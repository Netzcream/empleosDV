<script type="text/javascript" src="<?php echo $_SERVER["DOCUMENT_ROOT"] ?> /js/datedropper.js"></script>
<?php 
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}
if (!isset($_SESSION)) {
	session_start();
}

$Persona = new Persona();
if (isset($_SESSION["usr"])) {
	$Persona = unserialize (serialize ($_SESSION['usr']));
}
else {
	//LOGERROR
}
if (isset($_POST['action'])) {
	if ($_POST['action'] == "save") {
			$Persona->setNotificarme($_POST['notificarme']);
			$Persona->setEncontrarme($_POST['encontrarme']);
			$Persona->saveConfig1();
			$_SESSION["usr"] = $Persona;
	}
	else if ($_POST['action'] == "saveClave") {
	$original = $_POST['original'];
	$clave1 = $_POST['clave1'];
	$clave2 = $_POST['clave2'];
	$error = 0;
	$msj = "";


	
	if ($original == "") {
		//$('#claveOriginal').addClass('notSelected');
		$msj = "No ingreso clave actual<br>";
		$error++;
	}
	else if (strlen($original) < 5) {
		//$('#claveOriginal').addClass('notSelected');
		$msj = "La clave original debe tener al menos 5 caracteres.<br>";
		$error++;
	}
	if ($clave1 == "") {
		//$('#claveCambio1').addClass('notSelected');
		$msj .= "No ingreso nueva clave (1) <br>";
		$error++;
	}
	else if (strlen($clave1) < 5) {
		//$('#claveCambio1').addClass('notSelected');
		$msj .= "La nueva clave (1) debe tener al menos 5 caracteres.<br>";
		$error++;
	}
	if ($clave2 == "") {
		//$('#claveCambio2').addClass('notSelected');
		$msj .= "No ingreso nueva clave (2) <br>";
		$error++;
	}
	else if (strlen($clave2) < 5) {
		//$('#claveCambio2').addClass('notSelected');
		$msj .= "La nueva clave (2) debe tener al menos 5 caracteres.<br>";
		$error++;
	}
	if ($clave1 != $clave2) {
		//$('#claveCambio1').addClass('notSelected');
		//$('#claveCambio2').addClass('notSelected');
		$msj .= "No coinciden las claves<br>";
		$error++;
	}
	if ($error > 0) {
		echo "<label class='regLabelNota regError'>".$msj."</label>";
		}
	
	$conex = new MySQL();
	$consulta = " UPDATE usuario set Password=SHA1('".$clave1."') WHERE CodUsuario=".$Persona->getId()."  AND Password = SHA1('".$original."')";
	$conex->consulta($consulta);
	if ($Persona->getRol()->getId() == "AL") {
		$consulta = "UPDATE Alumno set FechaCambioPassword = NOW() WHERE CodUsuario=".$Persona->getId().";";
	}
	if ($Persona->getRol()->getId() == "EM") {
		$consulta = "UPDATE Empresa set FechaCambioPassword = NOW() WHERE CodUsuario=".$Persona->getId().";";
	}
	if ($Persona->getRol()->getId() == "PR") {
		$consulta = "UPDATE Profesor set FechaCambioPassword = NOW() WHERE CodUsuario=".$Persona->getId().";";
	}
	$conex->consulta($consulta);
	$Persona->getFechaCambioPass()->getSetFecha(date("Y-m-d H:i:s"));
	$_SERVER['usr'] = $Persona;
	
	echo "<script> $('#fechaCambioPass').html('&Uacute;ltimo cambio: ".$Persona->getFechaCambioPass()->getFechaCompleta()."');</script>";
	}
	else {
		//LOGERROR
	}

	//echo $Persona->getFechaCambioPass();
}

?>

				
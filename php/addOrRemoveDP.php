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
		if ($_POST['nac'] != "" 
		&& $_POST['apellido'] != "" 
		&& $_POST['nombre'] != ""
		&& $_POST['sexo'] != ""
		&& $_POST['tipo'] != ""
		&& $_POST['doc'] != ""
		) {
			$Persona->setApellido($_POST['apellido']);
			$Persona->setNombre($_POST['nombre']);
			$Persona->setSexo($_POST['sexo']);
			$Persona->setDocumentoByData($_POST['tipo'],$_POST['doc']);
			$Persona->getFechaNacClass()->setFecha($_POST['nac']);
			$Persona->saveDP();
			$_SESSION["usr"] = $Persona;
		}
		else {
			//LOGERROR
		}
	}
	else {
		//LOGERROR
	}
}


?>

				
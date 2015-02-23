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
	if ($_POST['action'] == "yes") {
		$carrera1 = $_POST['carrera1'];
		$carrera2 = $_POST['carrera2'];
		$valor = $_POST['val'];
		if ($carrera1 != "") {
			$Persona->setAvanceByCarrera($carrera1, $valor);
		}
		$avance = $Persona->getAvanceByCarrera($carrera2);
		echo "<script>
				$('#bBuscarPorcentaje').val('".$avance."');
				$('#bPorcentaje2').val('".$avance." %');
			</script>";
			$_SESSION["usr"] = $Persona;
	}
}

?>

				
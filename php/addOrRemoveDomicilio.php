<script type="text/javascript" src="<?php echo $_SERVER["DOCUMENT_ROOT"] ?> /js/datedropper.js"></script>
<?php 
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}
if (!class_exists('Direccion')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Direccion.php";
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
		if ($_POST['calle'] != "" && $_POST['loc'] != "" && $_POST['prov'] != "") {
			$Persona->getDomicilio()->setCalle($_POST['calle']);
			$Persona->getDomicilio()->getLoc()->setId($_POST['loc']);
			$Persona->getDomicilio()->getPcia()->setId($_POST['prov']);
			$Persona->getDomicilio()->setNum($_POST['nro']);
			if (isset($_POST['piso'])) {
				$Persona->getDomicilio()->setPiso($_POST['piso']);
			}
			else {
				$Persona->getDomicilio()->setPiso("");
			}
			if (isset($_POST['dpto'])) {
				$Persona->getDomicilio()->setDpto($_POST['dpto']);
			}
			else {
				$Persona->getDomicilio()->setDpto("");
			}
			$Persona->getDomicilio()->saveDomicilio($Persona->getId());	
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

				
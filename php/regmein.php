<?php
if (!isset($_SESSION)) { session_start(); }
$_SESSION['usuario'] = null;

if (isset($_POST)) {
	if (isset($_POST['error'])) {
		if ($_POST['error'] == 1) { echo "Error: No ingreso datos."; }
		else if ($_POST['error'] == 2) { echo "Error: Debe ingresar clave y confirmaci&oacute;n de la misma."; }
		else if ($_POST['error'] == 3) { echo "Error: Debe confirmar la clave."; }
		else if ($_POST['error'] == 4) { echo "Error: Debe ingresar la clave"; }
		else if ($_POST['error'] == 5) { echo "Error: No ingreso correo."; }
		else if ($_POST['error'] == 6) { echo "Error: No ingreso correo ni clave."; }
		else if ($_POST['error'] == 6) { echo "Error: No ingreso correo ni confirmación de clave."; }
		else if ($_POST['error'] == 8) { echo "Error: Ambas claves no coinciden."; }
		else { echo "Error no especificado"; }
		return;
	}
	else {
		
		$email = $_POST['email'];
		list($user, $dominio) = explode("@", $email);
		if ($dominio != "davinci.edu.ar") {
			echo "Actualmente no se encuentra permitido el registro a personas ajenas a la instituci&oacute;n";
			
		}
		
		/*
		$_POST['pass'];
		$_POST['pass2'];
		echo "Datos";
		*/
	}
}

?>
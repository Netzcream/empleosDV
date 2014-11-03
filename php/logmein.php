<?php
if (!isset($_SESSION)) { session_start(); }
$_SESSION['usuario'] = null;

if (isset($_POST)) {
	if (isset($_POST['error'])) {
		if ($_POST['error'] == 1) { echo "Error: No ingreso usuario y contrase&ntilde;a"; }
		else if ($_POST['error'] == 2) { echo "Error: No ingreso usuario"; }
		else if ($_POST['error'] == 3) { echo "Error: No ingreso contrase&ntilde;a"; }
		else { echo "Error no especificado"; }
		return;
	}
	else if (isset($_POST['logout'])) {
		session_destroy();
		/*
		echo "<script>
				$('#menuNavegador').load('php/menu.php');
				loadWeb(0);
			</script>";
			*/
		return;
		
	}
	$usr = $_POST['usr'];
	$usr = substr($usr,0,32);
	$usr = stripslashes($usr);
	$pwd = $_POST['pwd'];
	$pwd = stripslashes($pwd);
	$pwd = SHA1(substr($pwd,0,32));

	if ($usr == "" AND $pwd == "") { echo "Error: No ingreso usuario y contrase&ntilde;a"; }
	else if ($usr == "") { echo "Error: No ingreso usuario"; }
	else if ($pwd == "") { echo "Error: No ingreso contrase&ntilde;a"; }

	echo "Usuario: ".$usr." Pass:".$pwd;
}

?>
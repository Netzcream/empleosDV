<?php

if (!isset($_SESSION)) {
	session_start();
}

	$_SESSION['location'] = "login";
	echo "Hola";
	header('Location: ../index.php');
?>
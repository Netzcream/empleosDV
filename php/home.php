<?php 
if (!isset($_SESSION)) {
	session_start();
}
$_SESSION['location'] = "home";

if (($_SESSION['estadoUsuario'] == 2) AND ($_SESSION['UsuarioRol'] == "SA")) {
	include_once("primerosDatos.php");
}
else {
	
	echo "sss";
}




?>
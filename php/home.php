<?php 
if (!isset($_SESSION)) {
	session_start();
}
$_SESSION['location'] = "home";

if (isset($_SESSION['estadoUsuario']) AND $_SESSION['UsuarioRol'] AND ($_SESSION['estadoUsuario'] == 2) AND ($_SESSION['UsuarioRol'] == "SA")) {
		include_once("primerosDatos.php");
}
else {
	echo "HOME";
}




?>
<script>
errorToas('Prueba de Home');
</script>
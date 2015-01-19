<?php 
include_once("/conex.php");
if (!isset($_SESSION)) {
	session_start();
}
if (!isset($_SESSION['fotoPerfil'])) {
	$_SESSION['fotoPerfil'] = "imagenes/iconos/no_perfil.png";
}

$conex = new MySQL();
	
	$consulta = "UPDATE foto SET Foto =' ".$_SESSION['fotoPerfil']."'"
			." WHERE CodUsuario=".$_SESSION['CodUsuario'].";";
	$result = $conex->consulta($consulta);

echo '<img title="Perfil" alt="Foto Perfil" src="'.$_SESSION['fotoPerfil'].'">';
echo '<img class="upload" title="Cambiar imagen de perfil" alt="Foto Perfil" src="imagenes/iconos/upload_blanco.png">';
echo "<SCRIPT>$('#contMenu').load('php/menu.php'); </SCRIPT>";
?>
<?php

if (!isset($_SESSION)) { session_start(); }
if (isset($_SESSION['UsuarioRol'])) {
	if ($_SESSION['UsuarioRol'] == null) {
		$_SESSION['UsuarioRol'] = "SA";
	}
}
?>



<?php 

if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != null && $_SESSION['usuario'] != "") {

	echo '<div id="menuDa">';

//AD Administrador

 	if ($_SESSION['UsuarioRol'] == "AD") {
		echo '<div class="btnIcono" title="Autorizar"><img alt="Autorizar"src="imagenes/iconos/auth.png"><span>Autorizar</span></div>';
		echo '<div class="btnIcono" title="Bolsa"><img alt="Bolsa"src="imagenes/iconos/bolsa.png"><span>Bolsa</span></div>';
 		
	}
//AL Alumno
	else if ($_SESSION['UsuarioRol'] == "AL") {
		echo '<div class="btnIcono" title="Bolsa"><img alt="Bolsa"src="imagenes/iconos/bolsa.png"><span>Bolsa</span></div>';
	}
//EM Empresa
	else if ($_SESSION['UsuarioRol'] == "EM") {
		echo '<div class="btnIcono" title="Bolsa"><img alt="Bolsa"src="imagenes/iconos/bolsa.png"><span>Bolsa</span></div>';
	}
//PR Profesor
	else if ($_SESSION['UsuarioRol'] == "PR") {
	
	}
//SA Sin Asignar
	else if ($_SESSION['UsuarioRol'] == "SA") {
	
	} 
 
	$textLogOut = 'Admin - <span class="logoutLink" onclick="GoTo(5);">Desconectarse</span>';
 
	
	
	
	

	echo '<div class="btnIcono" title="Listados"><img alt="Listados"src="imagenes/iconos/listado.png"><span>Listado</span></div>';
	echo '<div class="btnIcono" title="Buscador"><img alt="Buscador"src="imagenes/iconos/lupa.png"><span>Buscador</span></div>';
	echo '<div class="btnIcono" id="perfilImg" title="Perfil"><img alt="Perfil"src="imagenes/no_perfil.png"><span>Perfil</span></div>';
	echo '</div>';
	
	
	
	echo "
	<script>
	function GoTo(a) {
		$('.menuDaInd').removeClass('selected');
	
		if (a == 0) $('#cuerpo').load('php/home.php');
		else if (a == 1) $('#cuerpo').load('php/registro.php');
		else if (a == 2) $('#cuerpo').load('php/login.php');
		else if (a == 3) { $('#btnListado').addClass('selected'); $('#cuerpo').load('php/listado.php'); }
		else if (a == 4) {
			$('#btnBuscador').addClass('selected');
			$('#cuerpo').load('php/buscar.php');
		}
		else if (a == 5) $('#cuerpo').load('php/logmein.php',{ logout:true });
	}
	$('#partOfMenu').html('". $textLogOut."');
	</script>";
	
	
	}
 ?>
 



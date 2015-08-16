<?php
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}
if (!isset($_SESSION)) { session_start(); }
if (isset($_SESSION['UsuarioRol'])) {
	if ($_SESSION['UsuarioRol'] == null) {
		$_SESSION['UsuarioRol'] = "SA";
	}
}
if (isset($_SESSION["usr"])) {
	$_SESSION["usr"] = unserialize (serialize ($_SESSION['usr']));
}

?>



<?php 

if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != null && $_SESSION['usuario'] != "") {

	echo '<div id="menuDa">';

//AD Administrador

 	if ($_SESSION['UsuarioRol'] == "AD") {
 		
 		$consulta = "SELECT * FROM usuario u"
					." INNER JOIN usuarioRol ur on (ur.CodUsuario = u.CodUsuario)"
					." WHERE u.estado = 2 AND ur.CodRol NOT IN ('SA','AD');";
 		
 		$conex = new MySQL();
 		$result = $conex->consulta($consulta);
 		$result2 = $conex->num_rows();
 		$auth = "";
 		if ($result2 > 0) {
 			$auth = "_rojo";
 		}
		echo '<div class="btnIcono" title="Autorizar" onclick="GoTo(6);"><img alt="Autorizar" src="imagenes/iconos/auth'.$auth.'.png"><span>Autorizar</span></div>';
		echo '<div class="btnIcono" title="Bolsa"><img alt="Bolsa"src="imagenes/iconos/bolsa.png"><span>Bolsa</span></div>';
		echo '<div class="btnIcono" title="Buscador" onclick="GoTo(4);"><img alt="Buscador" src="imagenes/iconos/lupa.png"><span>Buscador</span></div>';
	}
//AL Alumno
	else if ($_SESSION['UsuarioRol'] == "AL" AND $_SESSION['estadoUsuario'] == '3') {
		echo '<div class="btnIcono" title="Bolsa"><img alt="Bolsa"src="imagenes/iconos/bolsa.png"><span>Bolsa</span></div>';
		echo '<div class="btnIcono" id="perfilImg" onclick="GoTo(7);" title="Perfil"><img alt="Perfil" src="'.$_SESSION['usr']->getPic().'"><span>Perfil</span></div>';
	}
//EM Empresa
	else if ($_SESSION['UsuarioRol'] == "EM" AND $_SESSION['estadoUsuario'] == '3') {
		echo '<div class="btnIcono" title="Bolsa"  onclick="GoTo(8);"><img alt="Bolsa"src="imagenes/iconos/bolsa.png"><span>Bolsa</span></div>';
		echo '<div class="btnIcono" title="Buscador" onclick="GoTo(4);"><img alt="Buscador" src="imagenes/iconos/lupa.png"><span>Buscador</span></div>';
		echo '<div class="btnIcono" id="perfilImg" onclick="GoTo(7);" title="Perfil"><img alt="Perfil" src="'.$_SESSION['usr']->getPic().'"><span>Perfil</span></div>';
		
	}
//PR Profesor
	else if ($_SESSION['UsuarioRol'] == "PR" AND $_SESSION['estadoUsuario'] == '3') {
		echo '<div class="btnIcono" title="Buscador" onclick="GoTo(4);"><img alt="Buscador" src="imagenes/iconos/lupa.png"><span>Buscador</span></div>';
		echo '<div class="btnIcono" onclick="GoTo(7);" id="perfilImg" title="Perfil"><img alt="Perfil" src="'.$_SESSION['usr']->getPic().'"><span>Perfil</span></div>';
	}
//SA Sin Asignar
	else if ($_SESSION['UsuarioRol'] == "SA") {
	
	} 
	 $mostrarUsuario = $_SESSION['usuario'];
	 if (isset($_SESSION['MostrarNombre'])) {
	 	$mostrarUsuario = $_SESSION['MostrarNombre'];
	 }
	$textLogOut = $mostrarUsuario.' - <span onmouseover="hover()" onmouseout="unhover()" class="logoutLink" onclick="GoTo(5);">Desconectarse<img id="logOutIcon" class="logoutIcon" alt="Desconectarse" src="imagenes/iconos/logout_blanco.png"></span>';
	
	echo '</div>';
	
	
	
	echo "<script>
	function GoTo(a) {
		$('.menuDaInd').removeClass('selected');
		showWait();
		if (a == 0) $('#cuerpo').load('php/home.php');
		else if (a == 1) $('#cuerpo').load('php/registro.php');
		else if (a == 2) $('#cuerpo').load('php/login.php');
		else if (a == 3) { $('#btnListado').addClass('selected'); $('#cuerpo').load('php/listado.php'); }
		else if (a == 4) {
			$('#btnBuscador').addClass('selected');
			$('#cuerpo').load('php/buscar.php');
		}
		else if (a == 5) $('#cuerpo').load('php/logmein.php',{ logout:true });
		else if (a == 6) $('#cuerpo').load('php/authUsuarios.php');
		else if (a == 7) $('#cuerpo').load('php/perfilHome.php');
		else if (a == 8) $('#cuerpo').load('php/bolsaEmpresa.php');
	}
	$('#partOfMenu').html('". $textLogOut."');
		
	function hover() {
	    document.getElementById('logOutIcon').setAttribute('src', 'imagenes/iconos/logout.png');
	}
	function unhover() {
    	document.getElementById('logOutIcon').setAttribute('src', 'imagenes/iconos/logout_blanco.png');
	}
				
	</script>";
	
	
	}
 ?>
 



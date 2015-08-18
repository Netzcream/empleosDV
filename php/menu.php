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
	
	if (isset($_SESSION['usr'])) {
		$codUsuario = $_SESSION['usr']->getId();
	}
	echo '<div id="menuDa">';

//AD Administrador
echo '<div class="btnIcono" title="Inicio" onclick="GoTo(0);"><img alt="Inicio" src="imagenes/iconos/casa.png"><span>Inicio</span></div>';
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


 		$consulta2 = "SELECT * FROM Bolsa WHERE validaAdministrador=0 and fechaFinVigencia is null;";
		$conex2 = new MySQL();
 		$result3 = $conex2->consulta($consulta2);
 		$result4 = $conex2->num_rows();
 		$auth2 = "";
 		if ($result4 > 0) {
 			$auth2 = "_rojo";
 		}

		echo '<div class="btnIcono" title="Autorizar" onclick="GoTo(6);"><img alt="Autorizar" src="imagenes/iconos/auth'.$auth.'.png"><span>Autorizar</span></div>';
		echo '<div class="btnIcono" title="Usuarios" onclick="GoTo(12);"><img alt="Usuarios" src="imagenes/iconos/users.png"><span>Usuarios</span></div>';
		echo '<div class="btnIcono" title="Carreras" onclick="GoTo(13);"><img alt="Carreras" src="imagenes/iconos/carreras.png"><span>Carreras</span></div>';
		echo '<div class="btnIcono" title="Bolsa" onclick="GoTo(9);"><img alt="Bolsa"src="imagenes/iconos/bolsa'.$auth2.'.png"><span>Bolsa</span></div>';
		echo '<div class="btnIcono" title="Buscador" onclick="GoTo(4);"><img alt="Buscador" src="imagenes/iconos/lupa.png"><span>Buscador</span></div>';
	}
//AL Alumno
	else if ($_SESSION['UsuarioRol'] == "AL" AND $_SESSION['estadoUsuario'] == '3') {
		echo '<div class="btnIcono" title="Bolsa" onclick="GoTo(10);"><img alt="Bolsa"src="imagenes/iconos/bolsa.png"><span>Bolsa</span></div>';
		echo '<div class="btnIcono" title="Mis Postulaciones" onclick="GoTo(11);"><img alt="Postulaciones"src="imagenes/iconos/Postulaciones.png"><span>Postulado</span></div>';

		echo '<div class="btnIcono" title="Profesores" onclick="GoTo(15);"><img alt="Profesores" src="imagenes/iconos/users.png"><span>Prof.</span></div>';
		echo '<div class="btnIcono" title="Ver Recomendaciones" onclick="GoTo(16);"><img alt="Ver Recomendaciones" src="imagenes/iconos/reco.png"><span>Reco.</span></div>';

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

 		$consulta2 = "SELECT * FROM ProfesorRecomendacionAlumno WHERE estado=1 and codProfesor=".$codUsuario.";";
		$conex2 = new MySQL();
 		$result3 = $conex2->consulta($consulta2);
 		$result4 = $conex2->num_rows();
 		$reco = "";
 		if ($result4 > 0) {
 			$reco = "_rojo";
 		}


		echo '<div class="btnIcono" title="Recomendaciones" onclick="GoTo(14);"><img alt="Recomendaciones" src="imagenes/iconos/users'.$reco.'.png"><span>Reco</span></div>';
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
		else if (a == 5) $('#cuerpo').load('php/logmein.php',{ logout:true });";
if ($_SESSION['UsuarioRol'] == "AD") {
		echo "else if (a == 6) $('#cuerpo').load('php/authUsuarios.php');";
		echo "else if (a == 12) $('#cuerpo').load('php/adminListadoUsuarios.php');";
		echo "else if (a == 13) $('#cuerpo').load('php/adminABMCarreras.php');";
		echo " else if (a == 9) $('#cuerpo').load('php/bolsaAdminListado.php');";
	}
	if ($_SESSION['UsuarioRol'] == "PR" AND $_SESSION['estadoUsuario'] == '3') {
		echo "else if (a == 14) $('#cuerpo').load('php/profMisAlumnos.php');";
	}
		echo "else if (a == 7) $('#cuerpo').load('php/perfilHome.php');";
		echo "else if (a == 8) $('#cuerpo').load('php/bolsaEmpresa.php');";

		echo " else if (a == 10) $('#cuerpo').load('php/bolsaAlumnoList.php');";
		echo " else if (a == 11) $('#cuerpo').load('php/bolsaPostuladoAlumno.php');

		else if (a == 15) $('#cuerpo').load('php/alumnoProfesoresList.php');
		else if (a == 16) $('#cuerpo').load('php/alumnoRecomendaciones.php');

	}

	$('#partOfMenu').html('". $textLogOut."');
		
	function hover() {
	    document.getElementById('logOutIcon').setAttribute('src', 'imagenes/iconos/logout.png');
	}
	function unhover() {
    	document.getElementById('logOutIcon').setAttribute('src', 'imagenes/iconos/logout_blanco.png');
	}
	function reloadMenu() {
		$('#contMenu').load('php/menu.php');

	}	
	</script>";
	
	
	}
 ?>
 



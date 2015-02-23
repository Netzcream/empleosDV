<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}
/* Sistema de Logueo */
if (!isset($_SESSION)) { session_start(); }
$_SESSION['usuario'] = null;


if (isset($_POST)) {

	/* Se pueden recibir errores por parámetro (Validación del lado del cliente)*/
	if (isset($_POST['error'])) {
		if ($_POST['error'] == 1) { $error = "Error: No ingreso usuario y contrase&ntilde;a"; }
		else if ($_POST['error'] == 2) { $error = "Error: No ingreso usuario"; }
		else if ($_POST['error'] == 3) { $error = "Error: No ingreso contrase&ntilde;a"; }
		else { $error = "Error no especificado"; }
		$error = '<label class="regLabelNota regError">'.$error.'</label>';
		
		echo "<script>
			$('.loading').hide();
			$('.openLogin').show('fast');
			$('#reLabelNot').show('fast');
			document.getElementById('reLabelNot').innerHTML = '".$error."';
			</script>";
		return;
	}
	/* Se usa misma clase para desloguear; destruye la sesión */
	else if (isset($_POST['logout'])) {
		session_destroy();
		if (!isset($_SESSION)) {
			session_start();
		}
		
		$_SESSION['location'] = "login";
		echo "<script>
				$('#cuerpo').load('php/login.php');
				$('#contMenu').load('php/menu.php');
				$('#partOfMenu').html('');
			</script>";
		return;
		
	}
	$conex = new MySQL();
	/* Limpia la basura que pueda llegar a aparecer o ingresar el usuario */	
	$usr = $_POST['usr'];
	$usr = substr($usr,0,100);
	$usr = stripslashes($usr);
	$usr = $conex->escape($usr);
	$pwd = $_POST['pwd'];
	$pwd = stripslashes($pwd);
	$pwd = SHA1(substr($pwd,0,100));
	/* Validaciones del lado del servidor */
	if ($usr == "" AND $pwd == "") { $error = "Error: No ingreso usuario y contrase&ntilde;a"; } // No ingresa datos
	else if ($usr == "") { $error = "Error: No ingreso usuario"; } //No ingresa usuario
	else if ($pwd == "") { $error = "Error: No ingreso contrase&ntilde;a"; } //No ingresa clave
	
	if (isset($error) AND $error != "") {
		$error = '<label class="regLabelNota regError">'.$error.'</label>';
		echo "<script>
			$('.loading').hide();
			$('.openLogin').show('fast');
			$('#reLabelNot').show('fast');
			document.getElementById('reLabelNot').innerHTML = '".$error."';
			</script>";
		return;
		
	}
	$usr = strtolower ( $usr);


	$consulta = "SELECT * FROM usuario WHERE Email IN ('".$usr."','".$usr."@davinci.edu.ar') AND Password='".$pwd."';";
	$result = $conex->consulta($consulta);
	$result2 = $conex->num_rows();
	if ($result2 == 0) {
		$error = "El usuario/Mail y clave no coinciden";
		$error = '<label class="regLabelNota regError">'.$error.'</label>';
		echo "<script>
			$('.loading').hide();
			$('.openLogin').show('fast');
			$('#reLabelNot').show('fast');
			document.getElementById('reLabelNot').innerHTML = '".$error."';
			</script>";
		

		return;
	}
	else {
		$msj = "Ingres&oacute; correctamente.";
		
		

		$result3 = $conex->fetch_assoc();
		
		$_SESSION['usuario'] = $result3['Email'];
		$_SESSION['estadoUsuario'] = $result3['Estado'];
		$_SESSION['CodUsuario'] = $result3['CodUsuario'];
	
		$consulta = "SELECT * FROM usuarioRol where CodUsuario='".$result3['CodUsuario']."';";
		$result = $conex->consulta($consulta);
		$result3 = $conex->fetch_assoc();
		$_SESSION['UsuarioRol'] = $result3['CodRol'];
if ($_SESSION['estadoUsuario'] != 2) { 
	
		/* Si es alumno */
		if ($_SESSION['UsuarioRol'] == "AL" || $_SESSION['UsuarioRol'] == "PR") {
			$_SESSION['usr'] = new Persona();
			$_SESSION['usr']->getAndSetPersonaById($result3['CodUsuario']);
			$_SESSION['fotoPerfil'] = $_SESSION['usr']->getPic();
			$_SESSION['MostrarNombre'] = $_SESSION['usr']->getApellido() .", ".$_SESSION['usr']->getNombre();
		}
		else  {
			$_SESSION['usr'] = new Persona();
			$_SESSION['usr']->getAndSetPersonaById($result3['CodUsuario']);
			$_SESSION['MostrarNombre'] = $_SESSION['usr']->getNombre() ; 
			$_SESSION['fotoPerfil'] = $_SESSION['usr']->getPic();
		}
}
		
	if (!isset($_SESSION['fotoPerfil'])) {
		//Foto de perfil
		$consulta = "SELECT Foto FROM foto WHERE CodUsuario=".$_SESSION['CodUsuario'].";";
		$result = $conex->consulta($consulta);
		$result2 = $conex->num_rows();
		if ($result2 >0) {
			$result3 = $conex->fetch_assoc();
			$_SESSION['fotoPerfil'] = $result3['Foto'];
		}
		else {
			$_SESSION['fotoPerfil'] = 'imagenes/iconos/no_perfil.png';
		}
	}
		
		
		$msj = '<label class="regLabelNotificar">'.$msj.'</label>';
		echo "<script>
			$('.loading').hide();
			$('.openLogin').hide();
			$('#reLabelNot').show('fast');
			document.getElementById('reLabelNot').innerHTML = '".$msj."';
			setTimeout(function(){ 
					$('#cuerpo').load('php/home.php'),
					$('#contMenu').load('php/menu.php')
	},1500);
			</script>";
		
	}
	
}

?>
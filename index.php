<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
if (!isset($_SESSION)) {
	session_start();
}
if (!isset($_SESSION['location'])) {
	$_SESSION['location'] = "login";
}

if (!isset($_SESSION['usuario'])) {
	$_SESSION['location'] = "login";
}


if (isset($_GET)) {

	if (isset($_GET['m']) && isset($_GET['c']) ) {

		$_SESSION['location'] = "verificar";
		$email = $_GET['m'];
		$codigo = $_GET['c'];
		$email = substr($email,0,100);
		$email = stripslashes($email);
		$email = htmlentities($email,ENT_QUOTES);
		$codigo = stripslashes($codigo);
		$codigo = htmlentities($codigo,ENT_QUOTES);
		$_SESSION['vmail'] = $email;
		$_SESSION['vcode'] = $codigo;
	}

}
?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Bolsa DV</title>
		
		<link rel="shortcut icon" href="imagenes/logo/logo32.png" />
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
		
		<!-- Distintas hojas de estilos utilizadas -->
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
		<link rel="stylesheet" type="text/css" href="css/estilosM.css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>	
		<link rel="stylesheet" type="text/css" href="css/footable.standalone.css"/>
		<link rel="stylesheet" type="text/css" href="css/footable.core.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/login.css"/>
		<link rel="stylesheet" type="text/css" href="css/jq.Jcrop.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/perfil.css"/>
		<link rel="stylesheet" type="text/css" href="css/buscar.css"/>
		<link rel="stylesheet" type="text/css" href="css/jq.toastmessage.css"/>
		<link rel="stylesheet" type="text/css" href="css/datedropper.css"/>
		
		
		<!-- Distintos Scripts de JavaScript utilizados -->
		<script src="https://maps.googleapis.com/maps/api/js"></script>
		<script type="text/javascript" src="/js/jq-2.1.1.js"></script>
		<script type="text/javascript" src="/js/jq.min.js"></script>
		<script type="text/javascript" src="/js/scripts.js"></script>
		<script type="text/javascript" src="/js/jq.ez-pinned-footer.js"></script>
		<script type="text/javascript" src="/js/jq.toastmessage.js"></script>


		
	</head>
	<body>
	<div class="contenedor">
		<div class="preHeader">
		<div id="partOfMenu"></div>
		</div>

		<header id='headDa'>
			<div title="Bolsa DV" class="logo" onclick="GoTo(0);">
				<img alt="Bolsa DV" src="imagenes/logo/logo100.png">
				<span class="logoText">BolsaDV</span>
			</div>

			<div id="contMenu">
			<?php 
			if (isset($_SESSION['usuario'])) {
				include_once("php/menu.php");
				}
			?>
			</div>
		</header>

		<div id="cuerpo">
			<?php 
				if ($_SESSION['location'] == "home") {
					include_once("/php/home.php");
				}
				if ($_SESSION['location'] == "login") {
					include_once("/php/login.php");
				}
				else if ($_SESSION['location'] == "registro") {
					include_once("/php/registro.php");
				}
				else if ($_SESSION['location'] == "listado") {
					include_once("/php/listado.php");
				}
				else if ($_SESSION['location'] == "listadoAUTH") {
					include_once("/php/authUsuarios.php");
				}
				else if ($_SESSION['location'] == "listadoUsuarios") {
					include_once("/php/adminListadoUsuarios.php");
				}
				else if ($_SESSION['location'] == "buscar") {
					include_once("/php/buscar.php");
				}
				else if ($_SESSION['location'] == "abmCarreras") {
					include_once("/php/adminABMCarreras.php");
				}
				
				else if ($_SESSION['location'] == "verificar") {
					include_once("/php/verificoMail.php");
				}
				else if ($_SESSION['location'] == "perfilHome") {
					include_once("/php/perfilHome.php");
				}
				else if ($_SESSION['location'] == "bolsaAlumno") {
					include_once("/php/bolsaAlumnoList.php");
				}
				else if ($_SESSION['location'] == "bolsaAlumnoPostulado") {
					include_once("/php/bolsaPostuladoAlumno.php");
				}
				
				else if ($_SESSION['location'] == "misProfesores") {
					include_once("/php/alumnoProfesoresList.php");
				}
				else if ($_SESSION['location'] == "misRecomendaciones") {
					include_once("/php/alumnoRecomendaciones.php");
				}			
				else if ($_SESSION['location'] == "bolsaEmpresa") {
					include_once("/php/bolsaEmpresa.php");
				}	
				else if ($_SESSION['location'] == "misAlumnos") {
					include_once("/php/profMisAlumnos.php");
				}	
				else if ($_SESSION['location'] == "bolsaAdmin") {
					include_once("/php/bolsaAdminListado.php");
				}	

			?>

	<?php 

	?>

		</div>
	<div id="loadingBody" class="loading">
		<img alt="" src="imagenes/loading.gif" width=50>
	</div>
			<?php include_once("php/footer.php"); ?>	
			</div>
	</body>
</html>

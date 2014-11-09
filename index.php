<?php 

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
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/footable.standalone.css"/>
		<link rel="stylesheet" type="text/css" href="css/footable.core.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/login.css"/>
		<link rel="stylesheet" type="text/css" href="css/buscar.css"/>


	

		
		<!-- Distintos Scripts de JavaScript utilizados -->
		<script type="text/javascript" src="js/jq-2.1.1.js"></script>
		<script type="text/javascript" src="js/jq.min.js"></script>
		<script type="text/javascript" src="js/jq.ez-pinned-footer.js"></script>
		<script type="text/javascript" src="js/footable.js"></script>
		<script type="text/javascript" src="js/footable.sort.js"></script>
		<script type="text/javascript" src="js/footable.paginate.js"></script>
		<script type="text/javascript" src="js/footable.filter.js"></script>
	</head>
	<body>
	<div class="contenedor">
		<div class="preHeader"></div>

		<header>
			<div class="logo">
			<img  alt="Bolsa DV" src="imagenes/logo/logo100.png">
			
			
			<span>BolsaDV</span>
			
			
			</div>
			<?php 
			if (isset($_SESSION['usuario'])) {
				include_once("php/menu.php");
				}
			?>
		</header>

		<div id="cuerpo">
		
			<?php
		
			if ($_SESSION['location'] == "login") { 
				include_once("/php/login.php"); 
			}
			else if ($_SESSION['location'] == "registro") {
				include_once("/php/registro.php");
			}
			else if ($_SESSION['location'] == "listado") {
				include_once("/php/listado.php");
			}
			else if ($_SESSION['location'] == "buscar") {
				include_once("/php/buscar.php");
			}	
			else if ($_SESSION['location'] == "verificar") {
				include_once("/php/verificoMail.php");
			}		

			?>
	
		</div>
			<?php include_once("php/footer.php"); ?>	
			</div>
	</body>
</html>

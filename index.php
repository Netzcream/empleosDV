<?php 

if (!isset($_SESSION)) {
	session_start();
}

if (!isset($_SESSION['location'])) {
	$_SESSION['location'] = "login";
}
?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Bolsa DV</title>
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
	
		<div class="preHeader"></div>
	
		<header>
			<?php include_once("php/menu.php"); ?>
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
			
			?>
		</div>
		<?php include_once("php/footer.php"); ?>
	</body>
</html>

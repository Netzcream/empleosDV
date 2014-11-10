<?php
if (!isset($_SESSION)) { session_start(); }
$_SESSION['usuario'] = null;
include_once("/conex.php");

if (isset($_POST)) {
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
	else if (isset($_POST['logout'])) {
		session_destroy();
		/*
		echo "<script>
				$('#menuNavegador').load('php/menu.php');
				loadWeb(0);
			</script>";
			*/
		return;
		
	}
	$usr = $_POST['usr'];
	$usr = substr($usr,0,100);
	$usr = stripslashes($usr);
	$usr = htmlentities($usr,ENT_QUOTES);
	$pwd = $_POST['pwd'];
	$pwd = stripslashes($pwd);
	$pwd = SHA1(substr($pwd,0,100));

	if ($usr == "" AND $pwd == "") { $error = "Error: No ingreso usuario y contrase&ntilde;a"; }
	else if ($usr == "") { $error = "Error: No ingreso usuario"; }
	else if ($pwd == "") { $error = "Error: No ingreso contrase&ntilde;a"; }
	
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
	$usr= strtolower ( $usr);
	$conex = new MySQL();
	
	$consulta = "SELECT * FROM usuario WHERE Email IN ('".$usr."','".$usr."@davinci.edu.ar') AND Password='".$pwd."';";
	$result = $conex->consulta($consulta);
	$result2 = mysql_num_rows($result);
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
		
		$msj = '<label class="regLabelNotificar">'.$msj.'</label>';
		echo "<script>
			$('.loading').hide();
			$('.openLogin').hide();
			$('#reLabelNot').show('fast');
			document.getElementById('reLabelNot').innerHTML = '".$msj."';
			</script>";	
		$result3 = mysql_fetch_assoc($result);
		$_SESSION['usuario'] = $result3['Email'];
		$_SESSION['CodUsuario'] = $result3['CodUsuario'];
	}
	
}

?>
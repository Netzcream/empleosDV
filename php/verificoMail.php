<?php

if (!isset($_SESSION)) {
	session_start();
}
$email = $_SESSION['vmail'];
$codigo = $_SESSION['vcode'];


if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}

require_once $_SERVER["DOCUMENT_ROOT"]."/php/mail.php";

$consulta = "SELECT * FROM usuario WHERE Email='".$email."' AND CodConfirmacion='".$codigo."' AND Estado=1";
$conex = new MySQL();
$result = $conex->consulta($consulta);
if (mysql_num_rows($result) == 1) {
	$getts = mysql_fetch_assoc($result);
	$id=$getts['CodUsuario'];
	$consulta = "UPDATE usuario SET Estado=2 WHERE CodUsuario=".$id.";";
	$conex->consulta($consulta);
	
	$consulta = "INSERT INTO usuarioRol (CodUsuario,CodRol) values (".$id.",'SA');";
	$conex->consulta($consulta);
	
	$envioMail = new Email('v',$email);
	$envioMail->sendMail();
	$_SESSION['location'] = "login";
	//header('Location: ../');
	$notificoque = "Se verific&oacute; correctamente el registro. Puede loguearse ";
	
}
else {
	$notificoque = "Error: No existe registro pendiente de confirmaci&oacute;n que se coincidan con los datos propuestos.";
	$_SESSION['location'] = "registro";
}

$goto = "window.location.href = 'http://www.bolsadv.com'";

$texst = '<label class="regLabelNotificar">'.$notificoque.'</label> <input class="logInBtn" type="submit" value="Ir a Log In" onclick="'.$goto.'">';
echo "<script>
		$('.loading').hide();
		$('.openLogin').hide();
			</script>";
echo "<div class='prelogin'>
		".$texst."
		</div>";
?>

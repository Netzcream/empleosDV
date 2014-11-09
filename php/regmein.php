<?php
if (!isset($_SESSION)) { session_start(); }
$_SESSION['usuario'] = null;
include_once("/conex.php");
include_once("/mail.php");

if (isset($_POST)) {
	if (isset($_POST['error'])) {
		if ($_POST['error'] == 1) { echo "Error: No ingreso datos."; }
		else if ($_POST['error'] == 2) { echo "Error: Debe ingresar clave y confirmaci&oacute;n de la misma."; }
		else if ($_POST['error'] == 3) { echo "Error: Debe confirmar la clave."; }
		else if ($_POST['error'] == 4) { echo "Error: Debe ingresar la clave"; }
		else if ($_POST['error'] == 5) { echo "Error: No ingreso correo."; }
		else if ($_POST['error'] == 6) { echo "Error: No ingreso correo ni clave."; }
		else if ($_POST['error'] == 6) { echo "Error: No ingreso correo ni confirmación de clave."; }
		else if ($_POST['error'] == 8) { echo "Error: Ambas claves no coinciden."; }
		else if ($_POST['error'] == 9) { echo "Error: El correo ingresado es incorrecto."; }
		else if ($_POST['error'] == 10) { echo "Error: Su clave debe tener entre 5 y 15 caracteres."; }
		else if ($_POST['error'] == 11) { echo "Error: No existe forma en este mundo que un correo electr&oacute;nico institucional posea m&aacute;s de 100 caracteres, adem&aacute;s de que para ingresarlo tuvo que haber modificado el html... Y ESO no se hace. Esperaba mucho m&aacute;s de usted... Pi&eacute;nselo as&iacute;, si yo le dejara hacerlo, me crear&iacute;a una excepci&oacute;n la base de datos y esto ser&iacute;a un desprop&oacute;sito, error por ac&aacute;, error por all&aacute;. Pong&aacute;monos serios y ahora si, ingrese un correo normal y aqu&iacute; no ha pasado nada."; }
		else { echo "Error no especificado"; }
		return;
	}
	else {
		
		$email = $_POST['email'];
		list($user, $dominio) = explode("@", $email);
		if ($dominio != "davinci.edu.ar") {
			echo "Actualmente no se encuentra permitido el registro a personas ajenas a la instituci&oacute;n";
			return;
		}
		$email = htmlentities($email,ENT_QUOTES);
		$pass = htmlentities($_POST['pass']);
		$pass = SHA1(substr($pass,0,32));
		$consulta = "SELECT * FROM usuario WHERE Email='".$email."';";
		$conex = new MySQL();
		
		$result = mysql_num_rows($conex->consulta($consulta));
		if ($result > 0) {
			echo "Error: El correo ingresado ya se encuentra registrado.";
		}
		else {
			
			$confirmacion = SHA1($email."".date("YmdHis"));
			$consulta = "INSERT INTO usuario (Email,Password,Estado,CodConfirmacion)
					VALUES ('".$email."','".$pass."',0,'".$confirmacion."');";
			
			
			$conex->consulta($consulta);
			$sendMail = new Email('r',$email,$confirmacion);
			$envioMail = $sendMail->sendMail();
			if ($envioMail) {
				echo "Registrado con exito; revise su cuenta de correo ".$email." para realizar la confirmaci&oacute;n de registro.";
			}
			else {
				
				
			}
		}
	
	}
}

?>
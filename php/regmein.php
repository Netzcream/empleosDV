<?php
if (!isset($_SESSION)) { session_start(); }
$_SESSION['usuario'] = null;

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}

require_once $_SERVER["DOCUMENT_ROOT"]."/php/mail.php";

if (isset($_POST)) {
	if (isset($_POST['error'])) {
		$error = "";
		if ($_POST['error'] == 1) { $error = "Error: No ingreso datos."; }
		else if ($_POST['error'] == 2) { $error = "Error: Debe ingresar clave y confirmaci&oacute;n de la misma."; }
		else if ($_POST['error'] == 3) { $error = "Error: Debe confirmar la clave."; }
		else if ($_POST['error'] == 4) { $error = "Error: Debe ingresar la clave"; }
		else if ($_POST['error'] == 5) { $error = "Error: No ingreso correo."; }
		else if ($_POST['error'] == 6) { $error = "Error: No ingreso correo ni clave."; }
		else if ($_POST['error'] == 6) { $error = "Error: No ingreso correo ni confirmación de clave."; }
		else if ($_POST['error'] == 8) { $error = "Error: Ambas claves no coinciden."; }
		else if ($_POST['error'] == 9) { $error = "Error: El correo ingresado es incorrecto."; }
		else if ($_POST['error'] == 10) { $error = "Error: Su clave debe tener entre 5 y 15 caracteres."; }
		else if ($_POST['error'] == 11) { $error = "Error: No existe forma en este mundo que un correo electr&oacute;nico institucional posea m&aacute;s de 100 caracteres, adem&aacute;s de que para ingresarlo tuvo que haber modificado el html... Y ESO no se hace. Esperaba mucho m&aacute;s de usted... Pi&eacute;nselo as&iacute;, si yo le dejara hacerlo, me crear&iacute;a una excepci&oacute;n la base de datos y esto ser&iacute;a un desprop&oacute;sito, error por ac&aacute;, error por all&aacute;. Pong&aacute;monos serios y ahora si, ingrese un correo normal y aqu&iacute; no ha pasado nada."; }
		else { $error = "Error no especificado"; }
		
		$error = '<label class="regLabelNota regError">'.$error.'</label>';
		
		echo "<script>
			$('.loading').hide();
			$('.openLogin').show('fast');
			document.getElementById('reLabelNot').innerHTML = '".$error."';
			</script>";
		return;
	}
	else {
		
		$email = $_POST['email'];
		list($user, $dominio) = explode("@", $email);
		/*
		if ($dominio != "davinci.edu.ar") {
			$error = "Actualmente no se encuentra permitido el registro a personas ajenas a la instituci&oacute;n";
			echo "<script>
			$('.loading').hide();
			$('.openLogin').show('fast');
			document.getElementById('reLabelNot').innerHTML = '".$error."';
			</script>";
				
			return;
		}
		*/
		$email = htmlentities($email,ENT_QUOTES);
		$email = strtolower($email);
		$pass = htmlentities($_POST['pass']);
		$pass = SHA1(substr($pass,0,40));
		$consulta = "SELECT * FROM usuario WHERE Email='".$email."';";
		$conex = new MySQL();
		
		$result = mysql_num_rows($conex->consulta($consulta));
		if ($result > 0) {
			$error = "Error: El correo ingresado ya se encuentra registrado.";
			echo "<script>
			$('.loading').hide();
			$('.openLogin').show('fast');
			document.getElementById('reLabelNot').innerHTML = '".$error."';
		</script>";
				
		}
		else {
			
			$confirmacion = SHA1($email."".date("YmdHis"));
			$consulta = "INSERT INTO usuario (Email,Password,Estado,CodConfirmacion)
					VALUES ('".$email."','".$pass."',1,'".$confirmacion."');";
			
			
			$conex->consulta($consulta);
			$sendMail = new Email('r',$email,$confirmacion);
			$envioMail = $sendMail->sendMail();
			if ($envioMail) {
				$texst = '<label class="regLabelNotificar">Registrado con exito; revise su cuenta de correo '.$email.' para realizar la confirmaci&oacute;n de registro.</label> <input class="logInBtn" type="submit" value="Ir a Log In" onclick="goTo(0);">';
				echo "<script>
							document.getElementById('reLabelNot').innerHTML = '".$texst."';
							$('.loading').hide();
							$('.openLogin').hide();
						</script>";
				
			}
			else {
				echo "Error";
				echo "<script>
								$('.loading').hide();
								$('.openLogin').show();
			</script>";
				
			}
		}
	
	}
}

?>
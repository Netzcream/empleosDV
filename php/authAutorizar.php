<?php 

include_once("mail.php");

if (isset($_POST['codUsr'])) {
	$codUsr = htmlentities($_POST['codUsr'],ENT_QUOTES);
	
	if (!class_exists('MySQL')) {
		require_once 'conex.php';
	}
	$conex = new MySQL();

	$conex->consulta("START TRANSACTION;");
	$consulta = "UPDATE usuario SET Estado = 3 WHERE CodUsuario =".$codUsr.";";
	$a1 = $conex->consulta($consulta);
	$consulta = "INSERT INTO foto (CodUsuario, Foto)"
			." VALUES (".$codUsr.",'imagenes/iconos/no_perfil.png' );";
	$a2 = $conex->consulta($consulta);
	if ($a1) {
		$conex->consulta("COMMIT;");
		echo "<script>location.reload();errorToas('Usuario autorizado.'); </script>";
		$consulta = "SELECT Email FROM usuario WHERE CodUsuario =".$codUsr.";"; 
		$result = $conex->consulta($consulta);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$email = $row['Email'];
		$contenido ="";
		$subject = "Autorizado";
		$envioMail = new Email('p',$email,$contenido,$subject);
		$envioMail->sendMail();
	}
	else {
		$conex->consulta("ROLLBACK;");
		echo "<script>location.reload(); errorToas('Ocurrio un error.'); </script>";
		//LOGERROR
	}

}



?>
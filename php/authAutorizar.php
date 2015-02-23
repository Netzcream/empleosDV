<?php 

include_once("mail.php");

if (isset($_POST['codUsr'])) {

	
	if (!class_exists('MySQL')) {
		require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
	}
	$conex = new MySQL();
	$codUsr = $conex->escape($_POST['codUsr']);
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
		$row = $conex->fetch_array();
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
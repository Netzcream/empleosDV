<?php 


if (isset($_POST['codUsr'])) {
	$codUsr = htmlentities($_POST['codUsr'],ENT_QUOTES);
	include_once("/conex.php");
	$conex = new MySQL();
	$conex->consulta("START TRANSACTION;");
	$consulta = "UPDATE usuario SET Estado = 3 WHERE CodUsuario =".$codUsr.";";
	$a1 = $conex->consulta($consulta);
	
	
	$consulta = "INSERT INTO foto (CodUsuario, Foto)"
			." VALUES (".$_SESSION['CodUsuario'].",'imagenes/iconos/no_perfil.png' );";
	$a2 = $conex->consulta($consulta);
	if ($a1) {
		$conex->consulta("COMMIT;");
		echo "<script>location.reload();errorToas('Usuario autorizado.'); </script>";
	}
	else {
		$conex->consulta("ROLLBACK;");
		echo "<script>location.reload(); errorToas('Ocurrio un error.'); </script>";
		//LOGERROR
	}

}



?>
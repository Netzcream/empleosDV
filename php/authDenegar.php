<?php 


if (isset($_POST['codUsr'])) {
	$codUsr = htmlentities($_POST['codUsr'],ENT_QUOTES);
		

	if (!class_exists('MySQL')) {
		require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
	}
	$conex = new MySQL();
	$conex->consulta("START TRANSACTION;");
	$consulta = "DELETE FROM direccionUsuario WHERE CodUsuario =".$codUsr.";";
	$a1 = $conex->consulta($consulta);
	
	
	$consulta = "SELECT CodRol FROM usuarioRol WHERE CodUsuario =".$codUsr.";";
	$result = $conex->consulta($consulta);
	$resultado = mysql_fetch_assoc($result);
	
	$elRol = $resultado['CodRol'];
	
	$consulta = "UPDATE UsuarioRol SET CodRol='SA' WHERE CodUsuario =".$codUsr.";";
	$a2 = $conex->consulta($consulta);
	
	$a3 = true;
	if ($elRol == "AL") {
		$consulta = "DELETE FROM alumno WHERE CodUsuario =".$codUsr.";";
		$a3 = $conex->consulta($consulta);
	}
	else if ($elRol == "EM") {
		$consulta = "DELETE FROM empresa WHERE CodUsuario =".$codUsr.";";
		$a3 = $conex->consulta($consulta);
	}
	else if ($elRol == "PR") {
		$consulta = "DELETE FROM profesor WHERE CodUsuario =".$codUsr.";";
		$a3 = $conex->consulta($consulta);
	}
	if ($a1 and $a2 and $a3) {
		$conex->consulta("COMMIT;");
		echo "<script>location.reload();errorToas('Eliminado correctamente.'); </script>";
	}
	else {
		$conex->consulta("ROLLBACK;");
		echo "<script>location.reload(); errorToas('Ocurrio un error.'); </script>";
		//LOGERROR
	}

}



?>
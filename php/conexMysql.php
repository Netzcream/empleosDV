<?php
class MySQLiTest {
	private $conexion;
	private $total_consultas;

	public function MySQL(){
		if(!isset($this->conexion)){
			$this->conexion = new mysqli("localhost", "root","", "bolsadv");
		}
	}
	public function consulta($consulta){
		$stmt = $this->conexion->prepare($consulta);
		$this->total_consultas++;
		$resultado = $stmt->execute();
		if(!$resultado){
			echo 'MySQL Error: ' . mysql_error();
			exit;
		}
		return $resultado;
	}

	public function fetch_array($consulta){
		return mysql_fetch_array($consulta);
	}
	public function num_rows($consulta){
		return mysql_num_rows($consulta);
	}
	public function getTotalConsultas(){
		return $this->total_consultas;
	}
}
?>
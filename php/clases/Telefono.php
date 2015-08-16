<?php 
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}

class Telefono {
	private $id;
	private $numero;
	private $tipo;
	private $colTipos;
	
	public function __construct() {
		$this->id = null;
		$this->numero = null;
		$this->tipo = null;
		$this->colTipos = array();
	}
	
	public function getColTipos() {
		$consulta = "SELECT ID_TipoTelefono as id, Descripcion as tipo FROM tipotelefono;";
		$conex = new MySQL();
		$conex->consulta($consulta);
		//$result = $conex->fetch_assoc();
		//$result1 = $conex->consulta($consulta);
		$result = $conex->fetch_assoc();
		while ($result) {
			$this->colTipos[$result['id']] = $result['tipo'];
			$result = $conex->fetch_assoc();
		}
		return $this->colTipos;
	}
	
	
	
	
	
}


?>
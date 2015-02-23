
<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}

class EstadoUsuario {
	private $id;
	private $estado;

	public function __construct() { 
		$this->id = null;
		$this->estado = null;
	}

	public function getEstadoById($id) {
		$temp = new EstadoUsuario();
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT ID_EstadoUsuario as id, Descripcion as estado FROM EstadoUsuario "
					." WHERE ID_EstadoUsuario= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$temp->id = $result['id'];
			$temp->estado = $result['estado'];
		}
		return $temp;
	}
	public function getAndSetEstadoById($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT ID_EstadoUsuario as id, Descripcion as estado FROM EstadoUsuario "
					." WHERE ID_EstadoUsuario= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$this->id = $result['id'];
			$this->estado = $result['estado'];
		}
	}
	public function getAndSetEstadoByUsuarioId($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT eu.ID_EstadoUsuario as id, eu.Descripcion as estado FROM EstadoUsuario eu
						INNER JOIN usuario u on (u.Estado=eu.ID_EstadoUsuario)
						WHERE u.CodUsuario= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$this->id = $result['id'];
			$this->estado = $result['estado'];
		}
	}
	public function getEstadoByUsuarioId($id) {
		$temp = new EstadoUsuario();
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT eu.ID_EstadoUsuario as id, eu.Descripcion as estado FROM EstadoUsuario eu
						INNER JOIN usuario u on (u.Estado=eu.ID_EstadoUsuario)
						WHERE u.CodUsuario= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$temp->id = $result['id'];
			$temp->estado = $result['estado'];
		}
		return $temp;
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		if ($id) {
			$this->id = $id;	
		}
		else {
			//LOGERROR
		}
	}
	public function getEstado() {
		return $this->estado;
	}
	public function setEstado($est) {
		if ($est) {
			$this->estado = $est;	
		}
		else {
			//LOGERROR
		}
		
	}

}

?>
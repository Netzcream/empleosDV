<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
class EstadoCivil {
	private $id;
	private $estadoCivil;

	public function __construct() {
		$this->id = null;
		$this->estadoCivil = null;
	}
	public function getECById($id) {
		$temp = new EstadoCivil();
		if ($id) {
			$conex = new MySQL();
			$consulta = "SELECT ec.ID_EstadoCivil as id, ec.EstadoCivil as estado FROM estadocivil ec
		WHERE ec.ID_EstadoCivil= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$temp->setId($result['id']);
			$temp->setEstadoCivil(utf8_encode($result['estado']));
		}
		return $temp;
	}
	public function getAndSetECById($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = "SELECT ec.ID_EstadoCivil as id, ec.EstadoCivil as estado FROM estadocivil ec
		WHERE ec.ID_EstadoCivil= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$this->id = $result['id'];
			$this->estadoCivil = utf8_encode($result['estado']);
		}
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
	public function getEstadoCivil() {
		return $this->estadoCivil;
	}
	public function setEstadoCivil($ec) {
		if ($ec) {
			$this->estadoCivil = $ec;
		}
		else {
			//LOGERROR
		}
	}
}

?>
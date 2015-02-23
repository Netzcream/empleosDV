<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}

class Pais {
	private $id;
	private $pais;

	public function __construct() {	
		$this->id = null;
		$this->pais = null;
	}

	public function getPaisById($id) {
		$temp = new Pais();
		if ($id) {
			$conex = new MySQL();
			$consulta = "SELECT p.ID_Pais as id, p.Pais as pais FROM paises p
						WHERE p.ID_Pais= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$temp->setId($id);
			$temp->setPais($result['pais']);
		}
		return $temp;
	}
	public function getAndSetPaisById($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = "SELECT p.ID_Pais as id, p.Pais as pais FROM paises p
						WHERE p.ID_Pais= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$this->setId($id);
			$this->setPais($result['pais']);
		}
	}
	public function getColPaises() {
		$conex = new MySQL();
		$consulta = "SELECT ID_Pais as id, Pais as pais FROM paises;";
		$result1 = $conex->consulta($consulta);
		$result = $conex->fetch_assoc();
		$return = array();
		while($result) {
			$return[$result['id']] = $result['pais'];
			$result = $conex->fetch_assoc();
		}
		return $return;
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
	public function getPais() {
		return $this->pais;
	}
	public function setPais($pais) {
		if ($pais) {
			$this->pais = $pais;
		}
		else {
			//LOGERROR
		}
	}

}

?>
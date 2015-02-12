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
			$result1 = $this->conex->consulta($this->consulta);
			$result = mysql_fetch_assoc($result1);
			$temp->id = $id;
			$temp->pais = utf8_encode($result['pais']);
		}
		return $temp;
	}
	public function getAndSetPaisById($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = "SELECT p.ID_Pais as id, p.Pais as pais FROM paises p
						WHERE p.ID_Pais= '".$id."';";
			$result1 = $this->conex->consulta($this->consulta);
			$result = mysql_fetch_assoc($result1);
			$this->id = $id;
			$this->pais = utf8_encode($result['pais']);
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
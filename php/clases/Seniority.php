<?php 
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}

class Seniority {
	private $id;
	private $seniority;

	public function __construct() { 
		$this->id = null;
		$this->seniority = null;
	}
	
	
	public function getSeniorityById($id) {
		$temp = new Seniority();
		if ($id) {		
			$conex = new MySQL();
			$consulta = "SELECT Seniority FROM seniority where ID_Seniority=".$id.";";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$temp->setId($id);
			$temp->setSeniority($result['Seniority']);
		}
		return $temp;
	}
	public function getAndSetSeniorityById($id) {
		if ($id) {
			$this->setId($id);
			$this->setSeniority($this->getSeniorityById($id)->getSeniority());
		}
	}
	public function getColSeniorities() {
		$conex = new MySQL();
		$consulta = "SELECT ID_Seniority as id, Seniority as detalle FROM seniority;";
		$result1 = $conex->consulta($consulta);
		$result = $conex->fetch_assoc();
		$return = array();
		while($result) {
			$return[$result['id']] = $result['detalle'];
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
	public function getSeniority() {
		return $this->seniority;
	}
	public function setSeniority($se) {
		if ($se) {
			$this->seniority = $se;
		}
		else {
			//LOGERROR
		}
	}
	

}


?>
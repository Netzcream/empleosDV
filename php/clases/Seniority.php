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
			$result = mysql_fetch_assoc($result1);
			$temp->setId($id);
			$temp->setSeniority(utf8_encode($result['Seniority']));
		}
		return $temp;
	}
	public function getAndSetSeniorityById($id) {
		if ($id) {
			$this->setId($id);
			$this->setSeniority($this->getSeniorityById($id));
		}
	}
	public function getColSeniorities() {
		$conex = new MySQL();
		$consulta = "SELECT ID_Seniority as id, Seniority as detalle FROM seniority;";
		$result1 = $conex->consulta($consulta);
		$result = mysql_fetch_assoc($result1);
		$return = array();
		while($result) {
			$return[$result['id']] = utf8_encode($result['detalle']);
			$result = mysql_fetch_assoc($result1);
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
			$this->rol = $se;
		}
		else {
			//LOGERROR
		}
	}
	

}


?>
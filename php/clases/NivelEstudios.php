
<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}

class NivelEstudios {
	private $id;
	private $nivel;

	public function __construct() { 
		$this->id= null;
		$this->nivel = null;
		
	}
	
	public function getNivelById($id) {
		$temp = new NivelEstudios();
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT NivelEstudio as nivel FROM nivelestudios "
					." WHERE ID_NivelEstudio= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$temp->setId($id);
			$temp->nivel = $result['nivel'];
		}
		return $temp;
	}
	public function getAndSetNivelById($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT NivelEstudio as nivel FROM nivelestudios "
					." WHERE ID_NivelEstudio= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$this->setId($id);
			$this->nivel = $result['nivel'];
		}
	}
	
	public function getNiveles() {
		$temp = array();
		$conex = new MySQL();
		$consulta = " SELECT ID_NivelEstudio as id, NivelEstudio as nivel FROM nivelestudios ";
		$result1 = $conex->consulta($consulta);
		$result = $conex->fetch_assoc();
		while ($result) {
			$temp[$result['id']] = $result['nivel'];
			$result = $conex->fetch_assoc();
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
	public function getNivel() {
		return $this->nivel;
	}
	public function setNivel($nivel) {
		if ($nivel) {
			$this->nivel = $nivel;
		}
		else {
			//LOGERROR
		}
	}

}

?>
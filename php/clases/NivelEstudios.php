
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
			$result = mysql_fetch_assoc($result1);
			$temp->setId($id);
			$temp->nivel = utf8_encode($result['nivel']);
		}
		return $temp;
	}
	public function getAndSetNivelById($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT NivelEstudio as nivel FROM nivelestudios "
					." WHERE ID_NivelEstudio= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$this->setId($id);
			$this->nivel = utf8_encode($result['nivel']);
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
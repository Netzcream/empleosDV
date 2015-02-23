
<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}

class Carrera {
	private $id;
	private $descripcion;
	private $materias;
	private $carreras;

	public function __construct() { 
		$this->id = null;
		$this->estado = null;
		$this->materias = array();
		$this->carreras = array();
	}

	public function getCarrerasActivas() {
			$conex = new MySQL();
			$consulta = " SELECT CodCarrera as id, Descripcion as des FROM carrera "
					." WHERE Activo=1;";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			while ($result) {
				$this->carreras[$result['id']] = $result['des']; 	
				$result = $conex->fetch_assoc();
			}
			return $this->carreras;
	}
	
	public function getMaterias() {
		$temp = new Materia();
		$this->materias = $temp->getMateriasActivasByCarreraID($this->getId());
		return $this->materias;
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
	public function getDescripcion() {
		return $this->descripcion;
	}
	public function setDescripcion($desc) {
		if ($desc) {
			$this->descripcion = $desc;	
		}
		else {
			//LOGERROR
		}
		
	}

	

}

?>
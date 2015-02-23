
<?php

if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php"; }
if (!class_exists('Carrera')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Carrera.php"); }
if (!class_exists('Persona')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php"); }

class Materia {
	private $id;
	private $descripcion;
	private $profesores;
	private $carrera;
	private $materias;

	public function __construct() { 
		$this->id = null;
		$this->descripcion = null;
		$this->profesores = array();
		$this->carrera = null;
		$this->materias = array();
	}

	public function getMateriasActivasByCarreraID($id) {
			$conex = new MySQL();
			$consulta = " SELECT CodMateria as id, Materia as des FROM materia "
					." WHERE Activo=1 AND CodCarrera = '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			while ($result) {
				$temp = new Materia();
				$temp->setId($result['id']);
				$temp->setDescripcion($result['des']);
				$temp->setCarrera($id);
				$this->materias[$result['id']] = $temp; 	
				$result = $conex->fetch_assoc();
			}
			return $this->materias;
	}
	
	public function getProfesores() {
		$conex = new MySQL();
		$consulta = " SELECT pr.CodUsuario FROM profesormateria pm
			INNER JOIN profesor pr on (pm.ID_Profesor=pr.ID_Profesor)
			WHERE pm.CodMateria='".$this->getId()."';";
		$result1 = $conex->consulta($consulta);
		$result = $conex->fetch_assoc();
		while ($result) {
			$temp = new Persona();
			$temp->getPersonaById($result['id']);
			$this->profesores[$result['id']] = $temp;
			$result = $conex->fetch_assoc();
		}
		return $this->profesores;
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
	public function getCarrera() {
		return $this->carrera;
	}
	public function setCarrera($desc) {
		if ($desc) {
			$this->carrera = $desc;
		}
		else {
			//LOGERROR
		}
	
	}
	

}

?>
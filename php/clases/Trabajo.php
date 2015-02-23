
<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Fecha')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Fecha.php";
}
if (!class_exists('Pais')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Pais.php";
}
if (!class_exists('Seniority')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Seniority.php";
}
class Trabajo {
	private $id;
	private $idAlumno;
	private $puesto;
	private $seniority;
	private $empresa;
	private $descripcion;
	private $pais;
	private $fechaDesde;
	private $fechaHasta;
	private $personasCargo;
	
	

	public function __construct() { 
		$this->id= null;
		$this->idAlumno = null;
		$this->puesto = null;
		$this->empresa = null;
		$this->descripcion = null;
		$this->seniority = new Seniority();
		$this->pais = new Pais();
		$this->fechaDesde = new Fecha();
		$this->fechaHasta = new Fecha();
		$this->personasCargo = false;
	}
	
	public function getTrabajosById($id) {
		$temp = new Trabajo();
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT ID_Alumno as idAlumno, Puesto as puesto, ID_Seniority as seniority, Empresa as empresa, ID_Pais as pais, FechaInicio as inicio,FechaFin as fin, Descripcion as descr, PersonasACargo as acargo FROM experiencialaboral "
						." WHERE ID_Experiencia = '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$temp->setId($id);
			$temp->setIdAlumno($result['idAlumno']);
			$temp->setPuesto($result['puesto']);
			$temp->getSeniority()->getAndSetSeniorityById($result['seniority']);
			$temp->setEmpresa($result['empresa']);
			$temp->getPais()->getAndSetPaisById($result['pais']);
			$temp->setDesc($result['descr']);
			$temp->setPersonasCargo($result['acargo']);
			$temp->getFechaDesde()->getSetFecha($result['inicio']);
			$temp->getFechaHasta()->getSetFecha($result['fin']);
		}
		return $temp;
	}
	
	
	public function getTrabajosByAlumnoId($Aid) {
		$return = array();
		
		if ($Aid) {
			$conex = new MySQL();
			$consulta = " SELECT ID_Experiencia as id, Puesto as puesto, ID_Seniority as seniority, Empresa as empresa, ID_Pais as pais, FechaInicio as inicio,FechaFin as fin, Descripcion as descr, PersonasACargo as acargo FROM experiencialaboral "
					." WHERE ID_Alumno = '".$Aid."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			while ($result) {
				$temp = new Trabajo();
				$temp->setId($result['id']);
				$temp->setIdAlumno($Aid);
				$temp->setPuesto($result['puesto']);
				$temp->getSeniority()->getAndSetSeniorityById($result['seniority']);
				$temp->setEmpresa($result['empresa']);
				$temp->getPais()->getAndSetPaisById($result['pais']);
				$temp->setDesc($result['descr']);
				$temp->setPersonasCargo($result['acargo']);
				$temp->getFechaDesde()->getSetFecha($result['inicio']);
				$temp->getFechaHasta()->getSetFecha($result['fin']);
				$return[$temp->getId()] = $temp;
				unset($temp);
				$result = $conex->fetch_assoc();
			}
		}
		return $return;
	}
	public function getAndSetTrabajosById($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT ID_Alumno as idAlumno, Puesto as puesto, ID_Seniority as seniority, Empresa as empresa, ID_Pais as pais, FechaInicio as inicio,FechaFin as fin, Descripcion as descr, PersonasACargo as acargo FROM experiencialaboral "
					." WHERE ID_Experiencia = '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$this->setId($id);
			$this->setIdAlumno($result['idAlumno']);
			$this->setPuesto($result['puesto']);
			$this->getSeniority()->getAndSetSeniorityById($result['seniority']);
			$this->setEmpresa($result['empresa']);
			$this->getPais()->getAndSetPaisById($result['pais']);
			$this->setDesc($result['descr']);
			$this->setPersonasCargo($result['acargo']);
			$this->getFechaDesde()->getSetFecha($result['inicio']);
			$this->getFechaHasta()->getSetFecha($result['fin']);
		}
		
	}

	public function removeWorkFromIdAndPer($Wid,$Aid) {
		if ($Wid && $Aid) {
			$conex = new MySQL();
			$consulta = "DELETE FROM experiencialaboral WHERE ID_Experiencia=".$Wid." and ID_Alumno=".$Aid;
			$conex->consulta($consulta);
		} 
	}
	public function saveAndReturnIdByPersona($Aid) {
		$_SESSION["pretemp"] = "Test". $this->getId();
		if ($this->getId() == null) {
			$conex = new MySQL();
			$this->setIdAlumno($Aid);
			$_SESSION["temp"] = $this;
			$consulta = " INSERT INTO experiencialaboral ";
			$consulta .= "(ID_Experiencia,ID_Alumno,Puesto,ID_Seniority,Empresa,ID_Pais,FechaInicio,FechaFin,Descripcion,PersonasACargo)";
			$consulta .= " VALUES ";
			$consulta .= "(null
					,'".$this->getIdAlumno()."'
					,'".$conex->escape($this->getPuesto())."'
					,'".$this->getSeniority()->getId()."'
					,'".$conex->escape($this->getEmpresa())."'
					,'".$this->getPais()->getId()."'
					,'".$this->getFechaDesde()->getForInsert()."'
					,'".$this->getFechaHasta()->getForInsert()."'
					,'".$conex->escape($this->getDesc())."'
					,'".$this->getPersonasCargoForInsert()."')";
		
			$conex->consulta($consulta);
			$lastId = $conex->last_id();
			$this->setId($lastId);
			return $this;
		}
		else {
			$conex = new MySQL();
			$consulta = "UPDATE experiencialaboral "
			." set ID_Alumno = '".$this->getIdAlumno()."', "
			." Puesto = '".$conex->escape($this->getPuesto())."', "
			." ID_Seniority = '".$this->getSeniority()->getId()."', "
			." Empresa = '".$conex->escape($this->getEmpresa())."', "
			." ID_Pais = '".$this->getPais()->getId()."', "
			." FechaInicio = '".$this->getFechaDesde()->getForInsert()."', "
			." Descripcion = '".$conex->escape($this->getDesc())."', "
			." PersonasACargo = '".$this->getPersonasCargoForInsert()."', ";
			if ($this->getFechaHasta()->getForInsert() > 0 && $this->getFechaHasta()->getForInsert() != null)  {
				$consulta .= " FechaFin = '".$this->getFechaHasta()->getForInsert()."' ";
			}
			else {
				$consulta .= " FechaFin = NULL ";
			}
			
			$consulta .= " WHERE ID_Experiencia=".$this->getId().";";
			$conex->consulta($consulta);
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
	public function getIdAlumno() {
		return $this->idAlumno;
	}
	public function setIdAlumno($id) {
		if ($id) {
			$this->idAlumno = $id;
		}
		else {
			//LOGERROR
		}
	
	}
	public function getPuesto() {
		return $this->puesto;
	}
	public function setPuesto($puesto) {
		if ($puesto) {
			$this->puesto = $puesto;
		}
		else {
			//LOGERROR
		}
	
	}
	public function getSeniority() {
		return $this->seniority;
	}
	public function setSeniority($seniority) {
		if ($seniority) {
			$this->seniority = $seniority;
		}
		else {
			//LOGERROR
		}
	
	}
	public function getEmpresa() {
		return $this->empresa;
	}
	public function setEmpresa($empresa) {
		if ($empresa) {
			$this->empresa = $empresa;
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
	public function getFechaDesde() {
		return $this->fechaDesde;
	}
	public function setFechaDesde($fecha) {
		if ($fecha) {
			$this->fechaDesde= $fecha;
		}
		else {
			//LOGERROR
		}
	}
	public function getFechaHasta() {
		return $this->fechaHasta;
	}
	public function setFechaHasta($fecha) {
		if ($fecha) {
			$this->fechaHasta = $fecha;
		}
		else {
			//LOGERROR
		}
	}
	public function getPersonasCargo() {
		return $this->personasCargo;
	}
	public function getPersonasCargoForInsert() {
		if ($this->personasCargo == "1") { return true; }
		else return false;
	}
	public function setPersonasCargo($per) {
		$this->personasCargo = $per;
	}
	public function getDesc() {
		return $this->descripcion;
	}
	public function setDesc($desc) {
		if ($desc) {
			$this->descripcion = $desc;
		}
		else {
			//LOGERROR
		}
	}

}

?>
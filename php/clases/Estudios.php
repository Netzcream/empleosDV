
<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Fecha')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Fecha.php";
}
if (!class_exists('NivelEstudio')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/NivelEstudios.php";
}
class Estudios {
	private $id;
	private $instituto;
	private $titulo;
	private $nivelEstudio;
	private $fechaDesde;
	private $fechaHasta;
	
	

	public function __construct() { 
		$this->id= null;
		$this->instituto = null;
		$this->titulo = null;
		$this->nivelEstudio = new NivelEstudios();
		$this->fechaDesde = new Fecha();
		$this->fechaHasta = new Fecha();
	}
	
	public function getEstudiosById($id) {
		$temp = new Estudios();
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT id as id, institucion, titulo, ID_NivelEstudio as nivel, fechaDesde as desde, fechaHasta as hasta FROM estudios "
					." WHERE id= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$temp->setId($id);
			$temp->setInstituto(utf8_encode($result['institucion']));
			$temp->setTitulo(utf8_encode($result['titulo']));
			$temp->getNivel()->getAndSetNivelById($result['nivel']);
			$temp->getFechaDesde()->getSetFecha($result['desde']);
			$temp->getFechaHasta()->getSetFecha($result['hasta']);
		}
		return $temp;
	}
	public function getAndSetNivelById($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT id as id, institucion, titulo, ID_NivelEstudio as nivel, fechaDesde as desde, fechaHasta as hasta FROM estudios "
					." WHERE id= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$this->setId($id);
			$this->setInstituto(utf8_encode($result['institucion']));
			$this->setTitulo(utf8_encode($result['titulo']));
			$this->getNivel()->getAndSetNivelById($result['nivel']);
			$this->getFechaDesde()->getSetFecha($result['desde']);
			$this->getFechaHasta()->getSetFecha($result['hasta']);
		}
	}
	public function removeEstFromPersonaAndId($Pid,$Eid) {
		if ($Eid AND $Pid) {
			$conex = new MySQL();
			$consulta = "SELECT count(*) FROM usuarioEstudios WHERE CodUsuario=".$Pid." and estudiosID=".$Eid;
			if (mysql_fetch_row($conex->consulta($consulta)) > 0) {
				$consulta = "DELETE FROM usuarioEstudios WHERE CodUsuario=".$Pid." and estudiosID=".$Eid;
				$conex->consulta($consulta);
				$consulta = "DELETE FROM estudios WHERE id=".$Eid;
				$conex->consulta($consulta);
			}
		} 
	}
	public function saveAndReturnIdByPersona($Pid) {
		if ($this->getId() == null) {
			$conex = new MySQL();
			
			$consulta = "INSERT INTO estudios (id,institucion,titulo,ID_NivelEstudio,fechaDesde,fechaHasta)
			values (null,'".htmlentities($this->getInstituto(),ENT_QUOTES)."','".htmlentities($this->getTitulo(),ENT_QUOTES)."','".$this->getNivel()->getId()."','".$this->getFechaDesde()->getForInsert()."','".$this->getFechaHasta()->getForInsert()."')";
			$conex->consulta($consulta);
			$lastId = mysql_insert_id();
			$this->setId($lastId);
			$consulta = "INSERT INTO usuarioEstudios (id,CodUsuario,estudiosID) VALUES (null,".$Pid.",".$lastId.")";
			$conex->consulta($consulta);
			return $this;
		}
		else {
			$conex = new MySQL();

			$consulta = "UPDATE estudios "
					." set institucion = '".htmlentities($this->getInstituto(),ENT_QUOTES)."', "
					." titulo = '".htmlentities($this->getTitulo(),ENT_QUOTES)."', "
					." ID_NivelEstudio = '".$this->getNivel()->getId()."', "
					." fechaDesde = '".$this->getFechaDesde()->getForInsert()."', ";
					if ($this->getFechaHasta()->getForInsert() > 0 && $this->getFechaHasta()->getForInsert() != null)  {
						$consulta .= " fechaHasta = '".$this->getFechaHasta()->getForInsert()."' ";
					}
					else {
						$consulta .= " fechaHasta = NULL ";
					}
					
					$consulta .= " WHERE id=".$this->getId().";";
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
	public function getInstituto() {
		return $this->instituto;
	}
	public function setInstituto($inst) {
		if ($inst) {
			$this->instituto = $inst;
		}
		else {
			//LOGERROR
		}
	}
	public function getTitulo() {
		return $this->titulo;
	}
	public function setTitulo($tit) {
		if ($tit) {
			$this->titulo= $tit;
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
			$this->fechaHasta= $fecha;
		}
		else {
			//LOGERROR
		}
	}
	
	public function getNivel() {
		return $this->nivelEstudio;
	}
	public function setNivel($nivel) {
		if ($nivel) {
			$this->nivelEstudio = $nivel;
		}
		else {
			//LOGERROR
		}
	}

}

?>
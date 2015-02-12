<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}

class Provincia {
	private $id;
	private $provincia;

	public function __construct() { 
		$this->id=null;
		$this->provincia = null;
	}
	
	public function getProvinciaById($id) {
		$temp = new Provincia();
		if ($id) {
			$conex = new MySQL();
			$consulta = " Select ID_Provincia as id, Provincia as provincia From Provincia "
							 . " WHERE ID_Provincia = '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$temp->setId($result['id']);
			$temp->setProvincia(utf8_encode($result['provincia']));
		}
		return $temp;
	}
	public function getAndSetProvinciaById($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = " Select ID_Provincia as id, Provincia as provincia From Provincia "
					. " WHERE ID_Provincia = '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$this->setId($result['id']);
			$this->setProvincia(utf8_encode($result['provincia']));
		}
	}
	public function getProvinciaByLocalidadId($id) {
		$temp = new Provincia();
		if ($id) {
			$conex = new MySQL();
			$consulta = " Select p.ID_Provincia as id, p.Provincia as provincia from Provincia p "
							 ."	INNER JOIN Localidad l on (p.ID_Provincia=l.ID_Provincia) "
							 ."	WHERE l.ID_Localidad=".$id.";";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$temp->setId($result['id']);
			$temp->setProvincia(utf8_encode($result['provincia']));
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
	public function getProvincia() {
		return $this->provincia;
	}
	public function setProvincia($prov) {
		if ($prov) {
			$this->provincia = $prov;
		}
		else {
			//LOGERROR
		}
	}
}

?>
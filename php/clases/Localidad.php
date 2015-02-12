<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Provincia')) {
	require_once $_SERVER["DOCUMENT_ROOT"].'/php/clases/Provincia.php';
}


class Localidad {
	private $id;
	private $localidad;
	private $provincia;

	public function __construct() { 
		$this->id = null;
		$this->localidad = null;
		$this->provincia = new Provincia();
	}
	
	public function getLocalidadById($id) {
		$temp = new Localidad();
		if ($id) {
			$conex = new MySQL();
			$consulta = " Select ID_Localidad as id, Localidad as localidad, ID_Provincia as provID From localidad WHERE ID_Localidad= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$temp->setId($result['id']);
			$temp->setLocalidad(utf8_encode($result['localidad']));
			$tempp = new Provincia();
			$temp->setProvincia($tempp->getProvinciaById($result['provID']));
		}
		return $temp;
	}
	public function getLocalidadesByProvinciaID($id) {
		$return = Array();
		if ($id) {
			$this->provincia = new Provincia();
			$this->provincia = $this->provincia->getProvinciaById($id);
			$conex = new MySQL();
			$consulta = " Select ID_Localidad as id, Localidad as localidad from Localidad "
							 ."	WHERE ID_Provincia=".$id.";";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			
			while($result) {
				$temp = new Localidad();
				$temp->setId($result['id']);
				$temp->setLocalidad($result['localidad']);
				$temp->setProvincia($this->getProvincia());
				$return[] = $temp;
				$result = mysql_fetch_assoc($result1);
			}
		}
		return $return;
	}
	public function getAndSetLocById($id) {
		if ($id) {
			$this->id = $id;
			$conex = new MySQL();
			$consulta = " Select ID_Localidad as id, Localidad as localidad, ID_Provincia as provID From localidad WHERE ID_Localidad= '".$this->id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$this->localidad = utf8_encode($result['localidad']);
			$this->provincia = new Provincia();
			$this->provincia = $this->provincia->getProvinciaById($result['provID']);
		}
	}
	public function getId() {
		return $this->id;
	}
	public function getLocalidad() {
		return $this->localidad;
	}
	public function getProvincia() {
		return $this->provincia;
	}
	public function setId($id) {
		if ($id) {
			$this->id = $id;
		}
		else {
			//LOGERROR
		}
	}
	public function setLocalidad($loc) {
		if ($loc) {
			$this->localidad = $loc;
		}
		else {
			//LOGERROR
		}
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
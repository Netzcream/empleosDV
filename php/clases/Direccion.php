<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Provincia')) {
	require_once $_SERVER["DOCUMENT_ROOT"].'/php/clases/Provincia.php';
}
if (!class_exists('Localidad')) {
	require_once $_SERVER["DOCUMENT_ROOT"].'/php/clases/Localidad.php';
}
class Direccion {
	private $id;
	private $provincia;
	private $localidad;
	private $calle;
	private $numero;
	private $coord1;
	private $coord2;
	private $piso;
	private $dpto;

	public function __construct() { 
		$this->id = null;
		$this->localidad = new Localidad();
		$this->provincia = new Provincia();
		$this->calle = null;
		$this->numero = null;
		$this->coord1 = null;
		$this->coord2 = null;
		$this->piso = null;
		$this->dpto = null;
	}
	
	public function getAndSetDireccionById($id) {
			if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT ID_Provincia as provID, ID_Localidad as locaID, Calle as calle, Numero as numero, Coordenada1 as coord1, Coordenada2 as coord2, Piso as piso, Departamento as dpto FROM Direccion "
					. " WHERE ID_Direccion = '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$this->setId($id);
			$this->setLocByLocId($result['locaID']);
			$this->setPciaByPciaID($this->getLoc()->getProvincia()->getId());
			$this->setCalle(utf8_encode($result['calle']));
			$this->setNum(utf8_encode($result['numero']));
			$this->setPiso(utf8_encode($result['piso']));
			$this->setDpto(utf8_encode($result['dpto']));
			if ($result['coord1'] AND $result['coord2']) {
				$this->setCoor1(utf8_encode($result['coord1']));
				$this->setCoor2(utf8_encode($result['coord2']));
			}
		}
	}
	public function getDireccionById($id) {
		$temp = new Direccion();
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT ID_Provincia as provID, ID_Localidad as locaID, Calle as calle, Numero as numero, Coordenada1 as coord1, Coordenada2 as coord2, Piso as piso, Departamento as dpto FROM Direccion "
					. " WHERE ID_Direccion = '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$temp->setId($id);
			$temp->setLocByLocId($result['locaID']);
			$temp->setPciaByPciaID($temp->getLoc()->getProvincia()->getId());
			$temp->setCalle(utf8_encode($result['calle']));
			$temp->setNum(utf8_encode($result['numero']));
			$temp->setPiso(utf8_encode($result['piso']));
			$temp->setDpto(utf8_encode($result['dpto']));
			if ($result['coord1'] AND $result['coord2']) {
				$temp->setCoor1(utf8_encode($result['coord1']));
				$temp->setCoor2(utf8_encode($result['coord2']));
			}
		}
		return $temp;
	}
	public function getDireccionByUsrID($id) {
		$temp = new Direccion();
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT d.ID_Direccion as id, d.ID_Provincia as provID, d.ID_Localidad as locaID, d.Calle as calle, d.Numero as numero, d.Coordenada1 as coord1, d.Coordenada2 as coord2, d.Piso as piso, d.Departamento as dpto FROM Direccion d
							INNER JOIN direccionUsuario du on (du.ID_Direccion=d.ID_Direccion)
							WHERE du.CodUsuario = '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$temp->setId($result['id']);
			$temp->setLocByLocId($result['locaID']);
			$temp->setPciaByPciaID($temp->getLoc()->getProvincia()->getId());
			$temp->setCalle(utf8_encode($result['calle']));
			$temp->setNum(utf8_encode($result['numero']));
			$temp->setPiso(utf8_encode($result['piso']));
			$temp->setDpto(utf8_encode($result['dpto']));
			if ($result['coord1'] AND $result['coord2']) {
				$temp->setCoor1(utf8_encode($result['coord1']));
				$temp->setCoor2(utf8_encode($result['coord2']));
			}
		}
		return $temp;
	}
	public function getAndSetDireccionByUsrID($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = " SELECT d.ID_Direccion as id, d.ID_Provincia as provID, d.ID_Localidad as locaID, d.Calle as calle, d.Numero as numero, d.Coordenada1 as coord1, d.Coordenada2 as coord2, d.Piso as piso, d.Departamento as dpto FROM Direccion d
							INNER JOIN direccionUsuario du on (du.ID_Direccion=d.ID_Direccion)
							WHERE du.CodUsuario = '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$this->setId($result['id']);
			$this->setLocByLocId($result['locaID']);
			$this->setPciaByPciaID($this->getLoc()->getProvincia()->getId());
			$this->setCalle(utf8_encode($result['calle']));
			$this->setNum(utf8_encode($result['numero']));
			$this->setPiso(utf8_encode($result['piso']));
			$this->setDpto(utf8_encode($result['dpto']));
			if ($result['coord1'] AND $result['coord2']) {
				$this->setCoor1(utf8_encode($result['coord1']));
				$this->setCoor2(utf8_encode($result['coord2']));
			}
		}
	}
	public function generateCoord() {
		$prepAddr = $this->calle." ". $this->numero.", ".$this->localidad->getLocalidad().", ".$this->provincia->getProvincia().", Argentina";
		$prepAddr = preg_replace("/�|�|�|�|�/","a",$prepAddr);
		$prepAddr = preg_replace("/�|�|�|�/","A",$prepAddr);
		$prepAddr = preg_replace("/�|�|�/","e",$prepAddr);
		$prepAddr = preg_replace("/�|�|�/","E",$prepAddr);
		$prepAddr = preg_replace("/�|�|�/","i",$prepAddr);
		$prepAddr = preg_replace("/�|�|�/","I",$prepAddr);
		$prepAddr = preg_replace("/�|�|�|�|�/","o",$prepAddr);
		$prepAddr = preg_replace("/�|�|�|�/","O",$prepAddr);
		$prepAddr = preg_replace("/�|�|�/","u",$prepAddr);
		$prepAddr = preg_replace("/�|�|�/","U",$prepAddr);
		$prepAddr = str_replace(" ","_",$prepAddr);
		$prepAddr = str_replace("�","n",$prepAddr);
		$prepAddr = str_replace("�","N",$prepAddr);
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
		$output= json_decode($geocode);
		$latitude = $output->results[0]->geometry->location->lat;
		$longitude = $output->results[0]->geometry->location->lng;
		$this->setCoor1($latitude);
		$this->setCoor2($longitude);

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
	public function getCalle() {
		return $this->calle;
	}
	public function setCalle($calle) {
		if ($calle) {
			$this->calle = $calle;	
		}
		else {
			//LOGERROR
		}
	}
	public function getNum() {
		return $this->numero;
	}
	public function setNum($num) {
		if ($num) {
			$this->numero = $num;
		}
		else {
			//LOGERROR
		}
	}
	public function getPiso() {
		return $this->piso;
	}
	public function setPiso($piso) {
		if ($piso) {
			$this->piso = $piso;
		}
		else {
			//LOGERROR
		}
	}
	public function getDpto() {
		return $this->dpto;
	}
	public function setDpto($dpto) {
		if ($dpto) {
			$this->dpto = $dpto;
		}
		else {
			//LOGERROR
		}
	}
	public function getLoc() {
		return $this->localidad;
	}
	public function setLocByLocId($id) {
		if ($id) {
			$this->localidad = new Localidad();
			$this->localidad->getAndSetLocById($id);
		}
		else {
			//LOGERROR
		}
	}
	public function getPcia() {
		return $this->provincia;
	}
	public function setPciaByPciaID($id) {
		if ($id) {
			$this->provincia = new Provincia();
			$this->provincia->getAndSetProvinciaById($id);
		}
		else {
			//LOGERROR
		}
	}
	public function setPcia($pcia) {
		if ($pcia) {
			$this->provincia = $pcia;
		}
		else {
			//LOGERROR
		}
	}
	public function getCoor1() {
		return $this->coord1;
	}
	public function setCoor1($c) {
		if ($c) {
			$this->coord1 = $c;
		}
		else {
			//LOGERROR
		}
	}
	
	public function getCoor2() {
		return $this->coord2;
	}
	public function setCoor2($c) {
		if ($c) {
			$this->coord2 = $c;
		}
		else {
			//LOGERROR
		}
	}
	
}

?>
<?php

include_once("../conex.php");

class Pais {
	private $id;
	private $pais;

	public function __construct($id) {
		$this->id = $id;
		$this->conex = new MySQL();
		$this->consulta = "SELECT p.ID_Pais as id, p.Pais as pais FROM paises p
		WHERE p.ID_Pais= '".$this->id."';";
		$this->result = $this->conex->consulta($this->consulta);
		$result = mysql_fetch_assoc($this->result);
		$this->pais = utf8_encode($result['pais']);
	}

	public function getId() {
		return $this->id;
	}
	public function getPais() {
		return $this->pais;
	}

}

?>
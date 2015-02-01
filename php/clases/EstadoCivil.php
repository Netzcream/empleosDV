<?php

//include_once("conex.php");
class EstadoCivil {
	private $id;
	private $estadoCivil;

	public function __construct($id) {
		$this->id = $id;
		$this->conex = new MySQL();
		$this->consulta = "SELECT ec.ID_EstadoCivil as id, ec.EstadoCivil as estado FROM estadocivil ec
		WHERE ec.ID_EstadoCivil= '".$this->id."';";
		$this->result = $this->conex->consulta($this->consulta);
		$result = mysql_fetch_assoc($this->result);
		$this->estadoCivil = utf8_encode($result['estado']);
	}

	public function getId() {
		return $this->id;
	}
	public function getEstadoCivil() {
		return $this->estadoCivil;
	}

}

?>
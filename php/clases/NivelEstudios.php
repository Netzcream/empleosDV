
<?php

//include_once("conex.php");

class NivelEstudios {
	private $id;
	private $nivel;

	public function __construct($id) {
		$this->id = $id;
		$this->conex = new MySQL();
		$this->consulta = " SELECT NivelEstudio as nivel FROM nivelestudios "
					     ." WHERE ID_NivelEstudio= '".$this->id."';";
		$this->result = $this->conex->consulta($this->consulta);
		$result = mysql_fetch_assoc($this->result);
		$this->nivel = utf8_encode($result['nivel']);
	}

	public function getId() {
		return $this->id;
	}
	public function getNivel() {
		return $this->nivel;
	}

}

?>
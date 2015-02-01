<?php

//include_once("conex.php");

class Documento {
	private $id;
	private $tipoDocumento;
	private $documento;
	private $letras;

	public function __construct($id,$documento) {
		$this->id = $id;
		$this->documento = $documento;
		$this->conex = new MySQL();
		$this->consulta = " SELECT Descripcion as tipo, AdmiteLetras as letras FROM tipodocumento "
					     ." WHERE ID_TipoDocumento= '".$this->id."';";
		$this->result = $this->conex->consulta($this->consulta);
		$result = mysql_fetch_assoc($this->result);
		$this->tipoDocumento = utf8_encode($result['tipo']);
		$this->letras = utf8_encode($result['letras']);
	}

	public function getId() {
		return $this->id;
	}
	public function getTipoDocumento() {
		return $this->tipoDocumento;
	}
	public function getDocumento() {
		return $this->documento;
	}
	public function getLetras() {
		return $this->letras;
	}

}

?>
<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}

class Documento {
	private $id;
	private $tipoDocumento;
	private $documento;
	private $letras;

	public function __construct() { 
		$this->id = null;
		$this->tipoDocumento = null;
		$this->documento = null;
		$this->letras = null;
		
	}
	public function getDocumentoByData($id,$documento) {
		$temp = new Documento();
		if ($id and $documento) {
			$conex = new MySQL();
			$consulta = " SELECT Descripcion as tipo, AdmiteLetras as letras FROM tipodocumento "
					." WHERE ID_TipoDocumento= '".$id."';";
			$result1 = $conex->consulta(consulta);
			$result = $conex->fetch_assoc();
			$temp->setId($id);
			$temp->setDocumento($documento);
			$temp->setTipoDocumento($result['tipo']);
			$temp->setLetras($result['letras']);
		}
		
		return $temp;
	}
	public function getAndSetDocumentoByData($id,$documento) {
		if ($id and $documento) {
			$conex = new MySQL();
			$consulta = " SELECT Descripcion as tipo, AdmiteLetras as letras FROM tipodocumento "
					." WHERE ID_TipoDocumento= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			$this->setId($id);
			$this->setDocumento($documento);
			$this->setTipoDocumento($result['tipo']);
			$this->setLetras($result['letras']);
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
	public function getTipoDocumento() {
		return $this->tipoDocumento;
	}
	public function setTipoDocumento($tipo) {
		if ($tipo) {
			$this->tipoDocumento = $tipo;
		}
		else {
			//LOGERROR
		}
	}
	public function getDocumento() {
		return $this->documento;
	}
	public function setDocumento($doc) {
		if ($doc) {
			$this->documento = $doc;
		}
		else {
			//LOGERROR
		}
	}
	public function getLetras() {
		return $this->letras;
	}
	public function setLetras($letras) {
		if ($letras) {
			$this->letras = $letras;
		}
		else {
			//LOGERROR
		}
	}

}

?>
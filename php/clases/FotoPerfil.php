<?php

if (!class_exists('MySQL')) {
	require_once 'conex.php';
}

class FotoPerfil {
	private $id;
	private $foto;
	private $conex;
	private $consulta;

	public function __construct($id) {
		$this->id = $id;
		$conex = new MySQL();
		$consulta = "SELECT f.Foto as foto FROM foto f
		WHERE f.CodUsuario= '".$this->id."';";
		$this->result = $conex->consulta($consulta);
		$result = mysql_fetch_assoc($this->result);
		$this->foto = utf8_encode($result['foto']);
		
		if ($this->foto == null) {
			$this->foto = "imagenes/no_perfil.png";
		}
	}

	public function getId() {
		return $this->id;
	}
	public function getFoto() {
		return $this->foto;
	}
	public function setFoto($foto) {
		$this->foto = $foto;
	}
	public function saveFoto() {
		$conex = new MySQL();
		$consulta = "UPDATE foto set Foto = '".$this->foto."' WHERE CodUsuario=".$this->id.";";
		$conex->consulta($consulta);		
	}
}

?>
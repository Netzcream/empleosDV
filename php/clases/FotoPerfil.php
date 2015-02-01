<?php

include_once("../conex.php");

class FotoPerfil {
	private $id;
	private $foto;

	public function __construct($id) {
		$this->id = $id;
		$this->conex = new MySQL();
		$this->consulta = "SELECT f.Foto as foto FROM foto f
		WHERE f.CodUsuario= '".$this->id."';";
		$this->result = $this->conex->consulta($this->consulta);
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

}

?>
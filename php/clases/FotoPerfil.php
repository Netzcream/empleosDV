<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}

class FotoPerfil {
	private $id;
	private $foto;

	public function __construct() {
		$this->id=null;
		$this->foto = "imagenes/no_perfil.png";
		
	}
	public function getFotoByUsuarioID($id) {
		$temp = new FotoPerfil();
		if ($id) {
			$conex = new MySQL();
			$consulta = "SELECT f.Foto as foto FROM foto f
			WHERE f.CodUsuario= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$temp->setId($id);
			$temp->setFoto(utf8_encode($result['foto']));
			if ($temp->getFoto() == null) {
				$temp->setFoto("imagenes/no_perfil.png");
				$temp->saveFoto();
			}
		}
	}
	public function getAndSetFotoByUsuarioID($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = "SELECT f.Foto as foto FROM foto f
			WHERE f.CodUsuario= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$this->setId($id);
			$this->setFoto(utf8_encode($result['foto']));
			if ($this->getFoto() == null) {
				$this->setFoto("imagenes/no_perfil.png");
				$this->saveFoto();
			}
		}
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		if ($id) {
			$this->id=$id;
		}
		else {
			//LOGERROR
		}
	}
	public function getFoto() {
		return $this->foto;
	}
	public function setFoto($foto) {
		if ($foto) {
			$this->foto = $foto;
		}
		else {
			
			//LOGERROR
			
		}
	}
	public function saveFoto() {
		$conex = new MySQL();
		$consulta = "UPDATE foto set Foto = '".$this->foto."' WHERE CodUsuario=".$this->id.";";
		$conex->consulta($consulta);		
	}
}

?>
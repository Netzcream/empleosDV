
<?php

//include_once("conex.php");

class EstadoUsuario {
	private $id;
	private $estado;

	public function __construct($id) {
		$this->id = $id;
		$this->conex = new MySQL();
		$this->consulta = " SELECT ID_EstadoUsuario as id, Descripcion as estado FROM EstadoUsuario "
					     ." WHERE ID_EstadoUsuario= '".$this->id."';";
		$this->result = $this->conex->consulta($this->consulta);
		$result = mysql_fetch_assoc($this->result);
		$this->estado = utf8_encode($result['estado']);
	}

	public function getId() {
		return $this->id;
	}
	public function getEstado() {
		return $this->estado;
	}

}

?>
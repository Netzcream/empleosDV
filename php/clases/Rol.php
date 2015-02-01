<?php 
//include_once("conex.php");

class Rol {
	private $id;
	private $rol;
	private $tarea = array();

	public function __construct($id) {
		$this->id = $id;
		$this->conex = new MySQL();
		$this->consulta = "SELECT r.CodRol as id, r.Descripcion as rol, t.CodTarea as idTarea, t.Descripcion as tarea FROM Rol r
		INNER JOIN tarearol tr ON (tr.CodRol=r.CodRol)
		INNER JOIN tarea t on (t.CodTarea=tr.CodTarea)
		WHERE r.CodRol= '".$this->id."';";
		$this->result = $this->conex->consulta($this->consulta);
		$result = mysql_fetch_assoc($this->result);
		$this->rol = utf8_encode($result['rol']);
		while ($result) {
			$index = $result['idTarea'];
			$this->tarea[$index] = array(
					"tarea" => utf8_encode($result['tarea'])
			);
			$result = mysql_fetch_assoc($this->result);
		}
	}
	
	public function getId() {
		return $this->id;
	}
	public function getRol() {
		return $this->rol;
	}
	public function getTarea() {
		return $this->tarea;
	}
	public function getTareaById($index) {
		return $this->tarea[$index]['tarea'];
	}

}


?>
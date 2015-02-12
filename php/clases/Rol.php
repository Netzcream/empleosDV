<?php 
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}

class Rol {
	private $id;
	private $rol;
	private $tarea = array();

	public function __construct() { 
		$this->id = null;
		$this->rol = null;
		$this->tarea = array();
		
	}
	
	public function setRolById($id) {
		if ($id) {
			$this->id = $id;
			$conex = new MySQL();
			$consulta = "SELECT r.CodRol as id, r.Descripcion as rol, t.CodTarea as idTarea, t.Descripcion as tarea FROM Rol r
			INNER JOIN tarearol tr ON (tr.CodRol=r.CodRol)
			INNER JOIN tarea t on (t.CodTarea=tr.CodTarea)
			WHERE r.CodRol= '".$this->id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$this->rol = utf8_encode($result['rol']);
			while ($result) {
				$index = $result['idTarea'];
				$this->tarea[$index] = array(
						"tarea" => utf8_encode($result['tarea'])
				);
				$result = mysql_fetch_assoc($result1);
			}
		}
	}
	public function getRolById($id) {
		$temp = new Rol();
		if ($id) {
			$conex = new MySQL();
			$consulta = "SELECT r.CodRol as id, r.Descripcion as rol, t.CodTarea as idTarea, t.Descripcion as tarea FROM Rol r
			INNER JOIN tarearol tr ON (tr.CodRol=r.CodRol)
			INNER JOIN tarea t on (t.CodTarea=tr.CodTarea)
			WHERE r.CodRol= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$temp->id = $id;
			$temp->rol = utf8_encode($result['rol']);
			while ($result) {
				$index = $result['idTarea'];
				$temp->tarea[$index] = array(
						"tarea" => utf8_encode($result['tarea'])
				);
				$result = mysql_fetch_assoc($result1);
			}
		}
		return $temp;
	}
	
	public function getRolByPersonaId($id) {
		$temp = new Rol();
		if ($id) {		
			$conex = new MySQL();
			$consulta = "SELECT r.CodRol as id, r.Descripcion as rol, t.CodTarea as idTarea, t.Descripcion as tarea FROM Rol r
			INNER JOIN tarearol tr ON (tr.CodRol=r.CodRol)
			INNER JOIN tarea t on (t.CodTarea=tr.CodTarea)
			INNER JOIN usuarioRol ur on (ur.CodRol=r.CodRol)
			WHERE ur.CodUsuario= '".$id."';";
			$result1 = $conex->consulta($consulta);
			$result = mysql_fetch_assoc($result1);
			$temp->id = $result['id'];
			$temp->rol = utf8_encode($result['rol']);
			while ($result) {
				$index = $result['idTarea'];
				$temp->tarea[$index] = array(
						"tarea" => utf8_encode($result['tarea'])
				);
				$result = mysql_fetch_assoc($result1);
			}
		}
		return $temp;
	}
	
	public function getAndSetRolByPersonaId($id) {
		if ($id) {
			$conex = new MySQL();
			$consulta = "SELECT r.CodRol as id, r.Descripcion as rol, t.CodTarea as idTarea, t.Descripcion as tarea FROM Rol r
			INNER JOIN tarearol tr ON (tr.CodRol=r.CodRol)
			INNER JOIN tarea t on (t.CodTarea=tr.CodTarea)
			INNER JOIN usuarioRol ur on (ur.CodRol=r.CodRol)
			WHERE ur.CodUsuario= '".$id."';";
			$result1 = $conex->consulta($consulta);
			
			$result = mysql_fetch_assoc($result1);
			$this->id = $result['id'];
			$this->rol = utf8_encode($result['rol']);
			while ($result) {
				$index = $result['idTarea'];
				$this->tarea[$index] = array(
						"tarea" => utf8_encode($result['tarea'])
				);
				$result = mysql_fetch_assoc($result1);
			}
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
	public function getRol() {
		return $this->rol;
	}
	public function setRol($rol) {
		if ($rol) {
			$this->rol = $rol;
		}
		else {
			//LOGERROR
		}
	}
	public function getTarea() {
		return $this->tarea;
	}
	public function setTarea($tarea) {
		if ($tarea) {
			$this->tarea = $tarea;
		}
		else {
			//LOGERROR
		}
	} 
	public function getTareaById($index) {
		if ($index) {
			return $this->tarea[$index]['tarea'];
		}
		else {
			//LOGERROR
		}
	}

}


?>
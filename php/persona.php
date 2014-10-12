<?php
include_once("php/conex.php");

class Persona {
	
	public $id;
	public $apellido;
	public $nombre;
	public $nacimiento;
	public $email;
	public $foto;
	
	
	public function __construct($id) {
		$this->id = $id;
		$this->conex = new MySQL();
		$this->consulta = "SELECT * FROM PERSONA WHERE id=".$this->id.";";
		$result = mysql_fetch_assoc($this->conex->consulta($this->consulta));
		$this->apellido = $result['apellido'];
		$this->nombre = $result['nombre'];
		$this->nacimiento = $result['nacimiento'];
		$this->email = $result['email'];
		$this->foto = $result['foto'];
	}
	
	public function getId() {
		return $this->id;
	}
	public function getApellido() {
		return $this->apellido;
	}
	public function getNombre() {
		return $this->nombre;
	}
	public function getNacimiento() {
		return $this->nacimiento;
	}
	public function getEdad() {
		//fecha actual
		$dia=date('j');
		$mes=date('n');
		$ano=date('Y');
		//fecha de nacimiento
		list($Y,$m,$d) = explode("-",$this->getNacimiento());
		$dianaz= $d;
		$mesnaz= $m;
		$anonaz= $Y;
		//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
		if (($mesnaz == $mes) && ($dianaz > $dia)) {
			$ano=($ano-1); 
		}
			//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
			if ($mesnaz > $mes) {
				$ano=($ano-1);
			}
				//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
				$edad=($ano-$anonaz);
				return $edad;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getFoto() {
		if ($this->foto != null) {
		return $this->foto;
		}
		else {
			return "imagenes/no_perfil.png";
		}
	}
	
	public function setId($a) {
		$this->id = $a;
	}
	public function setApellido($a) {
		$this->apellido = $a;
	}
	public function setNombre($a) {
		$this->nombre = $a;
	}
	public function setNacimiento($a) {
		$this->nacimiento = $a;
	}
	public function setEmail($a) {
		$this->email = $a;
	}
	public function setFoto($a) {
		$this->foto = $a;
	}
	
}


?>
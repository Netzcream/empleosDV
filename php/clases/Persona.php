<?php

include_once("../conex.php");
include_once("/Rol.php");
include_once("/EstadoCivil.php");
include_once("/EstadoUsuario.php");
include_once("/Documento.php");
include_once("/NivelEstudios.php");
include_once("/Pais.php");
include_once("/Fecha.php");
include_once("/FotoPerfil.php");

$persona = new Persona(2);
echo "id: " .$persona->getRol()->getId();
echo "<br>Rol: " .$persona->getRol()->getRol();
echo "<br>EstadoCivil: " .$persona->getEstadoCivil()->getEstadoCivil();
echo "<br>Pais: " .$persona->getPais()->getId();
echo "<br>Estado: " .$persona->getEstado()->getEstado(); 
echo "<br>Documento: " .$persona->getDocumento()->getTipoDocumento() . " ".$persona->getDocumento()->getDocumento();
echo "<br>Nacimiento: " .$persona->getFechaNac();
echo "<br>Foto: " .$persona->getFoto();

class Persona {
	
	private $id;
	private $rol;
	private $apellido;
	private $estadoCivil;
	private $estado;
	private $nombre;
	private $nacimiento;
	private $email;
	private $foto;
	private $sexo;
	private $pais;
	private $documento;
	private $nivelEstudio;
	private $baja;

	public function __construct($id) {
		$this->id = $id; 
		$this->conex = new MySQL();
		
		
		$this->consulta = "SELECT CodRol as rol FROM usuarioRol WHERE CodUsuario = ".$this->id.";";
		$result = mysql_fetch_assoc($this->conex->consulta($this->consulta));
		$this->rol = new Rol($result['rol']);
		
		$this->consulta  = " SELECT "
						  ." u.CodUsuario as id, " 
						  ." u.Email as email, "
						  ." u.Estado as estado, "
						  ." res.Nombre as nombre, "
						  ." res.Apellido as apellido, "
						  ." res.FechaNacimiento as nacimiento, "
						  ." res.ID_Paises as paisID, "
						  ." res.Sexo as sexo, "
						  ." res.ID_EstadoCivil as estadoCivilID, "		
						  ." res.ID_TipoDocumento as tipoDocumentoID, "
						  ." res.Documento as documento, "
						  ." res.ID_NivelEstudios as nivelEstudioID, "
						  ." res.FechaBaja as fechaBaja, "
						  ." res.FechaCambioPassword as fechaCambioPassword ";
		$this->consulta .= " FROM usuario u ";
		
		if ($this->rol->getId() == "AL") {
			$this->consulta .= " INNER JOIN alumno res ON (u.CodUsuario=res.CodUsuario)";
		}
		else if ($this->rol->getId() == "PR") {
			$this->consulta .= " INNER JOIN profesor res ON (u.CodUsuario=res.CodUsuario)";
		}
		else if ($this->rol->getId() == "EM") {
			$this->consulta .= " INNER JOIN empresa res ON (u.CodUsuario=res.CodUsuario)";
		}
		$this->consulta .= " WHERE u.CodUsuario=".$this->id;
		
		
		$result = mysql_fetch_assoc($this->conex->consulta($this->consulta));
		
		$this->apellido = utf8_encode($result['apellido']);
		$this->nombre = utf8_encode($result['nombre']);
		$this->email = $result['email'];
		$this->sexo = $result['sexo'];
		$this->nacimiento = new Fecha($result['nacimiento']);
		$this->baja = new Fecha($result['fechaBaja']);
		$this->estadoCivil = new EstadoCivil($result['estadoCivilID']);
		$this->pais = new Pais($result['paisID']);
		$this->estado = new EstadoUsuario($result['estado']);
		$this->documento = new Documento(utf8_encode($result['tipoDocumentoID']), utf8_encode($result['documento']));
		$this->nivelEstudio = new NivelEstudios($result['nivelEstudioID']);
		$this->foto = new FotoPerfil($this->id);
		
		
	}

	public function getDocumento() {
		return $this->documento;
	}
	public function getEstado() {
		return $this->estado;
	}
	public function getPais() {
		return $this->pais;
	}
	public function getEstadoCivil() {
		return $this->estadoCivil;
	}
	public function getRol() {
		return $this->rol;
	}
	public function getId() {
		return $this->id;
	}
	public function getApellido() {
		return $this->apellido;
	}
	public function setApellido($a) {
		$this->apellido = $a;
	}
	public function getNombre() {
		return $this->nombre;
	}
	public function setNombre($a) {
		$this->nombre = $a;
	}
	public function getEdad() {
		return $this->nacimiento->getEdad();	
	}
	public function getFechaNac() {
		return $this->nacimiento->getFecha();
	}
	public function getFechaNacLong() {
		return $this->nacimiento->getFechaLong();
	}
	public function getFechaNacClass() {
		return $this->nacimiento;
	}
	public function setNacimiento(Datetime $a) {
		$this->nacimiento = new DateTime($a);
	}
	public function getSexo() {
		return $this->sexo;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getFoto() {
		return $this->foto->getFoto();
	}
	public function getSexoImg() {
		if ($this->getSexo() == "f") {
			return "imagenes/f.png";
		}
		else if ($this->getSexo() == "m") {
			return "imagenes/m.png";
		}		
	}


	public function savePersona() {
		$temp = "UPDATE PERSONA SET ";
		$temp .= " apellido = ".$this->apellido;
		$temp .= " nombre = ". $this->nombre;
		$temp .= " nacimiento = ".$this->nacimiento;
		$temp .= " email = ".$this->email;
		$temp .= " foto = ".$this->foto;
		$temp .= " sexo = ".$this->sexo;
		$temp .= " WHERE id=". $this->id;
	}
	
}


?>
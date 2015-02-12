<?php
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php';
}

include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Rol.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/EstadoCivil.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/EstadoUsuario.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Documento.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/NivelEstudios.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Pais.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Fecha.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/FotoPerfil.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Direccion.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Tag.php");

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
	private $domicilio;
	private $fechaIngreso;
	private $fechaCambioPass; 
	private $tags; 

	public function __construct() { 
		$this->id=null;
		$this->rol= new Rol();
		$this->apellido = null;
		$this->estadoCivil = new EstadoCivil();
		$this->estado = new EstadoUsuario();
		$this->nombre = null;
		$this->nacimiento = new Fecha();
		$this->email = null;
		$this->foto = new FotoPerfil();
		$this->sexo = null;
		$this->pais = new Pais();
		$this->documento = new Documento();
		$this->nivelEstudio = new NivelEstudios();
		$this->baja = new Fecha();
		$this->domicilio = new Direccion();
		$this->fechaCambioPass = new Fecha();
		$this->fechaIngreso = new Fecha();
		$this->tags = new Tag();
		
	}
	
	
	public function getPersonaById($id) {
		$temp = new Persona();
		if ($id) {
			$conex = new MySQL();
			$temp->id = $id;
				
			//Guardo Rol
			$temp->rol->getAndSetRolByPersonaId($id);
				
			$consulta  = " SELECT "
					." u.CodUsuario as id, "
					." u.Email as email, ";
				
			if ($temp->rol->getId() == "AL") {
				$consulta   .= " res.ID_NivelEstudios as nivelEstudioID, ";
			}
			if ($temp->rol->getId() == "AL" || $temp->rol->getId() == "PR") {
				$consulta   .= " res.Nombre as nombre, "
						." res.Apellido as apellido, "
						." res.FechaNacimiento as nacimiento, "
						." res.ID_Paises as paisID, "
						." res.Sexo as sexo, "
						." res.ID_EstadoCivil as estadoCivilID, "
						." res.ID_TipoDocumento as tipoDocumentoID, "
						." res.Documento as documento, ";
			}
			if ($temp->rol->getId() != "AD") {
				$consulta .= " res.FechaBaja as fechaBaja, ";
				$consulta .= " res.FechaIngreso as fi, ";
						$consulta .= " res.FechaCambioPassword as fcp, ";
			}
			if ($temp->rol->getId() == "EM") {
				$consulta .= " res.CUIT as documento, ";
				$consulta .= " res.NombreEmpresa as nombre, ";
				$consulta .= " td.ID_TipoDocumento as tipoDocumentoID, ";
					
			}
			$consulta .= " u.Estado as estado ";
			$consulta .= " FROM usuario u ";
				
			if ($temp->rol->getId() == "AL") {
				$consulta .= " INNER JOIN alumno res ON (u.CodUsuario=res.CodUsuario)";
			}
			else if ($temp->rol->getId() == "PR") {
				$consulta .= " INNER JOIN profesor res ON (u.CodUsuario=res.CodUsuario)";
			}
			else if ($temp->rol->getId() == "EM") {
				$consulta .= " INNER JOIN empresa res ON (u.CodUsuario=res.CodUsuario)";
				$consulta .= " LEFT JOIN tipodocumento td ON (td.descripcion='CUIT')";
			}
				
			$consulta .= " WHERE u.CodUsuario=".$temp->id;
				
			$result = mysql_fetch_assoc($conex->consulta($consulta));
				
			if ($temp->rol->getId() == "AL") {
				$temp->nivelEstudio = new NivelEstudios($result['nivelEstudioID']);
				$temp->tags->getAndSetTagsByUsuario($id);
			}
				
			if ($temp->rol->getId() == "AL" || $temp->rol->getId() == "PR") {
				$temp->setSexo($result['sexo']);
				$temp->setNacimiento($result['nacimiento']);
				$temp->getPais()->getAndSetPaisById($result['paisID']);
				$temp->getEstadoCivil()->getAndSetECById($result['estadoCivilID']);
				$temp->setApellido(utf8_encode($result['apellido']));
				
			}
	
			if ($temp->rol->getId() == "AD") {
				$temp->setNombre($result['email']);
			}
			else {
				$temp->setNombre(utf8_encode($result['nombre']));
				$temp->setDocumentoByData(utf8_encode($result['tipoDocumentoID']), utf8_encode($result['documento']));
				$temp->getBaja()->getSetFecha($result['fechaBaja']);
				$temp->getDomicilio()->getAndSetDireccionByUsrID($temp->id);
				$temp->getFechaIngreso()->getSetFecha($result['fi']);
				$temp->getFechaCambioPass()->getSetFecha($result['fi']);
				if ($result['fcp'] != null AND $result['fcp'] != "") {
					$temp->getFechaCambioPass()->getSetFecha($result['fcp']);
				}
			}
			$temp->setEmail($result['email']);
			$temp->getEstado()->getEstadoByUsuarioId($temp->id);
			$temp->getFoto()->getAndSetFotoByUsuarioID($temp->id);
		}
		return $temp;
	
	}
	
	public function getAndSetPersonaById($id) {
		if ($id) {
			$conex = new MySQL();
			$this->id = $id;
				
			//Guardo Rol
			$this->rol->getAndSetRolByPersonaId($id);
				
			$consulta  = " SELECT "
					." u.CodUsuario as id, "
					." u.Email as email, ";
				
			if ($this->rol->getId() == "AL") {
				$consulta   .= " res.ID_NivelEstudios as nivelEstudioID, ";
			}
			if ($this->rol->getId() == "AL" || $this->rol->getId() == "PR") {
				$consulta   .= " res.Nombre as nombre, "
						." res.Apellido as apellido, "
						." res.FechaNacimiento as nacimiento, "
						." res.ID_Paises as paisID, "
						." res.Sexo as sexo, "
						." res.ID_EstadoCivil as estadoCivilID, "
						." res.ID_TipoDocumento as tipoDocumentoID, "
						." res.Documento as documento, ";
			}
			if ($this->rol->getId() != "AD") {
				$consulta .= " res.FechaBaja as fechaBaja, ";
				$consulta .= " res.FechaIngreso as fi, ";
				$consulta .= " res.FechaCambioPassword as fcp, ";
			}
			if ($this->rol->getId() == "EM") {
				$consulta .= " res.CUIT as documento, ";
				$consulta .= " res.NombreEmpresa as nombre, ";
				$consulta .= " td.ID_TipoDocumento as tipoDocumentoID, ";
					
			}
			$consulta .= " u.Estado as estado ";
			$consulta .= " FROM usuario u ";
				
			if ($this->rol->getId() == "AL") {
				$consulta .= " INNER JOIN alumno res ON (u.CodUsuario=res.CodUsuario)";
			}
			else if ($this->rol->getId() == "PR") {
				$consulta .= " INNER JOIN profesor res ON (u.CodUsuario=res.CodUsuario)";
			}
			else if ($this->rol->getId() == "EM") {
				$consulta .= " INNER JOIN empresa res ON (u.CodUsuario=res.CodUsuario)";
				$consulta .= " LEFT JOIN tipodocumento td ON (td.descripcion='CUIT')";
			}
				
			$consulta .= " WHERE u.CodUsuario=".$this->id;
				
			$result = mysql_fetch_assoc($conex->consulta($consulta));
				
			if ($this->rol->getId() == "AL") {
				$this->nivelEstudio = new NivelEstudios($result['nivelEstudioID']);
				$this->tags->getAndSetTagsByUsuario($id);
			}
			
				
			if ($this->rol->getId() == "AL" || $this->rol->getId() == "PR") {
				$this->setSexo($result['sexo']);
				$this->setNacimiento($result['nacimiento']);
				$this->getPais()->getAndSetPaisById($result['paisID']);
				$this->getEstadoCivil()->getAndSetECById($result['estadoCivilID']);
				$this->setApellido(utf8_encode($result['apellido']));
			}
	
			if ($this->rol->getId() == "AD") {
				$this->setNombre($result['email']);
			}
			else {
				$this->setNombre(utf8_encode($result['nombre']));
				$this->setDocumentoByData(utf8_encode($result['tipoDocumentoID']), utf8_encode($result['documento']));
				$this->getBaja()->getSetFecha($result['fechaBaja']);
				$this->getDomicilio()->getAndSetDireccionByUsrID($this->id);
				$this->getFechaIngreso()->getSetFecha($result['fi']);
				$this->getFechaCambioPass()->getSetFecha($result['fi']);
				if ($result['fcp'] != null AND $result['fcp'] != "") {
					$this->getFechaCambioPass()->getSetFecha($result['fcp']);
				}
			}
			$this->setEmail($result['email']);
			$this->getEstado()->getEstadoByUsuarioId($this->id);
			$this->getFoto()->getAndSetFotoByUsuarioID($this->id);

		}
	
		
	}
		
	public function getDocumento() {
		return $this->documento;
	}
	public function setDocumentoByData($id,$documento) {
		if ($id and $documento) {
			$this->documento = new Documento();
			$this->documento->getAndSetDocumentoByData($id, $documento);
		}
		else {
			//LOGERROR
		}
	}
	public function setDocumento($doc) {
		if ($doc) {
			$this->documento = $doc;
		}
		else {
			//LOGERROR
		}
	}
	public function getEstado() {
		return $this->estado;
	}
	public function setEstado($estado) {
		if ($estado) {
			
			$this->estado = $estado;
		}
		else {
			//LOGERROR
		}
	}
	public function getPais() {
		return $this->pais;
	}
	public function setPais($pais) {
		if ($pais) {
			$this->pais = $pais;
		}
		else {
			//LOGERROR
		}
	}
	public function getEstadoCivil() {
		if ($this->estadoCivil) {
			return $this->estadoCivil;
		}
		else return null;
	}
	public function setEstadoCivil($estadoCivil) {
		if ($estadoCivil) {
			$this->estadoCivil = $estadoCivil;
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
	public function getApellido() {
		return $this->apellido;
	}
	public function setApellido($a) {
		if ($a) {
			$this->apellido = $a;
		}
		else {
			//LOGERROR
		}
	}
	public function getNombre() {
		return $this->nombre;
	}
	public function setNombre($a) {
		if ($a) {
			$this->nombre = $a;
		}
		else {
			//LOGERROR
		}
	}
	public function getEdad() {
		return $this->nacimiento->getEdad();	
	}
	public function getFechaNac() {
		if ($this->nacimiento) {
			return $this->nacimiento->getFecha();
		}
		else return null;
	}
	public function getFechaNacLong() {
		return $this->nacimiento->getFechaLong();
	}
	public function getFechaNacClass() {
		return $this->nacimiento;
	}
	public function setNacimiento($a) {
		if ($a) {
			$this->nacimiento = new Fecha();
			$this->nacimiento->getSetFecha($a);
		}
		else {
			//LOGERROR
		}
	}
	public function getSexo() {
		return $this->sexo;
	}
	public function setSexo($s) {
		if ($s) {
			$this->sexo = $s;
		}
		else {
			//LOGERROR
		}
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		if ($email) {
			$this->email = $email;
		}
		else {
			//LOGERROR
		}
	}
	public function getFoto() {
		return $this->foto;
	}
	public function getPic() {
		return $this->foto->getFoto();
	}
	public function setFotoClass($foto) {
		if ($foto) {
			$this->foto = $foto;
		}
		else {
			//LOGERROR
		}
	}
	public function getSexoImg() {
		if ($this->getSexo() == "f") {
			return "imagenes/f.png";
		}
		else if ($this->getSexo() == "m") {
			return "imagenes/m.png";
		}		
	}
	public function setFoto($foto) {
		if ($foto) {
			$this->foto->setFoto($foto);
			$this->foto->saveFoto();
		}
		else {
			//LOGERROR
		}
	}
	public function getBaja() {
		return $this->baja;
	}
	public function setBaja($baja) {
		if ($baja) {
			$this->baja = $baja;
		}
		else {
			//LOGERROR
		}
	}
	public function getDomicilio() {
		return $this->domicilio;
	}
	public function setDomicilio($dom) {
		if ($dom) {
			$this->domicilio = $dom;
		}
		else {
			//LOGERROR
		}
	}
	public function getFechaIngreso() {
		return $this->fechaIngreso;
	}
	public function setFechaIngreso($a) {
		if ($a) {
			$this->fechaIngreso = $a;
		}
		else {
			//LOGERROR
		}
		
	}
	public function getFechaCambioPass() {
		return $this->fechaCambioPass;
	}
	public function setFechaCambioPass($a) {
		if ($a) {
			$this->fechaCambioPass = $a;
		}
		else {
			//LOGERROR
		}
	}
	public function getTags() {
		return $this->tags;
	}
	public function setTags($tag) {
		if ($tag) {
		$this->tags->addTag($tag);
		}
		else {
			//LOGERROR
		}
	}
}


?>
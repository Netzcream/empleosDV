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
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Estudios.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Trabajo.php");
if (!class_exists('Carrera')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Carrera.php"); }
if (!class_exists('Materia')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Materia.php"); }

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
	private $estudios; 
	private $maxEstId;
	private $idAlumno; 
	private $trabajos;
	private $notificarme;
	private $recordarme;
	private $encontrarme;
	private $carreraDavinci;
	
	public function __construct() { 
		$this->id=null;
		$this->rol= new Rol();
		$this->apellido = null;
		$this->estadoCivil = new EstadoCivil();
		$this->estado = new EstadoUsuario();
		$this->nombre = null;
		$this->nacimiento = new Fecha();
		$this->nacimiento->setFecha(Date("Y-m-d H:i:s"));
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
		$this->estudios = array();
		$this->trabajos = array();
		$this->maxEstId = null;
		$this->idAlumno = null;
		$this->notificarme = null;
		$this->recordarme = null;
		$this->encontrarme = null;
		$this->carreraDavinci = null;

	}
	public function getCarreraDv() {
		return $this->carreraDavinci;
	}
	public function getCarrera() {
		if ($this->idAlumno) {
			$conex = new MySQL();
			$consulta = "SELECT CodCarrera as id FROM AlumnoCarrera WHERE ID_Alumno='".$this->idAlumno."' ORDER BY ID_Alumnocarrera DESC";
			$result1 = $conex->consulta($consulta);
			if ($conex->num_rows() > 0) {
				$result = $conex->fetch_assoc();
				$this->carreraDavinci = $result['id'];
			}
			else {
				$this->carreraDavinci = 'AS';
			}
		}
	
	}
	
	public function getAvanceByCarrera($id) {
		if ($id && $this->idAlumno) {
			$conex = new MySQL();
			$consulta = "SELECT avance FROM AlumnoCarrera WHERE CodCarrera='".$id."' AND ID_Alumno='".$this->idAlumno."'";
			$result1 = $conex->consulta($consulta);
			if ($conex->num_rows() > 0) {
				$result = $conex->fetch_assoc();
				if ($result['avance'] > 0) {
					return $result['avance'];
				}
				else {
					return '0';
				}
			}
			else {
				return '0'; 
			}
		}
		
	}
	public function setAvanceByCarrera($id,$avance) {
		if ($id && $this->idAlumno && $avance) {
			$conex = new MySQL();
			$consulta = "SELECT avance FROM AlumnoCarrera WHERE CodCarrera='".$id."' AND ID_Alumno='".$this->idAlumno."'";
			$result1 = $conex->consulta($consulta);
			if ($conex->num_rows() > 0) {
				$consulta = "UPDATE AlumnoCarrera set avance = '".$avance."' WHERE CodCarrera='".$id."' AND ID_Alumno='".$this->idAlumno."'";
				$result1 = $conex->consulta($consulta);
			}
			else {
				$consulta = "INSERT INTO AlumnoCarrera (ID_AlumnoCarrera,ID_Alumno,CodCarrera,avance)
						values (null,'".$this->idAlumno."','".$id."','".$avance."');";
				$result1 = $conex->consulta($consulta);
			}
		}
	
	}
	
	public function getPersonaById($id) {
		$temp = new Persona();
		if ($id) {
			$conex = new MySQL();
			$temp->setId($id);
				
			//Guardo Rol
			$temp->getRol()->getAndSetRolByPersonaId($id);
				
			$consulta  = " SELECT "
					." u.CodUsuario as id, "
					." u.Email as email, "
					." u.notificarme as notificarme, "
					." u.recordarme as recordarme, ";
				
			if ($temp->getRol()->getId() == "AL") {
				$consulta   .= " res.ID_NivelEstudios as nivelEstudioID, ";
				$consulta   .= " res.ID_Alumno as alumnoID, ";
				$consulta   .= " res.encontrarme as encontrarme, ";
			}
			if ($temp->getRol()->getId() == "PR") {
				$consulta   .= " res.ID_Profesor as alumnoID, ";
			}
			if ($temp->getRol()->getId() == "AL" || $temp->getRol()->getId() == "PR") {
				$consulta   .= " res.Nombre as nombre, "
						." res.Apellido as apellido, "
						." res.FechaNacimiento as nacimiento, "
						." res.ID_Paises as paisID, "
						." res.Sexo as sexo, "
						." res.ID_EstadoCivil as estadoCivilID, "
						." res.ID_TipoDocumento as tipoDocumentoID, "
						." res.Documento as documento, ";
			}
			if ($temp->getRol()->getId() != "AD") {
				$consulta .= " res.FechaBaja as fechaBaja, ";
				$consulta .= " res.FechaIngreso as fi, ";
				$consulta .= " res.FechaCambioPassword as fcp, ";
			}
			if ($temp->getRol()->getId() == "EM") {
				$consulta .= " res.CUIT as documento, ";
				$consulta .= " res.NombreEmpresa as nombre, ";
				$consulta .= " td.ID_TipoDocumento as tipoDocumentoID, ";
					
			}
			$consulta .= " u.Estado as estado ";
			$consulta .= " FROM usuario u ";
				
			if ($temp->getRol()->getId() == "AL") {
				$consulta .= " INNER JOIN alumno res ON (u.CodUsuario=res.CodUsuario)";
			}
			else if ($temp->getRol()->getId() == "PR") {
				$consulta .= " INNER JOIN profesor res ON (u.CodUsuario=res.CodUsuario)";
			}
			else if ($temp->getRol()->getId() == "EM") {
				$consulta .= " INNER JOIN empresa res ON (u.CodUsuario=res.CodUsuario)";
				$consulta .= " LEFT JOIN tipodocumento td ON (td.descripcion='CUIT')";
			}
				
			$consulta .= " WHERE u.CodUsuario=".$temp->getId();
				
			$conex->consulta($consulta);
			$result = $conex->fetch_assoc();
				
			if ($temp->getRol()->getId() == "AL") {
				$temp->getNivelEstudio()->getAndSetNivelById($result['nivelEstudioID']);
				$temp->setEncontrarme($result['encontrarme']);
			}
				
			if ($temp->getRol()->getId() == "AL" || $temp->getRol()->getId() == "PR") {
				$temp->setSexo($result['sexo']);
				$temp->setNacimiento($result['nacimiento']);
				$temp->getPais()->getAndSetPaisById($result['paisID']);
				$temp->getEstadoCivil()->getAndSetECById($result['estadoCivilID']);
				$temp->setApellido($result['apellido']);
				$temp->setIdAlumno($result['alumnoID']);
				
			}
	
			if ($temp->getRol()->getId() == "AD") {
				$temp->setNombre($result['email']);
			}
			else {
				$temp->setNombre($result['nombre']);
				$temp->setDocumentoByData($result['tipoDocumentoID'], $result['documento']);
				$temp->getBaja()->getSetFecha($result['fechaBaja']);
				$temp->getDomicilio()->getAndSetDireccionByUsrID($temp->getId());
				$temp->getFechaIngreso()->getSetFecha($result['fi']);
				$temp->getFechaCambioPass()->getSetFecha($result['fi']);
				if ($result['fcp'] != null AND $result['fcp'] != "") {
					$temp->getFechaCambioPass()->getSetFecha($result['fcp']);
				}
			}
			$temp->setNotificarme($result['notificarme']);
			$temp->setRecordarme($result['recordarme']);
			$temp->setEmail($result['email']);
			$temp->getEstado()->getEstadoByUsuarioId($temp->getId());
			$temp->getFoto()->getAndSetFotoByUsuarioID($temp->getId());
			if ($temp->getRol()->getId() == "AL") {
				$temp->getCarrera();
				$consulta = "SELECT estudiosID as id FROM usuarioEstudios WHERE CodUsuario=".$temp->getId();
				$result1 = $conex->consulta($consulta);
				$result = $conex->fetch_assoc();
				while ($result) {
					$index = $result['id'];
					$est = new Estudios();
					
					if ($index > $temp->getMaxEstId()) {
						$temp->setMaxEstId($index);
					}
					$temp->addEstudio($est->getEstudiosById($index));
					$result = $conex->fetch_assoc();
					unset($est);
				}
			}
		}
		return $temp;
	
	}
	
	public function getAndSetPersonaById($id) {
		if ($id) {
			$conex = new MySQL();
			$this->setId($id);
			
			$_SESSION['a1'] = "1";
			//Guardo Rol
			$this->getRol()->getAndSetRolByPersonaId($id);
			$_SESSION['a2'] = "2";
			$consulta  = " SELECT "
					." u.CodUsuario as id, "
					." u.Email as email, "
					." u.notificarme as notificarme, "
					." u.recordarme as recordarme, ";
			
			if ($this->getRol()->getId() == "AL") {
				$consulta   .= " res.ID_NivelEstudios as nivelEstudioID, ";
				$consulta   .= " res.ID_Alumno as alumnoID, ";
				$consulta   .= " res.encontrarme as encontrarme, ";
			}
			if ($this->getRol()->getId() == "PR") {
				$consulta   .= " res.ID_Profesor as alumnoID, ";
			}
			if ($this->getRol()->getId() == "AL" || $this->getRol()->getId() == "PR") {
				$consulta   .= " res.Nombre as nombre, "
						." res.Apellido as apellido, "
						." res.FechaNacimiento as nacimiento, "
						." res.ID_Paises as paisID, "
						." res.Sexo as sexo, "
						." res.ID_EstadoCivil as estadoCivilID, "
						." res.ID_TipoDocumento as tipoDocumentoID, "
						." res.Documento as documento, ";
			}
			if ($this->getRol()->getId() != "AD") {
				$consulta .= " res.FechaBaja as fechaBaja, ";
				$consulta .= " res.FechaIngreso as fi, ";
				$consulta .= " res.FechaCambioPassword as fcp, ";
			}
			if ($this->getRol()->getId() == "EM") {
				$consulta .= " res.CUIT as documento, ";
				$consulta .= " res.NombreEmpresa as nombre, ";
				$consulta .= " td.ID_TipoDocumento as tipoDocumentoID, ";
					
			}
			$consulta .= " u.Estado as estado ";
			$consulta .= " FROM usuario u ";
				
			if ($this->getRol()->getId() == "AL") {
				$consulta .= " INNER JOIN alumno res ON (u.CodUsuario=res.CodUsuario)";
			}
			else if ($this->getRol()->getId() == "PR") {
				$consulta .= " INNER JOIN profesor res ON (u.CodUsuario=res.CodUsuario)";
			}
			
			else if ($this->getRol()->getId() == "EM") {
				$consulta .= " INNER JOIN empresa res ON (u.CodUsuario=res.CodUsuario)";
				$consulta .= " LEFT JOIN tipodocumento td ON (td.descripcion='CUIT')";
			}
				
			$consulta .= " WHERE u.CodUsuario=".$this->getId();
				
			$conex->consulta($consulta);
			$result = $conex->fetch_assoc();
			if ($this->getRol()->getId() == "AL") {
				//$this->getNivelEstudio()->getAndSetNivelById($result['nivelEstudioID']);
				$this->setEncontrarme($result['encontrarme']);
			}
			
				
			if ($this->getRol()->getId() == "AL" || $this->getRol()->getId() == "PR") {
				$this->setSexo($result['sexo']);

				$this->setNacimiento($result['nacimiento']);
				
				//$this->getPais()->getAndSetPaisById($result['paisID']);
	
				//$this->getEstadoCivil()->getAndSetECById($result['estadoCivilID']);
		
				$this->setApellido($result['apellido']);
	
				$this->setIdAlumno($result['alumnoID']);
	
			}
	
			if ($this->getRol()->getId() == "AD") {
				$this->setNombre($result['email']);
			}
			else {
				$this->setNombre($result['nombre']);
				$this->setDocumentoByData($result['tipoDocumentoID'], $result['documento']);
				$this->getBaja()->getSetFecha($result['fechaBaja']);
				$this->getDomicilio()->getAndSetDireccionByUsrID($this->getId());
				$this->getFechaIngreso()->getSetFecha($result['fi']);
				$this->getFechaCambioPass()->getSetFecha($result['fi']);
				if ($result['fcp'] != null AND $result['fcp'] != "") {
					$this->getFechaCambioPass()->getSetFecha($result['fcp']);
				}
			}
			$this->setEmail($result['email']);
			$this->setNotificarme($result['notificarme']);
			$this->setRecordarme($result['recordarme']);
			$this->getEstado()->getEstadoByUsuarioId($this->getId());
			$this->getFoto()->getAndSetFotoByUsuarioID($this->getId());
			if ($this->getRol()->getId() == "AL") {
				$this->getCarrera();
				$consulta = "SELECT estudiosID as id FROM usuarioEstudios WHERE CodUsuario=".$this->getId();
				$result1 = $conex->consulta($consulta);
				$result = $conex->fetch_assoc();
				while ($result) {
					$index = $result['id'];
					$_SESSION['DOM'.$index] = "1";
					$est = new Estudios();
					if ($index > $this->getMaxEstId()) {
						$this->setMaxEstId($index);
					}
					
					$this->addEstudio($est->getEstudiosById($index));
					$result = $conex->fetch_assoc();
					unset($est);
				}
				$trabajos = new Trabajo();
				$this->setWork($trabajos->getTrabajosByAlumnoId($this->idAlumno));
	
			}
		}
	
		
	}
	public function getNotificarme() {
		return $this->notificarme;
	}
	public function setNotificarme($not) {
		$this->notificarme = $not;
	}
	public function getRecordarme() {
		return $this->recordarme;
	}
	public function setRecordarme($rec) {
		$this->recordarme = $rec;
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
	public function setNivelEstudio($a) {
		if ($a) {
			$this->nivelEstudio = $a;
		}
		else {
			//LOGERROR
		}
	}
	public function getNivelEstudio() {
		return $this->nivelEstudio;
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
	public function addEstudio($est) {
		if ($est) {
			$this->estudios[$est->getId()] = $est;
		}
		else {
			//LOGERROR
		}
	}
	public function getEst($id) {
		if ($id) {
			return $this->estudios[$id];
		}
		else {
			//LOGERROR
		}
	}
	public function getAllEst() {
		return $this->estudios;
	}
	public function delEst($id) {
		if ($id) {
			unset($this->estudios[$id]);
		}
		else {
			//LOGERROR
		}
	}
	public function getMaxEstId() {
		return $this->maxEstId;	
	}
	public function setMaxEstId($a) {
		if ($a) {
			$this->maxEstId = $a;
		}
		else {
			//LOGERROR
		}
	}
	public function getEncontrarme() {
		return $this->encontrarme;
	}
	public function setEncontrarme($a) {
		if ($a) {
			$this->encontrarme = $a;
		}
		else {
			//LOGERROR
		}
	}
	
	public function getidAlumno() {
		return $this->idAlumno;
	}
	public function setIdAlumno($id) {
		if ($id) {
			$this->idAlumno = $id;
		}
		else {
			//LOGERROR
		}
	}
	
	public function addTrabajo($work) {
		if ($work) {
			$this->trabajos[$work->getId()] = $work;
		}
		else {
			//LOGERROR
		}
	}
	public function getWork($id) {
		if ($id) {
			return $this->trabajos[$id];
		}
		else {
			//LOGERROR
		}
	}
	public function setWork($works) {
		if ($works) {
			$this->trabajos = $works;
		}
		else {
			//LOGERROR
		}
	}
	public function getAllWork() {
		return $this->trabajos;
	}
	public function delWork($id) {
		if ($id) {
			unset($this->trabajos[$id]);
		}
		else {
			//LOGERROR
		}
	}
	public function saveDP() {
		if ($this->getRol()->getId() == "AL") {
			$conex = new MySQL();
			$consulta = " UPDATE Alumno SET "
					   ." Nombre ='".$conex->escape($this->getNombre())."',"
					   ." Apellido ='".$conex->escape($this->getApellido())."',"
					   ." ID_TipoDocumento =".$this->getDocumento()->getId().","
					   ." Documento ='".$conex->escape($this->getDocumento()->getDocumento())."',"
					   ." FechaNacimiento ='".$conex->escape($this->getFechaNacClass()->getForInsert())."'"
					   ." WHERE CodUsuario=".$this->getId()." AND ID_Alumno=".$this->getidAlumno().";"; 
			$conex->consulta($consulta);
		}
		if ($this->getRol()->getId() == "PR") {
			$conex = new MySQL();
			$consulta = " UPDATE Profesor SET "
					." Nombre ='".$conex->escape($this->getNombre())."',"
					." Apellido ='".$conex->escape($this->getApellido())."',"
					." ID_TipoDocumento =".$this->getDocumento()->getId().","
					." Documento ='".$conex->escape($this->getDocumento()->getDocumento())."',"
					." FechaNacimiento ='".$conex->escape($this->getFechaNacClass()->getForInsert())."'"
					." WHERE CodUsuario=".$this->getId()." AND ID_Profesor=".$this->getidAlumno().";";
			$conex->consulta($consulta);
		}
	}
	
	
	public function saveConfig1() {
			$conex = new MySQL();
		if ($this->getRol()->getId() == "AL") {
			$var = 0;
			if ($this->getEncontrarme() == "true") { $var = "1"; }
			$consulta = " UPDATE Alumno SET "
			." encontrarme ='".$var."'"
			." WHERE CodUsuario=".$this->getId()." AND ID_Alumno=".$this->getidAlumno().";";
			$conex->consulta($consulta);
	
		}
		$var = 0;
		if ($this->getNotificarme() == "true") { $var = "1"; }
		$consulta = " UPDATE usuario SET "
					." notificarme ='".$var."'"
					." WHERE CodUsuario=".$this->getId().";";
		$conex->consulta($consulta);
	}
}


?>
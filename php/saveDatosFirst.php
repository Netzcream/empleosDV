<?php 

if (!isset($_SESSION)) {
	session_start();
}

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}
	
$conex = new MySQL();


if (isset($_POST)) {
	$error = 0;
	$rol = "";
	$apellido = "";
	$nombre = "";
	$sexo = "";
	$tipoDoc = "";
	$nroDoc = "";
	$localidad = "";
	$provincia = "";
	$nroCalle = "";
	$calle = "";
	$razonSoc = "";
	$nroCuit = "";
	$codUsuario = "";
	$consulta = "";
	$piso = "";
	$departamento = "";
	if (isset($_SESSION['CodUsuario'])) {
		$codUsuario = $_SESSION['CodUsuario'];
	}
	
	if (isset($_POST['rol'])) {
		$rol = $_POST['rol'];
		//Rol Alumno
		if (($rol == "soyAlum") || ($rol == "soyProf")) { 
			//Apellido
			
			if (isset($_POST['apellido'])) { $apellido = $conex->escape($_POST['apellido']); }
			else { $error++; }
			//Nombre
			if (isset($_POST['nombre'])) { $nombre = $conex->escape($_POST['nombre']); }
			else { $error++; }
			//Sexo
			if (isset($_POST['sexo'])) {
				if ($_POST['sexo'] == "soyFem") { $sexo = "f"; }
				else { $sexo = "m"; } 
			}
			else { $error++; }
			//Tipo de Documento
			if (isset($_POST['tipoDoc'])) { $tipoDoc = $conex->escape($_POST['tipoDoc']); }
			else { $error++; }
			//Nro de Doc
			if (isset($_POST['nroDoc'])) { $nroDoc = $conex->escape($_POST['nroDoc']); }
			else { $error++; }
			//Domicilio Calle
			if (isset($_POST['calle'])) { $calle = $conex->escape($_POST['calle']); }
			else { $error++; }
			//Domicilio Nro
			if (isset($_POST['nroCalle'])) { $nroCalle = $conex->escape($_POST['nroCalle']); }
			else { $error++; }
			//Domicilio PRovincia
			if (isset($_POST['provincia'])) { $provincia = $conex->escape($_POST['provincia']); }
			else { $error++; }
			//Domicilio Localidad
			if (isset($_POST['localidad'])) { $localidad = $conex->escape($_POST['localidad']); }
			else { $error++; }

			if (isset($_POST['piso'])) { $piso = $conex->escape($_POST['piso']); }
			else { $error++; }
				
			if (isset($_POST['dpto'])) { $departamento = $conex->escape($_POST['dpto']); }
			else { $error++; }
				
			
		}
		
		else if ($rol == "soyEmpr") {
			//Razon Social
			if (isset($_POST['razonSoc'])) { $razonSoc = $conex->escape($_POST['razonSoc']); }
			else { $error++; }
			//Nro de CUIT
			if (isset($_POST['nroCUIT'])) { $nroCuit = $conex->escape($_POST['nroCUIT']); }
			else { $error++; }
			//Domicilio Calle
			if (isset($_POST['calle'])) { $calle = $conex->escape($_POST['calle']); }
			else { $error++; }
			//Domicilio Nro
			if (isset($_POST['nroCalle'])) { $nroCalle = $conex->escape($_POST['nroCalle']); }
			else { $error++; }
			//Domicilio PRovincia
			if (isset($_POST['provincia'])) { $provincia = $conex->escape($_POST['provincia']); }
			else { $error++; }
			//Domicilio Localidad
			if (isset($_POST['localidad'])) { $localidad = $conex->escape($_POST['localidad'])	; }
			else { $error++; }
		}
		
		$codRol = "";
		
		
		if ($rol == "soyAlum") {
			$codRol = "AL";
			$consulta = "INSERT INTO alumno (ID_Alumno,CodUsuario,CodRol,Nombre,Apellido,FechaIngreso,Sexo,ID_TipoDocumento,Documento)"
					."VALUES (null,'".$codUsuario."','AL','".$nombre."','".$apellido."',NOW(),'".$sexo."',".$tipoDoc.",'".$nroDoc."');";
		}
		else if ($rol == "soyProf") {
			$codRol = "PR";
			$consulta = "INSERT INTO profesor (ID_Profesor,CodUsuario,CodRol,Nombre,Apellido,FechaIngreso,Sexo,ID_TipoDocumento,Documento)"
					."VALUES (null,'".$codUsuario."','PR','".$nombre."','".$apellido."',NOW(),'".$sexo."',".$tipoDoc.",'".$nroDoc."');";
		}
		else if ($rol == "soyEmpr") {
			$codRol = "EM";
			$consulta = "INSERT INTO empresa (ID_Empresa,CodUsuario,CodRol,NombreEmpresa,FechaIngreso,CUIT)"
					."VALUES (null,'".$codUsuario."','EM','".$razonSoc."',NOW(),'".$nroCuit."');";
		}
		$conex->consulta("START TRANSACTION;");
		$a1 = $conex->consulta($consulta);
		$consDomicilio = "INSERT INTO direccion (ID_Direccion,ID_Provincia,ID_Localidad,Calle,Numero,Piso,Departamento) VALUES "
					."(null,'".$provincia."','".$localidad."','".$conex->escape($calle)."','".$conex->escape($nroCalle)."','".$conex->escape($piso)."','".$departamento."');";
		$a2 = $conex->consulta($consDomicilio);
		$a3 = $conex->consulta("SELECT LAST_INSERT_ID() as id");
		$result = $conex->fetch_assoc();
		$lastID = $result['id'];
		
		$a4 = $conex->consulta("UPDATE UsuarioRol SET CodRol='".$codRol."' WHERE CodUsuario = ".$codUsuario.";");

		$consDomicilio = "INSERT INTO direccionUsuario (CodUsuario,ID_Direccion) VALUES "
				."('". $codUsuario."',".$lastID.");";
		$a5 = $conex->consulta($consDomicilio);
		

		if ($a1 and $a2 and $a3 and $a4 and $a5) {
			$conex->consulta("COMMIT;");
			echo '<br><br><br><br><br><br><label class="selRolLabel">Datos guardados correctamente</label>';
			echo '<img src="imagenes/iconos/check.png">';
			$_SESSION['UsuarioRol'] = $codRol;
		} else {
			$conex->consulta("ROLLBACK;");
			echo '<label class="selRolLabel">Ah ocurrido un error al momento de guardar los datos, favor de comunicarse con los administradores.  Muchas gracias</label>';
			
			//LOGERROR
		}
			
			
	}
}


?>
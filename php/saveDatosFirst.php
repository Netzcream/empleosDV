<?php 

if (!isset($_SESSION)) {
	session_start();
}

include_once("/conex.php");
	
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
			
			if (isset($_POST['apellido'])) { $apellido = htmlentities($_POST['apellido'],ENT_QUOTES); }
			else { $error++; }
			//Nombre
			if (isset($_POST['nombre'])) { $nombre = htmlentities($_POST['nombre'],ENT_QUOTES); }
			else { $error++; }
			//Sexo
			if (isset($_POST['sexo'])) {
				if ($_POST['sexo'] == "soyFem") { $sexo = "f"; }
				else { $sexo = "m"; } 
			}
			else { $error++; }
			//Tipo de Documento
			if (isset($_POST['tipoDoc'])) { $tipoDoc = htmlentities($_POST['tipoDoc'],ENT_QUOTES); }
			else { $error++; }
			//Nro de Doc
			if (isset($_POST['nroDoc'])) { $nroDoc = htmlentities($_POST['nroDoc'],ENT_QUOTES); }
			else { $error++; }
			//Domicilio Calle
			if (isset($_POST['calle'])) { $calle = htmlentities($_POST['calle'],ENT_QUOTES); }
			else { $error++; }
			//Domicilio Nro
			if (isset($_POST['nroCalle'])) { $nroCalle = htmlentities($_POST['nroCalle'],ENT_QUOTES); }
			else { $error++; }
			//Domicilio PRovincia
			if (isset($_POST['provincia'])) { $provincia = htmlentities($_POST['provincia'],ENT_QUOTES); }
			else { $error++; }
			//Domicilio Localidad
			if (isset($_POST['localidad'])) { $localidad = htmlentities($_POST['localidad'],ENT_QUOTES); }
			else { $error++; }

			if (isset($_POST['piso'])) { $piso = htmlentities($_POST['piso'],ENT_QUOTES); }
			else { $error++; }
				
			if (isset($_POST['dpto'])) { $departamento = htmlentities($_POST['dpto'],ENT_QUOTES); }
			else { $error++; }
				
			
		}
		
		else if ($rol == "soyEmpr") {
			//Razon Social
			if (isset($_POST['razonSoc'])) { $razonSoc = htmlentities($_POST['razonSoc'],ENT_QUOTES); }
			else { $error++; }
			//Nro de CUIT
			if (isset($_POST['nroCUIT'])) { $nroCuit = htmlentities($_POST['nroCUIT'],ENT_QUOTES); }
			else { $error++; }
			//Domicilio Calle
			if (isset($_POST['calle'])) { $calle = htmlentities($_POST['calle'],ENT_QUOTES); }
			else { $error++; }
			//Domicilio Nro
			if (isset($_POST['nroCalle'])) { $nroCalle = htmlentities($_POST['nroCalle'],ENT_QUOTES); }
			else { $error++; }
			//Domicilio PRovincia
			if (isset($_POST['provincia'])) { $provincia = htmlentities($_POST['provincia'],ENT_QUOTES); }
			else { $error++; }
			//Domicilio Localidad
			if (isset($_POST['localidad'])) { $localidad = htmlentities($_POST['localidad'],ENT_QUOTES)	; }
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
		$consDomicilio = "INSERT INTO direccion (CodUsuario,ID_Provincia,ID_Localidad,Calle,Numero,Piso,Departamento) VALUES "
				."('". $codUsuario."','".$provincia."','".$localidad."','".$calle."','".$nroCalle."','".$piso."','".$departamento."');";
		$a2 = $conex->consulta($consDomicilio);
		$a3 = $conex->consulta("UPDATE UsuarioRol SET CodRol='".$codRol."' WHERE CodUsuario = ".$codUsuario.";");

		if ($a1 and $a2 and $a3) {
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
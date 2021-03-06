		<script type="text/javascript" src="js/footable.js"></script>
		<script type="text/javascript" src="js/footable.sort.js"></script>
		<script type="text/javascript" src="js/footable.paginate.js"></script>
		<script type="text/javascript" src="js/footable.filter.js"></script>

<?php
if (!isset($_SESSION)) {
	session_start();
}
$_SESSION['location'] = "listadoUsuarios";

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}


$list = new Listado();
echo $list->getTable();

class Listado {
	public $tablaCompleta;
	public $cantColumnas;
	public $tablaArrayNombres = array();
	public $conex;
	public $consulta;
	public $result;
	public $cantRows;
	public $arrayCoordenadas = array();
	public function __construct() {
		$this->conex = new MySQL();
		
	}
	public function getHeader() {
		return "
				<thead>
					<tr>
						<th width='60' class='footable-first-column' title='Prueba de Listas'>Rol</th>
						<th data-toggle='true'>Apellido, Nombre o Raz&oacute;n Social</th>
						<th width='150' data-sort-ignore='true'>Tipo y Nro de Doc.</th>
						<th data-hide='phone' width='80'>Fecha</th>		
						<th data-hide='phone' width='70'>Sexo</th>
						<th data-hide='phone' width='80'>Estado</th>
						<th class='footable-last-column' data-sort-ignore='true' width='100'>Acciones</th>
					</tr>
				</thead>
				";
	}

	public function getListadoAlumnos() {
		
		$this->consulta = "SELECT D.Coordenada1 as C1, D.Coordenada2 as C2, a.CodUsuario as usrID, a.Apellido as apellido, a.Nombre as nombre, td.Descripcion as tipoDoc, a.Documento as doc, a.FechaIngreso as fecha, a.Sexo as sexo, u.Estado FROM usuario u"
							." INNER JOIN usuarioRol ur on (ur.CodUsuario = u.CodUsuario)"
							." INNER JOIN alumno a on (a.CodUsuario=u.codUsuario)"
							." INNER JOIN tipodocumento td on (a.ID_TipoDocumento=td.ID_TipoDocumento)"
							." LEFT JOIN DireccionUsuario ON DU (D.CodUsuario=u.CodUsuario)"
							." LEFT JOIN Domicilio ON D (D.ID_Direccion=DU.ID_Direccion)"
							." WHERE ur.CodRol = 'AL' and u.estado != 5;";
		$this->result = $this->conex->consulta($this->consulta);
		$this->cantRows = $this->conex->num_rows();
		$this->cantColumnas = $this->conex->num_fields();
		
		$temp = "";
		$resultado = $this->conex->fetch_assoc();
		while ($resultado) {
			$estadoText = "";
			if ($resultado['Estado'] == "1") {
				$estadoText = "Pendiente";
			}
			else if ($resultado['Estado'] == "2") {
				$estadoText = "Sin Rol";
			}
			else if ($resultado['Estado'] == "3") {
				$estadoText = "Activo";
			}
			else if ($resultado['Estado'] == "4") {
				$estadoText = "Bloqueado";
			}
			$temp .= "<tr>";
			$temp .= "<td title='Alumno' data-value='AL'>";
			$temp .= "<img alt='' src='imagenes/iconos/estudiante.png' width='40'>";
			$temp .= "</td>";
			$temp .= "<td>".$resultado['apellido'].", ".$resultado['nombre']."</td>";
			$temp .= "<td >".$resultado['tipoDoc']." - ".$resultado['doc']."</td>";
			$temp .= "<td >".$resultado['fecha']."</td>";
			
			if ($resultado['sexo'] == 'f') { $sexo = "Femenino"; }
			else $sexo = "Masculino";
			$temp .= "<td title='".$sexo."' style='text-align: center; vertical-align: middle;' data-value='".$resultado['sexo']."'><img width='40' alt='' src='imagenes/iconos/".$resultado['sexo'].".png'></td>";


			$temp .= "<td style='text-align: center; vertical-align: middle;' data-value='".$resultado['Estado']."'>".$estadoText."</td>";

			$temp .= "<td style='text-align: center; vertical-align: middle;'>";
			if ($resultado['Estado'] == "4") {
			$temp .= "<div class='btnCuadrado aceptar' title='Des Bloquear'onclick='authUsr(".$resultado['usrID'].",".'"'.$resultado['nombre'].'"'.");'><img alt='' src='imagenes/iconos/check_blanco.png' width='15'></div>";
			}
			else {
			$temp .= "<div class='btnCuadrado cancelar' title='Bloquear'onclick='cancelarUsr(".$resultado['usrID'].",".'"'.$resultado['nombre'].'"'.");'><img alt='' src='imagenes/iconos/block.png' width='15'></div>";
			}
			$temp .= "</td>";
			
			$temp .= "</tr>";
			$this->arrayCoordenadas[$resultado['usrID']] = array($resultado['C1'],$resultado['C2']);
			$resultado = $this->conex->fetch_assoc();
		} 

	
		return $temp;
	}
	
	
	public function getListadoProfesores() {
	
		$this->consulta = "SELECT a.CodUsuario as usrID, a.Apellido as apellido, a.Nombre as nombre, u.Estado, td.Descripcion as tipoDoc, a.Documento as doc, a.FechaIngreso as fecha, a.Sexo as sexo FROM usuario u"
				." INNER JOIN usuarioRol ur on (ur.CodUsuario = u.CodUsuario)"
				." INNER JOIN profesor a on (a.CodUsuario=u.codUsuario)"
						." INNER JOIN tipodocumento td on (a.ID_TipoDocumento=td.ID_TipoDocumento)"
								." WHERE ur.CodRol = 'PR' and u.estado != 5;";
		$this->result = $this->conex->consulta($this->consulta);
		$this->cantRows = $this->conex->num_rows();
		$this->cantColumnas = $this->conex->num_fields();
	
		$temp = "";
		$resultado = $this->conex->fetch_assoc();
		while ($resultado) {
			$estadoText = "";
			if ($resultado['Estado'] == "1") {
				$estadoText = "Pendiente";
			}
			else if ($resultado['Estado'] == "2") {
				$estadoText = "Sin Rol";
			}
			else if ($resultado['Estado'] == "3") {
				$estadoText = "Activo";
			}
			else if ($resultado['Estado'] == "4") {
				$estadoText = "Bloqueado";
			}
			$temp .= "<tr>";
			$temp .= "<td title='Profesor' data-value='PR'>";
			$temp .= "<img alt='' src='imagenes/iconos/profesor.png' width='40'>";
			$temp .= "</td>";
			$temp .= "<td>".$resultado['apellido'].", ".$resultado['nombre']."</td>";
			$temp .= "<td >".$resultado['tipoDoc']." - ".$resultado['doc']."</td>";
			$temp .= "<td >".$resultado['fecha']."</td>";
			if ($resultado['sexo'] == 'f') { $sexo = "Femenino"; }
			else $sexo = "Masculino";
			$temp .= "<td title='".$sexo."' style='text-align: center; vertical-align: middle;' data-value='".$resultado['sexo']."'><img width='40' alt='' src='imagenes/iconos/".$resultado['sexo'].".png'></td>";
			
			$temp .= "<td style='text-align: center; vertical-align: middle;' data-value='".$resultado['Estado']."'>".$estadoText."</td>";

			$temp .= "<td style='text-align: center; vertical-align: middle;'>";
			if ($resultado['Estado'] == "4") {
			$temp .= "<div class='btnCuadrado aceptar' title='Des Bloquear'onclick='authUsr(".$resultado['usrID'].",".'"'.$resultado['nombre'].'"'.");'><img alt='' src='imagenes/iconos/check_blanco.png' width='15'></div>";
			}
			else {
			$temp .= "<div class='btnCuadrado cancelar' title='Bloquear'onclick='cancelarUsr(".$resultado['usrID'].",".'"'.$resultado['nombre'].'"'.");'><img alt='' src='imagenes/iconos/block.png' width='15'></div>";
			}
			$temp .= "</td>";
			$temp .= "</tr>";
			$resultado = $this->conex->fetch_assoc();
		}
	
		return $temp;
	}
	
	
	public function getListadoEmpresas() {
	
		$this->consulta = "SELECT a.CodUsuario as usrID, a.NombreEmpresa as nombre, u.Estado, a.CUIT as doc, a.FechaIngreso as fecha FROM usuario u"
							." INNER JOIN usuarioRol ur on (ur.CodUsuario = u.CodUsuario)"
							." INNER JOIN empresa a on (a.CodUsuario=u.codUsuario)"
							." WHERE ur.CodRol = 'EM' and u.estado != 5;";
		$this->result = $this->conex->consulta($this->consulta);
		$this->cantRows = $this->conex->num_rows();
		$this->cantColumnas = $this->conex->num_fields();
	
		$temp = "";
		$resultado = $this->conex->fetch_assoc();
		while ($resultado) {
			$estadoText = "";
			if ($resultado['Estado'] == "1") {
				$estadoText = "Pendiente";
			}
			else if ($resultado['Estado'] == "2") {
				$estadoText = "Sin Rol";
			}
			else if ($resultado['Estado'] == "3") {
				$estadoText = "Activo";
			}
			else if ($resultado['Estado'] == "4") {
				$estadoText = "Bloqueado";
			}
			$temp .= "<tr>";
			$temp .= "<td title='Empresa' data-value='EM'>";
			$temp .= "<img alt='' src='imagenes/iconos/empresa.png' width='40'>";
			$temp .= "</td>";
			$temp .= "<td>".$resultado['nombre']."</td>";
			$temp .= "<td >".$resultado['doc']."</td>";
			$temp .= "<td >".$resultado['fecha']."</td>";
			$temp .= "<td title='No aplica' style='text-align: center; vertical-align: middle;' data-value='NA'>NA</td>";
			$temp .= "<td style='text-align: center; vertical-align: middle;' data-value='".$resultado['Estado']."'>".$estadoText."</td>";
			$temp .= "<td style='text-align: center; vertical-align: middle;'>";
			if ($resultado['Estado'] == "4") {
			$temp .= "<div class='btnCuadrado aceptar' title='Des Bloquear'onclick='authUsr(".$resultado['usrID'].",".'"'.$resultado['nombre'].'"'.");'><img alt='' src='imagenes/iconos/check_blanco.png' width='15'></div>";
			}
			else {
			$temp .= "<div class='btnCuadrado cancelar' title='Bloquear'onclick='cancelarUsr(".$resultado['usrID'].",".'"'.$resultado['nombre'].'"'.");'><img alt='' src='imagenes/iconos/block.png' width='15'></div>";
			}
			$temp .= "</td>";
					

			
			$temp .= "</tr>";
			$resultado = $this->conex->fetch_assoc();
		}
	
		return $temp;
	}
	
	
	public function getFooter() {
		$temp = "<tfoot>
					<tr>
						<td colspan='7'>
							<div  class='pagination pagination-centered hide-if-no-paging'></div>
						</td>
					</tr>
				</tfoot>";

		return $temp;
	}
	public function getTable() {
		$temp = "<p class='buscarTable'><input id='filter' type='search' placeholder='Buscar...'/></p>";
		$temp .= "<table class='tablaDemo breakpoint table toggle-circle toggle-medium' data-page-size='10' data-filter='#filter' data-filter-text-only='true'>";
		$temp .= $this->getHeader();
		$temp .= "<tbody>";
		$temp .= $this->getListadoAlumnos();
		$temp .= $this->getListadoProfesores();
		$temp .= $this->getListadoEmpresas();
		$temp .= "</tbody>";
		$temp .= $this->getFooter();
		$temp .= "</table>";
		$temp .= '<script type="text/javascript" src="/js/footable.js"></script>';
		$temp .= '<script type="text/javascript" src="/js/footable.sort.js"></script>';
		$temp .= '<script type="text/javascript" src="/js/footable.paginate.js"></script>';
		$temp .= '<script type="text/javascript" src="/js/footable.filter.js"></script>';
		$temp .= "<script type='text/javascript'>
					$(function () {
						$('.tablaDemo').footable({
							addRowToggle: true
							})
					});
				$('#cuerpo').show();
				</script>";
		return $temp;
	}
	
}
?>
<span id="tempLoad"> 

</span>
<script>
function cancelarUsr(a,b) {
	var r = confirm("Se va a bloquear al usuario "+b);
	if (r == true) {
		$('#tempLoad').load('php/adminListadoUsuariosAccion.php',{ accion : 'bloquear', codUsr:a});
	}
	
}
function authUsr(a,b) {
	var r = confirm("Se va a desbloquear al usuario "+b);
	if (r == true) {
		$('#tempLoad').load('php/adminListadoUsuariosAccion.php',{ accion : 'desbloquear', codUsr:a});
	}
	
}
$(document).ready(function() {
	hideWait();
});
</script>
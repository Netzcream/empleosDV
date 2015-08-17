		<script type="text/javascript" src="js/footable.js"></script>
		<script type="text/javascript" src="js/footable.sort.js"></script>
		<script type="text/javascript" src="js/footable.paginate.js"></script>
		<script type="text/javascript" src="js/footable.filter.js"></script>

<?php
if (!isset($_SESSION)) { session_start(); }
$_SESSION['location'] = "listadoEmpresas";

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
	
	public function __construct() {
		$this->conex = new MySQL();
		
	}
	public function getHeader() {
		return "
				<thead>
					<tr>
						<th width='40' class='footable-first-column' data-sort-ignore='true' title='Prueba de Listas'>Rol</th>
						<th data-toggle='true'>Apellido, Nombre</th>
						<th width='130' data-sort-ignore='true'>Nro de Doc.</th>
						<th data-hide='phone' width='50'>Fecha</th>		
						<th data-hide='phone' width='70'>Sexo</th>
						<th data-hide='phone' width='40' data-sort-ignore='true'>CV</th>
					</tr>
				</thead>
				";
	}

	public function getListadoAlumnos() {
		
		$this->consulta = "SELECT a.CodUsuario as usrID, a.Apellido as apellido, a.Nombre as nombre, td.Descripcion as tipoDoc, a.Documento as doc, a.FechaIngreso as fecha, a.Sexo as sexo "
							." FROM usuario u"
							." INNER JOIN usuarioRol ur on (ur.CodUsuario = u.CodUsuario)"
							." INNER JOIN alumno a on (a.CodUsuario=u.codUsuario)"
							." INNER JOIN AlumnoBolsa ab on (a.codUsuario=ab.alumnoId)"
							." INNER JOIN tipodocumento td on (a.ID_TipoDocumento=td.ID_TipoDocumento)"
							." WHERE ur.CodRol = 'AL' AND ab.bolsaId = ".$_POST['campo1'].";";
		$this->result = $this->conex->consulta($this->consulta);
		$this->cantRows = $this->conex->num_rows();
		$this->cantColumnas = $this->conex->num_fields();
		
		$temp = "";
		$resultado = $this->conex->fetch_assoc();
		while ($resultado) {
			$temp .= "<tr>";
			$temp .= "<td title='Alumno' >";
			$temp .= "<img alt='' src='imagenes/iconos/estudiante.png' width='20'>";
			$temp .= "</td>";
			$temp .= "<td>".$resultado['apellido'].", ".$resultado['nombre']."</td>";
			$temp .= "<td >".$resultado['tipoDoc'].": ".$resultado['doc']."</td>";

			$phpdate = strtotime( $resultado['fecha'] );
			$mysqldate = date( 'd-m-Y', $phpdate );

			$temp .= "<td >".$mysqldate."</td>";
			
			if ($resultado['sexo'] == 'f') { $sexo = "Femenino"; }
			else $sexo = "Masculino";
			$temp .= "<td title='".$sexo."' style='text-align: center; vertical-align: middle;' data-value='".$resultado['sexo']."'><img width='20' alt='' src='imagenes/iconos/".$resultado['sexo'].".png'></td>";

			$temp .= "<td title='".$sexo."' style='text-align: center; vertical-align: middle;' >";
			$temp .= "<a class='' target='_blank' href='php/imprimirCVde.php?cv=". $resultado['usrID'] ."'>Ver</a>";
			$temp .= "</td>";

			$temp .= "</tr>";
			$resultado = $this->conex->fetch_assoc();
		} 
	
		return $temp;
	}
	
		
	public function getFooter() {
		$temp = "<tfoot>
					<tr>
						<td colspan='6'>
							<div  class='pagination pagination-centered hide-if-no-paging'></div>
						</td>
					</tr>
				</tfoot>";

		return $temp;
	}
	public function getTable() {
		$temp = "<p class='buscarTable'><input id='filter' type='search' placeholder='Buscar...'/></p>";
		$temp .= "<table class='tablaDemo breakpoint table toggle-circle toggle-medium' data-page-size='5' data-filter='#filter' data-filter-text-only='true'>";
		$temp .= $this->getHeader();
		$temp .= "<tbody>";
		$temp .= $this->getListadoAlumnos();
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
function aceptarUsr(a,b) {
	var r = confirm("Se va a confirmar la autorizaci\u00F3n al usuario "+b);
	if (r == true) {
		$('#tempLoad').load('php/authAutorizar.php',{codUsr:a});
	}
}
function cancelarUsr(a,b) {
	var r = confirm("Se va a denegar la autorizaci\u00F3n al usuario "+b);
	if (r == true) {
		$('#tempLoad').load('php/authDenegar.php',{codUsr:a});
	}
	
}
$(document).ready(function() {
	hideWait();
});
</script>
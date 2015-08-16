<?php

if (!isset($_SESSION)) {
	session_start();
}
$_SESSION['location'] = "listado";

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}
/*
$list = new Listado();
echo $list->getTable();
*/
class Listado {
	public $tablaCompleta;
	public $cantColumnas;
	public $tablaArrayNombres = array();
	public $conex;
	public $consulta;
	public $result;
	public $cantRows;
	
	public function __construct() {
//		$this->cantRows = $this->conex->num_rows();
	//	$this->cantColumnas = $this->conex->num_fields();
		//mysql_fetch_assoc ( $devCapitulo );
	}
	
	public function getHeader() {
		return "
				<thead>
					<tr>
						<th width='40' class='footable-first-column' title='' data-sort-ignore='true'>Foto</th>
						<th  data-toggle='true'>Apellido</th>
						<th >Nombre</th>
						<th data-hide='phone' width='70'>Edad</th>
						<th data-hide='phone'>Zona</th>
						<th data-hide='phone'  width='70'>Sexo</th>
						<th class='footable-last-column' data-sort-ignore='true' width='40'>Perfil</th>
					</tr>
				</thead>
				";
	}
	
	public function getListado($colPersona) {
		$_SESSION['colPersonas'] = unserialize (serialize ($colPersona));
		$temp = "<tbody>";
		foreach ($colPersona as $Per) {
			$Persona = new Persona();
			$Persona = unserialize (serialize ($Per));
			
			$temp .= "<tr>";
			$temp .= "<td>";
			$temp .= "<img alt='' src='".$Persona->getPic()."' width='40'>";
			$temp .= "</td>";
			$temp .= "<td>".$Persona->getApellido()."</td>";
			$temp .= "<td>".$Persona->getNombre()."</td>";
			$temp .= "<td style='text-align: center; vertical-align: middle;'>".$Persona->getEdad()."</td>";
			$temp .= "<td>".$Persona->getDomicilio()->getLoc()->getLocalidad().", ".$Persona->getDomicilio()->getLoc()->getProvincia()->getProvincia()."</td>";
			$temp .= "<td style='text-align: center; vertical-align: middle;' data-value='".$Persona->getSexo()."'><img alt='' src='".$Persona->getSexoImg()."'></td>";
			$temp .= "<td style='text-align: center; vertical-align: middle;'><a target='_blank' href='php/imprimirCVde.php?cv=".$Persona->getId()."'>Ver</a></td>";
			$temp .= "</tr>";
		} 
		$temp .= "</tbody>";
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
	
	public function getTable($colPersona) {
		$temp = "<p class='buscarTable'><input id='filter' type='search' placeholder='Buscar...'/></p>";
		$temp .= "<table class='tablaDemo breakpoint table toggle-circle toggle-medium' data-page-size='10' data-filter='#filter' data-filter-text-only='true'>";
		$temp .= $this->getHeader();
		$temp .= $this->getListado($colPersona);
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


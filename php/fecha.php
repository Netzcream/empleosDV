<?php
class fecha {
	public $fecha;
	public $dia;
	public $mes;
	public $anio;
	
	function __construct($fecha) {
		$this->fecha = $fecha;
		list($this->anio,$this->mes,$this->dia) = explode("-",$this->fecha);
	}
	function getFecha() {
		return $this->dia."-".$this->mes."-".$this->anio;
	}
	function getLongDate() {
		return $this->dia." de ".$this->getSMes()." de ".$this->anio;
		
	}
	function getSMes() {
		$temp = "";
		switch ($this->mes) {
		case '1':
			$temp = "Enero"; 
			break;
		case '2':
			$temp = "Febrero";
			break;
		case '3':
			$temp = "Marzo";
			break;
		case '4':
			$temp = "Abril";
			break;
		case '5':
			$temp = "Mayo";
			break;
		case '6':
			$temp = "Junio";
			break;
		case '7':
			$temp = "Julio";
			break;
		case '8':
			$temp = "Agosto";
			break;
		case '9':
			$temp = "Septiembre";
			break;
		case '10':
			$temp = "Octubre";
			break;
		case '11':
			$temp = "Noviembre";
			break;
		case '12':
			$temp = "Diciembre";
			break;
		}
		return $temp;
	}	
	
}

?>
<?php 

class Fecha {
	private $ofecha;
	
	public function __construct() {
		$this->ofecha = null;
	}
	
	public function setFecha($fecha = null) {
		if ($fecha != null) {

			$this->ofecha = DateTime::createFromFormat('d/m/Y',$fecha);
		}
		else {
			$this->ofecha = null;
		}
	}
	public function getSetFecha($fecha = null) {
		if ($fecha != null) {
			$this->ofecha = new DateTime($fecha);
		}
		else {
			$this->ofecha = null;
		}
	} 
	public function getFecha() {
		if ($this->ofecha != null) {
			$d = $this->ofecha->format('d');
			$m = $this->ofecha->format('m');
			$Y = $this->ofecha->format('Y');
			
			//return $d."/".$m."/".$Y;
			return $this->ofecha->format('d/m/Y');
		}
		else return null;
	}
	public function getFechaSep($sep = "/") {
		if ($this->ofecha != null) {
			$d = $this->ofecha->format('d');
			$m = $this->ofecha->format('m');
			$Y = $this->ofecha->format('Y');
			return $d.$sep.$m.$sep.$Y;
		}
		else return null;
	}
	public function getFechaLong() {
		if ($this->ofecha != null) {
			$d = $this->ofecha->format('d');
			$m = $this->ofecha->format('m');
			$Y = $this->ofecha->format('Y');
			return $d." de ".$this->getMes()." de ".$Y;
		}
		else return null;
	}
	public function getAnio() {
		if ($this->ofecha != null) {
			$anio = $this->ofecha->format('Y');
			return $anio;
		}
		else return null;
	}
	public function getDia() {
		if ($this->ofecha != null) {
			$dia = $this->ofecha->format('d');
			return $dia;
		}
		else return null;
	}
	public function getMes() {
		if ($this->ofecha != null) {
			$m = $this->ofecha->format('m');
			$return = "";
			switch ($m) {
				case 1: 
					$return = "Enero";
					break;
				case 2:
					$return = "Febrero";
					break;
				case 3:
					$return = "Marzo";
					break;
				case 4:
					$return = "Abril";
					break;
				case 5:
					$return = "Mayo";
					break;
				case 6:
					$return = "Junio";
					break;
				case 7:
					$return = "Julio";
					break;
				case 8:
					$return = "Agosto";
					break;
				case 9:
					$return = "Septiembre";
					break;
				case 10:
					$return = "Octubre";
					break;
				case 11:
					$return = "Noviembre";
					break;
				case 12:
					$return = "Diciembre";
					break;
				default:
					$return = "";
					break;
			}
			return $return;
		}
		else return null;
	}
	public function getShortMes() {
		if ($this->ofecha != null) {
			$m = $this->ofecha->format('m');
			$return = "";
			switch ($m) {
				case 1:
					$return = "Ene";
					break;
				case 2:
					$return = "Feb";
					break;
				case 3:
					$return = "Mar";
					break;
				case 4:
					$return = "Abr";
					break;
				case 5:
					$return = "May";
					break;
				case 6:
					$return = "Jun";
					break;
				case 7:
					$return = "Jul";
					break;
				case 8:
					$return = "Ago";
					break;
				case 9:
					$return = "Sep";
					break;
				case 10:
					$return = "Oct";
					break;
				case 11:
					$return = "Nov";
					break;
				case 12:
					$return = "Dic";
					break;
				default:
					$return = "";
					break;
			}
			return $return;
		}
		else return null;
	}
	public function getEdad() {
		if ($this->ofecha != null) {
			//fecha actual
			$actual = new DateTime("NOW");
			$dia = $actual->format('d');
			$mes = $actual->format('m');
			$ano = $actual->format('Y');
			//fecha de nacimiento
			$d = $this->ofecha->format('d');
			$m = $this->ofecha->format('m');
			$Y = $this->ofecha->format('Y');
			//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
			if (($m == $mes) && ($d > $dia)) {
				$ano=($ano-1);
			}
			//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
			if ($m > $mes) {
				$ano=($ano-1);
			}
			//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
			$edad=($ano-$Y);
			return $edad;
		}
		else return null;
	}
	function getFechaCompleta() {
		$fecha = $this->ofecha->format('d/m/Y H:i:s');
		return $fecha;
	}
	function getForInsert() {
		if ($this->ofecha == null or $this->ofecha == "") {
			$fecha = null;
		}
		else {
			$fecha = $this->ofecha->format('Y/m/d H:i:s');
		}
		return $fecha;
	}
}

?>
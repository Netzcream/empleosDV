

<?php 
  header('Content-Type: text/html; charset=UTF-8');
  if (!isset($_SESSION)) {
  	session_start();
  }
include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php");

include_once($_SERVER["DOCUMENT_ROOT"]."/php/pdf/fpdf.php");

class PDF extends FPDF {
	private $Persona;

// Page header
function Header()
{
    // Logo
    $imagen = '../php/pdf/logo100.png';
    $this->Image($imagen,10,6,10);
    $nombre = $this->Persona->getApellido().", ".$this->Persona->getNombre();
	$this->SetTitle("Curriculum");
    // Arial bold 15
    $this->SetFont('Arial','I',11);
    // Calculate width of title and position
    $w = $this->GetStringWidth($nombre)+6;
    $this->SetX((210-$w)/2);
    // Colors of frame, background and text
    $this->SetTextColor(150,150,150);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(1);
    // Title
    $this->Cell($w,1,$nombre,0,0,'C');
    // Line break
    $this->Ln(10);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
}

function printBody() {
	

	
	$this->AliasNbPages();
	$this->AddPage();
	
	// Logo
	$imagen = "../".$this->Persona->getPic();
	$this->Image($imagen,95,20,20);
	/*
	$this->SetFont('Times','',12);
	$this->SetFillColor(230,230,0);
	$this->SetDrawColor(0,80,180);
	$this->Cell(0,10,'Printing line number 1',0,1);
	
	$this->Cell(0,10,'Printing line number 2',0,1);
	*/
	$this->Ln(25);	

	$this->getDatosPersonales();
	$this->getDomicilio();
	$this->getEstudios();

	$this->getExperiencia();
	$this->getTags();
	$this->getRecomendaciones();
	//$this->Seccion("Referencias");
}
function getEstudios() {
	if (sizeof($this->Persona->getAllEst()) > 0) {
		$this->Seccion("Estudios");
		$this->SetFont('Arial','',12);
		$this->SetFillColor(230,230,0);
		$temp = sizeof($this->Persona->getAllEst());
		
		foreach ($this->Persona->getAllEst() as $a) {
			$temp--;	
			$this->Cell(40,0,'Instituto:');
			$this->Cell(0,0,$a->getInstituto());
			$this->Ln(6);
			$this->Cell(40,0,'Titulo:');
			$this->Cell(0,0,$a->getTitulo());
			$this->Ln(6);
			$this->Cell(40,0,'Nivel:');
			$this->Cell(0,0,$a->getNivel()->getNivel());
			$this->Ln(6);
			
			
			$this->Cell(40,0,'Desde:');
			if ($a->getFechaDesde()->getDia() != null) {
				
				$this->Cell(0,0,$a->getFechaDesde()->getFecha());
			}
			else {
				$this->Cell(0,0,'No ingresado');
			}
			$this->Ln(6);
			$this->Cell(40,0,'Hasta:');
			if ($a->getFechaHasta()->getDia() != null) {
				$this->Cell(0,0,$a->getFechaHasta()->getFecha());
			}
			else {
				$this->Cell(0,0,'Presente');
			}
			$this->Ln(4);
			if ($temp > 0) { $this->breakline(); }
			else {
				$this->Ln(2);
			}
			
		}
	}
}


function getExperiencia() {
	if (sizeof($this->Persona->getAllWork()) > 0) {
		$this->Seccion("Experiencia Laboral");
		$this->SetFont('Arial','',12);
		$this->SetFillColor(230,230,0);
		$temp = sizeof($this->Persona->getAllWork());

		foreach ($this->Persona->getAllWork() as $a) {
			$temp--;
				
			$this->Cell(40,0,'Empresa:');
			$this->Cell(0,0,$a->getEmpresa());
			$this->Ln(6);
			$this->Cell(40,0,'Puesto:');
			
			$a->getSeniority()->getAndSetSeniorityById($a->getSeniority()->getId());
			$this->Cell(0,0,$a->getPuesto()." - (".$a->getSeniority()->getSeniority().")");
			$this->Ln(6);
			

				
				
			$this->Cell(40,0,'Periodo:');
			$fechas = "";
			if ($a->getFechaDesde()->getDia() != null) {

				$fechas = "Desde: ".$a->getFechaDesde()->getFecha()." - Hasta: ";
			}
			else {
				$fechas = "Desde: ".'No ingresado - Hasta: ';
			}

			if ($a->getFechaHasta()->getDia() != null) {
				$fechas .= $a->getFechaHasta()->getFecha();
			}
			else {
				$fechas .= 'Actualidad';
			}
			$this->Cell(0,0,$fechas);
			
			$this->Ln(6);
			$this->Cell(40,0,'Otros Datos:');
			$this->Ln(3);
			$this->SetFont('','I');
			$this->MultiCell(0,5,utf8_decode($a->getDesc()));			
			$this->Ln(4);
			if ($temp > 0) { $this->breakline(); }
			else {
				$this->Ln(2);
			}
				
		}
	}
}
function getTags() {
	$this->Persona->getTags()->getAndSetTagsByUsuario($this->Persona->getId());
	if (sizeof($this->Persona->getTags()->getTags()) > 0) {

		$this->Seccion("Tags");
		$this->SetFont('Arial','',12);
		$this->SetFillColor(230,230,0);

		$this->SetFont('','I');
		$tags = "";
		foreach ($this->Persona->getTags()->getTags() as $a) {
			if ($tags != "") {
				$tags .= " - ";	
			}
			$tags .= $a;
		}
		$this->MultiCell(0,5,utf8_decode($tags));
	}

	

}

function getDatosPersonales() {
	$this->Seccion("Datos Personales");
	
	$this->SetFont('Arial','',12);
	$this->SetFillColor(230,230,0);
	$this->Cell(40,0,'Apellido y Nombre:');
	$this->Cell(0,0,$this->Persona->getApellido().", ".$this->Persona->getNombre());
	$this->Ln(6);
	
	$this->Cell(40,0,$this->Persona->getDocumento()->getTipoDocumento().':');
	$this->Cell(0,0,$this->Persona->getDocumento()->getDocumento());
	$this->Ln(6);
	if ($this->Persona->getFechaNacClass()->getEdad() != "") {
		$this->Cell(40,0,'Edad:');
		$this->Cell(0,0,$this->Persona->getFechaNacClass()->getEdad()." años (".$this->Persona->getFechaNacClass()->getFecha().")");
		$this->Ln(6);
	}
	$this->Cell(40,0,'Email:');
	$this->Cell(0,0,$this->Persona->getEmail());
	$this->Ln(5);
}
function getRecomendaciones() {
	$sql = "SELECT M.CodMateria as materiaId, M.Materia as materia, P.*, ";
	$sql .= " PRA.id as idPRA, PRA.visible as visiblePRA ";
	$sql .= " FROM ProfesorRecomendacionAlumno PRA ";
	$sql .= " INNER JOIN Profesor P ON (P.CodUsuario=P.CodUsuario) ";
	$sql .= " INNER JOIN Materia M ON (M.CodMateria=PRA.CodMateria) ";
	$sql .= " WHERE PRA.estado=2 AND PRA.visible=1 AND PRA.codAlumno = ".$this->Persona->getId();
	$conex = new MySQL();
	$result3 = $conex->consulta($sql);
	$result4 = $conex->num_rows();
	if ($result4 > 0) {
		$this->Seccion("Profesores que recomiendan a ".$this->Persona->getNombre().", ".$this->Persona->getApellido());
		$result = $conex->fetch_assoc();
		while ($result) {
			$nombreProfesor = utf8_decode($result['Apellido'].", ".$result['Nombre']);
			$materia = utf8_decode($result['materia']);
			$nombreProfesor .= ", profesor de ".$materia;
			$this->SetFont('Arial','',12);
			$this->SetFillColor(230,230,0);
			$this->Cell(0,0,$nombreProfesor);
			$this->Ln(6);
			$result = $conex->fetch_assoc();
		}
 	}
}
function getDomicilio() {
	$this->Seccion("Domicilio");

	$this->SetFont('Arial','',12);
	$this->SetFillColor(230,230,0);
	$this->Cell(40,0,'Calle y Nro:');
	$calle = utf8_decode($this->Persona->getDomicilio()->getCalle());
	$numero = utf8_decode($this->Persona->getDomicilio()->getNum());
	$this->Cell(0,0,$calle." ".$numero);
	$this->Ln(6);

	if ($this->Persona->getDomicilio()->getPiso() != null) {
		$this->Cell(40,0,'Piso:');
		$this->Cell(0,0,$this->Persona->getDomicilio()->getPiso());
		$this->Ln(6);
	}
	if ($this->Persona->getDomicilio()->getDpto() != null) {
		$this->Cell(40,0,'Dpto:');
		$this->Cell(0,0,$this->Persona->getDomicilio()->getDpto());
		$this->Ln(6);
	}

	$localidad = utf8_decode($this->Persona->getDomicilio()->getLoc()->getLocalidad());
	
	$this->Cell(40,0,'Localidad:');
	$this->Cell(0,0,$localidad);
	$this->Ln(6);
	
	
	$provincia = utf8_decode($this->Persona->getDomicilio()->getLoc()->getProvincia()->getProvincia());
	
	$this->Cell(40,0,'Provincia:');
	$this->Cell(0,0,$provincia);
	$this->Ln(5);
}
function Seccion($label)
{
	// Arial 12
	$this->SetFont('Arial','B',12);
	// Background color
	$this->SetFillColor(200,200,200);
	// Title
	$this->Cell(0,6,$label,0,1,'L',true);
	// Line break
	$this->Ln(4);
}
function breakline()
{
	$this->SetFillColor(0,0,0);
	// Title
	$this->Cell(0,0,"",0,1,'L',true);
	// Line break
	$this->Ln(4);
}
function setPersona($id) {
	$this->Persona = new Persona();
	$this->Persona->getAndSetPersonaById($id);
}
}


//**************************************************************//

$cv = "";
if (isset($_GET['cv'])) {
	$cv = $_GET['cv'];
}

$Persona = new Persona();
if (isset($_SESSION["usr"])) {
	$Persona = unserialize (serialize ($_SESSION['usr']));
}
if ($Persona->getRol()->getId() == "EM" OR
	$Persona->getRol()->getId() == "PR" OR
	$Persona->getRol()->getId() == "AD" OR
	$Persona->getId() == $cv) {
		if ($cv != "") {
			$pdf = new PDF();
			$pdf->setPersona($cv);
			$pdf->printBody();
			$pdf->Output();
		}
		else {
			echo "No Autorizado";
			//LOGERROR
		}
	}
	else {
		echo "No Autorizado";
		//LOGERROR
	}
?>


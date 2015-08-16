<?php



header('Content-Type: text/html; charset=UTF-8');
header ('rel="shortcut icon" href="imagenes/logo/logo32.png"');

if (!isset($_SESSION)) { session_start(); }
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php"; }
if (!class_exists('Persona')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php"); }
if (!class_exists('Listado')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/listado.php";
}
$conex = new MySQL();
$minEdad = "";
$maxEdad = "";
$carrera = "";
$sexo = "";
$avance = "";
$tags = "";
$apellido = "";

if (isset($_POST['minEdad'])) {
	$fecha = date('Y-m-j');
	$maxEdad = date ( 'Y-m-j' ,strtotime ( '-'.$_POST['minEdad'].'year' , strtotime ( $fecha ) ) );
}
if (isset($_POST['maxEdad'])) {
	$fecha = date('Y-m-j');
	$minEdad = date ( 'Y-m-j' ,strtotime ( '-'.$_POST['maxEdad'].'year' , strtotime ( $fecha ) ) );
}

if (isset($_POST['carrera'])) {
	$top = 0;
	foreach ($_POST['carrera'] as $car) {
		if ($top > 0) {
			$carrera .= ",";
		} 
		$carrera .= "'".$car."'";
		$top++;
	}
}
if (isset($_POST['sexo'])) {
	$sexo = $_POST['sexo'];
	if ($sexo == "mf") {
		$sexo = '"m","f"';
	}
	else if ($sexo == "f") {
		$sexo = '"f"';
	}
	else if ($sexo == "m") {
		$sexo = '"m"';
	}
}
if (isset($_POST['avance'])) {
	$avance = $_POST['avance'];
}
if (isset($_POST['tags'])) {
	
	$top = 0;
	foreach ($_POST['tags'] as $car) {
		if ($top > 0) {
			$tags .= ",";
		}
		$tags .= "'".$car."'";
		$top++;
	}
}
if (isset($_POST['apellido'])) {
	$apellido = $_POST['apellido'];
}

$consulta = "SELECT A.CodUsuario as id FROM Alumno A";
$consulta .= " INNER JOIN usuario U ON (U.CodUsuario=A.CodUsuario)";
if ($carrera != "") {
	$consulta .= " INNER JOIN Alumnocarrera AC ON (A.ID_Alumno=AC.ID_Alumno)";
}
if ($tags != "") {
	$consulta .= " INNER JOIN usuarioTag UT ON (A.CodUsuario=UT.CodUsuario)";
	$consulta .= " INNER JOIN tag T ON (T.id=UT.tag_id)";
}
$consulta .= " WHERE (A.FechaNacimiento between '".$minEdad."' AND '".$maxEdad."' OR A.FechaNacimiento is null)";
$consulta .= " AND A.encontrarme = 1 AND A.Sexo in (".$sexo.") ";
$consulta .= " AND A.fechaBaja is null ";
$consulta .= " AND U.Estado = 3 ";
if ($carrera != "") {
	$consulta .= " AND AC.CodCarrera in (".$carrera.") AND AC.avance >= ".$avance;
}
if ($tags != "") {
	$consulta .= " AND T.tag in (".$tags.")";
}
if ($apellido != "") {
	$consulta .= " AND A.Apellido like ('%".$conex->escape($apellido)."%')";
}
$consulta .=" GROUP BY A.CodUsuario ORDER BY A.Apellido ASC,A.Nombre ASC ;";

$result1 = $conex->consulta($consulta);
$result = $conex->fetch_assoc();
$conPersonas = array();
while ($result) {
	$temp = new Persona();
	
	$conPersonas[] = $temp->getPersonaById($result['id']);
	$result = $conex->fetch_assoc();
}

$list = new Listado();
echo $list->getTable($conPersonas);

?>
<script>
$(document).ready(function() {
	hideWait();
});
</script>
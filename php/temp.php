<?php 

$sexo = $_POST['sexo'];
$fecha = date('Y-m-j');
$fechaMax = date ( 'Y-m-j' ,strtotime ( '-'.$_POST['minEdad'].'year' , strtotime ( $fecha ) ) );
$fechaMin = date ( 'Y-m-j' ,strtotime ( '-'.$_POST['maxEdad'].'year' , strtotime ( $fecha ) ) );

$apellido = "";
if (isset($_POST['apellido'])) {
	$apellido = $_POST['apellido'];
}
echo "PseudoSelect: <br>";
$query = "SELECT * FROM usuario u ";
/* *********** Sexo *********** */
if ($sexo == "m") {
	$query .= " AND u.Sexo = 'm' ";
}
else if ($sexo == "f") {
	$query .= " AND u.Sexo = 'f' ";
}
else {
	$query .= " AND (u.Sexo = 'm' OR u.Sexo = 'f') ";
}
/* *********** Edad *********** */

$query .= " AND (u.FechaNacimiento BETWEEN '".$fechaMin."' AND '".$fechaMax."' ) ";

/* *********** Apellido *********** */
if ($apellido != "") {
	$query .= " AND u.apellido LIKE '%".$apellido."%' ";
}

echo $query;
echo "<br>";
//echo count($_POST['carrera']);
echo "<br>";
//var_dump($_POST['tags']);
/*
array(6) { 
	["carrera"]=> string(16) "["AS","DG","VJ"]" 
	["avance"]=> string(2) "50" 
	["tags"]=> string(22) "["ActionScript","SQL"]" 

}
*/
/*
include_once 'conexMysql.php';
$conexionPrueba = new mysqli("localhost", "root","", "bolsadv");
$stmt = $conexionPrueba->prepare(" SELECT * FROM carrera WHERe CodCarrera='AS';");

$resultado = $stmt->execute();
echo $resultado['CodCarrera'];
*/
?>
<?php 

if (!isset($_SESSION)) {
	session_start();
}
$_SESSION['location'] = "home";
$provID = "1";
if (isset($_POST['provID'])) {
	$provID = $_POST['provID'];
}
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
	
$conex = new MySQL();

$consulta = "SELECT ID_Localidad as id, Localidad as loc FROM LOCALIDAD WHERE ID_Provincia=".$provID." order by loc ASC;";
$result = $conex->consulta($consulta);


$row = $conex->fetch_array();
while ($row) {
		
	$localidad[] = array($row['loc'], $row['id']);
	$row = $conex->fetch_array();
}
	

?>

				<select id="selLocDP" class="selDocDP">
				<?php 
				
				foreach ($localidad as $valor) {
					echo "<option value='".$valor[1]."'>".$valor[0]."</option>";
				}
				
				?>	
					</select>
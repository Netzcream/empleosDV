<?php 

if (!isset($_SESSION)) {
	session_start();
}
$_SESSION['location'] = "home";
$provID = "1";
if (isset($_POST['provID'])) {
	$provID = $_POST['provID'];
}
include_once("/conex.php");
	
$conex = new MySQL();

$consulta = "SELECT ID_Localidad as id, Localidad as loc FROM LOCALIDAD WHERE ID_Provincia=".$provID." order by loc ASC;";
$result = $conex->consulta($consulta);


$row = mysql_fetch_array($result, MYSQL_ASSOC);
while ($row) {
		
	$localidad[] = array(utf8_encode($row['loc']), $row['id']);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
}
	

?>

				<select id="selLocDP" class="selDocDP">
				<?php 
				
				foreach ($localidad as $valor) {
					echo "<option value='".$valor[1]."'>".$valor[0]."</option>";
				}
				
				?>	
					</select>
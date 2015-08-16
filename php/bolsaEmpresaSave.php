<?php
if (!isset($_SESSION)) {
	session_start();
}
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php'; }

		$idWork = $_SESSION["personaIdForWorks"];

		$sqlNTB = "SELECT B.id, TT.id as jornada, TT.descripcion, B.titulo, B.edadMin, B.edadMax, B.validaAdministrador, B.descripcion, B.conocimientos, B.software, B.otros, B.beneficios, B.sueldo,B.fechapubublicacion,B.mailContacto,B.contacto, ";
		$sqlNTB .= "(SELECT count(*) FROM AlumnoBolsa where bolsaId=B.id and estado=1) as postulados ";
		$sqlNTB .= "FROM Bolsa B ";
		$sqlNTB .= "INNER JOIN Usuario U ON (B.UsuarioId = U.CodUsuario) ";
		$sqlNTB .= "INNER JOIN tipotrabajo TT on (B.tipoTrabajoId=TT.id) ";
		$sqlNTB .= "WHERE B.fechaFinVigencia is null and usuarioId = ".$idWork." ORDER BY fechapubublicacion DESC;";



if (isset($_POST['accion'])) {

	if ($_POST['accion'] == 'a') {
		$titulo = $_POST['campo1'];
		$jornada = $_POST['campo2'];
		$edadMin = $_POST['campo3'];
		$edadMax = $_POST['campo4'];
		$sueldo = $_POST['campo5'];
		$desc = $_POST['campo6'];
		$mail = $_POST['campo7'];
		$cono = $_POST['campo8'];
		$soft = $_POST['campo9'];
		$benef = $_POST['campo10'];
		$otros = $_POST['campo11'];
		$id = $_SESSION["personaIdForWorks"];

		$sql = "INSERT INTO bolsa (usuarioId,tipoTrabajoId,titulo,edadMin,edadMax,descripcion,conocimientos,software,sueldo,mailContacto,contacto,beneficios,otros) ";
		$sql .= "values (".$id.",".$jornada.",'".$titulo."',".$edadMin.",".$edadMax.",'".$desc."','','".$soft."', ".$sueldo.",'".$mail."','','".$benef."','".$otros."');";
		$conex = new MySQL();
		$conex->consulta($sql);
		
	}
	else if ($_POST['accion'] == 'e') {
		$id = $_POST['campo1'];
		$sql = "UPDATE Bolsa SET FechaFinVigencia = NOW() WHERE id=".$id;
		$conex = new MySQL();
		$conex->consulta($sql);
	}



if ($_POST['accion'] == 'ed') {
		$titulo = $_POST['campo1'];
		$jornada = $_POST['campo2'];
		$edadMin = $_POST['campo3'];
		$edadMax = $_POST['campo4'];
		$sueldo = $_POST['campo5'];
		$desc = $_POST['campo6'];
		$mail = $_POST['campo7'];
		$cono = $_POST['campo8'];
		$soft = $_POST['campo9'];
		$benef = $_POST['campo10'];
		$otros = $_POST['campo11'];
		$idWork = $_POST['campoID'];
		$id = $_SESSION["personaIdForWorks"];



$sql = "UPDATE Bolsa set ";
$sql .= " tipoTrabajoId = ".$jornada.",";
$sql .= " titulo = '".$titulo."',";
$sql .= " edadMin = ".$edadMin.",";
$sql .= " edadMax = ".$edadMax.",";
$sql .= " descripcion = '".$desc."',";
$sql .= " software = '".$soft."',";
$sql .= " sueldo = ".$sueldo.",";
$sql .= " mailContacto = '".$mail."',";
$sql .= " beneficios = '".$benef."',";
$sql .= " otros  = '".$otros."'";
$sql .= " where id= ".$idWork;
$conex = new MySQL();
$conex->consulta($sql);
		
	}


	else {
	
	}

}

	$conex = new MySQL();
	$bolsas = array();
	$result1 = $conex->consulta($sqlNTB);
		if ($conex->num_rows() > 0) {
			$result = $conex->fetch_assoc();
			while ($result) {
				$bolsa = array();
				$bolsa['id'] = $result['id'];
				$bolsa['jornada'] = $result['jornada'];
				$bolsa['validaAdministrador'] = $result['validaAdministrador'];
				$bolsa['descripcion'] = $result['descripcion'];
				$bolsa['titulo'] = $result['titulo'];
				$bolsa['edadMin'] = $result['edadMin'];
				$bolsa['edadMax'] = $result['edadMax'];
				$bolsa['descripcion'] = $result['descripcion'];
				$bolsa['conocimientos'] = $result['conocimientos'];
				$bolsa['software'] = $result['software'];
				$bolsa['otros'] = $result['otros'];
				$bolsa['beneficios'] = $result['beneficios'];
				$bolsa['sueldo'] = $result['sueldo'];
				$bolsa['fechapubublicacion'] = $result['fechapubublicacion'];
				$bolsa['mailContacto'] = $result['mailContacto'];
				$bolsa['contacto'] = $result['contacto'];
				$bolsa['postulados'] = $result['postulados'];
				$bolsas[]= $bolsa;
				$result = $conex->fetch_assoc();
			}
		}
	$_SESSION["bolsas"] = $bolsas;

?>

<table class="listaTrabajos">
					<tr>
						<th>Puesto</th>
						<th style="width: 45px" title="Postulaciones">Post.</th>
						<th align=center>Estado</th>
						<th style="width: 45px">Editar</th>
						<th style="width: 45px">Borrar</th>
						<th style="width: 45px">Ver</th>
					</tr>
					<?php
						if (isset($_SESSION["bolsas"] )) {
						foreach ($_SESSION["bolsas"] as $value) {
							echo "<tr>";
							echo "<td><span class='listTituloEmpresa'>".$value['titulo']."</span>";
							echo "<span class='listDescripcion'>".$value['descripcion']."</span>";
							echo "</td>";

							echo "<td align=center><span class='listCantPost'>".$value['postulados']."</span></td>";
							if ($value['validaAdministrador'] == "1") {
								echo "<td title='Autorizado' align=center><img alt='' src='imagenes/iconos/check.png' width='20'></td>";
							}

							else if ($value['validaAdministrador'] == "2") {
								echo "<td title='Rechazado' align=center><img alt='' src='imagenes/iconos/rechazo.png' width='20'></td>";
							}
							else if ($value['validaAdministrador'] == "0") {
								echo "<td title='Pendiente' align=center><img alt='' src='imagenes/iconos/wait.png' width='20'></td>";
							}
							echo "<td align=center>";
							if ($value['validaAdministrador'] != "2" && $value['validaAdministrador'] != "1") {
								echo "<div class='btnCuadrado aceptar' onclick='editWork(".$value['id'].")' title='Editar'><img alt='' src='imagenes/iconos/edit.png' width='15'></div>";
							}
							echo "</td>";
							echo "<td align=center>";
							echo "<div class='btnCuadrado cancelar' onclick='delWork(".$value['id'].")'  title='Eliminar'><img alt='' src='imagenes/iconos/cross_blanco.png' width='15'></div>";
							echo "</td>";
							echo "<td align=center>";
							if ($value['validaAdministrador'] != "2") {
								echo "<div class='btnCuadrado ver' onclick='listAlumnosWork(".$value['id'].")' title='Ver postulaciones'><img alt='' src='imagenes/iconos/view.png' width='15'></div>";
							}
							echo "</td>";

							echo "</tr>";
						}
						}
					?>
				</table>
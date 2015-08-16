<?php
if (!isset($_SESSION)) {
	session_start();
}
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php'; }


	$campo1 = "";
	$campo2 = "";
	$campo3 = "";
	$campo4 = "";
	$campo5 = "";
	$campo6 = "";
	$campo7 = "";
	$campo8 = "";
	$campo9 = "";
	$campo10 = "";
	$campo11 = "";
	$idWork2 = "";

		$idWork = $_SESSION["personaIdForWorks"];

		$sqlNTB = "SELECT E.NombreEmpresa as nombre, B.id, TT.id as jornada, TT.descripcion as descjor, B.titulo, B.edadMin, B.edadMax, B.validaAdministrador, B.descripcion, B.conocimientos, B.software, B.otros, B.beneficios, B.sueldo,B.fechapubublicacion,B.mailContacto,B.contacto, ";
		$sqlNTB .= "(SELECT count(*) FROM AlumnoBolsa where bolsaId=B.id and estado=1) as postulados ";
		$sqlNTB .= "FROM Bolsa B ";
		$sqlNTB .= "INNER JOIN Usuario U ON (B.UsuarioId = U.CodUsuario) ";
		$sqlNTB .= "INNER JOIN Empresa E ON (U.CodUsuario = E.CodUsuario) ";
		$sqlNTB .= "INNER JOIN tipotrabajo TT on (B.tipoTrabajoId=TT.id) ";
		$sqlNTB .= "WHERE B.fechaFinVigencia is null and validaAdministrador = 1 ";
		$sqlNTB .= "AND B.id IN (SELECT bolsaId FROM AlumnoBolsa WHERE AlumnoId = ".$_SESSION["personaIdForWorks"]." ) ";
		$sqlNTB .= " ORDER BY fechapubublicacion ASC;";



if (isset($_POST['accion'])) {

	if ($_POST['accion'] == 'post') {
		$SQL = "INSERT INTO AlumnoBolsa (bolsaId,AlumnoId) VALUES (".$_POST['id'].",".$_SESSION["personaIdForWorks"].")";
		$conex = new MySQL();
		$conex->consulta($SQL);
	}
	if ($_POST['accion'] == 'auth') {
		$SQL = "UPDATE Bolsa SET validaAdministrador = 1 WHERE id=".$_POST['id'];
		$conex = new MySQL();
		$conex->consulta($SQL);
	}
	if ($_POST['accion'] == 'rech') {
		$SQL = "UPDATE Bolsa SET validaAdministrador = 2 WHERE id=".$_POST['id'];
		$conex = new MySQL();
		$conex->consulta($SQL);
	}
	else if ($_POST['accion'] == 'e') {
		$id = $_POST['campo1'];
		$sql = "UPDATE Bolsa SET FechaFinVigencia = NOW() WHERE id=".$id;
		$conex = new MySQL();
		$conex->consulta($sql);
	}



if ($_POST['accion'] == 'ed') {



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
				$bolsa['nombre'] = $result['nombre'];
				$bolsa['descJor'] = $result['descjor'];
				$bolsas[]= $bolsa;
				$result = $conex->fetch_assoc();
			}
		}
	$_SESSION["bolsas"] = $bolsas;
if ($_POST['accion'] != "preview") {
?>

<table class="listaTrabajos">
					<tr>
						<th>Puesto</th>
						<th style="width: 45px" title="Postulaciones">Post.</th>
						<th>Ver</th>
					</tr>
					<?php
						if (isset($_SESSION["bolsas"] )) {
						foreach ($_SESSION["bolsas"] as $value) {
							echo "<tr>";
							echo "<td><span class='listTituloEmpresa'>".$value['nombre']."</span> - <span class='listCargo'>".$value['titulo']."</span>";
							echo "<span class='listDescripcion'>".$value['descripcion']."</span>";
							echo "</td>";

echo "<td align=center><span class='listCantPost'>".$value['postulados']."</span></td>";

							echo "<td align=center><div class='btnCuadrado ver' onclick='previewWork(".$value['id'].")' title='Ver Detalle'><img alt='' src='imagenes/iconos/view.png' width='15'></div></td>";

							echo "</tr>";
						}
						}
					?>
				</table>


				<?php 
			} 
			else {


		$bolsa = array();
		$id = $_POST['campo1'];

		if (isset($_SESSION["bolsas"] )) {
			foreach ($_SESSION["bolsas"] as $value) {
				if ($value['id'] == $id) {
					$bolsa = $value;
				}
			}
			$campo1 = $bolsa['titulo'];
			$campo2 = $bolsa['descJor'];
			$campo3 = $bolsa['edadMin'];
			$campo4 = $bolsa['edadMax'];
			$campo5 = $bolsa['sueldo'];
			$campo6 = $bolsa['descripcion'];
			$campo7 = $bolsa['mailContacto'];
			$campo8 = $bolsa['conocimientos'];
			$campo9 = $bolsa['software'];
			$campo10 = $bolsa['beneficios'];
			$campo11 = $bolsa['otros'];
		}
?>

<div id="mibolsa" class="thingsConteiner5">
<div class="rowWork">	
	<span class="labelWork">Titulo:</span> 
	<span class="dataWork"><?= $campo1 ?></span>
</div>
<div class="rowWork">	
	<span class="labelWork">Jornada:</span> 
	<span class="dataWork"><?= $campo2 ?></span>
</div>
<?php 
if ($campo3 != "" or $campo4 != "") {
?>
<div class="rowWork">	
	<span class="labelWork">Rango Edad:</span> 
	<?php 
	if ($campo3 != "" and $campo4 != "") {
	?>
		<span class="dataWork">entre <?= $campo3 ?> y <?= $campo4 ?> años</span>
	<?php 
	}
	?>

	<?php 
	if ($campo3 != "" and $campo4 == "") {
	?>
		<span class="dataWork">desde <?= $campo3 ?> años</span>
	<?php 
	}
	?>
	<?php 
	if ($campo3 == "" and $campo4 != "") {
	?>
		<span class="dataWork">hasta <?= $campo4 ?> años</span>
	<?php 
	}
	?>
</div>
<?php 
}
?>

<?php 
if ($campo5 != "") {
?>
<div class="rowWork">	
<span class="labelWork">Sueldo Estimado:</span> 
<span class="dataWork"> $ <?= $campo5 ?></span>
</div>

<?php 
}
?>
<?php 
if ($campo6 != "") {
?>
<div class="rowWork">	
<span class="labelWork">Descripcion:</span> 
<span class="dataWork"><?= $campo6 ?></span>
</div>
<?php 
}
?>
<?php 
if ($campo8 != "") {
?>
<div class="rowWork">	
	<span class="labelWork">Conocimientos:</span> 
	<span class="dataWork"><?= $campo8 ?></span>
</div>
<?php 
}
?>
<?php 
if ($campo9 != "") {
?>
<div class="rowWork">	
<span class="labelWork">Software:</span> 
<span class="dataWork"><?= $campo9 ?></span>
</div>
<?php 
}
?>
<?php 
if ($campo10 != "") {
?>
<div class="rowWork">	
<span class="labelWork">Beneficios:</span> 
<span class="dataWork"><?= $campo10 ?></span>
</div>
<?php 
}
?>
<?php 
if ($campo11 != "") {
?>
<div class="rowWork">	
<span class="labelWork">Otros Datos:</span>
<span class="dataWork"><?= $campo11 ?></span>
</div>
<?php 
}
?>
<?php 
if ($campo7 != "") {
?>
<div class="rowWork">	
<span class="labelWork">Contacto:</span>
<span class="dataWork"> <?= $campo7 ?></span>
</div>
<?php 
}
?>

</div>
<?php

			}
				?>
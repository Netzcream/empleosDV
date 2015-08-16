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

		$sqlNTB = "SELECT E.NombreEmpresa as nombre, B.id, TT.id as jornada, TT.descripcion, B.titulo, B.edadMin, B.edadMax, B.validaAdministrador, B.descripcion, B.conocimientos, B.software, B.otros, B.beneficios, B.sueldo,B.fechapubublicacion,B.mailContacto,B.contacto, ";
		$sqlNTB .= "(SELECT count(*) FROM AlumnoBolsa where bolsaId=B.id and estado=1) as postulados ";
		$sqlNTB .= "FROM Bolsa B ";
		$sqlNTB .= "INNER JOIN Usuario U ON (B.UsuarioId = U.CodUsuario) ";
		$sqlNTB .= "INNER JOIN Empresa E ON (U.CodUsuario = E.CodUsuario) ";
		$sqlNTB .= "INNER JOIN tipotrabajo TT on (B.tipoTrabajoId=TT.id) ";
		$sqlNTB .= "WHERE B.fechaFinVigencia is null and validaAdministrador = 0 ORDER BY fechapubublicacion ASC;";



if (isset($_POST['accion'])) {

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
						<th>Ver</th>
						<th>Acciones</th>
					</tr>
					<?php
						if (isset($_SESSION["bolsas"] )) {
						foreach ($_SESSION["bolsas"] as $value) {
							echo "<tr>";
							echo "<td><span class='listTituloEmpresa'>".$value['nombre']."</span> - <span class='listCargo'>".$value['titulo']."</span>";
							echo "<span class='listDescripcion'>".$value['descripcion']."</span>";
							echo "</td>";



							echo "<td align=center><div class='btnCuadrado ver' onclick='previewWork(".$value['id'].")' title='Ver Detalle'><img alt='' src='imagenes/iconos/view.png' width='15'></div></td>";

							echo "<td class='listAccion2' align=center>";

							echo "<div class='btnCuadrado aceptar' onclick='autorizarWork(".$value['id'].")' title='Autorizar'><img alt='' src='imagenes/iconos/check_blanco.png' width='15'></div>";
							echo "<div class='btnCuadrado cancelar' onclick='denegarWork(".$value['id'].")'  title='Denegar'><img alt='' src='imagenes/iconos/cross_blanco.png' width='15'></div>";
							echo "</td>";

							echo "</tr>";
						}
						}
					?>
				</table>
				<script>
function autorizarWork(id) {
	var confirmar = confirm("Confirme que desea autorizar la publicacion");
	if (confirmar == true) {
		$('#mibolsa').load('php/bolsaAdminAcciones.php', {accion : 'auth', id: id });
	}
	else {
		return (false);
	}
}

function denegarWork(id) {
	var confirmar = confirm("Confirme que desea rechazar la publicacion");
	if (confirmar == true) {
		$('#mibolsa').load('php/bolsaAdminAcciones.php', {accion : 'rech', id: id });
	}
	else {
		return (false);
	}
}

				</script>

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
			$campo2 = $bolsa['jornada'];
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
<table class="tablaDeEmergencia">
<tr>
	<td>
		<span>Titulo</span>

		<input readonly id="campo1" class="inputFillDP" value="<?= $campo1 ?>" type="text" placeholder="Ej. Diseñador" maxlength="100">
	</td>

		<td><span>Jornada</span>

				<SELECT disabled id="campo2">
					<!-- Se Hardcodea por falta de tiempo -->
					<option value=2 <?php if ($campo2 == 2) echo "selected"; ?>>Full Time</option>
					<option value=1 <?php if ($campo2 == 1) echo "selected"; ?>>Part Time</option>
					<option value=3 <?php if ($campo2 == 3) echo "selected"; ?>>Desde casa</option>
					<option value=4 <?php if ($campo2 == 4) echo "selected"; ?>>Por turnos</option>
					<option value=5 <?php if ($campo2 == 5) echo "selected"; ?>>Nocturno</option>

				</SELECT>

	</td>
</tr>


<tr>
	<td>
		<table class="tablaDeEmergencia">
			<tr>
				<td>
					<span>Edad Minima</span>
				</td>
				<td>
					<span>Edad Maxima</span>
				</td>
			</tr>
			<tr>
				<td>
					<input readonly id="campo3" value="<?= $campo3 ?>" class="inputFillDP" type="text" maxlength="2" onKeyPress="return acceptNum(event)" style="width: 80px; text-align: center;">
				</td>
				<td>
					<input readonly id="campo4" value="<?= $campo4 ?>" class="inputFillDP"  type="text"  onKeyPress="return acceptNum(event)" maxlength="2" style="width: 80px; text-align: center;" >
				</td>
			</tr>
		</table>
	</td>
<td><span>Sueldo estimado</span><input readonly id="campo5" value="<?= $campo5 ?>" class="inputFillDP" onKeyPress="return acceptNum(event)" type="text" maxlength="10" placeholder="15000"></td>
</tr>

<tr>
	<td><span>Descripcion breve</span><input readonly id="campo6" value="<?= $campo6 ?>" class="inputFillDP" type="text" placeholder="Ej. Se solicita..." maxlength="2500"></td>
		<td><span>Mail contacto</span><input readonly id="campo7" value="<?= $campo7 ?>" class="inputFillDP" type="email" placeholder="info@empresa.com.ar" maxlength="2500"></td>
</tr>
<tr>
	<td><span>Conocimientos</span><textarea readonly id="campo8"><?= $campo8 ?></textarea></td>
	<td><span>Software</span><textarea readonly id="campo9"><?= $campo9 ?></textarea></td>
</tr>
<tr>
	<td><span>Beneficios</span><textarea readonly id="campo10"><?= $campo10 ?></textarea></td>
	<td><span>Otros Datos</span><textarea readonly id="campo11"><?= $campo11 ?></textarea></td>
</tr>
</table>
<?php

			}
				?>
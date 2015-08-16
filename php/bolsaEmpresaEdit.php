<?php
	if (!isset($_SESSION)) { session_start(); }
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
	$idWork = "";
	if (isset($_POST['accion'])) {

	if ($_POST['accion'] == 'e') {
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
			$idWork = $bolsa['id'];
		}
	}
}


?>


<table class="tablaDeEmergencia">
<tr>
	<td>
		<span>Titulo</span>

		<input id="campo1" class="inputFillDP" value="<?= $campo1 ?>" type="text" placeholder="Ej. Diseñador" maxlength="100">
	</td>

		<td><span>Jornada</span>

				<SELECT id="campo2">
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
					<input id="campo3" value="<?= $campo3 ?>" class="inputFillDP" type="text" maxlength="2" onKeyPress="return acceptNum(event)" style="width: 80px; text-align: center;">
				</td>
				<td>
					<input id="campo4" value="<?= $campo4 ?>" class="inputFillDP"  type="text"  onKeyPress="return acceptNum(event)" maxlength="2" style="width: 80px; text-align: center;" >
				</td>
			</tr>
		</table>
	</td>
<td><span>Sueldo estimado</span><input id="campo5" value="<?= $campo5 ?>" class="inputFillDP" onKeyPress="return acceptNum(event)" type="text" maxlength="10" placeholder="15000"></td>
</tr>

<tr>
	<td><span>Descripcion breve</span><input id="campo6" value="<?= $campo6 ?>" class="inputFillDP" type="text" placeholder="Ej. Se solicita..." maxlength="2500"></td>
		<td><span>Mail contacto</span><input id="campo7" value="<?= $campo7 ?>" class="inputFillDP" type="email" placeholder="info@empresa.com.ar" maxlength="2500"></td>
</tr>
<tr>
	<td><span>Conocimientos</span><textarea id="campo8"><?= $campo8 ?></textarea></td>
	<td><span>Software</span><textarea id="campo9"><?= $campo9 ?></textarea></td>
</tr>
<tr>
	<td><span>Beneficios</span><textarea id="campo10"><?= $campo10 ?></textarea></td>
	<td><span>Otros Datos</span><textarea id="campo11"><?= $campo11 ?></textarea></td>
</tr>
</table>
<input type="hidden" id="idWork" value="<?=$idWork?>"/>
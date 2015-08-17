<?php
if (!isset($_SESSION)) {
	session_start();
}
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php'; }

		$idWork = $_SESSION["personaIdForWorks"];

		$sqlNTB = "SELECT * FROM Materia M WHERE M.CodCarrera='".$_POST['campo1']."'";

if (isset($_POST['accion'])) {

		if ($_POST['accion'] == "enable") {

			$sql = "UPDATE materia SET Activo = 1 WHERE CodMateria='".$_POST['campo2']."'";
		$conex = new MySQL();
		$conex->consulta($sql);
		}
		else if ($_POST['accion'] == "disable") {
			$sql = "UPDATE materia SET Activo = 0 WHERE CodMateria='".$_POST['campo2']."'";
		$conex = new MySQL();
		$conex->consulta($sql);
		}

	}


?>

<table class="listaTrabajos">
					<tr>
						<th style="width: 45px">Codigo</th>
						<th >Materia</th>
						<th >Acciones</th>
					</tr>
					<?php


						$conex = new MySQL();
						$materias = array();
						$result1 = $conex->consulta($sqlNTB);

		if ($conex->num_rows() > 0) {
			$result = $conex->fetch_assoc();
			while ($result) {
				$materia = array();

				$materia['id'] = $result['CodMateria'];
				$materia['carrera'] = $result['CodCarrera'];
				$materia['descripcion'] = $result['Materia'];
				$materia['activo'] = $result['Activo'];

				$materias[]= $materia;
				$result = $conex->fetch_assoc();
			}
			$_SESSION["materias"] = $materias;
		}

						if (isset($_SESSION["materias"] )) {
						foreach ($_SESSION["materias"] as $value) {
							echo "<tr>";
							echo "<td><span class='listTituloEmpresa'>".$value['id']."</span>";
							
							echo "</td>";

							echo "<td>";
							echo "<span class='listDescripcion2'>".$value['descripcion']."</span>";
							echo "</td>";

							
							echo "<td align=center>";

							if ($value['activo'] == "1") {
							echo "<div class='btnCuadrado cancelar' onclick='disableMateria(".'"'.$value['id'].'"'.",".'"'.$value['carrera'].'"'.")'  title='Deshabilitar'><img alt='' src='imagenes/iconos/cross_blanco.png' width='15'></div>";
							}
							else {
							echo "<div class='btnCuadrado aceptar' onclick='enableMateria(".'"'.$value['id'].'"'.",".'"'.$value['carrera'].'"'.")'  title='Habilitar'><img alt='' src='imagenes/iconos/check_blanco.png' width='15'></div>";
							}
							echo "<div class='btnCuadrado ver' onclick='editProfesores(".'"'.$value['id'].'"'.",".'"'.$value['carrera'].'"'.")' title='Editar'><img alt='' src='imagenes/iconos/edit.png' width='15'></div>";
							echo "</td>";


							echo "</tr>";
						}
						}
					?>
				</table>
				<script>
function disableMateria(id,carrera) {
	var temp = id;
	var confirmar = confirm("Esta seguro que desea deshabilitar la materia?");
	if (confirmar == true) {
		$('#editDeEmergencia').load('php/adminABMMateriasAccion.php', { accion: "disable", campo1 : carrera, campo2: id });
	}
	else return;

}
function enableMateria(id,carrera) {
	var temp = id;
	var confirmar = confirm("Esta seguro que desea habilitar la materia?");
	if (confirmar == true) {
		$('#editDeEmergencia').load('php/adminABMMateriasAccion.php', { accion: "enable", campo1 : carrera, campo2: id });
	}
	else return;
}
function editProfesores(id,carrera) {
	$('#workBtn2').show();
	$('#titleEditWork2').html("Editar Profesores");
	$('#editDeEmergencia2').load('php/adminABMProfesoresAccion.php', { accion: "materias", campo1 : id, campo2: carrera });
	showEditBolsa2();
}

				</script>
<?php
if (!isset($_SESSION)) {
	session_start();
}
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php'; }
		$idWork = $_SESSION["personaIdForWorks"];
		$materia = $_POST['campo1'];
		$sqlNTB = "SELECT P.*, PM.CodMateria FROM Profesor P ";
		$sqlNTB .= " LEFT JOIN profesorMateria PM ON (PM.ID_Profesor=P.ID_Profesor and PM.CodMateria='".$materia."') ";

if (isset($_POST['accion'])) {

		if ($_POST['accion'] == "enable") {

			$sql = "INSERT INTO profesorMateria (ID_Profesor,CodMateria) VALUES (".$_POST['campo2'].",'".$materia."')";
			$conex = new MySQL();
			$conex->consulta($sql);
		}
		else if ($_POST['accion'] == "disable") {
			$sql = "DELETE FROM profesorMateria WHERE ID_Profesor=".$_POST['campo2']." AND CodMateria ='".$materia."'";
			$conex = new MySQL();
			$conex->consulta($sql);
		}

	}


?>

<table class="listaTrabajos">
					<tr>
						<th style="width: 45px">Materia</th>
						<th >Profesor</th>
						<th >Estado</th>
						<th >Accion</th>
					</tr>
					<?php


						$conex = new MySQL();
						$profesors = array();
						$result1 = $conex->consulta($sqlNTB);

		if ($conex->num_rows() > 0) {
			$result = $conex->fetch_assoc();
			while ($result) {
				$profesor = array();

				$profesor['esProfesor'] = $result['CodMateria'];
				$profesor['apellido'] = $result['Apellido'];
				$profesor['nombre'] = $result['Nombre'];
				$profesor['id'] = $result['ID_Profesor'];

				$profesors[]= $profesor;
				$result = $conex->fetch_assoc();
			}
			$_SESSION["profesores"] = $profesors;
		}

						if (isset($_SESSION["profesores"] )) {
						foreach ($_SESSION["profesores"] as $value) {
							echo "<tr>";
							echo "<td><span class='listTituloEmpresa'>".$materia."</span>";
							
							echo "</td>";

							echo "<td>";
							echo "<span class='listDescripcion2'>".$value['apellido'].", ".$value['nombre']."</span>";
							echo "</td>";
echo "<td align=center>";
if ($value['esProfesor'] == $materia) {
	echo "Asignado";
}
else {
echo "Sin Asignar";
}
echo "</td>";						
							echo "<td align=center>";

							if ($value['esProfesor'] == $materia) {
							echo "<div class='btnCuadrado cancelar' onclick='disableProfesor(".'"'.$value['id'].'"'.",".'"'.$materia.'"'.")'  title='Deshabilitar'><img alt='' src='imagenes/iconos/cross_blanco.png' width='15'></div>";
							}
							else {
							echo "<div class='btnCuadrado aceptar' onclick='enableProfesor(".'"'.$value['id'].'"'.",".'"'.$materia.'"'.")'  title='Habilitar'><img alt='' src='imagenes/iconos/check_blanco.png' width='15'></div>";
							}
							echo "</td>";


							echo "</tr>";
						}
						}
					?>
				</table>
				<script>
function disableProfesor(id,materia) {
	var temp = id;
	var confirmar = confirm("Esta seguro que desea deshabilitar al profesor?");
	if (confirmar == true) {
		$('#editDeEmergencia2').load('php/adminABMProfesoresAccion.php', { accion: "disable", campo1 : materia, campo2: id });
	}
	else return;

}
function enableProfesor(id,materia) {
	var temp = id;
	var confirmar = confirm("Esta seguro que desea habilitar Profesor?");
	if (confirmar == true) {
		$('#editDeEmergencia2').load('php/adminABMProfesoresAccion.php', { accion: "enable", campo1 : materia, campo2: id });
	}
	else return;
}

				</script>
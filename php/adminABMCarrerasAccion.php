<?php
if (!isset($_SESSION)) {
	session_start();
}
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php'; }

		$idWork = $_SESSION["personaIdForWorks"];

		$sqlNTB = "SELECT *, (SELECT count(*) FROM Materia M WHERE C.CodCarrera=M.CodCarrera and M.activo=1) as materias FROM CARRERA C;";

if (isset($_POST['accion'])) {

		if ($_POST['accion'] == "enable") {
			$sql = "UPDATE Carrera SET Activo = 1 WHERE CodCarrera='".$_POST['campo1']."'";
		$conex = new MySQL();
		$conex->consulta($sql);
		}
		else if ($_POST['accion'] == "disable") {
			$sql = "UPDATE Carrera SET Activo = 0 WHERE CodCarrera='".$_POST['campo1']."'";
		$conex = new MySQL();
		$conex->consulta($sql);
		}

	}


?>

<table class="listaTrabajos">
					<tr>
						<th style="width: 45px">Codigo</th>
						<th >Carrera</th>
						<th align=center>Materias</th>
						<th >Acciones</th>
					</tr>
					<?php


						$conex = new MySQL();
						$carreras = array();
						$result1 = $conex->consulta($sqlNTB);

		if ($conex->num_rows() > 0) {
			$result = $conex->fetch_assoc();
			while ($result) {
				$carrera = array();

				$carrera['id'] = $result['CodCarrera'];
				$carrera['descripcion'] = $result['Descripcion'];
				$carrera['activo'] = $result['Activo'];
				$carrera['materias'] = $result['materias'];

				$carreras[]= $carrera;
				$result = $conex->fetch_assoc();
			}
			$_SESSION["carreras"] = $carreras;
		}

						if (isset($_SESSION["carreras"] )) {
						foreach ($_SESSION["carreras"] as $value) {
							echo "<tr>";
							echo "<td><span class='listTituloEmpresa'>".$value['id']."</span>";
							
							echo "</td>";

							echo "<td>";
							echo "<span class='listDescripcion2'>".$value['descripcion']."</span>";
							echo "</td>";

							echo "<td align=center><span class='listCantPost'>".$value['materias']."</span></td>";
							
							echo "<td align=center>";

							if ($value['activo'] == "1") {
							echo "<div class='btnCuadrado cancelar' onclick='disableCareer(".'"'.$value['id'].'"'.")'  title='Deshabilitar'><img alt='' src='imagenes/iconos/cross_blanco.png' width='15'></div>";
							}
							else {
							echo "<div class='btnCuadrado aceptar' onclick='enableCareer(".'"'.$value['id'].'"'.")'  title='Habilitar'><img alt='' src='imagenes/iconos/check_blanco.png' width='15'></div>";
							}
							echo "<div class='btnCuadrado ver' onclick='editCarrera(".'"'.$value['id'].'"'.")' title='Editar'><img alt='' src='imagenes/iconos/edit.png' width='15'></div>";
							echo "</td>";


							echo "</tr>";
						}
						}
					?>
				</table>
				<script>

				</script>
<?php
if (!isset($_SESSION)) {
	session_start();
}
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php'; }
		$idWork = $_SESSION["personaIdForWorks"];
		$idProf = $_SESSION["profIdForWorks"];
		$sqlNTB = "	SELECT M.CodMateria as materiaId, M.CodCarrera as carrera, M.Materia as materia, P.*, ";
		$sqlNTB .= " PRA.id as idPRA, PRA.visible as visiblePRA ";
		$sqlNTB .= " FROM ProfesorRecomendacionAlumno PRA ";
		$sqlNTB .= " INNER JOIN Profesor P ON (P.CodUsuario=P.CodUsuario) ";
		$sqlNTB .= " INNER JOIN Materia M ON (M.CodMateria=PRA.CodMateria) ";
		$sqlNTB .= " WHERE PRA.estado=2 AND PRA.codAlumno = ".$idWork;


//echo $sqlNTB;

if (isset($_POST['accion'])) {

	
	if ($_POST['accion'] == "visible") {
		$a = $_POST['visible'];
		$m = $_POST['idPra'];
		if ($a == "0") { $a = "1"; }
		else { $a = "0"; }
		$sql = "UPDATE ProfesorRecomendacionAlumno set visible = ".$a." WHERE id=".$m.";";
		$conex = new MySQL();
		$conex->consulta($sql);
	}
}


?>

<table class="listaTrabajos">
					<tr>
						
						<th >Profesor/Materia</th>
						<th >Estado</th>
						<th >Visible</th>
					</tr>
					<?php
						$conex = new MySQL();
						$profesors = array();
						$result1 = $conex->consulta($sqlNTB);

		if ($conex->num_rows() > 0) {
			$result = $conex->fetch_assoc();
			while ($result) {
				$profesor = array();
				$profesor['apellido'] = $result['Apellido'];
				$profesor['nombre'] = $result['Nombre'];
				$profesor['id'] = $result['CodUsuario'];
				$profesor['idPra'] = $result['idPRA'];
				$profesor['visible'] = $result['visiblePRA'];
				$profesor['codmateria'] = $result['materiaId'];
				$profesor['materia'] = $result['materia'];
				$profesor['carrera'] = $result['carrera'];

				$profesors[]= $profesor;
				$result = $conex->fetch_assoc();
			}
			$_SESSION["profesores"] = $profesors;
		}
		$separemosCarreras = "";
		$separemosMaterias = "";

						if (isset($_SESSION["profesores"] )) {
						foreach ($_SESSION["profesores"] as $value) {
							$codigoMateria = $value['codmateria'];
							$idPra = $value['idPra'];
							$visible = $value['visible'];
							$carrera = $value['carrera'];
							$materia = $value['codmateria']." - ".$value['materia'];
							$profesor = $value['apellido'].", ".$value['nombre'];
						

							if ($carrera != $separemosCarreras and $separemosCarreras == "") {
								$separemosCarreras = $carrera;
							}
							if ($carrera != $separemosCarreras) {
								echo "<tr><td colspan='2' style='height: 3px; background-color: #063049;'></td></tr>";
								$separemosCarreras = $carrera;
							}

							else if ($codigoMateria != $separemosMaterias and $separemosMaterias == "") {
								$separemosMaterias = $codigoMateria;
							}
							else if ($codigoMateria != $separemosMaterias) {
								echo "<tr><td colspan='2' style='height: 1px; background-color: #666;'></td></tr>";
								$separemosMaterias = $codigoMateria;
							}


							echo "<tr>";
							//echo "<td align='center'><span class='listTituloEmpresa'>".$carrera."</span></td>";

							echo "<td class='needMargin'>";
							echo "<span class='listTituloEmpresa'>".$profesor."</span>";
							echo "<span class='listDescripcion'>".$materia."</span>";
							
							echo "</td>";
							/*
							Estados:
							null o 0: No solicitado
							1: solicitud pendiente
							2: recomendado
							3: rechazado
							*/
							echo "<td align='center' style='width: 60px; font-weight: bold; font-size: 0.8em;'>";

							if ($visible == "0") {
								echo "No visible";
							}
							else {
								echo "Visible";
							}
							echo "</td>";


							echo "<td align='center' style='font-size: 0.7em;'>";

						if ($visible == "0") {
							echo "<div class='btnCuadrado blanco' onclick='verReco(".$idPra.",".$visible.");'  title='Solicitar Recomendacion'><img alt='' src='imagenes/iconos/ojo_cerrado.png' width='15'></div>";
						}
						else {
							echo "<div class='btnCuadrado blanco' onclick='verReco(".$idPra.",".$visible.");'  title='Solicitar Recomendacion'><img alt='' src='imagenes/iconos/ojo_abierto.png' width='15'></div>";
						}

							

							echo "</td>";
				
							echo "</tr>";
	
						}
					}
					?>
				</table>
				<script>
				function verReco(idPra,visible) {
					$('#mibolsa').load('php/alumnoRecomendacionesAccion.php',{ accion: 'visible', idPra : idPra , visible : visible});
				}


				</script>
<?php
if (!isset($_SESSION)) {
	session_start();
}
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php'; }
		$idWork = $_SESSION["personaIdForWorks"];
		$idProf = $_SESSION["profIdForWorks"];
		//$materia = $_POST['campo1'];
		$sqlNTB = "SELECT P.CodUsuario as codProf, SUBSTR(M.CodMateria,3,1) as cuatrimestre, M.CodMateria, M.Materia, M.CodCarrera, AC.avance, A.*, PRA.estado as estadoReco FRom Alumno A";
		$sqlNTB .= " INNER JOIN AlumnoCarrera AC ON (AC.ID_Alumno=A.ID_Alumno)";
		$sqlNTB .= " INNER JOIN MATERIA M ON (M.CodCarrera=AC.CodCarrera)";
		$sqlNTB .= " INNER JOIN PROFESORMATERIA PM ON (PM.CodMateria=M.CodMateria)";
		$sqlNTB .= " INNER JOIN PROFESOR P ON (P.ID_Profesor=PM.ID_Profesor)";
		$sqlNTB .= " INNER JOIN ProfesorRecomendacionAlumno PRA ON (PRA.codProfesor=P.CodUsuario and PRA.codAlumno=A.CodUsuario and PRA.codMateria=M.CodMateria)";
		$sqlNTB .= " WHERE P.ID_Profesor = ".$idProf." and A.FechaBaja is null "; 
		//$sqlNTB .= " group by A.ID_Alumno, M.CodCarrera ";
		$sqlNTB .= " having (((cuatrimestre*100)/6+20) <avance)";
		$sqlNTB .= " order by estadoReco, M.CodCarrera,M.CodMateria,A.Apellido,A.Nombre;";

//echo $sqlNTB;

if (isset($_POST['accion'])) {
	$idAlumno = $_POST['alumno'];
	$idMateria = $_POST['materia'];
	$idProfesor = $_POST['profesor'];
	
	if ($_POST['accion'] == "aprobar") {

		$sql = "UPDATE ProfesorRecomendacionAlumno SET estado = 2 WHERE codProfesor = ".$idProfesor." AND codAlumno = ".$idAlumno." AND codMateria = '".$idMateria."';";
		$conex = new MySQL();
		$conex->consulta($sql);
	}
	else if ($_POST['accion'] == "rechazar") {
		$sql = "UPDATE ProfesorRecomendacionAlumno SET estado = 3 WHERE codProfesor = ".$idProfesor." AND codAlumno = ".$idAlumno." AND codMateria = '".$idMateria."';";
		$conex = new MySQL();
		$conex->consulta($sql);
	}
}


?>

<table class="listaTrabajos">
					<tr>
						
						<th >Alumno/Materia</th>
						<th width="50px">Estado</th>
						<th >Accion</th>
					</tr>
					<?php
						$conex = new MySQL();
						$alumnos = array();
						$result1 = $conex->consulta($sqlNTB);

		if ($conex->num_rows() > 0) {
			$result = $conex->fetch_assoc();
			while ($result) {
				$alumno = array();
				$alumno['apellido'] = $result['Apellido'];
				$alumno['nombre'] = $result['Nombre'];
				$alumno['id'] = $result['CodUsuario'];
				$alumno['idProf'] = $result['codProf'];
				
				$alumno['codmateria'] = $result['CodMateria'];
				$alumno['materia'] = $result['Materia'];
				$alumno['carrera'] = $result['CodCarrera'];
				$alumno['estadoReco'] = $result['estadoReco'];

				$alumnos[]= $alumno;
				$result = $conex->fetch_assoc();
			}
			$_SESSION["alumnos"] = $alumnos;
		}
		$separemosCarreras = "";
		$separemosMaterias = "";

						if (isset($_SESSION["alumnos"] )) {
						foreach ($_SESSION["alumnos"] as $value) {

							$carrera = $value['carrera'];
							$codigoMateria = $value['codmateria'];
							$idAlumno = $value['id'];
							$idProfesor = $value['idProf'];
							

							$materia = $value['codmateria']." - ".$value['materia'];
							$alumno = $value['apellido'].", ".$value['nombre'];
						
							$reco = $value['estadoReco'];


							if ($carrera != $separemosCarreras and $separemosCarreras == "") {
								$separemosCarreras = $carrera;
							}
							if ($carrera != $separemosCarreras) {
								echo "<tr><td colspan='3' style='height: 3px; background-color: #063049;'></td></tr>";
								$separemosCarreras = $carrera;
							}

							else if ($codigoMateria != $separemosMaterias and $separemosMaterias == "") {
								$separemosMaterias = $codigoMateria;
							}
							else if ($codigoMateria != $separemosMaterias) {
								echo "<tr><td colspan='3' style='height: 1px; background-color: #666;'></td></tr>";
								$separemosMaterias = $codigoMateria;
							}


							echo "<tr>";
							//echo "<td align='center'><span class='listTituloEmpresa'>".$carrera."</span></td>";

							echo "<td class='needMargin'>";
							echo "<span class='listTituloEmpresa'>".$alumno."</span>";
							echo "<span class='listDescripcion'>".$materia."</span>";
							
							echo "</td>";
							/*
							Estados:
							null o 0: No solicitado
							1: solicitud pendiente
							2: recomendado
							3: rechazado
							*/

							echo "<td align='center' style='font-size: 0.7em;'> <span >";
							if ($reco == "" or $reco == "0") { echo "No Solicitado"; }
							else if ($reco == "1") { echo "Pendiente"; }
							else if ($reco == "2") { echo "Recomendado"; }
							else if ($reco == "3") { echo "Rechazado"; }

							echo "</span></td>";
				
							echo "<td align=center>";
							if ($reco == "1") {
								$carrera = $value['carrera'];
								$codigoMateria = $value['codmateria'];
								$idAlumno = $value['id'];

							echo "<div class='btnCuadrado aceptar' onclick='recomendarAlumno(".$idAlumno.",".'"'.$codigoMateria.'"'.",".$idProfesor.");'  title='Recomendar'><img alt='' src='imagenes/iconos/check_blanco.png' width='15'></div>";
							echo "<div class='btnCuadrado cancelar' onclick='rechazarAlumno(".$idAlumno.",".'"'.$codigoMateria.'"'.",".$idProfesor.");'' title='No recomendar'><img alt='' src='imagenes/iconos/cross_blanco.png' width='15'></div>";
							}
							else {
								echo "<span style='font-size: 0.7em; color: #333;'>Sin acciones</span>";
							}
							echo "</td>";
							echo "</tr>";
	
						}
					}
					?>
				</table>
				<script>
				function recomendarAlumno(idAlumno,idMateria,idProfesor) {
					var confirmar = confirm("Esta seguro que desea aprobar la recomendación al alumno?");
					if (confirmar == true) {
						$('#mibolsa').load('php/profMisAlumnosAccion.php',{ accion: 'aprobar', alumno: idAlumno, materia: idMateria, profesor:idProfesor });
						reloadMenu();
					}
				}
				function rechazarAlumno(idAlumno,idMateria,idProfesor) {
					var confirmar = confirm("Esta seguro que desea rechazar la recomendación al alumno?");
					if (confirmar == true) {
						$('#mibolsa').load('php/profMisAlumnosAccion.php',{ accion: 'rechazar', alumno: idAlumno, materia: idMateria, profesor:idProfesor });
						reloadMenu();
					}
				}


				</script>
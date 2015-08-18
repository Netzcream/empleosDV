<?php
if (!isset($_SESSION)) {
	session_start();
}
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php'; }
		$idWork = $_SESSION["personaIdForWorks"];
		$idProf = $_SESSION["profIdForWorks"];

		$sqlNTB = "SELECT SUBSTR(M.CodMateria,3,1) as cuatrimestre, A.CodUsuario as codAlumno, ";
		$sqlNTB .= "M.CodMateria, M.Materia, M.CodCarrera, AC.avance, P.* ";
		$sqlNTB .= "FRom Alumno A ";
		$sqlNTB .= "INNER JOIN AlumnoCarrera AC ON (AC.ID_Alumno=A.ID_Alumno) ";
		$sqlNTB .= "INNER JOIN MATERIA M ON (M.CodCarrera=AC.CodCarrera) ";
		$sqlNTB .= "INNER JOIN PROFESORMATERIA PM ON (PM.CodMateria=M.CodMateria) ";
		$sqlNTB .= "INNER JOIN PROFESOR P ON (P.ID_Profesor=PM.ID_Profesor) ";
		$sqlNTB .= "WHERE A.codUsuario = 6  ";
		$sqlNTB .= "AND NOT EXISTS (SELECT * FROM ProfesorRecomendacionAlumno PRA WHERE PRA.codProfesor=P.CodUsuario ";
		$sqlNTB .= "and PRA.codAlumno=A.CodUsuario and PRA.codMateria=M.CodMateria) ";
		$sqlNTB .= "having (((cuatrimestre*100)/6+20) <avance) ";
		$sqlNTB .= "order by M.CodCarrera,M.CodMateria,P.Apellido,P.Nombre DESC; ";

//echo $sqlNTB;

if (isset($_POST['accion'])) {

	
	if ($_POST['accion'] == "reco") {
		$a = $_POST['alumno'];
		$m = $_POST['materia'];
		$p = $_POST['profesor'];

		$sql = "insert into ProfesorRecomendacionAlumno (codProfesor,codAlumno,codMateria,estado) ";
		$sql .= "values (".$p.",".$a.",'".$m."',1);";
		$conex = new MySQL();
		$conex->consulta($sql);
	}
}


?>

<table class="listaTrabajos">
					<tr>
						
						<th >Profesor/Materia</th>
						<th >Solicitar</th>
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
				$profesor['idAlumno'] = $result['codAlumno'];
				
				$profesor['codmateria'] = $result['CodMateria'];
				$profesor['materia'] = $result['Materia'];
				$profesor['carrera'] = $result['CodCarrera'];

				$profesors[]= $profesor;
				$result = $conex->fetch_assoc();
			}
			$_SESSION["profesores"] = $profesors;
		}
		$separemosCarreras = "";
		$separemosMaterias = "";

						if (isset($_SESSION["profesores"] )) {
						foreach ($_SESSION["profesores"] as $value) {

							$carrera = $value['carrera'];
							$codigoMateria = $value['codmateria'];
							$idProfesor = $value['id'];
							$idAlumno = $value['idAlumno'];
							

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

							echo "<td align='center' style='font-size: 0.7em;'>";

								echo "<div class='btnCuadrado aceptar' onclick='solicitarReco(".$idAlumno.",".'"'.$codigoMateria.'"'.",".$idProfesor.");'  title='Solicitar Recomendacion'><img alt='' src='imagenes/iconos/check_blanco.png' width='15'></div>";

							echo "</td>";
				
							echo "</tr>";
	
						}
					}
					?>
				</table>
				<script>
				function solicitarReco(idAlumno,idMateria,idProfesor) {
					var confirmar = confirm("Esta seguro que desea solicitar la recomendación al profesor?");
					if (confirmar == true) {
						$('#mibolsa').load('php/alumnoProfesoresListAccion.php',{ accion: 'reco', alumno: idAlumno, materia: idMateria, profesor:idProfesor });
						$('#contMenu').load("php/menu.php");
					}
				}


				</script>
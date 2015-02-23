<script type="text/javascript" src="<?php echo $_SERVER["DOCUMENT_ROOT"] ?> /js/datedropper.js"></script>
<?php 
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}
if (!class_exists('Trabajo')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Trabajo.php";
}

if (!isset($_SESSION)) {
	session_start();
}

$Persona = new Persona();
if (isset($_SESSION["usr"])) {
	$Persona = unserialize (serialize ($_SESSION['usr']));
}
else {
	//LOGERROR
}

if (isset($_POST['action'])) {
	if ($_POST['action'] == "load") {
		if (isset($_POST['id'])) {
			loadWorkByPersonaAndId($Persona,$_POST['id']);
		}
		else {
			//LOGERROR
		}
	}
	else if ($_POST['action'] == "edit") {
		if (isset($_POST['id'])) {

			$id = $_POST['id'];
			$Persona->getWork($id)->setEmpresa($_POST['empresa']);
			$Persona->getWork($id)->setPuesto($_POST['cargo']);
			$Persona->getWork($id)->getFechaDesde()->setFecha($_POST['fechaDesde']);
			if (isset($_POST['fechaHasta'])) {
				if ($_POST['fechaHasta'] != "" && $_POST['fechaHasta'] != null) {
					$Persona->getWork($id)->getFechaHasta()->setFecha($_POST['fechaHasta']);
				}
				else {

					$Persona->getWork($id)->getFechaHasta()->setFecha(null);
				}
			}
			
			
			
			$Persona->getWork($id)->setDesc($_POST['descripcion']);
			$Persona->getWork($id)->getPais()->getAndSetPaisById($_POST['pais']);
			$Persona->getWork($id)->getSeniority()->getAndSetSeniorityById($_POST['seniority']);
			$Persona->getWork($id)->setPersonasCargo($_POST['acargo']);

			$a = $Persona->getWork($id)->saveAndReturnIdByPersona($Persona->getidAlumno());
			$_SESSION["usr"] = $Persona;
		}
		else {
			//LOGERROR
		}
	}
	else if ($_POST['action'] == "add") {
		$_SESSION["pasos"] = array();
		if (isset($_POST['id'])) {
			$temp = new Trabajo();
			$temp->setEmpresa($_POST['empresa']);
			$temp->setPuesto($_POST['cargo']);
			$temp->getFechaDesde()->setFecha($_POST['fechaDesde']);
			if (isset($_POST['fechaHasta'])) {
				if ($_POST['fechaHasta'] != "" && $_POST['fechaHasta'] != null) {
					$temp->getFechaHasta()->setFecha($_POST['fechaHasta']);
				}
				else {
					$temp->getFechaHasta()->setFecha(null);
				}
			}
			$temp->setDesc($_POST['descripcion']);
			$temp->getPais()->getAndSetPaisById($_POST['pais']);
			$temp->getSeniority()->getAndSetSeniorityById($_POST['seniority']);
			$temp->setPersonasCargo($_POST['acargo']);
			$Persona->addTrabajo($temp->saveAndReturnIdByPersona($Persona->getidAlumno()));
			$_SESSION["usr"] = $Persona;
		}
		else {
			//LOGERROR
		}	
	}	
	else if ($_POST['action'] == "remove") {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$Persona->getWork($id)->removeWorkFromIdAndPer($id,$Persona->getIdAlumno());
			$Persona->delWork($id);
			$_SESSION["usr"] = $Persona;
		} 
		else {
			//LOGERROR
		}
		
		
	}
	else {
		//LOGERROR
	}
}
else {
	//LOGERROR
}

if ($_POST['action'] == "list") {
echo '<table class="listaTrabajos">
			<tr>
			<th>Trabajo</th>
			<th>Desde</th>
			<th>Hasta</th>
			<th>Acci&oacute;n</th>
			</tr>';

if (sizeof($Persona->getAllWork()) > 0) {
	$tt = 0;
	foreach ($Persona->getAllWork() as $a) {
	
		
		
		
		echo '<tr class="listRow'.$tt.'">';
		echo '<td class="needMargin">';
		
		
		echo '<span class="listTituloEmpresa">';
		echo $a->getEmpresa();
		echo '</span> - <span class="listCargo">';
		echo $a->getPuesto();
		echo '</span>';
		echo '<br>';
		echo '<span class="listDescripcion">';
		echo $a->getDesc();
		echo '</span>';
		echo '</td>';
			echo '<td class="listFechas">';
		if ($a->getFechaDesde()->getDia() != null) {
			echo '<span class="listDia">'.$a->getFechaDesde()->getDia().'</span>';
			echo '<span class="listMes">'.$a->getFechaDesde()->getShortMes().'</span>';
			echo '<span class="listAnio">'.$a->getFechaDesde()->getAnio().'</span>';
		}
		else {
			echo '<span class="listPres">No ingresado</span>';
		}
		echo '</td>';
		echo '<td class="listFechas">';
	
		if ($a->getFechaHasta()->getFecha() != null &&  $a->getFechaHasta()->getFecha() != "0000-00-00 00:00:00" && $a->getFechaHasta()->getFecha() != "0000/00/00 00:00:00") {
			echo '<span class="listDia">'.$a->getFechaHasta()->getDia().'</span>';
			echo '<span class="listMes">'.$a->getFechaHasta()->getShortMes().'</span>';
			echo '<span class="listAnio">'.$a->getFechaHasta()->getAnio().'</span>';
		}
		else {
			echo '<span class="listPres">Presente</span>';
		}
		
		echo '</td>';
		echo '<td class="listAccion">';
		echo "<div class='btnCuadrado aceptar' onclick='loadAndEditWork(".$a->getId()."); loadSectionPerfil(7);'><img alt='' src='imagenes/iconos/edit.png' width='15'></div>";
		echo "<div class='btnCuadrado cancelar' onclick='loadAndRemoveWork(".$a->getId()."); loadSectionPerfil(7);'><img alt='' src='imagenes/iconos/cross_blanco.png' width='15'></div>";
		echo '</td>';
		echo '</tr>';
		
		

	
		if ($tt == 0) { $tt++; }
		else { $tt--; }
	}
}
	else {
		echo "<tr><td colspan='4'>No hay datos cargados</td></tr>";
}
echo '</table>';
}
function loadWorkByPersonaAndId($Per,$a) {
		$Persona = new Persona();
		$Persona = unserialize (serialize ($Per));
		$trabajo = new Trabajo();
		$trabajo = unserialize (serialize ($Persona->getWork($a)));

		$fechaHasta = $trabajo->getFechaHasta()->getFecha();
		$desc = str_replace(array("\r", "\n")," ", $trabajo->getDesc()); 
	echo '<script>';
	echo '$("#currentWorkID").val("'.$a.'");';
	echo '$("#listEmpresa").val("'.$trabajo->getEmpresa().'");';
	echo '$("#listCargo").val("'.$trabajo->getPuesto().'");';

	echo '$("#listAddWorkDesde").val("'.$trabajo->getFechaDesde()->getFecha().'");';
	

	if ($fechaHasta) {
		echo '$("#listAddWorkHasta").val("'.$fechaHasta.'");';
	}
	if ($desc) {
		echo '$("#listDescripcion").val("'.$desc.'");';
	}
	echo '$("#workPaisSel option[value='.$trabajo->getPais()->getId().']").attr("selected","selected");';
	echo '$("#workSenioritySel option[value='.$trabajo->getSeniority()->getId().']").attr("selected","selected");';
	
	if ($trabajo->getPersonasCargo() == true) {
		echo '$("#checkPersonasACargo").prop("checked", true);';
	}
	else {
		echo '$("#checkPersonasACargo").prop("checked", false);';
	}
	
	
	echo '</script>';
}
?>

				
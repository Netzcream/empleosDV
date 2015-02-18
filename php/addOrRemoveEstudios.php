<script type="text/javascript" src="<?php echo $_SERVER["DOCUMENT_ROOT"] ?> /js/datedropper.js"></script>
<?php 
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}
if (!class_exists('Estudios')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Estudios.php";
}

if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION["usr"])) {
	$_SESSION["usr"] = unserialize (serialize ($_SESSION['usr']));
	$Persona = $_SESSION["usr"];
}
else {
	//LOGERROR
}

if (isset($_POST['action'])) {
	if ($_POST['action'] == "load") {
		if (isset($_POST['id'])) {
			loadByPersonaAndId($Persona,$_POST['id']);
		}
		else {
			//LOGERROR
		}
	}
	else if ($_POST['action'] == "edit") {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			if ($_POST['instituto'] != "" && $_POST['titulo'] != "" && $_POST['fechaDesde'] != "") {
				$Persona->getEst($id)->setInstituto($_POST['instituto']);
				$Persona->getEst($id)->setTitulo($_POST['titulo']);
				$Persona->getEst($id)->getFechaDesde()->setFecha($_POST['fechaDesde']);
				if (isset($_POST['fechaHasta'])) {
					if ($_POST['fechaHasta'] != "" && $_POST['fechaHasta'] != null) {
						$Persona->getEst($id)->getFechaHasta()->setFecha($_POST['fechaHasta']);
					}
					else {
						$Persona->getEst($id)->getFechaHasta()->setFecha(null);
					}
				}
				$Persona->getEst($id)->getNivel()->getAndSetNivelById($_POST['nivel']);
				$a = $Persona->getEst($id)->saveAndReturnIdByPersona($Persona->getId());
				$_SESSION["usr"] = $Persona;
			}
		}
		else {
			//LOGERROR
		}
	}
	else if ($_POST['action'] == "add") {
		if (isset($_POST['id'])) {
			if ($_POST['instituto'] != "" && $_POST['titulo'] != "" && $_POST['fechaDesde'] != "") {
				$temp = new Estudios();
				$temp->setInstituto($_POST['instituto']);
				$temp->setTitulo($_POST['titulo']);
				$temp->getFechaDesde()->setFecha($_POST['fechaDesde']);
				if (isset($_POST['fechaHasta'])) {
					$temp->getFechaHasta()->setFecha($_POST['fechaHasta']);
				}
				$temp->getNivel()->getAndSetNivelById($_POST['nivel']);
				$Persona->addEstudio($temp->saveAndReturnIdByPersona($Persona->getId()));
				$_SESSION["usr"] = $Persona;
			}
		}
		else {
			//LOGERROR
		}	
	}	
	else if ($_POST['action'] == "remove") {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$Persona->getEst($id)->removeEstFromPersonaAndId($Persona->getId(),$id);
			$Persona->delEst($id);
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
echo '<table class="listaEstudios">
<tr>
<th>Estudios</th>
<th>Desde</th>
<th>Hasta</th>
<th>Acci&oacute;n</th>
</tr>';

if (sizeof($Persona->getAllEst()) > 0) {
	$tt = 0;
	foreach ($Persona->getAllEst() as $a) {
	
		echo '<tr class="listRow'.$tt.'">';
		echo '<td class="needMargin">';
		echo '<span class="listTituloEmpresa">';
		echo $a->getInstituto();
		echo '</span> - <span class="listCargo">';
		echo $a->getTitulo();
		echo '</span>';
		echo '<span class="listDescripcion">';
		echo $a->getNivel()->getNivel();
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
	
		if ($a->getFechaHasta()->getDia() != null) {
			echo '<span class="listDia">'.$a->getFechaHasta()->getDia().'</span>';
			echo '<span class="listMes">'.$a->getFechaHasta()->getShortMes().'</span>';
			echo '<span class="listAnio">'.$a->getFechaHasta()->getAnio().'</span>';
		}
		else {
			echo '<span class="listPres">Presente</span>';
		}
		echo '</td>';
		echo '<td class="listAccion">';
		echo "<div class='btnCuadrado aceptar' onclick='loadAndEditEdu(".$a->getId()."); loadSectionPerfil(8);'><img alt='' src='imagenes/iconos/edit.png' width='15'></div>";
		echo "<div class='btnCuadrado cancelar' onclick='loadAndRemoveEdu(".$a->getId()."); loadSectionPerfil(8);'><img alt='' src='imagenes/iconos/cross_blanco.png' width='15'></div>";
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
function loadByPersonaAndId($Per,$a) {
	
		$Per = unserialize (serialize ($Per));
	echo '<script>
				$("#indEduInst").val("'.$Per->getEst($a)->getInstituto().'");
				$("#indEduTit").val("'.$Per->getEst($a)->getTitulo().'");
				$("#listAddStuDesde").val("'.$Per->getEst($a)->getFechaDesde()->getFecha().'");
				$("#listAddStuHasta").val("'.$Per->getEst($a)->getFechaHasta()->getFecha().'");
				$("#eduNivelEst option[value='.$Per->getEst($a)->getNivel()->getId().']").attr("selected","selected");
				$("#currentEDUID").val("'.$a.'");
			</script>';
}
?>

				
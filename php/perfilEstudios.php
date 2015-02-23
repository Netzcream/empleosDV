<?php 

if (!isset($_SESSION)) {
	session_start();
}
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php'; }
if (!class_exists('Rol')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Rol.php"); }
if (!class_exists('EstadoCivil')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/EstadoCivil.php"); }
if (!class_exists('EstadoUsuario')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/EstadoUsuario.php"); }
if (!class_exists('Documento')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Documento.php"); }
if (!class_exists('NivelEstudios')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/NivelEstudios.php"); }
if (!class_exists('Pais')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Pais.php"); }
if (!class_exists('Fecha')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Fecha.php"); }
if (!class_exists('FotoPerfil')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/FotoPerfil.php"); }
if (!class_exists('Direccion')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Direccion.php"); }
if (!class_exists('Tag')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Tag.php"); }
if (!class_exists('Estudios')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Estudios.php"); }
if (!class_exists('Trabajo')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Trabajo.php"); }
if (!class_exists('Persona')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php"); }

if (isset($_SESSION["usr"])) {
	$_SESSION["usr"] = unserialize (serialize ($_SESSION['usr']));
	$Persona = $_SESSION["usr"];
	if (!empty($Persona->getApellido()) && !empty($Persona->getNombre())) {
		$mostrarUsuario = $Persona->getApellido().", ".$Persona->getNombre();
		$_SESSION['MostrarNombre'] = $mostrarUsuario;
	}
}
else {
	//LOGERROR
}
?>

	<div class="titleSelRol">Mis Estudios</div>
			
		<div id="misEstudios" class="thingsConteiner2">
			
		<!-- Se carga la tabla de estudios -->
			
		</div>
		<div>
			<input type="button" class="perfilBtnSeeMyCV" value="A&ntilde;adir Nuevo" onclick="agregarEdu(); loadSectionPerfil(8);">
		</div>
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Volver" onclick="goBacktoPerfil(6);">
		</div>
		<input id="currentEDUID" type="hidden" value="">
		<input id="currentEDUAction" type="hidden" value="">
		
		<script>
		loadEduList();
		function loadEduList() {
			$('#misEstudios').load('php/addOrRemoveEstudios.php',{action:"list"});
		}
		function loadAndEditEdu(a){
			clearEdu();
			$('#titleEst').html("Modificar estudios");
			$('#perfilAddModEstudiosLoad').load('php/addOrRemoveEstudios.php',{action:"load",id:a});
			$("#eduBtn1").val("Cancelar");
			$("#eduBtn2").val("Modificar");
			$("#currentEDUAction").val("edit");
			
			//Carga el formulario de estudios con los datos del id a modificarlo
			//Todo en enable
		}
		function loadAndRemoveEdu(a) {
			clearEdu();
			$("#indEduInst").prop('disabled', true);
			$("#indEduTit").prop('disabled', true);
			$("#eduNivelEst").prop('disabled', true);
			$('#titleEst').html("Eliminar estudios");
			$('#perfilAddModEstudiosLoad').load('php/addOrRemoveEstudios.php',{action:"load",id:a});
			$("#eduBtn1").val("Cancelar");
			$("#eduBtn2").val("Eliminar");
			$("#currentEDUAction").val("remove");
			//Carga el formulario de estudios con los datos del id a para eliminarlo
			//(Poner todo en disable)
		}
		function agregarEdu() {
			clearEdu();
			$('#titleEst').html("Agregar estudios");
			$("#currentEDUAction").val("add");
			
			//Carga el formulario de estudios listo para agregar uno nuevo
		}
		function clearEdu() {
			$('input').removeClass('notSelected');
			$("#indEduInst").prop('disabled', false);
			$("#indEduTit").prop('disabled', false);
			$("#eduNivelEst").prop('disabled', false);
			
			$('#eduNivelEst option:selected').removeAttr('selected');
			$('#titleEst').html("");
			$("#indEduInst").val("");
			$("#indEduTit").val("");
			$("#listAddStuDesde").val("");
			$("#listAddStuHasta").val("");
			$("#eduNivelEst option:first").attr("selected","selected");
			$("#currentEDUID").val("new");
			$("#eduBtn1").val("Cancelar");
			$("#eduBtn2").val("Agregar");
			//Limpia el formulario de estudios.
			//Todo en enable
		}
		</script>
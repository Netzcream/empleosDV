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

			<div class="titleSelRol">Mis Trabajos</div>
			
			<div id="misTrabajos" class="thingsConteiner2">
			
			

		
			</div>
		<div>
			<input type="button" class="perfilBtnSeeMyCV" value="A&ntilde;adir Nuevo" onclick="agregarWork(); loadSectionPerfil(7);">
		</div>
			
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Volver" onclick="goBacktoPerfil(5);">
			</div>
				<input id="currentWorkID" type="hidden" value="">
				<input id="currentWorkAction" type="hidden" value="">
				
				<script>
				loadWorkList();
				function loadWorkList() {
					$('#misTrabajos').load('php/addOrRemoveTrabajos.php',{action:"list"});
				}

				function loadAndEditWork(a){
					clearWork();
					$('#titleEditWork').html("Modificar Trabajo");
					$('#perfilAddModWorkLoad').load('php/addOrRemoveTrabajos.php',{action:"load",id:a});
					$("#workBtn1").val("Cancelar");
					$("#workBtn2").val("Modificar");
					$("#currentWorkAction").val("edit");
					
					//Carga el formulario de estudios con los datos del id a modificarlo
					//Todo en enable
				}
				function loadAndRemoveWork(a) {
					clearWork();
					$('#titleEditWork').html("Eliminar Trabajo");
					$('#perfilAddModWorkLoad').load('php/addOrRemoveTrabajos.php',{action:"load",id:a});
					$("#workBtn1").val("Cancelar");
					$("#workBtn2").val("Eliminar");
					$("#currentWorkAction").val("remove");
					//Carga el formulario de estudios con los datos del id a para eliminarlo
					//(Poner todo en disable)

					$("#listEmpresa").prop('disabled', true);
					$("#listCargo").prop('disabled', true);
					$("#listDescripcion").prop('disabled', true);
					$("#workPaisSel").prop('disabled', true);
					$("#workSenioritySel").prop('disabled', true);
					$("#checkPersonasACargo").prop('disabled', true);
				}
				function agregarWork() {
					clearWork();
					$('#titleEditWork').html("Agregar Trabajos");
					$("#currentWorkAction").val("add");
					
					//Carga el formulario de estudios listo para agregar uno nuevo
				}
				</script>
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
			<div id="titleEditWork" class="titleSelRol">titulo</div>
			<div>
				<label class="labelFillDP inline">Empresa</label>
				<label class="labelFillDP inline">Cargo</label>
			</div>
			<div class="workSections">
				<input maxlength="100" id="listEmpresa" type="text" value="" class="inputFillDP" placeholder="Empresa">
				<input maxlength="50" id="listCargo" type="text" value="" class="inputFillDP" placeholder="Cargo">
			</div>
			<div class="workSections">
				<label class="labelFillDP inline2">Fecha desde</label>
				<input type="text" id="listAddWorkDesde" placeholder="Desde" onclick="clearInput(this);"/>
				 <input type="text" id="listAddWorkHasta" placeholder="Hasta" onclick="clearInput(this);"/>	
				 <label class="labelFillDP inline2">Fecha hasta</label>
			</div>
			<div>
				<label class="labelFillDP inline">Tarea/Descripci&oacute;n</label>
				</div>
			<div class="workSections">
				<textarea maxlength="2000" id="listDescripcion" class="textAreaFillDP" placeholder="Descripci&oacute;n"></textarea>
			</div>

			<div class="workSections">
				<label class="labelCheckbox2"><input id="checkPersonasACargo" type="checkbox" class="checkboxAlineado" value="" onclick=""><span>&iquest;Personas a cargo?</span></label>
			</div>
			
			<div>
				<label class="labelFillDP inline">Pais</label>
				<label class="labelFillDP inline">Seniority</label>
			</div>
			<div class="workSections">
				<select id="workPaisSel">
				<?php 
					$p = new Pais();
					foreach ($p->getColPaises() as $clave => $valor) {
						echo "<option value='".$clave."'>".$valor."</option>";
					}
				?>
				</select>
				<select id="workSenioritySel">
				<?php
					$s = new Seniority();
					foreach ($s->getColSeniorities() as $clave => $valor) {
						echo "<option value='".$clave."'>".$valor."</option>";
					}
				?>
				
				</select>
				</div>
				<div id="perfilAddModWorkLoad"></div>

			
			<div class="finRecuadroPerfil">
				<input id="workBtn1" type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(7);">
				<input id="workBtn2" type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(7);">
			</div>
			
			<script>
			$( "#listAddWorkDesde" ).dateDropper({
				format: "d/m/Y",
				lang: "es", 
				color:"#063049",
				placeholder: "Desde",
				animation: "dropdown",
				minYear: "1930",
				maxYear: "2030"
					
		});
		$( "#listAddWorkHasta" ).dateDropper({
			format: "d/m/Y",
			lang: "es", 
			color:"#063049",
			placeholder: "Hasta",
			animation: "dropdown",
			minYear: "1930",
			maxYear: "2030"
				
	});

		function validateModWork() {
			$('input').removeClass('notSelected');
			$('textarea').removeClass('notSelected');
			var empresa = $("#listEmpresa").val();
			var cargo = $("#listCargo").val();
			var fechaDesde = $("#listAddWorkDesde").val();
			var fechaHasta = $("#listAddWorkHasta").val();
			var descripcion = $("#listDescripcion").val();
			var pais = $('#workPaisSel').val();
			var seniority = $('#workSenioritySel').val();
			
			var acargo = ""; 
				if ($('#checkPersonasACargo').is(":checked") == true) {
					acargo = "1";
				}
				else {
					acargo = "0";
				}
			var id = $("#currentWorkID").val(); 
			var errores = 0;
			if (empresa == "" || empresa.length > 100) {
				 $("#listEmpresa").addClass('notSelected');
				 errores++;
			}
			if (cargo == "" || cargo.length > 50) {
				 $("#listCargo").addClass('notSelected');
				 errores++;
			}
			if (fechaDesde == "" || fechaDesde == "Desde") {
				 $("#listAddWorkDesde").addClass('notSelected');
				 errores++;
			}
			if (descripcion == "" || descripcion.length > 2000) {
				 $("#listDescripcion").addClass('notSelected');
				 errores++;
			}
			if (errores>0 && $("#currentWorkAction").val() != "remove") {
				return false;
			}
			if ($("#currentWorkAction").val() == "edit") {
				$('#perfilAddModWorkLoad').load('php/addOrRemoveTrabajos.php',{
					action:"edit",
					id:id,
					empresa:empresa,
					cargo:cargo,
					fechaDesde:fechaDesde,
					fechaHasta:fechaHasta,
					pais:pais,
					seniority:seniority,
					descripcion:descripcion,
					acargo:acargo
					});
			}
			if ($("#currentWorkAction").val() == "remove") {
				var id = $("#currentWorkID").val(); 
				$('#perfilAddModWorkLoad').load('php/addOrRemoveTrabajos.php',{
					action:"remove",
					id:id
					});
			}
			if ($("#currentWorkAction").val() == "add") {
				var id = $("#currentWorkID").val(); 
				$('#perfilAddModWorkLoad').load('php/addOrRemoveTrabajos.php',{
					action:"add",
					id:id,
					empresa:empresa,
					cargo:cargo,
					fechaDesde:fechaDesde,
					fechaHasta:fechaHasta,
					pais:pais,
					seniority:seniority,
					descripcion:descripcion,
					acargo:acargo
					});
			}
			return true;
		}

		function clearWork() {
			$('input').removeClass('notSelected');
			$('textarea').removeClass('notSelected');
			$('#workPaisSel option:selected').removeAttr('selected');
			$('#workSenioritySel option:selected').removeAttr('selected');
			$('#titleEditWork').html("");

			$("#listEmpresa").prop('disabled', false);
			$("#listCargo").prop('disabled', false);
			$("#listDescripcion").prop('disabled', false);
			$("#workPaisSel").prop('disabled', false);
			$("#workSenioritySel").prop('disabled', false);
			$("#checkPersonasACargo").prop('disabled', false);
			
			$("#listEmpresa").val("");
			$("#listCargo").val("");
			$("#listAddWorkDesde").val("");
			$("#listAddWorkHasta").val("");
			$("#listDescripcion").val("");
			$("#workPaisSel option:first").attr("selected","selected");
			$("#workSenioritySel option:first").attr("selected","selected");
			//$('#checkPersonasACargo').is(":checked")
			$('#checkPersonasACargo').prop('checked', false);
			$("#currentWorkID").val("new");
			$("#workBtn1").val("Cancelar");
			$("#workBtn2").val("Agregar");
			//Limpia el formulario de Trabajos.
			//Todo en enable
		}
			</script>
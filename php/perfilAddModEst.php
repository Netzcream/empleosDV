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
		
			<div class="titleSelRol" id="titleEst"></div>
			
			<div>
				<label class="labelFillDP inline">Instituci&oacute;n</label>
			</div>
			<div class="workSections">
				<input maxlength="50" id="indEduInst" type="text" value="" class="inputFillDP" placeholder="Instituci&oacute;n">
			</div>
			<div>
				<label class="labelFillDP inline">T&iacute;tulo</label>
			</div>
			
			<div class="workSections">
				<input maxlength="50" id="indEduTit" type="text" value="" class="inputFillDP" placeholder="T&iacute;tulo">
			</div>
			
			<div class="workSections">
				<label class="labelFillDP inline2">Fecha desde&nbsp;&nbsp;&nbsp;</label>
				 <label class="labelFillDP inline2">&nbsp;&nbsp;&nbsp;Fecha hasta</label>
			</div>
			
			<div class="workSections">
				<input type="text" id="listAddStuDesde" placeholder="Desde" onclick="clearInput(this);"/>
				<input type="text" id="listAddStuHasta" placeholder="Hasta" onclick="clearInput(this);"/>	
			</div>
			<div>
				<label class="labelFillDP inline">Nivel de estudio</label>
			</div>
			<div class="workSections">
				<select id="eduNivelEst">
				<?php 
				foreach ($Persona->getNivelEstudio()->getNiveles() as $clave => $valor) {
					echo "<option value='".$clave."'>".$valor."</option>";
				}
				
				?>
				</select>
			</div>
		<div id="perfilAddModEstudiosLoad"></div>

			
			<div class="finRecuadroPerfil">
				<input id="eduBtn1" type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(8);">
				<input id="eduBtn2" type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(8);">
			</div>
			
			<script>
				function validateModEst() {
					$('input').removeClass('notSelected');
					var instituto = $("#indEduInst").val();
					var titulo = $("#indEduTit").val();
					var fechaDesde = $("#listAddStuDesde").val();
					var fechaHasta = $("#listAddStuHasta").val();
					var nivel = $('#eduNivelEst').val();
					var id = $("#currentEDUID").val(); 

					var errores = 0;
					if (instituto == "" || instituto.length > 50) {
						 $("#indEduInst").addClass('notSelected');
						 errores++;
					}
					if (titulo == "" || titulo.length > 50) {
						 $("#indEduTit").addClass('notSelected');
						 errores++;
					}
					if (fechaDesde == "") {
						 $("#listAddStuDesde").addClass('notSelected');
						 errores++;
					}
	
					if (errores>0 && $("#currentEDUAction").val() != "remove") {
						return false;
					}
					
					if ($("#currentEDUAction").val() == "edit") {
						$('#perfilAddModEstudiosLoad').load('php/addOrRemoveEstudios.php',{
							action:"edit",
							id:id,
							instituto:instituto,
							titulo:titulo,
							fechaDesde:fechaDesde,
							fechaHasta:fechaHasta,
							nivel:nivel
							});
					}
					if ($("#currentEDUAction").val() == "remove") {
						var id = $("#currentEDUID").val(); 
						$('#perfilAddModEstudiosLoad').load('php/addOrRemoveEstudios.php',{
							action:"remove",
							id:id
							});
					}
					if ($("#currentEDUAction").val() == "add") {
						var id = $("#currentEDUID").val(); 
						$('#perfilAddModEstudiosLoad').load('php/addOrRemoveEstudios.php',{
							action:"add",
							id:id,
							instituto:instituto,
							titulo:titulo,
							fechaDesde:fechaDesde,
							fechaHasta:fechaHasta,
							nivel:nivel
							});
					}
					return true;
				}

				$( "#listAddStuDesde" ).dateDropper({
					format: "d/m/Y",
					lang: "es", 
					color:"#063049",
					placeholder: "Fecha hasta",
					animation: "dropdown",
					minYear: "1930",
					maxYear: "2030"
				});
				$( "#listAddStuHasta").dateDropper({
					format: "d/m/Y",
					lang: "es",
					color:"#063049",
					placeholder: "Fecha desde",
					animation: "dropdown",
					minYear: "1930",
					maxYear: "2030"
				
				});
			</script>
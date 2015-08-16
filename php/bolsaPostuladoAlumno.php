<?php

header('Content-Type: text/html; charset=UTF-8');
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
if (!class_exists('Carrera')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Carrera.php"); }
if (!class_exists('Materia')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Materia.php"); }
if (!class_exists('Telefono')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Telefono.php"); }

$_SESSION['location'] = "bolsaAlumno";
$mostrarUsuario = "NN";
$Persona = new Persona();
if (isset($_SESSION["usr"])) {
	$Persona = unserialize (serialize ($_SESSION['usr']));
	if ($Persona->getRol()->getId() == "AL") {
		if ($Persona->getNombre() != "") {
			$mostrarUsuario = $Persona->getNombre();
		}
	}

	$_SESSION["usr"] = $Persona;
}
else {
	//LOGERROR
}
$_SESSION["personaIdForWorks"] = $Persona->getId();

$conex = new MySQL();


?>
	<div id="perfilBolsaTrabajo" class="contSelRolUsuario selActivo">
			<div class="titleSelRol">Mis Postulaciones</div>
			
			<div id="mibolsa" class="thingsConteiner4">
	



				<script>
$('#mibolsa').load('php/bolsaPostuladoAlumnoAcciones.php', { accion:'listar' });
</script>
			</div>
		<div>
		</div>
			

		</div>
		
		<div id="perfilAddBolsaTrabajo" class="contSelRolUsuario">
		<div id="titleEditWork" class="titleSelRol" style="padding-bottom: 5px;"></div>
		<div id="editDeEmergencia">

</div>

			<input id="currentWorkID" type="hidden" value="">
			<input id="currentWorkAction" type="hidden" value="">
			
			<div class="finRecuadroPerfil">
				<input id="workBtn1" type="button" class="perfilBtnSeeMyCV" value="Volver" onclick="goBacktoPerfil();">
				<input id="workBtn2" type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="controlaDatosCargados(); ">
			</div>
		</div>


<script>

function previewWork(id) {
	$('#workBtn2').hide();
	$('#titleEditWork').html("Detalle");
	$('#editDeEmergencia').load('php/bolsaPostuladoAlumnoAcciones.php', { accion:'preview', campo1 : id });
	showEditBolsa();
}

function goBacktoPerfil() {
	$('body').css("overflow","hidden");
	$('#perfilAddBolsaTrabajo').fadeOut();
	setTimeout(function() {
		$('#perfilBolsaTrabajo').show();
		$('#perfilBolsaTrabajo').animate({'left': '50%', 'margin-left': -$('#perfilBolsaTrabajo').width()/2 });
		setTimeout(function() {
			$('body').css("overflow","auto");
		}, 500);
	}, 500);
}

function showEditBolsa() {
	
	$('body').css("overflow","hidden");
	$('input').removeClass('notSelected');
	$('#perfilBolsaTrabajo').animate({
		'marginLeft' : "-=1500px"
	},500,function() {
		$('#perfilBolsaTrabajo').hide();
	});	
	setTimeout(function() { $('#perfilAddBolsaTrabajo').fadeIn(); }, 500);
}
	$(document).ready(function() {
		hideWait();
	});
</script>
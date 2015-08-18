<?php


if (!isset($_SESSION)) {
	header('Content-Type: text/html; charset=UTF-8');
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

$_SESSION['location'] = "misAlumnos";
$mostrarUsuario = "NN";
$Persona = new Persona();
if (isset($_SESSION["usr"])) {
	$Persona = unserialize (serialize ($_SESSION['usr']));
	if ($Persona->getRol()->getId() == "EM") {
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
$_SESSION["profIdForWorks"] = $Persona->getidAlumno();

$conex = new MySQL();





?>
	<div id="perfilBolsaTrabajo" class="contSelRolUsuario selActivo">
			<div class="titleSelRol">Mis Alumnos</div>
			
			<div id="mibolsa" class="thingsConteiner5">
	



				<script>
$('#mibolsa').load('php/profMisAlumnosAccion.php');
</script>
			</div>
		<div>
		</div>
			

		</div>
		
		<div id="perfilAddBolsaTrabajo" class="contSelRolUsuario">
		<div id="titleEditWork" class="titleSelRol" style="padding-bottom: 5px;"></div>
		<div id="editDeEmergencia" class="thingsConteiner5">

	</div>
		
			<div class="finRecuadroPerfil">
				<input id="workBtn1" type="button" class="perfilBtnSeeMyCV" value="Volver" onclick="goBacktoPerfil();">
			</div>
		</div>


		<div id="perfilAddBolsaTrabajo2" class="contSelRolUsuario">
		<div id="titleEditWork2" class="titleSelRol" style="padding-bottom: 5px;"></div>
		<div id="editDeEmergencia2" class="thingsConteiner5">

	</div>
		
			<div class="finRecuadroPerfil">
				<input id="workBtn2" type="button" class="perfilBtnSeeMyCV" value="Volver" onclick="goBacktoPerfil2();">
			</div>
		</div>


<script>



function disableCareer(id) {
	var temp = id;
	var confirmar = confirm("Esta seguro que desea deshabilitar la carrera?");
	if (confirmar == true) {
		$('#mibolsa').load('php/profesorMisAlumnosAccion.php', { accion: "disable", campo1 : id });
	}
	else return;

}
function enableCareer(id) {
	var temp = id;
	var confirmar = confirm("Esta seguro que desea habilitar la carrera?");
	if (confirmar == true) {
		$('#mibolsa').load('php/profesorMisAlumnosAccion.php', { accion: "enable", campo1 : id });
	}
	else return;
}
function editCarrera(id) {
	$('#workBtn2').show();
	$('#titleEditWork').html("Editar Materias");
	$('#editDeEmergencia').html("");
	$('#editDeEmergencia').load('php/adminABMMateriasAccion.php', { campo1 : id });
	showEditBolsa();
}
function editWork(id) {
	$('#workBtn2').show();
	$('#titleEditWork').html("Editar trabajo");
	$('#editDeEmergencia').load('php/bolsaEmpresaEdit.php', { accion: "e", campo1 : id });
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

function goBacktoPerfil2() {
	$('body').css("overflow","hidden");
	$('#perfilAddBolsaTrabajo2').fadeOut();
	setTimeout(function() {
		$('#perfilAddBolsaTrabajo').show();
		$('#perfilAddBolsaTrabajo').animate({'left': '50%', 'margin-left': -$('#perfilAddBolsaTrabajo').width()/2 });
		setTimeout(function() {
			$('body').css("overflow","auto");
		}, 500);
	}, 500);
}

function goBacktoAndSavePerfil() {

if ($('#idWork').val() != "") {
	$('#mibolsa').load('php/bolsaEmpresaSave.php', { accion: "ed", campo1 : $('#campo1').val()
	, campo2 : $('#campo2').val()
	, campo3 : $('#campo3').val()
	, campo4 : $('#campo4').val()
	, campo5 : $('#campo5').val()
	, campo6 : $('#campo6').val()
	, campo7 : $('#campo7').val()
	, campo8 : $('#campo8').val()
	, campo9 : $('#campo9').val()
	, campo10 : $('#campo10').val()
	, campo11 : $('#campo11').val() 
	, campoID : $('#idWork').val() });
}
else { 
	$('#mibolsa').load('php/bolsaEmpresaSave.php', { accion: "a", campo1 : $('#campo1').val()
	, campo2 : $('#campo2').val()
	, campo3 : $('#campo3').val()
	, campo4 : $('#campo4').val()
	, campo5 : $('#campo5').val()
	, campo6 : $('#campo6').val()
	, campo7 : $('#campo7').val()
	, campo8 : $('#campo8').val()
	, campo9 : $('#campo9').val()
	, campo10 : $('#campo10').val()
	, campo11 : $('#campo11').val() });

}
	$('body').css("overflow","hidden");
	var volver = false;
	$('#perfilAddBolsaTrabajo').fadeOut();
	setTimeout(function() {
		$('#perfilBolsaTrabajo').show();
		$('#perfilBolsaTrabajo').animate({'left': '50%', 'margin-left': -$('#perfilBolsaTrabajo').width()/2 });
		setTimeout(function() {
			$('body').css("overflow","auto");
		}, 500);
	}, 500);

}
function controlaDatosCargados() {
	var error = 0;
	$('#campo1').removeClass("notSelected");
	$('#campo2').removeClass("notSelected");
	$('#campo3').removeClass("notSelected");
	$('#campo4').removeClass("notSelected");
	if ($('#campo1').val() == "") { 
		$('#campo1').addClass("notSelected");
		error++; 
	}
	if ($('#campo3').val() != "" && $('#campo4').val() != "") {
	
		if ($('#campo3').val() > $('#campo4').val()) {
			$('#campo3').addClass("notSelected");
			$('#campo4').addClass("notSelected");
			error++;

		}

	}

	if ($('#campo6').val() == "") { 
		$('#campo6').addClass("notSelected");
		error++; 
	}

	if (error > 0) { return false; }
	goBacktoAndSavePerfil();
}
function agregarBolsa() {
	$('#editDeEmergencia').load('php/bolsaEmpresaEdit.php');
	$('#workBtn2').show();
	$('#titleEditWork').html("A&ntilde;adir trabajo");
	return true;
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
function showEditBolsa2() {
	
	$('body').css("overflow","hidden");
	$('input').removeClass('notSelected');
	$('#perfilAddBolsaTrabajo').animate({
		'marginLeft' : "-=1500px"
	},500,function() {
		$('#perfilAddBolsaTrabajo').hide();
	});	
	setTimeout(function() { $('#perfilAddBolsaTrabajo2').fadeIn(); }, 500);
}
	$(document).ready(function() {
		hideWait();
	});
</script>
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
	<div class="titleSelRol">Cambio de clave</div>
		<br>	
			<div>
				<label class="labelFillDP inline">Clave actual</label>
			</div>
			<div class="preAdjust">
				<input id="claveOriginal" maxlength="15" type="password" class="inputFillDP" maxlength="50" placeholder="Clave actual">
			</div>
			
			
			<div>
				<label class="labelFillDP inline">Nueva Clave</label>
			</div>
			<div class="preAdjust">
				<input id="claveCambio1" maxlength="15" type="password" class="inputFillDP" maxlength="50" placeholder="Clave nueva">
			</div>
			
			<div>
				<label class="labelFillDP inline">Repita Clave</label>
			</div>
			<div class="preAdjust">
				<input id="claveCambio2" maxlength="15" type="password" class="inputFillDP" maxlength="50" placeholder="Clave nueva">
			</div>
			<div id="saveClave"></div>
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(9);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(9);">
			</div>	
<script>
function validateModClave() {
	var original = $('#claveOriginal').val();
	var clave1 = $('#claveCambio1').val();
	var clave2 = $('#claveCambio2').val();
	var error = 0;
	var msj = "";
	$('input').removeClass('notSelected');
	//maxlength="15" y 5
	if (original == "") {
		$('#claveOriginal').addClass('notSelected');
		msj = "No ingreso clave actual<br>";
		error++;
	}
	else if (original.length < 5) {
		$('#claveOriginal').addClass('notSelected');
		msj = "La clave original debe tener al menos 5 caracteres.<br>";
		error++;
	}
	if (clave1 == "") {
		$('#claveCambio1').addClass('notSelected');
		msj += "No ingreso nueva clave (1) <br>";
		error++;
	}
	else if (clave1.length < 5) {
		$('#claveCambio1').addClass('notSelected');
		msj += "La nueva clave (1) debe tener al menos 5 caracteres.<br>";
		error++;
	}
	if (clave2 == "") {
		$('#claveCambio2').addClass('notSelected');
		msj += "No ingreso nueva clave (2) <br>";
		error++;
	}
	else if (clave2.length < 5) {
		$('#claveCambio2').addClass('notSelected');
		msj += "La nueva clave (2) debe tener al menos 5 caracteres.<br>";
		error++;
	}
	if (clave1 != clave2) {
		$('#claveCambio1').addClass('notSelected');
		$('#claveCambio2').addClass('notSelected');
		msj += "No coinciden las claves<br>";
		error++;
	}
	if (error > 0) {
		$('#saveClave').html("<label class='regLabelNota regError'>"+msj+"</label>");
		return false;

	}
	$('#saveClave').load('php/addOrRemoveConfig.php',{ action:'saveClave',original:original,clave1:clave1,clave2:clave2} );
	return true;
}
</script>
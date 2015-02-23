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

		<div class="titleSelRol">Configuraci&oacute;n de cuenta</div>
		<br>	
			<div>
				<label class="labelFillDP inline">Correo electr&oacute;nico/Usuario</label>
			</div>
			<div class="preAdjust">
			
			<input id="editEmail" type="text" class="inputFillDP inputMail" maxlength="50" value="<?php echo $Persona->getEmail(); ?>" placeholder="Correo electr&oacute;nico" disabled>
				<div class="notationLabel">
				No se permite el cambio de correo electr&oacute;nico de momento.
				</div>
			</div>
		<br>	
			<div>
				<input type="button" class="perfilBtnSeeMyCV" value="Cambiar mi clave" onclick="loadSectionPerfil(9);">
				<div id="fechaCambioPass" class="notationLabel">
				&Uacute;ltimo cambio: 
				<?php echo $Persona->getFechaCambioPass()->getFechaCompleta(); ?>
				</div>
			</div>
		<br>
			<div>
				<label class="labelCheckbox"><input <?php if ($Persona->getNotificarme() == '1') echo "checked"; ?> id="checkNotByEmail" type="checkbox" class="checkboxAlineado" value="" onclick=""><span>Recibir notificaciones por correo electr&oacute;nico.</span></label>
				<label class="labelCheckbox"><input <?php if ($Persona->getEncontrarme() == '1') echo "checked"; ?> id="checkNotFindMe" type="checkbox" class="checkboxAlineado" value="" onclick=""><span>Permitir que las empresas me encuentren.</span></label>
			</div>
			
			<div id="saveConfig"></div>
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(1);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(1);">
			</div>		
			
			<script>
			function validateConfig() {
				var errores = 0;
				var notificarme = $('#checkNotByEmail').is(':checked');
				var encontrarme = $('#checkNotFindMe').is(':checked');
				
				
				$('#saveConfig').load('php/addOrRemoveConfig.php',{action:"save",notificarme:notificarme,encontrarme:encontrarme});
				return true;
			}	
			</script>
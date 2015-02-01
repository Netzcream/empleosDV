<?php
	require 'clases/Persona.php';
 
	
	if (!isset($_SESSION)) {
		session_start();
	}
	$_SESSION['location'] = "perfilHome";
	$mostrarUsuario = $_SESSION['usuario'];
	if (isset($_SESSION['MostrarNombre'])) {
	 	$mostrarUsuario = $_SESSION['MostrarNombre'];
	 }

	 $_SESSION["usr"] = unserialize (serialize ($_SESSION['usr']));

?>

<div>
	<div id="homePerfil" class="contSelRolUsuario selActivo">
		<div class="perfilHeader">
			<div id ="fotoPerfilACT" class="perfilIMG" onclick="loadImg();">
				<img title="Perfil" alt="Foto Perfil" src="<?php echo $_SESSION["usr"]->getFoto() ; ?>">
				<img class="upload" title="Cambiar imagen de perfil" alt="Foto Perfil" src="imagenes/iconos/upload_blanco.png">
			</div>
			<div class="perfilNombre"><?php echo $mostrarUsuario;  ?></div>
		</div>
		
		<div class="perfilBtns">
			<div class="perfilIndCont" onclick="loadSectionPerfil(1);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/configuracion.png"></div> <span>Configuraci&oacute;n</span></div>
			<div class="perfilIndCont" onclick="loadSectionPerfil(2);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/estudiante.png"></div><span>Datos Personales</span></div>
			<div class="perfilIndCont" onclick="loadSectionPerfil(3);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/casa.png"></div><span>Domicilio y Contacto</span></div>
			<div class="perfilIndCont" onclick="loadSectionPerfil(4);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/tag.png"></div><span>Mis Tags</span></div>
			<div class="perfilIndCont" onclick="loadSectionPerfil(5);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/trabajo.png"></div><span>Mis Trabajos</span></div>
			<div class="perfilIndCont" onclick="loadSectionPerfil(6);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/estudios.png"></div><span>Mis Estudios</span></div>
		</div>
		<div>
			<input class="perfilBtnSeeMyCV" type="submit" value="Ver mi curriculum"/>
		</div>
		
	</div>
	
		<div id="uploadFileCont" class="contSelRolUsuario">
		
		</div>
		
		<div id="perfilConfiguracion" class="contSelRolUsuario">
			<div class="titleSelRol">Configuraci&oacute;n de cuenta</div>
		
		
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(1);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoPerfil(1);">
			</div>		
		</div>
		
		<div id="perfilDatosPersonales" class="contSelRolUsuario">
			<div class="titleSelRol">Datos Personales</div>
		
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(2);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoPerfil(2);">
			</div>		
		</div>
		
		<div id="perfilDomicilioYContacto" class="contSelRolUsuario">
			<div class="titleSelRol">Domicilio y Contacto</div>
			
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(3);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoPerfil(3);">
			</div>		
		</div>
		
		<div id="perfilMisTags" class="contSelRolUsuario">
			<div class="titleSelRol">Mis Tags</div>
		
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(4);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoPerfil(4);">
			</div>		
		</div>
		
		<div id="perfilMisTrabajos" class="contSelRolUsuario">
			<div class="titleSelRol">Mis Trabajos</div>
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(5);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoPerfil(5);">
			</div>
		</div>
		
		<div id="perfilMisEstudios" class="contSelRolUsuario">
			<div class="titleSelRol">Mis Estudios</div>
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(6);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoPerfil(6);">
			</div>
		</div>
		
		
</div>

<script>
	$('#uploadFileCont').load('php/perfilUploadFE.php');


	function goBacktoPerfil(a) {
		if (a == 1) { $('#perfilConfiguracion').fadeOut(); }
		else if (a == 2) { $('#perfilDatosPersonales').fadeOut(); }
		else if (a == 3) { $('#perfilDomicilioYContacto').fadeOut(); }
		else if (a == 4) { $('#perfilMisTags').fadeOut(); }
		else if (a == 5) { $('#perfilMisTrabajos').fadeOut(); }
		else if (a == 6) { $('#perfilMisEstudios').fadeOut(); }
		setTimeout(function() {
			$('#homePerfil').show();
			$('#homePerfil').animate({'left': '50%', 'margin-left': -$('#homePerfil').width()/2 });
		}, 500);
}
	
	function loadImg() {
		$('#homePerfil').animate({
			'marginLeft' : "-=1500px"
		},500,function(){
			$('#homePerfil').hide();	 
			$('#uploadFileCont').fadeIn();	
		});
	}
	function loadSectionPerfil(a) {
		$('#homePerfil').animate({
			'marginLeft' : "-=1500px"
		},500,function(){
			$('#homePerfil').hide();	 
			if (a == 1) { $('#perfilConfiguracion').fadeIn(); }
			else if (a == 2) { $('#perfilDatosPersonales').fadeIn(); }
			else if (a == 3) { $('#perfilDomicilioYContacto').fadeIn(); }
			else if (a == 4) { $('#perfilMisTags').fadeIn(); }
			else if (a == 5) { $('#perfilMisTrabajos').fadeIn(); }
			else if (a == 6) { $('#perfilMisEstudios').fadeIn(); }
		});
	}
	function unloadImg() {
		$('#uploadFileCont').fadeOut();
		setTimeout(function() {
			$('#homePerfil').show();
			$('#homePerfil').animate({'left': '50%', 'margin-left': -$('#homePerfil').width()/2 });
		}, 500);
		$('#uploadFileCont').load('php/perfilUploadFE.php');
		$('#fotoPerfilACT').load('php/loadIMGPerfil.php');
	}
	function uploadPhoto() { 
		setTimeout(function() {
			unloadImg();
		}, 500);

	}
</script>
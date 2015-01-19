<?php 
	if (!isset($_SESSION)) {
		session_start();
	}
	$_SESSION['location'] = "perfilHome";
	$mostrarUsuario = $_SESSION['usuario'];
	if (isset($_SESSION['MostrarNombre'])) {
	 	$mostrarUsuario = $_SESSION['MostrarNombre'];
	 }

?>

<div>
	<div id="homePerfil" class="contSelRolUsuario selActivo">
		<div class="perfilHeader">
			<div id ="fotoPerfilACT" class="perfilIMG" onclick="loadImg();">
				<img title="Perfil" alt="Foto Perfil" src="<?php echo $_SESSION['fotoPerfil']; ?>">
				<img class="upload" title="Cambiar imagen de perfil" alt="Foto Perfil" src="imagenes/iconos/upload_blanco.png">
			</div>
			<div class="perfilNombre"><?php echo $mostrarUsuario; ?></div>
		</div>
		
		<div class="perfilBtns">
			<div class="perfilIndCont"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/configuracion.png"></div> <span>Configuraci&oacute;n</span></div>
			<div class="perfilIndCont"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/estudiante.png"></div><span>Datos Personales</span></div>
			<div class="perfilIndCont"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/casa.png"></div><span>Domicilio y Contacto</span></div>
			
			
			<div class="perfilIndCont"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/tag.png"></div><span>Mis Tags</span></div>
			<div class="perfilIndCont"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/trabajo.png"></div><span>Mis Trabajos</span></div>
			<div class="perfilIndCont"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/estudios.png"></div><span>Mis Estudios</span></div>
		</div>
		<div>
			<input class="perfilBtnSeeMyCV" type="submit" value="Ver mi curriculum"/>
		</div>
		
	</div>
	
		<div id="uploadFileCont" class="contSelRolUsuario">
		
		</div>
</div>

<script>
$('#uploadFileCont').load('php/perfilUploadFE.php');
	function loadImg() {
		$('#homePerfil').animate({
			'marginLeft' : "-=1500px"
		},500,function(){
			$('#homePerfil').hide();	 
			$('#uploadFileCont').fadeIn();	
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
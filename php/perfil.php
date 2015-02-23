<?php
	header('Content-type: text/html; charset=utf-8');

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
	
	$_SESSION['location'] = "perfilHome";
	$mostrarUsuario = $_SESSION['usuario'];
	$Persona = new Persona();
	if (isset($_SESSION['MostrarNombre'])) {
	 	$mostrarUsuario = $_SESSION['MostrarNombre'];
	 }

	 if (isset($_SESSION["usr"])) {
	 	$Persona = unserialize (serialize ($_SESSION['usr']));
	 	if ($Persona->getApellido() != "" && $Persona->getNombre() != "") {
		 	$mostrarUsuario = $Persona->getApellido().", ".$Persona->getNombre();
		 	$_SESSION['MostrarNombre'] = $mostrarUsuario; 
	 	}
	 }
	 else {
	 	//LOGERROR
	 }

 	

	 
?>

<div>
	<div id="homePerfil" class="contSelRolUsuario selActivo">
		<div class="perfilHeader">
			<div id ="fotoPerfilACT" class="perfilIMG" onclick="loadImg();">
				<img title="Perfil" alt="Foto Perfil" src="<?php echo $Persona->getPic() ; ?>">
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
		<!-- PERFIL CONFIGURACION -->
		<div id="perfilConfiguracion" class="contSelRolUsuario">
	
		</div>
		
		
		
		
		
		<!-- Cambio de clave -->

		
		<div id="perfilCambioClave" class="contSelRolUsuario">
			
		</div>
		
		<!-- Datos Personales -->
		
		
		<div id="perfilDatosPersonales" class="contSelRolUsuario">
		
		</div>
		
		<!-- Domicilio y Contacto -->
		
		<div id="perfilDomicilioYContacto" class="contSelRolUsuario">

		</div>
		
		<!-- TAGS -->
		
		<div id="perfilMisTags" class="contSelRolUsuario">
			
		</div>
		
		
		<!-- Mis Trabajos -->
		<div id="perfilMisTrabajos" class="contSelRolUsuario">

		</div>
		<!-- Añadir trabajos -->
		
		<div id="perfilAddModTrabajos" class="contSelRolUsuario">
		

		</div>
		
		
		<!-- Mis Estudios -->
		
		<div id="perfilMisEstudios" class="contSelRolUsuario">
		
		</div>
		
		<!-- Añadir estudios -->
		
		<div id="perfilAddModEstudios" class="contSelRolUsuario">

		</div>
			<div id="saving"  class="contSelRolUsuario">
				<div class="titleSelRol"></div>
				<div id="loadingRoll">
					<img alt="" src="imagenes/iconos/loading.png">
				</div>
			</div>
		</div>


		<script>
	

				
				function clearInput(a) {
					a.value = "";
				}



				
	$('#uploadFileCont').load('php/perfilUploadFE.php');


	function goBacktoPerfil(a) {
		$('body').css("overflow","hidden");
		if (a == 1) { $('#perfilConfiguracion').fadeOut(); }
		else if (a == 2) { $('#perfilDatosPersonales').fadeOut();  }
		else if (a == 3) { $('#perfilDomicilioYContacto').fadeOut(); }
		else if (a == 4) { $('#perfilMisTags').fadeOut(); }
		else if (a == 5) { $('#perfilMisTrabajos').fadeOut(); }
		else if (a == 6) { $('#perfilMisEstudios').fadeOut(); }
		else if (a == 7) { 
			$('#perfilAddModTrabajos').fadeOut(); 
			setTimeout(function() {
				$('#perfilMisTrabajos').show();
				$('#perfilMisTrabajos').animate({'left': '50%', 'margin-left': -$('#perfilMisTrabajos').width()/2 });
			}, 500);
			setTimeout(function() {
				$('body').css("overflow","auto");
			}, 500);
			return;
		}
		else if (a == 8) { 
			$('#perfilAddModEstudios').fadeOut(); 
			setTimeout(function() {
				$('#perfilMisEstudios').show();
				$('#perfilMisEstudios').animate({'left': '50%', 'margin-left': -$('#perfilMisEstudios').width()/2 });
			}, 500);
			setTimeout(function() {
				$('body').css("overflow","auto");
			}, 900);
			return;
		}
		else if (a == 9) { 
			$('#perfilCambioClave').fadeOut(); 
			setTimeout(function() {
				$('#perfilConfiguracion').show();
				$('#perfilConfiguracion').animate({'left': '50%', 'margin-left': -$('#perfilConfiguracion').width()/2 });
			}, 500);
			setTimeout(function() {
				$('body').css("overflow","auto");
			}, 900);
			return;
		}
		setTimeout(function() {
			$('#homePerfil').show();
			$('#homePerfil').animate({'left': '50%', 'margin-left': -$('#homePerfil').width()/2 });
			setTimeout(function() {
				$('body').css("overflow","auto");
			}, 500);
		}, 500);
		
}
	function goBacktoAndSavePerfil(a) {
		$('body').css("overflow","hidden");
		var volver = false;
		     if (a == 1) { if (validateConfig() == true) { $('#perfilConfiguracion').fadeOut(); volver = true; } }
		else if (a == 2) { if (validateDP() == true) { $('#perfilDatosPersonales').fadeOut(); volver = true; } }
		else if (a == 3) { if (validateDOM() == true) { $('#perfilDomicilioYContacto').fadeOut(); volver = true; } }
		else if (a == 4) { if (validateTag() == true) { $('#perfilMisTags').fadeOut(); volver = true; } }
		else if (a == 5) { $('#perfilMisTrabajos').fadeOut(); volver = true; }
		else if (a == 6) { $('#perfilMisEstudios').fadeOut(); volver = true; }
		else if (a == 7) { 
			if (validateModWork() == true) {
				$('#perfilAddModTrabajos').fadeOut(); 
				volver = true; 
			if (volver == true) {
				setTimeout(function() {
					$('#perfilMisTrabajos').show();
					$('#perfilMisTrabajos').animate({'left': '50%', 'margin-left': -$('#perfilMisTrabajos').width()/2 });
				}, 500);
				loadWorkList();
			}
			volver = false;
			}
		}
		else if (a == 8) { 
			if (validateModEst() == true) { 
				$('#perfilAddModEstudios').fadeOut(); 
				volver = true; 
				if (volver == true) {
					setTimeout(function() {
						$('#perfilMisEstudios').show();
						$('#perfilMisEstudios').animate({'left': '50%', 'margin-left': -$('#perfilMisEstudios').width()/2 });
					}, 500);
					loadEduList();
				}
				volver = false;
			}
		}

		else if (a == 9) { 

			if (validateModClave() == true) { 
				$('#perfilCambioClave').fadeOut(); 
				volver = true; 
				if (volver == true) {
					setTimeout(function() {
						$('#perfilConfiguracion').show();
						$('#perfilConfiguracion').animate({'left': '50%', 'margin-left': -$('#perfilConfiguracion').width()/2 });
					}, 500);
				}
				volver = false;
			}
		}
		if (volver == true) {
			setTimeout(function() {
				$('#homePerfil').show();
				$('#homePerfil').animate({'left': '50%', 'margin-left': -$('#homePerfil').width()/2 });
			}, 500);
		}
		setTimeout(function() {
			$('body').css("overflow","auto");
		}, 900);
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
		
		$('body').css("overflow","hidden");
		$('input').removeClass('notSelected');
		if (a != 7 && a != 8) {
			$('#homePerfil').animate({
				'marginLeft' : "-=1500px"
			},500,function() {
				$('#homePerfil').hide();
			});	
		}
			if (a == 1) { setTimeout(function() { $('#perfilConfiguracion').fadeIn(); }, 500); }
			else if (a == 2) { setTimeout(function() { $('#perfilDatosPersonales').fadeIn(); }, 500); }
			else if (a == 3) { setTimeout(function() { $('#perfilDomicilioYContacto').fadeIn(); }, 500); }
			else if (a == 4) { setTimeout(function() { $('#perfilMisTags').fadeIn(); }, 500); }
			else if (a == 5) { setTimeout(function() { $('#perfilMisTrabajos').fadeIn(); }, 500); }
			else if (a == 6) { setTimeout(function() { $('#perfilMisEstudios').fadeIn(); }, 500); }
			else if (a == 7) { 
				$('#perfilMisTrabajos').animate({
					'marginLeft' : "-=1500px"
				},500,function(){
					$('#perfilMisTrabajos').hide();
					$('#perfilAddModTrabajos').fadeIn();
				});	
				
		}
			else if (a == 8) { 
				$('#perfilMisEstudios').animate({
					'marginLeft' : "-=1500px"
				},500,function(){
					$('#perfilMisEstudios').hide();
					$('#perfilAddModEstudios').fadeIn();
				});	
				
		}
			else if (a == 9) {
				$('#claveOriginal').val("");
				$('#claveCambio1').val("");
				$('#claveCambio2').val("");
				$('#saveClave').html("");
				$('#perfilConfiguracion').animate({
					'marginLeft' : "-=1500px"
				},500,function(){
					$('#perfilConfiguracion').hide();
					$('#perfilCambioClave').fadeIn();
				});	
				
			}

			

			
			setTimeout(function() {
				$('body').css("overflow","auto");
			}, 900);
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

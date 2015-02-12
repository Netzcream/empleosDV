<?php

if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}
 
	
	if (!isset($_SESSION)) {
		session_start();
	}
	$_SESSION['location'] = "perfilHome";
	$mostrarUsuario = $_SESSION['usuario'];
	if (isset($_SESSION['MostrarNombre'])) {
	 	$mostrarUsuario = $_SESSION['MostrarNombre'];
	 }

	 if (isset($_SESSION["usr"])) {
	 	$_SESSION["usr"] = unserialize (serialize ($_SESSION['usr']));
	 	$Persona = $_SESSION["usr"];
	 }
	 else {
	 	//LOGERROR
	 }

 	
	 $conex = new MySQL();
	 $consulta = "SELECT ID_TipoDocumento as id,Descripcion as des, AdmiteLetras as letras from tipodocumento;";
	 $result = $conex->consulta($consulta);
	 
	 
	 $row = mysql_fetch_array($result, MYSQL_ASSOC);
	 	
	 while ($row) {
	 	$tipoDocumentos[] = array(utf8_encode($row['des']), $row['id'],$row['letras']);
	 	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	 }
	 	
	 	
	 $consulta = "SELECT ID_Provincia as id,Provincia as prov FROM provincia order by prov ASC;";
	 $result = $conex->consulta($consulta);
	 	
	 	
	 $row = mysql_fetch_array($result, MYSQL_ASSOC);
	 $first = "";
	 while ($row) {
	 
	 	$provincias[] = array(utf8_encode($row['prov']), $row['id']);
	 	if ($first == "") {
	 		$first = $row['id'];
	 	}
	 	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	 }
	 if ($Persona->getDomicilio()->getLoc()->getProvincia()->getId()) {
	 	$first = $Persona->getDomicilio()->getLoc()->getProvincia()->getId();
	 }
	 $consulta = "SELECT ID_Localidad as id, Localidad as loc FROM LOCALIDAD WHERE ID_Provincia=".$first." order by loc ASC;";
	 $result = $conex->consulta($consulta);
	 
	 
	 $row = mysql_fetch_array($result, MYSQL_ASSOC);
	 $firstLoc = "";
	 while ($row) {
	 		
	 	$localidad[] = array(utf8_encode($row['loc']), $row['id']);
	 	if ($firstLoc == "") {
	 		$firstLoc = $row['id'];
	 	}
	 	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	 }
?>

<div>
	<div id="homePerfil" class="contSelRolUsuario selActivo">
		<div class="perfilHeader">
			<div id ="fotoPerfilACT" class="perfilIMG" onclick="loadImg();">
				<img title="Perfil" alt="Foto Perfil" src="<?php echo $_SESSION["usr"]->getPic() ; ?>">
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
		<br>	
			<div>
				<label class="labelFillDP inline">Correo electr&oacute;nico</label>
			</div>
			<div class="preAdjust">
			
			<input id="editEmail" type="text" class="inputFillDP inputMail" maxlength="50" value="<?php echo $Persona->getEmail(); ?>" placeholder="Correo electr&oacute;nico">
			</div>
		<br>	
			<div>
				<input type="button" class="perfilBtnSeeMyCV" value="Cambiar mi clave" onclick="">
				<div class="notationLabel">
				&Uacute;ltimo cambio: 
				<?php echo $Persona->getFechaCambioPass()->getFechaCompleta();?>
				</div>
			</div>
		<br>
			<div>
				<label class="labelCheckbox"><input id="checkNotByEmail" type="checkbox" class="checkboxAlineado" value="" onclick=""><span>Recibir notificaciones por correo electr&oacute;nico.</span></label>
				<label class="labelCheckbox"><input type="checkbox" class="checkboxAlineado" value="" onclick=""><span>Permitir que las empresas me encuentren.</span></label>
			</div>
			
			
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(1);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(1);">
			</div>		
		</div>
		
		<div id="perfilDatosPersonales" class="contSelRolUsuario">
			<div class="titleSelRol">Datos Personales</div>

				<div>
					<label class="labelFillDP inline">Apellido</label>
					<label class="labelFillDP inline">Nombre</label>
				</div>
				<div>
					<input id="addApellido" type="text" class="inputFillDP" maxlength="50" value="<?php echo $Persona->getApellido(); ?>" placeholder="Apellido">
					<input id="addNombre" type="text" class="inputFillDP" maxlength="50" value="<?php echo $Persona->getNombre(); ?>" placeholder="Nombre">
				</div>
				<label class="labelFillDP">Sexo</label>
				<div>
				
					<div class="selSexoOnStart <?php if ($Persona->getSexo() == "m") echo "selected"; ?>" id="visibleSexM" onclick="selSex('m');"><img alt="" src="imagenes/iconos/m.png"></div>
					<div class="selSexoOnStart <?php if ($Persona->getSexo() == "f") echo "selected"; ?>" id="visibleSexF" onclick="selSex('f');"><img alt="" src="imagenes/iconos/f.png"></div>
				</div>
				<input class="selRolRadio" type="radio" name="soySexo" id="soyMasc" value="soyMasc" <?php if ($Persona->getSexo() == "m") echo "checked"; ?>>
				<input class="selRolRadio" type="radio" name="soySexo" id="soyFem" value="soyFem" <?php if ($Persona->getSexo() == "f") echo "checked"; ?>>
				<label class="labelFillDP">Documento</label>
				<div>
					<select id="selDocDP" class="selDocDP">
				<?php 
				
				foreach ($tipoDocumentos as $valor) {
					$sel = "";
					if ($Persona->getDocumento()->getId() == $valor[1]) { $sel = "selected = 'selected'"; } 
					echo "<option ".$sel." letras='".$valor[2]."'  value='".$valor[1]."'>".$valor[0]."</option>";
				}
				
				?>					
				</select>
					<input type="text" id="dpNroDoc" class="inputFillDP" maxlength="20" value="<?php echo $Persona->getDocumento()->getDocumento(); ?>" placeholder="Numero Documento">
				</div>
			
			
			
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(2);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(2);">
			</div>		
		</div>
		
		<div id="perfilDomicilioYContacto" class="contSelRolUsuario">
			<div class="titleSelRol">Domicilio y Contacto</div>
			
			
				<div>
					<label class="labelFillDP inline">Calle</label>
					<label class="labelFillDP inline">N&uacute;mero</label>
				</div>
				<div>
					<input id="dpCalle" type="text" class="inputFillDP" value="<?php echo $Persona->getDomicilio()->getCalle(); ?>" placeholder="Av. Corrientes">
					<input id="dpNro" type="text" class="inputFillDP" value="<?php echo $Persona->getDomicilio()->getNum(); ?>" placeholder="1234">
				</div>
	
				<div>
					<label class="labelFillDP inline">Piso</label>
					<label class="labelFillDP inline">Departamento</label>
				</div>
				<div>
					<input id="pisoDP" type="text" value="<?php echo $Persona->getDomicilio()->getPiso(); ?>" class="inputFillDP" placeholder="7">
					<input id="dptoDP" type="text" value="<?php echo $Persona->getDomicilio()->getDpto(); ?>" class="inputFillDP" placeholder="A">
				</div>
	
				<div>
					<label class="labelFillDP inline">Provincia</label>
					<label class="labelFillDP inline">Localidad</label>
				</div>
				<div>
					<select class="selDocDP" id="selProvDP" onchange="selProvDP();">
				<?php 
				
				$idPcia = ($Persona->getDomicilio()->getPcia()->getId());
				if ($idPcia == null OR $idPcia == "") {
					$idPcia = $first;
				}
				foreach ($provincias as $valor) {
					$selection= "";
					if ($idPcia == $valor[1]) {
						$selection= "selected=selected";
					}
					echo "<option ".$selection." value='".$valor[1]."'>".$valor[0]."</option>";
				}
				
				?>		
					</select>
					<div id="toLoadLoc">
					<select id="selLocDP" class="selDocDP">
				<?php 
				
				$idLoc = ($Persona->getDomicilio()->getLoc()->getId());
				if ($idLoc == null OR $idLoc == "") {
					$idLoc = $firstLoc;
				}
				foreach ($localidad as $valor) {
					$selection= "";
					if ($idLoc == $valor[1]) {
						$selection= "selected=selected";
					}
				
				

					echo "<option ".$selection." value='".$valor[1]."'>".$valor[0]."</option>";
				}
				
				?>	
					</select>
					</div>

						
				</div>
					<div class="perfilIndCont" onclick=""><div class="perfilIndBtnMap"><img title="" alt="" src="imagenes/iconos/mapa.png"></div><span>Ver en Mapa</span></div>
			
			
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(3);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(3);">
			</div>		
		</div>
		
		<div id="perfilMisTags" class="contSelRolUsuario">
			<div class="titleSelRol">Mis Tags</div>
		
			<div id="misTags" class="tagConteiner">
			
			<?php 
			foreach ($Persona->getTags()->getTags() as $a) {
					echo "<div class='tag' onclick='delTags(".'"'.$a.'"'.");'>".$a."</div>";
				}
			?>
			</div>
			
		<div class="groupTagAdd">
		<input id="tag" type="text" value="" class="inputFillDP inputTag" placeholder="Ingresar Tag">
		<input type="button" class="perfilBtnSeeMyCV" value="A&ntilde;adir Tag" onclick="addTags();">
		</div>
		
		
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(4);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(4);">
			</div>		
		</div>
		
		<div id="perfilMisTrabajos" class="contSelRolUsuario">
			<div class="titleSelRol">Mis Trabajos</div>
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(5);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(5);">
			</div>
		</div>
		
		<div id="perfilMisEstudios" class="contSelRolUsuario">
			<div class="titleSelRol">Mis Estudios</div>
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(6);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(6);">
			</div>
		</div>
		
		
			<div id="saving"  class="contSelRolUsuario">
				<div class="titleSelRol"></div>
				<div id="loadingRoll">
					<img alt="" src="imagenes/iconos/loading.png">
				</div>
			</div>
		
</div>
<script>
				
	$('#uploadFileCont').load('php/perfilUploadFE.php');
	function selSex(a) {
		$('.selSexoOnStart').removeClass('notSelected');
		$('.selSexoOnStart').removeClass('selected');
		if (a == 'm') {
			$('#soyMasc').click();
			$('#visibleSexM').addClass('selected');
		}
		else {
			$('#soyFem').click();
			$('#visibleSexF').addClass('selected');
		}
	}

	function goBacktoPerfil(a) {
		if (a == 1) { $('#perfilConfiguracion').fadeOut(); }
		else if (a == 2) { $('#perfilDatosPersonales').fadeOut();  }
		else if (a == 3) { $('#perfilDomicilioYContacto').fadeOut(); }
		else if (a == 4) { $('#perfilMisTags').fadeOut(); }
		else if (a == 5) { $('#perfilMisTrabajos').fadeOut(); }
		else if (a == 6) { $('#perfilMisEstudios').fadeOut(); }
		setTimeout(function() {
			$('#homePerfil').show();
			$('#homePerfil').animate({'left': '50%', 'margin-left': -$('#homePerfil').width()/2 });
		}, 500);
}
	function goBacktoAndSavePerfil(a) {
		var volver = false;
		if (a == 1) { $('#perfilConfiguracion').fadeOut(); volver = true; }
		else if (a == 2) { if (validateDP() == true) { $('#perfilDatosPersonales').fadeOut(); volver = true; } }
		else if (a == 3) { if (validateDOM() == true) { $('#perfilDomicilioYContacto').fadeOut(); volver = true; } }
		else if (a == 4) { $('#perfilMisTags').fadeOut(); volver = true; }
		else if (a == 5) { $('#perfilMisTrabajos').fadeOut(); volver = true; }
		else if (a == 6) { $('#perfilMisEstudios').fadeOut(); volver = true; }
		if (volver == true) {
			setTimeout(function() {
				$('#homePerfil').show();
				$('#homePerfil').animate({'left': '50%', 'margin-left': -$('#homePerfil').width()/2 });
			}, 500);
		}
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
	function selProvDP() {
		$('#selLocDP').prop('disabled', true);
		$('#toLoadLoc').load('php/localidades.php',{provID:$('#selProvDP').val()});
	}

	function validateDOM() {
		var errores = 0;
		var patron = new RegExp('^[0-9]+$');
		$('.inputFillDP').removeClass('notSelected');
		if ($('#dpCalle').val() == "") {
			$('#dpCalle').addClass('notSelected');
			errores++;
		}
		if ($('#dpNro').val() == "") {
			$('#dpNro').addClass('notSelected');
			errores++;
		}
		
		if (errores > 0) {
			errorToas();
			return false;
		}
		return true;
	}
	function validateDP() {
		var errores = 0;
		var patron = new RegExp('^[0-9]+$');
		
		$('.inputFillDP').removeClass('notSelected');
		if ($('#addApellido').val() == "") {
			$('#addApellido').addClass('notSelected');
			errores++;
		}
		else if ($('#addApellido').val().length < 3) {
			$('#addApellido').addClass('notSelected');
			errorToas('El apellido debe contener 3 o m&aacute;s caracteres.');
			errores++;
		}
		else if ($('#addApellido').val().length > 50) {
			$('#addApellido').addClass('notSelected');
			errorToas('No se permiten apellidos que superen los 50 caracteres.');
			errores++;
		}
		if ($('#addNombre').val() == "") {
			$('#addNombre').addClass('notSelected');
			errores++;
		}
		else if ($('#addNombre').val().length < 3) {
			$('#addNombre').addClass('notSelected');
			errorToas('El nombre debe contener 3 o m&aacute;s caracteres.');
			errores++;
		}
		else if ($('#addNombre').val().length > 50) {
			$('#addNombre').addClass('notSelected');
			errorToas('No se permiten nombres que superen los 50 caracteres.');
			errores++;
		}
		if ($("input[name=soySexo]:checked").val() == null) {
			$('.selSexoOnStart').addClass('notSelected');
			errores++;
		}
		$("#dpNroDoc").val($("#dpNroDoc").val().replace(/\./g, ''));
		$("#dpNroDoc").val($("#dpNroDoc").val().replace(/\-/g, ''));
		$("#dpNroDoc").val($("#dpNroDoc").val().replace(/\ /g, ''));
		
		if ($("#dpNroDoc").val() == "") {
			$('#dpNroDoc').addClass('notSelected');
			errores++;
		}
		else if ($('#dpNroDoc').val().length < 5) {
			$('#dpNroDoc').addClass('notSelected');
			errorToas('El n&uacute;mero de documento debe contener 5 o m&aacute;s caracteres.');
			errores++;
		}
		else if ($('#dpNroDoc').val().length > 20) {
			$('#dpNroDoc').addClass('notSelected');
			errorToas('No se permiten n&uacute;meros de documento que superen los 20 caracteres.');
			errores++;
		}
		else if (patron.test($('#dpNroDoc').val()) == false && document.getElementById("selDocDP").options[document.getElementById("selDocDP").selectedIndex].getAttribute('letras') != '1') {
			$('#dpNroDoc').addClass('notSelected');
			errorToas('Debe ingresar valores n&uacute;mericos para el documento.');
			errores++;
		}
		if (errores > 0) {
			errorToas('Debes ingresar y/o seleccionar los campos obligatorios.');
			return false;
		}
		return true;
	}
	function addTags() {
		
		if ($('#tag').val() == "" || $('#tag').val() == null) {
			errorToas('Debe ingresar un tag.');
			
		}
		else {
			$('#misTags').load('php/addOrRemoveTag.php',{ action:'add',tag : $('#tag').val()});
			$('#tag').val("");
		}
	}
	function delTags(tag) {
		$('#misTags').load('php/addOrRemoveTag.php',{ action:'remove',tag : tag});
	}

	$("#tag").keyup(function (e) {
	    if (e.keyCode == 13) {
	    	addTags();
	    }
	});

		
</script>

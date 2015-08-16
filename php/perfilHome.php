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
	
	$_SESSION['location'] = "perfilHome";
	$mostrarUsuario = "NN";
	$Persona = new Persona();
	 if (isset($_SESSION["usr"])) {
	 	$Persona = unserialize (serialize ($_SESSION['usr']));
	 	if ($Persona->getApellido() != "" && $Persona->getNombre() != "") {
		 	$mostrarUsuario = $Persona->getApellido().", ".$Persona->getNombre();
		 	$_SESSION['MostrarNombre'] = $mostrarUsuario; 
	 	}
	 	if ($Persona->getRol()->getId() == "EM") {
	 		if ($Persona->getNombre() != "") {
	 			$mostrarUsuario = $Persona->getNombre();
	 		}
	 	}
	 	$Persona->setTags(new Tag());
	 	$Persona->getTags()->getAndSetTagsByUsuario($Persona->getId());
	 	$_SESSION["usr"] = $Persona;
	 	
	 }
	 else {
	 	//LOGERROR
	 }
	 $conex = new MySQL();
	 $consulta = "SELECT ID_TipoDocumento as id,Descripcion as des, AdmiteLetras as letras from tipodocumento;";
	 $result = $conex->consulta($consulta);
	 
	 
	 $row = $conex->fetch_array();
	 	
	 while ($row) {
	 	$tipoDocumentos[] = array($row['des'], $row['id'],$row['letras']);
	 	$row = $conex->fetch_array();
	 }
	 	
	 	
	 $consulta = "SELECT ID_Provincia as id,Provincia as prov FROM provincia order by prov ASC;";
	 $result = $conex->consulta($consulta);
	 	
	 $row = $conex->fetch_array();
	 $first = "";
	 while ($row) {
	 
	 	$provincias[] = array($row['prov'], $row['id']);
	 	if ($first == "") {
	 		$first = $row['id'];
	 	}
	 	$row = $conex->fetch_array();
	 }
	 if ($Persona->getDomicilio()->getLoc()->getProvincia()->getId()) {
	 	$first = $Persona->getDomicilio()->getLoc()->getProvincia()->getId();
	 }
	 $consulta = "SELECT ID_Localidad as id, Localidad as loc FROM LOCALIDAD WHERE ID_Provincia=".$first." order by loc ASC;";
	 $result = $conex->consulta($consulta);
	 
	 
	 $row = $conex->fetch_array();
	 $firstLoc = "";
	 while ($row) {
	 		
	 	$localidad[] = array($row['loc'], $row['id']);
	 	if ($firstLoc == "") {
	 		$firstLoc = $row['id'];
	 	}
	 	$row = $conex->fetch_array();
	 }
?>

<div>
	<div id="homePerfil" class="contSelRolUsuario selActivo">
		<div class="perfilHeader">
			<div id ="fotoPerfilACT" class="perfilIMG" onclick="loadImg();">
				<img title="Perfil" alt="Foto Perfil" src="<?php echo $_SESSION["usr"]->getPic() ; ?>">
				<img class="upload" title="Cambiar imagen de perfil" alt="Foto Perfil" src="imagenes/iconos/upload_blanco.png">
			</div>
			<div class="perfilNombre"><?php echo $mostrarUsuario." <span class='notationLabel'>(".$Persona->getRol()->getRol().")<span>";  ?></div>
		</div>
		
		<div class="perfilBtns">
		
		<?php if($Persona->getRol()->getId() != "AD"): ?>
			<div class="perfilIndCont" onclick="loadSectionPerfil(1);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/configuracion.png"></div> <span>Configuraci&oacute;n</span></div>
			<div class="perfilIndCont" onclick="loadSectionPerfil(2);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/estudiante.png"></div><span>Datos Personales</span></div>
			<div class="perfilIndCont" onclick="loadSectionPerfil(3);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/casa.png"></div><span>Domicilio y Contacto</span></div>
		<?php endif; ?>
		<?php if($Persona->getRol()->getId() == "AL"): ?>
			<div class="perfilIndCont" onclick="loadSectionPerfil(4);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/tag.png"></div><span>Mis Tags</span></div>
			<div class="perfilIndCont" onclick="loadSectionPerfil(5);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/trabajo.png"></div><span>Mis Trabajos</span></div>
			<div class="perfilIndCont" onclick="loadSectionPerfil(6);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/estudios.png"></div><span>Mis Estudios</span></div>
		<?php endif; ?>
		<?php if($Persona->getRol()->getId() == "PR"): ?>
			
			<div class="perfilIndCont" onclick="loadSectionPerfil(5);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/trabajo.png"></div><span>Mis Alumnos</span></div>
			
		<?php endif; ?>
		
		<?php if($Persona->getRol()->getId() == "EM"): ?>
		
			<div class="perfilIndCont" onclick="loadSectionPerfil(10);"><div class="perfilIndBtn"><img title="" alt="" src="imagenes/iconos/trabajo.png"></div><span>Bolsa de trabajo</span></div>
		<?php endif; ?>
			
		</div>
		
		<?php if($Persona->getRol()->getId() == "AL"): ?>
		<div>
			<a class="perfilBtnSeeMyCV" target='_blank' href='php/imprimirCVde.php?cv=<?php echo $Persona->getId(); ?>'>Ver mi curriculum</a>
			<!--  <a class="perfilBtnSeeMyCV" type="submit" value="Ver mi curriculum" target='_blank' href='php/imprimirCVde.php?cv='/>  -->
		</div>
		<?php endif; ?>
	</div>
	
		<div id="uploadFileCont" class="contSelRolUsuario">
		
		</div>
		
		<div id="perfilConfiguracion" class="contSelRolUsuario">
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
		</div>
		
		
		
		
		
		<!-- Cambio de clave -->

		
		<div id="perfilCambioClave" class="contSelRolUsuario">
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
			<div>
				<label class="labelFillDP">Fecha nacimiento</label>
				<input type="text" id="listFechaNacimiento" value=""/>
				<div style="display: none;" id="pruebaFechas"></div>
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
			<div id="saveDP"></div>
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
					<input maxlength="50" id="dpCalle" type="text" class="inputFillDP" value="<?php echo $Persona->getDomicilio()->getCalle(); ?>" placeholder="Av. Corrientes">
					<input maxlength="6" id="dpNro" type="text" class="inputFillDP" value="<?php echo $Persona->getDomicilio()->getNum(); ?>" placeholder="1234">
				</div>
	
				<div>
					<label class="labelFillDP inline">Piso</label>
					<label class="labelFillDP inline">Departamento</label>
				</div>
				<div>
					<input maxlength="6" id="pisoDP" type="text" value="<?php echo $Persona->getDomicilio()->getPiso(); ?>" class="inputFillDP" placeholder="7">
					<input maxlength="1" id="dptoDP" type="text" value="<?php echo $Persona->getDomicilio()->getDpto(); ?>" class="inputFillDP" placeholder="A">
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
				<div>
				<?php $tipo = new Telefono(); ?>
					<label class="labelFillTel inline">Tel.:</label> 
					<select id="telid1" class="perfilTelType">
				<?php 
				foreach ($tipo->getColTipos() as $id => $value)
					echo "<option value='$id'>$value</option>";	
					
				?>
					</select>
					<input type="tel" class="inputFillDPTel" maxlength="14" placeholder="Telefono 1"/>
				</div>
				<div>
					<label class="labelFillTel inline">Tel.:</label>
					<select id="telid2" class="perfilTelType">
				<?php 
				foreach ($tipo->getColTipos() as $id => $value)
					echo "<option value='$id'>$value</option>";	
					
				?>
					</select>
					<input type="tel" class="inputFillDPTel" maxlength="14" placeholder="Telefono 2"/>
				</div>
				<div>
					<label class="labelFillTel inline">Tel.:</label>
					<select id="telid3" class="perfilTelType">
				<?php 
				foreach ($tipo->getColTipos() as $id => $value)
					echo "<option value='$id'>$value</option>";	
					
				?>
					</select>
					<input type="tel" class="inputFillDPTel" maxlength="14" placeholder="Telefono 3"/>
				</div>
				<!-- 	<div class="perfilIndCont" onclick=""><div class="perfilIndBtnMap"><img title="" alt="" src="imagenes/iconos/mapa.png"></div><span>Ver en Mapa</span></div>
			 -->
			<div id="perfilSaveDom"></div>
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(3);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(3);">
			</div>		
		</div>
		
		<div id="perfilMisTags" class="contSelRolUsuario">
			<div class="titleSelRol">Mis Tags</div>
		
			<div id="misTags" class="thingsConteiner">
			
			<?php 

			foreach ($Persona->getTags()->getTags() as $a) {
					echo "<div class='tag' onclick='delTags(".'"'.$a.'"'.");'>".$a."</div>";
				}
			?>
			</div>
			
		<div class="groupTagAdd">
		<input id="tag" maxlength="50" type="text" value="" class="inputFillDP inputTag" placeholder="Ingresar Tag">
		<input type="button" class="perfilBtnSeeMyCV" value="A&ntilde;adir Tag" onclick="addTags();">
		</div>
		
		<div class="notationLabel">
		Los cambios impactar&aacute;n en la base de datos &uacute;nicamente al guardarlos.
		</div>
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(4);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(4);">
			</div>		
		</div>
		
		<div id="perfilMisTrabajos" class="contSelRolUsuario">
			<div class="titleSelRol">Mis Trabajos</div>
			
			<div id="misTrabajos" class="thingsConteiner2">
			
			

		
			</div>
		<div>
			<input type="button" class="perfilBtnSeeMyCV" value="A&ntilde;adir Nuevo" onclick="agregarWork(); loadSectionPerfil(7);">
		</div>
			
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Volver" onclick="goBacktoPerfil(5);">
			</div>
		</div>
		
		<div id="perfilAddModTrabajos" class="contSelRolUsuario">
		
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
				<input id="currentWorkID" type="hidden" value="">
				<input id="currentWorkAction" type="hidden" value="">
			
			<div class="finRecuadroPerfil">
				<input id="workBtn1" type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(7);">
				<input id="workBtn2" type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(7);">
			</div>
		</div>
		
		
		
		
		
		
		
		

			
		<?php if($Persona->getRol()->getId() == "EM"): ?>
		
		<div id="perfilBolsaTrabajo" class="contSelRolUsuario">
			<div class="titleSelRol">Mis publicaciones</div>
			
			<div id="mibolsa" class="thingsConteiner2">
			
			

		
			</div>
		<div>
			<input type="button" class="perfilBtnSeeMyCV" value="A&ntilde;adir Nuevo" onclick="agregarBolsa(); loadSectionPerfil(11);">
		</div>
			
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Volver" onclick="goBacktoPerfil(10);">
			</div>
		</div>
		
		<div id="perfilAddBolsaTrabajo" class="contSelRolUsuario">
		
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
				<option>opcion</option>
				</select>
				<select id="workSenioritySel">
				<option>opcion</option>
				</select>
				</div>
				<div id="perfilAddModWorkLoad"></div>
				<input id="currentWorkID" type="hidden" value="">
				<input id="currentWorkAction" type="hidden" value="">
			
			<div class="finRecuadroPerfil">
				<input id="workBtn1" type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(11);">
				<input id="workBtn2" type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(11);">
			</div>
		</div>
		<?php endif; ?>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<div id="perfilMisEstudios" class="contSelRolUsuario">
			<div class="titleSelRol">Mis Estudios</div>
			
		<div id="misEstudios" class="thingsConteiner3">
			
		<!-- Se carga la tabla de estudios -->
			
		</div>
		
		<div>
			<input type="button" class="perfilBtnSeeMyCV" value="A&ntilde;adir Nuevo" onclick="agregarEdu(); loadSectionPerfil(8);">
		</div>
		
		
			<div>
					<label class="labelFillDP inline">Carreras DaVinci&nbsp;&nbsp;&nbsp;</label>
					<label class="labelFillDP inline">% aprobado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				</div>
			
		<div class="groupTagAdd">
			
			<select class="selDocDP selCarreraDavinci" id="selCarrera" onchange="selCarreraToEdit();">
			<?php 
				$carreras = new Carrera();
				$carreraDV = $Persona->getCarreraDv();
				foreach ($carreras->getCarrerasActivas() as $id => $carrera) {
					$selection = "";
					if ($carreraDV == $id) {
						$selection= "selected=selected";
					}
					echo "<option ".$selection." value='".$id."'>".$carrera."</option>";
				}
				$porcentaje = '0';
				$porcentaje = $Persona->getAvanceByCarrera($carreraDV);
				if ($porcentaje < 1) {
						$porcentaje = '0';
				}
			?>
				
			</select>
			<input type="hidden" value="<?php echo $carreraDV; ?>" id="selectedCarrera">
			<div class="limitRange2">
					<input id="bBuscarPorcentaje" type="range" min="0" max="100" value="<?php echo $porcentaje; ?>"  onchange="actualizaPorc2(value);"/>
					
				<script>
				function actualizaPorc2(prc) {
					document.querySelector('#bPorcentaje2').value = prc+" %";
					}
				</script>
			</div>
			<output for="bBuscarPorcentaje" id="bPorcentaje2"><?php echo $porcentaje; ?> %</output>	
			<div id="justForCarreras"></div>	
		</div>
		
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Volver" onclick="selCarreraToEdit(); goBacktoPerfil(6);">
			</div>
		</div>
		
		
		<div id="perfilAddModEstudios" class="contSelRolUsuario">
		
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
		<input id="currentEDUID" type="hidden" value="">
		<input id="currentEDUAction" type="hidden" value="">
			
			<div class="finRecuadroPerfil">
				<input id="eduBtn1" type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(8);">
				<input id="eduBtn2" type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(8);">
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
				loadWorkList();
				loadEduList();
				function loadEduList() {
					$('#misEstudios').load('php/addOrRemoveEstudios.php',{action:"list"});
				}


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
				function loadAndEditEdu(a){
					clearEdu();
					$('#titleEst').html("Modificar estudios");
					$('#perfilAddModEstudiosLoad').load('php/addOrRemoveEstudios.php',{action:"load",id:a});
					$("#eduBtn1").val("Cancelar");
					$("#eduBtn2").val("Modificar");
					$("#currentEDUAction").val("edit");
					
					//Carga el formulario de estudios con los datos del id a modificarlo
					//Todo en enable
				}
				function loadAndRemoveEdu(a) {
					clearEdu();
					$("#indEduInst").prop('disabled', true);
					$("#indEduTit").prop('disabled', true);
					$("#eduNivelEst").prop('disabled', true);
					$('#titleEst').html("Eliminar estudios");
					$('#perfilAddModEstudiosLoad').load('php/addOrRemoveEstudios.php',{action:"load",id:a});
					$("#eduBtn1").val("Cancelar");
					$("#eduBtn2").val("Eliminar");
					$("#currentEDUAction").val("remove");
					//Carga el formulario de estudios con los datos del id a para eliminarlo
					//(Poner todo en disable)
				}
				function agregarEdu() {
					clearEdu();
					$('#titleEst').html("Agregar estudios");
					$("#currentEDUAction").val("add");
					
					//Carga el formulario de estudios listo para agregar uno nuevo
				}
				function clearEdu() {
					$('input').removeClass('notSelected');
					$("#indEduInst").prop('disabled', false);
					$("#indEduTit").prop('disabled', false);
					$("#eduNivelEst").prop('disabled', false);
					
					$('#eduNivelEst option:selected').removeAttr('selected');
					$('#titleEst').html("");
					$("#indEduInst").val("");
					$("#indEduTit").val("");
					$("#listAddStuDesde").val("");
					$("#listAddStuHasta").val("");
					$("#eduNivelEst option:first").attr("selected","selected");
					$("#currentEDUID").val("new");
					$("#eduBtn1").val("Cancelar");
					$("#eduBtn2").val("Agregar");
					//Limpia el formulario de estudios.
					//Todo en enable
				}



				
				function clearInput(a) {
					a.value = "";
				}



				
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
		$('body').css("overflow","hidden");
		if (a == 1) { $('#perfilConfiguracion').fadeOut(); }
		else if (a == 2) { $('#perfilDatosPersonales').fadeOut();  }
		else if (a == 3) { $('#perfilDomicilioYContacto').fadeOut(); }
		else if (a == 4) { $('#perfilMisTags').fadeOut(); }
		else if (a == 5) { $('#perfilMisTrabajos').fadeOut(); }
		else if (a == 6) { $('#perfilMisEstudios').fadeOut(); }
		else if (a == 10) { $('#perfilBolsaTrabajo').fadeOut(); }
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
		else if (a == 11) { 
			$('#perfilAddBolsaTrabajo').fadeOut(); 
			setTimeout(function() {
				$('#perfilBolsaTrabajo').show();
				$('#perfilBolsaTrabajo').animate({'left': '50%', 'margin-left': -$('#perfilBolsaTrabajo').width()/2 });
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
					setTimeout(function() {
						loadWorkList();
					}, 500);
					
				}, 500);
				
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
						setTimeout(function() {
							loadEduList();
						}, 500);
					}, 500);
					
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
		
		$('#pruebaFechas').load('php/cargaScripts.php');
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
			else if (a == 10) { setTimeout(function() { 
				GoTo(8);
				}, 500); 
			}
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
			else if (a == 11) { 
				
				$('#perfilBolsaTrabajo').animate({
					'marginLeft' : "-=1500px"
				},500,function(){
					$('#perfilBolsaTrabajo').hide();
					$('#perfilAddBolsaTrabajo').fadeIn();
				});	
		}
			

			
			setTimeout(function() {
				$('body').css("overflow","auto");
			}, 900);
	}
	function agregarBolsa() {
		return true;
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
	function selCarreraToEdit() {
		var carrera1 = $('#selectedCarrera').val();
		var carrera2 = $('#selCarrera').val();
		var val = $('#bBuscarPorcentaje').val();
		$('#selectedCarrera').val($('#selCarrera').val());
		$('#justForCarreras').load('php/addOrRemovePercentCarreras.php',{action:'yes',carrera1:carrera1,carrera2:carrera2,val:val});
	}
	function validateDOM() {
		var errores = 0;
		var patron = new RegExp('^[0-9]+$');
		$('.inputFillDP').removeClass('notSelected');
		var calle = $('#dpCalle').val();
		var nro = $('#dpNro').val();
		var piso = $('#pisoDP').val();
		var dpto = $('#dptoDP').val();
		var prov = $('#selProvDP').val();
		var loc = $('#selLocDP').val();
		if (calle == "" || calle.length > 50) {
			$('#dpCalle').addClass('notSelected');
			errores++;
		}
		if (piso.length > 6) {
			$('#pisoDP').addClass('notSelected');
			errores++;
		}
		if (dpto.length > 1) {
			$('#dptoDP').addClass('notSelected');
			errores++;
		}
		
		if (errores > 0) {
			errorToas();
			return false;
		}
		$('#perfilSaveDom').load('php/addOrRemoveDomicilio.php',{
			action:"save",
			calle:calle,
			nro:nro,
			piso:piso,
			dpto:dpto,
			prov:prov,
			loc:loc
				});
		
		return true;
	}
	function validateConfig() {
		var errores = 0;
		var notificarme = $('#checkNotByEmail').is(':checked');
		var encontrarme = $('#checkNotFindMe').is(':checked');
		
		
		$('#saveConfig').load('php/addOrRemoveConfig.php',{action:"save",notificarme:notificarme,encontrarme:encontrarme});
		return true;
	}
	function validateDP() {
		var errores = 0;
		var patron = new RegExp('^[0-9]+$');
		
		$('.inputFillDP').removeClass('notSelected');
		var nac = $('#listFechaNacimiento').val();
		var apellido = $('#addApellido').val(); 
		var nombre = $('#addNombre').val();
		var tipo = $('#selDocDP').val();

		var sexo = '';
		if ($('#soyMasc').is(':checked') == true) {
			sexo = 'm';
		}
		else {
			sexo = 'f';
		}
		if (nac == "" || nac == "Nacimiento") {
			$('#listFechaNacimiento').addClass('notSelected');
			errores++;
		}
		if (apellido == "") {
			$('#addApellido').addClass('notSelected');
			errores++;
		}
		else if (apellido.length < 3) {
			$('#addApellido').addClass('notSelected');
			errorToas('El apellido debe contener 3 o m&aacute;s caracteres.');
			errores++;
		}
		else if (apellido.length > 50) {
			$('#addApellido').addClass('notSelected');
			errorToas('No se permiten apellidos que superen los 50 caracteres.');
			errores++;
		}
		if (nombre == "") {
			$('#addNombre').addClass('notSelected');
			errores++;
		}
		else if (nombre.length < 3) {
			$('#addNombre').addClass('notSelected');
			errorToas('El nombre debe contener 3 o m&aacute;s caracteres.');
			errores++;
		}
		else if (nombre.length > 50) {
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
		var doc = $("#dpNroDoc").val(); 
		
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
		//Guardar en la base de datos
		$('#saveDP').load('php/addOrRemoveDP.php',{action:"save",nac:nac,apellido:apellido,nombre:nombre,tipo:tipo,sexo:sexo,doc:doc});
		
		return true;
	}
	function addTags() {
		$('#tag').removeClass('notSelected');
		var tag = $('#tag').val();
		if (tag == "" || tag == null || tag.length < 3 || tag.length > 50) {
			$('#tag').addClass('notSelected');
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


	//ABM Trabajos

	
	function loadWorkList() {
		$('#misTrabajos').load('php/addOrRemoveTrabajos.php',{action:"list"});
	}

	function validateTag() {
		$('#misTags').load('php/addOrRemoveTag.php',{ action:'save'});
		return true;
	}
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
	function loadAndEditWork(a){
		clearWork();
		$('#titleEditWork').html("Modificar Trabajo");
		$('#perfilAddModWorkLoad').load('php/addOrRemoveTrabajos.php',{action:"load",id:a});
		$("#workBtn1").val("Cancelar");
		$("#workBtn2").val("Modificar");
		$("#currentWorkID").val(a);
		$("#currentWorkAction").val("edit");
		
		//Carga el formulario de estudios con los datos del id a modificarlo
		//Todo en enable
	}
	function loadAndRemoveWork(a) {
		clearWork();
		$('#titleEditWork').html("Eliminar Trabajo");
		$('#perfilAddModWorkLoad').load('php/addOrRemoveTrabajos.php',{action:"load",id:a});
		$("#workBtn1").val("Cancelar");
		$("#workBtn2").val("Eliminar");
		$("#currentWorkAction").val("remove");
		//Carga el formulario de estudios con los datos del id a para eliminarlo
		//(Poner todo en disable)

		$("#listEmpresa").prop('disabled', true);
		$("#listCargo").prop('disabled', true);
		$("#listDescripcion").prop('disabled', true);
		$("#workPaisSel").prop('disabled', true);
		$("#workSenioritySel").prop('disabled', true);
		$("#checkPersonasACargo").prop('disabled', true);
	}
	function agregarWork() {
		clearWork();
		$('#titleEditWork').html("Agregar Trabajos");
		$("#currentWorkAction").val("add");
		
		//Carga el formulario de estudios listo para agregar uno nuevo
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

	//Init de fecha de Nacimiento
	

	</script>
	<script type="text/javascript" src="js/jq.min.js"></script>
	<script type="text/javascript" src="js/datedropper.js"></script>

	<script>
	
	habilitarFechas();
	function habilitarFechas() {
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
	$( "#listFechaNacimiento").dateDropper({
		format: "d/m/Y",
		lang: "es",
		color:"#063049",
		placeholder: "Nacimiento",
		animation: "dropdown",
		minYear: "1930",
		maxYear: "2010"
	
	});
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
	}
	$('#listFechaNacimiento').val('<?php echo $Persona->getFechaNac(); ?>');
	$(document).ready(function() {
		hideWait();
	});
</script>

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
$conex = new MySQL();
$row = array();

$consulta = "SELECT ID_Provincia as id,Provincia as prov FROM provincia order by prov ASC;";
$result = $conex->consulta($consulta);
$row = $conex->fetch_array();

$first = "";

while ($row) {

	$provincias[] = array(utf8_encode($row['prov']), $row['id']);
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

	$localidad[] = array(utf8_encode($row['loc']), $row['id']);
	if ($firstLoc == "") {
		$firstLoc = $row['id'];
	}
	$row = $conex->fetch_array();
}
?>

			<div class="titleSelRol">Domicilio y Contacto</div>
			
			
				<div>
					<label class="labelFillDP inline">Calle</label>
					<label class="labelFillDP inline">N&uacute;mero</label>
				</div>
				<div>
				
					<input maxlength="50" id="dpCalle" type="text" class="inputFillDP" value="<?php //echo $Persona->getDomicilio()->getCalle(); ?>" placeholder="Av. Corrientes">
					<input maxlength="6" id="dpNro" type="text" class="inputFillDP" value="<?php //echo $Persona->getDomicilio()->getNum(); ?>" placeholder="1234">
				</div>
	
				<div>
					<label class="labelFillDP inline">Piso</label>
					<label class="labelFillDP inline">Departamento</label>
				</div>
				<div>
					<input maxlength="6" id="pisoDP" type="text" value="<?php //echo $Persona->getDomicilio()->getPiso(); ?>" class="inputFillDP" placeholder="7">
					<input maxlength="1" id="dptoDP" type="text" value="<?php //echo $Persona->getDomicilio()->getDpto(); ?>" class="inputFillDP" placeholder="A">
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
			
			<div id="perfilSaveDom"></div>
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(3);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(3);">
			</div>		
			<script>
			function selProvDP() {
				$('#selLocDP').prop('disabled', true);
				$('#toLoadLoc').load('php/localidades.php',{provID:$('#selProvDP').val()});
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
			</script>
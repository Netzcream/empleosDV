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

$consulta = "SELECT ID_TipoDocumento as id,Descripcion as des, AdmiteLetras as letras from tipodocumento;";
$result = $conex->consulta($consulta);
$row = $conex->fetch_array();

while ($row) {
	$tipoDocumentos[] = array(utf8_encode($row['des']), $row['id'],$row['letras']);
	$row = $conex->fetch_array();
}
?>

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
			
			<script>
			$( "#listFechaNacimiento").dateDropper({
				format: "d/m/Y",
				lang: "es",
				color:"#063049",
				placeholder: "Nacimiento",
				animation: "dropdown",
				minYear: "1930",
				maxYear: "2010"
			
			});
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
			//Init de fecha de Nacimiento
			$('#listFechaNacimiento').val('<?php echo $Persona->getFechaNac(); ?>');
			</script>
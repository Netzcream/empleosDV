		<script type="text/javascript" src="js/jq.rotate.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jq.toastmessage.css"/>
		<script type="text/javascript" src="js/jq.toastmessage.js"></script>
<?php
			if (!isset($_SESSION)) {
				session_start();
			}
			
			if (!class_exists('MySQL')) {
				require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
			}
			if (!class_exists('Persona')) {
				require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
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
				

			$consulta = "SELECT ID_Localidad as id, Localidad as loc FROM LOCALIDAD WHERE ID_Provincia=".$first." order by loc ASC;";
			$result = $conex->consulta($consulta);
				
				
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			while ($row) {
			
				$localidad[] = array(utf8_encode($row['loc']), $row['id']);
				$row = mysql_fetch_array($result, MYSQL_ASSOC);
			}	
			
?>

<div>
	<div id="dp1" class="contSelRolUsuario selActivo">
		<div class="titleSelRol">&#191;Cual es tu rol?</div>

			<div class="indBtnSelRol" onclick="onclickRol('pro');">
				<div class="selRolUsuario" title="Soy profesor">
					<img class="rolSelImageRol" alt="Profesor" src="imagenes/iconos/profesor.png" >
					<img id="checkPro" class="rolSelCheckDisplay" alt="Seleccionado" src="imagenes/iconos/check.png" >
				</div>
				<div>
					
					<label class="selRolLabel" for="soyProf">Soy Profesor</label>
				</div>
			</div>
			
			<div class="indBtnSelRol" onclick="onclickRol('alu');">
				<div class="selRolUsuario" title="Soy estudiante">
					<img class="rolSelImageRol" alt="Estudiante" src="imagenes/iconos/estudiante.png" >
					<img id="checkAlu" class="rolSelCheckDisplay" alt="Seleccionado" src="imagenes/iconos/check.png" >
				</div>
				<div>
					<label class="selRolLabel" for="soyAlum">Soy Alumno</label>
				</div>
			</div>
			
			<div class="indBtnSelRol" onclick="onclickRol('emp');">
				<div class="selRolUsuario" title="Soy empresa">
					<img class="rolSelImageRol" alt="Empresa" src="imagenes/iconos/empresa.png" >
					<img id="checkEmp" class="rolSelCheckDisplay" alt="Seleccionado" src="imagenes/iconos/check.png" >
				</div>
				<div>
					<label class="selRolLabel" for="soyEmpr">Soy Empresa</label>
				</div>
			</div>

		<input class="selRolRadio" type="radio" name="soyRol" id="soyProf" value="soyProf">
		<input class="selRolRadio" type="radio" name="soyRol" id="soyAlum" value="soyAlum">
		<input class="selRolRadio" type="radio" name="soyRol" id="soyEmpr" value="soyEmpr">
		
	
		<div>
			<label class="notationLabel">Elecci&oacute;n sujeta a autorizaci&oacute;n por parte de los administradores.</label>
		</div>	
		<div class="finRecuadro">

		<div class="contBtnsSelRoles">
				<input class="nextBtnRoles" type="button" value="Siguiente" onclick="showAndHide('dp1','dp2');">
			</div>
			<div>
				<img title="Rol" class="dotPagination" alt="" src="imagenes/iconos/dot_blanco.png">
				<img title="Datos Personales" class="dotPagination" alt="" src="imagenes/iconos/dot.png">
				<img title="Domicilio" class="dotPagination" alt="" src="imagenes/iconos/dot.png">
				<img title="Bienvenido" class="dotPagination" alt="" src="imagenes/iconos/dot.png">
			</div>
		</div>
	</div>
	
	
		<div id="dp2"  class="contSelRolUsuario">
			<div class="titleSelRol">Datos Personales</div>
				
				<div>
					<label class="labelFillDP inline">Apellido</label>
					<label class="labelFillDP inline">Nombre</label>
				</div>
				<div>
					<input id="addApellido" type="text" class="inputFillDP" maxlength="50" placeholder="Apellido">
					<input id="addNombre" type="text" class="inputFillDP" maxlength="50" placeholder="Nombre">
				</div>
				<label class="labelFillDP">Sexo</label>
				<div>
					<div class="selSexoOnStart" id="visibleSexM" onclick="selSex('m');"><img alt="" src="imagenes/iconos/m.png"></div>
					<div class="selSexoOnStart" id="visibleSexF" onclick="selSex('f');"><img alt="" src="imagenes/iconos/f.png"></div>
				</div>
				<input class="selRolRadio" type="radio" name="soySexo" id="soyMasc" value="soyMasc">
				<input class="selRolRadio" type="radio" name="soySexo" id="soyFem" value="soyFem">
				<label class="labelFillDP">Documento</label>
				<div>
					<select id="selDocDP" class="selDocDP">
				<?php 
				
				foreach ($tipoDocumentos as $valor) {
					echo "<option letras='".$valor[2]."' value='".$valor[1]."'>".$valor[0]."</option>";
				}
				
				?>					
				</select>
					<input type="text" id="dpNroDoc" class="inputFillDP" maxlength="20" placeholder="Numero Documento">
				</div>
		
		

		
		
		
		<div class="finRecuadro">
			<div class="contBtnsSelRoles">
				<input class="backBtnRoles" type="button" value="" onclick="stepBack('dp1','dp2');">
				<input class="nextBtnRoles" type="button" value="Siguiente" onclick="showAndHide('dp2','dp3');">
			</div>
			<div class="paginacionDot">
				<img title="Rol" class="dotPagination" alt="" src="imagenes/iconos/dot_verde.png">
				<img title="Datos Personales" class="dotPagination" alt="" src="imagenes/iconos/dot_blanco.png">
				<img title="Domicilio" class="dotPagination" alt="" src="imagenes/iconos/dot.png">
				<img title="Bienvenido" class="dotPagination" alt="" src="imagenes/iconos/dot.png">
			</div>	
		</div>
		
	</div>
	
	
			<div id="dp2Empresa"  class="contSelRolUsuario">
				<div class="titleSelRol">Datos de la Empresa</div>
				<br>
				<div>
					<label class="labelFillDP inline">Raz&oacute;n Social</label>
				</div>
				<div>
					<input id="addRazonSocial" type="text" class="inputFillDP" maxlength="50" placeholder="Raz&oacute;n Social">
				</div>
				<br>
				<div>
					<label class="labelFillDP inline">CUIT</label>
				</div>
				<div>
					<input type="text" id="dpNroCUIT" class="inputFillDP" maxlength="20" placeholder="Nro. de CUIT">
				</div>
			<div class="finRecuadro">
			<div class="contBtnsSelRoles">
				<input class="backBtnRoles" type="button" value="" onclick="stepBack('dp1','dp2Empresa');">
				<input class="nextBtnRoles" type="button" value="Siguiente" onclick="showAndHide('dp2Empresa','dp3');">
			</div>
			<div class="paginacionDot">
				<img title="Rol" class="dotPagination" alt="" src="imagenes/iconos/dot_verde.png">
				<img title="Datos de la empresa" class="dotPagination" alt="" src="imagenes/iconos/dot_blanco.png">
				<img title="Domicilio" class="dotPagination" alt="" src="imagenes/iconos/dot.png">
				<img title="Bienvenido" class="dotPagination" alt="" src="imagenes/iconos/dot.png">
			</div>	
		</div>
		
	</div>
	

		<div id="dp3"  class="contSelRolUsuario">
			<div class="titleSelRol">Domicilio</div>
				
				<div>
					<label class="labelFillDP inline">Calle</label>
					<label class="labelFillDP inline">N&uacute;mero</label>
				</div>
				<div>
					<input id="dpCalle" type="text" class="inputFillDP" placeholder="Av. Corrientes">
					<input id="dpNro" type="text" class="inputFillDP" placeholder="1234">
				</div>
	
				<div>
					<label class="labelFillDP inline">Piso</label>
					<label class="labelFillDP inline">Departamento</label>
				</div>
				<div>
					<input id="pisoDP" type="text" class="inputFillDP" placeholder="7">
					<input id="dptoDP" type="text" class="inputFillDP" placeholder="A">
				</div>
	
				<div>
					<label class="labelFillDP inline">Provincia</label>
					<label class="labelFillDP inline">Localidad</label>
				</div>
				<div>
					<select class="selDocDP" id="selProvDP" onchange="selProvDP();">
				<?php 
				
				foreach ($provincias as $valor) {
					echo "<option value='".$valor[1]."'>".$valor[0]."</option>";
				}
				
				?>		
					</select>
					<div id="toLoadLoc">
					<select id="selLocDP" class="selDocDP">
				<?php 
				
				foreach ($localidad as $valor) {
					echo "<option value='".$valor[1]."'>".$valor[0]."</option>";
				}
				
				?>	
					</select>
					</div>
				</div>
	
	
		
		<div class="finRecuadro">
			<div class="contBtnsSelRoles">
				<input class="backBtnRoles" type="button" value="" onclick="stepBack('dp2','dp3');">
				<input class="nextBtnRoles" type="button" value="Siguiente" onclick="showAndHide('dp3','dp4');">
			</div>
			<div class="paginacionDot">
				<img title="Rol" class="dotPagination" alt="" src="imagenes/iconos/dot_verde.png">
				<img title="Datos Personales" class="dotPagination" alt="" src="imagenes/iconos/dot_verde.png">
				<img title="Domicilio" class="dotPagination" alt="" src="imagenes/iconos/dot_blanco.png">
				<img title="Bienvenido" class="dotPagination" alt="" src="imagenes/iconos/dot.png">
			</div>	
		</div>
		
	</div>
	
	
	
	
	
			<div id="dp4"  class="contSelRolUsuario">
			<div class="titleSelRol">Bienvenido</div>
				
			<div class="logoWelcome">
				<img alt="" src="imagenes/logo/logo250.png">
			</div>
		
		
		<div class="contLabelNotEnd">
			<label class="notationLabelEnd">Sus datos ser&aacute;n guardados.</label>
			<label class="notationLabelEnd">Ser&aacute; notificado una vez el administrador revise su solicitud de ingreso y la apruebe.</label>
		</div>
		
		
		
		<div class="finRecuadro">
			<div class="contBtnsSelRoles">
				<input class="backBtnRoles" type="button" value="" onclick="stepBack('dp3','dp4');">
				<input class="nextBtnRoles" type="button" value="Finalizar" onclick="endFirstStep();">
			</div>
			<div class="paginacionDot">
				<img title="Rol" class="dotPagination" alt="" src="imagenes/iconos/dot_verde.png">
				<img title="Datos Personales" class="dotPagination" alt="" src="imagenes/iconos/dot_verde.png">
				<img title="Domicilio" class="dotPagination" alt="" src="imagenes/iconos/dot_verde.png">
				<img title="Bienvenido" class="dotPagination" alt="" src="imagenes/iconos/dot_blanco.png">
			</div>	
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
	function onclickRol(a) {
		$('.selRolUsuario').removeClass('notSelected');
		$('.rolSelCheckDisplay').removeClass('seleccionado');
		if (a == "alu") {
			$('#soyAlum').click();
			$('#checkAlu').addClass('seleccionado');
		}
		else if (a == "emp") {
			$('#soyEmpr').click();
			$('#checkEmp').addClass('seleccionado');
		}

		else if (a == "pro") {
			$('#soyProf').click();
			$('#checkPro').addClass('seleccionado');
		}
	}
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
	function showAndHide(a,b) {
		var a = a;
		var b = b;
		var errores = 0;
		var patron = new RegExp('^[0-9]+$');
		if (a == 'dp1') {

			//dp2Empresa
			if ($("input[name=soyRol]:checked").val() == null) {
				$('.selRolUsuario').addClass('notSelected');
				errores++;
			}
			if (errores > 0) {
				errorToas("Debes realizar una selecci&oacute;n.");
				return;
			}
			if ($("input[name=soyRol]:checked").val() == "soyEmpr") {
				b = 'dp2Empresa';
			}


			
		}
		if (a == 'dp2') {

			
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
				return;
			}
					
		}

		if (a == 'dp2Empresa') {
			$('.inputFillDP').removeClass('notSelected');
			if ($('#addRazonSocial').val() == "") {
				$('#addRazonSocial').addClass('notSelected');
				errores++;
			}
			else if ($('#addRazonSocial').val().length < 3) {
				$('#addRazonSocial').addClass('notSelected');
				errorToas('La raz&oacute;n social debe contener 3 o m&aacute;s caracteres.');
				errores++;
			}
			else if ($('#addRazonSocial').val().length > 50) {
				$('#addRazonSocial').addClass('	');
				errorToas('No se permiten denominaciones que superen los 50 caracteres.');
				errores++;
			}
			
			$("#dpNroCUIT").val($("#dpNroCUIT").val().replace(/\./g, ''));
			$("#dpNroCUIT").val($("#dpNroCUIT").val().replace(/\-/g, ''));
			$("#dpNroCUIT").val($("#dpNroCUIT").val().replace(/\ /g, ''));
			
			if ($("#dpNroCUIT").val() == "") {
				$('#dpNroCUIT').addClass('notSelected');
				errores++;
			}
			else if ($('#dpNroCUIT').val().length < 11) {
				$('#dpNroCUIT').addClass('notSelected');
				errorToas('El CUIT debe contener 11 o m&aacute;s caracteres.');
				errores++;
			}
			else if ($('#dpNroCUIT').val().length > 11) {
				$('#dpNroCUIT').addClass('notSelected');
				errorToas('No se permiten CUITs que superen los 11 caracteres.');
				errores++;
			}
			else if (patron.test($('#dpNroCUIT').val()) == false) {
				$('#dpNroCUIT').addClass('notSelected');
				errorToas('Debe ingresar valores n&uacute;mericos para el CUIT.');
				errores++;
			}
			if (errores > 0) {
				errorToas('Debes ingresar y/o seleccionar los campos obligatorios.');
				return;
			}
					
		}

		
		if (a == 'dp3') {

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
				return;
			}
		
		}
		$('#'+a).animate({
			'marginLeft' : "-=1500px"
		},500,function(){
			$('#'+a).hide();	 
			$('#'+b).fadeIn();	
		});



		
	}

	function stepBack(a,b) {
		//Volver a "a" desde "b"
		var a = a;
		var b = b;
		if ((b == "dp3") && ($("input[name=soyRol]:checked").val() == "soyEmpr")) {
			a = 'dp2Empresa';
		}
		$('#'+b).fadeOut();
		setTimeout(function() {
			$('#'+a).show();
			$('#'+a).animate({'left': '50%', 'margin-left': -$('#'+a).width()/2 });
		}, 500);


		
	}

	function selProvDP() {
		$('#selLocDP').prop('disabled', true);
		$('#toLoadLoc').load('php/localidades.php',{provID:$('#selProvDP').val()});
	}


	function endFirstStep() {
		var r = confirm("\u00BFConfirma que todos los datos ingresados son correctos?");
		if (r == true) {


			$('#dp4').animate({
				'marginLeft' : "-=1500px"
			},500,function(){
				$('#dp4').hide();	 
				$('#saving').fadeIn();
				
			});

			var rol = $("input[name=soyRol]:checked").val();
			var apellido = $('#addApellido').val();
			var nombre = $('#addNombre').val();
			var sexo = $("input[name=soySexo]:checked").val();
			var tipoDoc = $("#selDocDP").val();
			var nroDoc = $("#dpNroDoc").val();
			var razonSoc = $('#addRazonSocial').val();
			var nroCUIT = $("#dpNroCUIT").val();
			var calle = $('#dpCalle').val();
			var nroCalle = $('#dpNro').val();
			var provincia = $('#selProvDP').val();
			var localidad = $('#selLocDP').val();
			var piso = $('#pisoDP').val();
			var dpto = $('#dptoDP').val();
			$('#saving').load('php/saveDatosFirst.php',{rol:rol,apellido:apellido,nombre:nombre,sexo:sexo,tipoDoc:tipoDoc,nroDoc:nroDoc,razonSoc:razonSoc,nroCUIT:nroCUIT,calle:calle,nroCalle:nroCalle,provincia:provincia,localidad:localidad,piso:piso,dpto:dpto});
						
		}
		else { return; }
	}

		var rotation = function (){
			   $("#loadingRoll").rotate({
			      angle:0, 
			      animateTo:360, 
			      callback: rotation
			   });
			}
			rotation();

</script>
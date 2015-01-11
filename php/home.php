<?php
			if (!isset($_SESSION)) {
				session_start();
			}
			$_SESSION['location'] = "home";
			
	//selActivo
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
					<input id="addApellido" type="text" class="inputFillDP" placeholder="Apellido">
					<input id="addNombre" type="text" class="inputFillDP" placeholder="Nombre">
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
					<select class="selDocDP">
					<option>DNI</option>
					<option>CUIT</option>
					<option>CUIL</option>
					</select>
					<input type="text" class="inputFillDP" placeholder="Numero Documento">
				</div>
		
		<div class="finRecuadro">
			<div class="contBtnsSelRoles">
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

		<div id="dp3"  class="contSelRolUsuario">
			<div class="titleSelRol">Domicilio</div>
				
				<div>
					<label class="labelFillDP inline">Calle</label>
					<label class="labelFillDP inline">N&uacute;mero</label>
				</div>
				<div>
					<input type="text" class="inputFillDP" placeholder="Av. Corrientes">
					<input type="text" class="inputFillDP" placeholder="1234">
				</div>
	
				<div>
					<label class="labelFillDP inline">Piso</label>
					<label class="labelFillDP inline">Departamento</label>
				</div>
				<div>
					<input type="text" class="inputFillDP" placeholder="7">
					<input type="text" class="inputFillDP" placeholder="A">
				</div>
	
				<div>
					<label class="labelFillDP inline">Provincia</label>
					<label class="labelFillDP inline">Localidad</label>
				</div>
				<div>
					<select class="selDocDP">
						<option>Capital Federal</option>
						<option>Buenos Aires</option>
						<option>Chaco</option>
						<option>Santa Fe</option>
					</select>
					
					<select class="selDocDP">
						<option>Capital Federal</option>
						<option>Lanus</option>
						<option>Lomas de Zamora</option>
						<option>San Isidro</option>
					</select>
				</div>
	
	
		
		<div class="finRecuadro">
			<div class="contBtnsSelRoles">
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
		var errores = 0;
		if (a == 'dp1') {
			
			if ($("input[name=soyRol]:checked").val() == null) {
				$('.selRolUsuario').addClass('notSelected');
				errores++;
			}
			if (errores > 0) {
				return;
			}
		}
		if (a == 'dp2') {
			$('.inputFillDP').removeClass('notSelected');

			if ($('#addApellido').val() == "") {
				$('#addApellido').addClass('notSelected');
				errores++;
			}
			if ($('#addNombre').val() == "") {
				$('#addNombre').addClass('notSelected');
				errores++;
			}
			if ($("input[name=soySexo]:checked").val() == null) {
				$('.selSexoOnStart').addClass('notSelected');
				errores++;
			
			}
			
			if (errores > 0) {
				return;
			}
					
		}
		if (a == 'dp3') {
			
		}
		$('#'+a).animate({
			'marginLeft' : "-=1500px"
		},500,function(){
			$('#'+a).hide();	 
			$('#'+b).fadeIn();	
		});
	}
	function endFirstStep() {

		alert('Funcionalidad en progreso');
	}
</script>
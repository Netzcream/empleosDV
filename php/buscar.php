<?php

if (!isset($_SESSION)) {
	header('Content-Type: text/html; charset=UTF-8');
	session_start();
}
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Tag')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Tag.php"); }
$tags = new Tag();
$colTags = array();
foreach ($tags->tagColections() as $tag) {
	$row_array['id'] = $tag;
	$row_array['name'] = $tag;
	array_push($colTags,$row_array);
}
$colTags = json_encode($colTags);

$_SESSION['location'] = "buscar";

$conex = new MySQL();
$consulta = "SELECT codCarrera as id, descripcion as carrera FROM carrera where Activo=1;";
$result = $conex->consulta($consulta);
		    $json_response = array();
		    $row = $conex->fetch_array();
		    
		    while ($row) {
		    	
			        $row_array['id'] = $row['id'];
			        $row_array['name'] = $row['carrera'];
			        array_push($json_response,$row_array);
			        $row = $conex->fetch_array();
			    }
			    
			   $carreras = json_encode($json_response);
			    	
?>

		<link rel="stylesheet" type="text/css" href="css/jslider.css">
		<link rel="stylesheet" type="text/css" href="css/jslider.blue.css">
		<link rel="stylesheet" type="text/css" href="css/jslider.plastic.css">
		<link rel="stylesheet" type="text/css" href="css/jslider.round.css">
		<link rel="stylesheet" type="text/css" href="css/jslider.round.plastic.css">
		<link rel="stylesheet" type="text/css" href="css/magicsuggest-min.css">
		
		<script type="text/javascript" src="js/jshashtable-2.1_src.js"></script>
		<script type="text/javascript" src="js/jq.numberformatter-1.2.3.js"></script>
		<script type="text/javascript" src="js/tmpl.js"></script>
		<script type="text/javascript" src="js/jq.dependClass-0.1.js"></script>
		<script type="text/javascript" src="js/draggable-0.1.js"></script>
		<script type="text/javascript" src="js/jq.slider.js"></script>
		<script type="text/javascript" src="js/magicsuggest.js"></script>

	<div class="contSelRolUsuario selActivo">
			<div class="titleBuscador">Buscar alumnos</div>
		<div class="contBuscarInd">
			<label class="buscarLabel">Carrera</label>
			<div id="bBuscarCarrera">
			</div>
			<script>
			$(function() {
				var msBCarrera =  $('#bBuscarCarrera').magicSuggest({
			    	sortDir: 'asc',
			    	sortOrder: 'name',
			    	allowDuplicates: false,
			    	allowFreeEntries: false,
			    	useZebraStyle: true,
			    	maxDropHeight: 145,
			    	toggleOnClick: true,
			    	placeholder: 'Seleccione Carreras',
			    	valueField: 'id',
			    	noSuggestionText: 'No se encontraron coincidencias para: {{query}}',
			    	style: 'border-radius: 5px !important',
			    	data: <?php echo $carreras; ?>
			    	
			    });
				$(msBCarrera).on(
				  'selectionchange', function(e, cb, s){

	     		  }
				);
			});	    
			
			</script>
		</div>
		<!-- 
	<div class="">
			<label class="buscarLabel">Orientaci&oacute;n:</label>
			
			<div id="bBuscarOrientacion">
	
			</div>
			
				<script>
			$(function() {
				var msBOrientacion =  $('#bBuscarOrientacion').magicSuggest({
			    	sortDir: 'asc',
			    	sortOrder: 'name',
			    	allowDuplicates: false,
			    	allowFreeEntries: false,
			    	useZebraStyle: true,
			    	maxDropHeight: 145,
			    	toggleOnClick: true,
			    	placeholder: 'Seleccionar',
			    	valueField: 'id',
			    	noSuggestionText: 'No se encontraron coincidencias para: {{query}}',
			    	style: 'border-radius: 5px !important',
			    	data: echo $carreras;
			    });
				$(msBOrientacion).on(
				  'selectionchange', function(e, cb, s){
	     		  }
				);
			});	    
			
			</script>
			

</div>
 -->
<div class="contBuscarInd">

			<label class="buscarLabel">Edad</label>
		<div id="achicoEdad"> 
  	<div class="layout-slider">
      <input id="rangoEdad" name="area" value="18;30" />
    </div>
    
    
    </div>
    <script type="text/javascript" charset="utf-8">
      jQuery("#rangoEdad").slider({
    	  from: 20,
    	  to: 60,
    	  scale: ['20', '|', 30, '|', '40', '|', 50, '|', 60],
    	  limits: false,
    	  step: 1,
    	  dimension: '',
    	  skin: "blue"
    	});

     // $('#rangoEdad').slider("option", "value").val() --> Devuelve "18;37" por ejemplo
    </script>
		</div>
		
		<div class="contBuscarInd">
		<div class="adjustBuscarInd">
			<div class="contBuscarMidRow">
				<label class="buscarLabel">Sexo</label>
				<div  id="idSexM" title="Masculino" class="BcontSelSexo" onclick="selSexo('m');"><img alt="Masculino" src="imagenes/iconos/m.png" class="BselSexo"></div>
				<div  id="idSexFM" title="Ambos" class="BcontSelSexo BcontSelSexoSeleccionado" onclick="selSexo('fm');"><img alt="Ambos" src="imagenes/iconos/fm.png" class="BselSexo"></div>
				<div  id="idSexF" title="Femenino" class="BcontSelSexo" onclick="selSexo('f');"><img alt="Femenino" src="imagenes/iconos/f.png" class="BselSexo"></div>
			</div>
			
			<div class="contBuscarMidRow">
				<label class="buscarLabel">Avance de la Carrera</label>
				<div class="limitRange">
					<input id="bBuscarPorcentaje" type="range" min="0" max="100" value="50"  onchange="actualizaPorc(value);"/>
					<output for=bBuscarPorcentaje id=bPorcentaje>50 %</output>
				<script>
				function actualizaPorc(prc) {
					document.querySelector('#bPorcentaje').value = prc+" %";
					}
				</script>
				</div>
			</div>
		</div>
</div>	
		<div class="contBuscarInd">
			<label class="buscarLabel">Palabras Claves</label>
			

			<div id="bBuscarTags">
	
			</div>
			
				<script>
			$(function() {
				var ms =  $('#bBuscarTags').magicSuggest({
			    	sortDir: 'asc',
			    	sortOrder: 'name',
			    	allowDuplicates: false,
			    	allowFreeEntries: false,
			    	useZebraStyle: true,
			    	maxDropHeight: 145,
			    	toggleOnClick: true,
			    	placeholder: 'Palabras Clave',
			    	valueField: 'id',
			    	noSuggestionText: 'No se encontraron coincidencias para: {{query}}',
			    	style: 'border-radius: 5px !important',
			    	data: <?php echo $colTags; ?>
			    	
			    
			    });
				$(ms).on(
				  'selectionchange', function(e, cb, s){
	     		  }
				);
			});	    
			
			</script>
			
			
			
		</div>
		
			<div class="contBuscarInd">
				<label class="buscarLabel">Apellido</label>
				<input class="inputFillDP" id="apellidoOpt" type="text" placeholder="Apellido"/>
			</div>
		
			
			<div class="finRecuadroPerfil">
				<label id="logErrorNot" class="regLabelNota regError"></label>
				<input class="nextBtnBuscar" type="submit" onclick="buscar();" value="Buscar">
			</div>	
	</div>

<div class="loading">
	<img alt="" src="imagenes/loading.gif" width=30>
</div>


	<script>	
function selSexo(a) {
	$(".BcontSelSexo").removeClass('BcontSelSexoSeleccionado');
	if (a == 'm') {
		$('#idSexM').addClass('BcontSelSexoSeleccionado');
	 }
	if (a == 'fm') {
		$('#idSexFM').addClass('BcontSelSexoSeleccionado');
	 }
	if (a == 'f') {
		$('#idSexF').addClass('BcontSelSexoSeleccionado');
	 }
}
	function buscar() {
		var carrera = $('#bBuscarCarrera').magicSuggest().getValue();
		//var orientacion = JSON.stringify($('#bBuscarOrientacion').magicSuggest().getValue());
		var minEdad = $('#rangoEdad').slider().getValue()[0]+$('#rangoEdad').slider().getValue()[1];
		var maxEdad = $('#rangoEdad').slider().getValue()[3]+$('#rangoEdad').slider().getValue()[4];
		var a = $(".BcontSelSexoSeleccionado").attr('id');
		var sexo = "";
		if (a == 'idSexM') {
			sexo = "m";
		 }
		else if (a == 'idSexFM') {
			sexo = "mf";
		 }
		else if (a == 'idSexF') {
			sexo = "f";
		 }
		 var porcentaje = $('#bBuscarPorcentaje').val();

		 var cantTags = $('#bBuscarTags').magicSuggest().getSelection().length;
		 var tags = new Array();
		 
		for (var i = 0; i < cantTags; i++) {
		
			tags.push($('#bBuscarTags').magicSuggest().getSelection()[i]['name']);
		}
		var tags2 = tags;
		var apellido = $('#apellidoOpt').val();
//		alert("Carrera: " + carrera + " - MinEdad: "+minEdad+" - MaxEdad: "+maxEdad+" - Sexo: "+ sexo+ " - Porcentaje: "+porcentaje+" - Tags: "+tags2);
		showWait();
		$('#cuerpo').load('php/buscarAlumnos.php', {carrera: carrera, minEdad:minEdad,maxEdad:maxEdad,sexo:sexo,avance:porcentaje,tags:tags2, apellido:apellido } );
	}
	$(document).ready(function() {
		hideWait();
	});
	 </script>
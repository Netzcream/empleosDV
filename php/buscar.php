<?php
if (!isset($_SESSION)) {
	session_start();
}
$_SESSION['location'] = "buscar";

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

	<div class="prebuscar">
		<div class="separadorBuscar A80">
			<label class="buscarLabel">Carrera:</label>
			<div id="bBuscarCarrera">
	
			</div>
			<script>
			$(function() {
				var ms =  $('#bBuscarCarrera').magicSuggest({
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
			    	data: [{"id":1, "name":"Dise&ntilde;o Multimedial"},
					    	{"id":2, "name":"Dise&ntilde;o Gráfico"},
					    	{"id":3, "name":"Programaci&oacute;n de Videojuegos"},
					    	{"id":4, "name":"Cine de Animaci&oacute;n"},
					    	{"id":5, "name":"Desarrollo Web y Mobile"},
					    	{"id":6, "name":"Analista de Sistemas"}]
			    });
				$(ms).on(
				  'selectionchange', function(e, cb, s){
	     		  }
				);
			});	    
			
			</script>
		</div>
	<div class="separadorBuscar A80">
			<label class="buscarLabel">Orientaci&oacute;n:</label>
			
			<div id="bBuscarOrientacion">
	
			</div>
			
				<script>
			$(function() {
				var ms =  $('#bBuscarOrientacion').magicSuggest({
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
			    	data: [{"id":1, "name":"Dise&ntilde;o"},
					    	{"id":2, "name":"Desarrollo"},
					    	{"id":3, "name":"Analisis"},
					    	{"id":4, "name":"Video Juegos"},
					    	{"id":5, "name":"Desarrollo Web y Mobile"},
					    	{"id":6, "name":"Analista de Sistemas"}]
			    });
				$(ms).on(
				  'selectionchange', function(e, cb, s){
	     		  }
				);
			});	    
			
			</script>
			

</div>
<div class="separadorBuscar A80">
			<label class="buscarLabel">Edad:</label>
		<div id="achicoEdad"> 
  	<div class="layout-slider">
      <input id="rangoEdad" name="area" value="18;30" />
    </div>
    </div>
    <script type="text/javascript" charset="utf-8">
      jQuery("#rangoEdad").slider({
    	  from: 18,
    	  to: 60,
    	  scale: [18, '|', 30, '|', '40', '|', 50, '|', 60],
    	  limits: false,
    	  step: 1,
    	  dimension: '',
    	  skin: "blue"
    	});

     // $('#rangoEdad').slider("option", "value").val() --> Devuelve "18;37" por ejemplo
    </script>
		</div>
		<div class="separadorBuscar A100">
			<label class="buscarLabel">Sexo:</label>
			<div id="idSexM" class="BcontSelSexo" onclick="selSexo('m');"><img alt="Masculino" src="imagenes/m.png" class="BselSexo"></div>
			<div id="idSexFM" class="BcontSelSexo BcontSelSexoSeleccionado" onclick="selSexo('fm');"><img alt="Ambos" src="imagenes/fm.png" class="BselSexo"></div>
			<div id="idSexF" class="BcontSelSexo" onclick="selSexo('f');"><img alt="Femenino" src="imagenes/f.png" class="BselSexo"></div>
			
			
		</div>
		<div class="separadorBuscar A80">
			<label class="buscarLabel">Avance de la Carrera </label>
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

		<div class="separadorBuscar A80">
			<label class="buscarLabel">Palabras Claves</label>
			

			<div id="bBuscarTags">
	
			</div>
			
				<script>
			$(function() {
				var ms =  $('#bBuscarTags').magicSuggest({
			    	sortDir: 'asc',
			    	sortOrder: 'name',
			    	allowDuplicates: false,
			    	allowFreeEntries: true,
			    	useZebraStyle: true,
			    	maxDropHeight: 145,
			    	toggleOnClick: true,
			    	placeholder: 'Palabras Clave',
			    	valueField: 'id',
			    	noSuggestionText: 'No se encontraron coincidencias para: {{query}}',
			    	style: 'border-radius: 5px !important',
			    	data: [{"id":1, "name":"PHP"},
					    	{"id":2, "name":"HTML"},
					    	{"id":3, "name":"Java"},
					    	{"id":4, "name":"CSS"},
					    	{"id":5, "name":"HTML5"},
					    	{"id":6, "name":"ActionScript"}]
			    });
				$(ms).on(
				  'selectionchange', function(e, cb, s){
	     		  }
				);
			});	    
			
			</script>
			
			
			
		</div>
		
	<label id="logErrorNot" class="regLabelNota regError"></label>
	<input class="buscarBtn" type="submit" value="Buscar">
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
	

	
	 </script>
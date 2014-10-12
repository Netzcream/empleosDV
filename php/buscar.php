<?php
if (!isset($_SESSION)) {
	session_start();
}
$_SESSION['location'] = "buscar";

?>

	<link rel="stylesheet" href="css/jslider.css" type="text/css">
	<link rel="stylesheet" href="css/jslider.blue.css" type="text/css">
	<link rel="stylesheet" href="css/jslider.plastic.css" type="text/css">
	<link rel="stylesheet" href="css/jslider.round.css" type="text/css">
	<link rel="stylesheet" href="css/jslider.round.plastic.css" type="text/css">
	<script type="text/javascript" src="js/jshashtable-2.1_src.js"></script>
	<script type="text/javascript" src="js/jq.numberformatter-1.2.3.js"></script>
	<script type="text/javascript" src="js/tmpl.js"></script>
	<script type="text/javascript" src="js/jq.dependClass-0.1.js"></script>
	<script type="text/javascript" src="js/draggable-0.1.js"></script>
	<script type="text/javascript" src="js/jq.slider.js"></script>

<div class="prebuscar">
<table>
	<tr>
		<td class="buscarLabelRow">
			<label class="buscarLabel">Carrera:</label>
		</td>
		<td></td>
	</tr>
	<tr>
		<td class="buscarLabelRow">
			<label class="buscarLabel">Orientación:</label>
		</td>
		<td></td>
	</tr>
	<tr>
		<td class="buscarLabelRow">
			<label class="buscarLabel">Edad:</label>
		</td>
		<td>
		
  	<div class="layout-slider">
      <input id="rangoEdad" name="area" value="18;30" />
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
		
		</td>
	</tr>
	<tr>
		<td class="buscarLabelRow">
			<label class="buscarLabel">Sexo:</label>
		</td>
		<td></td>
	</tr>
	<tr>
		<td class="buscarLabelRow">
			<label class="buscarLabel">Avance de Carrera:</label>
		</td>
		<td>
		<input type="range" min="0" max="50" value="10" />
		</td>
	</tr>
</table>
	
	<label id="logErrorNot" class="regLabelNota regError"></label>
	<input class="buscarBtn" type="submit" value="Buscar">
</div>
<div class="loading">
	<img alt="" src="imagenes/loading.gif" width=30>
</div>


	<script>	

	 </script>
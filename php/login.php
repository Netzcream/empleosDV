<?php
if (!isset($_SESSION)) {
	session_start();
}
	$_SESSION['location'] = "login";
?>
<div class="prelogin">
<div class="openLogin">
	<input id="usuario" class="logInput" onkeypress="getEnter(event)" type="email" placeholder="juan.perez@davinci.edu.ar" maxlength="100">
	<input id="clave" class="logInput" onkeypress="getEnter(event)" type="password" placeholder="Contrase&ntilde;a" maxlength="10">
	
	<div class="logInOptions">
		<!--  <p><input id="logInCheckbox" type="checkbox">
		<label for="logInCheckbox">Recordarme</label></p>
		 -->
		<label class="labelCheckboxForLogin"><input id="logInCheckbox" type="checkbox" class="checkboxAlineado" value="" onclick=""><span>Recordarme</span></label>
		
		<p><label onclick="registro();">Registrarme</label></p>
	</div>
	
	
	
	
	<input class="logInBtn" type="submit" value="Ingresar" onclick="logmeIn();">
</div>
<div class="loading">
	<img alt="" src="imagenes/loading.gif" width=30>
</div>
<div id="logErrorNot" ></div>
<div id='reLabelNot'></div>
</div>


<script>

function getEnter(e) {
    if (e.keyCode == 13) { logmeIn(); }
}

function logmeIn() {
	$('.openLogin').hide("fast");
	$('.loading').show();
	$('#reLabelNot').hide("fast");
	
	var usr = $("#usuario").val();
	var pwd = $("#clave").val();
	
	if (usr == "" && pwd == "") { $("#logErrorNot").load ("php/logmein.php", {error : "1" }); }
	else if (usr == "") { $("#logErrorNot").load ("php/logmein.php", {error : "2" }); }
	else if (pwd == "") { $("#logErrorNot").load ("php/logmein.php", {error : "3" }); }
	else {
		var checkbox =  document.getElementById("logInCheckbox").checked;
		var chb = 0;
		if (checkbox == true) { chb = 1; }
		
		$("#logErrorNot").load ("php/logmein.php", {usr : usr, pwd:pwd, recuerda: chb });
	}
}
function registro() {
	var usr = $("#usuario").val();
	$("#cuerpo").load ("php/registro.php", {usr : usr });
}
</script>
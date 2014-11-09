<?php
if (!isset($_SESSION)) {
	session_start();
}
	$_SESSION['location'] = "login";
?>
<div class="prelogin">
	<input id="usuario" class="logInput" onkeypress="getEnter(event)" type="email" placeholder="juan.perez@davinci.edu.ar" maxlength="100">
	<input id="clave" class="logInput" onkeypress="getEnter(event)" type="password" placeholder="Contrase&ntilde;a" maxlength="15">
	<div class="logInOptions">
		<p><input id="logInCheckbox" type="checkbox">
		<label for="logInCheckbox">Recordarme</label></p>
		<p><label onclick="registro();">Registrarme</label></p>
	</div>
	<label id="logErrorNot" class="regLabelNota regError"></label>
	<input class="logInBtn" type="submit" value="Ingresar" onclick="logmeIn();">
</div>
<div class="loading">
	<img alt="" src="imagenes/loading.gif" width=30>
</div>

<script>

function getEnter(e) {
    if (e.keyCode == 13) { logmeIn(); }
}

function logmeIn() {
	var usr = $("#usuario").val();
	var pwd = $("#clave").val();
	
	if (usr == "" && pwd == "") { $("#logErrorNot").load ("php/logmein.php", {error : "1" }); }
	else if (usr == "") { $("#logErrorNot").load ("php/logmein.php", {error : "2" }); }
	else if (pwd == "") { $("#logErrorNot").load ("php/logmein.php", {error : "3" }); }
	else {
		$("#logErrorNot").load ("php/logmein.php", {usr : usr, pwd:pwd });
	}
}
function registro() {
	$("#cuerpo").load ("php/registro.php");
}
</script>
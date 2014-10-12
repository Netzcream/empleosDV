<?php
if (!isset($_SESSION)) {
	session_start();
}
	$_SESSION['location'] = "login";
?>
<div class="prelogin">
	<input class="logInput" type="email" placeholder="juan.perez@davinci.edu.ar">
	<input class="logInput" type="password" placeholder="Contrase&ntilde;a">
	<div class="logInOptions">
		<p><input id="logInCheckbox" type="checkbox">
		<label for="logInCheckbox">Recordarme</label></p>
		<p><label>Registrarme</label></p>
	</div>
	<label id="logErrorNot" class="regLabelNota regError"></label>
	<input class="logInBtn" type="submit" value="Ingresar">
</div>
<div class="loading">
	<img alt="" src="imagenes/loading.gif" width=30>
</div>
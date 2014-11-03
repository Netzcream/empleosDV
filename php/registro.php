<?php
if (!isset($_SESSION)) {
	session_start();
}
$_SESSION['location'] = "registro";

?>

<div class="prelogin">
<label class="logLabelLeft">Ingrese Correo *:</label>
<input id="Regemail" onkeypress="getEnter(event);" class="logInput" name="email" type="email" placeholder="juan.perez@davinci.edu.ar">
<label class="logLabelLeft">Ingrese Clave:</label>
<input id="RegPass1" onkeypress="getEnter(event);" class="logInput" name="pass" type="password" placeholder="Ingrese contrase&ntilde;a">
<label class="logLabelLeft">Repita Clave:</label>
<input id="RegPass2" onkeypress="getEnter(event);" class="logInput" name="pass2" type="password" placeholder="Repita contrase&ntilde;a">
	<div class="logInOptions">
		<p><label onclick="gotologin();">Ya estoy registrado</label></p>
	</div>

<label class="regLabelNota" title="Para poder registrarse debe poseer correo electrónico de la institución">* Para poder registrarse debe poseer correo @davinci.edu.ar</label>
<label id="regErrorNot" class="regLabelNota regError"></label>
<input class="logInBtn" type="submit" value="Registrarme" onclick="registerme();">
</div>
<div class="loading">
<img alt="" src="imagenes/loading.gif" width=30>
</div>

<script>
function registerme() {
	var email = $('#Regemail').val();
	var pass = $('#RegPass1').val();
	var pass2 = $('#RegPass2').val();
	if (email == "" && pass == "" && pass2 == "") { $("#regErrorNot").load ("php/regmein.php", {error : "1" }); }
	else if (email != "" && pass == "" && pass2 == "") { $("#regErrorNot").load ("php/regmein.php", {error : "2" }); }
	else if (email != "" && pass != "" && pass2 == "") { $("#regErrorNot").load ("php/regmein.php", {error : "3" }); }
	else if (email != "" && pass == "" && pass2 != "") { $("#regErrorNot").load ("php/regmein.php", {error : "4" }); }
	else if (email == "" && pass != "" && pass2 != "") { $("#regErrorNot").load ("php/regmein.php", {error : "5" }); }
	else if (email == "" && pass == "" && pass2 != "") { $("#regErrorNot").load ("php/regmein.php", {error : "6" }); }
	else if (email == "" && pass != "" && pass2 == "") { $("#regErrorNot").load ("php/regmein.php", {error : "7" }); }
	else if (email != "" && pass != "" && pass2 != "" ) { 
		if (pass != pass2) {
			$("#regErrorNot").load ("php/regmein.php", {error : "8" }); 
		}
		else {
			$("#regErrorNot").load ("php/regmein.php", { email:email,pass:pass,pass2:pass2 });
		}
	}
}
function getEnter(e) {
    if (e.keyCode == 13) { registerme(); }
}
function gotologin() {
	$("#cuerpo").load ("php/login.php");
}
</script>



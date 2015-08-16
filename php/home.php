<?php 
if (!isset($_SESSION)) {
	session_start();
}
$_SESSION['location'] = "home";

if (isset($_SESSION['estadoUsuario']) AND $_SESSION['UsuarioRol'] AND ($_SESSION['estadoUsuario'] == 2) AND ($_SESSION['UsuarioRol'] == "SA")) {
		include_once("primerosDatos.php");
}
else {

?>
<script type="text/javascript" src="js/twitter/tweetie.js"></script>
<div class="itsABody">




<div><img class="logoInicio" src="imagenes/logo/logo250.png"> </div>
<span class="labelInicio">Bolsa DV - Encontrate con tu trabajo</span>
<div><img onclick="OpenInNewTab('http://www.davinci.edu.ar/');" class="LogoDavinci" src="imagenes/logodavinci.png"> </div>
</div>

<?php



}




?>
<script>

function OpenInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}
//errorToas('Prueba de Home');
$(document).ready(function() {
	hideWait();
});
</script>
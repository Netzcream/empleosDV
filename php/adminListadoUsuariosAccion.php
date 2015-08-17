<?php
if (!isset($_SESSION)) {
	session_start();
}
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php'; }

if ($_POST['accion'] == 'bloquear') {
	$SQL = "UPDATE Usuario set estado = 4 WHERE CodUsuario = ".$_POST['codUsr'];
	$conex = new MySQL();
	$conex->consulta($SQL);
}
if ($_POST['accion'] == 'desbloquear') {
	$SQL = "UPDATE Usuario set estado = 3 WHERE CodUsuario = ".$_POST['codUsr'];
	$conex = new MySQL();
	$conex->consulta($SQL);
}

?>
<script>GoTo(12);</script>
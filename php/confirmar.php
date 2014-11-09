<?php
if (isset($_GET)) {

	if (isset($_GET['m']) && isset($_GET['c']) ) {

		$email = $_GET['m'];
		$codigo = $_GET['c'];
		$email = substr($email,0,100);
		$email = stripslashes($email);
		$email = htmlentities($email,ENT_QUOTES);
		$codigo = stripslashes($codigo);
		$codigo = htmlentities($codigo,ENT_QUOTES);
		echo "Verificando";
		return;
	}

}

?>
<?php
if (isset($_GET)) {

	if (isset($_GET['m']) && isset($_GET['c']) ) {

		$email = $_GET['m'];
		$codigo = $_GET['c'];
		$email = substr($email,0,100);
		$email = stripslashes($email);
		$email = htmlentities($email);
		$codigo = stripslashes($codigo);
		$codigo = htmlentities($codigo);
		echo "Verificando";
		return;
	}

}

?>
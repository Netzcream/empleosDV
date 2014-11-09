<?php
include_once("/mail.php");
$email = new Email('r','luciano.pujol@davinci.edu.ar','9223372036854775807');
$temp = $email->sendMail();
var_dump($temp);
if ($temp) {
	echo "Enviado correctamente";
	
}
else {
	echo "Error";
	
}

?>
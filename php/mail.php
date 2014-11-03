<?php

$from = "info@bolsadv.com";

$nombre ="Luciano";
$email = "pujol.luciano@gmail.com";
$comentario ="Hola!!!";

$to = "netzcream@gmail.com";
$subject = "Mensaje Enviado";
$contenido .= "Nombre: ".$nombre."\n";
$contenido .= "Email: ".$email."\n\n";
$contenido .= "Comentario: ".$comentario."\n\n";
$header = "From: ".$from."\nReply-To:".$from."\n";
$header .= "Mime-Version: 1.0\n";
$header .= "Content-Type: text/plain";
if(mail($to, $subject, $contenido ,$header)){
echo "Mail Enviado.";

}
?>
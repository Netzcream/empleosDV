<?php
include_once("/conex.php");

class Email {
	public $fromName;
	public $from;
	public $to;
	public $cco;
	public $subject;
	public $contenido;
	public $header;
	public $apellido;
	public $nombre;
	public $tipo;
	public $param;
	
	
	
	public function __construct($tipo,$to,$content = "nulo",$subject = "nulo") {
		$this->fromName = "BolsaDV Info";
		$this->from = "info@bolsadv.com";
		$this->to = $to;
		$this->tipo = $tipo;
		$this->param = $content;
		$this->contenido = $content;
		$this->subject = $subject;
		/*
		 * r = registro;
		 * v = verificado;
		 * l = login;
		 * e = error;
		 * c = confirmar Email
		 * n = Notificar
		 * p = por parametro
		 * */
		$this->setContent($this->tipo);
		$this->cambioDatos();
	}
	
	
	
	public function setContent($a) {
		switch ($a) {
			case 'r':
				$this->setContenido("Acabas de registrarte en BolsaDV\nTu registro se encuentra pendiente de confirmación.  Para ello debes hacer click en el siguiente enlace:
						\nhttp://www.bolsadv.com/?m=%to%&c=%param%
						\n\nMuchas gracias.");
				$this->header = "From: ". $this->fromName . " <" . $this->from . ">\nReply-To:".$this->from."\n";
				$this->header .= "Mime-Version: 1.0\n";
				$this->header .= "Content-Type: text/plain";
				$this->subject = "Confirmación de registro";
				break;
				case 'v':
					$this->setContenido("Confirmaste tu correo electrónico satisfactoriamente.\nYa puedes loguearte al sistema:
						\nhttp://www.bolsadv.com/
						\n\nMuchas gracias.");
					$this->header = "From: ". $this->fromName . " <" . $this->from . ">\nReply-To:".$this->from."\n";
					$this->header .= "Mime-Version: 1.0\n";
					$this->header .= "Content-Type: text/plain";
					$this->subject = "Email verificado";
					break;
					
				case 'p':
					$this->setContenido("Usuario autorizado; ya puede ingresar:
						\nhttp://www.bolsadv.com/
						\n\nMuchas gracias.");
					$this->header = "From: ". $this->fromName . " <" . $this->from . ">\nReply-To:".$this->from."\n";
					$this->header .= "Mime-Version: 1.0\n";
					$this->header .= "Content-Type: text/plain";
					break;
			case 'bloqueo':
				$this->setContenido("");
				$this->header = "From: ". $this->fromName . " <" . $this->from . ">\nReply-To:".$this->from."\n";
				$this->header .= "Mime-Version: 1.0\n";
				$this->header .= "Content-Type: text/plain";
				break;
				
			default:
				$this->setContenido($a);
				break;
		}
	}
	
	public function cambioDatos() {
		$this->setContenido(str_replace('%apellido%',$this->apellido,$this->getContenido()));
		$this->setContenido(str_replace('%nombre%',$this->nombre,$this->getContenido()));
		$this->setContenido(str_replace('%param%',$this->param,$this->getContenido()));
		$this->setContenido(str_replace('%to%',$this->to,$this->getContenido()));
	}
	/********************** SEND MAIL **************************/
	
	public function sendMail() {
		$send = mail($this->to,$this->subject,$this->contenido,$this->header);
		if ($send) { return true; }
		else { return false; } 
		
	}
	
	
	/********************** GETTERS & SETTERS **************************/
	
	public function getFrom() { return $this->from; }
	public function setFrom($a) { $this->from = $a; }
	public function getTo() { return $this->to; }
	public function setTo($a) { $this->to = $a; }
	public function getCco() { return $this->cco; }
	public function setCco($a) { $this->cco = $a; }
	public function getSubject() { return $this->subject; }
	public function setSubject($a) { $this->subject = $a; }
	public function getContenido() { return $this->contenido; }
	public function setContenido($a) { $this->contenido = $a; }
	public function getHeader() { return $this->header; }
	public function setHeader($a) { $this->header = $a; }


}

?>
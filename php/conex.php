<?php
	class MySQL{  
		private $conexion;  
		private $total_consultas;  
		private $lastID; 
		private $resultado;
		public function MySQL(){  
			$this->conexion = new mysqli("127.0.0.1", "root", "", "bolsadv");
			$this->conexion->query("SET NAMES 'utf8'");
			if ($this->conexion->connect_errno) {
				printf("Falló la conexión: %s\n", $mysqli->connect_error);
				exit();
			}
			/*
			if(!isset($this->conexion)){  
				$this->conexion = (mysql_connect("127.0.0.1","root","")) or die(mysql_error());
				mysql_select_db("bolsadv",$this->conexion) or die(mysql_error());  
			} */ 
		}  
		public function consulta($consulta){  
			$this->resultado = $this->conexion->query($consulta);
			if(!$this->resultado){  
				echo 'MySQL Error: '.$this->conexion->error;  
				exit;
			}  
			return $this->resultado;   
		}  
		
		public function fetch_array(){   
			return $this->resultado->fetch_array();  
		}  
		public function fetch_assoc(){
			return $this->resultado->fetch_assoc();
		}
		public function num_rows(){   
			return mysqli_num_rows($this->resultado);  
		}  
		public function num_fields(){
			return mysqli_num_fields($this->resultado);
		}
		public function last_id(){
			return $this->conexion->insert_id;
		}
		public function escape($a) {
			return $this->conexion->real_escape_string($a);
		}
		public function getTotalConsultas(){  
			return $this->total_consultas;  
		}  
	}
	

	


?>
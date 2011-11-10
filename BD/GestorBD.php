<?php
	class GestorBD
	{
		private $conn;
		
		//public GestorBD(){}
		
		public function conectar()
		{
			$this->conn = mysql_connect('localhost', 'root', '');
			if (!$this->conn) {
				//die('No se pudo conectar: ' . mysql_error());
				return false;
			}else{
				mysql_select_db("sotneve", $this->conn);
				return true;
			}
		}
		
		public function desconectar()
		{
			mysql_close($this->conn);
	
		}
		
		public function escapeString($str)
		{
			return mysql_real_escape_string($str, $this->conn);
		}
		
		public function consulta($query)      //CUIDAOOOOOOOOO! SQL Injection !!
		{
			return mysql_query($query, $this->conn);
		}
		

		public function numeroUsuarios()
		{
			$res = mysql_query("SELECT idUsuario FROM usuarios", $this->conn);
			return mysql_num_rows($res);
			
		}
		
		public function passCorrecta($email, $pass)
		{
			$query = sprintf("SELECT * FROM usuarios WHERE email = '%s' AND pass = SHA2('%s', 256)", $email, $pass);
			$result = $this->consulta($query);
			if(mysql_num_rows($result) > 0){
				$row = mysql_fetch_assoc($result);
				return $row;
			}else{
				return false;
			}
		}
		
		
		
		
		
		
		
		
		
	}



?>

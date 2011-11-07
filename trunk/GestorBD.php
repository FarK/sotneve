<?php
	class GestorBD
	{
		private $conn;
		
		//public GestorBD(){}
		
		public function conectar()
		{
			$this->conn = mysql_connect('localhost', 'root', '');
			if (!$this->conn) {
				die('No se pudo conectar: ' . mysql_error());
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
		
		public function consulta($query)      //CUIDAOOOOOOOOO! SQL Injection !!
		{
			mysql_query($query, $this->conn) or die(mysql_error());
		}
		

		public function numeroUsuarios()
		{
			$res = mysql_query("SELECT idUsuario FROM usuarios", $this->conn);
			return mysql_num_rows($res);
			
		}
		
		
		public function emailYaRegistrado($user)
		{
			$u = mysql_real_escape_string($user, $this->conn);
			$result = mysql_query("SELECT idUsuario FROM USERS WHERE email = '".$u."'", $this->conn);
			if(mysql_num_rows($result)>0)
			{
				return true;
			}else
			{
				return false;
			}
		}
		
		
		
		
		
		
		
		
		
	}



?>

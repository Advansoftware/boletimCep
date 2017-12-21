<?php
	class Login_model extends CI_Model {

		public function __construct()
		{
			$this->load->database();
		}
		
		public function get_login($email = FALSE, $senha = FALSE)
		{
			$dataResult = "";
			$query = $this->db->query("SELECT id, senha FROM 
								Usuario WHERE email = ".$this->db->escape($email)." AND senha = sha2(".$this->db->escape($senha).",512)");
			$data =  $query->row_array();
			if(!empty($data))
				$dataResult = hash("sha512",$data['id'].$data['senha']);
			return $dataResult;
		}
		
		public function session_is_valid($hash){
			$query = $this->db->query("SELECT id FROM 
										Usuario WHERE sha2(concat(id,senha),512) = ".$this->db->escape($hash)."");
			return $query->row_array();
		}
	}
?>
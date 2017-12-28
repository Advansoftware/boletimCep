<?php
	class Login_model extends CI_Model {

		public function __construct()
		{
			$this->load->database();
		}
		
		public function get_login($email = FALSE, $senha = FALSE)
		{
			$dataResult = "";
			$query = $this->db->query("SELECT id, grupo_id, senha FROM 
								usuario WHERE email = ".$this->db->escape($email)." AND senha = ".$this->db->escape($senha)."");
			 $data =  $query->row_array();
			 if(!empty($data))
			 {
				 //atualizar ultimo acesso
				 $query = $this->db->query("UPDATE usuario SET ultimo_acesso = NOW()  
				 					WHERE id = ".$this->db->escape($data['id'])."");
				 $dataResult = $data;
			 }
			return $dataResult;
		}
		
		public function session_is_valid($id){
			$query = $this->db->query("SELECT id FROM 
										usuario WHERE id = ".$this->db->escape($id)."");
			return $query->row_array();
		}
	}
?>
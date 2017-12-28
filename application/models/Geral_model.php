<?php
	class Geral_model extends CI_Model {

		public function __construct()
		{
			$this->load->database();
		}
		
		public function get_identificador_menu($modulo)
		{
			
			$query = $this->db->query("SELECT menu_id FROM modulo WHERE url = ".$this->db->escape($modulo)."");
			$result = $query->row_array();
				
			return $result['menu_id'];
		}
		
		public function get_permissao($type, $modulo)
		{
			$query = $this->db->query("SELECT a.$type FROM acesso a 
										INNER JOIN modulo m ON a.modulo_id = m.id 
										WHERE grupo_id = ".$this->session->grupo_id."  
										AND m.url = ".$this->db->escape($modulo)."");
			$result = $query->row_array();
			
			if(!empty($result))
				return $result["$type"] == 1;
			return false;
		}
	}
?>
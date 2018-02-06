<?php
	class Disciplina_model extends CI_Model {
		
		/*
			CONECTA AO BANCO DE DADOS DEIXANDO A CONEX�O ACESS�VEL PARA OS METODOS
			QUE NECESSITAREM REALIZAR CONSULTAS.
		*/
		public function __construct()
		{
			$this->load->database();
		}
		
		/*
			RETORNA UM LEAD DE ACORDO COM O ID, 
			CASO O PARAMETRO ID NAO SEJA PASSADO RETORNA UMA LISTA DE LEAD
		*/
		public function get_disciplina($id = FALSE, $page = false)
		{
			if ($id === FALSE)//retorna todos se nao passar o parametro
			{
				$limit = $page * ITENS_POR_PAGINA;
				$inicio = $limit - ITENS_POR_PAGINA;
				$step = ITENS_POR_PAGINA;	
				
				$pagination = " LIMIT ".$inicio.",".$step;
				if($page === false)
					$pagination = "";
					
				$query = $this->db->query("
					SELECT (SELECT count(*) FROM  disciplina WHERE ativo = 1) AS size,  
					d.id, d.nome as nome_disciplina, d.ativo, 
					d.data_registro, c.nome as nome_categoria, d.categoria_id 
						FROM disciplina d
					INNER JOIN categoria c ON d.categoria_id = c.id 
					WHERE d.ativo = 1 
					ORDER BY d.data_registro DESC ". $pagination ."");

				return $query->result_array();
			}
			$query = $this->db->get_where('disciplina', array('id' => $id));

			return $query->row_array();
		}
		
		public function get_disciplina_por_curso($id)
		{
			$query = $this->db->query("
				SELECT d.id, d.nome FROM disciplina_curso dc 
				INNER JOIN disciplina d ON dc.disciplina_id = d.id 
				WHERE dc.curso_id = ".$this->db->escape($id)."");
			return $query->result_array();
		}
		
		/*
			INSERE OU ATUALIZA UM LEAD 
		*/
		public function set_disciplina($data)
		{
			if(empty($data['id']))
				return $this->db->insert('disciplina',$data);	
			else
			{
				$this->db->where('id', $data['id']);
				return $this->db->update('disciplina', $data);
			}
		}
		
		/*
			FAZ UM UPDATE DESATIVANDO O LEAD, CASO NECESSITAR REATIVA-LO ALGUM DIA
		*/
		public function delete_disciplina($id){
			// $this->db->where('id',$id);
			// return $this->db->delete("leads");
			return $this->db->query("
				UPDATE disciplina SET ativo = 0 WHERE id = ".$this->db->escape($id)."");
		}
	}
?>
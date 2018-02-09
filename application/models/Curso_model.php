<?php
	class Curso_model extends CI_Model {
		
		/*
			CONECTA AO BANCO DE DADOS DEIXANDO A CONEXÃO ACESSÍVEL PARA OS METODOS
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
		public function get_curso($id = FALSE, $page = FALSE)
		{
			if ($id === FALSE)//retorna todos se nao passar o parametro
			{
				$limit = $page * ITENS_POR_PAGINA;
				$inicio = $limit - ITENS_POR_PAGINA;
				$step = ITENS_POR_PAGINA;	
				
				$pagination = " LIMIT ".$inicio.",".$step;
				if($page === false)
					$pagination = "";

				$query =  $this->db->query("SELECT (SELECT count(*) FROM  curso WHERE ativo = 1) AS size, 
											c.id, c.nome, 
											DATE_FORMAT(c.data_registro, '%d/%m/%Y') as data_registro, 
												(SELECT COUNT(*) FROM disciplina_curso dc 
													WHERE dc.curso_id = c.id) as qtd_disciplina  
											FROM curso c 
											WHERE ativo = 1 ORDER BY c.data_registro DESC 
											". $pagination ."");
				return $query->result_array();
			}

			$query =  $this->db->query("SELECT c.id, c.nome as nome_curso, 
										DATE_FORMAT(c.data_registro, '%d/%m/%Y') as data_registro, 
										dc.disciplina_id 
											FROM curso c 
										LEFT JOIN disciplina_curso dc ON c.id = dc.curso_id 
										LEFT JOIN disciplina d ON dc.disciplina_id = d.id 
										WHERE c.ativo = 1 AND c.id = ".$this->db->escape($id)."");
			return $query->result_array();
		}

		public function set_curso($data)
		{

			if($this->valida_curso($data) > 0)
				return "Este curso já está cadastrado no sistema.";

			if(empty($data['id']))
			{
				$dataToSave = array(
					'nome' => $data['nome'],
					'ativo' => $data['ativo']
				);
				$this->db->insert('curso',$dataToSave);
				$query = $this->db->query('SELECT id FROM curso ORDER BY id DESC LIMIT 1');
				$query = $query->row_array();
				for($i = 0; $i < count($data['disciplinas_id']); $i++)
				{
					$dataToSave = array(
						'disciplina_id' => $data['disciplinas_id'][$i],
						'curso_id' => $query['id']
					);
					$this->db->insert('disciplina_curso',$dataToSave);
				}
			}
			else
			{
				$query = $this->db->query("SELECT disciplina_id FROM disciplina_curso
								WHERE curso_id = ".$this->db->escape($data['id'])."");
				$query = $query->result_array();
				
				//DELETA OS QUE FORAM REMOVIDOS NA TELA PELO USUARIO
				for($i = 0; $i < count($query); $i++)
				{
					$flag = 0;
					for($j = 0; $j < count($data['disciplinas_id']); $j++)
					{
						if($query[$i]['disciplina_id'] == $data['disciplinas_id'][$j])
							$flag = 1;
					}
					if($flag == 0)
						$this->db->query("DELETE FROM disciplina_curso 
										WHERE disciplina_id = ".$this->db->escape($query[$i]['disciplina_id'])." AND curso_id =  
										".$this->db->escape($data['id'])."");
				}
				//FAZ INSERT DE TODOS, POREM OS INSERE DE SUCESSO SÃO AQUELES QUE NÃO VIOLAM A CHAVE PRIMARI
				for($i = 0; $i < count($data['disciplinas_id']); $i++)
					$this->db->query("INSERT IGNORE INTO disciplina_curso(disciplina_id, curso_id)
										VALUES(".$this->db->escape($data['disciplinas_id'][$i]).",".$this->db->escape($data['id']).")");
				$dataToSave = array(
					'id' => $data['id'],
					'nome' => $data['nome']
				);
				$this->db->where('id', $data['id']);
				$this->db->update('curso', $dataToSave);
			}
			return "sucesso";
		}
		
		public function valida_curso($data)
		{
			$query = $this->db->query("
				SELECT nome FROM curso 
				WHERE UPPER(nome) = UPPER(".$this->db->escape($data['nome']).") AND 
				id != ".$this->db->escape($data['id'])."");

			return $query->num_rows();
		}
		
		public function delete_curso($id)
		{
			return $this->db->query("UPDATE curso SET ativo = 0 WHERE id = ".$this->db->escape($id)."");
		}
	}
?>
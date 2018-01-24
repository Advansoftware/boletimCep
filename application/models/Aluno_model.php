<?php
	class Aluno_model extends CI_Model 
	{
		
		/*
			CONECTA AO BANCO DE DADOS DEIXANDO A CONEXÃO ACESSÍVEL PARA OS METODOS
			QUE NECESSITAREM REALIZAR CONSULTAS.
		*/
		public function __construct()
		{
			$this->load->database();
		}

		public function get_aluno($id = FALSE, $page = FALSE)
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
					SELECT (SELECT count(*) FROM aluno WHERE ativo = 1) AS size,
					a.id, DATE_FORMAT(a.data_registro, '%d/%m/%Y') as data_registro, a.matricula, 
					a.nome as nome_aluno, a.sexo, 
					DATE_FORMAT(a.data_nascimento, '%d/%m/%Y') as data_nascimento,
					a.numero_chamada, a.curso_id, t.nome as nome_turma, c.nome as nome_curso 
						FROM aluno a 
					LEFT JOIN turma_aluno ta ON a.Id = ta.aluno_id 
					LEFT JOIN turma t ON ta.turma_id = t.id
					INNER JOIN curso c ON a.curso_id = c.id 
					WHERE a.ativo = 1 ORDER BY a.numero_chamada ASC ". $pagination ."");

				return $query->result_array();
			}

			$query = $this->db->query("
					SELECT a.id, a.matricula, a.nome as nome_aluno, a.sexo, 
					DATE_FORMAT(a.data_nascimento, '%d/%m/%Y') as data_nascimento,
					DATE_FORMAT(a.data_registro, '%d/%m/%Y') as data_registro, 
					a.numero_chamada, a.curso_id, t.nome as nome_turma, c.nome as nome_curso, a.ativo  
						FROM aluno a 
					LEFT JOIN turma t ON a.turma_id = t.id 
					INNER JOIN curso c ON a.curso_id = c.id 
					WHERE a.ativo = 1 AND a.id = ".$this->db->escape($id)." 
					ORDER BY a.data_registro DESC ");

			return $query->result_array();
		}
		
		public function get_aluno_por_curso($id,$turma_id)//por curso e lista somente os alunos que nao possuem relacionamento com turma no ano corrente
		{
			$query = $this->db->query("
				SELECT a.id, a.nome, ta.turma_id FROM aluno a 
				LEFT JOIN turma_aluno ta ON a.id = ta.aluno_id 
				WHERE a.curso_id = ".$this->db->escape($id)." AND 
				(ta.turma_id is null OR ta.turma_id = ".$this->db->escape($turma_id)." OR
				YEAR(ta.data_registro) != YEAR(NOW())) GROUP BY a.nome");
print_r($query);
			return $query->result_array();
		}
		
		public function set_aluno($data)
		{
			if(empty($data['id']))
				return $this->db->insert('aluno',$data);
			else
			{
				$this->db->where('id', $data['id']);
				return $this->db->update('aluno', $data);
			}
		}
		
		public function delete_aluno($id)
		{
			// $this->db->where('id',$id); 
			// return $this->db->delete("leads");
			return $this->db->query("UPDATE aluno SET ativo = 0 WHERE id = ".$this->db->escape($id)."");
		}
	}
?>
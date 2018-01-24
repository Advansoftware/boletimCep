<?php
	class Turma_model extends CI_Model {
		
		/*
			CONECTA AO BANCO DE DADOS DEIXANDO A CONEXÃO ACESSÍVEL PARA OS METODOS
			QUE NECESSITAREM REALIZAR CONSULTAS.
		*/
		public function __construct()
		{
			$this->load->database();
		}

		public function get_turma($id = FALSE, $page = FALSE)
		{
			if ($id === FALSE)//retorna todos se nao passar o parametro
			{
				$limit = $page * ITENS_POR_PAGINA;
				$inicio = $limit - ITENS_POR_PAGINA;
				$step = ITENS_POR_PAGINA;
				
				$pagination = " LIMIT ".$inicio.",".$step;
				if($page === false)
					$pagination = "";

				$query =  $this->db->query(
					"SELECT (SELECT count(*) FROM turma WHERE ativo = 1) AS size, 
					t.id, t.ativo, DATE_FORMAT(t.data_registro, '%d/%m/%Y') as data_registro, 
					t.nome as nome_turma, t.curso_id, c.nome as nome_curso, 
					(SELECT count(*) FROM turma_aluno ta WHERE ta.turma_id = t.id) as qtd_aluno
						FROM turma t 
					INNER JOIN curso c ON t.curso_id = c.id 
					WHERE t.ativo = 1 
					ORDER BY t.data_registro DESC ".$pagination."");

				return $query->result_array();
			}

			$query =  $this->db->query(
				"SELECT t.id, t.ativo, DATE_FORMAT(t.data_registro, '%d/%m/%Y') as data_registro, 
				t.nome as nome_turma, t.curso_id, c.nome as nome_curso, 
				(SELECT count(*) FROM turma_aluno ta WHERE ta.turma_id = t.id) as qtd_aluno
					FROM turma t 
				INNER JOIN curso c ON t.curso_id = c.id 
				WHERE t.ativo = 1 
				AND t.id = ".$id."");

				return $query->row_array();
		}
		
		public function get_disciplina_por_turma($turma_id)
		{
			$query = $this->db->query("
				SELECT td.disciplina_id, d.nome 
					FROM  turma_disciplina td 
				INNER JOIN disciplina d ON td.disciplina_id = d.id 
				WHERE td.turma_id = ".$this->db->escape($turma_id)."");

			return $query->result_array();
		}
		
		public function get_aluno_por_turma($turma_id, $page = false)
		{
			$limit = $page * ITENS_POR_PAGINA;
			$inicio = $limit - ITENS_POR_PAGINA;
			$step = ITENS_POR_PAGINA;
			
			$pagination = " LIMIT ".$inicio.",".$step;
			if($page === false)
				$pagination = "";

			$query = $this->db->query("
				SELECT (
					SELECT count(*) FROM turma_aluno 
					WHERE turma_id = ".$this->db->escape($turma_id).") 
					AS size,
				ta.aluno_id, a.nome, a.numero_chamada, c.nome as nome_curso, ta.turma_id 
				FROM turma_aluno ta 
				INNER JOIN aluno a ON ta.aluno_id = a.id 
				INNER JOIN curso c ON a.curso_id = c.id 
				WHERE ta.turma_id = ".$this->db->escape($turma_id)."".$pagination."");

			return $query->result_array();
		}
		
		public function get_turma_por_curso($id, $page)
		{
			$limit = $page * ITENS_POR_PAGINA;
			$inicio = $limit - ITENS_POR_PAGINA;
			$step = ITENS_POR_PAGINA;
			
			$pagination = " LIMIT ".$inicio.",".$step;
			if($page === false)
				$pagination = "";
			
			$query =  $this->db->query(
				"SELECT (
						SELECT count(*) FROM turma t2 
						INNER JOIN curso c2 ON t2.curso_id = c2.id 
						WHERE t2.ativo = 1 AND c2.id = ".$this->db->escape($id).") 
						AS size, 
				t.id, t.ativo, DATE_FORMAT(t.data_registro, '%d/%m/%Y') as data_registro, 
				t.nome as nome_turma, t.curso_id, c.nome as nome_curso, 
				(SELECT count(*) FROM turma_aluno ta WHERE ta.turma_id = t.id) as qtd_aluno 
					FROM turma t 
				INNER JOIN curso c ON t.curso_id = c.id 
				WHERE t.ativo = 1 AND c.id = ".$this->db->escape($id)." 
				ORDER BY t.data_registro DESC ".$pagination."");

				return $query->result_array();
		}
		
		public function troca_aluno($data)
		{//ok
			$query = $this->db->query("
				UPDATE turma_aluno SET turma_id = ".$this->db->escape($data['turma_id'])."
				WHERE aluno_id = ".$this->db->escape($data['aluno_id'])." AND 
				turma_id = ".$this->db->escape($data['id_atual'])."");
		}
		
		
		
		/*
			INSERE OU ATUALIZA UM LEAD 
		*/
		public function set_turma($data)
		{
			if(empty($data['id']))
			{
				$this->db->insert('turma',$data);
				//pegar o id da turma gerado
				$query = $this->db->query("SELECT id FROM turma ORDER BY id DESC LIMIT 1");
				$query = $query->row_array();
				return $query['id'];
			}
			else
			{
				$this->db->where('id', $data['id']);
				$this->db->update('turma', $data);
				return $data['id'];
			}
		}
		
		public function set_turma_disciplina($data)
		{
			$query = $this->db->query("SELECT disciplina_id FROM turma_disciplina
							WHERE turma_id = ".$this->db->escape($data['turma_id'])."");
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
					$this->db->query("
						DELETE FROM turma_disciplina 
						WHERE disciplina_id = ".$this->db->escape($query[$i]['disciplina_id'])." AND 
						turma_id =  ".$this->db->escape($data['turma_id'])."");
			}
			//FAZ INSERT DE TODOS, POREM OS INSERE DE SUCESSO SÃO AQUELES QUE NÃO VIOLAM A CHAVE PRIMARI
			for($i = 0; $i < count($data['disciplinas_id']); $i++)
				$this->db->query("
					INSERT IGNORE INTO turma_disciplina(disciplina_id, turma_id)
					VALUES
							(".$this->db->escape($data['disciplinas_id'][$i]).",
							".$this->db->escape($data['turma_id']).")");
			return $data['turma_id'];
		}
		
		public function set_turma_aluno($data)
		{
			$query = $this->db->query("SELECT aluno_id FROM turma_aluno
							WHERE turma_id = ".$this->db->escape($data['turma_id'])."");
			$query = $query->result_array();
			
			//DELETA OS QUE FORAM REMOVIDOS NA TELA PELO USUARIO
			for($i = 0; $i < count($query); $i++)
			{
				$flag = 0;
				for($j = 0; $j < count($data['alunos_id']); $j++)
				{
					if($query[$i]['aluno_id'] == $data['alunos_id'][$j])
						$flag = 1;
				}
				if($flag == 0)
					$this->db->query("
						DELETE FROM turma_aluno 
						WHERE aluno_id = ".$this->db->escape($query[$i]['aluno_id'])." AND 
						turma_id = ".$this->db->escape($data['turma_id'])."");
			}
			//FAZ INSERT DE TODOS, POREM OS INSERE DE SUCESSO SÃO AQUELES QUE NÃO VIOLAM A CHAVE PRIMARI
			for($i = 0; $i < count($data['alunos_id']); $i++)
				$this->db->query("
					INSERT IGNORE INTO turma_aluno(aluno_id, turma_id)
					VALUES(".$this->db->escape($data['alunos_id'][$i]).",
					".$this->db->escape($data['turma_id']).")");
		}
		
		/*
			FAZ UM UPDATE DESATIVANDO O LEAD, CASO NECESSITAR REATIVA-LO ALGUM DIA
		*/
		public function delete_turma($id){
			// $this->db->where('id',$id); 
			// return $this->db->delete("leads");
			return $this->db->query("UPDATE turma SET ativo = 0 WHERE id = ".$this->db->escape($id)."");
		}
	}
?>
<?php
	class Aluno_model extends CI_Model {
		
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
		public function get_aluno($id = FALSE)
		{
			if ($id === FALSE)//retorna todos se nao passar o parametro
			{
				$query =  $this->db->query(
					"SELECT a.Id, DATE_FORMAT(a.DataRegistro, '%d/%m/%Y') as DataRegistro, a.Matricula, a.Nome as NomeAluno, a.Sexo, DATE_FORMAT(a.DataNascimento, '%d/%m/%Y') as DataNascimento, a.NumeroChamada, a.CursoId, t.Nome as NomeTurma, c.Nome as NomeCurso 
					FROM Aluno a 
					LEFT JOIN Turma_Aluno ta ON a.Id = ta.AlunoId 
					LEFT JOIN Turma t ON ta.TurmaId = t.Id
					INNER JOIN Curso c ON a.CursoId = c.Id 
					WHERE a.ativo = 1 ORDER BY a.DataRegistro DESC ");
				return $query->result_array();
			}

			$query =  $this->db->query(
					"SELECT a.Id, a.Matricula, a.Nome as NomeAluno, a.Sexo, a.DataNascimento, a.NumeroChamada, a.CursoId, t.Nome as NomeTurma, c.Nome as NomeCurso 
					FROM Aluno a 
					LEFT JOIN Turma t ON a.TurmaId = t.Id 
					INNER JOIN Curso c ON a.CursoId = c.Id 
					WHERE a.ativo = 1 AND a.Id = ".$this->db->escape($id)." ORDER BY a.DataRegistro DESC ");
			return $query->result_array();
		}
		
		public function get_aluno_por_curso($id,$turma_id)//por curso e lista somente os alunos que nao possuem relacionamento com turma
		{
			$query = $this->db->query("SELECT a.Id, a.Nome,ta.TurmaId FROM Aluno a 
										LEFT JOIN Turma_Aluno ta ON a.Id = ta.AlunoId 
										WHERE a.CursoId = ".$this->db->escape($id)." AND 
										(ta.TurmaId is null OR ta.TurmaId = ".$this->db->escape($turma_id).")");
			return $query->result_array();
		}
		
		/*
			INSERE OU ATUALIZA UM LEAD 
		*/
		public function set_aluno($data)
		{
			if(empty($data['Id']))
				return $this->db->insert('Aluno',$data);
			else
			{
				$this->db->where('Id', $data['Id']);
				return $this->db->update('Aluno', $data);
			}
		}
		
		/*
			FAZ UM UPDATE DESATIVANDO O LEAD, CASO NECESSITAR REATIVA-LO ALGUM DIA
		*/
		public function delete_aluno($id){
			// $this->db->where('id',$id); 
			// return $this->db->delete("leads");
			return $this->db->query("UPDATE Aluno SET Ativo = 0 WHERE Id = ".$this->db->escape($id)."");
		}
	}
?>
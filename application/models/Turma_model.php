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
		
		/*
			RETORNA UM LEAD DE ACORDO COM O ID, 
			CASO O PARAMETRO ID NAO SEJA PASSADO RETORNA UMA LISTA DE LEAD
		*/
		public function get_turma($id = FALSE)
		{
			if ($id === FALSE)//retorna todos se nao passar o parametro
			{
				$query =  $this->db->query(
					"SELECT t.Id, t.Ativo, DATE_FORMAT(t.DataRegistro, '%d/%m/%Y') as DataRegistro, t.Nome as NomeTurma, t.CursoId, c.Nome as NomeCurso, 
					(SELECT count(*) FROM Turma_Aluno ta WHERE ta.TurmaId = t.Id) as Qtd_Aluno
					FROM Turma t 
					INNER JOIN Curso c ON t.CursoId = c.Id 
					WHERE t.Ativo = 1 ORDER BY t.DataRegistro DESC");
				return $query->result_array();
			}

			$query =  $this->db->query(
					" SELECT t.Id, t.Nome as NomeTurma, t.CursoId FROM Turma t WHERE t.Id = ".$this->db->escape($id)."");
			return $query->result_array();
		}
		
		public function get_disciplina_por_turma($turma_id){
			$query = $this->db->query("SELECT td.DisciplinaId, d.Nome FROM  Turma_Disciplina td 
										INNER JOIN Disciplina d ON td.DisciplinaId = d.Id 
										WHERE td.TurmaId = ".$this->db->escape($turma_id)."");
			return $query->result_array();
		}
		
		public function get_aluno_por_turma($turma_id){
			$query = $this->db->query("SELECT ta.AlunoId, a.Nome, a.NumeroChamada, c.Nome as NomeCurso, ta.TurmaId FROM Turma_Aluno ta 
										INNER JOIN Aluno a ON ta.AlunoId = a.Id 
										INNER JOIN Curso c ON a.CursoId = c.Id 
										WHERE ta.TurmaId = ".$this->db->escape($turma_id)."");
			return $query->result_array();
		}
		
		public function get_turma_por_curso($id){
			$query =  $this->db->query(
					"SELECT t.Id, t.Ativo, DATE_FORMAT(t.DataRegistro, '%d/%m/%Y') as DataRegistro, t.Nome as NomeTurma, t.CursoId, c.Nome as NomeCurso, 
					(SELECT count(*) FROM Turma_Aluno ta WHERE ta.TurmaId = t.Id) as Qtd_Aluno
					FROM Turma t 
					INNER JOIN Curso c ON t.CursoId = c.Id 
					WHERE t.Ativo = 1 AND c.Id = ".$this->db->escape($id)." ORDER BY t.DataRegistro DESC");
				return $query->result_array();
		}
		
		public function troca_aluno($data){
			$query = $this->db->query("UPDATE Turma_Aluno SET TurmaId = ".$this->db->escape($data['TurmaId'])."
			WHERE AlunoId = ".$this->db->escape($data['AlunoId'])." AND TurmaId = ".$this->db->escape($data['Id_atual'])."");
		}
		
		
		
		/*
			INSERE OU ATUALIZA UM LEAD 
		*/
		public function set_turma($data)
		{
			if(empty($data['Id']))
			{
				$this->db->insert('Turma',$data);
				//pegar o id da turma gerado
				$query = $this->db->query("SELECT Id FROM Turma ORDER BY Id DESC LIMIT 1");
				$query = $query->row_array();
				return $query['Id'];
			}
			else
			{
				$this->db->where('Id', $data['Id']);
				$this->db->update('Turma', $data);
				return $data['Id'];
			}
		}
		
		public function set_turma_disciplina($data)
		{
			$query = $this->db->query("SELECT DisciplinaId FROM Turma_Disciplina
							WHERE TurmaId = ".$this->db->escape($data['TurmaId'])."");
			$query = $query->result_array();
			
			//DELETA OS QUE FORAM REMOVIDOS NA TELA PELO USUARIO
			for($i = 0; $i < count($query); $i++)
			{
				$flag = 0;
				for($j = 0; $j < count($data['disciplinasId']); $j++)
				{
					if($query[$i]['DisciplinaId'] == $data['disciplinasId'][$j])
						$flag = 1;
				}
				if($flag == 0)
					$this->db->query("DELETE FROM Turma_Disciplina 
									WHERE DisciplinaId = ".$this->db->escape($query[$i]['DisciplinaId'])." AND TurmaId =  
									".$this->db->escape($data['TurmaId'])."");
			}
			//FAZ INSERT DE TODOS, POREM OS INSERE DE SUCESSO SÃO AQUELES QUE NÃO VIOLAM A CHAVE PRIMARI
			for($i = 0; $i < count($data['disciplinasId']); $i++)
				$this->db->query("INSERT IGNORE INTO Turma_Disciplina(DisciplinaId,TurmaId)
									VALUES(".$this->db->escape($data['disciplinasId'][$i]).",".$this->db->escape($data['TurmaId']).")");
			return $data['TurmaId'];
		}
		
		public function set_turma_aluno($data)
		{
			$query = $this->db->query("SELECT AlunoId FROM Turma_Aluno
							WHERE TurmaId = ".$this->db->escape($data['TurmaId'])."");
			$query = $query->result_array();
			
			//DELETA OS QUE FORAM REMOVIDOS NA TELA PELO USUARIO
			for($i = 0; $i < count($query); $i++)
			{
				$flag = 0;
				for($j = 0; $j < count($data['alunosId']); $j++)
				{
					if($query[$i]['AlunoId'] == $data['alunosId'][$j])
						$flag = 1;
				}
				if($flag == 0)
					$this->db->query("DELETE FROM Turma_Aluno 
									WHERE AlunoId = ".$this->db->escape($query[$i]['AlunoId'])." AND TurmaId =  
									".$this->db->escape($data['TurmaId'])."");
			}
			//FAZ INSERT DE TODOS, POREM OS INSERE DE SUCESSO SÃO AQUELES QUE NÃO VIOLAM A CHAVE PRIMARI
			for($i = 0; $i < count($data['alunosId']); $i++)
				$this->db->query("INSERT IGNORE INTO Turma_Aluno(AlunoId,TurmaId)
									VALUES(".$this->db->escape($data['alunosId'][$i]).",".$this->db->escape($data['TurmaId']).")");
		}
		
		/*
			FAZ UM UPDATE DESATIVANDO O LEAD, CASO NECESSITAR REATIVA-LO ALGUM DIA
		*/
		public function delete_turma($id){
			// $this->db->where('id',$id); 
			// return $this->db->delete("leads");
			return $this->db->query("UPDATE Turma SET Ativo = 0 WHERE Id = ".$this->db->escape($id)."");
		}
	}
?>
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
					(SELECT count(*) FROM turma_aluno ta WHERE ta.TurmaId = t.Id) as Qtd_Aluno
					FROM turma t 
					INNER JOIN curso c ON t.CursoId = c.Id 
					WHERE t.Ativo = 1 ORDER BY t.DataRegistro DESC");
				return $query->result_array();
			}

			$query =  $this->db->query(
					" SELECT t.Id, t.Nome as NomeTurma, t.CursoId FROM turma t WHERE t.Id = ".$this->db->escape($id)."");
			return $query->result_array();
		}
		
		public function get_disciplina_por_turma($turma_id){
			$query = $this->db->query("SELECT td.DisciplinaId, d.Nome FROM  turma_disciplina td 
										INNER JOIN disciplina d ON td.DisciplinaId = d.Id 
										WHERE td.TurmaId = ".$this->db->escape($turma_id)."");
			return $query->result_array();
		}
		
		public function get_aluno_por_turma($turma_id){
			$query = $this->db->query("SELECT ta.AlunoId, a.Nome, a.NumeroChamada, c.Nome as NomeCurso, ta.TurmaId FROM turma_aluno ta 
										INNER JOIN aluno a ON ta.AlunoId = a.Id 
										INNER JOIN curso c ON a.CursoId = c.Id 
										WHERE ta.TurmaId = ".$this->db->escape($turma_id)."");
			return $query->result_array();
		}
		
		public function get_turma_por_curso($id){
			$query =  $this->db->query(
					"SELECT t.Id, t.Ativo, DATE_FORMAT(t.DataRegistro, '%d/%m/%Y') as DataRegistro, t.Nome as NomeTurma, t.CursoId, c.Nome as NomeCurso, 
					(SELECT count(*) FROM turma_aluno ta WHERE ta.TurmaId = t.Id) as Qtd_Aluno
					FROM turma t 
					INNER JOIN curso c ON t.CursoId = c.Id 
					WHERE t.Ativo = 1 AND c.Id = ".$this->db->escape($id)." ORDER BY t.DataRegistro DESC");
				return $query->result_array();
		}
		
		public function troca_aluno($data){
			$query = $this->db->query("UPDATE turma_aluno SET TurmaId = ".$this->db->escape($data['TurmaId'])."
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
				$query = $this->db->query("SELECT Id FROM turma ORDER BY Id DESC LIMIT 1");
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
			$query = $this->db->query("SELECT DisciplinaId FROM turma_disciplina
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
					$this->db->query("DELETE FROM turma_disciplina 
									WHERE DisciplinaId = ".$this->db->escape($query[$i]['DisciplinaId'])." AND TurmaId =  
									".$this->db->escape($data['TurmaId'])."");
			}
			//FAZ INSERT DE TODOS, POREM OS INSERE DE SUCESSO SÃO AQUELES QUE NÃO VIOLAM A CHAVE PRIMARI
			for($i = 0; $i < count($data['disciplinasId']); $i++)
				$this->db->query("INSERT IGNORE INTO turma_disciplina(DisciplinaId,TurmaId)
									VALUES(".$this->db->escape($data['disciplinasId'][$i]).",".$this->db->escape($data['TurmaId']).")");
			return $data['TurmaId'];
		}
		
		public function set_turma_aluno($data)
		{
			$query = $this->db->query("SELECT AlunoId FROM turma_aluno
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
					$this->db->query("DELETE FROM turma_aluno 
									WHERE AlunoId = ".$this->db->escape($query[$i]['AlunoId'])." AND TurmaId =  
									".$this->db->escape($data['TurmaId'])."");
			}
			//FAZ INSERT DE TODOS, POREM OS INSERE DE SUCESSO SÃO AQUELES QUE NÃO VIOLAM A CHAVE PRIMARI
			for($i = 0; $i < count($data['alunosId']); $i++)
				$this->db->query("INSERT IGNORE INTO turma_aluno(AlunoId,TurmaId)
									VALUES(".$this->db->escape($data['alunosId'][$i]).",".$this->db->escape($data['TurmaId']).")");
		}
		
		/*
			FAZ UM UPDATE DESATIVANDO O LEAD, CASO NECESSITAR REATIVA-LO ALGUM DIA
		*/
		public function delete_turma($id){
			// $this->db->where('id',$id); 
			// return $this->db->delete("leads");
			return $this->db->query("UPDATE turma SET Ativo = 0 WHERE Id = ".$this->db->escape($id)."");
		}
		
		/*
			CARREGA OS DADOS PARA SEREM CARRREGADOS NO GRAFICOS, RETORNA UMA MATRIZ,
			ONDE A PRIMEIRA LINHA E REFERE A QUANTIDADE DE LEADS POR DIA E A SEGUNDA LINHA 
			SE REFERE AO DIA
		*/
		public function get_lead_chart($mes = null, $ano = null)
		{
			//obter quantidade de dias para o mes em questão
			$qtd = date('t', mktime(0, 0, 0, $mes, 10, $ano ));
			$qtd_array = array();
			$dia = array();
			for($i = 1; $i <= $qtd; $i++)
			{
				$query = $this->db->query("SELECT count(*) as qtd_lead FROM leads 
										WHERE MONTH(data_registro) = ".$this->db->escape($mes)."AND YEAR(data_registro) =".$this->db->escape($ano) ."AND DAY(data_registro) = ".$this->db->escape($i)." AND ativo = 1");
				$query = $query->row_array();
				array_push($qtd_array,$query['qtd_lead']);
				array_push($dia,$i);
			}
			$data = array('qtd' => $qtd_array,
						  'dia' => $dia
			);
			return $data;
		}
	}
?>
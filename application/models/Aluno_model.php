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
					"SELECT a.Id, a.DataRegistro, a.Matricula, a.Nome as NomeAluno, a.Sexo, a.DataNascimento, a.NumeroChamada, a.CursoId, t.Nome as NomeTurma, c.Nome as NomeCurso 
					FROM aluno a 
					LEFT JOIN turma t ON a.TurmaId = t.Id 
					INNER JOIN curso c ON a.CursoId = c.Id 
					WHERE a.ativo = 1 ORDER BY a.DataRegistro DESC ");
				return $query->result_array();
			}

			$query =  $this->db->query(
					"SELECT a.Id, a.DataRegistro, a.Matricula, a.Nome as NomeAluno, a.Sexo, a.DataNascimento, a.NumeroChamada, a.CursoId, t.Nome as NomeTurma, c.Nome as NomeCurso 
					FROM aluno a 
					LEFT JOIN turma t ON a.TurmaId = t.Id 
					INNER JOIN curso c ON a.CursoId = c.Id 
					WHERE a.ativo = 1 AND a.Id = ".$this->db->escape($id)." ORDER BY a.DataRegistro DESC ");
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
		public function delete_curso($id){
			// $this->db->where('id',$id);
			// return $this->db->delete("leads");
			return $this->db->query("UPDATE curso SET Ativo = 0 WHERE Id = ".$this->db->escape($id)."");
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
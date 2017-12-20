<?php
	class Boletim_model extends CI_Model {
		
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
		public function get_boletim($busca,$AlunoId, $TurmaId)
		{
			if($busca == POR_ALUNO)
				$sql_parcial = " AND t.Id = ".$this->db->escape($TurmaId)." AND a.Id = ".$this->db->escape($AlunoId);
			else if($busca == POR_TURMA)
				$sql_parcial = " AND t.Id = ".$this->db->escape($TurmaId);

			$query = $this->db->query("SELECT t.Nome as NomeTurma, d.Nome as NomeDisciplina, c.Nome as NomeCategoria,
										a.Nome as NomeAluno, a.NumeroChamada, UPPER(cs.Nome) as NomeCurso,
										b.Nota1, b.Falta1, b.Nota2, b.Falta2, b.Nota3, b.Falta3, b.Nota4, b.Falta4,
										b.Bimestre,
										c.Id as categoriaId, t.Id as TurmaId, d.Id as DisciplinaId, a.Id as AlunoId, 
										b.Id as BoletimId 
										FROM turma t 
											INNER JOIN turma_disciplina td ON t.Id = td.TurmaId 
											INNER JOIN disciplina d ON td.DisciplinaId = d.Id
											INNER JOIN categoria c ON d.CategoriaId = c.Id
											INNER JOIN turma_aluno ta ON t.Id = ta.TurmaId
											INNER JOIN aluno a ON ta.AlunoId = a.Id
											INNER JOIN curso cs ON a.CursoId = cs.Id
											LEFT JOIN boletim b ON a.Id = b.AlunoId  AND d.Id = b.DisciplinaId
										WHERE true ".$sql_parcial." AND YEAR(ta.DataRegistro) = YEAR(NOW()) ORDER BY d.CategoriaId DESC");
			return $query->result_array();
		}
		
		public function set_boletim($alunoId,$disciplinaId,$bimestre,$valor,$boletim_id,$campo){
			if(empty($this->busca_registro($alunoId,$disciplinaId)))
				$this->db->query("INSERT INTO boletim(Ativo, AlunoId, DisciplinaId, Bimestre, $campo)
								VALUES(1,".$this->db->escape($alunoId).",".$this->db->escape($disciplinaId).",".$this->db->escape($bimestre).",".$this->db->escape($valor).");");
			else
				$this->db->query("UPDATE boletim SET $campo = ".$this->db->escape($valor)." WHERE Id = ".$this->busca_registro($alunoId,$disciplinaId)['Id']."");
			
		}
		
		public function busca_registro($alunoId,$disciplinaId)
		{
			$query = $this->db->query("SELECT Id FROM boletim WHERE AlunoId = ".$this->db->escape($alunoId)." AND DisciplinaId = ".$this->db->escape($disciplinaId)." AND YEAR(DataRegistro) = YEAR(NOW())");
			return $query->row_array();
		}
	}
?>
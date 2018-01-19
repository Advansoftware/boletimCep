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

		public function get_boletim($busca,$aluno_id, $turma_id)
		{
			if($busca == POR_ALUNO)
				$sql_parcial = " AND t.id = ".$this->db->escape($turma_id)." AND a.id = ".$this->db->escape($aluno_id);
			else if($busca == POR_TURMA)
				$sql_parcial = " AND t.id = ".$this->db->escape($turma_id);

			$query = $this->db->query("
				SELECT t.nome as nome_turma, d.nome as nome_disciplina, c.nome as nome_categoria,
				a.nome as nome_aluno, a.numero_chamada, UPPER(cs.nome) as nome_curso,
				b.nota1, b.falta1, b.nota2, b.falta2, b.nota3, b.falta3, b.nota4, b.falta4,b.bimestre,
				c.id as categoria_id, t.id as turma_id, d.id as disciplina_id, a.id as aluno_id, 
				b.id as boletim_id 
				FROM turma t 
					INNER JOIN turma_disciplina td ON t.id = td.turma_id 
					INNER JOIN disciplina d ON td.disciplina_id = d.id
					INNER JOIN categoria c ON d.categoria_id = c.id
					INNER JOIN turma_aluno ta ON t.id = ta.turma_id
					INNER JOIN aluno a ON ta.aluno_id = a.id
					INNER JOIN curso cs ON a.curso_id = cs.id
					LEFT JOIN boletim b ON a.id = b.aluno_id  AND d.id = b.disciplina_id
				WHERE true ".$sql_parcial." AND YEAR(ta.data_registro) = YEAR(t.data_registro) 
				ORDER BY d.categoria_id DESC");

			return $query->result_array();
		}
		
		public function set_boletim($aluno_id,$disciplina_id,$bimestre,$valor,$boletim_id,$campo)
		{
			if(empty($this->busca_registro($aluno_id,$disciplina_id)))
				$this->db->query("
					INSERT INTO boletim(ativo, aluno_id, disciplina_id, bimestre, $campo)
					VALUES(1,".$this->db->escape($aluno_id).",".$this->db->escape($disciplina_id).","
					.$this->db->escape($bimestre).",".$this->db->escape($valor).");");
			else
				$this->db->query("
					UPDATE boletim SET $campo = ".$this->db->escape($valor)." 
					WHERE id = ".$this->busca_registro($aluno_id,$disciplina_id)['id']."");
		}
		
		public function busca_registro($aluno_id,$disciplina_id)
		{
			$query = $this->db->query("
				SELECT id FROM boletim 
				WHERE aluno_id = ".$this->db->escape($aluno_id)." 
				AND disciplina_id = ".$this->db->escape($disciplina_id)." 
				AND YEAR(data_registro) = (SELECT YEAR(data_registro) 
						FROM turma WHERE 
						id = (SELECT turma_id 
								FROM aluno 
								WHERE id = ".$this->db->escape($aluno_id)."))");
			return $query->row_array();
		}
	}
?>
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
		public function get_boletim($id = FALSE)
		{
			if ($id === FALSE)//retorna todos se nao passar o parametro
			{
				$query =  $this->db->query("SELECT c.Id, c.Nome, DATE_FORMAT(c.DataRegistro, '%d/%m/%Y') as DataRegistro,  
				(SELECT COUNT(*) FROM disciplina_curso dc WHERE dc.CursoId = c.Id) as Qtd_Disciplina 
				FROM curso c WHERE Ativo = 1");
				return $query->result_array();
			}

			$query =  $this->db->query("SELECT c.Id, c.Nome as NomeCurso, DATE_FORMAT(c.DataRegistro, '%d/%m/%Y') as DataRegistro, dc.DisciplinaId FROM Curso c 
										LEFT JOIN disciplina_curso dc ON c.Id = dc.CursoId 
										LEFT JOIN disciplina d ON dc.DisciplinaId = d.Id 
										WHERE c.Ativo = 1 AND c.Id = ".$this->db->escape($id)."");
			return $query->result_array();
		}
		
	}
?>
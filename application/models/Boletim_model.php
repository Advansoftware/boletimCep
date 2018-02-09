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
			retorna o boletim, seja de todos da turma ou de um aluno especicifo ou de uma disciplina
		*/
		public function get_boletim($busca,$aluno_id, $turma_id, $disciplina_id = false)
		{
			if($busca == POR_ALUNO)
				$sql_parcial = " AND t.id = ".$this->db->escape($turma_id)." AND a.id = ".$this->db->escape($aluno_id);
			else if($busca == POR_TURMA)
				$sql_parcial = " AND t.id = ".$this->db->escape($turma_id);
			else if($busca = POR_TURMA_E_DISCIPLINA)
				$sql_parcial = " AND t.id = ".$this->db->escape($turma_id)." AND d.id = ".$this->db->escape($disciplina_id);

			$query = $this->db->query("
				SELECT t.nome AS nome_turma, d.nome AS nome_disciplina, c.nome AS nome_categoria, 
				(SELECT media FROM configuracoes_geral) AS media, 
				(SELECT total_faltas FROM configuracoes_geral) AS faltas_permitada, 
				a.nome AS nome_aluno, a.numero_chamada, UPPER(cs.nome) AS nome_curso, 
				b.nota1, b.falta1, b.nota2, b.falta2, b.nota3, b.falta3, b.nota4, b.falta4, b.bimestre, 
				c.id AS categoria_id, t.id AS turma_id, d.id AS disciplina_id, a.id AS aluno_id, 
				b.id AS boletim_id, nota_final, status, exame 
				FROM turma t 
					INNER JOIN turma_disciplina td ON t.id = td.turma_id 
					INNER JOIN disciplina d ON td.disciplina_id = d.id
					INNER JOIN categoria c ON d.categoria_id = c.id
					INNER JOIN turma_aluno ta ON t.id = ta.turma_id
					INNER JOIN aluno a ON ta.aluno_id = a.id
					INNER JOIN curso cs ON a.curso_id = cs.id
					LEFT JOIN boletim b ON a.id = b.aluno_id  AND d.id = b.disciplina_id
				WHERE true ".$sql_parcial."  
				ORDER BY d.categoria_id DESC");

			return $query->result_array();
		}
		/*
			cadastra as notas ou as atualiza
		*/
		public function set_boletim($aluno_id,$disciplina_id,$bimestre,$valor,$turma_id = false,$campo)
		{
			$CI = get_instance();
			$CI->load->model("Settings_model");

			if($bimestre == 1 && $campo == 'nota1' && 
				$valor > $CI->Settings_model->get_bimestres()['primeiro_bimestre'])
					return "O valor informado para o primeiro bimestre não pode ser  
					superior a ".$CI->Settings_model->get_bimestres()['primeiro_bimestre']." pontos";

			if($bimestre == 2 && $campo == 'nota2' && 
				$valor > $CI->Settings_model->get_bimestres()['segundo_bimestre'])
					return "O valor informado para o segundo bimestre não pode ser 
					superior a ".$CI->Settings_model->get_bimestres()['segundo_bimestre']." pontos";

			if($bimestre == 3 && $campo == 'nota3' && 
				$valor > $CI->Settings_model->get_bimestres()['terceiro_bimestre'])
					return "O valor informado para o terceiro bimestre não pode ser  
					superior a ".$CI->Settings_model->get_bimestres()['terceiro_bimestre']." pontos";

			if($bimestre == 4 && $campo == 'nota4' && 
				$valor > $CI->Settings_model->get_bimestres()['quarto_bimestre'])
					return "O valor informado para o quarto bimestre não pode ser   
					superior a ".$CI->Settings_model->get_bimestres()['quarto_bimestre']." pontos";

			if(empty($this->busca_registro($aluno_id, $disciplina_id, $turma_id)))
				$this->db->query("
					INSERT INTO boletim(ativo, aluno_id, disciplina_id,turma_id, bimestre, $campo)
					VALUES(1,".$this->db->escape($aluno_id).",".$this->db->escape($disciplina_id).","
					.$this->db->escape($turma_id).","
					.$this->db->escape($bimestre).",".$this->db->escape($valor).");");
			else
				$this->db->query("
					UPDATE boletim SET $campo = ".$this->db->escape($valor)." 
					WHERE id = ".$this->busca_registro($aluno_id,$disciplina_id, $turma_id)['id']."");
			
			if($campo == "nota4" || $campo == "falta4")
				$this->calculo_final($aluno_id,$disciplina_id,$turma_id);
			else if($campo == "exame")
				$this->exame_final($aluno_id,$disciplina_id,$turma_id,$valor);

			return "ok";
		}

		/*
			atualiza o status do aluno de acordo com a nota de exame final
		*/
		public function exame_final($aluno_id,$disciplina_id,$turma_id,$valor)
		{
			$status = "Reprovado";
			if($valor >= 60)
				$status = "Aprovado";
			$query = $this->db->query("
					UPDATE boletim SET status = '$status'
					WHERE turma_id = ".$this->db->escape($turma_id)." AND
					aluno_id = ".$this->db->escape($aluno_id)." AND
					disciplina_id = ".$this->db->escape($disciplina_id)."");
		}

		/*
			calcula a nota final do aluno e determina seu status
		*/
		public function calculo_final($aluno_id,$disciplina_id,$turma_id)
		{
			$query = $this->db->query("
				UPDATE boletim SET nota_final = (nota1 + nota2 + nota3 + nota4) 
				WHERE turma_id = ".$this->db->escape($turma_id)." AND 
				aluno_id = ".$this->db->escape($aluno_id)." AND 
				disciplina_id = ".$this->db->escape($disciplina_id)."");
			
			$CI = get_instance();
			$CI->load->model("Settings_model");

			//se estourar em faltas, automaticamente ja coloca o aluno em recuperacao em todas as materias
			if($this->total_faltas($aluno_id, $turma_id) > $CI->Settings_model->get_faltas())
			{
				$query = $this->db->query("
					UPDATE boletim SET status = 'Recuperação' 
					WHERE turma_id = ".$this->db->escape($turma_id)." AND
					aluno_id = ".$this->db->escape($aluno_id)."");
			}
			else if($this->get_nota_final_disciplina($aluno_id, $turma_id, $disciplina_id) < $CI->Settings_model->get_media())
			{
				$query = $this->db->query("
					UPDATE boletim SET status = 'Recuperação' 
					WHERE turma_id = ".$this->db->escape($turma_id)." AND
					aluno_id = ".$this->db->escape($aluno_id)." AND
					disciplina_id = ".$this->db->escape($disciplina_id)."");
			}
			else
			{
				$query = $this->db->query("
					UPDATE boletim SET status = 'Aprovado' 
					WHERE turma_id = ".$this->db->escape($turma_id)." AND
					aluno_id = ".$this->db->escape($aluno_id)." AND
					disciplina_id = ".$this->db->escape($disciplina_id)."");
			}
		}
		/*
			retorna todas as faltas de todas as disciplinas do aluno
		*/
		public function total_faltas($aluno_id, $turma_id)
		{
			$query = $this->db->query("
				SELECT SUM(COALESCE(falta1, 0) + COALESCE(falta2, 0) + COALESCE(falta3, 0) + COALESCE(falta4, 0)) as faltas FROM boletim
			 		WHERE aluno_id = ".$this->db->escape($aluno_id)." AND 
			 		turma_id = ".$this->db->escape($turma_id)."");

			return $query->row_array()['faltas'];
		}
		/*
			retorna a nota final obtida de acordo os parametros passados
		*/
		public function get_nota_final_disciplina($aluno_id, $turma_id,$disciplina_id)
		{
			$query = $this->db->query("
				SELECT nota_final FROM boletim 
				WHERE aluno_id = ".$this->db->escape($aluno_id)." AND 
			 	turma_id = ".$this->db->escape($turma_id)." AND
			 	disciplina_id = ".$this->db->escape($disciplina_id)."");
			
			return $query->row_array()['nota_final'];
		}

		public function busca_registro($aluno_id, $disciplina_id, $turma_id)
		{
			$query = $this->db->query("
				SELECT id FROM boletim b
				WHERE b.aluno_id = ".$this->db->escape($aluno_id)." 
				AND b.disciplina_id = ".$this->db->escape($disciplina_id)."
				AND b.turma_id = ".$this->db->escape($turma_id)."");

			return $query->row_array();
		}
	}
?>
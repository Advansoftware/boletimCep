<?php 
	class aluno{
		/*
			retorna todas as faltas  de todas as disciplinas de um determinado alunoe em uma determinada turma
		*/
		public static function get_faltas($aluno_id,$turma_id)
		{
			$CI = get_instance();
			$CI->load->model("Boletim_model");	
			return $CI->Boletim_model->total_faltas($aluno_id,$turma_id);
		}
	}
	
?>
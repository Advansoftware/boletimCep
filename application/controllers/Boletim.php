<?php
	define("POR_TURMA",1);
	define("POR_ALUNO",2);

	require_once("Geral.php");

	class Boletim extends Geral {
		/*
			no construtor carregamos as bibliotecas necessarias e tambem nossa model
		*/
		public function __construct()
		{
			parent::__construct();
			
			if(empty($this->account_model->session_is_valid($this->session->id)['id']))
				redirect('Account/login');
			$this->load->model('Disciplina_model');
			$this->load->model('Categoria_model');
			$this->load->model('Curso_model');
			$this->load->model('Aluno_model');
			$this->load->model('Turma_model');
			$this->load->model('Boletim_model');
			$this->set_menu();
			$this->data['controller'] = get_class($this);
			$this->data['menu_selectd'] = $this->Geral_model->get_identificador_menu(strtolower(get_class($this)));
		}
		
		/*
			listar as disciplinas cadastradas
		*/
		public function index($page = false)
		{
			if($page === false)
				$page = 1;

			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(READ,get_class($this)) == true)
			{
				$this->data['Cursos'] = $this->Curso_model->get_curso(false, $page);
				$this->data['paginacao']['size'] = $this->data['Cursos'][0]['size'];
				$this->data['paginacao']['pg_atual'] = $page;
				$this->view("boletim/index",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		public function turmas($curso_id, $page = false)
		{
			if($page === false)
				$page = 1;

			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(READ,get_class($this)) == true)
			{
				$this->data['nome_curso'] = $this->Curso_model->get_curso($curso_id)[0]['nome_curso'];
				$this->data['Turmas'] = $this->Turma_model->get_turma_por_curso($curso_id, $page);
				$this->data['paginacao']['size'] = ((isset($this->data['Turmas'][0]['size'])) ? $this->data['Turmas'][0]['size'] : 0 );
				$this->data['paginacao']['pg_atual'] = $page;
				$this->data['paginacao']['method'] = "turmas";

				$this->view("boletim/turmas",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		public function alunos($turma_id, $page = false)
		{
			if($page === false)
				$page = 1;

			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(READ,get_class($this)) == true)
			{
				$this->data['nome_turma'] = $this->Turma_model->get_turma($turma_id)[0]['nome_turma'];
				$this->data['Alunos'] = $this->Turma_model->get_aluno_por_turma($turma_id, $page);
				$this->data['paginacao']['size'] = ((isset($this->data['Alunos'][0]['size'])) ? $this->data['Alunos'][0]['size'] : 0 );
				$this->data['paginacao']['pg_atual'] = $page;
				$this->data['paginacao']['method'] = "alunos";

				$this->view("boletim/alunos",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		public function boletim($aluno_id,$turma_id)
		{
			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(READ,get_class($this)) == true)
			{
				$this->data['boletim'] = $this->Boletim_model->get_boletim(POR_ALUNO,$aluno_id,$turma_id);
				

				$this->view("boletim/boletim",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		public function atualiza_boletim($aluno_id,$disciplina_id,$bimestre,$valor,$boletim_id,$campo)
		{
			$this->Boletim_model->set_boletim($aluno_id,$disciplina_id,$bimestre,$valor,$boletim_id,$campo);
			$arr = array('response' => '9');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}

		public function turmaPdf()
		{
			$data['url'] = base_url();
			$data['controller'] = 'boletim';
			$data['NomeTurma'] = $this->Turma_model->get_turma($turma_id)[0]['NomeTurma'];
			$data['Alunos'] = $this->Turma_model->get_aluno_por_turma($turma_id);
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$html = $this->load->view('boletim/boletim_pdf', $data, true);
 
	        //this the the PDF filename that user will get to download
	        $pdfFilePath = "output_pdf_name.pdf";
	 		//$this->load->view('aluno/aluno_pdf',$data);
	        //load mPDF library
	      	$this->load->library('m_pdf');
	 		
	       //generate the PDF from the given html
	        $this->m_pdf->pdf->WriteHTML($html);
	 
	        //download it.
	        $this->m_pdf->pdf->Output($pdfFilePath, "D");
		}
	}
?>
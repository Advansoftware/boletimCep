<?php
define("POR_TURMA",1);
define("POR_ALUNO",2);
	class Boletim extends CI_Controller {
		/*
			no construtor carregamos as bibliotecas necessarias e tambem nossa model
		*/
		public function __construct()
		{
			parent::__construct();
			
			$this->load->model('login_model');
			$this->load->model('Categoria_model');
			$this->load->model('Disciplina_model');
			$this->load->model('Curso_model');
			$this->load->model('Aluno_model');
			$this->load->model('Turma_model');
			$this->load->model('Boletim_model');
			$this->load->helper('url_helper');
			$this->load->helper('url');
			$this->load->helper('html');
			$this->load->helper('form');
			$this->load->library('session');
			//verifica se o usuario este logado, a sessao alem de existir tambem deve ser valida
			if(empty($this->login_model->session_is_valid($this->session->id)['id']))
				redirect('login/login');
		}
		
		/*
			listar as disciplinas cadastradas
		*/
		public function index(){
			$data['url'] = base_url();
			$data['controller'] = 'boletim';
			$data['Cursos'] = $this->Curso_model->get_curso();
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('boletim/index',$data);
			$this->load->view('templates/footer',$data);
		}
		
		public function turmas($curso_id){
			$data['url'] = base_url();
			$data['controller'] = 'boletim';
			$data['NomeCurso'] = $this->Curso_model->get_curso($curso_id)[0]['NomeCurso'];
			$data['Turmas'] = $this->Turma_model->get_turma_por_curso($curso_id);
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('boletim/turmas',$data);
			$this->load->view('templates/footer',$data);
		}
		
		public function alunos($turma_id){
			$data['url'] = base_url();
			$data['controller'] = 'boletim';
			$data['NomeTurma'] = $this->Turma_model->get_turma($turma_id)[0]['NomeTurma'];
			$data['Alunos'] = $this->Turma_model->get_aluno_por_turma($turma_id);
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('boletim/alunos',$data);
			$this->load->view('templates/footer',$data);
		}
		
		public function boletim($aluno_id,$turma_id){
			$data['url'] = base_url();
			$data['controller'] = 'boletim';
			$data['boletim'] = $this->Boletim_model->get_boletim(POR_ALUNO,$aluno_id,$turma_id);
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('boletim/boletim',$data);
			$this->load->view('templates/footer',$data);
		}
		
		public function atualiza_boletim($aluno_id,$disciplinaId,$bimestre,$valor,$boletim_id,$campo){
			$this->Boletim_model->set_boletim($aluno_id,$disciplinaId,$bimestre,$valor,$boletim_id,$campo);
			$arr = array('response' => '9');
			header('Content-Type: application/json');
			echo json_encode($arr);
			
		}
		public function turmaPdf(){

			$data['url'] = base_url();
			$data['controller'] = 'boletim';
			$data['NomeTurma'] = $this->Turma_model->get_turma($turma_id)[0]['NomeTurma'];
			$data['Alunos'] = $this->Turma_model->get_aluno_por_turma($turma_id);
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			 $html=$this->load->view('boletim/boletim_pdf', $data, true);
 
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
<?php
	class Aluno extends CI_Controller {
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
			$data['controller'] = 'aluno';
			$data['Alunos'] = $this->Aluno_model->get_aluno();
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('aluno/index',$data);
			$this->load->view('templates/footer',$data);
		}
		
		/*
			APAGAR UMA DISCIPLINA DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function deletar($id = null)
		{
			$this->Aluno_model->delete_aluno($id);
		}
		
		/*
			APAGAR UMA DISCIPLINA DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function create_edit($id = null)
		{
			$data['url'] = base_url();

			$data['Aluno'] = $this->Aluno_model->get_aluno($id);
			
			$data['Cursos'] = $this->Curso_model->get_curso();
			$data['title'] = 'Administração';
			$data['controller'] = 'aluno';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('aluno/create_edit',$data);
			$this->load->view('templates/footer',$data);
		}
		
		public function store()
		{
			$dataToSave = array(
				'Id' => $this->input->post('Id'),
				'Ativo' => 1,
				'Nome' => $this->input->post('NomeAluno'),
				'Matricula' => $this->input->post('Matricula'),
				'NumeroChamada' => $this->input->post('NumeroChamada'),
				'DataNascimento' => $this->input->post('DataNascimento'),
				'Sexo' => $this->input->post('Sexo'),
				'CursoId' => $this->input->post('CursoId')
			);
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['Nome']))
				$this->Aluno_model->set_aluno($dataToSave);
			 else
				redirect('admin/dashboard');
			
			$arr = array('response' => $dataToSave['Sexo']);
			header('Content-Type: application/json');
			echo json_encode($arr);
		}

		public function alunoPdf(){
			$data['url'] = base_url();
			$data['controller'] = 'aluno';
			$data['Alunos'] = $this->Aluno_model->get_aluno();
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$this->load->library('pdfgenerator');
			$html = $this->load->view('aluno/aluno_pdf', $data, true);
			$filename = 'report_'.time();
			$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
		}
	}
?>
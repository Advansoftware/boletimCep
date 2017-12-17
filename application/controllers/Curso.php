<?php

define("MATERIA_TECNICA",1);
define("MATERIA_ENSIO_MEDIO",2);

	class Curso extends CI_Controller {
		/*
			no construtor carregamos as bibliotecas necessarias e tambem nossa model
		*/
		public function __construct()
		{
			parent::__construct();
			
			$this->load->model('login_model');
			$this->load->model('Disciplina_model');
			$this->load->model('Categoria_model');
			$this->load->model('Curso_model');
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
			$data['controller'] = 'curso';
			$data['Cursos'] = $this->Curso_model->get_curso();
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('curso/index',$data);
			$this->load->view('templates/footer',$data);
		}
		
		/*
			APAGAR UMA DISCIPLINA DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function delete($id = null)
		{
			$this->Curso_model->delete_curso($id);
		}
		
		/*
			APAGAR UMA DISCIPLINA DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function create_edit($id = null)
		{
			$data['url'] = base_url();

			$data['Disciplinas'] = $this->Disciplina_model->get_disciplina();

			$data['Curso'] = $this->Curso_model->get_curso($id);
			$data['title'] = 'Administração';
			$data['controller'] = 'curso';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('curso/create_edit',$data);
			$this->load->view('templates/footer',$data);
		}
		
		public function store()
		{
			$dataToSave = array(
				'Id' => $this->input->post('Id'),
				'Ativo' => 1,
				'NomeCurso' => $this->input->post('NomeCurso'),
				'disciplinasId' => $this->input->post('disciplinas')
			);
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['NomeCurso']))
				$this->Curso_model->set_curso($dataToSave);
			 else
				redirect('admin/dashboard');
			
			$arr = array('response' => 'sucesso');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
		
	}
?>
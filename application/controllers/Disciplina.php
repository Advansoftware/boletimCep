<?php
	class Disciplina extends CI_Controller {
		/*
			no construtor carregamos as bibliotecas necessarias e tambem nossa model
		*/
		public function __construct()
		{
			parent::__construct();
			
			$this->load->model('login_model');
			$this->load->model('Disciplina_model');
			$this->load->model('Categoria_model');
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
			$data['controller'] = 'disciplina';
			$data['Disciplinas'] = $this->Disciplina_model->get_disciplina();
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('disciplina/index',$data);
			$this->load->view('templates/footer',$data);
		}
		
		/*
			APAGAR UMA DISCIPLINA DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function deletar($id = null)
		{
			$this->Disciplina_model->delete_disciplina($id);
		}
		
		/*
			APAGAR UMA DISCIPLINA DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function create_edit($id = null)
		{
			$data['url'] = base_url();

			$data['Disciplina'] = $this->Disciplina_model->get_disciplina($id);
			
			$data['Categoria'] = $this->Categoria_model->get_categoria();
			$data['title'] = 'Administração';
			$data['controller'] = 'disciplina';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('disciplina/create_edit',$data);
			$this->load->view('templates/footer',$data);
		}
		
		public function store()
		{
			$dataToSave = array(
				'Id' => $this->input->post('Id'),
				'Ativo' => 1,
				'Nome' => $this->input->post('Nome'),
				'CategoriaId' => $this->input->post('CategoriaId')
			);
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['Nome']))
				$this->Disciplina_model->set_disciplina($dataToSave);
			 else
				redirect('admin/dashboard');
			
			$arr = array('response' => 'sucesso');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
		
	}
?>
<?php
	class Login extends CI_Controller {
		/*
			no construtor carregamos as bibliotecas necessarias e tambem nossa model
		*/
		public function __construct()
		{
			parent::__construct();
			
			$this->load->model('login_model');
			$this->load->helper('url_helper');
			$this->load->helper('url');
			$this->load->helper('html');
			$this->load->helper('form');
			$this->load->library('session');
		}
		
		/*
			metodo responsavel carregar o formulario de login
		*/
		public function login()
		{	
			$data['url'] = base_url();
			$data['title'] = 'Login';
			$data['message'] = 'Administração';
			$this->load->view('templates/header',$data);
			$this->load->view('login/login',$data);
			$this->load->view('templates/footer',$data);
			if(!empty($this->login_model->session_is_valid($this->session->id)['id']))
				redirect('admin/dashboard');
		}
		/*
			destroi a sessao de login
		*/
		public function logout()
		{
			unset($_SESSION['id']);
		}
		
		/*
			Valida os dados de login
		*/
		public function validar()
		{ 
			$email = $this->input->post('email');
			$senha = $this->input->post('senha');
			$response = $this->login_model->get_login($email,$senha);
			$data['title'] = 'Login';
			
			//se ja houver uma sessao apenas dar um refresh na pagina e nao criar a sessao novamente
			if(!empty($this->login_model->session_is_valid($this->session->id)['id']))
				$response = 'valido';
			else if(!empty($response))
			{
				$login = array(
				   'id'  => $response
				);
				$this->session->set_userdata($login);
				$response = 'valido';
			}
			else
				$response = 'invalido';

			$arr = array('response' => $response);
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
	}
?>
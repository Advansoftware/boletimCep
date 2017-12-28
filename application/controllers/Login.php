<?php
	require_once("Geral.php");
	class Login extends Geral {
		/*
			no construtor carregamos as bibliotecas necessarias e tambem nossa model
		*/
		public function __construct()
		{
			parent::__construct();
			

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
			$email = $this->input->post('email-login');
			$senha = $this->input->post('senha-login');
			$response = $this->login_model->get_login($email,$senha);
			$data['title'] = 'Login';
			
			
			if(!empty($this->login_model->session_is_valid($this->session->id)['id']))
				$response = 'valido';
			else if(!empty($response))
			{
				$login = array(
				   'id'  => $response['id'],
				   'grupo_id'  => $response['grupo_id']
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
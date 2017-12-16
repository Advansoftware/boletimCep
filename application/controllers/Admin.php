<?php
	class Admin extends CI_Controller {
		/*
			no construtor carregamos as bibliotecas necessarias e tambem nossa model
		*/
		public function __construct()
		{
			parent::__construct();
			
			$this->load->model('login_model');
			$this->load->model('lead_model');
			$this->load->helper('url_helper');
			$this->load->helper('url');
			$this->load->helper('html');
			$this->load->helper('form');
			$this->load->library('session');
			//verifica se o usuario está logado, a sessao alem de existir tambem deve ser valida
			if(empty($this->login_model->session_is_valid($this->session->id)['id']))
				redirect('login/login');
		}
		
		/*
			Renderiza o dashboard
		*/
		public function dashboard()
		{
			$data['url'] = base_url();
			$data['leads'] = $this->lead_model->get_lead();
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('admin/dashboard',$data);
			$this->load->view('templates/footer',$data);
		}
		
		public function estatistica()
		{
			$data['url'] = base_url();
			$data['leads'] = $this->lead_model->get_lead();
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('admin/estatistica',$data);
			$this->load->view('templates/footer',$data);
		}
		
		/*
			CARREGA UM LEAD NA TELA PARA SER EDITADO
		*/
		public function edit($id = null)
		{
			$dataToForm = $this->lead_model->get_lead($id);
			if(!empty($dataToForm['id']))//verifica se a id existe, caso nao existir redireciona pra lista de leads
			{
				$dataToForm['url'] = base_url();
				$dataToForm['title'] = 'Administração';
				$dataToForm['message'] = 'Administração';
				
				$this->load->view('templates/header_admin',$dataToForm);
				$this->load->view('admin/edit',$dataToForm);
				$this->load->view('templates/footer',$dataToForm);
			}
			else
				redirect('admin/dashboard');
		}
	}
?>
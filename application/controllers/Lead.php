<?php
	class Lead extends CI_Controller {
		/*
			no construtor carregamos as bibliotecas necessárias e também nossa model
		*/
		public function __construct()
		{
			parent::__construct();
			
			$this->load->model('lead_model');
			$this->load->model('login_model');
			$this->load->helper('url_helper');
			$this->load->helper('url');
			$this->load->helper('html');
			$this->load->helper('form');
			$this->load->library('session');
		}
		
		/*
			metodo responsavel por pegar os dados subtmetidos
			através do formulario e grava-los no banco
		*/
		public function store()
		{
			$dataToSave = array(
				'id' => $this->input->post('lead'),
				'ativo' => 1,
				'nome' => $this->input->post('nome'),
				'email' => $this->input->post('email'),
				'cpf' => $this->input->post('cpf'),
				'cep' => $this->input->post('cep'),
				'telefone' => $this->input->post('telefone'),
				'observacoes' => $this->input->post('observacoes'),
			);
			
			//bloquear acesso direto ao metodo store
			if(!empty($dataToSave['email']))
				$this->lead_model->set_lead($dataToSave);
			else
				redirect('lead/create');
			
			$arr = array('response' => 'sucesso');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
		
		/*
			metodo responsavel carregar o formulario de cadastro
		*/
		public function create()
		{
			$data['url'] = base_url();
			$data['title'] = 'Lead - Cadastro';
			$data['message'] = 'Informe seus dados no formulario abaixo';
			$this->load->view('templates/header',$data);
			$this->load->view('lead/create',$data);
			$this->load->view('templates/footer',$data);
		}
		
		/*
			FAZ A LISTAGEM DOS LEADS DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function index()
		{
			if(!empty($this->login_model->session_is_valid($this->session->id)['id']))
			{
				$arr = $this->lead_model->get_lead();
				header('Content-Type: application/json');
				echo json_encode($arr);
			}
			else
				redirect('lead/create');
		}
		
		/*
			APAGAR UM LEAD DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function delete($id = null)
		{
			if(!empty($this->login_model->session_is_valid($this->session->id)['id']))
				$this->lead_model->delete_lead($id);
			else
				redirect('lead/create');
		}
		
		/*
			CARREGA OS DADOS PARA O GRAFICO DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function estatistica($mes = null, $ano = null)
		{
			if(!empty($this->login_model->session_is_valid($this->session->id)['id']))
			{
				$result = $this->lead_model->get_lead_chart($mes,$ano);
				//$arr = array('response' => $ultimo_dia);
				header('Content-Type: application/json');
				echo json_encode($result);
			}
			else
				redirect('lead/create');
		}
	}
?>
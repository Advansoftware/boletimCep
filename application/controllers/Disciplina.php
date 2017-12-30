<?php
	require_once("Geral.php");
	
	class Disciplina extends Geral {
		/*
			no construtor carregamos as bibliotecas necessarias e tambem nossa model
		*/
		public function __construct()
		{
			parent::__construct();
			if(empty($this->login_model->session_is_valid($this->session->id)['id']))
				redirect('login/login');
			$this->load->model('Disciplina_model');
			$this->load->model('Categoria_model');
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
				$this->data['Disciplinas'] = $this->Disciplina_model->get_disciplina(false,$page);
				
				$this->data['paginacao']['size'] = $this->data['Disciplinas'][0]['size'];
				$this->data['paginacao']['pg_atual'] = $page;
				
				$this->view("disciplina/index",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		/*
			APAGAR UMA DISCIPLINA DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function deletar($id = null)
		{
			if($this->Geral_model->get_permissao(DELETE,get_class($this)) == true)
				$this->Disciplina_model->delete_disciplina($id);
			else
				$this->view("templates/permissao",$this->data);
		}
		
		/*
			APAGAR UMA DISCIPLINA DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function edit($id = null)
		{
			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(UPDATE,get_class($this)) == true)
			{
				$this->data['Disciplina'] = $this->Disciplina_model->get_disciplina($id);
				$this->data['Categoria'] = $this->Categoria_model->get_categoria();
				$this->view("disciplina/create_edit",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}

		public function create($id = null)
		{
			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(CREATE,get_class($this)) == true)
			{

				$this->data['Disciplina'] = $this->Disciplina_model->get_disciplina($id);
				$this->data['Categoria'] = $this->Categoria_model->get_categoria();
				$this->view("disciplina/create_edit",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		public function store()
		{
			$dataToSave = array(
				'id' => $this->input->post('id'),
				'ativo' => 1,
				'nome' => $this->input->post('nome'),
				'categoria_id' => $this->input->post('categoria_id')
			);
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['nome']))
				$this->Disciplina_model->set_disciplina($dataToSave);
			 else
				redirect('admin/dashboard');
			
			$arr = array('response' => 'sucesso');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
		
	}
?>
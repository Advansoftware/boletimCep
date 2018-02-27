<?php
	require_once("Geral.php");
	class Curso extends Geral {
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
				$this->data['paginacao']['size'] = (!empty($this->data['Cursos'][0]['size']) ? $this->data['Cursos'][0]['size'] : 0);
				$this->data['paginacao']['pg_atual'] = $page;
				$this->view("curso/index",$this->data);
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
				$this->Curso_model->delete_curso($id);
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
				$this->data['Disciplinas'] = $this->Disciplina_model->get_disciplina();
				$this->data['Curso'] = $this->Curso_model->get_curso($id);
				$this->view("curso/create_edit",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);		
			
		}

		public function create($id = null)
		{
			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(CREATE,get_class($this)) == true)
			{
				$this->data['Disciplinas'] = $this->Disciplina_model->get_disciplina();
				$this->data['Curso'] = $this->Curso_model->get_curso($id);
			}
			$this->view("curso/create_edit",$this->data);
		}
		
		public function store()
		{
			$resultado = "sucesso";
			$dataToSave = array(
				'id' => $this->input->post('id'),
				'ativo' => 1,
				'nome' => $this->input->post('nome'),
				'disciplinas_id' => $this->input->post('disciplinas')
			);
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['nome']))
				$resultado = $this->Curso_model->set_curso($dataToSave);
			 else
				redirect('admin/dashboard');
			
			$arr = array('response' => $resultado);
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
	}
?>
<?php

	require_once("Geral.php");

	class Aluno extends Geral {
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
			$this->load->model('Aluno_model');
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
				$this->data['Alunos'] = $this->Aluno_model->get_aluno(false, $page);	
				$this->data['paginacao']['size'] = $this->data['Alunos'][0]['size'];
				$this->data['paginacao']['pg_atual'] = $page;
				$this->view("aluno/index",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}

		public function detalhes($id = false)
		{
			$this->data['title'] = 'Administração - Detalhes';
			if($this->Geral_model->get_permissao(READ,get_class($this)) == true)
			{
				$this->data['obj'] = $this->Aluno_model->get_aluno($id);
	
				$this->view("aluno/detalhes",$this->data);
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
				$this->Aluno_model->delete_aluno($id);
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
				$this->data['Aluno'] = $this->Aluno_model->get_aluno($id);
				$this->data['Cursos'] = $this->Curso_model->get_curso();
				$this->view("aluno/create_edit",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		public function create($id = null)
		{
			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(CREATE,get_class($this)) == true)
			{
				$this->data['Aluno'] = $this->Aluno_model->get_aluno($id);
				$this->data['Cursos'] = $this->Curso_model->get_curso();
				$this->view("aluno/create_edit",$this->data);
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
				'matricula' => $this->input->post('matricula'),
				'numero_chamada' => $this->input->post('numero_chamada'),
				'data_nascimento' => $this->input->post('data_nascimento'),
				'sexo' => $this->input->post('sexo'),
				'curso_id' => $this->input->post('curso_id')
			);
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['nome']))
				$this->Aluno_model->set_aluno($dataToSave);
			 else
				redirect('admin/dashboard');
			
			$arr = array('response' => 'sucesso');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}

		public function alunoPdf(){
			$this->data['Alunos'] = $this->Aluno_model->get_aluno();
			$html = $this->load->view('aluno/aluno_pdf', $this->data, true);
			$filename = 'boletim_'.time();
			$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
		}
	}
?>
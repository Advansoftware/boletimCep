<?php

	require_once("Geral.php");

	class Turma extends Geral {
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
			$this->load->model('Turma_model');
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
				$this->data['Turmas'] = $this->Turma_model->get_turma(false, $page);
				$this->data['paginacao']['size'] = ((!empty($this->data['Turmas'][0]['size']))? $this->data['Turmas'][0]['size']: 0);
				$this->data['paginacao']['pg_atual'] = $page;
				$this->view("turma/index",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}

		public function detalhes($id = false)
		{
			if($this->Geral_model->get_permissao(READ,get_class($this)) == true)
			{
				$this->data['title'] = 'Turma - Detalhes';
				$this->data['obj'] = $this->Turma_model->get_turma($id);
				$this->data['alunos'] = $this->Turma_model->get_aluno_por_turma($id);
				$this->view("turma/detalhes",$this->data);
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
			$this->Turma_model->delete_turma($id);
		}
		
		/*
			APAGAR UMA DISCIPLINA DESDE QUE EXISTA A SESSAO DE USUARIO E A MESMA
			SEJA VALIDA
		*/
		public function create_edit($id = null, $pagina = null)
		{
			$this->data['Turma'] = $this->Turma_model->get_turma($id);
			$this->data['Cursos'] = $this->Curso_model->get_curso();
			$this->data['title'] = 'Administração';
			
			if($id == 0 || $pagina == 1)
				$this->view("turma/create_edit",$this->data);
			else if(count($this->Turma_model->get_disciplina_por_turma($id)) == 0 || $pagina == 2)
			{
				$this->data['disciplinas_turma'] = $this->Turma_model->get_disciplina_por_turma($id);
				$this->create_edit_disciplina();
			}
			else if(count($this->Turma_model->get_aluno_por_turma($id)) == 0 || $pagina == 3)
			{
				$this->data['alunos_turma'] = $this->Turma_model->get_aluno_por_turma($id);
				$this->create_edit_aluno();
			}
			else
				$this->view("turma/create_edit",$this->data);
		}
		
		public function create_edit_disciplina()
		{
			//ate aqui ja se tem a turma carregada
			//agora carregar todas as disciplinas pra ela de acordo com o curso
			$this->data['disciplinas'] = $this->Disciplina_model->get_disciplina_por_curso($this->data['Turma']['curso_id']);
			$this->view("turma/create_edit_disciplina",$this->data);
		}
		
		public function create_edit_aluno()
		{
			//ate aqui ja se tem a turma carregada
			//agora carregar todos os alunos acordo com o curso
			$this->data['alunos'] = $this->Aluno_model->get_aluno_por_curso($this->data['Turma']['curso_id'],$this->data['Turma']['id']);
			$this->view("turma/create_edit_aluno",$this->data);
		}
		
		public function store()
		{
			$dataToSave = array(
				'id' => $this->input->post('id'),
				'nome' => $this->input->post('nome'),
				'ativo' => 1,
				'curso_id' => $this->input->post('curso_id'),
				'ano_letivo' => $this->input->post('ano_letivo')
			);
			$idTurma = "";
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['nome']))
				$idTurma = $this->Turma_model->set_turma($dataToSave);
			 else
				redirect('admin/dashboard');
			
			$arr = array('page' => 'turma/create_edit/'.$idTurma.'/2');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
		
		public function store_disciplina()
		{
			$dataToSave = array(
				'turma_id' => $this->input->post('id'),
				'disciplinas_id' => $this->input->post('disciplinas')
			);
			$idTurma = "";
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['turma_id']))
				$idTurma = $this->Turma_model->set_turma_disciplina($dataToSave);
			 else
				redirect('admin/dashboard');
			
			$arr = array('page' => 'turma/create_edit/'.$idTurma.'/3');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
		public function store_aluno()
		{
			$dataToSave = array(
				'turma_id' => $this->input->post('id'),
				'alunos_id' => $this->input->post('alunos')
			);
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['turma_id']))
				$this->Turma_model->set_turma_aluno($dataToSave);
			 else
				redirect('admin/dashboard');
			
			for($i = 0; $i < count($dataToSave['alunos_id']); $i++)
			{
				$data = array(
					'id' => $dataToSave['alunos_id'][$i],
					'turma_id' => $dataToSave['turma_id']
				);
				$this->Aluno_model->set_aluno($data);
			}
			
			$arr = array('page' => 'turma/index');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
		
		public function trocar_aluno($id)
		{
			$this->data['title'] = 'Administração';
			$this->data['turma_atual'] = $this->Turma_model->get_turma($id);
			$this->data['alunos'] = $this->Turma_model->get_aluno_por_turma($id);
			$this->data['turmas'] = $this->Turma_model->get_turma();
			
			$this->view("turma/trocar_aluno",$this->data);
		}
		public function store_troca_aluno(){
			$data = array(
					'turma_id' => $this->input->post('turma_id'), //id da turma de destino
					'alunos_id' => $this->input->post('alunos'), //alunos que trocarao de turma
					'id_atual' => $this->input->post('id_atual'), //id_atual_turma
				);
			
			 for($i = 0; $i < count($data['alunos_id']); $i++)
			 {
				$dataToSave = array(
					'aluno_id' => $data['alunos_id'][$i],
					'turma_id' => $data['turma_id'],
					'id_atual' => $data['id_atual']
				);
				$this->Turma_model->troca_aluno($dataToSave);

				$dataToSave = array(
					'id' => $data['alunos_id'][$i],
					'turma_id' => $data['turma_id']
				);
				$this->Aluno_model->set_aluno($dataToSave);
			 }
			
			$arr = array('response' => 'sucesso');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
	}
?>
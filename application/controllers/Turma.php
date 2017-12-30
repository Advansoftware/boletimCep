<?php

	require_once("Geral.php");

	class Turma extends Geral {
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
				$this->data['paginacao']['size'] = $this->data['Turmas'][0]['size'];
				$this->data['paginacao']['pg_atual'] = $page;
				$this->view("turma/index",$this->data);
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
			$data['Turma'] = $this->Turma_model->get_turma($id);
			$data['Cursos'] = $this->Curso_model->get_curso();
			$data['title'] = 'Administração';
			
			if($id == 0 || $pagina == 1)
			{
				$this->load->view('templates/header_admin',$data);
				$this->load->view('turma/create_edit',$data);
				$this->load->view('templates/footer',$data);
			}
			else if(count($this->Turma_model->get_disciplina_por_turma($id)) == 0 || $pagina == 2)
			{
				$data['disciplinas_turma'] = $this->Turma_model->get_disciplina_por_turma($id);
				$this->create_edit_disciplina($data);
			}
			else if(count($this->Turma_model->get_aluno_por_turma($id)) == 0 || $pagina == 3)
			{
				$data['alunos_turma'] = $this->Turma_model->get_aluno_por_turma($id);
				$this->create_edit_aluno($data);
			}
			else
			{
				$this->load->view('templates/header_admin',$data);
				$this->load->view('turma/create_edit',$data);
				$this->load->view('templates/footer',$data);
			}
		}
		
		public function create_edit_disciplina($data)
		{
			//ate aqui ja se tem a turma carregada
			//agora carregar todas as disciplinas pra ela de acordo com o curso
			$data['disciplinas'] = $this->Disciplina_model->get_disciplina_por_curso($data['Turma'][0]['CursoId']);
			$this->load->view('templates/header_admin',$data);
			$this->load->view('turma/create_edit_disciplina',$data);
			$this->load->view('templates/footer',$data);
		}
		
		public function create_edit_aluno($data)
		{
			//ate aqui ja se tem a turma carregada
			//agora carregar todos os alunos acordo com o curso
			$data['alunos'] = $this->Aluno_model->get_aluno_por_curso($data['Turma'][0]['CursoId'],$data['Turma'][0]['Id']);
			$this->load->view('templates/header_admin',$data);
			$this->load->view('turma/create_edit_aluno',$data);
			$this->load->view('templates/footer',$data);
		}
		
		public function store()
		{
			$dataToSave = array(
				'Id' => $this->input->post('Id'),
				'Nome' => $this->input->post('Nome'),
				'Ativo' => 1,
				'CursoId' => $this->input->post('CursoId')
			);
			$idTurma = "";
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['Nome']))
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
				'TurmaId' => $this->input->post('Id'),
				'disciplinasId' => $this->input->post('disciplinas')
			);
			$idTurma = "";
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['TurmaId']))
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
				'TurmaId' => $this->input->post('Id'),
				'alunosId' => $this->input->post('alunos')
			);
			//bloquear acesso direto ao metodo store
			 if(!empty($dataToSave['TurmaId']))
				$this->Turma_model->set_turma_aluno($dataToSave);
			 else
				redirect('admin/dashboard');
			
			for($i = 0; $i < count($dataToSave['alunosId']); $i++)
			{
				$data = array(
					'Id' => $dataToSave['alunosId'][$i],
					'TurmaId' => $dataToSave['TurmaId']
				);
				$this->Aluno_model->set_aluno($data);
			}
			
			$arr = array('page' => 'turma/index');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
		
		public function trocar_aluno($id){
			$data['url'] = base_url();
			$data['controller'] = 'turma';
			$data['turma_atual'] = $this->Turma_model->get_turma($id);
			$data['alunos'] = $this->Turma_model->get_aluno_por_turma($id);
			$data['turmas'] = $this->Turma_model->get_turma();
			$data['title'] = 'Administração';
			$data['message'] = 'Administração';
			$this->load->view('templates/header_admin',$data);
			$this->load->view('turma/trocar_aluno',$data);
			$this->load->view('templates/footer',$data);
		}
		public function store_troca_aluno(){
			$data = array(
					'TurmaId' => $this->input->post('TurmaId'), //id da turma de destino
					'alunosId' => $this->input->post('alunos'), //alunos que trocarao de turma
					'Id_atual' => $this->input->post('Id_atual'), //id_atual_turma
				);
			
			 for($i = 0; $i < count($data['alunosId']); $i++)
			 {
				$dataToSave = array(
					'AlunoId' => $data['alunosId'][$i],
					'TurmaId' => $data['TurmaId'],
					'Id_atual' => $data['Id_atual']
				);
				$this->Turma_model->troca_aluno($dataToSave);
			 }
			
			$arr = array('response' => 'sucesso');
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
	}
?>
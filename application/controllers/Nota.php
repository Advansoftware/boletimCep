<?php
	define("POR_TURMA",1);
	define("POR_ALUNO",2);
	define("POR_TURMA_E_DISCIPLINA",3);

	require_once("Geral.php");

	class Nota extends Geral {
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
			$this->load->model('Boletim_model');
			$this->load->model('Settings_model');
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
				$this->view("nota/index",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		public function turmas($curso_id, $page = false)
		{
			if($page === false)
				$page = 1;

			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(READ,get_class($this)) == true)
			{
				$this->data['nome_curso'] = $this->Curso_model->get_curso($curso_id)[0]['nome_curso'];
				$this->data['Turmas'] = $this->Turma_model->get_turma_por_curso($curso_id, $page);
				$this->data['paginacao']['size'] = ((isset($this->data['Turmas'][0]['size'])) ? $this->data['Turmas'][0]['size'] : 0 );
				$this->data['paginacao']['pg_atual'] = $page;
				$this->data['paginacao']['method'] = "turmas";
				$this->data['paginacao']['parameter'] = $curso_id;

				$this->view("nota/turmas",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		public function disciplinas($turma_id, $page = false)
		{
			if($page === false)
				$page = 1;

			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(READ,get_class($this)) == true)
			{
				$this->data['turma_id'] = $turma_id;
				$this->data['nome_turma'] = $this->Turma_model->get_turma($turma_id)['nome_turma'];
				$this->data['disciplinas'] = $this->Turma_model->get_disciplina_por_turma($turma_id, $page);
				$this->data['paginacao']['size'] = ((isset($this->data['disciplinas'][0]['size'])) ? $this->data['disciplinas'][0]['size'] : 0 );
				$this->data['paginacao']['pg_atual'] = $page;
				$this->data['paginacao']['method'] = "alunos";
				$this->data['paginacao']['parameter'] = $turma_id;

				$this->view("nota/disciplinas",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}

		/*
			ESTE MÉTODO LISTA TODOS OS ALUNOS DE UMA TURMA COM RELAÇÃO A UMA DISCIPLINA
			PARA QUE O USUÁRIO POSSA INSERIR AS NOTAS DE TODOS OS ALUNOS POR DISCIPLINA
		*/
		public function nota_disciplina($turma_id, $disciplina_id)
		{
			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(READ,get_class($this)) == true)
			{
				$this->data['bimestres'] = $this->Settings_model->get_bimestres();

				$this->data['boletim'] = $this->Boletim_model->get_boletim(POR_TURMA_E_DISCIPLINA,0,$turma_id, $disciplina_id);
				$this->view("nota/nota_disciplina",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		public function atualiza_nota_disciplina($aluno_id,$disciplina_id,$bimestre,$valor,$turma_id,$campo)
		{
			$resultado = $this->Boletim_model->set_boletim($aluno_id,$disciplina_id,$bimestre,$valor,$turma_id,$campo);
			$arr = array('response' => $resultado);
			header('Content-Type: application/json');
			echo json_encode($arr);
		}
	}
?>
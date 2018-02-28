<?php
	define("POR_TURMA",1);
	define("POR_ALUNO",2);
	define("POR_TURMA_E_DISCIPLINA",3);
	define("POR_TURMA_E_DISCIPLINA_E_ALUNO",4);

	require_once("Geral.php");

	class Boletim extends Geral {
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
				$this->view("boletim/index",$this->data);
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

				$this->view("boletim/turmas",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		/*
			ESTE MÉTODO LISTA OS ALUNOS DE UMA TURMA PARA QUE O USUARIO ACESSE O BOLETIM DE CADA
			ALUNO
		*/
		public function alunos($turma_id, $page = false)
		{
			if($page === false)
				$page = 1;

			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(READ,get_class($this)) == true)
			{
				$this->data['nome_turma'] = $this->Turma_model->get_turma($turma_id)['nome_turma'];
				$this->data['Alunos'] = $this->Turma_model->get_aluno_por_turma($turma_id, $page);
				$this->data['paginacao']['size'] = ((isset($this->data['Alunos'][0]['size'])) ? $this->data['Alunos'][0]['size'] : 0 );
				$this->data['paginacao']['pg_atual'] = $page;
				$this->data['paginacao']['method'] = "alunos";
				$this->data['paginacao']['parameter'] = $turma_id;

				$this->view("boletim/alunos",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		public function boletim($aluno_id,$turma_id)
		{
			$this->data['title'] = 'Administração';
			if($this->Geral_model->get_permissao(READ,get_class($this)) == true)
			{
				$this->data['bimestres'] = $this->Settings_model->get_bimestres();

				$this->data['turma_id'] = $turma_id;
				$this->data['boletim'] = $this->Boletim_model->get_boletim(POR_ALUNO,$aluno_id,$turma_id);
				$this->view("boletim/boletim",$this->data);
			}
			else
				$this->view("templates/permissao",$this->data);
		}
		
		public function atualiza_boletim($aluno_id,$disciplina_id,$bimestre,$valor,$turma_id,$campo)
		{
			$resultado = $this->Boletim_model->set_boletim($aluno_id,$disciplina_id,$bimestre,$valor,$turma_id,$campo);
			$arr = array('response' => $resultado);
			header('Content-Type: application/json');
			echo json_encode($arr);
		}

		public function conselho($turma_id,$nivel)//nivel refere-se ao primeiro ou ao segundo conselho
		{
			$this->data['title'] = 'Administração';

			$this->data['disciplinas'] = $this->Turma_model->get_disciplina_por_turma($turma_id);
			$this->data['alunos'] = $this->Turma_model->get_aluno_por_turma($turma_id);
			$this->data['nivel'] = $nivel;

			$this->view("boletim/conselho",$this->data);
		}

		//o método abaixo carrega as notas de cada umn dos bimestres quando se clica em uma dicisplina na tela de conselho
		public function load_dados_conselho($aluno_id, $turma_id, $disciplina_id, $exame)
		{
			$resultado = "";
			$resultado = $this->Boletim_model->get_boletim(POR_TURMA_E_DISCIPLINA_E_ALUNO, $aluno_id, $turma_id, $disciplina_id);
			$arr = array('response' => $resultado);
			header('Content-Type: application/json');
			echo json_encode($arr);	
		}

		public function boletimAlunoPdf($aluno_id,$turma_id){
			$this->data['boletim'] = $this->Boletim_model->get_boletim(POR_ALUNO,$aluno_id,$turma_id);
			$html = $this->load->view('boletim/boletim_pdf', $this->data, true);
			$filename = 'boletim_'.time();
			$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
		}
	}
?>
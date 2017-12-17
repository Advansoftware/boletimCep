<?php
	class Curso_model extends CI_Model {
		
		/*
			CONECTA AO BANCO DE DADOS DEIXANDO A CONEX�O ACESS�VEL PARA OS METODOS
			QUE NECESSITAREM REALIZAR CONSULTAS.
		*/
		public function __construct()
		{
			$this->load->database();
		}
		
		/*
			RETORNA UM LEAD DE ACORDO COM O ID, 
			CASO O PARAMETRO ID NAO SEJA PASSADO RETORNA UMA LISTA DE LEAD
		*/
		public function get_curso($id = FALSE)
		{
			if ($id === FALSE)//retorna todos se nao passar o parametro
			{
				$query =  $this->db->query("SELECT Id, Nome as NomeCurso, DATE_FORMAT(DataRegistro, '%d/%m/%Y') as DataRegistro FROM Curso WHERE Ativo = 1 ORDER BY DataRegistro DESC");
				return $query->result_array();
			}

			$query =  $this->db->query("SELECT c.Id, c.Nome as NomeCurso, DATE_FORMAT(c.DataRegistro, '%d/%m/%Y') as DataRegistro, dc.DisciplinaId FROM Curso c 
										LEFT JOIN disciplina_curso dc ON c.Id = dc.CursoId 
										LEFT JOIN disciplina d ON dc.DisciplinaId = d.Id 
										WHERE c.Ativo = 1 AND c.Id = ".$this->db->escape($id)."");
			return $query->result_array();
		}
		
		/*
			INSERE OU ATUALIZA UM LEAD 
		*/
		public function set_curso($data)
		{
			if(empty($data['Id']))
			{
				$dataToSave = array(
					'Nome' => $data['NomeCurso'],
					'Ativo' => $data['Ativo']
				);
				$this->db->insert('Curso',$dataToSave);
				$query = $this->db->query('SELECT Id FROM Curso ORDER BY Id DESC LIMIT 1');
				$query = $query->row_array();
				for($i = 0; $i < count($data['disciplinasId']); $i++)
				{
					$dataToSave = array(
						'DisciplinaId' => $data['disciplinasId'][$i],
						'CursoId' => $query['Id']
					);
					$this->db->insert('disciplina_curso',$dataToSave);
				}
			}
			else
			{
				$dataToSave = array(
					'Id' => $data['Id'],
					'Nome' => $data['NomeCurso'],
					'Ativo' => $data['Ativo']
				);
				
				$query = $this->db->query("SELECT DisciplinaId FROM disciplina_curso
								WHERE CursoId = ".$this->db->escape($data['Id'])."");
				$query = $query->result_array();
				
					
					for($i = 0; $i < count($query); $i++)
					{
						$flag = 0;
						for($j = 0; $j < count($data['disciplinasId']); $j++)
						{
							if($query[$i]['DisciplinaId'] == $data['disciplinasId'][$j])
								$flag = 1;
						}
						if($flag == 0)
							$this->db->query("DELETE FROM disciplina_curso 
											WHERE DisciplinaId = ".$this->db->escape($query[$i]['DisciplinaId'])." AND CursoId =  
											".$this->db->escape($data['Id'])."");
					}
					
					for($i = 0; $i < count($data['disciplinasId']); $i++)
					{
						$flag = 0;
						for($j = 0; $j < count($query); $j++)
						{
							if($data['disciplinasId'][$i] == $query[$j]['DisciplinaId'])
								$flag = 1;
						}
						if($flag == 0)
						{
							$dataToSave = array(
								'DisciplinaId' => $data['disciplinasId'][$i],
								'CursoId' => $data['Id']
							);
							$this->db->insert('disciplina_curso',$dataToSave);
						}
					}
				
			}
			return "d";
		}
		
		/*
			FAZ UM UPDATE DESATIVANDO O LEAD, CASO NECESSITAR REATIVA-LO ALGUM DIA
		*/
		public function delete_curso($id){
			// $this->db->where('id',$id);
			// return $this->db->delete("leads");
			return $this->db->query("UPDATE curso SET Ativo = 0 WHERE Id = ".$this->db->escape($id)."");
		}
		
		/*
			CARREGA OS DADOS PARA SEREM CARRREGADOS NO GRAFICOS, RETORNA UMA MATRIZ,
			ONDE A PRIMEIRA LINHA E REFERE A QUANTIDADE DE LEADS POR DIA E A SEGUNDA LINHA 
			SE REFERE AO DIA
		*/
		public function get_lead_chart($mes = null, $ano = null)
		{
			//obter quantidade de dias para o mes em quest�o
			$qtd = date('t', mktime(0, 0, 0, $mes, 10, $ano ));
			$qtd_array = array();
			$dia = array();
			for($i = 1; $i <= $qtd; $i++)
			{
				$query = $this->db->query("SELECT count(*) as qtd_lead FROM leads 
										WHERE MONTH(data_registro) = ".$this->db->escape($mes)."AND YEAR(data_registro) =".$this->db->escape($ano) ."AND DAY(data_registro) = ".$this->db->escape($i)." AND ativo = 1");
				$query = $query->row_array();
				array_push($qtd_array,$query['qtd_lead']);
				array_push($dia,$i);
			}
			$data = array('qtd' => $qtd_array,
						  'dia' => $dia
			);
			return $data;
		}
	}
?>
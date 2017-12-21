<?php
	class Curso_model extends CI_Model {
		
		/*
			CONECTA AO BANCO DE DADOS DEIXANDO A CONEXÃO ACESSÍVEL PARA OS METODOS
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
				$query =  $this->db->query("SELECT c.Id, c.Nome, DATE_FORMAT(c.DataRegistro, '%d/%m/%Y') as DataRegistro,  
				(SELECT COUNT(*) FROM Disciplina_Curso dc WHERE dc.CursoId = c.Id) as Qtd_Disciplina 
				FROM Curso c WHERE Ativo = 1 ORDER BY c.DataRegistro DESC");
				return $query->result_array();
			}

			$query =  $this->db->query("SELECT c.Id, c.Nome as NomeCurso, DATE_FORMAT(c.DataRegistro, '%d/%m/%Y') as DataRegistro, dc.DisciplinaId FROM Curso c 
										LEFT JOIN Disciplina_Curso dc ON c.Id = dc.CursoId 
										LEFT JOIN Disciplina d ON dc.DisciplinaId = d.Id 
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
				$query = $this->db->query("SELECT DisciplinaId FROM Disciplina_Curso
								WHERE CursoId = ".$this->db->escape($data['Id'])."");
				$query = $query->result_array();
				
				//DELETA OS QUE FORAM REMOVIDOS NA TELA PELO USUARIO
				for($i = 0; $i < count($query); $i++)
				{
					$flag = 0;
					for($j = 0; $j < count($data['disciplinasId']); $j++)
					{
						if($query[$i]['DisciplinaId'] == $data['disciplinasId'][$j])
							$flag = 1;
					}
					if($flag == 0)
						$this->db->query("DELETE FROM Disciplina_Curso 
										WHERE DisciplinaId = ".$this->db->escape($query[$i]['DisciplinaId'])." AND CursoId =  
										".$this->db->escape($data['Id'])."");
				}
				//FAZ INSERT DE TODOS, POREM OS INSERE DE SUCESSO SÃO AQUELES QUE NÃO VIOLAM A CHAVE PRIMARI
				for($i = 0; $i < count($data['disciplinasId']); $i++)
					$this->db->query("INSERT IGNORE INTO Disciplina_Curso(DisciplinaId,CursoId)
										VALUES(".$this->db->escape($data['disciplinasId'][$i]).",".$this->db->escape($data['Id']).")");
				$dataToSave = array(
					'Id' => $data['Id'],
					'Nome' => $data['NomeCurso']
				);
				$this->db->where('Id', $data['Id']);
				$this->db->update('Curso', $dataToSave);
			}
		}
		
		/*
			FAZ UM UPDATE DESATIVANDO O LEAD, CASO NECESSITAR REATIVA-LO ALGUM DIA
		*/
		public function delete_curso($id){
			// $this->db->where('id',$id);
			// return $this->db->delete("leads");
			return $this->db->query("UPDATE Curso SET Ativo = 0 WHERE Id = ".$this->db->escape($id)."");
		}
	}
?>
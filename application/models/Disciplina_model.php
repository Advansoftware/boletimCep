<?php
	class Disciplina_model extends CI_Model {
		
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
		public function get_disciplina($id = FALSE)
		{
			if ($id === FALSE)//retorna todos se nao passar o parametro
			{
				$query =  $this->db->query('SELECT d.Id, d.Nome as NomeDisciplina, d.Ativo, d.DataRegistro, c.Nome as NomeCategoria, d.CategoriaId FROM Disciplina d
											INNER JOIN Categoria c ON d.CategoriaId = c.Id WHERE d.Ativo = 1 ORDER BY d.DataRegistro DESC');
				return $query->result_array();
			}

			$query = $this->db->get_where('Disciplina', array('Id' => $id));
			return $query->row_array();
		}
		
		public function get_disciplina_por_curso($id)
		{
			$query = $this->db->query("SELECT d.Id, d.Nome FROM Disciplina_Curso dc 
										INNER JOIN Disciplina d ON dc.DisciplinaId = d.ID 
										WHERE dc.CursoId = ".$this->db->escape($id)."");
			return $query->result_array();
		}
		
		/*
			INSERE OU ATUALIZA UM LEAD 
		*/
		public function set_disciplina($data)
		{
			if(empty($data['Id']))
				return $this->db->insert('Disciplina',$data);	
			else
			{
				$this->db->where('Id', $data['Id']);
				return $this->db->update('Disciplina', $data);
			}
		}
		
		/*
			FAZ UM UPDATE DESATIVANDO O LEAD, CASO NECESSITAR REATIVA-LO ALGUM DIA
		*/
		public function delete_disciplina($id){
			// $this->db->where('id',$id);
			// return $this->db->delete("leads");
			return $this->db->query("UPDATE Disciplina SET Ativo = 0 WHERE Id = ".$this->db->escape($id)."");
		}
	}
?>
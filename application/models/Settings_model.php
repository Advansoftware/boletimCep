<?php
	class Settings_model extends CI_Model {
		
		/*
			CONECTA AO BANCO DE DADOS DEIXANDO A CONEXÃO ACESSÍVEL PARA OS METODOS
			QUE NECESSITAREM REALIZAR CONSULTAS.
		*/
		public function __construct()
		{
			$this->load->database();
		}

		public function get_geral($id = FALSE)
		{
			$query = $this->db->query("
				SELECT id, media, itens_por_pagina, total_faltas, 
				primeiro_bimestre, segundo_bimestre, terceiro_bimestre, quarto_bimestre FROM 
				configuracoes_geral");

			return $query->row_array();
		}

		public function set_geral($data)
		{
			if(empty($data['id']))
				return $this->db->insert('configuracoes_geral',$data);
			else
			{
				$this->db->where('id', $data['id']);
				return $this->db->update('configuracoes_geral', $data);
			}
		}

		public function get_faltas()
		{
			$query = $this->db->query("SELECT total_faltas FROM  configuracoes_geral");
			return $query->row_array()['total_faltas'];
		}

		public function get_media()
		{
			$query = $this->db->query("SELECT media FROM  configuracoes_geral");
			return $query->row_array()['media'];
		}

		public function get_bimestres()
		{
			$query = $this->db->query("
				SELECT primeiro_bimestre, segundo_bimestre, terceiro_bimestre, quarto_bimestre 
				FROM configuracoes_geral");

			return $query->row_array();
		}
	}
?>
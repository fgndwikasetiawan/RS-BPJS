<?php
	class Ruang_iri extends CI_Model{
		public function __construct(){
			parent::__construct();
		}	

		function insert($data){
			$this->db->insert('RUANG_IRI', $data);
		}
		
	}	
?>
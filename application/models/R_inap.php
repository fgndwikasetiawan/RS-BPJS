<?php
	class R_inap extends CI_Model{
		public function __construct(){
			parent::__construct();
		}	

		function insert($data){
			$this->db->insert('PASIEN_IRI', $data);
		}

	}	
?>
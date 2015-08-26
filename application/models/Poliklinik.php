<?php
	class Poliklinik extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		function get_poli(){
			$this->db->select('ID_POLI, NM_POLI');
			$this->db->order_by('NM_POLI', 'ASC');
			$query = $this->db->get('POLIKLINIK');
			return $query->result();
		}

	}
?>
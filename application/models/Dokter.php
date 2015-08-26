<?php
	class Dokter extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		public function get_dokter() {
			$query = $this->db->get('DR_JAGA_IRD');
			return $query->result();
		}
	}
?>
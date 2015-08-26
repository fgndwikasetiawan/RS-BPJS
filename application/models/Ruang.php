<?php
	class Ruang extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		public function get_ruang() {
			$query = $this->db->get('RUANG');
			return $query->result();
		}
	}
?>
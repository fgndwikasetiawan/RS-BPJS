<?php
	class Cara_masuk extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		public function get_cara_masuk() {
			$query = $this->db->get('CARA_MASUK');
			return $query->result();
		}
	}
?>
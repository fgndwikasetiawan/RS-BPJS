<?php
	class SMF extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		public function get_smf() {
			$query = $this->db->get('SMF');
			return $query->result();
		}
	}
?>
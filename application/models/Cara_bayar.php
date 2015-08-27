<?php
	class Cara_bayar extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		function get_cara_bayar(){
			$this->db->select('CARA_BAYAR, KLSRAWATJALAN');
			$query = $this->db->get('CARA_BAYAR');
			return $query->result();
		}
	}
?>
<?php
	class Cara_berkunjung extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		function get_cara_kunj(){
			$this->db->select('CARA_KUNJ, KELAS_RAWATJALAN');
			$query = $this->db->get('CARA_BERKUNJUNG');
			return $query->result();
		}

	}
?>
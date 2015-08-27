<?php
	class Ruang_rawat extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		public function get_ruang_rawat() {
			$this->db->select('*');
			$this->db->from('RUANG_RAWAT');
			$this->db->join('RUANG', 'RUANG_RAWAT.IDRG = RUANG.IDRG', 'left');
			$query = $this->db->get();
			return $query->result();
		}
	}
?>
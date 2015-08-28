<?php
	class Ruang extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		public function get_ruang_by_idrg($idrg) {
			$this->db->where('IDRG', $idrg);
			$query = $this->db->get('RUANG');
			return $query->row();
		}
	}
?>
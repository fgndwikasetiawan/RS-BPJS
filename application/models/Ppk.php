<?php
   class Ppk extends CI_Model {
      public function __construct() {
         parent::__construct();
      }
		public function get_data($kd_ppk) {
			$this->db->where('KD_PPK', $kd_ppk);
			$query = $this->db->get('DATA_PPK');
			return $query->row();
		}
   }
 ?>

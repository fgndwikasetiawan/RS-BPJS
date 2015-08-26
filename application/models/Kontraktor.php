<?php
	class Kontraktor extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		function get_kontraktor(){
			$this->db->select('ID_KONTRAKTOR, NM_PERUSAHAAN');
			$this->db->order_by('NM_PERUSAHAAN', 'ASC');
			$query = $this->db->get('KONTRAKTOR');
			return $query->result();
		}

	}
?>
<?php
	class Pasien_iri extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		public function insert($data) {
			if (!$this->db->insert('PASIEN_IRI', $data)) {
				return false;
			}
			return true;
		}
		
		public function get_pasien($ipd) {
			$this->db->where('NO_IPD', $ipd);
			$query = $this->db->get('PASIEN_IRI');
			$result = $query->row();
			return $result;
		}
	}
?>
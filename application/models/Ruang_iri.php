<?php
	class Ruang_iri extends CI_Model{
		public function __construct(){
			parent::__construct();
		}	

		function insert($data){
			$this->db->insert('RUANG_IRI', $data);
		}
		
		function get_entri_by_ipd($ipd) {
			$this->db->select('*');
			$this->db->from('RUANG_IRI');
			$this->db->join('RUANG', 'RUANG_IRI.IDRG = RUANG.IDRG', 'left');
			$this->db->join('RUANG_RAWAT', 'RUANG_IRI.IDRG = RUANG_RAWAT.IDRG', 'left');
			$this->db->join('BED', 'RUANG_IRI.BED = BED.BED', 'left');
			$this->db->where('RUANG_IRI.NO_IPD', $ipd);
			$query = $this->db->get();
			return $query->result();
		}
		
		
	}	
?>
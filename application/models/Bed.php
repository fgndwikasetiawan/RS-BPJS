<?php 
	class Bed extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function get_bed(){
			$this->db->select('BED.BED, BED.IDRG, BED.KELAS');
			$this->db->order_by('BED', 'ASC');
			$query = $this->db->get('BED');
			return $query->result();
		}
	}
 ?>
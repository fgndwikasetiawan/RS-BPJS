<?php 
	class Kelas extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function get_kelas(){
			$this->db->select('KELAS');
			$this->db->order_by('KELAS', 'ASC');
			$query = $this->db->get('KELAS');
			return $query->result();
		}
	}
 ?>
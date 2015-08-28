<?php
	class User extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		public function get_user() {
			$this->db->select('USERNAME');
			$query = $this->db->get('PENGGUNA');
			return $query->result();
		}

		public function insert($data){
			$pass =  password_hash($data['PASSWORD_HASH'], PASSWORD_DEFAULT);
			$this->db->set('PASSWORD_HASH', $pass);
			$this->db->set('USERNAME', $data['USERNAME']);
			$this->db->insert('PENGGUNA');
		}

		function hapus($userbaru){
			$this->db->where('USERNAME', $userbaru);
			$query = $this->db->delete('PENGGUNA');
			return $query;
		}
	}
?>
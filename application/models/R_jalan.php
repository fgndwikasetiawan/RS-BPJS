<?php
	class R_jalan extends CI_Model{
		public function __construct(){
			parent::__construct();
		}	

		function insert($data){
			$this->db->set('TGL_KUNJUNGAN', 'SYSDATE', false);
			return $this->db->insert('DAFTAR_ULANG', $data);
		}

		function get_no_cm($no_register) {
			$this->db->select('NO_MEDREC');
			$this->db->where('NO_REGISTER', $no_register);
			$query = $this->db->get('DAFTAR_ULANG');
			$result = $query->row();
			return !$result ? null : $result->NO_MEDREC;
		}
	
		function get_historis($no_medrec) {
			$this->db->from('DAFTAR_ULANG');
			$this->db->join('POLIKLINIK', 'POLIKLINIK.ID_POLI = DAFTAR_ULANG.ID_POLI', 'left');
			$this->db->join('KONTRAKTOR', 'KONTRAKTOR.ID_KONTRAKTOR = DAFTAR_ULANG.ID_KONTRAKTOR', 'left');
			$this->db->join('ICD1', 'ICD1.ID_ICD = DAFTAR_ULANG.ID_DIAGNOSA', 'left');
			$this->db->select('*');
			$this->db->where('DAFTAR_ULANG.NO_MEDREC', $no_medrec);
			$this->db->order_by("DAFTAR_ULANG.TGL_KUNJUNGAN", "desc");
			$this->db->limit(5);
			$query = $this->db->get();
			return $query->result();
		}

		//return no register baru dengan tahun tanpa kode di depan (RG / RJ)
		function get_new_noreg() {
			$query = $this->db->query('select s_register.nextval from dual');
			$result = $query->row();
			$noreg = date('y') . sprintf("%06d", $result->NEXTVAL);
			return $noreg;
		}
		
		function hapus($noreg) {
			$this->db->where('NO_REGISTER', $noreg);
			$query = $this->db->delete('DAFTAR_ULANG');
			return $query;
		}
	}	
?>
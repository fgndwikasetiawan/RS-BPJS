<?php
	class Daftar_ulang extends CI_Model{
		public function __construct(){
			parent::__construct();
		}	

		function insert($data){
			$this->db->set('TGL_KUNJUNGAN', 'SYSDATE', false);
			return $this->db->insert('DAFTAR_ULANG', $data);
		}

		function get_historis($no_medrec) {
			$this->db->from('DAFTAR_ULANG');
			$this->db->join('POLIKLINIK', 'POLIKLINIK.ID_POLI = DAFTAR_ULANG.ID_POLI', 'left');
			$this->db->join('KONTRAKTOR', 'KONTRAKTOR.ID_KONTRAKTOR = DAFTAR_ULANG.ID_KONTRAKTOR', 'left');
			$this->db->join('ICD10', 'ICD10.ID_ICD10 = DAFTAR_ULANG.ID_DIAGNOSA', 'left');
			$this->db->select('*');
			$this->db->where('DAFTAR_ULANG.NO_MEDREC', $no_medrec);
			$this->db->order_by("DAFTAR_ULANG.TGL_KUNJUNGAN", "desc");
			$this->db->limit(5);
			$query = $this->db->get();
			return $query->result();
		}

		function get_poli(){
			$this->db->select('ID_POLI, NM_POLI');
			$query = $this->db->get('POLIKLINIK');
			return $query->result();
		}

		function get_cara_kunj(){
			$this->db->select('CARA_KUNJ, KELAS_RAWATJALAN');
			$query = $this->db->get('CARA_BERKUNJUNG');
			return $query->result();
		}

		function get_cara_bayar(){
			$this->db->select('CARA_BAYAR, KLSRAWATJALAN');
			$query = $this->db->get('CARA_BAYAR');
			return $query->result();
		}

		function get_perusahaan(){
			$this->db->select('ID_KONTRAKTOR, NM_PERUSAHAAN');
			$query = $this->db->get('KONTRAKTOR');
			return $query->result();
		}

		function get_diagnosa(){
			$this->db->select('ID_ICD10, NAMA_DIAGNOSA');
			$query = $this->db->get('ICD10');
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
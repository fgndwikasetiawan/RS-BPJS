<?php
	class Pasien_iri extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		public function insert($data) {
			if (isset($data['TGLDAFTARRI'])) {
				$this->db->set('TGLDAFTARRI', $data['TGLDAFTARRI'], false);
				unset($data['TGLDAFTARRI']);
			}
			
			if (!$this->db->insert('PASIEN_IRI', $data)) {
				return false;
			}
			return true;
		}
		
		public function update($data) {
			if (isset($data['TGLDAFTARRI'])) {
				$this->db->set('TGLDAFTARRI', $data['TGLDAFTARRI'], false);
				unset($data['TGLDAFTARRI']);
			}
			$this->db->where('NO_IPD', $data['NO_IPD']);
			if (!$this->db->update('PASIEN_IRI', $data)) {
				return false;
			}
			return true;
		}
		
		public function insert_or_update($data) {
			if ($this->cek_no_ipd($data['NO_IPD'])) {
				return $this->update($data);
			}
			else {
				return $this->insert($data);
			}
		}
		
		public function get_pasien($ipd) {
			$this->db->from('PASIEN_IRI');
			$this->db->join('SMF', 'PASIEN_IRI.ID_SMF = 	SMF.ID_SMF');
			$this->db->select('PASIEN_IRI.NO_CM,
									 PASIEN_IRI.NOREGASAL,
									 PASIEN_IRI.NO_IPD,
									 PASIEN_IRI.NOIPDIBU,
									 TO_CHAR(PASIEN_IRI.TGLDAFTARRI, \'DD/MM/YYYY\') TGL_DAFTAR,
									 SMF.NMSMF,
									 PASIEN_IRI.CARABAYAR,
									 PASIEN_IRI.CARAMASUK,
									 PASIEN_IRI.ID_DOKTER,
									 PASIEN_IRI.NOSJP,
									 PASIEN_IRI.ID_SMF,
									 PASIEN_IRI.ID_KONTRAKTOR,
									 PASIEN_IRI.NOPEMBAYARRI,
									 PASIEN_IRI.NO_SEP,
									 PASIEN_IRI.NMPEMBAYARRI,
									 PASIEN_IRI.KETPEMBAYARRI,
									 PASIEN_IRI.GOLPEMBAYARRI,
									 PASIEN_IRI.JATAHKLSIRI,
									 PASIEN_IRI.NMPJAWABRI,
									 PASIEN_IRI.ALAMATPJAWABRI,
									 PASIEN_IRI.NOTLPPJAWAB,
									 PASIEN_IRI.KARTUIDPJAWAB,
									 PASIEN_IRI.NOIDPJAWAB,
									 PASIEN_IRI.HUBPJAWABRI');
			$this->db->where('PASIEN_IRI.NO_IPD', $ipd);
			$query = $this->db->get();
			$result = $query->row();
			return $result;
		}
		
		/**
      *  Mengecek apakah $no_ipd ada dalam database
      *  return:
      *           -true jika ada
      *           -false jika tidak ada
      */
      public function cek_no_ipd($no_ipd) {
         $this->db->where('NO_IPD', $no_ipd);
         $query = $this->db->get('PASIEN_IRI');
         if ($query->num_rows() > 0) {
            return true;
         }
         else {
            return false;
         }
      }
		
		public function get_new_noipd() {
			$query = $this->db->query('select s_irnareg.nextval from dual');
			$result = $query->row();
			$noreg = 'RI' . date('y') . sprintf("%06d", $result->NEXTVAL);
			return $noreg;
		}
		
		//mengembalikan pilihan-pilihan nilai kartuidpjawab
		public function kartuidpjawab() {
			return ['KTP', 'NIP', 'SIM', 'PASPOR'];
		}
		
		//mengembalikan pilihan-pilihan nilai hubpjawabri
		public function hubpjawabri() {
			return ['KELUARGA', 'ORANGTUA', 'ISTRI', 'SUAMI', 'SAUDARA', 'MERTUA', 'ANAK', 'DIRI SAYA'];
		}
	}
?>
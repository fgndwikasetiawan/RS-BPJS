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
		
		public function get_new_noipd() {
			$query = $this->db->query('select s_irnareg.nextval from dual');
			$result = $query->row();
			$noreg = 'RI' . date('y') . sprintf("%06d", $result->NEXTVAL);
			return $noreg;
		}
	}
?>
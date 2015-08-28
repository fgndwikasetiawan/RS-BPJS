<?php
	class Ruang_iri extends CI_Model{
		public function __construct(){
			parent::__construct();
		}	

		function insert($data){
			$entri_terakhir = $this->get_last_entri_by_ipd($data['NO_IPD']);
			if ($entri_terakhir) {
				$update_data = ['TGLKELUARRG' => $data['TGLMASUKRG'] ];
				$this->update($data['NO_IPD'], $entri_terakhir->IDRG, $entri_terakhir->TGLMASUKRG, $update_data);
			}
			if (isset($data['TGLMASUKRG'])) {
				$this->db->set('TGLMASUKRG', $data['TGLMASUKRG'], false);
				unset($data['TGLMASUKRG']);
			}
			if($this->db->insert('RUANG_IRI', $data)) {
				return true;
			}
			else {
				return false;
			}
		}
		
		function hapus($ipd, $tgl, $idrg) {
			$this->db->where('NO_IPD', $ipd);
			$this->db->where('TGLMASUKRG', $tgl, false);
			$this->db->where('IDRG', $idrg);
			if ($this->db->delete('RUANG_IRI')) {
				return true;
			}
			return false;
		}
		
		function get_entri_by_ipd($ipd) {
			$this->db->select('RUANG.NMRUANG,
									 RUANG_IRI.IDRG,
									 TO_CHAR(RUANG_IRI.TGLMASUKRG, \'DD/MM/YYYY\') TGLMASUKRG,
									 RUANG_IRI.KELAS,
									 RUANG_IRI.BED,
									 TO_CHAR(RUANG_IRI.TGLKELUARRG, \'DD/MM/YYYY\') TGLKELUARRG'
									);
			$this->db->join('RUANG', 'RUANG_IRI.IDRG = RUANG.IDRG', 'left');
			$this->db->where('RUANG_IRI.NO_IPD', $ipd);
			$this->db->order_by('RUANG_IRI.TGLMASUKRG', 'ASC');
			$query = $this->db->get('RUANG_IRI');
			return $query->result();
		}
		
		function get_last_entri_by_ipd($ipd) {
			$this->db->select('NO_IPD, IDRG, TO_CHAR(TGLMASUKRG, \'DD/MM/YYYY\') TGLMASUKRG');
			$this->db->where('NO_IPD', $ipd);
			$this->db->order_by('TGLMASUKRG', 'DESC');
			$query = $this->db->get('RUANG_IRI');
			$row = $query->first_row();
			return $row;
		}
		
		function update($no_ipd, $idrg, $tglmasuk, $data) {
			if (isset($data['TGLMASUKRG'])) {
				$this->db->set('TGLMASUKRG', $data['TGLMASUKRG'], false);
				unset($data['TGLMASUKRG']);
			}
			if (isset($data['TGLKELUARRG'])) {
				$this->db->set('TGLKELUARRG', $data['TGLKELUARRG'], false);
				unset($data['TGLKELUARRG']);
			}
			$this->db->where('NO_IPD', $no_ipd);
			$this->db->where('IDRG', $idrg);
			$this->db->where('TGLMASUKRG', 'TO_DATE(\'' . $tglmasuk . '\', \'DD/MM/YYYY\')', false);
			$this->db->update('RUANG_IRI', $data); 
		}
		
	}	
?>
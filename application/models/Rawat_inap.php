<?php
	class Rawat_inap extends CI_Model{
		public function __construct(){
			parent::__construct();
		}	

		function insert($data){
			$this->db->insert('PASIEN_IRI', $data);
		}

		//ambil data dokter 
		function get_dokter(){
			$this->db->select('ID_PDOKTER, NAMA_DOKTER');
			$query = $this->db->get('DR_JAGA_IRD');
			return $query->result();
		}

		//ambil data cara masuk
		function get_cara_masuk(){
			$this->db->select('CARAMASUK');
			$query = $this->db->get('CARA_MASUK');
			return $query->result();
		}

		//ambil data cara bayar
		function get_cara_bayar(){
			$this->db->select('CARA_BAYAR, KLSRAWATJALAN');
			$query = $this->db->get('CARA_BAYAR');
			return $query->result();
		}

		//ambil data ruang
		function get_ruang(){
			$this->db->select('IDRG, NMRUANG');
			$this->db->order_by('NMRUANG', 'ASC');
			$query = $this->db->get('RUANG');
			return $query->result();
		}

		//ambil data perusahaan
		function get_perusahaan(){
			$this->db->select('ID_KONTRAKTOR, NM_PERUSAHAAN');
			$this->db->order_by('NM_PERUSAHAAN', 'ASC');
			$query = $this->db->get('KONTRAKTOR');
			return $query->result();
		}

	}	
?>
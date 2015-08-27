<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rawat_inap extends CI_Controller {

	public function __construct() {
<<<<<<< HEAD
		parent::__construct();		
		if (!$this->session->has_userdata('username')) {
			redirect(base_url() . 'Auth');
		}		
=======
		parent::__construct();
		if (!$this->session->has_userdata('username')) {
			redirect(base_url() . 'Auth');
		}
>>>>>>> 9a0685e74fb2f4b687cfc4f2fc54bb7cd133fef0
	}

	public function index(){
		load_main_template('Pendaftaran Rawat Inap', 'Pendaftaran Rawat Inap', 'rawat_inap', null, 3);
<<<<<<< HEAD
	}	
=======
	}
   
	public function form($tipe = null, $nomor = null) {
		if (($tipe != 'reg_irj' && $tipe != 'ipd') || (!$nomor || $nomor == '')) {
			load_main_template('Pendaftaran Rawat Inap', 'Pendaftaran Rawat Inap', 'rawat_inap', null, 3);	
		}
		else {
			$data_pasien = null;
			if ($tipe == 'reg_irj') {
				$this->load->model('r_jalan');
				$no_cm = $this->r_jalan->get_no_cm($nomor);
				if ($no_cm) {
					$this->load->model('pasien_irj');
					$data_pasien = $this->pasien_irj->cari_by_medrec($no_cm);
					$data_pasien->NOREGASAL = $nomor;
				}
			}
			else if ($tipe == 'ipd') {
				$this->load->model('pasien_iri');
				$entri_iri = $this->pasien_iri->get_pasien($nomor);
				if ($entri_iri) {
					$this->load->model('pasien_irj');
					$data_pasien = $this->pasien_irj->cari_by_medrec($entri_iri->NO_CM);
					$data_pasien = (object) array_merge((array)$data_pasien, (array)$entri_iri);
				}
			}
			if (!$data_pasien) {
				alert_fail('Pasien tidak ditemukan');
				redirect(base_url() . 'rawat_inap/form');
				return;
			}
			
			
			$this->load->model('cara_bayar');
			$this->load->model('cara_masuk');
			$this->load->model('dokter');
			$this->load->model('kontraktor');
			$this->load->model('ruang_rawat');
			$this->load->model('ruang_iri');
			
			$data['dokter'] = $this->dokter->get_dokter();
			$data['kontraktor'] = $this->kontraktor->get_kontraktor();
			$data['cara_bayar'] = $this->cara_bayar->get_cara_bayar();
			$data['cara_masuk'] = $this->cara_masuk->get_cara_masuk();
			$data['ruang_rawat'] = $this->ruang_rawat->get_ruang_rawat();
			if ($tipe == 'ipd') { 
				$data['ruang_iri'] = $this->ruang_iri->get_entri_by_ipd($nomor);
			}
			$data['pasien'] = $data_pasien;
			
			load_main_template('Pendaftaran Rawat Inap', 'Pendaftaran Rawat Inap', 'rawat_inap', $data, 3);
			
		}
	}
>>>>>>> 9a0685e74fb2f4b687cfc4f2fc54bb7cd133fef0
}

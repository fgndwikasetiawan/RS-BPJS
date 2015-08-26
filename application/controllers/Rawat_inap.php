<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rawat_inap extends CI_Controller {

	public function __construct() {
		parent::__construct();
		/*
		if (!$this->session->has_userdata('username')) {
			redirect(base_url() . 'Auth');
		}
		*/
	}

	public function index(){
		load_main_template('Pendaftaran Rawat Inap', 'Pendaftaran Rawat Inap', 'rawat_inap', null, 3);
	}
   
	public function form($tipe = null, $nomor = null) {
		if (($tipe != 'reg_rj' && $tipe != 'ipd') || (!$nomor || $nomor == '')) {
			load_main_template('Pendaftaran Rawat Jalan', 'Pendaftaran Rawat Jalan', 'rawat_jalan', null, 2);	
		}
		else {
			$data_pasien = null;
			if ($tipe == 'reg_rj') {
				$this->load->model('r_jalan');
				$no_cm = $this->r_jalan->get_no_cm($nomor);
				if ($no_cm) {
					$this->load->model('pasien_irj');
					$data_pasien = $this->pasien_irj->cari_by_medrec($no_cm);
				}
			}
			else if ($tipe == 'ipd') {
				$this->load->model('pasien_iri');
				$no_cm = $this->pasien_iri->get_no_cm($nomor);
				if ($no_cm) {
					$this->load->model('pasien_irj');
					$data_pasien = $this->pasien_irj->cari_by_medrec($no_cm);
				}
			}
			
			if (!$data_pasien) {
				alert_fail('Pasien tidak ditemukan');
				redirect(base_url() . 'rawat_inap');
			}
			
			
		}
	}
}

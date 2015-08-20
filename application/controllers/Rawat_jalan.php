<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rawat_jalan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->session->has_userdata('username')) {
			redirect(base_url() . 'Auth');
		}
	}
	
	public function index() {
		redirect(base_url() . 'rawat_jalan/form');
	}
	
	public function form($tipe = null, $nomor = null) {
		if (($tipe != 'medrec' && $tipe != 'bpjs') || (!$nomor || $nomor == '')) {
			load_main_template('Pendaftaran Rawat Jalan', 'Pendaftaran Rawat Jalan', 'rawat_jalan', null, 2);	
		}
		else {
			$this->load->model('pasien_irj');
			$this->load->model('daftar_ulang');
			$result = null;
			if($tipe == 'medrec'){
				$result = $this->pasien_irj->cari_by_medrec($nomor);
			}
			else if($tipe == 'bpjs'){
				$result = $this->pasien_irj->cari_by_bpjs($nomor);
			}
			if ($result == null) {
				alert_fail('Pasien tidak ditemukan');
				redirect(base_url() . 'rawat_jalan/form');
			}
			$data['no_cm'] = $result->NO_MEDREC;
			$data['nama'] = $result->NAMA;
			$data['usia'] = $result->UMUR;
			$data['sex'] = $result->SEX;
			$data['no_bpjs'] = $result->NO_ASURANSI;
			$data['tgl_lahir'] = $result->TGL_LAHIR;
	
			$noreg = 'RJ' . $this->daftar_ulang->get_new_noreg();
			$data['noreg'] = $noreg;
	
			$query = $this->daftar_ulang->get_historis($result->NO_MEDREC);
			$data['historis'] = $query;
	
			$query = $this->daftar_ulang->get_poli();
			$data['poli'] = $query;
	
			$query = $this->daftar_ulang->get_cara_kunj();
			$data['kunj'] = $query;
	
			$query = $this->daftar_ulang->get_cara_bayar();
			$data['bayar'] = $query;
	
			$query = $this->daftar_ulang->get_perusahaan();
			$data['perusahaan'] = $query;
	
			$query = $this->daftar_ulang->get_diagnosa();
			$data['diagnosa'] = $query;
	
			load_main_template('Pendaftaran Rawat Jalan', 'Pendaftaran Rawat Jalan', 'rawat_jalan', $data, 2);
		}
	}
	
	public function submit() {
		if ($this->input->post('no_cm') === null) {
			redirect(base_url() . 'pendaftaran/form');
		}
		$this->load->model('daftar_ulang');
		$data = array(
			'NO_REGISTER' => 'no_register',
			'NO_MEDREC' => 'no_cm',
			'NMPEMBAYAR' => 'nmpembayar',
			'KETPEMBAYAR' => 'ketpembayar',
			'CARA_KUNJ' => 'cara_kunj',
			'NO_SJP_ASKES' => 'no_sjp',
			'KELAS_PASIEN' => 'kelas_pasien',
			'ID_KONTRAKTOR' => 'id_perusahaan',
			'CARA_BAYAR' => 'cara_bayar',
			'ID_POLI' => 'id_poli',
			'ANAMNESA' => 'anamnesa',
			'ID_DIAGNOSA' => 'id_diagnosa'
			);

		foreach ($data as $key => $value) {
			$data[$key] = $this->input->post($value);
		}
		if ($this->daftar_ulang->insert($data)) {
			alert_success('Berhasil melakukan pendaftaran');
		}
		else {
			alert_fail('Gagal melakukan pendaftaran');
		}
		redirect(base_url().'rawat_jalan/form/medrec/' . $data['NO_MEDREC']);
	}

	public function cetak_sep() {
		require(getenv('DOCUMENT_ROOT') . '/assets/Surat.php');
		$surat = new Surat();
		$fields = array(
				'No. SEP' => $this->input->post('no_sep'),
				'Tgl. SEP' => date('d-m-Y'),
				'No. Kartu' => $this->input->post('input_no_bpjs'),
				'Peserta' => $this->input->post('ketpembayar'),
				'Nama Peserta' => $this->input->post('input_nama'),
				'Tgl. Lahir' => $this->input->post('input_tgl_lahir'),
				'Jenis Kelamin' => $this->input->post('input_sex'),
				'Asal Faskes' => $this->input->post('ppk_rujukan'),
				'Poli Tujuan' => $this->input->post('nm_poli'),
				'Kelas Rawat' => $this->input->post('kelas_pasien'),
				'Jenis Rawat' => 'Rawat Jalan',
				'Diagnosa Awal' => $this->input->post('id_diagnosa'),
				'Catatan' => $this->input->post('catatan')
			); 
		$surat->set_nilai($fields);
		$surat->cetak();
	}
	
	public function hapus_entri($no_cm, $no_reg) {
		$this->load->model('daftar_ulang');
		$this->daftar_ulang->hapus($no_reg);
		redirect(base_url() . 'rawat_jalan/form/medrec/' . $no_cm);
	}
}

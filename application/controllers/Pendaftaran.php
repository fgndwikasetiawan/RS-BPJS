<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->session->has_userdata('username')) {
			redirect(base_url() . 'Auth');
		}
	}

	public function index()
	{
		$this->load->model('agama');
		$this->load->model('pendidikan');
		$data['agama'] = $this->agama->get();
		$data['pendidikan'] = $this->pendidikan->get();
		$alert_msg = $this->session->flashdata('alert_msg');
		$alert_class = $this->session->flashdata('alert_class');
		if ($alert_msg && $alert_class) {
			$data['alert_msg'] = $alert_msg;
			$data['alert_class'] = $alert_class;
		}
		load_main_template('Pendaftaran Poliklinik', 'Pendaftaran Poliklinik', 'pendaftaran_poli', $data, 1);
	}

	public function daftar_poli() {
		$this->load->model('pasien_irj');
		//nama field tabel => nama field di post
		$data = array(
			'NO_MEDREC' => 'no_cm',
			'NAMA' => 'nama',
			'SEX' => 'sex',
			'TMPT_LAHIR' => 'tempat_lahir',
			'ALAMAT' => 'alamat',
			'ID_DAERAH' => 'id_daerah',
			'PENDIDIKAN' => 'pendidikan',
			'PEKERJAAN' => 'pekerjaan',
			'AGAMA' => 'agama',
			'STATUS' => 'status',
			'WNEGARA' => 'kwn',
			'UMUR' => 'usia_tahun',
			'UBULAN' => 'usia_bulan',
			'RT' => 'rt',
			'RW' => 'rw',
			'GOLDARAH' => 'gol_darah',
			'NO_ASURANSI' => 'no_bpjs',
			'ID_DESA' => 'id_desa',
			'ID_KECAMATAN' => 'id_kecamatan',
			'NAMA_KEL' => 'nama_kel',
			'TEMPAT_KARTU' => 'tempat_kartu'
		);
		//ambil nilai dari post
		foreach ($data as $key => $value) {
			$data[$key] = $this->input->post($value);
		}
		//buat string tanggal lahir
		$string_tanggal = '';
		$tanggal = intval($this->input->post('tanggal_lahir'));
		if ($tanggal < 10) {
			$string_tanggal .= '0';
		}
		$string_tanggal .= $tanggal . '-';
		$bulan = intval($this->input->post('bulan_lahir'));
		if ($bulan < 10) {
			$string_tanggal .= '0';
		}
		$string_tanggal .= $bulan . '-' . intval($this->input->post('tahun_lahir'));
		$data['TGL_LAHIR'] = "TO_DATE('". $string_tanggal ."', 'DD-MM-YYYY')";
		//selesai buat string tanggal lahir

		//field yang belum ada:
		//kecamatan, kelurahan, kotakab

		if ($this->pasien_irj->cek_no_medrec($data['NO_MEDREC'])) {
			if ($this->pasien_irj->update($data)) {
				$this->session->set_flashdata('alert_msg', 'Sukses mendaftarkan pasien');
				$this->session->set_flashdata('alert_class', 'alert-success');
			}
			else {
				$this->session->set_flashdata('alert_msg', 'Gagal mendaftarkan pasien');
				$this->session->set_flashdata('alert_class', 'alert-danger');
			}
		}
		else {
			if ($this->pasien_irj->insert($data)) {
				$this->session->set_flashdata('alert_msg', 'Sukses mendaftarkan pasien');
				$this->session->set_flashdata('alert_class', 'alert-success');
			}
			else {
				$this->session->set_flashdata('alert_msg', 'Gagal mendaftarkan pasien');
				$this->session->set_flashdata('alert_class', 'alert-danger');
			}
		}
		redirect(base_url() . 'pendaftaran/index');
	}

}

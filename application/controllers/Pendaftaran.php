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
		$this->load->model('daerah');
      $this->load->model('pasien_irj');
      
		$data['agama'] = $this->agama->get();
		$data['pendidikan'] = $this->pendidikan->get();

		$data['kabupaten'] = '[';
		foreach($this->daerah->get_kabupaten() as $k) {
			$data['kabupaten'] .= '[\'' . $k->ID_DAERAH . '\',\''. $k->NAMA_DAERAH . '\'],';
		}
		$data['kabupaten'] = substr($data['kabupaten'], 0, -1) . ']';

		$data['kecamatan'] = '[';
		foreach($this->daerah->get_kecamatan() as $k) {
			$data['kecamatan'] .= '[\'' . $k->ID_KECAMATAN . '\',\''. $k->NAMA_KECAMATAN . '\',\'' . $k->ID_DAERAH . '\'],';
		}
		$data['kecamatan'] = substr($data['kecamatan'], 0, -1) . ']';

		$data['kelurahan'] = '[';
		foreach($this->daerah->get_kelurahan() as $k) {
			$data['kelurahan'] .= '[\'' . $k->ID_DESA . '\',\''. $k->NAMA_DESA . '\',\'' . $k->ID_KECAMATAN . '\'],';
		}
		$data['kelurahan'] = substr($data['kelurahan'], 0, -1) . ']';
		
      $data['no_cm'] = sprintf("%'.010d", $this->pasien_irj->get_new_medrec());
      
		$alert_msg = $this->session->flashdata('alert_msg');
		$alert_class = $this->session->flashdata('alert_class');
		if ($alert_msg && $alert_class) {
			$data['alert_msg'] = $alert_msg;
			$data['alert_class'] = $alert_class;
		}
		load_main_template('Registrasi Pasien', 'Registrasi Pasien', 'registrasi_pasien', $data, 1);
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
         'UHARI' => 'usia_hari',
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
      
      //ubah umur jadi numerik
      $data['UMUR'] = intval($data['UMUR']);
      $data['UBULAN'] = intval($data['UBULAN']);
      $data['UHARI'] = intval($data['UHARI']);
      
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
				$this->session->set_flashdata('alert_msg', 'Berhasil menyimpan data pasien');
				$this->session->set_flashdata('alert_class', 'alert-success');
			}
			else {
				$this->session->set_flashdata('alert_msg', 'Gagal menyimpan data pasien');
				$this->session->set_flashdata('alert_class', 'alert-danger');
			}
		}
		else {
			if ($this->pasien_irj->insert($data)) {
				$this->session->set_flashdata('alert_msg', 'Berhasil menyimpan data pasien baru');
				$this->session->set_flashdata('alert_class', 'alert-success');
			}
			else {
				$this->session->set_flashdata('alert_msg', 'Gagal menyimpan data pasien baru');
				$this->session->set_flashdata('alert_class', 'alert-danger');
			}
		}
		redirect(base_url() . 'pendaftaran/index');
	}

}

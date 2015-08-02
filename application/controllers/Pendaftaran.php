<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function index()
	{
		$this->load->model('agama');
		$this->load->model('pendidikan');
		$data['agama'] = $this->agama->get();
		$data['pendidikan'] = $this->pendidikan->get();
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
		//field yang nggak ada:
		// tgl_lahir, kecamatan, kelurahan, kotakab
		foreach ($data as $key => $value) {
			$data[$key] = $this->input->post($value);
		}

		if ($this->pasien_irj->cek_no_medrec($data['no_medrec'])) {

		}
	}

}

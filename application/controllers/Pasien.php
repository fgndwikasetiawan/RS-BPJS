<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->session->has_userdata('username')) {
			redirect(base_url() . 'Auth');
		}
	}

	public function index(){
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
		load_main_template('Registrasi Pasien', 'Registrasi Pasien', 'registrasi_pasien', $data, 1);
	}
        
	public function simpan_pasien() {
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
			'ID_DAERAH' => 'id_daerah',
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

		if ($this->pasien_irj->cek_no_medrec($data['NO_MEDREC'])) {
			//Kalau no medrec sudah ada, maka lakukan update
			if ($this->pasien_irj->update($data)) {
				alert_success('Berhasil menyimpan data pasien');
				redirect(base_url() . 'rawat_jalan/form/medrec/' . $data['NO_MEDREC']);	
			}
			else {
				alert_fail('Gagal menyimpan data pasien');
				redirect(base_url() . 'pasien');	
			}
		}
		else {
			//Selain itu lakukan insert pasien baru
			if ($this->pasien_irj->insert($data)) {
				alert_success('Berhasil menyimpan data pasien baru');
				redirect(base_url() . 'rawat_jalan/form/medrec/' . $data['NO_MEDREC']);	
			}
			else {
				alert_fail('Gagal menyimpan data pasien baru');
				redirect(base_url() . 'pasien');	
			}
		}
	}
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

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
      
		$alert_msg = $this->session->flashdata('alert_msg');
		$alert_class = $this->session->flashdata('alert_class');
		if ($alert_msg && $alert_class) {
			$data['alert_msg'] = $alert_msg;
			$data['alert_class'] = $alert_class;
		}
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
				redirect(base_url() . 'pendaftaran/histori_pasien/medrec/' . $data['NO_MEDREC']);	
			}
			else {
				$this->session->set_flashdata('alert_msg', 'Gagal menyimpan data pasien');
				$this->session->set_flashdata('alert_class', 'alert-danger');
				redirect(base_url() . 'pendaftaran/index');	
			}
		}
		else {
			if ($this->pasien_irj->insert($data)) {
				$this->session->set_flashdata('alert_msg', 'Berhasil menyimpan data pasien baru');
				$this->session->set_flashdata('alert_class', 'alert-success');
				redirect(base_url() . 'pendaftaran/histori_pasien/medrec/' . $data['NO_MEDREC']);	
			}
			else {
				$this->session->set_flashdata('alert_msg', 'Gagal menyimpan data pasien baru');
				$this->session->set_flashdata('alert_class', 'alert-danger');
				redirect(base_url() . 'pendaftaran/index');
			}
		}
	}
	
	public function daftar_poli() {
		load_main_template('Pendaftaran Poliklinik', 'Pendaftaran Poliklinik', 'pendaftaran_poli', null, 2);
	}

	function daftar_ulang($data){
		if ($this->input->post('no_cm') === null) {
			redirect(base_url() . 'pendaftaran/daftar_poli');
		}

		$this->load->model('daftar_ulang');
		$data = array(
			'NO_MEDREC' => 'no_cm',
			'NPEMBAYAR' => 'npembayar',
			'KETPEMBAYAR' => 'ketpembayar',
			'CARA_KUNJ' => 'cara_kunj',
			'KELAS' => 'kelas',
			'ID_KONTRAKTOR' => 'nm_perusahaan',
			'CARA_BAYAR' => 'cara_bayar',
			'ID_POLI' => 'nm_poli',
			'ANAMNESA' => 'anamnesa',
			'ID_DIAGNOSA' => 'nm_diagnosa'
			);
		foreach ($data as $key => $value) {
			$data[$key] = $this->input->post($value);
		}
		$this->daftar_ulang->insert($data);
	}

	public function histori_pasien($tipe, $nomor){		
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
			redirect(base_url() . 'pendaftaran/daftar_poli');
			//set flash data
		}


		$data['no_cm'] = $result->NO_MEDREC;
		$data['nama'] = $result->NAMA;
		$data['usia'] = $result->UMUR;
		$data['sex'] = $result->SEX;
		$data['no_bpjs'] = $result->NO_ASURANSI;
		$data['tgl_lahir'] = $result->TGL_LAHIR;
		// $data['pisa'] = $result->PISA;
		// $data['tgl_cetak'] = $result->KELAS_PASIEN;
		// $data['jenis_peserta'] = $result->ID_POLI;
		// $data['hak_kelas'] = $result->CARA_KUNJ;

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

		load_main_template('Pendaftaran Poliklinik', 'Pendaftaran Poliklinik', 'pendaftaran_poli', $data, 2);
		
	}

	public function cetak_sep() {
		require(getenv('DOCUMENT_ROOT') . '/assets/Surat.php');
		$surat = new Surat();
		$fields = array(
				'No. SEP' => $this->input->post('no_sjp'),
				'Tgl. SEP' => date('d-m-Y'),
				'No. Kartu' => $this->input->post('input_no_bpjs'),
				'Peserta' => $this->input->post('ketpembayar'),
				'Nama Peserta' => $this->input->post('input_nama'),
				'Tgl. Lahir' => $this->input->post('input_tgl_lahir'),
				'Jenis Kelamin' => $this->input->post('input_sex'),
				'Poli Tujuan' => $this->input->post('input_nama_poli'),
				'Kelas Rawat' => $this->input->post('kelas'),
				'Diagnosa Awal' => $this->input->post('nm_diagnosa')
			); 
		$surat->set_nilai($fields);
		$surat->cetak();
	}
}

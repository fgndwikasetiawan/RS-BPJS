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
		if (($tipe != 'medrec' && $tipe != 'ktp') || (!$nomor || $nomor == '')) {
			load_main_template('Pendaftaran Rawat Jalan', 'Pendaftaran Rawat Jalan', 'rawat_jalan', null, 2);	
		}
		else {
			$this->load->model('pasien_irj');
			$this->load->model('r_jalan');
			$this->load->model('cara_bayar');
			$this->load->model('cara_berkunjung');
			$this->load->model('kontraktor');
			$this->load->model('poliklinik');
			
			$result = null;
			if($tipe == 'medrec'){
				$result = $this->pasien_irj->cari_by_medrec($nomor);
			}

			else if ($tipe == 'ktp') {
				$result = $this->pasien_irj->cari_by_ktp($nomor);
			}
			
			if ($result == null) {
				alert_fail('Pasien tidak ditemukan');
				redirect(base_url() . 'rawat_jalan/form');
			}
			
			$data['no_cm'] = $result->NO_MEDREC;
			$data['nama'] = $result->NAMA;
			$data['sex'] = $result->SEX;
			$data['no_bpjs'] = $result->NO_ASURANSI;
			$data['usia'] = $result->UMUR;
			$tgl_lahir = $result->TGL_LAHIR;
			$data['tgl_lahir'] = $tgl_lahir;
			if ($tgl_lahir != '') {				
				$tgl_lahir_exploded = explode('-', $tgl_lahir);
				$usia = hitung_umur(intval($tgl_lahir_exploded[0]), intval($tgl_lahir_exploded[1]), intval($tgl_lahir_exploded[2]));
				$data['usia'] = $usia['tahun'] . ' tahun ' . $usia['bulan'] . ' bulan ' . $usia['hari'] . ' hari';
				//update usia pasien
				$data_update = ['NO_MEDREC' => $result->NO_MEDREC, 'UMUR' => $usia['tahun'], 'UBULAN' => $usia['bulan'], 'UHARI' => $usia['hari']];
				$this->pasien_irj->update($data_update);
				//selesai update usia pasien
			}
			
			$query = $this->r_jalan->get_historis($result->NO_MEDREC);
			$data['historis'] = $query;
	
			$query = $this->poliklinik->get_poli();
			$data['poli'] = $query;
	
			$query = $this->cara_berkunjung->get_cara_kunj();
			$data['kunj'] = $query;
	
			$query = $this->cara_bayar->get_cara_bayar();
			$data['bayar'] = $query;
	
			$query = $this->kontraktor->get_kontraktor();
			$data['perusahaan'] = $query;

			load_main_template('Pendaftaran Rawat Jalan', 'Pendaftaran Rawat Jalan', 'rawat_jalan', $data, 2);
		}
	}
	
	public function submit() {
		if (!$this->input->post('no_cm')) {
			redirect(base_url() . 'rawat_jalan/form');
		}
		if (!$this->input->post('no_register')) {
			alert_fail('Gagal menyimpan data: No. Register tidak boleh kosong');
			redirect(base_url() . 'rawat_jalan/form/medrec/' . $this->input->post('no_cm'));
		}
		$this->load->model('r_jalan');
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
			'ID_DIAGNOSA' => 'id_diagnosa',
			'NAMA' => 'input_nama',
			'CATATAN' => 'catatan',
			'NO_SEP' => 'no_sep'
			);

		foreach ($data as $key => $value) {
			$data[$key] = $this->input->post($value);
		}
		if ($this->r_jalan->insert($data)) {
			alert_success('Berhasil melakukan pendaftaran');
		}
		else {
			alert_fail('Gagal melakukan pendaftaran');
		}
		redirect(base_url().'rawat_jalan/form/medrec/' . $data['NO_MEDREC']);
	}

	public function cetak_sep2($noreg_rj) {
		require(getenv('DOCUMENT_ROOT') . '/assets/Surat.php');
		$surat = new Surat();
		$this->load->model('r_jalan');
		$entri_rj = $this->r_jalan->get_entri($noreg_rj);
		
		if (!$entri_rj) {
			return;
		}
		
		$this->load->model('pasien_irj');
		$pasien = $this->pasien_irj->cari_by_medrec($entri_rj->NO_MEDREC);
		if (!$pasien) {
			return;
		} 
		
		$this->load->model('ppk');
		$ppk = $this->ppk->get_data($entri_rj->KD_PPK);
		if ($ppk) {
			$ppk = $ppk->NM_PPK;
		}
		else {
			$ppk = $entri_rj->KD_PPK;
		}
		
		$fields = array(
				'No. SEP' => $entri_rj->NO_SEP,
				'Tgl. SEP' => date('d/m/Y'),
				'No. Kartu' => $pasien->NO_ASURANSI,
				'Peserta' => '',
				'Nama Peserta' => $entri_rj->NAMA,
				'Tgl. Lahir' => $pasien->TGL_LAHIR,
				'Jenis Kelamin' => $pasien->SEX,
				'Asal Faskes' => $ppk,
				'Poli Tujuan' => $entri_rj->NM_POLI,
				'Kelas Rawat' => $entri_rj->KELAS_PASIEN,
				'Jenis Rawat' => 'Rawat Jalan',
				'Diagnosa Awal' => $entri_rj->ID_DIAGNOSA,
				'Catatan' => $entri_rj->CATATAN
			); 
		$surat->set_nilai($fields);
		$surat->cetak();
	}
	
	public function hapus_entri($no_cm, $no_reg) {
		$this->load->model('r_jalan');
		$this->r_jalan->hapus($no_reg);
		redirect(base_url() . 'rawat_jalan/form/medrec/' . $no_cm);
	}
}
?>

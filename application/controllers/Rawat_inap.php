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
		if (($tipe != 'reg_irj' && $tipe != 'ipd' && $tipe != 'medrec') || (!$nomor || $nomor == '')) {
			load_main_template('Pendaftaran Rawat Inap', 'Pendaftaran Rawat Inap', 'rawat_inap', null, 3);	
		}
		else {
			$data_pasien = null;
			if ($tipe == 'medrec') {
				$this->load->model('pasien_irj');
				$data_pasien = $this->pasien_irj->cari_by_medrec($nomor);
			}
			else if ($tipe == 'reg_irj') {
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
			$this->load->model('kelas');
			$this->load->model('bed');
			$this->load->model('smf');
			
			$data['dokter'] = $this->dokter->get_dokter();
			$data['kontraktor'] = $this->kontraktor->get_kontraktor();
			$data['cara_bayar'] = $this->cara_bayar->get_cara_bayar();
			$data['cara_masuk'] = $this->cara_masuk->get_cara_masuk();
			$data['ruang_rawat'] = $this->ruang_rawat->get_ruang_rawat();
			$data['kelas'] = $this->kelas->get_kelas();
			$data['bed'] = $this->bed->get_bed();
			$data['smf'] = $this->smf->get_smf();
			
			if ($tipe == 'ipd') { 
				$data['ruang_iri'] = $this->ruang_iri->get_entri_by_ipd($nomor);
			}
			$tgl_lahir = $data_pasien->TGL_LAHIR;
			if ($tgl_lahir != '') {
				$tgl_lahir_exploded = explode('-', $tgl_lahir);
				$usia = hitung_umur(intval($tgl_lahir_exploded[0]), intval($tgl_lahir_exploded[1]), intval($tgl_lahir_exploded[2]));
				$data_pasien->UMUR = $usia['tahun'] . ' tahun ' . $usia['bulan'] . ' bulan ' . $usia['hari'] . ' hari';
				//update usia pasien
				$data_update = ['NO_MEDREC' => $data_pasien->NO_MEDREC, 'UMUR' => $usia['tahun'], 'UBULAN' => $usia['bulan'], 'UHARI' => $usia['hari']];
				$this->pasien_irj->update($data_update);
				//selesai update usia pasien
			}
			$data['pasien'] = $data_pasien;
			
			load_main_template('Pendaftaran Rawat Inap', 'Pendaftaran Rawat Inap', 'rawat_inap', $data, 3);
		}
	}
	
	public function submit() {
		if (!$this->input->post('no_ipd')) {
			alert_fail('Gagal menyimpan entri: No. IPD tidak boleh kosong');
			redirect(base_url() . 'rawat_inap/form/reg_irj/' . $this->input->post('noregasal'));
		}
		$this->load->model('pasien_iri');
		$data = [
			'NO_CM' => 'no_cm',
			'NAMA' => 'nama',
			'NOREGASAL' => 'noregasal',
			'NO_IPD' => 'no_ipd',
			'NOIPDIBU' => 'noipdibu',
			'ID_SMF' => 'id_smf',
			'CARABAYAR' => 'carabayar',
			'CARAMASUK' => 'caramasuk',
			'NOSJP' => 'nosjp',
			'ID_KONTRAKTOR' => 'id_kontraktor',
			'NOPEMBAYARRI' => 'nopembayarri',
			'NO_SEP' => 'no_sep',
			'NMPEMBAYARRI' => 'nmpembayarri',
			'KETPEMBAYARRI' => 'ketpembayarri',
			'GOLPEMBAYARRI' => 'golpembayarri',
			'JATAHKLSIRI' => 'jatahklsiri',
			'NMPJAWABRI' => 'nmpjawabri',
			'ALAMATPJAWABRI' => 'alamatpjawabri',
			'NOTLPPJAWAB' => 'notlppjawab',
			'KARTUIDPJAWAB' => 'kartuidpjawab',
			'NOIDPJAWAB' => 'noidpjawab',
			'HUBPJAWABRI' => 'hubpjawabri',
			'IDRG' => 'idrg',
			'KLSIRI' => 'kelas'
		];
		foreach($data as $key => $value) {
			$data[$key] = $this->input->post($value);
		}
		$data['TGLDAFTARRI'] = "TO_DATE('" . $this->input->post('tgldaftarri') . "', 'DD/MM/YYYY')";
		$id_dokter = $this->input->post('id_dokter');
		if ($id_dokter != 'null') {
			$data['ID_DOKTER'] = $this->input->post('id_dokter');
		}
		
		if ($this->pasien_iri->insert_or_update($data)) {
			//Berhasil menyimpan entri pasien_iri, sekarang simpan entri ruang_iri
			if ($this->input->post('tglmasukrg')) {
				$data_ruang_iri = [
					'NO_IPD' => 'no_ipd',
					'IDRG' => 'idrg',
					'KELAS' => 'kelas',
					'BED' => 'bed',
					'NOMEDREC' => 'no_cm',
					'ID_DOKTER' => 'id_dokter'
				];
				foreach($data_ruang_iri as $key => $value) {
					$data_ruang_iri[$key] = $this->input->post($value);
				}
				$data_ruang_iri['TGLMASUKRG'] = "TO_DATE('" . $this->input->post('tglmasukrg') . "', 'DD/MM/YYYY')";
				if ($this->input->post('noregasal') != '') {
					$data_ruang_iri['STATMASUKRG'] = 'Pindahan';
				}
				else {
					$data_ruang_iri['STATMASUKRG'] = 'Asal';
				}
				$this->load->model('ruang_iri');
				if ($this->ruang_iri->insert($data_ruang_iri)) {
					alert_success('Berhasil menyimpan entri pasien rawat inap');
					redirect(base_url() . 'rawat_inap/form/ipd/' . $data_ruang_iri['NO_IPD']);	
				}	
				else {
					alert_fail('Gagal menyimpan entri');
					redirect(base_url() . 'rawat_inap/form/ipd/' . $data_ruang_iri['NO_IPD']);
				}
			}
			else {
				alert_success('Berhasil menyimpan entri pasien rawat inap');
				redirect(base_url() . 'rawat_inap/form/ipd/' . $data['NO_IPD']);
			}
		}
		else {
			alert_fail('Gagal menyimpan entri');
			redirect(base_url() . 'rawat_inap/form/reg_irj/' . $this->input->post('noregasal'));
		}
	}
	
	public function hapus_entri_ruang($ipd, $tglmasuk, $idrg) {
		$this->load->model('ruang_iri');
		$this->ruang_iri->hapus($ipd, $tglmasuk, $idrg);
	} 
	
	public function cetak_sep($ipd) {
		require(getenv('DOCUMENT_ROOT') . '/assets/Surat.php');
		$surat = new Surat();
		$entri_rj = null;
		$ppk = '';
		
		//load entri pasien_iri
		$this->load->model('pasien_iri');
		$entri_ri = $this->pasien_iri->get_pasien($ipd);
		if (!$entri_ri) {
			return;
		}
		
		//load entri pasien (by medrec) untuk dapat no bpjs dan nama
		$this->load->model('pasien_irj');
		$pasien = $this->pasien_irj->cari_by_medrec($entri_ri->NO_CM);
		if (!$pasien) {
			return;
		} 

		//jika ada noregasal (dari rawat jalan) ambil entri rawat jalannya
		if ($entri_ri->NOREGASAL) { 
			$this->load->model('r_jalan');
			$entri_rj = $this->r_jalan->get_entri($entri_ri->NOREGASAL);
			//load juka ppk rujukan
			if ($entri_rj) {
				$this->load->model('ppk');
				$ppk = $this->ppk->get_data($entri_rj->KD_PPK);
				if ($ppk) {
					$ppk = $ppk->NM_PPK;
				}
				else {
					$ppk = '';
				}
			}
		}
		
		//load entri ruang untuk ambil nama ruang
		$this->load->model('ruang');
		$ruang = $this->ruang->get_ruang_by_idrg($entri_ri->IDRG);
		if ($ruang) {
			$ruang = $ruang->NMRUANG;
		}
		
		
		$fields = array(
				'No. SEP' => $entri_ri->NO_SEP,
				'Tgl. SEP' => date('d/m/Y'),
				'No. Kartu' => $pasien->NO_ASURANSI,
				'Peserta' => '',
				'Nama Peserta' => $pasien->NAMA,
				'Tgl. Lahir' => $pasien->TGL_LAHIR,
				'Jenis Kelamin' => $pasien->SEX,
				'Asal Faskes' => $ppk,
				'Poli Tujuan' => $ruang,
				'Kelas Rawat' => $entri_rj ? $entri_rj->KELAS_PASIEN : '',
				'Jenis Rawat' => 'Rawat Inap',
				'Diagnosa Awal' => $entri_rj ? $entri_rj->ID_DIAGNOSA : '',
				'Catatan' => $entri_rj ? $entri_rj->CATATAN : ''
			); 
		$surat->set_nilai($fields);
		$surat->cetak();
	}
}
?>

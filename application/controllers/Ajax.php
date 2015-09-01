<?php
   defined('BASEPATH') OR exit('No direct script access allowed');

   class Ajax extends CI_Controller {

      public function __construct() {
      	parent::__construct();
      	if (!$this->session->has_userdata('username')) {
      		set_status_header(401);
            echo "Error 401: Unauthorized";
      	}
      }

      public function data_pasien_by_medrec($no_medrec) {
         $this->load->model('pasien_irj');
         $data_pasien = $this->pasien_irj->cari_by_medrec($no_medrec);
         echo json_encode($data_pasien);
      }

      public function data_pasien_by_bpjs($no_bpjs) {
         $this->load->model('pasien_irj');
         $data_pasien = $this->pasien_irj->cari_by_bpjs($no_bpjs);
         echo json_encode($data_pasien);
      }

      public function data_pasien_by_ktp($no_ktp) {
         $this->load->model('pasien_irj');
         $data_pasien = $this->pasien_irj->cari_by_ktp($no_ktp);
         echo json_encode($data_pasien);
      }

      public function daerah_by_id_desa($id_desa) {
         $this->load->model('daerah');
         $daerah = $this->daerah->cari_by_id_desa($id_desa);
         echo json_encode($daerah);
      }

      public function daerah_by_id_kecamatan($id_kecamatan) {
         $this->load->model('daerah');
         $daerah = $this->daerah->cari_by_id_kecamatan($id_kecamatan);
         echo json_encode($daerah);
      }
      
      public function data_ppk($kd_ppk) {
         $this->load->model('ppk');
         $data_ppk = json_encode($this->ppk->get_data($kd_ppk));
         echo $data_ppk;
      }
      
      
      //Memanggil webservice buat SEP dengan parameter-parameter yang diberikan
      //method: POST
      public function buat_SEP() {
         $timezone = date_default_timezone_get();
         date_default_timezone_set('UTC');
         $timestamp = strval(time()-strtotime('1970-01-01 00:00:00')); //cari timestamp
         $signature = hash_hmac('sha256', '27952' . '&' . $timestamp, 'rsm32h1', true);
         $encoded_signature = base64_encode($signature);
         $http_header = array(
               'Accept: application/json', 
               'Content-type: application/xml',
               'X-cons-id: 27952', //id rumah sakit
               'X-timestamp: ' . $timestamp,
               'X-signature: ' . $encoded_signature
         );
         date_default_timezone_set($timezone);
         //nama variabel sesuai dengan nama di xml
         $noMR = $this->input->post('no_cm');
         $noKartu = $this->input->post('no_bpjs');
         $noRujukan = $this->input->post('no_sjp');
         $ppkRujukan = $this->input->post('ppk_rujukan');
         $jnsPelayanan = $this->input->post('pelayanan');
         $klsRawat = $this->input->post('kelas_pasien');
         $diagAwal = $this->input->post('nm_diagnosa');
         $poliTujuan = $this->input->post('nm_poli');
         $catatan = $this->input->post('catatan');
         $user = 'Administrator';
         $ppkPelayanan = '0601R001';
         $tglSep = date('Y-m-d H:i:s');
         $tglRujukan = date('Y-m-d H:i:s');
         $data = '<request><data><t_sep>'.
                        '<noKartu>' . $noKartu . '</noKartu>'.
                        '<tglSep>' . $tglSep . '</tglSep>'.
                        '<tglRujukan>' . $tglRujukan . '</tglRujukan>'.
                        '<noRujukan>' . $noRujukan . '</noRujukan>'.
                        '<ppkRujukan>' . $ppkRujukan . '</ppkRujukan>'.
                        '<ppkPelayanan>' . $ppkPelayanan . '</ppkPelayanan>'.
                        '<jnsPelayanan>' . $jnsPelayanan . '</jnsPelayanan>'.
                        '<catatan>' . $catatan . '</catatan>'.
                        '<diagAwal>' . $diagAwal . '</diagAwal>'.
                        '<poliTujuan>' . $poliTujuan . '</poliTujuan>'.
                        '<klsRawat>' . $klsRawat . '</klsRawat>'.
                        '<user>' . $user . '</user>'.
                        '<noMR>' . $noMR . '</noMR>'.
                    '</t_sep></data></request>';
         $ch = curl_init('http://api.asterix.co.id/SepWebRest/sep/create/');
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $result = curl_exec($ch);
         curl_close($ch);
         $sep = json_decode($result)->response;
         echo $sep;
      }

      public function new_no_medrec() {
         $this->load->model('pasien_irj');
         $medrec = $this->pasien_irj->get_new_medrec();
         echo $medrec;
      }

      public function new_no_regrj() {
         $this->load->model('r_jalan');
         $noreg = $this->r_jalan->get_new_noreg();
         echo $noreg;
      }
      
      public function new_no_ipd() {
         $this->load->model('pasien_iri');
         $noipd = $this->pasien_iri->get_new_noipd();
         echo $noipd;
      }

      public function foo() {
         echo 'FOO!';
      }

      public function bar() {
         $this->load->view('foobar');
      }
      
      public function baz() {
         $post = $this->input->post();
         var_dump($post);
      }
   }
?>

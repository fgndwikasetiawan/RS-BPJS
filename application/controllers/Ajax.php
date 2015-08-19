<?php
   defined('BASEPATH') OR exit('No direct script access allowed');

   class Ajax extends CI_Controller {

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
      
      
      //Memanggil webservice buat SEP dengan parameter-parameter yang diberikan
      //method: POST
      public function buat_SEP() {
         $timezone = date_default_timezone_get();
         date_default_timezone_set('UTC');
         $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
         $signature = hash_hmac('sha256', '27952' . '&' . $timestamp, 'rsm32h1', true);
         $encoded_signature = base64_encode($signature);
         $http_header = array(
               'Accept: application/json', 
               'Content-type: application/xml',
               'X-cons-id: 27952',
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
         $tglSep = date('Y-M-d H:i:s');
         $tglRujukan = date('Y-M-d H:i:s');
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
         echo $result;
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

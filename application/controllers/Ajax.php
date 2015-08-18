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
         $http_header = array(
               'Accept: application/json', 
               'Content-type: application/xml',
               'X-cons-id: ?',
               'X-timestamp: ' . $timestamp,
               'X-signature: ?'
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
            $timezone = date_default_timezone_get();
            date_default_timezone_set('UTC');
            $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
            $http_header = array(
                  'Accept: application/json', 
                  'Content-type: application/xml',
                  'X-cons-id: 743627386',
                  'X-timestamp: ' . $timestamp,
                  'X-signature: DogC5UiQurNcigrBdQ3QN5oYvXeUF5E82I/LHUcI9v0='
            );
            date_default_timezone_set($timezone);
            $data = '<request><data><t_sep>'.
                        '<noKartu>' . '1234567890123' . '</noKartu>'.
                        '<tglSep>' . date('Y-M-d H:i:s') . '</tglSep>'.
                        '<tglRujukan>' . date('Y-M-d H:i:s') . '</tglRujukan>'.
                        '<noRujukan>' . '1234590000300003' . '</noRujukan>'.
                        '<ppkRujukan>' . '09010100' . '</ppkRujukan>'.
                        '<ppkPelayanan>' . '0901R001' . '</ppkPelayanan>'.
                        '<jnsPelayanan>' . '1' . '</jnsPelayanan>'.
                        '<catatan>' . 'halo' . '</catatan>'.
                        '<diagAwal>' . 'B010' . '</diagAwal>'.
                        '<poliTujuan>' . 'SAR' . '</poliTujuan>'.
                        '<klsRawat>' . '2' . '</klsRawat>'.
                        '<user>' . 'JD' . '</user>'.
                        '<noMR>' . '1234' . '</noMR>'.
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

      public function bar() {
         $this->load->view('foobar');
      }
      
      public function baz() {
         $post = $this->input->post();
         var_dump($post);
      }
   }
?>

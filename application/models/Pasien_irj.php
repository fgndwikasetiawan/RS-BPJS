<?php
   class Pasien_irj extends CI_Model {
      public function __construct() {
         parent::__construct();
      }

      /**
      *   Mencari data pasien berdasarkan no_medrec.
      */
      public function cari_by_medrec($no_medrec) {
         $this->db->where('NO_MEDREC', $no_medrec);
         $this->db->select('NO_MEDREC, NAMA, TMPT_LAHIR, TO_CHAR(TGL_LAHIR, \'DD-MM-YYYY\') TGL_LAHIR,
                           NAMA_KEL, AGAMA, ALAMAT, STATUS,
                           GOLDARAH, RT, RW, ID_DESA, ID_KECAMATAN, ID_DAERAH,
                           KECAMATAN, KELURAHAN, KOTAKAB, PENDIDIKAN, PEKERJAAN,
                           NO_ASURANSI, SEX, WNEGARA, TEMPAT_KARTU, UMUR');
         $query = $this->db->get('PASIEN_IRJ');
         return $query->row();
      }

      /**
      *   Mencari data pasien berdasarkan no_bpjs.
      */
      public function cari_by_bpjs($no_bpjs) {
         $this->db->where('NO_ASURANSI', $no_bpjs);
         $this->db->select('NO_MEDREC, NAMA, TMPT_LAHIR, TO_CHAR(TGL_LAHIR, \'DD-MM-YYYY\') TGL_LAHIR,
                           NAMA_KEL, AGAMA, ALAMAT, STATUS,
                           GOLDARAH, RT, RW, ID_DESA, ID_KECAMATAN, ID_DAERAH,
                           KECAMATAN, KELURAHAN, KOTAKAB, PENDIDIKAN, PEKERJAAN,
                           NO_ASURANSI, SEX, WNEGARA, TEMPAT_KARTU, UMUR');
         $query = $this->db->get('PASIEN_IRJ');
         return $query->row();
      }

      public function insert($data) {
         $this->db->set('TGL_DAFTAR', 'SYSDATE', false);
         $this->db->set('TGL_LAHIR', $data['TGL_LAHIR'], false);
         unset($data['TGL_LAHIR']);
         if (!$this->db->insert('PASIEN_IRJ', $data)) {
            return false;
         };
         return true;
      }

      public function update($data) {
         $no_medrec = $data['NO_MEDREC'];
         $this->db->where('NO_MEDREC', $no_medrec);
         unset($data['NO_MEDREC']);
         $this->db->set('TGL_LAHIR', $data['TGL_LAHIR'], false);
         unset($data['TGL_LAHIR']);
         if (!$this->db->update('PASIEN_IRJ', $data)) {
            return false;
         };
         return true;
      }

      /**
      *  Mengecek apakah $no_medrec ada dalam database
      *  return:
      *           -true jika ada
      *           -false jika tidak ada
      */
      public function cek_no_medrec($no_medrec) {
         $this->db->where('NO_MEDREC', $no_medrec);
         $query = $this->db->get('PASIEN_IRJ');
         if ($query->num_rows() > 0) {
            return true;
         }
         else {
            return false;
         }
      }
      
      public function get_new_medrec() {
         $query = $this->db->query('select s_medrec.nextval from dual');
         $result = $query->row();
         $medrec = sprintf("%'.010d", $result->NEXTVAL);
         return $medrec;
      }

   }
 ?>

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
                           NO_ASURANSI, SEX, WNEGARA, TEMPAT_KARTU');
         $query = $this->db->get('PASIEN_IRJ');
         return $query->row();
      }

      public function insert($data) {
         $this->db->insert('PASIEN_IRJ', $obj);
      }

      public function update($data) {
         $this->db->where('no_medrec', $data['no_medrec']);
         $this->db->update('PASIEN_IRJ', $data);
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

   }
 ?>

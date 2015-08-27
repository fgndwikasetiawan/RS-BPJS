<?php
   class Daerah extends CI_Model {
      public function __construct() {
         parent::__construct();
      }

      //Tidak dipakai
      public function cari_by_id_kecamatan($id_kecamatan) {
         $this->db->where('ID_KECAMATAN', $id_kecamatan);
         $query = $this->db->get('KECAMATAN');
         $kecamatan = $query->row();
         return $kecamatan;
      }

      //Tidak dipakai
      public function cari_by_id_desa($id_desa) {
         $this->db->where('ID_DESA', $id_desa);
         $query = $this->db->get('DESAKELURAHAN');
         $desa = $query->row();
         $kecamatan = $this->cari_by_id_kecamatan($desa->ID_KECAMATAN);
         $daerah = (object) array(
            'ID_DESA' => $desa->ID_DESA,
            'ID_KECAMATAN' => $kecamatan->ID_KECAMATAN,
            'NAMA_DESA' => $desa->NAMA_DESA,
            'NAMA_KECAMATAN' => $kecamatan->NAMA_KECAMATAN
         );
         return $daerah;
      }

      public function get_kabupaten() {
         $this->db->where('ID_DAERAH !=', '9999');
         $this->db->order_by('NAMA_DAERAH', 'ASC');
         $query = $this->db->get('KABUPATENKOTA');
         return $query->result();
      }

      public function get_kecamatan() {
         $this->db->where('ID_KECAMATAN !=', '9999');
         $this->db->order_by('NAMA_KECAMATAN', 'ASC');
         $query = $this->db->get('KECAMATAN');
         return $query->result();
      }

      public function get_kelurahan() {
         $this->db->where('ID_KECAMATAN !=', '9999');
         $this->db->order_by('NAMA_DESA', 'ASC');
         $query = $this->db->get('DESAKELURAHAN');
         return $query->result();
      }
   }
 ?>

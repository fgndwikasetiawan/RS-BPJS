<?php
   class Pendidikan extends CI_Model {
      public function __construct() {
         parent::__construct();
      }

      public function get() {
         $pendidikan = array('SD', 'SLTP', 'SLTA', 'SARJANA');
         return $pendidikan;
      }

   }
 ?>

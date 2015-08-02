<?php
   class Agama extends CI_Model {
      public function __construct() {
         parent::__construct();
      }

      public function get() {
         $agama = array('ISLAM', 'KRISTEN PROTESTAN', 'KATOLIK', 'BUDHA', 'HINDU', 'KONG HU CHU');
         return $agama;
      }

   }
 ?>

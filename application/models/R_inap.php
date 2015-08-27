<?php
	class R_inap extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		public function get_new_ipd() {
			return 90000;
		}
	}
?>
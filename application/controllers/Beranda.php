<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->session->has_userdata('username')) {
			redirect(base_url() . 'Auth');
		}
	}

	public function index(){
		load_main_template('Beranda', 'Sistem Informasi RSUP. Dr. Mohammad Hoesin', 'beranda', null, 0);
	}

}
?>
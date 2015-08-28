<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->session->has_userdata('username')) {
			redirect(base_url() . 'Auth');
		}
	}

	public function index(){
		$this->load->model('user');
		$data['user'] = $this->user->get_user();
		load_main_template('Manajemen', 'Manajemen Akun', 'manajemen', $data, 4);
	}

	public function submit(){
		if ($this->input->post('userbaru') === null || $this->input->post('passbaru') === null){
			alert_fail('Gagal menambahkan user');
		}
		$this->load->model('user');
		$data = array(
			'USERNAME' => 'userbaru',
			'PASSWORD_HASH' => 'passbaru'
			);

		foreach ($data as $key => $value) {
			$data[$key] = $this->input->post($value);
		}

		if ($this->user->insert($data)) {
			alert_success('Berhasil menambahkan user');
		}
		else{
			alert_fail('Gagal menambahkan user');
		}
		redirect(base_url().'manajemen');
	}

	public function hapus($userbaru){
		$this->load->model('user');
		$this->user->hapus($userbaru);
		redirect(base_url(). 'manajemen');

	}

}
?>
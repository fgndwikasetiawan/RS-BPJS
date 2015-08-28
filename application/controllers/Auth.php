<?php
Class Auth extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('authentication');
  }

  public function index(){
    $this->load->view('login_form');
  }

  public function user_login_process(){
     
    if ($this->form_validation->run()== FALSE){
      if (isset($this->session->userdata['logged_in'])){
        $this->load->view('admin_page');
      }
      else {
        $data = array(
          'username' => $this->input->post('username'),
          'password' => $this->input->post('password')
        );
        $result = $this->authentication->login($data);
        if ($result == TRUE){
          $this->session->username = $data['username'];
          redirect(base_url() . 'beranda');
        }
        else {
          $data = array(
             'message_display' => 'Username atau Password salah',
             'alert_class' => 'alert-danger'
          );
          $this->load->view('login_form', $data);
        }
      }
    }
  }

  public function logout() {
    $this->session->sess_destroy();
    $data['message_display'] = 'Berhasil Logout';
    $data['alert_class'] = 'alert-success';
    $this->load->view('login_form', $data);
  }
}
?>

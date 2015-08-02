<?php
   function load_main_template($title, $header, $view_name, $view_data, $navbar_index=-1) {
      $ci =& get_instance();
      $data = array (
         'page_title' => $title,
         'page_header' => $header,
         'navbar_index' => $navbar_index,
         'extra_stylesheets' => '',
         'extra_scripts' => '',
         'content' => ''
      );
      if (file_exists(APPPATH . '/views/' . $view_name . '.php')) {
         $data['content'] = $ci->load->view($view_name, $view_data, true);
      }
      if (file_exists(APPPATH . '/views/styles/' . $view_name . '.php')) {
         $data['extra_stylesheets'] = $ci->load->view('styles/' . $view_name, null, true);
      }
      if (file_exists(APPPATH . '/views/scripts/' . $view_name . '.php')) {
         $data['extra_scripts'] = $ci->load->view('scripts/' . $view_name, null, true);
      }
      $ci->load->view('templates/main', $data);
   }
?>

<?php
	function alert_success($msg) {
		$ci =& get_instance();
		$ci->session->set_flashdata('alert_msg', $msg);
		$ci->session->set_flashdata('alert_class', 'alert-success');	
	}
	function alert_fail($msg) {
		$ci =& get_instance();
		$ci->session->set_flashdata('alert_msg', $msg);
		$ci->session->set_flashdata('alert_class', 'alert-danger');	
	}
?>
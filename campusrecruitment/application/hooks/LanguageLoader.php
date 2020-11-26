<?php 
class LanguageLoader {
	function initialize() {
		$ci =& get_instance();
		$ci->load->helper('language');
		$siteLang = $ci->session->userdata('siteLang');
		if ($siteLang) {
			$ci->lang->load('message',$siteLang);
			$ci->lang->load('error_message',$siteLang);
		} else {
			$ci->lang->load('message','english');
			$ci->lang->load('error_message','english');
		}
	}
}
?>
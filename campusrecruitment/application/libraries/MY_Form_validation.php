<?php
class MY_Form_validation extends CI_Form_validation{
	function __construct($config = array()){
		parent::__construct($config);
	}
	function belongstowork($salary) {
		// print_r($this->CI->input->post());
		// print_r($this->CI->session->userdata('userName'));
		$query = $this->CI->db->query("SELECT COUNT(id) AS count FROM users WHERE email = '".$salary."' AND userName != '".$this->CI->session->userdata('userName')."'");
		$row = $query->row();
		return ($row->count > 0) ? FALSE : TRUE;
	}

	/**
	 * This email_exist_check method are used to validate the email for already exist or not
	 * @return true or false to companyProfileFormValidation method
	 * @author Kulasekaran.
	 *
	 */
	function email_exist_check($str, $fields) {
		list($table, $columnOne, $strTwo) = explode('.', $fields, 3); 
		$query = $this->db->query("SELECT COUNT(id) AS count FROM $table WHERE ".$columnOne." = '".$str."' AND id != '".$strTwo."'");
		$row = $query->row();
		$this->form_validation->set_message('email_exist_check', $this->lang->line("exist_email"));
		return ($row->count > 0) ? FALSE : TRUE;
	}

	/**
	 * This before_tomorrow method are used to validate the entry date is before tomorrow or not
	 * @return true or false to companyProfileFormValidation method
	 * @author kulasekaran.
	 *
	 */
	function before_tomorrow($entryDate) {
		$currentDate = date('Y-m-d');
		$this->form_validation->set_message('before_tomorrow', $this->lang->line("before_tomorrow"));
		return ($currentDate < $entryDate) ? FALSE : TRUE;
	}

}
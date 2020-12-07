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
	function exist_email($email) {

		$query = $this->CI->db->query("SELECT COUNT(id) AS count FROM company WHERE email = '".$email."' AND id != '3'");
		$row = $query->row();
		return ($row->count > 0) ? FALSE : TRUE;
	}

	/**
	 * This before_tomorrow method are used to validate the entry date is before tomorrow or not
	 * @return true or false to companyProfileFormValidation method
	 * @author kulasekaran.
	 *
	 */
	function before_tomorrow() {
		$entryDate = $this->CI->input->post('entryDate');
		$currentDate = date('Y-m-d');
		return ($currentDate < $entryDate) ? FALSE : TRUE;
	}

	/**
	 * This alphabetic method are used to validate the field are alphabetic or not
	 * @return true or false to companyProfileFormValidation method
	 * @author kulasekaran.
	 *
	 */
	function alphabetic($name) {
		$pattern = "/^[A-Za-z\s\.]+$/";
		$match = preg_match($pattern,$name);
		return ($match == 0) ? FALSE : TRUE;
	}

	/**
	 * This contact_digit method are used to validate contact field have ten digit or not
	 * @return true or false to companyProfileFormValidation method
	 * @author kulasekaran.
	 *
	 */
	function contact_digit($contact) {
		$pattern = "/\b\d{10}\b/";
		$match = preg_match($pattern,$contact);
		return ($match == 0) ? FALSE : TRUE;
	}

}
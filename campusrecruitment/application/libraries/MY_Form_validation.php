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
		$hiddenCompanyId = $this->CI->input->post('hiddenCompanyId');
		$existCompanyId = "";
		if ($hiddenCompanyId != null) {
			$existCompanyId = "NOT id = '".$hiddenCompanyId."' AND";
		}
		$query = $this->CI->db->query("SELECT COUNT(id) AS count FROM company WHERE ".$existCompanyId." email = '".$email."'");
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

	/**
	 * This exist_company_name method are used to validate company name is already exist or not
	 * @return true or false to companyProfileFormValidation method
	 * @author kulasekaran.
	 *
	 */
	function exist_company_name($companyName) {
		$hiddenCompanyId = $this->CI->input->post('hiddenCompanyId');
		$existCompanyId = "";
		if ($hiddenCompanyId != null) {
			$existCompanyId = "NOT id = '".$hiddenCompanyId."' AND";
		}
		$query = $this->CI->db->query("SELECT COUNT(id) AS count FROM company WHERE ".$existCompanyId." companyName LIKE '".$companyName."'");
		$row = $query->row();
		return ($row->count > 0) ? FALSE : TRUE;
	}

	/**
	 * This exist_company_website method are used to validate company website is already exist or not
	 * @return true or false to companyProfileFormValidation method
	 * @author kulasekaran.
	 *
	 */
	function exist_company_website($website) {
		$hiddenCompanyId = $this->CI->input->post('hiddenCompanyId');
		$existCompanyId = "";
		if ($hiddenCompanyId != null) {
			$existCompanyId = "NOT id = '".$hiddenCompanyId."' AND";
		}
		$query = $this->CI->db->query("SELECT COUNT(id) AS count FROM company WHERE ".$existCompanyId." website LIKE '".$website."'");
		$row = $query->row();
		return ($row->count > 0) ? FALSE : TRUE;
	}

	/**
	 * This valid_url method are used to validate company website format is correct or not
	 * @return to view
	 * @author Kulasekaran.
	 *
	 */
	function valid_website($website) {
    $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
    return (!preg_match($pattern, $website)) ? FALSE : TRUE;
    }

    /**
	 * This password_confirmation method are used to validate password field and confirm password is same or not
	 * @return to view
	 * @author Kulasekaran.
	 *
	 */
	function password_confirmation($password) {
	$confPassword = $this->CI->input->post('password_confirmation');
	$comparePassword = strcmp($password, $confPassword);
    return ($comparePassword != 0) ? FALSE : TRUE;
    }

}
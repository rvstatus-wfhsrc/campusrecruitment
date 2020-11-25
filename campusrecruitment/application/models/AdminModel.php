<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
 
 	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	// retrieves profile data
  	function profileDetail($userName) {
	    $profileDetail = $this->db->query("SELECT userName,name,gender,address,city,state,country,pincode,email,contact
	    									FROM users 
	    									WHERE userName = '$userName'");
	    return $profileDetail->result_array();
  	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {
 
 	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	// login data checking
  	function loginProcess($userName,$password) {
	    $result = $this->db->query("SELECT userName,flag FROM users WHERE userName = '$userName' AND password = '$password'");
	    return $result;
  	}
}
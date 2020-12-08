<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {
 
 	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	// login data checking
  	function loginProcess() {
        $flag = $this->input->post('flag');
        if($flag == 1) {
           $result = $this->db->query("SELECT userName,flag FROM users WHERE flag = '".$flag."' AND userName = '".$this->input->post('adminUserName')."' AND password = '".md5($this->input->post('adminPassword'))."'");
        } elseif ($flag == 2 ) {
            $result = $this->db->query("SELECT userName,flag FROM company WHERE userName = '".$this->input->post('companyUserName')."' AND password = '".md5($this->input->post('companyPassword'))."'");
        } else {
	       $result = $this->db->query("SELECT userName,flag FROM users WHERE flag = '".$flag."' AND userName = '".$this->input->post('jobSeekerUserName')."' AND password = '".md5($this->input->post('jobSeekerPassword'))."'");
        }
	    return $result;
  	}
}
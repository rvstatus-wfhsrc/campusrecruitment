<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
 
 	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	// retrieves profile data
  	function profileDetail($userName) {
  		$this->db->select('userName,name,gender,address,city,state,country,pincode,email,contact,image');
  		$this->db->where(array('userName' => $userName));
  		$profileDetail = $this->db->get('users');
	    return $profileDetail->result()[0];
  	}

  	// remove the user profile image
	function removeImage() {
		// Get the status
        $userName = $this->session->userdata('userName');
        $data = array('image' => null);
    	$imageStatus = $this->db->update('users',$data,array('userName' => $userName));
        return $imageStatus;
	}

	// retrieves profile data for edit
  	function profileEdit($userName) {
  		$this->db->select('userName,name,gender,address,city,state,country,pincode,email,contact,image');
  		$this->db->where(array('userName' => $userName));
  		$profileEdit = $this->db->get('users');
	    return $profileEdit->result()[0];
  	}

  	//update the user profile data
	function profileUpdate($userName,$profileUpdateData) {
		// Get the status
   //      $image = $this->input->post('image');
   //      $blob = null;
   //      $updateUser = null;
        try {
        	// for further use
   //      	if(isset($image)) {				
			// 	$blob = file_get_contents(addslashes($image));
			// 	$imageData = array('image' => $blob);
			// 	$this->db->where('userName', $userName);
			// 	$imageUpdate = $this->db->update('users', $imageData);
			// }
			$this->db->where('userName', $userName);
			$updateUser = $this->db->update('users', $profileUpdateData);
	    } catch (\Exception $e) {
	    }
        return $updateUser;
	}


}
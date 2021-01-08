<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	// retrieves profile data
	function profileDetail($userName) {
		// $this->db->select('userName,name,gender,address,city,state,country,pincode,email,contact,image');
		$this->db->select('userName,name,gender,address,pincode,email,contact,image');
		$this->db->where(array('userName' => $userName));
		$profileDetail = $this->db->get('cmt_users');
		return $profileDetail->result()[0];
	}

	// remove the user profile image
	function removeImage() {
		// Get the status
		$userName = $this->session->userdata('userName');
		$data = array('image' => null);
		$imageStatus = $this->db->update('cmt_users',$data,array('userName' => $userName));
		return $imageStatus;
	}

	// retrieves profile data for edit
	function profileEdit($userName) {
		// $this->db->select('userName,name,gender,address,city,state,country,pincode,email,contact,image');
		$this->db->select('userName,name,gender,address,pincode,email,contact,image');
		$this->db->where(array('userName' => $userName));
		$profileEdit = $this->db->get('cmt_users');
		return $profileEdit->result()[0];
	}

	//update the user profile data
	function profileUpdate($userName,$profileUpdateData) {
		$image = $_FILES['image']['tmp_name'];
		$file_path = null;
		$updateUser = null;
		$this->db->trans_begin();
		try {
			if($image != null) {
				$upload_path = 'assets/images/upload/admin/';
				$file_name = $_FILES['image']['name'];
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
				if (!file_exists($upload_path)) {
					mkdir($upload_path, 0777, true);
				}
				$file_path = $upload_path.$userName.".".$ext;
				move_uploaded_file($_FILES['image']['tmp_name'],$file_path);
				$imageData = array('image' => $file_path);
				$this->db->where('userName', $userName);
				$imageUpdate = $this->db->update('cmt_users', $imageData);
			}
			$this->db->where('userName', $userName);
			$updateUser = $this->db->update('cmt_users', $profileUpdateData);
			$this->db->trans_commit();
		} catch (\Exception $e) {
			$this->db->trans_rollback();
		}
		return $updateUser;
	}


}
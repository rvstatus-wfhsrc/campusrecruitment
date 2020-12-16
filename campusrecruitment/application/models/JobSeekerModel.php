<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Job Seeker Model
 *
 * This Model are used to perform the company job seeker details related to data base process
 * 
 * @author kulasekaran.
 *
 */
class JobSeekerModel extends CI_Model {

	/**
	 * Job Seeker Controller __construct
	 *
	 * This __construct are used to load the database
	 * 
	 * @author kulasekaran.
	 *
	 */
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * This jobSeekerAdd method are used to inserts the form data into users table
	 * @return the jobSeekerAddStatus with true or false value to controller according to database results
	 * @author kulasekaran.
	 *
	 */
	function jobSeekerAdd() {
		$image = $_FILES['image']['tmp_name'];
		$blob = null;
		$addJobSeeker = null;
		$imageData = array();
		
		// create job seeker userName
		$lastAddJobSeekerUser = $this->JobSeekerModel->lastJobSeekerUserName();
		$label = 'JS';
		$lastJobSeekerInArray = $lastAddJobSeekerUser->result_array();
		if ($lastJobSeekerInArray != null) {
			$lastJobSeekerUserName = $lastJobSeekerInArray[0];
			$lastJobSeekerID = $lastJobSeekerUserName['userName'];
			$jobSeekerCount = 1;
			if (isset($lastJobSeekerID) && $lastJobSeekerID != "") {
				$jobSeekerCount = substr($lastJobSeekerID, -4);
			   	$jobSeekerCount = $jobSeekerCount + 1;
			}
			$padCount = str_pad($jobSeekerCount, 4, '0', STR_PAD_LEFT);
			$jobSeekerUserName = $label.$padCount;
		} else {
			$jobSeekerUserName = "JS0001";
		}
		
		$this->db->trans_begin();
		try {
			// $image not null convert the image data into blob in array
			if($image != null) {
				$blob = file_get_contents($_FILES['image']['tmp_name']);
				$imageData = array('image' => $blob);
			}
			$jobSeekerAddData = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'country' => $this->input->post('country'),
				'state' => $this->input->post('state'),
				'city' => $this->input->post('city'),
				'pincode' => $this->input->post('pincode'),
				'contact' => $this->input->post('contact'),
				'password' => md5($this->input->post('password')),
				'userName' => $jobSeekerUserName,
				'created_by' => $jobSeekerUserName,
				'flag' => 3
			);
			$jobSeekerAddMergeData = array_merge($jobSeekerAddData, $imageData);
			$jobSeekerAddStatus = $this->db->insert('users', $jobSeekerAddMergeData);
			$this->db->trans_commit();
		} catch (\Exception $e) {
			$this->db->trans_rollback();
		}
		return $jobSeekerAddStatus;
	}

	/**
	 * This lastJobSeekerUserName method are used to get the userName of last added jobSeeker
	 * @return the username to JobSeekerController
	 * @author kulasekaran.
	 *
	 */
	function lastJobSeekerUserName() {
		$lastUserName = $this->db->query("SELECT userName FROM users WHERE userName LIKE 'JS%' ORDER BY id DESC");
		return $lastUserName;
	}

	/**
	 * This jobSeekerDetail method are used to get the one row data from users table
	 * @return to return the jobSeekerDetail array to controller
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerDetail() {
		$this->db->select(
					'country.countryName as country,
					state.stateName as state,
					city.cityName as city,
					user.id,
					user.name,
					user.gender,
					user.contact,
					user.email,
					user.address,
					user.userName,
					user.delFlag,
					user.pincode,
					user.image'
				)
			->from('users as user')
			->join('m_country as country','country.countryId = user.country','left')
			->join('m_state as state','state.stateId = user.state','left')
			->join('m_city as city','city.cityId = user.city','left');
		$jobSeekerUserName = $this->session->userdata('userName');
		$this->db->where(array('userName' => $jobSeekerUserName));
		$jobSeekerDetail = $this->db->get();
		return $jobSeekerDetail->result()[0];
	}

	/**
	 * This removeImage method are used to remove the job seeker profile image from users table
	 * @return to return the imageStatus to controller
	 * @author kulasekaran.
	 *
	 */
	function removeImage() {
		// Get the status
		$userName = $this->session->userdata('userName');
		$data = array('image' => null);
		$imageStatus = $this->db->update('users',$data,array('userName' => $userName));
		return $imageStatus;
	}

	/**
	 * This jobSeekerEdit method are used to get the one row data from users table
	 * @return to return the profileEdit array to controller
	 * @author kulasekaran.
	 *
	 */
	function jobSeekerEdit() {
		$this->db->select(
							'userName,
							id,
							name,
							gender,
							address,
							city,
							state,
							country,
							pincode,
							email,
							contact'
						);
		$this->db->where('userName',$this->session->userdata('userName'));
		$profileEdit = $this->db->get('users');
		if(isset($profileEdit->result()[0])){
			return $profileEdit->result()[0];
		} else {
			return array();
		}
	}

	/**
	 * This jobSeekerUpdate method are used to update the one row data into the users table
	 * @return to return the updateUser with true or false value to controller according to database results
	 * @author kulasekaran.
	 *
	 */
	function jobSeekerUpdate() {
		$image = $_FILES['image']['tmp_name'];
		$blob = null;
		$updateUser = false;
		$userName = $this->session->userdata('userName');
		$this->db->trans_begin();
		try {
			if($image != null) {
				$blob = file_get_contents($_FILES['image']['tmp_name']);
				$imageData = array('image' => $blob);
				$this->db->where('userName', $userName);
				$imageUpdate = $this->db->update('users', $imageData);
			}
			$this->db->where('userName', $userName);
			$profileUpdateData = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'country' => $this->input->post('country'),
				'state' => $this->input->post('state'),
				'city' => $this->input->post('city'),
				'pincode' => $this->input->post('pincode'),
				'contact' => $this->input->post('contact'),
				'updated_by' => $userName
			);
			$updateUser = $this->db->update('users', $profileUpdateData);
			$this->db->trans_commit();
			// $updateUser = true;
		} catch (\Exception $e) {
			$this->db->trans_rollback();
		}
		return $updateUser;
	}

	/**
	 * This jobSeekerQualificationAdd method are used to inserts the form data into t_qualification table
	 * @return the jobSeekerQualificationAddStatus with true or false value to controller according to database results
	 * @author kulasekaran.
	 *
	 */
	function jobSeekerQualificationAdd() {
		$jobSeekerUserName = $this->session->userdata('userName');
		$jobSeekerQualificationAddData = array(
			'tenthMark' => $this->input->post('tenthMark'),
			'twelvethMark' => $this->input->post('twelvethMark'),
			'qualification' => $this->input->post('qualification'),
			'yearOfPassing' => $this->input->post('yearOfPassing'),
			'collegeName' => $this->input->post('collegeName'),
			'cgpa' => $this->input->post('cgpa'),
			'skill' => $this->input->post('skill'),
			'extraSkill' => $this->input->post('extraSkill'),
			'created_by' => $jobSeekerUserName,
			'delFlag' => 0
		);
		$jobSeekerQualificationAddStatus = $this->db->insert('t_qualification', $jobSeekerQualificationAddData);
		return $jobSeekerQualificationAddStatus;
	}

}
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
		//create job seeker userName...
		$image = $_FILES['image']['tmp_name'];
		$blob = null;
		$addJobSeeker = null;
		$imageData = array();
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
			// $image => not null ----> gets the image data in array
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
	 * This jobEdit method are used to get the one row data from job_details table
	 * @return to return the jobEdit array to controller
	 * @author Kulasekaran.
	 *
	 */
	// function jobEdit() {
	// 	$this->db->select(
	// 						'id,
	// 						jobCategory,
	// 						jobType,
	// 						requiredSkill,
	// 						extraSkill,
	// 						role,
	// 						minQualification,
	// 						maxAge,
	// 						salary,
	// 						jobLocation,
	// 						workingHour,
	// 						jobDescription,
	// 						lastApplyDate'
	// 					);
	// 	$this->db->where(array('id' => $this->input->post('hiddenJobId')));
	// 	$jobEdit = $this->db->get('job_details');
	// 	if(isset($jobEdit->result()[0])){
	// 		return $jobEdit->result()[0];
	// 	} else {
	// 		return array();
	// 	}
	// }

	/**
	 * This jobUpdate method are used to update the one row data into the job_details table
	 * @return to return the jobUpdateStatus with true or false value to controller according to database results
	 * @author Kulasekaran.
	 *
	 */
	// function jobUpdate() {
	// 	$userName = $this->session->userdata('userName');
	// 	$hiddenJobId = $this->input->post('hiddenJobId');
	// 	$jobUpdateData = array(
	// 		'jobCategory' => $this->input->post('jobCategory'),
	// 		'jobType' => $this->input->post('jobType'),
	// 		'requiredSkill' => $this->input->post('requiredSkill'),
	// 		'extraSkill' => $this->input->post('extraSkill'),
	// 		'role' => $this->input->post('role'),
	// 		'minQualification' => $this->input->post('minQualification'),
	// 		'maxAge' => $this->input->post('maxAge'),
	// 		'salary' => $this->input->post('salary'),
	// 		'jobLocation' => $this->input->post('jobLocation'),
	// 		'workingHour' => $this->input->post('workingHour'),
	// 		'jobDescription' => $this->input->post('jobDescription'),
	// 		'lastApplyDate' => $this->input->post('lastApplyDate'),
	// 		'updated_by' => $userName
	// 	);
	// 	$this->db->where('id', $hiddenJobId);
	// 	$updateUser = $this->db->update('job_details', $jobUpdateData);
	// 	return $updateUser;
	// }

}
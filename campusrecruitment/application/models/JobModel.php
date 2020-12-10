<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Job Model
 *
 * This Model are used to perform the company job details related to data base process
 * 
 * @author Kulasekaran.
 *
 */
class JobModel extends CI_Model {

	/**
	 * Job Controller __construct
	 *
	 * This __construct are used to load the database
	 * 
	 * @author Kulasekaran.
	 *
	 */
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * This jobAdd method are used to add the data get from user into data base
	 * @return to return the jobAddStatus with true or false value to controller according to database results
	 * @author Kulasekaran.
	 *
	 */
	function jobAdd() {
		$userName = $this->session->userdata('userName');
		$jobAddData = array(
			'companyId' => $userName,
			'jobCategory' => $this->input->post('jobCategory'),
			'jobType' => $this->input->post('jobType'),
			'requiredSkill' => $this->input->post('requiredSkill'),
			'extraSkill' => $this->input->post('extraSkill'),
			'role' => $this->input->post('role'),
			'minQualification' => $this->input->post('minQualification'),
			'maxAge' => $this->input->post('maxAge'),
			'salary' => $this->input->post('salary'),
			'jobLocation' => $this->input->post('jobLocation'),
			'workingHour' => $this->input->post('workingHour'),
			'jobDescription' => $this->input->post('jobDescription'),
			'lastApplyDate' => $this->input->post('lastApplyDate'),
			'created_by' => $userName
		);

		$jobAddStatus = $this->db->insert('job_details', $jobAddData);
		return $jobAddStatus;
	}

	/**
	 * This jobList method are used to retrieves the data from user to data base
	 * @param records limit and start value is passed by JobController
	 * @return to return the jobHistory array value to controller
	 * @author Kulasekaran.
	 *
	 */
	function jobList($limit, $start) {
		$filterVal = $this->input->post('filterVal');
		$hiddenSearch = $this->input->post('hiddenSearch');
		$this->db->limit($limit, $start);
		$this->db->select(
					'dest.designationName,
					skill.skillName,
					role.roleName,
					country.countryName as jobLocation,
					jd.id,
					jd.delFlag,
					jd.maxAge,
					jd.salary,
					jd.workingHour,
					jd.lastApplyDate,
					jd.created_date_time'
				)
			->from('job_details as jd')
			// this is the left join in codeigniter
			->join('m_designation as dest','dest.designationId = jd.jobCategory','left')
			->join('m_role as role','role.roleId = jd.role','left')
			->join('m_skill as skill','skill.skillId = jd.requiredSkill','left')
			->join('m_country as country','country.countryId = jd.jobLocation','left');
			
			// filter process
			if ($filterVal == 2) {
				$this->db->where(array('jd.delFlag' => 0));
			} elseif ($filterVal == 3) {
				$this->db->where(array('jd.delFlag' => 1));
			}

			// search process
			$hiddenSearch = $this->input->post('hiddenSearch');
			if($hiddenSearch != ""){
				$this->db->like('skill.skillName',trim($hiddenSearch));
			}

			// sorting process
			$sortOptn = $this->input->post('sortOptn');
			$sortVal = $this->input->post('sortVal');
			if ($sortVal == 1) {
				$this->db->order_by('jd.created_date_time', $sortOptn);
			} else if ($sortVal == 2) {
				$this->db->order_by('skill.skillName', $sortOptn);
			} else if ($sortVal == 3) {
				$this->db->order_by('jd.salary', $sortOptn);
			} else if ($sortVal == 4) {
				$this->db->order_by('jd.lastApplyDate', $sortOptn);
			} else {
				$this->db->order_by('jd.created_date_time', 'DESC');
			}
		$jobHistory = $this->db->get();
		return $jobHistory->result();
	}

	/**
	 * This record_count method are used to get the total count of data from job_details table
	 * @return to return the total count value to controller
	 * @author Kulasekaran.
	 *
	 */
	public function record_count() {
		return $this->db->count_all("job_details");
	}

	/**
	 * This jobStatus method are used to turns active or inactive for the specfic job
	 * @param id and delFlag value of specific job is passed from JobController 
	 * @return the job status
	 * @author Kulasekaran.
	 *
	 */
	function jobStatus($id,$delFlag) {
		$userName = $this->session->userdata('userName');
		// $delFlag => 0 ----> change delFlag = 1
		// $delFlag => 1 ----> change delFlag = 0
		if ($delFlag == 0) {
			$this->db->where('id', $id);
			$jobStatus = $this->db->update('job_details', array('delFlag' => 1,'updated_by' => $userName ));
		} else {
			$this->db->where('id', $id);
			$jobStatus = $this->db->update('job_details', array('delFlag' => 0,'updated_by' => $userName ));
		}
		return $jobStatus;
	}

	/**
	 * This jobDetail method are used to get the one row data from job_details table
	 * @param id value of specific job is passed from JobController
	 * @return to return the jobDetail array to controller
	 * @author Kulasekaran.
	 *
	 */
	public function jobDetail($id) {
		$this->db->select(
							'dest.designationName,
							skill.skillName,
							role.roleName,
							country.countryName as jobLocation,
							minqual.minQualification,
							jd.id,
							jd.delFlag,
							jd.maxAge,
							jd.salary,
							jd.workingHour,
							jd.jobDescription,
							jd.lastApplyDate,
							jd.jobType,
							jd.extraSkill,
							cmpy.companyName,
							cmpy.incharge'

						)
					->from('job_details as jd')
					 // this is the left join in codeigniter
					->join('m_designation as dest','dest.designationId = jd.jobCategory','left')
					->join('m_role as role','role.roleId = jd.role','left')
					->join('m_skill as skill','skill.skillId = jd.requiredSkill','left')
					->join('m_country as country','country.countryId = jd.jobLocation','left')
					->join('m_min_qualification as minqual','minqual.minQualificationId = jd.minQualification','left')
					->join('company as cmpy','cmpy.userName = jd.companyId','left');

		$this->db->where(array('jd.id' => $id));
		$jobDetail = $this->db->get();
		return $jobDetail->result()[0];
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
	// 						requiredSkill,
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
	// 		'requiredSkill' => $this->input->post('requiredSkill'),
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
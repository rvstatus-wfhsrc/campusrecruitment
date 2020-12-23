<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Job Model
 *
 * This Model are used to perform the company job details related to data base process
 * 
 * @author kulasekaran.
 *
 */
class JobModel extends CI_Model {

	/**
	 * Job Controller __construct
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
	 * This jobAdd method are used to add the data get from user into data base
	 * @return to return the jobAddStatus with true or false value to controller according to database results
	 * @author kulasekaran.
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
	 * @author kulasekaran.
	 *
	 */
	function jobList($limit, $start) {
		$userName = $this->session->userdata('userName');
		$filterVal = $this->input->post('filterVal');
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
				$this->db->order_by('CAST(jd.salary as SIGNED INTEGER)', $sortOptn);
			} else if ($sortVal == 4) {
				$this->db->order_by('jd.lastApplyDate', $sortOptn);
			} else {
				$this->db->order_by('jd.created_date_time', 'DESC');
			}
			$this->db->where(array('jd.companyId' => $userName));
		$jobHistory = $this->db->get();
		return $jobHistory->result();
	}

	/**
	 * This record_count method are used to get the total count of data from job_details table
	 * @return to return the total count value to controller
	 * @author kulasekaran.
	 *
	 */
	public function record_count() {
		// filter process
		$userName = $this->session->userdata('userName');
		$filterVal = $this->input->post('filterVal');
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
		$this->db->select('COUNT(jd.id) as numrows');
		$this->db->from('job_details as jd');
		$this->db->join('m_skill as skill', 'jd.requiredSkill = skill.skillId');
		if ($this->session->userdata('flag') == 2) {
			$this->db->where(array('jd.companyId' => $userName));	
		} else {
			$this->db->where(array('jd.lastApplyDate >=' => date('Y-m-d')));
			$this->db->where(array('jd.delFlag' => 0));
		}
		$result = $this->db->get();
		return $result->result()['0']->numrows;
	}

	/**
	 * This jobStatus method are used to turns active or inactive for the specfic job
	 * @param id and delFlag value of specific job is passed from JobController 
	 * @return the job status
	 * @author kulasekaran.
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
	 * @author kulasekaran.
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
							jd.companyId,
							jd.delFlag,
							jd.maxAge,
							jd.salary,
							jd.workingHour,
							jd.jobDescription,
							jd.lastApplyDate,
							jd.jobType,
							jd.extraSkill,
							cmpy.contact,
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
	 * @author kulasekaran.
	 *
	 */
	function jobEdit() {
		$this->db->select(
							'id,
							jobCategory,
							jobType,
							requiredSkill,
							extraSkill,
							role,
							minQualification,
							maxAge,
							salary,
							jobLocation,
							workingHour,
							jobDescription,
							lastApplyDate'
						);
		$this->db->where(array('id' => $this->input->post('hiddenJobId')));
		$jobEdit = $this->db->get('job_details');
		if(isset($jobEdit->result()[0])){
			return $jobEdit->result()[0];
		} else {
			return array();
		}
	}

	/**
	 * This jobUpdate method are used to update the one row data into the job_details table
	 * @return to return the jobUpdateStatus with true or false value to controller according to database results
	 * @author kulasekaran.
	 *
	 */
	function jobUpdate() {
		$userName = $this->session->userdata('userName');
		$hiddenJobId = $this->input->post('hiddenJobId');
		$jobUpdateData = array(
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
			'updated_by' => $userName
		);
		$this->db->where('id', $hiddenJobId);
		$updateUser = $this->db->update('job_details', $jobUpdateData);
		return $updateUser;
	}

	/**
	 * This jobLists method are used to retrieves the all data from job_details
	 * @param records limit and start value is passed by JobController
	 * @return to return the jobLists array value to controller
	 * @author kulasekaran.
	 *
	 */
	function jobLists($limit, $start) {
		$filterVal = $this->input->post('filterVal');
		$this->db->limit($limit, $start);
		$this->db->select(
					'dest.designationName,
					skill.skillName,
					role.roleName,
					country.countryName as jobLocation,
					jd.id,
					jd.companyId,
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
				$this->db->order_by('CAST(jd.salary as SIGNED INTEGER)', $sortOptn);
			} else if ($sortVal == 4) {
				$this->db->order_by('jd.lastApplyDate', $sortOptn);
			} else {
				$this->db->order_by('jd.created_date_time', 'DESC');
			}
			$this->db->where(array('jd.lastApplyDate >=' => date('Y-m-d')));
			$this->db->where(array('jd.delFlag' => 0));
		$jobHistory = $this->db->get();
		return $jobHistory->result();
	}

	/**
	 * This jobApplyHistory method are used to retrieves the data from apply_job_details to data base
	 * @param records limit and start value is passed by JobController
	 * @return to return the jobApplyHistory array value to controller
	 * @author kulasekaran.
	 *
	 */
	function jobApplyHistory($limit, $start) {
		$userName = $this->session->userdata('userName');
		$filterVal = $this->input->post('filterVal');
		$this->db->limit($limit, $start);
		$this->db->select(
					'ajd.id,
					ajd.companyId,
					ajd.jobSeekerId,
					ajd.applyDate,
					ajd.delFlag,
					jd.lastApplyDate,
					cmpy.companyName,
					dest.designationName AS jobCategory,
					jd.salary,
					cmpy.incharge,
					cmpy.contact'
				)
			->from('apply_job_details as ajd')
			// this is the left join in codeigniter
			->join('company as cmpy','cmpy.userName = ajd.companyId','left')
			->join('job_details as jd','jd.id = ajd.jobId','left')
			->join('m_designation as dest','dest.designationId = jd.jobCategory','left');
			
			// filter process
			if ($filterVal == 2) {
				$this->db->where(array('ajd.delFlag' => 0));
			} elseif ($filterVal == 3) {
				$this->db->where(array('ajd.delFlag' => 1));
			}

			// search process
			$hiddenSearch = $this->input->post('hiddenSearch');
			if($hiddenSearch != ""){
				$this->db->like('cmpy.companyName',trim($hiddenSearch));
			}

			// sorting process
			$sortOptn = $this->input->post('sortOptn');
			$sortVal = $this->input->post('sortVal');
			if ($sortVal == 1) {
				$this->db->order_by('cmpy.companyName', $sortOptn);
			} else if ($sortVal == 2) {
				$this->db->order_by('dest.designationName', $sortOptn);
			} else if ($sortVal == 3) {
				$this->db->order_by('ajd.applyDate', $sortOptn);
			} else {
				$this->db->order_by('cmpy.companyName', 'ASC');
			}
			$this->db->where(array('ajd.created_by' => $userName));
		$jobApplyHistory = $this->db->get();
		return $jobApplyHistory->result();
	}

	/**
	 * This jobApply method are used to add the data into apply_job_details table
	 * @return to the jobApplyStatus with true or false value to controller according to database results
	 * @author kulasekaran.
	 *
	 */
	function jobApply() {
		$userName = $this->session->userdata('userName');
		$jobAddData = array(
			'jobId' => $this->input->post('hiddenJobId'),
			'companyId' => $this->input->post('hiddenCompanyId'),
			'jobSeekerId' => $userName,
			'applyDate' => date('yy-m-d'),
			'created_by' => $userName,
			'delFlag' => 0
		);

		$jobAddStatus = $this->db->insert('apply_job_details', $jobAddData);
		return $jobAddStatus;
	}

	/**
	 * This jobApplyCancelStatus method are used to cancel the specfic applied job
	 * @param id value of specific job is passed from JobController 
	 * @return the job cancel status
	 * @author kulasekaran.
	 *
	 */
	function jobApplyCancelStatus($id) {
		$userName = $this->session->userdata('userName');
		// $delFlag => 0 ----> change delFlag = 1
		$this->db->where('id', $id);
		$jobApplyCancelStatus = $this->db->update('apply_job_details', array('delFlag' => 1,'updated_by' => $userName ));
		return $jobApplyCancelStatus;
	}

	/**
	 * This jobApplyDetail method are used to get the one row data from apply_job_details table
	 * @param id value of specific applied job is passed from JobController
	 * @return to return the jobApplyDetail array to controller
	 * @author kulasekaran.
	 *
	 */
	public function jobApplyDetail($id) {
		$this->db->select(
					'ajd.id,
					ajd.companyId,
					ajd.jobSeekerId,
					ajd.applyDate,
					ajd.delFlag,
					jd.lastApplyDate,
					cmpy.companyName,
					dest.designationName AS jobCategory,
					jd.salary,
					jd.jobType,
					jd.extraSkill,
					jd.workingHour,
					jd.jobDescription,
					role.roleName,
					skill.skillName,
					country.countryName as jobLocation,
					cmpy.incharge,
					cmpy.contact'
				)
			->from('apply_job_details as ajd')
			// this is the left join in codeigniter
			->join('company as cmpy','cmpy.userName = ajd.companyId','left')
			->join('job_details as jd','jd.id = ajd.jobId','left')
			->join('m_role as role','role.roleId = jd.role','left')
			->join('m_skill as skill','skill.skillId = jd.requiredSkill','left')
			->join('m_country as country','country.countryId = jd.jobLocation','left')
			->join('m_designation as dest','dest.designationId = jd.jobCategory','left');

		$this->db->where(array('ajd.id' => $id));
		$jobApplyDetail = $this->db->get();
		return $jobApplyDetail->result()[0];
	}

	/**
	 * This record_count_for_job_apply method are used to get the total count of data from apply_job_details table
	 * @return to return the total count value to controller
	 * @author kulasekaran.
	 *
	 */
	public function record_count_for_job_apply() {
		// filter process
		$userName = $this->session->userdata('userName');
		$filterVal = $this->input->post('filterVal');
		// filter process
		if ($filterVal == 2) {
			$this->db->where(array('ajd.delFlag' => 0));
		} elseif ($filterVal == 3) {
			$this->db->where(array('ajd.delFlag' => 1));
		}

		// search process
		$hiddenSearch = $this->input->post('hiddenSearch');
		if($hiddenSearch != ""){
			$this->db->like('cmpy.companyName',trim($hiddenSearch));
		}

		// sorting process
		$sortOptn = $this->input->post('sortOptn');
		$sortVal = $this->input->post('sortVal');
		if ($sortVal == 1) {
			$this->db->order_by('cmpy.companyName', $sortOptn);
		} else if ($sortVal == 2) {
			$this->db->order_by('dest.designationName', $sortOptn);
		} else if ($sortVal == 3) {
			$this->db->order_by('ajd.applyDate', $sortOptn);
		} else {
			$this->db->order_by('cmpy.companyName', 'ASC');
		}
		$this->db->select('COUNT(ajd.id) as numrows');
		$this->db->from('apply_job_details as ajd');
		$this->db->join('company as cmpy','cmpy.userName = ajd.companyId','left');
		$this->db->join('job_details as jd','jd.id = ajd.jobId','left');
		$this->db->join('m_designation as dest','dest.designationId = jd.jobCategory','left');
		$this->db->where(array('ajd.created_by' => $userName));
		$result = $this->db->get();
		return $result->result()['0']->numrows;
	}
}
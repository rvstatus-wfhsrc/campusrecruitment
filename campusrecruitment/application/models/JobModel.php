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
					cmpy.contact,
					user.name AS jobSeekerName,
					user.contact AS jobSeekerContact'
				)
			->from('apply_job_details as ajd')
			// this is the left join in codeigniter
			->join('company as cmpy','cmpy.userName = ajd.companyId','left')
			->join('job_details as jd','jd.id = ajd.jobId','left')
			->join('m_designation as dest','dest.designationId = jd.jobCategory','left')
			->join('users as user','user.userName = ajd.jobSeekerId','left');
			
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
			if ($this->session->userdata('flag') == 3) {
				$this->db->where(array('ajd.jobSeekerId' => $userName));
			} else if($this->session->userdata('flag') == 2) {
				$this->db->where(array('ajd.companyId' => $userName));
			}
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
			'applyDate' => date('Y-m-d'),
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
					ajd.jobId,
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
					cmpy.contact,
					user.name AS jobSeekerName,
					user.gender,
					user.contact AS jobSeekerContact,
					jrd.applyJobId'
				)
			->from('apply_job_details as ajd')
			// this is the left join in codeigniter
			->join('company as cmpy','cmpy.userName = ajd.companyId','left')
			->join('job_details as jd','jd.id = ajd.jobId','left')
			->join('m_role as role','role.roleId = jd.role','left')
			->join('m_skill as skill','skill.skillId = jd.requiredSkill','left')
			->join('m_country as country','country.countryId = jd.jobLocation','left')
			->join('m_designation as dest','dest.designationId = jd.jobCategory','left')
			->join('users as user','user.userName = ajd.jobSeekerId','left')
			->join('job_result_details as jrd','jrd.applyJobId = ajd.id','left');

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
		if ($this->session->userdata('flag') == 3) {
			$this->db->where(array('ajd.jobSeekerId' => $userName));
		} else if($this->session->userdata('flag') == 2) {
			$this->db->where(array('ajd.companyId' => $userName));
		}
		$result = $this->db->get();
		return $result->result()['0']->numrows;
	}

	/**
	 * This getJobAppliedDetail method are used to data get data from database
	 * @return to the jobResultAdd variable to controller with data according to database results
	 * @author kulasekaran.
	 *
	 */
	function getJobAppliedDetail() {
		$userName = $this->session->userdata('userName');
		$jobId = $this->input->post('hiddenJobId');
		$jobSeekerId = $this->input->post('hiddenJobSeekerId');
		$this->db->select(
					'ajd.id,
					ajd.jobId,
					ajd.companyId,
					ajd.jobSeekerId,
					ajd.applyDate,
					cmpy.companyName,
					jd.salary,
					jd.jobType,
					jd.maxAge,
					jd.lastApplyDate,
					jd.jobCategory,
					skill.skillName,
					country.countryName AS jobLocation,
					dest.designationName AS jobCategory,
					role.roleName,
					minqual.minQualification,
					user.userName,
					user.name AS jobSeekerName,
					user.gender,
					user.contact'
				)
			->from('apply_job_details as ajd')
			// this is the left join in codeigniter
			->join('company as cmpy','cmpy.userName = ajd.companyId','left')
			->join('job_details as jd','jd.id = ajd.jobId','left')
			->join('m_skill as skill','skill.skillId = jd.requiredSkill','left')
			->join('m_country as country','country.countryId = jd.jobLocation','left')
			->join('m_designation as dest','dest.designationId = jd.jobCategory','left')
			->join('m_role as role','role.roleId = jd.role','left')
			->join('m_min_qualification as minqual','minqual.minQualificationId = jd.minQualification','left')
			->join('users as user','user.userName = ajd.jobSeekerId','left');

		$this->db->where(array('ajd.jobId' => $jobId));
		$this->db->where(array('ajd.jobSeekerId' => $jobSeekerId));
		$jobAppliedDetail = $this->db->get();
		return $jobAppliedDetail->result()[0];
	}

	/**
	 * This jobResultAddForm method are used to add the data get from form and inserts into job_result_details table
	 * @return to the jobResultAddStatus with true or false value to controller according to database results
	 * @author kulasekaran.
	 *
	 */
	function jobResultAddForm() {
		$userName = $this->session->userdata('userName');
		$jobResultAddData = array(
			'jobId' => $this->input->post('hiddenJobId'),
			'applyJobId' => $this->input->post('hiddenApplyJobId'),
			'companyId' => $this->input->post('hiddenCompanyId'),
			'jobSeekerId' => $this->input->post('hiddenJobSeekerId'),
			'resultDate' => date('Y-m-d'),
			// 'totalMark' => $this->input->post('totalMark'),
			'obtainMark' => $this->input->post('obtainMark'),
			'resultStatus' => $this->input->post('resultStatus'),
			'created_by' => $userName,
			'delFlag' => 0
		);

		$jobResultAddStatus = $this->db->insert('job_result_details', $jobResultAddData);
		return $jobResultAddStatus;
	}

	/**
	 * This jobResultHistory method are used to retrieves the data from job_result_details
	 * @param records limit and start value is passed by JobController
	 * @return to return the jobResultHistory array value to controller
	 * @author kulasekaran.
	 *
	 */
	function jobResultHistory($limit, $start) {
		$userName = $this->session->userdata('userName');
		$filterVal = $this->input->post('filterVal');
		$this->db->limit($limit, $start);
		$this->db->select(
					'jrd.id,
					jrd.jobId,
					jrd.companyId,
					jrd.jobSeekerId,
					jrd.resultDate,
					jrd.obtainMark,
					jrd.resultStatus,
					jrd.delFlag,
					ajd.applyDate,
					jd.lastApplyDate,
					jd.jobCategory AS jobCategoryId,
					jd.salary,
					dest.designationName AS jobCategory,
					cmpy.incharge,
					cmpy.contact,
					cmpy.companyName,
					user.name AS jobSeekerName,
					user.gender,
					user.contact AS jobSeekerContact'
				)
			->from('job_result_details as jrd')
			// this is the left join in codeigniter
			->join('company as cmpy','cmpy.userName = jrd.companyId','left')
			->join('apply_job_details as ajd','ajd.id = jrd.applyJobId','left')
			->join('job_details as jd','jd.id = jrd.jobId','left')
			->join('m_designation as dest','dest.designationId = jd.jobCategory','left')
			->join('users as user','user.userName = jrd.jobSeekerId','left');
			
			// filter process
			if ($filterVal == 2) {
				$this->db->where(array('jrd.resultStatus' => 1));
			} elseif ($filterVal == 3) {
				$this->db->where(array('jrd.resultStatus' => 2));
			}

			// search process
			$hiddenSearch = $this->input->post('hiddenSearch');
			if($hiddenSearch != ""){
				$this->db->like('jrd.resultDate',trim($hiddenSearch));
			}

			// sorting process
			$sortOptn = $this->input->post('sortOptn');
			$sortVal = $this->input->post('sortVal');
			if ($sortVal == 1) {
				$this->db->order_by('user.name', $sortOptn);
			} else if ($sortVal == 2) {
				$this->db->order_by('jrd.obtainMark', $sortOptn);
			} else {
				$this->db->order_by('user.name', 'ASC');
			}
			if ($this->session->userdata('flag') == 2) {
				$this->db->where(array('jrd.companyId' => $userName));
			} else if($this->session->userdata('flag') == 3) {
				$this->db->where(array('jrd.jobSeekerId' => $userName));
			}
		$jobResultHistory = $this->db->get();
		return $jobResultHistory->result();
	}

	/**
	 * This record_count_for_job_result method are used to get the total count of data from job_result_details table
	 * @return to the total count value to controller
	 * @author kulasekaran.
	 *
	 */
	public function record_count_for_job_result() {
		// filter process
		$userName = $this->session->userdata('userName');
		$filterVal = $this->input->post('filterVal');
		// filter process
		if ($filterVal == 2) {
			$this->db->where(array('jrd.resultStatus' => 1));
		} elseif ($filterVal == 3) {
			$this->db->where(array('jrd.resultStatus' => 2));
		}

		// search process
		$hiddenSearch = $this->input->post('hiddenSearch');
		if($hiddenSearch != ""){
			$this->db->like('jrd.resultDate',trim($hiddenSearch));
		}

		// sorting process
		$sortOptn = $this->input->post('sortOptn');
		$sortVal = $this->input->post('sortVal');
		if ($sortVal == 1) {
			$this->db->order_by('user.name', $sortOptn);
		} else if ($sortVal == 2) {
			$this->db->order_by('jrd.obtainMark', $sortOptn);
		} else {
			$this->db->order_by('user.name', 'ASC');
		}
		$this->db->select('COUNT(jrd.id) as numrows');
		$this->db->from('job_result_details as jrd');
		$this->db->join('company as cmpy','cmpy.userName = jrd.companyId','left');
		$this->db->join('job_details as jd','jd.id = jrd.jobId','left');
		$this->db->join('apply_job_details as ajd','ajd.id = jrd.applyJobId','left');
		$this->db->join('m_designation as dest','dest.designationId = jd.jobCategory','left');
		$this->db->join('users as user','user.userName = jrd.jobSeekerId','left');
		if ($this->session->userdata('flag') == 2) {
			$this->db->where(array('jrd.companyId' => $userName));
		} elseif($this->session->userdata('flag') == 3) {
			$this->db->where(array('jrd.jobSeekerId' => $userName));
		}
		$result = $this->db->get();
		return $result->result()['0']->numrows;
	}

	/**
	 * This jobResultDetail method are used to get the one row data from job_result_details table
	 * @param id value of specific job result is passed from JobController
	 * @return to return the jobResultDetail array to controller
	 * @author kulasekaran.
	 *
	 */
	public function jobResultDetail($id) {
		$this->db->select(
					'jrd.id,
					jrd.jobId,
					jrd.companyId,
					jrd.jobSeekerId,
					jrd.resultDate,
					jrd.obtainMark,
					jrd.resultStatus,
					jrd.delFlag,
					jd.salary,
					jd.jobType,
					jd.lastApplyDate,
					ajd.applyDate,
					cmpy.incharge,
					cmpy.contact,
					cmpy.companyName,
					dest.designationName AS jobCategory,
					role.roleName,
					user.name AS jobSeekerName,
					user.gender,
					user.contact AS jobSeekerContact'
				)
			->from('job_result_details as jrd')
			->join('company as cmpy','cmpy.userName = jrd.companyId','left')
			->join('job_details as jd','jd.id = jrd.jobId','left')
			->join('apply_job_details as ajd','ajd.jobId = jrd.jobId','left')
			->join('m_role as role','role.roleId = jd.role','left')
			->join('m_skill as skill','skill.skillId = jd.requiredSkill','left')
			->join('m_country as country','country.countryId = jd.jobLocation','left')
			->join('m_designation as dest','dest.designationId = jd.jobCategory','left')
			->join('users as user','user.userName = jrd.jobSeekerId','left');

		$this->db->where(array('jrd.id' => $id));
		$jobResultDetail = $this->db->get();
		return $jobResultDetail->result()[0];
	}

	/**
	 * This jobResultEdit method are used to get the one row data from job_result_details table
	 * @return to return the jobResultEdit array to controller
	 * @author kulasekaran.
	 *
	 */
	function jobResultEdit() {
		$this->db->select(
							'id,
							jobId,
							obtainMark,
							resultStatus'
						);
		$this->db->where(array('id' => $this->input->post('hiddenResultJobId')));
		$jobResultEdit = $this->db->get('job_result_details');
		return $jobResultEdit->result()[0];
	}

	/**
	 * This jobResultUpdate method are used to update the one row data into the job_result_details table
	 * @return to return the jobResultUpdateStatus with true or false value to controller according to database results
	 * @author kulasekaran.
	 *
	 */
	function jobResultUpdate() {
		$userName = $this->session->userdata('userName');
		$hiddenResultJobId = $this->input->post('hiddenResultJobId');
		$jobResultUpdateData = array(
			'obtainMark' => $this->input->post('obtainMark'),
			'resultStatus' => $this->input->post('resultStatus'),
			'updated_by' => $userName
		);
		$this->db->where('id', $hiddenResultJobId);
		$resultUpdate = $this->db->update('job_result_details', $jobResultUpdateData);
		return $resultUpdate;
	}

	/**
	 * This jobResultGroupHistory method are used to retrieves the data from job_result_details
	 * @param records limit and start value is passed by JobController
	 * @return to return the jobResultGroupHistory array value to controller
	 * @author kulasekaran.
	 *
	 */
	function jobResultGroupHistory($limit, $start) {
		$jobCategoryId = $this->input->post('hiddenJobCategoryId');
		$filterVal = $this->input->post('filterVal');
		$this->db->limit($limit, $start);
		$this->db->select(
					'jrd.id,
					jrd.jobId,
					jrd.companyId,
					jrd.jobSeekerId,
					jrd.resultDate,
					jrd.obtainMark,
					jrd.resultStatus,
					jrd.delFlag,
					ajd.applyDate,
					jd.lastApplyDate,
					jd.salary,
					dest.designationName AS jobCategory,
					cmpy.companyName,
					cmpy.incharge,
					cmpy.contact,
					user.name AS jobSeekerName,
					user.gender,
					user.contact AS jobSeekerContact'
				)
			->from('job_result_details as jrd')
			// this is the left join in codeigniter
			->join('company as cmpy','cmpy.userName = jrd.companyId','left')
			->join('apply_job_details as ajd','ajd.id = jrd.applyJobId','left')
			->join('job_details as jd','jd.id = jrd.jobId','left')
			->join('m_designation as dest','dest.designationId = jd.jobCategory','left')
			->join('users as user','user.userName = jrd.jobSeekerId','left');
			
			// filter process
			if ($filterVal == 2) {
				$this->db->where(array('jrd.resultStatus' => 1));
			} elseif ($filterVal == 3) {
				$this->db->where(array('jrd.resultStatus' => 2));
			}

			// search process
			$hiddenSearch = $this->input->post('hiddenSearch');
			if($hiddenSearch != ""){
				$this->db->like('jrd.resultDate',trim($hiddenSearch));
			}

			// sorting process
			$sortOptn = $this->input->post('sortOptn');
			$sortVal = $this->input->post('sortVal');
			if ($sortVal == 1) {
				$this->db->order_by('user.name', $sortOptn);
			} else if ($sortVal == 2) {
				$this->db->order_by('jrd.obtainMark', $sortOptn);
			} else {
				$this->db->order_by('user.name', 'ASC');
			}
			$this->db->where(array('jd.jobCategory' => $jobCategoryId));
		$jobResultGroupHistory = $this->db->get();
		return $jobResultGroupHistory->result();
	}
}
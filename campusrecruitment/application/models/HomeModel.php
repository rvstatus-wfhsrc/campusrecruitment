<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeModel extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * This jobList methond are used get the all available jobList 
	 * @return a $jobListArray value to called function on any controller
	 * @author Ragav.
	 *
	 */
	public function jobList($limit, $start) {


		// $filterVal = $this->input->post('filterVal');
		// $hiddenSearch = $this->input->post('hiddenSearch');
		$this->db->limit($limit, $start);
		$this->db->select(
					'dest.designationName,
					role.roleName,
					country.countryName as jobLocation,
					jd.id,
					jd.jobCategory,
					jd.workingHour,
					jd.jobDescription,
					jd.lastApplyDate,
					jd.jobType'
				)
				->from('cmt_job_details as jd')
				->join('cmt_m_designation as dest','dest.designationId = jd.jobCategory','left')
				->join('cmt_m_role as role','role.roleId = jd.role','left')
				->join('cmt_m_country as country','country.countryId = jd.jobLocation','left')
				->join('cmt_company as cmpy', 'jd.companyId = cmpy.userName');
		$this->db->where(
						array(
							'jd.delFlag' => 0,
							'jd.lastApplyDate >=' => date('Y-m-d')
						)
					);
		// search process
		$jobKeyWords = $this->input->post('jobKeyWords');
		$area = $this->input->post('area');
		$jobCategory = $this->input->post('jobCategory');
		$likeArray = array(
						'country.countryName' => trim($area),
						'cmpy.companyName' => trim($jobKeyWords),
						'dest.designationId' => trim($jobCategory)
					);
		$this->db->like($likeArray);
		// $this->db->like('country.countryName',trim($area));
		// $this->db->like('cmpy.companyName',trim($jobKeyWords));
		// $this->db->like('dest.designationId',trim($jobCategory));
		$this->db->order_by('jd.created_date_time', 'DESC');
		$jobListArray = $this->db->get();
		return $jobListArray->result();
	}

	/**
	 * This record_count method are used to get the total count of data from job_details table
	 * @return to return the total count value to controller
	 * @author Ragav.
	 *
	 */
	public function record_count() {
		// search process
		$jobKeyWords = $this->input->post('jobKeyWords');
		$area = $this->input->post('area');
		$jobCategory = $this->input->post('jobCategory');
		$likeArray = array(
						'country.countryName' => trim($area),
						'cmpy.companyName' => trim($jobKeyWords),
						'dest.designationId' => trim($jobCategory)
					);

		$this->db->like($likeArray);
		$this->db->select('COUNT(jd.id) as numrows');
		$this->db->from('cmt_job_details as jd');
		$this->db->join('cmt_m_country as country', 'jd.jobLocation = country.countryId');
		$this->db->join('cmt_company as cmpy', 'jd.companyId = cmpy.userName');
		$this->db->join('cmt_m_designation as dest', 'jd.jobCategory = dest.designationId');
		$this->db->where(
						array(
							'jd.delFlag' => 0,
							'jd.lastApplyDate >=' => date('Y-m-d')
						)
					);

		$result = $this->db->get();
		return $result->result()['0']->numrows;
	}

}
?>
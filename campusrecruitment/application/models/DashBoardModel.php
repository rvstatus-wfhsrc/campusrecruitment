<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dash Board Model
 *
 * This Model are used to perform the company and job seeker details related to data base process
 * 
 * @author kulasekaran.
 *
 */
class DashBoardModel extends CI_Model {

	/**
	 * Dash Board Controller __construct
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
	 * This companyAreaChart method are used to retrieve the number of jobs applied in current month by job seekers for a specific company
	 * @return the companyAreaChart array
	 * @author kulasekaran.
	 *
	 */
	function companyAreaChart() {
		$currentMonth = date('m');
		$this->db->select("count(id) AS count,DATE_FORMAT(created_date_time, '%b-%d') AS date");
		$this->db->where(array('MONTH(created_date_time) =' => '12'));
		$this->db->where(array('companyId' => $this->session->userdata('userName')));
		$this->db->where(array('delFlag' => 0));
		$this->db->group_by('date');
		$companyAreaChart = $this->db->get('apply_job_details');
		return $companyAreaChart->result();
	}

	/**
	 * This companyBarChart method are used to retrieve the number of jobs applied in current year by job seekers for a specific company
	 * @return the companyBarChart array
	 * @author kulasekaran.
	 *
	 */
	function companyBarChart() {
		$currentYear = date('Y');
		$this->db->select("count(id) AS count,DATE_FORMAT(created_date_time, '%m') AS month");
		$this->db->where(array('YEAR(created_date_time)' => '2020'));
		$this->db->where(array('companyId' => $this->session->userdata('userName')));
		$this->db->where(array('delFlag' => 0));
		// $this->db->orderBy('created_at','ASC');
		$this->db->group_by('month');
		$companyBarChart = $this->db->get('apply_job_details');
		return $companyBarChart->result();
	}

	/**
	 * This companyPieChart method are used to retrieve the number of applied and cancelled jobs by job seekers for a specific company
	 * @return the companyPieChart array
	 * @author kulasekaran.
	 *
	 */
	function companyPieChart() {
		$this->db->select("count(delFlag) AS count,delFlag");
		$this->db->where(array('companyId' => $this->session->userdata('userName')));
		$this->db->group_by('delFlag');
		$companyPieChart = $this->db->get('apply_job_details');
		return $companyPieChart->result();
	}

	/**
	 * This activeJobSeeker method are used to retrieve the number of job seekers in active
	 * @return the activeJobSeeker array
	 * @author kulasekaran.
	 *
	 */
	function activeJobSeeker() {
		$this->db->select('count(id) AS activeJobSeeker');
		$this->db->where(array('flag' => 3));
		$this->db->where(array('delFlag' => 0));
		$activeJobSeeker = $this->db->get('users');
		return $activeJobSeeker->result()[0];
	}

	/**
	 * This totalJobPosted method are used to retrieve the number of jobs posted by a specific company
	 * @return the totalJobPosted array
	 * @author kulasekaran.
	 *
	 */
	function totalJobPosted() {
		$this->db->select('count(id) AS jobPosted');
		$this->db->where(array('companyId' => $this->session->userdata('userName')));
		$this->db->where(array('delFlag' => 0));
		$totalJobPosted = $this->db->get('job_details');
		return $totalJobPosted->result()[0];
	}

	/**
	 * This totalJobApplied method are used to retrieve the number of jobs applied for a specific company by job seekers
	 * @return the totalJobApplied array
	 * @author kulasekaran.
	 *
	 */
	function totalJobApplied() {
		$this->db->select('count(id) AS jobApplied');
		$this->db->where(array('companyId' => $this->session->userdata('userName')));
		$this->db->where(array('delFlag' => 0));
		$totalJobApplied = $this->db->get('apply_job_details');
		return $totalJobApplied->result()[0];
	}

	/**
	 * This totalPassResult method are used to retrieve the number of jobs applied for a specific company by job seekers is passed
	 * @return the totalPassResult array
	 * @author kulasekaran.
	 *
	 */
	function totalPassResult() {
		$this->db->select('count(id) AS passResult');
		$this->db->where(array('companyId' => $this->session->userdata('userName')));
		$this->db->where(array('resultStatus' => 1));
		$this->db->where(array('delFlag' => 0));
		$totalPassResult = $this->db->get('job_result_details');
		return $totalPassResult->result()[0];
	}

	/**
	 * This totalFailResult method are used to retrieve the number of jobs applied for a specific company by job seekers is failed
	 * @return the totalFailResult array
	 * @author kulasekaran.
	 *
	 */
	function totalFailResult() {
		$this->db->select('count(id) AS failResult');
		$this->db->where(array('companyId' => $this->session->userdata('userName')));
		$this->db->where(array('resultStatus' => 2));
		$this->db->where(array('delFlag' => 0));
		$totalFailResult = $this->db->get('job_result_details');
		return $totalFailResult->result()[0];
	}

	/**
	 * This totalJobCancelled method are used to retrieve the number of jobs cancelled for a specific company by job seekers
	 * @return the totalJobCancelled array
	 * @author kulasekaran.
	 *
	 */
	function totalJobCancelled() {
		$this->db->select('count(id) AS jobCancelled');
		$this->db->where(array('companyId' => $this->session->userdata('userName')));
		$this->db->where(array('delFlag' => 1));
		$totalJobCancelled = $this->db->get('apply_job_details');
		return $totalJobCancelled->result()[0];
	}

	/**
	 * This maxJobAppliedDate method are used to retrieve the maximum created date and time and maximum updated date and time of jobs applied for a specific company by job seekers
	 * @return the maxJobAppliedDate array
	 * @author kulasekaran.
	 *
	 */
	function maxJobAppliedDate() {
		$this->db->select('MAX(created_date_time) AS createdDateTime,MAX(updated_date_time) AS updatedDateTime');
		$this->db->where(array('delFlag' => 0));
		$maxJobAppliedDate = $this->db->get('apply_job_details');
		return $maxJobAppliedDate->result()[0];
	}
}
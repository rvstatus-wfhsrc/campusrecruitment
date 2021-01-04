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
		$this->db->select("count(*) AS count,DATE_FORMAT(created_at, '%b-%d') AS date");
		$this->db->where(array('MONTH(created_at) = ?' => [$currentMonth]));
		$this->db->where(array('companyId' => $this->session->userdata('userName')));
		$this->db->where(array('delFlag' => 0));
		// $this->db->groupBy('date');
		$companyAreaChart = $this->db->get('apply_job_details');
		return $companyAreaChart->result()[0];
	}

	/**
	 * This companyBarChart method are used to retrieve the number of jobs applied in current year by job seekers for a specific company
	 * @return the companyBarChart array
	 * @author kulasekaran.
	 *
	 */
	function companyBarChart() {
		$currentYear = date('Y');
		$this->db->select("count(*) AS count,monthname(created_date_time, '%b-%d') AS month");
		$this->db->where(array('YEAR(created_date_time)' => '2020'));
		$this->db->where(array('companyId' => $this->session->userdata('userName')));
		$this->db->where(array('delFlag' => 0));
		// $this->db->orderBy('created_at','ASC');
		// $this->db->groupBy('month');
		$companyBarChart = $this->db->get('apply_job_details');
		return $companyBarChart->result()[0];
	}

	/**
	 * This activeJobSeeker method are used to retrieve the number of job seekers in active
	 * @return the activeJobSeeker array
	 * @author kulasekaran.
	 *
	 */
	function activeJobSeeker() {
		$this->db->select('count(*) AS activeJobSeeker');
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
		$this->db->select('count(*) AS jobPosted');
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
		$this->db->select('count(*) AS jobApplied');
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
		$this->db->select('count(*) AS passResult');
		$this->db->where(array('companyId' => $this->session->userdata('userName')));
		$this->db->where(array('delFlag' => 0));
		$totalPassResult = $this->db->get('job_result_details');
		return $totalPassResult->result()[0];
	}
}
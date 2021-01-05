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
		$this->db->select("count(ajd.id) AS count,jrd.resultStatus")
			->from('apply_job_details AS ajd')
			->join('job_result_details as jrd','jrd.applyJobId = ajd.id','left');
		$this->db->group_by('jrd.resultStatus');
		$this->db->where(array('ajd.companyId' => $this->session->userdata('userName')));
		$this->db->where(array('ajd.delFlag' => '0'));
		$companyPieChart = $this->db->get();
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

	/**
	 * This activeCompany method are used to retrieve the number of companies in active
	 * @return the activeCompany array
	 * @author kulasekaran.
	 *
	 */
	function activeCompany() {
		$this->db->select('count(id) AS activeCompany');
		$this->db->where(array('flag' => 2));
		$this->db->where(array('delFlag' => 0));
		$activeCompany = $this->db->get('company');
		return $activeCompany->result()[0];
	}

	/**
	 * This allCompanyJobPosted method are used to retrieve the number of jobs posted by all companies
	 * @return the allCompanyJobPosted array
	 * @author kulasekaran.
	 *
	 */
	function allCompanyJobPosted() {
		$this->db->select('count(id) AS allJobPosted');
		$this->db->where(array('delFlag' => 0));
		$allCompanyJobPosted = $this->db->get('job_details');
		return $allCompanyJobPosted->result()[0];
	}

	/**
	 * This allJobPassResult method are used to retrieve the number of jobs applied for all companies by job seekers is passed
	 * @return the allJobPassResult array
	 * @author kulasekaran.
	 *
	 */
	function allJobPassResult() {
		$this->db->select('count(id) AS allPassResult');
		$this->db->where(array('resultStatus' => 1));
		$this->db->where(array('delFlag' => 0));
		$allJobPassResult = $this->db->get('job_result_details');
		return $allJobPassResult->result()[0];
	}

	/**
	 * This allJobFailResult method are used to retrieve the number of jobs applied for all companies by job seekers is failed
	 * @return the allJobFailResult array
	 * @author kulasekaran.
	 *
	 */
	function allJobFailResult() {
		$this->db->select('count(id) AS allFailResult');
		$this->db->where(array('resultStatus' => 2));
		$this->db->where(array('delFlag' => 0));
		$allJobFailResult = $this->db->get('job_result_details');
		return $allJobFailResult->result()[0];
	}

	/**
	 * This allCompanyJobCancelled method are used to retrieve the number of jobs cancelled for all companies by job seekers
	 * @return the allCompanyJobCancelled array
	 * @author kulasekaran.
	 *
	 */
	function allCompanyJobCancelled() {
		$this->db->select('count(id) AS allJobCancelled');
		$this->db->where(array('delFlag' => 1));
		$allCompanyJobCancelled = $this->db->get('apply_job_details');
		return $allCompanyJobCancelled->result()[0];
	}

	/**
	 * This adminAreaChart method are used to retrieve the number of jobs applied in current month by job seekers all companies
	 * @return the adminAreaChart array
	 * @author kulasekaran.
	 *
	 */
	function adminAreaChart() {
		$currentMonth = date('m');
		$this->db->select("count(id) AS count,DATE_FORMAT(created_date_time, '%b-%d') AS date");
		$this->db->where(array('MONTH(created_date_time) =' => '12'));
		$this->db->group_by('date');
		$adminAreaChart = $this->db->get('apply_job_details');
		return $adminAreaChart->result();
	}

	/**
	 * This adminBarChart method are used to retrieve the number of jobs applied in current year by job seekers for all companies
	 * @return the adminBarChart array
	 * @author kulasekaran.
	 *
	 */
	function adminBarChart() {
		$currentYear = date('Y');
		$this->db->select("count(id) AS count,DATE_FORMAT(created_date_time, '%m') AS month");
		$this->db->where(array('YEAR(created_date_time)' => '2020'));
		$this->db->group_by('month');
		$adminBarChart = $this->db->get('apply_job_details');
		return $adminBarChart->result();
	}

	/**
	 * This adminPieChart method are used to retrieve the number of applied and cancelled jobs by job seekers for all companies
	 * @return the adminPieChart array
	 * @author kulasekaran.
	 *
	 */
	function adminPieChart() {
		$this->db->select("count(ajd.id) AS count,jrd.resultStatus")
			->from('apply_job_details AS ajd')
			->join('job_result_details as jrd','jrd.applyJobId = ajd.id','left');
		$this->db->group_by('jrd.resultStatus');
		$this->db->where(array('ajd.delFlag' => '0'));
		$adminPieChart = $this->db->get();
		return $adminPieChart->result();
	}

	/**
	 * This maxAllJobAppliedDate method are used to retrieve the maximum created date and time and maximum updated date and time of jobs applied for all companies by job seekers
	 * @return the maxAllJobAppliedDate array
	 * @author kulasekaran.
	 *
	 */
	function maxAllJobAppliedDate() {
		$this->db->select('MAX(created_date_time) AS createdDateTime,MAX(updated_date_time) AS updatedDateTime');
		$maxJobAppliedDate = $this->db->get('apply_job_details');
		return $maxJobAppliedDate->result()[0];
	}
}
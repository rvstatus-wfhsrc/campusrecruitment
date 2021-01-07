<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommonModel extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	// to get the country name
	function country()
	{
		$this->db->select('countryId,countryName');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('countryName', 'asc');
		$this->db->group_by(array("countryName", "countryId"));
		$country = $this->db->get('cmt_m_country');
		$countryArray = array( '' => 'Select Country');
		foreach($country->result_array() as $row)
	    {
	        $countryArray[$row['countryId']] = $row['countryName']; // add each user id to the array
	    }
		return $countryArray;
	}

	// to get the state name
	public function state($countryId = null)
	{

		$this->db->select('stateId,stateName');
		$this->db->where(array('delFlag' => 0));
		if(isset($countryId) && $countryId != "") {
			$this->db->where(array('countryId' => $countryId));
		}
		$this->db->order_by('stateName', 'asc');
		$this->db->group_by(array("stateName", "stateId"));
		$state = $this->db->get('cmt_m_state');
		foreach($state->result_array() as $row)
	    {
	        $stateArray[$row['stateId']] = $row['stateName']; // add each user id to the array
	    }
		return $stateArray;
	}

	// to get the city name
	public function city($stateId = null)
	{
		$this->db->select('cityId,cityName');
		$this->db->where(array('delFlag' => 0));
		if(isset($stateId) && $stateId != "") {
			$this->db->where(array('stateId' => $stateId));
		}
		$this->db->order_by('cityName', 'asc');
		$this->db->group_by(array("cityName", "cityId"));
		$city = $this->db->get('cmt_m_city');
		foreach($city->result_array() as $row)
	    {
	        $cityArray[$row['cityId']] = $row['cityName']; // add each user id to the array
	    }
		return $cityArray;
	}
	
	// to get the main department name
	public static function mainDept()
	{
		$mainDept = DB::table('m_main_department')
					->where('delFlag', 0)
					->orderBy('mainDeptId', 'ASC')
					->lists('name','mainDeptId');
		return $mainDept;
	}

	// to get the department name
	public static function dept($mainDeptId)
	{
		$dept = DB::table('cmt_m_department')
					->where('delFlag', 0)
					->where('mainDeptId', $mainDeptId)
					->orderBy('departmentId', 'ASC')
					->lists('name','departmentId');
		return $dept;
	}

	// to get the counter name
	public static function counter($mainDeptId)
	{
		$counter = DB::table('m_counter')
					->where('delFlag', 0)
					->where('mainDeptId', $mainDeptId)
					->orderBy('counterId', 'ASC')
					->lists('name','counterId');
		return $counter;
	}

	// to get the employee name
	public static function employeeName()
	{
		$employeeArray = DB::table('employee')
					->where('delFlag',0)
					->orderBy('name','ASC')
					->lists('name','userName');

		return $employeeArray;
	}

	// to get the designation name
	// public static function designation()
	// {
	// 	$designation = DB::table('cmt_m_designation')
	// 				->where('delFlag', 0)
	// 				->orderBy('designationName', 'ASC')
	// 				->lists('designationName','designationId');
	// 	return $designation;
	// }

	// to get the user name
	public static function userName()
	{
		$userName = DB::table('cmt_users')
					->select(DB::raw('concat (name," (",userName,")") as name,userName'))
					->where('delFlag', 0)
					->where('adminFlag', 0)
					->orderBy('name', 'ASC')
					->lists('name','userName');
		return $userName;
	}
	
	// to get the main department name
	public static function mainDeptName($mainDeptId)
	{
		$mainDeptName = DB::table('m_main_department')
					->where('delFlag', 0)
					->where('mainDeptId', $mainDeptId)
					->select('name')
					->first();
					
		return $mainDeptName;
	}

	/**
	 * This paginationConfig methond are used design the pagination link and also config each setting for pagination
	 * @return a $pagination_config value to the called function from any controller
	 * @param $totalRecord value is integer get from the specific tabel total data count and $baseUrl value is string for idendify the module
	 * @author kulasekaran.
	 *
	 */
	public static function paginationConfig($totalRecord,$baseUrl)
	{
		$pagination_config = array();
		$pagination_config["base_url"] = $baseUrl;
		$pagination_config["total_rows"] = $totalRecord;
		$pagination_config["per_page"] = 5;
		$pagination_config['page_query_string'] = true;

		// Pagination link format 
		$pagination_config['full_tag_open'] = '<ul class="pagination">';
		$pagination_config['full_tag_close'] = '</ul>';
		$pagination_config['num_tag_open'] = '<li class="page-item">';
		$pagination_config['num_tag_close'] = '</li>';
		$pagination_config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" >';
		$pagination_config['cur_tag_close'] = '</a></li>';
		$pagination_config['next_tag_open'] = '<li class="page-item">';
		$pagination_config['next_tagl_close'] = '</a></li>';
		$pagination_config['prev_tag_open'] = '<li class="page-item">';
		$pagination_config['prev_tagl_close'] = '</li>';
		$pagination_config['first_tag_open'] = '<li class="page-item">';
		$pagination_config['first_tagl_close'] = '</li>';
		$pagination_config['last_tag_open'] = '<li class="page-item">';
		$pagination_config['last_tagl_close'] = '</a></li>';
		$pagination_config['attributes'] = array('class' => 'page-link'); 
		$pagination_config['next_link'] = lang('lbl_next'); 
		$pagination_config['prev_link'] = lang('lbl_previous');
		$pagination_config['first_link'] = lang('lbl_first'); 
		$pagination_config['last_link'] = lang('lbl_last');
		return $pagination_config;
	}

	/**
	 * This designation methond are used get the all available designation 
	 * @return a $jobCategoryArray value to called function on any controller
	 * @author kulasekaran.
	 *
	 */
	public function designation()
	{
		$this->db->select('designationId,designationName');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('designationName', 'ASC');
		$jobCategoryResults = $this->db->get('cmt_m_designation');
		$jobCategoryArray = array( '' => 'Select Job Category');
		foreach($jobCategoryResults->result_array() as $row)
		{
			$jobCategoryArray[$row['designationId']] = $row['designationName'];
		}
		return $jobCategoryArray;
	}

	/**
	 * This skill methond are used get the all available skill 
	 * @return a $skillArray value to called function on any controller
	 * @author kulasekaran.
	 *
	 */
	public function skill()
	{
		$this->db->select('skillId,skillName');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('skillName', 'ASC');
		$skillResults = $this->db->get('cmt_m_skill');
		$skillArray = array( '' => 'Select Skill');
		foreach($skillResults->result_array() as $row)
		{
			$skillArray[$row['skillId']] = $row['skillName'];
		}
		return $skillArray;
	}

	/**
	 * This role methond are used get the all available role 
	 * @return a $roleArray value to called function on any controller
	 * @author kulasekaran.
	 *
	 */
	public function role()
	{
		$this->db->select('roleId,roleName');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('roleName', 'ASC');
		$roleResults = $this->db->get('cmt_m_role');
		$roleArray = array( '' => 'Select Role');
		foreach($roleResults->result_array() as $row)
		{
			$roleArray[$row['roleId']] = $row['roleName'];
		}
		return $roleArray;
	}

	/**
	 * This minQualification methond are used get the all available minQualification 
	 * @return a $minQualificationArray value to called function on any controller
	 * @author kulasekaran.
	 *
	 */
	public function minQualification()
	{
		$this->db->select('minQualificationId,minQualification');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('minQualification', 'ASC');
		$minQualificationResults = $this->db->get('cmt_m_min_qualification');
		$minQualificationArray = array( '' => 'Select Qualification');
		foreach($minQualificationResults->result_array() as $row)
		{
			$minQualificationArray[$row['minQualificationId']] = $row['minQualification'];
		}
		return $minQualificationArray;
	}

	/**
	 * This department method are used get the all available department 
	 * @return a $departmentArray value to called function on any controller
	 * @author kulasekaran.
	 *
	 */
	public function department()
	{
		$this->db->select('departmentId,departmentName');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('departmentName', 'ASC');
		$departmentResults = $this->db->get('cmt_m_department');
		$departmentArray = array( '' => 'Select Branch');
		foreach($departmentResults->result_array() as $row)
		{
			$departmentArray[$row['departmentId']] = $row['departmentName'];
		}
		return $departmentArray;
	}

	/**
	 * This university method are used get the all available university 
	 * @return a $universityArray value to called function on any controller
	 * @author kulasekaran.
	 *
	 */
	public function university()
	{
		$this->db->select('universityId,universityName');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('universityName', 'ASC');
		$universityResults = $this->db->get('cmt_m_university');
		$universityArray = array( '' => 'Select University');
		foreach($universityResults->result_array() as $row)
		{
			$universityArray[$row['universityId']] = $row['universityName'];
		}
		return $universityArray;
	}

	/**
	 * This qualification method are used get the all available qualification 
	 * @return a $qualificationArray value to called function on any controller
	 * @author kulasekaran.
	 *
	 */
	public function qualification()
	{
		$this->db->select('qualificationId,qualification');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('qualification', 'ASC');
		$qualificationResults = $this->db->get('cmt_m_qualification');
		$qualificationArray = array( '' => 'Select Qualification');
		foreach($qualificationResults->result_array() as $row)
		{
			$qualificationArray[$row['qualificationId']] = $row['qualification'];
		}
		return $qualificationArray;
	}

	/**
	 * This getYear method are used get the all available years 
	 * @return a $yearArray value to called function on any controller
	 * @author kulasekaran.
	 *
	 */
	public function getYear()
	{
	  	$inserted = array('' => 'Select Year');
	  	$original = array_combine(range(date("Y"), 1991), range(date("Y"), 1991));
	  	$yearArray = $inserted+$original;
	  	return $yearArray;
	}

	/**
	 * This getMaxAge method are used get the all available age 
	 * @return a $maxAgeArray value to called function on any controller
	 * @author kulasekaran.
	 *
	 */
	public function getMaxAge()
	{
	  	$inserted = array('' => 'Select Maximum Age');
	  	$original = array_combine(range(18, 26), range(18, 26));
	  	$maxAgeArray = $inserted+$original;
	  	return $maxAgeArray;
	}

}
?>
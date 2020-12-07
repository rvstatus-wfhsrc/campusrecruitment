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
		$country = $this->db->get('m_country');
		$countryArray = array( '' => 'Select Country');
		foreach($country->result_array() as $row)
	    {
	        $countryArray[$row['countryId']] = $row['countryName']; // add each user id to the array
	    }
		return $countryArray;
	}

	// to get the state name
	public function state()
	{
		$this->db->select('stateId,stateName');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('stateName', 'asc');
		$this->db->group_by(array("stateName", "stateId"));
		$state = $this->db->get('m_state');
		$stateArray = array( '' => 'Select State');
		foreach($state->result_array() as $row)
	    {
	        $stateArray[$row['stateId']] = $row['stateName']; // add each user id to the array
	    }
		return $stateArray;
	}

	// to get the city name
	public function city()
	{
		$this->db->select('cityId,cityName');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('cityName', 'asc');
		$this->db->group_by(array("cityName", "cityId"));
		$city = $this->db->get('m_city');
		$cityArray = array( '' => 'Select City');
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
		$dept = DB::table('m_department')
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
	// 	$designation = DB::table('m_designation')
	// 				->where('delFlag', 0)
	// 				->orderBy('designationName', 'ASC')
	// 				->lists('designationName','designationId');
	// 	return $designation;
	// }

	// to get the user name
	public static function userName()
	{
		$userName = DB::table('users')
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

	public static function paginationConfig($totalRecord,$baseUrl)
	{
		$pagination_config = array();
		$pagination_config["base_url"] = $baseUrl;
		// $pagination_config["base_url"] = base_url()."LoginController/login";
		$pagination_config["total_rows"] = $totalRecord;
		$pagination_config["per_page"] = 5;
		$pagination_config['page_query_string'] = true;
		// Pagination link format 
		/*$pagination_config['num_tag_open'] = '<li>'; 
		$pagination_config['num_tag_close'] = '</li>'; 
		$pagination_config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">'; 
		$pagination_config['cur_tag_close'] = '</a></li>'; 
		$pagination_config['next_link'] = 'Next'; 
		$pagination_config['prev_link'] = 'Prev'; 
		$pagination_config['next_tag_open'] = '<li class="pg-next">'; 
		$pagination_config['next_tag_close'] = '</li>'; 
		$pagination_config['prev_tag_open'] = '<li class="pg-prev">'; 
		$pagination_config['prev_tag_close'] = '</li>'; 
		$pagination_config['first_tag_open'] = '<li>'; 
		$pagination_config['first_tag_close'] = '</li>'; 
		$pagination_config['last_tag_open'] = '<li>'; 
		$pagination_config['last_tag_close'] = '</li>';
		$pagination_config['attributes'] = array('class' => 'page-link');*/


		$pagination_config['full_tag_open'] = '<ul class="pagination">';
		$pagination_config['full_tag_close'] = '</ul>';
		$pagination_config['num_tag_open'] = '<li class="page-item">';
		$pagination_config['num_tag_close'] = '</li>';
		$pagination_config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$pagination_config['cur_tag_close'] = '</a></li>';
		$pagination_config['next_tag_open'] = '<li class="page-item">';
		$pagination_config['next_tagl_close'] = '</a></li>';
		$pagination_config['prev_tag_open'] = '<li class="page-item">';
		$pagination_config['prev_tagl_close'] = '</li>';
		$pagination_config['first_tag_open'] = '<li class="page-item disabled">';
		$pagination_config['first_tagl_close'] = '</li>';
		$pagination_config['last_tag_open'] = '<li class="page-item">';
		$pagination_config['last_tagl_close'] = '</a></li>';
		$pagination_config['attributes'] = array('class' => 'page-link'); 
		$pagination_config['next_link'] = 'Next'; 
		$pagination_config['prev_link'] = 'Prev';
		return $pagination_config;
	}

	/**
	 * This designation methond are used get the all available designation 
	 * @return a $jobCategoryArray value to called function on any controller
	 * @author Ragav.
	 *
	 */
	public function designation()
	{
		$this->db->select('designationId,designationName');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('designationName', 'ASC');
		$jobCategoryResults = $this->db->get('m_designation');
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
	 * @author Ragav.
	 *
	 */
	public function skill()
	{
		$this->db->select('skillId,skillName');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('skillName', 'ASC');
		$skillResults = $this->db->get('m_skill');
		$skillArray = array( '' => 'Select Required Skill');
		foreach($skillResults->result_array() as $row)
		{
			$skillArray[$row['skillId']] = $row['skillName'];
		}
		return $skillArray;
	}

	/**
	 * This role methond are used get the all available role 
	 * @return a $roleArray value to called function on any controller
	 * @author Ragav.
	 *
	 */
	public function role()
	{
		$this->db->select('roleId,roleName');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('roleName', 'ASC');
		$roleResults = $this->db->get('m_role');
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
	 * @author Ragav.
	 *
	 */
	public function minQualification()
	{
		$this->db->select('minQualificationId,minQualification');
		$this->db->where(array('delFlag' => 0));
		$this->db->order_by('minQualification', 'ASC');
		$minQualificationResults = $this->db->get('m_min_qualification');
		$minQualificationArray = array( '' => 'Select Qualification');
		foreach($minQualificationResults->result_array() as $row)
		{
			$minQualificationArray[$row['minQualificationId']] = $row['minQualification'];
		}
		return $minQualificationArray;
	}

}
?>
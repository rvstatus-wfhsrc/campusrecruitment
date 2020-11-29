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
		$countryArray = array();
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
		$stateArray = array();
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
		$cityArray = array();
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
	public static function designation()
	{
		$designation = DB::table('m_designation')
					->where('delFlag', 0)
					->orderBy('designationName', 'ASC')
					->lists('designationName','designationId');
		return $designation;
	}

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

}
?>
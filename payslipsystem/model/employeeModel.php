<?php

/**
　* employee Model
　*
　* This Model are used to perform the employee related process
　* 
　* @author kulasekaran.
　*
　*/
class employeeModel {
	public $con;
  /**
  　* employee Model __construct
  　*
  　* This __construct are used to gets the database connection
  　* 
  　* @author kulasekaran.
  　*
   */
	function __construct() {
		$this->con = mysql_connect("localhost","root","") or die("Connection failed : ".mysql_error());
		mysql_select_db("payslip",$this->con);
	}

  /**
   * This employeeList method are used to retreives the data from database related to employee
   * @param start and end is integer values,data retreived between start value and end value
   * @return a array which contains employeeList,search and sortVal
   * @author kulasekaran.
   *
   */
	function employeeList($start,$end) {
    // search process
    $search = "";
    if (isset($_REQUEST['hiddenSearch'])) {
      $search = $_REQUEST['hiddenSearch'];
    }

    // sorting process
    $sortOptn = "";
    $sortVal = "";
    if (isset($_REQUEST['sortOptn'])) {
      $sortOptn = $_REQUEST['sortOptn'];
    }
    if (isset($_REQUEST['sortVal'])) {
      $sortVal = $_REQUEST['sortVal'];
    }
    if ($sortVal == 1) {
      $sort = 'Emp_ID '.$sortOptn;
    } else if ($sortVal == 2) {
      $sort = 'FirstName '.$sortOptn;
    } else {
      $sort = 'Emp_ID DESC';
    }

    // search process
    $searchSqlQuery = "AND mstemp.Emp_ID LIKE '%$search%'";

    $year = date('Y');
    if (isset($_REQUEST['year'])) {
      $year = $_REQUEST['year'];
    }
    $month = date('m');
    if (isset($_REQUEST['month'])) {
      $month = $_REQUEST['month'];
    }
    $yearSqlQuery = " AND salary.Year = '$year'";
    $monthSqlQuery = " AND salary.Month = '$month'";

    $sql = "SELECT
              mstemp.Emp_ID,
              mstemp.FirstName,
              mstemp.LastName,
              mstemp.Mobile,
              mstemp.Emailpersonal,
              salary.id AS salaryId,
              salary.Total AS totalSalary
              FROM emp_mstemployees AS mstemp
              LEFT JOIN emp_salary AS salary ON salary.Emp_ID = mstemp.Emp_ID
              WHERE mstemp.delFlg = 0 ".$searchSqlQuery."".$yearSqlQuery."".$monthSqlQuery." ORDER BY ".$sort." LIMIT $start,$end";
		$result = mysql_query($sql,$this->con);
    $getEmployee = array();
    $i = 0;
    while($row = mysql_fetch_array($result)) {
  		$getEmployee[$i]["Emp_ID"] = $row["Emp_ID"];
  		$getEmployee[$i]["FirstName"] = $row["FirstName"];
    	$getEmployee[$i]["LastName"] = $row["LastName"];
      $getEmployee[$i]["Mobile"] = $row["Mobile"];
      $getEmployee[$i]["Emailpersonal"] = $row["Emailpersonal"];
      $getEmployee[$i]["salaryId"] = $row["salaryId"];
      $getEmployee[$i]["totalSalary"] = $row["totalSalary"];
  		$i++;
    }
    return array('employeeList' => $getEmployee,'search' => $search,'sortVal' => $sortVal,'year' => $year,'month' => $month);
	}

  /**
   * This fnGetCount method are used to gets the count of emp_mstemployees table data
   * @return the $row variable which contains count
   * @author kulasekaran.
   *
   */
	function fnGetCount() {
		$count = mysql_query("SELECT count(id) as count FROM emp_mstemployees",$this->con);
		$row = mysql_fetch_array($count);
		return $row["count"];
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
}
?>
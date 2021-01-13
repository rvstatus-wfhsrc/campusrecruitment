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
      $sort = 'Emp_ID $sortOptn';
    } else if ($sortVal == 2) {
      $sort = 'FirstName $sortOptn';
    } else {
      $sort = 'Emp_ID DESC';
    }

		$result = mysql_query("SELECT Emp_ID,FirstName,LastName,Mobile,Emailpersonal FROM emp_mstemployees WHERE Emp_ID LIKE '%$search%' ORDER BY $sort LIMIT $start,$end",$this->con);
    $getUser = array();
    $i = 0;
    while($row = mysql_fetch_array($result)) {
  		$getUser[$i]["Emp_ID"] = $row["Emp_ID"];
  		$getUser[$i]["FirstName"] = $row["FirstName"];
    	$getUser[$i]["LastName"] = $row["LastName"];
      $getUser[$i]["Mobile"] = $row["Mobile"];
      $getUser[$i]["Emailpersonal"] = $row["Emailpersonal"];
  		$i++;
    }
    return array('employeeList' => $getUser,'search' => $search,'sortVal' => $sortVal);
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
}
?>
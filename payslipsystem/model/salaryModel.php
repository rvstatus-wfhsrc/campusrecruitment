<?php
require_once "../model/database.php";

/**
　* salary Model
　*
　* This Model are used to perform the salary related process
　* 
　* @author kulasekaran.
　*
　*/
class salaryModel {
  /**
   * salary Model __construct
   *
   * This __construct is used to get the database connection
   *
   * @author kulasekaran.
   *
   */
  function __construct() {
    $database = new database();
    $this->con = $database->databaseConnection();
  }

  /**
   * This salaryList method are used to retreives the data from database related to salary
   * @param start and end is integer values,data retreived between start value and end value
   * @return the $salaryList variable
   * @author kulasekaran.
   *
   */
  function salaryList($start,$end) {
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

    $searchSqlQuery = "AND mstemp.Emp_ID LIKE '%$search%' OR mstemp.LastName LIKE '%$search%' ";
    $year = date('Y');
    if (isset($_REQUEST['year'])) {
      $year = $_REQUEST['year'];
    } else if (isset($_SESSION['year'])) {
      $year = $_SESSION['year'];
      unset($_SESSION['year']);
    }
    $month = date('m');
    if (isset($_REQUEST['month'])) {
      $month = $_REQUEST['month'];
    } else if (isset($_SESSION['month'])) {
      $month = $_SESSION['month'];
      unset($_SESSION['month']);
    }
    $yearSqlQuery = "AND salary.Year = '$year' ";
    $monthSqlQuery = "AND salary.Month = '$month' ";

    $sql = "SELECT
              mstemp.Emp_ID,
              mstemp.FirstName,
              mstemp.LastName,
              salary.id AS salaryId,
              salary.NET_Salary AS netSalary,
              salary.Total AS totalSalary
              FROM emp_mstemployees AS mstemp
              LEFT JOIN emp_salary AS salary ON salary.Emp_ID = mstemp.Emp_ID AND salary.Month = $month AND salary.Year = $year
              WHERE mstemp.delFlg = 0 ".$searchSqlQuery." ORDER BY ".$sort." LIMIT $start,$end";
    $result = mysql_query($sql,$this->con);
    $getSalary = array();
    $i = 0;
    while($row = mysql_fetch_array($result)) {
      $getSalary[$i]["Emp_ID"] = $row["Emp_ID"];
      $getSalary[$i]["FirstName"] = $row["FirstName"];
      $getSalary[$i]["LastName"] = $row["LastName"];
      $getSalary[$i]["salaryId"] = $row["salaryId"];
      $getSalary[$i]["netSalary"] = $row["netSalary"];
      $getSalary[$i]["totalSalary"] = $row["totalSalary"];
      $i++;
    }
    return $getSalary;
  }

  /**
   * This recordCountForSalary method are used to gets the count of emp_mstemployees table data
   * @return the $row variable which contains count
   * @author kulasekaran.
   *
   */
  function recordCountForSalaryList() {
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
      $sort = 'mstemp.Emp_ID '.$sortOptn;
    } else if ($sortVal == 2) {
      $sort = 'mstemp.FirstName '.$sortOptn;
    } else {
      $sort = 'mstemp.Emp_ID DESC';
    }

    $searchSqlQuery = "AND mstemp.Emp_ID LIKE '%$search%' ";
    $sql = "SELECT
              count(mstemp.Emp_ID) AS count
              FROM emp_mstemployees AS mstemp
              WHERE mstemp.delFlg = 0 ".$searchSqlQuery." ORDER BY ".$sort;
    $count = mysql_query($sql,$this->con);
    $row = mysql_fetch_array($count);
    return $row["count"];
  }

  /**
   * This salaryEmployeeHistory method are used to retreives the data from database related to individual employee salary detail 
   * @return the $salaryEmployeeHistory variable
   * @author kulasekaran.
   *
   */
  function salaryEmployeeHistory($start,$end) {
    $employeeId = $_REQUEST['hiddenEmployeeId'];
    $sql = "SELECT
              mstemp.FirstName,
              mstemp.LastName,
              salary.Emp_Id,
              salary.BasicSalary,
              salary.Insentive,
              salary.PF,
              salary.ESI,
              salary.Total AS totalSalary,
              salary.Month AS month,
              salary.Year AS year
              FROM emp_salary AS salary
              LEFT JOIN emp_mstemployees AS mstemp ON mstemp.Emp_ID = salary.Emp_Id
              WHERE salary.Emp_Id = '".$employeeId."' ORDER BY salary.Year DESC,salary.Month DESC LIMIT $start,$end";
    $result = mysql_query($sql,$this->con);
    $salaryEmployeeHistory = array();
    $i = 0;
    while($row = mysql_fetch_array($result)) {
      $salaryEmployeeHistory[$i]["FirstName"] = $row["FirstName"];
      $salaryEmployeeHistory[$i]["LastName"] = $row["LastName"];
      $salaryEmployeeHistory[$i]["Emp_Id"] = $row["Emp_Id"];
      $salaryEmployeeHistory[$i]["BasicSalary"] = $row["BasicSalary"];
      $salaryEmployeeHistory[$i]["Insentive"] = $row["Insentive"];
      $salaryEmployeeHistory[$i]["PF"] = $row["PF"];
      $salaryEmployeeHistory[$i]["ESI"] = $row["ESI"];
      $salaryEmployeeHistory[$i]["totalSalary"] = $row["totalSalary"];
      $salaryEmployeeHistory[$i]["month"] = $row["month"];
      $salaryEmployeeHistory[$i]["year"] = $row["year"];
      $i++;
    }
    return $salaryEmployeeHistory;
  }

  /**
   * This recordCountForSalaryEmployeeHistory method are used to gets the count of emp_mstemployees table data
   * @return the $row variable which contains count
   * @author kulasekaran.
   *
   */
  function recordCountForSalaryEmployeeHistory() {
    $employeeId = $_REQUEST['hiddenEmployeeId'];
    $sql = "SELECT
              count(salary.Emp_Id) AS count
              FROM emp_salary AS salary
              WHERE salary.Emp_Id = '$employeeId'";
    $count = mysql_query($sql,$this->con);
    $row = mysql_fetch_array($count);
    return $row["count"];
  }

  /**
   * This salaryAddForm method are used to get the form data and inserts into emp_salary table 
   * @return the $salaryAddStatus variable
   * @author kulasekaran.
   *
   */
  function salaryAddForm() {
    $sql = "INSERT INTO emp_salary (
                                      Emp_Id,
                                      BasicSalary,
                                      PF,
                                      ESI,
                                      Insentive,
                                      Total,
                                      Month,
                                      Year
                                    )
                            VALUES (
                                      '".$_REQUEST['hiddenEmployeeId']."',
                                      '".$_REQUEST['basicSalary']."',
                                      '".$_REQUEST['pf']."',
                                      '".$_REQUEST['esi']."',
                                      '".$_REQUEST['insentive']."',
                                      '".$_REQUEST['totalSalary']."',
                                      '".$_REQUEST['month']."',
                                      '".$_REQUEST['year']."'
                                    )";
    $salaryAddStatus = mysql_query($sql,$this->con);
    return $salaryAddStatus;
  }

  /**
   * This salaryEdit method are used to get the employee salary data from database
   * @return the $salaryEdit variable
   * @author kulasekaran.
   *
   */
  function salaryEdit() {
    $salaryId = $_REQUEST['hiddenSalaryId'];
    $sql = "SELECT
              salary.id AS salaryId,
              salary.BasicSalary,
              salary.Insentive,
              salary.PF,
              salary.ESI,
              salary.Total AS totalSalary
              FROM emp_salary AS salary
              WHERE salary.id = $salaryId ";
    $result = mysql_query($sql,$this->con);
    $getSalaryDetail = array();
    $i = 0;
    while($row = mysql_fetch_array($result)) {
      $getSalaryDetail[$i]["salaryId"] = $row["salaryId"];
      $getSalaryDetail[$i]["BasicSalary"] = $row["BasicSalary"];
      $getSalaryDetail[$i]["Insentive"] = $row["Insentive"];
      $getSalaryDetail[$i]["pf"] = $row["PF"];
      $getSalaryDetail[$i]["esi"] = $row["ESI"];
      $getSalaryDetail[$i]["totalSalary"] = $row["totalSalary"];
      $i++;
    }
    return $getSalaryDetail;
  }

  /**
   * This salaryEditForm method are used to get the form data and updates into emp_salary table 
   * @return the $salaryEditStatus variable
   * @author kulasekaran.
   *
   */
  function salaryEditForm() {
    $employeeId = $_REQUEST['hiddenEmployeeId'];
    $month = $_REQUEST['month'];
    $year = $_REQUEST['year'];
    $sql = "UPDATE emp_salary
                SET BasicSalary = '".$_REQUEST['basicSalary']."',
                    Insentive = '".$_REQUEST['insentive']."',
                    PF = '".$_REQUEST['pf']."',
                    ESI = '".$_REQUEST['esi']."',
                    Total = '".$_REQUEST['totalSalary']."'
                WHERE Emp_Id = '".$employeeId."' AND Month = '".$month."' AND Year = '".$year."'";
    $salaryEditStatus = mysql_query($sql,$this->con);
    return $salaryEditStatus;
  }

  function getSalaryId() {
    $employeeId = $_REQUEST['hiddenEmployeeId'];
    $year = $_REQUEST['year'];
    $month = $_REQUEST['month'];
    $sql = "SELECT
              salary.id AS salaryId
              FROM emp_salary AS salary
              WHERE salary.Emp_Id = '".$employeeId."' AND salary.Month = '".$month."' AND salary.Year = '".$year."'";
    $salaryId = mysql_query($sql,$this->con);
    $row = mysql_fetch_array($salaryId);
    return $row["salaryId"];
  }

}
?>
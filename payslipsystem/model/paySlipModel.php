<?php

/**
　* paySlip Model
　*
　* This Model are used to perform the pay slip related process
　* 
　* @author kulasekaran.
　*
　*/
class paySlipModel {
	public $con;
  /**
  　* paySlip Model __construct
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
   * This paySlipDetail method are used to retreives the data from database related to pay slip
   * @return the $getPaySlip variable
   * @author kulasekaran.
   *
   */
	function paySlipDetail() {
    $salaryId = $_REQUEST['hiddenSalaryId'];
    $sql = "SELECT
              mstemp.Emp_ID,
              mstemp.FirstName,
              mstemp.LastName,
              mstemp.Emailpersonal,
              salary.id AS salaryId,
              salary.Total AS totalSalary,
              salary.Month AS Month,
              salary.Year AS Year
              FROM emp_salary AS salary
              LEFT JOIN emp_mstemployees AS mstemp ON mstemp.Emp_ID = salary.Emp_ID
              WHERE mstemp.delFlg = 0 AND salary.id = ".$salaryId;
		$result = mysql_query($sql,$this->con);
    $getPaySlip = array();
    $i = 0;
    while($row = mysql_fetch_array($result)) {
      $getPaySlip[$i]["Emp_ID"] = $row["Emp_ID"];
      $getPaySlip[$i]["FirstName"] = $row["FirstName"];
      $getPaySlip[$i]["LastName"] = $row["LastName"];
      $getPaySlip[$i]["Emailpersonal"] = $row["Emailpersonal"];
      $getPaySlip[$i]["salaryId"] = $row["salaryId"];
      $getPaySlip[$i]["totalSalary"] = $row["totalSalary"];
      $getPaySlip[$i]["Month"] = $row["Month"];
      $getPaySlip[$i]["Year"] = $row["Year"];
      $i++;
    }
    return $getPaySlip;
	}

  /**
   * This downloadPaySlip method are used to retreives the data from database related to pay slip
   * @return the $paySlip variable
   * @author kulasekaran.
   *
   */
  function downloadPaySlip() {
    $salaryId = $_REQUEST['hiddenSalaryId'];
    $sql = "SELECT
              mstemp.Emp_ID,
              mstemp.FirstName,
              mstemp.LastName,
              salary.BasicSalary,
              salary.DA,
              salary.MA,
              salary.Penalty,
              salary.PF,
              salary.IT_TAX,
              salary.Insentive,
              salary.Month,
              salary.Year,
              salary.Total AS totalSalary
              FROM emp_salary AS salary
              LEFT JOIN emp_mstemployees AS mstemp ON mstemp.Emp_ID = salary.Emp_ID
              WHERE mstemp.delFlg = 0 AND salary.id = ".$salaryId;
    $result = mysql_query($sql,$this->con);
    $paySlip = array();
    $i = 0;
    while($row = mysql_fetch_array($result)) {
      $paySlip[$i]["Emp_ID"] = $row["Emp_ID"];
      $paySlip[$i]["FirstName"] = $row["FirstName"];
      $paySlip[$i]["LastName"] = $row["LastName"];
      $paySlip[$i]["BasicSalary"] = $row["BasicSalary"];
      $paySlip[$i]["DA"] = $row["DA"];
      $paySlip[$i]["MA"] = $row["MA"];
      $paySlip[$i]["Penalty"] = $row["Penalty"];
      $paySlip[$i]["PF"] = $row["PF"];
      $paySlip[$i]["IT_TAX"] = $row["IT_TAX"];
      $paySlip[$i]["Insentive"] = $row["Insentive"];
      $paySlip[$i]["Month"] = $row["Month"];
      $paySlip[$i]["Year"] = $row["Year"];
      $i++;
    }
    return $paySlip;
  }

  /**
   * This sendPaySlip method are used to retreives the data from database related to pay slip mail
   * @return the $sendPaySlip variable
   * @author kulasekaran.
   *
   */
  function sendPaySlip() {
    $salaryId = $_REQUEST['hiddenSalaryId'];
    $sql = "SELECT
              mstemp.Emp_ID,
              mstemp.Emailpersonal,
              mstemp.FirstName,
              mstemp.LastName,
              salary.Month AS Month,
              salary.Year AS Year
              FROM emp_salary AS salary
              LEFT JOIN emp_mstemployees AS mstemp ON mstemp.Emp_ID = salary.Emp_ID
              WHERE mstemp.delFlg = 0 AND salary.id = ".$salaryId;
    $result = mysql_query($sql,$this->con);
    $sendPaySlip = array();
    $i = 0;
    while($row = mysql_fetch_array($result)) {
      $sendPaySlip[$i]["Emp_ID"] = $row["Emp_ID"];
      $sendPaySlip[$i]["Emailpersonal"] = $row["Emailpersonal"];
      $sendPaySlip[$i]["FirstName"] = $row["FirstName"];
      $sendPaySlip[$i]["LastName"] = $row["LastName"];
      $sendPaySlip[$i]["Month"] = $row["Month"];
      $sendPaySlip[$i]["Year"] = $row["Year"];
      $i++;
    }
    return $sendPaySlip;
  }

  /**
   * This paySlipDetailAdd method are used to inserts the pay slip details into payslip_details table
   * @return the $paySlipDetailAddStatus variable
   * @author kulasekaran.
   *
   */
  function paySlipDetailAdd($paySlipDetails,$subject,$content) {
    $salaryId = $_REQUEST['hiddenSalaryId'];
    $sql = "INSERT INTO pay_payslip_details (
                                              Emp_Id,
                                              salaryId,
                                              toMail,
                                              subject,
                                              content,
                                              year,
                                              month,
                                              mailSendStatus,
                                              created_by,
                                              delFlag
                                            )
                                    VALUES (
                                              '".$paySlipDetails[0]['Emp_ID']."',
                                              '".$salaryId."',
                                              '".$paySlipDetails[0]['Emailpersonal']."',
                                              '".$subject."',
                                              '".$content."',
                                              '".$paySlipDetails[0]['Year']."',
                                              '".$paySlipDetails[0]['Month']."',
                                              '1',
                                              '".$_SESSION['userName']."',
                                              '0'
                                            )";
    $paySlipDetailAddStatus = mysql_query($sql,$this->con);
    return $paySlipDetailAddStatus;
  }

  /**
   * This detailView method are used to retreives the data from database related to individual employee pay slip detail 
   * @return the $detailViewArray variable
   * @author kulasekaran.
   *
   */
  function detailView($start,$end) {
    $employeeId = $_REQUEST['hiddenEmployeeId'];
    $sql = "SELECT
              mstemp.FirstName,
              mstemp.LastName,
              salary.Total AS totalSalary,
              psdetails.Emp_Id,
              psdetails.salaryId,
              psdetails.toMail,
              psdetails.subject,
              psdetails.content,
              psdetails.year,
              psdetails.month
              FROM pay_payslip_details AS psdetails
              LEFT JOIN emp_mstemployees AS mstemp ON mstemp.Emp_ID = psdetails.Emp_Id
              LEFT JOIN emp_salary AS salary ON salary.Emp_Id = psdetails.Emp_Id
              WHERE psdetails.delFlag = 0 AND psdetails.Emp_Id = '".$employeeId."' LIMIT $start,$end";
    $result = mysql_query($sql,$this->con);
    $detailViewArray = array();
    $i = 0;
    while($row = mysql_fetch_array($result)) {
      $detailViewArray[$i]["FirstName"] = $row["FirstName"];
      $detailViewArray[$i]["LastName"] = $row["LastName"];
      $detailViewArray[$i]["totalSalary"] = $row["totalSalary"];
      $detailViewArray[$i]["Emp_Id"] = $row["Emp_Id"];
      $detailViewArray[$i]["salaryId"] = $row["salaryId"];
      $detailViewArray[$i]["toMail"] = $row["toMail"];
      $detailViewArray[$i]["subject"] = $row["subject"];
      $detailViewArray[$i]["content"] = $row["content"];
      $detailViewArray[$i]["year"] = $row["year"];
      $detailViewArray[$i]["month"] = $row["month"];
      $i++;
    }
    return $detailViewArray;
  }

  /**
   * This recordCountForDetailView method are used to gets the count of emp_mstemployees table data
   * @return the $row variable which contains count
   * @author kulasekaran.
   *
   */
  function recordCountForDetailView() {
    $employeeId = $_REQUEST['hiddenEmployeeId'];
    $sql = "SELECT
              count(psdetails.Emp_Id) AS count
              FROM pay_payslip_details AS psdetails
              WHERE psdetails.delFlag = 0 AND psdetails.Emp_Id = '".$employeeId."'";
    $count = mysql_query($sql,$this->con);
    $row = mysql_fetch_array($count);
    return $row["count"];
  }

  /**
   * This downloadPaySlipOnView method are used to retreives the data from database related to download pay slip on view
   * @return the $downloadPaySlipOnView variable
   * @author kulasekaran.
   *
   */
  function downloadPaySlipOnView() {
    $salaryId = $_REQUEST['hiddenSalaryId'];
    $sql = "SELECT
              mstemp.Emp_ID,
              salary.Month AS Month,
              salary.Year AS Year
              FROM emp_salary AS salary
              LEFT JOIN emp_mstemployees AS mstemp ON mstemp.Emp_ID = salary.Emp_ID
              WHERE mstemp.delFlg = 0 AND salary.id = ".$salaryId;
    $result = mysql_query($sql,$this->con);
    $downloadPaySlipOnView = array();
    $i = 0;
    while($row = mysql_fetch_array($result)) {
      $downloadPaySlipOnView[$i]["Emp_ID"] = $row["Emp_ID"];
      $downloadPaySlipOnView[$i]["Month"] = $row["Month"];
      $downloadPaySlipOnView[$i]["Year"] = $row["Year"];
      $i++;
    }
    return $downloadPaySlipOnView;
  }
}
?>
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
    session_start();
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
              mstemp.Emailoffice,
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
      $getPaySlip[$i]["Emailoffice"] = $row["Emailoffice"];
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
              mstemp.Emailoffice,
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
      $sendPaySlip[$i]["Emailoffice"] = $row["Emailoffice"];
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
    $sql = "INSERT INTO pay_payslip_details (Emp_Id,salaryId,toMail,subject,content,year,month,mailSendStatus,created_by,delFlag)
              VALUES ('".$paySlipDetails[0]['Emp_ID']."',
                      '".$salaryId."',
                      '".$paySlipDetails[0]['Emailoffice']."',
                      '".$subject."',
                      '".$content."',
                      '".$paySlipDetails[0]['Year']."',
                      '".$paySlipDetails[0]['Month']."',
                      '1',
                      '".$_SESSION['userName']."',
                      '0')";
    $paySlipDetailAddStatus = mysql_query($sql,$this->con);
    return $paySlipDetailAddStatus;
  }
}
?>
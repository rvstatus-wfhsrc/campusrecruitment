<?php
require_once "../model/salaryModel.php";
require_once "../model/commonModel.php";
session_start();
$object = new salaryController();

/**
　* salary Controller
　*
　* This Controller are used to perform the employee's salary related process
　* 
　* @author kulasekaran.
　*
　*/
class salaryController {

	/**
	　* salary Controller __construct
	　*
	　* This __construct are used to call the methods based on screen name
	　* 
	　* @author kulasekaran.
	　*
	 */
	function __construct() {
		if(isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "salaryList") {
			Self::salaryList();
		} else if (isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "salaryEmployeeHistory") {
			Self::salaryEmployeeHistory();
		}
	}

	/**
	 * This salaryList method are used to call the salary list screen
	 * @return to view [ salary/list ]
	 * @author kulasekaran.
	 *
	 */
	function salaryList() {
		$salaryModel = new salaryModel();
		$commonModel = new commonModel();
		if (isset($_REQUEST['pageno'])) {
			$pageno = $_REQUEST['pageno'];
		} else {
			$pageno = 1;
		}
		$year = date('Y');
	    if (isset($_REQUEST['year'])) {
	      $year = $_REQUEST['year'];
	    }
	    $month = date('m');
	    if (isset($_REQUEST['month'])) {
	      $month = $_REQUEST['month'];
	    }

	    // sorting process style
		if (isset($_REQUEST["sortOptn"])) {
			$sortOptn = $_REQUEST["sortOptn"];
		} else {
			$sortOptn = "DESC";
		}
		$sortStyle = "sort_desc";
		if(isset($sortOptn) && $sortOptn == "ASC") {
			$sortStyle = "sort_asc";
		} elseif(isset($sortOptn) && $sortOptn == "DESC") {
			$sortStyle = "sort_desc";
		}

		// pagination process
		$resultsPerPage = 5;
		$startResult = ($pageno - 1) * $resultsPerPage;
		$numOfResults = $salaryModel->recordCountForSalaryList();
		$totalPages = ceil($numOfResults / $resultsPerPage);
		$getYear = $commonModel->getYear();
		$getMonth = array('' => 'Select Month','1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
		$salaryList = $salaryModel->salaryList($startResult,$resultsPerPage);
		$mainMenu = "salaryList";
		require_once '../view/salary/list.php';
	}

	/**
	 * This salaryEmployeeHistory method are used to call the salary employee history screen
	 * @return to view [ salary/employeeHistory ]
	 * @author kulasekaran.
	 *
	 */
	function salaryEmployeeHistory() {
		$salaryModel = new salaryModel();
		if (isset($_REQUEST['pageno'])) {
			$pageno = $_REQUEST['pageno'];
		} else {
			$pageno = 1;
		}

		// pagination process
		$resultsPerPage = 5;
		$startResult = ($pageno - 1) * $resultsPerPage;
		$numOfResults = $salaryModel->recordCountForSalaryEmployeeHistory();
		$totalPages = ceil($numOfResults / $resultsPerPage);
		if(isset($_REQUEST['hiddenMonth'])) {
			$month = $_REQUEST['hiddenMonth'];
		} else {
			$month = $_REQUEST['month'];
		}
		if (isset($_REQUEST['hiddenYear'])) {
			$year = $_REQUEST['hiddenYear'];
		} else {
			$year = $_REQUEST['year'];
		}
		$salaryEmployeeHistory = $salaryModel->salaryEmployeeHistory($startResult,$resultsPerPage);
		$mainMenu = "salaryEmployeeHistory";
		require_once '../view/salary/employeeHistory.php';
	}

}
?>
<?php
session_start();
require_once "../model/salaryModel.php";
require_once "../model/commonModel.php";
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
		} else if (isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "salaryAdd") {
			Self::salaryAdd();
		} else if (isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "salaryAddEditFormValidation") {
			Self::salaryAddEditFormValidation();
		} else if (isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "salaryAddForm") {
			Self::salaryAddForm();
		} else if (isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "salaryEdit") {
			Self::salaryEdit();
		} else if (isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "salaryEditForm") {
			Self::salaryEditForm();
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
		$employeeId = $_REQUEST['hiddenEmployeeId'];
		$employeeName = $_REQUEST['hiddenEmployeeName'];
		$salaryEmployeeHistory = $salaryModel->salaryEmployeeHistory($startResult,$resultsPerPage);
		$mainMenu = "salaryEmployeeHistory";
		require_once '../view/salary/employeeHistory.php';
	}

	/**
	 * This salaryAdd method are used to add the employee salary for specific month
	 * @return to view [ salary/addEdit ]
	 * @author kulasekaran.
	 *
	 */
	function salaryAdd() {
		$employeeId = $_REQUEST['hiddenEmployeeId'];
		$employeeName = $_REQUEST['hiddenEmployeeName'];
		$month = $_REQUEST['month'];
		$year = $_REQUEST['year'];
		$getMonth = array('' => 'Select Month','1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
		$mainMenu = "salaryList";
		require_once '../view/salary/addEdit.php';
	}

	/**
	 * This salaryAddEditFormValidation method are used to validate the fields of salary add and edit screen
	 * @return a json value to js in salary/addedit.js
	 * @author kulasekaran.
	 *
	 */
	function salaryAddEditFormValidation() {
		unset($_SESSION['errors']);
		if(isset($_POST)){
			if (empty($_POST['basicSalary'])) {
				$_SESSION['errors']['basicSalary'] = "The Basic Salary field is required";
			}
			if (empty($_POST['insentive'])) {
				$_SESSION['errors']['insentive'] = "The Insentive field is required";
			}
			if (empty($_POST['pf'])) {
				$_SESSION['errors']['pf'] = "The PF field is required";
			}
			if (empty($_POST['esi'])) {
				$_SESSION['errors']['esi'] = "The ESI field is required";
			}
			if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
					echo json_encode($_SESSION['errors']); exit;
				}
			}else{
				echo json_encode(true); exit;
			}
		}
	}

	
	// function salaryAddEditFormValidation() {
	// 	unset($_SESSION['errors']);
	// 	if(isset($_POST)){
	// 		if (empty($_POST['basicSalary'])) {
	// 			$_SESSION['errors']['basicSalary'] = "The Basic Salary field is required";
	// 		}
	// 		if (empty($_POST['insentive'])) {
	// 			$_SESSION['errors']['insentive'] = "The Insentive field is required";
	// 		}
	// 		if (empty($_POST['pf'])) {
	// 			$_SESSION['errors']['pf'] = "The PF field is required";
	// 		}
	// 		if (empty($_POST['esi'])) {
	// 			$_SESSION['errors']['esi'] = "The ESI field is required";
	// 		}
	// 		if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
	// 			// if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	// 				echo json_encode($_SESSION['errors']); exit;
	// 			// }
	// 		}else{
	// 			echo json_encode(true); exit;
	// 		}
	// 	}
	// }

	/**
	 * This salaryAddForm method are used to add the employee salary for specific month
	 * @return to view [ salary/employeeHistory ]
	 * @author kulasekaran.
	 *
	 */
	function salaryAddForm() {
		$salaryModel = new salaryModel();
		$salaryAddStatus = $salaryModel->salaryAddForm();
		$employeeId = $_REQUEST['hiddenEmployeeId'];
		$employeeName = $_REQUEST['hiddenEmployeeName'];
		$month = $_REQUEST['month'];
		$year = $_REQUEST['year'];
		if ($salaryAddStatus == 1) {
			$_SESSION['message'] = "Salary Registered Successfully";
			$_SESSION['status'] = "success";
		} else {
			$_SESSION['message'] = "Sorry, Something Went Wrong. Please Try Again Later";
			$_SESSION['status'] = "danger";
		}
    	Self::salaryEmployeeHistory();
	}

	/**
	 * This salaryEdit method are used to edit the employee salary for specific month
	 * @return to view [ salary/addEdit ]
	 * @author kulasekaran.
	 *
	 */
	function salaryEdit() {
		$salaryModel = new salaryModel();
		$employeeId = $_REQUEST['hiddenEmployeeId'];
		$employeeName = $_REQUEST['hiddenEmployeeName'];
		$month = $_REQUEST['month'];
		$year = $_REQUEST['year'];
		$salaryId = $_REQUEST['hiddenSalaryId'];
		$getMonth = array('' => 'Select Month','1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
		$salaryEdit = $salaryModel->salaryEdit();
		$mainMenu = "salaryList";
		require_once '../view/salary/addEdit.php';
	}

	/**
	 * This salaryEditForm method are used to edit the employee salary for specific month
	 * @return to view [ salary/employeeHistory ]
	 * @author kulasekaran.
	 *
	 */
	function salaryEditForm() {
		$salaryModel = new salaryModel();
		$salaryEditStatus = $salaryModel->salaryEditForm();
		$employeeId = $_REQUEST['hiddenEmployeeId'];
		$employeeName = $_REQUEST['hiddenEmployeeName'];
		$month = $_REQUEST['month'];
		$year = $_REQUEST['year'];
		if ($salaryEditStatus == 1) {
			$_SESSION['message'] = "Salary Updated Successfully";
			$_SESSION['status'] = "success";
		} else {
			$_SESSION['message'] = "Sorry, Something Went Wrong. Please Try Again Later";
			$_SESSION['status'] = "danger";
		}
    	Self::salaryEmployeeHistory();
	}

}
?>
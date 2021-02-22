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
		} else {
			Self::salaryList();
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
	    if ($_SESSION['languages'] == "English" ) {
			require ("../webroot/common/commonEnglish.php");
			$languageJs = "english.js";
		} else {
			require ("../webroot/common/commonJapanese.php");
			$languageJs = "japanese.js";
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
		if (!isset($_REQUEST['hiddenSalaryId'])) {
			$salaryId = $salaryModel->getSalaryId();
		}
		if ($_SESSION['languages'] == "English" ) {
			require ("../webroot/common/commonEnglish.php");
			$languageJs = "english.js";
		} else {
			require ("../webroot/common/commonJapanese.php");
			$languageJs = "japanese.js";
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
		if ($_SESSION['languages'] == "English" ) {
			require ("../webroot/common/commonEnglish.php");
			$languageJs = "english.js";
		} else {
			require ("../webroot/common/commonJapanese.php");
			$languageJs = "japanese.js";
		}
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
		if ($_SESSION['languages'] == "English" ) {
			require ("../webroot/common/commonEnglish.php");
			$languageJs = "english.js";
		} else {
			require ("../webroot/common/commonJapanese.php");
			$languageJs = "japanese.js";
		}
		unset($_SESSION['errors']);
		if(isset($_POST)){
			if (empty($_POST['basicSalary'])) {
				$_SESSION['errors']['basicSalary'] = $err_basicSalary_required;
			} else if (!filter_var($_POST['basicSalary'], FILTER_VALIDATE_INT)) {
				$_SESSION['errors']['basicSalary'] = $err_basicSalary_integer;
			}
			if (empty($_POST['insentive'])) {
				$_SESSION['errors']['insentive'] = $err_insentive_required;
			} else if (!filter_var($_POST['insentive'], FILTER_VALIDATE_INT)) {
				$_SESSION['errors']['insentive'] = $err_insentive_integer;
			}
			if (empty($_POST['pf'])) {
				$_SESSION['errors']['pf'] = $err_pf_required;
			} else if (!filter_var($_POST['pf'], FILTER_VALIDATE_INT)) {
				$_SESSION['errors']['pf'] = $err_pf_integer;
			}
			if (empty($_POST['esi'])) {
				$_SESSION['errors']['esi'] = $err_esi_required;
			} else if (!filter_var($_POST['esi'], FILTER_VALIDATE_INT)) {
				$_SESSION['errors']['esi'] = $err_esi_integer;
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
		if ($_SESSION['languages'] == "English" ) {
			require ("../webroot/common/commonEnglish.php");
			$languageJs = "english.js";
		} else {
			require ("../webroot/common/commonJapanese.php");
			$languageJs = "japanese.js";
		}
		$salaryModel = new salaryModel();
		$salaryAddStatus = $salaryModel->salaryAddForm();
		$employeeId = $_REQUEST['hiddenEmployeeId'];
		$employeeName = $_REQUEST['hiddenEmployeeName'];
		$month = $_REQUEST['month'];
		$year = $_REQUEST['year'];
		if ($salaryAddStatus == 1) {
			$_SESSION['message'] = $ses_salaryAdd_success;
			$_SESSION['status'] = "success";
		} else {
			$_SESSION['message'] = $ses_salary_fail;
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
		if ($_SESSION['languages'] == "English" ) {
			require ("../webroot/common/commonEnglish.php");
			$languageJs = "english.js";
		} else {
			require ("../webroot/common/commonJapanese.php");
			$languageJs = "japanese.js";
		}
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
		if ($_SESSION['languages'] == "English" ) {
			require ("../webroot/common/commonEnglish.php");
			$languageJs = "english.js";
		} else {
			require ("../webroot/common/commonJapanese.php");
			$languageJs = "japanese.js";
		}
		$salaryModel = new salaryModel();
		$salaryEditStatus = $salaryModel->salaryEditForm();
		$employeeId = $_REQUEST['hiddenEmployeeId'];
		$employeeName = $_REQUEST['hiddenEmployeeName'];
		$month = $_REQUEST['month'];
		$year = $_REQUEST['year'];
		if ($salaryEditStatus == 1) {
			$_SESSION['message'] = $ses_salaryUpdate_success;
			$_SESSION['status'] = "success";
		} else {
			$_SESSION['message'] = $ses_salary_fail;
			$_SESSION['status'] = "danger";
		}
    	Self::salaryEmployeeHistory();
	}

}
?>
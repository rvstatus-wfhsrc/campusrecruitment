<?php
require_once "../model/employeeModel.php";
require_once "../model/commonModel.php";
session_start();
$object = new employeeController();

/**
　* employee Controller
　*
　* This Controller are used to perform the employee related process
　* 
　* @author kulasekaran.
　*
　*/
class employeeController {

	/**
	　* employee Controller __construct
	　*
	　* This __construct are used to call the methods based on screen name
	　* 
	　* @author kulasekaran.
	　*
	 */
	function __construct() {
		if($_SESSION["logged_in"] == "true" || $_REQUEST["screenName"] == "employeeList") {
			Self::employeeList();
		}
	}

	/**
	 * This employeeList method are used to call the employee list screen
	 * @return to view [ employee/list ]
	 * @author kulasekaran.
	 *
	 */
	function employeeList() {
		$employeeModel = new employeeModel();
		$commonModel = new commonModel();
		if (isset($_REQUEST['pageno'])) {
			$pageno = $_REQUEST['pageno'];
		} else {
			$pageno = 1;
		}
		if(isset($_SESSION['month'])) {
			$month = $_SESSION['month'];
		}
		if(isset($_SESSION['year'])) {
			$year = $_SESSION['year'];
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
		$numOfResults = $employeeModel->fnGetCount();
		$totalPages = ceil($numOfResults / $resultsPerPage);
		$getYear = $commonModel->getYear();
		$getMonth = array('' => 'Select Month','1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
		$employeeListArray = $employeeModel->employeeList($startResult,$resultsPerPage);
		$mainMenu = "employeeList";
		require_once '../view/employee/list.php';
	}

}
?>
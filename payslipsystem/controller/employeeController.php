<?php
require_once "../model/employeeModel.php";
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
		if($_REQUEST["screenName"] == "employeeList") {
			Self::employeeList();
		} else if($_REQUEST["screenName"] == "sort") {
			Self::fnsort();
		} else if ($_REQUEST["screenName"] == "searching") {
			Self::fnsearching();
		} else if ($_REQUEST["screenName"] == "filtering") {
			Self::fnfiltering();
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
		if (isset($_GET['pageno'])) {
   			$pageno = $_GET['pageno'];
		} else {
			$pageno = 1;
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
		$employeeListArray = $employeeModel->employeeList($startResult,$resultsPerPage);
		require_once '../view/employee/list.php';
	}
	function fnsort() {
		$sorting = $_REQUEST["sort"];
		$processModelObject = new ProcessModel();
		$processModelObject->fnSort("$sorting");
	}
	function fnsearching() {
		$processModelObject = new ProcessModel();
		$processModelObject->fnSearch($_REQUEST["searchValue"]);
	}
	function fnfiltering() {
		$processModelObject = new ProcessModel();
		$processModelObject->fnfilter($_REQUEST["genderid"],$_REQUEST["genderid1"]);	
	}
}
?>
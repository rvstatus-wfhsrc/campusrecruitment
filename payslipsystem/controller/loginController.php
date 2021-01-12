<?php
	$object = new loginController();

	/**
	 * Login Controller
	 *
	 * This Controller are used to perform the login related process
	 * 
	 * @author kulasekaran.
	 *
	 */
	class loginController {
		
		/**
		 * Login Controller __construct
		 *
		 * This __construct are used to call the methods based on screen name
		 * 
		 * @author kulasekaran.
		 *
		 */
		function __construct() {
			if(!empty($_REQUEST['screenName']) && $_REQUEST['screenName'] == "loginform") {
				Self::loginform();
			} elseif (!empty($_REQUEST['screenName']) && $_REQUEST['screenName'] == "employeeList") {
				// print_r($_REQUEST['screenName']);exit();
				Self::employeeList();
			} else {
				Self::index();
			}
		}
		
		/**
		 * This index method are used to call the login screen
		 * @return to view [ login/login ]
		 * @author kulasekaran.
		 *
		 */
		function index() {
			require_once '../view/login/login.php';
		}

		/**
		 * This employeeList method are used to call the employee list screen
		 * @return to view [ employee/list ]
		 * @author kulasekaran.
		 *
		 */
		function employeeList() {
			require_once '../view/employee/list.php';
		}
	}
	
?>
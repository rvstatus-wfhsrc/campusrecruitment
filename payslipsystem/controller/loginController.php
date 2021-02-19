<?php
	session_start();
	$object = new loginController();

	/**
	 * login Controller
	 *
	 * This Controller are used to perform the login related process
	 * 
	 * @author kulasekaran.
	 *
	 */
	class loginController {
		
		/**
		 * login Controller __construct
		 *
		 * This __construct are used to call the methods based on screen name
		 * 
		 * @author kulasekaran.
		 *
		 */
		function __construct() {
			if (isset($_REQUEST['screenName']) && $_REQUEST['screenName'] == "loginProcess") {
				Self::loginProcess();
			} else if (isset($_REQUEST['screenName']) && $_REQUEST['screenName'] == "logout") {
				Self::logoutProcess();
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
		 * This loginProcess method are used to sets the session and redirects into employeeController
		 * @return it does not returns anything
		 * @author kulasekaran.
		 *
		 */
		function loginProcess() {
			$_SESSION["userName"] = $_REQUEST['userName'];
			$_SESSION["flag"] = 1;
			$_SESSION["logged_in"] = true;
			$_SESSION['languages'] = "English";
			header("Location: employeeController.php?time=" . date(YmdHis));
		}

		/**
		 * This logoutProcess method are used to unsets the session and calls index method to display login screen
		 * @return it does not returns anything
		 * @author kulasekaran.
		 *
		 */
		function logoutProcess() {
			session_destroy();
			Self::index();
		}
	}
	
?>
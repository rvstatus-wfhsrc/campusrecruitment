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
			} else {
				Self::index();
			}
		}
		
		/**
		 * This index method are used to call the login screen
		 * @return to view [ login/login.php ]
		 * @author kulasekaran.
		 *
		 */
		function index() {
			require_once '../view/login/login.php';
		}
	}
	
?>
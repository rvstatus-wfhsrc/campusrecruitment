<?php
$object = new loginController();
class loginController {
	// constrocter start
	function __construct() {
		if(!empty($_REQUEST['screenName']) && $_REQUEST['screenName'] == "loginform") {
			Self::loginform();
		} else {
			Self::index();
		}
	}
	// constrocter end
	function index() {
		require_once '../view/paySlip/sample.php';
	}
}
?>
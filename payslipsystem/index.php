<!-- <html>
<title>
	Pay Slip System
</title>
<body>
	<p>WELCOME</p>
</body>
</html> -->

<?php
	header("Location: controller/loginController.php?time=" . date(YmdHis));
// include_once("controller/PaySlipController.php");
// $controller = new PaySlipController();
// $controller->invoke();
?>

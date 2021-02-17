<?php
session_start();
require_once "\common\PHPExcel.php";
require_once "../model/paySlipModel.php";
require_once "\common\phpmailer\phpmailer.php";
require_once "\common\phpmailer\PHPMailerAutoload.php";
$object = new paySlipController();

/**
　* paySlip Controller
　*
　* This Controller are used to perform the pay slip related process
　* 
　* @author kulasekaran.
　*
　*/
class paySlipController {

	/**
	　* paySlip Controller __construct
	　*
	　* This __construct are used to call the methods based on screen name
	　* 
	　* @author kulasekaran.
	　*
	 */
	function __construct() {
		if(isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "paySlipView") {
			Self::paySlipView();
		} elseif (isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "downloadPaySlip") {
			Self::downloadPaySlip();
		} elseif (isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "sendPaySlip") {
			Self::sendPaySlip();
		} elseif (isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "paySlipEmployeeHistory") {
			Self::detailView();
		} elseif (isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "viewFormValidation") {
			Self::viewFormValidation();
		} elseif (isset($_REQUEST["screenName"]) && $_REQUEST["screenName"] == "downloadPaySlipOnView") {
			Self::downloadPaySlipOnView();
		} else {
			header("Location: employeeController.php?time=" . date(YmdHis));
		}
	}

	/**
	 * This paySlipView method are used to call the pay slip view screen with payslip related data
	 * @return to view [ paySlip/view ]
	 * @author kulasekaran.
	 *
	 */
	function paySlipView() {
		$this->downloadPaySlip();
		$paySlipModel = new paySlipModel();
		$paySlipDetail = $paySlipModel->paySlipDetail();
		$month = $_REQUEST['hiddenMonth'];
		$year = $_REQUEST['hiddenYear'];
		$mainMenu = "paySlipView";
		require_once '../view/paySlip/view.php';
	}

	/**
	 * This downloadPaySlip method are used to sets the data in excel and download it
	 * @return it does not return anything
	 * @author kulasekaran.
	 *
	 */
	function downloadPaySlip() {
		$filePath = "../webroot/templates/pay_slip_template.xlsx";
		$paySlipModel = new paySlipModel();
		$paySlip = $paySlipModel->downloadPaySlip();
		$getDefaultTimeZone = date_default_timezone_get();
		date_default_timezone_set('Asia/Calcutta');
		$currentDate = date("Y/m/d");
		date_default_timezone_set($getDefaultTimeZone);
		$month = date('m',$paySlipDetail[0]['Month']);
		$date = date('d');
		$totalAddition = $paySlip[0]['BasicSalary'] + $paySlip[0]['Insentive'] + $paySlip[0]['DA'] + $paySlip[0]['MA'];
		$totalDeduction = $paySlip[0]['IT_TAX'] + $paySlip[0]['PF'] + $paySlip[0]['Penalty'];
		$netSalary = $totalAddition - $totalDeduction;
		$fileName = 'pay_slip_'.$paySlip[0]['Emp_ID'].'_'.$paySlip[0]['Year'].$month.$date.'.xls';
		$excelObject = new PHPExcel();
		$excelObject = PHPExcel_IOFactory::load($filePath);
		$excelObject->setActiveSheetIndex(0)
										->setCellValue("E6",$paySlip[0]['FirstName']." ".$paySlip[0]['LastName'])
										->setCellValue("D8",$paySlip[0]['Month'])
										->setCellValue("D10",$paySlip[0]['Year'])
										->setCellValue("F14",$paySlip[0]['BasicSalary'])
										->setCellValue("F15",$paySlip[0]['Insentive'])
										->setCellValue("F16",$paySlip[0]['DA'])
										->setCellValue("F17",$paySlip[0]['MA'])
										->setCellValue("K14",$paySlip[0]['IT_TAX'])
										->setCellValue("K15",$paySlip[0]['PF'])
										->setCellValue("K16",$paySlip[0]['Penalty'])
										->setCellValue("F19",$totalAddition)
										->setCellValue("K19",$totalDeduction)
										->setCellValue("K20",$netSalary)
										->setCellValue("L6",$currentDate);
		$writerObject = PHPExcel_IOFactory::createwriter($excelObject,"Excel5");
		ob_end_clean();
		$path = '../webroot/download/payslip';
		if(!is_dir($path)) {
			mkdir($path, 0755, true);
		}
		$file = 'pay_slip_'.$paySlip[0]['Emp_ID'].'_'.$paySlip[0]['Year']."_".$month.'.xls';
		$writerObject->save(str_replace('.php', '.xls', $path.'/'. $file));
	}

	/**
	 * This sendPaySlip method are used to send the mail with pay slip excel
	 * @return it does not return anything
	 * @author kulasekaran.
	 *
	 */
	function sendPaySlip() {
		$paySlipModel = new paySlipModel();
		$sendPaySlip = $paySlipModel->sendPaySlip();
		$month = date('m',$sendPaySlip[0]['Month']);
		$date = date('d');
		$subject = $_REQUEST['subject'];
		$content = $_REQUEST['content'];
		$cc = $_REQUEST['cc'];
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = "c.krishnaragav@gmail.com";
		$mail->Password = "pvictulryihbwpjn";
		$mail->setFrom('c.krishnaragav@gmail.com', 'krishna Ragav');
		$mail->addReplyTo('c.krishnaragav@gmail.com', 'krishna Ragav');
		$mail->addAddress($_REQUEST['toMail'], $sendPaySlip[0]['FirstName']." ".$sendPaySlip[0]['LastName']);
		$mail->Subject = $subject;
		$mail->Body = $content;
		$mail->AddCC($cc);
		$mail->addAttachment('../webroot/download/payslip/pay_slip_'.$sendPaySlip[0]['Emp_ID'].'_'.$sendPaySlip[0]['Year']."_".$month.'.xls');
		if (!$mail->send()) {
    		echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			$paySlipDetailAdd = $paySlipModel->paySlipDetailAdd($sendPaySlip,$subject,$content);
			$_SESSION['message'] = "Pay Slip Mail Send Successfully";
			$_SESSION['status'] = "success";
			$_SESSION['month'] = $_REQUEST['month'];
			$_SESSION['year'] = $_REQUEST['year'];
    		header("Location: employeeController.php?time=" . date(YmdHis));
		}
	}

	/**
	 * This detailView method are used to call the pay slip employee history screen
	 * @return to view [ paySlip/employeeHistory ]
	 * @author kulasekaran.
	 *
	 */
	function detailView() {
		$paySlipModel = new paySlipModel();
		if (isset($_REQUEST['pageno'])) {
			$pageno = $_REQUEST['pageno'];
		} else {
			$pageno = 1;
		}

		// pagination process
		$resultsPerPage = 5;
		$startResult = ($pageno - 1) * $resultsPerPage;
		$numOfResults = $paySlipModel->recordCountForDetailView();
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
		$detailView = $paySlipModel->detailView($startResult,$resultsPerPage);
		$mainMenu = "paySlipEmployeeHistory";
		require_once '../view/paySlip/employeeHistory.php';
	}

	function viewFormValidation() {
		unset($_SESSION['errors']);
		if(isset($_POST)){
			if (empty($_POST['toMail'])) {
				$_SESSION['errors']['toMail'] = "The To field is required";
			} elseif (!filter_var($_POST['toMail'], FILTER_VALIDATE_EMAIL)) {
				$_SESSION['errors']['toMail'] = "The E-Mail Address is invalid.";
			}
			if (empty($_POST['cc'])) {
				$_SESSION['errors']['cc'] = "The CC field is required";
			}
			if (empty($_POST['subject'])) {
				$_SESSION['errors']['subject'] = "The Subject field is required";
			}
			if (empty($_POST['content'])) {
				$_SESSION['errors']['content'] = "The Content field is required";
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

	/**
	 * This downloadPaySlipOnView method are used to download the excel
	 * @return it does not return anything
	 * @author kulasekaran.
	 *
	 */
	function downloadPaySlipOnView() {
		$excelObject = new PHPExcel();
		$fileName = $_REQUEST['hiddenFileName'];
		$filePath = '../webroot/download/payslip/'.$fileName;
		if(file_exists($filePath)) {
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename= $fileName");
			readfile($filePath);
		} else {
			echo "This File does not exist.";
		}
	}
}
?>
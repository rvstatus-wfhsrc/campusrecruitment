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
		if($_REQUEST["screenName"] == "paySlipView") {
			Self::paySlipView();
		} elseif ($_REQUEST["screenName"] == "downloadPaySlip") {
			Self::downloadPaySlip();
		} elseif ($_REQUEST["screenName"] == "sendPaySlip") {
			Self::sendPaySlip();
		}
	}

	/**
	 * This paySlipView method are used to call the pay slip view screen with payslip related data
	 * @return to view [ paySlip/view ]
	 * @author kulasekaran.
	 *
	 */
	function paySlipView() {
		$paySlipModel = new paySlipModel();
		$paySlipDetail = $paySlipModel->paySlipDetail();
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
		$fileName = 'pay_slip_'.$paySlip[0]['Emp_ID'].'_'.$paySlip[0]['Year'].$month.$date.'.xlsx';
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
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename= $fileName");
		$writerObject->save(str_replace(__FILE__,'C:\xampp\htdocs\github\campusgit\payslipsystem\webroot\download\payslip\pay_slip_'.$paySlip[0]['Emp_ID'].'_'.$paySlip[0]['Year'].$month.$date.'.xlsx',__FILE__));
		if($insertResults) {
			echo "Successfully Registered";
		} else {
			echo "Mysql Error";
		}
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
		$subject = "Pay Slip_".$sendPaySlip[0]['Year']."_".$month."_".$date;
		$content = 'This is a plain text message body';
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
		$mail->addAddress('kulasekaran337@gmail.com','Kulasekaran A');
		// $mail->addAddress($sendPaySlip[0]['Emailpersonal'], $sendPaySlip[0]['FirstName']." ".$sendPaySlip[0]['LastName']);
		$mail->Subject = $subject;
		$mail->Body = $content;
		$mail->addAttachment('C:\xampp\htdocs\github\campusgit\payslipsystem\webroot\download\payslip\pay_slip_'.$sendPaySlip[0]['Emp_ID'].'_'.$sendPaySlip[0]['Year'].$month.$date.'.xlsx');
		if (!$mail->send()) {
    		echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			$paySlipDetailAdd = $paySlipModel->paySlipDetailAdd($sendPaySlip,$subject,$content);
			$_SESSION['message'] = "Pay Slip Mail Send Successfully";
			$_SESSION['status'] = "success";
    		header("Location: employeeController.php?time=" . date(YmdHis));
		}
	}
}
?>
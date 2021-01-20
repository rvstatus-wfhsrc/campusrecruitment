<?php
require_once "\common\PHPExcel.php";
require_once "../model/paySlipModel.php";
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
		$totalAddition = $paySlip[0]['BasicSalary'] + $paySlip[0]['Insentive'] + $paySlip[0]['DA'] + $paySlip[0]['MA'];
		$totalDeduction = $paySlip[0]['IT_TAX'] + $paySlip[0]['PF'] + $paySlip[0]['Penalty'];
		$netSalary = $totalAddition - $totalDeduction;
		$fileName = $paySlip[0]['Emp_ID'].'.xlsx';
		$excelObject = new PHPExcel();
		$excelObject = PHPExcel_IOFactory::load($filePath);
		$excelObject->setActiveSheetIndex(0)
										->setCellValue("D6",$paySlip[0]['FirstName']." ".$paySlip[0]['LastName'])
										->setCellValue("C8",$paySlip[0]['Month'])
										->setCellValue("C10",$paySlip[0]['Year'])
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
										->setCellValue("M6",$currentDate);
		$writerObject = PHPExcel_IOFactory::createwriter($excelObject,"Excel5");
		ob_end_clean();
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename= $fileName");
		$writerObject->save("php://output");
		if($insertResults) {
			echo "Successfully Registered";
		} else {
			echo "Mysql Error";
		}
	}

}
?>
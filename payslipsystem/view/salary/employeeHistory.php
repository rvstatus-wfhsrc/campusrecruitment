<?php require_once "../model/commonModel.php"; ?>
<!doctype html>
<html lang="en">
	<head>
		<title><?php echo $lbl_paySlip; ?> | <?php echo $lbl_salary." ".$lbl_employee." ".$lbl_history; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../webroot/css/style.css">
		<link rel="stylesheet" href="../webroot/css/common.css">
		<script type="text/javascript">
			var dateTime = "<?php echo date('Ymdhis'); ?>";
		</script>
		<style>
			/* session flash message design */
			.fmsg {
				font-size: 14px;
				/*margin-left: 300px;*/
				width: 80%;
				margin-bottom: 0px;
				padding-top: 1px;
				padding-bottom: 1px;
			}
		</style>
	</head>
	<body>
		<div class="wrapper d-flex align-items-stretch">
			<nav class="navbar navbar-inverse navbar-fixed-top h5 pt-0">
				<div class="container-fluid mb-6">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a data-toggle="dropdown" href="#"><?php echo $lbl_employee; ?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="javascript:;" onclick="fnEmployeeList()"><?php echo $lbl_list; ?></a></li>
							</ul>
						</li>
						<li class="dropdown active">
							<a data-toggle="dropdown" href="#"><?php echo $lbl_salary; ?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="javascript:;" onclick="fnSalaryList()"><?php echo $lbl_list; ?></a></li>
							</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a data-toggle="dropdown" href="#"><span class="fa fa-language"></span> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="javascript:;" onclick="fnLanguageEnglish()" class="<?php if($_SESSION['languages'] == "1") { echo 'nav-selected'; } ?>">English</a></li>
								<li><a href="javascript:;" onclick="fnLanguageJapanese()" class="<?php if($_SESSION['languages'] == "2") { echo 'nav-selected'; } ?>">Japanese</a></li>
							</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a data-toggle="dropdown" href="#"><span class="fa fa-user"></span> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="javascript:;" onclick="fnLogout()"><?php echo $lbl_logout; ?></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- <nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
						<i class="fa fa-bars"></i>
						<span class="sr-only">Toggle Menu</span>
					</button>
				</div>
				<div class="p-4 pt-5">
					<h1> -->
						<!-- <a href="index.html" class="logo">Splash</a> -->
					<!-- </h1>
					<ul class="list-unstyled components mb-5">
						<li class="active">
							<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $lbl_employee; ?></a>
							<ul class="collapse list-unstyled show" id="homeSubmenu">
								<li class="<?php if($mainMenu == 'employeeList') { echo('active'); } ?>">
									<a href="javascript:;" onclick="fnEmployeeList()"><?php echo $lbl_list; ?></a>
								</li>
							</ul>
						</li>
						<li class="">
							<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $lbl_salary; ?></a>
							<ul class="collapse list-unstyled show" id="homeSubmenu">
								<li class="<?php if($mainMenu == 'salaryList') { echo('active'); } ?>">
									<a href="javascript:;" onclick="fnSalaryList()"><?php echo $lbl_list; ?></a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;" onclick="fnLogout()"><?php echo $lbl_logout; ?></a>
						</li>
					</ul>
					<div class="footer">
						<p> -->
							<!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Pay Slip System -->
						<!-- </p>
					</div>
				</div>
			</nav> -->
			<!-- Page Content  -->
			<div id="content" class="p-4 p-md-5 pt-5 mt70">
				<form action="../controller/salaryController.php?time=<?php echo(date('YmdHis')); ?>" method="POST" id="employeeHistoryForm" name="employeeHistoryForm">
					<input type="hidden" id="screenName" name="screenName">
					<input type="hidden" id="month" name="month" value="<?php echo $month; ?>">
					<input type="hidden" id="year" name="year" value="<?php echo $year; ?>">
					<input type="hidden" id="pageno" name="pageno" value="<?php echo $pageno; ?>">
					<input type="hidden" id="hiddenSalaryId" name="hiddenSalaryId">
					<input type="hidden" id="hiddenEmployeeId" name="hiddenEmployeeId" value="<?php echo $employeeId; ?>">
					<input type="hidden" id="hiddenEmployeeName" name="hiddenEmployeeName" value="<?php echo $employeeName; ?>">
					<input type="hidden" id="hiddenLanguage" name="hiddenLanguage">
					<div class="inb w40">
						<h2>
							<?php echo $lbl_salary." ".$lbl_employee." ".$lbl_history; ?>
						</h2>
					</div>
					<div class="inb w50">
						<!-- session message -->
						<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?php echo $_SESSION['status']; ?> fmsg tac">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php
							endif;
							unset($_SESSION['message']);
							unset($_SESSION['status']);
						?>
					</div>
					<div class="mb-1">
						<a class="btn btn-info editBtn" href="javascript:;" onclick="fnBackBtn(<?php echo $month; ?>,<?php echo $year; ?>)">
							<i class="fa fa-chevron-left fa-btn mr-1"></i><?php echo $lbl_back; ?>
						</a>
						<?php if((isset($_REQUEST['hiddenSalaryId']) && $_REQUEST['hiddenSalaryId'] != null) || (isset($salaryId) && $salaryId != null)) {
							if (isset($_REQUEST['hiddenSalaryId'])) {
								$employeeSalaryId = $_REQUEST['hiddenSalaryId'];
							} else {
								$employeeSalaryId = $salaryId;
							} ?>

							<a class="btn btn-warning text-white editBtn" href="javascript:;" onclick="fnSalaryEditBtn(<?php echo $employeeSalaryId; ?>)">
								<i class="fa fa-edit fa-btn mr-1"></i><?php echo $lbl_editSalary; ?>
							</a>
						<?php } else { ?>
							<a class="btn btn-success editBtn" href="javascript:;" onclick="fnSalaryAddBtn()">
								<i class="fa fa-plus fa-btn mr-1"></i><?php echo $lbl_addSalary; ?>
							</a>
						<?php } ?>
					</div>
					<?php
						$commonModel = new commonModel();
						$empIDColor = $commonModel->getEmpIDColor($_REQUEST['hiddenEmployeeId']);
					?>
					<div class="inb">
						<label> <?php echo $lbl_employee." ".$lbl_id; ?> :</label>
						<span style="color:<?php echo $empIDColor; ?>">
							<?php echo $_REQUEST['hiddenEmployeeId']; ?>
						</span>
					</div>
					<div class="inb ml-5">
						<label> <?php echo $lbl_employee." ".$lbl_name; ?> :</label>
						<span class="nameClr">
							<?php echo $_REQUEST['hiddenEmployeeName']; ?>
						</span>
					</div>
					<table class="table table-bordered table-position">
						<colgroup>
							<col width="1%">
							<col width="18%">
							<col width="17%">
							<col width="16%">
							<col width="16%">
							<col width="16%">
							<col width="16%">
						</colgroup>
						<thead class="thead">
							<tr>
								<th><?php echo $lbl_serialNumber; ?></th>
								<th><?php echo $lbl_year." / ".$lbl_month; ?></th>
								<th><?php echo $lbl_basicSalary; ?></th>
								<th><?php echo $lbl_insentive; ?></th>
								<th><?php echo $lbl_pf; ?></th>
								<th><?php echo $lbl_esi; ?></th>
								<th title="<?php echo $lbl_totalSalary; ?>"><?php echo $lbl_salary; ?></th>
							</tr>
						</thead>
						<?php if ($salaryEmployeeHistory != null) { ?>
							<?php $i = 0;
							foreach ($salaryEmployeeHistory as $key => $history) { ?>
								<?php $class = $key % 2 === 0 ? 'odd' : 'even'; ?>
								<tr class="<?php echo $class; ?>">
									<td class="tac"><?php echo ($pageno - 1) * $resultsPerPage + $key + 1 ?></td>
									<td class="tac"><?php echo $salaryEmployeeHistory[$i]["year"]; ?> / <?php echo $salaryEmployeeHistory[$i]["month"]; ?></td>
									<td class="tar"><?php echo number_format($salaryEmployeeHistory[$i]["BasicSalary"]); ?> &#8377;</td>
									<td class="tar"><?php echo number_format($salaryEmployeeHistory[$i]["Insentive"]); ?> &#8377;</td>
									<td class="tar"><?php echo number_format($salaryEmployeeHistory[$i]["PF"]); ?> &#8377;</td>
									<td class="tar"><?php echo number_format($salaryEmployeeHistory[$i]["ESI"]); ?> &#8377;</td>
									<td class="<?php if (isset($salaryEmployeeHistory[$i]["totalSalary"])) { echo "tar"; } else { echo "tac"; } ?>">
										<?php if(isset($salaryEmployeeHistory[$i]["totalSalary"])) {
											echo number_format($salaryEmployeeHistory[$i]["totalSalary"]); ?> &#8377;
										<?php } else {
											echo ("-");
										} ?>
									</td>
								</tr>
							<?php $i++;
							}
						} else { ?>
							<tr>
								<td colspan="7" class="tac noDataFoundClr">No data found</td>
							</tr>
						<?php } ?>
					</table>
					<?php if ($salaryEmployeeHistory != null) { ?>
						<?php if ($numOfResults > 5) { ?>
							<div class="pagination">
								<?php if($pageno > 1) {
									$prev = $pageno - 1;
									echo '<a href="javascript:;" onclick="fnPagination(1)">&laquo;</a>';
									echo '<a href="javascript:;" onclick="fnPagination('.$prev.')">Prev</a>&nbsp';
								} else {
									echo '<a>&laquo</a>';
									echo '<a>Prev</a>';
								}
								$start = $pageno;
								$end = $start + 2;
								if($end > $totalPages) {
									$end = $totalPages;
								}
								if($pageno > 3) {
									$start = $pageno - 1;
									$end = $pageno + 1;
									if($end > $totalPages) {
										$start = $totalPages - 2; 
										$end = $totalPages; 
									}
								}
								for ($i = $start; $i <= $end; $i++) {
									if($i == $pageno)
										echo '<a class = "active">'.$i.'</a>&nbsp;';
									else
										echo '<a href="javascript:;" onclick="fnPagination('.$i.')">'.$i.'</a>&nbsp;';
								}
								if ($pageno < $totalPages) {
									$next = $pageno + 1;
									echo '<a href="javascript:;" onclick="fnPagination('.$next.')">Next</a>';
									echo '<a href="javascript:;" onclick="fnPagination('.$totalPages.')">&raquo;</a>&nbsp';
								} else {
									echo '<a>Next</a>';
									echo '<a>&raquo</a>';
								}
								?>
							</div>
						<?php } ?>
					<?php } ?>
				</form>
			</div>
		</div>
		<script type="text/javascript" src="../webroot/js/jquery.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/popper.js" ></script>
		<script type="text/javascript" src="../webroot/js/main.js" ></script>
		<script type="text/javascript" src="../webroot/js/salary/employeeHistory.js" ></script>
	</body>
</html>
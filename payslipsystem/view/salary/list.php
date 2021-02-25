<?php require_once "../model/commonModel.php"; ?>
<!doctype html>
<html lang="en">
	<head>
		<title><?php echo $lbl_paySlip; ?> | <?php echo $lbl_salary." ".$lbl_list; ?></title>
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
								<li><a href="javascript:;" onclick="fnSalaryList()" class="<?php if($mainMenu == "salaryList") { echo 'nav-selected'; } ?>"><?php echo $lbl_list; ?></a></li>
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
							<ul class="collapse list-unstyled <?php if($mainMenu == 'salaryList') { echo('show'); } ?>" id="homeSubmenu">
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
			<form action="../controller/salaryController.php?time=<?php echo(date('YmdHis')); ?>" method="POST" id="listForm" name="listForm">
				<input type="hidden" id="screenName" name="screenName">
				<input type="hidden" id="hiddenEmployeeId" name="hiddenEmployeeId">
				<input type="hidden" id="hiddenEmployeeName" name="hiddenEmployeeName">
				<input type="hidden" id="hiddenYear" name="hiddenYear">
				<input type="hidden" id="hiddenMonth" name="hiddenMonth">
				<input type="hidden" id="hiddenSalaryId" name="hiddenSalaryId">
				<input type="hidden" id="hiddenLanguage" name="hiddenLanguage">
				<input type="hidden" id="hiddenSearch" name="hiddenSearch" value="<?php if(isset($_REQUEST['search'])) { echo $_REQUEST['search']; } ?>">
				<input type="hidden" id="pageno" name="pageno" value="<?php echo $pageno; ?>">
				<div id="content" class="p-4 p-md-5 pt-5 mt70">
					<div class="inb w100">
						<h2>
							<?php echo $lbl_salary." ".$lbl_list; ?>
						</h2>
					</div>
					<div class="inb float-left">
						<label for="year"><?php echo $lbl_year; ?> : </label>
						<span>
							<select id="year" name="year" class="form-control h34 inb autowidth">
								<?php
									$selectedYear = date('Y');
									if($_REQUEST['year'] != null ) {
										$selectedYear = $_REQUEST['year'];
									} else if(isset($year)) {
										$selectedYear = $year;
									}
									foreach($getYear as $years) {
										$yearOption = "<option value=".$years;
										if($selectedYear == $years) {$yearOption .= " selected";}$yearOption .= ">".$years."</option>";
										echo $yearOption;
									}
								?> 
							</select>
						</span>
					</div>
					<div class="inb ml-2 float-left">
						<label for="month"><?php echo $lbl_month; ?> : </label>
						<span>
							<select id="month" name="month" class="form-control h34 inb autowidth">
								<?php
									$selectedMonth = date('m');
									if($_REQUEST['month'] != null ) {
										$selectedMonth = $_REQUEST['month'];
									} else if(isset($month)) {
										$selectedMonth = $month;
									}
									foreach($getMonth as $key => $months) {
										$monthOption = "<option value=".$key;
										if($selectedMonth == $key) {$monthOption .= " selected";}$monthOption .= ">".$months."</option>";
										echo $monthOption;
									}
								?>
							</select>
						</span>
					</div>
					<div class="float-right mb5 w50">
						<!-- clear search -->
						<div  class="inb mt-1">
							<a href="javascript:;" onclick="fnClearSearch()">
								<img style="width: 26px;" src="../webroot/images/clearsearch.png" title="Clear Search">
							</a>
						</div>
						<!-- sorting process -->
						<div class="inb">
							<select name="sortProcess" id="sortProcess" class="form-control autowidth h34 inb mr-2 CMN_sorting <?php echo $sortStyle; ?>">
								<option value='1' <?php if(isset($_REQUEST['sortVal']) && $_REQUEST['sortVal'] == 1) { ?>selected <?php } ?>>Employee Id</option>
								<option value='2' <?php if(isset($_REQUEST['sortVal']) && $_REQUEST['sortVal'] == 2) { ?>selected <?php } ?>>Employee Name</option>
							</select>
							<input type="hidden" id="sortVal" name="sortVal" value="<?php echo $_REQUEST['sortVal']?>">
							<input type="hidden" id="sortOptn" name="sortOptn" value="<?php echo $sortOptn; ?>">
						</div>
						<!-- searching process -->
						<div class="input-group searchBtn">
							<input type="text" id="search" name="search" placeholder="Search Employee Id / Name" class="input_box form-control h34" value="<?php if(isset($_REQUEST['search'])) { echo $_REQUEST['search']; } ?>">
							<div class="input-group-append">
								<a class="btn btn-secondary h34" href="javascript:;" onclick="fnSearch()">
									<i class="fa fa-search" title="Search"></i>
								</a>
							</div>
						</div>
					</div>
					<table class="table table-bordered table-position">
						<colgroup>
							<col width="1%">
							<col width="15%">
							<col>
							<!-- <col width="12%"> -->
							<col width="15%">
						</colgroup>
						<thead class="thead">
							<tr>
								<th><?php echo $lbl_serialNumber; ?></th>
								<th><?php echo $lbl_employee." ".$lbl_id; ?></th>
								<th><?php echo $lbl_name; ?></th>
								<!-- <th>Net Salary</th> -->
								<th title="Total Salary"><?php echo $lbl_salary; ?></th>
							</tr>
						</thead>
						<?php
							if ($salaryList != null) { ?>
							<?php
								if(isset($_REQUEST['month'])) {
									$month = $_REQUEST['month'];
								} else if (isset($month)) {
									$month = $month;
								}
								if(isset($_REQUEST['year'])) {
									$year = $_REQUEST['year'];
								} else if (isset($year)) {
									$year = $year;
								}
								$i = 0;
								$commonModel = new commonModel();
								foreach ($salaryList as $key => $list) { ?>
									<?php $class = $key % 2 === 0 ? 'odd' : 'even'; ?>
									<tr class="<?php echo $class; ?>">
										<td class="tac"><?php echo ($pageno - 1) * $resultsPerPage + $key + 1 ?></td>
										<?php $empIDColor = $commonModel->getEmpIDColor($salaryList[$i]['Emp_ID']); ?>
										<td class="tac">
											<a href="javascript:;" onclick="fnSalaryEmployeeHistory('<?php echo $salaryList[$i]['Emp_ID']; ?>','<?php echo $salaryList[$i]['FirstName']." ".$salaryList[$i]['LastName']; ?>',<?php echo $month; ?>,<?php echo $year; ?>,<?php echo $salaryList[$i]["salaryId"]; ?>)" style="color:<?php echo $empIDColor; ?>">
												<?php echo $salaryList[$i]["Emp_ID"]; ?>
											</a>
										</td>
										<td class="nameClr"><?php echo $salaryList[$i]["FirstName"]." ".$salaryList[$i]["LastName"]; ?>
										</td>
										<!-- <td class="tac vam">
											<?php if (isset($salaryList[$i]["netSalary"])) {
												echo $salaryList[$i]["netSalary"];
											} else {
												echo '-';
											} ?>
										</td> -->
										<td class="<?php if (isset($salaryList[$i]["totalSalary"])) { echo "tar"; } else { echo "tac"; } ?> vam">
											<?php if (isset($salaryList[$i]["totalSalary"])) {
												echo number_format($salaryList[$i]["totalSalary"]); ?> &#8377;
											<?php } else {
												echo '-';
											} ?>
										</td>
									</tr>
								<?php
									$i++;
									}
									} else {
								?>
								<tr>
									<td colspan="4" class="tac noDataFoundClr">No data found</td>
								</tr>
							<?php } ?>
					</table>
					<?php if ($salaryList != null) { ?>
						<?php if ($numOfResults > 5) { ?>
							<div class="pagination mr19">
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
				</div>
			</form>
		</div>
		<script type="text/javascript" src="../webroot/js/jquery.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/popper.js" ></script>
		<script type="text/javascript" src="../webroot/js/main.js" ></script>
		<script type="text/javascript" src="../webroot/js/salary/list.js" ></script>
	</body>
</html>
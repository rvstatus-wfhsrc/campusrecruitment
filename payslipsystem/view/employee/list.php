<!doctype html>
<html lang="en">
	<head>
		<title>Pay Slip | Employee List</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../webroot/css/style.css">
		<link rel="stylesheet" href="../webroot/css/common.css">
		<script type="text/javascript">
			var dateTime = "<?php echo date('Ymdhis'); ?>";
		</script>
		<style>
			/* session flash message design */
			.fmsg {
				font-size: 14px;
				margin-left: 300px;
				width: 35%;
				margin-bottom: 0px;
				padding-top: 1px;
				padding-bottom: 1px;
			}
		</style>
	</head>
	<body>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
						<i class="fa fa-bars"></i>
						<span class="sr-only">Toggle Menu</span>
					</button>
				</div>
				<div class="p-4 pt-5">
					<h1>
						<!-- <a href="index.html" class="logo">Splash</a> -->
					</h1>
					<ul class="list-unstyled components mb-5">
						<li class="active">
							<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Employee</a>
							<ul class="collapse list-unstyled <?php if($mainMenu == 'employeeList') { echo('show'); } ?>" id="homeSubmenu">
								<li class="<?php if($mainMenu == 'employeeList') { echo('active'); } ?>">
									<a href="javascript:;" onclick="fnEmployeeList()">List</a>
								</li>
							</ul>
						</li>
					</ul>
					<div class="footer">
						<p>
							<!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Pay Slip System -->
						</p>
					</div>
				</div>
			</nav>
			<!-- Page Content  -->
			<form action="../controller/employeeController.php?time=<?php echo(date('YmdHis')); ?>" method="POST" id="listForm" name="listForm">
				<input type="hidden" id="screenName" name="screenName">
				<input type="hidden" id="hiddenSalaryId" name="hiddenSalaryId">
				<input type="hidden" id="hiddenEmployeeId" name="hiddenEmployeeId">
				<input type="hidden" id="hiddenYear" name="hiddenYear">
				<input type="hidden" id="hiddenMonth" name="hiddenMonth">
				<input type="hidden" id="hiddenSearch" name="hiddenSearch" value="<?php echo $employeeListArray['search']?>">
				<input type="hidden" id="pageno" name="pageno" value="<?php echo $pageno; ?>">
				<div id="content" class="p-4 p-md-5 pt-5">
					<h2 class="mb-4">Employee List</h2>
					<!-- session message -->
					<?php if(isset($_SESSION['message'])): ?>
				     <div class="alert alert-<?php echo $_SESSION['status']; ?> fmsg tac mb-2">
				     	<?php echo $_SESSION['message']; ?>
				     </div>
					<?php
						endif;
						unset($_SESSION['message']);
						unset($_SESSION['status']);
					?>
					<div class="inb float-left">
						<label for="year">Year : </label>
						<span>
							<select id="year" name="year" class="form-control h34 inb autowidth">
								<?php
									$selectedYear = "";
									if($employeeListArray['year'] != null ) {
										$selectedYear = $employeeListArray['year'];
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
						<label for="month">Month : </label>
						<span>
							<select id="month" name="month" class="form-control h34 inb autowidth">
								<?php
									$selectedMonth = "";
									if($employeeListArray['month'] != null ) {
										$selectedMonth = $employeeListArray['month'];
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
					<div class="float-right mb5">
						<!-- clear search -->
						<div  class="inb mt-1">
							<a href="javascript:;" onclick="fnClearSearch()">
								<img style="width: 26px;" src="../webroot/images/clearsearch.png" title="Clear Search">
							</a>
						</div>
						<!-- sorting process -->
						<div class="inb">
							<select name="sortProcess" id="sortProcess" class="form-control autowidth h34 inb mr-2 CMN_sorting <?php echo $sortStyle; ?>">
								<option value='1' <?php if($employeeListArray['sortVal'] == 1) { ?>selected <?php } ?>>Employee Id</option>
								<option value='2' <?php if($employeeListArray['sortVal'] == 2) { ?>selected <?php } ?>>Employee Name</option>
							</select>
							<input type="hidden" id="sortVal" name="sortVal" value="<?php echo $employeeListArray['sortVal']?>">
							<input type="hidden" id="sortOptn" name="sortOptn" value="<?php echo $sortOptn; ?>">
						</div>
						<!-- searching process -->
						<div class="input-group searchBtn">
							<input type="text" id="search" name="search" placeholder="Search Employee Id" class="input_box form-control h34" value="<?php echo $employeeListArray['search']?>">
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
							<col width="13%">
							<col>
							<col width="12%">
							<col width="11%">
							<col width="11%">
						</colgroup>
						<thead class="thead">
							<tr>
								<th>S.No.</th>
								<th>Employee Id</th>
								<th>Name</th>
								<th title="Net Salary">Salary</th>
								<th title="Personal E-Mail Address">E-Mail</th>
								<th></th>
							</tr>
						</thead>
						<?php
							if ($employeeListArray['employeeList'] != null) { ?>
							<?php
								$i = 0;
								foreach ($employeeListArray['employeeList'] as $key => $employeeList) { ?>
									<?php $class = $key % 2 === 0 ? 'odd' : 'even'; ?>
									<tr class="<?php echo $class; ?>">
										<td class="tac"><?php echo ($pageno - 1) * $resultsPerPage + $key + 1 ?></td>
										<td class="tac">
											<a href="javascript:;" onclick="fnPaySlipEmployeeHistory('<?php echo $employeeListArray['employeeList'][$i]['Emp_ID']; ?>',<?php echo $employeeListArray['month']; ?>,<?php echo $employeeListArray['year']; ?>)" class="employeeUserNameClr">
												<?php echo $employeeListArray['employeeList'][$i]["Emp_ID"]; ?>
											</a>
										</td>
										<td class="nameClr"><?php echo $employeeListArray['employeeList'][$i]["FirstName"]." ".$employeeListArray['employeeList'][$i]["LastName"]; ?></td>
										<td class="tac">
											<?php
												if(isset($employeeListArray['employeeList'][$i]["totalSalary"])) {
													echo number_format($employeeListArray['employeeList'][$i]["totalSalary"]); ?> &#8377;
												<?php } else {
													echo ("-");
												}
											?>
										</td>
										<td><?php echo $employeeListArray['employeeList'][$i]["Emailpersonal"]; ?></td>
										<td class="tac">
												<a href="javascript:;" onclick="fnPaySlipView(<?php echo $employeeListArray['employeeList'][$i]['salaryId']; ?>,<?php echo $employeeListArray['month']; ?>,<?php echo $employeeListArray['year']; ?>)">
													<img style="width: 20px;" src="../webroot/images/details.png" title="Pay Slip View">
												</a>
										</td>
									</tr>
								<?php
									$i++;
									}
									} else {
								?>
								<tr>
									<td colspan="6" class="tac noDataFoundClr">No data found</td>
								</tr>
							<?php } ?>
					</table>
					<?php if ($employeeListArray['employeeList'] != null) { ?>
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
				</div>
			</form>
		</div>
		<script type="text/javascript" src="../webroot/js/jquery.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/popper.js" ></script>
		<script type="text/javascript" src="../webroot/js/main.js" ></script>
		<script type="text/javascript" src="../webroot/js/employee/list.js" ></script>
	</body>
</html>
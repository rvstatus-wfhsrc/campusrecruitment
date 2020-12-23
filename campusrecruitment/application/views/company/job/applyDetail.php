<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<style>
			.container {
				line-height: 40px;
				font-size: 16px;
			}
			.content {
				position: relative;
			}
			.leftSide {
				font-family: 'Arial', sans-serif;
				display: inline-block;
				width: 21%;
				text-align: right;
				color: #000;
				font-weight: bold;
			}
			.rightSide {
				font-family: 'Arial', sans-serif;
				display: inline-block;
				width: 77%;
				margin-left: 5px;
			}
			.box {
				width: 95%;
				padding: 30px;
				border: 3px solid #D1E1DF;
				border-radius: 15px;
			}
			/* flash message design */
			.fmsg {
				font-size: 14px;
				margin-left: 173px;
				width: 48%;
				margin-bottom: 0px;
				padding-top: 1px;
				padding-bottom: 1px;
			}
		</style>
	</head>
	<body>
		<div>
			<ol class="breadcrumb mb-1 ml-4 w95">
				<li class="breadcrumb-item">
					<i class="fa fa-briefcase fa-btn mt3"></i>
					<?php echo $this->lang->line("lbl_job"); ?>
					<span class ="dot detailScrClr">&bull;</span>
					<span class="detailScrClr"><?php echo $this->lang->line("lbl_applyDetail"); ?></span>
				</li>
			</ol>
		</div>
		<?php echo form_open('JobController/jobApplyCancelStatus',['method' => 'POST','id' => 'applyDetailForm','name' => 'applyDetailForm']); ?>
			<input type="hidden" id="base" name="base" value="<?php echo base_url(); ?>">
			<input type="hidden" id="hiddenApplyJobId" name="hiddenApplyJobId">
			<div class="ml-4 mb-1">
				<a class="btn btn-info editBtn" href="javascript:;" onclick="fnBackBtn()">
					<i class="fa fa-chevron-left fa-btn"></i><?php echo lang('lbl_back'); ?>
				</a>
				<?php if ($jobApplyDetail->delFlag == 0) { ?>
					<a class="btn apply_btn text-white editBtn" href="javascript:;" onclick="fnCancelApply(<?php echo $jobApplyDetail->id;?>)">
						<i class="fa fa-close"></i>
						<?php echo $this->lang->line("lbl_cancel"); ?>
					</a>
				<?php } ?>
			</div>
			<div class="box ml-4 mb-4">
				<div class="container content">
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_companyName"); ?> : </div>
						<div class="rightSide"><?php echo $jobApplyDetail->companyName; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_incharge"); ?> : </div>
						<div class="rightSide"><?php echo $jobApplyDetail->incharge; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_jobCategory"); ?> : </div>
						<div class="rightSide"><?php echo $jobApplyDetail->jobCategory; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_salary"); ?> : </div>
						<div class="rightSide"><?php echo $jobApplyDetail->salary; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_lastApplyDate"); ?> : </div>
						<div class="rightSide"><?php echo $jobApplyDetail->lastApplyDate; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_applyDate"); ?> : </div>
						<div class="rightSide"><?php echo $jobApplyDetail->applyDate; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_contact"); ?> : </div>
						<div class="rightSide"><?php echo $jobApplyDetail->contact; ?></div>
					</div>
				</div>
			</div>
		<?php echo form_close();?>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/company/job/applyDetail.js"></script>
	</body>
</html>
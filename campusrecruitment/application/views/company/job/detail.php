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
					<span class="detailScrClr"><?php echo $this->lang->line("lbl_detail"); ?></span>
				</li>
				<?php if($this->session->flashdata('message')) { ?>
					<div class="alert alert-<?php echo $this->session->flashdata('type'); ?> fmsg tac">
						<?php echo $this->session->flashdata('message'); ?>
					</div>
				<?php } ?>
			</ol>
		</div>
		<?php echo form_open('JobController/jobEdit',['method' => 'POST','id' => 'jobDetailForm','name' => 'jobDetailForm']); ?>
			<input type="hidden" id="base" name="base" value="<?php echo base_url(); ?>">
			<input type="hidden" id="hiddenJobId" name="hiddenJobId" value="<?php echo $jobDetail->id; ?>">
			<input type="hidden" id="hiddenCompanyId" name="hiddenCompanyId">
			<input type="hidden" id="hiddenFlag" name="hiddenFlag" value="<?php echo $this->session->userdata('flag'); ?>">
			<div class="ml-4 mb-1">
				<a class="btn btn-info editBtn" href="javascript:;" onclick="fnBackBtn()">
					<i class="fa fa-chevron-left fa-btn"></i><?php echo lang('lbl_back'); ?>
				</a>
				<?php if ($this->session->userdata('flag') == 2 && $jobDetail->delFlag == 0) { ?>
					<a class="btn bg-warning text-white editBtn" href="javascript:;" onclick="fnJobEdit()">
						<i class="fa fa-edit fa-btn"></i>
						<?php echo $this->lang->line("lbl_edit"); ?>
					</a>
				<?php } elseif($this->session->userdata('flag') == 3) { ?>
					<a class="btn apply_btn text-white editBtn" href="javascript:;" onclick="fnJobApply(<?php echo $jobDetail->id;?> , '<?php echo $jobDetail->companyId;?>')">
						<i class="fa fa-check"></i>
						<?php echo $this->lang->line("lbl_apply"); ?>
					</a>
				<?php } ?>
			</div>
			<div class="box ml-4 mb-4">
				<div class="container content">
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_companyName"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->companyName; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_incharge"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->incharge; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_contact"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->contact; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_jobCategory"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->designationName; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_jobType"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->jobType == 1? 'Part-Time' : 'Full-Time'; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_role"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->roleName; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_requiredSkill"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->skillName; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_extraSkill"); ?> : </div>
						<div class="rightSide"><?php echo ($jobDetail->extraSkill != null) ? $jobDetail->extraSkill : "Nil"; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_minQualification"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->minQualification; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_maxAge"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->maxAge; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_workingHour"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->workingHour; ?> Hours</div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_salary"); ?> : </div>
						<div class="rightSide"><?php echo number_format($jobDetail->salary); ?> &#8377;</div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_jobLocation"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->jobLocation; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_lastApplyDate"); ?> : </div>
						<div class="rightSide"><?php echo $jobDetail->lastApplyDate; ?></div>
					</div>
					<div>
						<div class="leftSide"><?php echo $this->lang->line("lbl_jobDescription"); ?> : </div>
						<div class="rightSide vat"><?php echo nl2br($jobDetail->jobDescription); ?></div>
					</div>
				</div>
			</div>
		<?php echo form_close();?>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/company/job/detail.js"></script>
	</body>
</html>
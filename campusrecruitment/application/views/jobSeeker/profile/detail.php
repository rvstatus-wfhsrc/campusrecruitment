<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<style>
			.container{
				line-height: 40px;
				font-size: 16px;
			}
			.content {
				position: relative;
			}
			.fa-trash {
				color: #FF0000;
			}
			.leftSide{
				font-family: 'Arial', sans-serif;
				display: inline-block;
				width: 19%;
				text-align: right;
				color: #000;
				font-weight: bold;
			}
			.rightSide{
				font-family: 'Arial', sans-serif;
				display: inline-block;
				width: 79%;
				margin-left: 5px;
			}
			.box{
				width: 95%;
				padding: 30px;
				border: 3px solid #D1E1DF;
				border-radius: 15px;
			}
			/* flash message design */
			.fmsg{
				font-size: 14px;
				margin-left: 173px;
				width: 48%;
				margin-bottom: 0px;
				padding-top: 1px;
				padding-bottom: 1px;
			}
			.image {
				position: absolute;
				top: 0px;
				right: 0px;
				width: 300px;
				text-align: center;
			}
			img {
				max-width: 100%;
				max-height: 200%;
			}
			.fa-trash {
				color: #FF0000;
			}
		</style>
	</head>
	<body>
		<div>
			<ol class="breadcrumb mb-1 ml-4 w95">
				<li class="breadcrumb-item">
					<i class="fa fa-user fa-btn mt3"></i><?php echo lang('lbl_jobSeeker'); ?>
					<span class ="dot detailScrClr">&bull;</span>
					<span class="detailScrClr"><?php echo lang('lbl_detail'); ?></span>
				</li>
				<?php if($this->session->flashdata('message')) { ?>
					<div class="alert alert-<?php echo $this->session->flashdata('type'); ?> fmsg tac">
						<?php echo $this->session->flashdata('message'); ?>
					</div>
				<?php } ?>
			</ol>
		</div>
		<?php echo form_open('JobSeekerController/jobSeekerEdit',['method' => 'POST','id' => 'detailForm','name' => 'detailForm']); ?>
			<input type="hidden" id="base" value="<?php echo base_url(); ?>">
			<input type="hidden" id="hiddenJobSeekerId" name="hiddenJobSeekerId" value="<?php echo $jobSeekerDetail->id; ?>">
			<div class="ml-4 mb-1 dispNone">
				<a class="btn bg-warning text-white editBtn" href="javascript:;" onclick="fnJobSeekerEdit()">
					<i class="fa fa-edit fa-btn"></i><?php echo lang('lbl_edit'); ?>
				</a>
			</div>
			<div class="box ml-4 mb-4">
				<div class="container content">
					<div>
						<!-- image -->
						<div style="width: 100%">
							<?php if(!empty($jobSeekerDetail->image)) { ?>
								<div class="image">
									<img src="<?php echo 'data:image/jpg;base64,'.base64_encode($jobSeekerDetail->image); ?>" >
									<div class="tac">
										<a href="javascript:;" onclick="fnRemoveImage()" title="Remove Image" >
											<i class="fa fa-trash"></i>
										</a>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
					<div>
						<!-- user name -->
						<div class="leftSide"><?php echo lang('lbl_userName', 'userName'); ?> : </div>
						<div class="rightSide"><?php echo $jobSeekerDetail->userName; ?></div>
					</div>
					<div>
						<!-- name -->
						<div class="leftSide"><?php echo lang('lbl_name', 'name'); ?> : </div>
						<div class="rightSide"><?php echo $jobSeekerDetail->name; ?></div>
					</div>
					<div>
						<!-- gender -->
						<div class="leftSide"><?php echo lang('lbl_gender', 'gender'); ?> : </div>
						<div class="rightSide">
							 <?php echo $jobSeekerDetail->gender == 1? 'Male' : 'Female'; ?>
						</div>
					</div>
					<div>
						<!-- address -->
						<div class="leftSide"><?php echo lang('lbl_address', 'address'); ?> : </div>
						<div class="rightSide vat"><?php echo nl2br($jobSeekerDetail->address); ?></div>
					</div>
					<div>
						<!-- city -->
						<div class="leftSide"><?php echo lang('lbl_city', 'city'); ?> : </div>
						<div class="rightSide"><?php echo $jobSeekerDetail->city; ?></div>
					</div>
					<div>
						<!-- state -->
						<div class="leftSide"><?php echo lang('lbl_state', 'state'); ?> : </div>
						<div class="rightSide"><?php echo $jobSeekerDetail->state; ?></div>
					</div>
					<div>
						<!-- country -->
						<div class="leftSide"><?php echo lang('lbl_country', 'country'); ?> : </div>
						<div class="rightSide"><?php echo $jobSeekerDetail->country; ?></div>
					</div>
					<div>
						<!-- pincode -->
						<div class="leftSide"><?php echo lang('lbl_pincode', 'pincode'); ?> : </div>
						<div class="rightSide"><?php echo $jobSeekerDetail->pincode; ?></div>
					</div>
					<div>
						<!-- e-mail -->
						<div class="leftSide"><?php echo lang('lbl_email', 'email'); ?> : </div>
						<div class="rightSide"><?php echo $jobSeekerDetail->email; ?></div>
					</div>
					<div>
						<!-- contact -->
						<div class="leftSide"><?php echo lang('lbl_contact', 'contact'); ?> : </div>
						<div class="rightSide"><?php echo $jobSeekerDetail->contact; ?></div>
					</div>
				</div>
			</div>
		<?php echo form_close();?>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jobSeeker/profile/detail.js"></script>
	</body>
</html>
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
			/*Flash message design*/
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
		        /*height:150px;
		        background-size: contain;
		        background-position: center;
		        background-repeat: no-repeat;*/
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
	    <div class="dispNone">
			<ol class="breadcrumb mb-1 ml-4 w95">
				<li class="breadcrumb-item"><i class="fa fa-user fa-btn mt3"></i>Profile<span class ="dot detailScrClr">&bull;</span><span class="detailScrClr">Detail</span></li>
	    		<?php if($this->session->flashdata('message')) { ?>
	            	<div class="alert alert-<?php echo $this->session->flashdata('type'); ?> fmsg tac"><?php echo $this->session->flashdata('message'); ?> </div>
	        	<?php } ?>
	    	</ol>
		</div>
		<?php echo form_open('AdminController/profileEdit',['method' => 'POST','id' => 'profileDetailForm','name' => 'profileDetailForm']); ?>
			<input type="hidden" id="base" value="<?php echo base_url(); ?>">
			<div class="ml-4 mb-1 dispNone">
				<a class="btn bg-warning text-white editBtn" href="javascript:;" onclick="fnProfileEdit()">
					<i class="fa fa-edit fa-btn"></i>Edit
				</a>
			</div>
			<div class="box ml-4 mb-4">
				<div class="container content">
					<div>
						<!-- image -->
						<div style="width: 100%">
							<?php if(!empty($profileDetail->image)) { ?>
								<div class="image">
									<img src="<?php echo 'data:image/jpg;base64,'.base64_encode($profileDetail->image); ?>" >
									<div class="tac"><a href="javascript:;" onclick="fnRemoveImage()" title="Remove Image" ><i class="fa fa-trash"></i></a></div>
								</div>
							<?php } ?>
						</div>
					</div>
					<div>
						<!-- user name -->
						<div class="leftSide"><?php echo lang('lbl_userName', 'userName'); ?> : </div>
						<div class="rightSide"><?php echo $profileDetail->userName; ?></div>
					</div>
					<div>
						<!-- customer name -->
						<div class="leftSide"><?php echo lang('lbl_name', 'name'); ?> : </div>
						<div class="rightSide"><?php echo $profileDetail->name; ?></div>
					</div>
					<div>
						<!-- gender -->
						<div class="leftSide"><?php echo lang('lbl_gender', 'gender'); ?> : </div>
						<div class="rightSide">
							 <?php echo $profileDetail->gender == 1? 'Male' : 'Female'; ?>
						</div>
					</div>
					<div>
						<!-- address -->
						<div class="leftSide"><?php echo lang('lbl_address', 'address'); ?> : </div>
						<div class="rightSide vat"><?php echo nl2br($profileDetail->address); ?></div>
					</div>
					<div>
						<!-- city -->
						<div class="leftSide"><?php echo lang('lbl_city', 'city'); ?> : </div>
						<div class="rightSide"><?php echo $cityArray[$profileDetail->city]; ?></div>
					</div>
					<div>
						<!-- state -->
						<div class="leftSide"><?php echo lang('lbl_state', 'state'); ?> : </div>
						<div class="rightSide"><?php echo $stateArray[$profileDetail->state]; ?></div>
					</div>
					<div>
						<!-- country -->
						<div class="leftSide"><?php echo lang('lbl_country', 'country'); ?> : </div>
						<div class="rightSide"><?php echo $countryArray[$profileDetail->country]; ?></div>
					</div>
					<div>
						<!-- pincode -->
						<div class="leftSide"><?php echo lang('lbl_pincode', 'pincode'); ?> : </div>
						<div class="rightSide"><?php echo $profileDetail->pincode; ?></div>
					</div>
					<div>
						<!-- e-mail -->
						<div class="leftSide"><?php echo lang('lbl_email', 'email'); ?> : </div>
						<div class="rightSide"><?php echo $profileDetail->email; ?></div>
					</div>
					<div>
						<!-- contact -->
						<div class="leftSide"><?php echo lang('lbl_contact', 'contact'); ?> : </div>
						<div class="rightSide"><?php echo $profileDetail->contact; ?></div>
					</div>
				</div>
			</div>
		<?php echo form_close();?>
	 	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/profile/detail.js"></script>
	</body>
</html>
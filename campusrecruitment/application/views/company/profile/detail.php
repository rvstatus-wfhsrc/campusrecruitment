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
			.fa-trash {
				color: #FF0000;
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
		</style>
	</head>
	<body>
	    <div class="dispNone">
			<ol class="breadcrumb mb-1 ml-4 w95">
				<li class="breadcrumb-item"><i class="fa fa-building-o fa-btn mt3"></i><?php echo lang('lbl_company'); ?><span class ="dot detailScrClr">&bull;</span><span class="detailScrClr"><?php echo lang('lbl_detail'); ?></span></li>
				<?php if($this->session->flashdata('message')) { ?>
	            	<div class="alert alert-<?php echo $this->session->flashdata('type'); ?> fmsg tac"><?php echo $this->session->flashdata('message'); ?> </div>
	        	<?php } ?>
	    	</ol>
		</div>
		<?php echo form_open('CompanyController/companyProfileEdit',['method' => 'POST','id' => 'detailForm','name' => 'detailForm']); ?>
			<input type="hidden" id="baseUrl" value="<?php echo base_url(); ?>">
			<input type="hidden" id="hiddenCompanyId" name="hiddenCompanyId">
			<div class="ml-4 mb-1 dispNone">
				<a class="btn bg-warning text-white editBtn" href="javascript:;" onclick="fnCompanyEdit(<?php echo $companyDetail->id;?>)">
					<i class="fa fa-edit fa-btn"></i><?php echo lang('lbl_edit'); ?>
				</a>
			</div>
			<div class="box ml-4 mb-4">
				<div class="container content">
					<div>
						<!-- username -->
						<div class="leftSide"><?php echo lang('lbl_userName', 'userName'); ?> : </div>
						<div class="rightSide"><?php echo $companyDetail->userName; ?></div>
					</div>
					<div>
						<!-- company name -->
						<div class="leftSide"><?php echo lang('lbl_companyName', 'companyName'); ?> : </div>
						<div class="rightSide"><?php echo $companyDetail->companyName; ?></div>
					</div>
					<div>
						<!-- address -->
						<div class="leftSide"><?php echo lang('lbl_address', 'address'); ?> : </div>
						<div class="rightSide vat"><?php echo nl2br($companyDetail->address); ?></div>
					</div>
					<div>
						<!-- incharge -->
						<div class="leftSide"><?php echo lang('lbl_incharge', 'incharge'); ?> : </div>
						<div class="rightSide"><?php echo $companyDetail->incharge; ?></div>
					</div>
					<div>
						<!-- contact -->
						<div class="leftSide"><?php echo lang('lbl_contact', 'contact'); ?> : </div>
						<div class="rightSide"><?php echo $companyDetail->contact; ?></div>
					</div>
					<div>
						<!-- email -->
						<div class="leftSide"><?php echo lang('lbl_email', 'email'); ?> : </div>
						<div class="rightSide"><?php echo $companyDetail->email; ?></div>
					</div>
					<div>
						<!-- website -->
						<div class="leftSide"><?php echo lang('lbl_website', 'website'); ?> : </div>
						<div class="rightSide"><?php echo $companyDetail->website; ?></div>
					</div>
					<div>
						<!-- entry date -->
						<div class="leftSide"><?php echo lang('lbl_entryDate', 'entryDate'); ?> : </div>
						<div class="rightSide"><?php echo ($companyDetail->entryDate != '0000-00-00') ? $companyDetail->entryDate : "Nil"; ?></div>
					</div>
				</div>
			</div>
		<?php echo form_close();?>
	 	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/company/profile/detail.js"></script>
	</body>
</html>
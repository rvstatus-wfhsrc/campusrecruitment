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
	    		<!-- it will be use after finishing edit screen -->
	    		<!-- @if(Session::has('message'))
	            	<div class="alert alert-{{session('message')['type']}} fmsg tac">{{ Session::get('message')['text'] }}</div>
	        	@endif -->
	    	</ol>
		</div>
		<?php echo form_open('LoginController/loginUser',['method' => 'POST','id' => 'profileDetailForm','name' => 'profileDetailForm']); ?>
			<div class="ml-4 mb-1 dispNone">
				<a class="btn bg-warning text-white editBtn" href="javascript:;" onclick="fnProfileEdit()">
					<i class="fa fa-edit fa-btn"></i>Edit
				</a>
			</div>
			<div class="box ml-4 mb-4 dispNone">
				<div class="container content">
					<div>
						<!-- image -->
						<div style="width: 100%">
							<?php if(!empty($profileDetail->image)) { ?>
								<!-- <div class="image">
									<img src="{{ 'data:image/jpg;base64,'.base64_encode( $user->image )}}" >
									<div class="tac"><a href="javascript:;" onclick="fnRemoveImage()" title="Remove Image" ><i class="fa fa-trash"></i></a></div>
								</div> -->
							<?php } ?>
						</div>
					</div>
					<div>
						<!-- user name -->
						<div class="leftSide">User Name : </div>
						<div class="rightSide"><?php echo $profileDetail->userName; ?></div>
					</div>
					<div>
						<!-- customer name -->
						<div class="leftSide">Name : </div>
						<div class="rightSide"><?php echo $profileDetail->name; ?></div>
					</div>
					<div>
						<!-- gender -->
						<div class="leftSide">Gender : </div>
						<div class="rightSide">
							 <?php $profileDetail->gender == 1? 'Male' : 'Female' ?>
						</div>
					</div>
					<div>
						<!-- address -->
						<div class="leftSide">Address : </div>
						<div class="rightSide vat"><?php echo nl2br($profileDetail->address); ?></div>
					</div>
					<div>
						<!-- city -->
						<div class="leftSide">City : </div>
						<div class="rightSide"><?php echo $profileDetail->city; ?></div>
					</div>
					<div>
						<!-- state -->
						<div class="leftSide">State : </div>
						<div class="rightSide"><?php echo $profileDetail->state; ?></div>
					</div>
					<div>
						<!-- country -->
						<div class="leftSide">Country : </div>
						<div class="rightSide"><?php echo $profileDetail->country; ?></div>
					</div>
					<div>
						<!-- pincode -->
						<div class="leftSide">Pincode : </div>
						<div class="rightSide"><?php echo $profileDetail->pincode; ?></div>
					</div>
					<div>
						<!-- e-mail -->
						<div class="leftSide">E-Mail : </div>
						<div class="rightSide"><?php echo $profileDetail->email; ?></div>
					</div>
					<div>
						<!-- contact -->
						<div class="leftSide">Contact : </div>
						<div class="rightSide"><?php echo $profileDetail->contact; ?></div>
					</div>
				</div>
			</div>
		<?php echo form_close();?>
	 <!-- <script type="text/javascript" src="{{ URL::asset('resources/assets/js/jquery.min.js') }}"></script>
	    <script type="text/javascript" src="{{ URL::asset('resources/assets/js/profile/profileDetail.js') }}"></script> -->
	</body>
</html>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <style>
            h3 {
                font-size: 20px;
                margin-bottom: 0px;
            }
            label {
                justify-content: flex-end !important;
            }
            .imageName {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>
    </head>
    <body>
        <div>
            <?php if(isset($jobSeekerEdit)) { ?>
                <ol class="breadcrumb mb-2 ml-4 w95">
                    <li class="breadcrumb-item">
                        <i class="fa fa-user fa-btn mt3"></i>
                        <?php echo lang('lbl_jobSeeker'); ?>
                        <span class ="dot editScrClr">&bull;</span>
                        <span class="editScrClr"><?php echo lang('lbl_edit'); ?></span>
                    </li>
                </ol>
            <?php } ?>
        </div>
        <div class="container mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card shadow-lg border-0 rounded-lg mt-4">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light fs20">
                                <?php 
                                    if(isset($jobSeekerEdit)) {
                                        echo lang('lbl_jobSeekerEdit');
                                    } else {
                                        echo lang('lbl_jobSeekerAdd');
                                    }
                                ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- register and update job seeker account process -->
                            <?php if(isset($jobSeekerEdit)) { ?>
                                <!-- job seeker edit process form -->
                                <?php echo form_open('JobSeekerController/jobSeekerEditForm',
                                    ['method' => 'POST', 'class' => 'form-horizontal','id' => 'editForm','name' => 'editForm','enctype'=>'multipart/form-data']); ?>
                                <input type="hidden" id="hiddenJobSeekerId" name="hiddenJobSeekerId" value= "<?php echo $jobSeekerEdit->id; ?>" >
                                <input type="hidden" id="screenFlag" name="screenFlag" value= "2" >
                            <?php } else { ?>
                                <!-- job seeker add process form-->
                                <?php echo form_open('JobSeekerController/jobSeekerAddForm',
                                    ['method' => 'POST', 'class' => 'form-horizontal','id' => 'addForm','name' => 'addForm','enctype'=>'multipart/form-data']); ?>
                                <input type="hidden" id="screenFlag" name="screenFlag" value= "1" >
                            <?php } ?>
                                <input type="hidden" id="baseUrl" value="<?php echo base_url(); ?>">
                                <!-- name -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_name', 'name', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'name',
                                                'name' => 'name',
                                                'placeholder' => 'Enter Name',
                                                'class' => 'input_box col-md-12 form-control w43 h-25',
                                                'value' => set_value('name',isset($jobSeekerEdit->name) ? $jobSeekerEdit->name : false)
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <!-- e-mail -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_email', 'email', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'email',
                                                'name' => 'email',
                                                'placeholder' => 'Enter E-Mail Address',
                                                'class' => 'input_box col-md-12 form-control w40 h-25',
                                                'value' => set_value('email',isset($jobSeekerEdit->email) ? $jobSeekerEdit->email : false)
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <!-- gender -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_gender', 'Gender', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <input type="radio" name="gender" class="gender" value="1" <?php echo set_value('gender', isset($jobSeekerEdit->gender) && $jobSeekerEdit->gender == 1 ? "checked" : "") ?> />
                                        <span class = "pr20">Male</span>
                                        <input type="radio" name="gender" class="gender" value="2" <?php echo set_value('gender', isset($jobSeekerEdit->gender) && $jobSeekerEdit->gender == 2 ? "checked" : "") ?> />
                                        <span class="genderError">Female</span>
                                    </div>
                                </div>
                                <!-- address -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_address', 'address', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col">
                                        <?php 
                                            $data = array(
                                                'id' => 'address',
                                                'name' => 'address',
                                                'placeholder' => 'Enter Address',
                                                'class' => 'form-control w43',
                                                'rows' => 3,
                                                'cols' => 46,
                                                'value' => set_value('address',isset($jobSeekerEdit->address) ? $jobSeekerEdit->address : false)
                                            );
                                            echo form_textarea($data);
                                        ?>
                                    </div>
                                </div>
                                <!-- country -->
                                <!-- <div class="form-group form-inline">
                                    <?php echo lang('lbl_country', 'country', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'country',
                                                'name' => 'country',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('country', $countryArray,set_value('country', isset($jobSeekerEdit->country) ? $jobSeekerEdit->country : false),$fields);
                                        ?>
                                    </div>
                                </div> -->
                                <!-- state -->
                                <!-- <div class="form-group form-inline">
                                    <?php echo lang('lbl_state', 'state', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'state',
                                                'name' => 'state',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('state', $stateArray,set_value('state', isset($jobSeekerEdit->state) ? $jobSeekerEdit->state : false),$fields);
                                        ?>
                                    </div>
                                </div> -->
                                <!-- city -->
                                <!-- <div class="form-group form-inline">
                                    <?php echo lang('lbl_city', 'city', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'city',
                                                'name' => 'city',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('city', $cityArray,set_value('city', isset($jobSeekerEdit->city) ? $jobSeekerEdit->city : false),$fields);
                                        ?>
                                    </div>
                                </div> -->
                                <!-- pincode -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_pincode', 'pincode', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php 
                                            $data= array(
                                                'id' => 'pincode',
                                                'name' => 'pincode',
                                                'placeholder' => 'Enter Pincode',
                                                'class' => 'input_box col-md-12 form-control w30 h-25',
                                                'value' => set_value('pincode',isset($jobSeekerEdit->pincode) ? $jobSeekerEdit->pincode : false)
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <!-- contact -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_contact', 'contact', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php 
                                            $data= array(
                                                'id' => 'contact',
                                                'name' => 'contact',
                                                'placeholder' => 'Enter Contact',
                                                'class' => 'input_box col-md-12 form-control w28 h-25',
                                                'value' => set_value('contact',isset($jobSeekerEdit->contact) ? $jobSeekerEdit->contact : false)
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <?php if(!isset($jobSeekerEdit)) { ?>
                                    <!-- password -->
                                    <div class="form-group form-inline">
                                        <?php echo lang('lbl_password', 'password', array('class' => 'col-md-4 control-label required')); ?>
                                        <div class="col-md-8">
                                            <?php 
                                                 $data= array(
                                                    'id' => 'password',
                                                    'name' => 'password',
                                                    'placeholder' => 'Enter Password',
                                                    'class' => 'col-md-12 form-control w43 h-25',
                                                    'type' => 'password'
                                                );
                                                echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                    <!-- confirm password -->
                                    <div class="form-group form-inline">
                                        <?php echo lang('lbl_conf_password', 'password_confirmation', array('class' => 'col-md-4 control-label required')); ?>
                                        <div class="col-md-8">
                                            <?php 
                                                $data= array(
                                                    'id' => 'password_confirmation',
                                                    'name' => 'password_confirmation',
                                                    'placeholder' => 'Enter Confirm Password',
                                                    'class' => 'col-md-12 form-control w43 h-25',
                                                    'type' => 'password'
                                                );
                                                echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!--image  -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_image', 'image', array('class' => 'col-md-4 control-label')); ?>                   
                                    <div class="col-md-8">
                                        <?php echo "<input type='file' name='image' id='image' accept='image/*' class='w43 imageName' />"; ?>
                                        <span class="formatError"></span>
                                    </div>
                                </div>
                                <!-- register button -->
                                <div class="form-group">
                                    <div class="offset-md-4 col-md-6">
                                        <?php if(isset($jobSeekerEdit)) { ?>
                                            <button class="btn bg-warning text-white addEditProcess">
                                                <i class="fa fa-btn fa-edit"></i>
                                                <?php echo lang('lbl_update'); ?>
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-success addEditProcess">
                                                <i class="fa fa-btn fa-plus"></i>
                                                <?php echo lang('lbl_jobSeekerAdd'); ?>
                                            </button>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jobSeeker/profile/addEdit.js"></script>
    </body>
</html>
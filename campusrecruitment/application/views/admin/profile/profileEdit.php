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
        <div class="">
            <ol class="breadcrumb mb-2 ml-4 w95">
                <li class="breadcrumb-item"><i class="fa fa-user fa-btn mt3"></i>Profile<span class ="dot editScrClr">&bull;</span><span class="editScrClr">Edit</span></li>
            </ol>
        </div>
        <div class="container mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card shadow-lg border-0 rounded-lg mt-4">
                        <div class="card-header"><h3 class="text-center font-weight-light fs20"> Update Account Details </h3></div>
                        <div class="card-body">
                            <!-- register and update account process -->
                            <?php echo form_open('AdminController/profileUpdate',['method' => 'POST', 'class' => 'form-horizontal','id' => 'editForm','name' => 'editForm','enctype'=>'multipart/form-data']); ?>
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
                                                'value' => set_value('name',$profileEdit->name)
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
                                                'value' => set_value('email',$profileEdit->email)
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <!-- gender -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_gender', 'Gender', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <input type="radio" name="gender" value="1" <?php echo set_value('gender', $profileEdit->gender) == 1 ? "checked" : ""; ?> />
                                        <!-- <input type="radio" name="gender" value="1" <?php echo set_radio('gender', 1, $profileEdit->gender === 1) ?> /> -->
                                        <span class = "pr20">Male</span>
                                        <input type="radio" name="gender" value="2" <?php echo set_value('gender', $profileEdit->gender) == 2 ? "checked" : ""; ?> />
                                        <!-- <input type="radio" name="gender" value="2" <?php echo set_radio('gender', 2, $profileEdit->gender === 2) ?> /> -->
                                        <span>Female</span>
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
                                                'value' => set_value('address',$profileEdit->address)
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
                                            echo form_dropdown('country', $countryArray,set_value('country', $profileEdit->country, false),'class = "form-control autowidth h-25" id = "country" name = "country" placeholder = "Select Country"');
                                        ?>
                                    </div>
                                </div> -->
                                <!-- state -->
                                <!-- <div class="form-group form-inline">
                                    <?php echo lang('lbl_state', 'state', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php 
                                            echo form_dropdown('state', $stateArray,set_value('state', $profileEdit->state, false),'class = "form-control autowidth h-25" id = "state" name = "state"');
                                        ?>
                                    </div>
                                </div> -->
                                <!-- city -->
                                <!-- <div class="form-group form-inline">
                                    <?php echo lang('lbl_city', 'city', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            echo form_dropdown('city', $cityArray,set_value('city', $profileEdit->city, false),'class = "form-control autowidth h-25" id = "city" name = "city"');
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
                                                'value' => set_value('pincode',$profileEdit->pincode)
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
                                                'value' => set_value('contact',$profileEdit->contact)
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
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
                                        <button type="submit" class="btn bg-warning text-white editprocess">
                                            <i class="fa fa-btn fa-edit"></i>Update
                                        </button>
                                    </div>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/profile/edit.js"></script>
    </body>
</html>
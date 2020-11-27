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
                                <!-- name -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('Name','name',['class' => "col-md-4 control-label required"]); ?>
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
                                        <div class="error">
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- e-mail -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('E-Mail Address','email',['class' => "col-md-4 control-label required"]); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'email',
                                                'name' => 'email',
                                                'placeholder' => 'Enter E-Mail Address',
                                                'class' => 'input_box col-md-12 form-control w43 h-25',
                                                'value' => set_value('email',$profileEdit->email)
                                            );
                                            echo form_input($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('email'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- gender -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('Gender','gender',['class' => "col-md-4 control-label required"]); ?>
                                    <div class="col-md-8">
                                        <input type="radio" name="gender" value="1" <?php echo set_value('gender', $profileEdit->gender) == 1 ? "checked" : ""; ?> />
                                        <!-- <input type="radio" name="gender" value="1" <?php echo set_radio('gender', 1, $profileEdit->gender === 1) ?> /> -->
                                        <span class = "pr20">Male</span>
                                        <input type="radio" name="gender" value="2" <?php echo set_value('gender', $profileEdit->gender) == 2 ? "checked" : ""; ?> />
                                        <!-- <input type="radio" name="gender" value="2" <?php echo set_radio('gender', 2, $profileEdit->gender === 2) ?> /> -->
                                        <span>Female</span>
                                        <div class="error">
                                            <?php echo form_error('gender'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- address -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('Address','address',['class' => "col-md-4 control-label required"]); ?>
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
                                        <div class="error">
                                            <?php echo form_error('address'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- country -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('Country','country',['class' => "col-md-4 control-label required"]); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $countryArray = array(
                                                '0'  => 'Select Country',
                                                '1'    => 'India',
                                                '2'   => 'Japan'
                                            );
                                            echo form_dropdown('country', $countryArray,set_value('country', $profileEdit->country, false),'class = "form-control autowidth h-25" id = "country" name = "country"');
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('country'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- state -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('State','state',['class' => "col-md-4 control-label required"]); ?>
                                    <div class="col-md-8">
                                        <?php 
                                            $stateArray = array(
                                                '0'  => 'Select State',
                                                '1'    => 'India',
                                                '2'   => 'Japan'
                                            );
                                            echo form_dropdown('state', $stateArray,set_value('state', $profileEdit->state, false),'class = "form-control autowidth h-25" id = "state" name = "state"');
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('state'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- city -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('City','city',['class' => "col-md-4 control-label required"]); ?>
                                    <div class="col-md-8">
                                        <?php 
                                            $cityArray = array(
                                                '0'  => 'Select City',
                                                '1'    => 'Tirunelveli',
                                                '2'   => 'Tokyo'
                                            );
                                            echo form_dropdown('city', $cityArray,set_value('city', $profileEdit->city, false),'class = "form-control autowidth h-25" id = "city" name = "city"');
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('city'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- pincode -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('Pincode','pincode',['class' => "col-md-4 control-label required"]); ?>
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
                                        <div class="error">
                                            <?php echo form_error('pincode'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- contact -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('Contact','contact',['class' => "col-md-4 control-label required"]); ?>
                                    <div class="col-md-8">
                                        <?php 
                                            $data= array(
                                                'id' => 'contact',
                                                'name' => 'contact',
                                                'placeholder' => 'Enter Contact',
                                                'class' => 'input_box col-md-12 form-control w30 h-25',
                                                'value' => set_value('contact',$profileEdit->contact)
                                            );
                                            echo form_input($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('contact'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!--image  -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('Image','image',['class' => "col-md-4 control-label image"]); ?>                   
                                    <div class="col-md-8">
                                        <?php echo "<input type='file' name='image' id='image' accept='image/*' class='w43 imageName' />"; ?>
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
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/profile/edit.js"></script> -->
    </body>
</html>
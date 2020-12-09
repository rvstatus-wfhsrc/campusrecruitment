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
        </style>
    </head>
    <body>
        <div>
            <ol class="breadcrumb mb-2 ml-4 w95">
                <li class="breadcrumb-item">
                    <i class="fa fa-briefcase fa-btn mt3"></i>
                    <?php echo lang('lbl_job'); ?>
                    <?php if(isset($jobEdit)) { ?>
                        <span class ="dot editScrClr">&bull;</span>
                        <span class="editScrClr"><?php echo lang('lbl_edit'); ?></span>
                    <?php } else { ?>
                        <span class ="dot addScrClr">&bull;</span>
                        <span class="addScrClr"><?php echo lang('lbl_add'); ?></span>
                    <?php } ?>
                </li>
            </ol>
        </div>
        <div class="container mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card shadow-lg border-0 rounded-lg mt-4">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light fs20">
                                <?php 
                                    if(isset($jobEdit)) {
                                        echo lang('lbl_jobEdit');
                                    } else {
                                        echo lang('lbl_jobAdd');
                                    }
                                ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php if(isset($jobEdit)) { ?>
                                <!-- job edit process form -->
                                <?php echo form_open('JobController/jobEditForm',
                                    ['method' => 'POST', 'class' => 'form-horizontal','id' => 'editForm','name' => 'editForm']); ?>
                                <input type="hidden" id="hiddenJobId" name="hiddenJobId" value= "<?php echo $jobEdit->id; ?>" >
                                <input type="hidden" id="screenFlag" name="screenFlag" value= "2" >
                            <?php } else { ?>
                                <!-- job add process form-->
                                <?php echo form_open('JobController/jobAddForm',
                                    ['method' => 'POST', 'class' => 'form-horizontal','id' => 'addForm','name' => 'addForm']); ?>
                                <input type="hidden" id="screenFlag" name="screenFlag" value= "1" >
                            <?php } ?>
                                <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_jobCategory', 'jobCategory', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'jobCategory',
                                                'name' => 'jobCategory',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('jobCategory', $jobCategoryArray,set_value('jobCategory', isset($jobEdit->jobCategory) ? $jobEdit->jobCategory : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('jobCategory'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_jobType', 'jobType', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <input type="radio" name="jobType" class="jobType" value="1" <?php echo set_value('jobType', isset($jobEdit->jobType) ? "checked" : "") ?> />
                                        <span class = "pr20">Part-Time</span>
                                        <input type="radio" name="jobType" class="jobType" value="2" <?php echo set_value('jobType', isset($jobEdit->jobType) ? "checked" : "") ?> />
                                        <span>Full-Time</span>
                                        <div class="jobTypeError">
                                            <?php echo form_error('jobType'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_role', 'role', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'role',
                                                'name' => 'role',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('role', $roleArray,set_value('role', isset($jobEdit->role) ? $jobEdit->role : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('role'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_minQualification', 'minQualification', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'minQualification',
                                                'name' => 'minQualification',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('minQualification', $minQualificationArray,set_value('minQualification', isset($jobEdit->minQualification) ? $jobEdit->minQualification : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('minQualification'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_requiredSkill', 'requiredSkill', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'requiredSkill',
                                                'name' => 'requiredSkill',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('requiredSkill', $requiredSkillArray,set_value('requiredSkill', isset($jobEdit->requiredSkill) ? $jobEdit->requiredSkill : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('requiredSkill'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_extraSkill', 'extraSkill', array('class' => 'col-md-4 control-label')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array(
                                                'id' => 'extraSkill',
                                                'name' => 'extraSkill',
                                                'placeholder' => 'Enter Extra Skill',
                                                'class' => 'input_box col-md-12 form-control w43 h-25',
                                                'value' => set_value('extraSkill',isset($jobEdit->extraSkill) ? $jobEdit->extraSkill : false)
                                            );
                                            echo form_input($fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('extraSkill'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_maxAge', 'maxAge', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'maxAge',
                                                'name' => 'maxAge',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('maxAge', $maxAgeArray,set_value('maxAge', isset($jobEdit->maxAge) ? $jobEdit->maxAge : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('maxAge'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_salary', 'salary', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array(
                                                'id' => 'salary',
                                                'name' => 'salary',
                                                'placeholder' => 'Enter Salary',
                                                'class' => 'input_box col-md-12 form-control w43 h-25',
                                                'value' => set_value('salary',isset($jobEdit->salary) ? $jobEdit->salary : false)
                                            );
                                            echo form_input($fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('salary'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_workingHour', 'workingHour', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $workingHour = isset($jobEdit->workingHour) ? $jobEdit->workingHour : false;
                                            if ($workingHour != "") {
                                                $workingHour = date_format(date_create($workingHour),"H:i");
                                            }
                                            $fields = array(
                                                'id' => 'workingHour',
                                                'name' => 'workingHour',
                                                'placeholder' => 'Enter Working Hour',
                                                'class' => 'input_box col-md-12 form-control w43 h-25',
                                                'value' => set_value('workingHour',$workingHour)
                                            );
                                            echo form_input($fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('workingHour'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_jobLocation', 'jobLocation', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'jobLocation',
                                                'name' => 'jobLocation',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('jobLocation', $jobLocationArray,set_value('jobLocation', isset($jobEdit->jobLocation) ? $jobEdit->jobLocation : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('jobLocation'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_lastApplyDate', 'lastApplyDate', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="form-group col-md-8">
                                        <?php
                                            $fields = array(
                                                'id' => 'lastApplyDate',
                                                'name' => 'lastApplyDate',
                                                'placeholder' => 'Enter Date',
                                                'class' => 'input_box form-control w23 h-25',
                                                'autocomplete' => 'off',
                                                'value' => set_value('lastApplyDate',isset($jobEdit->lastApplyDate) ? $jobEdit->lastApplyDate : false)
                                            );
                                            echo form_input($fields);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_jobDescription', 'jobDescription', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col">
                                        <?php 
                                            $fields = array(
                                                'id' => 'jobDescription',
                                                'name' => 'jobDescription',
                                                'placeholder' => 'Enter Job Description',
                                                'class' => 'form-control w43',
                                                'rows' => 3,
                                                'cols' => 46,
                                                'value' => set_value('jobDescription',isset($jobEdit->jobDescription) ? $jobEdit->jobDescription : false)
                                            );
                                            echo form_textarea($fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('jobDescription'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="offset-md-4 col-md-6">
                                        <?php if(isset($jobEdit)) { ?>
                                            <button class="btn bg-warning text-white addEditProcess">
                                                <i class="fa fa-btn fa-edit"></i>
                                                <?php echo lang('lbl_update'); ?>
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-success addEditProcess">
                                                <i class="fa fa-btn fa-plus"></i>
                                                <?php echo lang('lbl_jobAdd'); ?>
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
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/datepicker_jquery_1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/bootstrap_datepicker_1.5.0.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/company/job/addEdit.js"></script>
    </body>
</html>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <style>
            a:hover {
                text-decoration: none !important;
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
            .row {
                margin-right: 0rem !important;
            }
            .container-fluid {
                padding-right: 8px !important;
            }
        </style>
    </head>
    <body>
        <div class="dispNone">
            <ol class="breadcrumb mb-1 ml-4 w96">
                <li class="breadcrumb-item">
                    <i class="fa fa-briefcase fa-btn mt3"></i>
                    <?php echo lang('lbl_job'); ?>
                    <span class ="dot historyScrClr">&bull;</span>
                    <span class="historyScrClr"><?php echo lang('lbl_list'); ?></span>
                </li>
                <?php if ($this->session->flashdata('message') != "") { ?>
                    <div class="alert alert-<?php echo($this->session->flashdata('type')); ?> fmsg tac">
                        <?php echo($this->session->flashdata('message')); ?>
                    </div>
                <?php } ?>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="container-fluid dispNone">
                    <?php if ($this->session->userdata('flag') == 2) { ?>
                        <a class="btn btn-success mb-1" href="<?php echo site_url('JobController/jobAdd') ?>">
                            <i class="fa fa-btn fa-plus"></i><?php echo lang('lbl_jobAdd'); ?>
                        </a>
                    <?php } ?>
                    <?php echo form_open('JobController/jobList',['method' => 'POST','id' => 'listForm','name' => 'listForm']); ?>
                        <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                        <input type="hidden" id="hiddenJobId" name="hiddenJobId">
                        <input type="hidden" id="hiddenDelFlag" name="hiddenDelFlag">
                        <input type="hidden" id="hiddenFlag" name="hiddenFlag" value="<?php echo $this->session->userdata('flag'); ?>">
                        <input type="hidden" id="per_page" name="per_page">
                        <input type="hidden" id="hiddenSearch" name="hiddenSearch" value="<?php echo $this->input->post('hiddenSearch'); ?>">

                        <?php if ($this->session->userdata('flag') == 2) { ?>
                            <!-- filtering process -->
                            <div class="inb fs16 float-left w54">
                                <a href="javascript:;" onclick="fnJobFilter(1)" id="filterVal1" 
                                    class="fs16 btn btn-link <?php echo $disableAll ?>"><?php echo lang('lbl_all'); ?></a>
                                <span> | </span>
                                <a href="javascript:;" onclick="fnJobFilter(2)" id="filterVal2" 
                                    class="fs16 btn btn-link <?php echo $disableActive ?>"><?php echo lang('lbl_active'); ?></a>
                                <span> | </span>
                                <a href="javascript:;" onclick="fnJobFilter(3)" id="filterVal3" 
                                    class="fs16 btn btn-link <?php echo $disableNonActive ?>"><?php echo lang('lbl_deactive'); ?></a>
                            </div>
                            <input type="hidden" id="filterVal" name="filterVal" value="<?php echo $this->input->post('filterVal'); ?>">
                        <?php } ?>

                        <!-- clear search -->
                        <div  class="inb float-left mt-1 w3">
                            <a href="javascript:;" onclick="fnClearSearch()">
                                <img style="width: 25px;" src="<?php echo base_url(); ?>assets/images/clearsearch.png" title="Clear Search">
                            </a>
                        </div>

                        <!-- sorting process -->
                        <div class="inb float-left">
                            <?php 
                                $data= array (
                                    'id' => 'sortProcess',
                                    'name' => 'sortProcess',
                                    'class' => 'form-control autowidth h34 inb mr-2 CMN_sorting '.$sortStyle,
                                );
                                echo form_dropdown('sortProcess',$sortArray,set_value('sortProcess', 1, false),$data);
                            ?>
                            <input type="hidden" id="sortVal" name="sortVal" value="<?php echo $this->input->post('sortVal'); ?>">
                            <input type="hidden" id="sortOptn" name="sortOptn" value="<?php echo $this->input->post('sortOptn'); ?>">
                        </div>

                        <!-- searching process -->
                        <div class="input-group searchBtn">
                            <?php
                                $data= array(
                                    'id' => 'search',
                                    'name' => 'search',
                                    'placeholder' => 'Search Skill Name',
                                    'class' => 'input_box form-control h34',
                                    'value' => $this->input->post('hiddenSearch')
                                );
                                echo form_input($data);
                            ?>
                            <div class="input-group-append">
                                <a class="btn btn-secondary h34" href="javascript:;" onclick="fnJobSearch()">
                                    <i class="fa fa-search" title="Search"></i>
                                </a>
                            </div>
                        </div>

                        <table class="table table-bordered table-position">
                            <colgroup>
                                <col width="1%">
                                <col>
                                <col width="10%">
                                <col width="11%">
                                <col width="11%">
                                <col width="10%">
                                <col width="7%">
                                <col width="11%">
                                <col width="13%">
                            </colgroup>
                            <thead class="thead">
                                <tr>
                                    <th><?php echo lang('lbl_serialNumber'); ?></th>
                                    <th title="<?php echo lang('lbl_jobCategory'); ?>"><?php echo lang('lbl_category'); ?></th>
                                    <th title="<?php echo lang('lbl_requiredSkill'); ?>"><?php echo lang('lbl_skill'); ?></th>
                					<th><?php echo lang('lbl_role'); ?></th>
                                    <th><?php echo lang('lbl_salary'); ?></th>
                                    <th title="<?php echo lang('lbl_jobLocation'); ?>"><?php echo lang('lbl_location'); ?></th>
                                    <th title="<?php echo lang('lbl_workingHour'); ?>">W.H</th>
                                    <th title="<?php echo lang('lbl_lastApplyDate'); ?>"><?php echo lang('lbl_last_date'); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php
                                if ($jobList != null) {
                                    foreach ($jobList as $key => $list) {
                                        $class = $key % 2 === 0 ? 'odd' : 'even'; ?>
                                        <tr class="<php <?php echo $class; ?>">
                                            <td class="tac vam"><?php echo (++$serialNumber); ?></td>
                                            <td class="vam"><?php echo $list->designationName; ?></td>
                                            <td class="vam"><?php echo $list->skillName; ?></td>
                                            <td class="vam"><?php echo $list->roleName; ?></td>
                                            <td class="tac vam"><?php echo number_format($list->salary); ?></td>
                                            <td class="vam"><?php echo $list->jobLocation; ?></td>
                                            <td class="tac vam"><?php echo $list->workingHour; ?></td>
                                            <td class="tac vam"><?php echo $list->lastApplyDate; ?></td>
                                            <td class="tac vam">
                                                <a href="javascript:;" onclick="fnJobDetail(<?php echo $list->id;?>)" class="m3">
                                                    <img class="w20" 
                                                        src="<?php echo base_url(); ?>assets/images/details.png" title="details view">
                                                </a>
                                                <?php if ($this->session->userdata('flag') == 2) { ?>
                                                    <?php if($list->delFlag == 0) { ?>
                                                        <a href="javascript:;" onclick="fnJobActiveOrDeactive(<?php echo $list->id;?> , <?php echo $list->delFlag;?>)">
                                                            <?php echo lang('lbl_active'); ?>
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="javascript:;" onclick="fnJobActiveOrDeactive(<?php echo $list->id;?> , <?php echo $list->delFlag;?>)" style="color: red;">
                                                            <?php echo lang('lbl_deactive'); ?>
                                                        </a>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <a href="javascript:;" onclick="fnApply(<?php echo $list->id;?>)" class="apply_link">
                                                        <?php echo lang('lbl_apply'); ?>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="9" class="tac noDataFoundClr fs16">No data found</td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php echo form_close();?>
                </div>
            </div>
            <!-- Render pagination links -->
            <div class="pagination" style="margin: auto;">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/company/job/list.js"></script>
    </body>
</html>

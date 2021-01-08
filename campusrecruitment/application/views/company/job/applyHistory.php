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
                    <span class="historyScrClr"><?php echo lang('lbl_applyHistory'); ?></span>
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
                    <?php if ($this->session->userdata('flag') == 3) { ?>
                        <a class="btn btn-success mb-1" href="<?php echo site_url('JobController/jobLists') ?>">
                            <i class="fa fa-btn fa-plus"></i><?php echo lang('lbl_findNewJob'); ?>
                        </a>
                    <?php } ?>
                    <?php echo form_open('JobController/jobApplyDetail',['method' => 'POST','id' => 'applyHistoryForm','name' => 'applyHistoryForm']); ?>
                        <input type="hidden" id="baseUrl" value="<?php echo base_url(); ?>">
                        <input type="hidden" id="hiddenApplyJobId" name="hiddenApplyJobId">
                        <input type="hidden" id="per_page" name="per_page">
                        <input type="hidden" id="hiddenSearch" name="hiddenSearch" value="<?php echo $this->input->post('hiddenSearch'); ?>">

                            <!-- filtering process -->
                            <div class="inb fs16 float-left w54">
                                <a href="javascript:;" onclick="fnJobFilter(1)" id="filterVal1" 
                                    class="fs16 btn btn-link <?php echo $disableAll ?>"><?php echo lang('lbl_all'); ?></a>
                                <span> | </span>
                                <a href="javascript:;" onclick="fnJobFilter(2)" id="filterVal2" 
                                    class="fs16 btn btn-link <?php echo $disableApplied ?>"><?php echo lang('lbl_applied'); ?></a>
                                <span> | </span>
                                <a href="javascript:;" onclick="fnJobFilter(3)" id="filterVal3" 
                                    class="fs16 btn btn-link <?php echo $disableCancelled ?>"><?php echo lang('lbl_cancelled'); ?></a>
                            </div>
                            <input type="hidden" id="filterVal" name="filterVal" value="<?php echo $this->input->post('filterVal'); ?>">

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
                                echo form_dropdown('sortProcess',$sortArray,set_value('sortProcess', 3, false),$data);
                            ?>
                            <input type="hidden" id="sortVal" name="sortVal" value="<?php echo $this->input->post('sortVal'); ?>">
                            <input type="hidden" id="sortOptn" name="sortOptn" value="<?php echo $this->input->post('sortOptn'); ?>">
                        </div>

                        <!-- searching process -->
                        <div class="input-group searchBtn">
                            <?php
                                if ($this->session->userdata('flag') == 2) {
                                    $searchPlaceHolder = 'Search Job Seeker Name';
                                } elseif ($this->session->userdata('flag') == 3) {
                                    $searchPlaceHolder = 'Search Company Name';
                                }
                                $data= array(
                                    'id' => 'search',
                                    'name' => 'search',
                                    'placeholder' => $searchPlaceHolder,
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
                                <col width="15%">
                                <col width="8%">
                                <col width="12%">
                                <col width="12%">
                                <col width="16%">
                                <col width="13%">
                            </colgroup>
                            <thead class="thead">
                                <tr>
                                    <th><?php echo lang('lbl_serialNumber'); ?></th>
                                    <th><?php echo lang('lbl_companyName'); ?></th>
                					<th><?php echo lang('lbl_jobCategory'); ?></th>
                                    <th><?php echo lang('lbl_salary'); ?></th>
                                    <th title="<?php echo lang('lbl_lastApplyDate'); ?>"><?php echo lang('lbl_last_date'); ?></th>
                                    <th><?php echo lang('lbl_appliedDate'); ?></th>
                                    <?php if ($this->session->userdata('flag') == 3) { ?>
                                        <th><?php echo lang('lbl_incharge'); ?> / <?php echo lang('lbl_contact'); ?></th>
                                    <?php } else if($this->session->userdata('flag') == 2) { ?>
                                        <th title="<?php echo lang('lbl_jobSeekerName'); ?> / <?php echo lang('lbl_contact'); ?>"><?php echo lang('lbl_name'); ?> / <?php echo lang('lbl_contact'); ?></th>
                                    <?php } ?>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php
                                if ($jobApplyHistory != null) {
                                    foreach ($jobApplyHistory as $key => $history) {
                                        $class = $key % 2 === 0 ? 'odd' : 'even'; ?>
                                        <tr class="<php <?php echo $class; ?>">
                                            <td class="tac vam"><?php echo (++$serialNumber); ?></td>
                                            <td class="vam"><?php echo $history->companyName; ?></td>
                                            <td class="vam"><?php echo $history->jobCategory; ?></td>
                                            <td class="tac vam"><?php echo $history->salary; ?></td>
                                            <td class="tac vam"><?php echo $history->lastApplyDate; ?></td>
                                            <td class="tac vam"><?php echo $history->applyDate; ?></td>
                                            <?php if ($this->session->userdata('flag') == 3) { ?>
                                                <td class="vam"><?php echo $history->incharge; ?><br><?php echo $history->contact; ?></td>
                                            <?php } else if($this->session->userdata('flag') == 2) { ?>
                                                <td class="vam"><?php echo $history->jobSeekerName; ?><br><?php echo $history->jobSeekerContact; ?></td>
                                            <?php } ?>
                                            <td class="tac vam">
                                                <a href="javascript:;" onclick="fnJobApplyDetail(<?php echo $history->id;?>)" class="m3">
                                                    <img class="w20" 
                                                        src="<?php echo base_url(); ?>assets/images/details.png" title="<?php echo lang('lbl_detailIconTitle'); ?>">
                                                </a>
                                                <?php if ($history->delFlag == 0 && $this->session->userdata('flag') == 3) { ?>
                                                    <?php if($history->jobResultId == null) { ?>
                                                        <a href="javascript:;" onclick="fnCancelApply(<?php echo $history->id;?>)" style="color: red;">
                                                            <?php echo lang('lbl_cancel'); ?>
                                                        </a>
                                                    <?php } else { ?>
                                                        <a title="<?php echo lang('lbl_checkYourResult'); ?>" href="<?php echo site_url('JobController/jobResultHistory') ?>">
                                                            <?php echo lang('lbl_result'); ?>
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="8" class="tac noDataFoundClr fs16">No data found</td>
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
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/company/job/applyHistory.js"></script>
    </body>
</html>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .btn_custom {
            border-radius: 0rem;
            padding: 1.1rem 0.2rem
        }
        @media screen and (min-width: 700px) {
            .display_btn {
                display:flex;
            }
        }

        @media screen and (max-width: 700px) {
            .w100 {
                width: 100% !important;
            }
            .mb5 {
                margin-bottom: 5px !important;
            }
        }

    </style>
</head>
<body>
    <div class="container-fluid">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><i class="fa fa-tachometer fa-btn mt3"></i><?php echo lang('lbl_dashboard'); ?></li>
            <li class="breadcrumb-item active"><?php echo lang('lbl_charts'); ?></li>
        </ol>
        <input type="hidden" id="baseUrl" value="<?php echo base_url(); ?>">
        <div class="display_btn">
            <a class="btn btn-info text-white mb24 mb5 btn_custom w17 w100">
                <i class="fa fa-btn fa-users"></i><br><?php echo $activeJobSeeker->activeJobSeeker; ?> <?php echo lang('lbl_caps_jobSeeker'); ?>
            </a>
            <a class="btn btn-warning text-white mb24 mb5 btn_custom w17 w100">
                <i class="fa fa-btn fa-briefcase"></i><br><?php echo $activeCompany->activeCompany; ?> <?php echo lang('lbl_caps_company'); ?>
            </a>
            <a class="btn btn-primary text-white mb24 mb5 btn_custom w17 w100">
                <i class="fa fa-btn fa-briefcase"></i><br><?php echo $allCompanyJobPosted->allJobPosted; ?> <?php echo lang('lbl_caps_jobPosted'); ?>
            </a>
            <a class="btn btn-success text-white mb24 mb5 btn_custom w17 w100">
                <i class="fa fa-btn fa-briefcase"></i><br><?php echo $allJobPassResult->allPassResult; ?> <?php echo lang('lbl_caps_passResult'); ?>
            </a>
            <a class="btn btn-info text-white mb24 mb5 btn_custom w17 w100">
                <i class="fa fa-btn fa-briefcase"></i><br><?php echo $allJobFailResult->allFailResult; ?> <?php echo lang('lbl_caps_failResult'); ?>
            </a>
            <a class="btn btn-danger text-white mb24 mb5 btn_custom w17 w100">
                <i class="fa fa-btn fa-briefcase"></i><br><?php echo $allCompanyJobCancelled->allJobCancelled; ?> <?php echo lang('lbl_caps_jobCancelled'); ?>
            </a>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-area-chart mr-1"></i>
                        <?php echo lang('lbl_heading_thisMonth'); ?>
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="30" style="width: 100% !important;"></canvas></div>
                    <div class="card-footer small text-muted">
                        <?php
                            $getDefaultTimeZone = date_default_timezone_get();
                            date_default_timezone_set('Asia/Calcutta');
                            $today = date("Y-m-d");
                            $yesterday = date('Y-m-d',strtotime("-1 days"));
                            $maxUpdatedDate = $maxAllJobAppliedDate->createdDateTime;
                            if (($maxAllJobAppliedDate->updatedDateTime != null) && ($maxAllJobAppliedDate->updatedDateTime > $maxAllJobAppliedDate->createdDateTime)) {
                                $maxUpdatedDate = $maxAllJobAppliedDate->updatedDateTime;
                            }
                            $maxDate = date("Y-m-d", strtotime($maxUpdatedDate));
                            $day = date("Y-m-d", strtotime($maxUpdatedDate))." ".lang('lbl_at');
                            $time = date("H:i", strtotime($maxUpdatedDate));
                            if ($today == $maxDate) {
                                $day = lang('lbl_today')." ".lang('lbl_at');
                            } elseif($yesterday == $maxDate) {
                                $day = lang('lbl_yesterday')." ".lang('lbl_at');
                            }
                            $updatedDate = lang('lbl_updated')." ".$day." ".$time;
                            date_default_timezone_set($getDefaultTimeZone);
                            if(isset($maxUpdatedDate) && $maxUpdatedDate != ""){
                                echo $updatedDate;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-bar-chart mr-1"></i>
                        <?php echo lang('lbl_heading_thisYear'); ?>
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="50" style="width: 100% !important;"></canvas></div>
                    <div class="card-footer small text-muted">
                        <?php 
                            if(isset($maxUpdatedDate) && $maxUpdatedDate != ""){
                                echo $updatedDate;
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-pie-chart mr-1"></i>
                        <?php echo lang('lbl_heading_fromTheBeginning'); ?>
                    </div>
                    <div class="card-body"><canvas id="myPieChart" width="100%" height="50" style="width: 100% !important;"></canvas></div>
                    <div class="card-footer small text-muted">
                        <?php 
                            if(isset($maxUpdatedDate) && $maxUpdatedDate != ""){
                                echo $updatedDate;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/dashBoard/chart/areaChart.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/dashBoard/chart/barChart.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/dashBoard/chart/pieChart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</body>
</html>
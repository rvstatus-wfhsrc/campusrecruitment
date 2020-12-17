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
        <div class="row">
            <div class="col-xl-12">
                <div class="container-fluid">
                    <a class="btn btn-success mb-1" href="<?php echo site_url('JobSeekerController/jobSeekerQualificationAdd') ?>">
                        <i class="fa fa-btn fa-plus"></i><?php echo lang('lbl_qualificationAdd'); ?>
                    </a>
                </div>
            </div>
    </body>
</html>

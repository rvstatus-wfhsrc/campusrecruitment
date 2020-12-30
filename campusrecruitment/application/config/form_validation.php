<?php
$config = array(
            'jobSeekerLoginRule' => array(
                            array(
                                'field' => 'jobSeekerUserName',
                                'label' => 'lang:lbl_userName',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'jobSeekerPassword',
                                'label' => 'lang:lbl_password',
                                'rules' => 'required|min_length[6]',
                                    array(
                                        'required' => 'lang:required',
                                        'min_length' => 'lang:min_length'
                                    )
                            )
                        ),
            'companyLoginRule' => array(
                            array(
                                'field' => 'companyUserName',
                                'label' => 'lang:lbl_userName',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'companyPassword',
                                'label' => 'lang:lbl_password',
                                'rules' => 'required|min_length[6]',
                                    array(
                                        'required' => 'lang:required',
                                        'min_length' => 'lang:min_length'
                                    )
                            )
                        ),
            'adminLoginRule' => array(
                            array(
                                'field' => 'adminUserName',
                                'label' => 'lang:lbl_userName',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'adminPassword',
                                'label' => 'lang:lbl_password',
                                'rules' => 'required|min_length[6]',
                                    array(
                                        'required' => 'lang:required',
                                        'min_length' => 'lang:min_length'
                                    )
                            )
                        ),
             'jobAddEdit' => array(
                            array(
                                'field' => 'jobCategory',
                                'label' => 'lang:lbl_jobCategory',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'jobType',
                                'label' => 'lang:lbl_jobType',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'requiredSkill',
                                'label' => 'lang:lbl_requiredSkill',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'extraSkill',
                                'label' => 'lang:lbl_extraSkill',
                                'rules' => 'extra_skill'
                            ),
                            array(
                                'field' => 'role',
                                'label' => 'lang:lbl_role',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'minQualification',
                                'label' => 'lang:lbl_minQualification',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'maxAge',
                                'label' => 'lang:lbl_maxAge',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'salary',
                                'label' => 'lang:lbl_salary',
                                'rules' => 'required|integer|greater_than[0]',
                                    array(
                                        'required' => 'lang:required',
                                        'integer' => 'lang:integer'
                                    )
                            ),
                            array(
                                'field' => 'jobLocation',
                                'label' => 'lang:lbl_jobLocation',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'workingHour',
                                'label' => 'lang:lbl_workingHour',
                                'rules' => 'required|integer|greater_than[0]|less_than_equal_to[15]',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'jobDescription',
                                'label' => 'lang:lbl_jobDescription',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            ),
                            array(
                                'field' => 'lastApplyDate',
                                'label' => 'lang:lbl_lastApplyDate',
                                'rules' => 'required|after_today',
                                    array(
                                        'required' => 'lang:required'
                                    )
                            )
                        ),
             'companyAddEdit' => array(
                                    array(
                                        'field' => 'companyName',
                                        'label' => 'lang:lbl_companyName',
                                        'rules' => 'required|alphabetic|max_length[50]|exist_company_name',
                                            array(
                                                'required' => 'lang:required',
                                                'max_length' => 'lang:max_length'
                                            )
                                    ),
                                    array(
                                        'field' => 'incharge',
                                        'label' => 'lang:lbl_incharge',
                                        'rules' => 'required|alphabetic|max_length[50]',
                                            array(
                                                'required' => 'lang:required',
                                                'max_length' => 'lang:max_length'
                                            )
                                    ),
                                    array(
                                        'field' => 'address',
                                        'label' => 'lang:lbl_address',
                                        'rules' => 'required',
                                            array(
                                                'required' => 'lang:required'
                                            )
                                    ),
                                    array(
                                        'field' => 'contact',
                                        'label' => 'lang:lbl_contact',
                                        'rules' => 'required|ten_digit_only',
                                            array(
                                                'required' => 'lang:required'
                                            )
                                    ),
                                    array(
                                        'field' => 'email',
                                        'label' => 'lang:lbl_email',
                                        'rules' => 'required|valid_email|max_length[50]|exist_email',
                                            array(
                                                'required' => 'lang:required',
                                                'max_length' => 'lang:max_length',
                                                'valid_email' => 'lang:valid_email'
                                            )
                                    ),
                                    array(
                                        'field' => 'website',
                                        'label' => 'lang:lbl_website',
                                        'rules' => 'required|valid_website|exist_company_website',
                                            array(
                                                'required' => 'lang:required',
                                                'max_length' => 'lang:max_length'
                                            )
                                    ),
                                    array(
                                        'field' => 'entryDate',
                                        'label' => 'lang:lbl_entryDate',
                                        'rules' => 'required|before_tomorrow',
                                            array(
                                                'required' => 'lang:required'
                                            )
                                    ),
                                    array(
                                        'field' => 'password',
                                        'label' => 'lang:lbl_password',
                                        'rules' => 'required|min_length[6]|password_confirmation',
                                            array(
                                                'required' => 'lang:required',
                                                'min_length' => 'lang:min_length'
                                            )
                                    ),
                                    array(
                                        'field' => 'password_confirmation',
                                        'label' => 'lang:lbl_conf_password',
                                        'rules' => 'required|min_length[6]',
                                            array(
                                                'required' => 'lang:required',
                                                'min_length' => 'lang:min_length'
                                            )
                                    )
                                ),
                'adminCompanyAddEdit' => array(
                                    array(
                                        'field' => 'companyName',
                                        'label' => 'lang:lbl_companyName',
                                        'rules' => 'required|alphabetic|max_length[50]|exist_company_name',
                                            array(
                                                'required' => 'lang:required',
                                                'max_length' => 'lang:max_length'
                                            )
                                    ),
                                    array(
                                        'field' => 'incharge',
                                        'label' => 'lang:lbl_incharge',
                                        'rules' => 'required|alphabetic|max_length[50]',
                                            array(
                                                'required' => 'lang:required',
                                                'max_length' => 'lang:max_length'
                                            )
                                    ),
                                    array(
                                        'field' => 'address',
                                        'label' => 'lang:lbl_address',
                                        'rules' => 'required',
                                            array(
                                                'required' => 'lang:required'
                                            )
                                    ),
                                    array(
                                        'field' => 'contact',
                                        'label' => 'lang:lbl_contact',
                                        'rules' => 'required|ten_digit_only',
                                            array(
                                                'required' => 'lang:required'
                                            )
                                    ),
                                    array(
                                        'field' => 'email',
                                        'label' => 'lang:lbl_email',
                                        'rules' => 'required|valid_email|max_length[50]|exist_email',
                                            array(
                                                'required' => 'lang:required',
                                                'max_length' => 'lang:max_length',
                                                'valid_email' => 'lang:valid_email'
                                            )
                                    ),
                                    array(
                                        'field' => 'website',
                                        'label' => 'lang:lbl_website',
                                        'rules' => 'required|valid_website|exist_company_website',
                                            array(
                                                'required' => 'lang:required',
                                                'max_length' => 'lang:max_length'
                                            )
                                    ),
                                    array(
                                        'field' => 'entryDate',
                                        'label' => 'lang:lbl_entryDate',
                                        'rules' => 'required|before_tomorrow',
                                            array(
                                                'required' => 'lang:required'
                                            )
                                    )
                                ),
                'jobSeekerAdd' => array(
                                    array(
                                        'field' => 'name',
                                        'label' => 'lang:lbl_name',
                                        'rules' => 'required|alphabetic|max_length[50]'
                                    ),
                                    array(
                                        'field' => 'email',
                                        'label' => 'lang:lbl_email',
                                        'rules' => 'required|valid_email|max_length[50]|jobSeeker_email_existing_check',
                                            array(
                                                'valid_email' => 'lang:valid_email'
                                            )
                                    ),
                                    array(
                                        'field' => 'gender',
                                        'label' => 'lang:lbl_gender',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'address',
                                        'label' => 'lang:lbl_address',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'country',
                                        'label' => 'lang:lbl_country',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'state',
                                        'label' => 'lang:lbl_state',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'city',
                                        'label' => 'lang:lbl_city',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'pincode',
                                        'label' => 'lang:lbl_pincode',
                                        'rules' => 'required|six_digit_only'
                                    ),
                                    array(
                                        'field' => 'contact',
                                        'label' => 'lang:lbl_contact',
                                        'rules' => 'required|ten_digit_only'
                                    ),
                                    array(
                                        'field' => 'password',
                                        'label' => 'lang:lbl_password',
                                        'rules' => 'required|min_length[6]|password_confirmation'
                                    ),
                                    array(
                                        'field' => 'password_confirmation',
                                        'label' => 'lang:lbl_conf_password',
                                        'rules' => 'required|min_length[6]'
                                    )
                                ),
                'jobSeekerEdit' => array(
                                    array(
                                        'field' => 'name',
                                        'label' => 'lang:lbl_name',
                                        'rules' => 'required|alphabetic|max_length[50]'
                                    ),
                                    array(
                                        'field' => 'email',
                                        'label' => 'lang:lbl_email',
                                        'rules' => 'required|valid_email|max_length[50]|jobSeeker_email_existing_check',
                                            array(
                                                'valid_email' => 'lang:valid_email'
                                            )
                                    ),
                                    array(
                                        'field' => 'gender',
                                        'label' => 'lang:lbl_gender',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'address',
                                        'label' => 'lang:lbl_address',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'country',
                                        'label' => 'lang:lbl_country',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'state',
                                        'label' => 'lang:lbl_state',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'city',
                                        'label' => 'lang:lbl_city',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'pincode',
                                        'label' => 'lang:lbl_pincode',
                                        'rules' => 'required|six_digit_only'
                                    ),
                                    array(
                                        'field' => 'contact',
                                        'label' => 'lang:lbl_contact',
                                        'rules' => 'required|ten_digit_only'
                                    )
                                ),
                'jobSeekerQualificationAddEdit' => array(
                                    array(
                                        'field' => 'tenthMark',
                                        'label' => 'lang:lbl_tenthMark',
                                        'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[100]'
                                    ),
                                    array(
                                        'field' => 'twelvethMark',
                                        'label' => 'lang:lbl_twelvethMark',
                                        'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[100]'
                                    ),
                                    array(
                                        'field' => 'qualification',
                                        'label' => 'lang:lbl_qualification',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'yearOfPassing',
                                        'label' => 'lang:lbl_yearOfPassing',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'monthOfPassing',
                                        'label' => 'lang:lbl_monthOfPassing',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'specification',
                                        'label' => 'lang:lbl_specification',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'branch',
                                        'label' => 'lang:lbl_branch',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'university',
                                        'label' => 'lang:lbl_university',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'collegeName',
                                        'label' => 'lang:lbl_collegeName',
                                        'rules' => 'required|alphabetic|max_length[50]'
                                    ),
                                    array(
                                        'field' => 'cgpa',
                                        'label' => 'lang:lbl_cgpa',
                                        'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[10]'
                                    ),
                                    array(
                                        'field' => 'skill',
                                        'label' => 'lang:lbl_skill',
                                        'rules' => 'required'
                                    ),
                                    array(
                                        'field' => 'extraSkill',
                                        'label' => 'lang:lbl_extraSkill',
                                        'rules' => 'extra_skill'
                                    )
                                ),
                'jobResultAddEdit' => array(
                                    // array(
                                    //     'field' => 'totalMark',
                                    //     'label' => 'lang:lbl_totalMark',
                                    //     'rules' => 'required|integer|greater_than[0]'
                                    // ),
                                    array(
                                        'field' => 'obtainMark',
                                        'label' => 'lang:lbl_obtainMark',
                                        'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[100]'
                                    ),
                                    array(
                                        'field' => 'resultStatus',
                                        'label' => 'lang:lbl_resultStatus',
                                        'rules' => 'required'
                                    )
                                ),
                'getResetPasswordLink' => array(
                                    array(
                                        'field' => 'email',
                                        'label' => 'lang:lbl_email',
                                        'rules' => 'required|valid_email|max_length[50]',
                                            array(
                                                'valid_email' => 'lang:valid_email'
                                            )
                                    )
                                ),
                'resetPassword' => array(
                                    array(
                                        'field' => 'password',
                                        'label' => 'lang:lbl_password',
                                        'rules' => 'required|min_length[6]|password_confirmation',
                                            array(
                                                'required' => 'lang:required',
                                                'min_length' => 'lang:min_length'
                                            )
                                    ),
                                    array(
                                        'field' => 'password_confirmation',
                                        'label' => 'lang:lbl_conf_password',
                                        'rules' => 'required|min_length[6]',
                                            array(
                                                'required' => 'lang:required',
                                                'min_length' => 'lang:min_length'
                                            )
                                    )
                                )
           );

?>
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
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
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
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
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
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
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
                                'field' => 'requiredSkill',
                                'label' => 'lang:lbl_requiredSkill',
                                'rules' => 'required',
                                    array(
                                        'required' => 'lang:required'
                                    )
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
                                'rules' => 'required|belongstowork',
                                    array(
                                        'required' => 'lang:required'
                                        // 'integer' => 'lang:integer'
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
                                'rules' => 'required',
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
                                'rules' => 'required',
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
                                        'rules' => 'required|contact_digit',
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
                                        'rules' => 'required|exist_company_website|valid_website',
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
                                        'rules' => 'required|contact_digit',
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
                                        'rules' => 'required|exist_company_website|valid_website',
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
                                )                                      
           );

?>
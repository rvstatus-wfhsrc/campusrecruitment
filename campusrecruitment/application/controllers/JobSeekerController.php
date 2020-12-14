<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Job Seeker Controller
 *
 * This Controller are used to perform the job seeker related process
 * 
 * @author Kulasekaran.
 *
 */

class JobSeekerController extends CI_Controller {

	public $layout_view = 'layouts/default';
	/**
	 * Job Seeker Controller __construct
	 *
	 * This __construct are used to load the CommonModel and JobSeekerModel
	 * 
	 * @author Kulasekaran.
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('JobSeekerModel');
		$this->load->model('CommonModel');
	}

    /**
	 * This jobSeekerProfileAdd method are used to call the job seeker add screen
	 * @return to view [ jobSeeker/profile/addEdit ]
	 * @author Kulasekaran.
	 *
	 */
    public function jobSeekerProfileAdd() {
    	$data['countryArray'] = $this->CommonModel->country();
		$data['stateArray'] = $this->CommonModel->state();
		$data['cityArray'] = $this->CommonModel->city();
        $this->layouts->view('jobSeeker/profile/addEdit',$data);
    }

    /**
	 * This jobSeekerFormValidation method are used to validate the job seeker add and edit screens fields
	 * @return the error status into assets/js/jobSeeker/profile/addEdit.js file
	 * @author Kulasekaran.
	 *
	 */
    public function jobSeekerProfileFormValidation() {
		// job seeker field validation
		if ($this->form_validation->run('jobSeekerAddEdit') == FALSE) {
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response); exit();
		} else {
			echo json_encode(true); exit();
		}
	}

	/**
	 * This jobSeekerAddForm method are used to get data from form and pass it to model for the specfic job seeker
	 * @return the redirect to the JobSeekerController/jobSeekerDetail
	 * @author Kulasekaran.
	 *
	 */
	public function jobSeekerAddForm() {
		$userName = $this->JobSeekerModel->lastJobSeekerUserName();
		$jobSeekerAddStatus = $this->JobSeekerModel->jobSeekerAdd($userName);
		print_r($jobSeekerAddStatus);exit();
		if($jobSeekerAddStatus){
			$this->session->set_flashdata([
				'message'  => 'Job Seeker Details Add Successfully',
				'type' => 'success'
			]);
		} else {
			$this->session->set_flashdata([
				'message'  => 'Sorry, Something Went Wrong. Please Try Again Later',
				'type' => 'danger'
			]);
		}
		redirect('JobSeekerController/jobSeekerDetail');
	}

	/**
	 * This companyDetail method are used to get the data from model for the specfic company
	 * @return to view screen [ detail ]
	 * @author kulasekaran.
	 *
	 */
	// public function companyDetail() {
	// 	$companyId = $this->input->post('hiddenCompanyId');
	// 	$url = 'admin/company/detail';
	// 	if ($this->session->flashdata('hiddenCompanyId')) {
	// 	    $companyId = $this->session->flashdata('hiddenCompanyId');
	// 	    $url = 'company/profile/detail';
	// 	} elseif ($this->session->flashdata('hiddenAdminCompanyId')) {
	// 		$companyId = $this->session->flashdata('hiddenAdminCompanyId');
	// 		$url = 'admin/company/detail';
	// 	} elseif ($companyId == null) {
	// 	    $url = 'company/profile/detail';
	// 	}
	// 	$data['companyDetail'] = $this->CompanyModel->companyDetail($companyId);
	// 	$this->layouts->view($url,$data);
	// }

	/**
	 * This companyEdit method are used to get the data from model for the specfic company
	 * @return to view screen [ addEdit ]
	 * @author kulasekaran.
	 *
	 */
	// public function companyEdit() {
	// 	if($this->input->post('hiddenCompanyId') == null) {
 //            redirect('CompanyController/companyHistory');
 //        }
	// 	$companyId = $this->input->post('hiddenCompanyId');
	// 	$data['companyEdit'] = $this->CompanyModel->companyEdit($companyId);
	// 	$this->layouts->view('admin/company/addEdit',$data);
	// }

	/**
	 * This companyUpdate method are used to get the data from form and pass it to model for update process
	 * @return the redirect to method [ companyHistory ]
	 * @author kulasekaran.
	 *
	 */
	// public function companyUpdate() {
	// 	$companyUpdateStatus = $this->CompanyModel->companyUpdate();
	// 	if($companyUpdateStatus == "1") {
	//         $this->session->set_flashdata(array('message' => 'Company Details Updated Successfully','type' => 'success','hiddenAdminCompanyId' => $this->input->post('hiddenCompanyId')));
	//        	redirect('CompanyController/companyDetail');
	//     } else {
	//         $this->session->set_flashdata(array('message' => 'Company Details Update Failed','type' => 'danger'));
	//         redirect('CompanyController/companyDetail');
	//     }
	// }

	/**
	 * This companyProfileAdd method are used to call the company add a new screen
	 * @return to view [ addEdit ]
	 * @author Kulasekaran.
	 *
	 */
 //    public function companyProfileAdd() {
 //        $this->layouts->view('company/profile/addEdit');
 //    }

 //    public function companyProfileFormValidation() {
	// 	if ($this->form_validation->run('companyAddEdit') == FALSE) {
	// 		$json_response = $this->form_validation->error_array();
	// 		echo json_encode($json_response); exit();
	// 	} else {
	// 		echo json_encode(true); exit();
	// 	}
	// }

	/**
	 * This companyProfileAddForm method are used to get data from form and pass it to model for the specfic company
	 * @return to view
	 * @author Kulasekaran.
	 *
	 */
	// public function companyProfileAddForm() {
 //        $userName = $this->CompanyModel->lastCompanyUserName();
	// 	$companyAddStatus = $this->CompanyModel->companyAdd($userName);
	// 	if($companyAddStatus == "1") { 
	// 		$this->session->set_flashdata(array('message' => 'Company Successfully Registered','type' => 'success','hiddenCompanyId' => $this->session->userdata('userName')));
	// 		redirect('LoginController');
	// 	} else {
	// 		$this->session->set_flashdata(array('message' => 'Sorry, Something Went Wrong. Please Try Again Later','type' => 'danger'));
	// 		redirect('CompanyController/companyDetail');
	// 	}
	// }

	/**
	 * This companyProfileEdit method are used to get the data from model for the specfic company
	 * @return to view screen [ company/profile/addEdit ]
	 * @author kulasekaran.
	 *
	 */
	// public function companyProfileEdit() {
	// 	if($this->input->post('hiddenCompanyId') == null) {
 //            redirect('CompanyController/companyDetail');
 //        }
	// 	$companyId = $this->input->post('hiddenCompanyId');
	// 	$data['companyEdit'] = $this->CompanyModel->companyEdit($companyId);
	// 	$this->layouts->view('company/profile/addEdit',$data);
	// }

	/**
	 * This companyProfileUpdate method are used to get the data from form and pass it to model for update process
	 * @return the redirect to method [ companyHistory ]
	 * @author kulasekaran.
	 *
	 */
	// public function companyProfileUpdate() {
	// 	$companyUpdateStatus = $this->CompanyModel->companyUpdate();
	// 	if($companyUpdateStatus == "1") {
	//         $this->session->set_flashdata(array('message' => 'Company Details Updated Successfully','type' => 'success','hiddenCompanyId' => $this->input->post('hiddenCompanyId')));
	//        	redirect('CompanyController/companyDetail');
	//     } else {
	//         $this->session->set_flashdata(array('message' => 'Company Details Update Failed','type' => 'danger'));
	//         redirect('CompanyController/companyDetail');
	//     }
	// }

}
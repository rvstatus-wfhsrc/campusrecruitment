<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Job Seeker Controller
 *
 * This Controller are used to perform the job seeker related process
 * 
 * @author kulasekaran.
 *
 */

class JobSeekerController extends CI_Controller {

	public $specificationArray = array('' => 'Select Specification','1'=>'UG','2'=>'PG','3'=>'Diploma');
	public $monthOfPassingArray = array('' => 'Select Month','1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
	public $layout_view = 'layouts/default';
	/**
	 * Job Seeker Controller __construct
	 *
	 * This __construct are used to load the CommonModel and JobSeekerModel
	 * 
	 * @author kulasekaran.
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
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerProfileAdd() {
		$data['countryArray'] = $this->CommonModel->country();
		$data['stateArray'] = $this->CommonModel->state();
		$data['cityArray'] = $this->CommonModel->city();
		$this->layouts->view('jobSeeker/profile/addEdit',$data);
	}

	/**
	 * This jobSeekerProfileFormValidation method are used to validate the job seeker add and edit screens fields
	 * @return the error status into assets/js/jobSeeker/profile/addEdit.js file
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerProfileFormValidation() {
		// job seeker field validation rule
		// screenFlag ---> 1 for add screen rule and 2 fore edit screen
		$validationRule = "jobSeekerAdd";
		if($this->input->post('screenFlag') != 1) {
			$validationRule = "jobSeekerEdit";
		}
		if ($this->form_validation->run($validationRule) == FALSE) {
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response); exit();
		} else {
			echo json_encode(true); exit();
		}
	}

	/**
	 * This jobSeekerAddForm method are used to get data from form and pass it to model for the specfic job seeker
	 * @return the redirect to the JobSeekerController/jobSeekerDetail
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerAddForm() {
		$jobSeekerAddStatus = $this->JobSeekerModel->jobSeekerAdd();
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
		redirect('LoginController/jobSeekerLogin');
	}

	/**
	 * This jobSeekerDetail method are used to get the data from model for the specfic job seeker
	 * @return to view screen [ jobSeeker/profile/addEdit ]
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerDetail() {
		$data['jobSeekerDetail'] = $this->JobSeekerModel->jobSeekerDetail();
		$this->layouts->view('jobSeeker/profile/detail',$data);
	}

	/**
	 * This removeImage method are used to remove the image for specfic job seeker
	 * @return redirect to jobSeekerDetail method in JobSeekerController
	 * @author kulasekaran.
	 *
	 */
	public function removeImage() {
		$imageStatus = $this->JobSeekerModel->removeImage();
		if($imageStatus == "1") { 
			$this->session->set_flashdata(
				array(
					'message' => 'Image Was Removed',
					'type' => 'success'
				)
			);
			redirect('JobSeekerController/jobSeekerDetail');
		} else {
			$this->session->set_flashdata(
				array(
					'message' => 'Sorry, Something Went Wrong. Please Try Again Later',
					'type' => 'danger'
				)
			);
			redirect('JobSeekerController/jobSeekerDetail');
		}
	}

	/**
	 * This jobSeekerEdit method are used to get the data from model for the specfic job seeker details
	 * @return to view screen [ jobSeeker/profile/addEdit ]
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerEdit() {
		if($this->input->post('hiddenJobSeekerId') == null) {
			redirect('JobSeekerController/jobSeekerDetail');
		}
		$data['countryArray'] = $this->CommonModel->country();
		$data['stateArray'] = $this->CommonModel->state();
		$data['cityArray'] = $this->CommonModel->city();
		$data['jobSeekerEdit'] = $this->JobSeekerModel->jobSeekerEdit();

		$this->layouts->view('jobSeeker/profile/addEdit',$data);
	}

	/**
	 * This jobSeekerEditForm method are used to get the data from form and pass it to model for update process
	 * @return the redirect to JobSeekerController jobSeekerDetail method 
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerEditForm() {
		$companyUpdateStatus = $this->JobSeekerModel->jobSeekerUpdate();
		if($companyUpdateStatus == "1") {
			$this->session->set_flashdata(
				array(
					'message' => 'Job Seeker Details Updated Successfully',
					'type' => 'success'
				)
			);
			redirect('JobSeekerController/jobSeekerDetail');
		} else {
			$this->session->set_flashdata(
				array(
					'message' => 'Job Seeker Details Update Failed',
					'type' => 'danger'
				)
			);
			redirect('JobSeekerController/jobSeekerDetail');
		}
	}

	/**
	 * This jobSeekerQualificationDetail method are used to get the qualification detail from database for specific job seeker
	 * @return to view[jobSeeker/qualification/detail]
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerQualificationDetail() {
		$data['qualificationArray'] = $this->CommonModel->qualification();
		$data['specificationArray'] = $this->specificationArray;
		$data['yearOfPassingArray'] = $this->CommonModel->getYear();
		$data['monthOfPassingArray'] = $this->monthOfPassingArray;
		$data['branchArray'] = $this->CommonModel->department();
		$data['universityArray'] = $this->CommonModel->university();
		$data['qualificationDetail'] = $this->JobSeekerModel->jobSeekerQualificationDetail();
		$this->layouts->view('jobSeeker/qualification/detail',$data);
	}

	/**
	 * This jobSeekerQualificationAdd method are used to display the qualification add screen
	 * @return to view[jobSeeker/qualification/addEdit] 
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerQualificationAdd() {
		$data['skillArray'] = $this->CommonModel->skill();
		$data['qualificationArray'] = $this->CommonModel->qualification();
		$data['specificationArray'] = $this->specificationArray;
		$data['yearOfPassingArray'] = $this->CommonModel->getYear();
		$data['monthOfPassingArray'] = $this->monthOfPassingArray;
		$data['branchArray'] = $this->CommonModel->department();
		$data['universityArray'] = $this->CommonModel->university();
		$this->layouts->view('jobSeeker/qualification/addEdit',$data);
	}

	/**
	 * This jobSeekerQualificationFormValidation method are used to validate the job seeker's qualification add and edit screens fields
	 * @return the error status into assets/js/jobSeeker/qualification/addEdit.js file
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerQualificationFormValidation() {
		// job seeker qualification field validation rule
		// screenFlag ---> 1 for add screen rule and 2 fore edit screen
		$validationRule = "jobSeekerQualificationAddEdit";
		if ($this->form_validation->run($validationRule) == FALSE) {
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response); exit();
		} else {
			echo json_encode(true); exit();
		}
	}

	/**
	 * This jobSeekerQualificationAddForm method are used to get qualification data from form and pass it to model for the specfic job seeker
	 * @return the redirect to the JobSeekerController/jobSeekerQualificationDetail
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerQualificationAddForm() {
		$jobSeekerQualificationAddStatus = $this->JobSeekerModel->jobSeekerQualificationAdd();
		if($jobSeekerQualificationAddStatus){
			$this->session->set_flashdata([
				'message'  => 'Job Seeker Qualification Details Add Successfully',
				'type' => 'success'
			]);
		} else {
			$this->session->set_flashdata([
				'message'  => 'Sorry, Something Went Wrong. Please Try Again Later',
				'type' => 'danger'
			]);
		}
		redirect('JobSeekerController/jobSeekerQualificationDetail');
	}

	/**
	 * This jobSeekerQualificationEdit method are used to get the data from model for the specfic job seeker's qualification details to edit
	 * @return to view screen [ jobSeeker/qualification/addEdit ]
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerQualificationEdit() {
		if($this->input->post('hiddenJobSeekerQualificationId') == null) {
			redirect('JobSeekerController/jobSeekerQualificationDetail');
		}
		$data['skillArray'] = $this->CommonModel->skill();
		$data['qualificationArray'] = $this->CommonModel->qualification();
		$data['specificationArray'] = $this->specificationArray;
		$data['yearOfPassingArray'] = $this->CommonModel->getYear();
		$data['monthOfPassingArray'] = $this->monthOfPassingArray;
		$data['branchArray'] = $this->CommonModel->department();
		$data['universityArray'] = $this->CommonModel->university();
		$data['qualificationEdit'] = $this->JobSeekerModel->jobSeekerQualificationEdit();
		$this->layouts->view('jobSeeker/qualification/addEdit',$data);
	}

	/**
	 * This jobSeekerQualificationUpdate method are used to get the data from form and pass it to model for update process
	 * @return the redirect to JobSeekerController/jobSeekerQualificationDetail method 
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerQualificationUpdate() {
		$qualificationUpdateStatus = $this->JobSeekerModel->jobSeekerQualificationUpdate();
		if($qualificationUpdateStatus == "1") {
			$this->session->set_flashdata(
				array(
					'message' => 'Job Seeker Qualification Details Updated Successfully',
					'type' => 'success'
				)
			);
			redirect('JobSeekerController/jobSeekerQualificationDetail');
		} else {
			$this->session->set_flashdata(
				array(
					'message' => 'Job Seeker Qualification Details Update Failed',
					'type' => 'danger'
				)
			);
			redirect('JobSeekerController/jobSeekerQualificationDetail');
		}
	}


}
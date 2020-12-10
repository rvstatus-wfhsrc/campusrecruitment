<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Job Controller
 *
 * This Controller are used to perform the company job details related process
 * 
 * @author Kulasekaran.
 *
 */

class JobController extends CI_Controller {

	public $maxAgeArray = array('' => 'Select Maximum Age','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26');
	public $layout_view = 'layouts/default';
	/**
	 * Job Controller __construct
	 * 
	 * This __construct are used to load the CommonModel and AdminModel
	 * 
	 * @author Kulasekaran.
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('JobModel');
		$this->load->model('CommonModel');
	}

	/**
	 * This jobList method are used to get the data from model for the specfic company (company whose login to website)
	 * @return to view screen [ history ]
	 * @author Kulasekaran.
	 *
	 */
	public function jobList() {
		// filter process
		$filterVal = $this->input->post('filterVal');
		$data['disableAll'] = "";
		$data['disableActive'] = "";
		$data['disableNonActive'] = "";
		if ($filterVal == 2) {
			$data['disableActive'] = "disabled";
		} elseif ($filterVal == 3) {
			$data['disableNonActive'] = "disabled";
		} else {
			$data['disableAll'] = "disabled";
		}

		// sorting process style
		$sortOptn = $this->input->post('sortOptn');
		$data['sortStyle'] = "sort_desc";
		if(isset($sortOptn) && $sortOptn == "ASC") {
			$data['sortStyle'] = "sort_asc";
		} elseif(isset($sortOptn) && $sortOptn == "DESC") {
			$data['sortStyle'] = "sort_desc";
		}
		$data['sortArray'] = array('1' => 'Created Date','2' => 'Skill','3' => 'Salary','4' => 'Last Apply Date');

		// pagination process
		$totalRecord = $this->JobModel->record_count();
		$pagination_config = $this->CommonModel->paginationConfig($totalRecord,base_url()."JobController/jobHistory");
		$this->pagination->initialize($pagination_config);
		$page = (isset($_GET['per_page'])) ? $_GET['per_page'] : 0;

		$data["links"] = $this->pagination->create_links();
		$data['jobHistory'] = $this->JobModel->jobList($pagination_config["per_page"], $page);
		
		$this->layouts->view('company/job/history',$data);
	}


	/**
	 * This jobAdd method are used for goto the job add screen
	 * @return to view screen [ add ]
	 * @author Kulasekaran.
	 *
	 */
	public function jobAdd() {
		$data = array();

		$data['maxAgeArray'] = $this->maxAgeArray;
		$data['jobCategoryArray'] = $this->CommonModel->designation();
		$data['requiredSkillArray'] = $this->CommonModel->skill();
		$data['roleArray'] = $this->CommonModel->role();
		$data['minQualificationArray'] = $this->CommonModel->minQualification();
		$data['jobLocationArray'] = $this->CommonModel->country();
		$this->layouts->view('company/job/addEdit', $data);
	}


	public function jobAddForm() {
		$jobAddStatus = $this->JobModel->jobAdd();
		if($jobAddStatus){
			$this->session->set_flashdata([
				'message'  => 'Job Details Add Successfully',
				'type' => 'success'
			]);
		} else {
			$this->session->set_flashdata([
				'message'  => 'Sorry, Something Went Wrong. Please Try Again Later',
				'type' => 'danger'
			]);
		}
		redirect('JobController/jobList');
	}

	/**
	 * This jobAddEditFormValidation method are used to validate the given field data
	 * @return retrun a json value to js in job/addedit.js 
	 * @author Kulasekaran.
	 *
	 */
	public function jobAddEditFormValidation() {
		if ($this->form_validation->run('jobAddEdit') == FALSE) {
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response); exit();
		} else {
			echo json_encode(true); exit();
		}
	}

	/**
	 * This jobstatus method are used to change the delflag for the specfic job
	 * @return the redirect to JobController/jobHistory
	 * @author Kulasekaran.
	 *
	 */
    public function jobStatus() {
    	$id = $this->input->post('hiddenJobId');
    	$delFlag = $this->input->post('hiddenDelFlag');
        $jobStatus = $this->JobModel->jobStatus($id,$delFlag);
        return redirect('JobController/jobList');
    }

	/**
	 * This jobDetail methond are used to get the data from model for the specfic job details
	 * @return to view screen with data [ job/detail ]
	 * @author Kulasekaran.
	 *
	 */
	// public function jobDetail() {
	// 	$hiddenJobId = $this->input->post('hiddenJobId');
	// 	if($this->session->flashdata('hiddenJobId')){
	// 		$hiddenJobId = $this->session->flashdata('hiddenJobId');
	// 	}
	// 	$data['jobDetail'] = $this->JobModel->jobDetail($hiddenJobId);

	// 	$this->layouts->view('admin/job/detail',$data);
	// }

	/**
	 * This jobEdit methond are used to get the data from model for the specfic job detail for edit process
	 * @return to view screen with data [ job/addEdit ]
	 * @author Kulasekaran.
	 *
	 */
	// public function jobEdit() {
	// 	$data['maxAgeArray'] = $this->maxAgeArray;
	// 	$data['jobEdit'] = $this->JobModel->jobEdit();
	// 	$data['jobCategoryArray'] = $this->CommonModel->designation();
	// 	$data['requiredSkillArray'] = $this->CommonModel->skill();
	// 	$data['roleArray'] = $this->CommonModel->role();
	// 	$data['minQualificationArray'] = $this->CommonModel->minQualification();
	// 	$data['jobLocationArray'] = $this->CommonModel->country();

	// 	$this->layouts->view('admin/job/addEdit',$data);
	// }

	/**
	 * This profile methond are used to get the data form model for the specfic user (user whose login to website)
	 * @return to view screen [ profileDetail ]
	 * @author Kulasekaran.
	 *
	 */
	// public function jobEditForm() {
	// 	$jobUpdateStatus = $this->JobModel->jobUpdate();
	// 	if($jobUpdateStatus){
	// 		$this->session->set_flashdata([
	// 			'message'  => 'Job Details Updated Successfully',
	// 			'type' => 'success',
	// 			'hiddenJobId' => $this->input->post('hiddenJobId')
	// 		]);
	// 	} else {
	// 		$this->session->set_flashdata([
	// 			'message'  => 'Sorry, Something Went Wrong. Please Try Again Later',
	// 			'type' => 'danger'
	// 		]);
	// 	}
	// 	redirect('JobController/jobDetail');
	// }
}
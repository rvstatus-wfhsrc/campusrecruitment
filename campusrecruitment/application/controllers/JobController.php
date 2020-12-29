<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Job Controller
 *
 * This Controller are used to perform the company job details related process
 * 
 * @author kulasekaran.
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
	 * @author kulasekaran.
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('JobModel');
		$this->load->model('CommonModel');
	}

	/**
	 * This jobList method are used to get the data from model for the specfic company (company whose login to website)
	 * @return to view screen [ company/job/list ]
	 * @author kulasekaran.
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
		$pagination_config = $this->CommonModel->paginationConfig($totalRecord,base_url()."JobController/jobList");
		$this->pagination->initialize($pagination_config);
		$page = (($this->input->post('per_page') != null)) ? $this->input->post('per_page') : 0;
		$data["serialNumber"] = $page;

		$data["links"] = $this->pagination->create_links();
		$data['jobList'] = $this->JobModel->jobList($pagination_config["per_page"], $page);
		
		$this->layouts->view('company/job/list',$data);
	}


	/**
	 * This jobAdd method are used for goto the job add screen
	 * @return to view screen [ add ]
	 * @author kulasekaran.
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
	 * @author kulasekaran.
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
	 * @return the redirect to JobController/jobList
	 * @author kulasekaran.
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
	 * @return to view screen with data [ company/job/detail ]
	 * @author kulasekaran.
	 *
	 */
	public function jobDetail() {
		if($this->session->flashdata('hiddenJobId') == null && $this->input->post('hiddenJobId') == null) {
			redirect('JobController/jobList');
		}
		$hiddenJobId = $this->input->post('hiddenJobId');
		if($this->session->flashdata('hiddenJobId')){
			$hiddenJobId = $this->session->flashdata('hiddenJobId');
		}
		$data['jobDetail'] = $this->JobModel->jobDetail($hiddenJobId);

		$this->layouts->view('company/job/detail',$data);
	}

	/**
	 * This jobEdit method are used to get the data from model for the specfic job detail for edit process
	 * @return to view screen with data [ company/job/addEdit ]
	 * @author kulasekaran.
	 *
	 */
	public function jobEdit() {
		if($this->input->post('hiddenJobId') == null) {
			redirect('JobController/jobList');
		}
		$data['maxAgeArray'] = $this->maxAgeArray;
		$data['jobEdit'] = $this->JobModel->jobEdit();
		$data['jobCategoryArray'] = $this->CommonModel->designation();
		$data['requiredSkillArray'] = $this->CommonModel->skill();
		$data['roleArray'] = $this->CommonModel->role();
		$data['minQualificationArray'] = $this->CommonModel->minQualification();
		$data['jobLocationArray'] = $this->CommonModel->country();

		$this->layouts->view('company/job/addEdit',$data);
	}

	/**
	 * This jobEditForm method are used to update the specific job data into database
	 * @return redirects to JobController/jobDetail
	 * @author kulasekaran.
	 *
	 */
	public function jobEditForm() {
		$jobUpdateStatus = $this->JobModel->jobUpdate();
		if($jobUpdateStatus){
			$this->session->set_flashdata([
				'message'  => 'Job Details Updated Successfully',
				'type' => 'success',
				'hiddenJobId' => $this->input->post('hiddenJobId')
			]);
		} else {
			$this->session->set_flashdata([
				'message'  => 'Sorry, Something Went Wrong. Please Try Again Later',
				'type' => 'danger'
			]);
		}
		redirect('JobController/jobDetail');
	}

	/**
	 * This jobLists method are used to get the data from model for the all company jobs
	 * @return to view screen [ company/job/list ]
	 * @author kulasekaran.
	 *
	 */
	public function jobLists() {

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
		$pagination_config = $this->CommonModel->paginationConfig($totalRecord,base_url()."JobController/jobLists");
		$this->pagination->initialize($pagination_config);
		$page = (($this->input->post('per_page') != null)) ? $this->input->post('per_page') : 0;
		$data["serialNumber"] = $page;

		$data["links"] = $this->pagination->create_links();
		$data['jobList'] = $this->JobModel->jobLists($pagination_config["per_page"], $page);
		
		$this->layouts->view('company/job/list',$data);
	}

	/**
	 * This jobApplyHistory method are used to get the data from model for the applied jobs by specfic job seeker
	 * @return to view screen [ company/job/applyHistory ]
	 * @author kulasekaran.
	 *
	 */
	public function jobApplyHistory() {
		// filter process
		$filterVal = $this->input->post('filterVal');
		$data['disableAll'] = "";
		$data['disableApplied'] = "";
		$data['disableCancelled'] = "";
		if ($filterVal == 2) {
			$data['disableApplied'] = "disabled";
		} elseif ($filterVal == 3) {
			$data['disableCancelled'] = "disabled";
		} else {
			$data['disableAll'] = "disabled";
		}

		// sorting process style
		$sortOptn = $this->input->post('sortOptn');
		$data['sortStyle'] = "sort_asc";
		if(isset($sortOptn) && $sortOptn == "ASC") {
			$data['sortStyle'] = "sort_asc";
		} elseif(isset($sortOptn) && $sortOptn == "DESC") {
			$data['sortStyle'] = "sort_desc";
		}
		$data['sortArray'] = array('1' => 'Company Name','2' => 'Job Category','3' => 'Apply Date');

		// pagination process
		$totalRecord = $this->JobModel->record_count_for_job_apply();
		$pagination_config = $this->CommonModel->paginationConfig($totalRecord,base_url()."JobController/jobApplyHistory");
		$this->pagination->initialize($pagination_config);
		$page = (($this->input->post('per_page') != null)) ? $this->input->post('per_page') : 0;
		$data["serialNumber"] = $page;

		$data["links"] = $this->pagination->create_links();
		$data['jobApplyHistory'] = $this->JobModel->jobApplyHistory($pagination_config["per_page"], $page);
		
		$this->layouts->view('company/job/applyHistory',$data);
	}

	/**
	 * This jobApply method are used to apply the job for specific job seeker
	 * @return the redirects to JobController/jobApplyHistory
	 * @author kulasekaran.
	 *
	 */
	public function jobApply() {
		$jobApplyStatus = $this->JobModel->jobApply();
		if($jobApplyStatus){
			$this->session->set_flashdata([
				'message'  => 'Job Applied Successfully',
				'type' => 'success'
			]);
		} else {
			$this->session->set_flashdata([
				'message'  => 'Sorry, Something Went Wrong. Please Try Again Later',
				'type' => 'danger'
			]);
		}
		redirect('JobController/jobApplyHistory');
	}

	/**
	 * This jobApplyCancelStatus method are used to cancel the applied job
	 * @return the redirect to JobController/jobApplyHistory
	 * @author kulasekaran.
	 *
	 */
    public function jobApplyCancelStatus() {
    	$id = $this->input->post('hiddenApplyJobId');
        $jobCancelStatus = $this->JobModel->jobApplyCancelStatus($id);
        return redirect('JobController/jobApplyHistory');
    }

    /**
	 * This jobApplyDetail method are used to get the data from model for the specfic applied job details
	 * @return to view screen [ company/job/applyDetail ]
	 * @author kulasekaran.
	 *
	 */
	public function jobApplyDetail() {
		if($this->input->post('hiddenApplyJobId') != null) {
			$hiddenApplyJobId = $this->input->post('hiddenApplyJobId');
        }elseif ($this->session->flashdata('hiddenApplyJobId')) {
        	$hiddenApplyJobId = $this->session->flashdata('hiddenApplyJobId');
        } else {
        	redirect('JobController/jobApplyHistory');
        }
		$data['jobApplyDetail'] = $this->JobModel->jobApplyDetail($hiddenApplyJobId);
		$this->layouts->view('company/job/applyDetail',$data);
	}

	/**
	 * This getJobAppliedDetail method are used for goto the job result add screen
	 * @return to view screen [ company/job/result/addEdit ]
	 * @author kulasekaran.
	 *
	 */
	public function getJobAppliedDetail() {
		$data['jobResultAdd'] = $this->JobModel->getJobAppliedDetail();
		$this->layouts->view('company/job/result/addEdit', $data);
	}

	/**
	 * This jobResultAddForm method are used for gets the data from form and insert into database
	 * @return the redirects to JobController/jobApplyDetail
	 * @author kulasekaran.
	 *
	 */
	public function jobResultAddForm() {
		$jobResultAddStatus = $this->JobModel->jobResultAddForm();
		if($jobResultAddStatus){
			$this->session->set_flashdata([
				'message'  => 'Job Result Details Add Successfully',
				'type' => 'success',
				'hiddenApplyJobId' => $this->input->post('hiddenApplyJobId')
			]);
		} else {
			$this->session->set_flashdata([
				'message'  => 'Sorry, Something Went Wrong. Please Try Again Later',
				'type' => 'danger'
			]);
		}
		redirect('JobController/jobResultHistory');
	}

	/**
	 * This jobResultAddEditFormValidation method are used to validate the given field data
	 * @return retrun a json value to js in job/result/addedit.js 
	 * @author kulasekaran.
	 *
	 */
	public function jobResultAddEditFormValidation() {
		if ($this->form_validation->run('jobResultAddEdit') == FALSE) {
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response); exit();
		} else {
			echo json_encode(true); exit();
		}
	}

	/**
	 * This jobResultHistory method are used to get the data from model for the result of applied jobs by specfic job seeker or for specific company
	 * @return to view screen [ company/job/result/history ]
	 * @author kulasekaran.
	 *
	 */
	public function jobResultHistory() {
		// filter process
		$filterVal = $this->input->post('filterVal');
		$data['disableAll'] = "";
		$data['disablePass'] = "";
		$data['disableFail'] = "";
		if ($filterVal == 2) {
			$data['disablePass'] = "disabled";
		} elseif ($filterVal == 3) {
			$data['disableFail'] = "disabled";
		} else {
			$data['disableAll'] = "disabled";
		}

		// sorting process style
		$sortOptn = $this->input->post('sortOptn');
		$data['sortStyle'] = "sort_asc";
		if(isset($sortOptn) && $sortOptn == "ASC") {
			$data['sortStyle'] = "sort_asc";
		} elseif(isset($sortOptn) && $sortOptn == "DESC") {
			$data['sortStyle'] = "sort_desc";
		}
		$data['sortArray'] = array('1' => 'Job Seeker Name','2' => 'Obtain Mark');

		// pagination process
		$totalRecord = $this->JobModel->record_count_for_job_result();
		$pagination_config = $this->CommonModel->paginationConfig($totalRecord,base_url()."JobController/jobApplyHistory");
		$this->pagination->initialize($pagination_config);
		$page = (($this->input->post('per_page') != null)) ? $this->input->post('per_page') : 0;
		$data["serialNumber"] = $page;

		$data["links"] = $this->pagination->create_links();
		$data['jobResultHistory'] = $this->JobModel->jobResultHistory($pagination_config["per_page"], $page);

		$this->layouts->view('company/job/result/history',$data);
	}

	/**
	 * This jobResultDetail method are used to get the data from model for the specfic job result details
	 * @return to view screen [ company/job/result/detail ]
	 * @author kulasekaran.
	 *
	 */
	public function jobResultDetail() {
		if($this->input->post('hiddenResultJobId') == null) {
        	redirect('JobController/jobResultHistory');
        }
        $hiddenResultJobId = $this->input->post('hiddenResultJobId');
		$data['jobResultDetail'] = $this->JobModel->jobResultDetail($hiddenResultJobId);
		$this->layouts->view('company/job/result/detail',$data);
	}

	/**
	 * This jobResultEdit method are used to get the data from model for the specfic job result details to edit
	 * @return to view screen [ company/job/result/addEdit ]
	 * @author kulasekaran.
	 *
	 */
	public function jobResultEdit() {
		if($this->input->post('hiddenResultJobId') == null) {
        	redirect('JobController/jobResultHistory');
        }
        $data['jobResultAdd'] = $this->JobModel->getJobAppliedDetail();
		$data['jobResultEdit'] = $this->JobModel->jobResultEdit();
		$this->layouts->view('company/job/result/addEdit',$data);
	}

	/**
	 * This jobResultEditForm method are used to update the specific job result data into database
	 * @return redirects to JobController/jobResultHistory
	 * @author kulasekaran.
	 *
	 */
	public function jobResultEditForm() {
		$jobResultUpdateStatus = $this->JobModel->jobResultUpdate();
		if($jobResultUpdateStatus){
			$this->session->set_flashdata([
				'message'  => 'Job Result Details Updated Successfully',
				'type' => 'success'
			]);
		} else {
			$this->session->set_flashdata([
				'message'  => 'Sorry, Something Went Wrong. Please Try Again Later',
				'type' => 'danger'
			]);
		}
		redirect('JobController/jobResultHistory');
	}
}
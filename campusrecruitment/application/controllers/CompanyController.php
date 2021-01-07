<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Company Controller
 *
 * This Controller are used to perform the companies related process
 * 
 * @author Kulasekaran.
 *
 */

class CompanyController extends CI_Controller {

	public $layout_view = 'layouts/default';
	/**
	 * Company Controller __construct
	 *
	 * This __construct are used to load the Layouts, url, session, CommonModel, form validation and CompanyModel
	 * 
	 * @author Kulasekaran.
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('CompanyModel');
		$this->load->model('CommonModel');
	}

	/**
	 * This companyHistory method are used to get the data from database for the all available company
	 * @return to view screen [ history ]
	 * @author Kulasekaran.
	 *
	 */
	public function companyHistory() {
		// filter disable process
		$data['hiddenSearch'] = $this->input->post('hiddenSearch');
		$filterVal = $this->input->post('filterVal');
		$sortOptn = $this->input->post('sortOptn');
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
        $data['sortArray'] = array('1' => 'Company Name','2' => 'Incharge','3' => 'Entry Date');
        // pagination process
		$totalRecord = $this->CompanyModel->record_count();
		$pagination_config = $this->CommonModel->paginationConfig($totalRecord,base_url()."CompanyController/companyHistory");
		$this->pagination->initialize($pagination_config);
		$page = (($this->input->post('per_page') != null)) ? $this->input->post('per_page') : 0;
		$data["serialNumber"] = $page;
		$data["links"] = $this->pagination->create_links();
		$data['companyHistory'] = $this->CompanyModel->companyHistory($pagination_config["per_page"], $page);
		$this->layouts->view('admin/company/history',$data);
	}

	/**
	 * This companyStatus method are used to change the delflag for the specfic company
	 * @return the redirect to controller [ companyHistory ]
	 * @author Kulasekaran.
	 *
	 */
    public function companyStatus() {
    	$id = $this->input->post('hiddenCompanyId');
    	$delFlag = $this->input->post('hiddenDelFlag');
        $companyStatus = $this->CompanyModel->companyStatus($id,$delFlag);
        return redirect('CompanyController/companyHistory');
    }

    /**
	 * This companyAdd method are used to call the company add screen
	 * @return to view [ addEdit ]
	 * @author Kulasekaran.
	 *
	 */
    public function companyAdd() {
        $this->layouts->view('admin/company/addEdit');
    }

    /**
	 * This companyFormValidation method are used to validate the company add and edit screens fields
	 * @return to js [ addEdit ]
	 * @author Kulasekaran.
	 *
	 */
    public function companyFormValidation() {
		// company field validation
		if ($this->form_validation->run('adminCompanyAddEdit') == FALSE) {
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response); exit();
		} else {
			echo json_encode(true); exit();
		}
	}

	/**
	 * This companyAddForm method are used to get data from form and pass it to model for the specfic company
	 * @return the redirect to method [ companyHistory ]
	 * @author Kulasekaran.
	 *
	 */
	public function companyAddForm() {
		$companyAddStatus = $this->CompanyModel->companyAdd();
		if($companyAddStatus == "1") { 
			$this->session->set_flashdata(array('message' => 'Company Successfully Registered','type' => 'success'));
			redirect('CompanyController/companyHistory');
		} else {
			$this->session->set_flashdata(array('message' => 'Sorry, Something Went Wrong. Please Try Again Later','type' => 'danger'));
			redirect('CompanyController/companyHistory');
		}
	}

	/**
	 * This companyDetail method are used to get the data from model for the specfic company
	 * @return to view screen [ detail ]
	 * @author kulasekaran.
	 *
	 */
	public function companyDetail() {
		$companyId = $this->input->post('hiddenCompanyId');
		$url = 'admin/company/detail';
		if ($this->session->flashdata('hiddenCompanyId')) {
		    $companyId = $this->session->flashdata('hiddenCompanyId');
		    $url = 'company/profile/detail';
		} elseif ($this->session->flashdata('hiddenAdminCompanyId')) {
			$companyId = $this->session->flashdata('hiddenAdminCompanyId');
			$url = 'admin/company/detail';
		} elseif ($companyId == null) {
		    $url = 'company/profile/detail';
		}
		$data['companyDetail'] = $this->CompanyModel->companyDetail($companyId);
		$this->layouts->view($url,$data);
	}

	/**
	 * This companyEdit method are used to get the data from model for the specfic company
	 * @return to view screen [ addEdit ]
	 * @author kulasekaran.
	 *
	 */
	public function companyEdit() {
		if($this->input->post('hiddenCompanyId') == null) {
            redirect('CompanyController/companyHistory');
        }
		$companyId = $this->input->post('hiddenCompanyId');
		$data['companyEdit'] = $this->CompanyModel->companyEdit($companyId);
		$this->layouts->view('admin/company/addEdit',$data);
	}

	/**
	 * This companyUpdate method are used to get the data from form and pass it to model for update process
	 * @return the redirect to method [ companyHistory ]
	 * @author kulasekaran.
	 *
	 */
	public function companyUpdate() {
		$companyUpdateStatus = $this->CompanyModel->companyUpdate();
		if($companyUpdateStatus == "1") {
	        $this->session->set_flashdata(array('message' => 'Company Details Updated Successfully','type' => 'success','hiddenAdminCompanyId' => $this->input->post('hiddenCompanyId')));
	       	redirect('CompanyController/companyDetail');
	    } else {
	        $this->session->set_flashdata(array('message' => 'Company Details Update Failed','type' => 'danger'));
	        redirect('CompanyController/companyDetail');
	    }
	}

	/**
	 * This companyProfileAdd method are used to call the company add a new screen
	 * @return to view [ addEdit ]
	 * @author Kulasekaran.
	 *
	 */
    public function companyProfileAdd() {
        $this->layouts->view('company/profile/addEdit');
    }

    public function companyProfileFormValidation() {
		if ($this->form_validation->run('companyAddEdit') == FALSE) {
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response); exit();
		} else {
			echo json_encode(true); exit();
		}
	}

	/**
	 * This companyProfileAddForm method are used to get data from form and pass it to model for the specfic company
	 * @return to view
	 * @author Kulasekaran.
	 *
	 */
	public function companyProfileAddForm() {
		$companyAddStatus = $this->CompanyModel->companyAdd();
		if($companyAddStatus == "1") { 
			$this->session->set_flashdata(array('message' => 'Company Successfully Registered','type' => 'success'));
			redirect('LoginController/companyLogin');
		} else {
			$this->session->set_flashdata(array('message' => 'Sorry, Something Went Wrong. Please Try Again Later','type' => 'danger'));
			redirect('LoginController/companyLogin');
		}
	}

	/**
	 * This companyProfileEdit method are used to get the data from model for the specfic company
	 * @return to view screen [ company/profile/addEdit ]
	 * @author kulasekaran.
	 *
	 */
	public function companyProfileEdit() {
		if($this->input->post('hiddenCompanyId') == null) {
            redirect('CompanyController/companyDetail');
        }
		$companyId = $this->input->post('hiddenCompanyId');
		$data['companyEdit'] = $this->CompanyModel->companyEdit($companyId);
		$this->layouts->view('company/profile/addEdit',$data);
	}

	/**
	 * This companyProfileUpdate method are used to get the data from form and pass it to model for update process
	 * @return the redirect to method [ companyHistory ]
	 * @author kulasekaran.
	 *
	 */
	public function companyProfileUpdate() {
		$companyUpdateStatus = $this->CompanyModel->companyUpdate();
		if($companyUpdateStatus == "1") {
	        $this->session->set_flashdata(array('message' => 'Company Details Updated Successfully','type' => 'success','hiddenCompanyId' => $this->input->post('hiddenCompanyId')));
	       	redirect('CompanyController/companyDetail');
	    } else {
	        $this->session->set_flashdata(array('message' => 'Company Details Update Failed','type' => 'danger'));
	        redirect('CompanyController/companyDetail');
	    }
	}

}
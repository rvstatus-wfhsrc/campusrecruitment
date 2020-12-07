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
		$this->load->library('Layouts');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('CompanyModel');
		$this->load->model('CommonModel');
		$this->load->library('form_validation');
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
        $data['sortStyle'] = "sort_desc";
        if(isset($sortOptn) && $sortOptn == "ASC") {
            $data['sortStyle'] = "sort_asc";
        } elseif(isset($sortOptn) && $sortOptn == "DESC") {
            $data['sortStyle'] = "sort_desc";
        }
        $data['sortArray'] = array('1' => 'Company Name','2' => 'Incharge','3' => 'Entry Date');
		$data['companyHistory'] = $this->CompanyModel->companyHistory();
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
		$id = $this->session->userdata('id');
		$this->form_validation->set_rules( 'companyName', $this->lang->line("lbl_companyName"), 'required|regex_match[/^[A-Za-z\s\.]+$/]|max_length[50]',
												array(
													'required' => $this->lang->line("required"),
													'regex_match' => $this->lang->line("alphabetic"),
													'max_length' => $this->lang->line("max_length")
												)
											);
		$this->form_validation->set_rules( 'incharge', $this->lang->line("lbl_incharge"), 'required|regex_match[/^[A-Za-z\s\.]+$/]|max_length[50]',
												array(
													'required' => $this->lang->line("required"),
													'regex_match' => $this->lang->line("alphabetic"),
													'max_length' => $this->lang->line("max_length")
												)
											);
		$this->form_validation->set_rules( 'address', $this->lang->line("lbl_address"), 'required',
												array(
													'required' => $this->lang->line("required")
												)
											);
		$this->form_validation->set_rules( 'contact', $this->lang->line("lbl_contact"), 'required|regex_match[/\b\d{10}\b/]',
												array(
													'required' => $this->lang->line("required"),
													'regex_match' => $this->lang->line("contact_digit")
												)
											);
		$this->form_validation->set_rules( 'email', $this->lang->line("lbl_email"), 'required|valid_email|max_length[50]|callback_email_exist_check[company.email.'.$this->input->post('hiddenCompanyId').']',
												array(
													'required' => $this->lang->line("required"),
													'valid_email' => $this->lang->line("valid_email"),
													'max_length' => $this->lang->line("max_length")
												)
											);
		$this->form_validation->set_rules( 'website', $this->lang->line("lbl_website"), 'required|max_length[50]|callback_valid_url['.$this->input->post('website').']',
												array(
													'required' => $this->lang->line("required"),
													'max_length' => $this->lang->line("max_length")
												)
											);
		$this->form_validation->set_rules( 'entryDate', $this->lang->line("lbl_entryDate"), 'required|callback_before_tomorrow['.$this->input->post('entryDate').']',
												array(
													'required' => $this->lang->line("required")
												)
											);
		if($this->form_validation->run() == FALSE) {
            $json_response = $this->form_validation->error_array();
            echo json_encode($json_response); exit();

        } else {
           echo json_encode(true); exit();

        }
	}

	/**
	 * This email_exist_check method are used to validate the email for already exist or not
	 * @return true or false to companyFormValidation method
	 * @author Kulasekaran.
	 *
	 */
	function email_exist_check($str, $fields) {
		list($table, $columnOne, $strTwo) = explode('.', $fields, 3); 
		$query = $this->db->query("SELECT COUNT(id) AS count FROM $table WHERE ".$columnOne." = '".$str."' AND id != '".$strTwo."'");
		$row = $query->row();
		$this->form_validation->set_message('email_exist_check', $this->lang->line("exist_email"));
		return ($row->count > 0) ? FALSE : TRUE;
	}

	/**
	 * This companyAddForm method are used to get data from form and pass it to model for the specfic company
	 * @return the redirect to method [ companyHistory ]
	 * @author Kulasekaran.
	 *
	 */
	public function companyAddForm() {
		//create company userName...
        $label = 'CY';
        $query = $this->db->query("SELECT userName FROM company WHERE userName LIKE 'CY%' ORDER BY id DESC");
        $lastCompanyInArray = $query->result_array();
        $lastCompanyUserName = $lastCompanyInArray[0];
        $lastCompanyID = $lastCompanyUserName['userName'];
        $companyCount = 1;
	    if (isset($lastCompanyID) && $lastCompanyID != "") {
	        $companyCount = substr($lastCompanyID, -4);
	       	$companyCount = $companyCount + 1;
	    }
	    $padCount = str_pad($companyCount, 4, '0', STR_PAD_LEFT);
	    $companyUserName = $label.$padCount;
		$companyAddStatus = $this->CompanyModel->companyAdd($companyUserName);
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
		$id = $this->input->post('hiddenCompanyId');
		if ($id != null) {
			$companydata = array('companyId' => $id);
		    $this->session->set_userdata($companydata);
		}
		$companyId = $this->session->userdata('companyId');
		$data['companyDetail'] = $this->CompanyModel->companyDetail($companyId);
		$this->layouts->view('admin/company/detail',$data);
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
		$userName = $this->session->userdata('userName');
		$companyId = $this->input->post('hiddenCompanyId');
		$companyUpdateData = array(
			'companyName' => $this->input->post('companyName'),
			'incharge' => $this->input->post('incharge'),
			'address' => $this->input->post('address'),
			'contact' => $this->input->post('contact'),
			'email' => $this->input->post('email'),
			'website' => $this->input->post('website'),
			'password' => md5('company'),
			'entryDate' => $this->input->post('entryDate'),
			'updated_by' => $userName
		);
		$companyUpdateStatus = $this->CompanyModel->companyUpdate($companyId,$companyUpdateData);
		if($companyUpdateStatus == "1") {
	        $this->session->set_flashdata(array('message' => 'Company Details Updated Successfully','type' => 'success'));
	       	redirect('CompanyController/companyDetail');
	    } else {
	        $this->session->set_flashdata(array('message' => 'Company Details Update Failed','type' => 'danger'));
	        redirect('CompanyController/companyDetail');
	    }
	}

	/**
	 * This before_tomorrow method are used to validate the entry date is before tomorrow or not
	 * @return true or false to companyFormValidation method
	 * @author kulasekaran.
	 *
	 */
	function before_tomorrow($entryDate) {
		$currentDate = date('Y-m-d');
		$this->form_validation->set_message('before_tomorrow', $this->lang->line("before_tomorrow"));
		return ($currentDate < $entryDate) ? FALSE : TRUE;
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
		//create company userName...
        $label = 'CY';
        $userName = $this->CompanyModel->lastCompanyUserName();
        $lastCompanyInArray = $userName->result_array();
        $lastCompanyUserName = $lastCompanyInArray[0];
        $lastCompanyID = $lastCompanyUserName['userName'];
        $companyCount = 1;
	    if (isset($lastCompanyID) && $lastCompanyID != "") {
	        $companyCount = substr($lastCompanyID, -4);
	       	$companyCount = $companyCount + 1;
	    }
	    $padCount = str_pad($companyCount, 4, '0', STR_PAD_LEFT);
	    $companyUserName = $label.$padCount;
		$companyAddStatus = $this->CompanyModel->companyAdd($companyUserName);
		print_r($companyAddStatus);exit();
		if($companyAddStatus == "1") { 
			$this->session->set_flashdata(array('message' => 'Company Successfully Registered','type' => 'success'));
			redirect('CompanyController/companyHistory');
		} else {
			$this->session->set_flashdata(array('message' => 'Sorry, Something Went Wrong. Please Try Again Later','type' => 'danger'));
			redirect('CompanyController/companyHistory');
		}
	}

	/**
	 * This valid_url method are used to get data from form and pass it to model for the specfic company
	 * @return to view
	 * @author Kulasekaran.
	 *
	 */
	function valid_url($str) {

           $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
           $this->form_validation->set_message('valid_url', "Invalid website");
            if (!preg_match($pattern, $str))
            {
                return FALSE;
            }

            return TRUE;
    }
}
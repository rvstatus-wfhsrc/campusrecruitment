<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Company Controller
 *
 * This Controller are used to perform the companies related process
 * 
 * @author Ragav.
 *
 */

class CompanyController extends CI_Controller {

	public $layout_view = 'layouts/default';
	/**
	 * Company Controller __construct
	 *
	 * This __construct are used to load the Layouts, url, session and CompanyModel
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
	 * This companyHistory method are used to get the data form model for the specfic user (user whose login to website)
	 * @return to view screen [ detail ]
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
	 * @redirect to controller [ companyHistory ]
	 * @author Kulasekaran.
	 *
	 */
    public function companyStatus()
    {
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
    public function companyAdd()
    {
        // $designationArray = CommonModel::designation();
        // $countryArray = CommonModel::country();
        // $stateArray = array();
        // $cityArray = array();
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
													'regex_match' => 'Please enter only alphabetical letter.',
													'max_length' => $this->lang->line("max_length")
												)
											);
		$this->form_validation->set_rules( 'incharge', $this->lang->line("lbl_incharge"), 'required|regex_match[/^[A-Za-z\s\.]+$/]|max_length[50]',
												array(
													'required' => $this->lang->line("required"),
													'regex_match' => 'Please enter only alphabetical letter.',
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
													'regex_match' => 'The Contact must be 10 digits.'
												)
											);
		$this->form_validation->set_rules( 'email', $this->lang->line("lbl_email"), 'required|valid_email|max_length[50]|callback_email_exist_check[company.email.'.$this->session->userdata('userName').']',
												array(
													'required' => $this->lang->line("required"),
													'valid_email' => $this->lang->line("valid_email"),
													'max_length' => $this->lang->line("max_length")
												)
											);
		$this->form_validation->set_rules( 'website', $this->lang->line("lbl_website"), 'required|max_length[50]',
												array(
													'required' => $this->lang->line("required"),
													'max_length' => $this->lang->line("max_length")
												)
											);
		if ($this->form_validation->run() == FALSE){
            $json_response = $this->form_validation->error_array();
            echo json_encode($json_response); exit();

        }else{
           echo json_encode(true); exit();

        }
	}

	function email_exist_check($str, $fields)
	{
		list($table, $columnOne, $strTwo) = explode('.', $fields, 3); 
		$query = $this->db->query("SELECT COUNT(id) AS count FROM $table WHERE ".$columnOne." = '".$str."' AND userName != '".$strTwo."'");
		$row = $query->row();
		$this->form_validation->set_message('email_exist_check', 'The E-Mail Address already exists.');
		return ($row->count > 0) ? FALSE : TRUE;
	}

	// To add the company details
	public function companyAddForm() {
			$userName = $this->session->userdata('userName');
			//create company userName...
        	$label = 'CY';
        	$query = $this->db->query("SELECT userName FROM company WHERE userName LIKE 'CY%' ORDER BY id DESC");
        	$lastCompanyInArray = $query->result_array();
        	$lastCompanyUserName = $lastCompanyInArray[0];
        	$lastCompanyID = $lastCompanyUserName['userName'];
        	$companyCount = 1;
	        if (isset($lastCompanyID) && $lastCompanyID != "") 
	        {
	            $companyCount = substr($lastCompanyID, -4);
	            $companyCount = $companyCount + 1;
	        }
	        $padCount = str_pad($companyCount, 4, '0', STR_PAD_LEFT);
	        $companyUserName = $label.$padCount;
			$companyAddData = array(
				'companyName' => $this->input->post('companyName'),
				'incharge' => $this->input->post('incharge'),
				'address' => $this->input->post('address'),
				'contact' => $this->input->post('contact'),
				'email' => $this->input->post('email'),
				'website' => $this->input->post('website'),
				'userName' => $companyUserName,
				'password' => md5('company'),
				'created_by' => $userName
			);
			$companyAddStatus = $this->CompanyModel->companyAdd($userName,$companyAddData);
			redirect('CompanyController/companyHistory');
	}

}
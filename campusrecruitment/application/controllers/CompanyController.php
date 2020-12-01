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
}
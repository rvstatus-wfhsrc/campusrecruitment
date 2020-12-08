<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Company Model
 *
 * This Model are used to perform the companies related database process
 * 
 * @author Kulasekaran.
 *
 */
class CompanyModel extends CI_Model {

	/**
	 * Company Model __construct
	 *
	 * This __construct are used to load the session and database
	 * 
	 * @author Kulasekaran.
	 *
	 */
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	/**
	 * This companyHistory method are used to retrieves the company data for the all company
	 * @return the company history array
	 * @author Kulasekaran.
	 *
	 */
	function companyHistory() {
		$filterVal = $this->input->post('filterVal');
		$hiddenSearch = $this->input->post('hiddenSearch');
		$this->db->select('id,companyName,incharge,contact,email,entryDate,address,delFlag');
		// search process
		$this->db->like('companyName',trim($hiddenSearch));
		// sorting process
		$sortOptn = $this->input->post('sortOptn');
		$sortVal = $this->input->post('sortVal');
		if ($sortVal == 1) {
			$this->db->order_by('companyName', $sortOptn);
		} else if ($sortVal == 2) {
			$this->db->order_by('incharge', $sortOptn);
		} else if ($sortVal == 3) {
			$this->db->order_by('entryDate', $sortOptn);
		} else {
			$this->db->order_by('companyName', 'ASC');
		}
		// filter process
		if ($filterVal == 2) {
            $this->db->where(array('delFlag' => 0));
		} elseif ($filterVal == 3) {
            $this->db->where(array('delFlag' => 1));
        }
		$companyHistory = $this->db->get('company');
		return $companyHistory->result();
	}

	/**
	 * This companyStatus method are used to turns active or inactive for the specfic company
	 * @return the company status
	 * @author Kulasekaran.
	 *
	 */
	function companyStatus($id,$delFlag) {
		$userName = $this->session->userdata('userName');
		// $delFlag => 0 ----> change delFlag = 1
		// $delFlag => 1 ----> change delFlag = 0
		if ($delFlag == 0) {
			$this->db->where('id', $id);
			$companyStatus = $this->db->update('company', array('delFlag' => 1,'updated_by' => $userName ));
		} else {
			$this->db->where('id', $id);
			$companyStatus = $this->db->update('company', array('delFlag' => 0,'updated_by' => $userName ));
		}
		return $companyStatus;	
	}

	/**
	 * This companyAdd method are used to insert company data for a new company
	 * @return the status of company add
	 * @author Kulasekaran.
	 *
	 */
	function companyAdd($lastAddCompanyUser) {
		//create company userName...
        $label = 'CY';
        $lastCompanyInArray = $lastAddCompanyUser->result_array();
        $lastCompanyUserName = $lastCompanyInArray[0];
        $lastCompanyID = $lastCompanyUserName['userName'];
        $companyCount = 1;
	    if (isset($lastCompanyID) && $lastCompanyID != "") {
	        $companyCount = substr($lastCompanyID, -4);
	       	$companyCount = $companyCount + 1;
	    }
	    $padCount = str_pad($companyCount, 4, '0', STR_PAD_LEFT);
	    $companyUserName = $label.$padCount;
		$userName = $this->session->userdata('userName');
		$companyAddData = array(
			'companyName' => $this->input->post('companyName'),
			'incharge' => $this->input->post('incharge'),
			'address' => $this->input->post('address'),
			'contact' => $this->input->post('contact'),
			'email' => $this->input->post('email'),
			'website' => $this->input->post('website'),
			'userName' => $companyUserName,
			'password' => md5('company'),
			'entryDate' => $this->input->post('entryDate'),
			'created_by' => $userName
		);
		$companyData = array();
		if ($this->session->userdata('flag') != 1) {
			$companyData = array(
				'password' => md5($this->input->post('password')),
				'created_by' => $companyUserName
			);
		}
		$companyAddMergeData = array_merge($companyAddData, $companyData);
		$companyAddStatus = $this->db->insert('company', $companyAddMergeData);
		return $companyAddStatus;
	}

	/**
	 * This companyProfileAdd method are used to insert company data for a new company
	 * @return the status of company add
	 * @author Kulasekaran.
	 *
	 */
	function companyProfileAdd($companyAddData) {
		$companyAddStatus = $this->db->insert('company', $companyAddData);
		return $companyAddStatus;
	}

	/**
	 * This companyDetail method are used to retrieve the company details for the specfic company
	 * @return the company detail array
	 * @author Kulasekaran.
	 *
	 */
	function companyDetail($companyId) {
		$this->db->select('id,companyName,incharge,contact,email,entryDate,address,website,userName,delFlag');
		if ($this->input->post('hiddenCompanyId') == null) {
			$this->db->where(array('userName' => $companyId));
		} else {
			$this->db->where(array('id' => $companyId));
		}
		$companyDetail = $this->db->get('company');
		return $companyDetail->result()[0];
	}

	/**
	 * This companyEdit method are used to retrieve the company details for the specfic company to edit
	 * @return the company edit detail array
	 * @author Kulasekaran.
	 *
	 */
	function companyEdit($companyId) {
		$this->db->select('id,companyName,incharge,contact,email,entryDate,address,website,delFlag');
		$this->db->where(array('id' => $companyId));
		$companyEdit = $this->db->get('company');
		return $companyEdit->result()[0];
	}

	/**
	 * This companyUpdate method are used to update the company details into database for the specfic company
	 * @return the status of company update
	 * @author Kulasekaran.
	 *
	 */
	function companyUpdate($companyId,$companyUpdateData) {
		$this->db->where('id', $companyId);
		$updateCompany = $this->db->update('company', $companyUpdateData);
		return $updateCompany;
	}

	/**
	 * This lastCompanyUserName method are used to get the userName of last added company
	 * @return the username to companyController
	 * @author Kulasekaran.
	 *
	 */
	function lastCompanyUserName() {
		$lastUserName = $this->db->query("SELECT userName FROM company WHERE userName LIKE 'CY%' ORDER BY id DESC");
		return $lastUserName;
	}
}
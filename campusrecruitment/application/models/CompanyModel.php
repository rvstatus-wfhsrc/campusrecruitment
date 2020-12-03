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
	 * This companyStatus method are used to turns the company active or inactive for the specfic company
	 * @return the company status
	 * @author Kulasekaran.
	 *
	 */
	function companyStatus($id,$delFlag)
	{
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
	 * @return the status of query execution
	 * @author Kulasekaran.
	 *
	 */
	function companyAdd($userName,$companyAddData) {
		$this->db->where('userName', $userName);
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
		$this->db->where(array('id' => $companyId));
		$companyDetail = $this->db->get('company');
		return $companyDetail->result()[0];
	}
}
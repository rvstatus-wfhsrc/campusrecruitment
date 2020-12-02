<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyModel extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	// retrieves company history
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

	// inserts the company details
	function companyAdd($userName,$companyAddData) {
		$this->db->where('userName', $userName);
		$companyAddStatus = $this->db->insert('company', $companyAddData);
		return $companyAddStatus;
	}
}
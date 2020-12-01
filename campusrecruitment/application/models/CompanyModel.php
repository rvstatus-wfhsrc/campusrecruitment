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
		$this->db->select('id,companyName,incharge,contact,email,delFlag');
		// search process
		$this->db->like('companyName',trim($hiddenSearch));
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
}
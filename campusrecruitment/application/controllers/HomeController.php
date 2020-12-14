<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home Controller
 *
 * This Controller are used to perform the job list display and search job as per user process
 * 
 * @author Ragav.
 *
 */
class HomeController extends CI_Controller {

	public $layout_view = 'layouts/default';

	/**
	 * Home Controller __construct
	 *
	 * This __construct are used to load the HomeModel and CommonModel
	 * 
	 * @author Ragav.
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('HomeModel');
		$this->load->model('CommonModel');
	}

	/**
	 * This index methond are used to get the data from model to view screen
	 * @return to view screen [ home/index ]
	 * @author Ragav.
	 *
	 */

	public function index() {
		$data['jobCategoryArray'] = $this->CommonModel->designation();

		// pagination process
		$totalRecord = $this->HomeModel->record_count();
		$pagination_config = $this->CommonModel->paginationConfig($totalRecord,base_url()."HomeController/index");
		$this->pagination->initialize($pagination_config);
		$page = (($this->input->post('per_page') != null)) ? $this->input->post('per_page') : 0;
		$data["serialNumber"] = $page;
		$data["totalRecord"] = $totalRecord;
		$data["links"] = $this->pagination->create_links();
		$data['jobList'] = $this->HomeModel->jobList($pagination_config["per_page"], $page);
		
		$this->layouts->view('home/index', $data);
	}

	/**
	 * This siteLangUpdate methond is ajax call used to change the session for language type
	 * @return to view screen [ js/script.js ]
	 * @author Ragav.
	 *
	 */
	function siteLangUpdate() {
		$userData = [
			'siteLang'  => 'english',
			'siteLangKey'  => 1,
		];
		$siteLang = $this->input->post();
		if(isset($siteLang['siteLang']) && $siteLang['siteLang'] == 2){
			$userData = [
				'siteLang'  => 'japanese',
				'siteLangKey'  => $siteLang['siteLang'],
			];
		}
		$this->session->set_userdata($userData);
		$success = TRUE;
		echo json_encode($success);exit;
	}
}
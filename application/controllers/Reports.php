<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct()
	 { 
            parent::__construct();
            $this->load->helper('url'); 
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->helper('security');
  			$this->load->library('session');
  			$this->load->model('Mod_health');
			//$this->load->model('Mod_report');
     } 

	public function index()
	{
		$this->load->view('index');
	}

	public function home()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/nav');	
			$this->load->view('admin/home');		
			$this->load->view('admin/footer');	

		}

	public function vbd_report_lab_datewise()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/nav');
			$data['get_state']=$this->Mod_health->get_state();
			$this->load->view('reports/vbd_report_lab_datewise',$data);		
			$this->load->view('admin/footer');	

		}			
		
											 
}

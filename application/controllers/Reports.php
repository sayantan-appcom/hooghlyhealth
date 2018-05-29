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
  			//$this->load->model('Mod_health');
			$this->load->model('Mod_report');
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
			$data['get_state']=$this->Mod_report->get_state();
			$data['get_institute']=$this->Mod_report->get_institute();
			$this->load->view('reports/vbd_report_lab_datewise',$data);		
			$this->load->view('admin/footer');	

		}	
		
		//////////////Fetch Institution Name/////////////////
	public function get_institution_name()
		{
		     $inst_district = $this->input->post('inst_district');
			 $inst_subdivision = $this->input->post('inst_subdivision');
			 $inst_block = $this->input->post('inst_block');
			 $inst_type = $this->input->post('inst_type');
		     $data=$this->Mod_report->get_institution_name($inst_district,$inst_subdivision,$inst_block,$inst_type);
		     echo json_encode($data);

		}
//////////////////////////////////////fetch district subdivision and block name/////////////////////////////////////////
	public function getDistrict_reports()
		{
            $state = $this->input->post('state');
			$data=$this->Mod_report->getDistrict_reports($state);
			echo json_encode($data);
		}	
	public function getSubdivision_reports()
		{
            $district = $this->input->post('district');
			$data=$this->Mod_report->getSubdivision_reports($district);
			echo json_encode($data);
		}
		
	public function getBlockMuni_reports()
		{
            $subdivision = $this->input->post('subdivision');
			$data=$this->Mod_report->getBlockMuni_reports($subdivision);
			echo json_encode($data);
		}	
		
///////////////////////////////Date Wise Report Form-L////////////////////////////////////////////////
public function Date_wise_report_FORM_L()
{
  
 
  $start_date=$this->input->post('from_date');
  $end_date=$this->input->post('to_date');
  $state_code=$this->input->post('state_code');
  $district_code=$this->input->post('district_code');
  $block_muni=$this->input->post('block_muni');
  $inst_name=$this->input->post('inst_name');
  $data['institution_details']=$this->Mod_report->fetch_instituion_details($inst_name);
  $data['state_code']=$state_code;
 $data['fetch_all_disease_subcategory']=$this->Mod_report->fetch_all_disease_subcategory();
  $data['start_date']= $start_date;
  $data['end_date']= $end_date; 


  $this->load->view('reports/Date_wise_report_FORM_L',$data);
 
}
/////////////////////////////////fetch_positive_test///////////////////////////////////////////////
public function fetch_positive_test()
{
$disease_sub_id=$this->uri->segment(3);
$institution_code=$this->uri->segment(4);

$data['fetch_positive_test']=$this->Mod_report->fetch_positive_test($disease_sub_id,$institution_code);
 $this->load->view('reports/fetch_positive_case_report',$data);


}	
		
											 
}

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
			  $inst_type=$this->input->post('inst_type');
			  $data['institution_details']=$this->Mod_report->fetch_instituion_details($inst_name);
			  $data['state_code']=$state_code;
			  //$data['fetch_all_disease_subcategory']=$this->Mod_report->fetch_all_disease_subcategory($inst_type);
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
		$start_date=$this->uri->segment(5);
		$end_date=$this->uri->segment(6);
		$data['fetch_positive_test']=$this->Mod_report->fetch_positive_test($disease_sub_id,$institution_code,$start_date,$end_date);
	    $this->load->view('reports/fetch_positive_case_report',$data);


}
////////////////////////////VBD report for other disease//////////////////////////////
	public function vbd_report_other_datewise()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/nav');
			$data['get_state']=$this->Mod_report->get_state();
			$data['get_institute']=$this->Mod_report->get_institute();
			$this->load->view('reports/vbd_report_other_datewise',$data);		
			$this->load->view('admin/footer');	

		}
		
		
///////////////////////////////Date Wise Report Form-P////////////////////////////////////////////////
public function Date_wise_report_FORM_P()
{
 
		  $start_date=$this->input->post('from_date');
		  $end_date=$this->input->post('to_date');
		  $state_code=$this->input->post('state_code');
		  $district_code=$this->input->post('district_code');
		  $block_muni=$this->input->post('block_muni');
		  $inst_name=$this->input->post('inst_name');
		  $inst_type=$this->input->post('inst_type');
		  $data['institution_details']=$this->Mod_report->fetch_instituion_details($inst_name);
		  $data['state_code']=$state_code;
		  $data['fetch_all_disease_admission']=$this->Mod_report->fetch_all_disease_admission();
		 
		  $data['start_date']= $start_date;
		  $data['end_date']= $end_date; 
		  $this->load->view('reports/Date_wise_report_FORM_P',$data);
 
}	
//////////////////////////////////  fetch_admission_patient_details////////////////////////////////////
public function fetch_admission_patient_details()
{
			$disease_syndrome_id=$this->uri->segment(3);
			$institution_code=$this->uri->segment(4);
			$data['fetch_admission_patient_details']=$this->Mod_report->fetch_admission_patient_details($disease_syndrome_id,$institution_code);
			$this->load->view('reports/fetch_admission_patient_details',$data);


}
////////////////////////vbd report category wise//////////////////////////////////////////
	public function vbd_report_category_wise()
		{
				$this->load->view('admin/header');
				$this->load->view('admin/nav');
				$data['get_state']=$this->Mod_report->get_state();
				$data['get_disease_category']=$this->Mod_report->get_disease_category();
				$data['get_institute']=$this->Mod_report->get_institute();
				$this->load->view('reports/vbd_report_category_wise',$data);		
				$this->load->view('admin/footer');	

		}
		
////////////////////////////////////// fetch_vbd_report_category_wise/////////////////////////////////////
 public function fetch_vbd_report_category_wise()
 {
 	
			$category_id=$this->input->post('category_name');
			$block_muni=$this->input->post('block_muni');
			$data['fetch_block_muni']=$this->Mod_report->fetch_block_muni($block_muni);
			$data['fetch_subcategory_name']=$this->Mod_report->fetch_subcategory_name($category_id);
			$this->load->view('reports/fetch_vbd_report_category_wise',$data);	
		 
 
 }	
 
 ////////////////////////vbd report sub category wise//////////////////////////////////////////
	public function vbd_report_subcategory_wise()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/nav');
			$data['get_state']=$this->Mod_report->get_state();
			$data['get_disease_category']=$this->Mod_report->get_disease_category();
			$data['get_institute']=$this->Mod_report->get_institute();
			$this->load->view('reports/vbd_report_sub_category_wise',$data);		
			$this->load->view('admin/footer');	

		}
		
///////////////////////////////// fetch sub category////////////////////////////////////////////
		
	public function getSubcategory_report()
	{
            $category_id = $this->input->post('category_name');
			$data=$this->Mod_report->getsubdisease($category_id);
			echo json_encode($data);
	}			
 	
////////////////////////////////////// fetch_vbd_report_category_wise/////////////////////////////////////
 public function fetch_vbd_report_sub_category_wise()
 {
 	
			$sub_category_id=$this->input->post('sub_category_name');
			$block_muni=$this->input->post('block_muni');
			$data['fetch_block_muni']=$this->Mod_report->fetch_block_muni($block_muni);
			$data['gettestname']=$this->Mod_report->gettestname($sub_category_id);
			$data['fetch_sub_category_name']=$this->Mod_report->fetch_sub_category_positive_test($sub_category_id);
			$this->load->view('reports/fetch_vbd_report_sub_category_wise',$data);	
 
 
 }	
 
 ////////////////////////////////////// fetch_vbd_report_district_status_wise/////////////////////////////////////
 public function fetch_vbd_report_district_status_wise()
 {
            $this->load->view('admin/header');
			$this->load->view('admin/nav');
			$data['get_state']=$this->Mod_report->get_state();
			$data['get_disease_category']=$this->Mod_report->get_disease_category();
			$this->load->view('reports/vbd_status_report_district_wise',$data);		
			$this->load->view('admin/footer');		
 
 
 }
 public function fetch_vbd_report_district_wise()
 {
			 $district_code=$this->input->post('district_code');
			 $category_id=$this->input->post('category_name');
			 $data['category_name']=$category_id;
			 $data['fetch_subdivision']=$this->Mod_report->fetchsubdivision($district_code);
			 $data['fetch_subcategory_name']=$this->Mod_report->fetch_subcategory_name($category_id);
			 $this->load->view('reports/vbd_report_status_district_wise',$data);	
 }
 
 /////////////////////////////// fecth vbd report status blockwise/////////////////////////////////////////
  public function fetch_vbd_report_status_block_wise()
 {

		 $subdivision_code=$this->uri->segment(3);
		 $category_id=$this->uri->segment(4);
		 $data['category_id']=$category_id;
		 $data['fetch_block']=$this->Mod_report->fetchblock($subdivision_code);
		 $data['fetch_subcategory_name']=$this->Mod_report->fetch_subcategory_name($category_id);
 		 $this->load->view('reports/vbd_report_status_block_wise',$data);	
 }
 
 ////////////////////////////vbd report institution wise//////////////////////////////////////////////////
 	public function vbd_report_lab_wise()
		{
				$this->load->view('maincontents/header');
			    $this->load->view('maincontents/nav');
				$this->load->view('reports/vbd_report_lab_wise');		
				$this->load->view('maincontents/footer');	

		}
		
		
///////////////////////////////////////date wise vbd report form-l lab wise/////////////////////////////////
public function Date_wise_report_FORM_L_lab_wise()
{
  
 
			  $start_date=$this->input->post('from_date');
			  $end_date=$this->input->post('to_date');
			  $state_code=$this->input->post('state_code');
			  $inst_name=$this->input->post('user_id');
			  $data['institution_details']=$this->Mod_report->fetch_instituion_details($inst_name);
			  $data['state_code']=$state_code;
			  $data['fetch_all_disease_subcategory']=$this->Mod_report->fetch_all_disease_subcategory();
			  $data['start_date']= $start_date;
			  $data['end_date']= $end_date; 
			  $this->load->view('reports/Date_wise_report_FORM_L_lab_wise',$data);
 
}	

/////////////////////////////////////////// vbd_report_other_institute_wise///////////////////

	public function vbd_report_other_institute_wise()
		{
				$this->load->view('maincontents/header');
			    $this->load->view('maincontents/nav');
				$this->load->view('reports/vbd_report_other_institute_wise');		
				$this->load->view('maincontents/footer');		

		}	
		
		
		///////////////////////////////Date Wise Report Form-P////////////////////////////////////////////////
public function Date_wise_report_FORM_P_institute_wise()
{
 
		  $start_date=$this->input->post('from_date');
		  $end_date=$this->input->post('to_date');
		  $inst_name=$this->input->post('user_id');
		  $data['institution_details']=$this->Mod_report->fetch_instituion_details($inst_name);
		  $data['fetch_all_disease_admission']=$this->Mod_report->fetch_all_disease_admission();
		  $data['start_date']= $start_date;
		  $data['end_date']= $end_date; 
		  $this->load->view('reports/Date_wise_report_FORM_P_institute_wise',$data);
 
}

/////////////////////////////////////admission_patient_details////////////////////////////////////////////////
public function admission_patient_details()
{
 
	            $this->load->view('maincontents/header');
			    $this->load->view('maincontents/nav');
				$this->load->view('reports/admission_patient_details');		
				$this->load->view('maincontents/footer');
 
}	

////////////////////////////////////// fetch_vbd_report_status_institute_wise////////////////////////////////////
public function fetch_vbd_report_status_institute_wise()
{

          $blockminicd=$this->uri->segment(3);
		  $category_id=$this->uri->segment(4);
		 $data['category_id']=$category_id;
		 $data['fetch_institution_report']=$this->Mod_report->fetch_institution_report($blockminicd);
		 $data['fetch_subcategory_name']=$this->Mod_report->fetch_subcategory_name($category_id);
 		 $this->load->view('reports/fetch_vbd_report_status_institute_wise',$data);
}
											 
}

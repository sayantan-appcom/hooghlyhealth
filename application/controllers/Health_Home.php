<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Health_Home extends CI_Controller {

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
			$this->load->library('recaptcha');
			$this->load->library('form_validation');
			$this->load->helper('security');
  			$this->load->library('session');
			$this->load->model('Mod_health');
     } 

	public function index()
	{
		$this->load->view('index');
	}

	public function home()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');	
			$this->load->view('maincontents/home');		
			$this->load->view('maincontents/footer');	

		}

	public function test_data_next()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');	
			$this->load->view('maincontents/test_data_next');		
			$this->load->view('maincontents/footer');	

		}	

	public function entry_test_data()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');
			$data['get_disease']=$this->Mod_health->get_disease();	
			$this->load->view('maincontents/entry_test_data',$data);		
			$this->load->view('maincontents/footer');	

		}			

	public function entry_diagnosis_test()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');
			$user_id= $this->uri->segment(3);
			$data['test_date']=$this->Mod_health->test_date($user_id);	
			$data['get_disease']=$this->Mod_health->get_disease();
			$data['get_relation']=$this->Mod_health->get_relation();
			$this->load->view('maincontents/entry_diagnosis_test',$data);		
			$this->load->view('maincontents/footer');	

		}	
		
	public function getsubdisease()
		{
            $disease_category = $this->input->post('disease_category');
			$data=$this->Mod_health->getsubdisease($disease_category);
			echo json_encode($data);
		}

	public function get_registrationId()
		{
            $test_date = $this->input->post('test_date');
			$data=$this->Mod_health->get_registrationId($test_date);
			echo json_encode($data);
		}	

	public function gettestname()
		{
            $disease_sub_category = $this->input->post('disease_sub_category');
			$data=$this->Mod_health->gettestname($disease_sub_category);
			echo json_encode($data);
		}

	public function insert_test_data()
		{
			
			$this->form_validation->set_rules('user_id','Institution Name','trim|xss_clean');
			$this->form_validation->set_rules('test_date','Test Date','trim|required|xss_clean');
			$this->form_validation->set_rules('disease_code','Institution Name','trim|xss_clean');
			$this->form_validation->set_rules('disease_subcase_code','Institution Name','trim|xss_clean');
			$this->form_validation->set_rules('test_type_code','Institution Name','trim|xss_clean');
			$this->form_validation->set_rules('total_tested','Total sample case','trim|required|xss_clean');
			$this->form_validation->set_rules('positive_case','Positive case','trim|required|xss_clean');
			//$this->form_validation->set_rules('negative_case','Test Name','trim|required|xss_clean');
			

			if ($this->form_validation->run() == TRUE) 
				{	

					$institution_code = $this->input->post('user_id');
					$disease_code = $this->input->post('disease_code');
					$disease_subcase_code = $this->input->post('disease_subcase_code');
					$test_type_code = $this->input->post('test_type_code');
					$test_date = $this->input->post('test_date');
					$total_tested = $this->input->post('total_tested');
					$positive_case = $this->input->post('positive_case');
					//$negative_case = $this->input->post('negative_case'); 

					$result=$this->Mod_health->get_test_insert($institution_code,$test_date,$disease_code,$disease_subcase_code,$test_type_code,$total_tested,$positive_case/*,$negative_case*/);

						if ($result == TRUE)
			 				{
			 					$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$this->load->view('maincontents/test_data_next');		
								$this->load->view('maincontents/footer');										
							} 
						
					 }
						else
							{
								$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');	
								$this->load->view('maincontents/entry_test_data');		
								$this->load->view('maincontents/footer');
							} 
			
		}			

	
	public function insert_diagnosis_test()
		{
			
			$this->form_validation->set_rules('user_id','Institution Name','trim|xss_clean');
			$this->form_validation->set_rules('test_date','Test Date','trim|required|xss_clean');
			$this->form_validation->set_rules('disease_code','Disease Category','trim|required|xss_clean');
			$this->form_validation->set_rules('disease_subcase_code','Disease Sub Category','trim|required|xss_clean');
			$this->form_validation->set_rules('test_type_code','Test Name','trim|required|xss_clean');			
			$this->form_validation->set_rules('patient_name','Patient Name','trim|xss_clean|required|max_length[30]');
			$this->form_validation->set_rules('patient_gurdain_name','Patient Gurdain Name','trim|xss_clean|required|max_length[30]');
			$this->form_validation->set_rules('relation_gurdain','Relation With Gurdain','trim|xss_clean|required|max_length[15]');
			$this->form_validation->set_rules('paient_age','Patient Age','trim|required|xss_clean|max_length[3]');
			$this->form_validation->set_rules('patient_gender','Patient Gender','trim|required|xss_clean');
			$this->form_validation->set_rules('patient_district','Patient District','trim|required|xss_clean');
			$this->form_validation->set_rules('patient_village_town','Patient Villege / Town','trim|xss_clean|required|max_length[15]');
			$this->form_validation->set_rules('patient_pin','Patient PIN','trim|required|xss_clean|min_length[6]|max_length[6]');
			$this->form_validation->set_rules('patient_address','Patient Address','trim|required|xss_clean|max_length[100]');
			$this->form_validation->set_rules('patient_mobile','Patient Mobile','trim|xss_clean|integer|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('patient_phone_no','Patient Phone Number','trim|xss_clean|integer|min_length[8]|max_length[12]');
			$this->form_validation->set_rules('patient_email','Patient Email Id','trim|valid_email|xss_clean|max_length[50]');
			$this->form_validation->set_rules('patient_aadhar','Patient Aadhar Number','trim|xss_clean|integer|min_length[16]|max_length[16]');
			$this->form_validation->set_rules('patient_epic','Institution EPIC Number','trim|xss_clean|max_length[15]');
			

			if ($this->form_validation->run() == TRUE) 
				{					
					$date= date("Y");
					$max=$this->Mod_health->get_max_regisID();
					
					$institution_code = $this->input->post('user_id');
					$get_fulldetails=$this->Mod_health->get_fulldetails($institution_code);
					foreach ($get_fulldetails as $detail) {
						 $state_code = $detail['state_code'];
						 $district_code = $detail['district_code'];
						 $subdivision_code = $detail['subdivision_code'];
						 $block_code = $detail['block_code'];						
					}
					$test_date = $this->input->post('test_date');
					$disease_code = $this->input->post('disease_code');
					$disease_subcase_code = $this->input->post('disease_subcase_code');
					$test_type_code = $this->input->post('test_type_code');
					$patient_name = $this->input->post('patient_name');
					$patient_gurdain_name = $this->input->post('patient_gurdain_name');			
					$relation_gurdain = $this->input->post('relation_gurdain');
					$paient_age = $this->input->post('paient_age');
					$patient_gender = $this->input->post('patient_gender');
					$patient_district = $this->input->post('patient_district');
					$patient_village_town = $this->input->post('patient_village_town');
					$patient_pin = $this->input->post('patient_pin');
					$patient_address = $this->input->post('patient_address');
					$patient_mobile = $this->input->post('patient_mobile');
					$patient_phone_no = $this->input->post('patient_phone_no');
					$patient_email = $this->input->post('patient_email');
					$patient_aadhar = $this->input->post('patient_aadhar');
					$patient_epic = $this->input->post('patient_epic');
										
					$registration_id = $disease_code.$disease_subcase_code.$state_code.$block_code.$date.$max;

					$result=$this->Mod_health->get_diagnosis_insert($institution_code,$test_date,$disease_code,$disease_subcase_code,$test_type_code,$patient_name,$patient_gurdain_name,$relation_gurdain,$paient_age,$patient_gender,$patient_district,$patient_village_town,$patient_pin,$patient_address,$patient_mobile,$patient_phone_no,$patient_email,$patient_aadhar,$patient_epic,$registration_id);

						if ($result == TRUE)
			 				{	
			 					$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data = array(
					'success_message' => 'Registration successfullly! Please note Registration Id : '.$registration_id					
				);			
								
								//$data=$this->session->set_flashdata('response',"Registration Successfully ! Remember Registration ID :".$registration_id);
								$this->load->view('maincontents/test_data_next',$data);		
								$this->load->view('maincontents/footer');									
												
							} 
						
					 }
						else
							{
								$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');	
								//$data['get_disease']=$this->Mod_health->get_disease();
								//$this->load->view('maincontents/entry_diagnosis_test',$data);		
								$this->load->view('maincontents/footer');
							}	

									 
			
		}	

		
	public function entry_admission()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');
			$user_id= $this->uri->segment(3);
			$data['test_date']=$this->Mod_health->test_date($user_id);
			$this->load->view('maincontents/entry_admission',$data);		
			$this->load->view('maincontents/footer');	

		}

	public function entry_admission_next()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');
            $test_date = $this->input->post('test_date');
            $registration_id = $this->input->post('registration_id');
			$data['patient']=$this->Mod_health->entry_admission_next($test_date,$registration_id);
			$data['get_admission_ward']=$this->Mod_health->get_admission_ward();
			$data['patient_status']=$this->Mod_health->patient_status();						
   			$this->load->view('maincontents/entry_admission_next',$data);
   			$this->load->view('maincontents/footer');
  			
  				  
		}		


	public function insert_admission()
		{
			$this->form_validation->set_rules('doctor_name','Doctor Name','trim|required|xss_clean');
			
			if ($this->form_validation->run() == TRUE) 
				{					
					$registration_id = $this->input->post('registration_id');
					$institution_code = $this->input->post('user_id');
					$doctor_name = $this->input->post('doctor_name');
					$admission_date_time = $this->input->post('admission_date_time');
					$admission_ward = $this->input->post('admission_ward');
					$admission_block = $this->input->post('admission_block');
					$admission_floor = $this->input->post('admission_floor');
					$admission_bed_no = $this->input->post('admission_bed_no');
					$patient_status = $this->input->post('patient_status');
					$dischrg_date_time = $this->input->post('dischrg_date_time');
					$transfer_date_time = $this->input->post('transfer_date_time');
					$cause_of_transfer = $this->input->post('cause_of_transfer');
					$transfer_to_whom = $this->input->post('transfer_to_whom'); 
					$force_transfer_datetime = $this->input->post('force_transfer_datetime'); 
					$force_transfer_cause = $this->input->post('force_transfer_cause');
					$death_date_time = $this->input->post('death_date_time');			
					$cause_of_death = $this->input->post('cause_of_death');

					

					$result=$this->Mod_health->get_insert_admission($registration_id,$institution_code,$doctor_name,$admission_date_time,$admission_ward,$admission_block,$admission_floor,$admission_bed_no,$patient_status,$dischrg_date_time,$transfer_date_time,$cause_of_transfer,$transfer_to_whom,$force_transfer_datetime,$force_transfer_cause,$death_date_time,$cause_of_death);

						if ($result == TRUE)
			 				{										
								$this->session->set_flashdata('response',"Admission Details Saved Successfully !");				
							} 						
					
     		 }
						else
							{
								$this->session->set_flashdata('response',"Admission Details not  Saved Successfully !");
							}	

						$this->load->view('maincontents/header');
						$this->load->view('maincontents/nav');
						$this->load->view('maincontents/entry_admission');		
						$this->load->view('maincontents/footer');		 
			
		}

	public function getdisease()
		{
            $test_date = $this->input->post('test_date');
            $institution_code = $this->input->post('institution_code');
			$data=$this->Mod_health->getdisease($test_date,$institution_code);
			echo json_encode($data);
		}

	public function get_subdisease()
		{
            $disease_code = $this->input->post('disease_code');
            $test_date = $this->input->post('test_date');
            $institution_code = $this->input->post('institution_code');
			$data=$this->Mod_health->get_subdisease($test_date,$disease_code,$institution_code);
			echo json_encode($data);
		}

	public function get_test_name()
		{
            $disease_code = $this->input->post('disease_code');
            $disease_subcase_code = $this->input->post('disease_subcase_code');
            $test_date = $this->input->post('test_date');
            $institution_code = $this->input->post('institution_code');
			$data=$this->Mod_health->get_test_name($disease_subcase_code,$test_date,$disease_code,$institution_code);
			echo json_encode($data);
		}			
	
											 
}

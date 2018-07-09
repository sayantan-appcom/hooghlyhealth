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

	public function test_data_entry()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');	
			$data['get_disease']=$this->Mod_health->get_disease();	
			$this->load->view('maincontents/entry_test_data',$data);		
			$this->load->view('maincontents/footer');	

		}

	public function getsubdisease()
		{
            $disease_category = $this->input->post('disease_category');
			$data=$this->Mod_health->getsubdisease($disease_category);
			echo json_encode($data);
		}

	public function getsyndrome()
		{
            $disease_category = $this->input->post('disease_category');
			$data=$this->Mod_health->getsyndrome($disease_category);
			echo json_encode($data);
		}	
		
	public function patient_search()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');	
			$this->load->view('maincontents/patient_search');
			$this->load->view('maincontents/footer');	

		}
		
	public function patient_details()
		{
			 $patient_name=$this->input->post('patient_name');
			
			$patient_mobile=$this->input->post('patient_mobile');
			$data['patient_name']=$patient_name;
			$data['patient_mobile']=$patient_mobile;
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');	
			$data['get_disease']=$this->Mod_health->get_disease();
			$data['get_relation']=$this->Mod_health->get_relation();
			$this->load->view('maincontents/patient_test_details',$data);
			$this->load->view('maincontents/footer');	

		}	

	/*public function patient_details()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');	
			$data['get_disease']=$this->Mod_health->get_disease();
			$data['get_relation']=$this->Mod_health->get_relation();
			$this->load->view('maincontents/patient_test_details',$data);
			$this->load->view('maincontents/footer');	

		}*/

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
			$this->form_validation->set_rules('test_id','Institution Name','trim|xss_clean');
			$this->form_validation->set_rules('total_tested','Total sample case','trim|required|xss_clean');
			

			if ($this->form_validation->run() == TRUE) 
				{	

					$institution_code = $this->input->post('user_id');
					$disease_code = $this->input->post('disease_code');
					$disease_subcase_code = $this->input->post('disease_subcase_code');
					$test_id = $this->input->post('test_id');
					$test_date = $this->input->post('test_date');
					$total_tested = $this->input->post('total_tested'); 

					$result=$this->Mod_health->get_test_insert($institution_code,$test_date,$disease_code,$disease_subcase_code,$test_id,$total_tested);

						if ($result == TRUE)
			 				{
			 					$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data['get_disease']=$this->Mod_health->get_disease();
								$this->session->set_flashdata('test_suc_msg',"Test data saved successfullly !");
								$this->load->view('maincontents/entry_test_data',$data);
								$this->load->view('maincontents/footer');										
							} 
						
					 }
						else
							{
								$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data['get_disease']=$this->Mod_health->get_disease();
								$this->session->set_flashdata('test_suc_msg',"Test data not saved successfullly !");									
								$this->load->view('maincontents/entry_test_data',$data);
								$this->load->view('maincontents/footer');
							} 
			
		}

									
///////////////////////////////////Insert test for patients////////////////////////////////////////////////////////
	
	public function insert_diagnosis_test()
		{
			
					
			$this->form_validation->set_rules('patient_name','Patient Name','trim|xss_clean|required|max_length[30]');
			$this->form_validation->set_rules('patient_gurdain_name','Patient Gurdain Name','trim|xss_clean|required|max_length[30]');
			$this->form_validation->set_rules('relation_gurdain','Relation With Gurdain','trim|xss_clean|required|max_length[15]');
			//$this->form_validation->set_rules('paient_age','Patient Age','trim|required|xss_clean|max_length[3]');
			$this->form_validation->set_rules('patient_age_year','Patient Age','trim|required|xss_clean|max_length[3]');
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
			$this->form_validation->set_rules('user_id','Institution Name','trim|xss_clean');
			$this->form_validation->set_rules('test_date','Test Date','trim|required|xss_clean');
			$this->form_validation->set_rules('disease_code','Disease Category','trim|required|xss_clean');
			$this->form_validation->set_rules('disease_subcase_code','Disease Sub Category','trim|required|xss_clean');
			$this->form_validation->set_rules('test_type_code','Test Name','trim|required|xss_clean');	
			

			if ($this->form_validation->run() == TRUE) 
				{					
					$date= date("Y");
					$max=$this->Mod_health->get_max_regisID();
					
					$institution_code = $this->input->post('user_id');
					$patient_name = $this->input->post('patient_name');
					$patient_gurdain_name = $this->input->post('patient_gurdain_name');			
					$relation_gurdain = $this->input->post('relation_gurdain');
					//$paient_age = $this->input->post('paient_age');
					$patient_age_year=$this->input->post('patient_age_year');
					$patient_age_month=$this->input->post('patient_age_month');
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
					$test_date = $this->input->post('test_date');
					$disease_code = $this->input->post('disease_code');
					$disease_subcase_code = $this->input->post('disease_subcase_code');
				    $test_type_code = $this->input->post('test_type_code');
					$PN_flag = $this->input->post('PN_flag');				
					$patient_id = $date.$max;
					///////////////////////////11.06.2018////////////////////////
					 $fetch_test_count=$this->Mod_health->fetch_test_count($test_date,$test_type_code,$institution_code);
					 //$fetch_test_count;
					
					$fetch_positive_test_case=$this->Mod_health->fetch_positive_test_case($test_date,$test_type_code,$institution_code);
					//echo  $fetch_positive_test_case;
				
					if($fetch_test_count==0)
					{
					$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data = array(
					'success_message' => ' There are no total test details entry first enter your total case  details'					
				);			
							  $this->load->view('maincontents/patient_search',$data);
			                  $this->load->view('maincontents/footer');
					
					
					}
					
					else if($fetch_positive_test_case>=$fetch_test_count)
					{
					
						$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data = array(
					'success_message' => 'your positive case details can not be greater than total test case entry '					
				);			
								

							  $this->load->view('maincontents/patient_search',$data);
			                  $this->load->view('maincontents/footer');
					}
					
					///////////////////////////11.06.2018/////////////////////////
					else{

					//$result=$this->Mod_health->get_diagnosis_insert($patient_id,$institution_code,$patient_name,$patient_gurdain_name,$relation_gurdain,$paient_age,$patient_gender,$patient_district,$patient_village_town,$patient_pin,$patient_address,$patient_mobile,$patient_phone_no,$patient_email,$patient_aadhar,$patient_epic,$test_type_code,$test_date,$PN_flag);
					
					$result=$this->Mod_health->get_diagnosis_insert($patient_id,$institution_code,$patient_name,$patient_gurdain_name,$relation_gurdain,$patient_age_year,$patient_age_month,$patient_gender,$patient_district,$patient_village_town,$patient_pin,$patient_address,$patient_mobile,$patient_phone_no,$patient_email,$patient_aadhar,$patient_epic,$test_type_code,$test_date,$PN_flag);
				
							

						if ($result == 1)
			 				{	
			 					$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data = array(
					'success_message' => 'Registration successfullly! Please note Registration Id : '.$patient_id					
				);			
								

							  $this->load->view('maincontents/patient_search',$data);
			                  $this->load->view('maincontents/footer');
							
							} 
							else
							{
							
					            $this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data = array(
					'success_message' => 'Registration  not successfullly! '				
				);			
								
								
							  $this->load->view('maincontents/patient_test_details',$data);
			                  $this->load->view('maincontents/footer');
							}
						
					 }
					 /////////////////////////////11.06.2018//////////////////
					 }
					 /////////////////////////////11.06.2018//////////////////
						else
							{
								$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');	
								$data['get_disease']=$this->Mod_health->get_disease();
			                    $data['get_relation']=$this->Mod_health->get_relation();
								//$data['get_disease']=$this->Mod_health->get_disease();
								//$this->load->view('maincontents/entry_diagnosis_test',$data);	
								$this->load->view('maincontents/patient_test_details',$data);	
								$this->load->view('maincontents/footer');
							}	

									 
			
		}	
	

public function  fetch_patient_details()
{
 $result=$this->uri->segment(3);


   
	$data['fetch_patient_details']=$this->Mod_health->fetch_patient_details($result);
	
	 $this->load->view('maincontents/header');
	$this->load->view('maincontents/nav');
	$data['get_disease']=$this->Mod_health->get_disease();
	$data['get_relation']=$this->Mod_health->get_relation();
	$this->load->view('maincontents/fetch_patient_details',$data);
	$this->load->view('maincontents/footer');
}

	// .......... Admission Search .......... //
	public function admission_search()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');	
			$this->load->view('maincontents/admission_search');		
			$this->load->view('maincontents/footer');	

		}	

	//.......... Admission Details Form..........//

	public function admission_details()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');
			$patient_name=$this->uri->segment(3);
			$patient_mobile=$this->uri->segment(4);
			$data['patient_name']=$patient_name;				
			$data['patient_mobile']=$patient_mobile;
			$data['get_disease']=$this->Mod_health->get_disease();
			$data['get_relation']=$this->Mod_health->get_relation();
			$data['get_admission_ward']=$this->Mod_health->get_admission_ward();
			$data['patient_status']=$this->Mod_health->patient_status();
			$this->load->view('maincontents/admission_details',$data);
			$this->load->view('maincontents/footer');	

		}

	//.......... Admission Details Form..........//

	public function admission_details_next()
		{
			$patient_name=$this->input->post('patient_name');
			$patient_mobile=$this->input->post('patient_mobile');
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');
			
			$data['patient_name']=$patient_name;				
			$data['patient_mobile']=$patient_mobile;
			$data['get_disease']=$this->Mod_health->get_disease();
			$data['get_relation']=$this->Mod_health->get_relation();
			$data['get_admission_ward']=$this->Mod_health->get_admission_ward();
			$data['patient_status']=$this->Mod_health->patient_status();
			$this->load->view('maincontents/admission_details',$data);
			$this->load->view('maincontents/footer');	

		}	

	// .......... Admission Insert ..........//
	public function insert_admission()
		{
			$this->form_validation->set_rules('patient_name','Patient Name','trim|xss_clean|required|max_length[30]');
			$this->form_validation->set_rules('patient_gurdain_name','Patient Gurdain Name','trim|xss_clean|required|max_length[30]');
			$this->form_validation->set_rules('relation_gurdain','Relation With Gurdain','trim|xss_clean|required|max_length[15]');
			//$this->form_validation->set_rules('paient_age','Patient Age','trim|required|xss_clean|max_length[3]');
			$this->form_validation->set_rules('patient_age_year','Patient Age','trim|required|xss_clean|max_length[3]');
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
			$this->form_validation->set_rules('disease_syndrome_code','Disease Assume Syndrome','trim|required|xss_clean');
			$this->form_validation->set_rules('doctor_name','Doctor Name','trim|required|xss_clean');
			$this->form_validation->set_rules('admission_date_time','Admission Date & Time','trim|required|xss_clean');
			$this->form_validation->set_rules('admission_ward','Admission Ward','trim|required|xss_clean');
			$this->form_validation->set_rules('admission_block','Admission Block','trim|xss_clean');
			$this->form_validation->set_rules('admission_floor','Admission Floor','trim|xss_clean');
			$this->form_validation->set_rules('admission_bed_no','Admission Bed Number','trim|xss_clean');
			
			
			if ($this->form_validation->run() == TRUE) 
				{					
					$date= date("Y");
					$max=$this->Mod_health->get_max_regisID();

					$patient_name = $this->input->post('patient_name');
					$patient_gurdain_name = $this->input->post('patient_gurdain_name');			
					$relation_gurdain = $this->input->post('relation_gurdain');
					//$paient_age = $this->input->post('paient_age');
					$patient_age_year=$this->input->post('patient_age_year');
					$patient_age_month=$this->input->post('patient_age_month');
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
					$institution_code = $this->input->post('user_id');
					$doctor_name = $this->input->post('doctor_name');
					$disease_syndrome_code = $this->input->post('disease_syndrome_code');
					$admission_date_time = $this->input->post('admission_date_time');
					$admission_ward = $this->input->post('admission_ward');
					$admission_block = $this->input->post('admission_block');
					$admission_floor = $this->input->post('admission_floor');
					$admission_bed_no = $this->input->post('admission_bed_no');
					

					$patient_id = $date.$max;

					

					$result=$this->Mod_health->get_insert_admission($patient_name,$patient_gurdain_name,$relation_gurdain,$patient_age_year,$patient_age_month,$patient_gender,$patient_district,$patient_village_town,$patient_pin,$patient_address,$patient_mobile,$patient_phone_no,$patient_email,$patient_aadhar,$patient_epic,$institution_code,$doctor_name,$disease_syndrome_code,$admission_date_time,$admission_ward,$admission_block,$admission_floor,$admission_bed_no,$patient_id);

						if ($result == TRUE)
			 				{										
								$this->session->set_flashdata('admission_msg',"Admission Details Saved Successfully !");				
							} 						
					
     		 }
						else
							{
								$this->session->set_flashdata('admission_msg',"Admission Details not  Saved Successfully !");
							}	

						$this->load->view('maincontents/header');
						$this->load->view('maincontents/nav');
						$this->load->view('maincontents/admission_search');		
						$this->load->view('maincontents/footer');		 
			
		}

	//.......... Check Patient Admin..........//

	public function check_patient()
		{
			$patient_name = $this->input->post('patient_name');
			$patient_mobile = $this->input->post('patient_mobile');
			$result=$this->Mod_health->search_patient_admin($patient_name,$patient_mobile);
			//echo $abc=$result['patient_id'];
			if($result != NULL)
			{
				
				echo json_encode($result);
			
			}
			if($result==false)
			{
				echo json_encode(array("Status"=>"There are no such Patient. You have to apply newly ! ","Patient_Name"=>$patient_name,"Patient_Mobile"=>$patient_mobile));	
			}

		}

	//.......... Only Admission Details Form..........//

	public function admission_details_only()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');
			$result=$this->uri->segment(3);
			$data['fetch_patient_details']=$this->Mod_health->fetch_patient_details($result);	
			$data['get_disease']=$this->Mod_health->get_disease();
			$data['get_relation']=$this->Mod_health->get_relation();
			$data['get_admission_ward']=$this->Mod_health->get_admission_ward();
			$data['patient_status']=$this->Mod_health->patient_status();
			$this->load->view('maincontents/admission_details_only',$data);
			$this->load->view('maincontents/footer');	

		}
		
	// .......... Only Admission Insert ..........//
	public function insert_admission_only()
		{
			$this->form_validation->set_rules('disease_syndrome_code','Disease Assume Syndrome','trim|required|xss_clean');
			$this->form_validation->set_rules('doctor_name','Doctor Name','trim|required|xss_clean');
			$this->form_validation->set_rules('admission_date_time','Admission Date & Time','trim|required|xss_clean');
			$this->form_validation->set_rules('admission_ward','Admission Ward','trim|required|xss_clean');
			$this->form_validation->set_rules('admission_block','Admission Block','trim|xss_clean');
			$this->form_validation->set_rules('admission_floor','Admission Floor','trim|xss_clean');
			$this->form_validation->set_rules('admission_bed_no','Admission Bed Number','trim|xss_clean');
						
			
			if ($this->form_validation->run() == TRUE) 
				{					
					
					$patient_id = $this->input->post('patient_id');
					$patient_name = $this->input->post('patient_name');
					$patient_gurdain_name = $this->input->post('patient_gurdain_name');	
					$paient_age = $this->input->post('paient_age');
					$patient_mobile = $this->input->post('patient_mobile');
					$institution_code = $this->input->post('user_id');
					$doctor_name = $this->input->post('doctor_name');
					$disease_syndrome_code = $this->input->post('disease_syndrome_code');
					$admission_date_time = $this->input->post('admission_date_time');
					$admission_ward = $this->input->post('admission_ward');
					$admission_block = $this->input->post('admission_block');
					$admission_floor = $this->input->post('admission_floor');
					$admission_bed_no = $this->input->post('admission_bed_no');					

					$result=$this->Mod_health->get_insert_admission_only($patient_name,$patient_gurdain_name,$paient_age,$patient_mobile,$institution_code,$doctor_name,$disease_syndrome_code,$admission_date_time,$admission_ward,$admission_block,$admission_floor,$admission_bed_no,$patient_id);

						if ($result == TRUE)
			 				{								
								
								$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$this->load->view('maincontents/admission_search');		
								$this->load->view('maincontents/footer');
								$this->session->set_flashdata('admission_msg',"Admission Details Saved Successfully !");				
							} 						
					
     		 
						else
							{
								$this->session->set_flashdata('admission_msg',"Admission Details not  Saved Successfully !");
								
							}
						}	
							

						$this->load->view('maincontents/header');
						$this->load->view('maincontents/nav');
						$this->load->view('maincontents/admission_search');		
						$this->load->view('maincontents/footer');		 
			
		}

	//.......... date validation...........//
	public function check_date()
	{
		$admission_date_time = $this->input->post('admission_date_time');
		$dischrg_date_time = $this->input->post('dischrg_date_time');
		$referout_date_time = $this->input->post('referout_date_time');
		$absconded_datetime = $this->input->post('absconded_datetime');
		$death_date_time = $this->input->post('death_date_time');
		if($dischrg_date_time != '' && $admission_date_time >= $dischrg_date_time)
		{
			$this->form_validation->set_message('check_date', 'The Discharge date must not be Previous than Admission date');
        		return false; 
   		}
   		else if($referout_date_time != '' && $admission_date_time >= $referout_date_time)
		{
			$this->form_validation->set_message('check_date', 'The ReferOut date must not be Previous than Admission date');
        		return false; 
   		}
   		else if($absconded_datetime != '' && $admission_date_time >= $absconded_datetime)
		{
			$this->form_validation->set_message('check_date', 'The Absconded date must not be Previous than Admission date');
        		return false; 
   		}
   		else if($death_date_time != '' && $admission_date_time >= $death_date_time)
		{
			$this->form_validation->set_message('check_date', 'The Death date must not be Previous than Admission date');
        		return false; 
   		}
    	else 
    	{
        	return true;
		}
	}	

	
	//............................//
	/////////////////////////////////////// search_patient////////////////////////////////////////////////////////////////

	public function search_patient()
	{
		$patient_name = $this->input->post('patient_name');
		$patient_mobile = $this->input->post('patient_mobile');
		$data['patient_name']=$patient_name;
		$data['patient_mobile']=$patient_mobile;
		$data['fetch_exist_patient_details']=$this->Mod_health->search_patient($patient_mobile);
		if($data!=0)
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');
			$this->load->view('maincontents/fetch_exist_patient_details',$data);
			$this->load->view('maincontents/footer');
		}

	/*else
	{ 
		$this->load->view('maincontents/header');
		$this->load->view('maincontents/nav');
		$data['get_disease']=$this->Mod_health->get_disease();
		$data['get_relation']=$this->Mod_health->get_relation();
		$this->load->view('maincontents/patient_test_details1',$data);
		$this->load->view('maincontents/footer');

	}*/
}

	/////////////////////////patient_test_insert_only//////////////////////////////////
public function patient_test_insert_only()
{


			$this->form_validation->set_rules('test_date','Test Date','trim|required|xss_clean');
			$this->form_validation->set_rules('disease_code','Disease Category','trim|required|xss_clean');
			$this->form_validation->set_rules('disease_subcase_code','Disease Sub Category','trim|required|xss_clean');
			$this->form_validation->set_rules('test_type_code','Test Name','trim|required|xss_clean');	
			

			if ($this->form_validation->run() == TRUE) 
				{					
					
					$institution_code = $this->input->post('user_id');
					$test_date = $this->input->post('test_date');
					$disease_code = $this->input->post('disease_code');
					$disease_subcase_code = $this->input->post('disease_subcase_code');
					$test_type_code = $this->input->post('test_type_code');
					$PN_flag = $this->input->post('PN_flag');				
					$patient_id =$this->input->post('patient_id');
					/////12.06.2018///////////////
					 $fetch_test_count=$this->Mod_health->fetch_test_count($test_date,$test_type_code,$institution_code);
					
					$fetch_positive_test_case=$this->Mod_health->fetch_positive_test_case($test_date,$test_type_code,$institution_code);
					
				
					if($fetch_test_count==0)
					{
					$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data = array(
					'success_message' => ' There are no total test details. First enter your total case  details !'					
				);			
							  $this->load->view('maincontents/patient_search',$data);
			                  $this->load->view('maincontents/footer');
					
					
					}
					
					else if($fetch_positive_test_case>=$fetch_test_count)
					{
					
						$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data = array(
					'success_message' => 'your positive case details can not be greater than total test case entry '					
				);			
								

							  $this->load->view('maincontents/patient_search',$data);
			                  $this->load->view('maincontents/footer');
					}
					
					else
					{

					$result=$this->Mod_health->patient_test_insert_only($patient_id,$institution_code,$test_type_code,$test_date,$PN_flag);
				
	
						if ($result == 1)
			 				{	
			 					$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data = array(
					'success_message' => 'Patient Test Details saved successfullly!  '				
				);			
								

							  $this->load->view('maincontents/patient_search',$data);
			                  $this->load->view('maincontents/footer');
							
							} 
							else
							{
							
					            $this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data = array(
					'success_message' => 'Patient Test Details not saved successfullly! '				
				);			
								
								
							  $this->load->view('maincontents/patient_test_details',$data);
			                  $this->load->view('maincontents/footer');
							}
						
					 }
					}
					 
						else
							{
								$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');	
								$data['get_disease']=$this->Mod_health->get_disease();
			                    $data['get_relation']=$this->Mod_health->get_relation();
								//$data['get_disease']=$this->Mod_health->get_disease();
								//$this->load->view('maincontents/entry_diagnosis_test',$data);	
								$this->load->view('maincontents/patient_test_details',$data);	
								$this->load->view('maincontents/footer');
							}	
}

	//.............. Change Password ..........//
 	public function change_password()
		{
			$this->load->view('maincontents/header');	
			$this->load->view('maincontents/nav');
			$this->load->view('maincontents/change_password_user');		
			$this->load->view('maincontents/footer');	

		}

	public function password_change()
		{
			$this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
			$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|callback_valid_password|xss_clean');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[new_password]');

			if ($this->form_validation->run() == TRUE)
			{
				$user_id = $this->input->post('user_id');
				$current_password = md5($this->input->post('current_password'));
				$new_password = $this->input->post('new_password');
				$confirm_password = $this->input->post('confirm_password');

				$password=$this->Mod_health->get_password($user_id);
				if($password == $current_password)
				{
					$result=$this->Mod_health->get_change_password($user_id,$current_password,$new_password,$confirm_password);
					if ($result == TRUE)
			 				{
			 					$this->session->set_flashdata('change_success',"Password Changed Successfully !");										
							}
					else
			 		{
			 					$this->session->set_flashdata('change_success',"Password Changed Unsuccessfully !");										
					}								 
				}
				else
			 	{
			 					$this->session->set_flashdata('change_success',"Current Password does not matched ! Please enter password");
								
																		
				}
				
				
			}
				
					$this->load->view('maincontents/header');	
					$this->load->view('maincontents/nav');
					$this->load->view('maincontents/change_password_user');		
					$this->load->view('maincontents/footer');
					
					
		}			

	public function valid_password($new_password = '')
    {
        $new_password = trim($new_password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
       /* if (empty($new_password))
        {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');
            return FALSE;
        }*/
        if (preg_match_all($regex_lowercase, $new_password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $new_password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $new_password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $new_password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('@#$'));
            return FALSE;
        }
        if (strlen($new_password) < 5)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
            return FALSE;
        }
        if (strlen($new_password) > 30)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 30 characters in length.');
            return FALSE;
        }
        return TRUE;
    }
	
/////////////////////////////////////////// test_data_entry//////////////////////////////////////////////////////	
		public function test_data_edit()
		{
				$this->load->view('maincontents/header');
				$this->load->view('maincontents/nav');	
				$data['get_disease']=$this->Mod_health->get_disease();	
				$this->load->view('maincontents/edit_test_data',$data);		
				$this->load->view('maincontents/footer');	

		}
		
		public function test_data_edit_fetch()
		{
				
				
				$test_date=$this->input->post('test_date');
				$test_id=$this->input->post('test_id');
				$user_id=$this->input->post('user_id');
				$data['edit_test_details']=$this->Mod_health->edit_test_details($test_date,$test_id,$user_id);
				$row=$this->Mod_health->test_details_row($test_date,$test_id,$user_id);

				
			if($row>0)
			{
				
				$this->load->view('maincontents/fetch_test_data',$data);
				
			}
				
			if($row==0)
				{
			
	     $this->load->view('maincontents/fetch_test_data_unsess');			
				
				
				}
				
		
		}
		
		
		public function test_data_update()
		{
		
		        $user_id=$this->input->post('user_id');
				$total_tested=$this->input->post('total_tested');
				$result=$this->Mod_health->test_data_update($user_id,$total_tested);
		        if ($result == TRUE)
			{
			 					
								$this->session->set_flashdata('test_suc_msg',"update test data sucessfully !");										
			}
			else
			 {
			 					
								$this->session->set_flashdata('test_suc_msg',"update test data unsucessfully!");										
					
					
			 }	
				
				
				//$this->load->view('maincontents/fetch_test_data',$data);
					$this->load->view('maincontents/header');	
					$this->load->view('maincontents/nav');
					$data['get_disease']=$this->Mod_health->get_disease();	
				    $this->load->view('maincontents/edit_test_data',$data);		
				    $this->load->view('maincontents/footer');			
		
		}
	
	// .......... Patient Outcome .......... //
	public function patient_outcome()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');	
			$this->load->view('maincontents/patient_outcome');		
			$this->load->view('maincontents/footer');	

		}



////////////////////////////////////checck_patient_outcome/////////////////////////////////
		
		public function check_patient_outcome()
		{
			$admission_date_time = $this->input->post('admission_date_time');
			//echo $admission_date_time;
			
			$patient_mobile = $this->input->post('patient_mobile');
			$result=$this->Mod_health->check_patient_outcome($admission_date_time,$patient_mobile);
	
		
			if($result != NULL)
			{
				
				echo json_encode($result);
			
			}
			if($result==false)
			{
				echo json_encode(array("Status"=>"There are no such Patient. You have to apply newly ! ","Patient_Name"=>$patient_name,"Patient_Mobile"=>$patient_mobile));	
			}

		}
		////////////////////////////////// patient outcome only//////////////////////////
		
			public function patient_outcome_only()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');
			$patient_id=$this->uri->segment(3);
			$admission_date_time=$this->uri->segment(4);
		    $admission_date_time1=substr($admission_date_time,0,10);
		   
	
			$data['fetch_patient_details']=$this->Mod_health->fetch_patient_details_outcome($patient_id,$admission_date_time1);
			print_r($data);
			
			$data['patient_status']=$this->Mod_health->patient_status();
			$this->load->view('maincontents/patient_outcome_only',$data);
			$this->load->view('maincontents/footer');	

		}
		
		
////////////////////////// patient_outcome_insert//////////////////////////////////////

public function patient_outcome_insert()
{
  					   $patient_id = $this->input->post('patient_id');
					   $admission_date_time = $this->input->post('admission_date_time');
					    echo $admission_date_time1=substr($admission_date_time,0,10);
						
				       $patient_status = $this->input->post('patient_status');
				       $dischrg_date_time=$this->input->post('dischrg_date_time');
				       $referout_type=$this->input->post('referout_type');
					   $referout_date_time=$this->input->post('referout_date_time');
					   $cause_of_referout=$this->input->post('cause_of_referout');
					   $referout_to_whom=$this->input->post('referout_to_whom');
					   $absconded_datetime=$this->input->post('absconded_datetime');
					   $death_date_time=$this->input->post('death_date_time');
					   $cause_of_death=$this->input->post('cause_of_death');
					   $return=$this->Mod_health->patient_outcome_insert($patient_id,$patient_status,$dischrg_date_time,$referout_type,$referout_date_time,$cause_of_referout,$referout_to_whom,$absconded_datetime,$death_date_time,$cause_of_death,$admission_date_time1);
					if($return=="1")
					 {
					  $this->session->set_flashdata('message',"Data Updated Successfully ! ");			
					  $this->load->view('maincontents/header');
			          $this->load->view('maincontents/nav');	
			          $this->load->view('maincontents/patient_outcome');		
			          $this->load->view('maincontents/footer');	
		
					 }
			
					else
					 {
						$this->session->set_flashdata('message',"Data can not update Successfully ! ");	
				        $this->load->view('maincontents/header');
			            $this->load->view('maincontents/nav');	
			            $this->load->view('maincontents/patient_outcome');		
			            $this->load->view('maincontents/footer');
					 }  


}		
		

	
	

	

	
	
											 
}
?>

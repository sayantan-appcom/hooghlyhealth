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
            $user_type = $this->input->post('user_type');
			$data=$this->Mod_health->getsubdisease($disease_category,$user_type);
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
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');	
			$data['get_disease']=$this->Mod_health->get_disease();
			$data['get_relation']=$this->Mod_health->get_relation();
			$this->load->view('maincontents/patient_test_details',$data);
			$this->load->view('maincontents/footer');	

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
								$data = array(
					'test_suc_msg' => 'Test data saved successfullly!');	
								$this->load->view('maincontents/entry_test_data',$data);
								$this->load->view('maincontents/footer');										
							} 
						
					 }
						else
							{
								$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data = array(
					'test_suc_msg' => 'Test data not saved successfullly!');	
								$this->load->view('maincontents/entry_test_data',$data);
								$this->load->view('maincontents/footer');
							} 
			
		}

	public function admission_search()
		{
			$this->load->view('maincontents/header');
			$this->load->view('maincontents/nav');	
			//$data['get_disease']=$this->Mod_health->get_disease();	
			$this->load->view('maincontents/admission_details');		
			$this->load->view('maincontents/footer');	

		}									
///////////////////////////////////Insert test for patients////////////////////////////////////////////////////////
	
	public function insert_diagnosis_test()
		{
			
					
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
			$this->form_validation->set_rules('user_id','Institution Name','trim|xss_clean');
			$this->form_validation->set_rules('test_date','Test Date','trim|required|xss_clean');
			$this->form_validation->set_rules('disease_code','Disease Category','trim|required|xss_clean');
			$this->form_validation->set_rules('disease_subcase_code','Disease Sub Category','trim|required|xss_clean');
			$this->form_validation->set_rules('test_type_code','Test Name','trim|required|xss_clean');	
			

			if ($this->form_validation->run() == TRUE) 
				{					
					$date= date("Y");
					$max=$this->Mod_health->get_max_regisID();
				//echo $max;
			
					$institution_code = $this->input->post('user_id');
					/*$get_fulldetails=$this->Mod_health->get_fulldetails($institution_code);
					foreach ($get_fulldetails as $detail) {
						 $state_code = $detail['state_code'];
						 $district_code = $detail['district_code'];
						 $subdivision_code = $detail['subdivision_code'];
						 $block_code = $detail['block_code'];						
					}*/
					
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
					$test_date = $this->input->post('test_date');
					$disease_code = $this->input->post('disease_code');
					$disease_subcase_code = $this->input->post('disease_subcase_code');
					$test_type_code = $this->input->post('test_type_code');
					$PN_flag = $this->input->post('PN_flag');				
					$patient_id = $date.$max;

					$result=$this->Mod_health->get_diagnosis_insert($patient_id,$institution_code,$patient_name,$patient_gurdain_name,$relation_gurdain,$paient_age,$patient_gender,$patient_district,$patient_village_town,$patient_pin,$patient_address,$patient_mobile,$patient_phone_no,$patient_email,$patient_aadhar,$patient_epic,$test_type_code,$test_date,$PN_flag);
				
							

						if ($result == 1)
			 				{	
			 					$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$data = array(
					'success_message' => 'Registration successfullly! Please note Registration Id : '.$patient_id					
				);			
								

							  $this->load->view('maincontents/patient_test_details',$data);
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



/////////////////////////////////////// search_patient////////////////////////////////////////////////////////////////

public function search_patient()
{
	$patient_name = $this->input->post('patient_name');
	$patient_mobile = $this->input->post('patient_mobile');
	$result=$this->Mod_health->search_patient($patient_name,$patient_mobile);
	
	
	if($result!=0)
	{
	
	$this->load->view('maincontents/header');
	$this->load->view('maincontents/nav');

	?>
	<a class="star" href="<?php echo site_url('Health_Home/fetch_patient_details'); ?>/<?php echo $result;?>"><?php echo "ALREADY DATA EXIST";?></a>	
	<?php
	$this->load->view('maincontents/footer');
	}

else
{ 
	$this->load->view('maincontents/header');
	$this->load->view('maincontents/nav');
	$data['get_disease']=$this->Mod_health->get_disease();
	$data['get_relation']=$this->Mod_health->get_relation();
	$this->load->view('maincontents/patient_test_details',$data);
	$this->load->view('maincontents/footer');


}
}

public function  fetch_patient_details()
{
echo $result=$this->uri->segment(3);


   
	$data['fetch_patient_details']=$this->Mod_health->fetch_patient_details($result);
	
	 $this->load->view('maincontents/header');
	$this->load->view('maincontents/nav');
	$data['get_disease']=$this->Mod_health->get_disease();
	$data['get_relation']=$this->Mod_health->get_relation();
	$this->load->view('maincontents/fetch_patient_details',$data);
	$this->load->view('maincontents/footer');
}

	

	
	
											 
}
?>

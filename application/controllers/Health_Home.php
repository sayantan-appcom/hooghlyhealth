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

	

	
	
											 
}

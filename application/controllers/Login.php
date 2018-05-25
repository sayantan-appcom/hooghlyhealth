<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	 public function __construct()
	 { 
            parent::__construct();
            $this->load->helper('url'); 
			$this->load->helper('form');
			$this->load->library('Recaptcha');
			$this->load->library('form_validation');
			$this->load->helper('security');
  			$this->load->library('session');
			$this->load->model('Mod_Login');
     } 

	public function index()
	{
		$this->load->helper('captcha');
		$vals = array(
		        'img_path'      => './captcha/',
		        'img_url'       => base_url().'captcha/',
		        'expiration'	=> 7200,
		        'word_length'	=> 6,
		        'font_size'		=> 60
				);
		$cap = create_captcha($vals);
		$data['captcha'] = $cap['image'];
		

		$this->load->view('index',$data);
	}

	public function refresh_captcha()
	{
		$this->load->helper('captcha');
		$vals = array(
		        'img_path'      => './captcha/',
		        'img_url'       => base_url().'captcha/',
		        'expiration'	=> 7200,
		        'word_length'	=> 6,
		        'font_size'		=> 60
				);
		$cap = create_captcha($vals);
		$data['captcha'] = $cap['image'];
		

		$this->load->view('index',$data);
	}


	public function user_login_process()
	{
		
	 $this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean');
	 $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

	 	if ($this->form_validation->run() == FALSE) 
			{				

			if(isset($this->session->userdata['logged_in']))
			{
				unset($this->session->userdata['logged_in']);
			}
				$this->load->view('index');
			}
		else{
			//$captcha_answer = $this->input->post('g-recaptcha-response');
			//$response = $this->recaptcha->verifyResponse($captcha_answer);

			//if ($response['success']) {
			$login = array(
            'email'=> $this->input->post('email'),
            'password' => md5($this->input->post('password'))            
             ); 
			$result = $this->Mod_Login->user_login($login);	
			if ($result == TRUE) 
				{
					$email = $this->input->post('email'); 
					$this->data['feeder'] = $this->Mod_Login->read_user_information($email);

				if ($this->data['feeder'] != false) 
				{
			    	$session_data = array(
						'user_type' => $this->data['feeder'][0]->inst_type_id,
						'user_id'=>$this->data['feeder'][0]->user_id,
						'user_name'=>$this->data['feeder'][0]->inst_name
							);
					$this->session->set_userdata('logged_in',$session_data);
					$this->load->view('maincontents/header');	
					$this->load->view('maincontents/nav');
					$this->load->view('maincontents/home');		
					$this->load->view('maincontents/footer');		
			    }
		    }
			else
			{				
				echo "Invalid Email OR Password! Please check it carefully";
			} 
		}
		/*else {
			echo "Invalid Captcha! Please check captcha carefully";
			}
		}	*/
	}
	
	public function logout()
		{
			unset($this->session->userdata['logged_in']);
			$this->session->sess_destroy();			
			redirect('Login');

		}

	

	 
}

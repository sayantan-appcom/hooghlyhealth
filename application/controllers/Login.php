<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	 public function __construct()
	 { 
            parent::__construct();
            $this->load->helper('url'); 
			$this->load->helper('form');
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
		        'font_size'		=> 60,
		        'img_width' => 120,
    			'img_height' => 30,
    			/*'word_length' => 6,*/
    			'word' =>rand(100000,999999),
		        'expiration'	=> 900

				);
		$cap = create_captcha($vals);
		$data['captcha'] = $cap['image'];
		$this->session->set_userdata('captchaword', $cap['word']);		

		$this->load->view('index',$data);
	}

	public function refresh_captcha()
	{
		$this->load->helper('captcha');
		$vals = array(
		        'img_path'      => './captcha/',
		        'img_url'       => base_url().'captcha/',
		        'font_size'		=> 60,
		        'img_width' => 120,
    			'img_height' => 30,
    			/*'word_length' => 6,*/
    			'word' =>rand(100000,999999),
		        'expiration'	=> 900
				);
		$cap = create_captcha($vals);
		$this->session->set_userdata('captchaword', $cap['word']);
		echo $cap['image'];
	}


	public function user_login_process()
	{
		
	 $this->form_validation->set_rules('user_email', 'Email Address', 'trim|required|valid_email|xss_clean');
	 $this->form_validation->set_rules('user_password', 'Password', 'trim|required|xss_clean');
	 $this->form_validation->set_rules('user_captcha', 'Captcha', 'trim|required|callback_validate_captcha');

			//echo $post_captcha=$this->input->post('user_captcha');
			//echo $set_captcha=$this->session->userdata('captchaword');
			//die();

	 	if ($this->form_validation->run() == FALSE) 
			{				

			if(isset($this->session->userdata['logged_in']))
			{
				unset($this->session->userdata['logged_in']);
			}
				$this->index();
			}
		else{
			//$captcha_answer = $this->input->post('g-recaptcha-response');
			//$response = $this->recaptcha->verifyResponse($captcha_answer);

			//if ($response['success']) {
			$login = array(
            'email'=> $this->input->post('user_email'),
            'password' => md5($this->input->post('user_password'))            
             ); 
			$result = $this->Mod_Login->user_login($login);	
			if ($result == TRUE) 
				{
					$email = $this->input->post('user_email'); 
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

	public function validate_captcha()
		{
			$post_captcha=$this->input->post('user_captcha');
			$set_captcha=$this->session->userdata('captchaword');
			if($post_captcha != $set_captcha)
			{
				$this->form_validation->set_message('validate_captcha', 'Wrong Captcha Code ! Enter Correct Captcha Code');
			        return false;
			}
			else
			{
				 return true;
			}
		}
	
	public function logout()
		{
			unset($this->session->userdata['logged_in']);
			$this->session->sess_destroy();			
			redirect('Login');

		}

	

	 
}

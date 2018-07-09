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

	public function UserLogin()
	{
		$this->load->helper('captcha');
		$vals = array(
		        'img_path'      => './captcha/',
		        'img_url'       => base_url().'captcha/',
		        'font_size'		=> 60,
		        'img_width' => 120,
    			'img_height' => 30,
    			//'word_length' => 6,
    			'word' =>rand(100000,999999),
		        'expiration'	=> 900

				);
		$cap = create_captcha($vals);
		$data['captcha'] = $cap['image'];
		$this->session->set_userdata('captchaword', $cap['word']);
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('user_login',$data);
		$this->load->view('footer');
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
				unset($this->session->userdata['captchaword']);
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
					$user_id = $session_data['user_id'];
					$get_flag = $this->Mod_Login->get_flag_chng($user_id);
					if($get_flag == 0)
					{
						//$data=$this->Mod_Login->get_password($user_id);						
						$this->load->view('maincontents/change_password',$session_data);
						
					}

					else
					{
						$this->load->view('maincontents/header');	
						$this->load->view('maincontents/nav');
						$this->load->view('maincontents/home');		
						$this->load->view('maincontents/footer');
					}

							
			    }
		    }
			else
			{				
				//echo "Invalid Email OR Password! Please check it carefully";
				//$this->session->set_flashdata('login_msg',"Invalid Email OR Password!");
				//$this->UserLogin();
				echo "<script>
					alert('Invalid Email OR Password! Please check it carefully');
					 </script>";
				$this->index();
			} 
		}
		/*else {
			echo "Invalid Captcha! Please check captcha carefully";
			}
		}	*/
	}

	public function home()
	{
		$this->load->view('maincontents/header');	
		$this->load->view('maincontents/nav');
		$this->load->view('maincontents/home');		
		$this->load->view('maincontents/footer');

	}

	public function validate_captcha()
		{
			$post_captcha=$this->input->post('user_captcha');
			$set_captcha=$this->session->userdata('captchaword');
			if($post_captcha != $set_captcha)
			{
				$this->form_validation->set_message('validate_captcha', 'Wrong Captcha Code ! Enter Correct Captcha Code');
			       // return false;
			       

			    echo "<script>
					alert('Wrong Captcha Code ! Enter Correct Captcha Code');
					 </script>";
				return false;	  
				$this->index();
				 	    
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
	public function change_password()
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

				$password=$this->Mod_Login->get_password($user_id);
				if($password == $current_password)
				{
					$result=$this->Mod_Login->get_change_password($user_id,$current_password,$new_password,$confirm_password);
					if ($result == TRUE)
			 				{
			 					$this->load->view('maincontents/header');
								$this->load->view('maincontents/nav');
								$this->load->view('maincontents/home');		
								$this->load->view('maincontents/footer');										
							}						 
				}
				else
				{
					$data = array(
					'resp' => 'Current Password does not matched !');
					$this->load->view('maincontents/change_password',$data);
					
				}			

			} 
				
			else
			{
				$this->load->view('maincontents/change_password');
			}	

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

	

	 
}

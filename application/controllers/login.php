<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Email_Model');
	  $this->load->model('Account_Model');
	  $this->domain = "DSS";
	  $this->domain_id = "1";
 	  
    }
	function callcenter($id='')
	{

		$data['id'] = $id;
		$this->load->view('callcenter/login',$data);
	}	
	function callcenter_login()
	{
		
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		 $res = $this
					  ->Account_Model
					  ->check_callcenter_login($username,$password,$this->domain_id); 


			 if ( $res !== false ) 
			 {
				   
						$sessionUserInfo = array( 
						'callcenter_id' 		=> $res->callcenter_id,
						'callcenter_email'	 			=> $res->email,
						'callcenter_logged_in' 	=> TRUE,
						'callcenter_firstname'  => $res->name,
						'callcenter_company_name'  => $res->company_name,
						);
						$this->session->set_userdata($sessionUserInfo);
				
				redirect('callcenter/userlogin_page','refresh');
					
	
			 }
			 else
			 {
			      $data['status']= 'Login Failed';
          	 }

		
	}
	
	function member_login($PATH_INFO='')
	{
		
         $data['authUrl'] =''; 
		$data['PATH_INFO']=$PATH_INFO;

		$this->load->view('account/member_login',$data);
	}
		function member_loginajax($PATH_INFO='')
	{
		 // $this->load->library('social/google/Google_Client.php');
		 // $this->load->library('social/google/contrib/Google_Oauth2Service.php');
		  $client = new Google_Client();
    $client->setApplicationName("Google UserInfo PHP Starter Application");
    $oauth2 = new Google_Oauth2Service($client);
		
         $authUrl = $client->createAuthUrl();
         $data['authUrl'] = $authUrl; 
		$data['PATH_INFO']=$PATH_INFO;

		$this->load->view('account/member_loginajax',$data);
	}
	function agent_login($PATH_INFO='')
	{
		 	$data['PATH_INFO']=$PATH_INFO;

		$this->load->view('account/agent_login',$data);
	}
	function check_userlogin($datass='')
	{
		
			$domain_id = $this->Account_Model->get_domain_list_id($this->domain);
		
			 $res = $this
					  ->Account_Model
					  ->check_admin_login(
						 $this->input->post('email'), 
						 $this->input->post('password'),
						 $domain_id->domain_id
					  ); 

			 if ( $res !== false ) 
			 {
				   
						$sessionUserInfo = array( 
						'b2c_id' 		=> $res->user_id,
						'b2c_email'	 			=> $res->email,
						'b2c_type' 		=> $res->usertype,
						'b2c_logged_in' 	=> TRUE,
						'b2c_firstname'  => $res->firstname,
						'b2c_lastname'  => $res->lastname
						
						);
						if($datass=='2')
						{
						$this->session->set_userdata($sessionUserInfo);
						}
						  echo 'Success';
						//$this->load->view('general/booking_page_login_access',$data);
					
			 }
			 else
			 {
			      $data['status']= 'Login Failed';
				  $this->load->view('general/booking_page_login_access',$data);
          	 }
		
		
	}
	function member_loginpage($page_url='')
	{
		
		if($page_url=='')
		{
				$page_url='home';

		}
		else
		{
		
			$page_url= strtr(base64_decode($page_url),array('.' => '+','-' => '=','~' => '/'));

		}
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email-Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data['status']='';
		if ( $this->form_validation->run() !== false ) {
			$domain_id = $this->Account_Model->get_domain_list_id($this->domain);
			 $res = $this
					  ->Account_Model
					  ->check_admin_login(
						 $this->input->post('email'), 
						 $this->input->post('password'),
						 $domain_id->domain_id
					  ); 
			 if ( $res !== false ) 
			 {
				   
				 
						$sessionUserInfo = array( 
						'b2c_id' 		=> $res->user_id,
						'b2c_email'	 			=> $res->email,
						'b2c_type' 		=> $res->usertype,
						'b2c_logged_in' 	=> TRUE,
						'b2c_firstname'  => $res->firstname,
						'b2c_lastname'  => $res->lastname,
						);
						$this->session->set_userdata($sessionUserInfo);
				
				redirect($page_url,'refresh');
				
	
			 }
			 else
			 {
			       $data['authUrl'] =''; 
					$data['PATH_INFO']='';
				 $data['x'] ='3434'; 
					$this->load->view('account/member_login',$data);
          	 }
			
		}	
		else
		{
			  $data['authUrl'] =''; 
			$data['PATH_INFO']='';
		 $data['x'] ='3434'; 
			$this->load->view('account/member_login',$data);
		}

					
		
			
				
	}
	
		function agent_loginpage($page_url='')
	{
		
		if($page_url=='')
		{
				$page_url='home';

		}else
		{
		
			$page_url= strtr(base64_decode($page_url),array('.' => '+','-' => '=','~' => '/'));

		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email-Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data['status']='';
		if ( $this->form_validation->run() !== false ) {
			$domain_id = $this->Account_Model->get_domain_list_id($this->domain);
		
			 $res = $this
					  ->Account_Model
					  ->check_agent_login(
						 $this->input->post('email'), 
						 $this->input->post('password'),
						 $domain_id->domain_id
					  ); 


			 if ( $res !== false ) 
			 {
				   
						$sessionUserInfo = array( 
						'b2b_id' 		=> $res->agent_id,
						'b2b_email'	 	=> $res->email_id,
						'b2b_type' 		=> $res->agent_type,
						'b2b_logged_in' 	=> TRUE,
						'b2b_firstname'  => $res->name,
						'b2b_companyname'  => $res->company_name,
						'b2b_logo'  => $res->agent_logo 
						);
						$this->session->set_userdata($sessionUserInfo);
				
				redirect('home','refresh');
					
	
			 }
			 else
			 {
			   $data['PATH_INFO']='';
 		 $data['status']= 'Login Failed !';
		$this->load->view('account/agent_login',$data);
			     
          	 }

		}	
		else
		{
			$data['PATH_INFO']='';
 		 $data['status']= 'Login Failed !';
		$this->load->view('account/agent_login',$data);
		}
	
					
		
				
	}
	
		public function indessx()
	{
	

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email-Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data['status']='';
		if ( $this->form_validation->run() !== false ) {
		
		
			 $res = $this
					  ->Home_Model
					  ->check_admin_login(
						 $this->input->post('email'), 
						 $this->input->post('password')
					  ); 


			 if ( $res !== false ) 
			 {
				   if($res->usertype==0)
					{
						$sessionUserInfo = array( 
						'sa_id' 		=> $res->user_id,
						'sa_email'	 			=> $res->email,
						'sa_logged_in' 	=> TRUE
						);
						$this->session->set_userdata($sessionUserInfo);
						redirect('home/dashboard', 'refresh'); 
					
					}
					else
					{
						$sessionUserInfo = array( 
					'admin_id' 		=> $res->user_id,
					'admin_email'	 	=> $res->email,
					'admin_type'	 	=> $res->usertype,
					'admin_logged_in' 	=> TRUE
					);
					$this->session->set_userdata($sessionUserInfo);
					  
					redirect('sdadmin/index/'.$res->domain, 'refresh'); 
					
					}
					
			 }
			 else
			 {
			      $data['status']= 'Login Failed';
          	 }

		}	
		
		
		$this->load->view('login',$data);
	
	}
	
	
		public function admin_login()
	{
	

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email-Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data['status']='';
		if ( $this->form_validation->run() !== false ) {
		
		
			 $res = $this
					  ->Home_Model
					  ->check_admin_login(
						 $this->input->post('email'), 
						 $this->input->post('password')
					  ); 


			 if ( $res !== false ) 
			 {
				   if($res->usertype==0)
					{
						$sessionUserInfo = array( 
						'sa_id' 		=> $res->user_id,
						'sa_email'	 			=> $res->email,
						'sa_logged_in' 	=> TRUE
						);
						$this->session->set_userdata($sessionUserInfo);
						redirect('home/dashboard', 'refresh'); 
					
					}
					else
					{
						$sessionUserInfo = array( 
					'admin_id' 		=> $res->user_id,
					'admin_email'	 	=> $res->email,
					'admin_type'	 	=> $res->usertype,
					'admin_logged_in' 	=> TRUE
					);
					$this->session->set_userdata($sessionUserInfo);
					  
					redirect('sdadmin/index/'.$res->domain, 'refresh'); 
					
					}
					
			 }
			 else
			 {
			      $data['status']= 'Login Failed';
          	 }

		}	
		
		
		$this->load->view('login',$data);
	
	}
	public function logout()
    {
    	
    	 if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id'))
	 			{
	 				
        if($this->session->userdata('b2c_id'))
	     	{
		
       $userid = 	$this->session->userdata('b2c_id');
       $usertype = 	$this->session->userdata('b2c_type');
	      	}
		
		     if($this->session->userdata('b2b_id'))
		     {
		
       $userid = $this->session->userdata('b2b_id');
       $usertype = 	$this->session->userdata('b2b_type');
		     }
		     
		     $this->Account_Model->change_onlie_status($userid,$usertype);
		     	
		    }
    	
        $this->session->unset_userdata('sessionUserInfo');
		      $this->session->sess_destroy();
        redirect('home', 'refresh'); 
    }
	public function logoutcc()
    {
    	
    	
        $this->session->unset_userdata('sessionUserInfo');
		      $this->session->sess_destroy();
        redirect('callcenter', 'refresh'); 
    }
	function member_forgetpassword()
	{
		$this->load->view('account/member_forgetpassword');
	}
	
	function member_passwordpage()
 	{
 	$email = $this->input->post('emailval');
 	$domain_id = $this->Account_Model->get_domain_list_id($this->domain);
 $res = $this
			 ->Account_Model
			 ->check_user_logindetail($email,$domain_id->domain_id);  
             if ( $res !== false ) 
			 {
			 	 
			 $first_name=$res->firstname;
			 $message = 'Check it your password below. Please click the below link to SignIn your account<br><br>';
			 $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			 <td rowspan="3"><img src="'.$res->profile_photo.'" width="100"></td>
			<td rowspan="3" align="left" valign="top">
			<strong>URL</strong> :'.WEB_HOTEL_URL.'b2c/login<br>
			<strong>Email</strong> : '.$email.'<br>
			<strong>Password</strong> : '.$res->password.'<br>
			
			</td>
		 	</tr>
			</table>';
			
              
				 $message_header='Forget Password';
				 $subject='DSS User Login Acess';
				 
				 $this->Email_Model->send_email($first_name,$subject,$email,$message_header,$message);
				 
				                   $data['status'] = "Valid Email";
                        $data['error_message'] = "Your Password Has Been send to your mail";
                        echo json_encode($data);        
		
        
			 }
     	     else 
        	 {
                        $data['status'] = "Existing Email";
                        $data['error_message'] = "Please enter the correct Email";
                        echo json_encode($data);        	
        	
        	}
 
 	}
 	
 	
 	function Update_feedback_detail()
 	
 	{
 	
 		$email = $this->input->post('emailval');
 		$name = $this->input->post('nameval');
		$subject = $this->input->post('categoryval');
		$messageval = $this->input->post('messageval');
		$hostval = $this->input->post('host');
		$countryval = $this->input->post('countryName');
		$cityval = $this->input->post('city');
		$regionval = $this->input->post('region');
		$domain_id = $this->Account_Model->get_domain_list_id($this->domain);
		$insertval=$this->Account_Model->insert_feedback_detail($name,$domain_id->domain_id,$email,$subject,	$messageval,$hostval,$cityval,$countryval,$regionval);  
  
 	
		$message_header='Customer Feedback';
		$this->Email_Model->send_email($name,$subject,$email,$message_header,$messageval);
				 
				                   $data['status'] = "Valid Email";
                        $data['error_message'] = "Your Feedback Has Been sent to <br>our support Team";
                        echo json_encode($data);        
		
        
			
 	
 		}
 		
		function member_registration_ajax()
		{
			 $data['msg'] ="unscees";
			 
			$sal = '';
			$fnam = $_POST['fnam'];
			$lname = $_POST['lname'];
			
			if($_POST['password'] == '')
{
	$chars1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$pw3 = "";
		for ($i1 = 0; $i1 < 4; $i1++) {
			$pw3 .= $chars1[mt_rand(0, strlen($chars1)-1)];
		}	
		
}
else
{


			$pw3 = $_POST['password'];
}
			$email3 = $_POST['email'];
			$address = $_POST['address'];
			
			$phone = $_POST['phone'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$postal = $_POST['postal'];
			$domain = $this->domain_id;
		$Query="select * from  b2c  where email ='".$email3."' and  domain ='".$domain."'";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			 $res = $this
					  ->Account_Model
					  ->check_admin_login(
						 $email3, 
						 $pw3,
						 $domain
					  ); 


			 if ( $res !== false ) 
			 {
						$sessionUserInfo = array( 
						'b2c_id' 		=> $res->user_id,
						'b2c_email'	 			=> $res->email,
						'b2c_type' 		=> $res->usertype,
						'b2c_logged_in' 	=> TRUE,
						'b2c_firstname'  => $res->firstname,
						'b2c_lastname'  => $res->lastname,
						);
						$this->session->set_userdata($sessionUserInfo);
			 }
			
			
		}
		else
		{
		//	  echo 'asdas';exit;
	
	
		
    	
		    $image_path = '';
		 
			if($this->Account_Model->add_b2c_user($sal,$fnam,$lname,$pw3,$email3,$address,$phone,$city,$country,$postal,$domain,$image_path))
			{
					
				/****** EMAIL **********/	
				 $message = 'Your Account Has Been Activated. Please click the below link to SignIn your account<br><br>';

				 
				  $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			 <td rowspan="3"><img src="'.$image_path.'" width="100"></td>
	
			<td rowspan="3" align="left" valign="top">
			<strong>URL</strong> :'.WEB_HOTEL_URL.'b2c/login<br>
			<strong>Email</strong> : '.$email3.'<br>
			<strong>Password</strong> : '.$pw3.'<br>
			
			</td>
		 	</tr>
			</table>';
			
			
				 $message_header='User Login Acess';
				 $subject='DSS User Login Acess';
				 
				 $this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
		 		/****** EMAIL **********/
				 $data['msg'] = "Success";
                       					
			}
			

		
	  		
		}
		
		}
 			function Update_newsletter_email()
 	
 	   {
 	
 		$email = $this->input->post('emailval');
        $domain_id = $this->Account_Model->get_domain_list_id($this->domain);
        $insertval=$this->Account_Model->insert_newsletter_email($domain_id->domain_id,$email);  
  		 
		$data['status'] = "Valid Email";
		$data['error_message'] = "Email Update";
		echo json_encode($data);        
 	
 		}
 		
 		
 		function checkval()
 		{
 
 		if(!isset($_SESSION['track_setting']) || ($_SESSION['track_setting'] == false))
{

			$_SESSION['track_hostval']='Nil';
			$_SESSION['track_countryNameval']='United States';
			$_SESSION['track_countryCodeval']= 'US';
			$_SESSION['track_cityval']= 'New York';
			$_SESSION['track_regionval']='New York';
			$_SESSION['track_latitudeval']= '37.4192';
			$_SESSION['track_longitudeval']= '-122.0570';
			$_SESSION['track_currency']= 'SGD';
			$_SESSION['track_currency_value']= '1';
		

		
		if($_POST)
		{
			$_SESSION['track_setting'] = true;
	
			$_SESSION['track_hostval']= $this->input->post('host');
		
			$_SESSION['track_countryNameval']= $this->input->post('countryName');
	
			$_SESSION['track_countryCodeval']= $this->input->post('countryCode');
		
			$_SESSION['track_cityval']= $this->input->post('city');
		
			$_SESSION['track_regionval']= $this->input->post('region');
	
			$_SESSION['track_latitudeval']= $this->input->post('latitude');
		
			$_SESSION['track_longitudeval']= $this->input->post('longitude');
			
			// fetch currency
			
		$currencyval = $this->Account_Model->fetch_currency_value($_SESSION['track_countryCodeval']);
			
   if($currencyval)			
   {
   	
   	 	$_SESSION['track_currency']= $currencyval->country;
			 $_SESSION['track_currency_value']= $currencyval->value; 
   	
   	}
   	
   	
   	
   	
			
		}
		
		
		
  }
  
    $this->Account_Model->insert_tracking_detail($_POST);
  
  $data['hostval'] = $_SESSION['track_hostval'];
  $data['countryNameval'] = $_SESSION['track_countryNameval'];
  $data['countryCodeval'] = $_SESSION['track_countryCodeval'];
  $data['cityval'] = $_SESSION['track_cityval'];
  $data['regionval'] = $_SESSION['track_regionval'];
  $data['latitudeval'] = $_SESSION['track_latitudeval'];
  $data['longitudeval'] = $_SESSION['track_longitudeval'];
  	$data['currency']=  	$_SESSION['track_currency'];
  //$data['status'] = "Medicine Found";

  echo json_encode($data);
  
 			
 		}
	
function check_member_login()
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$this->db->select('*');
	$this->db->from('b2c');
	$this->db->where('email',$email);
	$this->db->where('password',$password);
	$this->db->where('domain',$this->domain_id);
	
	$query = $this->db->get();
		
	if($query->num_rows() == 0 )
	{
	   echo "0";
	}
	else
	{
		echo "1";
	}		
}	

function check_member_login_ajax()
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$this->db->select('*');
	$this->db->from('b2c');
	$this->db->where('email',$email);
	$this->db->where('password',$password);
	$this->db->where('domain',$this->domain_id);
	
	$query = $this->db->get();
		
	if($query->num_rows() == 0 )
	{
	  print json_encode(array(
					'status' => 0
			));exit;
	}
	else
	{
		$domain_id = $this->Account_Model->get_domain_list_id($this->domain);
		
			 $res = $this
					  ->Account_Model
					  ->check_admin_login(
						 $this->input->post('email'), 
						 $this->input->post('password'),
						 $domain_id->domain_id
					  ); 


			 if ( $res !== false ) 
			 {
				   
						$sessionUserInfo = array( 
						'b2c_id' 		=> $res->user_id,
						'b2c_email'	 			=> $res->email,
						'b2c_type' 		=> $res->usertype,
						'b2c_logged_in' 	=> TRUE,
						'b2c_firstname'  => $res->firstname,
						'b2c_lastname'  => $res->lastname,
						);
						$this->session->set_userdata($sessionUserInfo);
				
				//redirect($page_url,'refresh');
				print json_encode(array(
					'status' => 1,
				'email' => $res->email,
				'firstname' => $res->firstname,
				'lastname' => $res->lastname,
				'title' => $res->title,
				'ship_address' => $res->ship_address,
				'contact_no' => $res->contact_no,
				'city' => $res->city,
				'country' => $res->country,
				'postal_code' => $res->postal_code
				
			));exit;
			
	
			 }
			 else
			 {
			      print json_encode(array(
					'status' => 0
					));exit;
          	 }
		
	}		
}	

function check_member_login_ajax_id()
{
	$email = $_POST['email_id'];
	
	

		$domain_id = $this->Account_Model->get_domain_list_id($this->domain);
		
			 $res = $this
					  ->Account_Model
					  ->check_admin_login_id(
						 $this->input->post('email_id'), 
						 $domain_id->domain_id
					  ); 


			 if ( $res !== false ) 
			 {
				   
						$sessionUserInfo = array( 
						'b2c_id' 		=> $res->user_id,
						'b2c_email'	 			=> $res->email,
						'b2c_type' 		=> $res->usertype,
						'b2c_logged_in' 	=> TRUE,
						'b2c_firstname'  => $res->firstname,
						'b2c_lastname'  => $res->lastname,
						);
						$this->session->set_userdata($sessionUserInfo);
				
				//redirect($page_url,'refresh');
				print json_encode(array(
					'status' => 1,
				'email' => $res->email,
				'firstname' => $res->firstname,
				'lastname' => $res->lastname,
				'title' => $res->title,
				'ship_address' => $res->ship_address,
				'contact_no' => $res->contact_no,
				'city' => $res->city,
				'country' => $res->country,
				'postal_code' => $res->postal_code
				
			));exit;
			
	
			 }
			 else
			 {
			      print json_encode(array(
					'status' => 0
					));exit;
          	 }
		
		
}	

function check_agent_login()
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$this->db->select('*');
	$this->db->from('b2b');
	$this->db->where('email_id',$email);
	$this->db->where('password',$password);
	$this->db->where('domain',$this->domain_id);	
	
	$query = $this->db->get();
		
	if($query->num_rows() == 0 )
	{
	   echo "0";
	}
	else
	{
		echo "1";
	}		
}	

function agent_forgetpassword()
{
	$this->load->view('account/agent_forgetpassword');
}
	
function agent_passwordpage()
{
 	$email = $this->input->post('emailval');
 	$domain_id = $this->Account_Model->get_domain_list_id($this->domain);
	$res = $this->Account_Model->check_agent_logindetail($email,$domain_id->domain_id);  
if ( $res !== false ) 
{
			 	 
	$first_name=$res->name;
	$message = 'Check it your password below. Please click the below link to SignIn your account<br><br>';
	$message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			 <td rowspan="3"><img src="'.$res->agent_logo.'" width="100"></td>
			<td rowspan="3" align="left" valign="top">
			<strong>URL</strong> :'.WEB_CONCERT_URL.'<br>
			<strong>Email</strong> : '.$email.'<br>
			<strong>Password</strong> : '.$res->password.'<br>
			
			</td>
		 	</tr>
			</table>';
			
              
	$message_header='Forget Password';
	$subject='DSS User Login Acess';
				 
	$this->Email_Model->send_email($first_name,$subject,$email,$message_header,$message);
				 
	$data['status'] = "Valid Email";
    $data['error_message'] = "Your Password Has Been send to your mail";
    echo json_encode($data);                
}
else 
{
  $data['status'] = "Existing Email";
  $data['error_message'] = "Please enter the correct Email";
  echo json_encode($data);        	        
}
} 	

function member_registration($page_url='')
	{
			$data['PATH_INFO']=$page_url;

		if($page_url=='')
		{
				$page_url='home';

		}else
		{
		
			$page_url= strtr(base64_decode($page_url),array('.' => '+','-' => '=','~' => '/'));

		}
		//echo '<pre/>';
		//print_r($_POST);exit;
		$domain_id = $this->Account_Model->get_domain_list_id($this->domain);

		$this->form_validation->set_rules('fnam', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('email3', 'Email', 'required|valid_email');
		if($this->form_validation->run()==FALSE)
		{
	  		$data['status']='';
			$data['country'] = $this->Account_Model->get_country_list(); 
			$this->load->view('account/member_registration',$data);
		}
		else
		{
			$sal = '';
			$fnam = $_POST['fnam'];
			$lname = $_POST['lname'];
			$pw3 = $_POST['pw3'];
			$email3 = $_POST['email3'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$postal = $_POST['postal'];
			$domain = $domain_id->domain_id;
		$Query="select * from  b2c  where email ='".$email3."' and  domain ='".$domain."'";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$data['status'] = '<div class="alert alert-block alert-danger">
							 
							  <h4 class="alert-heading">Already Registered!</h4>
							  This Email Address Already Registered, kindly Use Another One !!!
							</div>';
			$data['country'] = $this->Account_Model->get_country_list(); 
			
			$this->load->view('account/member_registration',$data);
		}
		else
		{
		
		
			$image_path='';
			if($this->Account_Model->add_b2c_user($sal,$fnam,$lname,$pw3,$email3,$address,$phone,$city,$country,$postal,$domain,$image_path))
			{
					
				/****** EMAIL **********/	
				 $message = 'Your Account Has Been Activated. Please click the below link to SignIn your account<br><br>';

				 
				  $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			 <td rowspan="3"><img src="'.$image_path.'" width="100"></td>
	
			<td rowspan="3" align="left" valign="top">
			<strong>URL</strong> : '.site_url().'/b2c/login<br>
			<strong>Email</strong> : '.$email3.'<br>
			<strong>Password</strong> : '.$pw3.'<br>
			
			</td>
		 	</tr>
			</table>';
			
			
				 $message_header='User Login Acess';
				 $subject='DSS User Login Acess';
				 
				 $this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
		 		/****** EMAIL **********/
				//echo $page_url;exit;
				$data['status'] = '<div class="alert alert-block alert-danger">
							 <h4 class="alert-heading">Your Account Registered Successfully!</h4>
							 Kindly go to login page and enjoy it.
							</div>';
			$data['country'] = $this->Account_Model->get_country_list(); 
		
			$this->load->view('account/member_registration',$data);
			
					
			}
			else
			{
				$data['status'] = '<div class="alert alert-block alert-danger">
							 <h4 class="alert-heading">Already Registered!</h4>
							  This Email Address Already Registered, kindly Use Another One !!!
							</div>';
			$data['country'] = $this->Account_Model->get_country_list(); 
		
			$this->load->view('account/member_registration',$data);
			
			}


		
	  		
		}
		}
	}
	
	function agent_registration($page_url='')
	{
			$data['PATH_INFO']=$page_url;

		if($page_url=='')
		{
				$page_url='home';

		}else
		{
		
			$page_url= strtr(base64_decode($page_url),array('.' => '+','-' => '=','~' => '/'));

		}
		//echo '<pre/>';
	//	print_r($_POST);exit;
		$domain_id = $this->Account_Model->get_domain_list_id($this->domain);

		$this->form_validation->set_rules('fnam', 'First Name', 'required');
		$this->form_validation->set_rules('company', 'Company Name', 'required');
		$this->form_validation->set_rules('email3', 'Email', 'required|valid_email');
		if($this->form_validation->run()==FALSE)
		{
	  		$data['status']='';
			$data['country'] = $this->Account_Model->get_country_list(); 
			
			$this->load->view('account/agent_registration',$data);
		}
		else
		{
			$name = $_POST['fnam'];
			$pw3 = $_POST['pw3'];
			$email3 = $_POST['email3'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$postal = $_POST['postal'];
		
			$company = $_POST['company'];
			$office = $_POST['office'];
			
			$skype = $_POST['skype'];
			$b_type = $_POST['b_type'];
			$y_buss = $_POST['y_buss'];
			$iata = $_POST['iata'];
			
			
			$domain_id = $this->Account_Model->get_domain_list_id($this->domain);
			$domain = $domain_id->domain_id;
			
		$Query="select * from  b2b  where email_id ='".$email3."' and  domain ='".$domain."'";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$data['status'] = '<div class="alert alert-block alert-danger">
							 
							  <h4 class="alert-heading">Already Registered!</h4>
							  This Email Address Already Registered, kindly Use Another One !!!
							</div>';
			$data['country'] = $this->Account_Model->get_country_list(); 
			
			$this->load->view('account/agent_registration',$data);
		}
		else
		{
		//	  echo 'asdas';exit;
		//echo  ADMIN_UPLOAD_PATH.$domain.'/b2b/images';exit;
			$config['upload_path'] = ADMIN_UPLOAD_PATH.$domain.'/b2b/images';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());

			$data['status'] ='<div class="alert alert-block alert-danger">
							
							  <h4 class="alert-heading">Profile Photo!</h4>
							  '.$error['error'].'
							</div>';
			$data['country'] = $this->Account_Model->get_country_list(); 
		
			$this->load->view('account/agent_registration',$data);
		}
		else
		{
			$cc = $this->upload->data('file');
    	
		    $image_path = WEB_DIR_ADMIN.'upload_files/'.$domain.'/b2b/images/'.$cc['file_name'];
		 
			if($this->Account_Model->add_agent_user($name,$company,$office,$pw3,$email3,$address,$phone,$city,$country,$postal,$domain,$image_path,$skype,$b_type,$y_buss,$iata))
			{
					
				/****** EMAIL **********/	
				 $message = 'Your Agent Account Has Been Registered Successfully, Within 24 hours our support will contact you on email.!!!<br><br>';

				 
				  $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			 <td rowspan="3"><img src="'.$image_path.'" width="100"></td>
	
			<td rowspan="3" align="left" valign="top">
			<strong>URL</strong> :'.site_url().'/login/agent_login<br>
			<strong>Email</strong> : '.$email3.'<br>
			<strong>Password</strong> : '.$pw3.'<br>
			
			</td>
		 	</tr>
			</table>';
			
			
				 $message_header='Agent Login Registration';
				 $subject='DSS Agent Login Registration';
				 
				 $this->Email_Model->send_email($name,$subject,$email3,$message_header,$message);
		 		/****** EMAIL **********/
				$data['status'] = '<div class="alert alert-block alert-danger">
							 
							  <h4 class="alert-heading">Agent Registration!</h4>
							  Agent Registration Successfully Completed, Within 24 hours our support will contact you on email.!!!
							</div>';
			$data['country'] = $this->Account_Model->get_country_list(); 
		
			$this->load->view('account/agent_registration',$data);
					
			}
			else
			{
				$data['status'] = '<div class="alert alert-block alert-danger">
							 
							  <h4 class="alert-heading">Already Registered!</h4>
							  This Email Address Already Registered, kindly Use Another One !!!
							</div>';
			$data['country'] = $this->Account_Model->get_country_list(); 
		
			$this->load->view('account/agent_registration',$data);
			
			}


		}
	
	  		
		}
		}
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

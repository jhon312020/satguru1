<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct()
	{
		parent::__construct();
		$this->domain = "DSS";
		$this->load->model('Account_Model');
		$this->load->model('Useraccount_Model');
		$this->load->model('Email_Model');
		$this->domain_id=1;
			  $this->check_isvalidated();	

	}
	 private function check_isvalidated(){
		
		if(! $this->session->userdata('b2c_id') )
	   {
		       redirect('home');
       }
		
		
		
    }
	function mybooking()
	{
		if($this->session->userdata('b2c_id'))
		{
			$b2c_type = $this->session->userdata('b2c_type');
			$b2c_id = $this->session->userdata('b2c_id');
		}
		
			 $fromdate = '';
			if(isset($_POST['from'])  && $_POST['from']!='')
			{
				$from_d = explode("-",$_POST['from']);
				 $fromdate = $from_d[2].'-'.$from_d[1].'-'.$from_d[0];
			}
			
			 $todate = '';
			if(isset($_POST['ed'])  && $_POST['ed']!='')
			{

				 $todates = explode("-",$_POST['ed']);
				 $todate = $todates[2].'-'.$todates[1].'-'.$todates[0];

			}
			
			 $pnrno = '';
			if(isset($_POST['pnrno']))
			{
				 $pnrno = $_POST['pnrno'];
			}
			
			 $tripid = '';
			if(isset($_POST['tripid']))
			{
				 $tripid = $_POST['tripid'];
			}
			
			 $service_type = '';
			if(isset($_POST['service_type']))
			{
				 $service_type = $_POST['service_type'];
			}
			$data['fromdate']=$fromdate;
			$data['todate']=$todate;
			$data['pnrno']=$pnrno;
			$data['tripid']=$tripid;
			$data['service_type']=$service_type;
			$data['result_upcoming'] = $this->Useraccount_Model->get_upcoming_list($b2c_id,$b2c_type,$this->domain_id,$fromdate,$todate,$pnrno,$tripid,$service_type); 
	
		
			
			$data['result_complete'] = $this->Useraccount_Model->get_cancel_list_recent($b2c_id,$b2c_type,$this->domain_id,$fromdate,$todate,$pnrno,$tripid,$service_type); 
			
		//echo '<pre/>';
		//print_r($data);exit;
		
		$this->load->view('account/my_account',$data);
	}
	
	
	
	
	
	function myprofile()
	{
		if($this->session->userdata('b2c_id'))
		{
			$b2c_type = $this->session->userdata('b2c_type');
			$b2c_id = $this->session->userdata('b2c_id');
		}
		
			$data['custdet'] = $this->Account_Model->get_member_info($b2c_id); 
		
		$this->load->view('account/my_profile',$data);
	}
	function edit_profile()
	{
		if($this->session->userdata('b2c_id'))
		{
			$b2c_type = $this->session->userdata('b2c_type');
			$b2c_id = $this->session->userdata('b2c_id');
		}
		
			$data['custdet'] = $this->Account_Model->get_member_info($b2c_id); 
		   $data['country'] = $this->Account_Model->get_country_list();
		$this->load->view('account/edit_profile',$data);
	}
	 function edit_myprofile() {
		
       if($this->session->userdata('b2c_id'))
		{
			$b2c_type = $this->session->userdata('b2c_type');
			$b2c_id = $this->session->userdata('b2c_id');
		}
		
        $firstname = mysql_real_escape_string($this->input->post('firstname'));
        $lastname = mysql_real_escape_string($this->input->post('lastname'));
        $address = mysql_real_escape_string($this->input->post('address'));
        $city = $this->input->post('city');
     
        $zip = $this->input->post('zip');
        $country = $this->input->post('country');
       
	   
        $mobile = $this->input->post('mobile');
	
        $this->Account_Model->user_profile_step1_all($b2c_id,  $firstname, $lastname, $address, $city, $zip, $country,$mobile);
		
        redirect('account/edit_profile','refresh');
    }
	function change_pwd()
	{
		
		if($this->session->userdata('b2c_id'))
		{
			$b2c_type = $this->session->userdata('b2c_type');
			$b2c_id = $this->session->userdata('b2c_id');
		}
		
			$data['custdet'] = $this->Account_Model->get_member_info($b2c_id); 
		  
        $this->load->view('account/change_pwd', $data);
		
		
		
	}
	function forget_password()
	{
	
        $this->load->view('account/forget_password');
		
	}
	function forget_password_process()
	{
		$email3 = $this->input->post('email');
		$domain = $this->domain_id;
			$Query="select * from  b2c  where email ='".$email3."' and  domain ='".$domain."'";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$result = $query->row();
				   
				
					 $message ='<table width="100%" border="0" cellspacing="5" cellpadding="5">
					 
					 <tr>
					 <td  align="left" valign="top">
					  This is to inform you that an login details of your account .<br><br>
					 </td>
					 <tr>
   			
			<td  align="left" valign="top">
			<strong><u>Login Details </u></strong><br><br>
			<strong>Login Url </strong> : '.site_url().'/login/member_login <br>
			<strong>Username </strong> : '.$result->email.' <br>
			<strong>Password </strong> : '.$result->password.' <br>
			</td>
		 	</tr>
			</table>'; 
				 $message_header='Forget Password';
				 $subject='DSS - Forget Password';
				$fnam = $result->firstname;
				 $this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
				 $data['x'] = 'Password has been sent to your Email-Id !.';
				    $this->load->view('account/forget_password',$data);
				 
		}
		else
		{
			 $data['x'] = 'Email-Id is wrong !.';
				    $this->load->view('account/forget_password',$data);
			
		}
			
	}
	function change_cust_pwd()
	{
		 $new_pwd = $this->input->post('new_pwd');
		 $cnew_pwd = $this->input->post('cnew_pwd');
		 $pres_pwd = $this->input->post('pres_pwd');
		     $customer_id = $this->session->userdata('b2c_id');
			 
		 	$check_pwd = $this->Account_Model->check_b2c_login($customer_id,$pres_pwd,$this->domain_id); 
		  
		  if($new_pwd == $cnew_pwd)
		  {
     if($check_pwd=='ok')
	 {
		 
		
			$data_x = array('password'=>$new_pwd);
			$this->db->where('user_id',$customer_id);
			$this->db->update('b2c',$data_x);
			
			
			$data['status']='Password Changed Successfully';
	 }
	 else
	 {
		 	$data['status']='Old Password Was Wrong';
	 }
		  }
		  else
		  {
			  	$data['status']='Confirm Password Is Wrong';
		  }
        	if($this->session->userdata('b2c_id'))
		{
			$b2c_type = $this->session->userdata('b2c_type');
			$b2c_id = $this->session->userdata('b2c_id');
		}
		
			$data['custdet'] = $this->Account_Model->get_member_info($b2c_id); 
		  
        $this->load->view('account/change_pwd', $data);
		
	}
	   function mycancellation() {
		   
		   if($this->session->userdata('b2c_id'))
		{
			$b2c_type = $this->session->userdata('b2c_type');
			$b2c_id = $this->session->userdata('b2c_id');
		}
		
		
			if(isset($this->input->post))
			{
		 $data['fromdate'] = $fromdate = $this->input->post('from');
        $data['todate'] = $todate = $this->input->post('ed');
        $data['pnrno'] = $pnrno = $this->input->post('pnrno');
        $data['tripid'] = $tripid = $this->input->post('tripid');
		$data['service_type'] = $service_type = $this->input->post('service_type');
			}
			else
			{
			 $data['fromdate'] = $fromdate = '';
        $data['todate'] = $todate = '';
        $data['pnrno'] = $pnrno = '';
        $data['tripid'] = $tripid ='' ;
		$data['service_type'] = $service_type = '';	
			}
			$data['result_cancel'] = $this->Useraccount_Model->get_cancel_list($b2c_id,$b2c_type); 
	
		
			
			
			
        $this->load->view('account/mycancellation',$data);
    }
	
		

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class B2b_account extends CI_Controller {

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
		
		if(! $this->session->userdata('b2b_id'))
	   {
		       redirect('home');
       }
		
		
		
    }
function myaccount()
	{
		if($this->session->userdata('b2b_id'))
		{
			$b2c_type = $this->session->userdata('b2b_type');
			$b2c_id = $this->session->userdata('b2b_id');
			
			$data['profile'] = $this->Account_Model->get_agent_info($this->session->userdata('b2b_id'));

			$data['deposit'] = $this->Account_Model->get_deposit_amount($this->session->userdata('b2b_id')); 
	
			$this->load->view('account/b2b/my_account',$data);
		}
	}
	function mybooking()
	{
		if($this->session->userdata('b2b_id'))
		{
			$b2b_type = $this->session->userdata('b2b_type');
			$b2b_id = $this->session->userdata('b2b_id');
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
			$data['result_upcoming'] = $this->Useraccount_Model->get_upcoming_list($b2b_id,$b2b_type,$this->domain_id,$fromdate,$todate,$pnrno,$tripid,$service_type); 
	
		
		
			
		//echo '<pre/>';
		//print_r($data);exit;
		
		$this->load->view('account/b2b/my_booking',$data);
	}
	function b2b_edit_profile()
	{
		 if($this->session->userdata('b2b_id'))
		{
			$b2b_type = $this->session->userdata('b2b_type');
			$b2b_id = $this->session->userdata('b2b_id');
		}
		
		
			$data['custdet'] = $this->Account_Model->get_agent_info($b2b_id); 
		   $data['country'] = $this->Account_Model->get_country_list();
		$this->load->view('account/b2b/edit_profile',$data);
	}
	function edit_myprofile_v1()
	{
		
		 if($this->session->userdata('b2b_id'))
		{
			$b2b_type = $this->session->userdata('b2b_type');
			$b2b_id = $this->session->userdata('b2b_id');
		}
		
        $firstname = mysql_real_escape_string($this->input->post('firstname'));
        
        $address = mysql_real_escape_string($this->input->post('address'));
        $city = $this->input->post('city');
      $company_name = mysql_real_escape_string($this->input->post('company_name'));
        $zip = $this->input->post('zip');
        $country = $this->input->post('country');
       
	     $skype_id = $this->input->post('skype_id');
        $mobile = $this->input->post('mobile');
	 $office_phone = $this->input->post('office_phone');
        $this->Account_Model->user_profile_step1_all_b2b($b2b_id,  $firstname, $office_phone, $address, $city, $zip, $country,$mobile,$company_name,$skype_id);
		
        redirect('b2b_account/b2b_edit_profile','refresh');
	}
	function add_deposit_amount()
	{
$b2c_type = $this->session->userdata('b2b_type');
			$b2b_id = $this->session->userdata('b2b_id');
			
  $user = $this->Useraccount_Model->get_agent_list_id($b2b_id); 
  	$deposit = $this->Useraccount_Model->get_deposit_amount($b2b_id); 

		$email3 = $user->email_id;
		$fnam = $user->name;
		$password = $user->password;
		$photo= $user->agent_logo;
		$old_balance =$deposit->balance_credit;
		
		$amount_credit = $_POST['amount'];
		$deposited_date = $_POST['deposited_date'];
		$remarks = $_POST['remarks'];
		
		$trans_id =$this->Useraccount_Model->add_agent_deposit($b2b_id, $amount_credit, $deposited_date, $remarks);
if ($trans_id!='')
			{
				    $message = '  This is to inform you that an amount of '.$amount_credit.' SGD has been send to admin  .<br><br>
					Your Tranasction-Id is '.$trans_id.'<br><br>
					';
				
					 $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			
			<td rowspan="3" align="left" valign="top">
			<strong>Deposit Details </strong><br><br>
			<strong>Old Balance </strong> : '.$old_balance.' SGD<br>
			<strong>Deposit Amount</strong> : '.$amount_credit.' SGD<br>
			<br>
			
			</td>
		 	</tr>
			</table>'; 
				 $message_header='Amount Requested To DSS';
				 $subject='DSS - Your Deposit Amount Still Processing...';
			
				 $this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
				 
				 
				redirect('b2b_account/deposit/'.$b2b_id.'/1','refresh');
			}
			else
			{
				redirect('b2b_account/deposit/'.$b2b_id.'/2','refresh');
			}
	}
	function add_deposit()
	{
		$b2c_type = $this->session->userdata('b2b_type');
		$b2c_id = $this->session->userdata('b2b_id');
		
		$data['id']=$b2c_id;

		$data['deposit'] = $this->Useraccount_Model->agent_deposit_details($b2c_id); 
		
		$this->load->view('account/b2b/add_deposit',$data);
	}
	function add_markup_v1()
	{
		$markup = $_POST['markup'];
		$b2b_id = $this->session->userdata('b2b_id');
		$row = array(
				"markup" => $markup
			);
			
			$this->db->where('agent_id', $b2b_id);
			
			$this->db->update('b2b', $row); 
		redirect('b2b_account/add_markup','refresh');
	}
	function add_markup()
	{
		
		
			$b2c_type = $this->session->userdata('b2b_type');
		$b2c_id = $this->session->userdata('b2b_id');
		
		$data['id']=$b2c_id;

		$data['agent'] = $this->Account_Model->get_agent_info($b2c_id); 
		
		$this->load->view('account/b2b/add_markup',$data);
	}
	function deposit()
	{
		
		$b2c_type = $this->session->userdata('b2b_type');
		$b2c_id = $this->session->userdata('b2b_id');
		
		$data['deposit'] = $this->Useraccount_Model->agent_deposit_details($b2c_id); 
		$data['deposit_amount'] = $this->Useraccount_Model->get_deposit_amount($b2c_id); 
		
		$data['id']=$b2c_id;
		$data['status']='';

//echo '<pre/>';
//print_r($data);exit;
		$this->load->view('account/b2b/agent_deposit_view',$data);
		
		
	}

	 function mycancellation() {
		   
		   if($this->session->userdata('b2b_id'))
		{
			$b2b_type = $this->session->userdata('b2b_type');
			$b2b_id = $this->session->userdata('b2b_id');
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
			$data['result_cancel'] = $this->Useraccount_Model->get_cancel_list($b2b_id,$b2b_type); 
	
		
			
			
			
        $this->load->view('account/b2b//mycancellation',$data);
    }
	
	function change_pwd()
	{
		
		if($this->session->userdata('b2b_id'))
		{
			$b2b_type = $this->session->userdata('b2b_type');
			$b2b_id = $this->session->userdata('b2b_id');
		}
		
			$data['custdet'] = $this->Account_Model->get_agent_info($b2b_id); 
		  
        $this->load->view('account/b2b/change_pwd', $data);
		
		
		
	}
	function change_cust_pwd()
	{
		 $new_pwd = $this->input->post('new_pwd');
		 $cnew_pwd = $this->input->post('cnew_pwd');
		 $pres_pwd = $this->input->post('pres_pwd');
		     $customer_id = $this->session->userdata('b2b_id');
			 
		 	$check_pwd = $this->Account_Model->check_b2b_login($customer_id,$pres_pwd,$this->domain_id); 
		  
		  if($new_pwd == $cnew_pwd)
		  {
     if($check_pwd=='ok')
	 {
		 
		
			$data_x = array('password'=>$new_pwd);
			$this->db->where('agent_id',$customer_id);
			$this->db->update('b2b',$data_x);
			
			
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
        	if($this->session->userdata('b2b_id'))
		{
			$b2b_type = $this->session->userdata('b2b_type');
			$b2b_id = $this->session->userdata('b2b_id');
		}
		
			$data['custdet'] = $this->Account_Model->get_agent_info($b2b_id); 
		  
        $this->load->view('account/b2b/change_pwd', $data);
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

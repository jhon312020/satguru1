<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deposit extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Admin_Model');
	  $this->load->model('B2b_Model');
	    $this->load->model('Deposit_Model');
	   
	     $this->load->model('Email_Model');
	     $this->load->model('Home_Model');
	  $this->check_isvalidated();	
   		$this->load->library('form_validation');
		
	  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
	  
    }
	 private function check_isvalidated(){
		
		if(! $this->session->userdata('admin_logged_in') && !$this->session->userdata('admin_id'))
	   {
		       redirect('login/index');
       }
		
		
		
    }
	
	public function agent_deposit_view($id,$status='')
	{
		$data['user'] = $this->B2b_Model->get_agent_list_id($id); 
		$data['deposit'] = $this->Deposit_Model->agent_deposit_details($id); 
		$data['deposit_amount'] = $this->B2b_Model->get_deposit_amount($id); 
		
		$data['id']=$id;
		$data['status']=$status;
		//echo '<pre/>';
		//print_r($data);exit;
		$this->load->view('b2b/agent_deposit_view',$data);
	}
		public function agent_deposit_overall_view()
	{
		//$data['user'] = $this->B2b_Model->get_agent_list(); 
		$data['deposit'] = $this->Deposit_Model->agent_deposit_details_overall(); 
		//$data['deposit_amount'] = $this->B2b_Model->get_deposit_amount($id); 
		
		
		//echo '<pre/>';
		//print_r($data);exit;
		$this->load->view('b2b/agent_deposit_view_overall',$data);
	}
	function add_deposit($id)
	{
		
		$data['id']=$id;
		$data['user'] = $this->B2b_Model->get_agent_list_id($id); 
		$data['deposit'] = $this->Deposit_Model->agent_deposit_details($id); 
		$this->load->view('b2b/add_deposit',$data);
	}
	function add_deposit_amount($id)
	{

  $user = $this->B2b_Model->get_agent_list_id($id); 
  	$deposit = $this->B2b_Model->get_deposit_amount($id); 

		$email3 = $user->email_id;
		$fnam = $user->name;
		$password = $user->password;
		$photo= $user->agent_logo;
		$old_balance =$deposit->balance_credit;
		
		$amount_credit = $_POST['amount'];
		$deposited_date = $_POST['deposited_date'];
		$remarks = $_POST['remarks'];
		
		$trans_id =$this->Deposit_Model->add_agent_deposit($id, $amount_credit, $deposited_date, $remarks);
if ($trans_id!='')
			{
				    $message = '  This is to inform you that an amount of '.$amount_credit.' SGD has been debited from your agent account .<br><br>
					Your Tranasction-Id is '.$trans_id.'<br><br>
					';
				
					 $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			
			<td rowspan="3" align="left" valign="top">
			<strong>Deposit Details </strong><br><br>
			<strong>Old Balance </strong> : '.$old_balance.' SGD<br>
			<strong>Deposit Amount</strong> : '.$amount_credit.' SGD<br>
			--------------------------------------------------<br>
			<strong>Current Balance</strong> : '.($old_balance+$amount_credit).' SGD<br>
			
			</td>
		 	</tr>
			</table>'; 
				 $message_header='Amount Deposited';
				 $subject='DSS - Your Amount Deposited';
			
				 $this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
				 
				 
				redirect('deposit/agent_deposit_view/'.$id.'/1','refresh');
			}
			else
			{
				redirect('deposit/agent_deposit_view/'.$id.'/2','refresh');
			}
	}
	function update_deposit_status($id,$status,$agent_id)
	{
						
		 $user = $this->B2b_Model->get_agent_list_id($agent_id); 
  	$deposit = $this->B2b_Model->get_deposit_amount($agent_id); 
		$deposit_det = $this->Deposit_Model->get_deposit_details($id); 

		$email3 = $user->email_id;
		$fnam = $user->name;
		$password = $user->password;
		$photo= $user->agent_logo;
		$amount =$deposit_det->amount_credit;
		$cur_amount =$deposit->balance_credit;
		$trans_id = $deposit_det->transaction_id;
		
		
		
		if ($this->Deposit_Model->update_deposit_status($id,$status,$agent_id,$amount))
			{
				
				if($status=='Accepted')
				{
				    $message = 'Your deposit requet has been accepted by admin. This is to inform you that an amount of '.$amount.' SGD has been debited from your agent account. <br><br>
					Your Tranasction-Id is '.$trans_id.'<br><br>
					';
					 $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			
			<td rowspan="3" align="left" valign="top">
			<strong>Deposit Details </strong><br><br>
			<strong>Old Balance </strong> : '.$cur_amount.' SGD<br>
			<strong>Deposit Amount</strong> : '.$amount.' SGD<br>
			--------------------------------------------------<br>
			<strong>Current Balance</strong> : '.($cur_amount+$amount).' SGD<br>
			
			</td>
		 	</tr>
			</table>'; 
				 $message_header='Deposit Request Accepted';
				 $subject='DSS - Your Deposit Request Accepted '.$trans_id;
				// echo $subject;exit;
				}
				if($status=='Pending')
				{
				    $message = 'This is to inform you that an amount of '.$amount.' SGD has not been debited from your agent account . Still the transaction status pending. Kindly contact to admin.<br><br>	Your Tranasction-Id is '.$trans_id.'<br><br>';
				
					 $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			
			<td rowspan="3" align="left" valign="top">
			<strong>Deposit Details </strong><br><br>
			
			<strong>Current Balance</strong> : '.$cur_amount.' SGD<br>
			
			</td>
		 	</tr>
			</table>'; 
			 $message_header='Deposit Request Still Pending';
				 $subject='DSS - Your Deposit Request Still Pending '.$trans_id;
				 
				
				}
				if($status=='Cancelled')
				{
				    $message = 'This is to inform you that an amount of '.$amount.' SGD has not been debited from your agent account . Your transaction Cancelled. Kindly contact to admin.<br><br>	Your Tranasction-Id is '.$trans_id.'<br><br>';
				
					 $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			
			<td rowspan="3" align="left" valign="top">
			<strong>Deposit Details </strong><br><br>
			
			<strong>Current Balance</strong> : '.$cur_amount.' SGD<br>
			
			</td>
		 	</tr>
			</table>'; 
			 $message_header='Deposit Request Cancelled';
				 $subject='DSS - Your Deposit Request Cancelled '.$trans_id;
				 
				
				}
				
				 $this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
				 
				
				redirect('deposit/agent_deposit_view/'.$agent_id.'/1','refresh');
			}
			else
			{
								
				redirect('deposit/agent_deposit_view/'.$agent_id.'/2','refresh');
			}

	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
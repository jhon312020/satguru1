<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class B2b extends CI_Controller {

public function __construct()
   {
	parent::__construct();
	$this->load->model('Home_Model');
	$this->load->model('Admin_Model');
	$this->load->model('B2b_Model');
	$this->load->model('Email_Model');
	
		  $this->check_isvalidated();	



	$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	$this->output->set_header('Pragma: no-cache');
	$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}
	 private function check_isvalidated(){
		
		if(! $this->session->userdata('admin_logged_in') && !$this->session->userdata('admin_id'))
	   {
		       redirect('login/index');
       }
		
		
		
    }
	
	
	function activeb2blist()
	{
			$admin_id = $this->session->userdata('admin_id');
			
			$status = 1;
			$data['page_header'] = 'B2B Active List';
			$data['cus_list'] = $this->B2b_Model->b2blist($status);
			//echo '<pre/>';
			//print_r($data);exit;
			$this->load->view('b2b/b2blist',$data);
		
	}
	function change_b2buser_status($id,$change_status)
	{
			$user_details = $this->B2b_Model->get_agent_list_id($id);
			$photo = $user_details->agent_logo;
			$email3 =  $user_details->email_id;
			$fnam =  $user_details->name  ;
			if($change_status == 1)
			{
				$status = 0;
				$this->B2b_Model->update_b2b_status($id,$status);
				
						 $message = 'Your Agent Account Has Been Inactive. Please Contact Admin<br><br>';
				
					 $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			 <td rowspan="3"><img src="'.$photo.'" width="100"></td>
	
			<td rowspan="3" align="left" valign="top">
			<strong>Email</strong> : '.$email3.'<br>
			<strong>Name</strong> : '.$fnam.'<br>
			
			</td>
		 	</tr>
			</table>'; 
				 $message_header='Inactive';
				 $subject='DSS - Your Agent Account Inactivated';
			
				 $this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
				redirect('b2b/inactiveb2blist','refresh');
			}
			else
			{
				$status = 1;
				$this->B2b_Model->update_b2b_status($id,$status);
						 $message = 'Your Agent Account Has Been Active.<br><br>';
				
					 $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			 <td rowspan="3"><img src="'.$photo.'" width="100"></td>
	
			<td rowspan="3" align="left" valign="top">
			<strong>Email</strong> : '.$email3.'<br>
			<strong>Name</strong> : '.$fnam.'<br>
			
			</td>
		 	</tr>
			</table>'; 
				 $message_header='Active';
				 $subject='DSS - Your Agent Account Activated';
			
				 $this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
				redirect('b2b/activeb2blist','refresh');
			}
			
		
	}
	function inactiveb2blist()
	{
			$admin_id = $this->session->userdata('admin_id');
			
			$status = 0;
			$data['page_header'] = 'B2B InActive List';
			$data['cus_list'] = $this->B2b_Model->b2blist($status);
	
			//echo '<pre/>';
			//print_r($data);exit;
			$this->load->view('b2b/b2blist',$data);
		
	}
	function delete_b2buser($id)
	{
		
		
			$user_details = $this->B2b_Model->get_agent_list_id($id);
			$photo = $user_details->agent_logo;
			$email3 =  $user_details->email_id;
			$fnam =  $user_details->name  ;
			
				$wheres = "agent_id = $id";
				$this->db->delete('b2b', $wheres);
				$this->db->delete('b2b_acc_info', $wheres);
				$this->db->delete('b2b_deposit', $wheres);
				$this->db->delete('b2b_top_cities', $wheres);
					$user_details = $this->B2b_Model->get_agent_list_id($id);
			 $message = 'Your Agent Account Has Been Closed. Please Contact Admin<br><br>';
				
					 $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			 <td rowspan="3"><img src="'.$photo.'" width="100"></td>
	
			<td rowspan="3" align="left" valign="top">
			<strong>Email</strong> : '.$email3.'<br>
			<strong>Name</strong> : '.$fnam.'<br>
			
			</td>
		 	</tr>
			</table>'; 
				 $message_header='Closed';
				 $subject='DSS - Your Agent Account Closed';
			
				 $this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
				 
				redirect('b2b/activeb2blist','refresh');
		
	}
	function edit_b2buser($user_id)
	{
		
			$data['user_details'] = $this->B2b_Model->get_agent_list_id($user_id);
			$admin_id = $this->session->userdata('admin_id');
					
			$this->load->view('b2b/edit_b2b',$data);
	
	}
	function update_agent($id)
	{
		
				$name = $_POST['name'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$postal = $_POST['postal'];
			
			$company = $_POST['company'];
			$office = $_POST['office'];
			
			if($this->B2b_Model->update_b2b_agent($id,$name,$address,$phone,$city,$country,$postal,$company,$office))
			{
						redirect('b2b/edit_b2buser/'.$id,'refresh');
			}
			else
			{
					redirect('b2b/edit_b2buser/'.$id,'refresh');
			}
	}
	function add_agent()
	{
		$data['status']='';
			$data['country'] = $this->Home_Model->get_country_list(); 
			
			$this->load->view('b2b/add_agent',$data);
			
	}
	function add_agent_v1()
	{
	
			$name = $_POST['fnam'].' '.$_POST['lname'];
			$pw3 = $_POST['pw3'];
			$email3 = $_POST['email3'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$postal = $_POST['postal'];
$domain =1; 
			$company = $_POST['company'];
			$office = $_POST['office'];
			
			
			
		$Query="select * from  b2b  where email_id ='".$email3."' ";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">Close</a>
							  <h4 class="alert-heading">Already Registered!</h4>
							  This Email Address Already Registered, kindly Use Another One !!!
							</div>';
			$data['country'] = $this->Home_Model->get_country_list(); 
			$this->load->view('b2b/add_agent',$data);
		}
		else
		{
		//	  echo 'asdas';exit;
			$config['upload_path'] = ADMIN_UPLOAD_PATH.$domain.'/b2b/images';
			
		
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('file'))
		{
			
			$error = array('error' => $this->upload->display_errors());

			$data['status'] ='<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">Close</a>
							  <h4 class="alert-heading">Agent Logo!</h4>
							  '.$error['error'].'
							</div>';
			$data['country'] = $this->Home_Model->get_country_list(); 
			
			$this->load->view('b2b/add_agent',$data);
		}
		else
		{
			
			$cc = $this->upload->data('file');
    		$image_path = base_url().'upload_files/'.$domain.'/b2b/images/'.$cc['file_name'];
		 
			if($this->B2b_Model->add_agent_user($name,$company,$office,$pw3,$email3,$address,$phone,$city,$country,$postal,$domain,$image_path))
			{
					 $message = 'Your Agent Account Has Been Activated. Please click the below link to SignIn your account<br><br>';

				 
				  $message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
   			 <td rowspan="3"><img src="'.$image_path.'" width="100"></td>
	
			<td rowspan="3" align="left" valign="top">
			<strong>URL</strong> :'.WEB_URL.'b2b/login<br>
			<strong>Email</strong> : '.$email3.'<br>
			<strong>Password</strong> : '.$pw3.'<br>
			
			</td>
		 	</tr>
			</table>';
			
			
				 $message_header='Agent Login Acess';
				 $subject='DSS Agent Login Acess';
				 
				 $this->Email_Model->send_email($name,$subject,$email3,$message_header,$message);
				 
					redirect('b2b/activeb2blist','refresh');
			}
			else
			{
			$data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">Close</a>
							  <h4 class="alert-heading">Already Registered!</h4>
							  This Email Address Already Registered, kindly Use Another One !!!
							</div>';
			$data['country'] = $this->Home_Model->get_country_list(); 
			$this->load->view('b2b/add_agent',$data);
			
			}


		}
	
	  		
		}
		
	}
	function b2bmarkup()
	{
		
			$data['agent'] = $this->B2b_Model->getAllAgent_new();
			$data['api'] = $this->Home_Model->getapidetails(1);
			$data['countries'] = $this->Home_Model->get_country_list();
			
			$data['b2b_markup_g'] = $this->B2b_Model->get_b2b_markup(1);
			$data['b2b_markup_s'] = $this->B2b_Model->get_b2b_markup(2);
			//echo '<pre/>';
			//print_r($data);exit;
			$this->load->view('b2b/b2b_markup',$data);
	}
	function b2bmarkupinsert($val='')
	{

		if($this->input->post('markup') != '0' && $this->input->post('markup') != '')
		{
			$api = $this->input->post('api');
			$agent = $this->input->post('agent');
			$markup = $this->input->post('markup');
			$product_type = 1;
			$this->B2b_Model->b2bmarkupinsert($api,$markup,$product_type,$agent);
		}
			redirect('b2b/b2bmarkup/'.$val,'refresh');
	
	}
	function b2bmarkupinsertcountry($val='')
	{
			if($this->input->post('markup_country') != '0' && $this->input->post('markup_country') != '' && $this->input->post('country_name') != '')
		{
			$api = $this->input->post('api_country');
			$markup = $this->input->post('markup_country');
			$agent = $this->input->post('agent');
			$country_name = $this->input->post('country_name');
			$product_type = 2;
		
			$this->B2b_Model->b2bmarkupinsertcountry($api,$markup,$val,$country_name,$product_type,$agent);
		}
			redirect('b2b/b2bmarkup/'.$val,'refresh');
		
		
	}
		
	function delete_markup($id,$val='')
	{
					
			$this->B2b_Model->delete_b2b_markup($id);
			redirect('b2b/b2bmarkup/'.$val,'refresh');
		
	}
	
	function b2breports_hotel($val='')
	{
		
			$admin_id = $this->session->userdata('admin_id');
			
			if($val == '1')
			{
				$data['page_header'] = 'Agent Reports';
			}
			else
			{
				$data['page_header'] = 'Agent Reports';
			}
			$data['hotel'] = $this->B2b_Model->gethotelreports2(1);
			
			$data['s_api_status'] = $this->B2b_Model->get_booking_api_status();
			$data['s_booking_status'] = $this->B2b_Model->get_booking_status();
			$data['s_transaction_status'] = $this->B2b_Model->get_transaction_status();
			$data['agent'] = $this->B2b_Model->getAllAgent_new();
			$this->load->view('b2b/reports/b2breports_hotel',$data);
		
	}
	
	function b2b_reports_search()
	{
	
	$fromdate= $_POST['fromdate'];
	$booking_status= $_POST['booking_status'];
	$pnr= $_POST['pnr'];
	$booking_no= $_POST['booking_no'];
	$emailid= $_POST['emailid'];
	$todate= $_POST['todate'];
	$api_status= $_POST['api_status'];
	$agentid= $_POST['agent'];
	$leadpax= $_POST['leadpax'];
	$payment_status= $_POST['payment_status'];
			
			$this->db->select('*');
			$this->db->from('booking_global');
			if($fromdate!='')
			{
			$fromdate_ = explode("/",$fromdate);
			$fromdate = $fromdate_[2].'-'.$fromdate_[0].'-'.$fromdate_[1];
			$this->db->where('voucher_date >=',$fromdate);
			}
			if($booking_status!='')
			{
			$this->db->where('booking_status',$booking_status);
			}
			if($pnr!='')
			{
			$this->db->where('pnr_no',$pnr);
			}
			if($agentid!='')
			{
			$this->db->where('user_id',$agentid);
			$this->db->where('user_type',2);
			}
			if($booking_no!='')
			{
			$this->db->where('booking_no',$booking_no);
			}
			if($emailid!='')
			{
			$this->db->where('useremail',$emailid);
			}
			if($todate!='')
			{
			$todate_ = explode("/",$todate);
			$todate = $todate_[2].'-'.$todate_[0].'-'.$todate_[1];
			$this->db->where('voucher_date <=',$todate);
			}
			if($api_status!='')
			{
			$this->db->where('api_status',$api_status);
			}
			if($leadpax!='')
			{
			$this->db->like('leadpax',$leadpax);
			}
			if($payment_status!='')
			{
			$this->db->where('transaction_status',$payment_status);
			}
			
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() > 0)
			{
			 $data['hotel'] =  $query->result();
			}
			else
			{
			$data['hotel'] =  '';
			}
			$data['page_header'] = 'Agent Reports';
			$data['s_api_status'] = $this->B2b_Model->get_booking_api_status();
			$data['s_booking_status'] = $this->B2b_Model->get_booking_status();
			$data['s_transaction_status'] = $this->B2b_Model->get_transaction_status();
			$this->load->view('b2b/reports/b2breports_hotel',$data);
			
	}
	function b2b_voucher($parent_pnr_no)
	{
	
		$data['parent_no'] = $parent_pnr_no; 
		$data['result']=$this->B2b_Model->get_reservation_details_id($parent_pnr_no);
		$data['hotel_result']=$this->B2b_Model->get_reservation_details_hotel($data['result']->product_id);
		
		$this->load->view('b2b/reports/voucher',$data);
	
	}

}?>

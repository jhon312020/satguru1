<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class B2c extends CI_Controller {

public function __construct()
   {
	parent::__construct();
	$this->load->model('Home_Model');
	$this->load->model('Admin_Model');
	$this->load->model('B2c_Model');
	
	
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
	function b2cregistration()
	{
		 
			$admin_id = $this->session->userdata('admin_id');
			
			$this->load->view('b2c/b2cregistration',$data);
			
		
	}
	
	function b2creginsert()
	{
			 
			$check_b2b_user = $this->B2c_Model->check_b2c_user($this->input->post('email_id'));
			if($check_b2b_user == 1)
			{
				$admin_id = $this->session->userdata('admin_id');
				
				$data['error'] = 'Email ID already exists.Please choose another';
				$this->load->view('b2c/b2cregistration',$data);
			}
			else
			{
				$title = $this->input->post('title');
				$first_name = $this->input->post('first_name');
				$last_name = $this->input->post('last_name');
				$email_id = $this->input->post('email_id');
				$pwfield = $this->input->post('pwfield');
				$phone = $this->input->post('phone');
				$postalcode = $this->input->post('postalcode');
				$country = $this->input->post('country');
				$city = $this->input->post('city');
				$addresss = $this->input->post('address');
				$akbar_ref = "AKBARB2C".rand(100,100000);
				
				$this->B2c_Model->b2creginsert($title,$first_name,$last_name,$email_id,$pwfield,$phone,$postalcode,$country,$city,$addresss,$akbar_ref);
				
				redirect('b2c/activeb2clist','refresh');
			}
		
	}
	
	
	function activeb2clist()
	{
			$admin_id = $this->session->userdata('admin_id');
			
			$status = 1;
			$data['page_header'] = 'B2C Active List';
			$data['cus_list'] = $this->B2c_Model->b2clist($status);
			$this->load->view('b2c/b2clist',$data);
		
	}
	
	
	function change_b2cuser_status($id,$change_status)
	{
		
			if($change_status == 1)
			{
				$status = 0;
				$this->B2c_Model->update_b2c_status($id,$status);
				redirect('b2c/inactiveb2clist','refresh');
			}
			else
			{
				$status = 1;
				$this->B2c_Model->update_b2c_status($id,$status);
				redirect('b2c/activeb2clist','refresh');
			}
			
		
	}
	
	function inactiveb2clist()
	{
			$admin_id = $this->session->userdata('admin_id');
			
			$status = 0;
			$data['page_header'] = 'B2C Inactive List';
			$data['cus_list'] = $this->B2c_Model->b2clist($status);
			$this->load->view('b2c/b2clist',$data);
		
	}	
	
	function delete_b2cuser($user_id)
	{
		
			$this->B2c_Model->delete_b2c_user($user_id);			
			redirect($_SERVER['HTTP_REFERER']);
		
	}
	
	function edit_b2cuser($user_id)
	{
		
			$data['user_details'] = $this->B2c_Model->get_single_b2c_details($user_id);
			$admin_id = $this->session->userdata('admin_id');
					
			$this->load->view('b2c/edit_b2c',$data);
	
	}
	
	function update_b2c($user_id)
	{
		
			$title = $this->input->post('title');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$email_id = $this->input->post('email_id');
			$pwfield = $this->input->post('pwfield');
			$phone = $this->input->post('phone');
			$postalcode = $this->input->post('postalcode');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$addresss = $this->input->post('address');			
				
			$this->B2c_Model->update_b2c_user($user_id,$title,$first_name,$last_name,$email_id,$pwfield,$phone,$postalcode,$country,$city,$addresss);
			redirect('b2c/edit_b2cuser/'.$user_id);
		
	}
	
	function b2cmarkup($val='')
	{
		
			$admin_id = $this->session->userdata('admin_id');
			
			$data['markupdet'] = $this->Home_Model->getmarkupdet(1);
			$data['markupdet_c'] = $this->Home_Model->getmarkupdet(2);
			$data['api_list'] = $this->Home_Model->getapidetails(1);
			$data['ty'] = 'Hotel';
			
			$this->load->view('b2c/b2cmarkup',$data);			
	
	}
	
	function b2cmarkupinsert($val='')
	{

		if($this->input->post('markup') != '0' && $this->input->post('markup') != '')
		{
			$api = $this->input->post('api');
			$markup = $this->input->post('markup');
			$product_type = 1;
			$this->B2c_Model->b2cmarkupinsert($api,$markup,$product_type);
		}
			redirect('b2c/b2cmarkup/'.$val,'refresh');
	
	}
	
	function delete_markup($id,$val='')
	{
					
			$this->B2c_Model->delete_b2c_markup($id);
			redirect('b2c/b2cmarkup/'.$val,'refresh');
		
	}
	
	function b2cmarkupinsertcountry($val='')
	{
			if($this->input->post('markup_country') != '0' && $this->input->post('markup_country') != '' && $this->input->post('country_name') != '')
		{
			$api = $this->input->post('api_country');
			$markup = $this->input->post('markup_country');
			$country_name = $this->input->post('country_name');
			$product_type = 2;
		
			$this->B2c_Model->b2cmarkupinsertcountry($api,$markup,$val,$country_name,$product_type);
		}
			redirect('b2c/b2cmarkup/'.$val,'refresh');
		
		
	}
	
	function b2creports_hotel($val='')
	{
		
			$admin_id = $this->session->userdata('admin_id');
			
			if($val == '1')
			{
				$data['page_header'] = 'Reports Member';
			}
			else
			{
				$data['page_header'] = 'Reports Walkin User';
			}
			$data['hotel'] = $this->B2c_Model->gethotelreports2(1);
			
			$data['s_api_status'] = $this->B2c_Model->get_booking_api_status();
			$data['s_booking_status'] = $this->B2c_Model->get_booking_status();
			$data['s_transaction_status'] = $this->B2c_Model->get_transaction_status();
			
			$this->load->view('b2c/reports/b2creports_hotel',$data);
		
	}
	
	function b2c_reports_search()
	{
	
	$fromdate= $_POST['fromdate'];
	$booking_status= $_POST['booking_status'];
	$pnr= $_POST['pnr'];
	$booking_no= $_POST['booking_no'];
	$emailid= $_POST['emailid'];
	$todate= $_POST['todate'];
	$api_status= $_POST['api_status'];
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
			$data['page_header'] = 'Reports Member';
			$data['s_api_status'] = $this->B2c_Model->get_booking_api_status();
			$data['s_booking_status'] = $this->B2c_Model->get_booking_status();
			$data['s_transaction_status'] = $this->B2c_Model->get_transaction_status();
			$this->load->view('b2c/reports/b2creports_hotel',$data);
			
	}
	function b2c_voucher($parent_pnr_no)
	{
	
		$data['parent_no'] = $parent_pnr_no; 
		$data['result']=$this->B2c_Model->get_reservation_details_id($parent_pnr_no);
		$data['hotel_result']=$this->B2c_Model->get_reservation_details_hotel($data['result']->product_id);
		
		$this->load->view('b2c/reports/voucher',$data);
	
	}

	
}?>

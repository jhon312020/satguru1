<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Staff extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->model('Home_Model');
	$this->load->model('Admin_Model');
	$this->load->model('staff_model');
	
	$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	$this->output->set_header('Pragma: no-cache');
	$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

	}	
	
	public function getlist()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$type = $this->uri->segment(3);
			$status = ($type==1)?'Staff Active list':'Staff InActive list';
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['cus_list'] = $this->staff_model->getlist($type);
			$data['page_header'] = $status;
			$this->load->view('staff_list',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	public function new_register()
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);			
			$data['page_header'] = "Staff Registration";
			$this->load->view('staff_register',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	public function staff_save() {
		if($this->session->userdata('admin_id')!='')
		{
			$fname = $this->input->post('first_name');
			$lname = $this->input->post('last_name');
			$email = $this->input->post('email_id');
			$password = $this->input->post('pwfield');
			$mobile = $this->input->post('phone');
			$address = $this->input->post('address');
			
			//$data_insert = array('fname' => $fname , 'lname' => $lname , 'email' => $email, 'password' => $password , 'mobile' => $mobile , 'address' => $address,'status' => 0);
			$this->staff_model->staff_save($fname,$lname,$email,$password,$mobile,$address);
			
			redirect('staff/getlist/0','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
		
		}
		
		
		public function change_status() {
		if($this->session->userdata('admin_id')!='')
		{
			$staff_id = $this->uri->segment(3);
			$type = $this->uri->segment(4);
			$status = ($type==1)?'0':'1';
			$this->staff_model->change_status($staff_id,$status);
			redirect('staff/getlist/'.$status,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
			
			
		}
	
	
	
}?>

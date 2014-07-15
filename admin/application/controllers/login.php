<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Home_Model');
		
 	 	  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
	
	  
    }
	 private function check_isvalidated(){
		
		if($this->session->userdata('admin_logged_in') && $this->session->userdata('admin_logged_in')!='')
	   {
		       redirect('admin/admin_dashboard');
       }
	   
	 }
		public function index()
	{
		$this->check_isvalidated();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('uemail', 'Email-Id', 'required');
		$this->form_validation->set_rules('upw', 'Password', 'required');
		$data['status']='';
		if ( $this->form_validation->run() !== false ) {
			
	
			 $res = $this
					  ->Home_Model
					  ->admin_login_check_db(
						 $this->input->post('uemail'), 
						 $this->input->post('upw')
					  ); 

			 if ( $res != '' ) 
			 {
				
				 
				   if($res->usertype==0)
					{
						$sessionUserInfo = array( 
						'admin' 		=> $this->input->post('uemail'),
						'admin_id'	 			=> $res->admin_id,
						'admin_logged_in' 	=> TRUE
						);
						$this->session->set_userdata($sessionUserInfo);
						redirect('admin/admin_dashboard', 'refresh'); 
					
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
        $this->session->unset_userdata('sessionUserInfo');
		$this->session->sess_destroy();
        redirect('login', 'refresh'); 
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

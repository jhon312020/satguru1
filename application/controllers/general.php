<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General extends CI_Controller {

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
	public function adult_child_binding($room_count)
	{
			$data['room_count']=$room_count;
			$this->load->view('general/adult_child_binding',$data);
	}
	public function adult_child_binding_m($room_count)
	{
			$data['room_count']=$room_count;
			$this->load->view('general/adult_child_binding_m',$data);
	}
	function child_age_binding($child_count,$room_id)
	{
			$data['child_count']=$child_count;
			$data['room_id']=$room_id;
			$this->load->view('general/child_age_binding',$data);
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php

class Email_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
	
	
	 function send_email($name,$subject='',$to='',$message_header='',$message='',$attach='')
		 {
			 $message1 ='Dear '.$name.',<br><br>'; 
			 $message1 .= 'Greetings From DSS<br>';
			 
			  $message1 .= $message;
			  $message1 .= '<br><br>Best regards, <br>Team DSS';
			$data['message']= $message1;
			$data['message_header']= $message_header;
			 
			$body = $this->load->view('email/email',$data,true);
			 
			$access = $this->get_email_acess();
		
			$this->load->library('email');
			$config['protocol'] = 'mail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			
			$config['mailtype'] = 'html';
			$config['protocol'] = $access->smtp;
			$config['smtp_host'] = $access->host;
			$config['smtp_port'] = $access->port;
			$config['smtp_user'] = $access->username;
			$config['smtp_pass'] = $access->password;
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$this->email->initialize($config);
			
			$this->email->from('admin@dss.com.sg', 'DSS');
			$to=trim($to);
			$this->email->to($to); 
			$this->email->subject($subject);
			$this->email->message($body);
			if($attach!='')
			{	
			  $this->email->attach($attach);
			}
			
			if($this->email->send())
			{
			
				return true;
			}
			else
			{
				
			  	return false;
			}
			 
		 }
	
		  public function get_email_acess()
		{
	   
			$this->db->select('*')
				->from('email_access');
			
			$query = $this->db->get();
	
		  if ( $query->num_rows > 0 ) {
		  
			 return $query->row();
		  }
		  return false;
	   }
		 
		 
		
		
	
}


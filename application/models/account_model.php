<?php 
//require_once APPPATH.'libraries/checkuser.php';
class Account_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
	
	  public function get_country_list()
   	{
   
		$this->db->select('*')
		->from('country');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
     public function get_country_list_v1()
   	{
   
		$this->db->select('*')
		->from('country_code');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   function check_callcenter_login($email,$password,$domain_id)
		{
			$this->db->select('*')
			->from('call_center')
			->where('email', $email)
		
            ->where('password', $password)
		->where('status', 1)
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
	$id = $query->row();
	  $idval = $id->callcenter_id;
	  $this->db->select('*')
			->from('call_center_domain')
			->where('callcenter_id', $idval)
		
            ->where('domain_id', $domain_id)
			->limit(1);
		$query_s = $this->db->get();

      if ( $query_s->num_rows > 0 ) {
   	  
         return  $id;
      }
      return false;
	
	  
	  
       
      }
      return false;
		}
	
    public function get_country_list_priceline()
   	{
   
		$this->db->select('country,iso_country_code')
		->from('priceline_country');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
        function add_b2c_user($sal,$fnam,$lname,$pw3,$email3,$address,$phone,$city,$country,$postal,$domain,$image_path)
   {
	   	$data = array(
		'title' => $sal,
		'firstname' => $fnam,
		'lastname ' => $lname,
		'password' => $pw3,
		'email' => $email3,
		'address' => $address,
		'contact_no' => $phone,
		'city' => $city,
		'country' => $country,
		'postal_code' => $postal,
		'domain' => $domain,
		'profile_photo' => $image_path,
		
		'usertype' => '3',
		'status' => '1',
		'last_visit_date' => ''
		);
			
		$this->db->set('register_date', 'NOW()', FALSE); 
		
		$this->db->insert('b2c', $data);
		$id = $this->db->insert_id();
		
		if (!empty($id)) {				
			return true;
		} else {
			return false;
		}
   }
    function checkfbUser($uid,$fname, $lname, $email_id,$location,$domain) {
if($location!='')
{	
        $loc =explode(",",$location);
		$city ='';
		if(isset($loc[0]))
		{
		$city = $loc[0];
		}
		$country ='';
		if(isset($loc[1]))
		{
		$country = $loc[1];
		}
}
else
{
	$city ='';
	$country ='';
}
			$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$res = "";
		for ($i = 0; $i < 4; $i++) {
			$res .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		
        $this->db->select('*');
        $this->db->from('b2c');
        $this->db->where('email', $email_id);
		 $this->db->where('domain', $domain);
		if($uid=='face')
		{
			$photo_image =WEB_HOTEL_DIR.'img/face.png';
		}
		else
		{
				$photo_image = 'http://graph.facebook.com/'.$uid.'/picture?width=500';
		}
        $query = $this->db->get();
        if ($query->num_rows == '') {
            $data = array(
                'firstname' => $fname,
                'lastname' => $lname,
                'email' => $email_id,
				'country' => $country,
				'city' => $city,
				'password' => $res,
				'domain' => $domain,
			
				'usertype' => '3',
				'status' => '1',
				'last_visit_date' => '',
                'profile_photo'=> $photo_image
            );
				$this->db->set('register_date', 'NOW()', FALSE); 
            $this->db->insert('b2c', $data);
			$user_id = $this->db->insert_id();
			$sessionUserInfo = array( 
						'b2c_id' 		=> $user_id,
						'b2c_email'	 			=> $email_id,
						'b2c_logged_in' 	=> TRUE
						);
						$this->session->set_userdata($sessionUserInfo);
						
								$this->db->select('*')
								->from('b2c')
								->where('user_id', $user_id)
								->limit(1);
								$query = $this->db->get();
								return $query->row();
			
			
				
				
        } else {
			$res =$query->row();
			$sessionUserInfo = array( 
						'b2c_id' 		=> $res->user_id,
						'b2c_email'	 			=> $res->email,
						'b2c_logged_in' 	=> TRUE
						);
						$this->session->set_userdata($sessionUserInfo);
						
				return $res;
			}

    }
    function check_userdata($email)
	{
		
		$this->db->select('*')
		->from('b2c')->where('email',$email);
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return '';
	}
	 function check_userdata_b2b($email)
	{
		
		$this->db->select('*')
		->from('b2b')->where('email_id',$email);
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return '';
	}
	function fetch_booking_details()
	{
		$user_id=$this->session->userdata('b2c_id');
		$this->db->select('*')
		->from('booking_hotel')
		->where('user_id',$user_id)
	 ->order_by('booking_id','desc');
		
		$query = $this->db->get();

    		  if ( $query->num_rows > 0 ) {
		         return $query->result();
    		  }
      return false;
	}
	public function get_domain_list_id($domain_url)
   	{
   
		$this->db->select('*')
		->from('domain')->where('domain_url',$domain_url);
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
   function get_member_info($userid)
   {
	   	// Only b2c users
	   	$this->db->select('*')
			->from('b2c')
			->where('user_id', $userid)
		 ->where('status', 1)
			->limit(1);
			
			$query = $this->db->get();

		  if ( $query->num_rows > 0 ) {
		  
			 return $query->row();
		  }
		  return false;
   }
     function get_agent_info($id)
   {
	   	$this->db->select('*')
			->from('b2b')
			->where('agent_id', $id)
	
		->where('status', 1)
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
    function get_deposit_info($id)
   {
	   	$this->db->select('*')
			->from('b2b_acc_info')
			->where('agent_id', $id)
	
	
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
    public function check_admin_login($email, $password, $domain_id)
   	{
   
		$this->db->select('*')
			->from('b2c')
			->where('email', $email)
			->where('domain', $domain_id)
			
            ->where('password', $password)
		->where('status', 1)
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
      public function check_b2c_login($email, $password, $domain_id)
   	{
   
		$this->db->select('*')
			->from('b2c')
			->where('user_id', $email)
			->where('domain', $domain_id)
            ->where('password', $password)
		->where('status', 1)
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return 'ok';
      }
	  else
	  {
		  return '';
	  }
     
   }
   public function check_b2b_login($email, $password, $domain_id)
   	{
   
		$this->db->select('*')
			->from('b2b')
			->where('agent_id', $email)
			->where('domain', $domain_id)
            ->where('password', $password)
		->where('status', 1)
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return 'ok';
      }
	  else
	  {
		  return '';
	  }
     
   }
     public function check_admin_login_id($email,  $domain_id)
   	{
   
		$this->db->select('*')
			->from('b2c')
			->where('user_id', $email)
			->where('domain', $domain_id)
			
         
		->where('status', 1)
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
   
     public function check_agent_login($email, $password, $domain_id)
   	{
   
		$this->db->select('*')
			->from('b2b')
			->where('email_id', $email)
			->where('domain', $domain_id)
			
            ->where('password', $password)
		->where('status', 1)
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
   
 public function check_user_logindetail($email,$domain_id)
   	{
   
		$this->db->select('*')
			->from('b2c')
			->where('email', $email)
	  	->where('domain', $domain_id)
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
	
public function get_banner_value($domainurl)
   	{
   
		$this->db->select('*')
			->from('hcms_slider_image')
			->where('domain_url', $domainurl);
	  
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   
   
   public function get_destination_value($domainurl)
   	{
   
		$this->db->select('*')
			->from('hcms_top_destination')
			->where('domain_url', $domainurl)
	  ->group_by('city_name');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   
   public function get_topdestination_value($domainurl)
   	{
   $arr	= array();
		 $this->db->select('city_name')
			->from('hcms_top_destination')
			->where('domain_url', $domainurl)
	  ->group_by('city_name')
	  	->limit(4);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         $cityval =  $query->result(); 
         
         
         foreach($cityval as $ctyVal){
         	$this->db->select('*')
									->from('hcms_top_destination')	
									->join('priceline_hotels', 'hcms_top_destination.degree_id = priceline_hotels.degree_id')
									->where('hcms_top_destination.domain_url', $domainurl)
									->where('hcms_top_destination.city_name', $ctyVal->city_name)
										->limit(4);
										
									$arr[$ctyVal->city_name] = $this->db->get()->result();
									  //echo $this->db->last_query(); exit;      	
         }
         return $arr;
      }
      return false;
   }
   
    public function get_last_deal_value($domainurl)
   	{
   
		$this->db->select('*')
			->from('hcms_last_deal')
			->where('domain_url', $domainurl);
	  
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   
     public function get_recommend_deal_value($domainurl)
   	{
   
		   $this->db->select('*')
			  ->from('hcms_recommend_deal')
			  ->where('domain_url', $domainurl);
	  
		    $query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   
   
  public function get_holiday_package_list($domainurl)
	{
			$this->db->select('*')
		->from('hcms_holiday_package')
		->where('domain_url', $domainurl);
	  	$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		      {
        		 return $query->result();
        }
      return false;
		
		
		}
		
		 public function get_latest_video_list($domainurl)
	{
			$this->db->select('*')
		->from('hcms_latest_video')
		->where('domain_url', $domainurl);
	  	$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		      {
        		 return $query->row();
        }
      return false;
		
		
		}
		
	function packages_country_list()
	{
		$sel_countries = "SELECT `country_id` , `name` FROM country WHERE `country_id` IN (SELECT `country_id` FROM holiday_list GROUP BY country_id) ORDER BY `name` ";
	
		$query = $this->db->query($sel_countries);
		if($query->num_rows() == '') {
			return '';
		} else {
			return $query->result();
		}
	}
   
 
function feedback_category_list()
{
	
		//$sel_category = "SELECT * FROM feedback_category  ORDER BY `category_name` ";
	$this->db->select('*');
	$this->db->from('feedback_category');
	$this->db->order_by('category_name');
		$query = $this->db->get();
		if($query->num_rows() == '') {
			return '';
		} else {
			return $query->result();
		}
	
	
	} 
   
	function insert_feedback_detail($name,$domain_id,$email,$subject,	$messageval,$hostval,$cityval,$countryval,$regionval)
		{
	
	  $dateval = date('Y:m:d');
			$data=array(
			'user_name'=>$name,
	  	'domain_id'=>$domain_id,
			'user_email'=>$email,
			'category'=>$subject,
			'message'=>$messageval,
			'user_ip_address'=>$hostval,
			'city'=>$cityval,
			'country'=>$countryval,
			'region'=>$regionval,
			'feedback_add_date'=>$dateval
			);

			$this->db->insert('feedback_detail',$data);
   return $this->db->insert_id();
		} 
		
		
		
		function getting_review_count($pid,$tid)
	{
		
		$this->db->select('*');
		$this->db->from('priceline_review');
		$this->db->where('hotelid_b',$pid);
		$this->db->where('hotelid_t',$tid);
	  
		$query = $this->db->get();	
		 if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
					$s = $query->row();
		
					return  $s->review_count;
			}
	
	}  
	
	function get_searchresult_new_table_image_table($bid,$tid)
	{
			$this->db->select('*');
		$this->db->from('priceline_photo');
		$this->db->where('hotelid_b',$bid);
		$this->db->where('hotelid_t',$tid);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() == 0 )
		{
		   return '';   
		  }else{
		  $a =  $query->row(); 
		  return $a->photo_url;
		  
		  }
	}
	
	function fetch_currency_value($countryval)
	{
	
		$this->db->select('*');
		$this->db->from('currency_converter');
		$this->db->where('country_code',$countryval);
	
	  
		$query = $this->db->get();	
		 if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
					return $query->row();
		
					
			}
		
	}
	

	function insert_tracking_detail($pageurl)
	{
		if($this->session->userdata('b2c_logged_in') || $this->session->userdata('b2b_logged_in'))
        {
           	$data = $this->get_user_info();
           	$user_id = $data['user_id'];
           	$user_type = $data['user_type'];
        }
           	else {
           		
           		 	$user_id = '0';
           	  $user_type =  '0';
           		
           		}
           		if(isset($_SESSION['city']))
           		{
           			
           			$searchcity = $_SESSION['city'];
           			}else {
           				
           				
           				$searchcity ="";
           				}
           		
           		$domainid = "1";
           		$domainname = "DSS";
           		
           		if($_SESSION['track_countryNameval'])
           		{
           		$countryNameval = $_SESSION['track_countryNameval'];
           		}else { 
           		
           		$countryNameval = 'Nil';
           		}
           		
           		if($_SESSION['track_cityval'])
           		{
           		$cityval = $_SESSION['track_cityval'];
           		}else { 
           		
           		$cityval = 'Nil';
           		}
           		
           		if($_SESSION['track_hostval'])
           		{
           		$hostval = $_SESSION['track_hostval'];
           		}else { 
           		
           		$hostval = 'Nil';
           		}
           		
           		if(	$_SESSION['track_latitudeval'])
           		{
           		
           		$latitude = 		$_SESSION['track_latitudeval'];
           			
           		}else {
           			
           			$latitude = 'Nil';
           			
           			}
           			
           			
           		if(	$_SESSION['track_longitudeval'])
           		{
           		
           		$longitude = 		$_SESSION['track_longitudeval'];
           			
           		}else {
           			
           			$longitude = 'Nil';
           			
           			}
           	
		 $data=array(
			'user_id'=>$user_id,
	  	'user_type'=>$user_type,
			'domain_id'=>$domainid,
			'domain_name'=>$domainname,
			'search_city'=>$searchcity,
			'page_url'=>$pageurl,
			'country'=>$countryNameval,
			'city'=>$cityval,
			'system_ip'=>$hostval,
			'latitude'=>$latitude,
   'longitude'=>$longitude
			);

			$this->db->insert('tracking_detail',$data);
		
		
		}
		
		function user_profile_step1_all($b2c_id,  $firstname, $lastname, $address, $city, $zip, $country,$mobile)
		{
			$row = array(
				"firstname" => $firstname,
				"lastname" => $lastname,
				"address" => $address,
				"city" => $city,
				"postal_code" => $zip,
				"country" => $country,
				"contact_no" => $mobile
			);
			
			$this->db->where('user_id', $this->session->userdata('b2c_id'));
			
			$this->db->update('b2c', $row); 
			//echo $this->db->last_query();exit;
			return true;
		}
			function user_profile_step1_all_b2b($b2c_id,  $firstname, $office_phone, $address, $city, $zip, $country,$mobile,$company_name,$skypeid)
		{
			$row = array(
				"name" => $firstname,
				"company_name" => $company_name,
				"office_phone" => $office_phone,
				"address" => $address,
				"city" => $city,
				"postal_code" => $zip,
				"country" => $country,
				"skype_id" => $skypeid,
				"mobile" => $mobile
			);
			
			$this->db->where('agent_id', $this->session->userdata('b2b_id'));
			
			$this->db->update('b2b', $row); 
			//echo $this->db->last_query();exit;
			return true;
		}
		
		function user_profile_step1($data)
		{
			$row = array(
				"title" => $data['title'],
				"firstname" => $data['first_name'],
				"lastname" => $data['last_name']
			);
			
			$this->db->where('user_id', $this->session->userdata('b2c_id'));
			$this->db->update('b2c', $row); 
			return true;
		}
		
		function user_profile_step2($data)
		{
			$row = array(
				"address" => $data['user_address'],
				"city" => $data['user_city'],
				"postal_code" => $data['user_zip']
			);
			
			$this->db->where('user_id', $this->session->userdata('b2c_id'));
			$this->db->update('b2c', $row); 
			return true;
		}
		
			function user_profile_step2plus($data)
		{
			$row = array(
				"ship_address" => $data['ship_address'],
			//	"city" => $data['user_city'],
			//	"postal_code" => $data['user_zip']
			);
			
			$this->db->where('user_id', $this->session->userdata('b2c_id'));
			$this->db->update('b2c', $row); 
			return true;
		}
		
		function user_profile_step3($data)
		{
			$row = array(
				"country" => $data['user_country']
			);
			
			$this->db->where('user_id', $this->session->userdata('b2c_id'));
			$this->db->update('b2c', $row); 
			return true;
		}
		
		function user_profile_step4($data)
		{
			$row = array(
				"contact_no" => $data['user_phone_no']
			);
			
			$this->db->where('user_id', $this->session->userdata('b2c_id'));
			$this->db->update('b2c', $row); 
			return true;
		}
		
		function user_profile_step5($data)
		{
			// Set the New email address to session
			
			$sessionUserInfo =  array("b2c_email" => $data['user_email_address']);
			$this->session->set_userdata($sessionUserInfo);
			
			$row = array(
				"email" => $data['user_email_address']
			);
			$this->db->where('user_id', $this->session->userdata('b2c_id'));
			$this->db->update('b2c', $row); 
			return true;
		}
		
		function check_image_exists($url)
		{
			if (!$fp = curl_init($url))
			 return 0;
			else  
			return 1;
		}
		
		function user_profile_step6($data)
		{
			$account_details = $this->Account_Model->get_member_info($this->session->userdata('b2c_id'));
				
			$domain = $account_details->domain;
			$config['upload_path'] = ADMIN_UPLOAD_PATH.$domain.'/b2c/images';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			
			$this->upload->do_upload('user_image');		
			$cc = $this->upload->data('file');
			$image_path = WEB_ADMIN_DIR.'upload_files/'.$domain.'/b2c/images/'.$cc['file_name'];
			
			$row = array(
			'profile_photo' => $image_path
			);			
			$this->db->where('user_id', $this->session->userdata('b2c_id'));
			$this->db->update('b2c', $row); 

			redirect('settings/review_detail','refresh');
		}
		function user_profile_step7($data)
		{
			$row = array(
			'password' => $data['new_password']
			);
			
			$user_info = $this->get_user_info();
			
			if($user_info['user_type'] == 2)
			{
			
					$this->db->select('*');
					$this->db->from('b2b');
					$this->db->where('agent_id', $user_info['user_id']);
					$this->db->where('password', $data['current_password']);
					$query = $this->db->get();
	
			
			if ( $query->num_rows > 0 ) {
				
				$this->db->where('agent_id', $user_info['user_id']);
				$this->db->update('b2b', $row);
				return "Correct";
				exit;
				}else {
					
					return "Wrong";
					exit;
					
					}
				
			}
			elseif($user_info['user_type'] == 3)
			{
				
							$this->db->select('*');
					$this->db->from('b2c');
					$this->db->where('user_id', $user_info['user_id']);
					$this->db->where('password', $data['current_password']);
					$query = $this->db->get();
	
			
			if ( $query->num_rows > 0 ) {
				$this->db->where('user_id', $user_info['user_id']);
				$this->db->update('b2c', $row);
					return "Correct";
					exit;
				}else {
					
					return "Wrong";
					exit;
					}
			}
			
			
		}
		
		function user_trips($userid,$usertype="")
		{
		    $this->db->select('*');
			$this->db->from('trip');
			$this->db->where('user_id', $userid);
			$this->db->where('user_type', $usertype);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			
			if ( $query->num_rows > 0 ) {
				return $query->result();
			}
			return false;

		}
		
		function getuser_tracking_detail($userid,$usertype)
		{
			$this->db->select('*');
			$this->db->from('tracking_detail');
			$this->db->where('user_id', $userid);
			$this->db->where('user_type', $usertype);
			$this->db->order_by("date", "desc"); 
			$this->db->limit(50); 
			$query = $this->db->get();
			
			if ( $query->num_rows > 0 ) {
				return $query->result();
			}
			return false;
		}
		 function add_agent_user($sal,$company,$office,$pw3,$email3,$address,$phone,$city,$country,$postal,$domain,$image_path,$skype,$b_type,$y_buss,$iata)
		{
	 
	   	$data = array(
		'name' => $sal,
		'company_name' => $company,
		'office_phone' => $office,
		'password' => $pw3,
		'email_id' => $email3,
		'address' => $address,
		'mobile' => $phone,
		'city' => $city,
		'country' => $country,
		'postal_code' => $postal,
		'domain' => $domain,
		'agent_logo' => $image_path,
		'skype_id' => $skype,
		'business_type' => $b_type,
		'year_of_business' => $y_buss,
		'iata' => $iata,
 		'agent_type' => '2',
		'status' => '0',
		'last_visit_date' => ''
		);
			
		$this->db->set('register_date', 'NOW()', FALSE); 
		
		$this->db->insert('b2b', $data);
		$id = $this->db->insert_id();
		

		if (!empty($id)) {
			
			$data12 = array(
			'agent_id' => $id,
			'balance_credit' => 0.00,
						'last_credit' => 0.00
			);
			
		$this->db->insert('b2b_acc_info', $data12);
		$this->db->insert_id();
		
					$city_array=array(198,844,4977,4073,337,2087,481,5770,3621,4239,3131,3850,435,1753,3257,4443,481,5770,3621,4239);
		$data1=array();
		for($k=0;$k<16;$k++)
		{
			$data1 = array(
			'agent_id' => $id,
			'citi_id' => $city_array[$k],
			);
			
		$this->db->insert('b2b_top_cities', $data1);
		$this->db->insert_id();
		}
			return true;
		} else {
			return false;
		}

   }
   
   function get_user_info()
   {
	   if($this->session->userdata('b2c_id'))
		$b2c = $this->session->userdata('b2c_id');
		
		if($this->session->userdata('b2b_id'))
		$b2b = $this->session->userdata('b2b_id');
	   
	   $data = array();
	   
	   if(!empty($b2c))
	   {
		   $data['user_type'] = $this->session->userdata('b2c_type');
		   $data['user_id'] = $b2c;
	   }
	   elseif(!empty($b2b))
	   {
		   $data['user_type'] = $this->session->userdata('b2b_type');
		   $data['user_id'] = $b2b;
	   }
	   
	   return $data;
   }
   
   function get_user_details()
   {
	   $user_type = $this->get_user_info();
		
	   if($user_type['user_type'] == 2)
	   {
		   $this->db->select('*');
		   $this->db->from('b2b');
		   $this->db->where('agent_id', $user_type['user_id']);
		   $query = $this->db->get();
			
			if ( $query->num_rows > 0 ) {
				return $query->row();
			}
			return false;
	   }
	   
	   if($user_type['user_type'] == 3)
	   {
		   $this->db->select('*');
		   $this->db->from('b2c');
		   $this->db->where('user_id', $user_type['user_id']);
		   $query = $this->db->get();
			
			if ( $query->num_rows > 0 ) {
				return $query->row();
			}
			return false;
	   }
   }
   
   function useragent_profile_step1($data)
	{
			$row = array(
				"company_name" => $data['company_name'],
				"name" => $data['user_name']
			);
			
			$this->db->where('agent_id', $this->session->userdata('b2b_id'));
			$this->db->update('b2b', $row); 
			return true;
	}
	
	function useragent_profile_step2($data)
	{
		$row = array(
				"address" => $data['user_address'],
				"city" => $data['user_city'],
				"postal_code" => $data['user_zip']
			);
			
			$this->db->where('agent_id', $this->session->userdata('b2b_id'));
			$this->db->update('b2b', $row); 
			return true;
	}
	
	function useragent_profile_step2plus($data)
	{
		$row = array(
				"ship_address" => $data['ship_address']
			//	"city" => $data['user_city'],
			//	"postal_code" => $data['user_zip']
			);
			
			$this->db->where('agent_id', $this->session->userdata('b2b_id'));
			$this->db->update('b2b', $row); 
			return true;
	}
	
	function useragent_profile_step3($data)
	{
		$row = array(
				"country" => $data['user_country']
			);
			
			$this->db->where('agent_id', $this->session->userdata('b2b_id'));
			$this->db->update('b2b', $row); 
			return true;
	}
	
	function useragent_profile_step4($data)
	{
		$row = array(
				"office_phone" => $data['user_phone_no']
			);
			
			$this->db->where('agent_id', $this->session->userdata('b2b_id'));
			$this->db->update('b2b', $row); 
			return true;
	}
	
		function useragent_profile_step6($data)
		{
			$account_details = $this->Account_Model->get_user_details();
				
			$domain = $account_details->domain;
			$config['upload_path'] = ADMIN_UPLOAD_PATH.$domain.'/b2b/images';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			
			$this->upload->do_upload('user_image');		
			$cc = $this->upload->data('file');
			$image_path = WEB_ADMIN_DIR.'upload_files/'.$domain.'/b2b/images/'.$cc['file_name'];
			
			$row = array(
			'agent_logo' => $image_path
			);			
			$this->db->where('agent_id', $this->session->userdata('b2b_id'));
			$this->db->update('b2b', $row); 

			redirect('settings/review_detail','refresh');
		}
		
		function fetch_trips_in_date($date)
		{
			$data = $this->get_user_info();
           	$user_id = $data['user_id'];
           	$user_type = $data['user_type'];
           	
			$this->db->select('*');
			$this->db->from('trip');
			$this->db->where('trip_start_date <=', $date);
			$this->db->where('trip_end_date >=', $date);
			$this->db->where('user_id', $user_id);
			$this->db->where('user_type', $user_type);
			$query = $this->db->get();
			if( $query->num_rows > 0 ) {
				return 1;
			}
			return 0;
		}
		
		function fetch_booking_in_date($date)
		{
			$data = $this->get_user_info();
           	$user_id = $data['user_id'];
           	$user_type = $data['user_type'];
           	
           	$this->db->select('*');
			$this->db->from('booking_hotel');
			$this->db->where('check_in <=', $date);
			$this->db->where('check_out >', $date);
			$this->db->where('user_id', $user_id);
			$this->db->where('user_type', $user_type);
			$query = $this->db->get();
			

			if( $query->num_rows > 0 ) {
				return 1;
			}
			return 0;
		}
		
		function get_trips_in_date($date)
		{
			$data = $this->get_user_info();
           	$user_id = $data['user_id'];
           	$user_type = $data['user_type'];
           	
			$this->db->select('*');
			$this->db->from('trip');
			$this->db->where('trip_start_date <=', $date);
			$this->db->where('trip_end_date >=', $date);
			$this->db->where('user_id', $user_id);
			$this->db->where('user_type', $user_type);
			
			$query = $this->db->get();
			
			if( $query->num_rows > 0 ) {
				return $query->result();
			}
			return false;
		}
		
		function get_bookings_in_date($date)
		{
			$data = $this->get_user_info();
           	$user_id = $data['user_id'];
           	$user_type = $data['user_type'];
           	
           	$this->db->select('*');
			$this->db->from('booking');
			$this->db->where('check_in <=', $date);
			$this->db->where('check_out >', $date);
			$this->db->where('user_id', $user_id);
			$this->db->where('user_type', $user_type);
			
			$query = $this->db->get();
			

			if( $query->num_rows > 0 ) {
				return $query->result();
			}
			return false;
		}
		function get_support_list_pending_count($b2c_id,$b2c_type )
	{
		$this->db->select('count(*) as total')
		->from('support_ticket')->where('last_updated_by =','Admin')->where('status', '1')	 ->where('user_id', $b2c_id)	->where('user_type',$b2c_type);
		//->group_by('support_ticket_id');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
	    if ( $query->num_rows > 0 ) 
		{
        		$a= $query->row();
				return $a->total;
        }
      return 0;
	}
	public function get_deposit_amount($id)
   	{
   
		$this->db->select('*')
		->from('b2b_acc_info')
		->where('agent_id', $id);
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
     function cart_count_status($uid,$utype)
   {
if(isset($_SESSION['session_data_id']))
{
		
    $session_id = $_SESSION['session_data_id'];
   	$this->db->select('count(*) as viewval')
   	->from('shopping_cart_global')->where('session_id =', $session_id)->where('user_id', $uid)	 
   	->where('user_type', $utype);
   
   		$query = $this->db->get();
   			//echo $this->db->last_query(); exit;
	    if ( $query->num_rows > 0 ) 
		     {
        		$a= $query->row();
				     return $a->viewval;
        }
      return 0;	
}
else
{
	
	     return 0;	
}
   	
   }
    function notification_count_status($uid,$utype)
   {
   	$this->db->select('count(*) as viewval')
   	->from('notification_user_detail')->where('view_status =', '0')->where('user_id', $uid)	 
   	->where('user_type', $utype);
   
   		$query = $this->db->get();
   			//echo $this->db->last_query(); exit;
	    if ( $query->num_rows > 0 ) 
		     {
        		$a= $query->row();
				     return $a->viewval;
        }
      return 0;	
   	
   	
   }
   
     function fetch_useronline_detail($userid,$usertype)
   {
    
    	$this->db->select('*') 
    ->from('user_online')->where('user_type =', $usertype)
    	 	->where('user_id', $userid);
    	 		$query = $this->db->get();
    	 		//echo $this->db->last_query(); exit;
	    if ( $query->num_rows > 0 ) 
		  {
    			
			mysql_query("UPDATE user_online SET date=NOW() WHERE user_type= $usertype AND user_id=$userid");		
			
     }
     else{
     
      $data = array(
			  
				  'user_type' => $usertype,
				  'user_id' =>$userid,
				   'domain' =>'1'
			 
			  );
     $this->db->insert('user_online', $data);   		
     
     }

     mysql_query("DELETE FROM user_online WHERE dt<SUBTIME(NOW(),'0 0:10:0')");   

   }  
   
   function change_onlie_status($userid,$usertype)
   {
   	
   	mysql_query("DELETE FROM user_online WHERE user_id= $userid AND user_type= $usertype");   
   	
   	}   
   	
   	
      	function insert_newsletter_email($domain,$emailid)
		{
			$this->db->select('*') 
			->from('b2b')->where('email_id =', $emailid);

			$query = $this->db->get(); 
			if ( $query->num_rows > 0 ) 
			{
				return '1';
			}
			else
			{
				$this->db->select('*') 
				->from('b2c')->where('email =', $emailid);
				$query = $this->db->get();  
				if ( $query->num_rows > 0 ) 
				{
					return '1';
				}
				else
				{
					$this->db->select('*') 
					->from('guestuser_newsletter')->where('email_id =', $emailid);
					$query = $this->db->get();  
					if ( $query->num_rows > 0 ) 
					{
						return '1';
					}
					else
					{
						$data = array(
						'guest_type'=>'4',  
						'email_id' => $emailid,
						'domain_id' => $domain,
						'status' => '1'
						);

						$this->db->insert('guestuser_newsletter', $data);
						return '1';

					}


				}

			}

		} 
function getCurrencyRates($code)   
{
	$this->db->select('value');
	$this->db->from('currency_converter');
	$this->db->where('country',$code);
	$query = $this->db->get();
	
	if($query->num_rows() == '') {
		return '1';
	} else {
		return $query->result();
	}
}   
}


<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

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
	 public function __construct()
    {
      parent::__construct();
	     $this->load->database(); 
	     $this->load->model('Hotel_Model');
	     $this->load->model('Wishlist_Model');
	     $this->load->model('Account_Model');
	     $this->load->model('Mytrip_Model');
	     $this->domain = "DSS";
	  
    }


   function review_detail()
   {
   	  if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id'))
		  {
   	$data['displayval'] = "myreview";
   	$this->load->view('account/settings', $data);
   	}
      	  else {
      	  	redirect('home','refresh');
           	  	
      	  	}
   	}
   	
   	 function wishlist_detail()
   {
   	 if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id'))
		  {
   	$data['displayval'] = "mywishlist";
   	$this->load->view('account/settings', $data);
   	}
      	  else {
      	  	redirect('home','refresh');
           	  	
      	  	}
   	
   	}
   	
   	 function trip_detail()
	 {
		 if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id'))
		 {
			$data['displayval'] = "mytrip";
			$this->load->view('account/settings', $data);
		 } 
	 	else 
	 	{
			redirect('home','refresh');         	  
		}   
   	 }
   	 
   	 function user_profile()
   	 {
		  if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id'))
		 {
			$data['displayval'] = "profilesettings";
			$this->load->view('account/settings', $data);
		 } 
	 	else 
	 	{
			redirect('home','refresh');         	  
		}  
	 }
	 
	 
	 /*function mybooking()
   	 {
		 if($this->session->userdata('b2c_id'))
		 {
			$data['displayval'] = "mybooking";
			$this->load->view('account/settings', $data);
		 } 
	 	else 
	 	{
			redirect('home','refresh');         	  
		}  
	 }*/
	 
	 function mysetting()
	 {
		  if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id'))
		 {
			$data['displayval'] = "mysetting";
			$this->load->view('account/settings', $data);
		 } 
	 	else 
	 	{
			redirect('home','refresh');         	  
		} 
	 }
	 
	 function mycalender()
	 {
		  if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id'))
		 {
			$data['displayval'] = "mycalender";
			$this->load->view('account/settings', $data);
		 } 
	 	else 
	 	{
			redirect('home','refresh');         	  
		} 
	 }
	 
	 function newsletter()
	 {
		  if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id'))
		 {
			$data['displayval'] = "newsletter";
			$this->load->view('account/settings', $data);
		 } 
	 	else 
	 	{
			redirect('home','refresh');         	  
		} 
	 }
	 
	 
	 function mynotification()
	 {
		  if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id'))
		 {
			$data['displayval'] = "notification";
			$this->load->view('account/settings', $data);
		 } 
	 	else 
	 	{
			redirect('home','refresh');         	  
		} 
	 }
	 
	 function user_profile_password()
   	 {
		  if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id'))
		 {
			$data['displayval'] = "myprofilepassword";
			$this->load->view('account/settings', $data);
		 } 
	 	else 
	 	{
			redirect('home','refresh');         	  
		}  
	 }
	 
	 function user_profile_display()
	 {
		  if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id'))
		 {
			$data['displayval'] = "myprofiledisplay";
			$this->load->view('account/settings', $data);
		 } 
	 	else 
	 	{
			redirect('home','refresh');         	  
		}  
	 }
	 
	 
                 /* New Wishlist */
                 
                 
        function all_detail($dispalyval="")
      {
      	
      	  if($this->session->userdata('b2c_id'))
		  {
		  if($dispalyval)
		  {
		  $data['displayval']=$dispalyval;	  
		  }
		  else
		  {
		  $data['displayval']="mywishlist";	  
		  }
		  
      	  $this->load->view('wishlist/alldetail',$data);
      	  }
      	  else {
      	  	redirect('home','refresh');
           	  	
      	  	}
      	}         

      function mynewwishlist_detail()
      
      {
				  	 $data['menu']="wish";
				  	 	$wishlist_all =  $this->load->view('wishlist/mywishlist_detail',$data,true);
				  	 
				  	 	print json_encode(array(
		       	        'wishlist_all' => $wishlist_all,
	    		));	 	
				  	
				  	}



				  function mywishlist_detail()
				  { 
				   
				  	 $data['menu']="wish";
				  	 $this->load->view('wishlist/mywishlist_detail',$data);
				
				  	}
				  	
				  	function fetch_wishlistdetail()
				  	{
				  		$list_id  =  $this->input->post('listid');
				  		// $data['wishlist_detail'] =  $this->Wishlist_Model->fetch_wishlist_details($this->session->userdata('b2c_id'),$list_id);
						if($list_id)
						{
						 $data['listval'] = $list_id;	
						}else
						{
						  $data['listval'] = "";		
						}
						
						
				  	   	$data['wishlist_detail'] =  $this->Wishlist_Model->fetch_wishlist_details($this->session->userdata('b2c_id'),$list_id);
				  		$wishlist_result = $this->load->view('wishlist/wishlistdetail_ajax', $data, true);
        if($list_id)
        {
        	
        	$list_name = $this->Wishlist_Model->fetch_list_name($this->session->userdata('b2c_id'),$list_id);
         
        	$wlist_name = $list_name->list_name;
		      	$wlist_id = $list_name->list_id; 
        	}else{
        		
        		$wlist_name ="";
        		$wlist_id = "";
				
        		}
		
	        	print json_encode(array(
		       	'wishlist_result' => $wishlist_result,
		       	"list_name"=>$wlist_name,
				"list_id"=>$wlist_id
			
	    		));	 	
				  		
				  		}
				  		
			  function removewishlist()
			  {
				  
				   $wishlistid = $this->input->get('wishlistid');
				   $hotelid = $this->input->get('hotelid');
				   $delval = $this->Wishlist_Model->delete_wishlist_detail($this->session->userdata('b2c_id'),$wishlistid,$hotelid);
				   
				   
				   if($delval==1){
					  
					 $this->sess_wishlist($hotelid);
					   
				   $data['status'] = "Wishlist Deleted";
				   echo json_encode($data);
				   }else
				   {
					  $data['status'] = "Wishlist Deleted";
				      echo json_encode($data);  
				   }
				  
			  }
			  
			  function sess_wishlist($hotelid)
			  {
				  if (!isset($_SESSION['wish_list_hotelid']))
			      $_SESSION['wish_list_hotelid'] = array();
			  	  if ($hotelid) {
						$key = array_search($hotelid, $_SESSION['wish_list_hotelid']);
						
						if ($key !== false) {
							unset($_SESSION['wish_list_hotelid'][$key]);
						}
					
					}
			   
       if($this->session->userdata('b2c_id'))
       {
    	  if (!isset($_SESSION['wish_list_hotelid']))
			    $_SESSION['wish_list_hotelid'] = array();
			    
			    $wishvalue = $_SESSION['wish_list_hotelid'];
			           if (count($wishvalue) > 0) {
                        $sdata = serialize($wishvalue);
                    } else {
                        $sdata = "";
                    }
    	
     	   //$this->Wishlist_Model->update_wishlist_detail($sdata,$this->session->userdata('b2c_id'));
			  }
			  }
				  			
			  function addnew_listname()
			  {
				  
					   $listname = $this->input->get('listname');
					   $this->Wishlist_Model->insert_new_listname($this->session->userdata('b2c_id'),$listname);
					   $data['status'] = "List Name Added";
					   echo json_encode($data);
				  
			  }
				
			 function edit_wishlitname($listid)
			  {
				  
		                $data['list_name'] = $this->Wishlist_Model->fetch_list_name($this->session->userdata('b2c_id'),$listid);
				     	$this->load->view('wishlist/update_wishlist',$data); 
				  
			  }
			  
			  function update_listname()
			  {
				   $listid = $this->input->get('listid');
				   $listname = $this->input->get('listname');
				   $list = $this->Wishlist_Model->update_listname($listid,$listname);
				   
				   if($list=='1')
				   {
					    $data['status'] = "List Name Updated";
						echo json_encode($data);  
				   }
				  
			  }	
			  
			  function clear_wishlist()
			  {
				  $listid = $this->input->get('listid'); 
				  $list = $this->Wishlist_Model->clear_wishlist($this->session->userdata('b2c_id'),$listid);
				  $data['status'] = "List value Deleted";
				  echo json_encode($data);  
			  }
			  
			  function delete_listname()
			  {
				  $listid = $this->input->get('listid'); 
				  $list = $this->Wishlist_Model->delete_listname($this->session->userdata('b2c_id'),$listid);
				  $data['status'] = "List value Deleted";
				  echo json_encode($data);  
			  }	  			
			  
			  function user_settings()
			  {
				  if($this->session->userdata('b2c_id'))
					$b2c_id = $this->session->userdata('b2c_id');
		
				  if($this->session->userdata('b2b_id'))
					$b2b_id = $this->session->userdata('b2b_id');
		
				  if(isset($b2c_id) && !empty($b2c_id))
				  {
					  $data['account_details'] = $this->Account_Model->get_user_details();
					 
					  // Check Image exists
					  if($this->Account_Model->check_image_exists($data['account_details']->profile_photo) == 1)
					  {
						$data['image_exists']   = 1;
					  }
					  else
					  {
						$data['image_exists']   = 0;  
					  }
					  
					  $data['menu']="user_settings";
					  $data['country'] = $this->Account_Model->get_country_list(); 
					  
					  $data['settings_view'] = $this->load->view('review/settings',$data, true);
					  
					  print json_encode(array(
							'review_settings' => $data));
		       	  }      
		       	  
		       	  elseif(isset($b2b_id) && !empty($b2b_id))
		       	  {
					  $data['account_details'] = $this->Account_Model->get_user_details();
					 
					  // Check Image exists
					  if($this->Account_Model->check_image_exists($data['account_details']->agent_logo) == 1)
					  {
						$data['image_exists']   = 1;
					  }
					  else
					  {
						$data['image_exists']   = 0;  
					  }
					  
					  $data['menu']="user_settings";
					  $data['country'] = $this->Account_Model->get_country_list(); 
					  
					  $data['settings_view'] = $this->load->view('review/settings_agent',$data, true);
					  
					  print json_encode(array(
							'review_settings' => $data));
					  
				  }
			  }	
			  
			  function user_profile_listings()
			  {
			  	 if($this->session->userdata('b2c_id'))
	     	{
		
			   $userid = 	$this->session->userdata('b2c_id');
			   $usertype = 	$this->session->userdata('b2c_type');
				 $data['account_details'] = $this->Account_Model->get_member_info($userid,$usertype);
				 $data['name'] =$data['account_details']->firstname.'&nbsp;'.$data['account_details']->lastname;
				$data['user_image'] =$data['account_details']->profile_photo;

	      	}
		
		     if($this->session->userdata('b2b_id'))
		     {
				 $userid = $this->session->userdata('b2b_id');
				 $usertype = 	$this->session->userdata('b2b_type');
				 $data['account_details'] = $this->Account_Model->get_agent_info($userid,$usertype);
				 $data['name'] =  $data['account_details']->name;
				$data['user_image'] =$data['account_details']->agent_logo;

		     }
				
				  $data['user_trips'] = $this->Account_Model->user_trips($userid,$usertype);
				  $data['user_wishlist'] = $this->Wishlist_Model->fetch_wishlist_details($userid,$usertype, '');
				  $data['tracking_details'] = $this->Account_Model->getuser_tracking_detail($userid,$usertype);
				  $data['booking_details'] = $this->Account_Model->fetch_booking_details();
				  $arg['prevalue'] = 1;
				  $data['previous_trips'] = $this->Mytrip_Model->fetch_mytrip_preview($userid,$usertype,$arg);
				  $arg['prevalue'] = 2;
				  $data['future_trips'] = $this->Mytrip_Model->fetch_mytrip_preview($userid,$usertype,$arg);
					
				  $data['menu']="user_propfile_display";
				  
				  $data['profile_view'] = $this->load->view('account/myprofile',$data, true);
				  
				   
				  print json_encode(array(
		       	        'profile_display' => $data));
			  }
			  
			  
			  function user_password_change()
			  {
				  $data['menu']="user_settings";
				  $data['user_password'] = $this->load->view('review/edituser_password',$data, true);
				  print json_encode(array(
		       	        'user_settings' => $data));
			  }
			
			function user_profile_step1()
			{
				$update_profile = $this->Account_Model->user_profile_step1($_POST);
				return true;
			}
			
			function user_profile_step2()
			{
				$update_profile = $this->Account_Model->user_profile_step2($_POST);
				return true;
			}
			
				function user_profile_step2plus()
			{
				$update_profile = $this->Account_Model->user_profile_step2plus($_POST);
				return true;
			}
			
			function user_profile_step3()
			{
				$update_profile = $this->Account_Model->user_profile_step3($_POST);
				return true;
			}
			
			function user_profile_step4()
			{
				$update_profile = $this->Account_Model->user_profile_step4($_POST);
				return true;
			}
			
			function user_profile_step5()
			{
				$update_profile = $this->Account_Model->user_profile_step5($_POST);
				return true;
			}
			function user_profile_step6()
			{
				$data = $_FILES;
				$update_profile = $this->Account_Model->user_profile_step6($data);
				return true;
			}
			
			function user_profile_step7()
			{
				$update_profile = $this->Account_Model->user_profile_step7($_POST);
				
      $data['status'] = $update_profile;
				  echo json_encode($data);  
			}
			
			function useragent_profile_step1()
			{
				$update_profile = $this->Account_Model->useragent_profile_step1($_POST);
				return true;
			}
			
			function useragent_profile_step2()
			{
				$update_profile = $this->Account_Model->useragent_profile_step2($_POST);
				return true;
			}
			
				function useragent_profile_step2plus()
			{
				$update_profile = $this->Account_Model->useragent_profile_step2plus($_POST);
				return true;
			}
			
			function useragent_profile_step3()
			{
				$update_profile = $this->Account_Model->useragent_profile_step3($_POST);
				return true;
			}
			
			function useragent_profile_step4()
			{
				$update_profile = $this->Account_Model->useragent_profile_step4($_POST);
				return true;
			}
			
			function useragent_profile_step6()
			{
				$data = $_FILES;
				$update_profile = $this->Account_Model->useragent_profile_step6($data);
				return true;
			}
			
			function user_calender()
			{			
				$user_info = $this->Account_Model->get_user_info();
				
				$data['menu']="calender";
			    $data['calender'] = $this->load->view('account/user_calender',$data,true);			    
			    
				print json_encode(array(
		       	        'user_calender' => $data));		       	       
			}
			function user_calender_tour()
			{			
			$idd =  $_POST['result_data'];
				$data['blackout']=$_SESSION['blackout'][$idd];
				$data['parent_pnr_no1']= $idd;
			    $data['calender'] = $this->load->view('account/user_calender_tour',$data,true);			    
			    
				print json_encode(array(
		       	        'user_calender' => $data));		       	       
			}
			function user_calender_tour_id()
			{			
			$idd =  $_POST['result_data'];
			$data['ref_id'] =  $_POST['ref_id'];
				$data['blackout']=$_SESSION['blackout'][$idd];
				$data['parent_pnr_no1']= $idd;
			    $data['calender'] = $this->load->view('account/user_calender_tour',$data,true);			    
			    
				print json_encode(array(
		       	        'user_calender' => $data));		       	       
			}
			
			function overlay_user_calender()
			{
				$search_date = $_REQUEST['year'].'-'.$_REQUEST['month'].'-'.$_REQUEST['day'];
				
				$data['search_date'] = $search_date;
				$data['user_trips'] = $this->Account_Model->get_trips_in_date($search_date);
				$data['user_bookings'] = $this->Account_Model->get_bookings_in_date($search_date);
				
				$this->load->view('account/user_calender_display', $data);
			}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

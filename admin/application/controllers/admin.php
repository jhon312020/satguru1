<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Admin extends CI_Controller {

public function __construct()
   {
	parent::__construct();
	$this->load->model('Home_Model');
	$this->load->model('Admin_Model');
	
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
	function admin_dashboard()
	{
			 
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$this->load->view('index',$data);
			
		
		
	}
	function myprofile()
	{
		 
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$this->load->view('admin/myprofile',$data);
			
	
	}
	function editprofile()
	{
		 
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$this->load->view('admin/editprofile',$data);
			
		
	}
	function updateprofile()
	{
			 
			$admin_id = $this->session->userdata('admin_id');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$email_id = $this->input->post('email_id');
			//$pwfield = $this->input->post('pwfield');
			$phone = $this->input->post('phone');
			$mobile = $this->input->post('mobile');
			$alternate_no = $this->input->post('alternate_no');
			$address = $this->input->post('address');
			$this->Home_Model->updateprofile($first_name,$last_name,$email_id,$phone,$mobile,$alternate_no,$address,$admin_id);
			redirect('admin/editprofile','refresh');
		
	}
	function changepassword($flag='')
	{
		
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			if($flag ==1)
			{
				$data['upd'] = "Password Has Been Changed Succesfully.";
			}
			else
			{
				$data['upd'] = '';
			}
			$this->load->view('admin/changepassword',$data);
		
	}
	function check_password()
	{
		
			$admin_id = $this->session->userdata('admin_id');
			$pwd = $this->input->post('pwd');
			$res = $this->Home_Model->check_password($pwd,$admin_id);
			if($res != '')
			{
			}
			else
			{
				echo "Current Password Not Correct!";
				//echo $res->password;
			}
		
	}
	function updatepassword()
	{
		
			$admin_id = $this->session->userdata('admin_id');
			$pwfield = $this->input->post('pwfield');
			$this->Home_Model->updatepassword($admin_id,$pwfield);
			redirect('admin/changepassword/1','refresh');
		
	}
	
	
	
	function currencyconverter()
	{
		
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['cur_list'] = $this->Home_Model->currencylist();
			$data['page_header'] = 'Currency List';
			$this->load->view('setting/currencylist',$data);
		
	}
	
	function editcur($id)
	{
		
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['cur_det'] = $this->Home_Model->currencydet($id);
			$data['id'] = $id;
			$data['page_header'] = 'Edit Currency';
			$this->load->view('setting/editcur',$data);
		
	}
	
	function updatecurrency($id)
	{
		
			$value = $this->input->post('value');
			$this->Home_Model->updatecurrency($id,$value);
			redirect('admin/currencyconverter','refresh');
		
	}
	
	function deletecur($id)
	{
		
			$curdet = $this->Home_Model->currencydet($id);
			if($curdet->status ==0)
			{
				$status = 2;
			}
			else
			{
				$status = 0;
			}
			$this->Home_Model->delete_currency($id,$status);
			redirect('admin/currencyconverter','refresh');
		
	}
	
	function apimanagement()
	{
		
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['api'] = $this->Home_Model->get_api_list();
			$this->load->view('setting/apimanagement',$data);
		
	}
	function updateapistatus($api_id,$status)
	{
			$data = array('status'=>$status);
			$this->db->where('api_id',$api_id);
			$this->db->update('api_domian_status',$data);
			
			
			//$this->db->last_query();exit;
		
			redirect('admin/apimanagement','refresh');
		
	}
	function editapi($id)
	{
		
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['apidet'] = $this->Home_Model->get_api_det($id);
			$data['id'] = $id;
			
			$this->load->view('setting/editapi',$data);
		
	}
	function updateapi($id)
	{
		if($_POST['api_name']='Asiantravel')
		{
			$admin_id = $this->session->userdata('admin_id');
			$apiname = $this->input->post('api_name');
			$apiurl = $this->input->post('apiurl');
			$apiusername = $this->input->post('apiusername');
			$apipassword = $this->input->post('apipassword');
			
			$data = array('api_name'=>$apiname,'url1'=>$apiurl,'username'=>$apiusername,'password'=>$apipassword);
			$this->db->where('api_id',$id);
			$this->db->update('api',$data);
			
			
			//$this->db->last_query();exit;
		}
			redirect('admin/apimanagement','refresh');
	
	}
	/* Added by JR on July 12th*/
	function managehotel()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['hoteldisplay'] = $this->Home_Model->gethotel();
			$data['country'] = $this->Home_Model->getPackageCountries();
			$data['page_header'] = 'Cheap Flights To Worldwide Destinations';
			$this->load->view('managehotel',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function add_managehotel()
	{
		if($this->session->userdata('admin_id')!='')
		{
		$redirect = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$redirectimage=dirname(dirname(dirname($redirect)));
		$redirectupload=$redirectimage."/banner_images/";
				
			if($_FILES['uploadimage']['name'][0] !='')
			{		
				$rd = "hotel".rand(10,1000);
				$file=$rd.$_FILES['uploadimage']['name'][0];
				copy($_FILES['uploadimage']['tmp_name'][0],"banner_images/".$file);
				$left_ban1=$file;
				$left_ban2=$redirectupload.$left_ban1;
			}
			else
			{
				$left_ban2 = '';
			}
			
			//$left_ban1 = $this->input->post('uploadimage');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$hotelname = $this->input->post('hotelname');
			$starrating = $this->input->post('starrating');
			$address = $this->input->post('address');
			$postalcode = $this->input->post('postalcode');
			$contactno = $this->input->post('contactno');
			$faxno = $this->input->post('faxno');
			$checkintime = $this->input->post('checkintime');
			$checkouttime = $this->input->post('checkouttime');
			$hoteldesc = $this->input->post('hoteldesc');
			$avarageprice = $this->input->post('avarageprice');
			$geo = $this->input->post('geo');
			
			/* Added by JR on 22-July-2014 for lat and long */
			//$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=573/1,+Jangli+Maharaj+Road,+Deccan+Gymkhana,+Pune,+Maharashtra,+India&sensor=false');
			$geo_info = $address.', '. $city.', '.$country;
			$geo_info = str_replace(' ', '+', $geo_info).'&sensor=false';
			$geocode = @file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$geo_info");
			$geoCordinates = '';
			if ($geocode)
			{
				$output= json_decode($geocode);
				$geoCordinates = $output->results[0]->geometry->location->lat.','.$output->results[0]->geometry->location->lng;
			}
			/* End of lat and long 22-July-2014 */
			
			$contractfrom = $this->input->post('contractfrom');
			$contractto = $this->input->post('contractto');
			//$contractfrom = explode('/',$contractfrom);
			//$contractfrom = $contractfrom[2].'-'.$contractfrom[0].'-'.$contractfrom[1] ;
			//$contractto = explode('/',$contractto);
		//	$contractto = $contractto[2].'-'.$contractto[0].'-'.$contractto[1] ;
			$directorsales = $this->input->post('directorsales');
			$salespersonname = $this->input->post('salespersonname');
			$salesno = $this->input->post('salesno');
			$salesemail = $this->input->post('salesemail');
			$extranetpersonname = $this->input->post('extranetpersonname');
			$extranetnumber = $this->input->post('extranetnumber');
			$extranetemail = $this->input->post('extranetemail');
			$hoteldescmore = $this->input->post('hoteldescmore');
			/*$hotelfeature1 = $this->input->post('hotelfeature');
		
			$flag=0;
			foreach($hotelfeature1 as $feature){
			$hotelfeature .= $feature."#";
			$flag=1;
			}
			if($flag==1){
			$hotelfeature=rtrim($hotelfeature);
			}  */
			$internetfacility = $this->input->post('internetfacility');
			$carparking = $this->input->post('carparking');
			$sports1 = $this->input->post('sports');
			//$sports = $sports."#";
			if($sports1!=""){
			  $flag1=0;
			  foreach($sports1 as $sport){
			  $sports .= $sport."#";
			  $flag1=1;
			  }
			  if($flag1==1){
			  $sports=rtrim($sports);
			  } 
			} else
			{
				 $sports='';
			}
				
			$this->Home_Model->add_hotel($left_ban2,$country,$city,$hotelname,$starrating,$address,$postalcode,$contactno,$faxno,$checkintime,$checkouttime,$hoteldesc,$avarageprice,$hotelcode,$contractfrom,$contractto,$directorsales,$salespersonname,$salesno,$salesemail,$extranetpersonname,$extranetnumber,$extranetemail,$hoteldescmore,$internetfacility,$carparking,$sports,$status,$geo, $geoCordinates);
			$hotelid_id = $this->db->insert_id();
			$hotelcode="H".$hotelid_id;
			$this->Home_Model->add_hotelcode($hotelcode,$hotelid_id);
			$uploadimagename=$_POST['uploadimagename'];
			$uploadimage=$_FILES['uploadimage']['name'];
			$redirect = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$redirectimage=dirname(dirname(dirname($redirect)));
			$redirectupload=$redirectimage."/banner_images/";
	
			
			for($i = 0; $i < count($uploadimage); $i++)  {
				
				$rd = "hotel".rand(10,1000);
				$file=$rd.$uploadimage[$i];
			
				copy($_FILES['uploadimage']['tmp_name'][$i],"banner_images/".$file);
				
				$left_ban1=$file;
				$left_ban2=$redirectupload.$left_ban1;	
				$this->Home_Model->add_image($hotelcode,$uploadimagename[$i],$left_ban2);
				$image_code = $this->db->insert_id();
				$image_id="I".$image_id;
				$this->Home_Model->add_imagecode($image_code,$image_id);
		}
		/*	$roomname=$_POST['roomname'];
			$roomprice=$_POST['roomprice'];
			$NormalOccupancy=$_POST['occupancy'];	
			$hotelid_id1="H".$hotelid_id;
			for($i = 0; $i < count($roomname); $i++)  {
	
			$this->Home_Model->add_room($hotelid_id1,$roomname[$i],$roomprice[$i],$NormalOccupancy[$i]);
			$room_id = $this->db->insert_id();
			$roomcode="R".$room_id;
			$this->Home_Model->add_roomcode($roomcode,$room_id);
		} */
		
			$facility = $this->input->post('facility');
			if($facility!=""){
				for($i = 0; $i < count($facility); $i++)  {
				
					$this->Home_Model->add_facility($hotelcode,$facility[$i]);
					$facility_id = $this->db->insert_id();
					$facilitycode="F".$facility_id;
					$this->Home_Model->add_facilitycode($facilitycode,$facility_id);
				}  
			}
			/*$Cancellation = $this->input->post('cp');
			$excp = $this->input->post('excp');
			$exdate1 = $this->input->post('exdate');
			$exdatetill2 = $this->input->post('exdatetill');
						
			for($i = 0; $i < count($exdate1); $i++)  {
	
			$this->Home_Model->add_cancellationpolicy($hotelcode,$Cancellation[$i],$excp[$i],$exdate1[$i],$exdatetill2[$i]);
			$cancel_id = $this->db->insert_id();
			$cancelcode="C".$cancel_id;
			$this->Home_Model->add_cancellationpolicycode($cancelcode,$cancel_id);
		}*/ 
		
			$Cancellation = $this->input->post('cp');
			if ($Cancellation)
			{
				$this->Home_Model->add_cancellationpolicy($hotelcode, $Cancellation);
				$cancel_id = $this->db->insert_id();
				$cancelcode="C".$cancel_id;
				$this->Home_Model->add_cancellationpolicycode($cancelcode, $cancel_id);
			}
			redirect('admin/addroom/'.$hotelcode,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function edit_managehotel()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$redirect = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$redirectimage=dirname(dirname(dirname(dirname($redirect))));
			$redirectupload=$redirectimage."/banner_images/";
			if ($_FILES['uploadimage']['name'] !='')
			{		
				$rd = "hotel".rand(10,1000);
				$file=$rd.$_FILES['uploadimage']['name'];
				copy($_FILES['uploadimage']['tmp_name'],"banner_images/".$file);
				$left_ban1=$file;	
				$left_ban2=$redirectupload.$left_ban1;
			}
			else
			{
				$left_ban1 = $this->input->post('uploadimage1');
			}
			 $id = $this->input->post('id');
			 $hotelcode="H". $id;
			//echo $left_ban1 = $this->input->post('uploadimage');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$hotelname = $this->input->post('hotelname');
			$starrating = $this->input->post('starrating');
			$address = $this->input->post('address');
			$postalcode = $this->input->post('postalcode');
			$contactno = $this->input->post('contactno');
			$faxno = $this->input->post('faxno');
			$checkintime = $this->input->post('checkintime');
			$checkouttime = $this->input->post('checkouttime');
			$hoteldesc = $this->input->post('hoteldesc');
			$avarageprice = $this->input->post('avarageprice');
			$geo = $this->input->post('geo');
			$contractfrom = $this->input->post('contractfrom');
			$contractto = $this->input->post('contractto');
			$directorsales = $this->input->post('directorsales');
			$salespersonname = $this->input->post('salespersonname');
			$salesno = $this->input->post('salesno');
			$salesemail = $this->input->post('salesemail');
			$extranetpersonname = $this->input->post('extranetpersonname');
			$extranetnumber = $this->input->post('extranetnumber');
			$extranetemail = $this->input->post('extranetemail');
			$hoteldescmore = $this->input->post('hoteldescmore');
			/* Added by JR on 22-July-2014 for lat and long */
			//$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=573/1,+Jangli+Maharaj+Road,+Deccan+Gymkhana,+Pune,+Maharashtra,+India&sensor=false');
			$geo_info = $address.', '. $city.', '.$country;
			$geo_info = str_replace(' ', '+', $geo_info).'&sensor=false';
			$geocode = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$geo_info");
			//print_r($geocode);
			//exit;
			$geoCordinates = '';
			if ($geocode)
			{
				$output= json_decode($geocode);
				$geoCordinates = $output->results[0]->geometry->location->lat.' , '.$output->results[0]->geometry->location->lng;
			}
			/* End of lat and long 22-July-2014 */
			//exit;
			/*$hotelfeature1 = $this->input->post('hotelfeature');
		
			$flag=0;
			foreach($hotelfeature1 as $feature){
			$hotelfeature .= $feature."#";
			$flag=1;
			}
			if($flag==1){
			$hotelfeature=rtrim($hotelfeature);
			}  */
			$internetfacility = $this->input->post('internetfacility');
			$carparking = $this->input->post('carparking');
			$sports1 = $this->input->post('sports');
			//$sports = $sports."#";
			if($sports1!=""){
			  $flag1=0;
			  foreach($sports1 as $sport){
			  $sports .= $sport."#";
			  $flag1=1;
			  }
			  if($flag1==1){
			  $sports=rtrim($sports);
			  } 
			} else
			{
				 $sports='';
			}
			$this->Home_Model->edit_hotel($country,$city,$hotelname,$starrating,$address,$postalcode,$contactno,$faxno,$checkintime,$checkouttime,$hoteldesc,$avarageprice,$hotelcode,$contractfrom,$contractto,$directorsales,$salespersonname,$salesno,$salesemail,$extranetpersonname,$extranetnumber,$extranetemail,$hoteldescmore,$internetfacility,$carparking,$sports,$status,$geo,$id, $geoCordinates);
			
			$facility = $this->input->post('facility');
			$sql=mysql_query("delete from  hotel_facilities where HotelCode='".$hotelcode."'");
			
			if($facility!=""){
			for($i = 0; $i < count($facility); $i++)  {
			$this->Home_Model->add_facility($hotelcode,$facility[$i]);
			$facility_id = $this->db->insert_id();
			$facilitycode="F".$facility_id;
			$this->Home_Model->add_facilitycode($facilitycode,$facility_id);
		}  }
			
			
			
			redirect('admin/edithotel/'.$id,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function addroom($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['hotel'] = $this->Home_Model->edit_searchhotel($id);
			$data['page_header'] = 'Add Room';
			$this->load->view('addroom',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addnewroom()
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$hotelid_id = $this->input->post('id');
			if($hotelid_id==""){
			$hotelid_id1=$this->uri->segment(3);
			} else {
				
				$hotelid_id1="H".$hotelid_id;
			}
			$redir=$this->uri->segment(4);
			$roomname=$this->input->post('roomname');
			$roomsize=$this->input->post('roomsize');
			$beds=$this->input->post('beds');
			
			$description=$this->input->post('description');
			$roomfeature1=$this->input->post('roomfeature');
			
			
			if($beds!=""){
			$beds=$this->input->post('beds');	
			} else
			{
				$beds='';
			}
					
			
			for($i = 0; $i < count($roomname); $i++)  {
				
				
				$roomimage=$_FILES['roomimage']['name'][$i];
				$redirect = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$redirectimage=dirname(dirname(dirname(dirname($redirect))));
				$redirectupload=$redirectimage."/banner_images/";
				if($roomimage)
			{		
				$rd = "room".rand(10,1000);
				$file=$rd.$_FILES['roomimage']['name'][$i];
				copy($_FILES['roomimage']['tmp_name'][$i],"banner_images/".$file);
				$left_ban1=$file;
				$left_ban2=$redirectupload.$left_ban1;
			}
			else
			{
				$left_ban1 = '';
			}
			
			/*if($roomfeature1!=""){
			  $flag1=0;
			  foreach($roomfeature1 as $roomf){
			  $roomfeature .= $roomf."#";
			  $flag1=1;
			  }
			  if($flag1==1){
			  $roomfeature=rtrim($roomfeature);
			  } 
			} else
			{
				 $roomfeature='';
			} */
			$extrabed=$this->input->post('extrabed');
			
			$this->Home_Model->add_room($hotelid_id1,$roomname[$i],$roomsize[$i],$beds[$i],$extrabed[$i],$description[$i],$left_ban2);
			$room_id = $this->db->insert_id();
			$roomcode="R".$room_id;
			$this->Home_Model->add_roomcode($roomcode,$room_id);
			
			for($k = 0; $k < count($roomfeature1); $k++)  {
	
			$this->Home_Model->add_amen($hotelid_id1,$roomcode,$roomfeature1[$k],$createdby);
			
		}
				
		}
			/*if($redir==''){
			
				redirect('admin/manageprice/'.$hotelid_id1,'refresh');
			} else {
				redirect('admin/edithotel/'.$hotelid_id,'refresh');
			
			} */
			redirect('admin/manageprice/'.$hotelid_id1,'refresh');
			
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function manageprice($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['hotel'] = $this->Home_Model->viewhotel($id);
			$data['room'] = $this->Home_Model->viewroom($id);
			$data['page_header'] = 'Price Control';
			$this->load->view('manageprice',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addprice()
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$addid=$this->input->post('addid');
			if($addid!='1'){
			  $saveadd=$this->input->post('saveadd');
			  $hotelid_id1=$this->uri->segment(3);
			  $currency=$this->input->post('currency');
			  $dmarkprice=$this->input->post('dmarkprice');
			  $dmarkbed=$this->input->post('dmarkbed');
			  $dmarkmeals=$this->input->post('dmarkmeals');
			  $extrabedchildprice=$this->input->post('extrabedchildprice');
			  $extrabedchildmarkup=$this->input->post('extrabedchildmarkup');
			  $extrabedadultprice=$this->input->post('extrabedadultprice');
			  $extrabedadultmarkup=$this->input->post('extrabedadultmarkup');
			  $lunchprice=$this->input->post('lunchprice');
			  $lunchmarkup=$this->input->post('lunchmarkup');
			  $dinnerprice=$this->input->post('dinnerprice');
			  $dinnermarkup=$this->input->post('dinnermarkup');
			  $this->Home_Model->add_price($hotelid_id1,$currency,$dmarkprice,$dmarkbed,$dmarkmeals,$extrabedchildprice,$extrabedchildmarkup,$extrabedadultprice,$extrabedadultmarkup,$lunchprice,$lunchmarkup,$dinnerprice,$dinnermarkup);
			  
			  $mealname=$this->input->post('mealname');
			  $mealdatefrom=$this->input->post('mealdatefrom');
			  $mealdateto=$this->input->post('mealdateto');
			  $mealprice=$this->input->post('mealprice');
			  $mealmarkup=$this->input->post('mealmarkup');
			  
			  for($k = 0; $k < count($mealname); $k++)  {
										
				$this->Home_Model->add_hotel_meal_service($hotelid_id1,$mealname[$k],$mealdatefrom[$k],$mealdateto[$k],$mealprice[$k],$mealmarkup[$k]);	
				}
			  
				  
			}
			$ratefromcount=$this->input->post('ratefrom');
			$ratefrom=$this->input->post('ratefrom');
			$rateto=$this->input->post('rateto');
			$Roomcode=$this->input->post('roomid');
			$contractrate=$this->input->post('contractrate');
			$roompricemarkup=$this->input->post('roompricemarkup');
			$weekdayfrom=$this->input->post('weekdayfrom');
			$weekdaytill=$this->input->post('weekdaytill');
			$surcharge=$this->input->post('surcharge');
			$ratefromh=$this->input->post('ratefromh');
			$ratetosurcharge=$this->input->post('ratetosurcharge');
			
			for($i = 0; $i < count($Roomcode); $i++)  {
										
				$this->Home_Model->add_hotelroomprice($hotelid_id1,$Roomcode[$i],$ratefrom[$i],$rateto[$i],$contractrate[$i],$roompricemarkup[$i],$weekdayfrom[$i],$weekdaytill[$i],$surcharge[$i]);	
				}

			for($j = 0; $j < count(array_filter($ratefromh)); $j++)  {
				
			$this->Home_Model->add_holidaysurcharge($hotelid_id1,$Roomcode[$j],$ratefromh[$j],$ratetosurcharge[$j]);	
			}
			if($saveadd!=''){	
				redirect('admin/managepriceadd/'.$hotelid_id1,'refresh');
			}
			 else 
				 {
					redirect('admin/promotioncontrol/'.$hotelid_id1,'refresh'); 
				 }
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function promotioncontrol($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['hotel'] = $this->Home_Model->viewhotel($id);
			$data['room'] = $this->Home_Model->viewroom($id);
			$data['page_header'] = 'Promotion Control- Promotions For All Room Categories';
			$this->load->view('promotioncontrol',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addpromotion()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$hotelid_id1=$this->uri->segment(3);
			$Roomcode=$this->input->post('roomid');
			$ratefrom=$this->input->post('ratefrom');
			$rateto=$this->input->post('rateto');
			$stay=$this->input->post('stay');
			$pay=$this->input->post('pay');
			$breakfast=$this->input->post('breakfast');
			$breakrate=$this->input->post('breakrate');
			$breakmarkup=$this->input->post('breakmarkup');
			for($k = 0; $k < count(array_filter($ratefrom)); $k++)  
			{
				$this->Home_Model->add_hotel_promotion($hotelid_id1,$Roomcode[$k],$ratefrom[$k],$rateto[$k],$stay[$k],$pay[$k],$breakfast[$k],$breakrate[$k],$breakmarkup[$k]);	
			}  
			$discountfrom=$this->input->post('discountfrom');
			$discountto=$this->input->post('discountto');
			$discountrate=$this->input->post('discountrate');
			
			for($i = 0; $i < count(array_filter($discountrate)); $i++)  
			{
				$this->Home_Model->add_perdiscount($hotelid_id1,$Roomcode[$i],$discountfrom[$i],$discountto[$i],$discountrate[$i]);	
			}
			$pricefrom=$this->input->post('pricefrom');
			$priceto=$this->input->post('priceto');
			$pricerate=$this->input->post('pricerate');
			for($j = 0; $j < count(array_filter($pricerate)); $j++)
			{
				$this->Home_Model->add_perprice($hotelid_id1,$Roomcode[$j],$pricefrom[$j],$priceto[$j],$pricerate[$j]);	
			} 
			/*$pricefrom=$this->input->post('pricefrom');
			$priceto=$this->input->post('priceto');
			$pricerate=$this->input->post('pricerate');
			for($j = 0; $j < count($pricerate); $j++)  {
									
			$this->Home_Model->add_perprice($hotelid_id1,$Roomcode[$j],$pricefrom[$j],$priceto[$j],$pricerate[$j]);	
			}  */
			
			$weekdayfrom=$this->input->post('weekdayfrom');
			$weekdaytill=$this->input->post('weekdaytill');
			$weekendrate=$this->input->post('weekendrate');
			for($m = 0; $m < count(array_filter($weekendrate)); $m++)
			{
				$this->Home_Model->add_weekendprice($hotelid_id1,$Roomcode[$m],$weekdayfrom[$m],$weekdaytill[$m],$weekendrate[$m]);	
			} 
			$upgradefrom=$this->input->post('upgradefrom');
			$upgradeto=$this->input->post('upgradeto');
			$promo=$this->input->post('promo');
			for($n = 0; $n < count(array_filter($promo)); $n++)
			{
				$this->Home_Model->add_promoprice($hotelid_id1,$Roomcode[$n],$upgradefrom[$n],$upgradeto[$n],$promo[$n]);
			} 
			//redirect('admin/promotioncontrol/'.$hotelid_id1,'refresh');
			redirect('admin/viewhotel/','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function viewhotel()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['hoteldisplay'] = $this->Home_Model->gethotel();
			$data['page_header'] = 'View Hotels';
			$this->load->view('viewhotel',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function edithotel($hotel_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['hotel'] = $this->Home_Model->edit_searchhotel($hotel_id);
			$hotel_id1="H".$hotel_id;
			$data['roomdisplay'] = $this->Home_Model->gethotelroom($hotel_id1);
			$data['country'] = $this->Home_Model->getPackageCountries();
			$data['facility'] = $this->Home_Model->getfacility($hotel_id1);
			$data['page_header'] = 'Cheap Flights To Worldwide Destinations';
			$this->load->view('edithotel',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function viewpromo()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$roomcode = "R".$this->uri->segment(3);
			$data['paystay'] = $this->Home_Model->viewpaystay($roomcode);
			$data['viewweekend'] = $this->Home_Model->viewweekend($roomcode);
			$data['viewpricediscount'] = $this->Home_Model->viewpricediscount($roomcode);
			$data['viewroompricediscount'] = $this->Home_Model->viewroompricediscount($roomcode);
			$data['viewserviceup'] = $this->Home_Model->viewserviceup($roomcode);
			$data['page_header'] = 'PAY-STAY PROMOTIONS';
			$data['page_header1'] = 'PAY-STAY PROMOTIONS';
			$data['page_header2'] = ' Week End Stay Promotion';
			$data['page_header3'] = '% Discount';
			$data['page_header4'] = 'Room Price Discount';
			$data['page_header5'] = 'Upgrades/Value Adds';
			$this->load->view('viewpromo',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addroomn($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['hotel'] = $this->Home_Model->edit_searchhotel($id);
			$data['page_header'] = 'Add Room';
			$this->load->view('addroomn',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function editroom($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['hotel'] = $this->Home_Model->edit_searchhotel($id);
			$data['roomdisplay'] = $this->Home_Model->getroom($id);
			$roomid="R".$id;
			$data['aminity'] = $this->Home_Model->getamen($roomid);
			$data['page_header'] = 'Edit Room';
			$this->load->view('editroom',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	public function change_roomstatus()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$room_id = $this->uri->segment(3);
			$type = $this->uri->segment(4);
			$status = ($type==1)?'0':'1';
			$hotelid = $this->uri->segment(5);
			$hotelid = substr($hotelid, 1);
			$this->Home_Model->change_roomstatus($room_id,$status);
			redirect('admin/edithotel/'.$hotelid,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addeditprice($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$id1="R".$id;
			$data['price'] = $this->Home_Model->getprice($id1);
			$data['page_header'] = 'Add RoomPrice';
			$data['page_header1'] = 'Manage Room Price';
			$this->load->view('addeditprice',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addpaystay($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['paystay'] = $this->Home_Model->getpaystay($id);
			$data['page_header'] = 'Add Paystay Promotion';
			$this->load->view('addpaystay',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addweekend($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['paystay'] = $this->Home_Model->getpaystay($id);
			$data['page_header'] = 'Add Weekend Promotion';
			$this->load->view('addweekend',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function adddiscountpromo($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['page_header'] = 'Add % Discount Promotion';
			$this->load->view('adddiscountpromo',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function adddiscountpr($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['page_header'] = 'Add Room Discount';
			$this->load->view('addroomdiscount',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addservice($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['page_header'] = 'Add Services';
			$this->load->view('addservice',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addpaystaypromo()
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$roomcode=$this->uri->segment(3);
			$roomcode1="R".$this->uri->segment(3);
			$hotelcode=$this->uri->segment(4);
			$ext=$roomcode."/".$hotelcode;
			$ratefrom=$this->input->post('ratefrom');
			$rateto=$this->input->post('rateto');
			$Roomcode=$this->input->post('roomid');
			$stay=$this->input->post('stay');
			$pay=$this->input->post('pay');
			$breakfast=$this->input->post('breakfast');
			$breakrate=$this->input->post('breakrate');
			$breakmarkup=$this->input->post('breakmarkup');
			$this->Home_Model->addpaystaypromo($roomcode1,$hotelcode,$ratefrom,$rateto,$stay,$pay,$breakfast,$breakrate,$breakmarkup);	
			redirect('admin/viewpromo/'.$ext,'refresh'); 
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function editpaystay($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['paystay'] = $this->Home_Model->getpaystay($id);
			$data['page_header'] = 'Edit Paystay Promotion';
			$this->load->view('editpaystay',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function editpaystaypromo($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$roomcode=$this->uri->segment(4);
			$hotelcode=$this->uri->segment(5);
			$ext=$roomcode."/".$hotelcode;
			$ratefrom=$this->input->post('ratefrom');
			$rateto=$this->input->post('rateto');
			$Roomcode=$this->input->post('roomid');
			$stay=$this->input->post('stay');
			$pay=$this->input->post('pay');
			$breakfast=$this->input->post('breakfast');
			$breakrate=$this->input->post('breakrate');
			$breakmarkup=$this->input->post('breakmarkup');
			$this->Home_Model->editpaystaypromo($id,$ratefrom,$rateto,$stay,$pay,$breakfast,$breakrate,$breakmarkup);	
			redirect('admin/viewpromo/'.$ext,'refresh'); 
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	public function delete_paystay($id) 
	{
		 if($this->session->userdata('admin_id')!='')
		{
			$orgroom_id = $this->uri->segment(5);
			$hotelid = $this->uri->segment(4);
			$room_id1=substr($room_id,1);
			$ext=$orgroom_id."/".$hotelid;
			$this->Home_Model->delete_paystay($id);
			redirect('admin/viewpromo/'.$ext,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addweekendpromo()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$roomcode=$this->uri->segment(3);
			$roomcode1="R".$this->uri->segment(3);
			$hotelcode=$this->uri->segment(4);
			$ext=$roomcode."/".$hotelcode;
			$weekdayfrom=$this->input->post('weekdayfrom');
			$weekdaytill=$this->input->post('weekdaytill');
			$weekendrate=$this->input->post('weekendrate');
			$this->Home_Model->addweekendpromo($roomcode1,$hotelcode,$weekdayfrom,$weekdaytill,$weekendrate);
			redirect('admin/viewpromo/'.$ext,'refresh'); 
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function editweekendstay($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['editweekendstay'] = $this->Home_Model->getweekendstay($id);
			$data['page_header'] = 'Edit Weekendstay Promotion';
			$this->load->view('editweekendstay',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	public function delete_weekend($id) 
	{
		if($this->session->userdata('admin_id')!='')
		{
			$orgroom_id = $this->uri->segment(5);
			$hotelid = $this->uri->segment(4);
			$room_id1=substr($room_id,1);
			$ext=$orgroom_id."/".$hotelid;
			$this->Home_Model->delete_weekend($id);
			redirect('admin/viewpromo/'.$ext,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addnewdiscount($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$roomcode=$this->uri->segment(3);
			$roomcode1="R".$this->uri->segment(3);
			$hotelcode=$this->uri->segment(4);
			$ext=$roomcode."/".$hotelcode;
			$discountfrom=$this->input->post('discountfrom');
			$discountto=$this->input->post('discountto');
			$discountrate=$this->input->post('discountrate');
			$this->Home_Model->addnewdiscount($roomcode1,$hotelcode,$discountfrom,$discountto,$discountrate);	
			redirect('admin/viewpromo/'.$ext,'refresh'); 
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function editdiscount($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['getdiscount'] = $this->Home_Model->getdiscountpromo($id);
			$data['page_header'] = 'Edit % Discount';
			$this->load->view('editdiscount',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function editdiscountpr($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$roomcode=$this->uri->segment(4);
			$hotelcode=$this->uri->segment(5);
			$ext=$roomcode."/".$hotelcode;
			$discountfrom=$this->input->post('pricefrom');
			$discountto=$this->input->post('priceto');
			$discountrate=$this->input->post('pricerate');
			$this->Home_Model->editdiscountpr($id,$discountfrom,$discountto,$discountrate);	
			redirect('admin/viewpromo/'.$ext,'refresh'); 
			
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	public function delete_roomdiscount($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$orgroom_id = $this->uri->segment(5);
			$hotelid = $this->uri->segment(4);
			$room_id1=substr($room_id,1);
			$ext=$orgroom_id."/".$hotelid;
			$this->Home_Model->delete_roomdiscount($id);
			redirect('admin/viewpromo/'.$ext,'refresh');
		  }
		  else
		  {
			  redirect('admin','refresh');
		  }
	}
	
	function addnewdiscountpr()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$roomcode=$this->uri->segment(3);
			$roomcode1="R".$this->uri->segment(3);
			$hotelcode=$this->uri->segment(4);
			$ext=$roomcode."/".$hotelcode;
			$discountfrom=$this->input->post('pricefrom');
			$discountto=$this->input->post('priceto');
			$discountrate=$this->input->post('pricerate');
			$this->Home_Model->addnewdiscountpr($roomcode1,$hotelcode,$discountfrom,$discountto,$discountrate);	
			redirect('admin/viewpromo/'.$ext,'refresh'); 
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function editdiscountprice($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['getdiscount'] = $this->Home_Model->getdiscountprice($id);
			$data['page_header'] = 'Edit % Discount';
			$this->load->view('editdiscount',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	public function delete_roompricedis($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$orgroom_id = $this->uri->segment(5);
			$hotelid = $this->uri->segment(4);
			$room_id1=substr($room_id,1);
			$ext=$orgroom_id."/".$hotelid;
			$this->Home_Model->delete_roompricedis($id);
			redirect('admin/viewpromo/'.$ext,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addservicesave()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$roomcode=$this->uri->segment(3);
			$roomcode1="R".$this->uri->segment(3);
			$hotelcode=$this->uri->segment(4);
			$ext=$roomcode."/".$hotelcode;
			$discountfrom=$this->input->post('upgradefrom');
			$discountto=$this->input->post('upgradeto');
			$discountrate=$this->input->post('promo');
			$this->Home_Model->addnewservice($roomcode1,$hotelcode,$discountfrom,$discountto,$discountrate);
			redirect('admin/viewpromo/'.$ext,'refresh'); 
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function editservice($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['getservice'] = $this->Home_Model->getservice($id);
			$data['page_header'] = 'Edit Service';
			$this->load->view('editservice',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function editservicesave($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$roomcode=$this->uri->segment(4);
			$hotelcode=$this->uri->segment(5);
			$ext=$roomcode."/".$hotelcode;
			$discountfrom=$this->input->post('upgradefrom');
			$discountto=$this->input->post('upgradeto');
			$discountrate=$this->input->post('promo');
			$this->Home_Model->editservicesave($id,$discountfrom,$discountto,$discountrate);
			redirect('admin/viewpromo/'.$ext,'refresh'); 
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	public function delete_service($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$orgroom_id = $this->uri->segment(5);
			$hotelid = $this->uri->segment(4);
			$room_id1=substr($room_id,1);
			$ext=$orgroom_id."/".$hotelid;
			$this->Home_Model->delete_service($id);
			redirect('admin/viewpromo/'.$ext,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	public function change_hotelstatus()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$hotel_id = $this->uri->segment(3);
			$type = $this->uri->segment(4);
			$status = ($type==1)?'0':'1';
			$this->Home_Model->change_hotelstatus($hotel_id,$status);
			redirect('admin/managehotel','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function managepriceadd($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['hotel'] = $this->Home_Model->viewhotel($id);
			$data['room'] = $this->Home_Model->viewroom($id);
			$data['page_header'] = 'Price Control';
			$this->load->view('managepriceadd',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function editroomprice($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['roomprice'] = $this->Home_Model->getroomprice($id);
			$data['page_header'] = 'Edit Room Price';
			$this->load->view('editroomprice',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function addnewprice()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$ratefromcount=$this->input->post('ratefrom');
			$ratefrom=$this->input->post('ratefrom');
			$rateto=$this->input->post('rateto');
			$Roomcode=$this->input->post('roomid');
			$contractrate=$this->input->post('contractrate');
			$roompricemarkup=$this->input->post('roompricemarkup');
			$weekdayfrom=$this->input->post('weekdayfrom');
			$weekdaytill=$this->input->post('weekdaytill');
			$surcharge=$this->input->post('surcharge');
			$ratefromh=$this->input->post('ratefromh');
			$ratetosurcharge=$this->input->post('ratetosurcharge');
			 $hotelid_id=$this->uri->segment(4);
			 $Roomcode="R".$this->uri->segment(3);
			 $Roomcode1=$this->uri->segment(3);
			
			for($i = 0; $i < count($ratefrom); $i++)  {
										
				$this->Home_Model->add_hotelroomprice($hotelid_id,$Roomcode,$ratefrom[$i],$rateto[$i],$contractrate[$i],$roompricemarkup[$i],$weekdayfrom[$i],$weekdaytill[$i],$surcharge[$i]);	
				}

			for($j = 0; $j < count($ratefromh); $j++)  {
				
			$this->Home_Model->add_holidaysurcharge($hotelid_id,$Roomcode,$ratefromh[$j],$ratetosurcharge[$j]);	
			}
			
				redirect('admin/addeditprice/'.$Roomcode1.'/'.$hotelid_id,'refresh');
			
			
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	public function delete_price($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$orgroom_id = $this->uri->segment(5);
			$hotelid = $this->uri->segment(4);
			$room_id1=substr($room_id,1);
			$ext=$orgroom_id."/".$hotelid;
			$this->Home_Model->delete_price($id);
			redirect('admin/addeditprice/'.$ext,'refresh');
			//redirect('admin/managehotel','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function updateroom($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$id = $this->input->post('id');
			$RoomName = $this->input->post('RoomName');
			$roomsize=$this->input->post('roomsize');
			$beds=$this->input->post('beds');
			$description=$this->input->post('description');
			$roomfeature1=$this->input->post('roomfeature');
			//$AvgPrice = $this->input->post('AvgPrice');
			//$NormalOccupancy = $this->input->post('NormalOccupancy');
			$hotelcode = $this->uri->segment(3); 
			$hotelcode = substr($hotelcode, 1);
			$extrabed=$this->input->post('extrabed');
			$this->Home_Model->update_room($RoomName,$roomsize,$beds,$extrabed,$description,$id);
			
			$roomcode="R".$id;
			$sql=mysql_query("delete from hotel_aminities where RoomCode='".$roomcode."'");
			$hotelcode1="H".$hotelcode;
			for($k = 0; $k < count($roomfeature1); $k++)  
			{
				$this->Home_Model->add_amen($hotelcode1,$roomcode,$roomfeature1[$k],$createdby);
			}
		    redirect('admin/edithotel/'.$hotelcode,'refresh');
			//redirect('admin/managehotel','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function editprice($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$roomcode=$this->uri->segment(4);
			$hotelcode=$this->uri->segment(5);
			$ext=$roomcode."/".$hotelcode;
			$ratefrom=$this->input->post('ratefrom');
			$rateto=$this->input->post('rateto');
			$Roomcode=$this->input->post('roomid');
			$contractrate=$this->input->post('contractrate');
			$roompricemarkup=$this->input->post('roompricemarkup');
			$weekdayfrom=$this->input->post('weekdayfrom');
			$weekdaytill=$this->input->post('weekdaytill');
			$surcharge=$this->input->post('surcharge');
			$this->Home_Model->editroomprice($id,$ratefrom,$rateto,$contractrate,$roompricemarkup,$weekdayfrom,$weekdaytill,$surcharge);	
			redirect('admin/addeditprice/'.$ext,'refresh'); 
			
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	/* End of it JR on July 12th*/
}?>

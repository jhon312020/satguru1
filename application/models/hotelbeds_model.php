<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * MyBookingSystem - Gta Api Model
 *  
 *
 * @package		MyBookingSystem
 * @author		Khadharvalli
 * @copyright	Copyright (c) 2013 - 2014, Provabtechnosoft Pvt. Ltd.
 * @license		http://www.mybookingsystem.com/support/license-agreement
 * @link		http://www.mybookingsystem.com
 * 
 */

class Hotelbeds_Model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}

	public function getApiAuthDetails($api)
	{
		$this->db->select('*');
		$this->db->from('apimanagement');
		$this->db->where('apiname', $api);
		$query = $this->db->get();
		if($query->num_rows() == 0 )
		{
			return '';
		}
		else
		{
			return $query->row();
		}
    }
    function fetch_search_by_id($id){
		$see=$_SESSION['hotel_search']['session_id'];
	//	$select = "SELECT  * FROM  asia_hotel_search_list WHERE  HotelCode = '$id' AND (session_id='$see' or session_id='') ";
		//$select = "SELECT * FROM asia_hotel_search_list WHERE HotelCode = '$id' AND (session_id='$see' or session_id='')";
		 ///$query = $this->db->query($select);
		 
		//if($query->num_rows() == '' ){
			 $select = "SELECT  * FROM hotel_search_list WHERE HotelCode = '$id'";
		     $query = $this->db->query($select);
		//}
		
			if ( $query->num_rows > 0 ) {
		
					return  $query->row();
				}
				
					else
					{
					return '';
	}
}
function fetch_rooms_aminii($id){
	$ses=$_SESSION['hotel_search']['session_id'];
	$select = "SELECT  * FROM  asia_hotel_aminities WHERE  HotelCode	 = '$id' AND session_id='$ses' GROUP BY RoomAmenities";

			$query = $this->db->query($select);
			//echo $this->db->last_query();exit;
			if ( $query->num_rows > 0 ) {
		
					return  $query->result();
				}
				
					else
					{
					return '';
	}
}
function fetch_ficilities($hotelCode){
	$col='"';
	$select = "SELECT  * FROM  feat WHERE  hotelid	 = '$col$hotelCode'";

			$query = $this->db->query($select);
			//echo $this->db->last_query();exit;
			if ( $query->num_rows > 0 ) {
		
					return  $query->row();
				}
				
					else
					{
					return '';
	}
	}
	function fetch_rooms($hotelCode){
		$select = "SELECT  * FROM  asia_hotel_room_list WHERE  HotelCode	 = '$hotelCode'";

			$query = $this->db->query($select);
			//echo $this->db->last_query();exit;
			if ( $query->num_rows > 0 ) {
		
					return  $query->result();
				}
				
					else
					{
					return '';
	}
	}
    function fetch_sear($id){
		$select = "SELECT  * FROM  asia_hotels_deatil WHERE  HotelId	 = '$id'";

			$query = $this->db->query($select);
			//echo $this->db->last_query();exit;
			if ( $query->num_rows > 0 ) {
		
					return  $query->row();
				}
				
					else
					{
					return '';
	}
}
    function fetch_search_result_all_id_all($id)
	{
		//AND hotelid_t != '0'
			//$select = "SELECT  * FROM  asia_hotel_search_list WHERE  session_id = '$id' or session_id='' and status='1' GROUP BY HotelName";
		
		/*  $select = "SELECT HotelCode, HotelName, StarRating, Category, Address, Location, PostalCode, ContactNo, FaxNo, checkintime, checkouttime, City, Country, HotelDesc, AvgPrice, FrontPgImage
		  FROM asia_hotel_search_list
		  UNION SELECT HotelCode, HotelName, StarRating, Category, Address, Location, PostalCode, ContactNo, FaxNo, checkintime, checkouttime, City, Country, HotelDesc, AvgPrice, FrontPgImage
		  FROM hotel_search_list
		  WHERE session_id = '$id'
		  OR session_id = ''
		  AND STATUS = '1' GROUP BY HotelName";  */
		  $ed = $_SESSION['hotel_search']['org_cin'];
		  $sd = $_SESSION['hotel_search']['org_cout'];
		  // Added by JR for star filter on 22-July-2014
        $hotel_star = '';
        if (isset($_SESSION['f_category']))
        {
            $hotel_star = implode(',', $_SESSION['f_category']);
        }
			//$select = "SELECT  * FROM  hotel_search_list WHERE  status='1' AND COUNTRY='".$_SESSION['hotel_search']['country']."' GROUP BY HotelName";
			//$select = "SELECT  * FROM  hotel_search_list WHERE  status='1' AND COUNTRY='".$_SESSION['hotel_search']['country']."' AND contractfrom <='".$ed."' AND contractto >= '".$sd."'";
			$select = sprintf("SELECT * FROM hotel_search_list WHERE status='1' AND COUNTRY = '%s' AND contractfrom <='".$ed."' AND contractto >= '".$sd."'",
            mysql_real_escape_string($_SESSION['hotel_search']['country']));
			
			if ($hotel_star)
			{
				$select .= " AND StarRating in ($hotel_star)";
			}
			$select .= " GROUP BY HotelName";
			//End of 22-July-2014
			//$select = "SELECT  * FROM  hotel_search_list WHERE  status='1' AND COUNTRY='".$_SESSION['hotel_search']['country']."' GROUP BY HotelName";
			
			//$select = "SELECT  * FROM  hotel_search_list WHERE  status='1' AND COUNTRY='".$_SESSION['hotel_search']['country']."' AND contractfrom <='".$ed."' AND contractto >= '".$sd."' GROUP BY HotelName";
		
			
			// and contractfrom>='".$ed."' and  '".$sd."' between contractfrom and contratcto 
			//and contractfrom>='".$_SESSION['hotel_search']['sd']."' and contractto<=''".$_SESSION['hotel_search']['ed']."''
				
			$query = $this->db->query($select);
			//echo $this->db->last_query();exit;
			if ( $query->num_rows > 0 ) {
		
					return $query->result(); 
				}
				
					else
					{
					return '';

			}
	}
	
	
    function get_currecy_details($currency)
    {
        $que="select * from  currency_converter where country='$currency' ";
        $query= $this->db->query($que);
        if($query->num_rows() =='')
        {
           return '';
        }
        else
        {
           return $query->row();
        }	
    }
    
    function fetch_search_result($session_id,$api)
    {
        $this->db->select('*');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$session_id);
        $this->db->where('api',$api);
        $this->db->group_by('hotelId');
        $this->db->order_by('total','ASC');

        $query = $this->db->get();

        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result(); 			
        }
    }
    function fetch_search_result_location($session_id,$api,$city)
    {
        $this->db->select('*');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$session_id);
        $this->db->where('api',$api);
		//$this->db->where('city',$city);
        $this->db->group_by('locationDescription');
        $this->db->order_by('total','ASC');

        $query = $this->db->get();

        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result(); 			
        }
    }
	function last_viewed_hotels()
	{
		$session_id = $_SESSION['hotel_search']['session_id'];
		$this->db->select('*');
        $this->db->from('api_hotel_detail_t1');
        $this->db->where('session_id',$session_id);
        //$this->db->where('api',$api);
		//$this->db->where('city',$city);
		$this->db->limit('2');
        $query = $this->db->get();

        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result(); 			
        }
	}
	function fetch_search_price($id){
		$this->db->select('*');
        $this->db->from('api_hotel_detail_t1');
        $this->db->where('session_id',$id);
        //$this->db->where('api',$api);
		//$this->db->where('city',$city);
		//$this->db->limit('2');
        $query = $this->db->get();
//echo $this->db->last_query(); exit;
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
		}
		function fetch_search_result_all($id){
			$this->db->select('*');
        $this->db->from('api_hotel_detail_t1');
        $this->db->where('session_id',$id);
        //$this->db->where('api',$api);
		//$this->db->where('city',$city);
		//$this->db->limit('2');
        $query = $this->db->get();
//echo $this->db->last_query(); exit;
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
		}
	function toprated_deluxe($session_id,$api,$city)
	{
		$this->db->select('locationDescription');
		$this->db->select('name');
		$this->db->select('total');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$session_id);
        $this->db->where('api',$api);
		$this->db->where('city',$city);
		$this->db->where('hotelRating','5.0');
        $this->db->order_by('total','DESC');
		$this->db->limit('1');

        $query = $this->db->get();

        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
	}
	function bestsavers_deluxe($session_id,$api,$city)
	{
		$this->db->select('locationDescription');
		$this->db->select('name');
		$this->db->select('total');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$session_id);
        $this->db->where('api',$api);
		$this->db->where('city',$city);
		$this->db->where('hotelRating','5.0');
        $this->db->order_by('total','ASC');
		$this->db->limit('1');

        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
	}
	function buisiness_toprated($session_id,$api,$city)
	{
		$this->db->select('locationDescription');
		$this->db->select('name');
		$this->db->select('total');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$session_id);
        $this->db->where('api',$api);
		$this->db->where('city',$city);
		$this->db->like('hotelRating','4.0');
		$this->db->or_like('hotelRating','3.0');
        $this->db->order_by('total','DESC');
		$this->db->limit('1');

        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
	}
	function buisiness_bestsavers($session_id,$api,$city)
	{
		$this->db->select('locationDescription');
		$this->db->select('name');
		$this->db->select('total');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$session_id);
        $this->db->where('api',$api);
		$this->db->where('city',$city);
		$this->db->like('hotelRating','4.0');
		$this->db->or_like('hotelRating','3.0');
        $this->db->order_by('total','ASC');
		$this->db->limit('1');

        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
	}
	function top_rated_economy($session_id,$api,$city)
	{
		$this->db->select('locationDescription');
		$this->db->select('name');
		$this->db->select('total');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$session_id);
        $this->db->where('api',$api);
		$this->db->where('city',$city);
		$this->db->like('hotelRating','2.0');
		$this->db->or_like('hotelRating','1.0');
        $this->db->order_by('total','DESC');
		$this->db->limit('1');

        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
	}
	function bestsavers_economy($session_id,$api,$city)
	{
		$this->db->select('locationDescription');
		$this->db->select('name');
		$this->db->select('total');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$session_id);
        $this->db->where('api',$api);
		$this->db->where('city',$city);
		$this->db->like('hotelRating','2.0');
		$this->db->or_like('hotelRating','1.0');
        $this->db->order_by('total','ASC');
		$this->db->limit('1');

        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
	}
	function fetch_search_result_meals($session_id,$api)
    {
        $this->db->select('*');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$session_id);
        $this->db->where('api',$api);
        $this->db->group_by('propertyCategory');
        $this->db->order_by('total','ASC');

        $query = $this->db->get();

        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result(); 			
        }
    }
	function getmealplan($prp)
	{
		$this->db->select('PropertyCategoryDesc');
        $this->db->from('expedia_property_type_list');
        $this->db->where('PropertyCategory',$prp);
        $query = $this->db->get();

        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            $row = $query->row(); 			
			return $row->PropertyCategoryDesc;
        }
	}
    function getRoomAvaibilityData($hotelcode,$sessId)
    {
        $this->db->select('*');
        $this->db->from('api_hotel_room_detail_t1');
        $this->db->where('session_id',$sessId);
        $this->db->where('hotel_code',$hotelcode);
        $this->db->order_by('total','ASC');
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result(); 			
        }
    }
    
    function getHotelDetailsOnCode($hotelCode,$sessionId)
    {
        $this->db->select('*');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotelId',$hotelCode);
        $this->db->where('api','expedia');
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
    }
    
    function getRoomDetailsOnCode($hotelCode,$roomCode,$sessionId)
    {
        $this->db->select('*');
        $this->db->from('api_hotel_room_detail_t');
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->where('roomTypeCode',$roomCode);
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
    }
    
    function getExpediaCountryList()
    {
        $this->db->select('*');
        $this->db->from('expedia_country_list');
        $this->db->order_by('NAME','ASC');
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result(); 			
        }
    }
    
    function getExpediaStateListOnCountry($country)
    {
        $this->db->select('*');
        $this->db->from('expedia_state_list');
        $this->db->where('CountryCode',$country);
        $this->db->order_by('StateName','ASC');
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result(); 			
        }
    }
    
    function insertExpediaBookingDetails($data)
    {
        $this->db->insert('transection_details',$data);
        return $this->db->insert_id();
    }
    
    function insertBookingPaxDetails($data)
    {
        $this->db->insert('booking_passenger_information',$data);
    }
    
    function insertBookingUserDetails($bookerInfo)
    {
         $this->db->insert('customer_contact_details',$bookerInfo);
    }
    
    function getPropertyTypeOnID($id)
    {
        $query=$this->db->query($sql="select PropertyCategoryDesc from expedia_property_type_list where PropertyCategory='".$id."'");
        if($query->num_rows() > 0)
        {
            $res=$query->row();
            return $res->PropertyCategoryDesc;
        }
        else return '';
    }
	function gethotelid($hotelname)
	{
		$this->db->select('HotelID');
        $this->db->from('expedia_hotels_list');
        $this->db->like('Name',$hotelname);
       // $this->db->order_by('StateName','ASC');
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            $res = $query->row(); 			
			return $res->HotelID;
        }
	}
	function get_facility_details_hotel($id)
	{
		$this->db->select('*');
		$this->db->from('api_permanent_facility');
		$this->db->where('hotel_code',$id);
		$this->db->where('fac_type','hotel');
		$this->db->where('api','hotelsbed');
		$this->db->group_by("fac"); 
		$query = $this->db->get();	
//		echo $this->db->last_query();exit;
		if($query->num_rows() == 0 )
		{
		   return '';   
		  }else{
		  
		  return  $query->result(); 
		  }
		
	}
	function get_facility_details_room($id)
	{
		$this->db->select('*');
		$this->db->from('api_permanent_facility');
		$this->db->where('hotel_code',$id);
		$this->db->where('api','hotelsbed');
		$query = $this->db->get();	
	//echo $this->db->last_query();exit;
		if($query->num_rows() == 0 )
		{
		   return '';   
		  }else{
		  
		  return  $query->result(); 
		  }
		
	}
	function get_cata_code_det($hotelCode)
		{
			$query = $this->db->query("SELECT * FROM hb_hotel WHERE HOTELCODE='$hotelCode'");
			if($query->num_rows =='')
			{
				return '';
			}else{
				$df =  $query->row();
				return $df->CATEGORYCODE;
			}
		}
		function get_cata_code_detw($hotelCode)
		{
			$query = $this->db->query("SELECT * FROM hb_category WHERE CATEGORYCODE='$hotelCode'");
			if($query->num_rows =='')
			{
				return '';
			}else{
				$df =  $query->row();
				return $df->CATEGORYNAME;
			}
		}
	function replaceFunnyChar( $input ){

$translation = array(
    'â€™' => "'",
    "â€\"" => '-',
    'Ã©' => 'é',
    'Ã¨' => 'è',
    'â€œ' => '"',
    'â€' => '"',
    'â€˜' => "'",
    'Ã¢' => 'ã',
    'Ã"' => 'ä',
	'Ã¤' => 'ä',
    'â€"' => '–',
    'Ä«' => 'ī',
    'é˜´' => '阴',
    'é™°' => '陰',
    "é˜³" => "阳",
    "é™½" => "陽",
    'Â´' => "'",
    'Ã¼' => 'ü',
	'Ã±o' => 'ñ',
    "Ã,Ã'" => "'",
    'â€¢' => '–'
);
}
	function get_cata_code_descriptIOn($hotelCode)
		{
			$query = $this->db->query("SELECT description FROM api_permanent WHERE  hotel_code='$hotelCode'");
			//echo $this->db->last_query();exit;
			if($query->num_rows =='')
			{
				return '';
			}else{
				$df =  $query->row();
				return $df->description;
			}
		}
		function get_hb_fac_room_des($code,$la)
	{
		$query = $this->db->query("SELECT * FROM hb_faci_desc WHERE CODE='$code' AND GROUP_='60' AND LANGUAGECODE='$la'");
		
		if($query->num_rows =='')
		{
			return '';
		}else{
			return $query->row();
		}
	}
	function get_hb_fac_hotel_s($hotel_id)
	{
		$query = $this->db->query("SELECT * FROM hb_facilities WHERE HOTELCODE='$hotel_id' AND GROUP_='70' ");
		//echo $this->db->last_query();exit;
		
		if($query->num_rows =='')
		{
			return '';
		}else{
			return $query->result();
		}
	}
		
	function get_hb_fac_hotel_des($code,$la)
	{
		$query = $this->db->query("SELECT * FROM hb_faci_desc WHERE CODE='$code' AND GROUP_='70' AND LANGUAGECODE='$la'");
		//echo $this->db->last_query();exit;
		if($query->num_rows =='')
		{
			return '';
		}else{
			return $query->row();
		}
	}
		function get_hb_fac_room_s($hotel_id)
	{
		$query = $this->db->query("SELECT * FROM hb_facilities WHERE HOTELCODE='$hotel_id' AND GROUP_='60'");
		
		if($query->num_rows =='')
		{
			return '';
		}else{
			return $query->result();
		}
	}
	function gethb_hotelimage_new_v1($hotelCode)
		{
		//$val="GEN";
			$query = $this->db->query("SELECT * FROM  asia_hotel_images WHERE HotelCode='$hotelCode' group by ImageFileName");
			//echo $this->db->last_query();exit;
			if($query->num_rows =='')
			{
				return '';
			}else{
				return $query->result();
			}
		}
		function gethb_hotelimage_facilities($hotelCode){
			$query = $this->db->query("SELECT * FROM  asia_hotel_facilities WHERE HotelCode='$hotelCode' group by Facility");
			//echo $this->db->last_query();exit;
			if($query->num_rows =='')
			{
				return '';
			}else{
				return $query->result();
			}
			}

			function delete_temp_results($session_id,$hotel_code)
		{
			$this->db->where('session_id', $session_id);
			$this->db->where('hotel_code', $hotel_code);
			$this->db->delete('api_hotel_detail_t1');						
		}
		function hotelcode($idss){
			$this->db->select('hotel_code');
			$this->db->select('session_id');
        $this->db->from('api_hotel_detail_t1');
        $this->db->where('api_temp_hotel_id ',$idss);
       // $this->db->order_by('StateName','ASC');
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            $res = $query->row(); 			
			return $res;
        }
		}
		function hotelroomdetails($seeid,$hotelid){
			$this->db->select('*');
        $this->db->from('api_hotel_detail_t1');
        $this->db->where('hotel_code ',$hotelid);
        $this->db->where('session_id ',$seeid);
       // $this->db->order_by('StateName','ASC');
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result();
        }
			
		}
	
	function add_cart_details_cert($ses_id,$result_id)
	{
		$this->db->select('asia_hotel_room_list.*,asia_hotel_search_list.*');
		$this->db->from('asia_hotel_room_list');
		$this->db->where('asia_hotel_room_list.id',$result_id);
		$this->db->join('asia_hotel_search_list', 'asia_hotel_search_list.HotelCode= asia_hotel_room_list.HotelCode');
	
		$query = $this->db->get();	
		
		$result_data[]  = $query->row();
		
		
		//echo $this->db->last_query();exit;
		//echo '<pre/>';print_r($result_data);exit;
		$api_temp_hotel_id_key='';
		$room_code='';
		$room_type='';
		$inclusion='';
		$shurival='';
		$charval='';
		$adult='';
		$child='';
		$board_type='';
		$token='';
		$inoffcode='';
		$contractnameVal='';
		$room_count='';
		$rate_typeval='';
		$total_cost=0;
		$destCodeVal='';
		$shortname='';
		$child_age='';
		$id=$result_data->id;
		$session_id=$result_data->session_id;
		$RoomCode=$result_data->RoomCode;
		$RoomName=$result_data->RoomName;
		$HotelCode=$result_data->HotelCode;
		$Currency=$result_data->Currency;
		$AvgPrice=$result_data->AvgPrice;
		$CancellationPeriod=$result_data->CancellationPeriod;
		$NormalOccupancy=$result_data->NormalOccupancy;
		$MaxChildAge=$result_data->MaxChildAge;
		$Availability=$result_data->Availability;
		$Date=$result_data->Date;
		$Breakfast=$result_data->Breakfast;
		$Inclusion=$result_data->Inclusion;
		$MaxOccupancy=$result_data->MaxOccupancy;
		$RestrictionName=$result_data->RestrictionName;		
		$rest=$this->cancellation_policy($id);	
		return $rest;
		
	}
	function fetch_cart_search_result_db_id($ses_id,$result_id)
	{
		$this->db->select('*');
		$this->db->from('asia_hotel_room_list');
		$this->db->where('session_id',$ses_id);
		$this->db->where('id',$result_id);
		//$this->db->group_by('parent_cart_id');
		$query = $this->db->get();	
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	
	function fetch_cart_search_result_db_id1($result_id)
	{
				
		$this->db->select('*');
		$this->db->from('hotel_room_list');
		$this->db->where('RoomCode',$result_id);
		//$this->db->group_by('parent_cart_id');
		$query = $this->db->get();	
		//echo $this->db->last_query();exit;
		return $query->result();
		
	}
	
	
		function fetch_cart_search_result_db_id_v1($ses_id,$result_id)
	{
		$this->db->select('*');
		$this->db->from('asia_hotel_search_list');
		$this->db->where('session_id',$ses_id);
		$this->db->where('HotelCode',$result_id);
		//$this->db->group_by('parent_cart_id');
		$query = $this->db->get();	
		return $query->result();
	}
			function fetch_cart_search_result_db_total_amount_id($ses_id,$result_id)
	{
		$this->db->select('sum(total_cost) as total_cost');
		$this->db->from('shopping_cart_hotel');
		$this->db->where('session_id',$ses_id);
		$this->db->where('parent_cart_id',$result_id);
		$query = $this->db->get();	
		return $query->row();
	}
	function everydetails($hotelcode){
		$this->db->select('*');
		$this->db->from('asia_hotel_search_list');
		$this->db->where('HotelCode',$hotelcode);
		
		$query = $this->db->get();
		
		//echo $this->db->last_query();exit;
		return $query->row();
	}
		function fetch_cart_search_result_db($ses_id)
	{
		$this->db->select('*');
		$this->db->from('shopping_cart_hotel');
		$this->db->where('session_id',$ses_id);
		$this->db->group_by('parent_cart_id');
		$query = $this->db->get();	
		return $query->result();
	}
		function booking($api,$cart_id,$parent_pnr_no,$parent_pnr_no1)
	{
		
$this->db->select('*');
		$this->db->from('api');
		$this->db->where('api_name', 'Hotelbeds');
		$query = $this->db->get();	
		//echo $$hotel_code; exit;
		if($query->num_rows() == 0 )
		{
		   	$set_crediential =FALSE;
		}
		else
		{
	  	  	$api_info =  $query->row(); 
		   	$client_id = $api_info->username;
			$password = $api_info->password;
			$post_url = $api_info->url1;
			$set_crediential =TRUE;
			$active_api = 'hotelbeds';
			//echo $client_id.','.$password.','.$post_url .','.$set_crediential.','.$active_api ;exit;
		}
		$this->city = $_SESSION['hotel_search']['dest_code'];

		$cinval = explode("/",$_SESSION['hotel_search']['cin']);
		$cin  = $cinval[2].$cinval[0].$cinval[1];
		$coutval = explode("/",$_SESSION['hotel_search']['cout']);
		$cout  = $coutval[2].$coutval[0].$coutval[1];
		$city_info = $this->get_city_code($this->city);
		$this->city_code = $city_info->hotelsbed;
				$this->days = $_SESSION['hotel_search']['days'];
		$this->room_count = $_SESSION['hotel_search']['room_count'];
		$this->adult = $_SESSION['hotel_search']['adult'];
		$this->child = $_SESSION['hotel_search']['child'];
		$this->child_age = $_SESSION['hotel_search']['child_age'];
		$this->adult_count = $_SESSION['hotel_search']['adult_count'];
		$this->child_count= $_SESSION['hotel_search']['child_count'];
		$this->sec_id=$_SESSION['hotel_search']['session_id'];
		$room_info = '';
		$sb_room_cnt=0;
		$db_room_cnt=0;
		$tr_room_cnt=0;
		$q_room_cnt=0;
		$dbc_room_cnt=0;
		$dbcc_room_cnt=0;
		$dummy_room_count=0;
		$cart_result_id =  $this->fetch_cart_search_result_db_cartid($this->sec_id,$cart_id);
	//echo "<pre/>";print_r($cart_result_id);exit;
		$cancel_policy =  $cart_result_id->CancellationPenaltyRule;
		$room_catagery_id = $cart_result_id->RoomCode;
		$hotel_code = $cart_result_id->HotelCode;
		$bookroom='';
		$m=1;
		
		$nameval='';
		$fname1='test';
		$pax_info='';
		
		for($i=0;$i< $this->room_count;$i++)
		{
			$array_vals[] =  $this->adult[$i].",".$this->child[$i];
		}
		
		$hotelbed_rooms='';
	
		$check_array=array();
		
		for($k=0;$k<count($array_vals);$k++)
		{
			if(isset($this->child_age[$k]))
			{
			$child_age  = $this->child_age[$k];
			}
			else
			{
			$child_age = '';
			}
			$key = array_search($array_vals[$k], $check_array);
			
			if ($key) 
			{
			
			unset($check_array[$key]);
			$split_key = explode("||",$key);
			$key_count = $split_key[0]+1;
				$check_array[$key_count."||".$split_key[1].",".$child_age] = $array_vals[$k];
			}
			else
			{
				
				$check_array['1||'.$child_age.'||'.$k] = $array_vals[$k];
			
			}
			
		}
		$m=1;
		
		foreach($check_array as $key=>$value)
		{
			$room_data = explode("||",$key);
			$adult_child_data = explode(",",$value);
			$childage_data = explode(",",$room_data[1]);
			
		
					
							if($adult_child_data[0] != 0)
							{
								//echo $adult_child_data[0];
							  
							   for($ac=0;$ac< ($adult_child_data[0]*$room_data[0]);$ac++)
							   {	
										$hotelbed_rooms .= '<Customer type="AD">
															   <CustomerId>'.$m.'</CustomerId>
															   <Age>30</Age>
															   <Name>'.$_SESSION['booking_info']['fname'][$ac].'</Name>
															   <LastName>'.$_SESSION['booking_info']['lname'][$ac].'</LastName>
															   </Customer>';
															   $m++;
							   }
										
							}
							if($adult_child_data[1] != 0)
							{
							  
							   for($s=0;$s<count($_SESSION['hotel_search']['child_age']);$s++)
							   {	$age=$_SESSION['hotel_search']['child_age'][$s][0];	
										$hotelbed_rooms .= '<Customer type="CH">
															   <CustomerId>'.$m.'</CustomerId>
															   <Age>'.$age.'</Age>
															   <Name>'.$_SESSION['booking_info']['cname'][$s].'</Name>
															   <LastName>'.$_SESSION['booking_info']['cname1'][$s].'</LastName>
															   </Customer>';
															     $m++;
							   }
										
							}
		}
		
		
//echo "<pre/>";print_r($_SESSION['booking_info']);exit;
$gb=array();
for($ru=0;$ru<count($_SESSION['hotel_search']['child_age']);$ru++)
{
$cc=explode(",",$_SESSION['hotel_search']['child_age'][$ru]);
    for($rus=0;$rus<count($cc);$rus++)
   {
   $gb[] = $cc[$rus];
   }
  }
$pass_info='';
for($ru=0;$ru<count($_SESSION['booking_info']['fname']);$ru++)
{

	$pass_info .= $_SESSION['booking_info']['sal'][$ru].' '.$_SESSION['booking_info']['fname'][$ru].' '.$_SESSION['booking_info']['lname'][$ru].'<br>';
}
if(isset($_SESSION['booking_info']['cname'][0]))
{
for($ru=0;$ru<count($_SESSION['booking_info']['cname']);$ru++)
{


	$pass_info .= 'Child : '.$_SESSION['booking_info']['cname'][$ru].' '.$_SESSION['booking_info']['cname1'][$ru].' / Age - '.$gb[$ru].'<br>';
	
}
}
//exit;
		if(isset($_SESSION['booking_info']['rema'][0]) && $_SESSION['booking_info']['rema']!='')
		{
		$remarks_k1 = implode(",",$_SESSION['booking_info']['rema']);
		$remarks_k2 = $_SESSION['booking_info']['remar'];
			if($remarks_k2!='')
			{
			$remarks_k1 = implode(",",$_SESSION['booking_info']['rema']);
			$remarks_k2 = $_SESSION['booking_info']['remar'];
			$rem_g1 = $remarks_k1.', '.$remarks_k2;
			$CommentList='<CommentList>
						<Comment type = "SERVICE">'.$rem_g1.'</Comment>
						<Comment type = "INCOMING">'.$rem_g1.'</Comment>
					</CommentList>';
			}
			else

			{
				$CommentList='<CommentList>
						<Comment type = "SERVICE">'.$remarks_k1.'</Comment>
					     <Comment type = "INCOMING">'.$remarks_k1.'</Comment>
					</CommentList>';
				
			}
		}
		elseif(isset($_SESSION['booking_info']['remar']) && $_SESSION['booking_info']['remar']!='')
		{
		
		$remarks_k2 = $_SESSION['booking_info']['remar'];
		$CommentList='<CommentList>
             <Comment type = "SERVICE">'.$remarks_k2.'</Comment>
                    <Comment type = "INCOMING">'.$remarks_k2.'</Comment>
                </CommentList>';
		}
		else
		{
			$CommentList='';
		}		
$ad_name =$_SESSION['booking_info']['fname'][0];
$ad_name1 =$_SESSION['booking_info']['lname'][0];		
  $booking_request ='<PurchaseConfirmRQ xmlns="http://www.hotelbeds.com/schemas/2005/06/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.hotelbeds.com/schemas/2005/06/messages PurchaseConfirmRQ.xsd" echoToken="DummyEchoToken">
	<Language>ENG</Language>
	<Credentials>
		<User>'.$client_id.'</User>
		<Password>'.$password.'</Password>
	</Credentials>
	<ConfirmationData purchaseToken="'.$purTokenVal.'">
		<Holder type="AD">
			<Name>'.$ad_name.'</Name>
			<LastName>'.$ad_name1.'</LastName>
		</Holder>
		<AgencyReference>'.$parent_pnr_no.'</AgencyReference>
		<ConfirmationServiceDataList>
			<ServiceData xsi:type="ConfirmationServiceDataHotel" SPUI="'.$serviceval.'">
				<CustomerList>'.$hotelbed_rooms.'
				</CustomerList>
					  '.$CommentList.'
			</ServiceData>
		</ConfirmationServiceDataList>
	</ConfirmationData>
</PurchaseConfirmRQ>';

//echo $URL;
//echo $booking_request;exit;

	  $response = $this->curl($booking_request);
//echo $response;exit;
 $responsessss='<PurchaseConfirmRS xmlns="http://www.hotelbeds.com/schemas/2005/06/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.hotelbeds.com/schemas/2005/06/messages PurchaseConfirmRS.xsd" echoToken="DummyEchoToken"><AuditData><ProcessTime>4381</ProcessTime><Timestamp>2013-07-22 23:03:48.385</Timestamp><RequestHost>123.201.135.77:77</RequestHost><ServerName>FORM</ServerName><ServerId>FO</ServerId><SchemaRelease>2005/06</SchemaRelease><HydraCoreRelease>2.0.201305161604</HydraCoreRelease><HydraEnumerationsRelease>1.0.201305161604</HydraEnumerationsRelease><MerlinRelease>N/A</MerlinRelease></AuditData><Purchase purchaseToken="FO110020078" timeToExpiration="1799982"><Reference><FileNumber>1808804</FileNumber><IncomingOffice code="164"></IncomingOffice></Reference><Status>BOOKING</Status><Agency><Code>81413</Code><Branch>1</Branch></Agency><Language>ENG</Language><CreationDate date="20130722"/><CreationUser>SKYTRAVEL1IQ81413</CreationUser><Holder type="AD"><Age>0</Age><Name>TEST</Name><LastName>TEST</LastName></Holder><AgencyReference>BS1374527029</AgencyReference><ServiceList><Service xsi:type="ServiceHotel" SPUI="164#H#1"><Reference><FileNumber>1808804-H1</FileNumber><IncomingOffice code="164"></IncomingOffice></Reference><Status>CONFIRMED</Status><ContractList><Contract><Name>NRF BAR</Name><IncomingOffice code="164"></IncomingOffice></Contract></ContractList><Supplier name="HOTELBEDS UK LIMITED" vatNumber="234328478"/><CommentList><Comment type="SERVICE">
Test</Comment><Comment type="INCOMING">Test</Comment></CommentList><DateFrom date="20130927"/><DateTo date="20130928"/><Currency code="GBP">United Kingdom Pound</Currency><TotalAmount>31.110</TotalAmount><AdditionalCostList><AdditionalCost type="AG_COMMISSION"><Price><Amount>0.000</Amount></Price></AdditionalCost><AdditionalCost type="COMMISSION_VAT"><Price><Amount>0.000</Amount></Price></AdditionalCost></AdditionalCostList><ModificationPolicyList><ModificationPolicy>Cancellation</ModificationPolicy><ModificationPolicy>Confirmation</ModificationPolicy><ModificationPolicy>Modification</ModificationPolicy></ModificationPolicyList><HotelInfo xsi:type="ProductHotel"><Code>39920</Code><Name>Comfort Hotel Heathrow</Name><Category type="SIMPLE" code="3EST">3 STARS</Category><Destination type="SIMPLE" code="LON"><Name>London</Name><ZoneList><Zone type="SIMPLE" code="10">Heathrow Airport</Zone></ZoneList></Destination></HotelInfo><AvailableRoom><HotelOccupancy><RoomCount>1</RoomCount><Occupancy><AdultCount>2</AdultCount><ChildCount>0</ChildCount><GuestList><Customer type="AD"><CustomerId>2</CustomerId><Age>30</Age></Customer><Customer type="AD"><CustomerId>1</CustomerId><Age>30</Age><Name>test</Name><LastName>test</LastName></Customer></GuestList></Occupancy></HotelOccupancy><HotelRoom SHRUI="lY3wwRZKRLN7y2+HhkAemg==" availCount="1" status="CONFIRMED"><Board type="SIMPLE" code="RO-U02">ROOM ONLY</Board><RoomType type="SIMPLE" code="DBT-U02" characteristic="ST">Double or Twin STANDARD</RoomType><Price><Amount>31.110</Amount></Price><CancellationPolicy><Price><Amount>31.110</Amount><DateTimeFrom date="20130721" time="2359"/><DateTimeTo date="20130927"/></Price></CancellationPolicy><HotelRoomExtraInfo><ExtendedData><Name>INFO_ROOM_AGENCY_BOOKING_STATUS</Name><Value>O</Value></ExtendedData><ExtendedData><Name>INFO_ROOM_INCOMING_BOOKING_STATUS</Name><Value>O</Value></ExtendedData></HotelRoomExtraInfo></HotelRoom></AvailableRoom></Service></ServiceList><Currency code="GBP"></Currency><PaymentData><PaymentType code="C"></PaymentType><Description>The total amount for this pro-forma invoice should be made in full to HOTELBEDS UK LIMITED, Bank: NatWest Bank PLC(City of London Office, PO Box 12258, 1 Princess Street, London EC2R 8PA.) Account:39256464, Sort code: 60 00 01, IBAN: GB60NWBK60000139256464,  SWIFT:NWBKGB2L,  7 days prior to clients arrival (except group bookings with fixed days in advance at the time of the confirmation) . Please indicate our reference number when making payment. Thank you for your cooperation.</Description></PaymentData><TotalPrice>31.110</TotalPrice></Purchase></PurchaseConfirmRS>
';
		$dom=new DOMDocument();
		$dom->loadXML($response);
		
		
		$Holder=$dom->getElementsByTagName("Holder");
			foreach($Holder as $Holderval)
			{
				$clientNameval=$Holderval->getElementsByTagName("Name");
				$clientFName = $clientNameval->item(0)->nodeValue; 
				$clientLNameval=$Holderval->getElementsByTagName("LastName");
				$clientLName = $clientLNameval->item(0)->nodeValue;
				$clientName = ucfirst($clientFName.' '.$clientLName);
			}
		  	$AgencyReference=$dom->getElementsByTagName("AgencyReference");
			$your_reference = $AgencyReference->item(0)->nodeValue;
			
			$arr = array('your_reference'=>$your_reference,'client'=>$clientName);
			$this->session->set_userdata($arr);
			
			$contract=$dom->getElementsByTagName("Contract");
								
					  	foreach($contract as $contractval)
					 
					  	$contractname=$contractval->getElementsByTagName("Name");
						$contractnameVal=$contractname->item(0)->nodeValue;
						
						 $agent=$dom->getElementsByTagName("Agency");
								
					  	foreach($agent as $agentval)
					 
					  	$agentname=$agentval->getElementsByTagName("Code");
						$agentnameVal=$agentname->item(0)->nodeValue;	

						 $Holder=$dom->getElementsByTagName("Holder");						
					  	foreach($Holder as $Holderval)
					     
					  	$Holder=$Holderval->getElementsByTagName("Name");
						$Holdername=$Holder->item(0)->nodeValue;
						$Holderlname=$Holderval->getElementsByTagName("LastName");
						$Holderlnameval=$Holderlname->item(0)->nodeValue;	
						
				$IncomingOfficecode=''	;	
			$IncomingOffice=$dom->getElementsByTagName("IncomingOffice");
			foreach($IncomingOffice as $sdasa)
			{
				$IncomingOfficecode = $IncomingOffice->item(0)->getAttribute("code");		 
			}
			// echo $IncomingOfficecode;
			 //exit;
			$bookingItemCode=$dom->getElementsByTagName("FileNumber");
			$bookingItemCodeval='';
			foreach($bookingItemCode as $aaaaaaaa)
			{
            $bookingItemCodeval = $bookingItemCode->item(0)->nodeValue;
			}
			
			
			 $statusval='';
			$status=$dom->getElementsByTagName("HotelRoom");
			foreach($status as $ddd)
			{
             $statusval = $status->item(0)->getAttribute("status");
			}
            
		   $cancel = $dom->getElementsByTagName( "CancellationPolicy" );
$dateFromValc='';
		  foreach($cancel as $canval)
		  {
	        $dateFromc=$canval->getElementsByTagName( "DateTimeFrom" );
		    $dateFromValc=$dateFromc->item(0)->getAttribute("date");
           
	      }
			
 			$dest=$dom->getElementsByTagName("Destination");
			  foreach($dest as $destval)
			  {
			$destName=$destval->getElementsByTagName("Name");	  
            $destNameval = $destName->item(0)->nodeValue;
			  } 
			  
	   $status=$dom->getElementsByTagName("HotelRoom");
       $statusval = $status->item(0)->getAttribute("status");
	   
	   $RoomType=$dom->getElementsByTagName("RoomType");
       $RoomTypeVal = $RoomType->item(0)->nodeValue;	
	   
	   $Board=$dom->getElementsByTagName("Board");
       $BoardTypeVal = $Board->item(0)->nodeValue;	 
	   
		
		
 						// $CommentList=$dom->getElementsByTagName("CommentList");
						 //$CommentListval=$CommentList->item(0)->nodeValue;
						 $CommentListval='';
						  
		   $Supplier=$dom->getElementsByTagName( "Supplier" );
		   $Suppliername=$Supplier->item(0)->getAttribute("name");
		   $vat=$Supplier->item(0)->getAttribute("vatNumber");
		   $ref=$Supplier->item(0)->getAttribute("ref");
		   
		   if($ref=='')
		   {
		   $comp_pol= 'Payable through'.' '.$Suppliername.' '.', acting as agent for the service operating company, details of which can be provided upon request. VAT:'.$vat;
		   }
		   else
		   {
		   $comp_pol= 'Payable through'.' '.$Suppliername.' '.', acting as agent for the service operating company, details of which can be provided upon request. VAT:'.$vat.' '.' Reference:'.$ref;
		   }
		   
		   
			
				$IncomingOfficecode=''	;	
			$IncomingOffice=$dom->getElementsByTagName("IncomingOffice");
			foreach($IncomingOffice as $sdasa)
			{
				$IncomingOfficecode = $IncomingOffice->item(0)->getAttribute("code");		 
			}
			
			$bookingItemCode=$dom->getElementsByTagName("FileNumber");
			$bookingItemCodeval='';
			foreach($bookingItemCode as $aaaaaaaa)
			{
            $bookingItemCodeval = $bookingItemCode->item(0)->nodeValue;
			}
			
			$bookingItemCodeval_final = $IncomingOfficecode.'-'.$bookingItemCodeval;
			$booking_status='Success';
			
			
			$statusval='';
			$status=$dom->getElementsByTagName("HotelRoom");
			foreach($status as $ddd)
			{
             $statusval = $status->item(0)->getAttribute("status");
			}
			$book_noval='';
				$AgencyReference=$dom->getElementsByTagName("AgencyReference");
				foreach($AgencyReference as $sdsadsa)
			{
             $book_noval = $AgencyReference->item(0)->nodeValue;
			}
			
		if($statusval=='')
		{
		$booking_status='Failed';
		$bookingItemCodeval='XXXXXXXXXXX';
		$statusval='Failed';
		$book_noval='XXXXXXXXXXX';
		}
		
		if(isset($_SESSION['book_final_book_val']['rema'][0]) && $_SESSION['book_final_book_val']['rema']!='')
		{
		$remarks_kf1 = implode(",",$_SESSION['book_final_book_val']['rema']);
		$remarks_k1s = $remarks_kf1.' <br>'.$_SESSION['book_final_book_val']['remar'];
			
			
		}
		elseif(isset($_SESSION['book_final_book_val']['remar']) && $_SESSION['book_final_book_val']['remar']!='')
		{
		
		$remarks_k1s = $_SESSION['book_final_book_val']['remar'];
		
		}
		else
		{
			$remarks_k1s='';
		}
		$this->insert_booking_data_hb($this->ses_id,$cart_id,$bookingItemCodeval_final,$statusval,$book_noval,$booking_status,$parent_pnr_no,$parent_pnr_no1,$cancel_policy,$comp_pol,$remarks_k1s, $pass_info);
	}
	function insert_booking_data_hb($ses_id,$cart_id,$bookingItemCodeval,$statusval,$book_noval,$booking_status,$parent_pnr_no,$parent_booking_number,$cancel_policy='',$com_pol,$remarks_k1s, $pass_info)
		{
			
			$cancellation_till_charge = '';
			$markup = '';
			$gateway = '';
			$currency_val = '';
			$xml_currency = '';
			$cancellation_till_date = '';
			$cancellation_till_charge = '';
			$agent_markup = '';
			$callcenterid = '';
			$agent_mode = '';
			$agent_mode_status = '';
			$cancellation_by = '';
			$promo = '';
			$cust_remark = $com_pol;
			$cust_remark1 = $remarks_k1s;
			$feed_back = $pass_info;
			$cin_val = explode("/",$_SESSION['hotel_search']['cin']);
			$cout_val = explode("/",$_SESSION['hotel_search']['cout']);
			$check_in =$cin_val[2].'-'.$cin_val[0].'-'.$cin_val[1];
			$check_out = $cout_val[2].'-'.$cout_val[0].'-'.$cout_val[1];
			$address = '';

			$phone = '';
			$fax = '';
			$nights = $_SESSION['days'];
			$child_age = '';
			$adult_info = '';
			$child_info = '';
			$passanger = $_SESSION['booking_info']['sal'][0].' '.$_SESSION['booking_info']['fname'][0].' '.$_SESSION['booking_info']['lname'][0];
			$pass_mobile_no = $_SESSION['booking_info']['mobile'];
			$voucher_date=date("Y-m-d H:i:s");      
			$ip_address=$_SESSION['track_hostval'];
			$ip_country=$_SESSION['track_countryNameval'];
			$ip_city=$_SESSION['track_cityval'];
			$image = '';
			$degree_id = ''; 
			


		
		
			$query=$this->db->query("INSERT INTO booking (parent_pnr_no,booking_number,pnr_no,domain_id,
									amount,api_status,booking_status,markup,gateway,currency_val,xml_currency,cancellation_till_date				                         ,cancellation_till_charge,agent_markup,callcenterid,agent_mode,agent_mode_status,cancellation_by,promo,cust_remark,cust_remark1,feed_back,									check_in,check_out,hotel_code,hotel_name,city,room_type,star,address,room_count,cancel_policy,adult,child,description,phone,fax,nights,api,
									inclusion_val,child_age,adult_info,child_info,passanger,pass_mobile_no,voucher_date,ip_address,ip_country,ip_city,parent_booking_number,image,remarks) 
																			
									SELECT '$parent_pnr_no','$bookingItemCodeval','$book_noval','1',total_cost,'$statusval','$booking_status','$markup','$gateway','$currency_val','$xml_currency','$cancellation_till_date','$cancellation_till_charge','$agent_markup','$callcenterid','$agent_mode','$agent_mode_status','$cancellation_by','$promo','$cust_remark','$cust_remark1','$feed_back',									'$check_in','$check_out',hotel_code,hotel_name,city,room_type,star,'$address',room_count,'$cancel_policy',adult,child,description,'$phone','$fax','$nights',api,
									inclusion,'$child_age','$adult_info','$child_info','$passanger','$pass_mobile_no','$voucher_date','$ip_address','$ip_country','$ip_city','$parent_booking_number',image,comment_remarks FROM shopping_cart_hotel WHERE shopping_cart_hotel_id=$cart_id");
		
		//echo $this->db->last_query();exit;
		
		
		}
	function cancellation_policy($cart_id)
	{
		$this->city = $_SESSION['hotel_search']['dest_code'];
		//echo $this->city;
		$cinval = explode("/",$_SESSION['hotel_search']['cin']);
		$cin  = $cinval[2].$cinval[0].$cinval[1];
		$coutval = explode("/",$_SESSION['hotel_search']['cout']);
		$cout  = $coutval[2].$coutval[0].$coutval[1];
		$city_info = $this->get_city_code($this->city);
		//print_r($this->cout);print_r($this->cin);exit;
		$this->city_code = $city_info->city_code;
		$this->countrycode = $city_info->countrycode;
		//$this->zone_id =$city_info->zone_id;
		//$this->city_code ="ALE";
		//echo 'hiii'.$this->city_code;exit;
				$this->days = $_SESSION['hotel_search']['days'];
		$this->room_count = $_SESSION['hotel_search']['room_count'];
		$this->adult = $_SESSION['hotel_search']['adult'];
		$this->child = $_SESSION['hotel_search']['child'];
		$this->child_age = $_SESSION['hotel_search']['child_age'];
		$this->adult_count = $_SESSION['hotel_search']['adult_count'];
		$this->child_count= $_SESSION['hotel_search']['child_count'];
		$this->sec_id=$_SESSION['hotel_search']['session_id'];


		$cart_result =  $this->fetch_cart_search_result_db_cartid($this->sec_id,$cart_id);
	
		$room_cnt = $cart_result->room_count;
		$token_code = array();
		$contractnameVal = array();
		
		$inoffcode= array();
		
		$destCodeVal = array();
		$child = array();
		$room_count = array();
		$adult= array();
		$shurival = array();
		$board_type= array();
		$shortname= array();
		$charval= array();
		$room_code = array();
		$child_age_db=array();
		
		for($i=0;$i< $_SESSION['hotel_search']['room_count'];$i++)
			{
				$array_vals[] =  $_SESSION['hotel_search']['adult'][$i].",".$_SESSION['hotel_search']['child'][$i];
			}
		
			$hotelbed_rooms='';
		
			$check_array=array();
			
			for($k=0;$k<count($array_vals);$k++)
			{
				if(isset($_SESSION['hotel_search']['child_age'][$k]))
				{
				$child_age  = $_SESSION['hotel_search']['child_age'][$k];
				}
				else
				{
				$child_age = '';
				}
				$key = array_search($array_vals[$k], $check_array);
				
				if ($key) 
				{
				
				unset($check_array[$key]);
				$split_key = explode("||",$key);
				$key_count = $split_key[0]+1;
					$check_array[$key_count."||".$split_key[1].",".$child_age] = $array_vals[$k];
				}
				else
				{
					
					$check_array['1||'.$child_age.'||'.$k] = $array_vals[$k];
				
				}
				
			}
				
	if(strrpos($room_cnt,"<br>") == false)
	{
		
		$token_code[] = $cart_result->token;
		$contractnameVal[] = $cart_result->contractnameVal;
		
		$inoffcode[] = $cart_result->inoffcode;
		
		$hotel_code =$cart_result->hotel_code;
		$destCodeVal[] = $cart_result->destCodeVal;
		$child[] = $cart_result->child;
		$room_count[] = $cart_result->room_count;
		$adult[]= $cart_result->adult;
		$shurival[] = $cart_result->shurival;
		$board_type[] = $cart_result->board_type;
		$shortname[] = $cart_result->shortname;
		$charval[] = $cart_result->charval;
		$child_age_db[] = $cart_result->child_age;
		$room_code[] = $cart_result->room_code;
		$room_count_data = 1;
	}
	else
	{
		
		$token_code = explode("<br>",substr($cart_result->token, 0, -4));
		$contractnameVal = explode("<br>",substr($cart_result->contractnameVal, 0, -4));
		
		$inoffcode = explode("<br>",substr($cart_result->inoffcode, 0, -4));
		
		$hotel_code =$cart_result->hotel_code;
		$destCodeVal = explode("<br>",substr($cart_result->destCodeVal, 0, -4));
		$child = explode("<br>",substr($cart_result->child, 0, -4));
		$room_count = explode("<br>",substr($cart_result->room_count, 0, -4));
		$adult = explode("<br>",substr($cart_result->adult, 0, -4));
		$shurival = explode("<br>",substr($cart_result->shurival, 0, -4));
		$board_type = explode("<br>",substr($cart_result->board_type, 0, -4));
		$shortname = explode("<br>",substr($cart_result->shortname, 0, -4));
		$charval = explode("<br>",substr($cart_result->charval, 0, -4));
		$room_code = explode("<br>",substr($cart_result->room_code, 0, -4));
		$child_age_db = explode("<br>",substr($cart_result->child_age, 0, -4));
		
		
		$room_count_data = count($token_code);
	}
	
		$room1ss='';
		

		//for($l=0;$l<count($check_array);$l++)
		$l=0;
		foreach($check_array as $key=>$value)
	
		{
			$key_v1 = explode("||",$key);
			
		
								// $destCodeVal=trim($destCodeVal[$l]);  //destination code
								 $ck='';
								 $chi='';
								//  for($hhs=0;$hhs < $adult[$l]; $hhs++)
							//	 {
									// $chi .='<Customer type="AD"/>';
							//	 }
								 if($child[$l] > 0)
								 {
									 //echo $attribr5->room_count.' '.$attribr5->child.'||||';
									// $dd=$room_count[$l]*$child[$l];
									 $c_age = explode(",",$child_age_db[$l]);
									// echo print_r($c_age);exit;
									   for($ac=0;$ac< count($c_age);$ac++)
								   {	
											$chi .= '
												<Customer type = "CH">
													<Age>'.$c_age[$ac].'</Age>
												</Customer>';
								   }
								
								 }
								 else
								 {
									 $chi .='';
								 }
								// echo $chi;
								$chi_v1='';
								if($chi!='')
								{
									$chi_v1 = '<GuestList>
										'.$chi.'
											</GuestList>';
								}
			$room1ss .='<AvailableRoom>
					<HotelOccupancy>
						<RoomCount>'.$room_count[$l].'</RoomCount>
						<Occupancy>
								<AdultCount>'.$adult[$l].'</AdultCount>
							<ChildCount>'.$child[$l].'</ChildCount>
							
						'.$chi_v1.'
							
						</Occupancy>
					</HotelOccupancy>
					<HotelRoom SHRUI="'.$shurival[$l].'" >
						<Board type="SIMPLE" code="'.$board_type[$l].'" shortname="'.$shortname[$l].'"/>
						<RoomType type="SIMPLE" code="'.$room_code[$l].'" characteristic="'.$charval[$l].'"/>
					</HotelRoom>
				</AvailableRoom>';
				$l++;	
		}
		
	 $request ='<ServiceAddRQ xmlns="http://www.hotelbeds.com/schemas/2005/06/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.hotelbeds.com/schemas/2005/06/messages ServiceAddRQ.xsd" echoToken="token">
		<Language>ENG</Language>
		<Credentials>
			<User>'.$client_id.'</User>
		<Password>'.$password.'</Password>
		</Credentials>
		<Service xsi:type="ServiceHotel"  availToken="'.$token_code[0].'">
			<ContractList>
				<Contract>
					<Name>'.$contractnameVal[0].'</Name>
					<IncomingOffice code="'.$inoffcode[0].'"/>
				</Contract>
			</ContractList>
			<DateFrom date="'.$cin.'"/>
			<DateTo date="'.$cout.'"/>
			<HotelInfo xsi:type="ProductHotel">
				<Code>'.$hotel_code.'</Code>
				<Destination type="SIMPLE" code="'.$this->city.'"/>
			</HotelInfo>'.$room1ss.'
		</Service>
	</ServiceAddRQ>';
//echo $request;
$response = $this->curl($request);
		//$response = $this->curl($request);
//echo $response;
			  $dom1 = new DOMDocument();
			   $dom1->loadXML($response);
			   $Messageval='';
					$Message = $dom1->getElementsByTagName( "Message" );
					foreach($Message as $dddd)
					{
				$Messageval=$Message->item(0)->nodeValue;
					}
	//echo $Message;exit;
		
			
		$Commentval='';
		if($Messageval =='')
		{
		
		
			
			   $dom = new DOMDocument();
			   $dom->loadXML($response);
				
		
				$purToken = $dom->getElementsByTagName( "Purchase" );
				$purTokenVal=$purToken->item(0)->getAttribute("purchaseToken");
				
			
				$service = $dom->getElementsByTagName("Service");
				$serviceval=$service->item(0)->getAttribute("SPUI");
				
				
					$Contract = $dom->getElementsByTagName( "Contract" );
						foreach($Contract as $contractval)
						{
							$CommentList=$contractval->getElementsByTagName( "CommentList" );
							foreach($CommentList as $commentval)
							{
								$Comment=$commentval->getElementsByTagName( "Comment" );
								$Commentval =$Comment->item(0)->nodeValue;
								
								
							}
						}
							
						$Supplier = $dom->getElementsByTagName( "Supplier" );
						$vatNumber=$Supplier->item(0)->getAttribute("vatNumber");

					    $cancel = $dom->getElementsByTagName( "CancellationPolicy" );
			
						  foreach($cancel as $canval)
						  {
			
							   $cancelprice=$canval->getElementsByTagName( "Amount" );
							   $canceldisplayValc=$cancelprice->item(0)->nodeValue;
							   $data['cancel_amt']=$canceldisplayValc;
			
			
			
							   $dateFromc=$canval->getElementsByTagName( "DateTimeFrom" );
							   $dateFromValc=$dateFromc->item(0)->getAttribute("date");
							   $time=$dateFromc->item(0)->getAttribute("time");
							   $data['datefrom']=$dateFromValc;
								$data['time']=$time;
									   
								$dateToc=$canval->getElementsByTagName( "DateTimeTo" );
								$dateToValc=$dateToc->item(0)->getAttribute("date");
								$data['dateto']=$dateToValc;
									   
				
								$CommentListval='';
							  $data['comment']=$CommentListval;			   
					   
							  $curr=$dom->getElementsByTagName( "Currency" );
							  $data['currencyCode']=$currencyCode=$curr->item(0)->getAttribute("code");	
			
			
							   $dateToc=$canval->getElementsByTagName( "DateTimeTo" );
							   $dateToValc=$dateToc->item(0)->getAttribute("date");
							   $data['dateto']=$dateToValc;
							  
							 }
								$AvailableRoom=$dom->getElementsByTagName( "AvailableRoom");
								$rt=0;
								$rt=0;
								$cust_id=array();
								$age=array();
								$RoomCount_val_n1 = array();
										$Room_val_n1 = array();
										$rby_rom_cnt='';
										$rby_rom='';
								foreach($AvailableRoom as $AvailableRoomval)
								{
									$HotelRoom=$AvailableRoomval->getElementsByTagName( "HotelRoom" );
									$RoomType=$AvailableRoomval->getElementsByTagName( "RoomType" );	
									$rtname[]=$RoomType->item(0)->nodeValue;
									$rby_rom=$RoomType->item(0)->nodeValue;
									$HotelOccupancy=$AvailableRoomval->getElementsByTagName("HotelOccupancy");
									foreach($HotelOccupancy as $Hote_O)
									{
										$Occupancy=$Hote_O->getElementsByTagName("Occupancy");
										foreach($Occupancy as $occ)
										{
											$GuestList=$occ->getElementsByTagName("GuestList");
											foreach($GuestList as $gl)
											{
												$Customer=$gl->getElementsByTagName("Customer");
												
												foreach($Customer as $cus)
												{
													$customer_type[]=$cus->getAttribute("type");
													$CustomerId=$cus->getElementsByTagName("CustomerId");
													foreach($CustomerId as $cid)
													{
														$cust_id[]=$cid->nodeValue;
														
													}
													$Age=$cus->getElementsByTagName("Age");
													foreach($Age as $a)
													{
														$age[]=$a->nodeValue;
													}
													
												}
												
											
											}
									
										}
									}
									$RoomCount=$AvailableRoomval->getElementsByTagName( "RoomCount" );	
									$RoomCount_val[]=$RoomCount->item(0)->nodeValue;
									$rby_rom_cnt =$RoomCount->item(0)->nodeValue;
							
								   $CancellationPolicy=$AvailableRoomval->getElementsByTagName( "CancellationPolicy" );	
								   
									foreach($CancellationPolicy as $CancellationPolicyval)
									{
										$k=0; 
										$Price=$CancellationPolicyval->getElementsByTagName( "Price" );	
									foreach($Price as $Pricessds)
									{
										$RoomCount_val_n1[] = $rby_rom_cnt;
										$Room_val_n1[] = $rby_rom;
										$DateTimeFrom=$Pricessds->getElementsByTagName( "DateTimeFrom" );	
										$from1[]=$DateTimeFrom->item(0)->getAttribute("date");
										$time1[]=$DateTimeFrom->item(0)->getAttribute("time");
										$Amount=$CancellationPolicyval->getElementsByTagName( "Amount" );	
										$amt[]=$Amount->item($k)->nodeValue;
										
										$k++;
									}
									 } 
									 $rt++;
								}
								
									$data['rtname']=$rtname;
									$data['from1']=$from1;
									$data['time1']=$time1;
									$data['amt']=$amt;
									$this->insert_booking_attrib($this->sec_id,$api,$purTokenVal,$serviceval,$canceldisplayValc,$dateFromValc,$dateToValc);
							
							$cancel_req='ok';
							
							
							
							$cancel_amt_eur=array();
							if($cancel_req!='')
							{
							
								$cancel_policy='';
								
													
							 if($Commentval=='')
							 {
								
								$Commentval="No remarks from this hotel<br>";
							 }
							 else
							 {
								
								 $Commentval=$Commentval.'<br>';
							 }
							 
					  // $cancel_policy .= $contract_remarks;
						 $data['contract_remarks'] = $Commentval;
							 
								  // echo '<pre/>';print_r($RoomCount_val_n1);exit;
						  for($i=0;$i< count($RoomCount_val_n1);$i++)
						  {
							
							  
								$cancel_policy .= ' In the event of cancellation or changes for '.$RoomCount_val_n1[$i].' '.$Room_val_n1[$i].' ' ;
					
						$cancel_amt_eur_org = number_format($amt[$i] ,2,'.','');
						if($currencyCode !='USD')
																 {
																	 $c_val1 =$this->get_currecy_details($currencyCode);
																	
																	 $c_val = $c_val1->value;
																	 if($c_val !='')
																	 {
																	 $org_amt_cancel=$amt[$i] /  $c_val;
																	
																	 }
																	 else
																	 {
																		
																		 $org_amt_cancel=$amt[$i];
																	
																	
																	 }
																 }
																 else
																 {
																	 $org_amt_cancel=$amt[$i];
																 }
																$amountv =  number_format($org_amt_cancel ,2,'.','');
						 
															
						  
						   $year=substr($from1[$i],0,4); 
						   $mon=substr($from1[$i],4,2); 
						   $date=substr($from1[$i],6,2);
						   $hour=substr($time1[$i],0,2);
						   $min=substr($time1[$i],2,2);
						   $cancel_policy .= ' after '.$hour.':'. $min.' on '.$date.'-'.$mon.'-'.$year;
						   $cancel_policy .= ' the following charges will be applied: '.$amountv.' USD'; 
						   $newdate3=$year.'-'.$mon.'-'.$date;
						   $cancel_policy .=  '<br/>';
						  
						  }
						   $cancel_policy=$cancel_policy;
							   
								}
							else
							{
								$cancel_policy='Nil';
							} 
							 
				 $data['new_cancelaion_till_date']=$year.'-'.$mon.'-'.$date;
				 $data['new_cancelaion_charge']=array_sum($cancel_amt_eur);
				 $cancellation_date = $data['new_cancelaion_till_date'];
	if(isset($Commentval))
	{
	$Commentval= mysql_escape_string($Commentval);
	}
	else
	{
		$Commentval = '';
	}
	$cancel_policy= mysql_escape_string($cancel_policy);
	
		$this->db->query("UPDATE shopping_cart_hotel SET cancel_policy='$cancel_policy',comment_remarks='$Commentval',purTokenVal='$purTokenVal',serviceval='$serviceval',cancellation_date='$cancellation_date' WHERE shopping_cart_hotel_id='$cart_id'");
		//echo $this->db->last_query();exit;
		}		
		else
		{
		}
	}
			function insert_booking_attrib($sec_res,$api,$purTokenVal,$serviceval,$canceldisplayValc,$dateFromValc,$dateToValc)
		{
	
			$data=array('criteria_id'=>$sec_res,'api_name'=>$api,'token_val'=>$purTokenVal,'service_val'=>$serviceval,'cancel_amt'=>$canceldisplayValc,'from_date'=>$dateFromValc,'to_date'=>$dateToValc);

			$this->db->insert('booking_attrib_hb',$data);
//echo $this->db->last_query();exit;
		}
	function fetch_cart_search_result_db_cartid($ses_id,$cart_id)
	{
		$this->db->select('*');
		$this->db->from('asia_hotel_room_list');
		$this->db->where('session_id',$ses_id);
		$this->db->where('id',$cart_id);
		$query = $this->db->get();	
		return $query->row();
		
		
	}
		function get_reservation_details_id($id)
	{
		
				$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('parent_pnr_no',$id);
	//	echo $this->db->last_query(); exit;
		$query = $this->db->get();	
	
		return $query->row();
	}
	function get_city_code($city)
	{		
		$this->db->select('*');
		$this->db->from('asia_city_list');
		$this->db->where('city_code',$city);
		$query = $this->db->get();
		if($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		}
	}

		function curl($request)
	{

		$ch2=curl_init();
		//echo $request;
		$post_url='http://212.170.239.71/appservices/http/FrontendService';
        curl_setopt($ch2, CURLOPT_URL, $post_url);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, "$request");
	/*	curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
		curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);*/
	  	//curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
        $httpHeader2 = array(
            "Content-Type: text/xml; charset=UTF-8",
            "Content-Encoding: UTF-8",
			"Accept-Encoding: gzip,deflate"
        );
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
		curl_setopt ($ch2, CURLOPT_ENCODING, "gzip,deflate");
        // Execute request, store response and HTTP response code
        $data2=curl_exec($ch2);
        $error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
        curl_close($ch2);
		//echo $data2;exit;
		return $data2;
	}

}

?>

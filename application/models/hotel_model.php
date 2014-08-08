<?php 
	class Hotel_Model extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function checkUserExists($userName, $password)
	{
		$query = $this->db->query("SELECT * FROM  master_customer WHERE emailid='$userName' AND password='".$password."'");
		if ($query->num_rows > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function checkUserExistss($userName,$password)
	{
		$query = $this->db->query("SELECT * FROM  master_customer WHERE emailid='$userName' AND password='".$password."'");
		if ($query->num_rows == '')
		{
			return '';
		}
		else
		{
			$dd =  $query->row();
			return $dd;
		}
	}

	function update_hotel_city($name,$api,$id)
	{
		$this->db->query("UPDATE api_permanent SET city='$id' WHERE api='hotelsbed' AND  hotel_code ='$name'");
	}

	function fetch_temp_result_room($ses_id,$hotel_code)
	{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_t');
		$this->db->where('session_id',$ses_id);
		$this->db->where('hotel_code',$hotel_code);
		//$this->db->where('hotel_code',$hotel_code);
		//$this->db->group_by('room_code'); 
		$this->db->order_by("total_cost",'ASC'); 
		$query = $this->db->get();	
		//echo $this->db->last_query();exit;
		return $query->result();
	}

	function fetch_temp_result_room_id($result_id)
	{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_t');
		$this->db->where('api_temp_hotel_id',$result_id);
		$query = $this->db->get();	
		//echo $this->db->last_query();exit;
		return $query->row();
	}
	
//own inventory function
	function fetch_own_result_room($hotel_code)
	{
		$this->db->select('*');
		$this->db->from('hotel_room_list');
		$this->db->where('HotelCode',$hotel_code);
		$query = $this->db->get();	
		return $query->result();
	}
	function fetch_temp_result_own_room_id($result_id)
	{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_t');
		$this->db->where('room_code',$result_id);
		$query = $this->db->get();	
		//echo $this->db->last_query();exit;
		return $query->row();
	}
	function fetch_temp_result_own_room_id_v1($result_id)
	{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_t');
		$this->db->where('api_temp_hotel_id',$result_id);
		$query = $this->db->get();	
		//echo $this->db->last_query();exit;
		return $query->result();
	}
//End own inventory

	function fetch_temp_result_room_id_v1($result_id)
	{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_t');
		$this->db->where('api_temp_hotel_id',$result_id);
		$query = $this->db->get();	
		//echo $this->db->last_query();exit;
		return $query->result();
	}

	function get_degree_id($b_id,$t_id)
	{
		$que = "select degree_id from  priceline_hotels where  	hotelid_b ='$b_id' AND 	hotelid_t ='$t_id' ";
		$query= $this->db->query($que);
		if ($query->num_rows() == '')
		{
			return '';
		}
		else
		{
			$v =  $query->row();
			return $v->degree_id;
		}
	}

	function get_currecy_details($currency)
	{
		$que = "select * from  currency_converter where country='$currency' ";
		$query = $this->db->query($que);
		if ($query->num_rows() == '')
		{
			return '';
		}
		else
		{
			return $query->row();
		}
	}

	function get_asia_room_details_v1($session,$h_id,$r_id)
	{
		$que = "select * from  api_hotel_detail_t_asia_room where session_id='$session' and HotelCodeval='$h_id' and RoomCodeval='$r_id' ";
		$query = $this->db->query($que);
		if ($query->num_rows() == '')
		{
			return '';
		}
		else
		{
			return $query->row();
		}
	}

	function get_asia_image_details_v1($r_id)
	{
		$que = "select * from  api_hotel_detail_t_asia_image where  RoomTypeCodeval='$r_id' ";
		$query = $this->db->query($que);
		if ($query->num_rows() == '')
		{
			return '';
		}
		else
		{
			return $query->row();
		}
	}
	
	function get_amentity($b_id)
	{
		$que="select amenity_name from  priceline_amenity where  	amenity_code ='$b_id' ";
		$query= $this->db->query($que);
		if ($query->num_rows() == '')
		{
			return '';
		}
		else
		{
			$v =  $query->row();
			return $v->amenity_name;
		}
	}

	function insert_biz_rule_alert($domain,$degree_id,$room,$total,$orgamt,$cin,$cout)
	{
		$data = array('domain_id'=>$domain,'degree_id'=>$degree_id,'room_type'=>$room,'total_cost'=>$total,'org_amt'=>$orgamt,'cin'=>$cin,'cout'=>$cout);
		$this->db->insert('biz_rules_alert',$data);
	}

	function fetch_gta_temp_result_room($ses_id,$hotel_code)
	{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_t');
		$this->db->where('session_id',$ses_id);
		$this->db->where('biz_status','1');
		//$this->db->where('hotel_code',$hotel_code);
		//$this->db->group_by('room_code'); 
		$this->db->order_by("total_cost",'ASC'); 
		$query = $this->db->get();	
		//echo $this->db->last_query();exit;
		return $query->result();
	}

	function fetch_gta_temp_result_room_apiwise($ses_id,$hotel_code,$api)
	{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_t');
		$this->db->where('session_id',$ses_id);
		$this->db->where('api',$api);
		$this->db->where('biz_status','0');
		//$this->db->where('hotel_code',$hotel_code);
	  //	$this->db->group_by('room_code'); 
		$this->db->order_by("total_cost",'ASC'); 
		$query = $this->db->get();	
	//	echo $this->db->last_query();exit;
		return $query->result();
	}

	function fetch_gta_temp_result_room_apiwise_hd($ses_id,$hotel_code,$api)
	{
		
		$this->db->select('*');
		$this->db->from('api_hotel_detail_t');
		$this->db->where('session_id',$ses_id);
		$this->db->where('api',$api);
	//	$this->db->where('biz_status','0');
		//$this->db->where('hotel_code',$hotel_code);
		//$this->db->group_by('room_code'); 
		$this->db->order_by("total_cost",'ASC'); 
		$query = $this->db->get();	
	//	echo $this->db->last_query();exit;
		return $query->result();
	}

	function getting_review_count($pid,$tid)
	{
		
		$this->db->select('*');
		$this->db->from('priceline_review');
		$this->db->where('hotelid_b',$pid);
		$this->db->where('hotelid_t',$tid);
		$query = $this->db->get();
		if ($query->num_rows() == '')
		{
			return '';
		}
		else
		{
			$s = $query->row();
			return  $s->review_count;
		}
	}

	function getting_priceline_hotels($pid,$tid)
	{
		
		$this->db->select('property_description,hotelid_hb,hotelid_gta,hotelid_tc,hotel_name');
		$this->db->from('priceline_hotels');
		$this->db->where('hotelid_b',$pid);
		$this->db->where('hotelid_t',$tid);
	  
		$query = $this->db->get();	
		 if ($query->num_rows() == '')
			{
				return '';
			}
			else
			{
					$s = $query->row();
		
					return  $s;
			}

	}
		function get_priceline_hotels_api($api,$tid)
	{
		

		$this->db->select('hotelid_b,hotelid_t,hotel_name,hotel_address_full,property_description,thumbnail,overall_rating,review_count,star_rating');
		$this->db->from('priceline_hotels');
		$this->db->where($api,$tid);
		$this->db->where('cityid_ppn',$_SESSION['city_code']);
	  
		$query = $this->db->get();	
		 if ($query->num_rows() == '')
			{
				return '';
			}
			else
			{
					$s = $query->row();
		
					return  $s;
			}

	}
	function fetch_gta_temp_result_room_m1($ses_id,$hotel_code)
	{
		$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hotel_code' AND `session_id` = '$ses_id'  GROUP BY Classification_val ORDER BY api_temp_hotel_id";
		$query= $this->db->query($que);
		return $query->result();
	}
		function fetch_gta_temp_result_room_m2($ses_id,$hotel_code,$classval)
	{
		
		$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hotel_code' AND `session_id` = '$ses_id' AND `Classification_val` = '$classval'  GROUP BY Promotionsaa ORDER BY api_temp_hotel_id";
			//echo $que;exit;
			$query= $this->db->query($que);
		
			return $query->result();
	}
		function fetch_gta_temp_result_room_m2_v1($ses_id,$hotel_code,$classval)
	{
		

		
		$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hotel_code' AND `session_id` = '$ses_id' AND `Classification_val` = '$classval'  GROUP BY Promotionsaa ORDER BY total_cost ASC";
			//echo $que;exit;
			$query= $this->db->query($que);
		
			return $query->result();
	}
	function fetch_gta_temp_result_room_m3_v1($ses_id,$hotel_code,$classval,$prom)
	{

		$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hotel_code' AND `session_id` = '$ses_id' AND `Classification_val` = '$classval' AND `Promotionsaa` = '$prom' GROUP BY inclusion ORDER BY total_cost ASC";
			//echo $que;exit;
			$query= $this->db->query($que);
		
			return $query->result();
		
	}
	function fetch_gta_temp_result_room_m4_v1($ses_id,$hotel_code,$classval,$prom,$inclusion)
	{
		
		
		
		$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hotel_code' AND `session_id` = '$ses_id' AND `Classification_val` = '$classval' AND `Promotionsaa` = '$prom' AND `inclusion` = '$inclusion' group by adult,child  ORDER BY total_cost ASC";
		//	echo $que;exit;
			$query1= $this->db->query($que);
			
		
		   if ($query1->num_rows() == '')
			{
				return '';
			}
			else
			{
				
				 $res = $query1->result();
				 $aa=array();
			
				
			for($k=0;$k<count($res);$k++)
			{
				$adult = $res[$k]->adult;
				$child = $res[$k]->child;
				$que2 = "SELECT *,min(total_cost) as least_cost FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hotel_code' AND `session_id` = '$ses_id' AND `Classification_val` = '$classval' AND `Promotionsaa` = '$prom' AND `inclusion` = '$inclusion' AND `adult` = '$adult' AND `child` = '$child' ORDER BY total_cost ASC";
		//	echo $que;exit;
				$query2= $this->db->query($que2);
				
				 $res2 = $query2->result();
								
				 $least_cost = $res2[0]->least_cost;
				 
				 $que1 = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hotel_code' AND `session_id` = '$ses_id' AND `Classification_val` = '$classval' AND `Promotionsaa` = '$prom' AND `inclusion` = '$inclusion' AND `total_cost` = '$least_cost' ";
				//echo $que1;exit;
			
				$query= $this->db->query($que1);
				$aa[] =  $query->result();
			
									
				
			
			}
			
		
			return $aa;
			}
	}
	function fetch_gta_temp_result_room_m3($ses_id,$hotel_code,$classval,$prom)
	{
		
		$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hotel_code' AND `session_id` = '$ses_id' AND `Classification_val` = '$classval' AND `Promotionsaa` = '$prom' GROUP BY room_type ORDER BY api_temp_hotel_id";
			//echo $que;exit;
			$query= $this->db->query($que);
		
			return $query->result();
		
	}
	function fetch_gta_temp_result_room_m4($ses_id,$hotel_code,$classval,$prom,$room_type)
	{

		
		$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hotel_code' AND `session_id` = '$ses_id' AND `Classification_val` = '$classval' AND `Promotionsaa` = '$prom' AND `room_type` = '$room_type' GROUP BY inclusion,room_type ORDER BY api_temp_hotel_id,total_cost";
			//echo $que;exit;
			$query= $this->db->query($que);
		
			return $query->result();
	}

	function fetch_gta_temp_result_room_m5($ses_id,$hotel_code,$classval,$prom,$room_type,$incl)
	{
		$que = "SELECT *,min(total_cost) as least_cost FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hotel_code' AND `session_id` = '$ses_id' AND `Classification_val` = '$classval' AND `Promotionsaa` = '$prom' AND `room_type` = '$room_type' AND `inclusion` = '$incl' ORDER BY api_temp_hotel_id,total_cost";
			
			$query1= $this->db->query($que);
				   
			if ($query1->num_rows() == '')
			{
				return '0';
			}
			else
			{
				 $res = $query1->result();
			
				 $least_cost = $res[0]->least_cost;
				 
				 $que1 = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hotel_code' AND `session_id` = '$ses_id' AND `Classification_val` = '$classval' AND `Promotionsaa` = '$prom' AND `room_type` = '$room_type' AND `inclusion` = '$incl' AND `total_cost` = '$least_cost' ORDER BY api_temp_hotel_id,total_cost";
			
				$query= $this->db->query($que1);
				return $query->result();
			}
			
		
	}

	function fetch_gta_temp_result_room_hotelbeds($ses_id,$hotel_code,$room=1)
	{

	}
	function insert_booking_attrib($sec_res,$api,$purTokenVal,$serviceval,$canceldisplayValc,$dateFromValc,$dateToValc)
	{

		$data=array('criteria_id'=>$sec_res,'api_name'=>$api,'token_val'=>$purTokenVal,'service_val'=>$serviceval,'cancel_amt'=>$canceldisplayValc,'from_date'=>$dateFromValc,'to_date'=>$dateToValc);

		$this->db->insert('booking_attrib_hb',$data);

	}
	function get_reservation_details($id)
	{
		
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('parent_pnr_no',$id);
		$query = $this->db->get();	
		return $query->result();
	}
	function get_reservation_details_hotel($id)
	{
		
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('booking_id',$id);
		$query = $this->db->get();	
		return $query->row();
	}
	function get_reservation_details_global($id)
	{
		
		$this->db->select('*');
		$this->db->from('booking_global');
		$this->db->where('pnr_no',$id);
		$query = $this->db->get();	
		
		return $query->result();
	}
	function get_reservation_details_id($id)
	{
		
		$this->db->select('*');
		$this->db->from('booking_global');
		$this->db->where('pnr_no',$id);
		$query = $this->db->get();	
		 if ($query->num_rows() == 0) {
			return '';
		} else {
			return $query->row();
		}
	}
		function get_permanent_details_v3($id)
	{
		
		$this->db->select('*');
		$this->db->from('api_permanent_hotel');
		$this->db->where('Global_Hotelcode',$id);
		
		$query = $this->db->get();	
		
		 if ($query->num_rows() == 0) {
			return '';
		} else {
			return $query->row();
		}
	}
// Own Inventory code	
	function get_permanent_details_own_v3($id)
	{
		
		$this->db->select('*');
		$this->db->from('hotel_search_list');
		$this->db->where('HotelCode',$id);
		
		$query = $this->db->get();	
		
		 if ($query->num_rows() == 0) {
			return '';
		} else {
			return $query->row();
		}
	}
// End Own Inventory
		function get_permanent_details_v3_Hotelspro($id,$api='')
	{
		
		$this->db->select('*');
		$this->db->from('api_permanent_hotel_hotelspro');
		$this->db->where('Hotelspro_Hotelcode',$id);
		
		$query = $this->db->get();	
		
		 if ($query->num_rows() == 0) {
			return '';
		} else {
			return $query->row();
		}
	}
	function get_permanent_details_v3_Gta($id,$api='')
	{
		
		$this->db->select('*');
		$this->db->from('api_permanent_hotel_gta');
		$this->db->where('HotelCode',$id);
		$this->db->where('CityCode',$_SESSION['gta_city_code_g2']);
		$query = $this->db->get();	
		if ($query->num_rows() == 0) 
		{
			return '';
		} else {
			return $query->row();
		}
	}
		function get_permanent_details_v3_hotelspro_hotelname($id)
	{
		
		$this->db->select('Hotel_name');
		$this->db->from('api_permanent_hotel_hotelspro');
		$this->db->where('Hotelspro_Hotelcode',$id);
		
		$query = $this->db->get();	
		
		 if ($query->num_rows() == 0) {
			return '';
		} else {
		  $a=  $query->row();
		  return $a->Hotel_name;
		}
	}
		function get_permanent_details_v3_own_hotelname($id)
	{
		
		$this->db->select('HotelName');
		$this->db->from('hotel_search_list');
		$this->db->where('HotelCode',$id);
		
		$query = $this->db->get();	
		
		 if ($query->num_rows() == 0) {
			return '';
		} else {
		  $a=  $query->row();
		  return $a->HotelName;
		}
	}
	function get_permanent_details_v4_Hotelspro($id,$api='')
	{
		
		$this->db->select('*');
		$this->db->from('api_permanent_hotel_hotelspro');
		$this->db->where('Hotelspro_Hotelcode',$id);
		
		$query = $this->db->get();	
		
		 if ($query->num_rows() == 0) {
			return '';
		} else {
			return $query->row();
		}
	}
	function get_permanent_details_v4_Own($id)
	{
		
		$this->db->select('*');
		$this->db->from('hotel_search_list');
		$this->db->where('HotelCode',$id);
		
		$query = $this->db->get();	
		
		 if ($query->num_rows() == 0) {
			return '';
		} else {
			return $query->row();
		}
	}
	function get_permanent_details_v4_Gta($id,$api='')
	{
		
		$this->db->select('HotelName as Hotel_name, ImageLinkImage as Hotel_thumbnail, StarRating as Hotel_star, LocationName as Hotel_location,Address as Hotel_address,ReportInfo as Hotel_description');
		$this->db->from('api_permanent_hotel_gta');
		$this->db->where('HotelCode',$id);
		$this->db->where('CityCode',$_SESSION['gta_city_code_g2']);
		
		$query = $this->db->get();	
	//echo $this->db->last_query(); exit;
		 if ($query->num_rows() == 0) {
			return '';
		} else {
			return $query->row();
		}
	}
	function get_permanent_details_v4_Asiantravel($id)
	{
		
		$this->db->select('HotelName as Hotel_name, hotel_images as Hotel_thumbnail, starrating as Hotel_star, location as Hotel_location,Address as Hotel_address,Hotel_description');
		$this->db->from('api_permanent_hotel_asiantravel');
		$this->db->where('HotelId',$id);
		
		$query = $this->db->get();	
		 if ($query->num_rows() == 0) {
			return '';
		} else {
			return $query->row();
		}
	}

	function get_permanent_details_v3_Asiantravel($id)
	{
		
		$this->db->select('*');
		$this->db->from('api_permanent_hotel_asiantravel');
		$this->db->where('HotelId',$id);
		
		$query = $this->db->get();	
		
		 if ($query->num_rows() == 0) {
			return '';
		} else {
			return $query->row();
		}
	}
	function get_permanent_details_v3_asiantravel_hotel_name($id)
	{
		
		$this->db->select('HotelName');
		$this->db->from('api_permanent_hotel_asiantravel');
		$this->db->where('HotelId',$id);
		
		$query = $this->db->get();	
		
		 if ($query->num_rows() == 0) {
			return '';
		} else {
			$a = $query->row();
			return $a->HotelName;
		}
	}
	function get_permanent_details_v1($api , $id,$hname='') {
		$this->db->select('*');
		$this->db->from('api_permanent');
		$this->db->where('api', $api);

		if ($hname) {
			$Linkearray = array('hotel_name'=>$hname);
			$this->db->like($Linkearray);
		}
		

		$this->db->where('hotel_code', $id);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return '';
		} else {
			return $query->row();
		}
	}

	function get_permanent_details_v2($api,$id,$city_id) 
	{
		$this->db->select('*');
		$this->db->from('api_permanent_hotel');
		$this->db->where('City_id', $city_id);
		$this->db->where($api.'_Hotelcode', $id);
		$query = $this->db->get();
		if ($query->num_rows() == 0)
		{
			return '';
		}
		else 
		{
			return $query->row();
		}
	}

	function get_permanent_details_v1_gta($api , $id,$city) 
	{
		$this->db->select('*');
		$this->db->from('api_permanent');
		$this->db->where('api', $api);
		$this->db->where('hotel_code', $id);
		$this->db->where('city', $city);
		$query = $this->db->get();
		if ($query->num_rows() == 0)
		{
			return '';
		} 
		else
		{
			return $query->row();
		}
	}

	function api_status_id($domain)
	{
		$this->db->select('api_domian_status.base_api,api_domian_status.status, api_domian_status.api_status_id, api.api_name');
		$this->db->from('api_domian_status');
		$this->db->join('api', 'api_domian_status.api_id = api.api_id');
		$this->db->join('domain', 'api_domian_status.domain_id = domain.domain_id');
		$this->db->where('domain.domain_url', $domain);
		$this->db->where('api_domian_status.status', '1');
		$this->db->order_by('api_domian_status.base_api','desc');
		$query = $this->db->get();	
		//echo $this->db->last_query(); exit;
		if ($query->num_rows() == 0 )
		{
		   return '';   
		}
		else
		{
		 return $query->result(); 
		}
	}

	function check_hotelsbed_p_result($hotel_id)
	{
		$query = $this->db->query("SELECT * FROM api_permanent WHERE hotel_code='$hotel_id' ");
		//echo $this->db->last_query();exit;
		if ($query->num_rows == '')
		{
			return '';
		}
		else
		{
			return 'yes';
		}
	}

	function insert_hotelsbed_permanent_result_v1($codev1,$api,$namev1,$org_city,$images,$Positionlat,$Positionlong,$star)
	{
		$data=array('api'=>$api,'hotel_code'=>$codev1,'hotel_name'=>$namev1,'city'=>$org_city,'image'=>$images,'latitude'=>$Positionlat,'longitude'=>$Positionlong,'star'=>$star);
		$this->db->insert('api_permanent',$data);
		// echo $this->db->last_query();exit;
		return $this->db->insert_id();
	}

	function insert_hotelsbed_temp_result($sec_res,$api,$itemCode,$room_code,$room_type,$cost_val,$status_val,$meals_val,$shruiVal,$charVal,$adult,$child,$boardTypeVal,$token,$inoffcode,$contractnameVal,$destCodeVal,$shotname,$r_count='',$amountv3,$org_amt,$currencyv1,$c_val,$amountv3pay,$city,$date_final,$Promotionsaa,$amountv1,$ShortNameaa,$Classification_val,$des_offer_value,$Remarksaa)
	{
		$data=array('session_id'=>$sec_res,'api'=>$api,'hotel_code'=>$itemCode,'room_code'=>$room_code,'room_type'=>$room_type,'inclusion'=>$meals_val,'total_cost'=>$cost_val,'status'=>$status_val,'shurival'=>$shruiVal,'charval'=>$charVal,'adult'=>$adult,'child'=>$child,'board_type'=>$boardTypeVal,'city'=>$city,'token'=>$token,'inoffcode'=>$inoffcode,'contractnameVal'=>$contractnameVal,'destCodeVal'=>$destCodeVal,'shortname'=>$shotname,'room_count'=>$r_count,'currency_val'=>$c_val,'xml_currency'=>$currencyv1,'org_amt'=>$org_amt,'perroomcost'=>$date_final,'Promotionsaa'=>$Promotionsaa,'ShortNameaa'=>$ShortNameaa,'Classification_val' => $Classification_val,'des_offer_value' => $des_offer_value,'Remarksaa' => $Remarksaa);
		$this->db->insert('api_hotel_detail_t',$data);
		return $this->db->insert_id();
	}

	function check_hotelname($api,$hotel_code,$city)
	{
		$this->db->select('hotel_name');
		$this->db->from('api_permanent');
		$this->db->where('city',$city);
		$this->db->where('hotel_code',$hotel_code);
		$this->db->where('api',$api);
		//$this->db->where('agent_id', $this->session->userdata('agentid'));
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($query->num_rows() == '')
		{
			return '';
		}
		else
		{
			return $query->row();
		}
	}

	function fetch_search_result_map_new_select_session($city_code)
	{
		$this->db->select('lat,lng,hotel_name,degree_id,hotel_address_full,phone,thumbnail');
		$this->db->from('priceline_hotels');
		$this->db->where('active','1');
		$this->db->where('hotelid_t !=','0');
		$this->db->where('lat !=','');
		$this->db->where('lng !=','');
		$this->db->where('pclncityid',$city_code);
		$query = $this->db->get();
		if ($query->num_rows() == '')
		{
			return '';
		}
		else
		{
			return $query->result();
		}
	}

	function fetch_search_result_map_new_select_session_id($city_code,$id)
	{
		
		$this->db->select('lat,lng,hotel_name,degree_id,hotel_address_full,phone,thumbnail');
		$this->db->from('priceline_hotels');
			$this->db->where('active','1');	$this->db->where('degree_id',$id);
				$this->db->where('hotelid_t !=','0');
		$this->db->where('lat !=','');
		$this->db->where('lng !=','');
		
		$query = $this->db->get();
		

			if ($query->num_rows() == ''){
				return '';
			}else{
				return $query->result();
				
			}
		}
		function get_city_details_degree_id($city)
	{
		$this->db->select('*');
		$this->db->from('priceline_city');
		$this->db->where('degree_city_id',$city);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}

	}
		function fetch_search_result_map_new_select_session_new()
	{
		$this->db->select('city_name');
		$this->db->from('priceline_city');
		$this->db->where('cityid',$_SESSION['city_code']);
		$query = $this->db->get();
		
		$query->num_rows() == '';
		
		  $ss = $query->row(); 
		  echo '<pre/>';
		  print_r($ss);exit;
		  $ciyy = $ss->city_name;
		 
		  
			$query = $this->db->query("SELECT  *, MIN(t.total_cost) AS low_cost FROM api_hotel_detail_t t, api_permanent p 
	WHERE t.hotel_code = p.hotel_code AND p.city = '$ciyy'");
		
		
			if ($query->num_rows() == ''){
				return '';
			}else{
				return $query->result_array();
				
			}
		}
		function get_gta_city($city)
		{
				 $this->db->select('Gta');
		$this->db->from('api_hotels_city');
		$this->db->where('city_id',$city);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  $c =  $query->row(); 
		  return $c->Gta;
		}

		}
		function fetch_search_result_map_new_select($id)
		{
		 $this->db->select('city_name');
		$this->db->from('api_hotels_city');
		$this->db->where('city',$_SESSION['city']);
		$query = $this->db->get();
		
		$query->num_rows() == '';
		
		  $ss = $query->row(); 
		  $ciyy = $ss->city_name;
			$query= $this->db->query("SELECT  *, MIN(t.total_cost) AS low_cost FROM api_hotel_detail_t t, api_permanent p 
	WHERE t.hotel_code = p.hotel_code  AND p.api = 'hotelsbed' AND t.api_temp_hotel_id='".$id."'");
		
		
			if ($query->num_rows() == ''){
				return '';
			}else{
				return $query->result_array();
				
			}
		}
		function fetch_search_result_map_new()
		{
			$sec_res= $_SESSION['session_data_id'];
			 $this->db->select('city_name');
		$this->db->from('api_hotels_city');
		$this->db->where('city',$_SESSION['city']);
		$query = $this->db->get();
		
		$query->num_rows() == '';
		
		  $ss = $query->row(); 
		  $ciyy = $ss->city_name;
		 
			$query= $this->db->query("SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) AS low_cost FROM api_hotel_detail_t t, api_permanent p 
	WHERE t.hotel_code = p.hotel_code  AND session_id = '".$sec_res."' GROUP BY t.hotel_code");
		
		
			if ($query->num_rows() == ''){
				return '';
			}else{
				return $query->result_array();
			}
		}
		function insert_booking_data($ses_id,$bookingItemCodeval,$statusval,$book_noval,$booking_status,$parent_pnr_no,$parent_booking_number)
		{
		
		//echo '<pre/>';
		//print_r($_SESSION);exit;
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
			$cust_remark = '';
			$cust_remark1 = '';
			if (isset($_SESSION['booking_info']['sp_req']))
			{
			$feed_back = $_SESSION['booking_info']['sp_req'];
			}
			else
			{
				$feed_back ='';
			}
			
			if (isset($_SESSION['cin']))
			{
			$cin_val = explode("-",$_SESSION['cin']);
			
			$check_in = $cin_val[2].'-'.$cin_val[0].'-'.$cin_val[1];

			}
			else
			{
				$check_in ='';
			}
			if (isset($_SESSION['cout']))
			{
			$cout_val = explode("-",$_SESSION['cout']);
			
			$check_out = $cout_val[2].'-'.$cout_val[0].'-'.$cout_val[1];

			}
			else
			{
				$check_out ='';
			}
		
			$address = '';

			$phone = '';
			$fax = '';
			$nights = '';
			$child_age = '';
			$adult_info = '';
			$child_info = '';
			$passanger_full = '';
			for($k=0;$k<count($_SESSION['booking_info']['h_title']);$k++)
			{
			$passanger_full .= $_SESSION['booking_info']['h_title'][$k].' '.$_SESSION['booking_info']['h_fname'][$k].' '.$_SESSION['booking_info']['h_lname'][$k].'<br>';
			}
			
			$lead_passanger = $_SESSION['booking_info']['b_title'].' '.$_SESSION['booking_info']['b_fname'].' '.$_SESSION['booking_info']['b_lname'];
			$pass_mobile_no = $_SESSION['booking_info']['b_phone'];
			$pass_b_address = $_SESSION['booking_info']['b_address'].',<br>'.$_SESSION['booking_info']['b_city'].' - Zip : '.$_SESSION['booking_info']['b_zip'].',<br>'.$_SESSION['booking_info']['b_country'];

			
			// $passanger ='Test';
			// $pass_mobile_no ='2323232';
			$voucher_date=date("Y-m-d H:i:s");      
			$ip_address= $_SESSION['track_hostval'];
			$ip_country= $_SESSION['track_countryNameval'];
			$ip_city= $_SESSION['track_cityval'];
			$image = '';
			$degree_id = ''; 
			$user_id=0;
			$user_type=1;
		if ($this->session->userdata('b2c_logged_in'))
		{
				$user_id= $this->session->userdata('b2c_id');	
				$user_type= $this->session->userdata('b2c_type');	
		}
			if ($this->session->userdata('b2b_logged_in'))
		{
				$user_id = $this->session->userdata('b2b_id');	
				$user_type = $this->session->userdata('b2b_type');	
		}
		$passanger_full = mysql_real_escape_string($passanger_full);
		$pass_b_address = mysql_real_escape_string($pass_b_address);

		$query = $this->db->query("INSERT INTO booking_hotel (
		degree_id,domain_id,user_type,user_id,amount,
		api_status,booking_status,sub_total,taxes_and_fees,currency_val,
		xml_currency,cancellation_till_date,cancellation_till_charge,agent_markup,callcenterid,
		agent_mode,agent_mode_status,cancellation_by,cust_remark,cust_remark1,
		feed_back,check_in,check_out,hotel_code,hotel_name,
		city,room_type,star,address,room_count,
		cancel_policy,adult,child,description,phone,
		fax,nights,api,inclusion_val,child_age,
		adult_info,child_info,lead_pax,passanger,pass_mobile_no
		,voucher_date,ip_address,ip_country,ip_city,
		image,pass_full_address,booking_number,pnr_no,promo,
		discount,org_amt,state_name,country_name,zipcode,
		h_checkin,h_checkout,h_lat,h_lang,cancel_policy_full,please_note,ppn_id) 

									SELECT  				
		degree_id,domain_id,'$user_type','$user_id',total_cost,
		'$statusval','$booking_status',sub_total,taxes_and_fees,currency_val,
		xml_currency,'$cancellation_till_date','$cancellation_till_charge','$agent_markup','$callcenterid',
		'$agent_mode','$agent_mode_status','$cancellation_by','$cust_remark','$cust_remark1',
		'$feed_back','$check_in','$check_out',hotel_code,hotel_name,
		city,room_type,star,hotel_address_full,room_count,
		cancel_policy,adult,child,description,phone,
		fax,sec_days,api,inclusion,'$child_age',
		'$adult_info','$child_info','$lead_passanger','$passanger_full','$pass_mobile_no',
		'$voucher_date','$ip_address','$ip_country','$ip_city',image,'$pass_b_address','$bookingItemCodeval','$parent_pnr_no',promo_type,
		discount,org_amt,state_name,country_name,postal_code,
		checkin,checkout,latitude,longitude,comment_remarks,purTokenVal,'$book_noval'

	 FROM shopping_cart_hotel WHERE 	shopping_global_id = $cart_id");
		
		$bk_id =  $this->db->insert_id();
		
		$product_name='Hotels';
		$booking_type='1';
		$query = $this->db->query("INSERT INTO booking_global (domain_id,pnr_no,booking_no,user_type,user_id,
									amount,api_status,booking_status,voucher_date,ipaddress,leadpax,product_id,product_name,booking_type) 
																			
									SELECT domain_id,'$parent_pnr_no','$bookingItemCodeval','$user_type','$user_id',total_cost,'$statusval','$booking_status','$voucher_date','$ip_address','$lead_passanger','$bk_id','$product_name','$booking_type' FROM shopping_cart_hotel WHERE shopping_global_id = $cart_id");

		}
		
	 function update_markup_rate($cost,$id,$inoffcode_v1_val=0)
		{
			if ($inoffcode_v1_val !=0)
			{
			$data = array(
			  
				'total_cost' => $cost,
				'biz_status' => '1',
				'inoffcode_v1' =>$inoffcode_v1_val
				
			 
			);
			}
			else
			{
				$data = array(
			  
				'total_cost' => $cost,
				'biz_status' => '1'
			
				
			 
			);
			}

			$this->db->where('api_temp_hotel_id', $id);
			$validate = $this->db->update('api_hotel_detail_t', $data);

			
			
	 }			
	 
	 
	 
		function fetch_hotel_review_detail($hotelid)
	{

		$this->db->select('*');
		$this->db->from('hotel_review');
		$this->db->join('b2c','b2c.user_id = hotel_review.user_id');
		//$this->db->join('hotel_review','hotel_review.user_id = b2c.user_id');
		$this->db->where('hotel_review.degree_id',$hotelid);
		$query = $this->db->get();	
	//	echo $this->db->last_query(); exit;
	 if ($query->num_rows() == 0 )
		{
		   return '';   
		}
		else
		{
		 return $query->result(); 
		}
		
	}	
	 function get_biz_margin_details()
	{

		$this->db->select('*')
		->from('biz_rules_margin');
		
		$query = $this->db->get();

	  if ( $query->num_rows > 0 ) {
	  
		 $a= $query->result();
		 return $a;
	  }
	  return false;
	}	

	function hotel_detail_wishlist($hotelid)
	{
		$this->db->select('*');
		$this->db->from('priceline_hotels');
		$this->db->where('degree_id',$hotelid);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}
		
		}
		 function get_priceline_hotel_info($ppnid)
	{
		$this->db->select('degree_id');
		$this->db->from('priceline_hotels');
		$this->db->where('hotelid_ppn',$ppnid);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '0';   
		}
		else
		{
			
		$a  =	$query->row(); 
		  return $a->degree_id;
		  
		  
		  
		}
		
		}
		function get_hotel_information($hotelid)
	{
		$this->db->select('*');
		$this->db->from('booking_hotel');
		$this->db->where('booking_id',$hotelid);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}
		
		}
		function get_hotel_information_v4($hotelid)
	{
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('booking_id',$hotelid);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}
		
		}
		function get_tour_information($hotelid)
	{
		$this->db->select('*');
		$this->db->from('booking_tour');
		$this->db->where('booking_id',$hotelid);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}
		
		}
		function get_ticket_information($hotelid)
		{
		$this->db->select('*');
		$this->db->from('booking_ticket');
		$this->db->where('booking_id',$hotelid);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}
		
		}
		
		function get_cars_information($hotelid)
		{
		$this->db->select('*');
		$this->db->from('booking_cars');
		$this->db->where('booking_id',$hotelid);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}
		
		}
		
		function booking_hotel_detail($bookingno)
		{
		$hotvalue = array();
		$this->db->select('degree_id');
		$this->db->from('booking');
		$this->db->where('parent_pnr_no',$bookingno);
		$this->db->group_by('degree_id');
		$query = $this->db->get();
			
			
				if ($query->num_rows() == '' )
		{
			
		  // foreach
		}
		else
		{
		   $bookval = $query->result();
		   
			foreach($bookval as $hotelval)
			{
				
				//echo $hotelval->degree_id;
				$this->db->select('degree_id,thumbnail,hotel_name,hotel_address_full,star_rating,city,state_name,country_name,property_description');
		  $this->db->from('priceline_hotels');
		  $this->db->where('degree_id',$hotelval->degree_id);
		  $this->db->group_by('degree_id');
		  $query = $this->db->get();
				
				$hotvalue[] = $query->result();
			
				}
		  
		  print_r($hotvalue);
		}
			
		}		
		function get_user_value($bookno)
		{
			
			$this->db->select('user_id,user_type');
		$this->db->from('booking');
		$this->db->where('parent_pnr_no',$bookno);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}
			
			}
		
		function get_agent_detail($agentid)
		{
			
			$this->db->select('email_id');
		$this->db->from('b2b');
		$this->db->where('agent_id',$agentid);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}
			
			}
			
		function get_agent_markup_id($agentid,$api)
		{
			
			$this->db->select('markup');
		$this->db->from('b2b');
		$this->db->where('agent_id',$agentid);
		$query = $this->db->get();
		
		if ($query->num_rows() == '0' )
		{
		   return 0;   
		}
		else
		{
		  $aa = $query->row(); 
		  return $aa->markup;
		  
		  
		}
			
			}
				function get_user_detail($userid)
		{
			
			$this->db->select('email');
		$this->db->from('b2c');
		$this->db->where('user_id',$userid);
		$query = $this->db->get();
		
		if ($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}
			
			}
		function get_b2c_markup($api)
		{
			$city_code = $_SESSION['city_code'];
			$this->db->select('api_permanent_city_id,Global_Countryname');
			$this->db->from('api_permanent_city');
			$this->db->where('Global_Citycode',$city_code);
			$query = $this->db->get();

			if ($query->num_rows() == '0' )
			{
				
							 $this->db->select('markup');
							$this->db->from('b2c_markup');
							$this->db->where('api',$api);
							$this->db->where('module_type','1');
							$query = $this->db->get();
							
							if ($query->num_rows() == '0' )
							{
							   return '0';   
							}
							else
							{
							  $d =  $query->row(); 
							  return $d->markup;
							}     
			}
			else
			{
				
					$d =  $query->row(); 
					
					$this->db->select('markup');
					$this->db->from('b2c_markup');
					$this->db->where('api',$api);
					$this->db->where('module_type','2');
					$this->db->where('country', $d->Global_Countryname);
					$query = $this->db->get();
					
					if ($query->num_rows() == '0' )
					{
						
							   $this->db->select('markup');
							$this->db->from('b2c_markup');
							$this->db->where('api',$api);
							$this->db->where('module_type','1');
							$query = $this->db->get();
							
							if ($query->num_rows() == '0' )
							{
								
							   return '0';   
							}
							else
							{
							
							  $d =  $query->row(); 
							 
							  return $d->markup;
							}  
					}
					else
					{
						
					  $d =  $query->row(); 
					  return $d->markup;
					}
					
					
			}
			
			
			}
				function get_b2b_markup($b2b_id,$api)
		{
			$city_code = $_SESSION['city_code'];
			$this->db->select('api_permanent_city_id,Global_Countryname');
			$this->db->from('api_permanent_city');
			$this->db->where('Global_Citycode',$city_code);
			
			$query = $this->db->get();

			if ($query->num_rows() == '0' )
			{
				
				
							  $this->db->select('markup');
							$this->db->from('b2b_markup');
							$this->db->where('api',$api);
							$this->db->where('agent_id',$b2b_id);
							$this->db->where('markup_type','1');
							$query = $this->db->get();
							
							if ($query->num_rows() == '0' )
							{
							   return '0';   
							}
							else
							{
							  $d =  $query->row(); 
							  return $d->markup;
							}     
			
			}
			else
			{
				
					$d =  $query->row(); 
					
					$this->db->select('markup');
					$this->db->from('b2b_markup');
					$this->db->where('api',$api);
					$this->db->where('markup_type','2');
					$this->db->where('agent_id',$b2b_id);
					$this->db->where('country', $d->Global_Countryname);
					$query = $this->db->get();
					
					if ($query->num_rows() == '0' )
					{
						
							 $this->db->select('markup');
							$this->db->from('b2b_markup');
							$this->db->where('api',$api);
							$this->db->where('agent_id',$b2b_id);
							$this->db->where('markup_type','1');
							$query = $this->db->get();
							
							if ($query->num_rows() == '0' )
							{
								
							   return '0';   
							}
							else
							{
							
							  $d =  $query->row(); 
							 
							  return $d->markup;
							}  
					}
					else
					{
						
					  $d =  $query->row(); 
					  return $d->markup;
					}
		}
	}
	function insert_enquery_detail($user_id,$email,$subject,	$message,$hostval,$cityval,$countryval,$regionval,$hotecode,$domainid)
	{
		$data = array(
			'degree_id'=>$hotecode,
			'domain_id'=>$domainid,
			'user_id'=>$user_id,
			'user_mail'=>$email,
			'subject'=>$subject,
			'message'=>$message,
			'user_ip_address'=>$hostval,
			'city'=>$cityval,
			'country'=>$countryval,
			'region'=>$regionval
		);
		$this->db->insert('enquiry_detail',$data);
		return $this->db->insert_id();
	}

	function get_domain_detail($domainname)
	{
		$this->db->select('*');
		$this->db->from('domain');
		$this->db->where('domain_url',$domainname);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		if ($query->num_rows() == '' )
		{
			return '';   
		}
		else
		{
			return $query->row(); 
		}
	}

	function get_flight_information($product_id)
	{
		$this->db->select('*');
		$this->db->from('booking_flights');
		$this->db->where('booking_id',$product_id);
		$query = $this->db->get();
		if ($query->num_rows() == '' )
		{
		  return '';   
		}
		else
		{
			return $query->row(); 
		}
	}

	function get_flight_information_all($product_id)
	{
		$this->db->select('*');
		$this->db->from('booking_flights');
		$this->db->where('booking_id',$product_id);
		$query = $this->db->get();
		if ($query->num_rows() == '' )
		{
			$data['oneway'] ='';
			$data['return'] ='';  
			return $data;
		}
		else
		{
			$data['oneway'] =  $query->row(); 
			$this->db->select('*');
			$this->db->from('booking_flights');
			$this->db->where('pnr_no',$data['oneway']->pnr_no);
			$this->db->where('mode','return');
			$query1 = $this->db->get();
			if ($query1->num_rows() == '' )
			{
				$data['return'] =  ''; 
			}
			else
			{
				$data['return']  =  $query1->row(); 
			}
			return $data;
		}
	}
}

<?php 
class Home_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function admin_login_check_db($username,$passwd)
	{
		
		$this->db->select('*');
		$this->db->from('admin_new');
		$this->db->where('email',$username);
		$this->db->where('password',$passwd);
		
		$query=$this->db->get();
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->row();
		}
	}

	function admin_det($admin_id)
	{
		
		$this->db->select('*');
		$this->db->from('admin_new');
		$this->db->where('admin_id',$admin_id);
		$query=$this->db->get();
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->row();
		}
	}
	
	function updateprofile($first_name,$last_name,$email_id,$phone,$mobile,$alternate_no,$address,$admin_id)
	{
		$data = array('first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email_id,'phone'=>$phone,'mobile'=>$mobile,'alternate_no'=>$alternate_no,'address'=>$address);
		$this->db->where('admin_id',$admin_id);
		$this->db->update('admin_new',$data);
	}
	
	function check_password($pwd,$admin_id)
	{
		$this->db->select('*');
		$this->db->from('admin_new');
		$this->db->where('admin_id',$admin_id);
		$this->db->where('password',$pwd);
		$query=$this->db->get();
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->row();
		}
	}
	
	function updatepassword($admin_id,$pwfield)
	{
		$data = array('password'=>$pwfield);
		$this->db->where('admin_id',$admin_id);
		$this->db->update('admin_new',$data);
	}
	
	function getmarkupdet($val)
	{
		$this->db->select('*');
		$this->db->from('b2c_markup');
		$this->db->join('api','b2c_markup.api = api.api_id');
		$this->db->join('country','b2c_markup.country = country.country_id','left');
		$this->db->where('b2c_markup.module_type',$val);
		$query=$this->db->get();
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->result();
		}
	}
	
	function getcountry()
	{
		$this->db->select('*');
		$this->db->from('country');
		$query=$this->db->get();
		if ($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->result();
		}
	}
	function getcountry_v1()
	{
		$this->db->select('Global_Countryname');
		$this->db->from('api_permanent_city');
		$this->db->group_by('Global_Countryname');
		$query=$this->db->get();
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->result();
		}
	}
	
	function getapidetails($module_type)
	{
		$this->db->select('*');
		$this->db->from('api');
		$this->db->where('module_type',$module_type);
		$query=$this->db->get();
		if ($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->result();
		}
		
	}
	
	public function get_country_list()
	{
		$this->db->select('*')
		->from('country');
		$query = $this->db->get();
		if ($query->num_rows > 0 ) 
		{
			return $query->result();
		}
		return false;
	}
	
	function currencylist()
	{
		$this->db->select('*');
		$this->db->from('currency_converter');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function currencydet($id)
	{
		$this->db->select('*');
		$this->db->from('currency_converter');
		$this->db->where('cur_id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	
	function updatecurrency($id,$value)
	{
		$data = array('value'=>$value);
		$this->db->where('cur_id',$id);
		$this->db->update('currency_converter',$data);
	}
	
	function updatecurrencystatus($id,$status)
	{
		$data = array('status'=>$status);
		$this->db->where('cur_id',$id);
		$this->db->update('currency_converter',$data);
	}
	
	function delete_currency($id)
	{
		$this->db->where('cur_id',$id);
		$this->db->delete('currency_converter');
	}
	
	function get_api_list()
	{
		
			$this->db->select('*')
			->from('api');
			$query = $this->db->get();
	
		  if ( $query->num_rows > 0 ) {
		  
			 return $query->result();
		  }
		  return false;
	}
	
	function get_api_det($id)
	{
		$this->db->select('*');
		$this->db->from('api');
		$this->db->where('api_id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
		
	}
	function get_api_det_v1($id)
	{
		$this->db->select('*');
		$this->db->from('api_domian_status');
		$this->db->where('api_id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
		
	}

	/* Added by JR on July 10th */
	function gethotel()
	{
		$this->db->select('*');
		$this->db->from('hotel_search_list');
		$this->db->where('createdby','admin');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	public function getPackageCountries()
	{
		$this->db->select('*');
		$this->db->from('country');
		$this->db->order_by('name','asc');
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else 
		{
			return '';
		}
	}

	function add_hotel($left_ban1,$country,$city,$hotelname,$starrating,$address,$postalcode,$contactno,$faxno,$checkintime,$checkouttime,$hoteldesc,$avarageprice,$createdby,$contractfrom,$contractto,$directorsales,$salespersonname,$salesno,$salesemail,$extranetpersonname,$extranetnumber,$extranetemail,$hoteldescmore,$internetfacility,$carparking,$sports,$status,$geo,$latitude = null, $longitude = null)
	{
		$data = array('FrontPgImage'=>$left_ban1,'Country'=>$country,'City'=>$city,'HotelName'=>$hotelname,'StarRating'=>$starrating,'Address'=>$address,'PostalCode'=>$postalcode,'ContactNo'=>$contactno,'FaxNo'=>$faxno,'checkintime'=>$checkintime,'checkouttime'=>$checkouttime,'HotelDesc'=>$hoteldesc,'AvgPrice'=>$avarageprice,'createdby'=>'admin','contractfrom'=>$contractfrom,'contractto'=>$contractto,'directorsales'=>$directorsales,'salespersonname'=>$salespersonname,'salesno'=>$salesno,'salesemail'=>$salesemail,'extranetpersonname'=>$extranetpersonname,'extranetnumber'=>$extranetnumber,'extranetemail'=>$extranetemail,'hoteldescmore'=>$hoteldescmore,'internetfacility'=>$internetfacility,'carparking'=>$carparking,'sports'=>$sports,'status'=>'1','geo'=>$geo, 'latitude'=>$latitude, 'longitude'=>$longitude);
		$this->db->insert('hotel_search_list',$data);
		return $this->db->insert_id();
	}
	
	function add_hotelcode($hotelcode,$hotelid_id)
	{
		$data = array('HotelCode'=>$hotelcode);
		$this->db->where('hotel_id',$hotelid_id);
		$this->db->update('hotel_search_list',$data);
		
	}
	
	function add_image($hotelid_id,$uploadimage,$uploadimagename)
	{
		$data = array('HotelCode'=>$hotelid_id,'ImageFileName'=>$uploadimage,'imagename'=>$uploadimagename,'createdby'=>'admin');
		$this->db->insert('hotel_images',$data);
	}

	function add_imagecode($image_code,$image_id)
	{
		$data = array('imagecode'=>$image_code);
		$this->db->where('id',$image_id);
		$this->db->update('hotel_images',$data);
	}
	
	/*function add_cancellationpolicy($hotelcode,$Cancellation,$excp,$exdate1,$exdatetill2)
	{
		$data = array('HotelCode'=>$hotelcode,'cancelpolicy'=>$Cancellation,'exclude'=>$excp,'excludefrom'=>$exdate1,'excludeto'=>$exdatetill2,'createdby'=>'admin');
		$this->db->insert('hotel_cancellationpolicy',$data);
	}*/
	
	function add_cancellationpolicy($hotelcode, $Cancellation)
	{
		$data = array('HotelCode'=>$hotelcode,'cancelpolicy'=>$Cancellation,'createdby'=>'admin');
		$this->db->insert('hotel_cancellationpolicy',$data);
	}
	function add_cancellationpolicycode($cancelcode,$cancel_id)
	{
		$data = array('cancelcode'=>$cancelcode);
		$this->db->where('id',$cancel_id);
		$this->db->update('hotel_cancellationpolicy',$data);
	}
	
	function edit_searchhotel($hotel_id)
	{
		$this->db->select('*');
		$this->db->from('hotel_search_list');
		$this->db->where('hotel_id',$hotel_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	
	//function add_room($hotelid_id1,$roomname,$roomsize,$beds,$extrabed,$description,$left_ban2,$createdby,$status)
	function add_room($hotelid_id1,$roomname,$roomsize,$beds,$extrabed,$description,$left_ban2,$createdby = 'admin',$status = 1)
	{
		$data = array('HotelCode'=>$hotelid_id1,'RoomName'=>$roomname,'roomsize'=>$roomsize,'beds'=>$beds,'extrabed'=>$extrabed,'description'=>$description,'left_ban2'=>$left_ban2,'createdby'=>'admin','status'=>'1');
		$this->db->insert('hotel_room_list',$data);
		
	}
	
	function add_roomcode($roomcode,$room_id)
	{
		$data = array('RoomCode'=>$roomcode);
		$this->db->where('id',$room_id);
		$this->db->update('hotel_room_list',$data);
	}
	
	function add_amen($hotelid_id1, $rcode, $aminity, $createdby)
	{
		$data = array('HotelCode'=>$hotelid_id1,'RoomCode'=>$rcode,'RoomAmenities'=>$aminity,'createdby'=>'admin');
		$this->db->insert('hotel_aminities',$data);
		
	}
	
	function viewhotel($hotel_id)
	{
		$this->db->select('*');
		$this->db->from('hotel_search_list');
		$this->db->where('HotelCode',$hotel_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	
	function viewroom($hotel_id)
	{
		
		$this->db->select('*');
		$this->db->from('hotel_room_list');
		$this->db->where('HotelCode',$hotel_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
		
	}
	
	function add_price($hotelid_id1,$currency,$dmarkprice,$dmarkbed,$dmarkmeals,$extrabedchildprice,$extrabedchildmarkup,$extrabedadultprice,$extrabedadultmarkup,$lunchprice,$lunchmarkup,$dinnerprice,$dinnermarkup)
	{
		$data = array('HotelCode'=>$hotelid_id1,'currency'=>$currency,'defaultroommarkup'=>$dmarkprice,'defaultextrabedmarkup'=>$dmarkbed,'defaultmealmarkup'=>$dmarkmeals,'extrabedchildprice'=>$extrabedchildprice,'extrabedchildmarkup'=>$extrabedadultmarkup,'extrabedadultprice'=>$extrabedadultprice,'extrabedadultmarkup'=>$extrabedadultmarkup,'lunchprice'=>$lunchprice,'lunchmarkup'=>$lunchmarkup,'dinnerprice'=>$dinnerprice,'dinnermarkup'=>$dinnermarkup);
		$this->db->insert('hotel_price',$data);
	}
	
	function add_hotel_meal_service($hotelid_id1,$mealname,$mealdatefrom,$mealdateto,$mealprice,$mealmarkup)
	{
		$data = array('HotelCode'=>$hotelid_id1,'mealname'=>$mealname,'mealdatefrom'=>$mealdatefrom,'mealdateto'=>$mealdateto,'mealprice'=>$mealprice,'mealmarkup'=>$mealmarkup);
		$this->db->insert('hotel_meal_service',$data);
	}
	
	function add_hotelroomprice($hotelid_id1,$Roomcode,$ratefrom,$rateto,$contractrate,$roompricemarkup,$weekdayfrom,$weekdaytill,$surcharge)
	{
		$data = array('HotelCode'=>$hotelid_id1,'Roomcode'=>$Roomcode,'ratefrom'=>$ratefrom,'rateto'=>$rateto,'contractrate'=>$contractrate,'roompricemarkup'=>$roompricemarkup,'weekdayfrom'=>$weekdayfrom,'weekdaytill'=>$weekdaytill,'surcharge'=>$surcharge);
		$this->db->insert('hotel_room_price',$data);
	}
	
	function gethotelroom($hotel_id)
	{
		$this->db->select('*');
		$this->db->from('hotel_room_list');
		$this->db->where('HotelCode',$hotel_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function getfacility($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_facilities');
		$this->db->where('HotelCode',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function viewpaystay($roomcode)
	{
		
		$this->db->select('*');
		$this->db->from('hotel_paystaypromo');
		$this->db->where('Roomcode',$roomcode);
		
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
		
	}
	
	function viewweekend($roomcode)
	{
		$this->db->select('*');
		$this->db->from('hotel_priceweekendpromo');
		$this->db->where('Roomcode',$roomcode);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function viewpricediscount($roomcode)
	{
		$this->db->select('*');
		$this->db->from('hotel_price_discount');
		$this->db->where('Roomcode',$roomcode);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function viewroompricediscount($roomcode)
	{
		$this->db->select('*');
		$this->db->from('hotel_roompricediscount');
		$this->db->where('Roomcode',$roomcode);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function viewserviceup($roomcode)
	{
		$this->db->select('*');
		$this->db->from('hotel_priceserviceupgrade');
		$this->db->where('Roomcode',$roomcode);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function getroom($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_room_list');
		$this->db->where('id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	
	function getamen($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_aminities');
		$this->db->where('RoomCode',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	public function change_roomstatus($room_id,$status)
	{
		$this->db->where('id',$room_id);
		$this->db->update('hotel_room_list' , array('status' => $status));
	}
	
	function getprice($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_room_price');
		$this->db->where('RoomCode',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function getpaystay($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_paystaypromo');
		$this->db->where('id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	
	function addpaystaypromo($roomcode, $hotelcode, $ratefrom, $rateto, $stay, $pay, $breakfast, $breakrate, $breakmarkup)
	{
		$data = array('roomcode'=>$roomcode,'hotelcode'=>$hotelcode,'ratefrom'=>$ratefrom,'rateto'=>$rateto,'stay '=>$stay,'pay'=>$pay,'breakfast '=>$breakfast,'breakrate'=>$breakrate,'breakmarkup'=>$breakmarkup);
		$this->db->insert('hotel_paystaypromo',$data);
	}
	
	function editpaystaypromo($id, $ratefrom, $rateto, $stay, $pay, $breakfast, $breakrate, $breakmarkup)
	{
		$data = array('ratefrom'=>$ratefrom,'rateto'=>$rateto,'stay '=>$stay,'pay'=>$pay,'breakfast '=>$breakfast,'breakrate'=>$breakrate,'breakmarkup'=>$breakmarkup);
		$this->db->where('id',$id);
		$this->db->update('hotel_paystaypromo',$data);
	}
	
	public function delete_paystay($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('hotel_paystaypromo');
	}
	
	public function delete_weekend($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('hotel_priceweekendpromo');
	}
	
	public function delete_roomdiscount($id) 
	{
		$this->db->where('id',$id);
		$this->db->delete('hotel_price_discount');
	}
	
	public function delete_roompricedis($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('hotel_roompricediscount');
	}
	
	public function delete_service($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('hotel_priceserviceupgrade');
	}
	
	function addweekendpromo($roomcode1,$hotelcode,$weekdayfrom,$weekdaytill,$weekendrate)	
	{
		$data = array('HotelCode'=>$hotelcode,'Roomcode'=>$roomcode1,'weekdayfrom'=>$weekdayfrom,'weekdaytill'=>$weekdaytill,'weekendrate'=>$weekendrate);
		$this->db->insert('hotel_priceweekendpromo',$data);
	}
	
	function getweekendstay($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_priceweekendpromo');
		$this->db->where('id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	
	function addnewdiscount($roomcode1,$hotelcode,$discountfrom,$discountto,$discountrate)
	{
		$data = array('HotelCode'=>$hotelcode,'Roomcode'=>$roomcode1,'discountfrom'=>$discountfrom,'discountto'=>$discountto,'discountrate'=>$discountrate);
		$this->db->insert('hotel_price_discount',$data);
	}
	function addnewdiscountpr($roomcode1,$hotelcode,$discountfrom,$discountto,$discountrate)
	{
		$data = array('HotelCode'=>$hotelcode,'Roomcode'=>$roomcode1,'pricefrom'=>$discountfrom,'priceto'=>$discountto,'pricerate'=>$discountrate);
		$this->db->insert('hotel_roompricediscount',$data);
	}
	
	function addnewservice($roomcode1,$hotelcode,$discountfrom,$discountto,$discountrate)
	{
		$data = array('HotelCode'=>$hotelcode,'Roomcode'=>$roomcode1,'upgradefrom'=>$discountfrom,'upgradeto'=>$discountto,'promo'=>$discountrate);
		$this->db->insert('hotel_priceserviceupgrade',$data);
	}
	
	function getdiscountpromo($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_price_discount');
		$this->db->where('id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	
	function getdiscountprice($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_roompricediscount');
		$this->db->where('id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	
	function getservice($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_priceserviceupgrade');
		$this->db->where('id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}
	
	function editdiscount($id, $discountfrom, $discountto, $discountrate)
	{
		$data = array('discountfrom '=>$discountfrom,'discountto'=>$discountto,'discountrate'=>$discountrate);
		$this->db->where('id',$id);
		$this->db->update('hotel_price_discount',$data);
	}
	
	
	function editdiscountpr($id,$discountfrom,$discountto,$discountrate)
	{
		$data = array('pricefrom '=>$discountfrom,'priceto'=>$discountto,'pricerate'=>$discountrate);
		$this->db->where('id',$id);
		$this->db->update('hotel_roompricediscount',$data);
	}
	
	function editservicesave($id,$discountfrom,$discountto,$discountrate)
	{
		$data = array('upgradefrom '=>$discountfrom,'upgradeto'=>$discountto,'promo'=>$discountrate);
		$this->db->where('id',$id);
		$this->db->update('hotel_priceserviceupgrade',$data);
	}
	
	public function change_hotelstatus($hotel_id,$status)
	{
		$this->db->where('hotel_id',$hotel_id);
		$this->db->update('hotel_search_list' , array('status' => $status));
	}
	
	function edit_hotel($country,$city,$hotelname,$starrating,$address,$postalcode,$contactno,$faxno,$checkintime,$checkouttime,$hoteldesc,$avarageprice,$hotelcode,$contractfrom,$contractto,$directorsales,$salespersonname,$salesno,$salesemail,$extranetpersonname,$extranetnumber,$extranetemail,$hoteldescmore,$internetfacility,$carparking,$sports,$status,$geo,$id, $latitude = null, $longitude = null)
	{
		$data = array('Country'=>$country,'City'=>$city,'HotelName'=>$hotelname,'StarRating'=>$starrating,'Address'=>$address,'PostalCode'=>$postalcode,'ContactNo'=>$contactno,'FaxNo'=>$faxno,'checkintime'=>$checkintime,'checkouttime'=>$checkouttime,'HotelDesc'=>$hoteldesc,'AvgPrice'=>$avarageprice,'createdby'=>'admin','contractfrom'=>$contractfrom,'contractto'=>$contractto,'directorsales'=>$directorsales,'salespersonname'=>$salespersonname,'salesno'=>$salesno,'salesemail'=>$salesemail,'extranetpersonname'=>$extranetpersonname,'extranetnumber'=>$extranetnumber,'extranetemail'=>$extranetemail,'hoteldescmore'=>$hoteldescmore,'internetfacility'=>$internetfacility,'carparking'=>$carparking,'sports'=>$sports,'status'=>'1','geo'=>$geo, 'latitude'=>$latitude, 'longitude'=>$longitude);
		$this->db->where('hotel_id',$id);
		$this->db->update('hotel_search_list',$data);
	}
	
	function add_facility($hotelid_id, $facility)
	{
		$data = array('HotelCode'=>$hotelid_id,'Facility'=>$facility,'createdby'=>'admin');
		$this->db->insert('hotel_facilities',$data);
	}
	
	function add_facilitycode($facilitycode,$facility_id)
	{
		$data = array('facilitycode'=>$facilitycode);
		$this->db->where('id',$facility_id);
		$this->db->update('hotel_facilities',$data);
	} 
	
	function add_holidaysurcharge($hotelid_id1,$Roomcode,$ratefromh,$ratetosurcharge)
	{
		$data = array('HotelCode'=>$hotelid_id1,'Roomcode'=>$Roomcode,'ratefromh'=>$ratefromh,'ratetosurcharge'=>$ratetosurcharge);
		$this->db->insert('hotel_room_holidayprice',$data);
	}
	
	function add_hotel_promotion($hotelid_id1,$Roomcode,$ratefrom,$rateto,$stay,$pay,$breakfast,$breakrate,$breakmarkup)
	{
		$data = array('HotelCode'=>$hotelid_id1,'Roomcode'=>$Roomcode,'ratefrom'=>$ratefrom,'rateto'=>$rateto,'stay'=>$stay,'pay'=>$pay,'breakfast'=>$breakfast,'breakrate'=>$breakrate,'breakmarkup'=>$breakmarkup);
		$this->db->insert('hotel_paystaypromo',$data);
	}
	
	function add_perdiscount($hotelid_id1,$Roomcode,$discountfrom,$discountto,$discountrate)
	{
		$data = array('HotelCode'=>$hotelid_id1,'Roomcode'=>$Roomcode,'discountfrom'=>$discountfrom,'discountto'=>$discountto,'discountrate'=>$discountrate);
		$this->db->insert('hotel_price_discount',$data);
		
	}	
	
	function add_perprice($hotelid_id1,$Roomcode,$pricefrom,$priceto,$pricerate)
	{
		$data = array('HotelCode'=>$hotelid_id1,'Roomcode'=>$Roomcode,'pricefrom'=>$pricefrom,'priceto'=>$priceto,'pricerate'=>$pricerate);
		$this->db->insert('hotel_roompricediscount',$data);
		
	}
	function add_weekendprice($hotelid_id1,$Roomcode,$weekdayfrom,$weekdaytill,$weekendrate)
	{
		$data = array('HotelCode'=>$hotelid_id1,'Roomcode'=>$Roomcode,'weekdayfrom'=>$weekdayfrom,'weekdaytill'=>$weekdaytill,'weekendrate'=>$weekendrate);
		$this->db->insert('hotel_priceweekendpromo',$data);
		
	}
	
	function add_promoprice($hotelid_id1,$Roomcode,$upgradefrom,$upgradeto,$promo)
	{
		$data = array('HotelCode'=>$hotelid_id1,'Roomcode'=>$Roomcode,'upgradefrom'=>$upgradefrom,'upgradeto'=>$upgradeto,'promo'=>$promo);
		$this->db->insert('hotel_priceserviceupgrade',$data);
		
	}

	function getroomprice($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_room_price');
		$this->db->where('id',$id);
		$query=$this->db->get();
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->row();
		}
	}
	
	public function delete_price($id) 
	{
		$this->db->where('id',$id);
		$this->db->delete('hotel_room_price');
	}
	
	function update_room($RoomName,$roomsize,$beds,$extrabed,$description,$id)
	{
		$data = array('RoomName'=>$RoomName,'roomsize'=>$roomsize,'beds'=>$beds,'extrabed'=>$extrabed,'description'=>$description);
		$this->db->where('id',$id);
		$this->db->update('hotel_room_list',$data);
	}
	
	function editroomprice($id,$ratefrom,$rateto,$contractrate,$roompricemarkup,$weekdayfrom,$weekdaytill,$surcharge)
	{
		$data = array('ratefrom'=>$ratefrom,'rateto'=>$rateto,'contractrate'=>$contractrate,'roompricemarkup'=>$roompricemarkup,'weekdayfrom'=>$weekdayfrom,'weekdaytill'=>$weekdaytill,'surcharge'=>$surcharge);
		$this->db->where('id',$id);
		$this->db->update('hotel_room_price',$data);
	}
	
	function editweekendpromo($id, $weekdayfrom, $weekdaytill, $weekendrate)
	{
		$data = array('weekdayfrom'=>$weekdayfrom,'weekdaytill'=>$weekdaytill,'weekendrate '=>$weekendrate);
		$this->db->where('id',$id);
		$this->db->update('hotel_priceweekendpromo',$data);
	}
	/* End of it */
}

?>

<?php 
class Hotelspro_Model extends CI_Model {

	/******* START SET CREDENTIAL **********/
	private $base_currency;
	private $client_id;
	private $email;
	private $password;
	private $post_url;
	private $set_crediential;
	private $active_api;
	/******* START SET CREDENTIAL **********/
		
		
	/******* START SET VARIABLES **********/
	private $city;
	private $city_code;
	private $cin;
	private $cout;
	private $room_count;
	private $days;
	private $adult;
	private $child;
	private $adult_count;
	private $child_count;
	private $child_age;
	private $zone_id;
	/******* END SET VARIABLES **********/
    function __construct()
    {
        parent::__construct();
		$this->load->model('Api_Model');
		$this->load->model('Hotel_Model');
		$this->domain = "DSS";
	 	$this->domain_id = "1";
	 	$this->set_crediential('Hotelspro');
    }
	function set_crediential($api)
	{
		$this->db->select('*');
		$this->db->from('api');
		$this->db->where('api_name',$api);
		$query = $this->db->get();	
		//echo $this->db->last_query(); exit;
		if($query->num_rows() == 0 )
		{
		   	$set_crediential =FALSE;
		}
		else
		{
	  	  	$api_info =  $query->row(); 
		   	$this->client_id = $api_info->username;
			$this->password = '';
			$this->post_url = $api_info->url1;
			$this->set_crediential =TRUE;
			$this->active_api = $api;
		}
	}
	function set_variables($api='')
	{
		
			$this->city = $_SESSION['city'];
			$cinval = explode("-",$_SESSION['cin']);
			$this->cin  = $cinval[0].'-'.$cinval[1].'-'.$cinval[2];
			$coutval = explode("-",$_SESSION['cout']);
			$this->cout  = $coutval[0].'-'.$coutval[1].'-'.$coutval[2];
		
			
			$this->city_code = $_SESSION['city_code'];
			//$this->zone_id =$city_info->zone_id;
			
			$this->days = $_SESSION['days'];
			$this->room_count = $_SESSION['room_count'];
			$this->adult = $_SESSION['adult'];
			$this->child = $_SESSION['child'];
			$this->child_age = $_SESSION['child_age'];
			$this->adult_count = $_SESSION['adult_count'];
			$this->child_count= $_SESSION['child_count'];
			
	}
	
	function hotel_availabilty_all($api)
	{

		$this->set_crediential($api);
		$this->set_variables($api);
		$this->room_combination = array();
		
		
		for($i=0;$i<$this->room_count;$i++)
        {
			$adult = array();
			$child = array();
			
			for($j=0;$j<$this->adult[$i];$j++)
			{
				$adult[] = array("paxType" => "Adult");
			}
			
			for($j=0;$j<$this->child[$i];$j++)
			{			
				if($this->child_age[$i] != 0)	
				{
					if(strpos($this->child_age[$i],",") !== false)
					{
						$aChildAge = explode(",",$this->child_age[$i]);
						$age = $aChildAge[$j];						
						$child[] = array("paxType" => "Child", "age" => $age);
					}
					else
					{
						$child[] = array("paxType" => "Child", "age" => $this->child_age[$i]);
					}
				}				
			}
			
			$this->temp = array();
			$this->temp = array_merge($adult,$child);
			
			$this->room_combination[] = $this->temp;
		}
	
	  $filters = array();
	  $filters[] = array("filterType" => "resultLimit", "filterValue" => "10");
	  
	  $explode = explode('-',$_SESSION['cin']); 	        	 
	  $cin = $explode[2].'-'.$explode[0].'-'.$explode[1]; 
	  
	  $explode1 = explode('-',$_SESSION['cout']); 	        	 
	  $cout = $explode1[2].'-'.$explode1[0].'-'.$explode1[1]; 
	  	
	  if(!empty($this->city_code))
	  {
		 
		  $xml_error ='';
		
		 $client = new SoapClient($this->post_url, array('trace' => 1));
		  try {
			    $checkAvailability = $client->getAvailableHotel($this->client_id, $this->city_code, $this->cin, $this->cout, "USA", "US", "false", $this->room_combination );
  }
  catch (SoapFault $exception) {
      $xml_error =  $exception->getMessage();
  }
		
		
	if($xml_error=='')
	{
	
	 $refcode=date("YmdHis");
	
  if (is_object($checkAvailability->availableHotels)) {
      $hotelResponse[] = $checkAvailability->availableHotels;
  } else {
      $hotelResponse = $checkAvailability->availableHotels;
  }
  
$searchId = $checkAvailability->searchId;
$_SESSION['hotelspro_search_id'] = $searchId;
// Get markup details
$markup = '';
$temp = array();  
if(!empty($hotelResponse))
{
foreach ((array)$hotelResponse as $hnum => $hotel) {
				
					$processId = $hotel->processId;					
					$codev1 =  $hotel->hotelCode;
					$amount = $hotel->totalPrice; 
					$currencyv1 =  $hotel->currency;
					
					$amin_price = array();
					if(!empty($hotel->rooms))
					{
						foreach($hotel->rooms as $Key => $value)
						{
							$amin_price[] = $value->totalRoomRate;
						}
					}
					$min_price = min($amin_price);
					
					
								if($currencyv1 !='SGD')
									{
										$c_val1 =$this->Hotel_Model->get_currecy_details($currencyv1);
										if($c_val1!='')
										{
											$c_val = $c_val1->value;
										}
										else
										{
											 $c_val='';
										}
										$org_amt=$min_price;
										$total_cost =  $min_price /  $c_val;
									 }
									 else
									 {
										$c_val =1; 
										$org_amt=$min_price;
										$total_cost = $min_price;
									 }
								
							
								if(!in_array($codev1,$temp))
								{
					if($this->session->userdata('b2b_email') &&  $this->session->userdata('b2b_email')!= '')
					{
							$markup_admin = $this->Hotel_Model->get_b2b_markup($this->session->userdata('b2b_id'));
							$markup_agent = $this->Hotel_Model->get_agent_markup_id($this->session->userdata('b2b_id'));
							
							$markup = $markup_admin + $markup_agent;
					}
					else
					{
							$markup = $this->Hotel_Model->get_b2c_markup();
					}
					if($markup!='0')
					{
						$AvgPriceval_ = ((($total_cost/100)*$markup)+$total_cost);
					}
					else
					{
						$AvgPriceval_ = $total_cost;
					}
					
										$mapped_id = $this->get_mapped_id($codev1);
										$hotelspro_data[] = array(
													'api' => 'Hotelspro',
													'hotel_code' => $codev1,
													'org_amt' => number_format($total_cost, 2, '.', ''),
													'xml_currency' => $currencyv1,
													'currency_val' => $c_val,
													'total_cost' => number_format($AvgPriceval_, 2, '.', ''),
													'star' => 0,
													'freewifi' => 'false',
													'bestdeal' => '',
													're_score' => '',
													're_count' => '',
													'promotion' => '',
													'city_code' =>  $this->city_code,
													'mapped_id' => $mapped_id
													);
													
													
									
								$temp[] = $codev1;
								}
															
  }  


$_SESSION['hotelspro_xml_data'] = $hotelspro_data;
//echo '<pre/>';
				//	print_r($_SESSION['hotel_xml_data']);exit;
// _SESSION['hotel_xml_data']
  
}
	}


}
					

}
function hotel_availabilty($api,$hotel_code)
	{
		$this->set_variables($api);
		if(isset($_SESSION['hotelspro_search_id']) && $_SESSION['hotelspro_search_id']!='')
		{
			
		$client = new SoapClient($this->post_url, array('trace' => 1));
		try {
				$checkAvailability = $client->allocateHotelCode($this->client_id,$_SESSION['hotelspro_search_id'],$hotel_code);
			}  
		catch (SoapFault $exception) {
			echo $exception->getMessage();
			exit;
		}
		
		if(isset($checkAvailability->searchId) && $checkAvailability->searchId!='')
		{
			$sec_res =  $_SESSION['session_data_id'];
			$this->delete_temp_results($sec_res,$hotel_code);
			
			$search_id = $checkAvailability->searchId;
			
			// Get markup details
				if($this->session->userdata('b2b_email') &&  $this->session->userdata('b2b_email')!= '')
		{
				$markup_admin = $this->Hotel_Model->get_b2b_markup($this->session->userdata('b2b_id'));
				$markup_agent = $this->Hotel_Model->get_agent_markup_id($this->session->userdata('b2b_id'));
				
				$markup = $markup_admin + $markup_agent;
		}
		else
		{
				$markup = $this->Hotel_Model->get_b2c_markup();
		}
		
			//echo '<pre/>';
			//print_r($checkAvailability->availableHotels);exit;
			foreach($checkAvailability->availableHotels as $mainkey => $mainvalue)
			{
				$processId = $mainvalue->processId;
				$hotelCode = $mainvalue->hotelCode;
				$availabilityStatus = $mainvalue->availabilityStatus;
				if($availabilityStatus == 'InstantConfirmation')
				{
					$availabilityStatus = 'Instant';
				}
				$totalPrice = $mainvalue->totalPrice;	
							
				if($mainvalue->currency !='SGD')
				{
					$c_val1 =$this->Hotel_Model->get_currecy_details($mainvalue->currency);
					if($c_val1!='')
					{
						$c_val = $c_val1->value;
						$total_cost =  number_format(($totalPrice /  $c_val), 2, '.', '');					
					}
					else
					{
						$c_val='';
						$total_cost =  $totalPrice;
					}
					
					$total_cost_org = $totalPrice;
				
				}
					else
					{
						$c_val =1; 
						$total_cost_org = $totalPrice;
						$total_cost = $totalPrice;
					}
				$total_cost_usd = $total_cost;
				
				if($markup!='0')
				{
					$total_cost = number_format(((($total_cost/100)*$markup)+$total_cost), 2, '.', '');
				}
				else
				{
					$total_cost = $total_cost;
				}
				
				$xml_currency = $mainvalue->currency;
				$conveted_currency = 'SGD';
				$boardType = $mainvalue->boardType;		
										
				$sec_res =  $_SESSION['session_data_id'];
											
				$rooms = $mainvalue->rooms;				
				$i=1;
				
				$adult_v1=array();
				$child_v1=array();
				$room_info_V =array();
				$roomcat = array();
				$final_occupancy = array();
				$occpancy_information =array();
				foreach($rooms as $key => $value)
				{
					
					$roomcat[] = $value->roomCategory;
					$roomrate_org = $value->totalRoomRate;
					
					if($mainvalue->currency !='SGD')
					{
						$c_val1 =$this->Hotel_Model->get_currecy_details($mainvalue->currency);
						if($c_val1!='')
						{
							$c_val = $c_val1->value;
								$roomrate_cost = number_format(($roomrate_org /  $c_val), 2, '.', '');
						}
						else
						{
							$c_val='';
								$roomrate_cost =  ($roomrate_org);
						}
					
					
					}
					else
					{
						$c_val =1; 
						$roomrate_cost = $roomrate_org;
					}
					
					if($markup!='0')
					{
					$roomrate_cost =  number_format(((($roomrate_cost/100)*$markup)+$roomrate_cost), 2, '.', '');
					}
															
					$adult = 0;
					$child = 0;

					if(!empty($value->paxes))
					{
						
						$new_rate_final=array();
						foreach($value->paxes as $pkey => $pvalue)
						{
							if($pvalue->paxType == 'Adult')
							{
								
								$adult++;
							}
							elseif($pvalue->paxType == 'Child')
							{
								
								$child++;
							}
							
							
								
								
												
							
						}
						
					}
					$room_info_V[] = 1;
					$adult_v1[] = $adult;
					$child_v1[] = $child;
					$new_rate_final = array('OccupancyId'=>$i,'NoAdult'=>$adult,'NoChild'=>$child,'Seq'=>'','Rate'=>$roomrate_cost,'Rate_org'=>$roomrate_org);
							$occpancy_information[] = implode("||||",$new_rate_final);	
					$pernigtvalue_date = array();
					$pernigtvalue_amount = array();
						
					if(!empty($value->ratesPerNight))
					{
						
						foreach($value->ratesPerNight as $pernigtkey => $pernigtvalue)
						{
							$pernigtvalue_v1 = $pernigtvalue->amount;
							
									if($mainvalue->currency !='SGD')
									{
										$c_val1 =$this->Hotel_Model->get_currecy_details($mainvalue->currency);
										if($c_val1!='')
										{
											$c_val = $c_val1->value;
												$pernigtvalue_v2 = number_format(($pernigtvalue_v1 /  $c_val), 2, '.', '');
										}
										else
										{
											$c_val='';
												$pernigtvalue_v2 =  ($pernigtvalue_v1);
										}
									
									
									}
									else
									{
										$c_val =1; 
										$pernigtvalue_v2 = $pernigtvalue_v1;
									}
									
									if($markup!='0')
									{
									$pernigtvalue_v2 =  number_format(((($pernigtvalue_v2/100)*$markup)+$pernigtvalue_v2), 2, '.', '');
									}
									
							
							
							$new_rate = array('OccupancyId'=>$i,'OccupancyRate'=>$pernigtvalue_v2,'Dateval'=>$pernigtvalue->date,'Breakfastval'=>'','Availabilityval'=>$availabilityStatus,'Inclusionval'=>$boardType);
							$new_rate_ = implode("^^^^",$new_rate);
										
													$final_occupancy[] = $new_rate_;
						}
					}
					
											
									
									
					
				//	print_r($pernigtvalue_date);
				/*	$aData['session_id'] = $sec_res;
					$aData['adult'] = $adult;
					$aData['child'] = $child;
					$aData['hotel_code'] = $hotelCode;
					$aData['process_id'] = $processId;
					$aData['room_category'] = $roomcat;
					$aData['inclusion'] = $boardType;
					$aData['status'] = $availabilityStatus;
					$aData['xml_currency'] = $xml_currency;
					$aData['converted_currency'] = $conveted_currency;
					$aData['org_package_cost'] = $total_cost_usd;
					$aData['total_package_cost'] = $total_cost;
					$aData['org_room_cost'] = $room_cost_usd;
					$aData['total_room_cost'] = $roomrate_cost;
					$aData['search_id'] = $search_id;
					
					$this->insert_temp_result($aData);   	*/
					$i++;
				}	
					
				$adult_info_adult_info_ = implode("<br>",$adult_v1);
					$child_info_V = implode("<br>",$child_v1);
					$room_info_V1 = implode("<br>",$room_info_V);
					
					$RoomNameval_V = implode("<br>",$roomcat);
					
					$final_occupancy_v = implode("||||",$final_occupancy);
					$occpancy_information_final = implode("^^^^",$occpancy_information);
					
					if($this->session->userdata('b2b_email') &&  $this->session->userdata('b2b_email')!= '')
					{	
						$markup_rate=0;
						if($markup_agent!=0 && $markup_agent!=0.00)
						{
								$markup_rate =  ($total_cost_org/100)*$markup_agent;
						}
			
					}
					else
					{
						$markup_rate=0;
						if($markup!=0 && $markup!=0.00)
						{
								$markup_rate =  ($total_cost/100)*$markup;
						}
					}
				$hotel_name =  $this->Hotel_Model->get_permanent_details_v3_hotelspro_hotelname($hotelCode);		
	
				//	print_r($final_occupancy_v);exit;
							$insertion_data[] = array(
														'session_id' =>  $_SESSION['session_data_id'],
														'api' => $api,
														'hotel_code' => $hotelCode,
														'hotel_name' => $hotel_name,
														'room_code' => $processId,
														'room_type' => $RoomNameval_V,
														'MaxOccupancyval' => $adult,
														'MaxChildOccupancyval' => $child,
														'MaxChildAgeval' => '',
														'total_cost' => $total_cost,
														'w_markup' => $markup_rate,
														'status' => $availabilityStatus,
														'inclusion' => $boardType,
														'shurival' => $occpancy_information_final,
														'Classification_val' => $boardType,
														'adult' => $adult,
														'child' => $child,
														'token' =>$final_occupancy_v,
														'ShortNameaa' =>'',
														'des_offer_value' => '',
														
														'room_count' => count($room_info_V),
														'org_amt' => $total_cost_org,
														'xml_currency' => $xml_currency,
														'currency_val' => $c_val,
														'city' => $this->city,
														'room_type_V' => $RoomNameval_V,
													
														'room_count_v' => $room_info_V1,
														'adult_v' => $adult_info_adult_info_,
														'child_v' => $child_info_V,
														'WiFival' => ''
														);
				
													
				
			}			
		}
		 if(isset($insertion_data))
						 {
				   $this->db->insert_batch('api_hotel_detail_t',$insertion_data);
						 }
		return true;
		}
	}

	function hotel_availabilty_prerequest($search_id,$hotel_code)
	{
		$client = new SoapClient($this->post_url, array('trace' => 1));
		try {
				$checkAvailability = $client->allocateHotelCode($this->client_id,$search_id,$hotel_code);
			}  
		catch (SoapFault $exception) {
			echo $exception->getMessage();
			exit;
		}
		
		if(isset($checkAvailability->searchId) && $checkAvailability->searchId!='')
		{
			$sec_res =  $_SESSION['session_data_id'];
			$this->delete_temp_results($sec_res,$hotel_code);
			
			$search_id = $checkAvailability->searchId;
			
			// Get markup details
			$markup = $this->Hotel_Model->get_markup('Hotelspro');
			
			foreach($checkAvailability->availableHotels as $mainkey => $mainvalue)
			{
				$processId = $mainvalue->processId;
				$hotelCode = $mainvalue->hotelCode;
				$availabilityStatus = $mainvalue->availabilityStatus;
				$totalPrice = $mainvalue->totalPrice;				
				if($mainvalue->currency !='USD')
				{
					$c_val1 =$this->Hotel_Model->get_currecy_details($mainvalue->currency);
					if($c_val1!='')
					{
						$c_val = $c_val1->value;
					}
					else
					{
						$c_val='';
					}
					
					$total_cost_org = $totalPrice;
					$total_cost =  $this->Hotel_Model->cus_number_format($total_cost_org /  $c_val);
					}
					else
					{
						$c_val =1; 
						$total_cost_org = $totalPrice;
						$total_cost = $totalPrice;
					}
				$total_cost_usd = $total_cost;
				
				if(!empty($markup))	 
				{
					$percentage = ($total_cost * $markup) / 100;
					$total_cost = $total_cost + $percentage;									
				}
				
				$xml_currency = $mainvalue->currency;
				$conveted_currency = 'USD';
				$boardType = $mainvalue->boardType;								
				$sec_res =  $_SESSION['session_data_id'];
											
				$rooms = $mainvalue->rooms;				
				
				foreach($rooms as $key => $value)
				{
					$roomcat = $value->roomCategory;
					$roomrate_org = $value->totalRoomRate;
					
					if($mainvalue->currency !='USD')
					{
						$c_val1 =$this->Hotel_Model->get_currecy_details($mainvalue->currency);
						if($c_val1!='')
						{
							$c_val = $c_val1->value;
						}
						else
						{
							$c_val='';
						}
					
						$roomrate_cost =  $this->Hotel_Model->cus_number_format($roomrate_org /  $c_val);
					}
					else
					{
						$c_val =1; 
						$roomrate_cost = $roomrate_org;
					}
					
					if(!empty($markup))	 
					{	
						$percentage = ($roomrate_cost * $markup) / 100;
						$roomrate_cost = $roomrate_cost + $percentage;									
					}												
					$room_cost_usd = $roomrate_cost;
					
					if(!empty($value->paxes))
					{
						$adult = 0;
						$child = 0;
						foreach($value->paxes as $pkey => $pvalue)
						{
							if($pvalue->paxType == 'Adult')
							{
								$adult++;
							}
							elseif($pvalue->paxType == 'Child')
							{
								$child++;
							}
						}
					}
					
					$aData['session_id'] = $sec_res;
					$aData['adult'] = $adult;
					$aData['child'] = $child;
					$aData['hotel_code'] = $hotelCode;
					$aData['process_id'] = $processId;
					$aData['room_category'] = $roomcat;
					$aData['inclusion'] = $boardType;
					$aData['status'] = $availabilityStatus;
					$aData['xml_currency'] = $xml_currency;
					$aData['converted_currency'] = $conveted_currency;
					$aData['org_package_cost'] = $total_cost_usd;
					$aData['total_package_cost'] = $total_cost;
					$aData['org_room_cost'] = $room_cost_usd;
					$aData['total_room_cost'] = $roomrate_cost;
					$aData['search_id'] = $search_id;
					
					$this->insert_temp_result($aData);   	
				}	
			}			
		}
		return true;
	}

function insert_temp_result($aData)
{
	$this->db->insert('hotelspro_hotel_detail_t',$aData);
	return $this->db->insert_id();		
}

function fetch_rooms_processid($session_id,$process_id)
{
	$this->db->select('*');
	$this->db->from('hotelspro_hotel_detail_t');
	$this->db->where('hotelspro_hotel_detail_t.process_id',$process_id);
	$this->db->where('hotelspro_hotel_detail_t.session_id',$session_id);
	
	$query = $this->db->get();
	if($query->num_rows() == '' )
	{
	   return '';   
	}
	else
	{
	  return $query->result(); 
	}
}


function fetch_processid_results($session_id,$hotel_code)
{
	$this->db->select('process_id');
	$this->db->from('hotelspro_hotel_detail_t');
	$this->db->where('hotelspro_hotel_detail_t.hotel_code',$hotel_code);
	$this->db->where('hotelspro_hotel_detail_t.session_id',$session_id);
	$this->db->group_by('process_id'); 
	
	$query = $this->db->get();
	if($query->num_rows() == '' )
	{
	   return '';   
	}
	else
	{
	  return $query->result(); 
	}
}

function delete_temp_results($session_id,$hotel_code = "")
{
	 if(empty($hotel_code))
	 {
		$this->db->delete('api_hotel_detail_t', array('session_id' => $session_id)); 
	 }
	 else
	 {
		 $this->db->delete('api_hotel_detail_t', array('session_id' => $session_id, 'hotel_code' => $hotel_code)); 
	 }	
	 return true;
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


foreach( $translation as $find => $replace ){
	
    $input = str_replace($find, $replace, $input );    
    //$output = preg_replace("/" . $find . "/", $replace, $input );
}
return $input;
}

function getLocationCode($city)
{
	$this->db->select();
}

function getHotelName($hotel_id)
{
	$this->db->select('HotelName,StarRating');
	$this->db->from('hotelspro_hotels_list');
	$this->db->where('HotelCode',$hotel_id);
	
	$query = $this->db->get();
	if($query->num_rows() != '')
	{
		return $query->row();
	}
	else
	{
		return '';
	}
}


function getHotelDetails($hotel_id)
{
	$this->db->select('*');
	$this->db->from('hotelspro_hotels_list');
	$this->db->join('hotelspro_hotels_desc','hotelspro_hotels_list.HotelCode = hotelspro_hotels_desc.HotelCode');
	$this->db->where('hotelspro_hotels_list.HotelCode',$hotel_id);
	
	$query = $this->db->get();
	
	if($query->num_rows() != '')
	{
		return $query->row();
	}
	else
	{
		return '';
	}
}

function get_amenities($hotel_code)
{
	$this->db->select('*');
	$this->db->from('hotelspro_hotels_amenities');
	$this->db->where('HotelCode',$hotel_code);
	
	$query = $this->db->get();
	
	if($query->num_rows() != '')
	{
		return $query->row();
	}
	else
	{
		return '';
	}
}

function get_hotel_details($processId)
{
	$this->db->select('*');
	$this->db->from('hotelspro_hotel_detail_t');
	$this->db->join('hotelspro_hotels_list','hotelspro_hotel_detail_t.hotel_code = hotelspro_hotels_list.HotelCode');
	$this->db->where('hotelspro_hotel_detail_t.process_id',$processId);
	$this->db->group_by('process_id'); 
	
	$query = $this->db->get();
	
	if($query->num_rows() != '')
	{
		return $query->row();
	}
	else
	{
		return '';
	}	
}
function last_viewed_hotels()
{
	return '';
}
function get_booking_details($processId)
{
	$this->db->select('*');
	$this->db->from('hotelspro_hotel_detail_t');
	$this->db->where('hotelspro_hotel_detail_t.process_id',$processId);
	
	$query = $this->db->get();
	
	if($query->num_rows() != '')
	{
		return $query->result();
	}
	else
	{
		return '';
	}
}

function get_cancellation_policy($processId,$hotelcode)
{	
	$this->set_variables();
	$client = new SoapClient($this->post_url,array('trace'=> 1));
	
	try{
		$getHotelCancellationPolicy = $client->getHotelCancellationPolicy($this->client_id,$processId,$hotelcode);
	}
	catch (SoapFault $exception){
		echo $exception->getMessage();
		exit;
	}
	
	$policies = is_array($getHotelCancellationPolicy->cancellationPolicy) ? $getHotelCancellationPolicy->cancellationPolicy : array($getHotelCancellationPolicy->cancellationPolicy);

	foreach ($policies as $policy) {		
		
		$cin = $_SESSION['cin'];		
		
		$cancellationDay = $policy->cancellationDay ;
		$data['cancellation_deadline_date'] = date('Y-m-d', strtotime($cin. ' - '.$cancellationDay.' days'));		
		$data['feeAmount'] = $policy->feeAmount;
		$data['feeType'] = $policy->feeType;
		$data['remarks'] = $policy->remarks;
		$data['cancellation_days'] = $cancellationDay;
		$temp[] = $data;
	}	
	
	return $temp;
}

	function booking($api,$result_id,$hotel_id,$parent_pnr_no,$booking_global_id)
	{
			$result=$this->Hotel_Model->fetch_temp_result_room_id($result_id);	
		$occ_info = explode("^^^^",$result->shurival);
		$hotelspro_rooms='';
		$booking_pass_details = $_SESSION['booking_pass_details'];

		
		
		$client=new SoapClient($this->post_url,array('trace'=>1));

		$leadTravellerInfo=array();
		$paxInfo=array("paxType"=>"Adult","title"=>$booking_pass_details['sal'][0],"firstName"=>$booking_pass_details['fname'][0],"lastName"=>$booking_pass_details['lname'][0]);

		$leadTravellerInfo["paxInfo"]=$paxInfo;
		$leadTravellerInfo["nationality"]="US";
	
		$otherTravellerInfo=array();
		for($i=1;$i<count($booking_pass_details['fname']);$i++)
		{
			
			$otherTravellerInfo[] =array("title"=>$booking_pass_details['sal'][$i],"firstName"=>$booking_pass_details['fname'][$i],"lastName"=>$booking_pass_details['lname'][$i]);
		}
		$preferences="";
		$note="";
		$agencyReferenceNumber='';
		$xml_error='';
		try
		{
			$makeHotelBooking=$client->makeHotelBooking($this->client_id,$result->room_code,$agencyReferenceNumber,$leadTravellerInfo,$otherTravellerInfo,$preferences,$note);
		}
		catch(SoapFault $exception)	//Failed booking
		{
			$xml_error =  $exception->getMessage();
	//	echo $xml_error;exit;
		}
		$booking_status='Failed';
		$BookingConfirmationNoval='XXXXXXXXXXX';
		$statusval='Failed';
		$trackingId = 'XXXXXXXXXXX';
		$BookedAndPaidval='';
		
	//	echo '<pre/>';
	//	print_r($makeHotelBooking->hotelBookingInfo);exit;
	if($xml_error=='')
	{
		if($makeHotelBooking->responseId != "")
		{
			$trackingId = $makeHotelBooking->trackingId;
			$statusval1 = $makeHotelBooking->hotelBookingInfo->bookingStatus;
			$BookingConfirmationNoval = $makeHotelBooking->hotelBookingInfo->confirmationNumber;
			if(isset($makeHotelBooking->comments))
			{
			$BookedAndPaidval = $makeHotelBooking->comments;
			}
			else
			{
				$BookedAndPaidval = '';
			}
			$policies = $makeHotelBooking->hotelBookingInfo->cancellationPolicy;

foreach ($policies as $policy) {		
		
		$cin = $_SESSION['cin'];		
		
		$cancellationDay = $policy->cancellationDay ;
		$cancellation_deadline_date = date('Y-m-d', strtotime($cin. ' - '.$cancellationDay.' days'));		
		$feeAmount = $policy->feeAmount;
		$feeType = $policy->feeType;
		$remarks = $policy->remarks;
		
		$BookedAndPaidval .= "&diams;If you cancel the booking after ".$cancellation_deadline_date." means, charges will applied ".$feeAmount.' '.$feeType.'<br>';
		$BookedAndPaidval .= "<em><strong>Remarks : </strong>".$remarks."</em><br><br>";
	}	
	
	
	
	
			
			$booking_status='Success';
			if($statusval1 == '1')
			{
			$statusval = 'Confirmed';	
			}
			if($statusval1 == '2')
			{
			$statusval = 'Confirmed';	
			}
			if($statusval1 == '3')
			{
			$statusval = 'Confirmed';	
			}
			if($statusval1 == '4')
			{
			$statusval = 'Confirmed';	
			}
			if($statusval1 == '5')
			{
			$statusval = 'Confirmed';	
			}
			
			
				$data = array(
				'booking_no' => $BookingConfirmationNoval,
				'api_status' => $statusval,
				'booking_status' => $booking_status,
				'BookedAndPaidval' => $BookedAndPaidval,
				'reservation_track_id' => $trackingId,
				'xml_error' => $xml_error
			);
		
	
			$this->db->where('id', $booking_global_id);
			 $this->db->update('booking_global', $data);
	
		return "Booking_Success";
	
	
		}
		else
		{
				$data = array(
				'booking_no' => $BookingConfirmationNoval,
				'api_status' => $statusval,
				'booking_status' => $booking_status,
				'BookedAndPaidval' => $BookedAndPaidval,
				'reservation_track_id' => $trackingId,
				'xml_error' => $xml_error
			);
		
	
			$this->db->where('id', $booking_global_id);
			 $this->db->update('booking_global', $data);
	
			return "Booking_Fail";
			
		}
	}
	else
		{
				$data = array(
				'booking_no' => $BookingConfirmationNoval,
				'api_status' => $statusval,
				'booking_status' => $booking_status,
				'BookedAndPaidval' => $BookedAndPaidval,
				'reservation_track_id' => $trackingId,
				'xml_error' => $xml_error
			);
		
	
			$this->db->where('id', $booking_global_id);
			 $this->db->update('booking_global', $data);
	
			return "Booking_Fail";
			
		}
	
		
	}

function cancellation($api,$booking_id)
	{
		
		$this->set_crediential($api);
		
	$result =  $this->Hotel_Model->get_reservation_details_id($booking_id);
	$track_id = $result->reservation_track_id;
	
	$client=new SoapClient($this->post_url,array('trace' => 1));
	
		$booking_status='';
		$statusval='';
		$xml_error='';
		try
		{
			$cancelHotelBooking = $client->cancelHotelBooking($this->client_id,$track_id);	
		}
		catch(SoapFault $exception)	//Failed booking
		{
			$xml_error =  $exception->getMessage();
		
		}
		if($xml_error =='')
		{
			
			$statusvals = $cancelHotelBooking->bookingStatus;
								if($statusvals=='Cancelled')
								{
									$statusval = 'Cancelled';
									$booking_status='Cancel';
								}
		}

		
				
		if(isset($booking_status) && $booking_status!='' && isset($statusval) && $statusval!='')
		{
			$this->db->query("UPDATE booking_global SET api_status='$statusval',booking_status='$booking_status' WHERE 	pnr_no='$booking_id'");
		}
}
function booking_status($api,$booking_no,$booking_id)
{
		
		$this->set_crediential($api);
		//$this->set_variables($api);
		$result =  $this->Hotel_Model->get_reservation_details_id($booking_id);
	$track_id = $result->reservation_track_id;
	$ErrorMessageval='';
	
		$client = new SoapClient($this->post_url, array('trace'=>1));
		try
		{
			$cancelHotelBooking = $client->getHotelBookingStatus($this->client_id,$track_id);	
		}
		catch(SoapFault $exception)	//Failed booking
		{
			$xml_error =  $exception->getMessage();
		
		}
		if($ErrorMessageval=='')
				{
					
			$statusval1 = $gethotelstatus->hotelBookingInfo->bookingStatus;
			if($statusval1 == '1')
			{
			$statusval = 'Confirmed';	
			}
			if($statusval1 == '2')
			{
			$statusval = 'Confirmed';	
			}
			if($statusval1 == '3')
			{
			$statusval = 'Confirmed';	
			}
			if($statusval1 == '4')
			{
			$statusval = 'Confirmed';	
			}
			if($statusval1 == '5')
			{
			$statusval = 'Confirmed';	
			}
			
					
									$xml_Statusval='Success';
										$data = array(
											
											'api_status' => $statusval
											
										);
										$this->db->where('id', $booking_id);
										 $this->db->update('booking_global', $data);				
								
								
				}
				else
				{
					$xml_Statusval=$ErrorMessageval;
				}
				
			
				
		
			return $output= array('Statusval'=>$Statusval,'xml_Statusval'=>$xml_Statusval);
	
}

	
	
function get_reservation_details($pnr_no)
{
	$this->db->select('*');
	$this->db->from('booking');
	$this->db->where('pnr_no',$pnr_no);
	
	$query = $this->db->get();
	
	if($query->num_rows() == 0 )
	{
	   	return false;
	}
	else
	{
	 	return $query->result();
	}	
}

function get_mapped_id($hotel_id)
{
	 $this->db->select('Global_Hotelcode');
		$this->db->from('api_permanent_hotel');
		$this->db->where('Hotelspro_Hotelcode ',$hotel_id);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 0 )
		{
			return 0;
		}
		else
		{
			$response =  $query->row();
			return $response->Global_Hotelcode;
		}

}
}


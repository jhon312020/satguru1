<?php 
class Asiantravel_Model extends CI_Model {

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
	private $sec_id;
	/******* END SET VARIABLES **********/
    function __construct()
    {
        //parent::__construct();
		$this->load->model('Api_Model');
		$this->load->model('Hotel_Model');
	//	$this->sec_id = $_SESSION['session_data_id'];
		$this->domain = "DSS";
	 	$this->domain_id = "1";
    }
	function last_viewed_hotels()
	{
		
		return '';
	}
	function set_crediential($api)
	{
		$this->db->select('*');
		$this->db->from('api');
		$this->db->where('api_name', $api);
		$query = $this->db->get();	
		//echo $this->db->last_query(); exit;
		if($query->num_rows() == 0 )
		{
		   	$set_crediential =FALSE;
		}
		else
		{
	  	  	$api_info =  $query->row(); 
		 	 $this->client_id = '';
			$this->email = '';
			$this->password = '';
			$this->post_url = '';
			
			$this->set_crediential =TRUE;
			$this->active_api = $api;
		}
		
	}
	function set_variables($api)
	{
			$this->city = $_SESSION['city'];
			$cinval = explode("-",$_SESSION['cin']);
			$this->cin  = $cinval[0].'-'.$cinval[1].'-'.$cinval[2];
			$coutval = explode("-",$_SESSION['cout']);
			$this->cout  = $coutval[0].'-'.$coutval[1].'-'.$coutval[2];
			//$this->city_code = $_SESSION['city_code'];
			$city_info = $this->get_city_code($_SESSION['city_code']);
		//	echo '<pre/>';
		//	print_r($city_info);exit;
			$this->city_code = $city_info->asia_citycode;
			$this->country_code = $city_info->asia_countrycode;
			
			$this->days = $_SESSION['days'];
			$this->room_count = $_SESSION['room_count'];
			$this->adult = $_SESSION['adult'];
			$this->child = $_SESSION['child'];
			$this->child_age = $_SESSION['child_age'];
			$this->adult_count = $_SESSION['adult_count'];
			$this->child_count= $_SESSION['child_count'];
			
	}
	function hotel_availabilty($api,$hotel_code)
	{
		
		$this->delete_temp_data( $_SESSION['session_data_id']);
		$this->set_crediential($api);
		$this->set_variables($api);
			$room_info = '';
		$sb_room_cnt=0;
		$db_room_cnt=0;
		$tr_room_cnt=0;
		$q_room_cnt=0;
		$dbc_room_cnt=0;
		$dbcc_room_cnt=0;
		$dummy_room_count=0;
		
	
		for($i=0;$i< $this->room_count;$i++)
		{
			$array_vals[] =  $this->adult[$i].",".$this->child[$i];
		}
		
		$asia_rooms='';
	
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
		
				
				$check_array['1||'.$child_age.'||'.$k] = $array_vals[$k];
			
		
			
		}
	//echo '<pre/>';
		//	print_r($check_array);exit;
		foreach($check_array as $key=>$value)
		{
			$room_data = explode("||",$key);
			$adult_child_data = explode(",",$value);
			$childage_data = explode(",",$room_data[1]);
			$asia_rooms.='
							  <RoomSearchInfo>
							 		<NoAdult>'.$adult_child_data[0].'</NoAdult>
									<NoChild>'.$adult_child_data[1].'</NoChild>';
							if($adult_child_data[1] != 0)
							{
							   $asia_rooms .= '<ChildAge>';
							   for($ac=0;$ac< count($childage_data);$ac++)
							   {	
										$asia_rooms .= '
											
												<int>'.$childage_data[$ac].'</int>
											';
							   }
										$asia_rooms .= '
										</ChildAge>';
							}
							else
							{
								$asia_rooms .= '
										<ChildAge><int>0</int>
										</ChildAge>';
							}
									$asia_rooms .= '
							  </RoomSearchInfo>';
		}

		$request = '<?xml version="1.0" encoding="utf-16"?> 
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <soap:Header>
    <SOAPHeaderAuthentication MyAttribute="" xmlns="http://instantroom.com/">
      <UserName>b2bagent</UserName>
      <Password>b2bagent</Password>
      <Culture>en-US</Culture>
    </SOAPHeaderAuthentication>
  </soap:Header>
  <soap:Body>
    <SearchHotelByHotelIdV2 xmlns="http://instantroom.com/">
      <HotelID>'.$hotel_code.'</HotelID>
      <CheckInDate>'.$this->cin.'</CheckInDate>
      <CheckOutDate>'.$this->cout.'</CheckOutDate>
      <RoomInfo>
       '.$asia_rooms.'
      </RoomInfo>
      <InstantConfirmationOnly>true</InstantConfirmationOnly>
    </SearchHotelByHotelIdV2>
  </soap:Body>
</soap:Envelope>';


	$soapUrl = 'http://ws.asiatravel.net/HotelB2BAPI/atHotelsService.asmx?op=SearchHotelByHotelIdV2';	
	//echo $request;
	$response = $this->curl($soapUrl,$request);
	//	echo $response;exit;

		if(!empty($response))
		{
				$dom2=new DOMDocument();
				$dom2->loadXML($response);
				$Cityval='';
					$Cityssasdas = $dom2->getElementsByTagName("City");
					foreach($Cityssasdas as $Cityvall)
					{
					$Cityval=$Cityssasdas->item(0)->nodeValue;
					}
					if($Cityval!='')
					{
						$PromotionExceptionDatesvall= array();
					$PromotionExceptionDates=$dom2->getElementsByTagName("PromotionExceptionDates");
						foreach($PromotionExceptionDates as $val2)
						{
							
							$PromotionId = $val2->getElementsByTagName("PromotionId");
							$PromotionIdval =$PromotionId->item(0)->nodeValue;
							
							$Date = $val2->getElementsByTagName("Date");
							$Dateval =substr($Date->item(0)->nodeValue,0,10);
							$PromotionExceptionDatesvall[] = array('PromotionIdval'=>$PromotionIdval,'Dateval'=>$Dateval);
									
							
						}
						$Room_info='';
				$Room=$dom2->getElementsByTagName("Room");
				foreach($Room as $val)
				{
					$RoomCode = $val->getElementsByTagName("RoomCode");
					$RoomCodeval=$RoomCode->item(0)->nodeValue;
					
					$HotelCode = $val->getElementsByTagName("HotelCode");
					$HotelCodeval =$HotelCode->item(0)->nodeValue;
					
					$RoomName = $val->getElementsByTagName("RoomName");
					$RoomNameval =$RoomName->item(0)->nodeValue;
					
					
					
					$Availability = $val->getElementsByTagName("Availability");
					$Availabilityval=$Availability->item(0)->nodeValue;
					
					$MaxOccupancy = $val->getElementsByTagName("MaxOccupancy");
					$MaxOccupancyval =$MaxOccupancy->item(0)->nodeValue;
					
					$MaxChildOccupancy = $val->getElementsByTagName("MaxChildOccupancy");
					$MaxChildOccupancyval=$MaxChildOccupancy->item(0)->nodeValue;
					
					$MaxChildAge = $val->getElementsByTagName("MaxChildAge");
					$MaxChildAgeval=$MaxChildAge->item(0)->nodeValue;
					
					$NonRefundable = $val->getElementsByTagName("NonRefundable");
					$NonRefundableval=$NonRefundable->item(0)->nodeValue;
					
					$FreeWiFi = $val->getElementsByTagName("FreeWiFi");
					$FreeWiFival=$FreeWiFi->item(0)->nodeValue;
					
					if($FreeWiFival == 'true')
					{
						$Room_info .='Free Wi-Fi<br>';
					
					}
					if($NonRefundableval == 'true')
					{
						$Room_info .='Non Refundable - Cancellation is not allowed once booking is confirmed.<br>';
					}
					$RoomCancellationPolicy=$val->getElementsByTagName("RoomCancellationPolicy");
					foreach($RoomCancellationPolicy as $va1c)
					{
						
						$CancellationPeriod = $va1c->getElementsByTagName("CancellationPeriod");
						$CancellationPeriodval  = $CancellationPeriod->item(0)->nodeValue;
						
						
						$CancellationPeriodRule = $va1c->getElementsByTagName("CancellationPeriodRule");
						$CancellationPeriodRuleval =$CancellationPeriodRule->item(0)->nodeValue;
						
						$CancellationFee = $va1c->getElementsByTagName("CancellationFee");
						$CancellationFeeval =$CancellationFee->item(0)->nodeValue;
						
						$CancellationPenaltyRule = $va1c->getElementsByTagName("CancellationPenaltyRule");
						$CancellationPenaltyRuleval =$CancellationPenaltyRule->item(0)->nodeValue;
						
						$Room_info .= 'Cancellation Notice Period : '.$CancellationPeriodval.' days.<br>';
						$Room_info .= 'Cancellation Charge : '.$CancellationPeriodRuleval.' - '.$CancellationFeeval.' '.$CancellationPenaltyRuleval;
						
						
					}
					
					
					$RoomOccupancySeq_Val = array();
					$RoomOccupancySeq=$val->getElementsByTagName("RoomOccupancySeq");
					foreach($RoomOccupancySeq as $va1l)
					{
						
						$OccupancyId = $va1l->getElementsByTagName("OccupancyId");
						$OccupancyIdvakk =$OccupancyId->item(0)->nodeValue;
						
						$NoAdult = $va1l->getElementsByTagName("NoAdult");
						$NoAdultval =$NoAdult->item(0)->nodeValue;
						
						$NoChild = $va1l->getElementsByTagName("NoChild");
						$NoChildval =$NoChild->item(0)->nodeValue;
						
						$Seq = $va1l->getElementsByTagName("Seq");
						$Seqval =$Seq->item(0)->nodeValue;
						
						$RoomOccupancySeq_Val[] = array('OccupancyId'=>$OccupancyIdvakk,'NoAdult'=>$NoAdultval,'NoChild'=>$NoChildval,'Seq'=>$Seqval);
					}
					
					$RoomOccupancyRate_Val = array();
					$RoomOccupancyRate=$val->getElementsByTagName("RoomOccupancyRate");
					foreach($RoomOccupancyRate as $va13)
					{
						
						$Occupancy = $va13->getElementsByTagName("Occupancy");
						$Occupancyva =$Occupancy->item(0)->nodeValue;
						
						$Date = $va13->getElementsByTagName("Date");
						$Dateva  =substr($Date->item(0)->nodeValue,0,10);
						
						
						$Rate = $va13->getElementsByTagName("Rate");
						$Rateva =$Rate->item(0)->nodeValue;
						
						$RoomOccupancyRate_Val[] = array('OccupancyId'=>$Occupancyva,'occrate_Dateval'=>$Dateva,'occrate_Rateval'=>$Rateva);
						
					}
					
					
					//echo '<pre/>';
				//	print_r($RoomOccupancySeq_Val);
				//	print_r($RoomOccupancyRate_Val);
					
					$RoomOccupancy_Val = array();
					$RoomOccupancy=$val->getElementsByTagName("RoomOccupancy");
					foreach($RoomOccupancy as $va1l1)
					{
						
						$roorm_OccupancyId = $va1l1->getElementsByTagName("OccupancyId");
						$roorm_OccupancyIdval =$roorm_OccupancyId->item(0)->nodeValue;
						
						$Rate = $va1l1->getElementsByTagName("Rate");
						$Rateval =$Rate->item(0)->nodeValue;
						
												
						$RoomOccupancy_Val[] = array('OccupancyId'=>$roorm_OccupancyIdval,'Rateval'=>$Rateval);
					}
					
				//	echo '<pre/>';
				//	print_r($RoomOccupancy_Val);
					
					$RoomAvailabilityAndInclusionval='';
					$RoomAvailabilityAndInclusion_arr=array();
					$RoomAvailabilityAndInclusion=$val->getElementsByTagName("RoomAvailabilityAndInclusion");
					foreach($RoomAvailabilityAndInclusion as $va1l1s)
					{
						
						$Date = $va1l1s->getElementsByTagName("Date");
						$Dateval  =substr($Date->item(0)->nodeValue,0,10);
						
						$Breakfast = $va1l1s->getElementsByTagName("Breakfast");
						$Breakfastval =$Breakfast->item(0)->nodeValue;
						
						$Availability = $va1l1s->getElementsByTagName("Availability");
						$Availabilityval =$Availability->item(0)->nodeValue;
						
						$Inclusionval='';
							$Inclusion = $va1l1s->getElementsByTagName("Inclusion");
							foreach($Inclusion as $dfssdf)
							{
							$Inclusionval =$Inclusion->item(0)->nodeValue;
							}
							
						if($Breakfastval =='fasle')
						{
							$br = ', No Breakfast';
						}
						else
						{
							$br = ', With Breakfast';
						}
						
							$RoomAvailabilityAndInclusionval.= 'Date : '.$Dateval.$br.'('.$Inclusionval.')<br> ';
							
						
						$RoomAvailabilityAndInclusion_arr[] = array('Dateval'=>$Dateval,'Breakfastval'=>$Breakfastval,'Availabilityval'=>$Availabilityval,'Inclusionval'=>$Inclusionval);
						
												
						
					}
					
					
					$RoomPromotion_f1 = array();
						$RoomPromotion=$val->getElementsByTagName("RoomPromotion");
						foreach($RoomPromotion as $val1)
						{
							
							$PromotionId = $val1->getElementsByTagName("PromotionId");
							$PromotionIdval =$PromotionId->item(0)->nodeValue;
							
							$PromotionDetailId = $val1->getElementsByTagName("PromotionDetailId");
							$PromotionDetailIdval =$PromotionDetailId->item(0)->nodeValue;
							
							$TravelPeriodStart = $val1->getElementsByTagName("TravelPeriodStart");
							$TravelPeriodStartval =substr($TravelPeriodStart->item(0)->nodeValue,0,10);
							
							$TravelPeriodEnd = $val1->getElementsByTagName("TravelPeriodEnd");
							$TravelPeriodEndval =substr($TravelPeriodEnd->item(0)->nodeValue,0,10);
							
							$PromotionType = $val1->getElementsByTagName("PromotionType");
							$PromotionTypeval =$PromotionType->item(0)->nodeValue;
							
							$Condition = $val1->getElementsByTagName("Condition");
							$Conditionval =$Condition->item(0)->nodeValue;
							
							$DisCountType = $val1->getElementsByTagName("DisCountType");
							$DisCountTypeval =$DisCountType->item(0)->nodeValue;
							
							if($DisCountTypeval=='Percentage')
							{	$DisCountTypeval ='%'; }
								
							$DiscountValue = $val1->getElementsByTagName("DiscountValue");
							$DiscountValueval =$DiscountValue->item(0)->nodeValue;
							$PromotionExpDate='';
							
							if(isset($PromotionExceptionDatesvall[0]) && $PromotionExceptionDatesvall[0]!='')
							{
								for($g=0;$g<count($PromotionExceptionDatesvall);$g++)
								{
									if($PromotionExceptionDatesvall[$g]['PromotionIdval'] == $PromotionIdval )
									{
										$PromotionExpDate .= $PromotionExceptionDatesvall[$g]['Dateval'].', ';
									}
								}
							}
							
							$ved_ar = array('PromotionIdval'=>$PromotionIdval,'PromotionDetailIdval'=>$PromotionDetailIdval,'TravelPeriodStartval'=>$TravelPeriodStartval,'TravelPeriodEndval'=>$TravelPeriodEndval,'PromotionTypeval'=>$PromotionTypeval,'Conditionval'=>$Conditionval,'DisCountTypeval'=>$DisCountTypeval,'DiscountValueval'=>$DiscountValueval,'PromotionExpDate'=>$PromotionExpDate);
							$RoomPromotion_f1[]	=  implode("^^^^",$ved_ar);
						}
						
						
//echo '<pre/>';
//print_r($PromotionExceptionDatesvall);

							$ShortNameaa_f1	=  implode("||||",$RoomPromotion_f1);
					
					//  echo $ShortNameaa_f1;exit;
					//	echo '<pre/>';
					//	print_r($RoomOccupancySeq_Val);print_r($RoomOccupancy_Val);
					//	echo $RoomAvailabilityAndInclusionval;exit;
					//	echo '<pre/>';
					//	print_r($RoomOccupancySeq_Val);
					
					$occpancy_information = array();
					$total_cost=0;
					$total_adult=0;
					$total_child=0;
						$room_info_ = array();
						$adult_info_ =array();
						$child_info_ = array();
						$RoomNameval_ = array();
						
					for($c=0;$c<count($RoomOccupancySeq_Val);$c++)
					{
						
						for($cv=0;$cv<count($RoomOccupancy_Val);$cv++)
						{
							if($RoomOccupancySeq_Val[$c]['OccupancyId'] == $RoomOccupancy_Val[$cv]['OccupancyId'])
							{
								$new_rate = array('OccupancyId'=>$RoomOccupancySeq_Val[$c]['OccupancyId'],'NoAdult'=>$RoomOccupancySeq_Val[$c]['NoAdult'],'NoChild'=>$RoomOccupancySeq_Val[$c]['NoChild'],'Seq'=>$RoomOccupancySeq_Val[$c]['Seq'],'Rate'=>$RoomOccupancy_Val[$cv]['Rateval']);
							
								$RoomOccupancySeq_Val[$c]='';
								$RoomOccupancySeq_Val[$c] = $new_rate;
							}

							
						}
						
						$occpancy_information[] = implode("||||",$RoomOccupancySeq_Val[$c]);
						$total_cost = $total_cost + $RoomOccupancySeq_Val[$c]['Rate'];
						$total_adult = $total_adult + $RoomOccupancySeq_Val[$c]['NoAdult'];
						$total_child = $total_child + $RoomOccupancySeq_Val[$c]['NoChild'];
						$room_info_[] = 1;
						$adult_info_[] = $RoomOccupancySeq_Val[$c]['NoAdult'];
						$child_info_[] = $RoomOccupancySeq_Val[$c]['NoChild'];
						$RoomNameval_[] = $RoomNameval;
						
					}
					
					//echo '<pre/>';
				//	print_r($occpancy_information);
				//	print_r($RoomOccupancyRate_Val);
				//	print_r($RoomAvailabilityAndInclusion_arr);
					//	print_r($occpancy_information);
			
			//	print_r($occpancy_information);
					$final_occupancy = array();
					for($cf=0;$cf<count($occpancy_information);$cf++)
					{
						for($c=0;$c<count($RoomOccupancyRate_Val);$c++)
						{
							
							if($RoomOccupancyRate_Val[$c]['OccupancyId'] == $occpancy_information[$cf][0])
							{
									for($cv=0;$cv<count($RoomAvailabilityAndInclusion_arr);$cv++)
									{
										if($RoomOccupancyRate_Val[$c]['occrate_Dateval'] == $RoomAvailabilityAndInclusion_arr[$cv]['Dateval'])
										{
											$new_rate = array('OccupancyId'=>$RoomOccupancyRate_Val[$c]['OccupancyId'],'OccupancyRate'=>$RoomOccupancyRate_Val[$c]['occrate_Rateval'],'Dateval'=>$RoomAvailabilityAndInclusion_arr[$cv]['Dateval'],'Breakfastval'=>$RoomAvailabilityAndInclusion_arr[$cv]['Breakfastval'],'Availabilityval'=>$RoomAvailabilityAndInclusion_arr[$cv]['Availabilityval'],'Inclusionval'=>$RoomAvailabilityAndInclusion_arr[$cv]['Inclusionval']);
										
											$new_rate_ = implode("^^^^",$new_rate);
											$final_occupancy[] = $new_rate_;
										}
			
										
									}
								}
						}
						
					}
					
					
					//
				//		echo '<pre/>';
		
			//		print_r($RoomAvailabilityAndInclusion_arr);
		//		print_r($final_occupancy);exit;
				//	
					$room_info_V = implode("<br>",$room_info_);
					$adult_info_adult_info_ = implode("<br>",$adult_info_);
					$child_info_V = implode("<br>",$child_info_);
					$final_occupancy_v = implode("||||",$final_occupancy);
					$RoomNameval_V = implode("<br>",$RoomNameval_);
				
					
					$occpancy_information_final = implode("^^^^",$occpancy_information);
					$boardv1=$Breakfastval;
				
				
			
					
				
				
			
				//	print_r($final_occupancy_v);exit;
							$insertion_data[] = array(
														'session_id' =>  $_SESSION['session_data_id'],
														'api' => $api,
														'hotel_code' => $HotelCodeval,
														'room_code' => $RoomCodeval,
														'room_type' => $RoomNameval,
														'MaxOccupancyval' => $MaxOccupancyval,
														'MaxChildOccupancyval' => $MaxChildOccupancyval,
														'MaxChildAgeval' => $MaxChildAgeval,
														'total_cost' => $total_cost,
														'w_markup' => $total_cost,
														'status' => $Availabilityval,
															'inclusion' => $boardv1,
														'shurival' => $occpancy_information_final,
														'Classification_val' => $RoomAvailabilityAndInclusionval,
														'adult' => $total_adult,
														'child' => $total_child,
														'token' =>$final_occupancy_v,
														'ShortNameaa' =>$ShortNameaa_f1,
														'des_offer_value' => $Room_info,
														
														'room_count' => count($RoomOccupancySeq_Val),
														'org_amt' => $total_cost,
														'xml_currency' => 'SGD',
														'currency_val' => '1',
														'city' => $Cityval,
														'room_type_V' => $RoomNameval_V,
													
														'room_count_v' => $room_info_V,
														'adult_v' => $adult_info_adult_info_,
														'child_v' => $child_info_V,
														'WiFival' => $FreeWiFival,
														
														'total_cost' => $total_cost
														);
				
													
													
					
				}
					}
		}
	//	echo '<pre/>';
	//	print_r($insertion_data);exit;
		 if(isset($insertion_data))
						 {
				   $this->db->insert_batch('api_hotel_detail_t',$insertion_data);
						 }
	//echo 'asda';exit;
		
	}
	function hotel_availabilty_all($api)
	{
		
		$this->set_crediential($api);
		$this->set_variables($api);
			$room_info = '';
		$sb_room_cnt=0;
		$db_room_cnt=0;
		$tr_room_cnt=0;
		$q_room_cnt=0;
		$dbc_room_cnt=0;
		$dbcc_room_cnt=0;
		$dummy_room_count=0;
		
	
		for($i=0;$i< $this->room_count;$i++)
		{
			$array_vals[] =  $this->adult[$i].",".$this->child[$i];
		}
		
		$asia_rooms='';
	
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
		
				
				$check_array['1||'.$child_age.'||'.$k] = $array_vals[$k];
			
		
			
		}
	//echo '<pre/>';
		//	print_r($check_array);exit;
		foreach($check_array as $key=>$value)
		{
			$room_data = explode("||",$key);
			$adult_child_data = explode(",",$value);
			$childage_data = explode(",",$room_data[1]);
			$asia_rooms.='
							  <RoomSearchInfo>
							 		<NoAdult>'.$adult_child_data[0].'</NoAdult>
									<NoChild>'.$adult_child_data[1].'</NoChild>';
							if($adult_child_data[1] != 0)
							{
							   $asia_rooms .= '<ChildAge>';
							   for($ac=0;$ac< count($childage_data);$ac++)
							   {	
										$asia_rooms .= '
											
												<int>'.$childage_data[$ac].'</int>
											';
							   }
										$asia_rooms .= '
										</ChildAge>';
							}
							else
							{
								$asia_rooms .= '
										<ChildAge><int>0</int>
										</ChildAge>';
							}
									$asia_rooms .= '
							  </RoomSearchInfo>';
		}

		$request = '<?xml version="1.0" encoding="utf-16"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <soap:Header>
    <SOAPHeaderAuthentication MyAttribute="" xmlns="http://instantroom.com/">
      <UserName>b2bagent</UserName>
      <Password>b2bagent</Password>
      <Culture>en-US</Culture>
    </SOAPHeaderAuthentication>
  </soap:Header>
  <soap:Body>
    <SearchHotelsByDestV2 xmlns="http://instantroom.com/">
      <CountryCode>'.$this->country_code.'</CountryCode>
      <CityCode>'.$this->city_code.'</CityCode>
      <CheckIndate>'.$this->cin.'</CheckIndate>
      <CheckoutDate>'.$this->cout.'</CheckoutDate>
      <RoomInfo>
       '.$asia_rooms.'
      </RoomInfo>
      <InstantConfirmationOnly>true</InstantConfirmationOnly>
    </SearchHotelsByDestV2>
  </soap:Body>
</soap:Envelope>';
//echo $request;
		
	$soapUrl = 'http://ws.asiatravel.net/HotelB2BAPI/atHotelsService.asmx?op=SearchHotelsByDestV2';	
	$response = $this->curl($soapUrl,$request);
//echo $response;
	
		if(!empty($response))
		{
				$dom2=new DOMDocument();
				$dom2->loadXML($response);
				$hotel=$dom2->getElementsByTagName("Hotel");
				foreach($hotel as $val)
				{
					$item = $val->getElementsByTagName("HotelCode");
					$itemCode=$item->item(0)->nodeValue;
					
					$StarRating = $val->getElementsByTagName("StarRating");
					$str = explode(' ',$StarRating->item(0)->nodeValue);
					$StarRatingval=$str[0];
					
					$AvgPrice = $val->getElementsByTagName("AvgPrice");
					$AvgPriceval=$AvgPrice->item(0)->nodeValue;
					
					
					$IsBestDeal = $val->getElementsByTagName("IsBestDeal");
					$IsBestDealval=$IsBestDeal->item(0)->nodeValue;
					
					$HotelReviewScore = $val->getElementsByTagName("HotelReviewScore");
					$HotelReviewScoreval=$HotelReviewScore->item(0)->nodeValue;
					
					$HotelReviewCount = $val->getElementsByTagName("HotelReviewCount");
					$HotelReviewCountval=$HotelReviewCount->item(0)->nodeValue;
					
					$FreeWiFi = $val->getElementsByTagName("FreeWiFi");
					$FreeWiFival=$FreeWiFi->item(0)->nodeValue;
					$promotion='';
						$RoomPromotion=$val->getElementsByTagName("RoomPromotion");
						foreach($RoomPromotion as $val1)
						{
							
							$PromotionType = $val1->getElementsByTagName("PromotionType");
							$PromotionTypeval =$PromotionType->item(0)->nodeValue;
							
							$DisCountType = $val1->getElementsByTagName("DisCountType");
							$DisCountTypeval =$DisCountType->item(0)->nodeValue;
							
							if($DisCountTypeval=='Percentage')
							{	$DisCountTypeval ='%'; }
								
							$DiscountValue = $val1->getElementsByTagName("DiscountValue");
							$DiscountValueval =$DiscountValue->item(0)->nodeValue;
					
					
							$promotion = $PromotionTypeval.' - '.$DiscountValueval.$DisCountTypeval.' OFF on Your Hotel Stay';
						}
					

					if($this->check_hotel_info($itemCode)=='no')
					{
						
						
						
					$HotelName = $val->getElementsByTagName("HotelName");
					$HotelNameval =$HotelName->item(0)->nodeValue;
					
					
					
					$Address = $val->getElementsByTagName("Address");
					$Addressval=$Address->item(0)->nodeValue;
					
					$Location = $val->getElementsByTagName("Location");
					$Locationval=$Location->item(0)->nodeValue;
					
					$PostalCode = $val->getElementsByTagName("PostalCode");
					$PostalCodeval=$PostalCode->item(0)->nodeValue;
					
					$City = $val->getElementsByTagName("City");
					$Cityval=$City->item(0)->nodeValue;
					
					$Country = $val->getElementsByTagName("Country");
					$Countryval=$Country->item(0)->nodeValue;
					
					$HotelDesc = $val->getElementsByTagName("HotelDesc");
					$HotelDescval=$HotelDesc->item(0)->nodeValue;
					
					$FrontPgImage = $val->getElementsByTagName("FrontPgImage");
					$FrontPgImageval=$FrontPgImage->item(0)->nodeValue;
					
					
					
					
							$insertion_data[] = array(
														'hotel_code' => $itemCode,
														'hotel_name' => $HotelNameval,
														'star' => $StarRatingval,
														'address' => $Addressval,
														'location' => $Locationval,
														'postal' => $PostalCodeval,
														'city' => $this->city_code,
														
														'description' => $HotelDescval,
														'image' => $FrontPgImageval,
														'api' => 'Asiantravel'
														);
					}
						$_SESSION['hotel_xml_data'][] = array(
												
													'api' => 'Asiantravel',
													'hotel_code' => $itemCode,
													'star' => $StarRatingval,
													'org_amt' => number_format($AvgPriceval, 2, '.', ''),
													'xml_currency' => 'SGD',
													'freewifi' => $FreeWiFival,
													'bestdeal' => $IsBestDealval,
													're_score' => $HotelReviewScoreval,
													're_count' => $HotelReviewCountval,
													'promotion' => $promotion,
													'currency_val' => '1',
												
													'total_cost' => number_format($AvgPriceval, 2, '.', '')
													);
													
													
					
				}
		}
		 if(isset($insertion_data))
						 {
							// echo '<pre/>';
							// print_r($insertion_data);exit;
						   $this->db->insert_batch('api_permanent',$insertion_data);
						 }
	}
	function cancellation_policy($api,$cart_id)
	{}
	function get_hotel_details_xml($id)
	{
		
$soapUrl = "http://ws.asiatravel.net/HotelB2BAPI/atHotelsService.asmx?op=RetrieveHotelInformationV2"; // asmx URL of WSDL
      
        $request = '<?xml version="1.0" encoding="utf-16"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <soap:Header>
    <SOAPHeaderAuthentication MyAttribute="" xmlns="http://instantroom.com/">
      <UserName>b2bagent</UserName>
      <Password>b2bagent</Password>
      <Culture>en-US</Culture>
    </SOAPHeaderAuthentication>
  </soap:Header>
  <soap:Body>
                           
    <RetrieveHotelInformationV2 xmlns="http://instantroom.com/">
								    <intHotelID>'.$id.'</intHotelID>
    </RetrieveHotelInformationV2>
									</soap:Body>
								  </soap:Envelope>';  
	 $response = $this->curl($soapUrl, $request);
//	echo 'sada'.$response;exit;
	$data='';
	if(!empty($response))
		{
				$dom2=new DOMDocument();
				$dom2->loadXML($response);
				$hotel=$dom2->getElementsByTagName("HotelGenInfo");
				foreach($hotel as $val)
				{
					
					$HotelDesc = $val->getElementsByTagName("HotelDesc");
					$data['HotelDesc']=$HotelDesc->item(0)->nodeValue;
					
					$Longitude = $val->getElementsByTagName("Longitude");
					$data['Longitude']=$Longitude->item(0)->nodeValue;
					
					$Latitude = $val->getElementsByTagName("Latitude");
					$data['Latitude']=$Latitude->item(0)->nodeValue;
					
					$CheckInTime = $val->getElementsByTagName("CheckInTime");
					$data['CheckInTime']=$CheckInTime->item(0)->nodeValue;
					
					$CheckOutTime = $val->getElementsByTagName("CheckOutTime");
					$data['CheckOutTime']=$CheckOutTime->item(0)->nodeValue;
					
					$HotelImages=$val->getElementsByTagName("HotelImages");
					$h_images=array();
					$l=0;
				foreach($HotelImages as $valimage)
				{
					$img = $HotelImages->item($l)->getAttribute("ImageFileName");
					
					if($img=='')
					{
						$RoomTypeCodeval='';
						$RoomTypeCode=$valimage->getElementsByTagName("RoomTypeCode");
						foreach($RoomTypeCode as $dfd)
						{ 
						$RoomTypeCodeval =$RoomTypeCode->item(0)->nodeValue;
						}
						$ImageFileName=$valimage->getElementsByTagName("ImageFileName");
						$ImageFileNameval =$ImageFileName->item(0)->nodeValue;
						$ImageName=$valimage->getElementsByTagName("ImageName");
						$ImageNameval =$ImageName->item(0)->nodeValue;
						$h_images[]= array('RoomTypeCodeval'=>mysql_real_escape_string($RoomTypeCodeval),'ImageFileNameval'=>mysql_real_escape_string($ImageFileNameval),'ImageNameval'=>mysql_real_escape_string($ImageNameval));
						
						
				
					}
					else
					{
					
						$h_images[] =array('RoomTypeCodeval'=>'','ImageFileNameval'=>mysql_real_escape_string($img),'ImageNameval'=>'');
					}
				$l++;
				}
				
				$data['h_images']=$h_images;
				
				
				$HotelFacility=$val->getElementsByTagName("HotelFacility");
					$HotelFacilityVas=array();
					$l=0;
				foreach($HotelFacility as $valimages)
				{
					$fac =$HotelFacility->item($l)->getAttribute("Facility");	
					if($fac!='')
					{
						
						$HotelFacilityVas[] =$fac;	
					}
					else
					{
						$HotelImagesssss=$valimages->getElementsByTagName("FeatureDesc");
						$HotelFacilityVas[] =$HotelImagesssss->item(0)->nodeValue;
						
					}
					
				$l++;
				}
				
				$data['HotelFacilityVas']=$HotelFacilityVas;
				
					///////
					$Room=$val->getElementsByTagName("Room");
					$h_room_info=array();
					$l=0;
				foreach($Room as $Roomv)
				{
					
						$RoomCode=$Roomv->getElementsByTagName("RoomCode");
						$RoomCodeval =$RoomCode->item(0)->nodeValue;
						$RoomTypeCode=$Roomv->getElementsByTagName("RoomTypeCode");
						$RoomTypeCodeval='';
						foreach($RoomTypeCode as $vv)
						{
						$RoomTypeCodeval =$RoomTypeCode->item(0)->nodeValue;
						}
						$HotelCode=$Roomv->getElementsByTagName("HotelCode");
						$HotelCodeval =$HotelCode->item(0)->nodeValue;
						$RoomName=$Roomv->getElementsByTagName("RoomName");
						$RoomNameval =$RoomName->item(0)->nodeValue;
						$RoomDescriptionss=$Roomv->getElementsByTagName("RoomDescription");
						$RoomDescriptionssvass='';
						foreach($RoomDescriptionss as $sd)
						{
						$RoomDescriptionssvass =$RoomDescriptionss->item(0)->nodeValue;
						}
						$FeatureDescval='';
						$pk=0;
						$FeatureDesc=$Roomv->getElementsByTagName("FeatureDesc");
						foreach($FeatureDesc as $dsf)
						{
							$FeatureDescval .=" &bull; ".$FeatureDesc->item($pk)->nodeValue.'<br>';
							$pk++;
						}
					
							$h_room_info[] = array(
														'session_id' =>  $_SESSION['session_data_id'],
														'RoomCodeval' => mysql_real_escape_string($RoomCodeval),
														'RoomTypeCodeval' => mysql_real_escape_string($RoomTypeCodeval),
														'HotelCodeval' => mysql_real_escape_string($HotelCodeval),
														'RoomNameval' => mysql_real_escape_string($RoomNameval),
														'RoomDescriptionval' => mysql_real_escape_string($RoomDescriptionssvass),
														'FeatureDescval' => mysql_real_escape_string($FeatureDescval)
														
														);
				
													
					
					
				$l++;
				}			
				
					 if(isset($h_room_info[0]))
						 {
							 
				   $this->db->insert_batch('api_hotel_detail_t_asia_room',$h_room_info);
				   
						 }
						 if(isset($h_images[0]))
						 {
							
				   $this->db->insert_batch('api_hotel_detail_t_asia_image',$h_images);
				   
						 }
						 
				}
		}	
		return $data;
	}
	function hotel_detail($api)
	{
		$this->set_crediential($api);
	}
	function booking($api,$result_id,$hotel_id,$parent_pnr_no,$booking_global_id)
	{
		
		$this->set_crediential($api);
		$this->set_variables($api);
			$room_info = '';
		$sb_room_cnt=0;
		$db_room_cnt=0;
		$tr_room_cnt=0;
		$q_room_cnt=0;
		$dbc_room_cnt=0;
		$dbcc_room_cnt=0;
		$dummy_room_count=0;
	
		$result=$this->Hotel_Model->fetch_temp_result_room_id($result_id);	
		$occ_info = explode("^^^^",$result->shurival);
		$asia_rooms='';
		$booking_pass_details = $_SESSION['booking_pass_details'];
	//echo '<pre/>';
		//	print_r($occ_info);exit;
		for($i=0;$i<count($occ_info);$i++)
		{
			$room_data = explode("||||",$occ_info[$i]);
			
			$asia_rooms.='
							  <RoomReserveInfo>
							  <RoomId>'.$result->room_code.'</RoomId>
							  <OccupancyId>'.$room_data[0].'</OccupancyId>
							 		<NoAdult>'.$room_data[1].'</NoAdult>
									<NoChild>'.$room_data[2].'</NoChild>';
							if($room_data[0] == 'sadasd')
							{
							   
							   for($ac=0;$ac< count($childage_data);$ac++)
							   {	
										$asia_rooms .= '
											<ChildAge'.$ac.'>
												'.$childage_data[$ac].'
												</ChildAge'.$ac.'>
											';
							   }
										
							}
							else
							{
								$asia_rooms .= '';
							}
						
									$asia_rooms .= '
									<PaxInfo>
								<GuestTitle>'.$booking_pass_details['user_title'].'</GuestTitle>
								<FirstName>'.$booking_pass_details['firstname'].'</FirstName>
								<LastName>'.$booking_pass_details['lastname'].'</LastName>
							  </PaxInfo>';
		
								$asia_rooms .= '  </RoomReserveInfo>';
		}
		//echo '<pre/>';
		//print_r($_SESSION);echo $asia_rooms;exit;

		$request = '<?xml version="1.0" encoding="utf-16"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <soap:Header>
    <SOAPHeaderAuthentication MyAttribute="" xmlns="http://instantroom.com/">
      <UserName>b2bagent</UserName>
      <Password>b2bagent</Password>
      <Culture>en-US</Culture>
    </SOAPHeaderAuthentication>
  </soap:Header>
  <soap:Body>
    <BookHotel xmlns="http://instantroom.com/">
      <HotelID>'.$result->hotel_code.'</HotelID>
      <RoomID>'.$result->room_code.'</RoomID>
      <CheckInDate>'.$this->cin.'</CheckInDate>
      <CheckOutDate>'.$this->cout.'</CheckOutDate>
      <GuestContactDetails>
        <Salutation>0</Salutation>
        <ContactPersonFirstName>'.$booking_pass_details['firstname'].'</ContactPersonFirstName>
        <ContactPersonLastName>'.$booking_pass_details['lastname'].'</ContactPersonLastName>
        <Email>'.$booking_pass_details['email'].'</Email>
        <AlternateEmail />
        <PhoneNo>'.$booking_pass_details['mobile'].'</PhoneNo>
        <FaxNo />
        <MobileNo>'.$booking_pass_details['mobile'].'</MobileNo>
        <Address>'.$booking_pass_details['address'].'</Address>
        <PostalCode />
        <City />
        <Company />
        <Nationality>'.$booking_pass_details['nationality'].'</Nationality>
        <CountryOfResidence>'.$booking_pass_details['nationality'].'</CountryOfResidence>
        <SpecialRequest>'.$booking_pass_details['special'].'</SpecialRequest>
      </GuestContactDetails>
      <RoomInfo>
       '.$asia_rooms.'
      </RoomInfo>
     
      <CreditCardDetails>
        <CardNo>4544152000000004</CardNo>
        <CardType>Visa</CardType>
        <CardCVV>123</CardCVV>
        <CardExpiry>2011/06</CardExpiry>
        <CardHolderName>test</CardHolderName>
        <CardIssuanceCountry>SG</CardIssuanceCountry>
        <CardIssuanceBank>citibank</CardIssuanceBank>
        <BillingAddress>'.$booking_pass_details['address'].'</BillingAddress>
      </CreditCardDetails>
      <PaymentType>CreditLimit</PaymentType>
      <TotalRoomRate>'.$result->total_cost.'</TotalRoomRate>
      <AgentRefNo>'.$parent_pnr_no.'</AgentRefNo>
    </BookHotel>
  </soap:Body>
</soap:Envelope>';
		//echo $request;exit;
	$soapUrl = 'http://ws.asiatravel.net/HotelB2BAPI/atHotelsService.asmx?op=BookHotel';	
	//echo $request;
	$response = $this->curl($soapUrl,$request);
	
	//echo 'sada'.$response;exit;
	
		if(!empty($response))
		{
				$dom2=new DOMDocument();
				$dom2->loadXML($response);
				$Cityval='';
					
					
	
		 
		$Booking=$dom2->getElementsByTagName("Booking");
		$booking_status='Failed';
		$BookingConfirmationNoval='XXXXXXXXXXX';
		$statusval='Failed';
		$BookedAndPaidval='';
		foreach($Booking as $Bookingval)
		{
			$BookingConfirmationNo = $Bookingval->getElementsByTagName("BookingConfirmationNo");
						$BookingConfirmationNoval=$BookingConfirmationNo->item(0)->nodeValue;
						
						$Status = $Bookingval->getElementsByTagName("Status");
						$statusval=$Status->item(0)->nodeValue;
						
						$BookedAndPaid = $Bookingval->getElementsByTagName("BookedAndPaid");
						$BookedAndPaidval=$BookedAndPaid->item(0)->nodeValue;
						
						
				$booking_status='Success';
			
		}
			$data = array(
				'booking_no' => $BookingConfirmationNoval,
				'api_status' => $statusval,
				'booking_status' => $booking_status,
				'BookedAndPaidval' => $BookedAndPaidval
			);
		
	
			$this->db->where('id', $booking_global_id);
			 $this->db->update('booking_global', $data);
	
	//$this->insert_booking_data($result_id,$BookingConfirmationNoval,$statusval,$booking_status,$parent_pnr_no,$booking_global_id);
	
			}
		 
	
		
	}
	function insert_booking_data($result_id,$BookingConfirmationNoval,$statusval,$booking_status,$parent_pnr_no,$booking_global_id)
	{
		
			$data = array(
				'booking_no' => $BookingConfirmationNoval,
				'api_status' => $statusval,
				'booking_status' => $booking_status
			);
		
	
			$this->db->where('id', $booking_global_id);
			 $this->db->update('booking_global', $data);
	
			
		
	}
	function cancellation($api,$booking_id)
	{
		
		$this->set_crediential($api);
		
		$result =  $this->Hotel_Model->get_reservation_details_id($booking_id);
		$result_hotel =  $this->Hotel_Model->get_hotel_information_v4($result->product_id);
$booking_status='';
		$statusval='';
	$xml_data ='<?xml version="1.0" encoding="utf-16"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <soap:Header>
    <SOAPHeaderAuthentication MyAttribute="" xmlns="http://instantroom.com/">
      <UserName>b2bagent</UserName>
      <Password>b2bagent</Password>
      <Culture />
    </SOAPHeaderAuthentication>
  </soap:Header>
  <soap:Body>
    <CancelBooking xmlns="http://instantroom.com/">
      <ReferenceNo>'.$result->booking_no.'</ReferenceNo>
    </CancelBooking>
  </soap:Body>
</soap:Envelope>';
	$soapUrl = 'http://ws.asiatravel.net/HotelB2BAPI/atHotelsService.asmx?op=CancelBooking';	
			$response = $this->curl($soapUrl,$xml_data);

			   $dom=new DOMDocument(); 
					$dom->loadXML("$response"); 
			
			$BookingResponse=$dom->getElementsByTagName("CancelBookingResult");
			
					foreach($BookingResponse as $BookingResponseval)
					{
						
						$statusvals = $BookingResponse->item(0)->nodeValue;
						if($statusvals=='true')
						{
							$statusval = 'Cancelled';
							$booking_status='Cancel';
						}
						
					}

				
				
				
				
		if(isset($booking_status) && $booking_status!='' && isset($statusval) && $statusval!='')
		{
			$this->db->query("UPDATE booking_global SET  	api_status='$statusval',booking_status='$booking_status' WHERE 	pnr_no='$booking_id'");
		}
		
		
		
	}
	function curl($soapUrl, $request)
	{
		
		
			  $soapUser = "promise_xml";  //  username
       		  $soapPassword = "promise11"; // password
			  
			  $ch2=curl_init();
		
        curl_setopt($ch2, CURLOPT_URL, $soapUrl);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, "$request");
	    //curl_setopt($ch2, CURLOPT_USERPWD, $soapUser.":".$soapPassword);
  		//curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		//curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
 		//	curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0); 
  		//	curl_setopt($ch2, CURLOPT_SSLVERSION, 3); 
		
        $httpHeader2 = array(
            "Content-Type: text/xml; charset=UTF-8",
            "Content-Encoding: UTF-8",
			"Accept-Encoding: gzip,deflate",
			"Host: ws.asiatravel.net",
                        "Content-length: ".strlen($request)
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
	function check_hotel_info($id)
	{
		
	     $this->db->select('*');
		$this->db->from('api_permanent');
		$this->db->where('hotel_code',$id);
		$this->db->where('api','Asiantravel');
		$query = $this->db->get();
		
		if($query->num_rows() == '' )
		{
		   return 'no';   
		}
		else
		{
		  return 'yes'; 
		}
	
	}
	function get_city_code($city)
	{
		
	     $this->db->select('*');
		$this->db->from('api_hotels_city');
		$this->db->where('city_id',$city);
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
	function delete_temp_data($ses_id)
	{
	$this->db->delete('api_hotel_detail_t', array('session_id' => $ses_id)); 	
	}
		
}

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->model('Account_Model');
		$this->load->model('Hotel_Model');
		$this->load->model('Home_Model');
		$this->load->helper('home');
		$this->domain = "DSS";
		$this->domain_id = "1";
	}
	function index()
	{
		/* $data['airports'] = '';
		 $data['imp_airports'] ='';
         $this->load->view('flight/flight_index', $data); */
		redirect('home/hotels/', 'refresh');
	}	
	function forget_password()
	{
	
        $this->load->view('account/forget_password');
		
	}
	function forget_password_process()
	{
			    $this->load->model('Email_Model');

		$email3 = $this->input->post('email');
		$domain = $this->domain_id;
			$Query="select * from  b2c  where email ='".$email3."' and  domain ='".$domain."'";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$result = $query->row();
				   
				
					 $message ='<table width="100%" border="0" cellspacing="5" cellpadding="5">
					 
					 <tr>
					 <td  align="left" valign="top">
					  This is to inform you that an login details of your account .<br><br>
					 </td>
					 <tr>
   			
			<td  align="left" valign="top">
			<strong><u>Login Details </u></strong><br><br>
			<strong>Login Url </strong> : '.site_url().'/login/member_login <br>
			<strong>Username </strong> : '.$result->email.' <br>
			<strong>Password </strong> : '.$result->password.' <br>
			</td>
		 	</tr>
			</table>'; 
				 $message_header='Forget Password';
				 $subject='DSS - Forget Password';
				$fnam = $result->firstname;
				 $this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
				 $data['x'] = 'Password has been sent to your Email-Id !.';
				    $this->load->view('account/forget_password',$data);
				 
		}
		else
		{
			 $data['x'] = 'Email-Id is wrong !.';
				    $this->load->view('account/forget_password',$data);
			
		}
			
	}
	function chat()
	{
		
		$server = "localhost";
		$db_user = "root";
		$db_pass = "";
		$database = "DSS";

		$db = mysql_connect($server, $db_user,$db_pass);
		mysql_select_db($database,$db);
		$timeoutseconds = 5; //5 minutes
		$timestamp = time();
		$timeout = $timestamp-$timeoutseconds;
		$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
		$PHP_SELF = $_SERVER['PHP_SELF'];
		echo "INSERT INTO useronline VALUES ('$timestamp','$REMOTE_ADDR','$PHP_SELF')";
		$insert = mysql_query("INSERT INTO useronline VALUES ('$timestamp','$REMOTE_ADDR','$PHP_SELF')",$db);
		if(!($insert)) {
		print "Useronline Insert Failed > ";
		}
		$delete = mysql_query("DELETE FROM useronline WHERE timestamp<$timeout",$db);
		if(!($delete)) {
		print "Useronline Delete Failed > ";
		}
		$result = mysql_query("SELECT DISTINCT ip FROM useronline WHERE file='$PHP_SELF'",$db);
		if(!($result)) {
		print "Useronline Select Error > ";
		}
		$user = mysql_num_rows($result);
		//mysql_close();
		if($user == 1) {
		print("$user user online\n");
		} else {
		print("$user users online\n");
		}
	}
	function email_test()
	{
	$this->load->view('email/email_test - voucher 2');
	}
	function email_test1()
	{
	$this->load->view('email/email_test - voucher');
	}
	
	function contact_detail()
	{
	  $this->load->view('hotel/contact_us');	
	}
	
	function sortHotel()
	{
		$data = $_SESSION['hotel_search_session_data'];
		
		if($_POST['filter'] == "name" && $_POST['type'] == "asc") 
		{
			usort($data, function($a, $b) {
				if ($a['hotel_name'] == $b['hotel_name']) return 0;
				return ($a['hotel_name'] > $b['hotel_name']) ? 1 : -1;
			});
		}
		if($_POST['filter'] == "name" && $_POST['type'] == "desc") 
		{
			usort($data, function($a, $b) {
				if ($a['hotel_name'] == $b['hotel_name']) return 0;
				return ($a['hotel_name'] < $b['hotel_name']) ? 1 : -1;
			});
		}
		if($_POST['filter'] == "rating" && $_POST['type'] == "desc") 
		{
			usort($data, function($a, $b) {
				if ($a['review_rating'] == $b['review_rating']) return 0;
				return ($a['review_rating'] < $b['review_rating']) ? 1 : -1;
			});
		}
		if($_POST['filter'] == "rating" && $_POST['type'] == "asc") 
		{
			usort($data, function($a, $b) {
				if ($a['review_rating'] == $b['review_rating']) return 0;
				return ($a['review_rating'] > $b['review_rating']) ? 1 : -1;
			});
		}
		
		if($_POST['filter'] == "price" && $_POST['type'] == "desc") 
		{
			usort($data, function($a, $b) {
				if ($a['min_rate'] == $b['min_rate']) return 0;
				return ($a['min_rate'] < $b['min_rate']) ? 1 : -1;
			});
		}
		if($_POST['filter'] == "price" && $_POST['type'] == "asc") 
		{
			usort($data, function($a, $b) {
				if ($a['min_rate'] == $b['min_rate']) return 0;
				return ($a['min_rate'] > $b['min_rate']) ? 1 : -1;
			});
		}
		
		if($_POST['filter'] == "star" && $_POST['type'] == "desc") 
		{
			usort($data, function($a, $b) {
				if ($a['star_rating'] == $b['star_rating']) return 0;
				return ($a['star_rating'] < $b['star_rating']) ? 1 : -1;
			});
		}
		if($_POST['filter'] == "star" && $_POST['type'] == "asc") 
		{
			usort($data, function($a, $b) {
				if ($a['star_rating'] == $b['star_rating']) return 0;
				return ($a['star_rating'] > $b['star_rating']) ? 1 : -1;
			});
		}
		
		if(!empty($_SESSION['hotel_currency_code']))
		{
			$aConvertedCode = $this->Account_Model->getCurrencyRates($_SESSION['hotel_currency_code']);
		
		if(!empty($aConvertedCode[0]->value))
		{
			foreach($data as $key => $value)
			{
				$min_rate = $value['min_rate'] * $aConvertedCode[0]->value;
				$strike_rate = $value['org_min_rate'] * $aConvertedCode[0]->value;
				$data[$key]['min_rate'] = number_format($min_rate,2);
				$data[$key]['org_min_rate'] = number_format($strike_rate,2);
			}
		}
		}
		
		$_SESSION['hotel_search_session_data']  = $data;
		
		
		$aResponse['result'] = $data;
		$hotel_search_result = $this->load->view('hotel/search_result_ajax_search_page', $aResponse, true);		
		print json_encode(array(
			'hotel_search_result' => $hotel_search_result,
		));
	}	
	
	function currencyConvert()
	{
		$_SESSION['hotel_currency_code'] = $_POST['currency_code'];
		$aConvertedCode = $this->Account_Model->getCurrencyRates($_SESSION['hotel_currency_code']);
		$aData = $_SESSION['hotel_search_session_data'];
		
		if(!empty($aConvertedCode[0]->value))
		{
			foreach($aData as $key => $value)
			{
				$min_rate = $value['min_rate'] * $aConvertedCode[0]->value;
				$strike_rate = $value['org_min_rate'] * $aConvertedCode[0]->value;
				$aData[$key]['min_rate'] = number_format($min_rate,2);
				$aData[$key]['org_min_rate'] = number_format($strike_rate,2);
			}
		}
		$aResponse['result'] = $aData;
		$hotel_search_result = $this->load->view('hotel/search_result_ajax_search_page', $aResponse, true);	
		print json_encode(array(
			'hotel_search_result' => $hotel_search_result,
		));
	}
	
	function modify_search()
	{
		$this->load->view('hotel/modify_search');
	}
	
	function contact_us()
	{
		$this->load->view('contact_us');
	}
	  public function hotels() {
      
        $this->load->view('hotel/hotel_index');
    }
	  public function getAdultChilds() {
        $roomCount = $_GET['count'];
        $showAdultChild = showAdultChildBox($roomCount); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showAdultChild
        ));
    }

    public function showChildAgeBox() {
        $childCount = $_GET['count'];
        $rm = $_GET['rm'];
        $showChild = showChildAgeBox($childCount, $rm); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showChild
        ));
    }

    public function getAdultChildsModifySearch() {
        $roomCount = $_GET['count'];
        $showAdultChild = showAdultChildBoxModify($roomCount); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showAdultChild
        ));
    }

    public function showChildAgeBoxModify() {
        $childCount = $_GET['count'];
        $rm = $_GET['rm'];
        $showChild = showChildAgeBoxModify($childCount, $rm); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showChild
        ));
    }
    
    
    function payment(){
		//$this->db->select('*');
		//$this->db->from('asia_hotel_room_list');
		//$this->db->where('id',$_SESSION['customer']['id']);	
		//$query = $this->db->get();
		
			$service = '';
			$RoomCode=$service->RoomCode;
			$HotelCode=$service->HotelCode;
			$AvgPrice 	=$service->Rate;
			$OccupancyId 	=$service->OccupancyId;
			$cinval = explode("/",$_SESSION['hotel_search']['cin']);

		$cin  = $cinval[2].'-'.$cinval[0].'-'.$cinval[1];

		$coutval = explode("/",$_SESSION['hotel_search']['cout']);

		$cout  = $coutval[2].'-'.$coutval[0].'-'.$coutval[1];
		$sec_id=$_SESSION['hotel_search']['session_id'];
		for($i=0;$i< $_SESSION['hotel_search']['adult'];$i++){
			
			
		}
		$sal=$this->input->post('sal');
		
		$data['fname']=$fname=$this->input->post('fname');
		$data['email']=$email=$this->input->post('email');
		$data['mobile']=$mobile=$this->input->post('mobile');
		$data['address']=$address=$this->input->post('address');
        $soapUser = "promise_xml";  //  username
        $soapPassword = "promise11"; // password	
	$xml_post_string='<?xml version="1.0" encoding="utf-16"?>
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
      <HotelID>'.$HotelCode.'</HotelID>
      <RoomID>'.$RoomCode.'</RoomID>
      <CheckInDate>'.$cin.'T00:00:00</CheckInDate>
      <CheckOutDate>'.$cout.'T00:00:00</CheckOutDate>
      <GuestContactDetails>
        <Salutation>0</Salutation>
        <ContactPersonFirstName>'.$_SESSION['customer']['firstname'].'</ContactPersonFirstName>
        <ContactPersonLastName>'.$_SESSION['customer']['lastname'].'</ContactPersonLastName>
        <Email>'.$_SESSION['customer']['email'].'</Email>
        <AlternateEmail />
        <PhoneNo>'.$_SESSION['customer']['mobile'].'</PhoneNo>
        <FaxNo />
        <MobileNo>'.$_SESSION['customer']['mobile'].'</MobileNo>
        <Address>'.$_SESSION['customer']['address'].'</Address>
        <PostalCode />
        <City />
        <Company />
        <Nationality>'.$_SESSION['customer']['nationality'].'</Nationality>
        <CountryOfResidence>'.$_SESSION['customer']['nationality'].'</CountryOfResidence>
        <SpecialRequest>'.$_SESSION['customer']['special'].'</SpecialRequest>
      </GuestContactDetails>
      <RoomInfo>
        <RoomReserveInfo>
          <RoomId>'.$RoomCode.'</RoomId>
          <OccupancyId>'.$OccupancyId.'</OccupancyId>
          <NoAdult>'.$_SESSION['hotel_search']['adult'].'</NoAdult>
          <NoChild>0</NoChild>
          <ChildAge1>0</ChildAge1>
          <ChildAge2>0</ChildAge2>
          <PaxInfo>
            <GuestTitle>Mr</GuestTitle>
            <FirstName>test</FirstName>
            <LastName>test</LastName>
          </PaxInfo>
        </RoomReserveInfo>
      </RoomInfo>
      <FlightInfo>
        <FlightArrivalNo>SQ 121</FlightArrivalNo>
        <FlightArrivalDateTime>6/5/2011</FlightArrivalDateTime>
        <FlightDepartureNo>SQ 122</FlightDepartureNo>
        <FlightDepartureDateTime>6/5/2011</FlightDepartureDateTime>
      </FlightInfo>
      <CreditCardDetails>
        <CardNo>4544152000000004</CardNo>
        <CardType>Visa</CardType>
        <CardCVV>123</CardCVV>
        <CardExpiry>2011/06</CardExpiry>
        <CardHolderName>test</CardHolderName>
        <CardIssuanceCountry>SG</CardIssuanceCountry>
        <CardIssuanceBank>citibank</CardIssuanceBank>
        <BillingAddress>'.$_SESSION['customer']['address'].'</BillingAddress>
      </CreditCardDetails>
      <PaymentType>CreditLimit</PaymentType>
      <TotalRoomRate>'.$AvgPrice.'</TotalRoomRate>
      <Availability>true</Availability>
      <AgentRefNo>ABC123</AgentRefNo>
    </BookHotel>
  </soap:Body>
</soap:Envelope>';
	//echo '<pre>';print_r($xml_post_string);exit;
	$posturl='http://ws.asiatravel.net/HotelB2BAPI/atHotelsService.asmx?op=BookHotel';
            $ch = curl_init(); 

        $httpHeader2 = array(
            "Content-Type: text/xml; charset=UTF-8",
            "Content-Encoding: UTF-8",
			"Accept-Encoding: gzip,deflate",
			 "Host: ws.asiatravel.net"
        );

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $posturl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader2);
            $response = curl_exec($ch); 
		    curl_close($ch); 
			
			//echo '<pre>';print_r($response);exit;
		$response1 = str_replace("<soap:Body>","",$response);

            $response2 = str_replace("</soap:Body>","",$response1);

		    $lang= htmlspecialchars(print_r($response2, true));

			$xmlString = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3",  $response);

  	        $xml = SimpleXML_Load_String($xmlString);

	        $xml = new SimpleXMLElement($xml->asXML());
			$parse = $xml->soapBody->BookHotelResponse->BookHotelResult;
			$diffgrdiffgram = $parse->diffgrdiffgram;	
			$bookingdeatils=$diffgrdiffgram->AT_BookingDetails;
			//echo '<pre>';print_r($diffgrdiffgram);exit;	
			$data['BookingConfirmationNo']=$BookingConfirmationNo=$bookingdeatils->Booking->BookingConfirmationNo;
			$data['HotelId']=$HotelId=$bookingdeatils->Booking->HotelId;
			$data['HotelName']=$HotelName=$bookingdeatils->Booking->HotelName;
			$data['HotelPhoneNo']=$HotelPhoneNo=$bookingdeatils->Booking->HotelPhoneNo;
			$data['CountryName']=$CountryName=$bookingdeatils->Booking->CountryName;
			$data['CityName']=$CityName=$bookingdeatils->Booking->CityName;
			$data['Status']=$Status=$bookingdeatils->Booking->Status;
			$data['CheckInDate']=$CheckInDate=$bookingdeatils->Booking->CheckInDate;
			$data['CheckOutDate']=$CheckOutDate=$bookingdeatils->Booking->CheckOutDate;
			$data['BookedAndPaid']=$BookedAndPaid=$bookingdeatils->Booking->BookedAndPaid;
			$data['Currency']=$Currency=$bookingdeatils->Booking->Currency;
			$data['TotalPrice']=$TotalPrice=$bookingdeatils->Booking->TotalPrice;
			$data['GuestName']=$GuestName=$bookingdeatils->BookingDetails->GuestName;
			$data['GuestLastName']=$GuestLastName=$bookingdeatils->BookingDetails->GuestLastName;
			$data['Gender']=$Gender=$bookingdeatils->BookingDetails->Gender;
			$data['RoomCode']=$RoomCode=$bookingdeatils->BookingDetails->RoomCode;
			$data['RoomName']=$RoomName=$bookingdeatils->BookingDetails->RoomName;
			$data['NoOfRoom']=$NoOfRoom=$bookingdeatils->BookingDetails->NoOfRoom;
			$data['NoOfAdult']=$NoOfAdult=$bookingdeatils->BookingDetails->NoOfAdult;
			$data['NoOfChild']=$NoOfChild=$bookingdeatils->BookingDetails->NoOfChild;
			$data['ChildAges1']=$ChildAges1=$bookingdeatils->BookingDetails->ChildAges1;
			$data['ChildAges2']=$ChildAges2=$bookingdeatils->BookingDetails->ChildAges2;
			$data['PeriodStart']=$PeriodStart=$bookingdeatils->RoomInclusion->PeriodStart;
			$data['PeriodEnd']=$PeriodEnd=$bookingdeatils->BookingDetails->PeriodEnd;
			$data['Inclusion']=$Inclusion=$bookingdeatils->BookingDetails->Inclusion;
			$data['CancellationPeriod']=$CancellationPeriod=$bookingdeatils->CancellationPolicy->CancellationPeriod;
			$data['CancellationPeriodRule']=$CancellationPeriodRule=$bookingdeatils->CancellationPolicy->CancellationPeriodRule;
			$data['CancellationFee']=$CancellationFee=$bookingdeatils->CancellationPolicy->CancellationFee;
			$data['CancellationPenaltyRule']=$CancellationPenaltyRule=$bookingdeatils->CancellationPolicy->CancellationPenaltyRule;
			$data['NoShowFee']=$NoShowFee=$bookingdeatils->CancellationPolicy->NoShowFee;
			$data['NoShowPenaltyRule']=$NoShowPenaltyRule=$bookingdeatils->CancellationPolicy->NoShowPenaltyRule;
			
			$query=$this->db->query("INSERT INTO booking_asia (session_id,BookingConfirmationNo,HotelId,HotelName,
									HotelPhoneNo,CountryName,CityName,Status,CheckInDate,CheckOutDate,BookedAndPaid,Currency				                     ,TotalPrice,GuestName,GuestLastName,Gender,RoomCode,RoomName,NoOfRoom,NoOfAdult,NoOfChild,ChildAges1,ChildAges2,PeriodStart,PeriodEnd,Inclusion,CancellationPeriod,CancellationPeriodRule,CancellationFee,CancellationPenaltyRule,NoShowFee,NoShowPenaltyRule) VALUES('$sec_id','$BookingConfirmationNo','$HotelId','$HotelName','$HotelPhoneNo','$CountryName','$CityName','$Status','$CheckInDate','$CheckOutDate','$BookedAndPaid','$Currency','$TotalPrice','$GuestName','$GuestLastName','$Gender','$RoomCode','$RoomName','$NoOfRoom','$NoOfAdult','$NoOfChild','$ChildAges1','$ChildAges2','$PeriodStart','$PeriodEnd','$Inclusion','$CancellationPeriod','$CancellationPeriodRule','$CancellationFee','$CancellationPenaltyRule','$NoShowFee','$NoShowPenaltyRule')");
		$to = $_SESSION['customer']['email'];
$subject = "Confirmation Booking Details ";

$from = "dssdemo@dss.com.sg" ;

$message='<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Voucher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

  </head>
  <style>
      textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
background-color: #ffffff;
border: 1px solid #cccccc;
-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
-webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
-moz-transition: border linear 0.2s, box-shadow linear 0.2s;
-o-transition: border linear 0.2s, box-shadow linear 0.2s;
transition: border linear 0.2s, box-shadow linear 0.2s;
}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
display: inline-block;
height: 20px;
padding: 4px 6px;
margin-bottom: 10px;
font-size: 14px;
line-height: 20px;
color: #555555;
vertical-align: middle;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}
  </style>
  <body>
      <div style="float: right; width: 167px;text-align: right;">
                      
                      <div style=" padding-top:0px;">
<a href="javascript:void(0);" onClick="javascript:window.print();" style="color: #8A8985;margin-right: 10px;text-decoration: none;font-size: 13px;" >Print</a>                      
                      
<span class="res_btn"></span>

                  </div>         
            
		</div>
      <div style="width: 800px; margin: 0 auto;">
          <div style="width: 780px;padding: 10px; float: left;">
              <div style="width: 50%; float: left;"><h3><span style="color: #979797;">Hotel</span> Voucher</h3></div>
              <div style="width: 50%; float: right;text-align: right;"><img src="'.base_url().'/assets/images/logo.png" width="180" style="margin-top: 10px;"></div>
          </div>
          <div style="width: 778px; border: 1px solid #de6061; padding: 10px;float: left; border-radius: 5px;">
              <div style="width: 20px; float: left;">
                  <img src="'.base_url().'/assets/images/tag-red.png">
              </div>
              <div style="width: 755px; float: left;">
                  <span style="color: #de6061;">Please Present This Voucher Upon Arrival</span>
              </div>
              
              <div style="width: 758px; border: 1px solid #ccc; padding: 10px;float: left; border-radius: 5px; margin-top: 20px;">
                  <h4><?php echo $HotelName;?></h4> 
                  <p>Address</p>
                  
                  <div style="width: 50%; float: left;">
                      <div style="width: 378px; float: left;">
                          <div style="width: 150px; float: left;"> <label>Booking Number</label></div>
                          <div style="width: 150px; float: left;">'.$BookingConfirmationNo.'</div>
                     
    
    </div>
                            <div style="width: 378px; float: left;">
                                <div style="width: 150px; float: left;"><label>Guest Name</label></div>
                          <div style="width: 150px; float: left;">'.$_SESSION['customer']['firstname'].'  '.$_SESSION['customer']['lastname'].'</div>
                      
    
    </div>
                            <div style="width: 378px; float: left;">
                                <div style="width: 150px; float: left;"> <label>Check In</label></div>
                          <div style="width: 150px; float: left;">'. $_SESSION['hotel_search']['cin'].'</div>
                     
    
    </div>
                            <div style="width: 378px; float: left;">
                                <div style="width: 150px; float: left;"> <label>Room Type</label></div>
                          <div style="width: 150px; float: left;">'.$RoomName.'</div>
                     
   
    </div>
                            <div style="width: 378px; float: left;">
                                <div style="width: 150px; float: left;"><label>Meals</label></div>
                          <div style="width: 150px; float: left;">'.$Inclusion.'</div>
                      
    
    </div>
                            <div style="width: 378px; float: left;">
                                <div style="width: 150px; float: left;"><label>Option</label></div>
                          <div style="width: 150px; float: left;"></div>
                      
    
    </div>
                            <div style="width: 378px; float: left;">
                                <div style="width: 150px; float: left;"> <label>Check In</label></div>
                          <div style="width: 150px; float: left;">'.$_SESSION['hotel_search']['cin'].'</div>
                     
   
    </div>
                            <div style="width: 378px; float: left;">
                                <div style="width: 150px; float: left;"><label>Extra Request</label></div>
                          <div style="width: 150px; float: left;">'. $_SESSION['customer']['special'].'</div>
                      
    
    </div>
                       <div style="width: 378px; float: left;">
                           <div style="width: 150px; float: left;"><label>Office No</label></div>
                          <div style="width: 150px; float: left;">'.$HotelPhoneNo.'</div>
                      
    
    </div>
                  </div>
                  <div style="width: 50%; float: left;">
                              <div style="width: 378px; float: left;">
                                  <div style="width: 150px; float: left;"> <label>Hotel B_No.</label></div>
                          <div style="width: 150px; float: left;">'.$BookingConfirmationNo.'</div>
                     
    
    </div>
                  
                              <div style="width: 378px; float: left;margin-top: 45px;">
                                  <div style="width: 150px; float: left;"> <label>Check Out</label></div>
                          <div style="width: 150px; float: left;">'. $_SESSION['hotel_search']['cout'].'</div>
                     
  
    </div>
                              <div style="width: 378px; float: left;">
                                  <div style="width: 150px; float: left;">  <label>Night</label></div>
                          <div style="width: 150px; float: left;">'. ($_SESSION['hotel_search']['days'] + 1).'</div>
                    
    
    </div>
                              <div style="width: 378px; float: left;margin-top: 79px;
">
                                  <div style="width: 150px; float: left;"><label>Check Out</label></div>
                          <div style="width: 150px; float: left;"> '.$_SESSION['hotel_search']['cout'].'</div>
                      
   
    </div>
                  </div>
                  
                  
              </div>
              <div style="width: 758px; float: left; margin-top: 20px;">
                      <div style="width: 150px; float: left;"><label>Booking Manager</label></div>
                          <div style="width: 600px; float: left;"> <input type="text" placeholder="Type something…" style="width: 600px;"></div>
                  </div>
              <div style="width: 758px; float: left; margin-top: 20px;">
                     <div style="width: 20px; float: left;">
                  <img src="'.base_url().'/assets/images/tag-red.png">
              </div>
              <div style="width: 600px; float: left;">
                  <span><b>Caution</b> &nbsp; &nbsp;Please read properly</span>
              </div>
              
                  <div style="width: 100%; border: 1px solid #ccc; border-radius: 5px; padding: 10px; float: left;">
                      <ul>
                          <li>aah bhdsj hsj</li>
                          <li>aah bhdsj hsj</li>
                          <li>aah bhdsj hsj</li>
                          <li>aah bhdsj hsj</li>
                          <li>aah bhdsj hsj</li>
                          <li>aah bhdsj hsj</li>
                      </ul>
                  </div>
              </div>
              <div style="width: 758px; float: left; margin-top: 20px;">
                  <p>Request for booking change</p>
              </div>
              
              <div style="width: 758px; float: left; margin-top: 20px;">
                  <div style="width: 200px; float: left;"><img src="'.base_url().'/assets/images/logo.png" width="180" style="margin-top: 10px;"></div>
                  <div style="width: 500px; float: left;"><h4>Singapore : Tel- 09335757775</h4></div>
              </div>
          </div>
      </div>
 
  

  </body>
</html>';
//echo $message;
$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: '. $from. "\r\n" .
'Reply-To:'. $to. "\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($to,$subject,$message,$headers);
$msg="Mail has been dispatched with password";
$this->load->view('hotels/reservation_print', $data);
	
	}
//Own Inventory 
	function booking_status($booking_id)
	{
		
			
		//$this->load->model('Hotelspro_Model');
		$this->load->model('Owninventory_Model');
		
	
		$data['result'] = $result =  $this->Hotel_Model->get_reservation_details_id($booking_id);
		
	if($result!='')
	{
		$result_hotel =  $this->Hotel_Model->get_hotel_information_v4($result->product_id);

		$api = $result_hotel->api;
		$api_m =$api.'_Model';
		
		
		$output = $this->$api_m->booking_status($api,$result->booking_no,$result->id);
		
		
		if($output['xml_Statusval']!='Fail')
		{
			$data['Statusval'] = $output['Statusval'];
			$data['xml_Statusval'] = $output['xml_Statusval'];
			$data['hotel_result'] =  $this->Hotel_Model->get_hotel_information_v4($result->product_id);
			$this->load->view('hotel/others/booking_status',$data);
		}
		
	}
	}
	function insert_booking_data($api,$result_id,$hotel_id,$parent_pnr_no,$tran_id,$tran_status,$tran_des)
	{
		$result=$this->Hotel_Model->fetch_temp_result_own_room_id($result_id);	
		$service=$this->Hotel_Model->get_permanent_details_v4_Own($hotel_id);		
		
		//echo '<pre/>';
		//print_r($this->session->userdata);exit;
		//echo '<pre/>';
		//print_r($service);
		//print_r($result);
		//exit;
	
	 if($this->session->userdata('guest_email') && $this->session->userdata('guest_email')!= '')
	  {
		  $userid = '';
		  $usertype = 4;
		  $useremail = $this->session->userdata('guest_email');
	  }
	  elseif($this->session->userdata('b2c_email') &&  $this->session->userdata('b2c_email')!= '')
	  {
		 $userid = $this->session->userdata('b2c_id');
		  $usertype = 3;
		  $useremail = $this->session->userdata('b2c_email');
	  }
	  elseif($this->session->userdata('b2b_email') &&  $this->session->userdata('b2b_email')!= '')
	  {
		  $userid = $this->session->userdata('b2b_id');
		  $usertype = 2;
		  $useremail = $this->session->userdata('b2b_email');
		  
		 
	  }
	  else
	  {
		  $userid = 'Unkown';
		  $usertype = 'Unkown';
		  $useremail = 'Unkown';
		  
	  }
	
	
		$voucher_date=date("Y-m-d H:i:s");   
		
			$passanger_full = '';
			for($k=0;$k<count($_SESSION['booking_pass_details']['sal']);$k++)
			{
			$passanger_full .= $_SESSION['booking_pass_details']['sal'][$k].' '.$_SESSION['booking_pass_details']['fname'][$k].' '.$_SESSION['booking_pass_details']['lname'][$k].'<br>';
			}
		if ($api == 'own')
		{
			$amount = $_SESSION['ItemTotalPrice'];
		}
		else
		{
			$amount = $result->total_cost;
		}
//print_r($service);			
		$data_hotel=array(
		'booking_number'=>'',
		'pnr_no'=>$parent_pnr_no,
		'parent_booking_number'=>'',
		'parent_pnr_no'=>'',
		'user_type'=>'',
		'user_id'=>'',
		'branch_id'=>'',
		//'amount'=>$result->total_cost,
		'amount'=>$amount,
		'api_status'=>'',
		'booking_status'=>'',
		'voucher_date'=>$voucher_date,
		'markup'=>'',
		'gateway'=>'',
		'currency_val'=>'',
		'xml_currency'=>'',
		'cancellation_till_date'=>'',
		'cancellation_till_charge'=>'',
		'callcenterid'=>'',
		'cancellation_by'=>'',
		'promo'=>'',
		'cust_remark'=>$_SESSION['booking_pass_details']['special'],
		'cust_remark1'=>'',
		'check_in'=>$_SESSION['cin'],
		'check_out'=>$_SESSION['cout'],
		'hotel_code'=>$result->hotel_code,
		'hotel_name'=>$service->HotelName,
		'image'=>$service->FrontPgImage,
	
		'city'=>$result->city,
		'room_type'=>$result->room_type,
		'star'=>$service->StarRating,
		'address'=>$service->Address,
		'room_count'=>$result->room_count,
		'cancel_policy'=>'',
		'adult'=>$result->adult,
		'child'=>$result->child,
		'description'=>$service->HotelDesc,
		'nights'=>$_SESSION['days'],
		'api'=>$result->api,
		'inclusion_val'=>$result->Classification_val,
		'child_age'=>'',
		'adult_info'=>'',
		'child_info'=>'',
		'passanger'=>$passanger_full,
		'pass_mobile_no'=>$_SESSION['booking_pass_details']['mobile'],
		'pass_address'=>$_SESSION['booking_pass_details']['address'],
		'pass_nationality'=>$_SESSION['booking_pass_details']['nationality'],
		'pass_city'=>$_SESSION['booking_pass_details']['user_city'],
		'remarks'=>$_SESSION['booking_pass_details']['special'],
		'voucherd_status'=>''
		
		);
			$this->db->insert('booking',$data_hotel);
			$hotel_id_pa =  $this->db->insert_id();
			//$_SESSION['booking_pass_details']
			
		
		$data=array(
		'pnr_no'=>$parent_pnr_no,
		'booking_no'=>'',
		'user_id'=>$userid,
		'useremail'=>$useremail,
		'user_type'=>$usertype,
		'amount'=>$result->total_cost,
		'api_status'=>'',
		'booking_status'=>'',
		'voucher_date'=>$voucher_date,
		'ipaddress'=>$this->get_client_ip(),
		'leadpax'=>$_SESSION['booking_pass_details']['user_title'].' '.$_SESSION['booking_pass_details']['firstname'].' '.$_SESSION['booking_pass_details']['lastname'],
		'product_name'=>'Hotel',
		'transaction_id'=>$tran_id,
		'transaction_status'=>$tran_status,
		'transaction_details'=>$tran_des,
		'product_id'=>$hotel_id_pa
		
		);
			$this->db->insert('booking_global',$data);
			//echo $this->db->last_query();exit;
		   $global_id =  $this->db->insert_id();
		
	}
	function PPHttpPost($methodName_, $nvpStr_, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode) {
			// Set up your API credentials, PayPal end point, and API version.
			$API_UserName = urlencode($PayPalApiUsername);
			$API_Password = urlencode($PayPalApiPassword);
			$API_Signature = urlencode($PayPalApiSignature);
			
			$paypalmode = ($PayPalMode=='sandbox') ? '.sandbox' : '';
	
			$API_Endpoint = "https://api-3t".$paypalmode.".paypal.com/nvp";
			$version = urlencode('109.0');
		
			// Set the curl parameters.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
			// Turn off the server and peer verification (TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
		
			// Set the API operation, version, and API signature in the request.
			$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
		
			// Set the request as a POST FIELD for curl.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
			// Get response from the server.
			$httpResponse = curl_exec($ch);
		
			if(!$httpResponse) {
				exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
			}
		
			// Extract the response details.
			$httpResponseAr = explode("&", $httpResponse);
		
			$httpParsedResponseAr = array();
			foreach ($httpResponseAr as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				}
			}
		
			if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
				exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
			}
		
		return $httpParsedResponseAr;
	}
		
	function get_client_ip() {
     $ipaddress = '';
	 if(getenv('REMOTE_ADDR'))
         $ipaddress = getenv('REMOTE_ADDR');
   else if (getenv('HTTP_CLIENT_IP'))
         $ipaddress = getenv('HTTP_CLIENT_IP');
     else if(getenv('HTTP_X_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
     else if(getenv('HTTP_X_FORWARDED'))
         $ipaddress = getenv('HTTP_X_FORWARDED');
     else if(getenv('HTTP_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_FORWARDED_FOR');
     else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    
     else
         $ipaddress = 'UNKNOWN';

     return $ipaddress; 
}
	function cancellation_view($booking_id)
	{
		$data['resultsd'] =  $this->Hotel_Model->get_reservation_details_id($booking_id);
		$data['result'] =  $this->Hotel_Model->get_hotel_information($data['resultsd']->product_id);
		$data['booking_id'] =$booking_id;
		
		$this->load->view('global/cancellation_view',$data);
	}
	function cancellation($booking_id)
	{
		
		
		$this->load->model('Hotelspro_Model');
		$this->load->model('Asiantravel_Model');
		
	
		$result =  $this->Hotel_Model->get_reservation_details_id($booking_id);
		
	if($result!='')
	{
		$result_hotel =  $this->Hotel_Model->get_hotel_information_v4($result->product_id);
	//echo '<pre/>';
//	print_r($result);
//	print_r($result_hotel);exit;
		$api = $result_hotel->api;
		$api_m =$api.'_Model';
		
		//echo $api;exit;
		$this->$api_m->cancellation($api,$booking_id);
		
		redirect("hotel/reservation/".$booking_id, 'refresh');
	}
		
	}
	function cancellation_policy_api($cart_id)
	{
		$cart_result =  $this->Cart_Model->fetch_cart_search_result_db_cartid_api($this->ses_id,$cart_id);
	
     			$api =$cart_result->api;
				$api_m =$api.'_Model';
				echo $this->$api_m->cancellation_policy($api,$cart_id);

	}
	function get_currency_val($cur)
	{
		$currency_val =  $this->Hotel_Model->get_currecy_details($cur);
	$currency_val1=1;
	
	if($currency_val!='')
	{
     			$currency_val1 =$currency_val->value;
	}
			print json_encode(array(
		'currency_val' => $currency_val1
		
		));

	}

function payment_load_v1($api='', $result_id, $hotel_id,$parent_pnr_no)
{
		if(isset($_GET["token"]) && isset($_GET["PayerID"]))
		{
			$token = $_GET["token"];
			$payer_id = $_GET["PayerID"];
			$PayPalMode 			= 'sandbox'; // sandbox or live
			$PayPalApiUsername 		= 'ruby.provab-facilitator_api1.gmail.com'; //PayPal API Username
			$PayPalApiPassword 		= '1397909558'; //Paypal API password
			$PayPalApiSignature 	= 'AFcWxV21C7fd0v3bYYYRCpSSRl31A2LHhtIkJ.t.jTA.3HHCWoHFgNe6'; //Paypal API Signature
			$PayPalCurrencyCode 	= 'SGD'; //Paypal Currency Code
			$PayPalReturnURL 		= site_url().'/home/payment_load_v1/'.$api.'/'.$result_id.'/'.$hotel_id.'/'.$parent_pnr_no; //Point to process.php page
			$PayPalCancelURL 		= site_url().'/home/payment_load_v1_cancel'; //Cancel URL if user clicks cancel

						//get session variables
			$ItemName 			= $_SESSION['ItemName']; //Item Name
			$ItemPrice 			= $_SESSION['ItemPrice'] ; //Item Price
			$ItemNumber 		= $_SESSION['ItemNumber']; //Item Number
			$ItemDesc 			= $_SESSION['ItemDesc']; //Item Number
			$ItemQty 			= $_SESSION['ItemQty']; // Item Quantity
			$ItemTotalPrice 	= $_SESSION['ItemTotalPrice']; //(Item Price x Quantity = Total) Get total amount of product; 
			$TotalTaxAmount 	= $_SESSION['TotalTaxAmount'] ;  //Sum of tax for all items in this order. 
			$HandalingCost 		= $_SESSION['HandalingCost'];  //Handling cost for this order.
			$InsuranceCost 		= $_SESSION['InsuranceCost'];  //shipping insurance cost for this order.
			$ShippinDiscount 	= $_SESSION['ShippinDiscount']; //Shipping discount for this order. Specify this as negative number.
			$ShippinCost 		= $_SESSION['ShippinCost']; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.
			$GrandTotal 		= $_SESSION['GrandTotal'];

			$padata = 	'&TOKEN='.urlencode($token).
						'&PAYERID='.urlencode($payer_id).
						'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
						'&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
						'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
						'&L_PAYMENTREQUEST_0_DESC0='.urlencode($ItemDesc).
						'&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).
						'&L_PAYMENTREQUEST_0_QTY0='. urlencode($ItemQty).
						'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
						'&PAYMENTREQUEST_0_TAXAMT='.urlencode($TotalTaxAmount).
						'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($ShippinCost).
						'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($HandalingCost).
						'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($ShippinDiscount).
						'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($InsuranceCost).
						'&PAYMENTREQUEST_0_AMT='.urlencode($GrandTotal).
						'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode);
	
	//We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
	$httpParsedResponseAr = $this->PPHttpPost('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
		
		//Check if everything went ok..
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
		{
			$pament_Transaction_ID = urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
			$pament_Transaction_des= 'Failed';
			$pament_Transaction_status='Failed';
			if('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
			{
				$pament_Transaction_des =  'Transaction Completed Successfully, Your Payment Received! ';
				$pament_Transaction_status='Success';
			}
			if('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
			{
				$pament_Transaction_des =  'Transaction Completed Successfully, But Payment Is Still Pending! ';
				$pament_Transaction_status='Pending';
			}

			// we can retrive transection details using either GetTransactionDetails or GetExpressCheckoutDetails
			// GetTransactionDetails requires a Transaction ID, and GetExpressCheckoutDetails requires Token returned by SetExpressCheckOut
			$padata = 	'&TOKEN='.urlencode($token);

			$httpParsedResponseAr = $this->PPHttpPost('GetExpressCheckoutDetails', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

			if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
			{
					
					//$this->load->model('Hotelspro_Model');
					//$this->load->model('Asiantravel_Model');
					$this->load->model('Owninventory_Model');
					$this->ses_id= $_SESSION['session_data_id'];
					$booking_global_id = $this->insert_booking_data($api,$result_id,$hotel_id,$parent_pnr_no,$pament_Transaction_ID,$pament_Transaction_status,$pament_Transaction_des);
					$api_m ='Owninventory_Model';
					$this->$api_m->booking($api,$result_id,$hotel_id,$parent_pnr_no,$booking_global_id);
					redirect('hotel/reservation/'.$parent_pnr_no,'refresh');
			
			}
			else
			{
				$data['msg']=urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]);
				$data['header']='Payment Gateway ERROR!!!';
				$this->load->view('hotel/others/paypal_error',$data);
			}
	
		}else{
		
			$data['msg']=urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]);
			$data['header']='Payment Gateway ERROR!!!';
			$this->load->view('hotel/others/paypal_error',$data);
		}
	}
}	
	function payment_load($api='',$result_id,$hotel_id)
	{
		$_SESSION['booking_pass_details']=$_POST;
		$result=$this->Hotel_Model->fetch_temp_result_own_room_id($result_id);	
		$service=$this->Hotel_Model->get_permanent_details_own_v3($hotel_id);
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$parent_pnr_no = "";
		for ($i = 0; $i < 10; $i++) 
		{
			$parent_pnr_no .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		if($this->session->userdata('b2b_email') &&  $this->session->userdata('b2b_email')!= '')
		{
			$pament_Transaction_ID='';
			$pament_Transaction_status='Success';
			$pament_Transaction_des='Agent Booking';
						
						$this->load->model('Hotelspro_Model');
						$this->load->model('Asiantravel_Model');
						$this->ses_id= $_SESSION['session_data_id'];
						$booking_global_id = $this->insert_booking_data($api,$result_id,$hotel_id,$parent_pnr_no,$pament_Transaction_ID,$pament_Transaction_status,$pament_Transaction_des);
						
						 $deposit_amount_det = $this->Account_Model->get_deposit_amount($this->session->userdata('b2b_id')); 
						 if($deposit_amount_det->balance_credit >  $result->total_cost)
			  {
				  
							  $api_m =$api.'_Model';
						$booking_final_status = $this->$api_m->booking($api,$result_id,$hotel_id,$parent_pnr_no,$booking_global_id);
						if($booking_final_status == 'Booking_Success')
						{
						$final_cost = $result->total_cost	- $result->w_markup;	
							 $deposit_amount_det =  ($deposit_amount_det->balance_credit-$final_cost);
							$data = array(
							'balance_credit' => $deposit_amount_det
						);
					
						$this->db->where('agent_id', $this->session->userdata('b2b_id'));
						 $this->db->update('b2b_acc_info', $data);
						}
						redirect('hotel/reservation/'.$parent_pnr_no,'refresh');
			  }
			  else
			  {
				  $data['msg']='Due to insufficient balance. You cant do this booking!.';
					$data['header']='BOOKING ERROR!!!';
					$this->load->view('hotel/others/error_page',$data);
			  }
		}
		else
		{
		/*echo '<pre/>';
		echo $api;
		print_r($result);
		print_r($service);
		print_r($_SESSION);
		print_r($_POST);
		exit;*/
		$PayPalMode 			= 'sandbox'; // sandbox or live
		$PayPalApiUsername 		= 'ruby.provab-facilitator_api1.gmail.com'; //PayPal API Username
		$PayPalApiPassword 		= '1397909558'; //Paypal API password
		$PayPalApiSignature 	= 'AFcWxV21C7fd0v3bYYYRCpSSRl31A2LHhtIkJ.t.jTA.3HHCWoHFgNe6'; //Paypal API Signature
		$PayPalCurrencyCode 	= 'SGD'; //Paypal Currency Code
		$PayPalReturnURL 		= site_url().'/home/payment_load_v1/'.$api.'/'.$result_id.'/'.$hotel_id.'/'.$parent_pnr_no; //Point to process.php page
		$PayPalCancelURL 		= site_url().'/home/payment_load_v1_cancel'; //Cancel URL if user clicks cancel


		/************PAYPAL EXPRESS CHECKOUT**********************/
		
	//Mainly we need 4 variables from product page Item Name, Item Price, Item Number and Item Quantity.
	
	//Please Note : People can manipulate hidden field amounts in form,
	//In practical world you must fetch actual price from database using item id. Eg: 
	//$ItemPrice = $mysqli->query("SELECT item_price FROM products WHERE id = Product_Number");
	
	$ItemName 		= $result->hotel_name.'('.$result->room_type.')'; //Item Name
	if ($api == 'own')
	{
		$ItemPrice 		= $_SESSION['overall_amount']; //Item Price$result->total_cost
		$result->total_cost = $ItemPrice;
	}
	else
	{
		$ItemPrice 		= $result->total_cost; //Item Price$result->total_cost
	}
	$ItemNumber 	= $parent_pnr_no; //Item Number
	$ItemDesc 		= ''; //Item Number
	$ItemQty 		= 1; // Item Quantity
	$ItemTotalPrice = $ItemPrice; //(Item Price x Quantity = Total) Get total amount of product; 
	
	//Other important variables like tax, shipping cost
	$TotalTaxAmount 	= 0.00;  //Sum of tax for all items in this order. 
	$HandalingCost 		= 0.00;  //Handling cost for this order.
	$InsuranceCost 		= 0.00;  //shipping insurance cost for this order.
	$ShippinDiscount 	= -0.00; //Shipping discount for this order. Specify this as negative number.
	$ShippinCost 		= 0.00; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.
	
	//Grand total including all tax, insurance, shipping cost and discount
	$GrandTotal = ($ItemTotalPrice + $TotalTaxAmount + $HandalingCost + $InsuranceCost + $ShippinCost + $ShippinDiscount);
	
	//Parameters for SetExpressCheckout, which will be sent to PayPal
	$padata = 	'&METHOD=SetExpressCheckout'.
				'&RETURNURL='.urlencode($PayPalReturnURL).
				'&CANCELURL='.urlencode($PayPalCancelURL).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				'&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
				'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
				'&L_PAYMENTREQUEST_0_DESC0='.urlencode($ItemDesc).
				'&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).
				'&L_PAYMENTREQUEST_0_QTY0='. urlencode($ItemQty).
				'&NOSHIPPING=0'.
				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
				'&PAYMENTREQUEST_0_TAXAMT='.urlencode($TotalTaxAmount).
				'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($ShippinCost).
				'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($HandalingCost).
				'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($ShippinDiscount).
				'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($InsuranceCost).
				'&PAYMENTREQUEST_0_AMT='.urlencode($GrandTotal).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode).
				'&LOCALECODE=GB'.
				'&LOGOIMG= http://localhost/satguru1/assets/new_css/images/logo.jpg'.
				'&CARTBORDERCOLOR=FFFFFF'.
				'&ALLOWNOTE=1';
				############# set session variable we need later for "DoExpressCheckoutPayment" #######
				$_SESSION['ItemName'] 			=  $ItemName; //Item Name
				$_SESSION['ItemPrice'] 			=  $ItemPrice; //Item Price
				$_SESSION['ItemNumber'] 		=  $ItemNumber; //Item Number
				$_SESSION['ItemDesc'] 			=  $ItemDesc; //Item Number
				$_SESSION['ItemQty'] 			=  $ItemQty; // Item Quantity
				$_SESSION['ItemTotalPrice'] 	=  $ItemTotalPrice; //(Item Price x Quantity = Total) Get total amount of product; 
				$_SESSION['TotalTaxAmount'] 	=  $TotalTaxAmount;  //Sum of tax for all items in this order. 
				$_SESSION['HandalingCost'] 		=  $HandalingCost;  //Handling cost for this order.
				$_SESSION['InsuranceCost'] 		=  $InsuranceCost;  //shipping insurance cost for this order.
				$_SESSION['ShippinDiscount'] 	=  $ShippinDiscount; //Shipping discount for this order. Specify this as negative number.
				$_SESSION['ShippinCost'] 		=   $ShippinCost; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.
				$_SESSION['GrandTotal'] 		=  $GrandTotal;


		//We need to execute the "SetExpressCheckOut" method to obtain paypal token
//		$paypal= new MyPayPal();
		$httpParsedResponseAr = $this->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
		
		//Respond according to message we receive from Paypal
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
		{

				//Redirect user to PayPal store with Token received.
			 	$paypalurl ='https://www.'.$PayPalMode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
				header('Location: '.$paypalurl);
			 
		}else{
		
		$data['msg']=urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]);
		$data['header']='Payment Gateway ERROR!!!';
		$this->load->view('hotel/others/paypal_error',$data);
		
			
		}

		/************PAYPAL EXPRESS CHECKOUT**********************/
		}
	
	}
		function payment_load_v1_cancel()
	{
		
	$data['msg']='Your recent transaction was cancelled. For any number of reasons ';
		$data['header']='Payment Gateway ERROR!!!';
		$this->load->view('hotel/others/paypal_error',$data);
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

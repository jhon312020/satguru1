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
	
	function payment_load($amount,$id)
	{
		$sess_id = session_id();
		$_SESSION['customer']['id'] = $id;
		$_SESSION['customer']['session_id'] =$sess_id;
		$_SESSION['customer']['title'][] = $this->input->post('title');
		$_SESSION['customer']['fname'][] = $this->input->post('fname');
		$_SESSION['customer']['lanme'][] = $this->input->post('lanme');
		$_SESSION['customer']['firstname']=$this->input->post('firstname');
		$_SESSION['customer']['lastname']=$this->input->post('lastname');
		$_SESSION['customer']['mobile'] = $this->input->post('mobile');
		$_SESSION['customer']['email'] = $this->input->post('email');
		$_SESSION['customer']['address'] = $this->input->post('address');
		$_SESSION['customer']['special'] = $this->input->post('special');
		$_SESSION['customer']['nationality'] = $this->input->post('nationality');
		$data['amount']=$amount;
		$this->load->view('hotel/OwnInventory/paypal',$data);
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

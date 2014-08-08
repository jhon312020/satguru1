<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->model('Hotel_Model');
		$this->load->model('Account_Model');
		
		
		
	}
	
	function call_api($api,$hotel_code)
	{
		
			
		$this->load->model('Hotelspro_Model');
		
		$this->load->model('Asiantravel_Model');
	
		$this->ses_id= $_SESSION['session_data_id'];

		switch ($api)
		 {
				case $api:
					 //$this->load->library("hotel/api/".$api);
					 //$this->result= $this->$api->hotel_availabilty($api);
					//$hid = $api.'_Hotelcode';
					 $api_m =$api.'_Model';

					//$hotel_code = $permanent_data->$hid;
					
					if($hotel_code!='')
					{
					 $this->$api_m->hotel_availabilty($api,$hotel_code);
					}
				break;					

				default:
				echo '';
		}
	
	
			
	 		redirect('hotel/fetch_search_result_room/'.$this->ses_id.'/'.$hotel_code.'/'.$api);
			
			
	
	}
	function call_api_search_result($api,$final='')
	{
		
			
		$this->load->model('Hotelspro_Model');
		
		$this->load->model('Asiantravel_Model');
		
		$this->ses_id= $_SESSION['session_data_id'];

		switch ($api)
		 {
				case $api:
					 //$this->load->library("hotel/api/".$api);
					 //$this->result= $this->$api->hotel_availabilty($api);
					 $api_m =$api.'_Model';
					 $this->$api_m->hotel_availabilty_all($api);
				break;					
				default:
				echo '';
		}
		
			if($final == 1)
			{
				redirect('hotel/fetch_search_result_page/'.$this->ses_id.'/'.$final);
			}
			else
			{
				print json_encode(array(
					'hotel_search_result' => "",
					'total_result' =>"",
					'min_val' => "",
					'max_val' =>"",
				));
			}	
		
	}
	
	function call_api_all()
	{
		
	 		redirect('hotel/fetch_search_result');
	}
	function promo($result_id)
	{
		  $room_info_m1 = $this->Hotel_Model->fetch_temp_result_room_id($result_id);
		
		$data['promotion'] = $room_info_m1->ShortNameaa;
		$data['room_type'] = $room_info_m1->room_type;
	
			$data['Hotel_info'] = $this->Hotel_Model->get_permanent_details_v3($room_info_m1->hotel_code);
		
	 	$this->load->view('hotel/others/promo',$data);
	}
	function get_asia_room_details($hotel_id,$room_id)
	{
		$ses = $_SESSION['session_data_id'];
		$data['room_info_m2'] = $this->Hotel_Model->get_asia_room_details_v1($ses,$hotel_id,$room_id);
		if($data['room_info_m2']->RoomTypeCodeval!='')
		{
		$data['room_image_m2'] = $this->Hotel_Model->get_asia_image_details_v1($data['room_info_m2']->RoomTypeCodeval);
		}
		
		$data['Hotel_info'] = $this->Hotel_Model->get_permanent_details_v3_Asiantravel($hotel_id,'Asiantravel');
		
		//echo '<pre/>';
		//print_r($data);exit;
	 	$this->load->view('hotel/Asiantravel/room_info',$data);
	}
	function booking_api($api,$result_id,$hotel_id)
	{
		
		
		$_SESSION['booking_pass_details']=$_POST;
		$result=$this->Hotel_Model->fetch_temp_result_room_id($result_id);	
		$service=$this->Hotel_Model->get_permanent_details_v3($hotel_id,$result->api);		
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
		
		//echo '<pre/>';
		//print_r($result);print_r($service);exit;
		$PayPalMode 			= 'sandbox'; // sandbox or live
		$PayPalApiUsername 		= 'ruby.provab-facilitator_api1.gmail.com'; //PayPal API Username
		$PayPalApiPassword 		= '1397909558'; //Paypal API password
		$PayPalApiSignature 	= 'AFcWxV21C7fd0v3bYYYRCpSSRl31A2LHhtIkJ.t.jTA.3HHCWoHFgNe6'; //Paypal API Signature
		$PayPalCurrencyCode 	= 'SGD'; //Paypal Currency Code
		$PayPalReturnURL 		= site_url().'/api/booking_api_v1/'.$api.'/'.$result_id.'/'.$hotel_id.'/'.$parent_pnr_no; //Point to process.php page
		$PayPalCancelURL 		= site_url().'/api/booking_api_v1_cancel'; //Cancel URL if user clicks cancel


		/************PAYPAL EXPRESS CHECKOUT**********************/
		
	//Mainly we need 4 variables from product page Item Name, Item Price, Item Number and Item Quantity.
	
	//Please Note : People can manipulate hidden field amounts in form,
	//In practical world you must fetch actual price from database using item id. Eg: 
	//$ItemPrice = $mysqli->query("SELECT item_price FROM products WHERE id = Product_Number");

	$ItemName 		= $result->hotel_name.'('.$result->room_type_V.')'; //Item Name
	$ItemPrice 		= $result->total_cost; //Item Price$result->total_cost
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
				'&RETURNURL='.urlencode($PayPalReturnURL ).
				'&CANCELURL='.urlencode($PayPalCancelURL).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				
				'&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
				'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
				'&L_PAYMENTREQUEST_0_DESC0='.urlencode($ItemDesc).
				'&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).
				'&L_PAYMENTREQUEST_0_QTY0='. urlencode($ItemQty).
				
				/* 
				//Additional products (L_PAYMENTREQUEST_0_NAME0 becomes L_PAYMENTREQUEST_0_NAME1 and so on)
				'&L_PAYMENTREQUEST_0_NAME1='.urlencode($ItemName2).
				'&L_PAYMENTREQUEST_0_NUMBER1='.urlencode($ItemNumber2).
				'&L_PAYMENTREQUEST_0_DESC1='.urlencode($ItemDesc2).
				'&L_PAYMENTREQUEST_0_AMT1='.urlencode($ItemPrice2).
				'&L_PAYMENTREQUEST_0_QTY1='. urlencode($ItemQty2).
				*/
				
				/* 
				//Override the buyer's shipping address stored on PayPal, The buyer cannot edit the overridden address.
				'&ADDROVERRIDE=1'.
				'&PAYMENTREQUEST_0_SHIPTONAME=J Smith'.
				'&PAYMENTREQUEST_0_SHIPTOSTREET=1 Main St'.
				'&PAYMENTREQUEST_0_SHIPTOCITY=San Jose'.
				'&PAYMENTREQUEST_0_SHIPTOSTATE=CA'.
				'&PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE=US'.
				'&PAYMENTREQUEST_0_SHIPTOZIP=95131'.
				'&PAYMENTREQUEST_0_SHIPTOPHONENUM=408-967-4444'.
				*/
				
				'&NOSHIPPING=0'. //set 1 to hide buyer's shipping address, in-case products that does not require shipping
				
				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
				'&PAYMENTREQUEST_0_TAXAMT='.urlencode($TotalTaxAmount).
				'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($ShippinCost).
				'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($HandalingCost).
				'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($ShippinDiscount).
				'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($InsuranceCost).
				'&PAYMENTREQUEST_0_AMT='.urlencode($GrandTotal).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode).
				'&LOCALECODE=GB'. //PayPal pages to match the language on your website.
				'&LOGOIMG=http://ota.com.sg/staging/assets/images/logo.png'. //site logo
				'&CARTBORDERCOLOR=FFFFFF'. //border color of cart
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
	function booking_api_v1($api,$result_id,$hotel_id,$parent_pnr_no)
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
		$PayPalReturnURL 		= site_url().'/api/booking_api_v1/'.$api.'/'.$result_id.'/'.$hotel_id.'/'.$parent_pnr_no; //Point to process.php page
		$PayPalCancelURL 		= site_url().'/api/booking_api_v1_cancel'; //Cancel URL if user clicks cancel

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
				
				//set item info here, otherwise we won't see product details later	
				'&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
				'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
				'&L_PAYMENTREQUEST_0_DESC0='.urlencode($ItemDesc).
				'&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).
				'&L_PAYMENTREQUEST_0_QTY0='. urlencode($ItemQty).

				/* 
				//Additional products (L_PAYMENTREQUEST_0_NAME0 becomes L_PAYMENTREQUEST_0_NAME1 and so on)
				'&L_PAYMENTREQUEST_0_NAME1='.urlencode($ItemName2).
				'&L_PAYMENTREQUEST_0_NUMBER1='.urlencode($ItemNumber2).
				'&L_PAYMENTREQUEST_0_DESC1=Description text'.
				'&L_PAYMENTREQUEST_0_AMT1='.urlencode($ItemPrice2).
				'&L_PAYMENTREQUEST_0_QTY1='. urlencode($ItemQty2).
				*/

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
						
						$this->load->model('Hotelspro_Model');
						$this->load->model('Asiantravel_Model');
						$this->ses_id= $_SESSION['session_data_id'];
						$booking_global_id = $this->insert_booking_data($api,$result_id,$hotel_id,$parent_pnr_no,$pament_Transaction_ID,$pament_Transaction_status,$pament_Transaction_des);
						$api_m =$api.'_Model';
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
	function booking_api_v1_cancel()
	{
		
	$data['msg']='Your recent transaction was cancelled. For any number of reasons ';
		$data['header']='Payment Gateway ERROR!!!';
		$this->load->view('hotel/others/paypal_error',$data);
	}
	function booking_status($booking_id)
	{
		
			
		$this->load->model('Hotelspro_Model');
		$this->load->model('Asiantravel_Model');
		
	
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
		$result=$this->Hotel_Model->fetch_temp_result_room_id($result_id);	
		$fn_name ='get_permanent_details_v4_'.$result->api;
		$service=$this->Hotel_Model->$fn_name($hotel_id,$result->api);		
		
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
			
			
		$data_hotel=array(
		'booking_number'=>'',
		'pnr_no'=>$parent_pnr_no,
		'parent_booking_number'=>'',
		'parent_pnr_no'=>'',
		'user_type'=>'',
		'user_id'=>'',
		'branch_id'=>'',
		'amount'=>$result->total_cost,
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
		'hotel_name'=>$service->Hotel_name,
		'image'=>$service->Hotel_thumbnail,
	
		'city'=>$result->city,
		'room_type'=>$result->room_type,
		'star'=>$service->Hotel_star,
		'address'=>$service->Hotel_address,
		'room_count'=>$result->room_count,
		'cancel_policy'=>'',
		'adult'=>$result->adult,
		'child'=>$result->child,
		'description'=>$service->Hotel_description,
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
	
	
}

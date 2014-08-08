<style>
	textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
    background-color: #ffffff;
    border: 1px solid #cccccc;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    transition: border 0.2s linear 0s, box-shadow 0.2s linear 0s;
}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
    border-radius: 4px;
    color: #555555;
    display: inline-block;
    font-size: 14px;
    line-height: 20px;
    margin-bottom: 10px;
    padding: 4px 6px;
    vertical-align: middle;
    width: 176px;
}

</style>
<?php 
	$amount = '';  $totalbreak = ''; $totalam = ''; $this->load->view('header_footer/header_hotel');
	$qry = mysql_query("select * from hotel_search_list where hotelcode='".$cart_result[0]->HotelCode."'"); 
	$hotel_details = mysql_fetch_array($qry);
	$room_info_result = mysql_query("select * from hotel_room_list where roomcode='".$cart_result[0]->RoomCode."'"); 
	$room_info_results = mysql_fetch_array($room_info_result);
	$begin = new DateTime($_SESSION['hotel_search']['cin']);
	$end = new DateTime($_SESSION['hotel_search']['cout']);
	$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
	$timestamp_start = strtotime($_SESSION['hotel_search']['cin']);
	$timestamp_end = strtotime($_SESSION['hotel_search']['cout']);
	$difference = abs($timestamp_end - $timestamp_start);
	$days = floor($difference/(60*60*24));
	$currency = mysql_query("select currency from hotel_price where HotelCode='".$cart_result[0]->HotelCode."'");
	$fetchcurrency = mysql_fetch_array($currency);
	$currencysg = $fetchcurrency['currency'];
	foreach($daterange as $date)
	{
		$newdate = $date->format('Y-m-d');
		$day_of_the_week = date('l', strtotime($newdate));
		$day_of_the_week1 = date('w', strtotime($newdate));
		//Currency
		// Price
		$roomprice = mysql_query("select * from hotel_room_price where '".$newdate."' between ratefrom and rateto  and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
		$fetch_price = mysql_fetch_array($roomprice);
		$contractrate = $fetch_price['contractrate'];
		$roompricemarkup = $fetch_price['roompricemarkup'];
		$surcharge = $fetch_price['surcharge'];
		$weekdayfrom = $fetch_price['weekdayfrom'];
		$weekdaytill = $fetch_price['weekdaytill'];
		//holidaySurcharge
		$holidaysurcharge = mysql_query("select ratetosurcharge from hotel_room_holidayprice where HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."' and ratefromh='".$newdate."'");
		$fetch_holidayprice = mysql_fetch_array($holidaysurcharge);
		$fetch_holidaysur = $fetch_holidayprice['ratetosurcharge'];
		//Total Price
		$totalpricemarkup = $contractrate + $roompricemarkup;
		$totalprice = $contractrate + $roompricemarkup + $fetch_holidaysur;
		// Total Price Discount
		$discountrate = mysql_query("select discountrate from  hotel_price_discount where '".$newdate."' between discountfrom and  discountto  and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
		$numfetchdiscount = mysql_num_rows($discountrate);
		$fetchdiscount = mysql_fetch_array($discountrate);
		$discountrate=$fetchdiscount['discountrate'];
		if($numfetchdiscount>0)
		{
			$totalprice1 = $totalprice/$discountrate;
			$totalprice = $totalprice-$totalprice1;
		}
		// hotel_roompricediscount
		$roomprice = mysql_query("select pricerate from  hotel_roompricediscount where '".$newdate."' between pricefrom and  priceto  and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
		$numfetchpricediscount = mysql_num_rows($roomprice);
		$fetchdiscountprice = mysql_fetch_array($roomprice);
		$discountpricerate = $fetchdiscountprice['pricerate'];
		if($numfetchpricediscount>0)
		{
			$totalprice = $totalprice-$discountpricerate;
		}
		// hotel_roompricediscount
		$roomprice = mysql_query("select pricerate from  hotel_roompricediscount where '".$newdate."' between pricefrom and  priceto  and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
		$numfetchpricediscount = mysql_num_rows($roomprice);
		$fetchdiscountprice = mysql_fetch_array($roomprice);
		$discountpricerate = $fetchdiscountprice['pricerate'];
		if($numfetchpricediscount>0)
		{
			$totalprice = $totalprice-$discountpricerate;
		}
		// Pay stay Promotion
		$paystaypromotion = mysql_query("select * from hotel_paystaypromo where '".$newdate."' between ratefrom and rateto and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
		$fetch_holidaypromotion=mysql_fetch_array($paystaypromotion);
		$fetch_stay = $fetch_holidaypromotion['stay'];
		$breakfast = $fetch_holidaypromotion['breakfast'];
		if($days >= $fetch_stay) 
		{
			$fetch_pay = $fetch_holidaypromotion['pay'];
			$differenc = $fetch_stay-$fetch_pay;
			$differencmarkup = $differenc*$totalpricemarkup;
			if($breakfast == 'yes')
			{
				$breakrate = $fetch_holidaypromotion['breakrate'];
				$breakmarkup = $fetch_holidaypromotion['breakmarkup'];
				$totalbreak = $breakrate + $breakmarkup;
			}
		}
		// Weekend promo
		$weekdaysurcharge = mysql_query("select * from hotel_priceweekendpromo where '".$newdate."' between ratefrom and rateto and '".$day_of_the_week1."' between weekdayfrom and weekdaytill and  HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
		if ($weekdaysurcharge)
		{
			$fetch_weekdaysurcharge = mysql_fetch_array($weekdaysurcharge);
			$weekdayfrom = $fetch_weekendpromo['weekdayfrom'];
			$weekdaytill = $fetch_weekendpromo['weekdaytill'];
			$weekendrate = $fetch_weekendpromo['weekendrate'];
			$totalprice2 = $totalprice/$discountpricerate;
			$totalprice = $totalprice-$totalprice2;
		}
		// Weekday surcharge
		$weekendpromo = mysql_query("select * from hotel_room_price where '".$newdate."' between ratefrom and rateto and '".$day_of_the_week1."' between weekdayfrom and weekdaytill  and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
		$fetch_weekendpromo = mysql_fetch_array($weekendpromo);
		$weeksurcharge = $fetch_weekendpromo['surcharge'];
		$totalprice = $totalprice + $weeksurcharge;
		
		// Cancellation Information
		$cancel_result_set = mysql_query("select * from hotel_cancellationpolicy where HotelCode = '".$cart_result[0]->HotelCode."'");
		$cancel_record = '';
		$cancel_record = mysql_fetch_assoc($cancel_result_set);
	}
	$totalprice = $_SESSION['overall_amount'];
?>
<div id="wrapper">
        <!-- CSS -->
        <!--########### COMMON CSS #############-->    
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/slimbox2.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slimbox2.css" type="text/css" media="screen" />
        
        
        <!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flexslider.css" type="text/css" media="screen" />-->
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/camera.css" type="text/css" media="screen" />
        <!--########### COMMON CSS #############-->    
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://maps.gstatic.com/cat_js/intl/en_us/mapfiles/api-3/15/11/%7Bcommon,map,overlay,util,marker%7D.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://maps.gstatic.com/cat_js/intl/en_us/mapfiles/api-3/15/11/%7Binfowindow%7D.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://maps.gstatic.com/cat_js/intl/en_us/mapfiles/api-3/15/11/%7Bonion%7D.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://maps.gstatic.com/cat_js/intl/en_us/mapfiles/api-3/15/11/%7Bcontrols%7D.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://maps.gstatic.com/cat_js/intl/en_us/mapfiles/api-3/15/11/%7Bstats%7D.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  
<style type="text/css">.gm-style .gm-style-mtc label,.gm-style .gm-style-mtc div{font-weight:400}</style><style type="text/css">.gm-style .gm-style-cc span,.gm-style .gm-style-cc a,.gm-style .gm-style-mtc div{font-size:10px}</style><link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700"><style type="text/css">@media print {  .gm-style .gmnoprint, .gmnoprint {    display:none  }}@media screen {  .gm-style .gmnoscreen, .gmnoscreen {    display:none  }}</style><style type="text/css">.gm-style{font-family:Roboto,Arial,sans-serif;font-size:11px;font-weight:400;text-decoration:none}</style><script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/languages/jquery.validationEngine-en.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/Validation/css/validationEngine.jquery.css" media="all" type="text/css" />
    
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab.css" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script>
<script src="<?php echo base_url(); ?>assets/js/menu_jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bjqs-1.3.min.js"></script>
    <!-- Home Slider Javascript--> 
    
    <script class="secret-source">
    jQuery(document).ready(function($) {
        $('#tabs').smartTab({autoProgress: false, stopOnFocus: true, transitionEffect: 'vSlide'});
    });
    </script>
	<style type="text/css">

.stepcarousel{
	position: relative;
	overflow: scroll; /*leave this value alone*/
	width: 1035px; /*Width of Carousel Viewer itself*/
	height: 170px; /*Height should enough to fit largest content's height*/
	-moz-border-radius: 0px 10px 10px 0px;
    -webkit-border-radius: 0px 10px 10px 0px;
    -khtml-border-radius: 0px 10px 10px 0px;
    border-radius: 0px 10px 10px 0px;

	background-color: #none;
	margin:0 8px 8px 8px;
	margin-left:160px;
	font-family:Tahoma, Geneva, sans-serif;
	font-size:12px;
}

.stepcarousel .belt{
position: absolute; /*leave this value alone*/
left: 0;
top: 0;
}

.stepcarousel .panel{
	float: left; /*leave this value alone*/
	overflow: hidden; /*margin around each panel*/
	width: 100px; /*Width of each panel holding each content. If removed, widths should be individually defined on each content DIV then. */
	padding-right: 0px;
	padding-left: 0px;
	margin-top: 0px;
	margin-right: 5px;
	margin-bottom: 0px;
	margin-left: 0px;/*
	border-right:1px solid #CCCCCC;*/
	background:none;
	border:1px solid #ccc;
}


</style>
<div class="inner_wrapper" >
  <div class="padding10 part985">
    <div class="left_part">
      <div id='cssmenu'  >
        <ul>
          <li class='has-sub active'><a href='#'><span>Your Search Details</span></a>
            <ul style="line-height:20px; font-family:Arial, Helvetica, sans-serif; font-size:12px; display:block;">
              <span style="width:100px; float:left;">Hotels In </span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['city']; ?><br />
              </span> <span style="width:100px; float:left;">Checkin Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;
              <?php //echo date('M d, Y',strtotime('Y-m-d',$cin2)); ?>
              <?php  echo date($_SESSION['cin']); ?><br />
              </span> <span style="width:100px; float:left;"> Checkout Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php  echo date($_SESSION['cout']); ?><br />
              </span> <span style="width:100px; float:left;">Adults </span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['adult_count']; ?><br />
              </span> <span style="width:100px; float:left;">Childs</span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['child_count']; ?><br />
              </span> <span style="width:100px; float:left;">Nights</span> <span style="font-weight:bold; color:#025590;"> :&nbsp;<?php echo $_SESSION['days'];?></span>
            </ul>
            <div style="clear:both;"></div>
          </li>
          <li class='has-sub'><a href='#'><span>Modify Search</span></a>
            <ul>
              <?php $this->load->view('hotel/modify_search'); ?>
            </ul>
            <div style="clear:both;"></div>
          </li>
          <li class='has-sub'><a href='#'><span>Last Viewed Hotels</span></a>
            <ul>
              <?php $last_viewed_hotels = ''; ?>
              <div class="bg_whight">
                <div class="padding10">
                  <div class="font_size20 color_blue">Last Viewed Hotel</div>
                  <div class="border_bottom2"></div>
                  <div class="font_size14 color_blue padding_top_bottom">
                    <?php if(isset($last_viewed_hotels)) { if($last_viewed_hotels != '') { foreach($last_viewed_hotels as $last) { ?>
                    <div class="lastview_hotel_img"> <img src="<?php echo $hotel_details->image; ?>" width="60" height="60" /> </div>
                    <div class="lastview_hotel_name_stars font_size14" align="left" style="width:117px;"> <strong><?php echo $hotel_details->hotel_name; ?></strong>
                      <div class="clear"></div>
                      <div class="stars5" style="width:112px"></div>
                    </div>
                    <div class="clear_space1"></div>
                    <div class="border_bottom2"></div>
                    <div class="clear_space1"></div>
                    <?php } } } ?>
                    <?php ?>
                  </div>
                </div>
              </div>
            </ul>
            <div style="clear:both;"></div>
          </li>
        </ul>
      </div>
    </div>
    <div style="width:750px; margin-left:0px;" class="right_part">
      <div class="color_blue1 font_size22 padding10"><strong><?php 
	  
	  
	 echo $hotel_details['HotelName'];

	 ?></strong> 
        <script>
		function goBack()
		  {
		  window.history.back()
		  }
		</script>
        <div class="clear"></div>
      </div>
      <div class="bg_whight">
        <div class="padding10">
          
          <div class="right_part " style="width:720px;">
                    <div class="right_main_bar top20" style="margin-top:10px; width:720px;">                                        
                    <div class="fleft left20">Passanger Details</div>
                    <div class="fright" style="margin-right:20px;">Adults 12+ yrs (1)  </div> </div>
                <div class="clear"></div>

               <!-- <form name="pre_booking" id="pre_booking" method="POST" action="<?php echo base_url() ?>index.php/api/booking_api/<?php echo $cart_result->api.'/'.$cart_result->api_temp_hotel_id.'/'.$cart_result->hotel_code; ?>" class='form-horizontal form-validate' onsubmit="return b2clogincheck();"> -->

<form method="post" action="<?php echo base_url() ?>index.php/home/payment_load/own/<?php echo $cart_result[0]->RoomCode; ?>/<?php echo $cart_result[0]->HotelCode; ?>"  name="member_login" class='form-horizontal bbq wizard' id="member_payment">
               <div>
 <?php
		
		$room_count = $_SESSION['hotel_search']['adult'];
		$room_type = $room_info_results['RoomName'];
		$adult = $_SESSION['hotel_search']['adult'];
		$child = $_SESSION['hotel_search']['child'];
		  for($i=0; $i < count($room_count); $i++)
		  {
			  if($room_count[$i]==1)
			  {
				  
			  ?>
    <div id="r-box" style="height:auto;">
		
    	<div  class="" style="padding-left: 10px; margin-top: 10px; color: rgb(0, 17, 76);"><strong>Room <?php echo $i+1; ?>:  <?php echo $room_type; ?></strong> </div>
    </div>
     <?php
			 for($j=0;$j < $adult[$i]; $j++)
		  {
			  ?>
     <table align="left" width="724" border="0" cellspacing="5" cellpadding="5" class="sum-txt" style="margin-top:0px;  border-radius:10px; float:none;">
      
      <tr>
        <td width="70">Salutation *</td>
        <td width="220">
        <?php
        if($j==0)
		{
			echo " Lead Passenger's First Name ";
		}
		else
		{
			echo 'First Name';
		}
			?>
            
        </td>
         <td width="220">Last Name</td>
         <td >&nbsp;</td>
      </tr>
      <tr>
        <td> <select name="sal[]" class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:75px; padding:5px; font-size:11px;"  id="sal<?php echo $j;?>">
                 <option value="Mr">Mr</option>
                   <option value="Ms">Ms</option>
                 <option value="Mrs">Mrs</option>
                  <option value="Dr">Dr</option>
                 </select>

               </td>
        <td> <input type="text" name="fname[]" style="width:200px" class=" validate[required]"  required="required"   id="fname<?php echo $j;?>" /></td>
         <td><input style="width:200px" type="text" name="lname[]" class=" validate[required]"  required="required"   id="lname<?php echo $j;?>" /></td>
         <td >&nbsp;</td>
      </tr>
    </table>
     <?php
		  }
		   for($j=0;$j<  $child[$i]; $j++)
		  {
			  ?>
     <table align="left" width="724" border="0" cellspacing="5" cellpadding="5" class="sum-txt" style="min-height:100px; margin-top:0px;  border-radius:10px; float:none;">
      
      <tr>       
       <td width="70">&nbsp;</td>
       <td width="220">Child First Name</td>
       <td width="220">Child Last Name</td>
       <td width="70">&nbsp;</td>
      </tr>
      <tr>
		 <td></td>
		<td><input type="text" name="cname[]" style="width:200px" class="validate[required]"  required="required"   id="cname<?php echo $j;?>"/> </td>
		<td><input type="text" name="cname1[]" style="width:200px" class="validate[required]"  required="required"  id="cname1<?php echo $j;?>" /></td>
      </tr>
      
    </table>
     <?php
		  }
			  ?>
              <?php
			  }
			  
			  if($room_count[$i]==2)
			  {
				  
			  ?>
 <div id="r-box" style="height:auto;">
    	<div  class="" style="padding-left: 10px; margin-top: 10px; color: rgb(0, 17, 76);"><strong>Room <?php echo $i+1; ?>: <?php echo $room_type[$i]; ?> </strong></div>
    </div> 
     <?php
			for($j=0;$j<  $adult[$i]; $j++)
			{
			  ?>
     <table align="left" width="724" border="0" cellspacing="5" cellpadding="5" class="sum-txt" style="min-height:320px; margin-top:0px;  border-radius:10px; float:none;">
      
      <tr>
        <td width="70">Salutation *</td>
        <td width="220">  <?php
        if($j==0)
		{
			echo " Lead Passenger's First Name ";
		}
		else
		{
			echo 'First Name';
		}
			?></td>
         <td width="220">Last Name</td>
         <td >&nbsp;</td>
      </tr>
      <tr>
        <td> <select name="sal[]" class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:75px; padding:5px; font-size:11px;" >
                 <option value="Mr">Mr</option>
                   <option value="Ms">Ms</option>
                 <option value="Mrs">Mrs</option>
                 <option value="Dr">Dr</option>
                 </select>
               </td>
        <td> <input type="text" name="fname[]" style="width:200px" class="validate[required]"  required="required"   /></td>
         <td><input style="width:200px" type="text" name="lname[]" class="validate[required]"  required="required"  /></td>
         <td >&nbsp;</td>
      </tr>
    </table>
     <?php
			}
			  ?>
              <?php
			  
			   for($j=0;$j<  $child[$i]; $j++)
		  {
			  ?>
     <table align="left" width="724" border="0" cellspacing="5" cellpadding="5" class="sum-txt" style="min-height:100px; margin-top:15px;  border-radius:10px; float:none;">
      
        <tr>       
			<td width="70">&nbsp;</td>
			<td width="220">Child First Name</td>
			<td width="220">Child Last Name</td>
			<td width="70">&nbsp;</td>
		</tr>
		   
		<tr>
		<td></td>
        <td><input type="text" name="cname[]" style="width:200px" class="validate[required]"  required="required"   /></td> &nbsp;
        <td><input type="text" name="cname1[]" style="width:200px" class="validate[required]"  required="required"   /></td>
      
         
      </tr>
      
    </table>
     <?php
		  }
			  ?>
              <?php
			  }
			  
			  if($room_count[$i]==3)
			  {

			  ?>
    <div id="r-box" style="height:auto;">
    	<div class="" style="padding-left: 10px; margin-top: 10px; color: rgb(0, 17, 76);"><strong>Room <?php echo $i+1; ?>: <?php echo $room_type[$i]; ?> </strong></div>
    </div> 
     <?php
			 for($j=0;$j<  $adult[$i]; $j++)
		  {
			  ?>
     <table align="left" width="724" border="0" cellspacing="5" cellpadding="5" class="sum-txt" style="min-height:320px; margin-top:0px;  border-radius:10px; float:none;">
      
      <tr>
        <td width="70">Salutation *</td>
        <td width="220">  <?php
        if($j==0)
		{
			echo " Lead Passenger's First Name ";
		}
		else
		{
			echo 'First Name';
		}
			?></td>
         <td width="220">Last Name</td>
         <td >&nbsp;</td>
      </tr>
      <tr>
        <td> <select name="sal[]" class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:75px; padding:5px; font-size:11px;" >
                 <option value="Mr">Mr</option>
                   <option value="Ms">Ms</option>
                 <option value="Mrs">Mrs</option>
                  <option value="Dr">Dr</option>
                 </select>
               </td>	
        <td><input type="text" name="fname[]" style="width:200px" class="validate[required]"  required="required"   /></td>
         <td><input style="width:200px" type="text" name="lname[]" class="validate[required]"  required="required"  /></td>
         <td >&nbsp;</td>
      </tr>
    </table>
     <?php
		  }
		   for($j=0;$j<  $child[$i]; $j++)
		  {
			  ?>
     <table align="left" width="724" border="0" cellspacing="5" cellpadding="5" class="sum-txt" style="min-height:100px; margin-top:15px;  border-radius:10px; float:none;">
      
		<tr>       
			<td width="70">&nbsp;</td>
			<td width="220">Child First Name</td>
			<td width="220">Child Last Name</td>
			<td width="70">&nbsp;</td>
		</tr>
       
        <tr>
		<td></td>
        <td><input type="text" name="cname[]" style="width:200px" class="validate[required]"  required="required"   /> &nbsp;
        <td><input type="text" name="cname1[]" style="width:200px" class="validate[required]"  required="required"   /></td>
      
         
      </tr>
      
    </table>
     <?php
		  }
			  ?>
              <?php
	}			  
			  ?>
    
              <?php
			  }
			  
			  ?>
          </div>
                <div class="detail_area top10" style=" width:690px;">
                    <div class="traveller_blue_bg" style="color:#0F4F8B; padding-left:10px;"> Please Note : Please make sure that the name entered is exactly as per traveller's passport.  Traveler age is calculated as per the travel date. </div> 
                 <div>

          
          </div>
                </div>
                <div class="clear"></div>

                <div class="right_main_bar top20" style="margin-top:13px; width:720px;">
                    <div class="fleft left20">Contact Details</div>
                </div>
                <div class="clear"></div>
				<?php 
				 ?>
				
                <div class="detail_area top10" style=" width:690px;">

                    <div class="top10">
                        <div class="wid100 fleft" style="width:85px;"><label class="left10">Salutation:</label>
                            <select name="user_title" class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:75px; padding:5px; font-size:11px;"  >
                          
                                <option value="Mr">Mr</option>
                   <option value="Ms">Ms</option>
                 <option value="Mrs">Mrs</option>
                  <option value="Dr">Dr</option>
                            </select>
                        </div>

                        <div class="wid190 fleft"><label class="left10">First Name:</label><br />
                            <input name="firstname" id="firstname" value="<?php echo $firstname; ?>" class=" fleft validate[required,custom[onlyLetterSp]]" type="text"  required="required"   /></div>

                        <div class="wid190 fleft"><label class="left10">Last Name:</label><br />
                            <input name="lastname" id="lastname" value="<?php echo $lastname; ?>"  class=" fleft validate[required,custom[onlyLetterSp]]" type="text"  required="required"  /></div>
</div>
                        <div class="clear"></div>
                        <div class="top10">
                            <label class="left10">Address</label><br />
                            <textarea name="address" id="address" rows="2" style="border:1px solid #aacde6; border-radius:5px; width:578px;" class="validate[required]"  required="required"   ><?php echo $address; ?></textarea></div>
                        <div class="top10">
                            <div class="wid190 fleft"><label class="left10">Special Request:</label><br />
                                <input name="special"  id="special" value="" type="text"  />
                            </div>
                            <div class="wid190 fleft"><label class="left10">Nationality</label><br />
                            
                                <?php $get_country_list = $this->Account_Model->get_country_list_v1();
								
								
								?>
                                <select name="nationality" id="nationality" class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width: 190px;height: 27px; padding:5px; font-size:11px;">
						<?php
						for($i=0;$i<count($get_country_list);$i++)
						{
							if($get_country_list[$i]->CountryName == $country)
							{
								$sel ='selected="selected"';
							}
							else
							{
								$sel='';
							}
							?>		
                                <option <?php echo $sel; ?> value="<?php echo $get_country_list[$i]->CountryISOCode; ?>"><?php echo $get_country_list[$i]->CountryName; ?></option>
                                  <?php
						}
						?>
                                  
                                  </select></div>
                            <div class="wid190 fleft"><label class="left10">City:</label><br />
                                <input name="user_city" id="user_state" value="<?php echo $city; ?>" class=" fleft validate[required]" required="required"  type="text"   /></div>
                        </div> 
                        <div class="clear"></div>
                         <div class="top10">
                            <div class="wid190 fleft"><label class="left10">E-mail:</label><br />
                                <input name="email"  readonly="readonly" id="email" class=" fleft validate[required,custom[email]]" type="text" value="<?php echo $customer_user_email; ?>"  required="required"  /></div>
                            <div class="wid190 fleft"><label class="left10">Mobile:</label><br />
                                <input name="mobile" id="mobile" class=" fleft validate[required,custom[phone]]" required="required" value="<?php echo $contact_no; ?>" type="text" /></div>
                        </div>

                        <div class="clear"></div>
                        <!--<div class="traveller_blue_bg top10"><input name="user_update" type="checkbox" value=""  class="fleft validate[required]" style="margin-top:8px;"/><div style="color:#0F4F8B; padding-left:10px;">Update my profile with this contact details. for flight </div></div>-->
                    </div>                      
                
                <div class="clear"></div>
                <div class="clear"></div>
                
                                <div >  

                    <div class="fright top20" style="text-align:right; ">Total you need to pay : <span class="red_txt" style="font-size:20px; font-weight:bold;"> <!-- SGD --><?php echo $currencysg; ?> <?php echo $totalprice; ?> </span>
                    <?php 
                     $_SESSION['user_currency'] =  $currencysg;  $_SESSION['total_price'] = $totalprice;
                    ?>
                        <div>Click the button below to make the payment & complete your booking</div>
 <?php
 if($this->session->userdata('b2b_logged_in')) { 
 
					$deposit_amount_det = $this->Account_Model->get_deposit_amount($this->session->userdata('b2b_id')); 
			
			  if($deposit_amount_det->balance_credit > $cart_result->total_cost)
			  {
				  ?>
                        <button class="flight_booking_redbtn top10" style="margin-bottom:10px;">MAKE PAYMENT</button>
                        <?php
			  }
			  else
			  {
					echo ' <div class="top30" style="margin-top:12px; color:#FF0004"> <strong>Due to insufficient balance. You cant do this booking!.</strong></div>';   
			  }
			  
 }
 else
 {
	  ?>
                        <button class="flight_booking_redbtn top10" style="margin-bottom:10px;">MAKE PAYMENT</button>
                        <?php
 }
 ?>
                    </div>
                </div>
</form>

            </div>
            </div>
          <div class="clear_space1"></div>
          
          
         
        
          <div class="clear_space1"></div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <style type="text/css">
.tab-box-12 { 
  border-bottom: 1px solid #DDD;
  padding-bottom:5px;
  
}
.tab-box {
	background-color: #08427E;
	height: 28px;
	padding-top: 14px;
	padding-bottom: 0px;
  font-size:18px;
}
.tab-box a {/*
  border:1px solid #DDD;*/
  color:#bad6f4;
  padding: 8px 20px;
  text-decoration:none;
  background-color: #6998ca;
  margin-left:10px;
  border-radius:5px 5px 0px 0px;
  font-size:15px;
}
.tab-box a.activeLink { 
  background-color: #fff; 
  border-bottom: 0; 
  padding: 8px 20px;
  color:#014e81;
  font-size:15px;
  border-radius: 7px 7px 0px 0px;
  -moz-left-radius: 7px 7px 0px 0px;
  -webkit-left-radius: 7px 7px 0px 0px;
  -o-border-radius: 7px 7px 0px 0px;
}
.tabcontent {border: 0; padding: 5px; float: left;width: 100%;}
.hide { display: none;}

.small { color: #999; margin-top: 100px; border: 1px solid #EEE; padding: 5px; font-size: 9px; font-family:Verdana, Arial, Helvetica, sans-serif; }
</style>
  <script type="text/javascript" src="<?php echo base_url()?>assets/js/js-image-slider.js"></script> 
  <script src="<?php echo base_url()?>assets/js/jquery_tab.js" type="text/javascript"></script> 
  <script type="text/javascript">
  $(document).ready(function() {
    $(".tabLink").each(function(){
      $(this).click(function(){
        tabeId = $(this).attr('id');
        $(".tabLink").removeClass("activeLink");
        $(this).addClass("activeLink");
        $(".tabcontent").addClass("hide");
        $("#"+tabeId+"-1").removeClass("hide")   
        return false;	  
      });
    });  
  });
</script>
  <link href="<?php echo base_url()?>assets/map/infobox.css" type="text/css" rel="stylesheet">
  <script src="<?php echo base_url()?>assets/map/infobox.js" type="text/javascript"></script> 
  <script type="text/javascript" src="https://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyDF0Uq19B_mn5qFTN6R-t6tZPi0FcRJbv0"></script><script type="text/javascript" src="https://maps.gstatic.com/cat_js/intl/en_us/mapfiles/api-3/15/11/%7Bmain,adsense,geometry,zombie%7D.js"></script> 
  <script type="text/javascript">
    //&lt;![CDATA[
	  var WINDOW_HTML = '&lt;div style="width: 250px;padding-left: 10px;size:8px;"&gt;';	
    function load(lat,long) {
	
  
      if (GBrowserIsCompatible()) {
			var map = new GMap2(document.getElementById("map_div"), { size: new GSize(660,328) });
			map.addControl(new GSmallMapControl());
			map.addControl(new GMapTypeControl());
			map.setCenter(new GLatLng(lat,long), 18);
			var marker = new GMarker(new GLatLng(lat,long));
			

			//marker.setContent(100);
			map.addOverlay(marker);
			GEvent.addListener(marker, "click", function() {
				marker.openInfoWindowHtml(WINDOW_HTML);
			
			marker.openInfoWindowHtml('&lt;span style="color:#E62424; font-size:16px; float:left;"&gt;&lt;/span&gt;');
			
		});	
         }
     }
	 </script> 
  <script type="text/javascript">
function roam(name)
{
	var roam_key = $('#other_hotel').attr('class');
	
	 if (roam_key == 'show')
	{ 
	  if (roam_array) {
		for(j in roam_array) {
			roam_array[j].setMap(map);
		}
	  }
	  $('#other_hotel').removeClass('show');
	  $('#other_hotel').addClass('hide');
	  $('#other_hotel').val('Hide Other Hotels');
	} 
	else if(roam_key == 'hide')
	{
		if (roam_array) 
		{
			 for (j in roam_array) 
			 {
				 roam_array[j].setMap(null);
			 }
		}
	  $('#other_hotel').removeClass('hide');
	  $('#other_hotel').addClass('show');
	  $('#other_hotel').val('Show Other Hotels');
	}
}// end of Roam function

var center_lat = "";
var center_lng = "";

var infos = [];
var center = new google.maps.LatLng(center_lat, center_lng);



function initialize() {
  var mapOptions = {
    zoom: 10,
    mapTypeId: 'roadmap',
    center: center
  };

  map = new google.maps.Map(document.getElementById("map_div"), mapOptions);
  //map.setTilt(45);


  var hotel_img =  '<?php echo base_url()?>assets/images/select.png';
  var roam_arrnd =  '<?php echo base_url()?>assets/images/unselect.png';
  
  for (index in projmark){ addMainmark(projmark[index], hotel_img);}
  
  if(roaming.length &gt; 0)
 {
 	for (index in roaming){ addMarker_roam(roaming[index], roam_arrnd); }
  }
function orderOfCreation(marker,b) {
        return 1;
      }
    function addMainmark(data, img) 
  {
	  var marker = new google.maps.Marker({
	      	 position: new google.maps.LatLng(data.lat, data.lng),
	        map: map,	       
	        draggable: false,
	        animation: google.maps.Animation.DROP,
	        icon: img,
			zIndex:2

	});

	var content_main = document.createElement("DIV");
	var title = document.createElement("DIV");
	title.innerHTML = data.info;					
	content_main.appendChild(title);
	var myInfoOptions1 = {
			 content: content_main
			,disableAutoPan: false
			,maxWidth: 0
			,pixelOffset: new google.maps.Size(-140, 0)
			,zIndex: null
			,boxStyle: { 
			 // border: "2px solid #3399FE"
			 // ,background: "white",
			  opacity: 1
			  ,width: "300px"
			  ,height: "95px"
			  
			 }
			,closeBoxMargin: "10px 2px 2px 2px"
			,closeBoxURL: ""
			,infoBoxClearance: new google.maps.Size(1, 1)
			,isHidden: false
			,pane: "floatPane"
			,enableEventPropagation: false
		};
                   
      google.maps.event.addListener(marker, 'mouseover', function () { 
      	   closeInfos();     	                 
		ib.open(map, this);
	   infos[0]=ib;
             });     
	
	 google.maps.event.addListener(marker, 'mouseout', function () { 
      	   closeInfos();     	                 
		ib.close(map, this);
	   infos[0]=ib;
             }); 
			 
	  var ib = new InfoBox(myInfoOptions1);
		 
	
  }
  
  function addMarker_roam(data, img) 
  {
      var marker = new google.maps.Marker({
                   position: new google.maps.LatLng(data.lat, data.lng),
                   map: map,                
                   draggable: false,
                   animation: google.maps.Animation.DROP,
                   icon: img,
				    zIndex:1
      });
    roam_array.push(marker);
     var content = document.createElement("DIV");
      var title = document.createElement("DIV");
      title.innerHTML = data.info;    					
      content.appendChild(title);       


		var myInfoOptions = {
			 content: content
			,disableAutoPan: false
			,maxWidth: 0
			,pixelOffset: new google.maps.Size(-140, 0)
			,zIndex: null
			,boxStyle: { 
			  //border: "2px solid #ECA425"
			  //,background: "white",
			  opacity: 1
			  ,width: "300px"
			  ,height: "100px"
			  
			 }
			,closeBoxMargin: "10px 2px 2px 2px"
			,closeBoxURL: ""
			,infoBoxClearance: new google.maps.Size(1, 1)
			,isHidden: false
			,pane: "floatPane"
			,enableEventPropagation: false
		};
                   
      google.maps.event.addListener(marker, 'mouseover', function () { 
      	   closeInfos();     	                 
		ib.open(map, this);
	   infos[0]=ib;
             });     
	
	 google.maps.event.addListener(marker, 'mouseout', function () { 
      	   closeInfos();     	                 
		ib.close(map, this);
	   infos[0]=ib;
             }); 
			 
	  var ib = new InfoBox(myInfoOptions);
		
        
  } //end of for loop of roaming places
 
} // end of Initialize Function


function closeInfos(){
	   if(infos.length &gt; 0){
	  
	      infos[0].set("marker",null);	    
	      infos[0].close();	     
	      infos.length = 0;
	   }
	} // end of close Infos

google.maps.event.addDomListener(window, 'load', initialize);
</script> 
</div>
<!-- FOOTER WRAPPER -->
<?php $this->load->view('header_footer/footer'); ?>
<!-- FOOTER WRAPPER END --> 
<!-- Wrapper END --> 
<script type="text/javascript">
function check_new_sub(email)
{
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(email) == false)
	{
		document.getElementById("user_error1").innerHTML = "Please enter a valid email address";
		document.getElementById("email_sub").value = '';
		document.getElementById("email_sub").focus();
		return false;
	}
	else
	{
		/* $.ajax
			({
				 type: "POST",
				 url: "http://192.168.0.144/WDM/singapore/index.php/home/check_sub",
				  data: "source="+email,
				  success: function(msg)
				  {
					 if(msg == 1)
					 {
						 document.getElementById("user_error1").innerHTML = "Email id already exists";
						 document.getElementById("email_sub").value = '';
				 		 document.getElementById("email_sub").focus();
						 return false;
					 }
					 else
					 {
					  	 document.getElementById("user_error1").innerHTML = "Thanks for subscribing with us!!!!";
					 }
				  }
			});*/
		 document.getElementById("user_error1").innerHTML = "";
	}
}
function check_subsrcibe()
{
	var email = $('#email_sub').val();
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(email) == false)
	{
		document.getElementById("user_error1").innerHTML = "Please enter a valid email address";
		document.getElementById("email_sub").value = '';
		document.getElementById("email_sub").focus();
		return false;
	}
	else
	{
		$.ajax
			({
				 type: "POST",
				 url: "<?php echo base_url()?>index.php/home/check_sub",
				  data: "source="+email,
				  success: function(msg)
				  {
					 if(msg == 1)
					 {
						 document.getElementById("user_error1").innerHTML = "Email id already exists";
						 document.getElementById("email_sub").value = '';
				 		 document.getElementById("email_sub").focus();
						 return false;
					 }
					  else
					 {
					  	document.getElementById("user_error1").innerHTML = "Thanks for subscribing with us!!!!";
					 }
				  }
			});
	}
}
</script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script> 
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url()?>assets/js/autocomplete/hotels_city_autocomplete.js"></script> 
<!--###########AUTO COMPLETE#############--> 
<!--###########DATE PICKER#############-->
<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
<script src="<?php echo base_url()?>assets/js/slider/jquery.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url()?>assets/js/slider/jquery.mobile.customized.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url()?>assets/js/slider/jquery.easing.1.3.js" type="text/javascript"></script> 
<script src="<?php echo base_url()?>assets/js/slider/camera.min.js" type="text/javascript"></script> 
<script>
		jQuery(function(){
			
			jQuery('#camera_wrap_4').camera({
				height: 'auto',
				loader: 'bar',
				pagination: false,
				thumbnails: true,
				hover: false,
				opacityOnGrid: false,
				imagePath: '../images/'
			});

		});
	</script> 

<!--###########DATE PICKER#############---> 
<script type="text/javascript">
        var baseUrl = "<?php echo base_url()?>";
        var siteUrl = "<?php echo site_url()?>";
    </script> 
<!-- Home Slider Javascript END--> 

<script type="text/javascript">
        $("#searchDetails").click(function(){
		
		if ($('#searchDetails_block').css('display') == 'none') 
		{
			$("#searchDetails").removeClass('modify_search_icon');
			$("#searchDetails").addClass('modify_search_icon1');
		}
		else
		{
			$("#searchDetails").removeClass('modify_search_icon1');
			$("#searchDetails").addClass('modify_search_icon');
		}			
			$("#searchDetails_block").slideToggle();
			
	});
        
        $("#modifysearch").click(function(){
		
		if ($('#modifysearch_block').css('display') == 'none') 
		{
			$("#modifysearch").removeClass('modify_search_icon');
			$("#modifysearch").addClass('modify_search_icon1');
		}
		else
		{
			$("#modifysearch").removeClass('modify_search_icon1');
			$("#modifysearch").addClass('modify_search_icon');
		}			
			$("#modifysearch_block").slideToggle();
			
	});
        
        function getAdultChilds(count)
        {
           $.ajax({
                    url:"<?php echo base_url()?>index.php/home/getAdultChilds/",
                    data:"count="+count,
                    type: "GET",
                    dataType: "json",
                    beforeSend:function(){
                          $("#loading").html("");
                    },
                    success: function(data){
                          $("#adultchild").html(data.total_result);
                    },
                    error:function(request, status, error){

                    }
              });
        }
        
         $( "#user_country" ).change(function() {
            var country=$('#user_country').val();
            $.ajax({

                url:"<?php echo base_url()?>index.php/expedia/getExpediaStateListOnCountry/",
                data:"country="+country,
                type: "GET",
                dataType: "json",
                beforeSend:function(){
                      $("#loading").html("");
                },
                success: function(data){
                      $("#user_state_div").html(data.total_result);
                },
                error:function(request, status, error){

                }
           });
        });
        
         $(function() {
            $( "#datepicker" ).datepicker({
                numberOfMonths: 3,
                dateFormat: 'yy-mm-dd',
                minDate: 1
            });

            $( "#datepicker1" ).datepicker({
                numberOfMonths: 3,
                dateFormat: 'yy-mm-dd',
                minDate: 1
            });

        });

        $('#datepicker').change(function() {
          //$t=$(this).val();
          var selectedDate = $(this).datepicker('getDate');
          var str1 = $("#datepicker1").val();
          var predayDate = dateADD(selectedDate);
          var str2 = zeroPad(predayDate.getDate(), 2) + "-" + zeroPad((predayDate.getMonth() + 1), 2) + "-" + (predayDate.getFullYear());
          var dt1 = parseInt(str1.substring(0, 2), 10);
          var mon1 = parseInt(str1.substring(3, 5), 10);
          var yr1 = parseInt(str1.substring(6, 10), 10);
          var dt2 = parseInt(str2.substring(0, 2), 10);
          var mon2 = parseInt(str2.substring(3, 5), 10);
          var yr2 = parseInt(str2.substring(6, 10), 10);
          var date1 = new Date(yr1, mon1, dt1);
          var date2 = new Date(yr2, mon2, dt2);
          if (date2 &lt; date1)
          {

          }
          else
          {
              var nextdayDate = dateADD(selectedDate);
              var nextDateStr = (nextdayDate.getFullYear()) +"-"+zeroPad((nextdayDate.getMonth() + 1), 2)+"-"+zeroPad(nextdayDate.getDate(), 2);

              $t = nextDateStr;
              $( "#datepicker1" ).datepicker({
                    numberOfMonths: 3,
                    dateFormat: 'yy-mm-dd',
                    minDate: 1
                });
              $("#datepicker1").val($t);
          }

        });
    </script> 

<div id="lbOverlay" style="display: none;"></div>
<div id="lbCenter" style="display: none;">
  <div id="lbImage">
    <div style="position: relative;"><a href="#" id="lbPrevLink"></a><a href="#" id="lbNextLink"></a></div>
  </div>
</div>
<div id="lbBottomContainer" style="display: none;">
  <div id="lbBottom"><a href="#" id="lbCloseLink"></a>
    <div id="lbCaption"></div>
    <div id="lbNumber"></div>
    <div style="clear: both;"></div>
  </div>
</div>
<div class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" id="ui-datepicker-div"></div>
</body>
<!--###########AUTO COMPLETE#############-->
</html>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script class="secret-source">
		$(document).ready(function(){
			$("#pre_booking").validationEngine();
            
	});
  
    </script>
<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/languages/jquery.validationEngine-en.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/Validation/css/validationEngine.jquery.css" media="all" type="text/css" />

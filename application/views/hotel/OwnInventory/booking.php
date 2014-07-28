<?php 
	$amount = '';  $totalbreak = ''; $totalam = ''; $this->load->view('header_footer/header_hotel');
	$qry = mysql_query("select * from hotel_search_list where hotelcode='".$cart_result[0]->HotelCode."'"); 
	$hotel_details = mysql_fetch_array($qry);
	//print_r($hotel_details);
	/*$HotelName = $fetcharray['HotelName'];
	$image = $fetcharray['FrontPgImage'];
	$starRating = $fetcharray['StarRating'];*/
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
      <div class="color_blue1 font_size22 padding10"><strong><?php echo $hotel_details['HotelName']; ?></strong> 
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
        <div class="padding5 text3">
                    <div class="hotel_image"><img src="<?php echo $hotel_details['FrontPgImage']; ?>" width="140" height="140" /></div>
                    <div class="hotel_text_detail" style="width:552px;">
                    <div class="trip_rating_part" align="center">
  <div ></div>
                        
                        <div class="clr_space"></div>
                        
                    </div>
                        <div class="text12" style="color:#08427e;"><?php echo $hotel_details['HotelName']; ?></div>
                        <div style="color:#535353; font-size:11px;"><?php echo $hotel_details['Address']; ?><br /><?php echo $hotel_details['Location']; ?><br /><?php echo $hotel_details['PostalCode']; ?> </div>
                        <div class=""><img src="<?php echo base_url().'assets/images/dummy/star-active'.$hotel_details['StarRating'].'.png'; ?>" style="border: none;"/></div>
                        <div class="clr_space"></div>
                        <div style="width:444px; float:left; color:#333; font-size:11px; line-height:15px;  margin-top:-7px; margin-bottom:-7px;">
                    <p><!--<b><?php //echo preg_replace("/[^a-z0-9_-]/i", " ", $hotel_details->HotelDesc); ?></b> <br>--><b><?php echo preg_replace("/[^a-z0-9_-]/i", " ",  substr($hotel_details['HotelDesc'],0,200)); ?></b></p><div class="clr"></div>
                </div>
                        <div class="clr_space"></div>
                        <?php  
						//$cur=floor(0.20669*$hotel_details->AvgPrice);?>
                        <div style="float:right; font-size:20px; color:#2981BC; font-weight:bold;" ><?php //echo 'SGD  '.$hotel_details->AvgPrice	;?></div>
                        
                        
                <?php ?>
                    </div>
                    
                    
                    <div class="clear"></div>
                    <!--select room part-->
                    <div>
                        <div class="clear_space1"></div>
                    </div>
                    <!--select room part-->
                    <div class="clear"></div>
                    <div class="padding5 border_bottom3"></div>
                </div>
          
          <div class="clear_space1"></div>
         <table width="720" class="">
                                  <tbody><tr id="">
	<td class="">
                                        <span class="" id="">
                                        <b><i><span style="color:Green;" id="lblRoomAvailabilityStatus">Rooms Available with instant confirmation.</span></i></b>
                                        </span>
                                    </td>
	<td class="" style="float:right">
                                            
                                            
                                        </td>
</tr>

                                </tbody></table>
                               <style>
							   .RateTblRoomDesc {
							   background-color:#AAEBFF;
							   }
							   .RateTblAvailability {
    background-color: #12EB7E;
    font-weight: bold;
}
 .RateTblInstant {
    background-color: #13EB7B;
    font-weight: bold;
	color:#333;
}
 .RateTblOnRequest {
    background-color: #FF0F13;
	color:#fff;
    font-weight: bold;
}
.notesbox1_bl {
    background: none no-repeat scroll 0 100% #F3F3F3;
    width: 100%;
}
.notesbox1_br {
    background: none no-repeat scroll 100% 100% rgba(0, 0, 0, 0);
}.notesbox1_tl {
    background: none no-repeat scroll 0 0 rgba(0, 0, 0, 0);
}
.notesbox1_tr {
    background: none no-repeat scroll 100% 0 rgba(0, 0, 0, 0);
    height: 100%;
    padding: 10px;
}

.p11b {
    font-size: 11px;
    font-weight: bold;
}
.cv6 {
    color: #FF0000;
}

.promobox_tr {
  
    height: 100%;
    padding: 10px;
}
							   </style> 
                                <div style="width:100%;overflow-x:auto;" id="">
                                    <table border="0" cellspacing="1" cellpadding="2" style="width:100%;" class="p8p" id="tblRoomRate">
	<tbody><tr style=" background-color:#0075C0;
    color: #FFFFFF;
    font-weight: bold;
    text-align: center;">
		<td><span id="">Occupancy</span></td><td><span id="">Number of Rooms</span></td><td><span id="">Total Price</span></td>
        <?php 
		for($days_count = 0; $days_count < $_SESSION['hotel_search']['days']; $days_count++)
		{
			$date_val[] = date('Y-m-d', strtotime($_SESSION['hotel_search']['cin']. " + $days_count days"));
		}
		
$data_val1 = array_unique($date_val);
//print_r($data_val1);

for($da = 0; $da < count($data_val1); $da++)
{
		?>
        <td><span id=""><?php echo date("D",strtotime($data_val1[$da])); ?><br><?php echo date("d",strtotime($data_val1[$da])); ?> <?php echo date("M",strtotime($data_val1[$da])); ?></span></td>
        <?php
}
?>
        
	</tr>
    

<?php /*?>    <tr align="center">
		<td colspan="3" class="RateTblRoomDesc" style="  text-align:left;"><span></span></td><td colspan="<?php echo count($data_val1); ?>" class="RateTblRoomDesc"><span>Room Only</span></td>
	</tr><?php */ ?>
    <?php 
$shurival = 	array();//explode("^^^^",$result->shurival);
$shurival_v1 = array();
$adults_count = 0; 
$child_count = 0;
//print_r($_SESSION['hotel_search']['child']);
foreach($_SESSION['hotel_search']['adult'] as $adults) 
{ 
	$adults_count = $adults_count + $adults; 
} 
foreach($_SESSION['hotel_search']['child'] as $child) 
{ 
	$child_count = $child_count + $child; 
} 

	//for($r=0;$r< count($shurival);$r++)
	//{
		//$shurival_v1 = 	explode("||||",$shurival[$r]);
		?>
    <tr>
		<td nowrap="" class="RateTblRoomDesc " style="  text-align:left;">
        <span style="font-weight:bold;"><?php echo $adults_count; ?> Adult</span>
        <?php 
		for($i=0;$i<$adults_count;$i++)
		{
			?>
        <img style="border-width:0px;" src="<?php echo base_url(); ?>assets/images/dummy/adult.png">
        <?php
		}
		?>
        <?php
		if($child_count!=0)
		{
			?>
              <span style="font-weight:bold;"><?php echo $child_count; ?> Child</span>
        <?php 
		for($i=0;$i<$child_count;$i++)
		{
			?>
        <img style="border-width:0px;" src="<?php echo base_url(); ?>assets/images/dummy/child.png">
        <?php
		}
		}
		
		?>
        
        </td>
        <td nowrap="" align="center" style="width:100px;" class="RateTblRoomDesc">1</td>
        <td nowrap="" align="center" style="width:100px;" class="RateTblInstant<?php //echo $result->status; ?>">
        <span style="font-weight:bold;">SGD <?php echo $totalpricemarkup; ?> </span></td>
        <?php
			
		for($da=0;$da<count($data_val1);$da++)
		{
				$tip_text = '';
			?>
              <td nowrap="" align="center" style="width:90px;" class="RateTblInstant<?php //echo $token_val_occ_id_final[$to][4]; ?>">
              
              <a style="text-decoration:none;" onmouseout="UnTip()" onmouseover="Tip('<?php echo $tip_text; ?>&lt;br /&gt;Billing Currency : SGD')">
              <span id="">SGD <?php echo $totalpricemarkup; ?></span>
              </a>
              </td>
              <?php
	
	?>
        
      
      <?php
}
?>
        
	</tr>
    <?php
	//}
	?>
    <tr style="height:30px">
		<td  align="right"colspan="2" class="RateTblRoomDesc" style="  text-align:right; font-size:12px"><span><strong> Total Cost :  </strong></span></td><td class="RateTblRoomDesc" style="text-align:center;"><strong>SGD <?php echo $totalprice;; ?></strong></td><td colspan="<?php echo count($data_val1); ?>" class="RateTblRoomDesc"><span></span></td>
	</tr>
    
</tbody></table>
                                </div>
                                
                             <div class="clr_space"></div><br />
            <div style="margin-bottom:12px; float:left; margin-left:10px;">     
                                <div class="bg02 font_size13" style="float:left;width:455px;"><img alt="" src="<?php echo base_url(); ?>assets/images/bullet_arrow.gif">
                <strong style="color: #FF0000; line-height: 15px; font-size:11px">Billing Currency :  SGD</strong></br>
    <img alt="" src="<?php echo base_url(); ?>assets/images/bullet_arrow.gif">
    <?php if(false){ ?>  <img alt="" src="<?php echo base_url(); ?>assets/images/bullet_arrow.gif"><strong style="color: #FF0000; line-height: 15px; font-size:11px;">All rates are Included with Breakfast.</strong><?php }else{ echo '';}?>
                <strong style="color: #FF0000;
 line-height: 15px; font-size:11px;">All rates are exclusive of hotel tax and service charges.</strong></div>
 </div>
 
                                <table width="720" align="center">
                                    <tbody><tr class="" style="text-align:left">
                                      <td valign="top">
                                            

    <div class="notesbox1_bl">
        <div class="notesbox1_br">
            <div class="notesbox1_tl">
                <div class="notesbox1_tr"> 
                    <span class="p11b cv6">
                        <span id="">Rates Inclusion/Terms and Conditions</span>:</span>
                    <br>
                    <span id="" style="color:#F00" >
					Meals Type :
                    <?php
//$cancellation_policy_v1=$result->Classification_val.'<br>';
//$cancellation_policy = 	$this->Hotelspro_Model->get_cancellation_policy($result->room_code,$result->hotel_code);
/*for($k=0;$k<count($cancellation_policy); $k++)
{
		$cancellation_policy_v1 .= "&diams;If you cancel the booking after ".$cancellation_policy[$k]['cancellation_deadline_date']." means, charge is ".$cancellation_policy[$k]['feeAmount'].' '.$cancellation_policy[$k]['feeType'].'<br>';
		$cancellation_policy_v1 .= "<em><strong>Remarks : </strong>".$cancellation_policy[$k]['remarks']."</em><br><br>";
}*/
					echo $cancel_record['cancelpolicy'];
					
		
					?></span>
                </div>
            </div>
        </div>
    </div>

<div class="clear">&nbsp;</div>  
                                        </td>
                                    </tr>
                                </tbody></table>
                                <table width="720" align="center">
                                    <tbody><tr class="" style="text-align:left">
                                      <td valign="top">

                                        
            <?php
			//$promotion = $result->ShortNameaa;
			$promotion = '';
//echo $promotion;exit;
		if($promotion!='')
		{
			?>        

            <div class="promobox_tr" style="background-color:#F7E6FF"> 
        <?php  
        
		
$promotion_v1 = explode("||||",$promotion);
for($i=0;$i<count($promotion_v1);$i++)
{
	$promotion_v2 = explode("^^^^",$promotion_v1[$i]);

	?>
            <span class="p11b cv6">
                <span id="">Room Promotions</span>&nbsp; 
               
               
                </span><br>
                <table width="100%" cellspacing="0" cellpadding="0" style="" id="" class="p8p">
                    <tbody><tr>
                        <td>
                            <span style="font-weight:bold;" id=""></span>
                        </td>
                    </tr>   
                    <tr>
                        <td>
                            <table border="0" align="Left" cellspacing="0" cellpadding="0" style="border-width:2px;border-style:None;font-size:8pt;width:100%;border-collapse:collapse;" id="">
	<tbody><tr>
		<td><span style="color:Purple;font-weight:bold;"><u><?php echo $promotion_v2[4]; ?></u><br />
          <strong>Enjoy <?php echo $promotion_v2[7]; ?><?php echo $promotion_v2[6]; ?> OFF</strong></span></td>
	</tr>
  
    <tr>
		<td><span style="font-weight:bold;">Promo Only Applicable For <?php echo date("d-M-Y",strtotime($promotion_v2[2])); ?> To <?php echo date("d-M-Y",strtotime($promotion_v2[3])); ?> Period. <br />
  <br /> 
Promo Only Applicable For Before <?php echo $promotion_v2[5]; ?> Days Of Travel Date.
<?php
if(isset($promotion_v2[8]) && $promotion_v2[8]!='')
{
	$exp_date = explode(",",$promotion_v2[8]);
	
	?>

  <br /> 
Promo Not Applicable For Below Dates <br />
 <?php 
 for($k=0;$k<count($exp_date);$k++)
 {
	 if($exp_date[$k]!='')
	 {
 echo date("d-M-Y",strtotime($exp_date[$k])).'<br>'; 
	 }
 }
}
 ?>	</span></td>
	</tr><tr>
		<td>&nbsp; </td>
	</tr>
</tbody></table>
				        </td>
                    </tr>                                                                                                                                                                         
                </tbody></table>
                <?php
}
?>
          
            </div>
  <?php
		}
		?>
<div class="clear">&nbsp;</div>

                                        </td>
                                    </tr>
                                </tbody></table>
              
               <div style="width:728px; margin-left:0px" class="right_main_bar top10">
            <div class="fleft left20"> &nbsp;Proceed to Payment</div>
          </div>
          <div style="width:728px;">
           <?php if(!$this->session->userdata('b2c_logged_in') && !$this->session->userdata('b2b_logged_in')){?>
          <div style="background-color: #FFF;margin-left:10px;
border-radius: 10px;margin-bottom:10px;" class="top10 fleft left60">
          <form class="form-horizontal form-validate" action="<?php echo base_url(); ?>index.php/hotel/hotel_booking_own1/<?php echo $cart_result[0]->RoomCode; ?>" method="POST" id="contine_guest" name="guest_form">
            <div class="top30 fleft left20">
              <div class="flight_booking_header1"> Continue without registering</div>
              <div style="margin-top:12px;" class="top30"> In a hurry? Proceed to pay without registering on<br>
                DSS DEMO ONLINE<br>
                <br>
                Enter your e-mail to continue.</div>
              <input type="text" class="flight_booking_inputbox top20 validate[required,custom[email]]"  value="" style="margin-top:5px;" name="guest_email" id="guest_email">
              <input type="hidden" value="guest_booking" name="booking_type">
            <input type="hidden" name="price" value="<?php echo $totalprice; ?>" />
               <div class="clear"></div>
              <button style="margin-top:10px;" class="flight_booking_redbtn top20"> Continue as Guest </button>
              <span id="formerror"></span><br>
            </div>
          </form>
          <div class="clear_space1"></div>
         </div>
          <?php }else{ ?>
           
          <?php
		  }
		  ?>
		
          <div style="background-color: #FFF;
border-radius: 10px;margin-bottom:10px;" class="top10 fleft left60">
          <?php if($this->session->userdata('b2c_logged_in')){
			  ?><div style="float: right;
    margin-top: 22px;">
            <div class="flight_booking_header1"> Already Registered</div>
            <div class="top30" style="margin-top:12px;"> Welcome back! You have already login in DSS DEMO ONLINE </div>
            <form class="form-horizontal form-validate" action="<?php echo base_url(); ?>index.php/hotel/hotel_booking_own1/<?php echo $cart_result[0]->RoomCode; ?>" method="POST" id="user_form" name="user_form">
            
            <button class="flight_booking_redbtn top20" type="submit"> Continue </button>
                   <input type="hidden" name="price" value="<?php echo $result->total_cost; ?>" />
              <input type="hidden" name="booking_type" value="b2c" />
            
            </form></div> <?php }
		  elseif($this->session->userdata('b2b_logged_in'))
		  {
			  $deposit_amount_det = $this->Account_Model->get_deposit_amount($this->session->userdata('b2b_id')); 
		  ?><div style="float: right;
    margin-top: 22px;">
            <div class="flight_booking_header1"> Already Registered</div>
            <div class="top30" style="margin-top:12px;"> Welcome back! You have already login in DSS DEMO ONLINE </div>
            
             <div class="top30" style="margin-top:12px; color:#FF0004"> 
             <?php
			  if($deposit_amount_det->balance_credit >  $result->total_cost)
			  {
				  ?>
             <table width="400" cellpadding="5" cellspacing="5">
  <tr>
    <td><strong>Current Balance</strong></td>
    <td>:</td>
    <td><?php echo $deposit_amount_det->balance_credit; ?> SGD</td>
  </tr>
  <tr>
    <td><strong>Booking Cost</strong></td>
    <td>:</td>
    <td><?php echo $result->total_cost; ?> SGD</td>
  </tr>
  <tr>
    <td  colspan="3">--------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td><strong>After Booking</strong></td>
    <td>:</td>
    <td><?php echo ($deposit_amount_det->balance_credit-$result->total_cost); ?> SGD</td>
  </tr>
</table>
<form class="form-horizontal form-validate" action="<?php echo base_url(); ?>index.php/hotel/hotel_booking_own1/<?php echo $cart_result[0]->RoomCode; ?>" method="POST" id="user_form" name="user_form">
            
            <button class="flight_booking_redbtn top20" type="submit"> Continue </button>
                   <input type="hidden" name="price" value="<?php echo $result->total_cost; ?>" />
                   
                    <input type="hidden" name="booking_type" value="b2b" />
            
            </form>
<?php
			  }
			  else
			  {
				echo '<strong>Due to insufficient balance. You cant do this booking!.</strong>';  
			  }
			  ?>
 </div>
             
            </div> <?php 
		  }
		  else{ ?>
          <form class="form-horizontal form-validate" action="<?php echo base_url(); ?>index.php/hotel/hotel_booking_own1/<?php  echo $cart_result[0]->RoomCode; ?>" method="POST" id="user_form" name="user_form">
            <div class="top30 fleft left20">
              <div class="flight_booking_header1"> Already Registered</div>       <input type="hidden" name="price" value="<?php echo $totalprice; ?>" />
              <div style="margin-top:12px;" class="top30"> Welcome back! Please log-in to your DSS DEMO ONLINE <br>
                account by entering your e-mail and password to continue.</div>
              <br>
              <label class="top20">Username</label>
              <span style="display:none;" id="loading"><img width="20" src="http://provabsc.com/singapore/assets/images/290.gif"></span> <span id="usemail_pwd" style="display:none; margin-left:10px; color:#BF0000">Please enter email id you have registered with us</span><br>
              <input type="text" class="flight_booking_inputbox validate[required,custom[email]]"  style="margin-top:5px;" value="" id="user_name" name="user_name">
              <br>
              <label class="top20">Password</label>
              <br>
              <input type="password" class="flight_booking_inputbox validate[required]" value=""  style="margin-top:5px;" name="user_password">
              <input type="hidden" value="user_booking" name="booking_type">
              <br />
              <div>
              <?php
			  if(isset($status))
			  {
					echo '<span style="color:red; font-weight:bold">'.$status.'</span>'; 
			  }
			  ?>
              </div>
             
              <div class="clear"></div>
              <button class="flight_booking_redbtn top20 fleft"> Login </button>
              <div style="margin-right:150px; cursor:pointer;" class="top30 fright"></div>
            </div>
          </form>
         
          <?php }?>
           <div class="clear_space1"></div>
         </div>
         
          <div class="clear"></div>
          
          </div>
         
        
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

 

<?php /*?><div id="lbOverlay" style="display: none;"></div>
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
<div class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" id="ui-datepicker-div"></div><?php */?>
</body>
<!--###########AUTO COMPLETE#############-->
</html>



 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script class="secret-source">
		$(document).ready(function(){
			
			$("#contine_guest").validationEngine();
            $("#terms_check").validationEngine();
			$("#user_form").validationEngine();
	});
  
    </script>
<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/jquery.validationEngine.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/languages/jquery.validationEngine-en.js"></script>



<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tooltip/tooltip.js"></script>

<link rel="stylesheet" href="<?php echo base_url()?>assets/Validation/css/validationEngine.jquery.css" media="all" type="text/css" />
<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
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

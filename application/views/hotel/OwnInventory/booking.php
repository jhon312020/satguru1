<?php $amount = '';  $totalbreak = ''; $this->load->view('header_footer/header_hotel'); ?>
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

<link charset="utf-8" media="screen" type="text/css" href="<?php echo base_url(); ?>assets/css/popbox_new.css" rel="stylesheet">

  <script src="<?php echo base_url(); ?>assets/js/popbox_new.js" charset="utf-8" type="text/javascript"></script>
  
  <script charset="utf-8" type="text/javascript">
    $(document).ready(function(){
      $('.popbox,.popbox1').popbox();
    });
  </script>
  
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
/*height: 20px;*/
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


<div class="inner_wrapper">
<div class="padding10 part985">
    <div class="left_part">
                      <div id='cssmenu'  >
               
                    <ul>
                        <li class='has-sub active'><a href='#'><span>Your Search Details</span></a>
                            <ul style="line-height:20px; font-family:Arial, Helvetica, sans-serif; font-size:12px; display:block;">
                               <span style="width:100px; float:left;">Hotels In </span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['hotel_search']['city']; ?><br /></span>
                                <span style="width:100px; float:left;">Checkin Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;
								<?php //echo date('M d, Y',strtotime('Y-m-d',$cin2)); ?>
                                <?php echo date('d M Y',strtotime($_SESSION['hotel_search']['cin'])); ?><br /></span>
                               <span style="width:100px; float:left;"> Checkout Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo date('d M Y',strtotime($_SESSION['hotel_search']['cout'])); ?><br /></span>
                                <span style="width:100px; float:left;">Adults </span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['hotel_search']['adult']; ?><br /></span>
                                <span style="width:100px; float:left;">Childs</span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['hotel_search']['child_count']; ?><br /></span>
                                <span style="width:100px; float:left;">Nights</span> <span style="font-weight:bold; color:#025590;"> :&nbsp;<?php echo $_SESSION['hotel_search']['days'] + 1;?></span>
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
                                <?php //$last_viewed_hotels = $this->Hotelbeds_Model->last_viewed_hotels(); 
								
							
								?>
                                    <div class="bg_whight">
            <div class="padding10">
                <div class="font_size20 color_blue">Last Viewed Hotel</div>
                <div class="border_bottom2"></div>
                <div class="font_size14 color_blue padding_top_bottom">
                <?php if(isset($last_viewed_hotels)) { if($last_viewed_hotels != '') { foreach($last_viewed_hotels as $last) { ?>
                    <div class="lastview_hotel_img">
                        <img src="<?php echo $hotel_details->image; ?>" width="60" height="60" />
                    </div>
                    <div class="lastview_hotel_name_stars font_size14" align="left" style="width:117px;">
                        <strong><?php echo $hotel_details->hotel_name; ?></strong>
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
    <?php 
       //$last = $this->Hotelbeds_Model->everydetails($cart_result[0]->HotelCode);
	   //if($last->HotelName==''){
		  $qry=mysql_query("select * from hotel_search_list where hotelcode='".$cart_result[0]->HotelCode."'"); 
		  $fetcharray=mysql_fetch_array($qry);
		  $HotelName=$fetcharray['HotelName'];
		  $image=$fetcharray['FrontPgImage'];
		  $starRating1=$fetcharray['StarRating'];
		  if( $starRating1=='1 stars')
			  $starRating=1;
		  if($starRating1=='2 stars')
			  $starRating=2;
		  if($starRating1=='3 stars')
			  $starRating=3;
		  if($starRating1=='4 stars')
			  $starRating=4;
		  if($starRating1=='5 stars')
			  $starRating=5;
			  $begin = new DateTime($_SESSION['hotel_search']['cin']);
     		  $end = new DateTime($_SESSION['hotel_search']['cout']);
      		  $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
			  $timestamp_start = strtotime($_SESSION['hotel_search']['cin']);
			  $timestamp_end = strtotime($_SESSION['hotel_search']['cout']);
			  $difference = abs($timestamp_end - $timestamp_start);
			  $days = floor($difference/(60*60*24));
			  
			  
			 

		   /*}
		   else
		   {
			   $HotelName=$last->HotelName;
			   $image=$last->FrontPgImage;
			    if($last->StarRating=='1 stars')
				  $starRating=1;
			  if($last->StarRating=='2 stars')
				  $starRating=2;
			  if($last->StarRating=='3 stars')
				  $starRating=3;
			  if($last->StarRating=='4 stars')
				  $starRating=4;
			  if($last->StarRating=='5 stars')
				  $starRating=5;
				  
				  $prices = $this->Hotels_Model->dateprice($cart_result[0]->HotelCode,$cart_result[0]->RoomCode);
					 }*/
	   
	   //echo '<pre>';print_r($last);
   
    


?>
    <div style="width:750px; margin-left:0px;" class="right_part">
        <div class="color_blue1 font_size22 padding10"><strong><?php echo  $HotelName;?></strong>
        
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
                    <div class="hotel_image"><img src="<?php echo  $image;?>" width="140" height="146" /></div>
                    <div style="width:552px;" class="hotel_text_detail">
                    <div align="center" class="trip_rating_part">
                                                           
                        <?php if( $starRating=='1'){ ?>
                        <div class="trip_rating_one"></div>
                        <?php }else if($starRating=='2'){ ?>
                        <div class="trip_rating_two"></div>
                        <?php }else if($starRating=='3'){ ?>
                        <div class="trip_rating_three"></div>
                        <?php }else if($starRating=='4'){ ?>
                        <div class="trip_rating_four"></div>
                        <?php }else if($starRating=='5'){ ?>
                       
                        <div class="trip_rating_five"></div>
                        <?php }else{ ?>
                        <div class="trip_rating1"></div>
                        <?php } ?>
                        <?php echo $starRating; ?>stars Hotel

                    </div>
                        <div style="color:#08427e;" class="text12"><?php echo $HotelName;?></div>
                        <div style="color:#535353; font-size:11px;"><!-- &ndash;--> </div>					 <?php if( $starRating=='1'){ ?>
                         <div class="stars1" style="margin-top:5px;"></div>
                        <?php }else if($starRating=='2'){ ?>
                        <div class="stars2" style="margin-top:5px;"></div>
                        <?php }else if($starRating=='3'){ ?>
                         <div class="stars3" style="margin-top:5px;"></div>
                        <?php }else if($starRating=='4'){ ?>
                          <div class="stars4" style="margin-top:5px;"></div>
                        <?php }else if($starRating=='5'){ ?>
                       
                         <div class="stars5" style="margin-top:5px;"></div>
                        <?php }else{ ?>
                        <div class="trip_rating1"></div>
                        <?php } ?>
                      
                        <div class="clr_space"></div>
                      <div style="width:444px; float:left; color:#333; font-size:11px; line-height:17px;  margin-top:1px; margin-bottom:-7px;">
                    <strong style="color:red;">Room Type :  </strong><strong><?php echo $cart_result[0]->RoomName?></strong></br>
                    <strong style="color:red;">Inclusion :  </strong><strong><?php echo $cart_result[0]->Inclusion ?></strong></br>
                   <strong style="color:red;">Date From :  </strong><strong><?php echo $_SESSION['hotel_search']['cin']?></strong></br>
                    <strong style="color:red;">Date To :  </strong><strong><?php echo $_SESSION['hotel_search']['cout']?></strong></br>
					<strong style="color:red;">Total Days :  </strong><strong><?php echo $_SESSION['hotel_search']['days']?></strong></br>
                         <strong style="color:red;">Total Adult :  </strong><strong><?php  echo $_SESSION['hotel_search']['adult']?></strong></br>
                    <div class="clr"></div>
                </div>
                        <div class="clr_space"></div>
                        <div style="margin-top:12px; float:left;"><?php 
						//$prices = $this->Hotels_Model->dateprice($cart_result[0]->HotelCode,$cart_result[0]->RoomCode);
						$prices = array();
						
						 ?>
                        <div class="padding10" style="float:left;width: 516px;">
                         <div class="bg01" style="float:left;width: 516px;">
                            <div style="width: 245px;float:left;margin-left: 26px;">&nbsp;<strong style=" color: #FF0000;;
    font-size: 11px;
    line-height: 15px;">Date</strong></div>
                            <div  style="width: 245px;float:right;"><strong style="color: #FF0000;;
    font-size: 11px;
    line-height: 15px;">Price</strong></div>
    
    
                            <div class="clear"></div>
                        </div>
                           <div class="bg02" style="float:left;width: 516px;">
                           <?php
						   $finalcount=count($prices);
						   if($finalcount!=0){
						   
						    for($d=0;$d< count($prices);$d++){
							   $date=explode('T', $prices[$d]->Date);
							   ?>
                          <div style="width: 245px;float:left;margin-left: 10px; margin-top:5px; margin-bottom:5px;">&nbsp;<strong style=" color: #333333;
    font-size: 11px;
    line-height: 15px;" ><?php echo $date[0];?></strong></div>
                          <div style="width: 245px;float:right; margin-top:5px;margin-bottom:5px;" >&nbsp;<strong style="    color: #333333;
    font-size: 11px;
    line-height: 15px;" ><?php echo $prices[$d]->Currency.' '.$prices[$d]->Rate;?></strong></div>
                
                           <?php }?>
                              </div>
                        </div>
                        <div style="float:right; font-size:20px; color:#2981BC; font-weight:bold;">  </div>
                        
                   
                                    </div>
                    
                    
                    <div class="clear"></div>
                      <?php } else {
						  
						 $currency=mysql_query("select currency from hotel_price where HotelCode='".$cart_result[0]->HotelCode."'");
						 $fetchcurrency=mysql_fetch_array($currency);
						 $currencysg=$fetchcurrency['currency'];
						
						  foreach($daterange as $date){
							  
							  $newdate=$date->format('Y-m-d');
							  $day_of_the_week = date('l', strtotime($newdate));
							  $day_of_the_week1 = date('w', strtotime($newdate));
							  
							  
							//Currency
							
							
							
							// Price
						 
						 $roomprice=mysql_query("select * from hotel_room_price where '".$newdate."' between ratefrom and rateto  and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
						$fetch_price=mysql_fetch_array($roomprice);
						$contractrate=$fetch_price['contractrate'];
						$roompricemarkup=$fetch_price['roompricemarkup'];
						$surcharge=$fetch_price['surcharge'];
						$weekdayfrom=$fetch_price['weekdayfrom'];
						$weekdaytill=$fetch_price['weekdaytill'];
						
						//holidaySurcharge
						$holidaysurcharge=mysql_query("select ratetosurcharge from hotel_room_holidayprice where HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."' and ratefromh='".$newdate."'");
						
						$fetch_holidayprice=mysql_fetch_array($holidaysurcharge);				
						
						$fetch_holidaysur=$fetch_holidayprice['ratetosurcharge'];	
						
						 
						
						//Total Price
						
						$totalpricemarkup=$contractrate+$roompricemarkup;
						
						$totalprice=$contractrate+$roompricemarkup+$fetch_holidaysur;
						
						// Total Price Discount
						
						$discountrate=mysql_query("select discountrate from  hotel_price_discount where '".$newdate."' between discountfrom and  discountto  and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
					
						$numfetchdiscount=mysql_num_rows($discountrate);
						$fetchdiscount=mysql_fetch_array($discountrate);
						$discountrate=$fetchdiscount['discountrate'];
						if($numfetchdiscount>0){
							
							$totalprice1=$totalprice/$discountrate;
							$totalprice=$totalprice-$totalprice1;
							
						}
						
						
					//
					
					// hotel_roompricediscount
						
						$roomprice=mysql_query("select pricerate from  hotel_roompricediscount where '".$newdate."' between pricefrom and  priceto  and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
					
						$numfetchpricediscount=mysql_num_rows($roomprice);
						$fetchdiscountprice=mysql_fetch_array($roomprice);
						$discountpricerate=$fetchdiscountprice['pricerate'];
						if($numfetchpricediscount>0){
							
							$totalprice=$totalprice-$discountpricerate;
							
							
						}	
						
					
					// hotel_roompricediscount
						
						$roomprice=mysql_query("select pricerate from  hotel_roompricediscount where '".$newdate."' between pricefrom and  priceto  and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
					
						$numfetchpricediscount=mysql_num_rows($roomprice);
						$fetchdiscountprice=mysql_fetch_array($roomprice);
						$discountpricerate=$fetchdiscountprice['pricerate'];
						if($numfetchpricediscount>0){
							
							$totalprice=$totalprice-$discountpricerate;
							
							
						}	
					
					
					
									
						// Pay stay Promotion
						
						$paystaypromotion=mysql_query("select * from hotel_paystaypromo where '".$newdate."' between ratefrom and rateto and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
						
						$fetch_holidaypromotion=mysql_fetch_array($paystaypromotion);				
						$fetch_stay=$fetch_holidaypromotion['stay'];
						$breakfast=$fetch_holidaypromotion['breakfast'];
						if($days>=$fetch_stay) {
						   $fetch_pay=$fetch_holidaypromotion['pay'];
						   $differenc=$fetch_stay-$fetch_pay;
						   $differencmarkup=$differenc*$totalpricemarkup;
						   
						   
						   if($breakfast=='yes'){
						 	  $breakrate=$fetch_holidaypromotion['breakrate'];
						  	  $breakmarkup=$fetch_holidaypromotion['breakmarkup'];
							  $totalbreak= $breakrate+ $breakmarkup;
						   }
						   
					   }
						
					// Weekend promo
						
						$weekdaysurcharge=mysql_query("select * from hotel_priceweekendpromo where '".$newdate."' between ratefrom and rateto and '".$day_of_the_week1."' between weekdayfrom and weekdaytill and  HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
						if ($weekdaysurcharge)
						{
						$fetch_weekdaysurcharge=mysql_fetch_array($weekdaysurcharge);				
						$weekdayfrom=$fetch_weekendpromo['weekdayfrom'];
						$weekdaytill=$fetch_weekendpromo['weekdaytill'];
							$weekendrate=$fetch_weekendpromo['weekendrate'];
							$totalprice2=$totalprice/$discountpricerate;
							$totalprice=$totalprice-$totalprice2;
						}
					
					
					// Weekday surcharge
						
						$weekendpromo=mysql_query("select * from hotel_room_price where '".$newdate."' between ratefrom and rateto and '".$day_of_the_week1."' between weekdayfrom and weekdaytill  and HotelCode='".$cart_result[0]->HotelCode."' and Roomcode='".$cart_result[0]->RoomCode."'");
						
						$fetch_weekendpromo=mysql_fetch_array($weekendpromo);	
						$weeksurcharge=$fetch_weekendpromo['surcharge']; 			
						$totalprice=$totalprice+$weeksurcharge;
					
						
						  ?>
                      
                       <div style="width: 245px;float:left;margin-left: 10px; margin-top:5px; margin-bottom:5px;">&nbsp;<strong style=" color: #333333;
    font-size: 11px;
    line-height: 15px;" ><?php echo $date->format('Y-m-d');?> </strong></div>
                          <div style="width: 245px;float:right; margin-top:5px;margin-bottom:5px;" >&nbsp;<strong style="    color: #333333;
    font-size: 11px;
    line-height: 15px;" ><?php //echo $totalpricemarkup;?> &nbsp; &nbsp;<?php echo $currencysg." ".$totalprice;
	
	 $amount +=floatval($totalprice);
	
	?>
    
    
	<?php //if ($fetch_holidaysur!=""){ echo "&nbsp;&nbsp;&nbsp;Holiday Surcharge:".$fetch_holidaysur; } ?><?php //if ($discountrate!=""){ echo "&nbsp;&nbsp;&nbsp;Discount Rate:".$discountrate. "%"; } ?><?php // if ($discountpricerate!=""){ echo "&nbsp;&nbsp;&nbsp;Discount Price Rate:".$discountpricerate; } ?></strong></div>
                           <?php }?> 
                              </div>
                        </div>
                        <div style="float:right; font-size:20px; color:#2981BC; font-weight:bold;">  </div>
                        
                   
                                    </div>
                  <form method="post"  name="formlog" class='form-horizontal bbq wizard' id="formlog">   
                    <script>
					  function showdinner(str)
					  {
						 
						if (str=="")
						{
							document.getElementById("txtHint").innerHTML="";
							return;
						} 
						if(!dinner.checked){
							document.getElementById("txtHint").innerHTML="";
							//var TotalAmt=document.getElementById("totalamountold").value;			 			document.getElementById("totalamount").value=TotalAmt;
							
							
							var dinneramount=document.getElementById("amountdinner").value;                      var TotalAmt=document.getElementById("totalamount").value;
							document.getElementById("totalamount").value=parseFloat(TotalAmt)-parseFloat(dinneramount);
							return;	
							}
										
					if(dinner.checked){
												
					  if (window.XMLHttpRequest)
						{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
						}
					  else
						{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
					  xmlhttp.onreadystatechange=function()
						{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						  {
						  document.getElementById("txtHint").innerHTML=xmlhttp.responseText;             
						var TotalAmt=document.getElementById("totalamount").value;
						var valueajax=document.getElementById("txtHint").innerHTML;
						document.getElementById("totalamount").value=parseFloat(TotalAmt)+parseFloat(valueajax);
						document.getElementById("amountdinner").value=document.getElementById("txtHint").innerHTML;
						  }
						}
					  xmlhttp.open("GET","<?php echo base_url(); ?>dinner.php?q="+str,true);
					  xmlhttp.send();
					  }}
					//lunch   
				  function showlunch(str)
					  {
						 
						if (str=="")
						{
							document.getElementById("txtHint1").innerHTML="";
							return;
						} 
						if(!lunch.checked){
							document.getElementById("txtHint1").innerHTML="";
							var lunchamount=document.getElementById("amountlunch").value;                      var TotalAmt=document.getElementById("totalamount").value;
							document.getElementById("totalamount").value=parseFloat(TotalAmt)-parseFloat(lunchamount);
							return;	
						}
										
					if(lunch.checked){
					  if (window.XMLHttpRequest)
						{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
						}
					  else
						{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
					  xmlhttp.onreadystatechange=function()
						{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						  {
						  document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
							var TotalAmt=document.getElementById("totalamount").value;
							var valueajax=document.getElementById("txtHint1").innerHTML;					document.getElementById("totalamount").value=parseFloat(TotalAmt)+parseFloat(valueajax);
							document.getElementById("amountlunch").value=document.getElementById("txtHint1").innerHTML;
							
						  
						  }
						}
					  xmlhttp.open("GET","<?php echo base_url(); ?>lunch.php?q="+str,true);
					  xmlhttp.send();
					  }}
					
					//extrabed for child
					
					 function showchild(str)
					  {
						 
						if (str=="")
						{
							document.getElementById("txtHint2").innerHTML="";
							return;
						} 
						if(!extrabedchild.checked){
							 document.getElementById("txtHint2").innerHTML="";
							 var bedchild=document.getElementById("bedchild").value;                    		 var TotalAmt=document.getElementById("totalamount").value;							 document.getElementById("totalamount").value=parseFloat(TotalAmt)-parseFloat(bedchild);
							return;	
						}
										
					if(extrabedchild.checked){
					  if (window.XMLHttpRequest)
						{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
						}
					  else
						{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
					  xmlhttp.onreadystatechange=function()
						{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						  {
						  document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
						 	var TotalAmt=document.getElementById("totalamount").value;
							var valueajax=document.getElementById("txtHint2").innerHTML;					document.getElementById("totalamount").value=parseFloat(TotalAmt)+parseFloat(valueajax);
							document.getElementById("bedchild").value=document.getElementById("txtHint2").innerHTML;
						  }
						}
					  xmlhttp.open("GET","<?php echo base_url(); ?>childbed.php?q="+str,true);
					  xmlhttp.send();
					  }}
					
					
					//extrabed for adult
					
					 function showadult(str)
					  {
						 
						if (str=="")
						{
							document.getElementById("txtHint3").innerHTML="";
							return;
						} 
						if(!extrabedadult.checked){
							document.getElementById("txtHint3").innerHTML="";
							 var bedadult=document.getElementById("bedadult").value;                    		 var TotalAmt=document.getElementById("totalamount").value;							 document.getElementById("totalamount").value=parseFloat(TotalAmt)-parseFloat(bedadult);
							return;	
						}
										
					if(extrabedadult.checked){
					  if (window.XMLHttpRequest)
						{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
						}
					  else
						{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
					  xmlhttp.onreadystatechange=function()
						{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						  {
						  document.getElementById("txtHint3").innerHTML=xmlhttp.responseText; 			  var TotalAmt=document.getElementById("totalamount").value;
						  var valueajax=document.getElementById("txtHint3").innerHTML;					document.getElementById("totalamount").value=parseFloat(TotalAmt)+parseFloat(valueajax);  					  document.getElementById("bedadult").value=document.getElementById("txtHint3").innerHTML;
							
						  }
						}
					  xmlhttp.open("GET","<?php echo base_url(); ?>adultbed.php?q="+str,true);
					  xmlhttp.send();
					  }}
					
					
					  </script>
                      
                      
                    <div class="clear"></div>
                       <div style="float:left; font-size:20px; color:#2981BC; font-weight:bold;"><input type="checkbox"  onClick="showdinner(this.value)" name="dinner" id="dinner" value="<?php echo $cart_result[0]->HotelCode;?>">Dinner<br>
                       <input type="checkbox" name="lunch" value="<?php echo $cart_result[0]->HotelCode;?>" id="lunch" onClick="showlunch(this.value)">Lunch<br>
                       <input type="checkbox" value="<?php echo $cart_result[0]->HotelCode;?>"  id="extrabedchild" name="extrabedchild" onClick="showchild(this.value)">Extra Bed  for child<br>
                        <input type="checkbox" value="<?php echo $cart_result[0]->HotelCode;?>" id="extrabedadult" name="extrabedadult" onClick="showadult(this.value)">Extra Bed  for Adult</div><br>
                      <?php }?>
                      
                   </form>  
                    <!--select room part-->
                    <div>
                    <div style="margin-top: 16px; border-radius: 6px; padding:5px 10px 10px 10px; height: auto; float: left; width: 519px; background: #FFF; border: 1px dotted rgb(216, 109, 11);">
                    
 <div class="prc_bg"><span style="color:red;font-size: 11px;
font-weight: bold;">Hotel Price :  </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#333;font-size: 11px;
font-weight: bold;"><?php if($amount!='') {echo $amount;} else { ?><?php  echo $cart_result[0]->Currency.'  '.$cart_result[0]->AvgPrice?> (* Per day) <?php }?></span></div></br>
   
   
   <div class="prc_bg">
    <span style="color:red;font-size: 11px;
font-weight: bold;">Per Room Price  :  </span>&nbsp;&nbsp;<span style="color:#333;font-size: 11px;
font-weight: bold">
<?php if($cart_result[0]->Rate==''){
$cart_result[0]->Rate=$cart_result[0]->AvgPrice;
}  else
$cart_result[0]->Rate=$cart_result[0]->Rate;

 ?>

<?php  echo $cart_result[0]->Currency.' '.$cart_result[0]->Rate?></span></div></br>

<div class="prc_bg">
     <span style="color:red;font-size: 11px;
font-weight: bold;">Room Count :  </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#333;font-size: 11px;
font-weight: bold"><?php  echo $_SESSION['hotel_search']['room_count']?></span></div></br>
    <?php $tota=$_SESSION['hotel_search']['room_count']*$cart_result[0]->Rate;?>
    
  <div class="prc_bg">  
    <span style="color:red;font-size: 11px;
font-weight: bold;">Price :  </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;&nbsp;&nbsp;&nbsp;<span style="color:#333;font-size: 13px;
font-weight: bold"><?php if($amount!='') {echo $_SESSION['hotel_search']['room_count'].'*'. $amount;}  else {?><?php  echo $_SESSION['hotel_search']['room_count'].'*'.$cart_result[0]->Rate.' '. $cart_result[0]->Currency; }?></span></div></br>

 					 <div class="prc_bg">  
    <span style="color:red;font-size: 11px;
font-weight: bold;">Dinner : </span><span id="txtHint"></span></div>

                    <div class="prc_bg">  
    <span style="color:red;font-size: 11px;
font-weight: bold;">  Lunch:</span><span id="txtHint1"></span></div>
                    <div class="prc_bg">  
    <span style="color:red;font-size: 11px;
font-weight: bold;"> Extra Bed For Child: </span><span id="txtHint2"></span></div>
                <div class="prc_bg">  
    <span style="color:red;font-size: 11px;
font-weight: bold;">      Extra Bed For Adult:</span><span id="txtHint3"></span></div>
                     
                     <input type="hidden" name="amountlunch" id="amountlunch" value=""><input type="hidden" name="amountdinner" id="amountdinner" value=""><input type="hidden" name="bedchild" id="bedchild" value=""><input type="hidden" name="bedadult" id="bedadult" value="">
<div class="prc_bg"> 
    <span style="color:red;font-size: 11px;
font-weight: bold;" id="test">Total Price  :  </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#333;font-size: 11px;
font-weight: bold"><?php if($amount!='') {
	$pric=$_SESSION['hotel_search']['room_count']* $amount;
	$totalam=$pric-$differencmarkup ;
	if (isset($dinnerprice, $_SESSION))
	{
		$final = $totalam + $_SESSION['dinnerprice'];
	}
	else
	{
		$final = $totalam;
	}
	
	//echo $totalam ;
	} else {  ?><?php  echo $cart_result[0]->Currency.'   '.$cart_result[0]->Rate?><?php }?><?php if($differencmarkup!=''){ ?> PAY-STAY PROMOTIONS:<?php echo $differencmarkup;}?> <input type="text" name="totalamount" id="totalamount" value="<?php echo $totalam ; ?>" readonly><!--<input type="hidden" name="totalamountold" id="totalamountold" value="<?php echo $totalam ;?>"> --></span></div>
  <?php if($totalbreak!='') {  ?>
    <div class="prc_bg"> 
    <span style="color:red;font-size: 11px;
font-weight: bold;">Breakfast not included for free night  :  </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#333;font-size: 11px;
font-weight: bold"><?php
	$pric=$_SESSION['hotel_search']['room_count']* $amount;
	
	echo $totalam1=$totalam+$totalbreak ;} ?></span></div>
    
    
                    </div>
                    
                        <div class="clear_space1"></div>
                    </div>
                    <!--select room part-->
                    <div class="clear"></div>
                    <div class="padding5 border_bottom3"></div>
                </div>
                <div class="clear"></div>
                
                <div class="clear_space1"></div>
                
                 <div style="width:728px;" class="right_main_bar top10">
                    <div class="fleft left20"> &nbsp;Continue Booking</div>
              
                <?php /* echo base_url() ?>home/payment_load/<?php echo $tota?>/<?php echo $cart_result[0]->id */?>
                <form method="post" action="<?php echo base_url() ?>index.php/home/payment_load/<?php echo $tota ?>/<?php echo $cart_result[0]->id ?>"  name="member_login" class='form-horizontal bbq wizard' id="member_payment">
                 <?php
	//echo '<pre/>';
	//print_r($cart_result);
		$room_infof = $cart_result[0]->id;
		$room_count = $_SESSION['hotel_search']['room_count'];
		$room_type = $cart_result[0]-> RoomName ;
		$inclusion = $cart_result[0]->Inclusion;
		$adult =$_SESSION['hotel_search']['adult'];
		$child =$_SESSION['hotel_search']['child'];?>
		
		 
              
               <div class="top30 fleft left20">
                   
                   <div style="width: 100%; float: left;">
                    <label ><span style="#FF0000;">Guest Details</span></label></br>
				 <?php   for($i=0;$i< count($room_infof); $i++)
		  {
			
				  for($j=0;$j<  $adult[$i]; $j++)
		  {
			  ?>
                       <div style="width: 100%; float: left;">
                       
                       <div style="width: 700px; float: left;">
                      <div style="width: 90px; float: left;">
                               <label><font color="#000">Salutation</font></label>
                               <select name="title[]" id="title">
                                   <option value="Mr">Mr</option>
                                   <option value="Ms">Ms</option>
                               </select>
                           </div>
                           <div style="width: 200px; float: left;">
                           <label><font color="#000">First Name</font></label>
    <input type="text" name="fname[]" id="fname" required placeholder="first name">
                           </div>
                           <div style="width: 200px; float: left;">
                           <label><font color="#000">Last Name</font></label>
    <input type="text" name="lanme[]" id="laname" required placeholder="last name">
                           </div>
                           <div style="width: 90px; float: left;">
                           <label><font color="#000">No of Child</font></label>
                           <select name="noofchild[]" id="title">
                                   <option value="0">0</option>
                                   <option value="1">1</option>
                                   <option value="2">2</option>
                                   
                               </select>
    
                           </div>
                           <div style="width: 90px; float: left;">
                           <label><font color="#000">Child Age</font></label>
    <select name="childage[]" id="title">
                                   <option value="0">0</option>
                                   <option value="1">1</option>
                                   <option value="2">2</option>
                                   <option value="3">3</option>
                                   <option value="4">4</option>
                                   <option value="5">5</option>
                                   <option value="6">6</option>
                                   <option value="7">7</option>
                               </select>
                           </div>
                   </div>
                       </div>
                       <?php }}?>
                       <div style="width: 100%; float: left;">
                       <label><strong style="#FF0000;"><font color="#000">Guest Contact Details</font></strong></label>
                       </div>
                       </br>
                       <div style="width: 90px; float: left;">
                                <label><font color="#000">Salutation</font></label>
                               <select name="title[]" id="title">
                                   <option value="Mr">Mr</option>
                                   <option value="Ms">Ms</option>
                               </select>
                   </div>
                       
                       </div>
                   <div style="width: 100%; float: left;">
                    
                       <div style="width: 200px; float: left;">
                        <label><font color="#000">First Name</font></label>
                   </div>
                       <div style="width: 400px; float: left;">
                      <input type="text" name="firstname" required id="mobile" placeholder="First Name">
                   </div>
                       </div>
                                          <div style="width: 100%; float: left;">
                    
                       <div style="width: 200px; float: left;">
                        <label><font color="#000">Last Name</font></label>
                   </div>
                       <div style="width: 400px; float: left;">
                      <input type="text" name="lastname" required id="mobile" placeholder="Last Name">
                   </div>
                       </div>
                                          <div style="width: 100%; float: left;">
                    
                       <div style="width: 200px; float: left;">
                        <label><font color="#000">Mobile No</font></label>
                   </div>
                       <div style="width: 400px; float: left;">
                      <input type="text" name="mobile" required id="mobile" placeholder="Mobile No">
                   </div>
                       </div>
                       <div style="width: 100%; float: left;">
                       <div style="width: 200px; float: left;">
                        <label><font color="#000">Email Id</font></label>
                   </div>
                       <div style="width: 400px; float: left;">
                      <input type="email" name="email" required id="eamil" placeholder="Type something">
                   </div>
                       </div>
                       <div style="width: 100%; float: left;">
                       <div style="width: 200px; float: left;">
                        <label><font color="#000">Address</font></label>
                   </div>
                       <div style="width: 400px; float: left;">
                      <textarea type="text" name="address" required id="address"></textarea>
                   </div>
                       </div>
                       <div style="width: 100%; float: left;">
                       <div style="width: 200px; float: left;">
                        <label><font color="#000">Special Request</font></label>
                   </div>
                       <div style="width: 400px; float: left;">
                      <input type="text" name="special" required id="special" placeholder="Type something">
                   </div>
                       </div>
<div style="width: 100%; float: left;">
                       <div style="width: 200px; float: left;">
                        <label> <font color="#000">Nationality </font></label>
                   </div>
                       <div style="width: 400px; float: left;">
                      <!--<select name="nationality" style="width: 168px;">
  <option value="SG">Singapore</option>
</select>-->


<select name="nationality" style="width: 168px;">
                                    <option value="AF"> Afghanistan </option>
                                    <option value="AL"> Albania </option>
                                    <option value="DZ"> Algeria </option>
                                    <option value="AG"> Antigua and Barbuda </option>
                                    <option value="AR"> Argentina </option>
                                    <option value="AM"> Armenia </option>
                                    <option value="AW"> Aruba </option>
                                    <option value="AU"> Australia </option>
                                    <option value="AT"> Austria </option>
                                    <option value="AZ"> Azerbaijan </option>
                                    <option value="BS"> Bahamas </option>
                                    <option value="BH"> Bahrain </option>
                                    <option value="BD"> Bangladesh </option>
                                    <option value="BB"> Barbados </option>
                                    <option value="BY"> Belarus </option>
                                    <option value="BE"> Belgium </option>
                                    <option value="BZ"> Belize </option>
                                    <option value="BJ"> Benin </option>
                                    <option value="BM"> Bermuda </option>
                                    <option value="BO"> Bolivia </option>
                                    <option value="BA"> Bosnia and Herzegovina </option>
                                    <option value="BW"> Botswana </option>
                                    <option value="BR"> Brazil </option>
                                    <option value="BN"> Brunei </option>
                                    <option value="BG"> Bulgaria </option>
                                    <option value="KH"> Cambodia </option>
                                    <option value="CM"> Cameroon </option>
                                    <option value="CA"> Canada </option>
                                    <option value="KY"> Cayman Islands </option>
                                    <option value="TD"> Chad </option>
                                    <option value="CL"> Chile </option>
                                    <option value="CN"> China </option>
                                    <option value="CO"> Colombia </option>
                                    <option value="CK"> Cook Islands </option>
                                    <option value="CR"> Costa Rica </option>
                                    <option value="CI"> Cote dIvoire </option>
                                    <option value="HR"> Croatia </option>
                                    <option value="CU"> Cuba </option>
                                    <option value="CY"> Cyprus </option>
                                    <option value="CZ"> Czech Republic </option>
                                    <option value="DK"> Denmark </option>
                                    <option value="DJ"> Djibouti </option>
                                    <option value="DO"> Dominican Republic </option>
                                    <option value="EC"> Ecuador </option>
                                    <option value="EG"> Egypt </option>
                                    <option value="SV"> El Salvador </option>
                                    <option value="GQ"> Equatorial Guinea </option>
                                    <option value="EE"> Estonia </option>
                                    <option value="ET"> Ethiopia </option>
                                    <option value="FJ"> Fiji </option>
                                    <option value="FI"> Finland </option>
                                    <option value="FR"> France </option>
                                    <option value="GF"> French Guiana </option>
                                    <option value="PF"> French Polynesia </option>
                                    <option value="GA"> Gabon </option>
                                    <option value="GE"> Georgia </option>
                                    <option value="DE"> Germany </option>
                                    <option value="GH"> Ghana </option>
                                    <option value="GI"> Gibraltar </option>
                                    <option value="GR"> Greece </option>
                                    <option value="GL"> Greenland </option>
                                    <option value="GD"> Grenada </option>
                                    <option value="GP"> Guadeloupe </option>
                                    <option value="GU"> Guam </option>
                                    <option value="GT"> Guatemala </option>
                                    <option value="GN"> Guinea </option>
                                    <option value="HN"> Honduras </option>
                                    <option value="HK"> Hong Kong </option>
                                    <option value="HU"> Hungary </option>
                                    <option value="IS"> Iceland </option>
                                    <option value="IN"> India </option>
                                    <option value="ID"> Indonesia </option>
                                    <option value="IR"> Iran </option>
                                    <option value="IQ"> Iraq </option>
                                    <option value="IE"> Ireland </option>
                                    <option value="IL"> Israel </option>
                                    <option value="IT"> Italy </option>
                                    <option value="JM"> Jamaica </option>
                                    <option value="JP"> Japan </option>
                                    <option value="JO"> Jordan </option>
                                    <option value="KZ"> Kazakhstan </option>
                                    <option value="KE"> Kenya </option>
                                    <option value="KR"> Korea, South </option>
                                    <option value="KW"> Kuwait </option>
                                    <option value="KG"> Kyrgyzstan </option>
                                    <option value="LA"> Laos </option>
                                    <option value="LV"> Latvia </option>
                                    <option value="LB"> Lebanon </option>
                                    <option value="LS"> Lesotho </option>
                                    <option value="LR"> Liberia </option>
                                    <option value="LY"> Libya </option>
                                    <option value="LT"> Lithuania </option>
                                    <option value="LU"> Luxembourg </option>
                                    <option value="MO"> Macau </option>
                                    <option value="MK"> Macedonia </option>
                                    <option value="MW"> Malawi </option>
                                    <option value="MY"> Malaysia </option>
                                    <option value="MV"> Maldives </option>
                                    <option value="ML"> Mali </option>
                                    <option value="MT"> Malta </option>
                                    <option value="MU"> Mauritius </option>
                                    <option value="MX"> Mexico </option>
                                    <option value="FM"> Micronesia </option>
                                    <option value="MD"> Moldova </option>
                                    <option value="MC"> Monaco </option>
                                    <option value="MN"> Mongolia </option>
                                    <option value="MS"> Montserrat </option>
                                    <option value="MA"> Morocco </option>
                                    <option value="MZ"> Mozambique </option>
                                    <option value="MM"> Myanmar </option>
                                    <option value="NA"> Namibia </option>
                                    <option value="NP"> Nepal </option>
                                    <option value="NL"> Netherlands </option>
                                    <option value="AN"> Netherlands Antilles </option>
                                    <option value="NC"> New Caledonia </option>
                                    <option value="NZ"> New Zealand </option>
                                    <option value="NI"> Nicaragua </option>
                                    <option value="NG"> Nigeria </option>
                                    <option value="NU"> Niue </option>
                                    <option value="NF"> Norfolk Island </option>
                                    <option value="MP"> Northern Mariana Islands </option>
                                    <option value="NO"> Norway </option>
                                    <option value="OM"> Oman </option>
                                    <option value="PK"> Pakistan </option>
                                    <option value="PW"> Palau </option>
                                    <option value="PA"> Panama </option>
                                    <option value="PG"> Papua New Guinea </option>
                                    <option value="PY"> Paraguay </option>
                                    <option value="PE"> Peru </option>
                                    <option value="PH"> Philippines </option>
                                    <option value="PL"> Poland </option>
                                    <option value="PT"> Portugal </option>
                                    <option value="PR"> Puerto Rico </option>
                                    <option value="QA"> Qatar </option>
                                    <option value="RO"> Romania </option>
                                    <option value="RU"> Russia </option>
                                    <option value="RW"> Rwanda </option>
                                    <option value="LC"> Saint Lucia </option>
                                    <option value="WS"> Samoa </option>
                                    <option value="SA"> Saudi Arabia </option>
                                    <option value="SN"> Senegal </option>
                                    <option value="SC"> Seychelles </option>
                                    <option value="SG"> Singapore </option>
                                    <option value="SK"> Slovakia </option>
                                    <option value="SI"> Slovenia </option>
                                    <option value="SB"> Solomon Islands </option>
                                    <option value="ZA"> South Africa </option>
                                    <option value="ES"> Spain </option>
                                    <option value="LK"> Sri Lanka </option>
                                    <option value="SD"> Sudan </option>
                                    <option value="SZ"> Swaziland </option>
                                    <option value="SE"> Sweden </option>
                                    <option value="CH"> Switzerland </option>
                                    <option value="SY"> Syria </option>
                                    <option value="TW"> Taiwan </option>
                                    <option value="TJ"> Tajikistan </option>
                                    <option value="TZ"> Tanzania </option>
                                    <option value="TH"> Thailand </option>
                                    <option value="TG"> Togo </option>
                                    <option value="TO"> Tonga </option>
                                    <option value="TT"> Trinidad and Tobago </option>
                                    <option value="TN"> Tunisia </option>
                                    <option value="TR"> Turkey </option>
                                    <option value="TM"> Turkmenistan </option>
                                    <option value="TC"> Turks and Caicos Islands </option>
                                    <option value="UG"> Uganda </option>
                                    <option value="UA"> Ukraine </option>
                                    <option value="AE"> United Arab Emirates </option>
                                    <option value="GB"> United Kingdom </option>
                                    <option value="US"> United States </option>
                                    <option value="UY"> Uruguay </option>
                                    <option value="UZ"> Uzbekistan </option>
                                    <option value="VU"> Vanuatu </option>
                                    <option value="VE"> Venezuela </option>
                                    <option value="VN"> Vietnam </option>
                                    <option value="YE"> Yemen </option>
                                    <option value="ZM"> Zambia </option>
                                    <option value="ZW"> Zimbabwe </option>
                                  </select>


                   </div>
                       </div>
                   </div>
    <input type="submit" value="Continue Booking" id="next2"  style=" -moz-border-bottom-colors: none; -moz-border-left-colors: none;  -moz-border-right-colors: none; -moz-border-top-colors: none; background: -moz-linear-gradient(center top , #009CFF, #0066A6) repeat scroll 0 0 transparent; border-color: #009CFF #0286DA #0066A6; border-image: none; border-radius: 3px 3px 3px 3px; border-style: solid; border-width: 1px;box-shadow: 0 0 1px 0 rgba(255, 255, 255, 0), 0 0 0 1px rgba(255, 255, 255, 0) inset, 0 1px 0 0 #009CFF;color: #FFFFFF;cursor: pointer;display: inline-block;font-size: 15px;line-height: normal; padding: 7px 10px;text-align: center;text-decoration: none;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.44);transition: box-shadow 0.15s ease 0s;white-space: nowrap;background-color: #1c699d;float: right;"/>

</form></div>


<div style="width:728px;float:left;margin-top: 20px;" class="right_main_bar top10">
                    <div class="fleft left20"> &nbsp;Proceed to Payment</div>
                </div>


<div style="background-color: #FFF;margin-left:10px;margin-left: 125px;
border-radius: 10px;margin-bottom:10px;" class="top10 fleft left60">
                    
                    <form name="user_form" id="user_form" method="POST" action="<?php echo site_url(); ?>/home/pro_pre_booking/<?php echo $cart_result[0]->HotelCode; ?>/<?php echo $cart_result[0]->RoomCode; ?>" class='form-horizontal form-validate'>
                        <div class="top30 fleft left20">
                            <div class="flight_booking_header1"> Already Registered</div>
                            <div class="top30" style="margin-top:12px;"> Welcome back! Please log-in to your DSS DEMO ONLINE <br />
                                account by entering your e-mail and password to continue.</div>
                            <br />
                            <label class="top20">Username</label>
                            <span id="loading" style="display:none;"><img src="<?php echo base_url(); ?>assets/images/290.gif" width="20"  /></span>
                            <span style="display:none; margin-left:10px; color:#BF0000" id="usemail_pwd">Please enter email id you have registered with us</span><br />
                            <input type="text" name="user_name" id="user_name" value="" style="margin-top:5px;" class="flight_booking_inputbox validate[required,custom[email]]"  />
                            <?php /*?><br /><?php echo form_error('user_name'); ?><?php */?>
                            
                            <br />
                            <label class="top20">Password</label><br />
                            <input type="password" name="user_password" style="margin-top:5px;" value="" class="flight_booking_inputbox validate[required]" />
                            <?php /*?><br><?php echo form_error('user_password'); ?><?php */?>
                            <input type="hidden" name="user_booking" value="user_booking" />
                            <div class="clear"></div>
                            <button class="flight_booking_redbtn top20 fleft"> Login </button>
                            <div class="top30 fright" style="margin-right:150px; cursor:pointer;"><span class="forgotpassword" onClick="forgot_password();">Forgot Password</span></div>
                        </div>
                    </form>
              
                
                <div class="clear_space1"></div>
                 
<!--                <div class="float_left font_size18"><span class="color_blue1">Booking Conditions</span></div>
                <div class="float_right font_size18"><span class="color_blue1">Cancellation Policy</span></div

 </div>
                
                <div class="clear_space1"></div>
                 <!--<div style="width:728px;" class="right_main_bar top10">
                    <div class="fleft left20"> &nbsp;Proceed to Payment</div>
                </div>-->
                
               
                      
                      <!--  <div style="background-color: #FFF;margin-left:10px;margin-left: 125px;
border-radius: 10px;"class="top30 fleft left20">
                    
                    <form name="user_form" id="user_form" method="POST" action="<?php echo site_url(); ?>/home/pro_pre_booking/<?php echo $cart_result[0]->HotelCode; ?>/<?php echo $cart_result[0]->RoomCode; ?>" class='form-horizontal form-validate'>
                        <div class="top30 fleft left20">
                            <div class="flight_booking_header1"> Already Registered</div>
                            <div class="top30" style="margin-top:12px;"> Welcome back! Please log-in to your DSS DEMO ONLINE <br />
                                account by entering your e-mail and password to continue.</div>
                            <br />
                            <label class="top20">Username</label>
                            <span id="loading" style="display:none;"><img src="<?php echo base_url(); ?>assets/images/290.gif" width="20"  /></span>
                            <span style="display:none; margin-left:10px; color:#BF0000" id="usemail_pwd">Please enter email id you have registered with us</span><br />
                            <input type="text" name="user_name" id="user_name" value="" style="margin-top:5px;" class="flight_booking_inputbox validate[required,custom[email]]"  />
                            <?php /*?><br /><?php echo form_error('user_name'); ?><?php */?>
                            
                            <br />
                            <label class="top20">Password</label><br />
                            <input type="password" name="user_password" style="margin-top:5px;" value="" class="flight_booking_inputbox validate[required]" />
                            <?php /*?><br><?php echo form_error('user_password'); ?><?php */?>
                            <input type="hidden" name="user_booking" value="user_booking" />
                            <div class="clear"></div>
                            <button class="flight_booking_redbtn top20 fleft"> Login </button>
                            <div class="top30 fright" style="margin-right:150px; cursor:pointer;"><span class="forgotpassword" onClick="forgot_password();">Forgot Password</span></div>
                        </div>
                    </form>
              
                
                <div class="clear_space1"></div>
                 
<!--                <div class="float_left font_size18"><span class="color_blue1">Booking Conditions</span></div>
                <div class="float_right font_size18"><span class="color_blue1">Cancellation Policy</span></div>-->
              <!--   <div class="clear"></div>
            </div>-->
            
            </div>
    </div>
    
    <div class="clear"></div>
</div><div class="clear"></div>
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
				 url: "http://192.168.0.110/WDM/singapore/index.php/home/check_sub",
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
    
<script class="secret-source">
		$(document).ready(function(){
			$("#contine_guest").validationEngine();
            $("#terms_check").validationEngine();
			$("#user_form").validationEngine();
	});
  
    </script>
<div id="lbOverlay" style="display: none;"></div><div id="lbCenter" style="display: none;"><div id="lbImage"><div style="position: relative;"><a href="#" id="lbPrevLink"></a><a href="#" id="lbNextLink"></a></div></div></div><div id="lbBottomContainer" style="display: none;"><div id="lbBottom"><a href="#" id="lbCloseLink"></a><div id="lbCaption"></div><div id="lbNumber"></div><div style="clear: both;"></div></div></div><div class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" id="ui-datepicker-div"></div></body><!--###########AUTO COMPLETE#############--></html>

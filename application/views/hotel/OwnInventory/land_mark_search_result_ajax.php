<?php
	$totalPriceAry = array();
	$latitude = $result->latitude;
	$longitude = $result->longitude;
	$address = preg_replace("/[^a-z0-9_-]/i", " ",  $result->Address).'   '.$result->Location.'   '.$result->PostalCode;
	if (!isset($_SESSION['center_coordinates']))
	{
		$_SESSION['center_coordinates']['latitude'] = $latitude;
		$_SESSION['center_coordinates']['longitude'] = $longitude;
	}
	$_SESSION['coordinates'][] = array('name'=>$result->HotelName,'latitude'=>$latitude,'longitude'=>$longitude, 'address'=>$address);
	$image = $result->FrontPgImage;
	$totalPriceAry[]=$result->AvgPrice;
	$currency = 'SGD';
	if($result->StarRating == '4'){
		$starimage='assets/images/dummy/star-active4.png';
		$starRating = 4;}
	if($result->StarRating == '3'){
	   
		$starimage = 'assets/images/dummy/star-active3.png';
		 $starRating = 3;}
	if($result->StarRating == '2'){
		$starimage='assets/images/dummy/star-active2.png';
		$starRating = 2;}
	if($result->StarRating == '1'){
		$starimage='assets/images/dummy/star-active1.png';
		$starRating = 1;}
	if($result->StarRating == '5'){
		$starimage = 'assets/images/dummy/star.png';
		$starRating = 5;}
	if($result->AvgPrice == ''){
	 $datetoday = date('Y-m-d');
		 $sel = "select * from hotel_room_price where HotelCode='".$result->HotelCode."' and rateto>='".$datetoday."' and ratefrom<='".$datetoday."' ORDER BY contractrate ASC limit 0,1";
		 $quer = mysql_query($sel);	
		 $fetch = mysql_fetch_array($quer);
		 $result->AvgPrice = $fetch['contractrate']+$fetch['roompricemarkup'];
		} else
		{
			$result->AvgPrice=$result->AvgPrice;
		}
			$link = 'index.php/hotel/hotel_details/'.$result->HotelCode.'/'.base64_encode('own');
		?>
<div class="bg_whight searchhotel_box margin_bottom10">
  <div class="padding10 HotelInfoBox" data-star="<?php echo $starRating; ?>" data-price="<?php echo $result->AvgPrice; ?>" data-hotel-name="<?php  echo $result->HotelName; echo preg_replace("/[^a-z0-9_-]/i", " ",  $result->HotelName); ?>" data-location="<?php echo $result->HotelName;?> ">
    <div class="padding5 text3">
      <div class="hotel_image"><a href="<?php echo base_url().$link; ?>" target=_blank><img src="<?php echo $image; ?>" width="140" height="140" style="border: none;" /></a></div>
      <div style="width: 480px; float: left;" class='box_change'>
      <div class="text12" style="color:#08427e; float:left;"> <a href="<?php echo base_url().$link;?>" target=_blank><?php echo $result->HotelName; ?><img src="<?php echo base_url().$starimage; ?>" style="border: none;"/></a></div>
      <div style="color:#535353; font-size:11px; float:left; width:480px; margin:5px 0px; word-wrap:break-word;"><?php echo  preg_replace("/[^a-z0-9_-]/i", " ",  $result->Address).'   '.$result->Location.'   '.$result->PostalCode; ?></div>
      <!-- <div class="stars<?php //echo $starRating; ?>"></div> -->
      <div class="clr_space"></div>
      </br>
      <div style="width:444px; float:left; color:#333; font-size:11px; line-height:15px;  margin-top:7px; margin-bottom:-7px; word-wrap:break-word;" class='box_change'> <strong>Description </strong><?php echo preg_replace("/[^a-z0-9_-]/i", " ",  substr($result->HotelDesc,0,200)); ?>
        <div class="clr"></div>
        <?php if (isset($result->distance)) { ?>
	<span style='font-weight:bold'><?php echo round($result->distance, 2); ?> km from <?php echo $land_mark_name; ?></span>
<?php } ?>
      </div>
      <div class="clr_space"></div>
      </br>
      </div>
      <div style="width: 114px; float: left;">
      <div class="hotel_price_part"> 
        <span class="text6" style="text-align:center; color: #B31111; font-size:19px;"><strong><?php echo 'SGD '; ?></strong><strong><?php echo $result->AvgPrice * $_SESSION['room_count']; ?></strong></span> 
        <span class="detail_txt1">  <br/>
    <a class="btnBook_instant " href="<?php echo base_url().$link; ?>">
    View More </a> </span> </div></div>
      <div class="clear"></div>
      <!--###############select room part###############################-->
      <div class="sam<?php echo $i; ?>" id="get_room<?php echo $i; ?>" style="display:none;" align="center">
        <div id="show_room_loading" style="display:none;margin:30px;" align="center"> <img src="<?php echo base_url(); ?>assets/images/loding_room.gif"></div>
      </div>
      <!--###############select room part################################-->
      <div class="clear"></div>
      <div class="padding5 border_bottom3"></div>
    </div>
  </div>
</div>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($totalPriceAry)) echo min($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($totalPriceAry)) echo max($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo '&#36;'; ?>" />
<input type="hidden" name="price" id="setCurrency" value="<?php if ($totalPriceAry) echo $totalPriceAry[0];?>" />
<input type="hidden" name="currency" id="setCurrency" value="<?php echo  $currency?>" />

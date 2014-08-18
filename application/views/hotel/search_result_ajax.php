<?php
	$room_count = $_SESSION['room_count'];
	$no_of_days = $_SESSION['days'];
	$own_inventory_hotel_list = $_SESSION['OwnInventoryHotelList'];
	if ($own_inventory)
	{
		//echo $own_inventory;
	}
	if (isset($result_data) && $result_data)
	{
		$ii = 0;
		$count_val = $total_record;
		foreach ($result_data as $i=>$v) 
		{
			$res_api = @$result_data[$i]['api'];
			$res_hotel_code = @$result_data[$i]['hotel_code'];
			$res_total_cost = @$result_data[$i]['total_cost'];
			$available = 'Instant';
			$api_table = 'get_permanent_details_v4_'.$res_api;
			$result = $this->Hotel_Model->$api_table($res_hotel_code);
			// echo $this->db->last_query();echo '<br>';
			if (isset($result->Hotel_name) && $result->Hotel_name !='')
			{
				if (in_array($result->Hotel_name, $own_inventory_hotel_list))
				{
					continue;
				}
				$image = $result->Hotel_thumbnail;
				$_SESSION['coordinates'][] = array('name'=>$result->Hotel_name,'latitude'=>$result->Hotel_latitude,'longitude'=>$result->Hotel_longitude, 'address'=>$result->Hotel_address);
				if ($image == '')
				{
					$image = base_url().'assets/images/img/noimagefound.jpg';
				}
				$totalPriceAry[] = $res_total_cost;
				$currency = 'SGD';
				$link = 'index.php/hotel/hotel_details/'.$res_hotel_code.'/'.base64_encode($res_api);
?>
				<div class="bg_whight searchhotel_box margin_bottom10">
				  <div class="padding10 HotelInfoBox" data-star="<?php echo $result->Hotel_star; ?>" data-price="<?php echo $res_total_cost; ?>" data-hotel-name="<?php  echo $result->Hotel_name; echo preg_replace("/[^a-z0-9_-]/i", " ",  $result->Hotel_name); ?>" data-location="<?php echo $result->Hotel_location;?> ">
						<div class="padding5 text3">
							<div class="hotel_image">
								<a href="<?php echo base_url().$link; ?>" target=_blank>
								
								<img src="<?php echo $image; ?>" width="140" height="140" style="border: none;" /></a>
							</div>
							<div class = "box_change" style="width: 480px; float: left;">
								<div class="text12" style="color:#08427e; float:left;"> <a href="<?php echo base_url().$link;?>" target=_blank><?php echo $result->Hotel_name; ?><img src="<?php echo base_url().'assets/images/dummy/star-active'.$result->Hotel_star.'.png'; ?>" style="border: none;"/></a></div>
								<div style="color:#535353; font-size:11px; float:left; width:480px; margin:5px 0px; word-wrap:break-word;">
									<?php if(isset($result->Hotel_postalcode) && !empty($result->Hotel_postalcode)) { ?>
										<?php echo  preg_replace("/[^a-z0-9_-]/i", " ",  $result->Hotel_address).'   '.$result->Hotel_location.'   '.$result->Hotel_postalcode; ?>
									<?php } else { ?>
										<?php echo  preg_replace("/[^a-z0-9_-]/i", " ",  $result->Hotel_address).'   '.$result->Hotel_location; ?>
									<?php } ?>
								</div>
					<div class="clr_space"></div>
				</br>
	<?php if(isset($result->Hotel_description) && !empty($result->Hotel_description)) { ?>
	<div class = "box_change" style="width:444px; float:left; color:#333; font-size:11px; line-height:15px;  margin-top:7px; margin-bottom:-7px; word-wrap:break-word;">
	 <strong>Description </strong><?php echo preg_replace("/[^a-z0-9_-]/i", " ",  substr($result->Hotel_description,0,200)); ?>
		<div class="clr"></div>
	</div>
	<?php } ?>
	<div class="clr_space"></div>
	</br>
   
	<div style=" float: left; font-size:12px; margin-top:5px; color:#0263BC;">
	 <?php if($result_data[$i]['freewifi']!='false' ){ ?><img src="<?php echo base_url(); ?>assets/images/icon_wifi.gif" />Free Wi-Fi<?php }?>
<?php if($result_data[$i]['bestdeal']=='True'){ ?>
								<div style=";text-align: center; float: left;color:#BB00D4;"><b>Best Deal!</b></div><?php }?>
	<?php if($result_data[$i]['promotion']!='' ){ ?><span style="color:red" ><strong>&nbsp;Enjoy <?php echo $result_data[$i]['promotion']; ?></strong></span><?php }?>
	
	</div>
				   <!-- <div style="width: 480px; float: left;margin-top: 25px;margin-left: 70px;color:black;"><strong>Promotion</strong></div>-->
							</div>
							<div style="width: 114px; float: left;">
							   <div class="hotel_price_part">
									<!--<span class="details_price_small_txt" style="color:#333;"><?php// echo 'SGD  '.$result[$i]->AvgPrice; ?></span><br />-->
									<span class="text6" style="text-align:center; color: #B31111; font-size:19px;"><strong><?php echo 'SGD '; ?></strong><strong><?php echo $res_total_cost; ?></strong></span>                
									<?php if(isset($result_data[$i]['max_price']) && !empty($result_data[$i]['max_price'])) { ?>
									<span style="font-family: arial; font-size: 15px; text-decoration: line-through; color: rgb(255, 115, 0);"> <?php echo $result_data[$i]['max_price']; ?> SGD<br></span>
									<?php } ?>
									<span class="detail_txt1">
									<br>
									<?php if($available=='Instant'){?>
									
									<a class="btnBook_instant " href="<?php echo base_url().$link; ?>">
									View More
									</a><?php }else{?>
									<a class="btnBook_request " href="<?php echo base_url().$link; ?>">
									View More
									</a><?php }?>
									<br>
									
									<?php if(ceil($result_data[$i]['re_score'])!='0'){ ?>
									<br> <div style="margin-top: 10px; font-weight: bold; font-size: 15px;"><img width="100px" src="<?php echo base_url().'assets/images/dummy/review_'.ceil($result_data[$i]['re_score']).'.png'; ?>"> SCORE <?php echo ceil($result_data[$i]['re_score']); ?> / 5 </div><?php }?>
									</span>

								</div>
							</div>
	
							<div class="clr_space"></div>
							 
							<div class="clear"></div>
							<!--###############select room part###############################-->
							<div class="sam<?php echo $i; ?>" id="get_room<?php echo $i; ?>" style="display:none;" align="center">
							  	<div id="show_room_loading" style="display:none;margin:30px;" align="center">
									<img src="<?php echo base_url(); ?>assets/images/loding_room.gif">
								</div>
							</div>
							<!--###############select room part################################-->
							<div class="clear"></div>
							<div class="padding5 border_bottom3"></div>
						</div>
					</div>
                 </div>
    <?php    
		}
	}
}
?>

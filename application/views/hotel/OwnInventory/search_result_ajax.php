<?php
		$totalPriceAry = array();
		//$result = $this->Hotelbeds_Model->fetch_search_result_all_id_all($_SESSION['hotel_search']['session_id']); 
		$result= $own_inventory;
		$_SESSION['OwnInventoryHotelList'] = '';
		//echo '<pre>';echo $result[0]->FrontPgImage;exit;
        for ($i=0; $i < count($result); $i++)
        {
			$_SESSION['OwnInventoryHotelList'][] = $result[$i]->HotelName;
			//list($latitude, $longitude) = explode(',', $result[$i]->geo_coordinates);
			$latitude = $result[$i]->latitude;
			$longitude = $result[$i]->longitude;
			$address = preg_replace("/[^a-z0-9_-]/i", " ",  $result[$i]->Address).'   '.$result[$i]->Location.'   '.$result[$i]->PostalCode;
			$_SESSION['coordinates'][] = array('name'=>$result[$i]->HotelName,'latitude'=>$latitude,'longitude'=>$longitude, 'address'=>$address);
			
				$image = $result[$i]->FrontPgImage;
				$totalPriceAry[]=$result[$i]->AvgPrice;
            //$currency = 'SGD';
            $currency = 'USD';
            if($result[$i]->StarRating=='4'){
				$starimage='assets/images/dummy/star-active4.png';
                $starRating=4;}
            if($result[$i]->StarRating=='3'){
               
                $starimage='assets/images/dummy/star-active3.png';
				 $starRating=3;}
            if($result[$i]->StarRating=='2'){
				$starimage='assets/images/dummy/star-active2.png';
                $starRating=2;}
            if($result[$i]->StarRating=='1'){
				$starimage='assets/images/dummy/star-active1.png';
                $starRating=1;}
            if($result[$i]->StarRating=='5'){
				$starimage='assets/images/dummy/star.png';
                $starRating=5;}
				if($result[$i]->AvgPrice==''){
					 $datetoday=date('Y-m-d');
				 $sel="select * from hotel_room_price where HotelCode='".$result[$i]->HotelCode."' and rateto>='".$datetoday."' and ratefrom<='".$datetoday."' ORDER BY contractrate ASC limit 0,1";
				 $quer= mysql_query($sel);	
				 $fetch=mysql_fetch_array($quer);
				 $result[$i]->AvgPrice	=$fetch['contractrate']+$fetch['roompricemarkup'];
				} else
				{
					$result[$i]->AvgPrice=$result[$i]->AvgPrice;
				}
				
				
                //$link = 'hotels/hotel_details/'.$result[$i]->HotelCode;
                $link = 'index.php/hotel/hotel_details/'.$result[$i]->HotelCode.'/'.base64_encode('own');
                //$links = 'hotelbeds/hotel_availbility/'.$result[$i]->HotelCode;
                ?>

<div class="bg_whight searchhotel_box margin_bottom10">
  <div class="padding10 HotelInfoBox" data-star="<?php echo $starRating; ?>" data-price="<?php echo $result[$i]->AvgPrice; ?>" data-hotel-name="<?php  echo $result[$i]->HotelName; echo preg_replace("/[^a-z0-9_-]/i", " ",  $result[$i]->HotelName); ?>" data-location="<?php echo $result[$i]->HotelName;?> ">
    <div class="padding5 text3">
      <div class="hotel_image"><a href="<?php echo base_url().$link; ?>" target=_blank><img src="<?php echo $image; ?>" width="140" height="140" style="border: none;" /></a></div>
      <div style="width: 480px; float: left;" class='box_change'>
      <div class="text12" style="color:#08427e; float:left;"> <a href="<?php echo base_url().$link;?>" target=_blank><?php echo $result[$i]->HotelName; ?><img src="<?php echo base_url().$starimage; ?>" style="border: none;"/></a></div>
      <div style="color:#535353; font-size:11px; float:left; width:480px; margin:5px 0px; word-wrap:break-word;"><?php echo  preg_replace("/[^a-z0-9_-]/i", " ",  $result[$i]->Address).'   '.$result[$i]->Location.'   '.$result[$i]->PostalCode; ?></div>
      <!-- <div class="stars<?php //echo $starRating; ?>"></div> -->
      <div class="clr_space"></div>
      </br>
      <div style="width:444px; float:left; color:#333; font-size:11px; line-height:15px;  margin-top:7px; margin-bottom:-7px; word-wrap:break-word;" class='box_change'> <strong>Description </strong><?php echo preg_replace("/[^a-z0-9_-]/i", " ",  substr($result[$i]->HotelDesc,0,200)); ?>
        <div class="clr"></div>
      </div>
      <div class="clr_space"></div>
      </br>
      </div>
      <div style="width: 114px; float: left;">
      <div class="hotel_price_part"> 
        <span class="text6" style="text-align:center; color: #B31111; font-size:19px;"><strong><?php echo 'USD '; ?></strong><strong><?php echo $result[$i]->AvgPrice * $_SESSION['room_count']; ?></strong></span> 
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
<?php    
		}
		?>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($totalPriceAry)) echo min($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($totalPriceAry)) echo max($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo '&#36;'; ?>" />
<input type="hidden" name="price" id="setCurrency" value="<?php if ($totalPriceAry) echo $totalPriceAry[0];?>" />
<input type="hidden" name="currency" id="setCurrency" value="<?php echo  $currency?>" />
<?php
	//	}
	//	}
		//}     
?>
<script type="text/javascript">
	function getHotelRooms(id,hotel_code)
        {
            if(document.getElementById("get_room"+id).style.display=='none')
            {
                document.getElementById("get_room"+id).style.display='block';
                $.ajax({
                            url:"<?php echo site_url(); ?>/hotelbeds/getHotelRooms/",
                            data:"code="+hotel_code,
                            type: "GET",
                            dataType: "json",
                            beforeSend:function(){
                                  $("#show_room_loading").show();
                            },
                            success: function(data){
                                  $('#show_room_loading').hide();
                                  $("#get_room"+id).html(data.total_result);
                            },
                            error:function(request, status, error){

                            }
                      });
              }
              else
              {
                    document.getElementById("get_room"+id).style.display='none'
              }
        }
</script>
<style type="text/css">
.message {
    position: absolute;
    top: 100px;
    left: 0;
    width: 100%;
    text-align: center;
    opacity: 0;
    -webkit-transform: scale(.9, .9);
    -webkit-transition: all .18s ease-in-out;
}
.info:hover + .message {
    opacity: 1;
    -webkit-transform: scale(1, 1);
}
a { 
	text-decoration:none; 
	color:#f30000;
}

.post { margin: 0 auto; padding-bottom: 50px; float: left; width: 960px; }



.btn-sign a { color:#fff; text-shadow:0 1px 2px #161616; }

#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

.login-popup{
	display:none;
	background: #fff;
	padding: 10px; 	
	border: 2px solid #ddd;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top: 50%; left: 50%;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999;
	-moz-box-shadow: 0px 0px 20px #999; /* Firefox */
    -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
    -moz-border-radius: 3px; /* Firefox */
    -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close {
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#999; 
	font-size:11px; 
	line-height:18px;
} 

form.signin .textbox input { 
	background:#666666; 
	border-bottom:1px solid #333;
	border-left:1px solid #000;
	border-right:1px solid #333;
	border-top:1px solid #000;
	color:#fff; 
	border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
    -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:200px;
}
form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }
.button { 
	background: -moz-linear-gradient(center top, #f3f3f3, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#dddddd));
	background:  -o-linear-gradient(top, #f3f3f3, #dddddd);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#f3f3f3', EndColorStr='#dddddd');
	border-color:#000; 
	border-width:1px;
	border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
    -webkit-border-radius: 4px;
	color:#333;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:314px;
}
.button:hover { background:#ddd; }
</style>

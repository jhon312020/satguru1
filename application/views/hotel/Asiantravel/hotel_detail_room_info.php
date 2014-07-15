<?php
  $room_info_m1 = $this->Hotel_Model->fetch_temp_result_room($ses_id,$hotel_id_val);
 // echo '<pre/>';
//  print_r($room_info_m1);exit;
  ?>


        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody><tr>
                <td></td>
            </tr>
            <tr>
                
                <td width="50%" align="left" id="">
                    <table>
                        <tbody><tr>
                            <td width="2%"><img src="<?php echo base_url(); ?>assets/images/dummy/icon-cursor.gif"></td>
                            <td width="1%"><span style="vertical-align:top;"> - </span></td>
                            <td align="left"><span style="color:Red; font-size:10px" id="">Mouse over room rate for included items such as breakfast, perks, billing currency, T&amp;C etc...</span></td>
                        </tr>
                    </tbody></table>  
                </td>
    
                <td align="right" style="padding-right:7px;">
                    <b><span id="">Currency Converter</span> </b> 
                    <select class="qsb_select" id="" onchange="currency_converter(this.value)"  style="font-family:Arial;font-size:8pt;border-radius: 4px;
    color: #555555;
    display: inline-block;
    font-size: 14px;
    line-height: 20px;
    margin-bottom: 10px;
    padding: 4px 6px;
    vertical-align: middle;" name="">
	<option value="AUD">Australian Dollar (AUD)</option>
	<option value="BHD">Bahrain (BHD)</option>
	<option value="BWP">Botswana Pulas (BWP)</option>
	<option value="GBP">British Pound (GBP)</option>
	<option value="BND">Brunei Dollar (BND)</option>
	<option value="CAD">Canadian Dollar (CAD)</option>
	<option value="CNY">Chinese Yuan Renminbi (CNY)</option>
	<option value="EUR">Euro (EUR)</option>
	<option value="FJD">Fiji Dollar (FJD)</option>
	<option value="HKD">Hong Kong Dollar (HKD)</option>
	<option value="INR">India (INR)</option>
	<option value="IDR">Indonesia (IDR)</option>
	<option value="JPY">Japanese Yen (JPY)</option>
	<option value="JOD">Jordan (JOD)</option>
	<option value="KWD">Kuwait Dinar (KWD)</option>
	<option value="MOP">Macau Pataca (MOP)</option>
	<option value="MYR">Malaysia Ringgit (MYR)</option>
	<option value="MUR">Mauritius Rupees (MUR)</option>
	<option value="MAD">Morocco Dirhams (MAD)</option>
	<option value="MZN">Mozambican Metical  (MZN)</option>
	<option value="MMK">Myanmar Kyats (MMK)</option>
	<option value="NZD">New Zealand Dollar (NZD)</option>
	<option value="OMR">Oman (OMR)</option>
	<option value="PKR">Pakistan (PKR)</option>
	<option value="PHP">Philippine Peso (PHP)</option>
	<option value="QAR">Qatar (QAR)</option>
	<option value="RUB">Russian Ruble (RUB)</option>
	<option value="SAR">Saudi Arabia (SAR)</option>
	<option value="SGD" selected="selected">Singapore Dollar (SGD)</option>
	<option value="ZAR">South Africa (ZAR)</option>
	<option value="KRW">South Korean Won (KRW)</option>
	<option value="SEK">Sweden Kroner (SEK)</option>
	<option value="CHF">Switzerland Franc (CHF)</option>
	<option value="TWD">Taiwan (TWD)</option>
	<option value="THB">Thai Baht (THB)</option>
	<option value="TND">Tunisian Dollar (TND)</option>
	<option value="AED">United Arab Emirates Dirham  (AED)</option>
	<option value="USD">US Dollar (USD)</option>
	<option value="VND">Vietnamese Dong (VND)</option>

</select>
                </td>	
            </tr>
            
            <tr>
                
                <td width="50%" align="left" id="">&nbsp;
                      
                </td>
    
                <td align="right" style="padding-right:7px;">&nbsp;
                
                   
                    
                </td>	
            </tr>

 <tr>
                
                <td width="50%" align="left" id="">
                      
                </td>
    
                <td align="right" style="padding-right:7px;">
               
                   
                    
                </td>	
            </tr>

            

        </tbody></table>
        <div style="overflow:auto">
        	<?php
		if(isset($room_info_m1[0]) && $room_info_m1[0]!='')
		{
			?>
        <table border="0" cellspacing="0" cellpadding="2" style="border-collapse:collapse;" class="" id="">
	<tbody>
    
    
    <tr align="center" class="row_date2">
		<td class="rm_promotion rm_promotion_header">Room Type</td><td class="rm_book">Book</td>
        <?php

		$token0 = explode("||||",$room_info_m1[0]->token);
		//print_r($token);exit;
		for($k=0;$k<count($token0);$k++)
		{
			$tokenval0 = explode("^^^^",$token0[$k]);
			
			?>
        <td class="date dateprev"><?php echo date("D",strtotime($tokenval0[2])); ?><br><?php echo date("d",strtotime($tokenval0[2])); ?><br><?php echo date("M",strtotime($tokenval0[2])); ?></td>
        <?php
		}
		?>
	</tr>
      <tr align="center" class="row_date2" style="height:26px">
		<td class="rm_promotion rm_promotion_header">&nbsp;</td><td class="rm_book">&nbsp;</td>
        <?php
	
		for($k=0;$k< $_SESSION['room_count'];$k++)
		{
			?>
        <td class="date dateprev" style="border-top:1px solid #FFFFFF; " colspan="<?php echo $_SESSION['days']; ?>"> Room <?php echo $k+1 ; ?>
        </td>
        <?php
		}
		?>
	</tr>

        <?php 
								

   
if(isset($room_info_m1[0]))
{
	$count_price_id=0;	
for($t=0;$t<count($room_info_m1);$t++)
{
	$token = explode("||||",$room_info_m1[$t]->token);
	$promotion_b2='';
	if($room_info_m1[$t]->ShortNameaa!='')
	{
	$promotion_b1 = explode("||||",$room_info_m1[$t]->ShortNameaa);
	if($promotion_b1[0]!='')
	{
	$promotion_b2 = explode("^^^^",$promotion_b1[0]);
	}
	}
?>
    <tr class="table_header" id="">
		<td align="right" colspan="<?php echo count($token)+2; ?>" id="">
        <?php
		if($promotion_b2!='')
		{
		?>
        <a class="promolink" rev="iframe|350" rel="facebox" href="<?php echo base_url(); ?>index.php/api/promo/<?php echo $room_info_m1[$t]->api_temp_hotel_id; ?>">Promo Details</a>
        <?php
		}
		?>
        </td>
	</tr>
     
    <tr align="center" class="table_rate" id="">
		<td align="left" class="rm_promotion" id=""><b><?php echo $room_info_m1[$t]->room_type; ?></b><br>
        
        
       <span class="" > <a class="promolink" rev="iframe|350" rel="facebox" href="<?php echo base_url(); ?>index.php/api/get_asia_room_details/<?php echo $room_info_m1[$t]->hotel_code; ?>/<?php echo $room_info_m1[$t]->room_code; ?>/<?php echo $room_info_m1[$t]->room_code; ?>" style="text-decoration:underline; color:#0C6; font-size:10px">Room Info</a></span>
       <?php 
	   if($room_info_m1[$t]->WiFival == 'true')
	   {
		echo ' <img src="'.base_url().'assets/images/icon_wifi.gif"><span style="font-size:10px;color:#0263BC">Free-Wifi</span> ';
	   }
       ?>
       </td><td class="rm_book" id="">
        <span class="paymode">
        <?php
		if($promotion_b2!='')
		{
		?>
        <font color="green"><?php echo $promotion_b2[4]; ?></font></span>
        <?php
		}
		?><br>
        <a href="<?php echo base_url().'index.php/hotel/hotel_booking/'.$room_info_m1[$t]->api_temp_hotel_id.'/'.$room_info_m1[$t]->hotel_code; ?>" style="cursor:pointer">
         <?php
		if($room_info_m1[$t]->status=='Instant')
		{
		?>
       <span style="cursor:pointer; background-color:#2BBD00;" onclick="" class="book_new_btn">Book</span>
       <?php
		}
		elseif($room_info_m1[$t]->status=='OnRequest')
		{
			?>
             <span style="cursor:pointer; border:1px solid #DC0003; color:#fff; background-color:#DC0003;" onclick="" class="book_new_btn">OnRequest</span>
              <?php
			  
		}
		else
		{
			echo '-';
		}
		?>
		  
       
        </a>
        <br>
        <?php
		 $doscount= 0;
		if($promotion_b2!='')
		{
		?>
        <span class="paymode"><font color="green">Save <?php echo $promotion_b2[7]; ?>%</font></span>
         <?php
		 if($promotion_b2[7]!=0)
		 {
			 $doscount= $promotion_b2[7];
		 }
		}
		?>
      
        </td>
        
        <?php
		
		for($k=0;$k<count($token);$k++)
		{
			
			$tokenval = explode("^^^^",$token[$k]);
		
			$tip_text = '';
			$tip_text .= $tokenval[5].'<br>'.$room_info_m1[$t]->des_offer_value;
			
			?>
            
        <td class="rate_<?php echo trim($tokenval[4]); ?>" id="">
               <a style="text-decoration:none;" onmouseout="UnTip()" onmouseover="Tip('<?php echo $tip_text; ?>&lt;br /&gt;Billing Currency : SGD')"><span class="oldrate" id=""><?php
               if($doscount!=0)
			   {
			   echo '<input type="hidden"  id="price1_org'.$count_price_id.'" value="'.ceil((($tokenval[1]/100)*$doscount)+$tokenval[1]).'" ><span id="price1_'.$count_price_id.'">'.ceil((($tokenval[1]/100)*$doscount)+$tokenval[1]).'</span>';
			   }
			   else
			   {
				   echo '<input type="hidden"  id="price1_org'.$count_price_id.'" value="" ><span id="price1_'.$count_price_id.'"></span>';
			   }
			   ?></span><br><input type="hidden"  id="price_org<?php echo $count_price_id; ?>" value="<?php echo $tokenval[1]; ?>" ><span id="price<?php echo $count_price_id; ?>"><?php echo $tokenval[1]; ?></span></a></td>
               
             <?php
			 	$count_price_id++;
		}
		?>
	
	</tr>
    
    <?php
}
}
?>
</tbody></table>
<?php
		}
		else
		{
		echo '<div class="no_available" style="text-align:center"><h1>There are no available rooms for your stay. </h1><img src="'.base_url().'assets/images/no_hotel_img.png" width="154" height="154" /><br /><br /><div class="no_available_text" style="color:#333">Sorry, we have no prices for rooms in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div></div>'	;
		}
		?>
<input type="hidden" name="count_price_id" id="count_price_id" value="<?php if(isset($count_price_id)) { echo $count_price_id; } ?>" />
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tooltip/tooltip.js"></script>
<script>
 var baseurl = '<?php echo base_url(); ?>';
 </script>

 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/facebox.js"></script>
 <script>
jQuery(document).ready(function() {
    jQuery('a[rel*=facebox]').facebox()
  })
 
 </script>
<style>
.oldrate {
    color: #FF0000;
    text-decoration: line-through;
}
.book_new_btn
{
	 background-color:rgba(10,147,0,1.00);
    border: 1px solid #257300;
    border-radius: 5px;
    color: #fff;
    font-size: 12px;
    height: 25px;
    line-height: 21px;
    padding: 4px;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    width: 51px;
}
.row_date2 {
    background-color: #2C62CE;
    background-repeat: no-repeat;
    color: #FFFFFF;
    font-family: arial;
    font-size: 11px;
    font-weight: bold;
    height: 44px;
    margin-bottom: 10px;
    padding-bottom: 5px;
}
	.rm_promotion_header {
    padding-left: 10px;
    table-layout: fixed;
    text-align: left;
    width: 25%;
}

.rm_book {
    border-left: 1px solid #FFFFFF;
    text-align: center;
}

table.table_date tr td.date {
    border-right: 1px solid #FFFFFF;
    width: 5%;
}
.dateprev {
    border-left: 1px solid #FFFFFF;
    position: relative;
}

table.table_date tr td.date {
    border-right: 1px solid #FFFFFF;
    width: 5%;
}

tr.table_rate td.rm_promotion {
    color: #800080;
    width: 25%;
}
tr.table_rate td {
    border-bottom: 1px solid #FFFFFF;
}

tr.table_rate td.rm_book {
    width: 10%;
}
tr.table_rate td.rate_avail {
    background-color: #13EB7B;
    border-right: 1px solid #FFFFFF;
    padding: 3px;
    width: 5%;
}

tr.table_rate td.rate_request {
    background-color: #FF9933;
    border-right: 1px solid #FFFFFF;
    padding: 3px;
    width: 5%;
}
tr.table_rate td.rate_soldout {
    background-color: #FF4545;
    border-right: 1px solid #FFFFFF;
    padding: 3px;
    width: 5%;
}
tr.table_rate td.rate_Instant {
    background-color: #13EB7B;
    border-right: 1px solid #FFFFFF;
    padding: 3px;
    width: 5%;
}

tr.table_rate td.rate_OnRequest {
    background-color:#FF0F13;
	color:#fff;
    border-right: 1px solid #FFFFFF;
    padding: 3px;
    width: 5%;
}

#facebox {
    left: 0;
    position: fixed;
    text-align: left;
    top: 0;
    z-index: 100;
	border:3px solid #333;
}
#facebox .popup {
    position: relative;
	background: #fffff;
background: -moz-linear-gradient(top, #ffffff 0%, #ff7f7 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#ff7f7));
background: -webkit-linear-gradient(top, #ffffff 0%,#f7f7f7 100%);
background: -o-linear-gradient(top, #ffffff 0%,#f7f7f7 100%);
background: -ms-linear-gradient(top, #ffffff 0%,#f7f7f7 100%);
background: linear-gradient(to bottom, #ffffff 0%,#f7f7f7 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fffff', endColorstr='#f7f7f7',GradientType=0 );
border: 1px soli #eee;
}
#facebox table {
    border-collapse: collapse;
}
#facebox td {
    border-bottom: 0 none;
    padding: 0;
}
#facebox .body {
    background: none repeat scroll 0 0 #FFFFFF;
    padding: 10px;
	
}
#facebox .loading {
    text-align: center;
}
#facebox .image {
    text-align: center;
}
#facebox img {
    border: 0 none;
    margin: 0;
}
#facebox .footer {
    border-top: 1px solid #DDDDDD;
    margin-top: 10px;
    padding-top: 5px;
    text-align: right;
}
#facebox .tl, #facebox .tr, #facebox .bl, #facebox .br {
    height: 10px;
    overflow: hidden;
    padding: 0;
    width: 10px;
}
#facebox_overlay {
    height: 100%;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
}
.facebox_hide {
    z-index: -100;
}
.facebox_overlayBG {
    background-color: #000000;
    z-index: 99;
}
	</style>
</div>

<script>
function currency_converter($val)
{
	if($val!='SGD')
	{
	var menu_count = document.getElementById("count_price_id").value;
	var api_url= '<?php echo site_url(); ?>';
		$.ajax({
			  type: 'POST',
			  url: api_url+'/api/get_currency_val/'+$val,
			  data: '',
			  async: true,
			  dataType: 'json',
			  beforeSend:function(){
				 
			 },
			success: function(data){
				
				var currency_vals = data.currency_val;
				
			for(var x=0; x < menu_count ;  x++)
	{
		var total_finalss = document.getElementById("price"+x).innerHTML;
		var total_finalss1_org = document.getElementById("price1_org"+x).value;
	var total_finalss1_org_c = document.getElementById("price_org"+x).value;		

		var tots  = parseFloat(total_finalss1_org_c) * parseFloat(currency_vals);

	 total_final = tots.toFixed(2);
		document.getElementById("price"+x).innerHTML=total_final;
		
		if(total_finalss1_org!='' && total_finalss1_org!='NaN')
		{
			var total_finalss1 = document.getElementById("price1_org"+x).value;
			
				var tots1  = parseFloat(total_finalss1) * parseFloat(currency_vals);
				 total_final1 = tots1.toFixed(2);	
	document.getElementById("price1_"+x).innerHTML=total_final1;
		}

	}

			},		  
		 	error:function(request, status, error){}
		  
			});
			
	
	}else
	{
			var menu_count = document.getElementById("count_price_id").value;
			for(var x=0; x < menu_count ;  x++)
	{
		var total_finalss = document.getElementById("price_org"+x).value;
		var total_finalss1 = document.getElementById("price1_org"+x).value;
		
		document.getElementById("price"+x).innerHTML=total_finalss;
		if(total_finalss1!='')
		{
document.getElementById("price1_"+x).innerHTML=total_finalss1;
		}

	}
		
	}
	
}
</script>
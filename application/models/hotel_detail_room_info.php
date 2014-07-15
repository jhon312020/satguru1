<?php
  $room_info_m1 = $this->Hotel_Model->fetch_temp_result_room($ses_id,$hotel_id_val);
  ?>


<div class="padding10">

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
                    <select class="qsb_select" id="" onchange="" name="">
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
                
                <td width="50%" align="left" id="">
                    <table>
                        <tbody><tr>
                            <td width="2%"><img src="<?php echo base_url(); ?>assets/images/icon_wifi.gif"></td>
                            <td width="1%"><span style="vertical-align:top;"> - </span></td>
                            <td align="left"><span style="color:Red; font-size:10px" id="">Free Wi-Fi</span></td>
                        </tr>
                    </tbody></table>  
                </td>
    
                <td align="right" style="padding-right:7px;">
               
                   
                    
                </td>	
            </tr>

 <tr>
                
                <td width="50%" align="left" id="">
                    <table>
                        <tbody><tr>
                            <td width="2%"><img src="<?php echo base_url(); ?>assets/images/dummy/discount.png"></td>
                            <td width="1%"><span style="vertical-align:top;"> - </span></td>
                            <td align="left"><span style="color:Red; font-size:10px" id="">Discount</span></td>
                        </tr>
                    </tbody></table>  
                </td>
    
                <td align="right" style="padding-right:7px;">
               
                   
                    
                </td>	
            </tr>

            

        </tbody></table>
        
        <div style="overflow:auto">
        <table border="0" cellspacing="0" cellpadding="2" style="border-collapse:collapse;" class="" id="">
	<tbody>
    
    
    <tr align="center" class="row_date2">
		<td class="rm_promotion rm_promotion_header">Room Type</td><td class="rm_book">Book</td>
        <?php
		//echo '<pre/>';
	//	print_r($room_info_m1);exit;
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
        <?php 
								

   
if(isset($room_info_m1[0]))
{
	
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
        
        
        <br><span class="rmdetails"></span></td><td class="rm_book" id="">
        <span class="paymode">
        <?php
		if($promotion_b2!='')
		{
		?>
        <font color="green"><?php echo $promotion_b2[4]; ?></font></span>
        <?php
		}
		?><br>
        <input type="submit" class="book_new_btn" id="" onclick="" value="Book" name="">
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
        <td class="rate_avail" id="">
               <a style="text-decoration:none;" onmouseout="UnTip()" onmouseover="Tip('<?php echo $tip_text; ?>&lt;br /&gt;Billing Currency : SGD')"><span class="oldrate" id=""><?php
               if($doscount!=0)
			   {
			   echo ceil((($tokenval[1]/100)*$doscount)+$tokenval[1]);
			   }
			   ?></span><br><?php echo $tokenval[1]; ?></a></td>
               
             <?php
		}
		?>
	
	</tr>
    
    <?php
}
}
?>
</tbody></table>
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

#facebox {
    left: 0;
    position: absolute;
    text-align: left;
    top: 0;
    z-index: 100;
}
#facebox .popup {
    position: relative;
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>DSS Travels</title>
        <!-- CSS -->
        <!--########### COMMON CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
        <!--########### COMMON CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab_rounded.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nivo-slider.css" type="text/css" media="screen" />
    </head>
    <body>
    <div id="header_hotel_print">
<?php $this->load->view('header_footer/header_hotel'); ?>
</div>
<div class="inner_page_body">
    <div class="inner_page_inner_body" style="">
<?php if(isset($suc_msg)){ ?>
<table align="center" style="padding:10px;">
    <tr>
        <td style="color:green;"><?php echo $suc_msg; ?></td>
    </tr>
</table>
<?php } ?>
<?php if(isset($err_msg)){ ?>
<table align="center" style="padding:10px;">
    <tr>
        <td style="color:red;"><?php echo $err_msg; ?></td>
    </tr>
</table>
<?php } ?>


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

.blt_li{ list-style-image:url(<?php echo base_url(); ?>/assets/images/blt.png);
border-bottom:1px solid #ccc;}
  </style>
 
   <div style="width: 800px; margin: 0 auto;">
          <div style="width: 780px;padding: 0px; float: left;">
              <div style="width: 50%; float: left;color:#14731C; font-size:20px; padding-top:20px;"><h3><span style=" ">PNR</span> Number - <?php echo $hotel_result->pnr_no; ?>
              <br />
            <span style=" font-size:13px; color:#525252 ">Hotel Booking Number - <?php echo $result->booking_no; ?></span>
              
              </h3></div>
              <div style="width: 50%; float: right;text-align: right;"><img src="<?php echo base_url(); ?>/assets/images/logo.png" width="220" height="80" style="margin-top: 10px;"></div>
          </div>
         
               <br></span><br><br>
          <div style="width: 778px; border-left: 1px solid green;border-right: 1px solid green;border-top:3px solid green;border-bottom: 3px solid green; padding: 30px;float: left; border-radius: 5px;">
          
         
             
              <div style="width: 755px; float: left;">
                 <?php
			  
			  if(isset($xml_Statusval) && $xml_Statusval!='' && $xml_Statusval!='Success')
			  {
				  ?>
                  <span style="color: red; font-size:15px;"> &diams; <?php echo $xml_Statusval; ?></span>
                  <?php
			  }
			  ?><br />
                   <?php
			  
			  if($xml_Statusval=='Success')
			  {
				  ?>
                  <span style="color: green; font-size:15px;"> &diams; We are updated your booking status. Currently Your Booking Status is <span style="color:#15720E"> <strong><?php echo $Statusval; ?>.</strong></span></span>
                     <?php
			  }
			  else
			  {
				  ?>
                 <span style="color: red; font-size:15px;"> &diams; ERROR : We are not updated your booking status . Kindly contact support.</strong></span></span>   
                  <?php
			  }
			  ?>
                
                  <div style="width: 758px; border: 1px solid #ccc; padding: 10px;float: left; border-radius: 5px; margin-top: 20px;background-color:#f7f6f6;">
              <table width="100%" cellpadding="5" cellspacing="5">
              <tr>
              	<td> <img src="<?php echo $hotel_result->image; ?>"  width="100px"/></td>
                <td   colspan="3">Hotel Name : <?php echo $hotel_result->hotel_name; ?><br />
                Address : <?php echo $hotel_result->address; ?></td>
               </tr>
               <tr>
              	<td style="color:#FFFFFF" bgcolor="#585858">Booking Number</td>
                <td style="color:#FFFFFF"  colspan="" bgcolor="#585858"><?php echo $result->pnr_no; ?></td>
                <td style="color:#FFFFFF"  bgcolor="#585858"> Hotel Booking_No</td>
                <td  style="color:#FFFFFF" bgcolor="#585858"> <?php echo $result->booking_no; ?></td>
               </tr>
               <tr>
              	<td bgcolor="#D0D0D0">Guest Name</td>
                <td colspan=""><?php echo $hotel_result->passanger; ?></td>
                <td bgcolor="#D0D0D0"> Total Price</td>
                <td> <?php echo $hotel_result->amount.' SGD'?></td>
               </tr>
               <tr>
              	<td bgcolor="#D0D0D0">Check In</td>
                <td colspan=""><?php echo  $hotel_result->check_in ?></td>
                <td bgcolor="#D0D0D0"> Check Out</td>
                <td> <?php echo $hotel_result->check_out; ?></td>
               </tr>
               <tr>
              	<td bgcolor="#D0D0D0">Room Type</td>
                <td colspan=""><?php echo $hotel_result->room_type ?></td>
                <td bgcolor="#D0D0D0"> Night</td>
                <td> <?php echo $hotel_result->nights;?></td>
               </tr>
               <tr>
              	<td bgcolor="#D0D0D0">Meals</td>
                <td colspan=""><?php echo $hotel_result->inclusion_val ;?></td>
                <td bgcolor="#D0D0D0"> Status</td>
                <td> <?php echo $result->api_status ?></td>
               </tr>
               <tr>
              	<td bgcolor="#D0D0D0">Extra Request</td>
                <td colspan=""><?php echo $hotel_result->cust_remark;?></td>
                <td bgcolor="#D0D0D0"> City Name</td>
                <td> <?php echo $hotel_result->city?></td>
               </tr>
                <tr>
              	<td colspan="4" bgcolor="#D0D0D0"><?php echo $result->BookedAndPaidval?></td>
               </tr>
               
              </table>
             
             
                  
                  
            </div>
              </div>
              
              
			  
			   
			  
              
            
              
              
              
          </div>
      </div>


</div></div>
<div id="footer_hotel_print">
<?php $this->load->view('header_footer/footer'); ?>
</div>
<script>
function printIframe(id)
{
var iframe = document.frames ? document.frames[id] : document.getElementById(id);
var ifWin = iframe.contentWindow || iframe;
ifWin.focus();
ifWin.printMe();
return false;
}
</script>
        </body>
    </html>
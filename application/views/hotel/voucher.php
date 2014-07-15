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
 
   


    <?php $this->load->view('hotel/voucher_content'); ?>  
 


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
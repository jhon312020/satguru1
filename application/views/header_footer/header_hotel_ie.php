

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/popbox_new.css" type="text/css" media="screen" charset="utf-8">

  <script type="text/javascript" charset="utf-8"  src="<?php echo base_url(); ?>assets/js/popbox_new.js"></script>
  

  
 <!-- <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      $('.popbox,.popbox1').popbox();
    });
  </script>-->
  <div style="height: 120px; border-bottom: 2px solid #f47706;">
  <div class="inner_wrapper " style="width: 1020px; margin:auto; margin-left:10%;">
        
        <div style="width: 100%; float: left;">
        <div style="width: 280px; float: left;">
            <div class="logo toplayer">
			<a href="<?php echo base_url(); ?>">
			 <img src="<?php echo base_url(); ?>assets/images/logo.png" border="0" />
			 </a>
			 
		   </div>
        </div>
        <div style="width: 700px; float: right;">
               <div class="header-rights" style="float: right;height: auto;position: relative;width: 700px;z-index: 1000;">
<div class="header-rights-top" style="width: 700px;
height: auto;
float: left;
margin-top: 18px;">
<div class="header-top-in" style="width: 200px;
height: 50px;
float: right;">

<div class="toplink"  style="float:right; margin-top:0px; background: linear-gradient(to bottom, #2981bc 0%, #2981bc 50%, #1c699d 50%, #1c699d 100%) repeat scroll 0 0 rgba(0, 0, 0, 0); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#2981bc', endColorstr='#2981bc', GradientType=0);border-radius:5px; padding:8px; color:#fff;">
                <ul>
                    
                        <?php 
						
						
					 if($this->session->userdata('b2c_logged_in')) { ?>
						<li>	<span style="color:#fff;">Hi, <?php echo $this->session->userdata('b2c_firstname'); ?></span>
                        </li> | 
                    <li>    <a href="<?php echo site_url(); ?>/account/mybooking">My Account</a> </li>
                        |
                    <li>    <a href="<?php echo site_url(); ?>/login/logout">Logout</a> </li>
					<?php } else { ?>
					<li>	<a href="<?php echo site_url(); ?>/login/member_login"> Login</a> </li> |
                    <li>	<a href="<?php echo site_url(); ?>/login/member_registration">Regsiter</a> </li>
					<?php } ?>
					
                   
				
                </ul>
            </div>
</div>

<div class="header-top-in right10" style="margin-right:0px;">
<span class="call_small_txt">Call an <br /> expert</span>
            <span class="fleft"><img src="<?php echo base_url(); ?>assets/images/phone_icon.png" /></span>
            <span class="call_txt">1234567890</span>
</div>

</div>
<div style="clear:both;"></div>
<div class="header-rights-bottom" style="float:right; height:30px; clear:both;">

<nav>	
            <div id="navbar">
                <ul>
                    <li><a href="<?php echo site_url(); ?>/home/flights" ><img src="<?php echo base_url(); ?>assets/images/flight_icon.png" border="0" align="absmiddle" /> Flights </a> </li>
                    <li style="background: linear-gradient(to bottom, #f19c25 0%, #f19c25 50%, #ef6806 50%, #ef6806 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);" >
                    
                    <a href="<?php echo site_url(); ?>/home/hotels" style="background: linear-gradient(to bottom, #f19c25 0%, #f19c25 50%, #ef6806 50%, #ef6806 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);" ><img src="<?php echo base_url(); ?>assets/images/hotel_icon.png" border="0" align="absmiddle" style="margin-top:-5px;" /> Hotel</a>
                    
                    </li>
                    
                    <li >
                    
                    <a href="<?php echo site_url(); ?>/home/cars" ><img src="<?php echo base_url(); ?>assets/images/car_icon.png" border="0" align="absmiddle" style="margin-top:-5px;" /> Car</a>
                    
                    </li>
                   
                </ul>
            </div>
        </nav>
        <div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div>
        </div>
        </div>
<!--        <div class="clear"></div>-->
        <!-- NAVIGATION -->
        
        <!-- NAVIGATION END -->
     
    </div>
  </div>
      <!-- INNER WRAPPER END -->
  
  <div id="wrapper">
    
    <!-- <div class="header1" style="height: 120px;
z-index: 3;
position: relative;
background-image: url(../images/bg1.jpg);
background-repeat: repeat;
background-position: top;"></div>-->
    

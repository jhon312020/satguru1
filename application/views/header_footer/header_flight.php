
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/popbox_new.css" type="text/css" media="screen" charset="utf-8">

  <script type="text/javascript" charset="utf-8"  src="<?php echo base_url(); ?>assets/js/popbox_new.js"></script>
  
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      $('.popbox,.popbox1').popbox();
    });
  </script>
<div id="wrapper">
    <div class="inner_wrapper ">
        <div class="logo toplayer">
			<a href="<?php echo base_url(); ?>">
            <?php 
			if($this->session->userdata('b2b_logged_in')) { 
				?>
			 <img width="270" height="70" style="width:270px; height:70px"  src="<?php echo $this->session->userdata('b2b_logo'); ?>" border="0" />
             <?php
			}
			else
			{
				?>
			 <img src="<?php echo base_url(); ?>assets/images/logo.png" border="0" />
             <?php
			}
			?>
			 </a>
			 
		   </div>
        <div class="clear"></div>
        <!-- NAVIGATION -->
        
        <!-- NAVIGATION END -->
        <div class="header-rights">
<div class="header-rights-top">
<div class="header-top-in">
<!--<style>
.gradient {background: linear-gradient(to bottom, #2981bc 0%, #2981bc 50%, #1c699d 50%, #1c699d 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);}
</style>-->
<style>
.top_link_part {
	background-image:url(<?php echo base_url(); ?>assets/images/top_link_bg.jpg);
	background-repeat:repeat-x;	
	background-position:center center;
	}
</style>
<div class="toplink top_link_part"  style="float:right; margin-top:0px;border-radius:5px; padding:8px; color:#fff;">
                <ul>
                    
                        <?php 
						
						
					 if($this->session->userdata('b2c_logged_in')) { ?>
						<li>	<span style="color:#fff;">Hi, <?php echo $this->session->userdata('b2c_firstname'); ?></span>
                        </li> | 
                    <li>    <a href="<?php echo site_url(); ?>/account/mybooking">My Account</a> </li>
                        |
                    <li>    <a href="<?php echo site_url(); ?>/login/logout">Logout</a> </li>
					<?php } 
					else if($this->session->userdata('b2b_logged_in')) { 
					$deposit_amount_det = $this->Account_Model->get_deposit_amount($this->session->userdata('b2b_id')); 
					
					?>
						<li>	<span style="color:#fff;">Company : <?php echo $this->session->userdata('b2b_companyname'); ?></span>
                        </li> | 
                        <li>	<span style="color:#fff;">Balance Amount : <span style="color:yellow;"><?php echo $deposit_amount_det->balance_credit.' SGD'; ?></span></span>
                        </li> | 
                        <li>	<span style="color:#fff;">Last Credit :  <span style="color:yellow;"><?php echo $deposit_amount_det->last_credit.' SGD'; ?></span></span>
                        </li> | 
                        
                       
                    
                    <li>    <a href="<?php echo site_url(); ?>/b2b_account/myaccount">My Account</a> </li>
                        |
                    <li>    <a href="<?php echo site_url(); ?>/login/logout">Logout</a> </li>
					<?php } 
					
					else { ?>
                    <li>	<a href="<?php echo site_url(); ?>/login/agent_login"> Agent Login</a> </li> |
                    <li>	<a href="<?php echo site_url(); ?>/login/agent_registration"> Agent Regsiter</a> </li> |
                   					<li>	<a href="<?php echo site_url(); ?>/login/member_login"> Login</a> </li> |
                    <li>	<a href="<?php echo site_url(); ?>/login/member_registration">Regsiter</a> </li>
					<?php } ?>
					
                   
				
                </ul>
            </div>
</div>
<?php
if(!$this->session->userdata('b2b_logged_in')) { 
?>
<div class="header-top-in right10" style="margin-right:0px;">
<span class="call_small_txt">Call an <br /> expert</span>
            <span class="fleft"><img src="<?php echo base_url(); ?>assets/images/phone_icon.png" /></span>
            <span class="call_txt">1234567890</span>
</div>
<?php
}
?>
</div>

<div class="header-rights-bottom">

<nav>	
            <div id="navbar">
                <ul>
                    <li style="background: linear-gradient(to bottom, #f19c25 0%, #f19c25 50%, #ef6806 50%, #ef6806 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);" ><a href="<?php echo site_url(); ?>/home/flights" style="background: linear-gradient(to bottom, #f19c25 0%, #f19c25 50%, #ef6806 50%, #ef6806 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);" ><img src="<?php echo base_url(); ?>assets/images/flight_icon.png" border="0" align="absmiddle" /> Flights </a> </li>
                    <li >
                    
                    <a href="<?php echo site_url(); ?>/home/hotels"  ><img src="<?php echo base_url(); ?>assets/images/hotel_icon.png" border="0" align="absmiddle" style="margin-top:-5px;" /> Hotel</a>
                    
                    </li>
                    
                    <li >
                    
                    <a href="<?php echo site_url(); ?>/home/cars" ><img src="<?php echo base_url(); ?>assets/images/car_icon.png" border="0" align="absmiddle" style="margin-top:-5px;" /> Car</a>
                    
                    </li>
                   <?php /*?> <li><a href="<?php echo site_url(); ?>/home/packages"><img src="<?php echo base_url(); ?>assets/images/packages_icon.png" border="0" align="absmiddle" style="margin-top:-5px;" />Packages</a></li><?php */?>
                    <?php /*?><li><a href="">About Us</a></li>
                    <li><a href="">Contact us</a></li><?php */?>
                </ul>
            </div>
        </nav>
</div>
</div>
    </div><!-- INNER WRAPPER END -->
    <div class="header1"></div>

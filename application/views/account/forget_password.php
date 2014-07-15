<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>DSS Travels</title>
        <!-- CSS -->
        <!--########### COMMON CSS #############-->    
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
        <!--########### COMMON CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab_rounded.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nivo-slider.css" type="text/css" media="screen" />
        <!--########### REGISTRATION CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin_style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" media="screen" />
        <!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themes.css">
    </head>
    <body>
        <!--########################## HEADER INCLUDE ##############################-->
        <?php $this->load->view('header_footer/header_hotel'); ?>
        <!--########################## HEADER INCLUDE ##############################-->
        <!--#################################### BODY CONTENT STARTS #################################################---> 
        <div class="inner_wrapper">  
            
        
        <div class="clear"></div>
        <!-- CONTENT WRAPPER -->
        <div class="top10"></div>
        <div class="content_wrapper" style="box-shadow: none;">
            <div class="inner_wrapper" style="margin-top:20px;">
                
                <div style="float:left; width:1020px;">
                
							<div >
							 
									<span style="font-size:18px;">Forget your <span style="color:#da2121; font-size:16px; font-weight:bold;">Password</span></span>
								 
							</div>
          <div style="float:left; width:520px;">
							<div class="box-content">
								
								<form action="<?php echo site_url(); ?>/home/forget_password_process" method="POST" class='form-horizontal form-validate' id="bb" onsubmit="return b2clogincheck();">
									<div class="login">
                                    <div >
										
										<div <?php /*?>class="controls"<?php */?>>
										<span style="text-transform:uppercase; font-size:14px; margin-bottom:20px; font-weight:bold; float:left; text-shadow: 2px 1px #10528d;">To Retrive My Account</span>

										</div>
                                        <div style="clear:both"></div>
                                      <div style="border-bottom:1px solid #2c7cb9; border-top:1px solid #1e5c8a; margin-bottom:30px;">
                      <?php 
					  if(isset($x) && $x != ''){?>
					  
					   <span style="color:#FFF;"> <?php echo $x; ?></span>               
                        <?php }?>
                                      </div>
                                       
									</div>
									
							  <div  style="float:left; margin-right:15px;">
										<label for="emailfield"   style=" text-shadow: 2px 1px #10528d; margin-bottom:5px;">Email Address</label>
										<div>
											<input type="email" name="email" id="email_id" class="field  validate[required,custom[email]]" data-rule-email="true"  style="float:left;">
											
                                           
										</div>
                                         <span id="user_error1" style="color:#FFF;"></span>
									</div>
							  
									
							  <div style="float:left; margin-top:32px;">
							<input class="newsletter_btn" type="submit"  style="background-color:#CC0003" value="SUBMIT"  />
							
									</div>
                                    
                                    </div>
								</form>
                                
                                <span style="font-size:15px; margin-top:20px; float:right;">Don't have a DSS Account? <span style="color:#da2121; font-weight:bold; font-size:15px;">Create it now!</span>
                                <a href="<?php echo site_url()?>/account/member_registration"><img src="<?php echo base_url(); ?>assets/images/register.png" style="margin-left:20px;" /></a> </span>
                               </div></div>
                                
                                <div class="Benefits" style="border:1px solid #2a83bf;">
                                     
									
									 
								 <table width="100%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td colspan="2" style="font-weight:bold; font-size:16px; color:#3C3C3C;">Benefits of <span style="color:#da2121; font-size:14px;">DSS DEMO </span>Account</td>
    </tr>
  <tr>
    <td width="25" style="border-bottom:dashed 1px #c7c7c7;"><img src="<?php echo base_url(); ?>assets/images/tik.png" /> </td>
    <td style="border-bottom:dashed 1px #c7c7c7;">Faster Bookings</td>
  </tr>
  <tr>
    <td style="border-bottom:dashed 1px #c7c7c7;"><img src="<?php echo base_url(); ?>assets/images/tik.png" /></td>
    <td style="border-bottom:dashed 1px #c7c7c7;">Track Travel History</td>
  </tr>
  <tr>
    <td style="border-bottom:dashed 1px #c7c7c7;"><img src="<?php echo base_url(); ?>assets/images/tik.png" /></td>
    <td style="border-bottom:dashed 1px #c7c7c7;">Manage Your Profile</td>
  </tr>
  <tr>
    <td style="border-bottom:dashed 1px #c7c7c7;"><img src="<?php echo base_url(); ?>assets/images/tik.png" /></td>
    <td style="border-bottom:dashed 1px #c7c7c7;">Deal Alerts</td>
  </tr>
  <tr>
    <td style="border-bottom:dashed 1px #c7c7c7;"><img src="<?php echo base_url(); ?>assets/images/tik.png" /></td>
    <td style="border-bottom:dashed 1px #c7c7c7;">Manage profile &amp; personalize experience</td>
  </tr>
  <tr>
    <td style="border-bottom:dashed 1px #c7c7c7;"><img src="<?php echo base_url(); ?>assets/images/tik.png" /></td>
    <td style="border-bottom:dashed 1px #c7c7c7;">Receive alerts &amp; recommendations</td>
  </tr>
  <tr>
    <td style="border-bottom:dashed 1px #c7c7c7;"><img src="<?php echo base_url(); ?>assets/images/tik.png" /></td>
    <td style="border-bottom:dashed 1px #c7c7c7;">Print e-tickets</td>
  </tr>
  <tr>
    <td  ><img src="<?php echo base_url(); ?>assets/images/tik.png" /></td>
    <td  >Check booking history</td>
  </tr>
                                 </table>

				  </div>
              </div>
							</div>
						</div>
               
                </div>
                <!-- CONTENT WRAPPER END --></div>
         
           
        </div>
        <!--#################################### BODY CONTENT ENDS ###################################################--->
        <!--########################## FOOTER INCLUDE ##############################-->
        <?php $this->load->view('header_footer/footer'); ?>
        <!--########################## FOOTER INCLUDE ##############################-->
    </body>
   
    <!--###########DATE PICKER#############--->
    <script type="text/javascript">
        var baseUrl = "<?php echo base_url() ?>";
        var siteUrl = "<?php echo site_url() ?>";
    </script>
   
   
</html>    
 <script class="secret-source">
		$(document).ready(function(){
			$("#bb").validationEngine();
	});
	</script>  
 <script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/languages/jquery.validationEngine-en.js"></script>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/Validation/css/validationEngine.jquery.css" media="all" type="text/css" />
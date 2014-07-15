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
        <!--########### REGISTRATION CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin_style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" media="screen" />
        <!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themes.css">
	<script type="text/javascript" src="<?php print base_url()?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/languages/jquery.validationEngine-en.js"></script>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/Validation/css/validationEngine.jquery.css" media="all" type="text/css" />
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
        <div class="content_wrapper11" style="box-shadow: none;">
            <div class="inner_wrapper" style="margin-top:20px;">
                <div class="book-head-icon">
                    <div class="book-icon11">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/mybookinghover.png" /></div>
                        <a href='<?php echo site_url()?>/account/myprofile' style="color:#fff;"><div class="book-icon3">My Profile</div></a>
                    </div>
                    <div class="book-icon12">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/mybooking.png" /></div>
                        <a href='<?php echo site_url()?>/account/mybooking' > <div class="book-icon3">My Booking</div></a>
                    </div>
                    <div class="book-icon12">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/cancellation.png" /></div>
                         <a href='<?php echo site_url()?>/account/mycancellation'><div class="book-icon3">My Cancellation</div></a>
                    </div>
                    <div class="book-icon13">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/password.png" /></div>
                        <a href='<?php echo site_url()?>/account/change_pwd'> <div class="book-icon3">Change Password</div></a>
                    </div>
                </div>
                <div class='row-fluid top20' style='clear: both;float: left;'>
                <form action="<?php echo site_url(); ?>/account/edit_myprofile" method="post" name="my_account" id="my_account">
                    <div class='span8'>
                        <div class="book-edit">
                            <div class="row-fluid">
                                <div class="span12">
									
                                    <input type="text" placeholder="Type something" name="firstname" class="validate[required,custom[onlyLetterSp]]" value="<?php if(isset($custdet) && $custdet != ''){echo ucfirst($custdet->firstname);}?>">
                                        <input type="text" placeholder="Type something" class="validate[required,custom[onlyLetterSp]]" name="lastname" value="<?php if(isset($custdet) && $custdet != ''){echo ucfirst($custdet->lastname);}?>">
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="right_main_bar top20" style="margin-top:15px;width: 220px;">
                                    <div class="fleft left20">Contact Details</div>
                   
                                    </div>
                                </div>
                                </div>
                            <div class="row-fluid top20">
                                <div class="span2">
                                <label class="control-label" for="inputEmail" name="address">Address : </label>
                                </div>
                                <div class="span2">
                                
                               <input type="text" name="address" class="validate[required]" style="width:300px;"  value="<?php if(isset($custdet) && $custdet != ''){echo ucfirst(trim($custdet->address));} ?>"  />
                                
                                
                                </div>
                                </div>
                                
                            <div class="row-fluid top10">
                                <div class="row-fluid top5">
                                <div class="span2">
                                <label class="control-label" for="inputEmail" name="address">City : </label>
                                </div>
                                <div class="span2">
                                
                              <input type="text" placeholder="Type something" style="width: 300px;" class="validate[required,custom[onlyLetterSp]]" name="city" value="<?php if(isset($custdet) && $custdet != ''){echo ucfirst($custdet->city);}?>">
                                
                                
                                </div>
                                </div>
                                
                                
                                <div class="row-fluid top5">
                                <div class="span2">
                                <label class="control-label" for="inputEmail" name="address">Zip : </label>
                                </div>
                                <div class="span2">
                                
                               <input type="text" placeholder="Type something" style="width: 300px;" name="zip" value="<?php if(isset($custdet) && $custdet != ''){echo ucfirst($custdet->postal_code);}?>" >
                                
                                
                                </div>
                                </div>
                                
                                <div class="row-fluid top5">
                                <div class="span2">
                                <label class="control-label" for="inputEmail" name="address">Country : </label>
                                </div>
                                <div class="span2">
                                
                               <select style="width: 300px;" name="country">
                               <?php if(isset($country)) { if($country != '') { foreach($country as $cn) { ?>
                               <option value="<?php echo $cn->name; ?>" <?php if($custdet->country == $cn->name) { echo "selected"; } ?>><?php echo $cn->name; ?></option>
                               <?php } } } ?>
                               </select>
                               
                             
                                
                                
                                </div>
                                </div>
                                
                                </div>
                            <div class="row-fluid top10">
                                <div class="span2">
                                 <label class="control-label" for="inputEmail">Mobile : </label>
                                </div>
                                <div class="span10">
                                                                    
                                <div class="row-fluid">
                                    <div class="span5">
                                    <input type="text" placeholder="Type something" class="validate[required,custom[phone]]" style="width: 205px;" name="mobile" value="<?php if(isset($custdet) && $custdet != ''){echo ucfirst($custdet->contact_no);}?>"> 
                                    </div>
                               
                              
                                </div>
                                </div>
                                </div>
                            
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="right_main_bar top20" style="margin-top:15px;width: 220px;">
                                    <div class="fleft left20">Personal Details</div>
                   
                                    </div>
                                </div>
                                </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class='profile-detail'style='padding-bottom: 30px;'>
<!--
                            <dl class="dl-horizontal" style='margin: 3px 3px 25px 3px;'>
                              <dt>DOB : </dt>
                              <dd></dd>
                            </dl>
-->
                           <label class="checkbox">
                              <input type="checkbox" value="1" name="newsletter_signup"
                               <?php if(isset($custdet) && $custdet->signup_newsletter == 1){?> checked="checked"<?php }?> >
                              <span style='float: left;font-size: 12px;'>Sign up for monthly newsletter, Promotions and low fare alert </span>
                            </label>
                            <label class="checkbox">
                              <input type="checkbox" value="1" name="smsalert_signup" 
                              <?php if(isset($custdet) && $custdet->signup_smsalert == 1){?> checked="checked"<?php }?> >
                              <span style='float: left;font-size: 12px;'>Sign up for free SMS alerts. </span>
                            </label>
                        </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <button class="btn-profile top24" type="submit">Save</button>
                                    <a href="#" style="margin-left: 20px;"><button class="btn-profile top24" type="button">Cancel</button></a>
                        
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    </form>
                    <div class='span4 align-right'>
                     
                        <img src="<?php echo base_url(); ?>assets/images/book-icon/editflightbanner.png" />
                    </div>
                </div>
               
                
                <style>
                    .table td {font-size: 12px;}
                    .dl-horizontal dt{text-align: left;width: auto;font-size: 12px;}
                    .dl-horizontal dd {font-size: 12px;margin-left: 78px;}
                    .checkbox input[type="checkbox"] {float: left;margin-left: 0px;margin-right: 5px;}

                </style>  
<!--                <div class="box box-color box-bordered red">
                
							<div class="box-title">
								<h3>
									<i class="icon-ok"></i>
									<span style="font-size:18px;">Create your <span style="color:#da2121; font-size:16px;">akbartravels.us</span> account</span>
								</h3>
							</div>
         
              </div>-->
							</div>
						</div>
               
                </div>
                <!-- CONTENT WRAPPER END --></div>
            <div class="clear"></div>
            
            <div class="top30"></div>
            <div class="clear"></div>
        </div>
        <!--#################################### BODY CONTENT ENDS ###################################################--->
        <!--########################## FOOTER INCLUDE ##############################-->
        <?php $this->load->view('header_footer/footer'); ?>
        <!--########################## FOOTER INCLUDE ##############################-->
    </body>
   <script type="text/javascript">
   
    $(document).ready(function(){
			$("#my_account").validationEngine();
	});
    
   </script>
</html>    

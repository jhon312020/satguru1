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
                    <div class="book-icon12">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/myprofile.png" /></div>
                        <a href='<?php echo site_url()?>/b2b_account/myaccount' ><div class="book-icon3">My Profile</div></a>
                    </div>
                    <div class="book-icon12">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/mybooking.png" /></div>
                        <a href='<?php echo site_url()?>/b2b_account/mybooking'> <div class="book-icon3">My Booking</div></a>
                    </div>
                    <div class="book-icon12">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/cancellation.png" /></div>
                         <a href='<?php echo site_url()?>/b2b_account/mycancellation'><div class="book-icon3">Cancelled Booking</div></a>
                    </div>
                    <div class="book-icon13">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/password.png" /></div>
                        <a href='<?php echo site_url()?>/b2b_account/change_pwd'> <div class="book-icon3">Change Password</div></a>
                    </div>
                     <div class="book-icon12">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/dollor.png" /></div>
                        <a href='<?php echo site_url()?>/b2b_account/deposit'> <div class="book-icon3">My Deposit</div></a>
                    </div>
                     <div class="book-icon11">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/markup.png" /></div>
                        <a href='<?php echo site_url()?>/b2b_account/add_markup'   style="color:#fff;"> <div class="book-icon3"> Markup</div></a>
                    </div>
                </div>
                  
                <div class='row-fluid top20' style='clear: both;float: left;'>
                    <div class='span6'>
                        <h4></h4>
                    </div>
                    <div class='span6 align-right'>
                         
                    </div>
                </div>
                
                <div class='row-fluid top20' style='clear: both;float: left;'>
                    <div class='span6'>
                         <div class="right_main_bar top20" style="margin-top:15px;width: 220px;">
                    <div class="fleft left20">My Markup</div>
                   
                </div>
                
                <form action="<?php echo site_url(); ?>/b2b_account/add_markup_v1/<?php echo $id; ?>" method="post" name="my_account" id="my_account">
                
                        <div class='profile-detail'>
                           
                            <dl class="dl-horizontal" style='margin: 3px;'>
                              <dt><label class="control-label">Markup : </label></dt>
                              <dd><input type="text" value="<?php echo $agent->markup; ?>"  name="markup" class="validate[required]" id="markup" > </dd>
                            </dl>
                           
                              <div style="color:#FF0004; font-weight:bold">
                         <?php 
					  if(isset($status) && $status!='')
					  {
						  echo $status;
					  }
					  ?>
                      </div>
                            <div class="row-fluid">
                                <div class="span12 align-center">
                                    <button class="btn-profile top24" type="submit">Save</button>
                                    <a href="#"><button class="btn-profile top24" type="button">Cancel</button></a>
                        
                                </div>
                            </div>
                        </div>
                        </form>
                        
                    </div>
                    <div class='span6' style="margin-top: 46px;">
                        
                        <img src="<?php echo base_url(); ?>assets/images/book-icon/flightimage.jpg" style="height: 236px;" />
                    </div>
                </div>
                
                <style>
                    .table td {font-size: 12px;}
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
   
    <script>
		function check_present_pwd(pwd)
		{
			$.ajax
			({
				 type: "POST",
				 url: "<?php echo site_url(); ?>/home/check_present_pwd",
				  data: "source="+pwd,
				  success: function(msg)
				  {
					  if(msg == 0)
					  {
						  alert('Password is not correct, Please try again !!!!');
						  $('#pres_pwd').val('');
						  $('#pres_pwd').focus();
					  }
					}
				});
		}
    $(document).ready(function(){
			$("#my_account").validationEngine();
	});
    
    
</script>
</html>    

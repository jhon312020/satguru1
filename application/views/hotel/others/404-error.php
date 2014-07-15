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
   
	<script type="text/javascript">
        
       function b2clogincheck()
	   {
		   var first_name = $('#first_name').val();
			if(first_name == '')
			{
				document.getElementById("first_name_error").innerHTML = "Please enter First Name";
				document.getElementById("first_name").focus();
				return false;
			}
	       var email = $('#email_id').val();
		   var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
		   if(regMail.test(email) == false)
			{
				alert(email);
				document.getElementById("user_error1").innerHTML = "Please enter a valid email address";
				document.getElementById("email_id").value = '';
				document.getElementById("email_id").focus();
				return false;
			}
			elseif(regMail.test(email) == true)
			{
				//document.getElementById("user_error1").innerHTML = "";
				alert(email);
        		$.ajax({
            	url: "<?php echo base_url(); ?>check_user .php",  
            	data:{email:email},
            	type:"POST",          
            	dataType:"text",      
            	success:function(data)
            	{    
                	if(data > 0 ) {
                    message = "This email is registered already!";
                    messageDialog("Error", message, "error", 2);
                    return false;                   
                 }
                 else { return true;}
            }
        });

    
			}
			var pwfield = $('#pwfield').val();
			if(pwfield == '')
			{
				document.getElementById("pwd_error1").innerHTML = "Please enter Password";
				document.getElementById("pwfield").focus();
				return false;
			}
			
			
	   }
	   
    </script>
    
    </head>
    <body>
        <!--########################## HEADER INCLUDE ##############################-->
        <?php $this->load->view('header_footer/header_hotel'); ?>
        <!--########################## HEADER INCLUDE ##############################-->
        <!--#################################### BODY CONTENT STARTS #################################################---> 
        <div class="inner_wrapper">  
            
        
        <div class="clear"></div>
      
        <div class="" style="box-shadow: none;">
            <div class="inner_wrapper" style="margin-top:20px; background-color:#FFFFFF">
                <div>
                <?php
				
				if(isset($status) && $status!='')
				{
					echo $status;
				}
					?>
                </div>
                <div style="border: 1px solid #8CC1E7;
    border-radius: 5px;
   
    box-shadow: 3px 3px 3px #CBCBCB; padding:5px;">
							<div style="background-color:red; padding:10px; text-align:center;  color:#FFF; font-size:25px; font-weight:bold">
							  
									Oops! Sorry, it looks like something went wrong and an error.
								 
							</div>
							<div class="box-content">
								
								
									<div class="control-group">
										
										<div class="controls" style="color: #FF0000;
    margin-left: 170px;
    margin-top: 10px;">
											
										</div>
									</div>
								
									   
	  <div class="no_available" style="text-align:center;  color:red; font-size:16px; font-weight:bold;"><img src="<?php echo base_url(); ?>assets/images/404-error-page.jpg" width="" height="" /></div>
								
							</div>
						</div>
               
                </div>
                <!-- CONTENT WRAPPER END --></div>
            <div class="clear"></div>
            
          
        </div>
        <!--#################################### BODY CONTENT ENDS ###################################################--->
        <!--########################## FOOTER INCLUDE ##############################-->
        <?php $this->load->view('header_footer/footer'); ?>
        <!--########################## FOOTER INCLUDE ##############################-->
    </body>
    <!--###########AUTO COMPLETE#############-->            


  
    
    
</html>    

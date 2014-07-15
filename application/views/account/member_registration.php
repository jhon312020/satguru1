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
							<div style="background-color:#145893; padding:5px; color:#FFF; font-size:12px; font-weight:bold">
							  
									&nbsp;&nbsp;Customer Registration
								 
							</div>
							<div class="box-content">
								
								<form action="<?php echo site_url(); ?>/login/member_registration" method="POST" class='form-horizontal form-validate' id="supplier_reg_form" onsubmit="return b2clogincheck();">
									<div class="control-group">
										
										<div class="controls" style="color: #FF0000;
    margin-left: 170px;
    margin-top: 10px;">
											<?php if(isset($flag)) { echo "Registration Completed With DSS Travels!"; } ?>
										</div>
									</div>
									<div class="control-group" style="width:480px; float:left;  margin-bottom:5px;">
										<label for="textfield" class="control-label" style="font-size:12px;">First Name:</label>
										<div style="float:left; margin-left:10px;">
											<input type="text" name="fnam" id="first_name" tabindex=1 class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" style="height:auto; float:left; width:250px;"  data-rule-required="true" data-rule-minlength="2">
											<br/><span id="err_first_name" style="float:left; margin-left:0px;"></span> 
										</div>
                                         
									</div>
                                    
									<div class="control-group" style="width:480px; float:left;  margin-bottom:5px;">
										<label for="textfield" class="control-label " style="font-size:12px;  ">Postcode/ZIP: </label>
										<div style="float:left; margin-left:10px;">
											<input type="number" name="postal" id="postalcode" maxlength="6"  class="travller_inputbox178 fleft validate[required]" style="height:auto; width:100px;"  data-rule-required="true" data-rule-minlength="2" >
                                            <br/><span id="err_postalcode" style="float:left; margin-left:0px;"></span> 
										</div>
									</div>
									 
									<div class="control-group" style="width:480px; float:left;  margin-bottom:5px;">
										<label for="textfield" class="control-label" style="font-size:12px; ">Last Name:</label>
										<div style="float:left; margin-left:10px;">
											<input type="text" name="lname" id="last_name"  tabindex=2 class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" style="height:auto; width:250px;"  data-rule-required="true" data-rule-minlength="2">
                                            <br/><span id="err_lname" style="float:left; margin-left:0px;"></span> 
										</div>
									</div>
                                    <div class="control-group" style="width:480px; float:left;  margin-bottom:5px;">
										<label for="textfield" class="control-label" style="font-size:12px; ">Email Id:</label>
										<div style="float:left; margin-left:10px;">
											<input type="text" name="email3" id="email_id" tabindex=7 class="travller_inputbox178 fleft validate[required,custom[email]]" style="height:auto; width:250px;"  data-rule-required="true" data-rule-minlength="2">
                                            <br/><span id="err_email_id" style="float:left; margin-left:0px;"></span>
										</div>
										<div class="control-group" style="width:230px; float:left;  margin-bottom:5px; margin-left: 173px; margin-left: 173px; width: 233px; color:red; font-size:12px;"><span id="user_error1"></span>
										</div>
									</div>
                                    <div class="control-group" style="width:480px; float:left;  margin-bottom:5px;">
										<label for="textfield" class="control-label" style="font-size:12px; ">Password:</label>
										<div style="float:left; margin-left:10px;">
											<input type="password" name="pw3" id="pwfield" tabindex=3 class="travller_inputbox178 fleft validate[required]" style="height:auto; width:250px;"  data-rule-required="true" data-rule-minlength="2">
											 <br/><span id="err_pwd_id" style="float:left; margin-left:0px;"></span>
										</div>
									</div>
                                    <div class="control-group" style="width:480px; float:left;  margin-bottom:5px;">
										<label for="textfield" class="control-label" style="font-size:12px; ">Contact No:</label>
										<div style="float:left; margin-left:10px;">
											<input type="text" name="phone" id="phone" maxlength="12" tabindex=8 class="travller_inputbox178 fleft validate[required,custom[phone]]" style="height:auto; width:250px;"  data-rule-required="true" data-rule-minlength="2" onkeypress='validate(event)'>
											 <br/><span id="err_phone" style="float:left; margin-left:0px;"></span>
										</div>
									</div>
                                    <div class="control-group" style="width:480px; float:left;  margin-bottom:5px;">
										<label for="textfield" class="control-label" style="font-size:12px; ">Confirm password:</label>
										<div style="float:left; margin-left:10px;">
											<input type="password" name="pw4" id="cpwfield" tabindex=4 class="travller_inputbox178 fleft validate[required,equals[pwfield]]" style="height:auto; width:250px;"  data-rule-required="true" data-rule-minlength="2">
											 <br/><span id="err_cpwfield" style="float:left; margin-left:0px;"></span>
										</div>
									</div>
									   <div class="control-group" style="width:480px; float:left;  margin-bottom:5px;">
										<label for="textfield" class="control-label" style="font-size:12px; ">Country:</label>
										<div style="float:left; margin-left:10px;">
											<select class="search_input_box2" tabindex=9 style=" text-indent: 0.01px; text-overflow: '';  width:265px; padding:2px;" name="country">
											<?php if(isset($country)) { if($country != '') { foreach($country as $row) { ?>
											<option value="<?php echo $row->name; ?>" ><?php echo $row->name; ?></option>
											<?php } } } ?>
											</select>
										</div>
									</div>
	  <div class="control-group" style="width:480px; float:left;  margin-bottom:5px;">
										<label for="textfield" class="control-label" style="font-size:12px; ">Address</label>
										<div style="float:left; margin-left:10px;">
											<textarea name="address" rows="2" tabindex=5 maxlength="100" class="travller_inputbox178 fleft validate[required]" id="address" style="height:auto; width:280px;"  data-rule-required="true" data-rule-minlength="2"></textarea>
</div>
									</div>
                                  
                                     <div class="control-group" style="width:480px; float:left;  margin-bottom:5px;">
										<label for="textfield" class="control-label" style="font-size:12px; ">City:</label>
										<div style="float:left; margin-left:10px;">
											<input type="text" name="city" id="city" tabindex=10 class="travller_inputbox178 fleft validate[required]" style="height:auto; width:250px;"  data-rule-required="true" data-rule-minlength="2">
										</div>
									</div>
                                    <div style="clear:both;"></div>
									<div class="control-group">
										 
										<div class="controls">
											<label class="checkbox" style="font-size:11px;">
												<input type="checkbox" tabindex=11 name="policy" value="agree" class="validate[required]" required="true" data-rule-required="true" > I agree the <a href="#">policy.</a>
											</label>
										</div>
									</div>
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" tabindex=12 value="Register">
										
									</div>
								</form>
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


    <script class="secret-source">
		$(document).ready(function(){
			$("#supplier_reg_form").validationEngine();
	});
  function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
function validateForm() {
    var firstName = $('#txtFirstName').val();
    var lastName = $('#txtLastName').val();
    var email = $('#txtMail').val();
    if(!firstName || firstName.length === 0) {
        message = "All fields are mandatory\\nFirst Name is required";
        messageDialog("Warning", message, "warning", 2);
        return false;
    } 
    if( !firstName.match(letters) ) {
        message = "Invalid name";
        messageDialog("Warning", message, "warning", 2);
        return false;
    }
    else {
        $.ajax({
            url:"check_user.php",  
            data:{                 
                email:email
            },
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
    return true;
}
    </script><!-- Home Slider Javascript END-->
    
    
</html>    
 <script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/languages/jquery.validationEngine-en.js"></script>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/Validation/css/validationEngine.jquery.css" media="all" type="text/css" />
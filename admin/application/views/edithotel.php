<!doctype html>
<html>
<?php $this->load->view('links');
//session_start();
 ?>
<!-- Validation -->
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/validation/jquery.validate.min.js"></script>
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/validation/additional-methods.min.js"></script>
<link rel="stylesheet" href="<?php echo WEB_DIR_ADMIN ?>css/plugins/datatable/TableTools.css">
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- dataTables -->
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/jquery.dataTables.min.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/TableTools.min.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/ColReorderWithResize.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/ColVis.min.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/jquery.dataTables.columnFilter.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/jquery.dataTables.grouping.js"></script>
    
      <!-- date picker-->
      
    <link rel="stylesheet" href="<?php echo WEB_DIR_ADMIN ?>css/plugins/datepicker/datepicker.css">
    <script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
    
    <script type="text/javascript" src="<?php print WEB_DIR_ADMIN;?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR_ADMIN;?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />

<script>

<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/addmore/jquery-1.3.2.min.js"></script>
<script>
function airlinname_empty(val)
{
	if(val == '')
	{
		$('#airline_image').removeAttr('src');
		$('#airline_logo').val('');
	}
}
</script>



<body>
	
	<div id="modal-user" class="modal hide">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="user-infos"><?php echo $admin_det->first_name." ".$admin_det->last_name; ?></h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="span2">
					<img src="img/demo/user-1.jpg" alt="">
				</div>
				<div class="span10">
					<dl class="dl-horizontal" style="margin-top:0;">
						<dt>Full name:</dt>
						<dd><?php echo $admin_det->first_name." ".$admin_det->last_name; ?></dd>
						<dt>Email:</dt>
						<dd><?php echo $admin_det->email; ?></dd>
						
					</dl>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Close</button>
		</div>
	</div>
	<div id="navigation">
		<div class="container-fluid">
			<a href="#" id="brand"><img src="<?php echo WEB_DIR_ADMIN ?>img/newlogo.png"></a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
			<ul class='main-nav'>
				<li class='active'>
					<a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard">
						<span>Home</span>
					</a>
				</li>
				
			<?php $this->load->view('topmenu'); ?>
		</div>
	</div>
	<div class="container-fluid" id="content">
		
		<?php $this->load->view('leftmenu'); ?>
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Manage Hotel Details</h1>
					</div>
					<div class="pull-right">
						<ul class="minitiles">
							<li class='grey'>
								
							</li>
							<li class='lightgrey'>
								
							</li>
						</ul>
						<ul class="stats">
							
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				
				<div class="box box-color box-bordered red">
							<div class="box-title">
								<h3>
									<i class="icon-ok"></i>
									Edit Hotel Details
								</h3>
                              
							</div>
							<div class="box-content">
								<form action="<?php echo WEB_URL_ADMIN ?>admin/edit_managehotel" method="POST" class='form-horizontal form-validate' id="bb" enctype="multipart/form-data">
									
									<div class="control-group">
										<label for="textfield" class="control-label">Select Country</label>
										<div class="controls">
										<select class="search_input_box2" tabindex=9 style=" text-indent: 0.01px; text-overflow: '';  width:265px; padding:2px;" name="country">
											<?php if(isset($country)) { if($country != '') { foreach($country as $row) { ?>
                                            
											<option value="<?php echo $row->name; ?>" <?php
            if($row->name==$hotel->Country)echo ' selected="selected"';
        ?>><?php echo $row->name; ?></option>
											<?php } } } ?>
											</select>
																					</div>
									</div>
                               <input type="hidden" name="id" value="<?php echo $hotel->hotel_id; ?>">     
                                 <div class="control-group">
										<label for="textfield" class="control-label">City</label>
										<div class="controls">
											<input type="text" name="city" id="city" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" value="<?php if($hotel->City != '') { echo $hotel->City; } ?>" />
										</div>
									</div>   
                                 
                                    <div class="control-group">
										<label for="textfield" class="control-label">Hotel Name</label>
										<div class="controls">
											<input type="text" name="hotelname" id="hotelname" class="input-xlarge" data-rule-required="true" data-rule-minlength="2"  value="<?php if($hotel->HotelName != '') { echo $hotel->HotelName; } ?>"/>
											
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Star Rating</label>
										<div class="controls">
											<!-- <input type="text" name="starrating" id="starrating" class="input-xlarge" data-rule-required="true" data-rule-minlength="" value="<?php if($hotel->StarRating != '') { echo $hotel->StarRating; } ?>"/> -->
											
											<select name = 'starrating' id = 'starrating'>
												<?php 
												$star_rating = array(5,4,3,2,1);
												foreach($star_rating as $rating) 
												{
													if ($rating == $hotel->StarRating)
													{
														echo "<option value='$rating' selected='selected'>$rating stars</option>";
													}
													else
													{
														echo "<option value=$rating>$rating stars</option>";
													}
												}
												?>
											</select> 
										</div>
									</div>
                                     <div class="control-group">
              <label for="textfield" class="control-label">B2B Contract Period-From </label>
              <div class="controls">
                <input type="text" name="contractfrom" id="contractfrom" class="input-xlarge datepick" data-rule-required="true" data-rule-minlength="2" value="<?php if($hotel->contractfrom != '') { echo $hotel->contractfrom; } ?>"/>
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">To</label>
              <div class="controls">
                <input type="text" name="contractto" id="contractto" class="input-xlarge datepick" data-rule-required="true" data-rule-minlength="2" value="<?php if($hotel->contractto != '') { echo $hotel->contractto; } ?>"/>
                <br>
                <br>
              </div>
            </div>
									<div class="control-group">
										<label for="textfield" class="control-label">Address</label>
										<div class="controls">
											<input type="text" name="address" id="address" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" value="<?php if($hotel->Address != '') { echo $hotel->Address; } ?>"/>
										</div>
									</div>
									 <div class="control-group">
										<label for="textfield" class="control-label">Postal Code</label>
										<div class="controls">
										<input type="text" name="postalcode" id="postalcode"  class="input-xlarge" value="<?php if($hotel->PostalCode != '') { echo $hotel->PostalCode; } ?>">
										</div>
									</div> 
									
                                     <div class="control-group">
										<label for="textfield" class="control-label">Contact No</label>
										<div class="controls">
											<input type="text" name="contactno" id="contactno" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" value="<?php if($hotel->ContactNo != '') { echo $hotel->ContactNo; } ?>"/>
										</div>
									</div>   
                                    <div class="control-group">
										<label for="textfield" class="control-label">Fax No</label>
										<div class="controls">
										<input type="text" name="faxno" id="faxno"  class="input-xlarge" value="<?php if($hotel->FaxNo  != '') { echo $hotel->FaxNo ; } ?>">
										</div>
									</div>
                                  <!--   <div class="control-group">
										<label for="textfield" class="control-label">Check In Time</label>
										<div class="controls">
										<input type="text" name="checkintime" id="checkintime"  class="input-xlarge" value="<?php if($hotel->checkintime != '') { echo $hotel->checkintime; } ?>">
										</div>
									</div>
                                 
                                     <div class="control-group">
										<label for="textfield" class="control-label">Check Out Time</label>
										<div class="controls">
										<input type="text" name="checkouttime" id="checkouttime"  class="input-xlarge" value="<?php if($hotel->checkouttime != '') { echo $hotel->checkouttime; } ?>">
										</div>
									</div>  -->
                                    
                                     <div class="control-group">
                              <label for="textfield" class="control-label">Director Of Sales Name</label>
                              <div class="controls">
                                <input type="text" name="directorsales" id="directorsales"  class="input-xlarge" value="<?php if($hotel->directorsales != '') { echo $hotel->directorsales ; } ?>">
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="textfield" class="control-label">Sales Person Name</label>
                              <div class="controls">
                                <input type="text" name="salespersonname" id="salespersonname"  class="input-xlarge" value="<?php if($hotel->salespersonname  != '') { echo $hotel->salespersonname ; } ?>" data-rule-required="true">
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="textfield" class="control-label">Sales Department Contact Number</label>
                              <div class="controls">
                                <input type="text" name="salesno" id="salesno"  class="input-xlarge" value="<?php if($hotel->salesno  != '') { echo $hotel->salesno ; } ?>" data-rule-required="true">
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="textfield" class="control-label">Sales Department Email</label>
                              <div class="controls">
                                <input type="text" name="salesemail" id="salesemail"  class="input-xlarge" value="<?php if($hotel->salesemail != '') { echo $hotel->salesemail  ; } ?>" data-rule-required="true">
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="textfield" class="control-label">Extranet Person Name</label>
                              <div class="controls">
                                <input type="text" name="extranetpersonname" id="extranetpersonname"  class="input-xlarge" value="<?php if($hotel->extranetpersonname  != '') { echo $hotel->extranetpersonname ; } ?>">
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="textfield" class="control-label">Extranet Department Number</label>
                              <div class="controls">
                                <input type="text" name="extranetnumber" id="extranetnumber"  class="input-xlarge" value="<?php if($hotel->extranetnumber  != '') { echo $hotel->extranetnumber ; } ?>">
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="textfield" class="control-label">Extranet Department Email</label>
                              <div class="controls">
                                <input type="text" name="extranetemail" id="extranetemail"  class="input-xlarge" value="<?php if($hotel->extranetemail  != '') { echo $hotel->extranetemail ; } ?>">
                              </div>
                            </div>
                                                    
                                     <div class="control-group">
										<label for="textfield" class="control-label">Hotel snippet Description</label>
										<div class="controls">
										<textarea name="hoteldesc" id="hoteldesc" data-rule-required="true"><?php if($hotel->HotelDesc != '') { echo $hotel->HotelDesc; } ?></textarea>
										</div>
									</div> 
                                    
                             
          
            <div class="control-group">
              <label for="textfield" class="control-label">Geographical Situation</label>
              <div class="controls">
                <textarea name="geo" id="geo" rows="10" cols="100"><?php if($hotel->geo != '') { echo $hotel->geo; } ?></textarea>
              </div>
            </div>
            <br>
            <div class="control-group">
              <label for="textfield" class="control-label">Hotel Description</label>
              <div class="controls">
                <textarea name="hoteldescmore" id="hoteldescmore" rows="10" cols="100" data-rule-required="true"><?php if($hotel->hoteldescmore != '') { echo $hotel->hoteldescmore; } ?></textarea>
              </div>
            </div>
                                      <div class="control-group">
										<label for="textfield" class="control-label">Average Price</label>
										<div class="controls">
										<input type="text" name="avarageprice" id="averageprice"  class="input-xlarge" value="<?php if($hotel->AvgPrice != '') { echo $hotel->AvgPrice; } ?>">
										</div>
									</div> 
                                    
                                       <div class="control-group">
										<label for="textfield" class="control-label">Upload Image</label>
										<div class="controls">
										<input type="file" name="uploadimage" id="uploadimage"  class="input-xlarge">
                                        <input type="hidden" name="uploadimage1" id="uploadimage1" value="<?php if($hotel->FrontPgImage != '') { echo $hotel->FrontPgImage; } ?>">
										</div>
									</div> 
                                                    


  <div class="box-title">
          <h3> <i class="icon-ok"></i>Hotel Features</h3>
        </div>
            <h2></h2>
            <div class="control-group"> <?php 
            $sport= $hotel->sports;
			$str=explode("#",$sport);
			$sp = '';
			$sp1 = '';
			$sp2 = '';
			$sp3 = '';
			$sp4 = '';
			$sp5 = '';
			$sp6 = '';
			$sp7 = '';
			$fa1 = $fa2 = $fa3 = $fa4 = $fa5 = $fa6 = $fa7 = $fa8 = $fa9 = $fa10 = $fa11 = $fa12 = $fa13 = $fa14 = $fa15 = $fa16 = $fa17 = $fa18 = $fa19 = $fa20 = $fa21 = $fa22 = $fa23 = $fa24 = $fa25 = '';
			foreach($str as $value) { 
			
			if($value=='fitness center')
			  $sp='Yes';
			  else
			  $sp=='';
			if($value=='outdoor pool')
			  $sp1='Yes';
			  else
			  $sp1=='';
			if($value=='tennis courts')
			  $sp2='Yes';
			  else
			  $sp2=='';
			if($value=='sauna')
			  $sp3='Yes';
			  else
			  $sp3=='';
			if($value=='hot tub')
			  $sp4='Yes';
			  else
			  $sp4=='';
			if($value=='pool (kids)')
			  $sp5='Yes';
			  else
			  $sp5=='';
			if($value=='massage')
			  $sp6='Yes';
			  else
			  $sp6=='';
			if($value=='spa')
			  $sp7='Yes';
			  else
			  $sp7=='';        
			  
			
			}
			?>
            
            
            
         
			
			
			
              <label for="textfield" class="control-label">Sports And Recreation</label>
              <div class="controls"><table><tr><td>
                <input type="checkbox" value="fitness center" name="sports[]" <?php if($sp!='') echo ' checked="checked"';?>>
                &nbsp;fitness center&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="outdoor pool" name="sports[]" <?php if($sp1!='') echo ' checked="checked"';?>>
                &nbsp;outdoor pool&nbsp;&nbsp; </td>
              <td>  <input type="checkbox" value="tennis courts" name="sports[]" <?php if($sp2!='') echo ' checked="checked"';?>>
                &nbsp;tennis courts&nbsp;&nbsp; </td><td><input type="checkbox" value="sauna" name="sports[]" <?php if($sp3!='') echo ' checked="checked"';?>>
                &nbsp;sauna&nbsp;&nbsp;</td></tr><tr><td>
                
                <input type="checkbox" value="hot tub" name="sports[]" <?php if($sp4!='') echo ' checked="checked"';?>>
                &nbsp;hot tub&nbsp;&nbsp; </td>
              <td>  <input type="checkbox" value="pool (kids)" name="sports[]" <?php if($sp5!='') echo ' checked="checked"';?>>
                &nbsp;pool (kids)&nbsp;&nbsp; </td>
              <td>  <input type="checkbox" value="massage" name="sports[]" <?php if($sp6!='') echo ' checked="checked"';?>>
                &nbsp;massage&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="spa" name="sports[]" <?php if($sp7!='') echo ' checked="checked"';?>>
                &nbsp;spa&nbsp;&nbsp;</td></tr> </table></div>
            </div> <hr>
            <br>
          <?php $i =1; if(isset($facility)) { if($facility != '') { foreach($facility as $list) { ?> 
          <?php  
		 
	  		  if($list->Facility=='24-hour room service')
			   	$fa1='yes';
					else
				$fa1=='';
				
			 if($list->Facility=='airport transfer')
			  $fa2='yes';
					else
				$fa2=='';
			 if($list->Facility=='babysitting')
			   	$fa3='yes';
					else
				$fa3=='';
			 if($list->Facility=='bar')
			   	$fa4='yes';
					else
				$fa4='';
			 if($list->Facility=='business center')
			   	$fa5='yes';
					else
				$fa5=='';
				
			 if($list->Facility=='coffee shop')
			   	$fa6='yes';
					else
				$fa6=='';
				
			 if($list->Facility=='concierge')
			   	$fa7='yes';
					else
				$fa7=='';
			 if($list->Facility=='elevator')
			   	$fa8='yes';
					else
				$fa8=='';
			 if($list->Facility=='executive floor')
			   	$fa9='yes';
					else
				$fa9=='';
			 if($list->Facility=='facilities for disabled guests')
			   	$fa10='yes';
					else
				$fa10=='';	
				
			 if($list->Facility=='family room')
			   	$fa11='yes';
					else
				$fa11='';
			 if($list->Facility=='laundry service')
			   	$fa12='yes';
					else
				$fa12==''; 
			if($list->Facility=='meeting facilities')
			 $fa13='yes';
					else
				$fa13==''; 
			if($list->Facility=='poolside bar')
			   	$fa14='yes';
					else
				$fa14=='';
			 if($list->Facility=='restaurant')
			   $fa15='yes';
					else
				$fa15==''; 
			if($list->Facility=='room service')
			   	$fa16='yes';
					else
				$fa16==''; 
			if($list->Facility=='safety deposit boxes')
			   	$fa17='yes';
					else
				$fa17==''; 
			if($list->Facility=='smoking area')
			   	$fa18='yes';
					else
				$fa18==''; 
			if($list->Facility=='Wi-Fi in public areas')
			   	$fa19='yes';
					else
				$fa19==''; 
			if($list->Facility=='tours')
			   	$fa20='yes';
					else
				$fa20=='';
			 if($list->Facility=='salon')
			   	$fa21='yes';
					else
				$fa21==''; 
			if($list->Facility=='luggage storage')
			   	$fa22='yes';
					else
				$fa22==''; 
			if($list->Facility=='newspapers')
			   	$fa23='yes';
					else
				$fa23==''; 
			if($list->Facility=='shops')
			   	$fa24='yes';
					else
				$fa24=='';	

		  		
		   ?>
          
          <?php }}}?> 
          
         
            <div class="control-group">
              <label for="textfield" class="control-label">Facilities</label>
              <div class="controls"><table><tr><td>
              <?php //echo "hi".$_SESSION['fa2'];?>
                <input type="checkbox" value="24-hour room service" name="facility[]" 			                  <?php if($fa1!='') echo ' checked="checked"';?>>
                &nbsp;24-hour room service&nbsp;&nbsp;</td>
               <td> <input type="checkbox" value="airport transfer" name="facility[]"  <?php if($fa2!='') echo ' checked="checked"';?>>
                &nbsp;airport transfer&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="babysitting" name="facility[]"  <?php if($fa3!='') echo ' checked="checked"';?>>
                &nbsp;babysitting&nbsp;&nbsp; </td></tr>
             <tr> <td>  <input type="checkbox" value="bar" name="facility[]"  <?php if($fa4!='') echo ' checked="checked"';?>>
                &nbsp;bar&nbsp;&nbsp;  </td>
             
             <td>
                <input type="checkbox" value="business center" name="facility[]"  <?php if($fa5!='') echo ' checked="checked"';?>>
                &nbsp;business center&nbsp;&nbsp; </td>
              <td>  <input type="checkbox" value="coffee shop" name="facility[]"<?php if($fa6!='') echo ' checked="checked"';?>>
                &nbsp;coffee shop&nbsp;&nbsp; </td></tr>
              <tr>  <td><input type="checkbox" value="concierge" name="facility[]" <?php if($fa7!='') echo ' checked="checked"';?>>
                &nbsp;concierge&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="elevator" name="facility[]" <?php if($fa8!='') echo ' checked="checked"';?>>
                &nbsp;elevator&nbsp;&nbsp; </td>
             
                <td>
                <input type="checkbox" value="executive floor" name="facility[]" <?php if($fa9!='') echo ' checked="checked"';?>>
                &nbsp;&nbsp;executive floor&nbsp;&nbsp; </td></tr><tr><td>
                <input type="checkbox" value="facilities for disabled guests" name="facility[]" <?php if($fa10!='') echo ' checked="checked"';?>>
                &nbsp;facilities for disabled guests&nbsp;&nbsp; </td> <td>
                <input type="checkbox" value="family room" name="facility[]" <?php if($fa11!='') echo ' checked="checked"';?>>
                &nbsp;family room&nbsp;&nbsp; </td> <td>
                <input type="checkbox" value="laundry service" name="facility[]" <?php if($fa12!='') echo ' checked="checked"';?>>
                &nbsp;laundry service&nbsp;&nbsp; </td> </tr><tr><td>
                
                <input type="checkbox" value="meeting facilities" name="facility[]" <?php if($fa13!='') echo 'checked="checked"';?>>
                &nbsp;meeting facilities&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="poolside bar" name="facility[]" <?php if($fa14!='') echo ' checked="checked"';?>>
                &nbsp;poolside bar&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="restaurant" name="facility[]" <?php if($fa15!='') echo ' checked="checked"';?>>
                &nbsp;restaurant&nbsp;&nbsp; </td></tr>
           <tr>   <td>  <input type="checkbox" value="room service" name="facility[]" <?php if($fa16!='') echo ' checked="checked"';?>>
                &nbsp;room service&nbsp;&nbsp; </td><td>
                <input type="checkbox" value="safety deposit boxes" name="facility[]" <?php if($fa17!='') echo ' checked="checked"';?>>
                &nbsp;safety deposit boxes&nbsp;&nbsp;  </td>
               <td> <input type="checkbox" value="smoking area" name="facility[]" <?php if($fa18!='') echo ' checked="checked"';?>>
                &nbsp;smoking area&nbsp;&nbsp; </td></tr>
               <tr>
               <td> <input type="checkbox" value="Wi-Fi in public areas" name="facility[]" <?php if($fa19!='') echo ' checked="checked"';?>>
                &nbsp;Wi-Fi in public areas&nbsp;&nbsp; </td>
                <td><input type="checkbox" value="tours" name="facility[]" <?php if($fa20!='') echo ' checked="checked"';?>>
                &nbsp;tours&nbsp;&nbsp; </td>
<td>
                <input type="checkbox" value="salon" name="facility[]" <?php if($fa21!='') echo ' checked="checked"';?>>
                &nbsp;salon&nbsp;&nbsp; </td></tr><tr>
               <td><input type="checkbox" value="facilities for disabled guests" name="facility[]" <?php if($fa22!='') echo ' checked="checked"';?>> 
                &nbsp;facilities for disabled guests&nbsp;&nbsp;</td>
              <td>  <input type="checkbox" value="luggage storage" name="facility[]" <?php if($fa23!='') echo ' checked="checked"';?>>
                &nbsp;luggage storage&nbsp;&nbsp; </td>
              <td>  <input type="checkbox" value="newspapers" name="facility[]" <?php if($fa24!='') echo ' checked="checked"';?>>
                &nbsp;newspapers&nbsp;&nbsp;&nbsp;&nbsp; </td></tr>
             <tr>  <td> <input type="checkbox" value="shops" name="facility[]" <?php if($fa25!='') echo ' checked="checked"';?>>
                &nbsp;shops&nbsp;&nbsp; </td></tr></table></div>
            </div>
           <hr>
            <div class="control-group">
              <label for="textfield" class="control-label">Internet Facility</label>
              <div class="controls">
                <input type="checkbox" value="Free LAN and WiFi access" name="internetfacility"  <?php if($hotel->internetfacility =='Free LAN and WiFi access') echo ' checked="checked"';?>>
                &nbsp;Free LAN and WiFi access&nbsp;&nbsp; </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Car Parking</label>
              <div class="controls">
                <input type="checkbox" value="Car Parking" name="carparking" <?php if($hotel->carparking  =='Car Parking') echo ' checked="checked"';?>>
                &nbsp;Car Parking&nbsp;&nbsp; </div>
            </div> <hr>


                                    
                                    
                                    
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Submit">
										<a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard"><button type="button" class="btn">Cancel</button></a>
									</div>
								</form>
							</div>
						</div>
				
			</div>
				
			<div class="box box-color box-bordered red">
					
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Manage Room Details
								</h3>
                               
                                  <h4 align="right"><!--<a href="<?php echo WEB_URL_ADMIN ?>admin/viewfacility/<?php echo $hotel->hotel_id; ?>">Add/View Facility</a>&nbsp;&nbsp;&nbsp; --><a href="<?php echo WEB_URL_ADMIN ?>admin/addroomn/<?php echo $hotel->hotel_id; ?>">Add New Room </a></h4>
							</div>
                            
                             <script type="text/javascript"  language="javascript">
							  function confirm_update(id,del_status,hotelid)
							  {
								  var st = (del_status==0)?'Active':'Inactive';
								  var r=confirm("Are you sure you want to change Status to "+st+"?");
							  if (r==true)
								{
								self.location="<?php echo WEB_URL_ADMIN ?>admin/change_roomstatus/"+id+"/"+del_status+"/"+hotelid;
								}
							  else
								{
								
								}
							  }
							  </script>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
									<thead>
										<tr class='thefilter'>
											<th>#ID</th>
											<th>Roomname</th>
											<!--<th class='hidden-350'>Price</th>
											<th class=''>Occupancy</th>  -->
                                              <th>Status</th>
                                              <th class='hidden-480'>Action</th>
											<th class='hidden-480'>Price Control</th>
                                          <th class='hidden-480'>Promotion Control</th>
											
										</tr>
										<tr>
											<th>#ID</th>
											<th>Room Name</th>
											<!--<th class='hidden-350'>Price</th>
											<th class=''>Occupancy</th>  -->
                                              <th>Status</th>
										<th class='hidden-480'></th> 
                                           <th class='hidden-480'>Price Control</th>  
                                            <th class='hidden-480'>Promotion Control</th>  
										</tr>
									</thead>
									<tbody>
										<?php $i =1; if(isset($roomdisplay)) { if($roomdisplay != '') { foreach($roomdisplay as $list) { ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $list->RoomName; ?></td>
											<!--<td class='hidden-350'><?php echo $list->AvgPrice; ?></td>
											<td class=''><?php echo $list->NormalOccupancy; ?></td> --> <td><a href="javascript:confirm_update('<?php echo $list->id; ?>','<?php echo $list->status;?>','<?php echo $list->HotelCode;?>')">
											<?php echo ($list->status==1)?'Active':'InActive'; ?>
											</td>  
											
                                            <td class='hidden-480'><a href="<?php echo WEB_URL_ADMIN ?>admin/editroom/<?php echo $list->id; ?>">Edit</a></td>
										
                                           <td class='hidden-480'><a href="<?php echo WEB_URL_ADMIN ?>admin/addeditprice/<?php echo $list->id; ?>/<?php echo $list->HotelCode; ?>">Delete/Add Price</a></td>	 <td class='hidden-480'><a href="<?php echo WEB_URL_ADMIN ?>admin/viewpromo/<?php echo $list->id; ?>/<?php echo $list->HotelCode; ?>">Add /View/Delete </a></td>	  
										</tr>
										<?php $i++;} } } ?>
									</tbody>
								</table>
							</div>
						</div>
				
			</div>
		</div></div>
		
	</body>

	</html>


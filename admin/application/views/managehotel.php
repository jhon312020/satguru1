<!doctype html>
<html>
<?php $this->load->view('links'); ?>
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
      <div class="span2"> <img src="img/demo/user-1.jpg" alt=""> </div>
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
<a href="#" id="brand"><img src="<?php echo WEB_DIR_ADMIN ?>img/newlogo.png"></a> <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
<ul class='main-nav'>
<li class='active'> <a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard"> <span>Home</span> </a> </li>
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
            <li class='grey'> </li>
            <li class='lightgrey'> </li>
          </ul>
          <ul class="stats">
            <li class='lightred'> <i class="icon-calendar"></i>
              <div class="details"> <span class="big">February 22, 2013</span> <span>Wednesday, 13:56</span> </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="box box-color box-bordered red">
        <div class="box-title">
          <h3> <i class="icon-ok"><img src="<?php echo WEB_DIR_ADMIN ?>css/icon_addhotel.png"></i> Add New Hotel </h3>
        </div>
        <div class="box-content">
          <form action="<?php echo WEB_URL_ADMIN ?>admin/add_managehotel" method="POST" class='form-horizontal form-validate' id="bb" enctype="multipart/form-data">
          	<div class="group-container">
            <div class="control-group">
              <label for="textfield" class="control-label">Select Country</label>
              <div class="controls">
                <select class="search_input_box2" tabindex=9 style=" text-indent: 0.01px; text-overflow: '';  width:265px; padding:2px;" name="country">
                  <?php if(isset($country)) { if($country != '') { foreach($country as $row) { ?>
                  <option value="<?php echo $row->name; ?>" ><?php echo $row->name; ?></option>
                  <?php } } } ?>
                </select>
              </div>
            </div> <br>
            <div class="control-group">
              <label for="textfield" class="control-label">City</label>
              <div class="controls">
                <input type="text" name="city" id="city" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" />
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Hotel Name</label>
              <div class="controls">
                <input type="text" name="hotelname" id="hotelname" class="input-xlarge"data-rule-required="true" data-rule-minlength="2"  />
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Star Rating</label>
              <div class="controls">
                <!-- <select name="starrating">
                  <OPTION value="Boutique">Boutique</OPTION>
                  <OPTION value="Luxury Boutique">Luxury Boutique </OPTION>
                  <OPTION value="5 stars">5</OPTION>
                  <OPTION value="4 stars">4</OPTION>
                  <OPTION value="3 stars">3</OPTION>
                  <OPTION value="2 stars">2</OPTION>
                </select> -->
                <select name="starrating">
                
                  <OPTION value="5">5 stars</OPTION>
                  <OPTION value="4">4 stars</OPTION>
                  <OPTION value="3">3 stars</OPTION>
                  <OPTION value="2">2 stars</OPTION>
                  <OPTION value="1">1 stars</OPTION>
                </select> 
              </div>
            </div> <br>
            <div class="control-group">
              <label for="textfield" class="control-label">B2B Contract Period-From </label>
              <div class="controls">
                <input type="text" name="contractfrom" id="contractfrom" class="input-xlarge datepick" data-rule-required="true" data-rule-minlength="2" />
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">To</label>
              <div class="controls">
                <input type="text" name="contractto" id="contractto" class="input-xlarge datepick" data-rule-required="true" data-rule-minlength="2" />
                <br>
                <br>
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Address</label>
              <div class="controls">
                <input type="text" name="address" id="address" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" />
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Postal Code</label>
              <div class="controls">
                <input type="text" name="postalcode" id="postalcode"  class="input-xlarge">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Contact No</label>
              <div class="controls">
                <input type="text" name="contactno" id="contactno" class="input-xlarge"data-rule-required="true" data-rule-minlength="2" />
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Fax No</label>
              <div class="controls">
                <input type="text" name="faxno" id="faxno"  class="input-xlarge">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Director Of Sales Name</label>
              <div class="controls">
                <input type="text" name="directorsales" id="directorsales"  class="input-xlarge">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Sales Person Name</label>
              <div class="controls">
                <input type="text" name="salespersonname" id="salespersonname"  class="input-xlarge" data-rule-required="true">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Sales Department Contact Number</label>
              <div class="controls">
                <input type="text" name="salesno" id="salesno"  class="input-xlarge" data-rule-required="true">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Sales Department Email</label>
              <div class="controls">
                <input type="text" name="salesemail" id="salesemail"  class="input-xlarge" data-rule-required="true">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Extranet Person Name</label>
              <div class="controls">
                <input type="text" name="extranetpersonname" id="extranetpersonname"  class="input-xlarge">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Extranet Department Number</label>
              <div class="controls">
                <input type="text" name="extranetnumber" id="extranetnumber"  class="input-xlarge">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Extranet Department Email</label>
              <div class="controls">
                <input type="text" name="extranetemail" id="extranetemail"  class="input-xlarge">
              </div>
            </div>
            </div>
            
            <!--   <div class="control-group">
										<label for="textfield" class="control-label">Check In Time</label>
										<div class="controls">
										<input type="text" name="checkintime" id="checkintime"  class="input-xlarge">
										</div>
									</div>
                                 
                                     <div class="control-group">
										<label for="textfield" class="control-label">Check Out Time</label>
										<div class="controls">
										<input type="text" name="checkouttime" id="checkouttime"  class="input-xlarge">
										</div>
									</div>   -->
            
            <div class="control-group group-container">
              <label for="textfield" class="control-label">Hotel snippet Description</label>
              <div class="controls">
                <textarea name="hoteldesc" id="hoteldesc" rows="10" cols="10" data-rule-required="true"></textarea>
              </div>
            </div>
            <div class="control-group group-container">
              <label for="textfield" class="control-label">Geographical Situation</label>
              <div class="controls">
                <textarea name="geo" id="geo" rows="10" cols="100"></textarea>
              </div>
            </div>
            <div class="control-group group-container">
              <label for="textfield" class="control-label">Hotel Description</label>
              <div class="controls">
                <textarea name="hoteldescmore" id="hoteldescmore" rows="10" cols="100"></textarea>
              </div>
            </div>
         
           <div class="box-title">
          <h3> <i class="icon-ok"><img src="<?php echo WEB_DIR_ADMIN ?>css/icon_features.png"></i>Hotel Features</h3>
        </div>
            <h2></h2>
            <div class="control-group  group-container">
              <label for="textfield" class="control-label">Sports And Recreation</label>
              <div class="controls"><table><tr><td>
                <input type="checkbox" value="fitness center" name="sports[]">
                &nbsp;fitness center&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="outdoor pool" name="sports[]">
                &nbsp;outdoor pool&nbsp;&nbsp; </td>
              <td>  <input type="checkbox" value="tennis courts" name="sports[]">
                &nbsp;tennis courts&nbsp;&nbsp; </td><td><input type="checkbox" value="sauna" name="sports[]">
                &nbsp;sauna&nbsp;&nbsp;</td></tr><tr><td>
                
                <input type="checkbox" value="hot tub" name="sports[]">
                &nbsp;hot tub&nbsp;&nbsp; </td>
              <td>  <input type="checkbox" value="pool (kids)" name="sports[]">
                &nbsp;pool (kids)&nbsp;&nbsp; </td>
              <td>  <input type="checkbox" value="massage" name="sports[]">
                &nbsp;massage&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="spa" name="sports[]">
                &nbsp;spa&nbsp;&nbsp;</td></tr> </table></div>
            </div>
            <div class="control-group group-container">
              <label for="textfield" class="control-label">Facilities</label>
              <div class="controls"><table><tr><td>
                <input type="checkbox" value="24-hour room service" name="facility[]">
                &nbsp;24-hour room service&nbsp;&nbsp;</td>
               <td> <input type="checkbox" value="airport transfer" name="facility[]">
                &nbsp;airport transfer&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="babysitting" name="facility[]">
                &nbsp;babysitting&nbsp;&nbsp; </td></tr>
             <tr> <td>  <input type="checkbox" value="bar" name="facility[]">
                &nbsp;bar&nbsp;&nbsp;  </td>
             
             <td>
                <input type="checkbox" value="business center" name="facility[]">
                &nbsp;business center&nbsp;&nbsp; </td>
              <td>  <input type="checkbox" value="coffee shop" name="facility[]">
                &nbsp;coffee shop&nbsp;&nbsp; </td></tr>
              <tr>  <td><input type="checkbox" value="concierge" name="facility[]">
                &nbsp;concierge&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="elevator" name="facility[]">
                &nbsp;elevator&nbsp;&nbsp; </td>
             
                <td>
                <input type="checkbox" value="executive floor" name="facility[]">
                &nbsp;&nbsp;executive floor&nbsp;&nbsp; </td></tr><tr><td>
                <input type="checkbox" value="facilities for disabled guests" name="facility[]">
                &nbsp;facilities for disabled guests&nbsp;&nbsp; </td> <td>
                <input type="checkbox" value="family room" name="facility[]">
                &nbsp;family room&nbsp;&nbsp; </td> <td>
                <input type="checkbox" value="laundry service" name="facility[]">
                &nbsp;laundry service&nbsp;&nbsp; </td> </tr><tr><td>
                
                <input type="checkbox" value="meeting facilities" name="facility[]">
                &nbsp;meeting facilities&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="poolside bar" name="facility[]">
                &nbsp;poolside bar&nbsp;&nbsp; </td>
               <td> <input type="checkbox" value="restaurant" name="facility[]">
                &nbsp;restaurant&nbsp;&nbsp; </td></tr>
           <tr>   <td>  <input type="checkbox" value="room service" name="facility[]">
                &nbsp;room service&nbsp;&nbsp; </td><td>
                <input type="checkbox" value="safety deposit boxes" name="facility[]">
                &nbsp;safety deposit boxes&nbsp;&nbsp;  </td>
               <td> <input type="checkbox" value="smoking area" name="facility[]">
                &nbsp;smoking area&nbsp;&nbsp; </td></tr>
               <tr>
               <td> <input type="checkbox" value="Wi-Fi in public areas" name="facility[]">
                &nbsp;Wi-Fi in public areas&nbsp;&nbsp; </td>
                <td><input type="checkbox" value="tours" name="facility[]">
                &nbsp;tours&nbsp;&nbsp; </td>
<td>
                <input type="checkbox" value="salon" name="facility[]">
                &nbsp;salon&nbsp;&nbsp; </td></tr><tr>
               <td><input type="checkbox" value="facilities for disabled guests" name="facility[]"> 
                &nbsp;facilities for disabled guests&nbsp;&nbsp;</td>
              <td>  <input type="checkbox" value="luggage storage" name="facility[]">
                &nbsp;luggage storage&nbsp;&nbsp; </td>
              <td>  <input type="checkbox" value="newspapers" name="facility[]">
                &nbsp;newspapers&nbsp;&nbsp;&nbsp;&nbsp; </td></tr>
             <tr>  <td> <input type="checkbox" value="shops" name="facility[]">
                &nbsp;shops&nbsp;&nbsp; </td></tr></table></div>
            </div>
            <div class="control-group group-container">
              <label for="textfield" class="control-label">Internet Facility</label>
              <div class="controls">
                <input type="checkbox" value="Free LAN and WiFi access" name="internetfacility">
                &nbsp;Free LAN and WiFi access&nbsp;&nbsp; </div>
            </div>
            <div class="control-group  group-container">
              <label for="textfield" class="control-label">Car Parking</label>
              <div class="controls">
                <input type="checkbox" value="Car Parking" name="carparking">
                &nbsp;Car Parking&nbsp;&nbsp; </div>
            </div>
            <div class="box-title">
          <h3> <i class="icon-ok"><img src="<?php echo WEB_DIR_ADMIN ?>css/icon_cancellation.png"></i>Cancellation Policy</h3>
        </div> 
        	<div class="group-container">
            <div id='TextBoxesGroup'>
              <div id="TextBoxDiv1">
                <div class="control-group">
					<br/>
                  <label for="textfield" class="control-label">Cancellation Policy</label>
                  <div class="controls">
                    <textarea name="cp" id="cp" rows="10" cols="10" data-rule-required="true"></textarea>
                    </div>
                </div>
              </div>
            </div>
             <br>
             <br>
            </div>
            
            <div class=" group-container">
            <div class="control-group">
              <label for="textfield" class="control-label">Average Price</label>
              <div class="controls">
                <input type="text" name="avarageprice" id="averageprice"  class="input-xlarge">
              </div>
            </div>
            <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter1 = 2;
						  
						  $("#addimage").click(function () {
								  
							  if(counter1>50){
								  alert("Only 20 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxFac' + counter1);
								 
					
							 newTextBoxDiv.after().html('<div class="control-group"><label for="textfield" class="control-label">Upload Image'+ counter1 + ' : </label><div class="controls">' +
								  '<input type="text" name="uploadimagename[]" id="uploadimagename[]"  class="input-xlarge"><input type="file" name="uploadimage[]" id="uploadimage[]"  class="input-xlarge"></div></div>'); 
							  newTextBoxDiv.appendTo("#TextBoxesGroup1");
								  
							  counter1++;
						  });
				  
						  $("#removeimage").click(function () {
							  if(counter1==1){
								  alert("No more textbox to remove");
								  return false;
							  }   
							  counter1--;
							  
							  $("#TextBoxFac" + counter1).remove();
						  });
						  
						
						  
					});
</script>
            <div id='TextBoxesGroup1'>
            <div id="TextBoxFac">
              <div class="control-group">
                <label for="textfield" class="control-label">Upload Image</label>
                <div class="controls">
                  <input type="text" name="uploadimagename[]" id="uploadimagename[]"  class="input-xlarge" data-rule-required="true">
                  <input type="file" name="uploadimage[]" id="uploadimage[]"  class="input-xlarge" data-rule-required="true">
                </div>
              </div>
             
            </div>
           </div>  <input type='button' value='Add Image' id='addimage'>
            <input type='button' value='Remove Image' id='removeimage'> 
            </div>
            
            <div class="form-actions">
              <input type="submit" class="btn btn-primary" value="Next">
              <a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard">
              <button type="button" class="btn">Cancel</button>
              </a> </div>
          </form>
        </div>
      </div>
    </div>
    
    
  </div>
</div>
</div>
</body>
</html>

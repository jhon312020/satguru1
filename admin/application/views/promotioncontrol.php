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

 <link rel="stylesheet" href="code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="code.jquery.com/jquery-1.9.1.js"></script>
<script src="code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
 <script>
$(function() {
$( "#datepicker" ).datepicker();
});
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
          <h1><?php echo $data['page_header'];?></h1>
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
          <h4><?php echo $hotel->HotelName; ?>,&nbsp;&nbsp;<?php echo $hotel->City;?>,&nbsp;&nbsp;<?php echo $hotel->Country;?></h4>
          <h3> <i class="icon-ok"></i> <?php echo $page_header;?> </h3>
        </div>
        <div class="box-content">
          <form action="<?php echo WEB_URL_ADMIN ?>admin/addpromotion/<?php echo $this->uri->segment(3);?>" method="POST" class='form-horizontal form-validate' id="bb" enctype="multipart/form-data">
            <div class="control-group">
             <input type='hidden'  name='id' value="<?php echo $hotel->hotel_id;?>" >
             
            </div>
          
            <?php $i =1; if(isset($room)) { if($room != '') { foreach($room as $list) { ?>
           
           <!--  Pay Stay Promotion--->	
            <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter = 2;
						  
						  $("#addpromotion<?php echo $i;?>").click(function () {
							 $('body').on('focus',".datepick", function(){
							$(this).datepicker();
						});	  
							  if(counter>10){
								  alert("Only 10 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxDivs<?php echo $i;?> = $(document.createElement('div')).attr("id", 'TextBoxDivs<?php echo $i;?>' + counter);
								 
						  
							 newTextBoxDivs<?php echo $i;?>.after().html('<div class="control-group"><label for="textfield" class="control-label">Room Rates'+ counter + ' : </label><div class="controls">' +
								  'From<input type="text" id="ratefrom[]" name="ratefrom[]"  class="input-xlarge datepick" style="width:50px;">To<input type="text" id="rateto[]" name="rateto[]"  class="input-xlarge datepick" style="width:50px;"> &nbsp;&nbsp;&nbsp;stay<input type="text" id="stay[]" name="stay[]"  class="" style="width:50px;"> &nbsp;&nbsp;&nbsp;pay<input type="text" id="pay[]" name="pay[]"  class="" style="width:50px;"><br/> <br/>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="breakfast[]" id="breakfast[]" value="yes">Breakfast included on the free nights <br> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             <input type="checkbox" name="breakfast[]" id="breakfast[]" value="no">Breakfast Chargable on the free nights  Rate<input type="text" id="breakrate[]" name="breakrate[]"  class="" style="width:50px;">Markup<input type="text" id="breakmarkup[]" name="breakmarkup[]"  class="" style="width:50px;"></div></div>  <input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->RoomCode; ?>"><br><br>'); 
							  newTextBoxDivs<?php echo $i;?>.appendTo("#TextBoxesGroups<?php echo $i;?>");
								  
							  counter++;
						  });
				  
						  $("#removepromotion<?php echo $i;?>").click(function () {
							  if(counter==1){
								  alert("No more textbox to remove");
								  return false;
							  }   
							  counter--;
							  
							  $("#TextBoxDivs<?php echo $i;?>" + counter).remove();
						  });
						  
						  $("#getButtonValue").click(function () {
						  
							  var msg = '';
							  for(i=1; i<counter; i++){
								  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();

							  }
							  alert(msg);
						  });
						  
					});
</script>

		<!--  % Discount--->	
			
			
			 <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter = 2;
						  
						  $("#adddiscount<?php echo $i;?>").click(function () {
							   $('body').on('focus',".datepick", function(){
							$(this).datepicker();
						});
								  
							  if(counter>10){
								  alert("Only 10 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxDiv<?php echo $i;?> = $(document.createElement('div')).attr("id", 'TextBoxDiv<?php echo $i;?>' + counter);
								 
						  
							 newTextBoxDiv<?php echo $i;?>.after().html('<div class="control-group"><label for="textfield" class="control-label">Discount '+ counter + ' : </label><div class="controls">' +
								  'From<input type="text" id="discountfrom[]" name="discountfrom[]"  class="input-xlarge datepick" style="width:50px;">&nbsp;Till&nbsp; <input type="text" id="discountto[]" name="discountto[]"  class="input-xlarge datepick" style="width:50px;"> &nbsp;&nbsp;&nbsp;Enjoy  <input type="text" id="discountrate[]" name="discountrate[]"  class="" style="width:50px;"> &nbsp;&nbsp;&nbsp; %</div></div>  <input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->RoomCode; ?>">'); 
							  newTextBoxDiv<?php echo $i;?>.appendTo("#TextBoxesGr<?php echo $i;?>");
								  
							  counter++;
						  });
				  
						  $("#removepromotion<?php echo $i;?>").click(function () {
							  if(counter==1){
								  alert("No more textbox to remove");
								  return false;
							  }   
							  counter--;
							  
							  $("#TextBoxDiv<?php echo $i;?>" + counter).remove();
						  });
						  
						  $("#getButtonValue").click(function () {
						  
							  var msg = '';
							  for(i=1; i<counter; i++){
								  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();

							  }
							  alert(msg);
						  });
						  
					});
</script>
			
		<!--  Room Price Discount--->	
			
			
			 <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter = 2;
						  
						  $("#addprice<?php echo $i;?>").click(function () {
							   $('body').on('focus',".datepick", function(){
							$(this).datepicker();
						});
								  
							  if(counter>10){
								  alert("Only 10 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxD<?php echo $i;?> = $(document.createElement('div')).attr("id", 'TextBoxD<?php echo $i;?>' + counter);
								 
						  
							 newTextBoxD<?php echo $i;?>.after().html('<div class="control-group"><label for="textfield" class="control-label"></label><div class="controls">' +
								  'From&nbsp;<input type="text" id="pricefrom[]" name="pricefrom[]"  class="input-xlarge datepick" style="width:50px;">&nbsp;Till&nbsp;<input type="text" id="priceto[]" name="priceto[]"  class="input-xlarge datepick" style="width:50px;"> &nbsp;&nbsp;&nbsp;Enjoy  <input type="text" id="pricerate[]" name="pricerate[]"  class="" style="width:50px;"> &nbsp;&nbsp;&nbsp;</div></div>  <input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->RoomCode; ?>"><br>'); 
							  newTextBoxD<?php echo $i;?>.appendTo("#TextBoxesG<?php echo $i;?>");
								  
							  counter++;
						  });
				  
						  $("#removeprice<?php echo $i;?>").click(function () {
							  if(counter==1){
								  alert("No more textbox to remove");
								  return false;
							  }   
							  counter--;
							  
							  $("#TextBoxD<?php echo $i;?>" + counter).remove();
						  });
						  
						  $("#getButtonValue").click(function () {
						  
							  var msg = '';
							  for(i=1; i<counter; i++){
								  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();

							  }
							  alert(msg);
						  });
						  
					});
</script>	
			<!--  Room Price Discount--->	
			
			
			 <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter = 2;
						  
						  $("#addweekend<?php echo $i;?>").click(function () {
								  
							  if(counter>10){
								  alert("Only 10 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxDive<?php echo $i;?> = $(document.createElement('div')).attr("id", 'TextBoxDive<?php echo $i;?>' + counter);
								 
						  
							 newTextBoxDive<?php echo $i;?>.after().html('<div class="control-group"><label for="textfield" class="control-label"></label><div class="controls">' +
								  'From <select name="weekdayfrom[]" style="width:50px;"><option value="Sunday">Sunday</option><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option></select>Till<select name="weekdaytill[]" style="width:50px;"><option value="Sunday">Sunday</option><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option  value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option> </select>&nbsp;&nbsp;&nbsp;Enjoy  <input type="text" id="weekendrate[]" name="weekendrate[]"  class="" style="width:50px;"> &nbsp;&nbsp;&nbsp; %</div></div>  <input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->RoomCode; ?>">'); 
							  newTextBoxDive<?php echo $i;?>.appendTo("#TextBoxesGre<?php echo $i;?>");
								  
							  counter++;
						  });
				  
						  $("#removeweekend<?php echo $i;?>").click(function () {
							  if(counter==1){
								  alert("No more textbox to remove");
								  return false;
							  }   
							  counter--;
							  
							  $("#TextBoxDive<?php echo $i;?>" + counter).remove();
						  });
						  
						  $("#getButtonValue").click(function () {
						  
							  var msg = '';
							  for(i=1; i<counter; i++){
								  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();

							  }
							  alert(msg);
						  });
						  
					});
</script>	


<!--  Upgrades--->	
			
			
			 <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter = 2;
						  
						  $("#addpromo<?php echo $i;?>").click(function () {
							   $('body').on('focus',".datepick", function(){
							$(this).datepicker();
						});
								  
							  if(counter>10){
								  alert("Only 10 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxV<?php echo $i;?> = $(document.createElement('div')).attr("id", 'TextBoxV<?php echo $i;?>' + counter);
								 
						  
							 newTextBoxV<?php echo $i;?>.after().html('<div class="control-group"><label for="textfield" class="control-label"></label><div class="controls">' +
								  'From <input type="text" id="upgradefrom[]" name="upgradefrom[]"  class="input-xlarge datepick" style="width:50px;">Till <input type="text" id="upgradeto[]" name="upgradeto[]"  class="input-xlarge datepick" style="width:50px;"> &nbsp;&nbsp;&nbsp;Promo  <input type="text" id="promo[]" name="promo[]"  class="" >  &nbsp;&nbsp;&nbsp;</div></div>  <input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->RoomCode; ?>">'); 
							  newTextBoxV<?php echo $i;?>.appendTo("#TextBoxP<?php echo $i;?>");
								  
							  counter++;
						  });
				  
						  $("#removepromo<?php echo $i;?>").click(function () {
							  if(counter==1){
								  alert("No more textbox to remove");
								  return false;
							  }   
							  counter--;
							  
							  $("#TextBoxV<?php echo $i;?>" + counter).remove();
						  });
						  
						  $("#getButtonValue").click(function () {
						  
							  var msg = '';
							  for(i=1; i<counter; i++){
								  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();

							  }
							  alert(msg);
						  });
						  
					});
</script>
			<script language="javascript">
            function sync2(textbox)
              {
            
              document.getElementById('roompricemarkup').value = textbox.value;
           
              }
            
            </script>
            
              <div class="box-title">
          <h3> <i class="icon-ok"></i>Room Type: <?php echo $list->RoomName; ?></h3>
        </div>
            
            
            <div id='TextBoxesGroups<?php echo $i;?>'>
            <div id="TextBoxDivs1<?php echo $i;?>">
            <h5>A. PAY-STAY PROMOTIONS</h5>
              <input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->RoomCode; ?>">
         
          
            <div class="control-group">
              <label for="textfield" class="control-label">Room Rates</label>
              <div class="controls"> From
                <input type='text' id="ratefrom[]" name="ratefrom[]"  class="input-xlarge datepick" style="width:50px;">
                To
                <input type='text' id="rateto[]" name="rateto[]"  class="input-xlarge datepick" style="width:50px;">
                &nbsp;&nbsp;&nbsp;stay
                <input type='text' id="stay[]" name="stay[]"  class="" style="width:50px;"> &nbsp;&nbsp;&nbsp;pay
                <input type='text' id="pay[]" name="pay[]"  class="" style="width:50px;">
                <br/><br/>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="breakfast[]" id="breakfast[]" value="yes">Breakfast included on the free nights <br> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <input type="checkbox" name="breakfast[]" id="breakfast[]" value="no">Breakfast Chargable on the free nights   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rate &nbsp;&nbsp;
                <input type='text' id="breakrate[]" name="breakrate[]"  class="" style="width:50px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Markup&nbsp;&nbsp;<input type='text' id="breakmarkup[]" name="breakmarkup[]"  class="" style="width:50px;"> <br/>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' value='Add More' id='addpromotion<?php echo $i;?>'>
            <input type='button' value='Remove More' id='removepromotion<?php echo $i;?>'> <br>
              </div>
            </div> </div><br></div> <hr/>
              <div id='TextBoxesGr<?php echo $i;?>'>
            <div id="TextBoxDiv1<?php echo $i;?>">
             <h5>B. %Discount</h5>
            <div class="control-group">
              <label for="textfield" class="control-label"></label>
              <div class="controls"> From
                <input type='text' id="discountfrom[]" name="discountfrom[]"  class="input-xlarge datepick" style="width:50px;">&nbsp;
               Till&nbsp;
                <input type='text' id="discountto[]" name="discountto[]"  class="input-xlarge datepick" style="width:50px;">
                &nbsp;&nbsp;&nbsp;Enjoy
                <input type='text' id="discountrate[]" name="discountrate[]"  class="" style="width:50px;"> &nbsp;&nbsp;&nbsp; % <br> <br>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='button' value='Add Discount' id='adddiscount<?php echo $i;?>'>
            <input type='button' value='Remove Discount' id='removediscount<?php echo $i;?>'> 
              </div>
            </div> <br><br></div></div><hr/>
            
            <h5>B. Room Price Discount</h5>
            
             <div id='TextBoxesG<?php echo $i;?>'>
            <div id="TextBoxD1<?php echo $i;?>">
            <div class="control-group">
              <label for="textfield" class="control-label"></label>
              <div class="controls"> From
                <input type='text' id="pricefrom[]" name="pricefrom[]"  class="input-xlarge datepick" style="width:50px;">
            
               Till
                <input type='text' id="priceto[]" name="priceto[]"  class="input-xlarge datepick" style="width:50px;">
                &nbsp;&nbsp;&nbsp;Enjoy
                <input type='text' id="pricerate[]" name="pricerate[]"  class="" style="width:50px;"> &nbsp;&nbsp;&nbsp; 
                <br/> <br>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <input type='button' value='Add more' id='addprice<?php echo $i;?>'>
            <input type='button' value='Remove more' id='removeprice<?php echo $i;?>'> 
             </div>
            </div> <br></div></div> <hr/> <h5>B. Week End Stay Promotion</h5>
            
             <div id='TextBoxesGre<?php echo $i;?>'>
            <div id="TextBoxDive1<?php echo $i;?>">
            <div class="control-group">
              <label for="textfield" class="control-label"></label>
              <div class="controls"> From
                <select name="weekdayfrom[]" style="width:50px;">
                  <option value="0">Sunday</option>
                  <option value="1">Monday</option>
                  <option value="2">Tuesday</option>
                  <option value="3">Wednesday</option>
                  <option value="4">Thursday</option>
                  <option value="5">Friday</option>
                  <option value="6">Saturday</option>
                </select>
                Till
                <select name="weekdaytill[]" style="width:50px;">
                  <option value="0">Sunday</option>
                  <option value="1">Monday</option>
                  <option value="2">Tuesday</option>
                  <option value="3">Wednesday</option>
                  <option value="4">Thursday</option>
                  <option value="5">Friday</option>
                  <option value="6">Saturday</option>
                </select>
                &nbsp;&nbsp;&nbsp;Enjoy
                <input type='text' id="weekendrate[]" name="weekendrate[]"  class="" style="width:50px;"> &nbsp;&nbsp;&nbsp; %
                <br/> 
              <input type='button' value='Add more' id='addweekend<?php echo $i;?>'>
            <input type='button' value='Remove more' id='removeweekend<?php echo $i;?>'> 
             </div>
            </div>  </div></div><hr/><h5>B. Upgrades/Value Adds</h5>
            
             <div id='TextBoxP<?php echo $i;?>'>
            <div id="TextBoxV<?php echo $i;?>">
            <div class="control-group">
              <label for="textfield" class="control-label"></label>
              <div class="controls"> From
                <input type='text' id="upgradefrom[]" name="upgradefrom[]"  class="input-xlarge datepick" style="width:50px;">
            
               Till
                <input type='text' id="upgradeto[]" name="upgradeto[]"  class="input-xlarge datepick" style="width:50px;">
                &nbsp;&nbsp;&nbsp;Promo
                <input type='text' id="promo[]" name="promo[]"  class="" > &nbsp;&nbsp;&nbsp; 
                <br/> 
              <input type='button' value='Add More ' id='addpromo<?php echo $i;?>'>
            <input type='button' value='Remove More' id='removepromo<?php echo $i;?>'> 
             </div>
            </div> </div></div>
            <hr/>
            <?php $i++;}}}?>
            <script>
				function sync(textbox)
				{
				  document.getElementById('extrabedchildmarkup').value = textbox.value;
				  document.getElementById('extrabedadultmarkup').value = textbox.value;
				}
				function sync1(textbox)
				{
				
				  document.getElementById('lunchmarkup').value = textbox.value;
				  document.getElementById('dinnermarkup').value = textbox.value;
				}
				
				</script>
           
            <div class="form-actions">
              <input type="submit" class="btn btn-primary" value="Save " name="saveadd1" id="saveadd1">
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

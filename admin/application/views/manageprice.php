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
          <form action="<?php echo WEB_URL_ADMIN ?>admin/addprice/<?php echo $this->uri->segment(3);?>" method="POST" class='form-horizontal form-validate' id="bb" enctype="multipart/form-data">
            <div class="control-group">
              <input type='hidden'  name='id' value="<?php echo $hotel->hotel_id;?>" >
              <label for="textfield" class="control-label">Default Currency</label>
              <div class="controls">
                <select name="currency" name="dcurrency" >
                <option value="SGD">SGD</option>
                <option value="USD">USD</option>
                </select>
              </div>
            </div> <br>
            <div class="control-group">
              <label for="textfield" class="control-label">Default Room Price Markup</label>
              <div class="controls">
                <input type='text' id='dmarkprice' name="dmarkprice"  onkeyup="sync2(this)" data-rule-required="true">
                in deafult currency stated above </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Default Extra Bed Markup</label>
              <div class="controls">
                <input type='text' id='dmarkbed' name="dmarkbed"  onkeyup="sync(this)" data-rule-required="true">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Default Meals Markup</label>
              <div class="controls">
                <input type='text' id="dmarkmeals" name="dmarkmeals" value="" onkeyup="sync1(this)" data-rule-required="true">
              </div>
            </div>
            <?php $i =1; if(isset($room)) { if($room != '') { foreach($room as $list) { ?>
            <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter = 2;
						  
						  $("#addButton<?php echo $i;?>").click(function () {
							   $('body').on('focus',".datepick", function(){
							$(this).datepicker();
						});
								  
							  if(counter>10){
								  alert("Only 10 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxDiv<?php echo $i;?> = $(document.createElement('div')).attr("id", 'TextBoxDiv<?php echo $i;?>' + counter);
								 
						  
							 newTextBoxDiv<?php echo $i;?>.after().html('<div class="control-group"><label for="textfield" class="control-label">Holiday Surcharges'+ counter + ' : </label><div class="controls">' +
								  '<input type="text" id="ratefromh[]" name="ratefromh[]"  class="input-xlarge datepick" style="width:70px;">Contract Rate:   <input type="text" id="ratetosurcharge[]" name="ratetosurcharge[]"  class="" style="width:70px;"></div></div>  <input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->RoomCode; ?>">'); 
							  newTextBoxDiv<?php echo $i;?>.appendTo("#TextBoxesGroup<?php echo $i;?>");
								  
							  counter++;
						  });
				  
						  $("#removeButton<?php echo $i;?>").click(function () {
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


 			function sync2(textbox)
             	 {
           
            		 var n1 = textbox.value;
					  var n2s = document.getElementsByName('roompricemarkup[]');
					 // alert(n2s.length);
					  for(var i=0; i<n2s.length;i++){
						  n2s[i].value = n1;
						 // alert(n2s[i].value);
					  }
					
					//document.getElementById('roompricemarkup[]').value = textbox.value;
					
           
             	 }

</script>

			
            
             <div class="box-title">
          <h3> <i class="icon-ok"></i>Room Type: <?php echo $list->RoomName; ?></h3>
        </div>
            
        <br>
              <input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->RoomCode; ?>">
         
          
            <div class="control-group">
              <label for="textfield" class="control-label">Room Rates- From</label>
              <div class="controls">
                <input type='text' id="ratefrom[]" name="ratefrom[]"  class="input-xlarge datepick" style="width:70px;" data-rule-required="true">
                To
                <input type='text' id="rateto[]" name="rateto[]"  class="input-xlarge datepick" style="width:70px;" data-rule-required="true">
                &nbsp;&nbsp;&nbsp;contract Rate
                <input type='text' id="contractrate[]" name="contractrate[]"  class="" style="width:70px;" data-rule-required="true">
                <br/>
                <!--<input type='button' value='Add Seasons' id='addButton<?php echo $i;?>'>
            <input type='button' value='Remove Seasonse' id='removeButton<?php echo $i;?>'>  --> 
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Room Price Markup</label>
              <div class="controls">
                <input type='text' id="roompricemarkup[]" name="roompricemarkup[]" data-rule-required="true">
                Change if different From Default </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Weekly Surcharges</label>
              <div class="controls">
                <select name="weekdayfrom[]" style="width:70px;">
                  <option value="0">Sun</option>
                  <option value="1">Mon</option>
                  <option value="2">Tue</option>
                  <option value="3">Wed</option>
                  <option value="4">Thur</option>
                  <option value="5">Fri</option>
                  <option value="6">Sat</option>
                </select>
                Till
                <select name="weekdaytill[]" style="width:70px;">
                  <option value="0">Sun</option>
                  <option value="1">Mon</option>
                  <option value="2">Tue</option>
                  <option value="3">Wed</option>
                  <option value="4">Thur</option>
                  <option value="5">Fri</option>
                  <option value="6">Sat</option>
                </select>
                &nbsp;Surcharge
                <input type="text" name="surcharge[]" id="surcharge[]" >
              </div>
            </div> 
            <br>
           
            
             <div id='TextBoxesGroup<?php echo $i;?>'>
            <div id="TextBoxDiv1<?php echo $i;?>">
            <div class="control-group">
              <label for="textfield" class="control-label">Holiday Surcharges</label>
              <div class="controls"> 
                <input type='text' id="ratefromh[]" name="ratefromh[]"  class="input-xlarge datepick" style="width:70px;">
              <!--  To
                <input type='text' id="ratetoh" name="ratetoh"  class="input-xlarge datepick" style="width:50px;">  -->
                &nbsp;&nbsp;&nbsp;contract Rate
                <input type='text' id="ratetosurcharge[]" name="ratetosurcharge[]"  class="" style="width:70px;">
                <br/> 
             
             </div>
            </div> <input type='button' value='Add Surcharge' id='addButton<?php echo $i;?>'>
            <input type='button' value='Remove Surcharge' id='removeButton<?php echo $i;?>'>  </div></div>
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
                
              
            <div class="control-group">
              <label for="textfield" class="control-label">Extra Bed for child 2-12</label>
              <div class="controls"> Price
                <input type='text' id="extrabedchildprice" name="extrabedchildprice" style="width:70px;" >
                Markup
                <input type='text' id="extrabedchildmarkup" name="extrabedchildmarkup" style="width:70px;">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Extra Bed for Adult</label>
              <div class="controls"> Price
                <input type='text' id="extrabedadultprice" name="extrabedadultprice" style="width:70px;" >
                Markup
                <input type='text' id="extrabedadultmarkup" name="extrabedadultmarkup" style="width:70px;">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Lunch</label>
              <div class="controls"> Price
                <input type='text' id="lunchprice" name="lunchprice" style="width:70px;" >
                Markup
                <input type='text' id="lunchmarkup" name="lunchmarkup" style="width:70px;">
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Dinner</label>
              <div class="controls"> Price
                <input type='text' id="dinnerprice" name="dinnerprice" style="width:70px;" >
                Markup
                <input type='text' id="dinnermarkup" name="dinnermarkup" style="width:70px;">
              </div>
            </div>
             <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter = 2;
						  
						  $("#addmeal<?php echo $i;?>").click(function () {
							   $('body').on('focus',".datepick", function(){
							$(this).datepicker();
						});
								  
							  if(counter>10){
								  alert("Only 10 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxDivs<?php echo $i;?> = $(document.createElement('div')).attr("id", 'TextBoxDivs<?php echo $i;?>' + counter);
								 
						  
							 newTextBoxDivs<?php echo $i;?>.after().html('<div class="control-group"><label for="textfield" class="control-label">Meal/Services Name'+ counter + ' : </label><div class="controls">' +
								  '<input type="text" id="mealname[]" name="mealname[]" style="width:50px;"></div></div><div class="control-group"><label for="textfield" class="control-label">Meal Date From'+ counter + ' : </label><div class="controls">' +
								  '<input type="text" id="mealdatefrom[]" name="mealdatefrom[]" style="width:50px;" class="input-xlarge datepick">To<input type="text" id="mealdateto[]" name="mealdateto[]" style="width:50px;" class="input-xlarge datepick"></div></div><div class="control-group"><label for="textfield" class="control-label">Price'+ counter + ' : </label><div class="controls">' +
								  '<input type="text" id="mealprice[]" name="mealprice[]" style="width:50px;" >Markup <input type="text" id="mealmarkup[]" name="mealmarkup[]" style="width:50px;"></div></div>'); 
							  newTextBoxDivs<?php echo $i;?>.appendTo("#TextBoxesGroups<?php echo $i;?>");
								  
							  counter++;
						  });
				  
						  $("#removemeal<?php echo $i;?>").click(function () {
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
             <div id='TextBoxesGroups<?php echo $i;?>'>
            <div id="TextBoxDivs<?php echo $i;?>">
               <div class="control-group">
              <label for="textfield" class="control-label">Meal/Services Name</label>
              <div class="controls">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                <input type='text' id="mealname[]" name="mealname[]" style="width:70px;" >
               
              </div>
            </div>              
             <div class="control-group">
              <label for="textfield" class="control-label">Date</label>
              <div class="controls">From 
                <input type='text' id="mealdatefrom[]" name="mealdatefrom[]" class="input-xlarge datepick" style="width:70px;"  >
                To&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                <input type='text' id="mealdateto[]" name="mealdateto[]" style="width:70px;" class="input-xlarge datepick" style="width:70px;">
              </div>
            </div>   
              <div class="control-group">
              <label for="textfield" class="control-label">Price</label>
              <div class="controls"> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                <input type='text' id="mealprice[]" name="mealprice[]" style="width:70px;" >
               Markup
                <input type='text' id="mealmarkup[]" name="mealmarkup[]" style="width:70px;">
              </div>
            </div> <input type='button' value='Add More ' id='addmeal<?php echo $i;?>'>
            <input type='button' value='Remove More' id='removemeal<?php echo $i;?>'>   </div></div>  
            <div class="form-actions">
              <input type="submit" class="btn btn-primary" value="Save and Add Promotion Control" name="saveadd1" id="saveadd1">
          <input type="submit" name="saveadd" id="saveadd" class="btn btn-primary" value="Save and Add New Room Rates "><!--  <a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard"> 
              <button type="button" class="btn">Cancel</button> -->
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

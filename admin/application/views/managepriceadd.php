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
            <input type='hidden'  name='id' value="<?php echo $hotel->hotel_id;?>" >
            <?php $i =1; if(isset($room)) { if($room != '') { foreach($room as $list) { ?>
            <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter = 2;
						  
						  $("#addButton<?php echo $i;?>").click(function () {
								  
							  if(counter>10){
								  alert("Only 10 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxDiv<?php echo $i;?> = $(document.createElement('div')).attr("id", 'TextBoxDiv<?php echo $i;?>' + counter);
								 
						  
							 newTextBoxDiv<?php echo $i;?>.after().html('<div class="control-group"><label for="textfield" class="control-label">Holiday Surcharges'+ counter + ' : </label><div class="controls">' +
								  '<input type="text" id="ratefromh[]" name="ratefromh[]"  class="input-xlarge datepick" style="width:50px;">Contract Rate:   <input type="text" id="ratetosurcharge[]" name="ratetosurcharge[]"  class="" style="width:50px;"></div></div>  <input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->RoomCode; ?>">'); 
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
</script> 
            <script language="javascript">
            function sync2(textbox)
              {
            
              document.getElementById('roompricemarkup').value = textbox.value;
           
              }
            
            </script>
            <h4>Room Type: <?php echo $list->RoomName; ?></h4>
            <input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->RoomCode; ?>">
            <input type="hidden" name="addid" id="addid" value="1">
            
            <div class="control-group">
              <label for="textfield" class="control-label">Room Rates</label>
              <div class="controls"> From
                <input type='text' id="ratefrom[]" name="ratefrom[]"  class="input-xlarge datepick" style="width:50px;">
                To
                <input type='text' id="rateto[]" name="rateto[]"  class="input-xlarge datepick" style="width:50px;">
                &nbsp;&nbsp;&nbsp;contract Rate
                <input type='text' id="contractrate[]" name="contractrate[]"  class="" style="width:50px;">
                <br/>
              
              </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Room Price Markup</label>
              <div class="controls">
                <input type='text' id="roompricemarkup[]" name="roompricemarkup[]" >
                Change if different From Default </div>
            </div>
            <div class="control-group">
              <label for="textfield" class="control-label">Weekly Surcharges</label>
              <div class="controls">
                <select name="weekdayfrom[]" style="width:50px;">
                  <option value="Sunday">Sunday</option>
                  <option value="Monday">Monday</option>
                  <option value="Tuesday">Tuesday</option>
                  <option value="Wednesday">Wednesday</option>
                  <option value="Thursday">Thursday</option>
                  <option value="Friday">Friday</option>
                  <option value="Saturday">Saturday</option>
                </select>
                Till
                <select name="weekdaytill[]" style="width:50px;">
                  <option value="Sunday">Sunday</option>
                  <option value="Monday">Monday</option>
                  <option value="Tuesday">Tuesday</option>
                  <option value="Wednesday">Wednesday</option>
                  <option value="Thursday">Thursday</option>
                  <option value="Friday">Friday</option>
                  <option value="Saturday">Saturday</option>
                </select>
                &nbsp;Surcharge
                <input type="text" name="surcharge[]" id="surcharge[]">
              </div>
            </div>
            <div id='TextBoxesGroup<?php echo $i;?>'>
              <div id="TextBoxDiv1<?php echo $i;?>">
                <div class="control-group">
                  <label for="textfield" class="control-label">Holiday Surcharges</label>
                  <div class="controls">
                    <input type='text' id="ratefromh[]" name="ratefromh[]"  class="input-xlarge datepick" style="width:50px;">
                  
                    &nbsp;&nbsp;&nbsp;contract Rate
                    <input type='text' id="ratetosurcharge[]" name="ratetosurcharge[]"  class="" style="width:50px;">
                    <br/>
                    <input type='button' value='Add Surcharge' id='addButton<?php echo $i;?>'>
                    <input type='button' value='Remove Surcharge' id='removeButton<?php echo $i;?>'>
                  </div>
                </div>
              </div>
            </div>
            <hr/>
            <?php $i++;}}}?>
            <div class="form-actions">
              <input type="submit" class="btn btn-primary" value="Save and Add Promotion Control" name="saveadd1" id="saveadd1">
              <input type="submit" name="saveadd" id="saveadd" class="btn btn-primary" value="Save and Add New Room Rates ">
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

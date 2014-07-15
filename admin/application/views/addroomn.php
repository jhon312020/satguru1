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
          <h3> <i class="icon-ok"></i> <?php echo $page_header;?> </h3>
        </div>
        <div class="box-content">
          <form action="<?php echo WEB_URL_ADMIN ?>admin/addnewroom/<?php echo $this->uri->segment(3);?>/1" method="POST" class='form-horizontal form-validate' id="bb" enctype="multipart/form-data">
            <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter = 2;
						  
						  $("#addButton").click(function () {
								  
							  if(counter>10){
								  alert("Only 10 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
								 
						  
							 newTextBoxDiv.after().html('<div class="control-group"><label for="textfield" class="control-label">Roomname'+ counter + ' : </label><div class="controls">' +
								  '<input type="text" name="roomname[]" id="roomname[]" data-rule-required="true"></div></div><div class="control-group"><label for="textfield" class="control-label">Room Size'+ counter + ' : </label><div class="controls">' +
								  '<input type="text" name="roomsize[]" id="roomsize[]" data-rule-required="true"></div></div><div class="control-group"><label for="textfield" class="control-label">Beds'+ counter + ' : </label><div class="controls">' +
								  '<input type="text" name="beds[]" id="beds[]" value="" ></div></div><div class="control-group"><label for="textfield" class="control-label">Extra Bed Availability'+ counter + ' : </label><div class="controls">' +
								  '<input type="checkbox" id="extrabed[]" name="extrabed[]" value="yes">&nbsp;Yes <input type="checkbox" id="extrabed[]" name="extrabed[]" value="no">&nbsp;No</div></div><div class="control-group"><label for="textfield" class="control-label">Description'+ counter + ' : </label><div class="controls">' +
								  '<textarea name="description[]" id="description[]" ></textarea></div></div><div class="control-group"><label for="textfield" class="control-label">Room Features'+ counter + ' : </label><div class="controls"><table><tr><td>' +
								  '<input type="checkbox" name="roomfeature[]" value="air conditioning">&nbsp;air conditioning </td><td><input type="checkbox" name="roomfeature[]" value="separate shower and tub">&nbsp;separate shower and tub</td><td><input type="checkbox" name="roomfeature[]" value="ironing facilities">&nbsp;ironing facilities</td></tr><tr><td><input type="checkbox" name="roomfeature" value="mini bar[]">&nbsp;mini bar </td><td> <input type="checkbox" name="roomfeature[]" value="daily newspaper">&nbsp;daily newspaper</td><td><input type="checkbox" name="roomfeature[]" value="desk">&nbsp;desk </td></tr><tr><td><input type="checkbox" name="roomfeature[]" value="shower">&nbsp;shower</td><td><input type="checkbox" name="roomfeature[]" value="complimentary bottled water">&nbsp;complimentary bottled water</td><td><input type="checkbox" name="roomfeature[]" value="satellite/cable TV">&nbsp;satellite/cable TV </td></tr><tr><td><input type="checkbox" name="roomfeature[]" value="bathtub">&nbsp;bathtub </td><td><input type="checkbox" name="roomfeature[]" value="hair dryer">&nbsp;hair dryer</td><td><input type="checkbox" name="roomfeature[]" value="bathrobes">&nbsp;bathrobes</td><tr><td><input type="checkbox" name="roomfeature[]" value="seating area">&nbsp;seating area </td><td> <input type="checkbox" name="roomfeature[]" value="Free WiFi">&nbsp;Free WiFi</td><td><input type="checkbox" name="roomfeature[]" value="coffee/tea maker">&nbsp;coffee/tea maker</td></tr></table></div></div> <br><div class="control-group"><label for="textfield" class="control-label">Room Image'+ counter + ' : </label><div class="controls">' +
								  ' <input type="file" name="roomimage[]"></div></div>'); 
							  newTextBoxDiv.appendTo("#TextBoxesGroup");
								  
							  counter++;
						  });
				  
						  $("#removeButton").click(function () {
							  if(counter==1){
								  alert("No more textbox to remove");
								  return false;
							  }   
							  counter--;
							  
							  $("#TextBoxDiv" + counter).remove();
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
            <div id='TextBoxesGroup'>
              <div id="TextBoxDiv1">
                <div class="control-group">
                 <input type='hidden'  name='id' value="<?php echo $hotel->hotel_id;?>" >
                  <label for="textfield" class="control-label">Room Name</label>
                  <div class="controls">
                    <input type='text' id='roomname[]' name='roomname[]' data-rule-required="true">
                  </div>
                </div>
                <div class="control-group">
                  <label for="textfield" class="control-label">Room Size</label>
                  <div class="controls">
                    <input type='text' id='roomsize[]' name="roomsize[]" data-rule-required="true">
                  </div>
                </div>
                <div class="control-group">
                  <label for="textfield" class="control-label">Beds</label>
                  <div class="controls">
                    <input type='text' id='beds[]' name="beds[]" data-rule-required="true">
                  </div>
                </div>
                  <div class="control-group">
                  <label for="textfield" class="control-label">Extra Bed Availability</label>
                  <div class="controls">
                    <input type='checkbox' id="extrabed[]" name="extrabed[]" value="yes">&nbsp;Yes <input type='checkbox' id="extrabed[]" name="extrabed[]" value="no" >&nbsp;No
                  </div>
                </div>
                <div class="control-group">
                  <label for="textfield" class="control-label">Description</label>
                  <div class="controls">
                   <textarea name="description[]" data-rule-required="true"></textarea>
                  </div>
                </div> <br>
                 <div class="control-group">
                  <label for="textfield" class="control-label">Room Features</label>
                  <div class="controls"> <table><tr><td>
                  <input type="checkbox" name="roomfeature[]" value="air conditioning">&nbsp;air conditioning </td> <td>
                  <input type="checkbox" name="roomfeature[]" value="separate shower and tub">&nbsp;separate shower and tub </td><td>
                  <input type="checkbox" name="roomfeature[]" value="ironing facilities">&nbsp;ironing facilities </td></tr> <tr><td>
         <input type="checkbox" name="roomfeature" value="mini bar[]">&nbsp;mini bar </td>
               <td>   <input type="checkbox" name="roomfeature[]" value="daily newspaper">&nbsp;daily newspaper </td>
                  <td><input type="checkbox" name="roomfeature[]" value="desk">&nbsp;desk  </td></tr>
               <tr><td>   <input type="checkbox" name="roomfeature[]" value="shower">&nbsp;shower</td>
           <td>          <input type="checkbox" name="roomfeature[]" value="complimentary bottled water">&nbsp;complimentary bottled water </td>
                 <td> <input type="checkbox" name="roomfeature[]" value="satellite/cable TV">&nbsp;satellite/cable TV  </td> <td>
                 <input type="checkbox" name="roomfeature[]" value="bathtub">&nbsp;bathtub </td></tr><tr>
          <td>             <input type="checkbox" name="roomfeature[]" value="hair dryer">&nbsp;hair dryer </td> <td>
                   <input type="checkbox" name="roomfeature[]" value="bathrobes">&nbsp;bathrobes  </td> <td>
                    <input type="checkbox" name="roomfeature[]" value="seating area">&nbsp;seating area </td></tr><tr><td>
                     <input type="checkbox" name="roomfeature[]" value="Free WiFi">&nbsp;Free WiFi  </td><td>      
                      <input type="checkbox" name="roomfeature[]" value="coffee/tea maker">&nbsp;coffee/tea maker </td></tr></table>
                  </div>
                </div> <br><br>
                 <div class="control-group">
                  <label for="textfield" class="control-label">Room Image</label>
                  <div class="controls">
                  <input type="file" name="roomimage[]">
                  </div>
                </div>
              </div>
            </div>
            <input type='button' value='Add Room' id='addButton'>
            <input type='button' value='Remove Room' id='removeButton'>
            <div class="form-actions">
              <input type="submit" class="btn btn-primary" value="Submit">
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

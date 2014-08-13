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
          <h1><?php //echo $data['page_header'];?></h1>
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
        <form action="<?php echo WEB_URL_ADMIN ?>admin/addnewprice/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>" method="POST" class='form-horizontal form-validate' id="bb" enctype="multipart/form-data">
          <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter = 2;
						 
						  $("#addButton").click(function () {
								  
							 
							  if(counter>10){
								  alert("Only 10 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
								 
						  
							 newTextBoxDiv.after().html('<div class="control-group"><label for="textfield" class="control-label">Room Rates- From'+ counter + ' : </label><div class="controls">' +
								  '<input type="text" id="ratefrom[]" name="ratefrom[]"  class="input-xlarge datepick" style="width:70px;">To<input type="text" id="rateto[]" name="rateto[]"  class="input-xlarge datepick" style="width:70px;">  &nbsp;&nbsp;&nbsp;contract Rate <input type="text" id="contractrate[]" name="contractrate[]"  class="" style="width:70px;"></div></div> <div class="control-group"><label for="textfield" class="control-label">Room Price Markup'+ counter + ' : </label><div class="controls">' +
								  '<input type="text" id="roompricemarkup[]" name="roompricemarkup[]" >Change if different From Default</div></div> <div class="control-group"><label for="textfield" class="control-label">Weekly Surcharges'+ counter + ' : </label><div class="controls">' +
								  '<select name="weekdayfrom[]" style="width:70px;">  <option value="0">Sun</option><option value="1">Mon</option><option value="2">Tue</option><option value="3">Wed</option><option value="4">Thur</option><option value="5">Fri</option><option value="6">Sat</option></select> Till <select name="weekdaytill[]" style="width:70px;"><option value="0">Sun</option>               <option value="1">Mon</option><option value="2">Tue</option><option value="3">Wed</option><option value="4">Thur</option><option value="5">Fri</option><option value="6">Sat</option></select>&nbsp;Surcharge<input type="text" name="surcharge[]" id="surcharge[]"></div></div><hr/><input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->Roomcode; ?>">'); 
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
          <script type="text/javascript">

					  $(document).ready(function(){
				  
						  var counter = 2;
						  
						  $("#addButton1").click(function () {
								  
							  if(counter>10){
								  alert("Only 10 textboxes allow");
								  return false;
							  }   
							  
							  var newTextBoxDi = $(document.createElement('div')).attr("id", 'TextBoxDi<?php echo $i;?>' + counter);
								 
						  
							 newTextBoxDi.after().html('<div class="control-group"><label for="textfield" class="control-label">Holiday Surcharges'+ counter + ' : </label><div class="controls">' +
								  '<input type="text" id="ratefromh[]" name="ratefromh[]"  class="input-xlarge datepick" style="width:70px;">Contract Rate:   <input type="text" id="ratetosurcharge[]" name="ratetosurcharge[]"  class="" style="width:70px;"></div></div>  <input type="hidden" name="roomid[]" id="roomid[]" value="<?php echo $list->Roomcode; ?>">'); 
							  newTextBoxDi.appendTo("#TextBoxesGroups");
								  
							  counter++;
						  });
				  
						  $("#removeButton1").click(function () {
							  if(counter==1){
								  alert("No more textbox to remove");
								  return false;
							  }   
							  counter--;
							  
							  $("#TextBoxDi" + counter).remove();
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
                  <input type="text" name="surcharge[]" id="surcharge[]">
                </div>
              </div>
             <!-- <input type='button' value='Add More' id='addButton'>
              <input type='button' value='Remove More' id='removeButton'>  -->
            </div>
          </div>
          <div id='TextBoxesGroups'>
            <div id="TextBoxDi">
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
              </div>
            <!--  <input type='button' value='Add Surcharge' id='addButton1'>
              <input type='button' value='Remove Surcharge' id='removeButton1'>  -->
            </div>
          </div>
          </div>
          <div class="form-actions">
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard">
            <button type="button" class="btn">Cancel</button>
            </a> </div>
        </form>
      </div>
      <div class="box box-color box-bordered red">
        <div class="box-title">
          <h3> <i class="icon-table"></i> <?php echo $page_header1;?> </h3>
          <h4 align="right"></h4>
        </div>
        <script type="text/javascript"  language="javascript">
							  function confirm_delete(id,roomcode,hotelid,orgcode)
							  {
								
								  var r=confirm("Are you sure you want to delete?");
							  if (r==true)
								{
								self.location="<?php echo WEB_URL_ADMIN ?>admin/delete_price/"+id+"/"+roomcode+"/"+hotelid+"/"+orgcode;
								}
							  else
								{
								
								}
							  }
							  </script>
        <div class="box-content nopadding">
          <table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Ratefrom</th>
                <th>Rateto</th>
                <th>Rate</th>
                <th>Markup</th>
                <th>From-to</th>
                <th>Surcharge</th>
                
              </tr>
            </thead>
            <tbody>
              <?php $i =1; if(isset($price)) { if($price != '') { foreach($price as $list) { 
									if($list->weekdayfrom=='0')
										$weekdayfrom='Sunday';
									if($list->weekdayfrom=='1')
										$weekdayfrom='Monday';
									if($list->weekdayfrom=='2')
										$weekdayfrom='Tuesday';
									if($list->weekdayfrom=='3')
										$weekdayfrom='Wednesday';
									if($list->weekdayfrom=='4')
										$weekdayfrom='Thursday';
									if($list->weekdayfrom=='5')
										$weekdayfrom='Friday';
									if($list->weekdayfrom=='6')
										$weekdayfrom='Saturday';
											
									if($list->weekdaytill=='0')
										$weekdaytill='Sunday';
									if($list->weekdaytill=='1')
										$weekdaytill='Monday';
									if($list->weekdaytill=='2')
										$weekdaytill='Tuesday';
									if($list->weekdaytill=='3')
										$weekdaytill='Wednesday';
									if($list->weekdaytill=='4')
										$weekdaytill='Thursday';
									if($list->weekdaytill=='5')
										$weekdaytill='Friday';
									if($list->weekdaytill=='6')
										$weekdaytill='Saturday';
										
										
										?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $list->ratefrom; ?></td>
                <td><?php echo $list->rateto; ?></td>
                <td><?php echo $list->contractrate; ?></td>
                <td><?php echo $list->roompricemarkup; ?></td>
                <td><?php echo $weekdayfrom; ?>/<?php echo $weekdaytill; ?></td>
                <td><?php echo $list->surcharge; ?></td>
                 <td><a href="<?php echo WEB_URL_ADMIN ?>admin/editroomprice/<?php echo $list->id; ?>/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Edit</td><td><a href="javascript:confirm_delete('<?php echo $list->id; ?>','<?php echo $list->Roomcode;?>','<?php echo $list->HotelCode;?>','<?php echo $this->uri->segment(3);?>')">Delete</td>
              </tr>
              <?php $i++;} } } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</body>
</html>

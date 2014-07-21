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
        <form action="<?php echo WEB_URL_ADMIN ?>admin/editprice/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>/<?php echo $this->uri->segment(5);?>" method="POST" class='form-horizontal form-validate' id="bb" enctype="multipart/form-data">
         
          <div id='TextBoxesGroup'>
            <div id="TextBoxDiv1">
              <div class="control-group">
                <label for="textfield" class="control-label">Room Rates- From</label>
                <input type='hidden' name="id"  class="input-xlarge datepick" style="width:70px;" value="<?php echo $roomprice->id;?>" >
                <div class="controls"> 
                  <input type='text' id="ratefrom" name="ratefrom"  class="input-xlarge datepick" style="width:70px;" value="<?php if($roomprice->ratefrom!= '') { echo $roomprice->ratefrom; } ?>" data-rule-required="true">
                  To
                  <input type='text' id="rateto" name="rateto"  class="input-xlarge datepick" style="width:70px;"  value="<?php if($roomprice->rateto!= '') { echo $roomprice->rateto; } ?>" data-rule-required="true">
                  &nbsp;&nbsp;&nbsp;contract Rate
                  <input type='text' id="contractrate" name="contractrate"  class="" style="width:70px;" value="<?php if($roomprice->contractrate!= '') { echo $roomprice->contractrate; } ?>" data-rule-required="true">
                  <br/>
                  <!--<input type='button' value='Add Seasons' id='addButton<?php echo $i;?>'>
            <input type='button' value='Remove Seasonse' id='removeButton<?php echo $i;?>'>  --> 
                </div>
              </div>
              <div class="control-group">
                <label for="textfield" class="control-label">Room Price Markup</label>
                <div class="controls">
                  <input type='text' id="roompricemarkup" name="roompricemarkup" value="<?php if($roomprice-> roompricemarkup != '') { echo $roomprice-> roompricemarkup ; } ?>" data-rule-required="true">
                  Change if different From Default </div>
              </div>
              <div class="control-group">
                <label for="textfield" class="control-label">Weekly Surcharges</label>
                <div class="controls"><select name="weekdayfrom" style="width:70px;">
                    <option value="0" <?php 
            if($roomprice->weekdayfrom=="0")echo ' selected="selected"';
        ?>>Sun</option>
                    <option value="1" 
					<?php if($$roomprice->weekdayfrom=="1")echo 'selected="selected"';
        ?>>Mon</option>
                    <option value="2" <?php
            if($roomprice->weekdayfrom=="2")echo ' selected="selected"';
        ?>>Tue</option>
                    <option value="3" <?php
            if($roomprice->weekdayfrom=="3")echo ' selected="selected"';
        ?>>Wed</option>
                    <option value="4" <?php
            if($roomprice->weekdayfrom=="4")echo ' selected="selected"';
        ?>>Thur</option>
                    <option value="5" <?php
            if($roomprice->weekdayfrom=="5")echo ' selected="selected"';
        ?>>Fri</option>
                    <option value="6" <?php
            if($roomprice->weekdayfrom=="6")echo ' selected="selected"';
        ?>>Sat</option>
                  </select>
                  Till
                  <select name="weekdaytill" style="width:70px;">
                    <option value="0" <?php 
            if($roomprice->weekdaytill=="0")echo ' selected="selected"';
        ?>>Sun</option>
                    <option value="1" <?php 
            if($roomprice->weekdaytill=="1")echo ' selected="selected"';
        ?>>Mon</option>
                    <option value="2" <?php 
            if($roomprice->weekdaytill=="2")echo ' selected="selected"';
        ?>>Tue</option>
                    <option value="3" <?php 
            if($roomprice->weekdaytill=="3")echo ' selected="selected"';
        ?>>Wed</option>
                    <option value="4" <?php 
            if($roomprice->weekdaytill=="4")echo ' selected="selected"';
        ?>>Thur</option>
                    <option value="5" <?php 
            if($roomprice->weekdaytill=="5")echo ' selected="selected"';
        ?>>Fri</option>
                    <option value="6" <?php 
            if($roomprice->weekdaytill=="6")echo ' selected="selected"';
        ?>>Sat</option>
                  </select>
                  &nbsp;Surcharge
                  <input type="text" name="surcharge" id="surcharge" value="<?php if($roomprice->surcharge != '') { echo $roomprice->surcharge; } ?>">
                </div>
              </div>
             
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
      
      </div>
    </div>
  </div>
</div>
</div>
</div>
</body>
</html>

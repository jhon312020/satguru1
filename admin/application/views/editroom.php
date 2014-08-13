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
						<h1><?php if (isset($data)) echo $data['page_header'];?></h1>
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
								<?php if (isset($data)) echo $data['page_header'];?>
								</h3>
                              
							</div>
							<div class="box-content">
								<form action="<?php echo WEB_URL_ADMIN ?>admin/updateroom/<?php echo $roomdisplay->HotelCode;?>" method="POST" class='form-horizontal form-validate' id="bb" enctype="multipart/form-data">
									
				                                 
                                
                                 
                                    <div class="control-group">
										<label for="textfield" class="control-label">Room Name</label>
										<div class="controls">
											<input type="text" name="RoomName" id="RoomName" class="input-xlarge" data-rule-required="true" data-rule-minlength="2"  value="<?php if($roomdisplay->RoomName  != '') { echo $roomdisplay->RoomName ; } ?>"/>
											
										</div>
									</div>
                                    <input type="hidden" name="id" value="<?php echo $roomdisplay->id; ?>">     
									<div class="control-group">
                  <label for="textfield" class="control-label">Room Size</label>
                  <div class="controls">
                    <input type='text' id='roomsize' name="roomsize" value="<?php if($roomdisplay->roomsize!= '') { echo $roomdisplay->roomsize; } ?>" data-rule-required="true">
                  </div>
                </div>
                <div class="control-group">
                  <label for="textfield" class="control-label">Beds</label>
                  <div class="controls">
                    <input type='text' id='beds' name="beds" value="<?php if($roomdisplay->beds!= '') { echo $roomdisplay->beds; } ?>" data-rule-required="true">
                  </div>
                </div>
                  <div class="control-group">
                  <label for="textfield" class="control-label">Extra Bed Availability</label>
                  <div class="controls">
                    <input type='checkbox' id="extrabed" name="extrabed" value="yes"  <?php if($roomdisplay->extrabed=='yes') echo ' checked="checked"';?>>&nbsp;Yes <input type='checkbox' id="extrabed" name="extrabed" value="no" <?php if($roomdisplay->extrabed=='no') echo ' checked="checked"';?>>&nbsp;No
                  </div>
                </div>
                <div class="control-group">
                  <label for="textfield" class="control-label">Description</label>
                  <div class="controls">
                   <textarea name="description" data-rule-required="true"><?php if($roomdisplay->description   != '') { echo $roomdisplay->description ; } ?></textarea>
                  </div>
                </div> <br>
                
                 <?php $fa1 = $fa2 = $fa3 = $fa4 = $fa5 = $fa6 = $fa7 = $fa8 = $fa9 = $fa10 = $fa11 = $fa12 = $fa13 = $fa14 = $fa15 = ''; $i =1; if(isset($aminity)) { if($aminity != '') { foreach($aminity as $list) { ?> 
          <?php  
			
	  		  if($list->RoomAmenities=='air conditioning')
			   	$fa1='yes';
					else
				$fa1='';
				
			 if($list->RoomAmenities=='separate shower and tub')
			  $fa2='yes';
					else
				$fa2='';
			 if($list->RoomAmenities=='ironing facilities')
			   	$fa3='yes';
					else
				$fa3='';
			 if($list->RoomAmenities=='mini bar')
			   	$fa4='yes';
					else
				$fa4='';
			 if($list->RoomAmenities=='daily newspaper')
			   	$fa5='yes';
					else
				$fa5='';
				
			 if($list->RoomAmenities=='desk')
			   	$fa6='yes';
					else
				$fa6='';
				
			 if($list->RoomAmenities=='shower')
			   	$fa7='yes';
					else
				$fa7='';
			 if($list->RoomAmenities=='complimentary bottled water')
			   	$fa8='yes';
					else
				$fa8='';
			 if($list->RoomAmenities=='satellite/cable TV')
			   	$fa9='yes';
					else
				$fa9='';
			 if($list->RoomAmenities=='bathtub')
			   	$fa10='yes';
					else
				$fa10='';
				
			 if($list->RoomAmenities=='hair dryer')
			   	$fa11='yes';
					else
				$fa11='';
			 if($list->RoomAmenities=='bathrobes')
			   	$fa12='yes';
					else
				$fa12=''; 
			if($list->RoomAmenities=='seating area')
			 $fa13='yes';
					else
				$fa13=''; 
			if($list->RoomAmenities=='Free WiFi')
			   	$fa14='yes';
					else
				$fa14='';
			 if($list->RoomAmenities=='coffee/tea maker')
			   $fa15='yes';
					else
				$fa15=''; 
		   ?>
          
          <?php }}}?> 
                
                 <div class="control-group">
                  <label for="textfield" class="control-label">Room Features</label>
                  <div class="controls"> <table><tr><td>
                  <input type="checkbox" name="roomfeature[]" value="air conditioning"  <?php if($fa1!='') echo ' checked="checked"';?>>&nbsp;air conditioning </td> <td>
                  <input type="checkbox" name="roomfeature[]" value="separate shower and tub"  <?php if($fa2!='') echo ' checked="checked"';?>>&nbsp;separate shower and tub </td><td>
                  <input type="checkbox" name="roomfeature[]" value="ironing facilities"  <?php if($fa3!='') echo ' checked="checked"';?>>&nbsp;ironing facilities </td></tr> <tr><td>
         <input type="checkbox" name="roomfeature" value="mini bar[]"  <?php if($fa4!='') echo ' checked="checked"';?>>&nbsp;mini bar </td>
               <td>   <input type="checkbox" name="roomfeature[]" value="daily newspaper"  <?php if($fa5!='') echo ' checked="checked"';?>>&nbsp;daily newspaper </td>
                  <td><input type="checkbox" name="roomfeature[]" value="desk"  <?php if($fa6!='') echo ' checked="checked"';?>>&nbsp;desk  </td></tr>
               <tr><td>   <input type="checkbox" name="roomfeature[]" value="shower"  <?php if($fa7!='') echo ' checked="checked"';?>>&nbsp;shower</td>
           <td>          <input type="checkbox" name="roomfeature[]" value="complimentary bottled water"  <?php if($fa8!='') echo ' checked="checked"';?>>&nbsp;complimentary bottled water </td>
                 <td> <input type="checkbox" name="roomfeature[]" value="satellite/cable TV"  <?php if($fa9!='') echo ' checked="checked"';?>>&nbsp;satellite/cable TV  </td> <td>
                 <input type="checkbox" name="roomfeature[]" value="bathtub"  <?php if($fa10!='') echo ' checked="checked"';?>>&nbsp;bathtub </td></tr><tr>
          <td>             <input type="checkbox" name="roomfeature[]" value="hair dryer"  <?php if($fa11!='') echo ' checked="checked"';?>>&nbsp;hair dryer </td> <td>
                   <input type="checkbox" name="roomfeature[]" value="bathrobes"  <?php if($fa12!='') echo ' checked="checked"';?>>&nbsp;bathrobes  </td> <td>
                    <input type="checkbox" name="roomfeature[]" value="seating area"  <?php if($fa13!='') echo ' checked="checked"';?>>&nbsp;seating area </td></tr><tr><td>
                     <input type="checkbox" name="roomfeature[]" value="Free WiFi"  <?php if($fa14!='') echo ' checked="checked"';?>>&nbsp;Free WiFi  </td><td>      
                      <input type="checkbox" name="roomfeature[]" value="coffee/tea maker"  <?php if($fa15!='') echo ' checked="checked"';?>>&nbsp;coffee/tea maker </td></tr></table>
                  </div>
                </div> 
                                    
                                    
                                    
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Submit">
										<a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard"><button type="button" class="btn">Cancel</button></a>
									</div>
								</form>
							</div>
						</div>
				
			</div>
				
			
				
			</div>
		</div></div>
		
	</body>

	</html>


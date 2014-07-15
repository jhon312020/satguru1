<!doctype html>
<html>
<title>Api Management</title>
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
<body>
	
	
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
					</ul>
			<?php $this->load->view('topmenu'); ?>
		</div>
	</div>
	<div class="container-fluid" id="content">
		
		<?php $this->load->view('leftmenu'); ?>
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>API Management</h1>
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
									<span class="big"><?php echo date("F d, Y"); ?></span>
									<span><?php echo date("l"); ?></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				
				
				
				
			  <div class="box box-color box-bordered red">
							<div class="span6">
							<div class="box box-bordered">
								<div class="box-title" style="width:981px">
									<ul class="tabs tabs-left">
										<li class="active">
											<a href="#t10" data-toggle="tab">List API</a>
										</li>
									
									</ul>
									
								</div>
								<div class="box-content" style="width: 951px;">
									<div class="tab-content">
										<div class="tab-pane active" id="t10">
											
												<div class="box-content nopadding" style="border:none;">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Api Name</th>
											<th>Crediential</th>
											<th class='hidden-480'>Status</th>
											<th class='hidden-480'>Edit</th>
										</tr>
									</thead>
									<tbody>
									<?php if(isset($api)) { if($api != '') { foreach($api as $ap) {
										
										
										 ?>
										<tr>
											<td><?php echo $ap->api_name; ?></td>
                                            <td>
                                            <?php echo $ap->username; ?><br><?php echo $ap->username1; ?>
                                                <br>
                                                <?php echo $ap->username2; ?>
                                                <br>
                                                <?php echo $ap->password; ?><br>
                                                <?php echo $ap->url1; ?><br>
                                                <?php echo $ap->url2; ?></td>
					<td class='hidden-480'>
                       <?php
					  $api = $this->Home_Model->get_api_det_v1($ap->api_id);
					 
					    if($api->status=='1')
					   {
						   echo 'Activate';
					   }
					   else
					   {
						  echo 'Deactivate';
					   }
						 ?>
                    </td>					
											<td class='hidden-480'><a href="<?php echo WEB_URL_ADMIN ?>admin/editapi/<?php echo $ap->api_id; ?>">Update</a> | 
                                        <?php if($api->status=='1')
					   {
						 ?>
                         <a href="<?php echo WEB_URL_ADMIN ?>admin/updateapistatus/<?php echo $ap->api_id; ?>/0">DeActivate</a>
                         <?php
						 
					   }
					   else
					   {
						   ?>
                         <a href="<?php echo WEB_URL_ADMIN ?>admin/updateapistatus/<?php echo $ap->api_id; ?>/1">Activate</a>
                         <?php
					   }
						 ?>
										    
                                             </td>
                                            
										</tr>
									<?php } } } ?>	
									</tbody>
								</table>
								
							</div>
											
											
										</div>
										
										<div class="tab-pane" id="t12">
											<h4>Add New API Details</h4>
											<form action="<?php echo WEB_URL_ADMIN ?>admin/addapi" method="POST" class='form-horizontal form-validate' id="bb">
											<div class="control-group">
											
											<label for="textfield" class="control-label">Module</label>
											<div class="controls">
												<select name="module" id="module" class="input-xlarge" data-rule-required="true" >
													<option value="">select</option>
													<option value="Hotel">Hotel</option>
													<option value="Flight">Flight</option>
													<option value="Car">Car</option>
												</select>
											</div>
											</div>
											<div class="control-group">
											
											<label for="textfield" class="control-label">API Name</label>
											<div class="controls">
												<input type="text" name="apiname" id="apiname" class="input-xlarge" data-rule-required="true" data-rule-minlength="2">
											</div>
											</div>
											<div class="control-group">
											<label for="textfield" class="control-label">API Url</label>
											<div class="controls">
												<input type="text" name="apiurl" id="apiurl" class="input-xlarge" data-rule-required="true" data-rule-minlength="2">
											</div>
											</div>
											<div class="control-group">
											<label for="textfield" class="control-label">API User name</label>
											<div class="controls">
												<input type="text" name="apiusername" id="apiusername" class="input-xlarge" data-rule-required="true" data-rule-minlength="2">
											</div>
											</div>
											<div class="control-group">
											<label for="textfield" class="control-label">API Password</label>
											<div class="controls">
												<input type="text" name="apipassword" id="apipassword" class="input-xlarge" data-rule-required="true" data-rule-minlength="2">
											</div>
											</div>
											<div class="form-actions">
													<input type="submit" class="btn btn-primary" value="Submit">
										
											</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
			  </div>
			</div>
		</div></div>
		
	</body>

	</html>


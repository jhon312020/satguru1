<!doctype html>
<html>
<?php $this->load->view('links'); ?>
<!-- Validation -->
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/validation/jquery.validate.min.js"></script>
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/validation/additional-methods.min.js"></script>
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
						<h1>B2C Markup</h1>
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
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard">Dashboard</a>
							<i class="icon-angle-right"></i>
						</li>
						
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				
				
				
				<div class="box box-color box-bordered red">
							<div class="box-title">
								<h3>
									<i class="icon-ok"></i>
									B2C Markup - <?php echo $ty; ?>
								</h3>
							</div>
							<div class="box-content">
							<h4>API BASED</h4>
								<form action="<?php echo WEB_URL_ADMIN ?>b2c/b2cmarkupinsert/1" method="POST" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">API Name</label>
										<div class="controls">
											<select name="api" id="api" class="input-xlarge" data-rule-required="true">
                                            
											<?php foreach($api_list as $key => $value) { ?>
												<option value="<?php echo $value->api_id?>"><?php echo $value->api_name ?></option>
											<?php } ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Markup (%)</label>
										<div class="controls">
											<input type="text" name="markup" id="markup" class="input-xlarge" data-rule-number="true" >
										</div>
									</div>
									<input type="hidden" name="module_type" value="1" />
									<div class="form-actions">
									<input type="submit" class="btn btn-primary" value="Submit">
										
									</div>
								</form>
							</div>
								
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
									<thead>
										<tr class='thefilter'>
											<th>#ID</th>
											<th class='hidden-350'>Api</th>
											<th class='hidden-1024'>Module</th>
                                            <th class='hidden-1024'>Country</th>
											<th class='hidden-1024'>Markup</th>
														
											<th class='hidden-350'>Action</th>
										</tr>
										
									</thead>
									<tbody>
										<?php $i =1; if(isset($markupdet)) { if($markupdet != '') { foreach($markupdet as $key => $list) { ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $list->api_name; ?></td>
											<td class='hidden-350'><?php if($list->module_type == 1); echo 'Hotel'; ?></td>
                                            <td class='hidden-1024'>All</td>
											<td class='hidden-1024'><?php echo $list->markup; ?>%</td>
											
											<td class='hidden-480'>
												<a href="<?php echo WEB_URL_ADMIN; ?>b2c/delete_markup/<?php echo $list->id.'/'.$list->module_type; ?>">Delete</a>
											</td>											
										</tr>
										<?php $i++;} } } ?>
									</tbody>
								</table>
							</div>
							
							<div class="box-content">
							<h4>COUNTRY BASED</h4>
								<form action="<?php echo WEB_URL_ADMIN ?>b2c/b2cmarkupinsertcountry/1" method="POST" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">API Name</label>
										<div class="controls">
											<select name="api_country" id="api_country" class="input-xlarge" data-rule-required="true">
										<?php foreach($api_list as $key => $value) { ?>
												<option value="<?php echo $value->api_id?>"><?php echo $value->api_name ?></option>
											<?php } ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Markup (%)</label>
										<div class="controls">
											<input type="text" name="markup_country" id="markup_country" class="input-xlarge" data-rule-number="true" value="<?php if(isset($markupdet)) { if($markupdet!= '') { echo $markupdet->markup; } } ?>" >
										</div>
									</div>
									<?php $country = $this->Home_Model->getcountry_v1(); ?>
									<div class="control-group">
										<label for="textfield" class="control-label">Country</label>
										<div class="controls">
											<select name="country_name" id="country_name" class="input-xlarge" data-rule-required="true">
											<option value="">Select</option>
											<?php if(isset($country)) { if($country != '') { foreach($country as $cnt) { ?>
											<option value="<?php echo $cnt->Global_Countryname; ?>"><?php echo $cnt->Global_Countryname; ?></option>
											<?php } } } ?>
											</select>
										</div>
									</div>
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Submit">
										
									</div>
								</form>
								
							</div>
							
							
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
									<thead>
										<tr class='thefilter'>
											<th>#ID</th>
											<th class='hidden-350'>Api</th>
											<th class='hidden-1024'>Module</th>
                                            <th class='hidden-1024'>Country</th>
											<th class='hidden-1024'>Markup</th>
														
											<th class='hidden-350'>Action</th>
										</tr>
										
									</thead>
									<tbody>
										<?php $i =1; if(isset($markupdet_c)) { if($markupdet_c != '') { foreach($markupdet_c as $key => $list) { ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $list->api_name; ?></td>
											<td class='hidden-350'><?php if($list->module_type == 1); echo 'Hotel'; ?></td>
                                            <td class='hidden-1024'><?php echo $list->country; ?></td>
											<td class='hidden-1024'><?php echo $list->markup; ?>%</td>
											
											<td class='hidden-480'>
												<a href="<?php echo WEB_URL_ADMIN; ?>b2c/delete_markup/<?php echo $list->id.'/'.$list->module_type; ?>">Delete</a>
											</td>											
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


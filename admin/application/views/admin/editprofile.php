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
						<h1>Edit Profile</h1>
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
									Edit Profile
								</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo WEB_URL_ADMIN ?>admin/updateprofile" method="POST" class='form-horizontal form-validate' id="bb">
									<div class="control-group">
										<label for="textfield" class="control-label">First Name</label>
										<div class="controls">
											<input type="text" name="first_name" value="<?php if($admin_det->first_name != '') { echo $admin_det->first_name; } ?>" id="first_name" class="input-xlarge" data-rule-required="true" data-rule-minlength="2">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Last Name</label>
										<div class="controls">
											<input type="text" name="last_name" value="<?php if($admin_det->last_name != '') { echo $admin_det->last_name; } ?>" id="last_name" class="input-xlarge" data-rule-required="true" data-rule-minlength="2">
										</div>
									</div>
									<div class="control-group">
										<label for="emailfield" class="control-label">Email Id</label>
										<div class="controls">
											<input type="text" name="email_id" id="email_id" value="<?php if($admin_det->email != '') { echo $admin_det->email; } ?>"  class="input-xlarge" data-rule-email="true" data-rule-required="true">
											
										</div>
									</div>
									
									<div class="control-group">
										<label for="pwfield" class="control-label">Password</label>
										<div class="controls">
											<input type="password" class="input-xlarge" value="<?php if($admin_det->password != '') { echo $admin_det->password; } ?>" disabled="disabled">
											<a href="<?php echo WEB_URL_ADMIN; ?>admin/changepassword" class="btn btn-primary">Change Password</a>
									</div>
									</div>
									<!-- <div class="control-group">
										<label for="pwfield" class="control-label">Password</label>
										<div class="controls">
											<input type="password" name="pwfield" id="pwfield" class="input-xlarge" value="<?php if($admin_det->password != '') { echo $admin_det->password; } ?>" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="confirmfield" class="control-label">Confirm password</label>
										<div class="controls">
											<input type="password" name="confirmfield" id="confirmfield"  value="<?php if($admin_det->password != '') { echo $admin_det->password; } ?>" class="input-xlarge" data-rule-equalTo="#pwfield" data-rule-required="true">
										</div>
									</div>-->
									<div class="control-group">
										<label for="textfield" class="control-label">Contact No</label>
										<div class="controls">
											<input type="text" name="phone" value="<?php if($admin_det->phone != '') { echo $admin_det->phone; } ?>" id="phone" class="input-xlarge" data-rule-number="true" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Mobile No</label>
										<div class="controls">
											<input type="text" name="mobile" value="<?php if($admin_det->mobile != '') { echo $admin_det->mobile; } ?>" id="mobile" class="input-xlarge" data-rule-number="true" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alternate No</label>
										<div class="controls">
											<input type="text" name="alternate_no" value="<?php if($admin_det->alternate_no != '') { echo $admin_det->alternate_no; } ?>" id="alternate_no" class="input-xlarge" data-rule-number="true" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Address</label>
										<div class="controls">
											<textarea name="address" id="address" class="input-xlarge" data-rule-required="true" data-rule-minlength="2"><?php if($admin_det->address != '') { echo $admin_det->address; } ?></textarea>
										</div>
									</div>
									<div style="clear:both;padding-bottom:20px;"></div>
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Submit">
										<a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard"><button type="button" class="btn">Cancel</button></a>
									</div>
								</form>
							</div>
						</div>
				
			</div>
		</div></div>
		
	</body>

	</html>


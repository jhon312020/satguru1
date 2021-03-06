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
						<h1>Edit B2B User</h1>
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
									B2B Registration
								</h3>
							</div>
							<?php if(isset($error) && $error != "") { ?>
								<p style="color:red;padding-left:150px;padding-top:10px;font-weight:bold;"><?php echo $error; ?></p>
								
							<?php } ?>
							<div class="box-content">
								<form action="<?php echo WEB_URL_ADMIN ?>b2b/update_agent/<?php echo $user_details->agent_id; ?>" method="POST" class='form-horizontal form-validate' id="bb">
								
									
									
									<div class="control-group">
										<label for="textfield" class="control-label">Name</label>
										<div class="controls">
											<input type="text" name="name" id="name" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" value="<?php echo $user_details->name; ?>" >
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Company Name</label>
										<div class="controls">
											<input type="text" name="company" id="company" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" value="<?php echo $user_details->company_name; ?>" >
										</div>
									</div>
									<div class="control-group">
										<label for="emailfield" class="control-label">Email Id</label>
										<div class="controls">
											<input type="text" name="email3" id="email3" class="input-xlarge" data-rule-email="true" data-rule-required="true" value="<?php echo $user_details->email_id; ?>" >
										</div>
									</div>
								
									<div class="control-group">
										<label for="textfield" class="control-label">Contact No</label>
										<div class="controls">
											<input type="text" name="phone" id="phone" class="input-xlarge" data-rule-number="true" data-rule-required="true" value="<?php echo $user_details->mobile ; ?>" >
										</div>
									</div>
                                    	<div class="control-group">
										<label for="textfield" class="control-label">Office No</label>
										<div class="controls">
											<input type="text" name="office" id="office" class="input-xlarge" data-rule-number="true" data-rule-required="true" value="<?php echo $user_details->office_phone ; ?>" >
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Postal Code</label>
										<div class="controls">
											<input type="text" name="postal" id="postal" class="input-xlarge" data-rule-number="true" data-rule-required="true" value="<?php echo $user_details->postal_code; ?>" >
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Country</label>
										<div class="controls">
											<input type="text" name="country" id="country" readonly class="input-xlarge" data-rule-required="true"  value="<?php echo $user_details->country; ?>" >
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">City</label>
										<div class="controls">
											<input type="text" name="city" id="city" class="input-xlarge" data-rule-required="true"  value="<?php echo $user_details->city; ?>" >
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Address</label>
										<div class="controls">
											<textarea name="address" id="address" class="input-xlarge" data-rule-required="true" data-rule-minlength="2"><?php echo $user_details->address; ?></textarea>
										</div>
									</div>
									
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Submit">
										
									</div>
								</form>
							</div>
						</div>
				
			</div>
		</div></div>
		
	</body>

	</html>


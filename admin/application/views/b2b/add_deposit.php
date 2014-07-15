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
						<h1>Add New Deposit</h1>
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
									Deposit 
								</h3>
							</div>
							<?php if(isset($status) && $status != "") { ?>
								<p style="color:red;padding-left:150px;padding-top:10px;font-weight:bold;"><?php echo $status; ?></p>
								
							<?php } ?>
							<div class="box-content">
								<form action="<?php echo WEB_URL_ADMIN ?>deposit/add_deposit_amount/<?php echo $id; ?>" method="POST" class='form-horizontal form-validate' id="bb">
								
									
									
									<div class="control-group">
										<label for="textfield" class="control-label">Amount Deposited</label>
										<div class="controls">
											<input type="text" name="amount" id="amount" class="input-xlarge" data-rule-required="true" data-rule-minlength="2" value="" >
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Date of Deposite</label>
										<div class="controls">
											<input type="text" name="deposited_date" id="deposited_date" class="input-xlarge datepick" data-rule-required="true" data-rule-minlength="2" value="" >
										</div>
									</div>
								
									<div class="control-group">
										<label for="textfield" class="control-label">Remarks</label>
										<div class="controls">
											<textarea name="remarks" id="remarks" class="input-xlarge" data-rule-required="true" data-rule-minlength="2"></textarea>
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


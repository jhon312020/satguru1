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
						<h1>Edit Currency</h1>
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
									Edit Currency
								</h3>
							</div><div class="span6">
							<div class="box box-bordered">
								<div class="box-title">
									<ul class="tabs tabs-left">
										<li class="active">
											<a href="<?php echo WEB_URL_ADMIN ?>admin/currencyconverter">Back Currency List</a>
										</li>
										
									</ul>
									
								</div>
								<div class="box-content">
									<div class="tab-content">
										<div class="tab-pane active" id="t10">
											
												
								<form action="<?php echo WEB_URL_ADMIN ?>admin/updatecurrency/<?php echo $id; ?>" method="POST" class='form-horizontal form-validate' id="bb">
											
											<div class="control-group">
											
											<label for="textfield" class="control-label">Currency</label>
											<div class="controls">
												<?php if(isset($cur_det)) { if($cur_det->country != '') { echo $cur_det->country; }} ?>
											</div>
											</div>
											<div class="control-group">
											<label for="textfield" class="control-label">Value</label>
											<div class="controls">
												<input type="text" name="value" id="value" value="<?php if(isset($cur_det)) { if($cur_det->value != '') { echo $cur_det->value; }} ?>"  class="input-xlarge" data-rule-required="true" data-rule-minlength="2">
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


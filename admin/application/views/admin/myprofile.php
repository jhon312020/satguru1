<!doctype html>
<html>
<?php $this->load->view('links'); ?>
<link rel="stylesheet" href="<?php echo WEB_DIR_ADMIN ?>css/plugins/datatable/TableTools.css">
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- dataTables -->
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/jquery.dataTables.min.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/TableTools.min.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/FixedColumns.min.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/dataTables.scroller.min.js"></script>
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
						<h1>My Profile</h1>
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
										<i class="icon-table"></i>
										My Profile
									</h3>
								</div>
								<div class="box-content nopadding">
									<table class="table table-hover table-nomargin table-bordered dataTable dataTable-fixedcolumn dataTable-scroll-x dataTable-scroll-y">
										<thead>
											<tr>
												<th>#ID</th>
												<th>First Name</th>
												<th>Last Name</th>
												<th>Email Id</th>
												<th>Created Date</th>
												<th>Address</th>
												<th>Contact No</th>
												<th>Mobile</th>
												<th>Alternate No</th>
												<th>City</th>
												<th>View/Edit</th>
												</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td><?php echo $admin_det->first_name; ?></td>
												<td><?php echo $admin_det->last_name; ?></td>
												<td><?php echo $admin_det->email; ?></td>
												<td><?php echo $admin_det->created_date; ?></td>
												<td><?php if($admin_det->address != '') { echo $admin_det->address; }?></td>
												<td><?php if($admin_det->phone != '') { echo $admin_det->phone; }?></td>
												<td><?php if($admin_det->mobile != '') { echo $admin_det->mobile; } ?></td>
												<td><?php if($admin_det->alternate_no != '') { echo $admin_det->alternate_no; } ?></td>
												<td><?php if($admin_det->city != '') { echo $admin_det->city; } ?></td>
												<td><a href="<?php echo WEB_URL_ADMIN ?>admin/editprofile">Edit</a></td>
												</tr>
											
										</tbody>
									</table>
								</div>
							</div>
				
				
			</div>
		</div></div>
		
	</body>

	</html>


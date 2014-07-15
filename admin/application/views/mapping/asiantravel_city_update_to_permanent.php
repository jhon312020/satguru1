<!doctype html>
<html>
<?php $this->load->view('links'); ?>
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
                    
						<h1>Asiantravel Mapping /  <?php echo 'City : '.$keycity; ?></h1>
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
									<i class="icon-table"></i>
									<?php echo $page_header; ?>
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>Sl No</th>
													<th>Country Name</th>                                                   
													<th>City Name</th>
													<th>Hotelspro City code</th>
													<th>Asian travel City code</th>
													<th>Asian travel Country code</th>                                                                                                                                                   
                                                    <th>Action</th>													
												</tr>
											</thead>
											<tbody>
                                            <?php if($api_permanent_data!='') { ?>
											<tr>
												<td>1</td>
												<td><?php echo $api_permanent_data['Global_Countryname']; ?></td>
												<td><?php echo $api_permanent_data['Global_Cityname']; ?></td>
												<td><?php echo $api_permanent_data['Global_Citycode']; ?></td>
												<td><?php echo $api_permanent_data['Asiantravel_Citycode']; ?></td>
												<td><?php echo $api_permanent_data['Asiantravel_Countrycode']; ?></td>
												<td>
													<div class="btn-group">
														<a class="btn btn-mini tip" href="<?php echo WEB_URL_ADMIN; ?>mapping/update_asiantravel_city_code/<?php echo $api_permanent_data['api_permanent_city_id']; ?>/<?php echo $asiantravel_citycode;?>/<?php echo $asiantravel_countrycode;?>" data-original-title="Update City Mapping">  
															Update
														</a>
												</td>
											</tr>
											<?php }  ?>
											</tbody>
										</table>
							</div>
						</div>
				
				
			</div>
		</div></div>
		
	</body>

	</html>


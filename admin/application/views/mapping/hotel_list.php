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
                    
						<h1>Asiantravel Mapping /  <?php echo 'Hotels : '.$keycity; ?></h1>
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
													<th>Thumb</th>                                                   
													<th>Hotel Name</th>
													<th>Star</th>
													<th>Address</th>
													<th>City</th>   
													<th>Hotelspro</th> 
													<th>Asiantravel</th>                                                                                                                                                    
                                             		
												</tr>
											</thead>
											<tbody>
                                            <?php if(!empty($hotel_list)) {$i=1; foreach($hotel_list as $key => $value) { 
										
										
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td>
												
														<img src="<?php echo $value['Hotel_thumbnail']; ?>" width="50"/>
												
												</td>
												<td><?php echo $value['Hotel_name']; ?></td>
												<td><?php echo $value['Hotel_star']; ?></td>
												<td><?php echo $value['Hotel_address']; ?></td>
												<td><?php echo $value['City_name'].', '.$value['Country_name']; ?></td>
												<td><?php echo $value['Hotelspro_Hotelcode']; ?></td>
                                                <td><?php echo $value['Asiantravel_Hotelcode']; ?></td>
                                               
												
												
											</tr>
											<?php $i++; }} ?>
											</tbody>
										</table>
							</div>
						</div>
				
				
			</div>
		</div></div>
		
	</body>

	</html>


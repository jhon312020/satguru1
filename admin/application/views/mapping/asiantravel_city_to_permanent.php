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
													<th>Related City Name</th>
                                                   
													<th>Country Name</th>
                                            
                                                    <th>Matches in Percentage</th>
                                                   
                                                    <th>Action</th>
													
												</tr>
											</thead>
											<tbody>
                                            <?php
									if($related_city!='')
									{
											for($i=0;$i<count($related_city);$i++)
											{
												?>
											<tr>
                                            
                                               <td><?php echo $i+1; ?></td>
                                              <td><?php echo $related_city[$i][1]; ?></td>
                                               
                                               <td><?php echo $related_city[$i][2]; ?></td>
                                             
                                               <td>
                                               <?php
											   if($related_city[$i][0] == 100)
											   {
												   ?>
											   <div class="progress progress-striped progress-success progress-round">
								<div class="bar" style='width: <?php echo $related_city[$i][0]; ?>%'><?php echo $related_city[$i][0]; ?>%</div>
							</div>
                            <?php
											   }
											   elseif($related_city[$i][0] > 75)
											   {
											   ?>
                                                  
											   <div class="progress progress-striped progress-warning progress-round">
								<div class="bar" style='width: <?php echo $related_city[$i][0]; ?>%'><?php echo $related_city[$i][0]; ?>%</div>
							</div>
                            <?php
											   }
											   elseif($related_city[$i][0] < 75)
											   {
												   ?>
                                                  
											   <div class="progress progress-striped progress-danger progress-round">
								<div class="bar" style='width: <?php echo $related_city[$i][0]; ?>%'><?php echo $related_city[$i][0]; ?>%</div>
							</div>
                            <?php   
											   }
											   ?>
											  </td>
                                              
                                              
                                               <td>
                                            <div class="btn-group">	<a class="btn btn-mini tip" href="<?php echo WEB_URL_ADMIN; ?>mapping/check_city_mapping_citywise_asiantravel/<?php echo $related_city[$i][3]; ?>/<?php echo $asian_citycode;?>/<?php echo $asian_country_code;?>" data-original-title="Update City Mapping">  Choose Correct Permanent Data City</a>
                                        </div>
                                               </td>
                                              
                                                 
                                               
                                                </tr>
                                                <?php
											}
									}
											?>
											</tbody>
										</table>
							</div>
						</div>
				
				
			</div>
		</div></div>
		
	</body>

	</html>


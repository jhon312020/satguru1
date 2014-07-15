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
						<h1><?php echo $page_header; ?></h1>
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
								<table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
									<thead>
										<tr class='thefilter'>
											<th>#ID</th>  <th>Logo</th>
											<th>Name</th>
											<th class='hidden-350'>Email</th>
											<th class='hidden-1024'>City</th>
											<th class='hidden-480'>Contact No</th>
												<th class='hidden-480'>Balance</th>
                                                                        	<th class='hidden-480'>Markup</th>
											<th class='hidden-350'>Action</th>
										</tr>
										<tr>
											<th>#ID</th>
                                            <th>Logo</th>
											<th>Name</th>
											<th class='hidden-350'>Email</th>
											<th class='hidden-1024'>City</th>
											<th class='hidden-480'>Contact No</th>
                                            	<th class='hidden-480'>Balance</th>
                                                                        	<th class='hidden-480'>Markup</th>
									
											<th class='hidden-350'>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i =1; if(isset($cus_list)) { if($cus_list != '') { foreach($cus_list as $list) { ?>
										<tr>
											<td><?php echo $i; ?></td>
                                            <td><img src="<?php echo $list->agent_logo; ?>" height="70" width="70"></td>
											<td><?php echo $list->company_name; ?></td>
											<td class='hidden-350'><?php echo $list->email_id; ?></td>
											<td class='hidden-1024'><?php echo $list->city; ?></td>
											<td class='hidden-480'><?php echo $list->office_phone ; ?></td>
                                            <td class='hidden-480'><?php echo $list->balance_credit ; ?></td>
                                            <td class='hidden-480'><?php echo $list->markup.'%' ; ?></td>
										
											<td class='hidden-480'>
												<a href="<?php echo WEB_URL_ADMIN ?>b2b/change_b2buser_status/<?php echo $list->agent_id; ?>/<?php echo $list->status; ?>"><?php if($list->status == 1) { echo "De-active"; } else { echo "Active"; } ?></a>
												<a href="<?php echo WEB_URL_ADMIN ?>b2b/edit_b2buser/<?php echo $list->agent_id; ?>">
													Edit
												</a>
												<a href="<?php echo WEB_URL_ADMIN ?>b2b/delete_b2buser/<?php echo $list->agent_id; ?>">
													Delete
												</a>
                                                	<a href="<?php echo WEB_URL_ADMIN ?>deposit/agent_deposit_view/<?php echo $list->agent_id; ?>">
													Deposit
												</a>
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


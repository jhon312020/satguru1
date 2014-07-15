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
						
					</div>
				</div>
				<a href="<?php echo site_url() ; ?>/deposit/add_deposit/<?php echo $id; ?>" ><button class="btn btn-primary">Add New Deposit</button></a>
				
				<div class="box box-color box-bordered red">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									<?php echo $page_header; ?>
                                    Balance Amount : <?php echo $deposit_amount->balance_credit; ?><br>
                                    
								</h3>
                               
							</div>
                            
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
									<thead>
										<tr class='thefilter'>
											<th>SL No</th>
                                            
                                              <th>Transaction ID</th>
											<th>Date</th>
											<th class='hidden-350'>Amount</th>
											<th class='hidden-1024'>Remarks</th>
											<th class='hidden-480'>Status</th>
																			<th class='hidden-350'>Action</th>
										</tr>
										<tr>
											<th>SL No</th>
                                            
                                              <th>Transaction ID</th>
											<th>Date</th>
											<th class='hidden-350'>Amount</th>
											<th class='hidden-1024'>Remarks</th>
											<th class='hidden-480'>Status</th>
																			<th class='hidden-350'>Action</th>
										</tr>
									</thead>
									<tbody>
								    <?php
									if($deposit!='')
									{
											
											for($i=0;$i<count($deposit);$i++)
											{
												?>
				
												<tr>
                                             <td><?php echo $i+1;?></td>
                                                <td >
										<?php echo $deposit[$i]->transaction_id; ?>
										</td>
                                                <td><?php echo date("M d - Y",strtotime($deposit[$i]->deposited_date)); ?></td>
                                                <td><?php echo $deposit[$i]->amount_credit; ?></td>
                                                 <td><?php echo $deposit[$i]->remarks; ?></td>
                                                  <td><?php
												  if($deposit[$i]->status=='Accepted')
												  {
													  echo '<img alt="" src="'.WEB_DIR.'img/icons/fugue/check.png">';
												  }
												   if($deposit[$i]->status=='Pending')
												  {
													  echo '<img alt="" src="'.WEB_DIR.'img/icons/fugue/busy.png">';
												  }
												   if($deposit[$i]->status=='Cancelled')
												  {
													  echo '<img alt="" src="'.WEB_DIR.'img/icons/fugue/slash.png">';
												  }
												  
												   echo '&nbsp;'.$deposit[$i]->status; ?></td>
                                                
                                                 <td><div class="btn-group">
                                                 <?php
												  
												   if($deposit[$i]->status=='Pending')
												  {
													 ?>
                                                       <a class="btn btn-mini tip" href="<?php echo site_url(); ?>/deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Accepted/<?php echo $id; ?>" data-original-title="Accepted">To Accept</a>
													<a class="btn btn-mini tip" href="<?php echo site_url(); ?>/deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Pending/<?php echo $id; ?>" data-original-title="Pending">To Pending</a>
												<a class="btn btn-mini tip" href="<?php echo site_url(); ?>/deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Cancelled/<?php echo $id; ?>" data-original-title="Cancelled">To Cancel</a>
                                                     <?php
												  }
												   if($deposit[$i]->status=='Cancelled')
												  {
													   ?>
                                                
											   <a class="btn btn-mini tip" href="<?php echo site_url(); ?>/deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Accepted/<?php echo $id; ?>" data-original-title="Accepted">To Accept</a>
													<a class="btn btn-mini tip" href="<?php echo site_url(); ?>/deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Pending/<?php echo $id; ?>" data-original-title="Pending">To Pending</a>
                                                     <?php
												  }
												  ?>
												
                                                
											</div></td>
                                               
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


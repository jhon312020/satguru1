<!doctype html>
<html>
<?php $this->load->view('links'); ?>
<!-- Validation -->
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/validation/jquery.validate.min.js"></script>
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/validation/additional-methods.min.js"></script>
<!-- dataTables -->
	<link rel="stylesheet" href="<?php echo WEB_DIR_ADMIN ?>css/plugins/datatable/TableTools.css">
	<!-- Datepicker -->
	<link rel="stylesheet" href="<?php echo WEB_DIR_ADMIN ?>css/plugins/datepicker/datepicker.css">

<!-- dataTables -->

	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/jquery.dataTables.min.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/ColReorderWithResize.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/ColVis.min.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/jquery.dataTables.columnFilter.js"></script>
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/jquery.dataTables.grouping.js"></script>
	<!-- Chosen -->
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- Datepicker -->
	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
    	<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/TableTools.min.js"></script>

<body>
	<script>
	$(document).ready( function () {
	$('#example2').dataTable( {
		"sDom": 'T<"clear">lfrtip',
		"oTableTools": {
			"sSwfPath": "<?php echo WEB_DIR; ?>assets/js/datatable/swf/copy_csv_xls_pdf.swf"
		}
	} );
} );
</script>
	
	<div id="navigation">
		<div class="container-fluid">
			<a href="#" id="brand"><img src="<?php echo WEB_DIR_ADMIN ?>img/newlogo.png"></a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
			<ul class='main-nav'>
				<li class='active'>
					<a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard">
						<span>Dashboard</span>
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
									<span class="big"><?php echo date("F d, Y"); ?></span>
									<span><?php echo date("l"); ?></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				
				<div class="box box-color box-bordered red">
						<div class="box-content" style="border:none;">
							<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Online Itinerary</h3>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo WEB_URL_ADMIN ?>b2c/b2c_reports_search" method="POST" class='form-horizontal form-column form-bordered form-validate'>
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">From Date</label>
											<div class="controls">
												<input type="text" name="fromdate" id="fromdate" placeholder="From Date" class="input-xlarge datepick" data-rule-required="true" >
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Booking Status</label>
											<div class="controls">
												<select name="booking_status" id="booking_status" class="input-xlarge">
                                                
                                        			<option value="">All</option>
                                                    <?php
													if($s_booking_status!='')
													{
														for($i=0;$i<count($s_booking_status);$i++)
														{
																if($s_booking_status[$i]->booking_status!='')
															{
														?>
													<option value="<?php echo $s_booking_status[$i]->booking_status; ?>"><?php echo $s_booking_status[$i]->booking_status; ?></option>
													<?php
															}
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">PNR Number</label>
											<div class="controls">
												<input type="text" name="pnr" id="paymentcode" placeholder="PNR Number" class="input-xlarge">
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Hotel Booking No</label>
											<div class="controls">
												<input type="text" name="booking_no" id="atno" placeholder="Hotel Booking No" class="input-xlarge">
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Email Id</label>
											<div class="controls">
												<input type="text" name="emailid" id="emailid" placeholder="Email Id" class="input-xlarge">
											</div>
										</div>
										
										
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">To Date</label>
											<div class="controls">
												<input type="text" name="todate" id="todate" placeholder="To Date" class="input-xlarge datepick">
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">API Status</label>
											<div class="controls">
												<select name="api_status" id="current_status" class="input-xlarge">
													<option value="">All</option>
													  <?php
													if($s_api_status!='')
													{
														for($i=0;$i<count($s_api_status);$i++)
														{
															if($s_api_status[$i]->api_status!='')
															{
														?>
													<option value="<?php echo $s_api_status[$i]->api_status; ?>"><?php echo $s_api_status[$i]->api_status; ?></option>
													<?php
															}
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Lead Pax</label>
											<div class="controls">
												<input type="text" name="leadpax" id="atno" placeholder="Lead Pax" class="input-xlarge">
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Payment Status</label>
											<div class="controls">
												<select name="payment_status" id="current_status" class="input-xlarge">
													<option value="">All</option>
													  <?php
													if($s_transaction_status!='')
													{
														for($i=0;$i<count($s_transaction_status);$i++)
														{
															if($s_transaction_status[$i]->transaction_status!='')
															{
														?>
													<option value="<?php echo $s_transaction_status[$i]->transaction_status; ?>"><?php echo $s_transaction_status[$i]->transaction_status; ?></option>
													<?php
															}
														}
													}
													?>
												</select>
											</div>
										</div>
										
									
									</div>
									<div class="span12">
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">Search</button>
											<a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
						</div>
				</div>
				
				<div class="box box-color box-bordered red">
							
							<div class="row-fluid">
					<div class="span12">
					<div class="box box-bordered">
								<div class="box-title">
									<ul class="tabs tabs-left">
										<li class="active">
											<a href="#t10" data-toggle="tab">Hotel Booking Reports</a>
										</li>
										<?php /*<li>
											<a href="#t12" data-toggle="tab">Hotel Booking Reports</a>
										</li>
										<li>
											<a href="#t13" data-toggle="tab">Car Booking Reports</a>
										</li>
										<li>
											<a href="#t14" data-toggle="tab">Package Booking Reports</a>
										</li> <?php */ ?>
									</ul>
									
								</div>
								<div class="box-content" >
									<div class="tab-content">
										<div class="tab-pane active" id="t10">
											
								<div class="box-content nopadding" style="border:none;">
								<h4>Hotel Reports</h4>
								<?php  ?>
	<table id="example2" class="table table-hover table-nomargin table-bordered display" style="background-color:white">
													<thead>
														<tr class='thefilter'>
															<th>No </th>
															<th>PNR No</th>
															<th class='hidden-480'>Hotel Booking No</th>
															<th class='hidden-480'>Transaction No</th>
															<th>Product</th>
															
                                                            	<th>Email-ID</th>
															<th>Lead Pax</th>
															<th class='hidden-1024'>Amount</th>
															<th class='hidden-1024'>Voucher Date</th>
															<th class='hidden-1024'>API status</th>
															<th class='hidden-1024'>Booking Status</th>
                                                            <th class='hidden-1024'>Payment Status</th>
															<th class='hidden-1024'>IP Address</th>
                                                            	<th class='hidden-1024'>Action</th>
							
															
														</tr>
														
													</thead>
													<tbody>
													<?php 
													$fl_count=1;
													if(isset($hotel)) { if($hotel != '') { foreach($hotel as $fl) { ?>
														<tr>
															<td><?php echo $fl_count; ?></td>
															<td><?php echo $fl->pnr_no; ?></td>
															<td class='hidden-1024'><?php echo $fl->booking_no; ?></td>
															<td class='hidden-480'><?php echo $fl->transaction_id; ?></td>
															<td><?php echo $fl->product_name; ?></td>
															
															<td class='hidden-350'><?php echo $fl->useremail; ?></td>
															<td class='hidden-350'><?php echo $fl->leadpax; ?></td>
															<td class='hidden-350'><?php echo $fl->amount; ?></td>
															<td class='hidden-350'><?php echo $fl->voucher_date; ?></td>
															<td class='hidden-350'><?php echo $fl->api_status; ?></td>
															<td class='hidden-350'><?php echo $fl->booking_status; ?></td>
															
															<td class='hidden-480'><?php echo $fl->transaction_status; ?></td>
															<td class='hidden-1024'><?php echo $fl->ipaddress; ?></td>
                                                            	<td class='hidden-1024'><a href="<?php echo WEB_URL_ADMIN ?>b2c/b2c_voucher/<?php echo $fl->pnr_no;?>">Voucher</a></td>
															
														</tr>
														<?php 
														$fl_count++;
														} } } ?>
													</tbody>
											</table>
								
							</div>
											
											
										</div>
										
										
										
										
										
										
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


<!doctype html>

<style>

#black_grid {
    background: none repeat scroll 0 0 #000000;
    height: 100%;
    margin: 0 auto;
    opacity: 0.7;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 3000;
}

</style>
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
									<?php echo $page_header; ?>
								</h3>
							</div>
							<div id="small_preloader" align="center" style="display:none;"><h2>Updating Currency.....,Please Wait.....</h2></div>
							<div id="black_grid" style=" display:none;">&nbsp;</div>
							<div class="box-content nopadding ">
								<table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
									<thead>
										<tr class='thefilter'>
											<th>#ID</th>
											<th>Currency</th>
											<th class='hidden-350'>Value</th>
											<th class='hidden-1024'>Updated Datetime</th>
											<th class='hidden-480'>Action</th>
										</tr>
										<tr>
											<th>#ID</th>
											<th>Currency</th>
											<th class='hidden-350'>Value</th>
											<th class='hidden-1024'>Updated Datetime</th>
											<th class='hidden-480'>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i =1; if(isset($cur_list)) { if($cur_list != '') { foreach($cur_list as $list) { ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $list->country; ?></td>
											<td class='hidden-350'><?php echo $list->value; ?></td>
											<td class='hidden-1024'><?php echo $list->date_time; ?></td>
											<td class='hidden-480'><a href="<?php echo WEB_URL_ADMIN ?>admin/editcur/<?php echo $list->cur_id; ?>">Edit</a> / <a href="<?php echo WEB_URL_ADMIN ?>admin/deletecur/<?php echo $list->cur_id; ?>">Delete</a></td>
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


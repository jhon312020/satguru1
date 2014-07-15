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
						<h1>Asiantravel Mapping / Hotellist</h1>
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
							<div class="span6">
							<div class="box box-bordered">
								<div class="box-title" style="width:981px">
									<ul class="tabs tabs-left">
										<li class="active">
											<a href="#t10" data-toggle="tab">Asiantravel Mapping</a>
										</li>
									
									</ul>
									
								</div>
								<div class="box-content" style="width: 951px;">
									<div class="tab-content">
										<div class="tab-pane active" id="t10">
											
												<div class="box-content nopadding" style="border:none;">
								
 <script type="text/javascript" src="<?php print WEB_DIR;  ?>assets/autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR;  ?>assets/autofill/css/autosuggest_inquisitor1.css" type="text/css" media="screen" charset="utf-8" />

							<form action="<?php echo WEB_URL_ADMIN; ?>mapping/mapping_hotel_asaintravel_to_permanent" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
                            <br>
								<div class="control-group">
									<label for="req" class="control-label">Asiantravel City Name</label>
                                    
									<div class="controls">
                                <input class="search_input_boxbig" name="cityval" type="text" id="cityName1" style="color: #999999;
    font-size: 13px; padding:5px; height: auto;"/>
      <br  /><span id="dorigin_error" style="color:#F00;"></span>
                                        <script type="text/javascript">
	    var options = {
		script:"<?php echo WEB_DIR_ADMIN; ?>asiantravel_city_list.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('cityName1').value = obj.id; } };
	    var as_json = new AutoSuggest('cityName1', options);
        </script>
        
										
									</div>
								</div>
                                
								
								<div class="control-group" id="city_view">
                                </div>
		                
								<div class="form-actions">
									<input type="submit" class='btn btn-primary'>
								</div>
							</form>	
							</div>
											
											
										</div>
										
										
									</div>
								</div>
                                
							</div>
						</div>
			  </div>
              
              <div class="box box-color box-bordered red">
							<div class="span6">
							<div class="box box-bordered">
								<div class="box-title" style="width:981px">
									<ul class="tabs tabs-left">
										<li class="active">
											<a href="#t10" data-toggle="tab">Checking Hotel Mapping</a>
										</li>
									
									</ul>
									
								</div>
								<div class="box-content" style="width: 951px;">
									<div class="tab-content">
										<div class="tab-pane active" id="t10">
											
												<div class="box-content nopadding" style="border:none;">
								
 

							<form action="<?php echo WEB_URL_ADMIN; ?>mapping/checking_hotel_asaintravel_to_permanent" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
                            <br>
								<div class="control-group">
									<label for="req" class="control-label">Asiantravel City Name</label>
                                    
									<div class="controls">
                                <input class="search_input_boxbig" name="cityval" type="text" id="cityName2" style="color: #999999;
    font-size: 13px; padding:5px; height: auto;"/>
      <br  /><span id="dorigin_error" style="color:#F00;"></span>
                                        <script type="text/javascript">
	    var options = {
		script:"<?php echo WEB_DIR_ADMIN; ?>asiantravel_city_list.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('cityName2').value = obj.id; } };
	    var as_json = new AutoSuggest('cityName2', options);
        </script>
        
										
									</div>
								</div>
                                
								
								<div class="control-group" id="city_view">
                                </div>
		                
								<div class="form-actions">
									<input type="submit" class='btn btn-primary'>
								</div>
							</form>	
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


<!doctype html>
<html>
<?php $this->load->view('links'); ?>

<body>
	
	<div id="modal-user" class="modal hide">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="user-infos"><?php echo $admin_det->first_name." ".$admin_det->last_name; ?></h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="span2">
					<img src="img/demo/user-1.jpg" alt="">
				</div>
				<div class="span10">
					<dl class="dl-horizontal" style="margin-top:0;">
						<dt>Full name:</dt>
						<dd><?php echo $admin_det->first_name." ".$admin_det->last_name; ?></dd>
						<dt>Email:</dt>
						<dd><?php echo $admin_det->email; ?></dd>
						
					</dl>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Close</button>
		</div>
	</div>
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
						<h1>Dashboard</h1>
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
				
				
				<div style="width:100%; float:left; height:auto; margin-top:15px;">
                <a href="<?php echo WEB_URL_ADMIN ?>admin/myprofile"><div class="dashboard_box"><br>
<img src="<?php echo WEB_DIR_ADMIN ?>img/icons/My_profile.png" border="0" ><br> 
 My Profile </div></a>
 
 
 <a href="<?php echo WEB_URL_ADMIN ?>b2c/activeb2clist"><div class="dashboard_box" style="background-color:#1cbabc;"><br>
<img src="<?php echo WEB_DIR_ADMIN ?>img/icons/staff.png" border="0" ><br> 
B2C</div></a>
 
  
<!-- <a href="<?php echo WEB_URL_ADMIN ?>staff/getlist/1"> <div class="dashboard_box" style="background-color:#f70018;"><br>
<img src="<?php echo WEB_DIR_ADMIN ?>img/icons/user.png" border="0" ><br> 
 Staff Accounts</div></a> -->
 
 
 <a href="<?php echo WEB_URL_ADMIN ?>b2c/b2cmarkup"><div class="dashboard_box" style="background-color:#99cc2c;"><br>
<img src="<?php echo WEB_DIR_ADMIN ?>img/icons/markup.png" border="0" ><br> 
 Markup</div></a>
 
 
<!-- <a href="<?php echo WEB_URL_ADMIN ?>admin/requestResponse"> <div class="dashboard_box" style="background-color:#f03485;"><br>
<img src="<?php echo WEB_DIR_ADMIN ?>img/icons/xml.png" border="0" ><br> 
XML Requests </div></a> -->
 
<!-- <a href="<?php echo WEB_URL_ADMIN ?>misc/list_markup"><div class="dashboard_box" style="background-color:#93047c;"><br>
<img src="<?php echo WEB_DIR_ADMIN ?>img/icons/deals.png" border="0" ><br> 
 Deals</div></a> -->
 
<?php /* ?><a href="<?php echo WEB_URL_ADMIN ?>admin/b2creports"> <div class="dashboard_box" style="background-color:#61ae24;"><br>
<img src="<?php echo WEB_DIR_ADMIN ?>img/icons/booking_reports.png" border="0" ><br> 
 Booking Reports </div></a> <?php */ ?>
 
 
<!-- <a href="<?php echo WEB_URL_ADMIN ?>admin/Cheap_flights"> <div class="dashboard_box" style="background-color:#038ecf;"><br>
<img src="<?php echo WEB_DIR_ADMIN ?>img/icons/Content_anage.png" border="0" ><br> 
 Content Manage </div></a> -->
 

                
                </div>
				
				
			</div>
		</div></div>
		
	</body>

	</html>


<!doctype html>
<html>
<?php $this->load->view('links'); ?>
<!-- Validation -->
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/validation/jquery.validate.min.js"></script>
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/validation/additional-methods.min.js"></script>

<script type="text/javascript">
function check_password(pwd)
{
	$.ajax
    ({
         type: "POST",
         url: "<?php echo WEB_URL_ADMIN?>admin/check_password",
		  data: "pwd="+pwd,
		  success: function(msg)
          {
		  	if(msg != '') {
				$('#pwd_error').html(msg);
				$("#pwfield").attr("readonly","readonly");
				$("#confirmfield").attr("readonly","readonly"); 
			}
			else
			{
				$('#pwd_error').html();
				$("#pwfield").removeAttr("readonly");
				$("#confirmfield").removeAttr("readonly");
			}
			}
    });
}
</script>
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
						<h1>Change Password</h1>
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
									<i class="icon-ok"></i>
									Change Password
								</h3>
							</div>
							<div class="box-content">
								<form action="<?php echo WEB_URL_ADMIN ?>admin/updatepassword" method="POST" class='form-horizontal form-validate' id="bb">
									<div class="control-group" style="color:#C60000;">
										<?php echo $upd; ?>
										
									</div>
									<div class="control-group">
										<label for="pwfield" class="control-label">Current Password</label>
										<div class="controls">
											<input type="password" name="curpwfield" id="curpwfield" class="input-xlarge" data-rule-required="true" onBlur="check_password(this.value)">
										<span id="pwd_error" style="color:#C60000;"></span>
										</div>
									</div>
									<div class="control-group">
										<label for="confirmfield" class="control-label">New Password</label>
										<div class="controls">
											<input type="password" name="pwfield" id="pwfield" class="input-xlarge" data-rule-equalTo="#pwfield" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="confirmfield" class="control-label">Confirm Password</label>
										<div class="controls">
											<input type="password" name="confirmfield" id="confirmfield" class="input-xlarge" data-rule-equalTo="#pwfield" data-rule-required="true">
										</div>
									</div>
									
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Submit" id="submt-id">
										<a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard"><button type="button" class="btn">Cancel</button></a>
									</div>
								</form>
							</div>
						</div>
				
			</div>
		</div></div>
		
	</body>

	</html>


<script type="text/javascript">
function update_currency()
{
	if (confirm("Are you sure you want to update Currency?"))
	{
		$.ajax({
		  url:'<?php echo WEB_URL_ADMIN; ?>admin/currency_value_update/',
		  data: '',
		  dataType: "json",
		  beforeSend:function(){
       			//$('#small_preloader').fadeIn('slow');
       			//$('#black_grid').fadeIn('slow');
		  },
		  success: function(result){
			 //alert(result);
			  $('#black_grid').fadeOut('slow');
			  $('#small_preloader').fadeOut('slow');
				if (result == 'success') 
				{
					window.location = '<?php echo WEB_URL; ?>admin/currencyconverter/';
				}
		  }
		 });

	}
}
</script>
<div id="left">
			
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>My Profile</span></a>
				</div>
				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">My Account</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/myprofile">My Profile</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/changepassword">change My Password</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>User Accounts</span></a>
				</div>
				<ul class="subnav-menu">
					
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">User List (B2C)</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>b2c/activeb2clist">Active User List</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>b2c/inactiveb2clist">Inactive User List</a>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>b2c/b2cregistration">New User Registration (B2C)</a>
							</li>
							
						</ul>
					</li>
					
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">User List (B2B)</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>b2b/activeb2blist">Active User List</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>b2b/inactiveb2blist">Inactive User List</a>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>b2b/add_agent">New User Registration (B2B)</a>
							</li>
							
						</ul>
					</li>
					
				</ul>
			</div>
            
            
			
			<!-- <div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Staff Accounts</span></a>
				</div>
				
				<ul class="subnav-menu">
					
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Staff List</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>staff/getlist/1">Active Staff List</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>staff/getlist/0">Inactive Staff List</a>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>staff/new_register">New Staff Registration</a>
							</li>
							</li>
						</ul>
					</li>
					
					
				</ul>
			</div> -->
			
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Markup</span></a>
				</div>
				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">B2C Markup</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>b2c/b2cmarkup/1">Hotel</a>
							</li>
							<!-- <li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/b2cmarkup/2">Flight General</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/b2cmarkup/5">Airlines</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/b2cmarkup/3">Car</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/b2cmarkup/4">Package</a>
							</li> -->
						</ul>
					</li>
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">B2B Markup</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>b2b/b2bmarkup/1">Hotel</a>
							</li>
							<!-- <li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/b2cmarkup/2">Flight General</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/b2cmarkup/5">Airlines</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/b2cmarkup/3">Car</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/b2cmarkup/4">Package</a>
							</li> -->
						</ul>
					</li>
				</ul>
			</div>
           <div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Mapping</span></a>
				</div>
				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">City Mapping</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>mapping/mapping_asaintravel" >Asiantravel City Mapping</a>
							</li>	
						</ul>
					</li>
					
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Hotel Mapping</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>mapping/mapping_hotel_asiantravel" >Asiantravel Hotel Mapping</a>
							</li>	
						</ul>
					</li>
					
				</ul>
			</div>
			
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Booking Reports</span></a>
				</div>
				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">B2C Reports</a>
						<ul class="dropdown-menu">
							
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>b2c/b2creports_hotel/1">Hotel</a>
							</li>
                            
							<?php /*<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/b2creports/2">Walkin User</a>
							</li> <?php */ ?>
							
						</ul>
					</li>
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">B2B Reports</a>
						<ul class="dropdown-menu">
							
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>b2b/b2breports_hotel/1">Hotel</a>
							</li>
                            
							<?php /*<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/b2creports/2">Walkin User</a>
							</li> <?php */ ?>
							
						</ul>
					</li>
				</ul>
			</div>
			<!-- <div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Content Manage</span></a>
				</div>
				<ul class="subnav-menu">
					<?php /*?><li class='dropdown'>
						<a href="#" data-toggle="dropdown">Latest News</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/addnews">Add News</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/newslist">List News</a>
							</li>
							
						</ul>
					</li><?php */?>
					<li>
						<a href="<?php echo WEB_URL_ADMIN ?>admin/newsletters">Newsletters</a>
					</li>
					<li>
						<a href="<?php echo WEB_URL_ADMIN ?>admin/bannerimages">Banner Images</a>
					</li>
					
				</ul>
			</div> -->
			<!-- <div class="subnav">
				<div class="subnav-title">
				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">CMS Home Pages</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/Cheap_flights">Cheap Flights</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/car_deals">Best Car Deals</a>
							
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/cheap_buis_fares">Cheap Buisiness Fares</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/hotel_deals">Best Hotel Deals</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/dealofday">Deal Of the Day</a>
							</li>
                            <li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/slidertopimages">Slider Top Images</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/airlines">Airlines</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/imp_air">Important Airports</a>
							</li>
						</ul>
					</li>
				</div>
				
			</div>-->
            <div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>My Control Panel</span></a>
				</div>
				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Currency Converter</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/currencyconverter">List Currency</a>
							</li>
							<?php /*?><li>
								<a href="javascript:void(0)" style="border-radius:0 8px 0 0" onclick="update_currency();">Update Currency</a>
							</li><?php */?>
						</ul>
					</li>
					 <li>
						<a href="<?php echo WEB_URL_ADMIN ?>admin/apimanagement">API Management</a>
					</li>
					<!--
					<li>
						<a href="<?php echo WEB_URL_ADMIN ?>admin/extrataxcharge">Extra Tax Charge</a>
					</li>
					<li>
						<a href="<?php echo WEB_URL_ADMIN ?>admin/paymentgateway">Payment Gateway</a>
					</li>
					<li>
						<a href="<?php echo WEB_URL_ADMIN ?>admin/paymentgatewaycharge">Payment Gateway Charge</a>
					</li>
                                        <li>
						<a href="<?php echo WEB_URL_ADMIN ?>admin/promocode_coupons">Promo Code Coupons</a>
					</li>-->
				</ul>
			</div>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Own Inventory</span></a>
				</div>
				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Manage Hotels</a>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/managehotel">Add Hotel</a>
							</li>
							<li>
								<a href="<?php echo WEB_URL_ADMIN ?>admin/viewhotel">Manage Hotel</a>
							</li>
						</ul>
					</li>

				</ul>
			</div>
		</div>

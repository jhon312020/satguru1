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
								<h3><i class="icon-list"></i>Voucher</h3>
							</div>
							<div class="box-content nopadding">
							
							
							<div style="width: 800px; margin: 0 auto;">
          <div style="width: 780px;padding: 10px; float: left;">
              <div style="width: 50%; float: left;"><h3><span style="color: #979797;">Hotel</span> Voucher</h3></div>
              <div style="width: 50%; float: right;text-align: right;"><img src="<?php echo WEB_DIR; ?>/assets/images/logo.png" width="220" height="80" style="margin-top: 10px;"></div>
          </div>
      
          <div style="width: 778px; border-left: 1px solid #de6061;border-right: 1px solid #de6061;border-top:3px solid #de6061;border-bottom: 3px solid #de6061; padding: 10px;float: left; border-radius: 5px;">
          
         
              <div style="width: 20px; float: left;">
                  <img src="<?php echo WEB_DIR; ?>/assets/images/tag-red.png">
              </div>
              <div style="width: 755px; float: left;">
                  <span style="color: #de6061;">Please Present This Voucher Upon Arrival</span>
                
                  <span style="float:right">
                  <a href="javascript:void(0);" onClick="javascript:window.print();" style="color: #8A8985;margin-right: 10px;text-decoration: none;font-size: 13px;" >Print</a>  
                  </span>
              </div>
              
              <div style="width: 758px; border: 1px solid #ccc; padding: 10px;float: left; border-radius: 5px; margin-top: 20px;background-color:#f7f6f6;">
              <table width="100%" cellpadding="5" cellspacing="5">
              <tr>
              	<td> <img src="<?php echo $hotel_result->image; ?>"  width="100px"/></td>
                <td   colspan="3">Hotel Name : <?php echo $hotel_result->hotel_name; ?><br />
                Address : <?php echo $hotel_result->address; ?></td>
               </tr>
               <tr>
              	<td style="color:#FFFFFF" bgcolor="#585858">Booking Number</td>
                <td style="color:#FFFFFF"  colspan="" bgcolor="#585858"><?php echo $result->pnr_no; ?></td>
                <td style="color:#FFFFFF"  bgcolor="#585858"> Hotel Booking_No</td>
                <td  style="color:#FFFFFF" bgcolor="#585858"> <?php echo $result->booking_no; ?></td>
               </tr>
               <tr>
              	<td bgcolor="#D0D0D0">Guest Name</td>
                <td colspan=""><?php echo $hotel_result->passanger; ?></td>
                <td bgcolor="#D0D0D0"> Total Price</td>
                <td> <?php echo $hotel_result->amount.' SGD'?></td>
               </tr>
               <tr>
              	<td bgcolor="#D0D0D0">Check In</td>
                <td colspan=""><?php echo  $hotel_result->check_in ?></td>
                <td bgcolor="#D0D0D0"> Check Out</td>
                <td> <?php echo $hotel_result->check_out; ?></td>
               </tr>
               <tr>
              	<td bgcolor="#D0D0D0">Room Type</td>
                <td colspan=""><?php echo $hotel_result->room_type ?></td>
                <td bgcolor="#D0D0D0"> Night</td>
                <td> <?php echo $hotel_result->nights;?></td>
               </tr>
               <tr>
              	<td bgcolor="#D0D0D0">Meals</td>
                <td colspan=""><?php echo $hotel_result->inclusion_val ;?></td>
                <td bgcolor="#D0D0D0"> Status</td>
                <td> <?php echo $result->api_status ?></td>
               </tr>
               <tr>
              	<td bgcolor="#D0D0D0">Extra Request</td>
                <td colspan=""><?php echo $hotel_result->cust_remark;?></td>
                <td bgcolor="#D0D0D0"> City Name</td>
                <td> <?php echo $hotel_result->city?></td>
               </tr>
                <tr>
              	<td colspan="4" bgcolor="#D0D0D0"><?php echo $result->BookedAndPaidval?></td>
               </tr>
               
              </table>
             
             
                  
                  
            </div>
			  
			   <div style="width: 780px; float: left; margin-top:0px; margin-bottom:3px;background-color:#EFEFEF; border-bottom:1px solid #DE6061;"><div style="width: 20px; margin-top:10px; float: left;margin-left:8px;">
                  <img src="<?php echo WEB_DIR; ?>/assets/images/tag-red.png">
              </div>
                      <div style="width:600px; float: left; margin-top:10px;margin-bottom:10px;margin-left:10px;"><div>DSS travel service is in charge of this booking's payment.</div>
					  <div style="clear:both;"></div>
					  <div>Please do not ask the guest payment Contact our reservation consor for anything to make sure.</div>
					  
					  </div>
                          
                  </div>
			  
              
            <div style="width: 758px; float: left; margin-top: 20px;">
              <div style="width: 780px; float: left; margin-top:0px;background-color:#EFEFEF;">
                     <div style="width: 20px; float: left;margin-left:8px;">
                  <img src="<?php echo WEB_DIR; ?>/assets/images/tag-red.png">
              </div>
              <div style="width: 600px; float: left;">
                  <span><b>Caution</b> &nbsp; &nbsp;Please read properly</span></div>
              </div>
              
                  <div style="width: 100%; border: 1px solid #ccc; border-radius: 5px; padding: 10px; float: left;">
                      <ul>
                          <li class="blt_li">IMPORTANT: At check-in ,you must present the credit card used to make this booking and  a valid photo ID with the same name.Failure to do so may result in the hotel requesting additional payment or your reservation not being honored.If you have submitted the DSS   Group fax form along with the required documentation for third party booking or paid via a different payment method ,please disgard the note above.</li>
                          <li class="blt_li">Unless otherwise indicated,all rooms are guaranteed on the day of arrival.In case of no-shows,your room(s) will be released and you will be subject to the term and condition of the Cancellation Policy specified in the Confirmation Booking email.</li>
                          <li class="blt_li">The total price for this booking does not include mini-bar items,telephone usage,laundry service,etc.If applicable the hotel will bill you directly.</li>
                          <li class="blt_li">In cases where Breakfast is included with the room rate,please note that certain hotels may charge extra for children travelling with their parents.Additional guests requesting extra beds are required to pay for breakfast.If applicable,the hotel will bill you directly.</li>
                          
                      </ul>
                  </div>
              </div>
              <div style="width: 758px; float: left; margin-top:0px;">
                  <p>Requests for booking changes or cancellation are possible duringthe business hours.(9.00-10.00)</p>
              </div>
              
              <div style="width: 778px; float: left;border:1px solid #CCC; background-color:#EEE">
                  <div style="width: 200px; float: left;"><img src="<?php echo WEB_DIR; ?>/assets/images/logo.png" width="180" style="margin-top: 10px;margin-left: 12px;"></div>
                  <div style="width: 223px; float:right;">Singapore : Tel- 09335757775</div>
              </div>
          </div>
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


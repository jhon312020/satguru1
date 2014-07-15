<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>DSS Travels</title>
        <!-- CSS -->
        <!--########### COMMON CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
        <!--########### COMMON CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab_rounded.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nivo-slider.css" type="text/css" media="screen" />
        <!--########### REGISTRATION CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin_style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" media="screen" />
        <!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themes.css">
    </head>
    <body>
        <!--########################## HEADER INCLUDE ##############################-->
        <?php $this->load->view('header_footer/header_hotel'); ?>
        <!--########################## HEADER INCLUDE ##############################-->
        <!--#################################### BODY CONTENT STARTS #################################################---> 
        <div class="inner_wrapper">  
            
        
        <div class="clear"></div>
        <!-- CONTENT WRAPPER -->
        <div class="top10"></div>
        <div class="content_wrapper11" style="box-shadow: none;">
            <div class="inner_wrapper" style="margin-top:20px;">
                <div class="book-head-icon">
                    <div class="book-icon12">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/myprofile.png" /></div>
                        <a href='<?php echo site_url()?>/b2b_account/myaccount' ><div class="book-icon3">My Profile</div></a>
                    </div>
                    <div class="book-icon12">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/mybooking.png" /></div>
                        <a href='<?php echo site_url()?>/b2b_account/mybooking'> <div class="book-icon3">My Booking</div></a>
                    </div>
                    <div class="book-icon12">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/cancellation.png" /></div>
                         <a href='<?php echo site_url()?>/b2b_account/mycancellation'><div class="book-icon3">Cancelled Booking</div></a>
                    </div>
                    <div class="book-icon13">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/password.png" /></div>
                        <a href='<?php echo site_url()?>/b2b_account/change_pwd'> <div class="book-icon3">Change Password</div></a>
                    </div>
                     <div class="book-icon11">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/dollor.png" /></div>
                        <a href='<?php echo site_url()?>/b2b_account/deposit'  style="color:#fff;"> <div class="book-icon3">My Deposit</div></a>
                    </div>
                     <div class="book-icon13">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/markup.png" /></div>
                        <a href='<?php echo site_url()?>/b2b_account/add_markup'> <div class="book-icon3"> Markup</div></a>
                    </div>
                </div>
                <div class="book-content">
					
					
				
             
                    <div class="row-fluid" style="clear: both;">
                    <div class="span12">
                       <div class="right_main_bar top20" style="margin-top:15px;width: 917px;">
                    <div class="fleft left20"><img src="<?php echo base_url(); ?>assets/images/white_arrow.png" align="absmiddle"> &nbsp;My Deposit </div><span style="float:right">Balance Amount : <?php echo $deposit_amount->balance_credit; ?> SGD&nbsp;&nbsp;</span>
                   
                </div>
                    </div>
                </div>
                	
                    	<a href="<?php echo site_url(); ?>/b2b_account/add_deposit/<?php echo $id; ?>" ><button class="btn btn-primary">Add New Deposit</button></a>
                    <div class="row-fluid top20" style="clear: both;">
                    <div class="span12">
                       <table class="table table-striped" style="border: 1px solid #ccc;border-radius: 5px 5px 0px 0px;border-collapse: separate;">
              <thead>
                <tr class="book-bg">
                  <th style='border-radius: 5px 0px 0px 0px;border-collapse: separate;'>No</th>
                
                  <th>Transaction Number</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Remarks</th>
                  <th>Status</th>
                 
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
												  
													
												   echo '&nbsp;'.$deposit[$i]->status; ?></td>
                                                
                                                 
                                               
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
                
                <style>
                    .table td {font-size: 12px;}
                </style>  

							</div>
						</div>
               
                </div>
                <!-- CONTENT WRAPPER END --></div>
            <div class="clear"></div>
            
            <div class="top30"></div>
            <div class="clear"></div>
        </div>
        <!--#################################### BODY CONTENT ENDS ###################################################--->
        <!--########################## FOOTER INCLUDE ##############################-->
        <?php $this->load->view('header_footer/footer'); ?>
        <!--########################## FOOTER INCLUDE ##############################-->
    </body>
    <!--###########AUTO COMPLETE#############-->            
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/autocomplete/hotels_city_autocomplete.js"></script>
    <!--###########AUTO COMPLETE#############-->
    <!--###########DATE PICKER#############-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui1.css" />
    <!--###########DATE PICKER#############--->
    <script type="text/javascript">
        var baseUrl = "<?php echo base_url() ?>";
        var siteUrl = "<?php echo site_url() ?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bjqs-1.3.min.js"></script>
    <!-- Home Slider Javascript--> 
    
    <script class="secret-source">
    jQuery(document).ready(function($) {
        $('#tabs').smartTab({autoProgress: false, stopOnFocus: true, transitionEffect: 'vSlide'});
    });
    </script><!-- Home Slider Javascript END-->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider();
        });
    </script>
    
    <script>
    function zeroPad(num, count)
    {
        var numZeropad = num + '';
        while (numZeropad.length < count) {
            numZeropad = "0" + numZeropad;
        }
        return numZeropad;
    }
    
    function dateADD(currentDate)
    {
        var valueofcurrentDate = currentDate.valueOf() + (24 * 60 * 60 * 1000);
        var newDate = new Date(valueofcurrentDate);
        return newDate;
    }
    var holydays = ['14-01-2014', '15-01-2014', '16-01-2014'];
	function highlightDays(date) {
		//alert("hii");
    for (var i = 0; i < 3; i++) {
        if (new Date(holydays[i]).toString() == date.toString()) {
			//alert("hi");
            return [true, 'highlight'];
        }
    }
    return [true, ''];

}
var holydays = ['01/01/2014','01/20/2014','02/17/2014','05/26/2014','07/04/2014','09/01/2014','10/13/2014','11/11/2014','11/27/2014','12/25/2014'];
var tips  = ['New Year','Martin Luther King Day','Presidents Day (Washington Birthday)','Memorial Day','Independence Day','Labor Day','Columbus Day','Veterans Day','','Christmas']; 
function highlightDays(date) {
   
    for (var i = 0; i < holydays.length; i++) {
        if (new Date(holydays[i]).toString() == date.toString()) {
            return [true, 'highlight',tips[i]];
        }
    }
    return [true, ''];

}
    $(function() {
		
        $( "#datepicker" ).datepicker({
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            //minDate: 1,
			firstDay: 1,
			inline: true,
			beforeShowDay: highlightDays
			
        });
        
       /* $( "#datepicker1" ).datepicker({
			changeMonth: true,
			changeYear: true,
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            minDate: 1
        });*/
        
    });
   
   $("#datepicker").change(function(){
				var selectedDate1= $("#datepicker").datepicker('getDate');
			  	var nextdayDate  = dateADD(selectedDate1);
				var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"-"+zeroPad((nextdayDate.getMonth()+1),2)+"-"+(nextdayDate.getFullYear());
				$t = nextDateStr;
				$('#out').html('<input type="text" name="ed" id="datepicker1" style="width:110px;" class="search_input_box4" value="'+$t+'"/> ');+
				$(function() {
							$( "#datepicker1").datepicker({
								
								 numberOfMonths: 2,
								 firstDay: 1,
								dateFormat: 'dd-mm-yy',
								buttonImageOnly: true,
								//minDate: $t
							});

						});
			});
    
    $('#oneway').click(function () {
        $('#return_date').hide();
    });
    $('#roundtrip').click(function () {
        $('#return_date').show();
    });
</script>
</html>    

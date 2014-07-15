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
                    
                     <div class="book-icon11" style="width:150px;">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/mybookinghover.png" /></div>
                        <a href='<?php echo site_url()?>/account/myprofile' style="color:#fff;"><div class="book-icon3">My Profile</div></a>
                    </div>
                    <div class="book-icon12">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/mybooking.png" /></div>
                        <a href='<?php echo site_url()?>/account/mybooking' > <div class="book-icon3">My Booking</div></a>
                    </div>
                    <div class="book-icon12">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/cancellation.png" /></div>
                         <a href='<?php echo site_url()?>/account/mycancellation'><div class="book-icon3">Cancelled</div></a>
                    </div>
                    <div class="book-icon13">
                        <div class="book-icon2"><img src="<?php echo base_url(); ?>assets/images/book-icon/password.png" /></div>
                        <a href='<?php echo site_url()?>/account/change_pwd'> <div class="book-icon3">Change Password</div></a>
                    </div>
                </div>
                <div class='row-fluid top20' style='clear: both;float: left;'>
                    <div class='span6'>
                        <h4><?php echo $custdet->firstname." ".$custdet->lastname; ?></h4>
                    </div>
                   <div class='span6 align-right'>
                        <a href="<?php echo site_url()?>/account/edit_profile"><button class="btn-profile top24" type="button">Edit Profile</button></a>
                        
                    </div>
                </div>
                <div class='row-fluid top20' style='clear: both;float: left;'>
                    <div class='span6'>
                         <div class="right_main_bar top20" style="margin-top:15px;width: 220px;">
                    <div class="fleft left20">Contact Details</div>
                   
                </div>
                        <div class='profile-detail'>
                            <dl class="dl-horizontal" style='margin: 3px;'>
                              <dt>Address : </dt>
                              <dd><?php echo $custdet->address;?></dd>
                            </dl>
                            <dl class="dl-horizontal" style='margin: 3px;'>
                              <dt>Mobile : </dt>
                              <dd><?php echo $custdet-> 	contact_no; ?></dd>
                            </dl>
                           
                        </div>
                    </div>
                    <?php /*?><div class='span6 align-right'>
                        <div class="right_main_bar top20" style="margin-top:15px;width: 220px;">
                    <div class="fleft left20">Personal Details</div>
                   
                </div>
                        <div class='profile-detail'>
                            <dl class="dl-horizontal" style='margin: 3px;'>
                              <dt>DOB : </dt>
                              <dd></dd>
                            </dl>
                           <label class="checkbox">
  <input type="checkbox" value="">
  <span style='float: left;'>Option one is this and that be sure to include why it's great</span>
</label>
                        </div>
                    </div><?php */?>
                </div>
                
                <style>
                    .table td {font-size: 12px;}
                    .dl-horizontal dt{text-align: left;width: auto;font-size: 12px;}
                    .dl-horizontal dd {font-size: 12px;
margin-left: 78px;
}
.checkbox input[type="checkbox"] {
float: left;
margin-left: 0px;
}
                </style>  
<!--                <div class="box box-color box-bordered red">
                
							<div class="box-title">
								<h3>
									<i class="icon-ok"></i>
									<span style="font-size:18px;">Create your <span style="color:#da2121; font-size:16px;">akbartravels.us</span> account</span>
								</h3>
							</div>
         
              </div>-->
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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
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
    
    <script type="text/javascript">
        
        $( "#room_count" ).change(function() {
            var roomCount=$('#room_count').val();
            $.ajax({
                url:"<?php echo site_url(); ?>/home/getAdultChilds/",
                data:"count="+roomCount,
                type: "GET",
                dataType: "json",
                beforeSend:function(){
                      $("#loading").html("");
                },
                success: function(data){
                      $("#adultchild").html(data.total_result);
                },
                error:function(request, status, error){

                }
           });
        });
        
        $( "#child_count0" ).change(function() {
            var roomCount=$('#child_count0').val();
            $.ajax({
                url:"<?php echo site_url(); ?>/home/showChildAgeBox/",
                data:"count="+roomCount+"&rm="+0,
                type: "GET",
                dataType: "json",
                beforeSend:function(){
                      $("#loading").html("");
                },
                success: function(data){
                      $("#child_age0").html(data.total_result);
                },
                error:function(request, status, error){

                }
           });
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
    
    $(function() {
        $( "#datepicker" ).datepicker({
            numberOfMonths: 3,
            dateFormat: 'yy-mm-dd',
            minDate: 1
        });
        
        $( "#datepicker1" ).datepicker({
            numberOfMonths: 3,
            dateFormat: 'yy-mm-dd',
            minDate: 1
        });
        
    });
    
    $('#datepicker').change(function() {
      //$t=$(this).val();
      var selectedDate = $(this).datepicker('getDate');
      var str1 = $("#datepicker1").val();
      var predayDate = dateADD(selectedDate);
      var str2 = zeroPad(predayDate.getDate(), 2) + "-" + zeroPad((predayDate.getMonth() + 1), 2) + "-" + (predayDate.getFullYear());
      var dt1 = parseInt(str1.substring(0, 2), 10);
      var mon1 = parseInt(str1.substring(3, 5), 10);
      var yr1 = parseInt(str1.substring(6, 10), 10);
      var dt2 = parseInt(str2.substring(0, 2), 10);
      var mon2 = parseInt(str2.substring(3, 5), 10);
      var yr2 = parseInt(str2.substring(6, 10), 10);
      var date1 = new Date(yr1, mon1, dt1);
      var date2 = new Date(yr2, mon2, dt2);
      if (date2 < date1)
      {

      }
      else
      {
          var nextdayDate = dateADD(selectedDate);
          var nextDateStr = (nextdayDate.getFullYear()) +"-"+zeroPad((nextdayDate.getMonth() + 1), 2)+"-"+zeroPad(nextdayDate.getDate(), 2);

          $t = nextDateStr;
          $( "#datepicker1" ).datepicker({
                numberOfMonths: 3,
                dateFormat: 'yy-mm-dd',
                minDate: 1
            });
          $("#datepicker1").val($t);
      }

    });
    
    
</script>
</html>    

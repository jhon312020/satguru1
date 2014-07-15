        <script type="text/javascript" src="<?php print base_url();  ?>assets/autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
        
<link rel="stylesheet" href="<?php print base_url();  ?>assets/autofill/css/autosuggest_inquisitor1.css" type="text/css" media="screen" charset="utf-8" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab_rounded.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nivo-slider.css" type="text/css" media="screen" />
<form name="hotel_search" method="POST" action="<?php echo site_url() ?>/hotel/search" onSubmit="return validate_form()">
<div style="float:left;">
    <div class="padding_top_bottom5">
        <input type="text" class="search_input_box ui-autocomplete-input"  value="<?php echo $_SESSION['city']; ?>" name="cityval" style="font-size:12px;" id="cityName1"/> <br  /><span id="dorigin_error" style="color:#F00;"></span>
        <script type="text/javascript">
	    var options = {
		script:"<?php echo base_url(); ?>test_hotel.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('cityName1').value = obj.id; } };
	    var as_json = new AutoSuggest('cityName1', options);
        </script>
    </div> 
    <!--      <div class="padding_top_bottom5">
          <select class="selectbox_modify1">
          <option>Nationality</option>
          </select>
          </div>-->
    <div class="padding_top_bottom5" style="margin-top:5px; float:left">
        <input type="text" name="sd" value="<?php echo date($_SESSION['cin']); ?>" placeholder="Check In" class="search_input_box4" style="font-size:11px; padding-left:5px; margin-right:10px;" id="datepicker" />
        <br  /><span id="date_error" style="color:#F00;"></span>
        <input type="text" name="ed" style="font-size:11px; padding-left:5px;" value="<?php echo date($_SESSION['cout']); ?>" placeholder="Check Out" class="search_input_box4" id="datepicker1" />
         <br  /><span id="date_error1" style="color:#F00;"></span>
    </div>
    <div class="clear"></div>
    <div class="padding_top_bottom5">
        <select  class="search_input_box ui-autocomplete-input"  style="width:90px;" name="room_count" id="room_count">
            <?php for($r=1;$r<=8;$r++){ ?>
                 <option value="<?php echo $r; ?>">Room: <?php echo $r; ?></option>
            <?php } ?>
        </select>
    </div>
    <div style="clear:both;"></div>
        <div id="adultchild">
        
        <div class=" fleft" style="width:100%;">
        <div class="padding_top_bottom5">
            <div>
                <select name="adult[]" class="search_input_box ui-autocomplete-input"  style="width:90px;"  id="adult_count0">
                    <option value="1">Adult 1</option>
                                 <option value="2">Adult 2</option>
                                  <option value="3">Adult 3</option>
                                   <option value="4">Adult 4</option>
                </select>
            </div>

            <div style="float:left; width: 110px;">
                <select name="child[]" class="search_input_box ui-autocomplete-input"  style="width:90px;  margin-left:10px;"  id="child_count0">
                    <?php for($c=0;$c<=3;$c++){ ?>
                        <option value="<?php echo $c; ?>" >child: <?php echo $c; ?></option>
                    <?php } ?>
                </select>
                <div id="child_age0">
               
                </div>
            </div>
        </div>
        </div>
            <script type="text/javascript">
                $( "#child_count0" ).change(function() {
                    var roomCount=$('#child_count0').val();
                    $.ajax({
                        url:"<?php echo site_url(); ?>/home/showChildAgeBoxModify/",
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
        
    </div>
    <div class="clear"></div>
    <div align="right" class="padding_top_bottom5"><input type="submit" value="Search" class="booking_button" /></div>
    <div></div>
    <div></div>
</div>
</form>
 <!--###########AUTO COMPLETE#############-->            
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.ui.min.css" type="text/css" />
    
     <script src="<?php echo base_url(); ?>assets/js/jquery.ui.min.js"></script>
     <?php /*?> <script src="<?php echo base_url(); ?>assets/js/jquery.autocomplete.min.js"></script><?php */?>
     
       <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/filter/scripts/jquery-1.7.2.min.js"></script> 
    <!-- For slider filter and sorting js--> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/filter/scripts/jquery-ui-1.8.20.custom.min.js"></script>
    <link type="text/css" href="<?php echo base_url(); ?>assets/js/filter/styles/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/filter/hotel/filter.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/filter/hotel/sorting.js"></script> 
    <!-- For slider filter and sorting js--> 
    
     <!--###########AUTO COMPLETE#############-->            
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/autocomplete/hotels_city_autocomplete.js"></script>
    <!--###########AUTO COMPLETE#############-->
    <!--###########DATE PICKER#############-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script type="text/javascript">
        var baseUrl = "<?php echo base_url() ?>";
        var siteUrl = "<?php echo site_url() ?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bjqs-1.3.min.js"></script>
     
    <!--###########AUTO COMPLETE#############-->
    <!--###########DATE PICKER#############-->
     <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui1.css" />
    <!--###########DATE PICKER#############--->
    <!-- Home Slider Javascript--> 
    
    <script class="secret-source">
    jQuery(document).ready(function($) {
        $('#tabs').smartTab({autoProgress: false, stopOnFocus: true, transitionEffect: 'vSlide'});
    });
    </script><!-- Home Slider Javascript END-->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider({effect:'slideInRight'});
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
   var holydays = ['01/01/2014','01/20/2014','02/17/2014','05/26/2014','07/04/2014','09/01/2014','10/13/2014','11/11/2014','11/27/2014','12/25/2014'];
	var tips  = ['New Year','Martin Luther King Day','Presidents Day (Washington Birthday)','Memorial Day','Independence Day','Labor Day','Columbus Day','Veterans Day','','Christmas'];      
function highlightDays(date) {
   
    for (var i = 0; i < holydays.length; i++) {
        if (new Date(holydays[i]).toString() == date.toString()) {
            return [true, 'highlight', tips[i]];
        }
    }
    return [true, ''];

}
    $(function() {
        $( "#datepicker" ).datepicker({
            numberOfMonths: 2,
           dateFormat: 'yy-mm-dd',
            minDate: 1,
			firstDay: 1,
			inline: true,
			beforeShowDay: highlightDays
        });
        
        $( "#datepicker1" ).datepicker({
            numberOfMonths: 2,
           dateFormat: 'yy-mm-dd',
            minDate: 1,
			firstDay: 1
        });
        
    });
    
    $('#datepicker').change(function() {
				var selectedDate1= $("#datepicker").datepicker('getDate');
			  	var nextdayDate  = dateADD(selectedDate1);
				var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"-"+zeroPad((nextdayDate.getMonth()+1),2)+"-"+(nextdayDate.getFullYear());
				$t = nextDateStr;
				$('#out').html('<input type="text" name="ed" id="datepicker1" class="search_input_box4" value="'+$t+'" style="color:#70a4d1;"/> ');+

         				$(function() {
							$( "#datepicker1").datepicker({
								
								 numberOfMonths: 2,
								 firstDay: 1,
								dateFormat: 'yy-mm-dd',
								buttonImageOnly: true,
								minDate: $t
								
								
							});

						});
     

    });
    
    
</script>
<script>

 function validate_form()
 {
	 var dorigin = $('#cityName1').val();
	 var sd = $('#datepicker').val();
	 var ed = $('#datepicker1').val();
	 //alert(sd);
	 var stryear1 = sd.substring(6);
 var strmth1  = sd.substring(0,2);
 var strday1  = sd.substring(5,3);
 var date1    = new Date(stryear1  ,strday1,strmth1);
 
 //seperate the year,month and day for the second date
 var stryear2 = ed.substring(6);
 var strmth2  = ed.substring(0,2);
 var strday2  = ed.substring(5,3);
 var date2    = new Date(stryear2 ,strday2,strmth2  );
 
 var datediffval = (date2 - date1 )/864e5;
//alert(datediffval);
	 //var ddestination = $('#ddestination').val();
	
	 if(dorigin == 'Type Departure Location Here' || dorigin == '')
	 {
		  document.getElementById("dorigin_error").innerHTML = "Please Select Destination";
		  document.getElementById("cityName1").focus();
		 return false;
	 }
	/* else if(ddestination == 'Type Arrival Location Here' || ddestination == '')
	 {
		 document.getElementById("dorigin_error").innerHTML = "";
		  document.getElementById("ddestination_error").innerHTML = "Please Select Travelling To";
		  document.getElementById("ddestination").focus();
		 return false;
	 }*/
	 else if(sd == '')
	  {
		 document.getElementById("dorigin_error").innerHTML = "";
		 ///document.getElementById("ddestination_error").innerHTML = "";
		 document.getElementById("date_error").innerHTML = "Please Select Checkin Date";
		 document.getElementById("datepicker").focus();
		 return false;
	  }
	   else if(ed == '')
	  {
		 document.getElementById("dorigin_error").innerHTML = "";
		 ///document.getElementById("ddestination_error").innerHTML = "";
		 document.getElementById("date_error1").innerHTML = "Please Select Checkout Date";
		 document.getElementById("datepicker1").focus();
		 return false;
	  }
	   else if(datediffval<=0)
	  {
		 document.getElementById("dorigin_error").innerHTML = "";
		 ///document.getElementById("ddestination_error").innerHTML = "";
		 document.getElementById("date_error1").innerHTML = "Please select proper checkout date";
		 document.getElementById("datepicker1").focus();
		 return false;
	  }
	   else if(datediffval>=20)
	  {
		 document.getElementById("dorigin_error").innerHTML = "";
		 ///document.getElementById("ddestination_error").innerHTML = "";
		 document.getElementById("date_error1").innerHTML = "Please select date within 20days";
		 document.getElementById("datepicker1").focus();
		 return false;
	  }
	  else
	  {
		  document.getElementById("dorigin_error").innerHTML = "";
		  document.getElementById("date_error").innerHTML = "";
		  //document.getElementById("ddestination_error").innerHTML = "";
		 // document.flight_search.submit();
	  }
 }
 </script>

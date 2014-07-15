<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>DSS DEMO</title>
        <!-- CSS -->
        <!--########### COMMON CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/search_result.css" type="text/css"/>
        
        <!--########### COMMON CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab_rounded.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nivo-slider.css" type="text/css" media="screen" />
    </head>
    <body>
        <!--########################## HEADER INCLUDE ##############################-->
        <?php $this->load->view('header_footer/header_hotel'); ?>
        <script type="text/javascript" src="<?php print base_url();  ?>assets/autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print base_url();  ?>assets/autofill/css/autosuggest_inquisitor1.css" type="text/css" media="screen" charset="utf-8" />
        <!--########################## HEADER INCLUDE ##############################-->
        
        <div class="inner_wrapper">  
            <div class="tabMain">
                 <div class="tabs">
                    <ul style="width:auto; flat:left; padding-left:0px; ">
                        <li><a href="<?php echo site_url(); ?>/home/flights">Flights<br />
                            </a></li>
                        <li style="background: linear-gradient(to bottom, #f19a24 0%, #f19a24 50%, #ef6806 50%, #ef6806 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);"><a href="<?php echo site_url(); ?>/home/hotels">Hotels<br />
                            </a></li>
                        <li><a href="<?php echo site_url(); ?>/home/cars">Car<br />
                            </a></li>
                        <?php /*?><li><a href="<?php echo site_url() ?>/package_home">Packages<br />
                            </a></li><?php */?>
                    </ul>	</div> 

                <form name="hotel_search" method="POST" action="<?php echo site_url(); ?>/hotel/search" onSubmit="return validate_form()">
                <div class="tabmain_container">
                    <div class="top_search_area">
                        <h1 style="color:#F80000; font-weight:bold; padding-left:12px;">SEARCH FOR HOTELS </h1>
                    </div>
                    <div class="clear"></div>
                    <div style="padding:15px;" >
                        <div class="fleft">
                            <label class="label" style="color:#fff; font-weight:bold; "> Choose Destination </label> <br />
                            <input class="search_input_boxbig" name="cityval" type="text" id="cityName1" style="color: #999999;
    font-size: 13px; padding:5px; height: auto;"/>
                             <br  /><span id="dorigin_error" style="color:#F00;"></span>
        <script type="text/javascript">
	    var options = {
		script:"<?php echo base_url(); ?>test_hotel.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('cityName1').value = obj.id; } };
	    var as_json = new AutoSuggest('cityName1', options);
        </script>
                        </div>
                        <div class="clear"></div>        
                        <div class="fleft top10">
                            <label class="label" style="color:#fff; font-weight:bold; font-size:11px; ">Check in</label> <br />
                            <input class="search_input_box4" name="sd" type="text" id="datepicker" style="color:#999;" />
                            <br  /><span id="date_error" style="color:#F00;"></span>
                        </div>
                        <div class="fleft left10 top10">
                            <label class="label" style="color:#fff; font-weight:bold; font-size:11px; ">Check out</label> <br />
                            <input class="search_input_box4" name="ed" type="text" id="datepicker1"  style="color:#999;"/>
                        </div>
                        <div class="fleft left10  top10">
                            <label class="label" style="color:#fff; font-weight:bold; font-size:11px; ">Room(s)</label> <br />
                            <select name="room_count" class="search_input_box2" id="room_count" style="-moz-appearance: none; -webkit-appearance: none;
    text-indent: 0.01px;  color:#2F382F; 
    text-overflow: ''; padding:5px; height:30px;">
                                <?php for($r=1;$r<=8;$r++){ ?>
                                <option value="<?php echo $r; ?>"><?php echo $r; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="clear"></div>
                        <div id="adultchild">
                            <div class="fleft top10">
                                <label class="label" style="color:#fff; font-weight:bold; font-size:11px; ">Adult(s)</label> <br />
                                <select name="adult[]" class="search_input_box2" id="adult_count0" style="-moz-appearance: none; -webkit-appearance: none;
    text-indent: 0.01px;
    text-overflow: ''; padding:5px; height:30px;">
                                    <?php for($a=1;$a<=4;$a++){ ?>
                                    <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="fleft left10 top10">
                                <label class="label" style="color:#fff; font-weight:bold; font-size:11px; "">Child(ren)</label> <br />
                                <select name="child[]" class="search_input_box2" id="child_count0" style="-moz-appearance: none; -webkit-appearance: none; 
    text-indent: 0.01px;
    text-overflow: ''; padding:5px; height:30px; color:#2F382F; " >
                                    <option value="0">0</option>
                                    <?php for($c=1;$c<=3;$c++){ ?>
                                    <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div id="child_age0">
                                
                            </div>
                        </div>
                        <button class="search_btn" type="submit"><img src="<?php echo base_url(); ?>assets/images/search_icon.png" align="absmiddle" />Search Hotel</button>
                    </div> 
                </div>
                </form>
            </div>
            
            <div class="toplayer1 fright top50" style="width:370px;">
           <span style="margin-top:10px; float:left; width:322px; height:62px;">
                <img src="<?php echo base_url(); ?>assets/images/express_deals.png" />
</span>

<span style="margin-top:10px; float:left; width:322px; height:70px; margin-bottom:15px;">
                <img src="<?php echo base_url(); ?>assets/images/express_deals1.png" />
</span>

                <div class="top50 "><img src="<?php echo base_url(); ?>assets/images/dealoftheday.png" /></div>
            
            </div>
        </div>
        <!-- SLIDER WRAPPER -->
        <div id="wrapper">
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider">
                 <?php
						$slider_images = $this->Home_Model->get_fightsliderImages(); 
						if(isset($slider_images)){ if($slider_images != ''){ foreach($slider_images as $si){
						?>
                    <img src="<?php echo base_url(); ?>admin/banner_images/<?php echo $si->file_path;?>" />
                   
				  <?php }}}?>
                  
                </div>
                <div id="htmlcaption" class="nivo-html-caption">
                    <strong></strong> <em></em> <a href="#"></a>. 
                </div>
            </div>
        </div> <!-- SLIDER WRAPPER END -->
        <div class="clear"></div>
        <!-- CONTENT WRAPPER -->
        <div class="top10"></div>
        <div class="content_wrapper">
    <div class="inner_wrapper" style="margin-top:200px;">
        <!-- LEFT SIDE -->
                
                <div style="width:1020px; height:auto; float:left;">
                
                <div class="step1">
                
                <div class="box1">
                
                 <h1 style="font-weight:bold; font-size:18px;">Recent Search</h1>
                    <div class="left_side_box" style="min-height:302px; padding:0px;">

						<?php $recent_search = '';
						$r= 0;
							  if(isset($recent_search)) { if($recent_search != '') { foreach($recent_search as $rec) {
								  //echo $rec->alocation; 
								  $from1 = $rec->dlocation;
								  $from = substr($from1,0,3);
								  $to1 = $rec->alocation;
								  $to = substr($to1,0,-3);
								  $dep1 = $rec->ddate1;
								  $dep = substr($dep1,0,8);
								  $deps = explode('-',$dep);
								  $depss = "20".$deps[2]."-".$deps[1]."-".$deps[0];
								  
								  $arv1 = $rec->adate1;
								  if(strpos($rec->dlocation,'<br>'))
								  {
								  		$dlocation = explode('<br>',$rec->dlocation);
										$dloc = $dlocation[0];
								  }
								  else
								  {
									  $dloc =$rec->dlocation;
								  }
								  
								  if(strpos($rec->alocation,'<br>'))
								  {
								  		$alocation = explode('<br>',$rec->alocation);
										$count = count($alocation);
										$con = $count -1;
										$aloc = $alocation[$con];
								  }
								  else
								  {
									   $aloc =$rec->alocation;
								  }
								  
								 $from_cit = $this->Home_Model->get_from_city($dloc);
								 $to_cit = $this->Home_Model->get_from_city($aloc);
								  ?>
                                   <script type="text/javascript">
									function recent_flightas<?php echo $r; ?>()
									{
										$("#recent_flights<?php echo $r; ?>").submit();
									}
									</script>
									<form name="recent_flights<?php echo $r; ?>" id="recent_flights<?php echo $r; ?>" action="<?php echo site_url(); ?>/flights/search1" method="post">
									<input type="hidden" name="from_city1" value="<?php echo $from_cit->city."-".$from_cit->country.",".$from_cit->city_code; ?>"  />
									<input type="hidden" name="to_city1" value="<?php echo $to_cit->city."-".$to_cit->country.",".$to_cit->city_code; ?>"  />
									<input type="hidden" name="adult" value="<?php echo $rec->adults; ?>" />
									<input type="hidden" name="child" value="<?php echo $rec->childs; ?>" />
									<input type="hidden" name="infant" value="<?php echo $rec->infants; ?>" />
									<input type="hidden" name="cabin" value="<?php echo $rec->cabin_selected; ?>"  />
									<input type="hidden" name="sd" value="<?php echo $rec->sd; ?>"  />
                                    <?php if($rec->journey_types == 'Round')
									{
										$journey_type = 'Round';
									}
									else
									{
										$journey_type = 'OneWay';
									}
									if($journey_type == 'Round') { 
									?>
                                    <input type="hidden" name="ed" value="<?php echo $rec->ed; ?>"  />
                                    <?php } else {  ?> <input type="hidden" name="ed" value=""  /> <?php } ?>
								   <input type="hidden" name="journey_type" value="<?php echo $journey_type; ?>"  />
								   </form>
                        <div class="left_txt_area">
                            <div  class="fleft red_txt left10" onclick="recent_flightas<?php echo $r; ?>();" style="cursor:pointer;"> <?php echo $from; ?> </div>
                            <div class="fleft left10" onclick="recent_flightas<?php echo $r; ?>();" style="cursor:pointer;"> <img src="<?php echo base_url(); ?>assets/images/arrow_icon.png" /></div>
                            <div class="fleft red_txt left10" onclick="recent_flightas<?php echo $r; ?>();" style="cursor:pointer;"><?php echo $aloc; ?></div>
                            <div class=" wid100 fleft left40" onclick="recent_flightas<?php echo $r; ?>();" style="cursor:pointer;"><?php echo date('M d',strtotime($depss)); ?> - <?php echo date('M d',strtotime($depss)); ?>  <?php if($rec->journey_types == 'Round') { echo "Round Trip"; } else { echo "One Way"; } ?> &#36;<?php echo round($rec->FareAmount); ?></div>
                        </div>
						<?php $r++; } } } ?>
                        
               </div>
               </div>
               
               <div class="box2">
              <h1 style="font-weight:bold; font-size:18px;">best hotel deals</h1>
                   <?php
				   			$hotel = 0;
							$hotel_deals = '';
							if(isset($hotel_deals)){ if($hotel_deals != ''){ foreach($hotel_deals as $hd){
					?>
                    <form name="hotel_form<?php echo $hotel; ?>" id="hotel_form<?php echo $hotel; ?>" action="#" method="post">
                    <input type="hidden" name="check_in" id="check_in" value="<?php echo date('d-m-Y'); ?>" />
                    <input type="hidden" name="check_out" id="check_out" value="<?php echo date('d-m-Y', strtotime(date('d-m-Y') . ' + 1 day')); ?>" />
                    <input type="hidden" name="room_count[]" id="room_count" value="1" />
                    <input type="hidden" name="adult[]" id="adult" value="1" />
                    <input type="hidden" name="child[]" id="child" value="0" />
                    <input type="hidden" name="hotel_name" id="hotel_name" value="<?php echo $hd->hotel_name; ?>" />
                    </form>
                     <script type="text/javascript">
						function get_hoteldetails<?php echo $hotel; ?>()
						{
							$("#hotel_form<?php echo $hotel; ?>").submit();
						}
					</script>
                    <div class="best_hotel_bg" style="margin-top:3px; margin-left:5px; margin-right:5px; margin-bottom:8px;">
                    	
                        <div style="width:194px; height:auto; float:left;  padding:10px;">
                        
          				<span><img src="<?php echo base_url(); ?>admin/banner_images/<?php echo $hd->image ;?>" width="194" height="80" border="0" title="<?php echo $hd->hotel_name;?>" onclick="get_hoteldetails<?php echo $hotel; ?>()" style="cursor:pointer;"/></span> 
                       </div>
                       
                       <div style="width:215px; height:auto; float:left; background-color:#fff;">
                      <div  style="width:auto; float:left; margin-left:9px; padding:5px;">
                            <span onclick="get_hoteldetails<?php echo $hotel; ?>()"><?php echo $hd->hotel_name; ?><span class="red_txt1"><br/> From &#36;<?php echo $hd->fare;?></span></span> <span class="blue_txt1"><a href="#" style="text-decoration:blink; font-weight:bold; color:#083e73;" >Book Now </a></span>
                        </div> </div>
                    </div>
                    <?php $hotel++; }}}?>
               </div>
               
               
               <div class="box3">
               
               <h1 style="font-weight:bold; font-size:18px;">Best car deals</h1>
                    <?php 
							$car_deals = '';
							$c = 0;
							if(isset($car_deals)){if($car_deals != ''){ foreach($car_deals as $cd){
					?>
                    <script type="text/javascript">
							function car_deals_form<?php echo $c; ?>()
							{
								$("#car_dealsfr<?php echo $c; ?>").submit();
								//document.car_dealsfr<?php echo $c; ?>.submit();
							}
							</script>
                    <form name="car_dealsfr<?php echo $c; ?>" id="car_dealsfr<?php echo $c; ?>" action="#" method="post">
                    <input type="hidden" value="<?php $cd->traveltype; ?>" name="travel_type"  />
                    	<?php if($cd->traveltype == 1) { ?>
                    	<input type="hidden" name="city_from_local" id="city_from_local" value="<?php echo $cd->source_local; ?>"  />
                        <input type="hidden" name="duration_local" id="duration_local" value="6"  />
                        <input type="hidden" name="sd" id="sd" value="<?php echo date('d-m-Y'); ?>"  />
                        <?php }
						else
						{ ?>
                        <input type="hidden" name="city_from" id="city_from" value="<?php echo $cd->source_outstation; ?>"  />
                        <input type="hidden" name="city_to" id="city_to" value="<?php echo $cd->city_to; ?>"  />
                        <input type="hidden" name="duration" id="duration" value="22"  />
                        <input type="hidden" name="ed" id="ed" value="<?php echo date('d-m-Y'); ?>"  />
                        <?php } ?>
                    </form>
                    <div class="right_txt_area"> 
                        <div class="fleft wid100" style="margin-right:10px;">
                        	<a href="#" title="<?php echo $cd->carname;?>"><img src="<?php echo base_url(); ?>admin/banner_images/<?php echo $cd->image ;?>" border="0" align="top" width="92" height="65" onclick="car_deals_form<?php echo $c; ?>();"/></a>
                        </div>
                        <div onclick="car_deals_form<?php echo $c; ?>();" style="cursor:pointer;  line-height:16px; font-size:12px;  "><?php $car_det = $cd->cardetails; echo substr($car_det,0,53).'...';?></div>
                    </div>
                    <?php $c++; }}}?></div>

         
</div>

<div class="step1" style="margin-top:10px;" >
      
           <div class="box4">
            <h1 style="font-weight:bold; font-size:18px;">Best Flight Offers</h1>
            <span><img src="<?php echo base_url(); ?>assets/images/w1.jpg" /></span>
           
           </div>
           
           
           <div class="box5" >
           <h1 style="font-weight:bold; font-size:18px;">Top Hotel deals</h1>
           <div class="box1body">
<div class="special-body">
<div class="special-box">
<div class="special-boxin">
<div class="special-img"><img src="<?php echo base_url(); ?>assets/images/tophotel.jpg" width="92" height="86" /></div>
<div class="special-textbox">
<h2>Dubai Holidays</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text f the printing </p>
</div>
<div class="special-textbox-rightimg"></div>
<div class="special-textbox-right">
<div class="special-form">Form</div>
<div class="special-rate">$4500</div>
<div class="special-form" style="margin-top:3px;">On Words</div>
</div>

</div>
</div>

<div class="special-box">
<div class="special-boxin">
<div class="special-img"><img src="<?php echo base_url(); ?>assets/images/tophotel.jpg" width="92" height="86" /></div>
<div class="special-textbox">
<h2>Dubai Holidays</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text </p>
</div>
<div class="special-textbox-rightimg"></div>
<div class="special-textbox-right">
<div class="special-form">Form</div>
<div class="special-rate">$4500</div>
<div class="special-form" style="margin-top:3px;">On Words</div>
</div>

</div>
</div>

<div class="special-box">
<div class="special-boxin">
<div class="special-img"><img src="<?php echo base_url(); ?>assets/images/tophotel.jpg" width="92" height="86" /></div>
<div class="special-textbox">
<h2>Dubai Holidays</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy texthe printing and typesetting industry.  </p>
</div>
<div class="special-textbox-rightimg"></div>
<div class="special-textbox-right">
<div class="special-form">Form</div>
<div class="special-rate">$4500</div>
<div class="special-form" style="margin-top:3px;">On Words</div>
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
        <!--#################################### BODY CONTENT ENDS ###################################################--->
        <!--########################## FOOTER INCLUDE ##############################-->
        <?php $this->load->view('header_footer/footer'); ?>
        <!--########################## FOOTER INCLUDE ##############################-->
    </body>
    <!--###########AUTO COMPLETE#############-->            
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.ui.min.css" type="text/css" />
    
     <script src="<?php echo base_url(); ?>assets/js/jquery.ui.min.js"></script>
     <?php /*?> <script src="<?php echo base_url(); ?>assets/js/jquery.autocomplete.min.js"></script><?php */?>
     
     
     
    <script src="<?php echo base_url(); ?>assets/js/autocomplete/hotels_city_autocomplete.js"></script>
    <!--###########AUTO COMPLETE#############-->
    <!--###########DATE PICKER#############-->
     <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui1.css" />
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
                numberOfMonths: 2,
                dateFormat: 'yy-mm-dd',
                minDate: 1
            });
          $("#datepicker1").val($t);
      }

    });
	
    
    
</script>
<script>

 function validate_form()
 {
	 var dorigin = $('#cityName1').val();
	 var sd = $('#datepicker').val();
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
	  else
	  {
		  document.getElementById("dorigin_error").innerHTML = "";
		  document.getElementById("date_error").innerHTML = "";
		  //document.getElementById("ddestination_error").innerHTML = "";
		 // document.flight_search.submit();
	  }
 }
 </script>
</html>    

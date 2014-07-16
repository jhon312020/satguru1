<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DSS DEMO</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/search_result.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab.css" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script>
<script src="<?php echo base_url(); ?>assets/js/menu_jquery.js"></script>
<link href="<?php echo base_url(); ?>assets/slider_scripts/listings-59ffb9b6c75d3dc35ae9fc56850da63e.css" rel="stylesheet" type="text/css" />

</head>
<style type="text/css">

.stepcarousel{
	position: relative;
	overflow: scroll; /*leave this value alone*/
	width: 1035px; /*Width of Carousel Viewer itself*/
	height: 170px; /*Height should enough to fit largest content's height*/
	-moz-border-radius: 0px 10px 10px 0px;
    -webkit-border-radius: 0px 10px 10px 0px;
    -khtml-border-radius: 0px 10px 10px 0px;
    border-radius: 0px 10px 10px 0px;

	background-color: #none;/*
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FFFFFF), to(#F1F1F1));
    background: -webkit-linear-gradient(top, #F1F1F1, #FFFFFF);
    background: -moz-linear-gradient(top, #F1F1F1, #FFFFFF);
    background: -ms-linear-gradient(top, #F1F1F1, #FFFFFF);
    background: -o-linear-gradient(top, #F1F1F1, #FFFFFF);*/
	margin:0 8px 8px 8px;
	margin-left:160px;
	font-family:Tahoma, Geneva, sans-serif;
	font-size:12px;
}

.stepcarousel .belt{
position: absolute; /*leave this value alone*/
left: 0;
top: 0;
}

.stepcarousel .panel{
	float: left; /*leave this value alone*/
	overflow: hidden; /*margin around each panel*/
	width: 100px; /*Width of each panel holding each content. If removed, widths should be individually defined on each content DIV then. */
	padding-right: 0px;
	padding-left: 0px;
	margin-top: 0px;
	margin-right: 5px;
	margin-bottom: 0px;
	margin-left: 0px;/*
	border-right:1px solid #CCCCCC;*/
	background:none;
	border:1px solid #ccc;
}


</style>
<body>
        <!--########################## HEADER INCLUDE ##############################-->
        <?php $this->load->view('header_footer/header_hotel'); ?>
        <!--########################## HEADER INCLUDE ##############################-->
        <!--#################################### BODY CONTENT STARTS #################################################--->
        <div class="inner_wrapper">
            <!-- LEFT PART -->
            <div class="left_part"> 
            
            <div class="blue_bg top20 left5" style="margin-left:0px;">
                    <div class="lblue_bg">
                        <div class="left_header" style=" color:#000; margin-bottom:10px;">Price Range</div>
                        <span id="priceSliderOutput" style="font-weight: normal; margin:10px 0px 0px 10px; "></span>
                        <div style="padding:10px 0px 0px 0px; margin: 0px;">
        <div id="priceSlider" style="width:175px"></div>
                          <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                          <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
                
                <div class="blue_bg top20 left5" style="margin-left:0px; margin-top:10px;">
                    <div class="lblue_bg">
                        <div class="left_header" style=" color:#000; margin-bottom:10px;">Hotel Name Search</div>
                         
                        <div style="padding:0px 0px 0px 0px; margin: 0px;">
                           
                          <input id="hotelName" class="travller_inputbox178 hotel_name" name="hotel_name" type="text" style="width:206px; padding:0px; margin:0px; color:#5B5B5B;" /> 
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
            
             <div class="left_header1_bg top20" style="margin-top:10px;"><span class="top20" style="margin-left:15px;" >Stars</span></div>
                <div style="clear:both;"></div>
                <div class="lblue1_bg ">
                    <div class="wid80 fleft" style=" width:70px;">
                        <input  id="0" value="0" name="starr" type="checkbox" class="star" checked="checked"  /> Unrated
                    </div>
                    
                    <div class="wid80 fleft" style=" width:70px;">
                        <input  id="1" value="1" name="starr" type="checkbox" class="star" checked="checked"  /> 1 <img src="<?php echo base_url(); ?>assets/images/star.png" />
                    </div>
                    
                     <div class="wid80 fleft" style=" width:70px;">
                        <input  id="2" value="2" name="starr" type="checkbox" class="star" checked="checked"  /> 2 <img src="<?php echo base_url(); ?>assets/images/star.png" />
                    </div>
                    <br />
   <br />
                     <div class="wid80 fleft" style=" width:70px;">
                       <input  id="3" value="3" name="starr" type="checkbox" class="star" checked="checked"  /> 3 <img src="<?php echo base_url(); ?>assets/images/star.png" />
                    </div>
                    
                    <div class="wid80 fleft" style=" width:70px;">
                        <input  id="4" value="4" name="starr" type="checkbox" class="star" checked="checked"  /> 4 <img src="<?php echo base_url(); ?>assets/images/star.png" />
                    </div>
                    
                    <div class="wid80 fleft" style=" width:70px;">
                        <input  id="5" value="5" name="starr" type="checkbox" class="star" checked="checked"  /> 5 <img src="<?php echo base_url(); ?>assets/images/star.png" />
                    </div>
                    
                     
                     <br />
   <br />
                     
                     
                     
                </div>
                
                
                
                
                
                
                
                
                
                
                
                
                <div style="clear:both;"></div>
                
               
                <div >&nbsp;&nbsp;</div>
                <div id='cssmenu'  >
               
                    <ul>
                        <li class='has-sub active'><a href='#'><span>Your Search Details</span></a>
                            <ul style="line-height:20px; font-family:Arial, Helvetica, sans-serif; font-size:12px; display:block;">
                               <span style="width:100px; float:left;">Hotels In </span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['city']; ?><br /></span>
                                <span style="width:100px; float:left;">Checkin Date</span> <span style="font-weight:bold; color:#025590;">:
								<?php //echo date('M d, Y',strtotime('Y-m-d',$cin2)); ?>
                                <?php echo date($_SESSION['cin']); ?><br /></span>
                               <span style="width:100px; float:left;"> Checkout Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo date($_SESSION['cout']); ?><br /></span>
                                <span style="width:100px; float:left;">Adults </span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['adult_count']; ?><br /></span>
                                <span style="width:100px; float:left;">Childs</span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['child_count']; ?><br /></span>
                                <span style="width:100px; float:left;">Rooms</span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['room_count']; ?><br /></span>
                                <span style="width:100px; float:left;">Nights</span> <span style="font-weight:bold; color:#025590;"> :&nbsp;<?php echo $_SESSION['days'];?></span>
                            </ul>
                            <div style="clear:both;"></div>
                        </li>
                        <li class='has-sub'><a href='#'><span>Modify Search</span></a>
                            <ul>
                                
                                    <?php $this->load->view('hotel/modify_search'); ?>
                                 
                            </ul>
                            <div style="clear:both;"></div>
                        </li>
                         <li class='has-sub'><a href='#'><span>Legend </span></a>
                            <ul>
                   <span style="width:100px; float:left;">Instant Book</span> <span style="width: 55px; float:right;"class="btnBook_instant"></span>
                   <span style="width:100px; float:left;">Request Book</span> <span style="width: 55px; float:right;"class="btnBook_request"></span>
                   <span style="width:100px; float:left;">Sold Out</span> <span style="width: 55px; float:right;background-color: red;clear: both;color: #FFFFFF;font-style: normal;font-weight: bold;margin-right: 5px;padding: 8px;text-align: center;"></span>
                                    
                                 
                            </ul>
                            <div style="clear:both;"></div>
                        </li>
                        
                       
                        
                        <!--<li class='has-sub'><a href='#'><span>Facilities</span></a>
                            <ul style=" font-family:Arial, Helvetica, sans-serif; font-size:11px; ">
                                <div class="top10" style="margin-top:2px; margin-bottom:5px;"> <select name="" class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:210px; padding:5px; font-size:11px; color:#F00;">
                              <option>Click here for more Facilities</option>
                            </select></div>
                                <div class="top10" style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:3px; margin-right:5px;" value="NRP" checked  onclick="return filter();"/>WI-FI</div>
                                <div class="top10"  style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:3px; margin-right:5px;" value="RP" checked  onclick="return filter();"/>Parking</div>
                                <div class="top10"  style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:3px; margin-right:5px;" value="RP" checked  onclick="return filter();"/>Fitness Center</div>
                                <div class="top10"  style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:3px; margin-right:5px;" value="RP" checked  onclick="return filter();"/>Non-Smoking Rooms</div>
                                <div class="top10"  style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:3px; margin-right:5px;" value="RP" checked  onclick="return filter();"/>Indoor Pool</div>
                                <div class="top10"  style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:3px; margin-right:5px;" value="RP" checked  onclick="return filter();"/>Spa</div>
                                <div class="top10"  style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:3px; margin-right:5px;" value="RP" checked  onclick="return filter();"/>Outdoor Pool</div>
                                <div class="top10"  style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:3px; margin-right:5px;" value="RP" checked  onclick="return filter();"/>Restaurant</div>
                                <div class="top10"  style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:3px; margin-right:5px;" value="RP" checked  onclick="return filter();"/>TV Room</div>
                                 <div class="top10"  style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:3px; margin-right:5px;" value="RP" checked  onclick="return filter();"/>Kitchen</div>
                                  <div class="top10"  style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:3px; margin-right:5px;" value="RP" checked  onclick="return filter();"/>Bathtub</div>
                            </ul>
                        </li>-->
                        
                        
                        
                         
                    </ul>
                </div>
            </div>
            <!-- LEFT PART END -->

            <!-- RIGHT PART -->

          <div class="right_part top30" style="width:765px; margin-left:0px;">
          
                <div class="right_main_header" ><span id="hotelCount">Searching</span> Hotels Available in <?php echo $_SESSION['city']; ?> </div>
                <div style="color:#063879; font-size:11px; margin-top:0px;">Adult :<?php echo $_SESSION['adult_count']; ?> &nbsp;| &nbsp;Checkin :<?php echo date($_SESSION['cin']); ?> &nbsp; |&nbsp; Checkout :<?php echo date($_SESSION['cout']); ?> &nbsp;  | &nbsp;Rooms:<?php echo $_SESSION['room_count']; ?></div>
                <div style="clear:both"></div>
                
                
                <span id="spot_hotels"></span>
                 <div style="clear:both"></div>
                <div class="right_main_bar top20">
                
               
                
                    <!--<div class="fleft left20"><img src="<?php echo base_url(); ?>assets/images/white_arrow.png" align="absmiddle" /> &nbsp;Book Your Hotels</div>
                    <div class="fright" style="margin-right:20px;">Prev Day  |  Next Day</div>
                    <div class="clear"></div>-->
                      
                    <!--########################## MATRIX PART START  ###################################-->   
                    <!--<div id="matrix_result"></div>-->
                    <!--######################### MATRIX PART END  ####################################--> 

                    <div class="cler"></div><div class="cler"></div>
                    <div class="sort_bar top10 clear"  style="margin-bottom:5px;" >
                        <div class="wid108 right_devider center_txt fleft">Sort By ></div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Price" rel="data-price" data-order="asc" class="HotelSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" border="0" /></a> &nbsp;Price&nbsp;  <a href="javascript:void(0);" title="Sort By Price" rel="data-price" data-order="desc" class="HotelSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/downarror.png" border="0" /> </a>
                      </div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Star" rel="data-star" data-order="asc" class="HotelSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" border="0" /></a> &nbsp;Star rating&nbsp; <a href="javascript:void(0);" title="Sort By Star" rel="data-star" data-order="desc" class="HotelSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/downarror.png" border="0" /> </a>
                      </div>
                        <div class="wid108 right_devider center_txt fleft" style="border-right:0px;">
                            <a href="javascript:void(0);" title="Sort By Hotel Name" rel="data-hotel-name" data-order="asc" class="HotelSorting" style="text-decoration:none; color:#fff; "><img src="<?php echo base_url();?>assets/images/uparror.png" border="0" /> </a>&nbsp;Hotel Name&nbsp;  <a href="javascript:void(0);" title="Sort By Hotel Name" rel="data-hotel-name" data-order="desc" class="HotelSorting" style="text-decoration:none; color:#fff; "><img src="<?php echo base_url();?>assets/images/downarror.png" border="0" /> </a>
                    </div>
                        <?php /*?><div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Duration" rel="data-duration" data-order="asc" class="HotelSorting" style="text-decoration:none; color:#00306D;"><img src="<?php echo base_url();?>assets/images/uparror.png" /> &nbsp;Price &nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" /></a>
                        </div><?php */?>
                         
                         
                    </div>
                    <div class="clear"></div>
                   <!--####################### FLIGHT LIST START  #################################-->
                   <div class="content resultHotels" id="result" style="background-image:none; float:left; width:771px;">
                       <div id="progressbar" style=" margin-top:70px;" align="center"><img src="<?php echo base_url();?>assets/images/ajax-loader1.gif" width="" /></div>
                   </div>
                   
                    <input type="hidden" id="setMinPrice" value="0" />
					<input type="hidden" id="setMaxPrice" value="0" />
					<input type="hidden" id="setCurrency" value="SGD" />
                   <!--####################### FLIGHT LIST END ####################################-->
                </div>
          </div>
          <!--##################################### RIGHT PART END  ###########################################################--->
        </div>
        <!--#################################### BODY CONTENT ENDS ###################################################--->
        <!--########################## FOOTER INCLUDE ##############################-->
      <div style=" bottom:0px; background:bottom;">
        <?php $this->load->view('header_footer/footer'); ?></div>
        <!--########################## FOOTER INCLUDE ##############################-->
        
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
    <script type="text/javascript">
    $(document).ready(function()
    {  
   					var a = [<?php echo $api_fs; ?>];
					
						var api_url='<?php echo site_url(); ?>';
						var api_dir='<?php echo base_url(); ?>';
						
						
				var total_count = 	'';
			

  	  var i = 0;
 	  var aa='';
 	  $final=0;
  	  $('#loading').fadeIn();
	   
    function nextCall() 
	{

		if(i == a.length) 
		{
			$('#loading').fadeOut();
			$('#loading_image').hide();
			$('#proceddd_idbar').fadeOut();
			$('#loading_result').fadeIn();
			$('#loading_imagea').fadeIn();
			$('#hotels_available').fadeIn();
			return; 
		}
		
		if(i == (a.length-1)) 
		{
			$final=1;
		}
		$.ajax({
			  type: 'POST',
			  url: api_url+'/api/call_api_search_result/'+a[i]+'/'+$final,
			  data: '',
			  async: true,
			  dataType: 'json',
			  beforeSend:function(){
				 $(".nextpage").hide();
			 },
			success: function(data){
				i++;
				nextCall();
				
				if(data.hotel_search_result != "")
				{
						$('#preloading_div').fadeOut('slow');
						$('#black_grid').fadeOut('slow');
						
						if(data.hotel_search_result == false || data.hotel_search_result == null)
						{
						 $('#noresult').fadeIn();
						}
						$(".nextpage").fadeIn('slow');
						$("#hotelCount").html(data.total_result);
						$('#place').html(data.place);
						$('#priceStarts').html(data.per_night_min);
						$('#chain').html(data.chain);
						$('#result').html(data.hotel_search_result);
						if(i == (a.length)) 		
						{
							$('.min_rate_final_load').hide();
							$('.min_rate_final').fadeIn();
						}
						//alert(data.min_val);alert(data.max_val);
						var minVal = parseFloat(data.min_val);
						var maxVal = parseFloat(data.max_val);
					
						/*$( "#slider-range" ).slider({
							range: true,
							min: minVal,
							max: maxVal,
							values: [ minVal, maxVal ],
							slide: function( event, ui ) {
								var r = Math.round(ui.values[ 0 ] );
								var rr = Math.round(ui.values[ 1 ]);
								$( "#amount_dummy" ).val( ui.values[ 0 ] + "  to " + ui.values[ 1 ] );
								$( "#amount" ).val( "USD " + r + "  to  USD " + rr );
							},
							  change: function( event, ui ) {
							  if (event.originalEvent) {
								filter();
								loadData(1);  // For first time page load default results
							   
							  }
							}
						});
						$( "#amount_dummy" ).val( $( "#slider-range" ).slider( "values", 0 ) +
							"  to   " + $( "#slider-range" ).slider( "values", 1 ) );
							
					$( "#slider-range-star" ).slider({
							range: true,
							min: 0,
							max: 5,
							values: [ 0, 5 ],
							slide: function( event, ui ) {
								$( "#star" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
							},
							  change: function( event, ui ) {
							  if (event.originalEvent) {
								 // alert("hi");
								filterSearch();
								loadData(1);
								
							  }
							}
						});
						$( "#star" ).val( $( "#slider-range-star" ).slider( "values", 0 ) +
							" - " + $( "#slider-range-star" ).slider( "values", 1 ) );*/
				
					$('#setMinPrice').val(minVal);		
					$('#setMaxPrice').val(maxVal);		
					setPriceSlider();
					 
					$order='asc';
					$sortBy='data-price';
					sortHotels($order,$sortBy,$('.HotelSorting'));
					 
					var hotelCount=0;						
					$(".HotelInfoBox").each(function()
					{
						hotelCount++;
					   
					});	
					
					$("#hotelCount").text(hotelCount);	
					$("#hotelCount1").text(hotelCount);	
			}
			else
			{
				$('#result').html('<div class="no_available" style="text-align:center"><h1>There are no available hotels  for your stay. </h1><img src="'+api_dir+'assets/images/no_hotel_img.png" width="154" height="154" /><br /><br /><div class="no_available_text" style="color:#333">Sorry, we have no prices for hotels in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div></div>');
			}
		  },
		 	error:function(request, status, error){
			$('#preloading_div').fadeOut('slow');
			$('#black_grid').fadeOut('slow');

			if(i==0)
			{
			$('#result').html('<div class="no_available" style="text-align:center"><h1>There are no available hotels  for your stay. </h1><img src="'+api_dir+'assets/images/no_hotel_img.png" width="154" height="154" /><br /><br /><div class="no_available_text" style="color:#333">Sorry, we have no prices for hotels in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div></div>');
			}
			else{//alert(a[i]+" Having some problem cotact your admin")cust_support
			}
		  }
		  
			});
			
		}
		
		  nextCall();
		$('#loading').hide();
		
		

    function search_view(val)
  {
	  if(val==2)
	  {
		  //grid
		  $("#grid").show();
		  $("#itemContainer").hide();
	  }
	  else
	  {
		   $("#itemContainer").show();
		  $("#grid").hide();
		  
	  }
  }
  

 
 
		
		$(".star").click(function()
                {
                    filter();
                });
                  
               
		  
		 
            
    });
    
    $("#loc_name0").click(function()
    {
        alert('helll');
         filter();
    });
</script> 

<script type="text/javascript">

$(document).ready(function()
{
    $("#hotelName").keyup(function()
    {       
        var filter = $(this).val(), count = 0;
        
        var regex = new RegExp(filter, "i"); 
       
        $(".HotelInfoBox").each(function()
        {           
            if ($(this).attr('data-hotel-name').search(regex) < 0) 
            { 
                 $(this).parents(".searchhotel_box").hide();         
            } 
            else 
            {
				count++;
                $(this).parents(".searchhotel_box").show();
               
            }
            
        });

        // Update the count
       $("#hotelCount").text(count);	
        
    });   
    
	 $("#hotelArea").keyup(function()
    {       
        var filter = $(this).val(), count = 0;
        
        var regex = new RegExp(filter, "i"); 
       
        $(".HotelInfoBox").each(function()
        {   
			if ($(this).attr('data-location').search(regex) < 0) 
            { 
                 $(this).parents(".searchhotel_box").hide();         
            } 
            else 
            {
				count++;
                $(this).parents(".searchhotel_box").show();
               
            }        
            if ($(this).attr('data-address').search(regex) < 0) 
            { 
                 $(this).parents(".searchhotel_box").hide();         
            } 
            else 
            {
				count++;
                $(this).parents(".searchhotel_box").show();
               
            }
            
        });

        // Update the count
       $("#hotelCount").text(count);	
        
    });   
	
	$("#searchDetails").click(function(){
		
		if ($('#searchDetails_block').css('display') == 'none') 
		{
			$("#searchDetails").removeClass('modify_search_icon');
			$("#searchDetails").addClass('modify_search_icon1');
		}
		else
		{
			$("#searchDetails").removeClass('modify_search_icon1');
			$("#searchDetails").addClass('modify_search_icon');
		}			
			$("#searchDetails_block").slideToggle();
			
	});
        
        $("#modifysearch").click(function(){
		
		if ($('#modifysearch_block').css('display') == 'none') 
		{
			$("#modifysearch").removeClass('modify_search_icon');
			$("#modifysearch").addClass('modify_search_icon1');
		}
		else
		{
			$("#modifysearch").removeClass('modify_search_icon1');
			$("#modifysearch").addClass('modify_search_icon');
		}			
			$("#modifysearch_block").slideToggle();
			
	});
	
	
	$("#facilityDetails").click(function(){
		
		if ($('#facilities_block').css('display') == 'none') 
		{
			$("#facilityDetails").removeClass('modify_search_icon');
			$("#facilityDetails").addClass('modify_search_icon1');
		}
		else
		{
			$("#facilityDetails").removeClass('modify_search_icon1');
			$("#facilityDetails").addClass('modify_search_icon');
		}			
			$("#facilities_block").slideToggle();
			
	});
	
    
});



</script>
    <script type="text/javascript">
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
<style type="text/css">
.message {
    position: absolute;
    top: 100px;
    left: 0;
    width: 100%;
    text-align: center;
    opacity: 0;
    -webkit-transform: scale(.9, .9);
    -webkit-transition: all .18s ease-in-out;
}
.info:hover + .message {
    opacity: 1;
    -webkit-transform: scale(1, 1);
}
a { 
	text-decoration:none; 
	color:#f30000;
}

.post { margin: 0 auto; padding-bottom: 50px; float: left; width: 960px; }



.btn-sign a { color:#fff; text-shadow:0 1px 2px #161616; }

#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

.login-popup{
	display:none;
	background: #fff;
	padding: 10px; 	
	border: 2px solid #ddd;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top: 50%; left: 50%;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999;
	-moz-box-shadow: 0px 0px 20px #999; /* Firefox */
    -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
    -moz-border-radius: 3px; /* Firefox */
    -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close {
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#999; 
	font-size:11px; 
	line-height:18px;
} 

form.signin .textbox input { 
	background:#666666; 
	border-bottom:1px solid #333;
	border-left:1px solid #000;
	border-right:1px solid #333;
	border-top:1px solid #000;
	color:#fff; 
	border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
    -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:200px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.button { 
	background: -moz-linear-gradient(center top, #f3f3f3, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#dddddd));
	background:  -o-linear-gradient(top, #f3f3f3, #dddddd);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#f3f3f3', EndColorStr='#dddddd');
	border-color:#000; 
	border-width:1px;
	border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
    -webkit-border-radius: 4px;
	color:#333;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:314px;
}

.button:hover { background:#ddd; }

</style>

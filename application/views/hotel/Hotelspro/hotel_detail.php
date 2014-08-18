<?php
	$hotel_details= $this->Hotel_Model->get_permanent_details_v3_Hotelspro($id,$api);
	$hotel_code = $hotel_details->Hotelspro_Hotelcode;
	$hotel_name = $hotel_details->Hotel_name;
	$star = $hotel_details->Hotel_star;
	$image = $hotel_details->Hotel_thumbnail;
	if($image=='')
	{
		$image= base_url().'assets/images/img/noimagefound.jpg';
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>satguru</title>
        <!-- CSS -->
        <!--########### COMMON CSS #############-->    
<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/languages/jquery.validationEngine-en.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/Validation/css/validationEngine.jquery.css" media="all" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/search_result.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab.css" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script>
<script src="<?php echo base_url(); ?>assets/js/menu_jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bjqs-1.3.min.js"></script>
    <!-- Home Slider Javascript--> 
    
    <script class="secret-source">
    jQuery(document).ready(function($) {
        $('#tabs').smartTab({autoProgress: false, stopOnFocus: true, transitionEffect: 'vSlide'});
    });
    </script>
      
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

	background-color: #none;
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

.header-rights {
	height:120px !important;
	
	}







</style>
       <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js" > </script>
       
       
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/slimbox2.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slimbox2.css" type="text/css" media="screen" />
        
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/search_result.css" type="text/css"/>
        <!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flexslider.css" type="text/css" media="screen" />-->
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/camera.css" type="text/css" media="screen" />
        <!--########### COMMON CSS #############-->    
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    </head>
    <body>
<?php $this->load->view('header_footer/header_hotel'); ?>
<div class="inner_wrapper" >
<div class="padding10 part985">
    <div class="left_part">
        <div id='cssmenu'>               
          <ul>
           <li class='has-sub active'><a href='#'><span>Your Search Details</span></a>
           <ul style="line-height:20px; font-family:Arial, Helvetica, sans-serif; font-size:12px; display:block;">
           <span style="width:100px; float:left;">Hotels In </span> 
           <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['city']; ?><br /></span>
           <span style="width:100px; float:left;">Checkin Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;
			<?php //echo date('M d, Y',strtotime('Y-m-d',$cin2)); ?>
            <?php  echo date($_SESSION['cin']); ?><br /></span>
            <span style="width:100px; float:left;"> Checkout Date</span>
            <span style="font-weight:bold; color:#025590;">:&nbsp;<?php  echo date($_SESSION['cout']); ?><br /></span>
            <span style="width:100px; float:left;">Adults </span>
            <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['adult_count']; ?><br /></span>
            <span style="width:100px; float:left;">Childs</span>
            <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['child_count']; ?><br /></span>
            <span style="width:100px; float:left;">Rooms</span>
            <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['room_count']; ?><br /></span>
            <span style="width:100px; float:left;">Nights</span>
            <span style="font-weight:bold; color:#025590;"> :&nbsp;<?php echo $_SESSION['days'];?></span>
           </ul>
           <div style="clear:both;"></div>
           </li>
           <li class='has-sub'><a href='#'><span>Modify Search</span></a>
           <ul>
		   <?php $this->load->view('hotel/modify_search'); ?>
           </ul>
           <div style="clear:both;"></div>
           </li>
           <li class='has-sub'><a href='#'><span>Last Viewed Hotels</span></a>
           <ul>
          <?php //$last_viewed_hotels = $this->Asiantravel_Model->last_viewed_hotels(); ?>
           <div class="bg_whight">
            <div class="padding10">
                <div class="font_size20 color_blue">Last Viewed Hotel</div>
                <div class="border_bottom2"></div>
                <div class="font_size14 color_blue padding_top_bottom">
                <?php if(isset($last_viewed_hotels)) { if($last_viewed_hotels != '') { foreach($last_viewed_hotels as $last) { ?>
                    <div class="lastview_hotel_img">
                        <img src="<?php echo $hotel_details->image; ?>" width="60" height="60" />
                    </div>
                    <div class="lastview_hotel_name_stars font_size14" align="left" style="width:117px;">
                        <strong><?php echo $hotel_details->hotel_name; ?></strong>
                        <div class="clear"></div>
                        <div class="stars5" style="width:112px"></div>
                    </div>
                    <div class="clear_space1"></div>
                    <div class="border_bottom2"></div>
                    <div class="clear_space1"></div>
                    <?php } } } ?>
                </div>
            </div>
        </div>
                                 
                            </ul>
                            <div style="clear:both;"></div>
                        </li>
                    </ul>
                </div>
    </div>
    <div class="right_part" style="width:750px; margin-left:0px;">
        <div class="color_blue1 font_size22 padding10"><strong><?php echo $hotel_details->Hotel_name ; ?></strong>
        <?php /*?><span style="float:right"><input type="button" value="Back" class="book_btn1" onClick="goBack()" /></span><?php */?>
        <script>
		function goBack()
		  {
		  window.history.back()
		  }
		</script>
            <div class="clear"></div>
        </div>
        <div class="bg_whight">
            <div class="padding10">
                <div class="padding5 text3">
                    <div class="hotel_image"><img src="<?php echo $image; ?>" width="140" height="140" /></div>
                    <div class="hotel_text_detail" style="width:552px;">
                    <div class="trip_rating_part" align="center">
  <div ></div>
                        
                        <div class="clr_space"></div>
                        
                    </div>
                        <div class="text12" style="color:#08427e;"><?php echo $hotel_details->Hotel_name; ?></div>
                        <div style="color:#535353; font-size:11px;"><?php echo $hotel_details->Hotel_address; ?><br /><?php echo $hotel_details->Hotel_location; ?><br /><?php echo $hotel_details->Hotel_postalcode; ?> </div>
                        <div class=""><img src="<?php echo base_url().'assets/images/dummy/star-active'.$hotel_details->Hotel_star.'.png'; ?>" style="border: none;"/></div>
                        <div class="clr_space"></div>
                        <div style="width:444px; float:left; color:#333; font-size:11px; line-height:15px;  margin-top:-7px; margin-bottom:-7px;">
                    <p><!--<b><?php //echo preg_replace("/[^a-z0-9_-]/i", " ", $hotel_details->HotelDesc); ?></b> <br>--><b><?php echo preg_replace("/[^a-z0-9_-]/i", " ",  substr($hotel_details->Hotel_description,0,200)); ?></b></p><div class="clr"></div>
                </div>
                        <div class="clr_space"></div>
                        <?php  
						//$cur=floor(0.20669*$hotel_details->AvgPrice);?>
                        <div style="float:right; font-size:20px; color:#2981BC; font-weight:bold;" ><?php //echo 'SGD  '.$hotel_details->AvgPrice	;?></div>
                        
                        
                <?php ?>
                    </div>
                    
                    
                    <div class="clear"></div>
                    <!--select room part-->
                    <div>
                        <div class="clear_space1"></div>
                    </div>
                    <!--select room part-->
                    <div class="clear"></div>
                    <div class="padding5 border_bottom3"></div>
                </div>
                <div class="clear"></div>
                
                <div class="clear_space1"></div>
                <div class="bg03">
                    <div class="tab-box"> 
                        <a href="javascript:;" class="tabLink activeLink" id="cont-1">Availbility</a> 
                    <a href="javascript:;" class="tabLink " id="cont-3">Amenities</a> 
                        <a href="javascript:;" class="tabLink " id="cont-4">Photos</a> 
                        <a href="javascript:;" class="tabLink " id="cont-5">Description</a> 
                    </div>
                    <div class="tabcontent" id="cont-1-1" style="padding-left:4px;"> 
                    <div id="result">
                    <div id="progressbar" style=" margin-top:50px;" align="center"><img src="<?php echo base_url();?>assets/images/ajax-loader1.gif" width="" /></div></div>
                    
                    </div>
                    
                    <div class="tabcontent hide" id="cont-3-1"> 
                    
                        <div class="padding10">
    <?php 
		  if($hotel_details->Hotel_facility!='')
		  {
          ?>
                 <div class="row-fluid top20">
              <div class="span12">
                  <div class="detail-tim" style=" font-size:13px"><strong>Hotel Facilities</strong></div>
              </div>
          </div>
           <div class="row-fluid">
              <div class="span12">
             
                 
                 
              <div class="span12">
                  <div class=""><br /><?php 
				$hotel_fac = explode(";",$hotel_details->Hotel_facility);
					for($ssd=0;$ssd<count($hotel_fac);$ssd++)
					{
							 echo  '&bull; '.$hotel_fac[$ssd].''.'<br> ';
							// echo  $fac_r_s[$sd].' - '.$fac_r_Fee[$sd].'<br>' ;
					}
				
				
				
			
				?>   <br /><br /> </div>
              </div>
              
                <div align="left" style="color:#F00">Note : <?php echo '<img  width="20" src="'.base_url().'assets/img/paid.png">'; ?> Some services shall be paid at the establishment.&nbsp;</div>
              </div>
               
          </div>
          <?php 
		  }
		  if($hotel_details->Room_facility!='')
		  {
          ?>
          <div class="row-fluid top20">
              <div class="span12">
                  <div class="detail-tim" style=" font-size:13px"><strong>Room Facilities</strong></div>
              </div>
          </div>
           <div class="row-fluid">
              <div class="span12">
             
                 
                 
              <div class="span12">
                  <div class=""><br /><?php 
				  
				$room_fac = explode(";",$hotel_details->Room_facility);
					for($ssd=0;$ssd<count($room_fac);$ssd++)
					{
							 echo  '&bull; '.$room_fac[$ssd].''.'<br> ';
							// echo  $fac_r_s[$sd].' - '.$fac_r_Fee[$sd].'<br>' ;
					}
				
				
				
				
			
				?>   <br /><br /> </div>
              </div>
              
                <div align="left" style="color:#F00">Note : <?php echo '<img  width="20" src="'.base_url().'assets/img/paid.png">'; ?> Some services shall be paid at the establishment.&nbsp;</div>
              </div>
               
          </div>
          
          <?php
		  }
				
				?>
                        </div><div class="clear"></div>
                    </div>
 
                   <div class="tabcontent hide" id="cont-4-1"> 
                    
                        <div class="padding10" style="width:700px">
      			
       <?php 
	  // echo '<pre/>';
	   //print_r($result['h_images']);exit;
	   $hotel_images = explode(" ",$hotel_details->Hotel_images);
	for($im=0;$im<count($hotel_images);$im++)
	{
		?>
        <div style="width: 230px;
float: left;
margin-top: 10px;
text-align: center;">
      <a href="<?php  echo $hotel_images[$im]; ?>" rel="lightbox"   title="" > <img width="230" height="165" src="<?php echo $hotel_images[$im]; ?>" /> </a>
      </div>
        <?php
	}
	?>
                        </div><div class="clear"></div>
                    </div>
                    <div class="tabcontent hide" id="cont-5-1"> 
                        <div class="padding10">
                            <?php 
                                      if(isset($hotel_details->Hotel_description))
                                {
                                echo '</br>';
							
                                    echo htmlspecialchars($hotel_details->Hotel_description);
									
                                }
                            ?>
                        </div>
                    </div> 
                </div>
               
                
                <div class="clear_space1"></div>
                
                 <div class="right_main_tab right_main_bar top10"  style="width:728px;">
                    <div class="fleft left20"> &nbsp;Hotel Map</div>
                </div>
                <div class = "hotel_details" id="" style="height:300px; width:720px; border:5px solid #F2F2F2; float:left;" ><div class="">
                  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

<script type="text/javascript">
             
function initialize() {
  var myLatlng = new google.maps.LatLng(<?php print $hotel_details->Hotel_latitude; ?>,<?php print $hotel_details->Hotel_longitude; ?>);
  var mapOptions = {
    zoom: 14,
    center: myLatlng
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var contentString = '<table width="350" cellspacing="5" cellpadding=5><tr><td  width="100" ><img src="<?php echo $image; ?>" width="100" height="100"></td><td align="left"  width="250" ><span style="font-size:14px;color:red"><?php echo $hotel_details->Hotel_name; ?></span><br><?php echo $hotel_details->Hotel_address; ?><br /><?php echo $hotel_details->Hotel_location; ?></td></tr></table>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
	  icon: '<?php echo base_url();?>assets/images/hotel-icon-50x50-grey.png',
      title: '<?php echo $hotel_details->Hotel_name; ?>'
  });
 
   google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });

 
}

google.maps.event.addDomListener(window, 'load', initialize);

			 
                </script>             
     <table align="left" width="724" border="0" cellspacing="0" cellpadding="5" class="sum-txt" style="margin-top:2px; font-size:15px; border-radius:10px;">
      <tr>
         <td align="left">
         	<div id="map-canvas" style="width: 711px; height:290px;margin-bottom:5px">Not Available</div>
         </td>
      </tr>
    </table></div></div>
 <div class="clear_space1"></div>
              
              
              
               
                <div class="clear"></div>
                 <div class="clear_space1"></div>
                
            </div>
    </div>
    
    <div class="clear"></div>
</div><div class="clear"></div>
</div>





<style type="text/css">
.tab-box-12 { 
  border-bottom: 1px solid #DDD;
  padding-bottom:5px;
  
}
.tab-box {
	background-color: #08427E;
	height: 28px;
	padding-top: 14px;
	padding-bottom: 0px;
  font-size:18px;
}
.tab-box a {/*
  border:1px solid #DDD;*/
  color:#bad6f4;
  padding: 8px 20px;
  text-decoration:none;
  background-color: #6998ca;
  margin-left:10px;
  border-radius:5px 5px 0px 0px;
  font-size:15px;
}
.tab-box a.activeLink { 
  background-color: #fff; 
  border-bottom: 0; 
  padding: 8px 20px;
  color:#014e81;
  font-size:15px;
  border-radius: 7px 7px 0px 0px;
  -moz-left-radius: 7px 7px 0px 0px;
  -webkit-left-radius: 7px 7px 0px 0px;
  -o-border-radius: 7px 7px 0px 0px;
}
.tabcontent {border: 0; padding: 5px; float: left;width: 100%;}
.hide { display: none;}

.small { color: #999; margin-top: 100px; border: 1px solid #EEE; padding: 5px; font-size: 9px; font-family:Verdana, Arial, Helvetica, sans-serif; }
</style>


 <script src="<?php echo base_url(); ?>assets/js/js-image-slider.js" type="text/javascript"></script>
 

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery_tab.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".tabLink").each(function(){
      $(this).click(function(){
        tabeId = $(this).attr('id');
        $(".tabLink").removeClass("activeLink");
        $(this).addClass("activeLink");
        $(".tabcontent").addClass("hide");
        $("#"+tabeId+"-1").removeClass("hide")   
        return false;	  
      });
    });  
  });
</script>
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js"></script>

     

</div>
<?php $this->load->view('header_footer/footer'); ?>
</body>
     <!--###########AUTO COMPLETE#############-->            
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/autocomplete/hotels_city_autocomplete.js"></script>
    <!--###########AUTO COMPLETE#############-->
    <!--###########DATE PICKER#############-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    
    
     <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/slider/jquery.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/slider/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/slider/jquery.easing.1.3.js'></script> 
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/slider/camera.min.js'></script> 
    
    <script>
		jQuery(function(){
			
			jQuery('#camera_wrap_4').camera({
				height: 'auto',
				loader: 'bar',
				pagination: false,
				thumbnails: true,
				hover: false,
				opacityOnGrid: false,
				imagePath: '../images/'
			});

		});
	</script>
    
    
    
   
    <!--###########DATE PICKER#############--->
    <script type="text/javascript">
        var baseUrl = "<?php echo base_url() ?>";
        var siteUrl = "<?php echo site_url() ?>";
    </script>
    <!-- Home Slider Javascript END-->
  
    
    <script type="text/javascript">
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
        
        function getAdultChilds(count)
        {
           $.ajax({
                    url:"<?php echo site_url(); ?>/home/getAdultChilds/",
                    data:"count="+count,
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
        }
        
         $( "#user_country" ).change(function() {
            var country=$('#user_country').val();
            $.ajax({

                url:"<?php echo site_url(); ?>/hotelbeds/getExpediaStateListOnCountry/",
                data:"country="+country,
                type: "GET",
                dataType: "json",
                beforeSend:function(){
                      $("#loading").html("");
                },
                success: function(data){
                      $("#user_state_div").html(data.total_result);
                },
                error:function(request, status, error){

                }
           });
        });
        
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
<script>
	var api_url='<?php echo site_url(); ?>';
	$.ajax({
			  type: 'POST',
			  url: api_url+'/api/call_api/Hotelspro/<?php echo $id; ?>',
			  data: '',
			  async: true,
			  dataType: 'json',
			  beforeSend:function(){
				 
			 },
			success: function(data){
				
				
				if(data.hotel_search_result == false || data.hotel_search_result == null)
				{
				 $('#noresult').fadeIn();
				}
				
			
				$('#result').html(data.room_result);
			
			
			
			
		  },

		  
		 	error:function(request, status, error){
		
			
		  }
		  
			});
			</script>
  
 

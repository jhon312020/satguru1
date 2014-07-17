<?php $this->load->view('header_footer/header'); ?>
<script type="text/javascript" src="<?php print base_url();  ?>assets/autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print base_url();  ?>assets/autofill/css/autosuggest_inquisitor1.css" type="text/css" media="screen" charset="utf-8" />
<div class="banner blueberry">
	<div id="content doc">
		<ul class="slides">
		<li><img class="thumb" src="<?php echo base_url(); ?>assets/new_css/images/banner.jpg" /></li>
		<li><img class="thumb" src="<?php echo base_url(); ?>assets/new_css/images/banner.jpg" /></li>
		<li><img class="thumb" src="<?php echo base_url(); ?>assets/new_css/images/banner.jpg" /></li>
		<li><img class="thumb" src="<?php echo base_url(); ?>assets/new_css/images/banner.jpg" /></li>
		</ul>
		<div class="after-menu">
			<ul class="search-menu">
				<li class="active"><h4><a href="<?php echo site_url(); ?>/home/hotels">HOTELS</a></h4></li>
				<li class="nor"><h4><a href="<?php echo site_url(); ?>/">FLIGHTS</a></h4></li>
				<li class="nor"><h4><a href="#">CARS</a></h4></li>
				<li class="nor"><h4><a href="#">TOUR&nbsp;PACKAGES</a></h4></li>
			</ul>
		</div>
	</div>
</div>
         </div>
		
        <div class="maincontent">
                <form name="hotel_search" method="POST" action="<?php echo site_url(); ?>/hotel/search" onSubmit="return validate_form()">
				<div class="search-panel">
				<div class="search-spc">
					<span class="where">
						<h5>Where</h5><br />
						<h6>YOUR DESTINATION</h6>
						<input type="text" name="cityval" id="cityName1" placeholder="&nbsp;&nbsp;ENTER A DESTINATION OR A HOTEL NAME"  />
						<br  /><span id="dorigin_error" style="color:#F00;"></span>
								<script type="text/javascript">
								var options = {
								script:"<?php echo base_url(); ?>test_hotel.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('cityName1').value = obj.id; } };
								var as_json = new AutoSuggest('cityName1', options);
								</script>
					</span>
					<span class="when">
						<h5>When</h5><br />
						<h6>CHECK IN</h6>
						<input class="but-eve" name="sd" type="text" id="datepicker" style="width:120px;"/>
					</span>
					<span class="check">
						<h5>&nbsp;</h5><br />
						<h6>CHECK OUT</h6>
                            <input class="but-eve" name="ed" type="text" id="datepicker1" style="background:none;width:85px;"/>
						<!-- <input class="but-eve" type="text"  value="&nbsp;&nbsp;MM/DD/YY" /> -->
					</span>
					<span class="check">
						<h5>&nbsp;</h5><br />
						<h6>NIGHTS</h6>
						<div class="customselect">
						<select class="but-Arr" name="nights" onChange="changeDate();" id="select_nights">
							<option value="1" selected="">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
						</select>
						</div>

					</span>
					<span style="float:right; background:#ffffff; padding-bottom:20px;">
						<span class="who">
							<h5>Who</h5><br />
							<h6>ROOMS</h6>
							<div class="customselect">
							<select class="but-Arr" name="room_count" id="room_count">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</select>
							</div>
							<!-- <input class="but-Arr" type="text" value="&nbsp;&nbsp;01" /> -->
						</span>
						<span id="adultchild">
							<span class="adults">
								<h5>&nbsp;</h5><br />
								<h6>ADULTS</h6>
								<div class="customselect">
								<select class="but-Arr" name="adult[]" id="adult_count0">
									<option value="1">1</option>
									<option value="2" selected>2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
								</div>
							<!--	<input class="but-Arr" type="text" value="&nbsp;&nbsp;02" /> -->
							</span>
							<span class="kids">
								<h5>&nbsp;</h5><br />
								<h6>KIDS</h6>
								<div class="customselect">
								<select class="but-Arr" name="child[]" id="child_count0">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
								</select>
								</div>
								<!-- <input class="but-Arr" type="text" value="&nbsp;&nbsp;01" /> -->
							</span>
							<span class="kids" id="child_age0"></span>
						</span>
					</span>
					<div class="clear"></div>
					</div>
				</div>
				<div class="seach_area_button">
					<div class="search-but">
						<button type="submit"><img class="mybut" src="<?php echo base_url(); ?>assets/new_css/images/search-bt.jpg" /></button>
						
					</div>
				</div>
			</form>
        </div>
<div class="bg">		
		<div class="category-content">
			<div class="cat-mid">
			<div class="row1">
				<span class="deals">
					<h5>Recommended Hotels</h5>
				</span>
				<div class="deal-img">
					<div id="tS2" class="jThumbnailScroller">
	<div class="jTscrollerContainer">
		<div class="jTscroller">
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h3.jpg" /><br /><p>Rosevelt</p></a>
			
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h2.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h3.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h4.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h2.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h3.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h4.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h2.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h3.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h4.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			
		</div>
	</div>
	<a href="#" class="jTscrollerPrevButton"></a>
	<a href="#" class="jTscrollerNextButton"></a>
</div>

				</div>
			</div>
					<div class="row2">
						<div class="r2-col-lft">
						<h5 style="color:#334050; font-weight:bold; padding-top:10px;">HOT HOTEL DEALS</h5><br />
						<section class="tabs">
	            <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
		        <label for="tab-1" class="tab-label-1">POPULAR</label>
		
	            <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
		        <label for="tab-2" class="tab-label-2">LASVEGAS</label>
		
	            <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
		        <label for="tab-3" class="tab-label-3">MIAMI</label>
			
	            <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4" />
		        <label for="tab-4" class="tab-label-4">SANFRANCISCO</label>
				<input id="tab-5" type="radio" name="radio-set" class="tab-selector-5" />
		        <label for="tab-5" class="tab-label-5">HONGKONG</label>
            
			    <div class="clear-shadow"></div>
				
		        <div class="content">
			        <div class="content-1">
						<h2>About us</h2>
                        <p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man.</p>
				    </div>
			        <div class="content-2">
						<h2>Services</h2>
                        <p>Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb.</p>
				    </div>
			        <div class="content-3">
						<h2>Portfolio</h2>
                        <p>The path of the righteous man is beset on all sides by the iniquities of the selfish and the tyranny of evil men. Blessed is he who, in the name of charity and good will, shepherds the weak through the valley of darkness, for he is truly his brother's keeper and the finder of lost children. And I will strike down upon thee with great vengeance and furious anger those who would attempt to poison and destroy My brothers. And you will know My name is the Lord when I lay My vengeance upon thee.</p>
				    </div>
				    <div class="content-4">
						<h2>Contact</h2>
                        <p>You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.</p>
				    </div>
					 <div class="content-5">
						<h2>Contact</h2>
                        <p>You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if	 we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.</p>
				    </div>
		        </div>
			</section>
						</div>
						<div class="r2-col-rgt">
							<h5 style="color:#334050; padding-left:15px; font-weight:bold; padding-top:10px;">What Travelers Says?</h5><br />
								<div class="testimonial">
									<h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when ...</h4>
									<h5><img src="<?php echo base_url(); ?>assets/new_css/images/guest.jpg" /> </h5><p style="padding-top:30px; padding-left:10px; color:#393d56; float:left; ">JESSICABROWN<br /><font color="#cccccc">GUEST</font></p>
								</div>
                           
						</div>
					</div>
					<div class="row3">
					<span class="deals">
					<h5 >Travellers Choice Of Hotel</h5>
				</span>
				<div class="deal-img-3">
					<div id="tS3" class="jThumbnailScroller">
	<div class="jTscrollerContainer">
		<div class="jTscroller">
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h3.jpg" /><br /><p>Rosevelt</p></a>
			
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h2.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h3.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h4.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h2.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h3.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h4.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h2.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h3.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h4.jpg" /></a>
			<a href="#"><img src="<?php echo base_url(); ?>assets/new_css/images/h1.jpg" /></a>
			
		</div>
	</div>
	<a href="#" class="jTscrollerPrevButton"></a>
	<a href="#" class="jTscrollerNextButton"></a>
</div>
				</div>
					
					</div>
				</div>
				</div>
				</div>
				
				
				
				<div class="footer">
					<div class="foot-width">
						<div class="col-lft">
							<div class="board">
								<h3>Bulletin Board</h3>
							</div>
							<p>If you encounter a flight change or cancellation, please contact the appropriate airline. Flights for you to make sure you, call the airline to confirm return again, you can call us to confirm your departure flight in three days prior to departure.</p><br />
							<p>Airline contact numbers (domestic) <br />
							Air: 95583; CEA: 95530; <br />
							Southern: 95539; HNA: 950718; <br />
							Xiamen Airlines: 95557;</p>
						 </div>
						<div class="col-cen">
							<div class="board">
							<h3>Links</h3>
							</div>
							<p class="link-list">
							> Lianhe Zaobao<br />
							> 12306 China Railway Customer Service<br />
							> Weather Forecast<br />
							> Singapore Immigration<br />
							> Singapore Ministry of Manpower
							</p>
						<span class="social-media">
							<ul class="media-icon">
								<li><img src="<?php echo base_url(); ?>assets/new_css/images/fbicon.jpg" /></li>
								<li><img src="<?php echo base_url(); ?>assets/new_css/images/twico.jpg" /></li>
								<li><img src="<?php echo base_url(); ?>assets/new_css/images/googleico.jpg" /></li>
								<li><img src="<?php echo base_url(); ?>assets/new_css/images/inico.jpg" /></li>
							</ul>
						</span>
						</div>
						<div class="col-rgt">
							<div class="board">
							<h3>Consultation</h3>
							</div>
							<p>Email Address: satgurutravel@gmail.com</p>
							<span class="feedback">
							<h2>FEEDBACk</h2>
							<input class="plus" type="text" value="&nbsp;&nbsp;Email Address" />
							</span>
							<img src="<?php echo base_url(); ?>assets/new_css/images/logo-slide.jpg" style="margin-top:15px; " />
							
						</div>
					</div>
				</div>
<div class="foot-rigths">
	<P style=" ">Copyright@satguru Travel & Tours. All Right Reserved</P>
	<p style=" padding-left:65px; color:#3f9cd5; font-weight:bold;">Terms&Conditions | Disclaimer | Privacy Policy</p>
	<p style=" padding-left:45px;">Designed and Developed By : DSS</p>
</div>

				
				
				
			
    </div>
</body>
</html>

<!------------------script-------------->

<!------------------script-------------->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_css/theme/blueberry.css" />
<script src="<?php echo base_url(); ?>assets/new_css/js/banner-slider.js"></script>
<script src="<?php echo base_url(); ?>assets/new_css/theme/jquery.blueberry.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.ui.min.css" type="text/css" />
<script src="<?php echo base_url(); ?>assets/js/jquery.ui.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui1.css" />

<script>
$(window).load(function() {
	$('.blueberry').blueberry();
});
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
			firstDay: 1,
			showOn:'off'
        }); 
    }); 
    
    $('#datepicker').change(function() {
		var n = parseInt($('#select_nights').val());
		var date2 = $('#datepicker').datepicker('getDate');
		date2.setDate(date2.getDate()+n);
		$('#datepicker1').datepicker('setDate', date2);
    });
	function changeDate() {
		var n = parseInt($('#select_nights').val());
		var date2 = $('#datepicker').datepicker('getDate');
		date2.setDate(date2.getDate()+n);
		$('#datepicker1').datepicker('setDate', date2);
	}
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
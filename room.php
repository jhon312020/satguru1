<?php 
	session_start();
	include("db.php");
	$hotelIds = $_GET['search'];
	$ses = $_SESSION['hotel_search']['session_id'];
	$cinval = explode("/",$_SESSION['hotel_search']['cin']);
	$cin  = $cinval[2].'-'.$cinval[0].'-'.$cinval[1];
	$coutval = explode("/",$_SESSION['hotel_search']['cout']);
	$cout  = $coutval[2].'-'.$coutval[0].'-'.$coutval[1];
	$adult = $_SESSION['hotel_search']['adult'];
	$link = $base_url.'/index.php/hotel/bookingv/';
	$hotelRoomResult = mysql_query("SELECT * FROM  hotel_room_list WHERE HotelCode = '$hotelIds'and status = '1' GROUP BY RoomName");
	$hotelRoomRowCount = mysql_num_rows($hotelRoomResult);
	while ($hotelRoomRow = mysql_fetch_array($hotelRoomResult))
	{
		if(isset($hotelRoomRowCount) > 0)
		{
			$hotelRoomRow['id'] = $hotelRoomRow['RoomCode'];
		}
		$datetoday = date('Y-m-d');
		if($hotelRoomRow['AvgPrice'] == '') 
		{
			$hotelRoomPriceResult = mysql_query("SELECT * FROM  hotel_room_price WHERE HotelCode = '$hotelIds' and Roomcode='".$hotelRoomRow['RoomCode']."' and  rateto >= '".$datetoday."' and ratefrom <= '".$datetoday."'");
			$hotelRoomPricearray = mysql_fetch_array($hotelRoomPriceResult);
			$hotelRoomRow['AvgPrice'] = $hotelRoomPricearray['contractrate'] + $hotelRoomPricearray['roompricemarkup'];
		}
		else
		{
			$hotelRoomRow['AvgPrice']=	$hotelRoomRow['AvgPrice'];
		}
			$arr = '<div class="hotel_details_room_type_part">
						<div class="hotel_details_room_type_part1">
							<span class="text11">'.$hotelRoomRow['RoomName'].' </span><br />
						</div>
					</div>
					<div class="hotel_details_room_rate_part"><span class="text3">'. $hotelRoomRow['AvgPrice'].' '.$hotelRoomRow['Currency'].'</span></div>
					&nbsp;<div class="hotel_details_room_status_part">Available</div>
					&nbsp;<div class="hotel_details_room_max_part">
							<span class="text1">'.$hotelRoomRow['Inclusion'].'</span>
						</div>
					&nbsp;<div class="hotel_details_room_total_part1">'. $hotelRoomRow['AvgPrice'].' '.$hotelRoomRow['Currency'].'</div>
					<div class="hotel_details_room_book_button" align="center">
						<span class="font_size12"><a href="'.$link.$hotelRoomRow['id'].'" class="booking_button">Book</a></span>
					</div>
					<div class="clear"></div>
					<br></br></br>
					 ';
		echo $arr;
	}
?>

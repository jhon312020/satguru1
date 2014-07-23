<?php 
	session_start();
	error_reporting(0);
	include("db.php");
	$ids = $_GET['search'];
	$ses = $_SESSION['hotel_search']['session_id'];
	/*$cinval = explode("/",$_SESSION['hotel_search']['cin']);
	$cin = $cinval[2].'-'.$cinval[0].'-'.$cinval[1];
	$coutval = explode("/",$_SESSION['hotel_search']['cout']);
	$cout  = $coutval[2].'-'.$coutval[0].'-'.$coutval[1];*/
	$facilities = array();
	$facilityResult = mysql_query("SELECT * FROM  hotel_facilities WHERE HotelCode = '$ids'");
	echo '<div class="row-fluid top20">
	<div class="span12">
		<div class="detail-tim" style=" font-size:13px"><strong>Hotel Facilities</strong></div>
	</div>
</div>';
	echo '<div class="row-fluid">
	<div class="span12">
		<div class="span12">
			<div class=""><br/>';
	while ($facilityRow = mysql_fetch_assoc($facilityResult))
	{
		//echo '<div class="facility_part">'.$facilityRow['Facility'].'</div>';
		$facilities[] = '&bull; '.ucfirst($facilityRow['Facility']).'<br/>';
	}
	$searchListResult = mysql_query("SELECT * FROM  hotel_search_list WHERE HotelCode = '$ids'");
	$searchListRows = mysql_num_rows($searchListResult);
	if ($searchListRows > 0)
	{
		$searchListRow = mysql_fetch_array($searchListResult);
		if ($searchListRow['internetfacility'])
		{
			$facilities[] = '&bull; '.ucfirst($searchListRow['internetfacility']).'<br/>';
		}
		if ($searchListRow['carparking'])
		{
			$facilities[] = '&bull; '.ucfirst($searchListRow['carparking']).'<br/>';
		}
		if ($searchListRow['sports'])
		{
			$facilities[] = '&bull; '.ucfirst(str_replace('#','<br/> &bull; ',trim($searchListRow['sports'], '#'))).'<br/>';
		}
	}
	if ($facilities)
	{
		echo implode('', $facilities);
	}
	else
	{
		echo 'Sorry There is No Amenities';
	}
echo'</div></div></div></div>';
	$hotelRoomListResource = mysql_query("SELECT * FROM hotel_room_list WHERE HotelCode='$ids' GROUP BY RoomName");
	echo '<div class="row-fluid top20">
	<div class="span12">
		<div class="detail-tim" style=" font-size:13px"><strong>Room Facilities</strong></div>
	</div>
</div>';
	while ($code = mysql_fetch_array($hotelRoomListResource))
	{
		$room = $code['RoomCode'];
		$RoomName = $code['RoomName'];
		echo '<div class="row-fluid">
	<div class="span12">
		<div class="span12">
			<div class=""><br/>';
		$hotelAmentiies = "SELECT * FROM  hotel_aminities WHERE HotelCode='$ids' AND  RoomCode ='$room'";
		$hotelAmentiiesResource = mysql_query($hotelAmentiies);
		if (mysql_num_rows($hotelAmentiiesResource) > 0)
		{
			while ($ami = mysql_fetch_array($hotelAmentiiesResource))
			{
				echo '&bull; '.ucfirst($ami['RoomAmenities']).'<br/>';
			}
		}
		else 
		{
			echo 'Sorry There is No Amenities';
		}
	}
	echo'</div></div></div></div>';
	mysql_close($con);
?>

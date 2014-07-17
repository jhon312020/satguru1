<?php 
	session_start();
	error_reporting(0);
	include("db.php");
	$ids = $_GET['search'];
	$ses = $_SESSION['hotel_search']['session_id'];
	$cinval = explode("/",$_SESSION['hotel_search']['cin']);
	$cin = $cinval[2].'-'.$cinval[0].'-'.$cinval[1];
	$coutval = explode("/",$_SESSION['hotel_search']['cout']);
	$cout  = $coutval[2].'-'.$coutval[0].'-'.$coutval[1];
	$hotelRoomListResource = mysql_query("SELECT * FROM hotel_room_list WHERE HotelCode='$ids' GROUP BY RoomName");
	echo '<table><tr>';
	while ($code = mysql_fetch_array($hotelRoomListResource))
	{
		$room = $code['RoomCode'];
		$RoomName = $code['RoomName'];
		echo '<th align="center" style="color:green;">'.$RoomName.'</th></tr>';
		$hotelAmentiies = "SELECT * FROM  hotel_aminities WHERE HotelCode='$ids' AND  RoomCode ='$room'";
		$hotelAmentiiesResource = mysql_query($hotelAmentiies);
		if (mysql_num_rows($hotelAmentiiesResource) > 0)
		{
			while ($ami = mysql_fetch_array($hotelAmentiiesResource))
			{
				$amin = $ami['RoomAmenities'];
				echo '<tr><td align="center" style="background-color: #EEEEEE;
				border-radius: 7px;
				float: left;
				margin: 4px;
				padding: 5px;
				width: 210px;font-size: 13px;">'.$amin.'</td></tr>';
			}
		}
		else 
		{
			echo '<tr><td align="center" style="background-color: #EEEEEE; margin: 4px;
			padding: 5px;
			width: 210px;font-size: 13px;border-radius: 7px;"> Sorry There is No Amenities</tr></td>';}
		}
		echo'</table>';
		mysql_close($con);
?>

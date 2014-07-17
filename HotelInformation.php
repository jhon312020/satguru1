<?php 
	session_start();
	//error_reporting(0);
	include("db.php");
	$hotelIds = $_GET['search'];
	$facilityResult = mysql_query("SELECT * FROM  hotel_facilities WHERE HotelCode = '$hotelIds'");
	while ($facilityRow = mysql_fetch_assoc($facilityResult))
	{
		echo '<div class="facility_part">'.$facilityRow['Facility'].'</div>';
	}
	$searchListResult = mysql_query("SELECT * FROM  hotel_search_list WHERE HotelCode = '$hotelIds'");
	$searchListRows = mysql_num_rows($searchListResult);
	if ($searchListRows > 0)
	{
		$searchListRow = mysql_fetch_array($searchListResult);
		echo '<h3>Internet Facility</h3><div class="facility_part">'.$searchListRow['internetfacility'].'</div>';
		echo '<h3>Car Parking</h3><div class="facility_part">'.$searchListRow['carparking'].'</div>';
		echo '<h3>Sports</h3><div class="facility_part">'.str_replace('#','<br>',$searchListRow['sports']).'</div>';
	}
	mysql_close($con);
?>

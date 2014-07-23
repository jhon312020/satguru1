<script type="text/javascript" src="http://localhost/satguru1/assets/js/slimbox2.js"></script>
<link rel="stylesheet" href="http://localhost/satguru1/assets/css/slimbox2.css" type="text/css" media="screen">

<?php 
	session_start();
	error_reporting(0);
	include("db.php");
	$hotelIds = $_GET['search'];
	$ses = $_SESSION['hotel_search']['session_id'];
	$cinval = explode("/",$_SESSION['hotel_search']['cin']);
	$cin  = $cinval[2].'-'.$cinval[0].'-'.$cinval[1];
	$coutval = explode("/",$_SESSION['hotel_search']['cout']);
	$cout  = $coutval[2].'-'.$coutval[0].'-'.$coutval[1];
	$hotelImageQuery = "SELECT * FROM  hotel_images WHERE HotelCode = '$hotelIds'";
	$hotelImageResult = mysql_query($hotelImageQuery);
	while ($hoteImageRow = mysql_fetch_assoc($hotelImageResult))
	{
		echo '<a href="'.$hoteImageRow['imagename'].'" rel="lightbox"   title="DSS DEMO" target="_blank" ><img src="'.$hoteImageRow['imagename'].'"  width="128" height="100" style="margin-right:10px;" /></a> ';
	}
	mysql_close($con);
?>

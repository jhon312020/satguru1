<?php 
	session_start();
	include("db.php");
	$q = $_GET['q'];
	$queryroom=mysql_query("SELECT * FROM  hotel_price WHERE HotelCode='".$q."'");
	$row=mysql_fetch_array($queryroom);
	$numrows=mysql_num_rows($queryroom);
	if($numrows>0)
	{
		$extrabedadultprice=$row['extrabedadultprice'];
		$extrabedadultmarkup=$row['extrabedadultmarkup'];
		$totalmarkup=$extrabedadultprice+$extrabedadultmarkup;
		echo $totalmarkup;
	}
?>

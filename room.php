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
	$flag = 0;
	$pr_c = 0;
	$arr = '';
	echo '<table cellspacing="0" cellpadding="2" border="0" id="" class="" style="border-collapse:collapse; width:100%;">';
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
		if ($flag == 0) {
			$arr = '<tr align="center" class="row_date2">
							<td class="rm_promotion rm_promotion_header">Room Type</td><td class="rm_book">Book</td>';
								for($rc=1; $rc<=$_SESSION['room_count']; $rc++) {
									$show_b_date = date_create($_SESSION['sd']);
									for($i=1; $i<=$_SESSION['days']; $i++) {
										$arr.= '<td class="date dateprev">'.date_format($show_b_date, 'D').'<br>'.date_format($show_b_date, 'd').'<br>'.date_format($show_b_date, 'M').'</td>';
										$show_b_date = date_add($show_b_date, date_interval_create_from_date_string('1 day'));
									}
								}
				$arr.='</tr>
						<tr align="center" style="height:26px" class="row_date2">
							<td class="rm_promotion rm_promotion_header">&nbsp;</td><td class="rm_book">&nbsp;</td>';
							for($rmc_i=1; $rmc_i<=$_SESSION['room_count']; $rmc_i++) {
								$arr.= '<td colspan="'.$_SESSION['days'].'" style="border-top:1px solid #FFFFFF;" class="date dateprev"> Room '.$rmc_i.' </td>';
							}
				$arr .= '</tr>';
				$flag = 1;
			}
				$arr .=	'<tr align="center" id="" class="table_rate">
							<td align="left" id="" class="rm_promotion"><br><b>'.$hotelRoomRow['RoomName'].'</b></td>
							<td id="" class="rm_book"><br><a href="'.$link.$hotelRoomRow['id'].'" class=""><span class="book_new_btn">Book</span></a></td>';
						for($rc=1; $rc<=$_SESSION['room_count']; $rc++) {
									$show_b_date = date_create($_SESSION['sd']);
									for($i_d=1; $i_d<=$_SESSION['days']; $i_d++) {
										$arr.= '<td class="rate_Instant"><br>
										<span id="" class="oldrate"><input type="hidden" value="" id="price1_org'.$pr_c.'"><span id="price1_'.$pr_c.'"></span></span>
										<input type="hidden"  id="price_org'.$pr_c.'" value="'.$hotelRoomRow['AvgPrice'].'" ><span id="price'.$pr_c.'">'.$hotelRoomRow['AvgPrice'].'</span></td>';
										$pr_c = $pr_c + 1;
									}
								}
				$arr .= '</tr>';
		
	}
	echo $arr;
	echo '</table>';
?>
<input type="hidden" value="2" id="count_price_id" name="count_price_id">

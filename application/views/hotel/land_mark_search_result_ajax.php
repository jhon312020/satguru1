<?php
	$room_count = $_SESSION['room_count'];
	$no_of_days = $_SESSION['days'];
	if (isset($land_marks) && $land_marks)
	{
		$i = 0;
		$_SESSION['coordinates'] = array();
		unset($_SESSION['center_coordinates']);
		foreach ($land_marks as $result) 
		{
			$data1['result']= $result;
			$data1['result_data'] = $result_data;
			$data1['i'] = $i;
			if (isset($result->Hotelspro_Hotelcode))
			{
				$this->load->view('/hotel/Hotelspro/land_mark_search_result_ajax', $data1);
			}
			else
			{
				$this->load->view('/hotel/OwnInventory/land_mark_search_result_ajax', $data1);
			}
			$i++;
		}
}
?>

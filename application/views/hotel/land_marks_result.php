<?php
	$type = '';
	if ($land_marks)
	{
		/*foreach ($land_marks as $land_mark)
		{
			if ($type != $land_mark->type)
			{
				$type = $land_mark->type;
				echo '<div style="font-weight:bold; color:#025590;margin:10px 0px 5px 0px">'.$type.'</div>';
			}
			if (isset($land_mark->distance))
			{
				$distance = round($land_mark->distance);
				if ($distance)
				{
					echo '<div style="margin:2px; cursor: pointer;" id = "mark_'.$land_mark->id.'" class="click_land_mark"> > '.$land_mark->name.' '.$distance.' Kms</div>';
				}
				else
				{
					echo '<div style="margin:2px; cursor: pointer; color:#f30000;" id = "mark_'.$land_mark->id.'" class="click_land_mark"> > '.$land_mark->name.' '.$distance.' Kms</div>';
				}
			}
			else
			{
				echo '<div style="margin:2px; cursor: pointer;" id = "mark_'.$land_mark->id.'" class="click_land_mark"> > '.$land_mark->name.'</div>';
			}
		}*/
		$land_mark_select = "<select style = 'width:215px;' class = 'click_land_mark'>";
		foreach ($land_marks as $land_mark)
		{
			if ($type != $land_mark->type)
			{
				if ($type)
				{
					$type .= '</optgroup>';
				}
				$type = $land_mark->type;
				$land_mark_select .= '<optgroup label="'.$type.'">';
			}
			if (isset($land_mark->distance))
			{
				$distance = round($land_mark->distance);
				if ($land_mark->id == $land_mark_id)
				{
					$land_mark_select .= '<option value="'.$land_mark->id.'" selected>'.$land_mark->name.' '.$distance.' Kms</option>';
				}
				else
				{
					$land_mark_select .= '<option value="'.$land_mark->id.'">'.$land_mark->name.' '.$distance.' Kms</option>';
				}
			}
			else
			{
				$land_mark_select .= '<option value="'.$land_mark->id.'">'.$land_mark->name.'</option>';
			}
		}
		$land_mark_select .= '</optgroup></select>';
		echo $land_mark_select;
	}
	else
	{
		echo '<h1>Sorry no landmarks are available!</h1>';
	}
?>

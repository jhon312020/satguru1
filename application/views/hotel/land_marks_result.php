<?php
	$type = '';
	foreach ($land_marks as $land_mark)
	{
		if ($type != $land_mark->type)
		{
			$type = $land_mark->type;
			echo '<div style="font-weight:bold; color:#025590;margin:10px 0px 5px 0px">'.$type.'</div>';
		}
		echo '<div style="margin:2px;"> > '.$land_mark->name.'</div>';
	}
?>

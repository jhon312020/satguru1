<?php
$promotion_v1 = explode("||||",$promotion);
for($i=0;$i<count($promotion_v1);$i++)
{
	$promotion_v2 = explode("^^^^",$promotion_v1[$i]);

	?>

<table width="100%" cellpadding="0" cellspacing="0" style="font-family:Arial,Helvetica,sans-serif;">
            <tbody><tr>
                <td>
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tbody><tr>
                            <td valign="top" align="left" style="" colspan="3">
                                <span id="" style="font-size:16px;font-weight:bold; color:#333333">
                                <strong>Room Promotions</strong><br></span>
                <span id="" style="font-size:14px;font-weight:bold; color:#333333">                 Room Type : <?php echo $room_type; ?></span>&nbsp;
                              
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="left" style="border-bottom: 2px solid #DDDDDD;" colspan="3">
                              &nbsp;
                              
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr style="background-color: White;">
                            <td align="left" width="20%" valign="top">
                           
                                <img src="<?php echo $Hotel_info->image; ?>" id="" width="130" height="130">
                               
                            </td>
                            <td style="" width="5%">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td align="left" valign="top" width="75%">
                                <div style="overflow-y:auto;">                                    
                                    <table width="100%" cellpadding="0" cellspacing="5">
                                    <tbody>
                                   
                                    
                                    <tr>
                                        <td style="color:#333333">
                                            <span id="" style="font-size:15px;font-weight:bold;"><strong><?php echo $promotion_v2[4]; ?></strong></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color:#333333">
                                            <span id="" style="display:inline-block;width:420px;font-size:13px;"><strong>Enjoy <?php echo $promotion_v2[7]; ?><?php echo $promotion_v2[6]; ?> OFF</strong></span>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td style="color:#333333">
                                            <span id="" style="display:inline-block;width:420px;font-size:13px;">Promo Only Applicable For <?php echo date("d-M-Y",strtotime($promotion_v2[2])); ?> To <?php echo date("d-M-Y",strtotime($promotion_v2[3])); ?> Period. <br />
  <br /> 
Promo Only Applicable For Before <?php echo $promotion_v2[5]; ?> Days Of Travel Date.
<?php
if(isset($promotion_v2[8]) && $promotion_v2[8]!='')
{
	$exp_date = explode(",",$promotion_v2[8]);
	
	?>

  <br /> 
Promo Not Applicable For Below Dates <br />
 <?php 
 for($k=0;$k<count($exp_date);$k++)
 {
	 if($exp_date[$k]!='')
	 {
 echo date("d-M-Y",strtotime($exp_date[$k])).'<br>'; 
	 }
 }
 ?>
<?php
}
?></span>
                                        </td>
                                    </tr> 
                                     <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                   
                                  
                                     <?php
									if(isset($room_info_m2->FeatureDescval) && $room_info_m2->FeatureDescval!='')
									{
										?>
                                    <tr>
                                        <td style="color:#333333">
                                            <span id="" style="font-size:15px;font-weight:bold;">Room Amenities</span>:
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color:#333333">
                                            <div style="vertical-align:top;font-size:13px;">
                                                <div>
                                                   <?php echo $room_info_m2->FeatureDescval; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
									}
									?>
                                </tbody></table>
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
        </tbody></table><?php

}
?>
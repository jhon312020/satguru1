<table width="100%" cellpadding="0" cellspacing="0" style="font-family:Arial,Helvetica,sans-serif;">
            <tbody><tr>
                <td>
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tbody><tr>
                            <td valign="top" align="left" style="" colspan="3">
                                <span id="" style="font-size:16px;font-weight:bold; color:#333333">
                                <strong><?php echo $room_info_m2->RoomNameval; ?></strong></span>&nbsp;
                              
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="left" style="border-bottom: 2px solid #DDDDDD;" colspan="3">&nbsp;
                              
                              
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr style="background-color: White;">
                            <td align="left" width="40%" valign="top">
                            <?php 
							if(isset($room_image_m2->ImageFileNameval))
							{
								
								?>
                                <img src="<?php echo $room_image_m2->ImageFileNameval; ?>" id="" width="180" height="180">
                                <?php
							}
							else
							{
								
							?>
                           
                                <img src="<?php echo $Hotel_info->hotel_images; ?>" id="" width="180" height="180">
                                <?php	
							}
							?>
                            </td>
                            <td style="" width="5%">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td align="left" valign="top" width="55%">
                                <div style="overflow-y:auto;">                                    
                                    <table width="100%" cellpadding="0" cellspacing="5">
                                    <tbody>
                                    <?php
									if(isset($room_info_m2->RoomDescriptionval) && $room_info_m2->RoomDescriptionval!='')
									{
										?>
                                    
                                    <tr>
                                        <td style="color:#333333">
                                            <span id="" style="font-size:15px;font-weight:bold;"><strong>Room Descriptions:</strong></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color:#333333">
                                            <span id="" style="display:inline-block;width:420px;font-size:13px;"><?php echo $room_info_m2->RoomDescriptionval; ?></span>
                                        </td>
                                    </tr>  <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php
									}
									else
									{
									?>
                                      <tr>
                                        <td style="color:#333333">
                                            <span id="" style="font-size:15px;font-weight:bold;">Room Descriptions:</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color:#333333">
                                            <span id="" style="display:inline-block;width:420px;font-size:13px;">Not Available</span>
                                        </td>
                                    </tr>  <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php	
									}
									?>
                                  
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
									else
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
                                                   Not Available
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
        </tbody></table>
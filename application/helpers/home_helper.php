<?php 

    function showAdultChildBox($count)
    {
        $showAdultChild='';
        for($r=0;$r<$count;$r++)
        {
            $showAdultChild.='<div class="fleft top10">
                        <label style="color:#fff; font-weight:bold; font-size:11px;"  class="label">Adult(s)</label> <br />
                        <select name="adult[]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; padding:5px; height:30px;" class="search_input_box2" id="adult_count'.$r.'">';
                            for($a=1;$a<=4;$a++){
                                $showAdultChild.='<option value="'.$a.'">'.$a.'</option>';
                            }
                        $showAdultChild.='</select>
                    </div>
                    <div class="fleft left10 top10">
                        <label class="label" style="color:#fff; font-weight:bold; font-size:11px; ">Child(ren)</label> <br />
                        <select name="child[]" class="search_input_box2" style="-moz-appearance: none; -webkit-appearance: none;      text-indent: 0.01px;      padding:5px; height:30px; color:#2F382F; " id="child_count'.$r.'">
                            <option value="0">0</option>';
                            for($c=1;$c<=3;$c++){
                                $showAdultChild.='<option value="'.$c.'">'.$c.'</option>';
                            }
                        $showAdultChild.='</select>
                  </div>
                  <div id="child_age'.$r.'">
                      
                  </div>
                  <div class="clear"></div>';
            
            $showAdultChild.='<script type="text/javascript">
                                    $( "#child_count'.$r.'" ).change(function() {
                                        var childCount=$("#child_count'.$r.'").val();
                                        $.ajax({
                                            url:"'.site_url().'/home/showChildAgeBox/",
                                            data:"count="+childCount+"&rm="+'.$r.',
                                            type: "GET",
                                            dataType: "json",
                                            beforeSend:function(){
                                                  $("#loading").html("");
                                            },
                                            success: function(data){
                                                  $("#child_age'.$r.'").html(data.total_result);
                                            },
                                            error:function(request, status, error){

                                            }
                                       });
                                    });
                              </script>';
        }
        
        return $showAdultChild;
    }

    function showChildAgeBox($childCount,$rm)
    {
        $showChild='';
        if($childCount!='')
        {
            
            for($i=0; $i<$childCount; $i++)
            {
                $ch=$i+1;
                $showChild.='<div class="fleft left10 top10" style="color:#fff; font-weight:bold; font-size:11px; ">
                                    Child Age '.$ch.'<br>
                                    <select name="child_age'.$rm.'[]" style="-moz-appearance: none; -webkit-appearance: none;     text-indent: 0.01px;      padding:5px; height:30px;" class="search_input_box2">';
                                       for($ag=1;$ag<=10;$ag++)
                                       {
                                           $showChild.='<option value="'.$ag.'">'.$ag.'</option>';
                                       }
                                    $showChild.='</select>
                             </div>';
            }
        }
        return $showChild;
    }
    
    function showAdultChildBoxModify($count)
    {
        $showAdultChild='';
        for($r=0;$r<$count;$r++)
        {
            $showAdultChild.='<div class=" fleft" style="width:100%;">
                                <div class="padding_top_bottom5">
                                <div>
                                    <select name="adult[]" class="search_input_box5 margin_right10 fleft" id="adult_count'.$r.'">';
                                    for($a=1;$a<=4;$a++){
                                        $showAdultChild.='<option value="'.$a.'">adult: '.$a.'</option>';
                                    }
                  $showAdultChild.='</select>
                    <div style="float:left; width: 110px;">
                        <select name="child[]" class="search_input_box5" id="child_count'.$r.'">
                            <option value="0">child: 0</option>';
                            for($c=1;$c<=3;$c++){
                                $showAdultChild.='<option value="'.$c.'">child: '.$c.'</option>';
                            }
     $showAdultChild.='</select>
                        <div id="child_age'.$r.'">

                        </div>
                    </div>
                </div>
                </div>';
            
            $showAdultChild.='<script type="text/javascript">
                                    $( "#child_count'.$r.'" ).change(function() {
                                        var childCount=$("#child_count'.$r.'").val();
                                        $.ajax({
                                            url:"'.site_url().'/home/showChildAgeBoxModify/",
                                            data:"count="+childCount+"&rm="+'.$r.',
                                            type: "GET",
                                            dataType: "json",
                                            beforeSend:function(){
                                                  $("#loading").html("");
                                            },
                                            success: function(data){
                                                  $("#child_age'.$r.'").html(data.total_result);
                                            },
                                            error:function(request, status, error){

                                            }
                                       });
                                    });
                              </script>';
        }
        
        return $showAdultChild;
    }
    
    function showChildAgeBoxModify($childCount,$rm)
    {
        $showChild='';
        if($childCount!='')
        {
            for($i=0; $i<$childCount; $i++)
            {
                $ch=$i+1;
                $showChild.='<select name="child_age['.$rm.'][]" class="search_input_box5" style="margin-top:3px;">';
                                       for($ag=1;$ag<=10;$ag++)
                                       {
                                           $showChild.='<option value="'.$ag.'">age: '.$ag.'</option>';
                                       }
                                    $showChild.='</select>';
            }
        }
        return $showChild;
    }
?>
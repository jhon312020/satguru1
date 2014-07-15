<!doctype html>
<html>
<?php $this->load->view('links'); ?>
<!-- Validation -->
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/validation/jquery.validate.min.js"></script>
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/validation/additional-methods.min.js"></script>
<link rel="stylesheet" href="<?php echo WEB_DIR_ADMIN ?>css/plugins/datatable/TableTools.css">
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/bootbox/jquery.bootbox.js"></script>
<!-- dataTables -->
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/TableTools.min.js"></script>
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/ColReorderWithResize.js"></script>
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/ColVis.min.js"></script>
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/jquery.dataTables.columnFilter.js"></script>
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datatable/jquery.dataTables.grouping.js"></script>

<!-- date picker-->

<link rel="stylesheet" href="<?php echo WEB_DIR_ADMIN ?>css/plugins/datepicker/datepicker.css">
<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR_ADMIN;?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR_ADMIN;?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<script>

<script src="<?php echo WEB_DIR_ADMIN ?>js/plugins/addmore/jquery-1.3.2.min.js"></script>

<body>
<div id="modal-user" class="modal hide">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="user-infos"><?php echo $admin_det->first_name." ".$admin_det->last_name; ?></h3>
  </div>
  <div class="modal-body">
    <div class="row-fluid">
      <div class="span2"> <img src="img/demo/user-1.jpg" alt=""> </div>
      <div class="span10">
        <dl class="dl-horizontal" style="margin-top:0;">
          <dt>Full name:</dt>
          <dd><?php echo $admin_det->first_name." ".$admin_det->last_name; ?></dd>
          <dt>Email:</dt>
          <dd><?php echo $admin_det->email; ?></dd>
        </dl>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal">Close</button>
  </div>
</div>
<div id="navigation">
<div class="container-fluid">
<a href="#" id="brand"><img src="<?php echo WEB_DIR_ADMIN ?>img/newlogo.png"></a> <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
<ul class='main-nav'>
<li class='active'> <a href="<?php echo WEB_URL_ADMIN ?>admin/admin_dashboard"> <span>Home</span> </a> </li>
<?php $this->load->view('topmenu'); ?>
</div>
</div>
<div class="container-fluid" id="content">
  <?php $this->load->view('leftmenu'); ?>
  <div id="main">
    <div class="container-fluid">
      <div class="page-header">
        <div class="pull-left">
          <h1><?php echo $data['page_header'];?></h1>
        </div>
        <div class="pull-right">
          <ul class="minitiles">
            <li class='grey'> </li>
            <li class='lightgrey'> </li>
          </ul>
          <ul class="stats">
            <li class='lightred'> <i class="icon-calendar"></i>
              <div class="details"> <span class="big">February 22, 2013</span> <span>Wednesday, 13:56</span> </div>
            </li>
          </ul>
        </div>
      </div>
      
      <div class="box box-color box-bordered red">
        <div class="box-title">
          <h3> <i class="icon-table"></i> <?php echo $page_header1;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo WEB_URL_ADMIN ?>admin/addpaystay/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Add New</a></h3>
          <h4 align="right"></h4>
        </div>
        <script type="text/javascript"  language="javascript">
				function confirm_delete(id,roomcode,hotelid,orgcode)
				{
				  
					var r=confirm("Are you sure you want to delete?");
				if (r==true)
				  {
				  self.location="<?php echo WEB_URL_ADMIN ?>admin/delete_paystay/"+id+"/"+roomcode+"/"+hotelid+"/"+orgcode;
				  }
				else
				  {
				  
				  }
				}
				</script>
        <div class="box-content nopadding">
          <table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Ratefrom</th>
                <th>Rateto</th>
                <th>Stay</th>
                <th>Pay</th>
                <th>Breakfast</th>
                <th>Rate/Markup</th>
                
              </tr>
            </thead>
            <tbody>
              <?php $i =1; if(isset($paystay)) { if($paystay != '') { foreach($paystay as $list) { 
								
									if(	$list->breakrate!='' or $list->breakrate!='NULL'){
										
									$breakrate=$list->breakrate; 
									
									$markup= $list->breakmarkup;
									$breakfast=$breakrate."/".$markup;
									
									}
										
										?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $list->ratefrom; ?></td>
                <td><?php echo $list->rateto; ?></td>
                <td><?php echo $list->stay; ?></td>
                <td><?php echo $list->pay; ?></td>
                <td><?php echo $list->breakfast; ?></td>
                <td><?php echo $breakfast;?></td>
                <td><a href="<?php echo WEB_URL_ADMIN ?>admin/editpaystay/<?php echo $list->id; ?>/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Edit</td><td><a href="javascript:confirm_delete('<?php echo $list->id; ?>','<?php echo $list->RoomCode;?>','<?php echo $list->HotelCode;?>','<?php echo $this->uri->segment(3);?>')">Delete</td>
              </tr>
              <?php $i++;} } } ?>
            </tbody>
          </table>
        </div>
      </div>
      
      
 <!--Week End Stay Promotion  -->
 
 
 <div class="box box-color box-bordered red">
        <div class="box-title">
          <h3> <i class="icon-table"></i> <?php echo $page_header2;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo WEB_URL_ADMIN ?>admin/addweekend/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Add New</a></h3>
          <h4 align="right"></h4>
        </div>
        <script type="text/javascript"  language="javascript">
							  function confirm_delete1(id,roomcode,hotelid,orgcode)
							  {
								
								  var r=confirm("Are you sure you want to delete?");
							  if (r==true)
								{
								self.location="<?php echo WEB_URL_ADMIN ?>admin/delete_weekend/"+id+"/"+roomcode+"/"+hotelid+"/"+orgcode;
								}
							  else
								{
								
								}
							  }
							  </script>
        <div class="box-content nopadding">
          <table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Weekend From</th>
                <th>Weekend Till</th>
                <th>Rate</th>
               </tr>
            </thead>
            <tbody>
              <?php $i =1; if(isset($viewweekend)) { if($viewweekend != '') { foreach($viewweekend as $list1) { 
						  if($list1->weekdayfrom=='0')
							  $weekday='Sunday';
						  else if($list1->weekdayfrom=='1')
							  $weekday='Monday';
						  else if($list1->weekdayfrom=='2')
							  $weekday='Tuesday';
						  else if($list1->weekdayfrom=='3')
							  $weekday='Wednesday';
						  else if($list1->weekdayfrom=='4')
							  $weekday='Thursday';
						  else if($list1->weekdayfrom=='5')
							  $weekday='Friday';
						  else if($list1->weekdayfrom=='6')
							  $weekday='Saturday';
							
							
							
						 if($list1->weekdaytill=='0')
							  $weekdaytill='Sunday';
						  else if($list1->weekdaytill=='1')
							  $weekdaytill='Monday';
						  else if($list1->weekdaytill=='2')
							  $weekdaytill='Tuesday';
						  else if($list1->weekdaytill=='3')
							  $weekdaytill='Wednesday';
						  else if($list1->weekdaytill=='4')
							  $weekdaytill='Thursday';
						  else if($list1->weekdaytill=='5')
							  $weekdaytill='Friday';
						  else if($list1->weekdaytill=='6')
							  $weekdaytill='Saturday';	
									
					?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $weekday; ?></td>
                <td><?php echo $weekdaytill; ?></td>
                <td><?php echo $list1->weekendrate ; ?>%</td>
                <td><a href="<?php echo WEB_URL_ADMIN ?>admin/editweekendstay/<?php echo $list1->id; ?>/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Edit</td><td><a href="javascript:confirm_delete1('<?php echo $list1->id; ?>','<?php echo $list1->RoomCode;?>','<?php echo $list1->HotelCode;?>','<?php echo $this->uri->segment(3);?>')">Delete</td>
              </tr>
              <?php $i++;} } } ?>
            </tbody>
          </table>
        </div>
      </div>
      
      
      
      
      
       <!-- % Discount  -->
 
 
 <div class="box box-color box-bordered red">
        <div class="box-title">
          <h3> <i class="icon-table"></i> <?php echo $page_header3;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo WEB_URL_ADMIN ?>admin/adddiscountpromo/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Add New</a></h3>
          <h4 align="right"></h4>
        </div>
        <script type="text/javascript"  language="javascript">
							  function confirm_delete2(id,roomcode,hotelid,orgcode)
							  {
								
								  var r=confirm("Are you sure you want to delete?");
							  if (r==true)
								{
								self.location="<?php echo WEB_URL_ADMIN ?>admin/delete_roomdiscount/"+id+"/"+roomcode+"/"+hotelid+"/"+orgcode;
								}
							  else
								{
								
								}
							  }
							  </script>
        <div class="box-content nopadding">
          <table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Discount From</th>
                <th>Discount To</th>
                <th>Rate</th>
               </tr>
            </thead>
            <tbody>
              <?php $i =1; if(isset($viewpricediscount)) { if($viewpricediscount != '') { foreach($viewpricediscount as $list2) { 
						 
									
					?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $list2->discountfrom ; ?></td>
                <td><?php echo $list2->discountto; ?></td>
                <td><?php echo $list2->discountrate; ?> %</td>
                <td><a href="<?php echo WEB_URL_ADMIN ?>admin/editdiscount/<?php echo $list2->id; ?>/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Edit</td><td><a href="javascript:confirm_delete2('<?php echo $list2->id; ?>','<?php echo $list2->RoomCode;?>','<?php echo $list2->HotelCode;?>','<?php echo $this->uri->segment(3);?>')">Delete</td>
              </tr>
              <?php $i++;} } } ?>
            </tbody>
          </table>
        </div>
      </div>
      
      
      
       <!-- Room Price Discount  -->
 
 
 <div class="box box-color box-bordered red">
        <div class="box-title">
          <h3> <i class="icon-table"></i> <?php echo $page_header4;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo WEB_URL_ADMIN ?>admin/adddiscountpr/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Add New</a></h3>
          <h4 align="right"></h4>
        </div>
        <script type="text/javascript"  language="javascript">
							  function confirm_delete3(id,roomcode,hotelid,orgcode)
							  {
								
								  var r=confirm("Are you sure you want to delete?");
							  if (r==true)
								{
								self.location="<?php echo WEB_URL_ADMIN ?>admin/delete_roompricedis/"+id+"/"+roomcode+"/"+hotelid+"/"+orgcode;
								}
							  else
								{
								
								}
							  }
							  </script>
        <div class="box-content nopadding">
          <table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
            <thead>
              <tr>
                <th>#ID</th>
                <th>From</th>
                <th>To</th>
                <th>Rate</th>
               </tr>
            </thead>
            <tbody>
              <?php $i =1; if(isset($viewroompricediscount)) { if($viewroompricediscount != '') { foreach($viewroompricediscount as $list3) { 
						 
									
					?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $list3->pricefrom ; ?></td>
                <td><?php echo $list3->priceto ; ?></td>
                <td><?php echo $list3->pricerate ; ?></td>
                <td><a href="<?php echo WEB_URL_ADMIN ?>admin/editdiscountprice/<?php echo $list3->id; ?>/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Edit</td><td><a href="javascript:confirm_delete3('<?php echo $list3->id; ?>','<?php echo $list3->RoomCode;?>','<?php echo $list3->HotelCode;?>','<?php echo $this->uri->segment(3);?>')">Delete</td>
              </tr>
              <?php $i++;} } } ?>
            </tbody>
          </table>
        </div>
      </div>
      
      
      
       <!-- Upgrades/Value Adds  -->
 
 
 <div class="box box-color box-bordered red">
        <div class="box-title">
          <h3> <i class="icon-table"></i> <?php echo $page_header5;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo WEB_URL_ADMIN ?>admin/addservice/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Add New</a></h3>
          <h4 align="right"></h4>
        </div>
        <script type="text/javascript"  language="javascript">
							  function confirm_delete4(id,roomcode,hotelid,orgcode)
							  {
								
								  var r=confirm("Are you sure you want to delete?");
							  if (r==true)
								{
								self.location="<?php echo WEB_URL_ADMIN ?>admin/delete_service/"+id+"/"+roomcode+"/"+hotelid+"/"+orgcode;
								}
							  else
								{
								
								}
							  }
							  </script>
        <div class="box-content nopadding">
          <table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
            <thead>
              <tr>
                <th>#ID</th>
                <th>From</th>
                <th>To</th>
                <th>Rate</th>
               </tr>
            </thead>
            <tbody>
              <?php $i =1; if(isset($viewserviceup)) { if($viewserviceup != '') { foreach($viewserviceup as $list4) { 
						 
									
					?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $list4->upgradefrom ; ?></td>
                <td><?php echo $list4->upgradeto ; ?></td>
                <td><?php echo $list4->promo ; ?></td>
                <td><a href="<?php echo WEB_URL_ADMIN ?>admin/editservice/<?php echo $list4->id; ?>/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Edit</td><td><a href="javascript:confirm_delete4('<?php echo $list4->id; ?>','<?php echo $list4->RoomCode;?>','<?php echo $list4->HotelCode;?>','<?php echo $this->uri->segment(3);?>')">Delete</td>
              </tr>
              <?php $i++;} } } ?>
            </tbody>
          </table>
        </div>
      </div>
      
      
      
    </div>
  </div>
</div>
</div>
</div>
</body>
</html>

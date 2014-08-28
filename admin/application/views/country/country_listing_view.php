<div class="container-fluid">
      <div class="page-header">
        <div class="pull-left">
          <h1>Manage Country Details</h1>
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
      
    </div>
    <script type="text/javascript"  language="javascript">
			  function confirm_update(id,del_status)
			  {
				  var st = (del_status==0)?'Active':'Inactive';
				  var r=confirm("Are you sure you want to change Status to "+st+"?");
			  if (r==true)
				{
				self.location="<?php echo WEB_URL_ADMIN ?>admin/change_hotelstatus/"+id+"/"+del_status;
				}
			  else
				{
				
				}
			  }
			  </script>
    <div class="box box-color box-bordered red">
      <div class="box-title">
        <h3> <i class="icon-table"></i> Manage Country Details </h3>
      </div>
      <div class="box-content nopadding">
        <table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
          <thead>
            <tr class='thefilter'>
              <th>#ID</th>
              <th>Country Name</th>
              <th class='hidden-350'>Phone Code</th>
            </tr>
            <tr>
              <th>#ID</th>
              <th>Country Name</th>
              <th class='hidden-350'>Phone Code</th>
              <th class=''></th>
            </tr>
          </thead>
          <tbody>
            <?php $i =1; if(isset($view_data)) { if($view_data != '') { foreach ($view_data as $key => $data): ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $data['name']; ?></td>
              <td class='hidden-350'><?php echo $data['phonecode']; ?></td>
              <td class=''><?php echo anchor('country/modify/'.$data['country_id'], 'Edit')
. ' / '
. anchor('country/remove/'.$data['country_id'], 'Delete'); ?></td>
            </tr>
            <?php $i++; endforeach;  } } ?>
          </tbody>
        </table>
      </div>
    </div>

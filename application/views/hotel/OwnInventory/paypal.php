<?php //$this->session->userdata('book_id');  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: DSS DEMO ::</title>
<link href="<?php echo  base_url();?>css/loadingpage.css" rel="stylesheet" type="text/css" />
<script src="<?php echo  base_url();?>Scripts/swfobject_modified.js" type="text/javascript"></script>
<script type="text/javascript">
function call()
{
document.frmname.submit();
}
var ray={
ajax:function(st)
	{
		this.show('load');
	},
show:function(el)
	{
		this.getID(el).style.display='';
	},
getID:function(el)
	{
	    document.getElementById("main_container").style.opacity=0.1;	
		return document.getElementById(el);
	}
}
</script>

</head>

<body onload="call()">
<link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo.png" />
<div id="load" style="display:none;"> </div>
<form name="frmname" action="https://www.sandbox.paypal.com/cgi-bin/webscr"  method="post">
<input type="hidden" name="rm" value="2"/>
<input type="hidden" name="cmd" value="_xclick"/>


  <input type="hidden" value="laxmi.provab@gmail.com" name="business" />

  <input type="hidden" value="<?php echo site_url(); ?>/home/payment" name="return" />
  
  <input type="hidden" value="<?php echo site_url(); ?>/home/index" name="cancel_return" />
  <input type="hidden" value="" name="notify_url" />
  <input type="hidden" value="DSS DEMO" name="item_name" />
                    
  <input type="hidden" value="<?php echo $amount?>" name="amount" />
  <input type="hidden" value="SGD" name="currency_code" />

<div class="loading_part">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
      <tr>
        <td width="616" height="84" align="center" valign="top"><div class="logo"><img src="<?php echo base_url() ?>assets/images/logo.png"/></div></td>
      </tr>
      <tr>
        <td height="30" align="center" valign="baseline" class="underline">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="baseline" class="text" style="color:#670001; ">Please do not refresh the screen or press backspace key , as we are currently connecting to payment gateway</td>
      </tr>
      <tr>
        <td align="center" valign="middle">
        <img src="<?php echo base_url() ?>assets/images/framely.gif" width="64" height="64" style="margin-top:15px;"/>
        </td>
        
      </tr>
      <tr><td>&nbsp;</td></tr>
      
      <tr>
        <td height="30" align="center" valign="baseline">&nbsp;</td>
      </tr>
    </table>
  </div>
</form>

</body>
</html>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	
	 public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Account_Model');
	  $this->load->model('Hotel_Model');
	    $this->load->model('Home_Model');
  $this->load->helper('home');
	  $this->domain = "DSS";
  $this->domain_id = "1";
	}
	function index()
	{
		/* $data['airports'] = '';
		 $data['imp_airports'] ='';
         $this->load->view('flight/flight_index', $data); */
		redirect('home/hotels/', 'refresh');
	}	
	function forget_password()
	{
	
        $this->load->view('account/forget_password');
		
	}
	function forget_password_process()
	{
			    $this->load->model('Email_Model');

		$email3 = $this->input->post('email');
		$domain = $this->domain_id;
			$Query="select * from  b2c  where email ='".$email3."' and  domain ='".$domain."'";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$result = $query->row();
				   
				
					 $message ='<table width="100%" border="0" cellspacing="5" cellpadding="5">
					 
					 <tr>
					 <td  align="left" valign="top">
					  This is to inform you that an login details of your account .<br><br>
					 </td>
					 <tr>
   			
			<td  align="left" valign="top">
			<strong><u>Login Details </u></strong><br><br>
			<strong>Login Url </strong> : '.site_url().'/login/member_login <br>
			<strong>Username </strong> : '.$result->email.' <br>
			<strong>Password </strong> : '.$result->password.' <br>
			</td>
		 	</tr>
			</table>'; 
				 $message_header='Forget Password';
				 $subject='DSS - Forget Password';
				$fnam = $result->firstname;
				 $this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
				 $data['x'] = 'Password has been sent to your Email-Id !.';
				    $this->load->view('account/forget_password',$data);
				 
		}
		else
		{
			 $data['x'] = 'Email-Id is wrong !.';
				    $this->load->view('account/forget_password',$data);
			
		}
			
	}
	function chat()
	{
		
		$server = "localhost";
		$db_user = "root";
		$db_pass = "";
		$database = "DSS";

		$db = mysql_connect($server, $db_user,$db_pass);
		mysql_select_db($database,$db);
		$timeoutseconds = 5; //5 minutes
		$timestamp = time();
		$timeout = $timestamp-$timeoutseconds;
		$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
		$PHP_SELF = $_SERVER['PHP_SELF'];
		echo "INSERT INTO useronline VALUES ('$timestamp','$REMOTE_ADDR','$PHP_SELF')";
		$insert = mysql_query("INSERT INTO useronline VALUES ('$timestamp','$REMOTE_ADDR','$PHP_SELF')",$db);
		if(!($insert)) {
		print "Useronline Insert Failed > ";
		}
		$delete = mysql_query("DELETE FROM useronline WHERE timestamp<$timeout",$db);
		if(!($delete)) {
		print "Useronline Delete Failed > ";
		}
		$result = mysql_query("SELECT DISTINCT ip FROM useronline WHERE file='$PHP_SELF'",$db);
		if(!($result)) {
		print "Useronline Select Error > ";
		}
		$user = mysql_num_rows($result);
		//mysql_close();
		if($user == 1) {
		print("$user user online\n");
		} else {
		print("$user users online\n");
		}
	}
	function email_test()
	{
	$this->load->view('email/email_test - voucher 2');
	}
	function email_test1()
	{
	$this->load->view('email/email_test - voucher');
	}
	
	function contact_detail()
	{
	  $this->load->view('hotel/contact_us');	
	}
	
	function sortHotel()
	{
		$data = $_SESSION['hotel_search_session_data'];
		
		if($_POST['filter'] == "name" && $_POST['type'] == "asc") 
		{
			usort($data, function($a, $b) {
				if ($a['hotel_name'] == $b['hotel_name']) return 0;
				return ($a['hotel_name'] > $b['hotel_name']) ? 1 : -1;
			});
		}
		if($_POST['filter'] == "name" && $_POST['type'] == "desc") 
		{
			usort($data, function($a, $b) {
				if ($a['hotel_name'] == $b['hotel_name']) return 0;
				return ($a['hotel_name'] < $b['hotel_name']) ? 1 : -1;
			});
		}
		if($_POST['filter'] == "rating" && $_POST['type'] == "desc") 
		{
			usort($data, function($a, $b) {
				if ($a['review_rating'] == $b['review_rating']) return 0;
				return ($a['review_rating'] < $b['review_rating']) ? 1 : -1;
			});
		}
		if($_POST['filter'] == "rating" && $_POST['type'] == "asc") 
		{
			usort($data, function($a, $b) {
				if ($a['review_rating'] == $b['review_rating']) return 0;
				return ($a['review_rating'] > $b['review_rating']) ? 1 : -1;
			});
		}
		
		if($_POST['filter'] == "price" && $_POST['type'] == "desc") 
		{
			usort($data, function($a, $b) {
				if ($a['min_rate'] == $b['min_rate']) return 0;
				return ($a['min_rate'] < $b['min_rate']) ? 1 : -1;
			});
		}
		if($_POST['filter'] == "price" && $_POST['type'] == "asc") 
		{
			usort($data, function($a, $b) {
				if ($a['min_rate'] == $b['min_rate']) return 0;
				return ($a['min_rate'] > $b['min_rate']) ? 1 : -1;
			});
		}
		
		if($_POST['filter'] == "star" && $_POST['type'] == "desc") 
		{
			usort($data, function($a, $b) {
				if ($a['star_rating'] == $b['star_rating']) return 0;
				return ($a['star_rating'] < $b['star_rating']) ? 1 : -1;
			});
		}
		if($_POST['filter'] == "star" && $_POST['type'] == "asc") 
		{
			usort($data, function($a, $b) {
				if ($a['star_rating'] == $b['star_rating']) return 0;
				return ($a['star_rating'] > $b['star_rating']) ? 1 : -1;
			});
		}
		
		if(!empty($_SESSION['hotel_currency_code']))
		{
			$aConvertedCode = $this->Account_Model->getCurrencyRates($_SESSION['hotel_currency_code']);
		
		if(!empty($aConvertedCode[0]->value))
		{
			foreach($data as $key => $value)
			{
				$min_rate = $value['min_rate'] * $aConvertedCode[0]->value;
				$strike_rate = $value['org_min_rate'] * $aConvertedCode[0]->value;
				$data[$key]['min_rate'] = number_format($min_rate,2);
				$data[$key]['org_min_rate'] = number_format($strike_rate,2);
			}
		}
		}
		
		$_SESSION['hotel_search_session_data']  = $data;
		
		
		$aResponse['result'] = $data;
		$hotel_search_result = $this->load->view('hotel/search_result_ajax_search_page', $aResponse, true);		
		print json_encode(array(
			'hotel_search_result' => $hotel_search_result,
		));
	}	
	
	function currencyConvert()
	{
		$_SESSION['hotel_currency_code'] = $_POST['currency_code'];
		$aConvertedCode = $this->Account_Model->getCurrencyRates($_SESSION['hotel_currency_code']);
		$aData = $_SESSION['hotel_search_session_data'];
		
		if(!empty($aConvertedCode[0]->value))
		{
			foreach($aData as $key => $value)
			{
				$min_rate = $value['min_rate'] * $aConvertedCode[0]->value;
				$strike_rate = $value['org_min_rate'] * $aConvertedCode[0]->value;
				$aData[$key]['min_rate'] = number_format($min_rate,2);
				$aData[$key]['org_min_rate'] = number_format($strike_rate,2);
			}
		}
		$aResponse['result'] = $aData;
		$hotel_search_result = $this->load->view('hotel/search_result_ajax_search_page', $aResponse, true);	
		print json_encode(array(
			'hotel_search_result' => $hotel_search_result,
		));
	}
	
	function modify_search()
	{
		$this->load->view('hotel/modify_search');
	}
	
	function contact_us()
	{
		$this->load->view('contact_us');
	}
	  public function hotels() {
      
        $this->load->view('hotel/hotel_index');
    }
	  public function getAdultChilds() {
        $roomCount = $_GET['count'];
        $showAdultChild = showAdultChildBox($roomCount); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showAdultChild
        ));
    }

    public function showChildAgeBox() {
        $childCount = $_GET['count'];
        $rm = $_GET['rm'];
        $showChild = showChildAgeBox($childCount, $rm); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showChild
        ));
    }

    public function getAdultChildsModifySearch() {
        $roomCount = $_GET['count'];
        $showAdultChild = showAdultChildBoxModify($roomCount); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showAdultChild
        ));
    }

    public function showChildAgeBoxModify() {
        $childCount = $_GET['count'];
        $rm = $_GET['rm'];
        $showChild = showChildAgeBoxModify($childCount, $rm); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showChild
        ));
    }
	
	
	
	

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

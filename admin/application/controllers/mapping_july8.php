<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapping extends CI_Controller {

public function __construct(){
		parent::__construct();
		$this->load->model('Home_Model');
		$this->load->model('Admin_Model');
		$this->load->model('Mapping_Model');
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}	
	
	function mapping_asaintravel()
	{
		$this->load->view('mapping/asiantravel_mapping_citylist');
	}
	
	function mapping_city_asaintravel_to_permanent()
	{
				$str1 = $_POST['cityval'];
				
				$related_city=array();
				$related_cityx=array();
				
				$query = mysql_query("select * from api_permanent_city") or die("Query failed");
				
				while ($row = mysql_fetch_array($query)) {
				similar_text(strtolower($str1), strtolower($row['Global_Cityname']), $similarity_pst);
				if (number_format($similarity_pst, 0) > 50){
				
				$related_city['cityname'] =  $row['Global_Cityname'];
				$related_city['country_name'] =  $row['Global_Countryname'];
				$related_city['api_permanent_city_id'] =  $row['api_permanent_city_id'];
				$related_city['percentage'] = number_format($similarity_pst, 0);
			
				$related_cityx[] =$related_city;
				}
				} 
				$price = array();
				foreach ($related_cityx as $key => $row)
				{
				$price[$key] = array($row['percentage'],$row['cityname'],$row['country_name'],$row['api_permanent_city_id']);
				}
				array_multisort($price, SORT_DESC, $related_cityx);
				
				
				$data['related_city'] = $price;
				$data['keycity']=$_POST['cityval'];
				
				$query = mysql_query('SELECT Asiantravel,country_code FROM api_permanent_city_asiantravel WHERE city_name = "'.$data['keycity'].'"');
				$row = mysql_fetch_array($query);
			//	echo '<pre/>';
				//print_r($row);
				if($row['Asiantravel']!='')
				{
				$data['asian_citycode'] = $row['Asiantravel'];
				$data['asian_country_code'] = $row['country_code'];
				//echo '<pre/>';
				//print_r($data);exit;
				$this->load->view('mapping/asiantravel_city_to_permanent',$data);
				}
				else
				{
					$data['status'] = 'City code not updated properly in this city. Kindly do the mapping manually';
					$this->load->view('mapping/mapping_error',$data);
				}
				
		
	}
	
	function check_city_mapping_citywise_asiantravel($city_id,$asiantravel_citycode,$asiantravel_countrycode)
	{
		$query = mysql_query("SELECT * FROM api_permanent_city WHERE api_permanent_city_id = ".$city_id);		
		$row = mysql_fetch_array($query);
		$data['api_permanent_data'] = $row;
		$data['asiantravel_citycode'] = $asiantravel_citycode;
		$data['asiantravel_countrycode'] = $asiantravel_countrycode;
		$this->load->view('mapping/asiantravel_city_update_to_permanent',$data);		
	}
	
	function update_asiantravel_city_code($city_id,$asiantravel_citycode,$asiantravel_countrycode)
	{
		$query = mysql_query("UPDATE api_permanent_city SET Asiantravel_Citycode = '$asiantravel_citycode',Asiantravel_Countrycode = '$asiantravel_countrycode' WHERE  api_permanent_city_id = '$city_id'");
		redirect('mapping/check_city_mapping_citywise_asiantravel/'.$city_id.'/'.$asiantravel_citycode.'/'.$asiantravel_countrycode);
	}
	
	function mapping_hotel_asiantravel()
	{
		$this->load->view('mapping/asiantravel_mapping_hotelist');
	}	
	
	function mapping_hotel_asaintravel_to_permanent()
	{
				$str1 = $_POST['cityval'];
				
				$related_city=array();
				$related_cityx=array();
				
				$query = mysql_query("select * from api_permanent_city") or die("Query failed");
				
				while ($row = mysql_fetch_array($query)) {
				similar_text(strtolower($str1), strtolower($row['Global_Cityname']), $similarity_pst);
				if (number_format($similarity_pst, 0) > 50){
				
				$related_city['cityname'] =  $row['Global_Cityname'];
				$related_city['country_name'] =  $row['Global_Countryname'];
				$related_city['api_permanent_city_id'] =  $row['api_permanent_city_id'];
				$related_city['percentage'] = number_format($similarity_pst, 0);
			
				$related_cityx[] =$related_city;
				}
				} 
				$price = array();
				foreach ($related_cityx as $key => $row)
				{
				$price[$key] = array($row['percentage'],$row['cityname'],$row['country_name'],$row['api_permanent_city_id']);
				}
				array_multisort($price, SORT_DESC, $related_cityx);
				
				
				$data['related_city'] = $price;
				$data['keycity']=$_POST['cityval'];
				
				$query = mysql_query('SELECT Asiantravel,country_code FROM api_permanent_city_asiantravel WHERE city_name = "'.$data['keycity'].'"');
				$row = mysql_fetch_array($query);
				$data['asian_citycode'] = $row['Asiantravel'];
				$data['asian_country_code'] = $row['country_code'];
				//echo '<pre/>';
				$this->load->view('mapping/asiantravel_hotel_to_permanent',$data);
	}
	
	function check_hotel_mapping_citywise_asiantravel($city_id,$asiantravel_citycode,$asiantravel_countrycode)
	{
		$query = mysql_query("SELECT * FROM api_permanent_hotel_asiantravel WHERE city_code = '$asiantravel_citycode'");		
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		$data['hotel_list'] = $result;
		$this->load->view('mapping/asiantravel_hotel_list',$data);
	}
	
	function check_hotel_mapping_citywise($city,$country,$asian_city_code,$asian_hotel_code)
	{
		$city = trim(stripslashes(urldecode($city)));
		$country = trim(stripslashes(urldecode($country)));
		
		$query = mysql_query("SELECT * FROM api_permanent_hotel WHERE City_name LIKE '%$city%' AND  Country_name LIKE '%$country%'");
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		$data['hotel_list'] = $result;
		
		$query = mysql_query("SELECT * FROM api_permanent_hotel_asiantravel WHERE HotelId = '$asian_hotel_code'");
		$row = mysql_fetch_assoc($query);
		$data['asian_travel_hotels'] = $row;
		$data['asian_hotel_code'] = $asian_hotel_code;
		$data['asian_city_code'] = $asian_city_code;
		$data['country'] = $country;
		$data['city'] = $city;
		$this->load->view('mapping/asiantravel_update_mapping_hotel',$data);
	}
	
	function update_asiantravel_hotel_mapping($api_permanent_id,$asian_hotel_code,$asian_city_code,$country,$city)
	{
		$query = mysql_query("UPDATE api_permanent_hotel SET Asiantravel_Hotelcode = '$asian_hotel_code' WHERE  Global_Hotelcode = '$api_permanent_id'");
		redirect('mapping/check_hotel_mapping_citywise/'.$city.'/'.$country.'/'.$asian_city_code.'/'.$asian_hotel_code);
	}
}?>

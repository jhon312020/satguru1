<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {

	
	function __construct()
	{
		parent::__construct();

	
		$this->load->model('Map_Model');
		$this->load->model('Api_Model');
		//$this->ses_id= $_SESSION['session_data_id'];
		unset($_SESSION['cart_id']);
	}
	function mapping_fun($id)
	{
		$data['result_id']=$id;
		$data['result']=$this->Hotel_Model->fetch_search_result_map_new_select($id);
		
		$this->load->view('hotel/map',$data);
		
	}
	function fetch_search_result_map_select($id)
	{
		
$query=$this->Hotel_Model->fetch_search_result_map_new_select($id);
$map_data = array();
$cnt=0;
for($k=0;$k< count($query);$k++)
{
	
	$map_data[$cnt]['lat'] = $query[$k]['latitude'];
	$map_data[$cnt]['lng'] = $query[$k]['longitude'];
	$map_data[$cnt]['name'] = $query[$k]['hotel_name'];
	$star = $query[$k]['star'];
	
if($star==1)
{
$st ="<img src='".WEB_HOTEL_DIR."images/1 star.jpg' />";
}
elseif($star==2)
{
$st ="<img src='".WEB_HOTEL_DIR."images/2 star.jpg' />";
}
elseif($star==3)
{
$st ="<img src='".WEB_HOTEL_DIR."images/3 star.jpg' />";
}
elseif($star==4)
{
$st ="<img src='".WEB_HOTEL_DIR."images/4 star.jpg' />";
}
elseif($star==5)
{
$st ="<img src='".WEB_HOTEL_DIR."images/5 star.jpg' />";
}
else
{
$st ="<img src='".WEB_HOTEL_DIR."images/0 star copy.jpg' />";

}
	$info = "<div id='mapdetailsbox2'><div id='imgbox2'><img src='' width='70px' height='70px' /></div><div id='hotelname2'>" . $query[$k]['hotel_name'] . "</div>"; 
	$info.="<div id='star2'> ".$st." </div> <div id='avalabletxt2'> Avalable From</div><div id='doller2'>" . $query[$k]['low_cost'] . "</div><div id='pernight2'> Per Night</div><div style='clear:both'></div></div>";
	$map_data[$cnt]['info'] = $info;
	$cnt++;
}

echo json_encode($map_data);


	}
	
	function mapping_fun_all()
	{
	
		$get_c_data = $this->Api_Model->get_city_details_degree_id($_SESSION['city_code']);
		$data['city_data']=$get_c_data;
		$data['result']=$this->Map_Model->fetch_search_result_map_new_select_session($get_c_data->Hotelbeds);
		//echo '<pre/>';
		//print_r($data);exit;
		$this->load->view('map/map_all',$data);
	}
	
}

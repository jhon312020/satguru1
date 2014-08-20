<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	private $ses_id;
	public $base_currency = 'SGD';
	public $domain;

	function __construct()
	{
		parent::__construct();
		/*$this->domain = 'DSS';
		$this->load->model('Owninventory_Model');
		$this->load->model('Hotel_Model');
		$this->load->model('Api_Model');
		$this->load->model('Account_Model');*/
	}
	
	/**
	 * Function land_mark()
	 * Renders the hotel places based on
	 * Author Megamind computing solutions
	 * Params $latitude, $longitude
	 * @return html content if data exists
	 * reference link http://stackoverflow.com/questions/11112926/how-to-find-nearest-location-using-latitude-and-longitude-from-sql-database
	 * http://www.geodatasource.com/developers/php
	 */
	function land_mark()
	{
		if (isset($_POST['land_mark_id']) && $_POST['land_mark_id'] && isset($_SESSION['hotelspro_xml_data']))
		{
			$land_mark_id = preg_replace("/[^0-9]/","",$this->input->post('land_mark_id'));
			$this->load->model('Land_Marks_Model');
			$this->load->model('Hotel_Model');
			$land_mark = $this->Land_Marks_Model->get_land_mark($land_mark_id);
			//print_r($land_mark);
			if ($land_mark)
			{
				$result = array_merge_recursive($_SESSION['hotelspro_xml_data'], $_SESSION['asiantravel_xml_data']);
				//print_r($result);
				if ($result)
				{
					$hotel_codes = array_unique(array_map(function ($i) { return $i['hotel_code']; }, $result));
					//print_r($hotel_codes);
					$hotel_codes = implode('","', $hotel_codes);
					$land_mark_list = $this->Hotel_Model->get_land_mark_based_hotelspro_hotels('"'.$hotel_codes.'"', $land_mark->latitude, $land_mark->longtitude);
					$grouped_list = $this->_generate_group_list($result, 'hotel_code');
					$land_marks['land_marks'] = $this->Land_Marks_Model->get_land_marks_and_distance($land_mark->citycode, $land_mark->latitude, $land_mark->longtitude);
					$land_mark_result = $this->load->view('hotel/land_marks_result', $land_marks, true);
					//$center_coordinates['latitude'] = $land_mark->latitude;
					//$center_coordinates['longtitude'] = $land_mark->longtitude;
					//print_r($grouped_list);
				}
				if ($_SESSION['hotel_xml_data'])
				{
					$data['own_inventory'] = $_SESSION['hotel_xml_data'];
					$data['own_inventory'] = $this->load->view('hotel/OwnInventory/search_result_ajax', $data, true);
				}
				else
				{
					$data['own_inventory'] = '';
					$_SESSION['OwnInventoryHotelList'] = array();
				}
				//print_r($land_mark_list);
				//exit;
				$data['result_data'] = $grouped_list;
				$data['land_marks'] = $land_mark_list;
				$hotel_search_result = $this->load->view('hotel/land_mark_search_result_ajax', $data, true);
				print json_encode(array(
					'hotel_search_result' => $hotel_search_result,
					'coordinates'=>$_SESSION['coordinates'],
					'center'=>$_SESSION['center_coordinates'],
					'land_marks'=> $land_mark_result,
				));
			}
		}
	}

	/**
	 * Function _generate_group_list()
	 * List of files to be grouped 
	 * together under common key field
	 * Author Megamind computing solutions
	 * param lists as array
	 * param key_field as string
	 * param table_name as string
	 * @return array
	 */
	function _generate_group_list($lists = array(), $key_field = null)
	{
		$group_list = array();
		if ($lists && $key_field)
		{
			foreach ($lists as $key=>$list)
			{
				$group_list[$list[$key_field]] = $list;
			}
		}
		return $group_list;
	}
}

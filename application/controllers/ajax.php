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
	 * ALTER TABLE `hotel_search_list` CHANGE `geo_coordinates` `latitude` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ; ALTER TABLE `hotel_search_list` ADD `longitude` VARCHAR( 50 ) NULL AFTER `latitude` ; ALTER TABLE `land_marks` ADD `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; ALTER TABLE `land_marks` ADD `updated` DATETIME NULL DEFAULT NULL AFTER `created`;

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
				if ($_SESSION['hotelspro_xml_data'] && $_SESSION['asiantravel_xml_data'])
				{
					$result = array_merge_recursive($_SESSION['hotelspro_xml_data'], $_SESSION['asiantravel_xml_data']);
				}
				else
				{
					$result = $_SESSION['hotelspro_xml_data'];
				}
				//print_r($result);
				if ($result)
				{
					$hotel_codes = array_unique(array_map(function ($i) { return $i['hotel_code']; }, $result));
					$land_mark_list_own = '';
					if ($_SESSION['hotel_xml_data'])
					{
						$own_hotel_codes = $_SESSION['hotel_xml_data'];
						$own_hotel_codes = array_unique(array_map(function ($i) { return $i->hotel_id; }, $own_hotel_codes));
						$own_hotel_codes = implode('","', $own_hotel_codes);
						$land_mark_list_own = $this->Hotel_Model->get_land_mark_based_own_hotels('"'.$own_hotel_codes.'"', $land_mark->latitude, $land_mark->longitude);
					}
					$hotel_codes = implode('","', $hotel_codes);
					$land_mark_list = $this->Hotel_Model->get_land_mark_based_hotelspro_hotels('"'.$hotel_codes.'"', $land_mark->latitude, $land_mark->longitude);
					$grouped_list = $this->_generate_group_list($result, 'hotel_code');
					if ($land_mark_list_own)
					{
						if ($land_mark_list)
						{
							$land_mark_list = array_merge_recursive($land_mark_list_own, $land_mark_list);
						}
						else
						{
							$land_mark_list = $land_mark_list_own;
						}
						usort($land_mark_list, array($this, '_sort_by_distance'));
					}
					//echo '<br/> count Own:'. count($land_mark_list_own);
					//echo '<br/> count Combined:'. count($land_mark_list);
					//echo '<br/> count Combined:'. count($land_mark_list_combined);
					//print_r($land_mark_list);
					//exit;
					$land_marks['land_marks'] = $this->Land_Marks_Model->get_land_marks_and_distance($land_mark->citycode, $land_mark->latitude, $land_mark->longitude);
					$land_marks['land_mark_id'] = $land_mark_id;
					$land_mark_result = $this->load->view('hotel/land_marks_result', $land_marks, true);
					//$center_coordinates['latitude'] = $land_mark->latitude;
					//$center_coordinates['longitude'] = $land_mark->longitude;
					//print_r($grouped_list);
				}
				//print_r($land_mark_list);
				//exit;
				$data['result_data'] = $grouped_list;
				$data['land_marks'] = $land_mark_list;
				$data['land_mark_name'] = $land_mark->name;
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
	
	/**
	 * Function _sort_by_distance()
	 * List of files to be grouped 
	 * together under common key field
	 * Author Megamind computing solutions
	 * param lists as array
	 * param key_field as string
	 * param table_name as string
	 * @return array
	 */
	function _sort_by_distance($a, $b) 
	{
		if ($a->distance == $b->distance) return 0;
		return ($a->distance > $b->distance) ? 1 : -1;
	}
}

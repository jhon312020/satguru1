<?php 
//require_once APPPATH.'libraries/checkuser.php';
class Land_Marks_Model extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	/**
	 * Function get_land_mark_list()
	 * Returns the land marks based on the city code array
	 * Author Megamind computing solutions
	 * Params $city_code as array(),
	 * @return array();
	 */
	public function get_land_mark_list($city_code = array())
	{
		$this->db->select('name, type, id')
		->from('land_marks');
		$this->db->where_in('citycode', $city_code);
		$this->db->order_by('type');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) {
			return $query->result();
		}
		return false;
	}

	/**
	 * Function get_land_mark()
	 * Returns the land marks based on the city code
	 * Author Megamind computing solutions
	 * Params $land_mark_id as integer
	 * @return array();
	 */
	public function get_land_mark($land_mark_id = '')
	{
		$this->db->select('latitude, longtitude, citycode')
		->from('land_marks');
		$this->db->where('id', $land_mark_id);
		$this->db->order_by('type');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) {
			return $query->row();
		}
		return false;
	}

	/**
	 * Function get_land_marks_and_distance()
	 * Returns the land marks and distance based 
	 * on the latitude and longtitude value
	 * Author Megamind computing solutions
	 * Params $city_code as string, $given_latitude as string 
	 * and $given_longtitude as string
	 * @return array();
	 */
	public function get_land_marks_and_distance($city_code = '', $given_latitude = '', $given_longtitude = '')
	{
		$que = "SELECT *, ( 3959 * acos( cos( radians($given_latitude) ) * cos( radians( latitude ) ) *  cos( radians( longtitude ) - radians($given_longtitude) ) + sin( radians($given_latitude) ) * sin( radians( latitude ) ) ) ) AS distance FROM land_marks WHERE  citycode = '$city_code' ORDER BY type";
		$query = $this->db->query($que);
		if ($query->num_rows() =='') {
			return '';
		} else {
			return $query->result();
		}
	}
}


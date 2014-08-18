<?php 
//require_once APPPATH.'libraries/checkuser.php';
class Land_Marks_Model extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_land_mark_list($city_code = array())
	{
		$this->db->select('name, type')
		->from('land_marks');
		$this->db->where_in('citycode', $city_code);
		$this->db->order_by('type');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) {
			return $query->result();
		}
		return false;
	}
}


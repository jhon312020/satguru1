<?php 
class Misc_Model extends CI_Model
{

		function __construct()
		{
		
		parent::__construct();
		
		}
		
		public function getmarkuplist()
		{
				$query = $this->db->get('akbar_markup');
				if($query->num_rows() > 0)
				{
						return $query->result();
				}
		}
		
		public function getdiscountlist()
		{
			$query = $this->db->get('akbar_discount');
				if($query->num_rows() > 0)
				{
						return $query->result();
				}
			}
			public function getiatalist()
		{
			$query = $this->db->get('akbar_iata');
				if($query->num_rows() > 0)
				{
						return $query->result();
				}
			}
			public function getplblist()
		{
			$query = $this->db->get('akbar_plb');
				if($query->num_rows() > 0)
				{
						return $query->result();
				}
			}
		
}

?>

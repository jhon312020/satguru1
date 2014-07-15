<?php 
class Home_Model extends CI_Model {

    function __construct()
    {
		
        // Call the Model constructor
        parent::__construct();
		

			
    }
		function get_airports()
 		{
			$que="select city,country,city_code from  city_code_amadeus WHERE country ='USA' ORDER BY city";
	        $query= $this->db->query($que);
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->result();
        	}
		}
		
		function get_imp_airports()
 		{
			$que="select * from  important_airport where status = 1 ORDER BY imp_airport asc";
	        $query= $this->db->query($que);
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->result();
        	}
		}
		function get_fightsliderImages()
		{
			$location = array('generic','flight');
			
			$this->db->select('file_path');
			$this->db->from('banner_images');
			$this->db->or_where_in('imageloca', $location);
			$this->db->where('image_subloca','Top');
			$this->db->where('status',1);
			$this->db->order_by('banner_id', 'RANDOM');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
			function recent_search()
		{
		    $que="select * from  flight_search_result GROUP BY fromcityval ORDER BY id desc LIMIT 0,5";
	        $query= $this->db->query($que);
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->result();
        	}
 		}
		function get_from_city($citycode)
		{
			$this->db->select('*');
			$this->db->from('city_code_amadeus');
			$this->db->like('city_code',$citycode);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		}
		function get_hotelDeals()
		{
			$this->db->select('*');
			$this->db->from('cms_hotel_deals');
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(4);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
			function get_carDeals()
		{
			$this->db->select('*');
			$this->db->from('cms_car_deals');
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(4);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
				
   					
}



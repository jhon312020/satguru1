<?php 
class Own_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	 function insert_temp_result($sec_res,$api,$itemCode,$room_code,$room_type,$status_val,$meals_val,$adult,$child,$org_amt,$currencyv1,$c_val,$total_cost,$city,$room_count,$degree_id='',$min_rate)
	{
			$data=array('session_id'=>$sec_res,'api'=>$api,'hotel_code'=>$itemCode,'room_code'=>$room_code,'room_type'=>$room_type,'inclusion'=>$meals_val,'total_cost'=>$total_cost,'city'=>$city,'status'=>$status_val,'adult'=>$adult,'child'=>$child,'currency_val'=>$c_val,'xml_currency'=>$currencyv1,'org_amt'=>$org_amt,'room_count'=>$room_count,'degree_id'=>$degree_id,'inoffcode_v1'=>$min_rate);
			$this->db->insert('api_hotel_detail_t',$data);
			//echo $this->db->last_query();exit;
		   return $this->db->insert_id();
		
	}
	function insert_priceline_temp_result($sec_id,$active_api,$adult_count,$child_count,$room_count,$degree_id,$itemCode,$rate_typeval,$room_codeval,$room_titleval,$room_descriptionval,$room_detailsval,$room_occupancy_limitval,$rooms_leftval,$has_promoval,$org_amt,$currencyv1,$c_val,$promoval,$est_price_to_val,$policy_nameval,$policy_description,$status_val,$ppn_bundleval)
	{
		
		//'adult'=>$adult_count,'child'=>$child_count<strong></strong>
		$data=array('session_id'=>$sec_id,'api'=>$active_api,'room_count'=>$room_count,'degree_id'=>$degree_id,'rate_typeval'=>$rate_typeval,'hotel_code'=>$itemCode,'room_code'=>$room_codeval,'room_type'=>$room_titleval,'room_descriptionval'=>$room_descriptionval,'room_detailsval'=>$room_detailsval,'adult'=>$room_occupancy_limitval,'rooms_leftval'=>$rooms_leftval,'has_promoval'=>$has_promoval,'total_cost'=>$org_amt,'xml_currency'=>$currencyv1,'currency_val'=>$c_val,'promoval'=>$promoval,'est_price_to_val'=>$est_price_to_val,'policy_nameval'=>$policy_nameval,'policy_description'=>$policy_description,'status'=>$status_val,'org_amt'=>$org_amt,'w_markup'=>$org_amt,'shortname'=>$ppn_bundleval);
			$this->db->insert('api_hotel_detail_t',$data);
		//	echo $this->db->last_query();exit;
		   return $this->db->insert_id();
	}
	function fetch_search_result($ses_id, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='',$place_val2='',$chain_vals='',$hotel_name_vals='',$atoz='',$address='', $sap_star=0)
	{
	
		$display_perpage = 15;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		$hotel_name_value = $_SESSION['hotel_name'];
		if($hotel_name_value!='')
		{
			$where.= " AND p.hotel_name LIKE '$hotel_name_value%' ";
		}
		if($address!=''&& $address!=NULL)
		{
			//$where.= " AND p.address LIKE '$address%' ";
		}
		if($atoz!='' && $atoz!=null)
		{
			$where.= " AND p.hotel_name Like '$atoz%' ";
		}
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		if($place_val2!='')
		{
			$place_val2;
			$where.= " AND p.location  = '$place_val2' ";
		}
if($chain_vals!='')
		{
			$where.= " AND t.inclusion  = '$chain_vals' ";
		}

	   $star_rate_value = $_SESSION['star_rate'];
		if($star_rate_value!='' && $star_rate_value!='0' )
		{
			$tot_st=array();
			for($sta=0;$sta<$star_rate_value;$sta++)
			{
			  $tot_st[] = $sta;
			}
	
			$tot_star = implode(',',$tot_st);
			$where.= " AND p.star IN($tot_star) ";
		}
		else
		{
			$where.= " AND (p.star BETWEEN 0 AND 5)";
		}
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.star, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.star DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
			}
		}
		$where.= " AND `status` IN ('AVAILABLE', 'OK', 
			'Available', 'InstantConfirmation', 'true') ";
		
		$where.= "AND t.city = p.city  AND LCASE(t.api) = p.api ";
		
		//echo $where;exit;
		if (empty($fac)) 
		{
			
		$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_search_list p WHERE t.hotel_code = p.hotel_code AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order ";
		} 
		else 
		{
$s=array('"');
   $fac_arr=explode("+",str_replace($s,'',$fac));
$facility_where='';
//$r_facility_where='';
$i=0;
$facility_array_count=count($fac_arr);
foreach ($fac_arr as $facility_value)
{
if($facility_value!="")
{
//print_r($facility_value);
if($i+1<$facility_array_count)
	{
		$facility_where.=" p.hotel_facilities LIKE '%$facility_value%' AND ";
                //$r_facility_where.=" p.room_facilities LIKE '%$facility_value%' AND ";
	}
else{
	$facility_where.=" p.hotel_facilities LIKE '%$facility_value%' ";
//$r_facility_where.=" p.room_facilities LIKE '%$facility_value%' ";
	}
 }
$i++;
}
//$fac="Pool";
//echo $fac;

			//$where.= " and MATCH(p.hotel_facilities) AGAINST ('$fac'  IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_search_list p, hotel_facilities f WHERE t.hotel_code = p.hotel_code and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where AND $facility_where GROUP BY t.hotel_code $order";
			//echo $select.'<br><br><br>'.$where; exit;
		} 
		//echo $select;exit;
		$query = $this->db->query($select);
        //echo $this->db->last_query();exit;
		
		if ( $query->num_rows > 0 ) {
			$data['result'] = $query->result();
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();
			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_search_list p WHERE t.hotel_code = p.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		}
		else 
		{
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_search_list p, hotel_facilities f WHERE t.hotel_code = p.hotel_code and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where AND $facility_where group by  t.hotel_code ) as tab";
				
		}
		
			//echo $select2; exit();
			$query2 = $this->db->query($select2);
			//echo $this->db->last_query();exit;
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			//print_r($data);exit;
			return $data;
		}
		//print_r($data);exit;
      return false;
	
	}
		function fetch_search_result_all($city,$offset=0)
	{
		$offset = ($offset*100)+100;
		$limit=100;
		//$offset=0;
		//AND hotelid_t != '0'
		//echo 'asda';exit;
		$this->db->select('*');
		$this->db->where('cityid_ppn',$city);
		$this->db->where('active','1');
		$this->db->order_by('lowrate','ASC');
		$query=$this->db->get('priceline_hotels',$limit,$offset);
		
	//	$query1=$this->db->get('priceline_hotels');
		
		//	echo $this->db->last_query();
			
			if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();

			$data['totRow'] = 0;
		$select2 = "SELECT MIN(lowrate) as minVal, MAX(lowrate) as maxVal FROM priceline_hotels  WHERE cityid_ppn = '$city' AND active = '1' AND lowrate !='0.00'  ";

		
			
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
					

			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
		
return false;

	}
	
	function fetch_search_result_all_id($id)
	{
		//AND hotelid_t != '0'
			$select = "SELECT  * FROM  priceline_hotels WHERE  	degree_id = '$id'";

			$query = $this->db->query($select);
			if ( $query->num_rows > 0 ) {
		
					return  $query->row();
				
		
		}
		


	}
	
	
	function get_city_code($city)
	{
	    $this->db->select('*');
		$this->db->from('api_hotels_city');
		$this->db->where('city',$city);
		$query = $this->db->get();
		
		if($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}

	}
	function get_city_details($city)
	{
	    $this->db->select('*');
		$this->db->from('priceline_city');
		$this->db->where('city',$city);
		$query = $this->db->get();
		
		if($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}

	}
	function get_city_details_new($city,$country='')
	{
	    $this->db->select('*');
		$this->db->from('api_permanent_city');
		$this->db->where('Global_City',$city);
		$query = $this->db->get();
		if($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}

	}
	function fetch_search_result_temp($api='')
	{
				$city_info = $this->get_city_code($_SESSION['city']);
				$api_val = explode(",",$api );
			
				$this->db->select('*');
				$this->db->from('hotel_search_list');
				$this->db->where('city',$city_info->city_name);
				for($l=0;$l<count($api_val);$l++)
				{
					//$this->db->where('api',strtolower($api_val[$l]));
				}
				//$this->db->where('api',strtolower('hotelsbed'));
				
				$query = $this->db->get();
				//echo $this->db->last_query();exit;
				if($query->num_rows() == '' )
				{
				   return '';   
				}
				else
				{
				  return $query->result(); 
				}

	
	}
		function get_searchresult($id)
	{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_t');
		$this->db->where('api_temp_hotel_id',$id);
		$this->db->join('hotel_search_list', 'api_hotel_detail_t.hotel_code = hotel_search_list.hotel_code and api_hotel_detail_t.city = hotel_search_list.city  and api_hotel_detail_t.api = hotel_search_list.api ');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() == 0 )
		{
		   return '';   
		  }else{
		  return $query->row(); 
		  }
		
	}
	function get_searchresult_new_table($id)
	{
		$this->db->select('*');
		$this->db->from('priceline_hotels');
		$this->db->where('degree_id',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() == 0 )
		{
		   return '';   
		  }else{
		  return $query->row(); 
		  }
		
	}
	function get_searchresult_new_table_based_id($id)
	{
		$this->db->select('*');
		$this->db->from('priceline_hotels');
		$this->db->where('hotelid_b',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() == 0 )
		{
		  $this->db->select('*');
		$this->db->from('priceline_hotels');
		$this->db->where('hotelid_t',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() == 0 )
		{
		   return '';   
		  }else{
		  return $query->row(); 
		  }   
		  }else{
		  return $query->row(); 
		  }
		
	}
	
	function get_searchresult_new_table_image($bid,$tid)
	{
		$this->db->select('*');
		$this->db->from('priceline_photo');
		$this->db->where('hotelid_b',$bid);
		$this->db->where('hotelid_t',$tid);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() == 0 )
		{
		   return '';   
		  }else{
		  return $query->result(); 
		  }
	}
	function delete_temp_data($ses_id)
	{
		$this->db->delete('api_hotel_detail_t', array('session_id' => $ses_id)); 
	}
	function delete_shoppingcart_data($ses_id)
	{
		$this->db->delete('shopping_cart', array('session_id' => $ses_id)); 
	}
	
}



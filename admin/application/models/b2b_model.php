<?php 
class B2b_Model extends CI_Model
{

		function __construct()
		{
		
		parent::__construct();
		
		}
		
	
		function b2blist($status)
		{
			$this->db->select('b2b.*,domain.*,b2b_acc_info.balance_credit')
		->from('b2b')
		->where('status',$status)
		->join('domain', 'domain.domain_id  = b2b.domain', 'left')
		->join('b2b_acc_info', 'b2b_acc_info.agent_id  = b2b.agent_id', 'left');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
		}
		
		function update_b2b_status($id,$status)
		{
			$data = array('status'=>$status);
			$this->db->where('agent_id',$id);
			$this->db->update('b2b',$data);
			return true;
		}
		 function add_agent_user($sal,$company,$office,$pw3,$email3,$address,$phone,$city,$country,$postal,$domain,$image_path)
   {
	   	$data = array(
		'name' => $sal,
		'company_name' => $company,
		'office_phone' => $office,
		'password' => $pw3,
		'email_id' => $email3,
		'address' => $address,
		'mobile' => $phone,
		'city' => $city,
		'country' => $country,
		'postal_code' => $postal,
		'domain' => $domain,
		'agent_logo' => $image_path,
 		'agent_type' => '2',
		'status' => '1',
		'last_visit_date' => ''
		);
			
		$this->db->set('register_date', 'NOW()', FALSE); 
		
		$this->db->insert('b2b', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {
			
			$data12 = array(
			'agent_id' => $id,
			'balance_credit' => 0.00,
						'last_credit' => 0.00
			);
			
		$this->db->insert('b2b_acc_info', $data12);
		$this->db->insert_id();
		
					$city_array=array(198,844,4977,4073,337,2087,481,5770,3621,4239,3131,3850,435,1753,3257,4443,481,5770,3621,4239);
		$data1=array();
		for($k=0;$k<16;$k++)
		{
			$data1 = array(
			'agent_id' => $id,
			'citi_id' => $city_array[$k],
			);
			
		$this->db->insert('b2b_top_cities', $data1);
		$this->db->insert_id();
		}
			return true;
		} else {
			return false;
		}

   }
		public function get_agent_list_id($id)
   	{
   
		$this->db->select('*')
		->from('b2b')
		->where('agent_id', $id);
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
    function update_b2b_agent($id,$name,$address,$phone,$city,$country,$postal,$company,$office)
   {
	   	$data = array(
			'name' => $name,
			'company_name' => $company,
			'office_phone' => $office,
			'address' => $address,
			'mobile' => $phone,
			'city' => $city,
			'country' => $country,
			'postal_code' => $postal
			
			);
		
		
			
			$where = "agent_id = ".$id;
		if ($this->db->update('b2b', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
      public function get_deposit_amount($id)
   	{
   
		$this->db->select('*')
		->from('b2b_acc_info')
		->where('agent_id', $id);
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
   function getAllAgent_new()
	{
		$select = "SELECT agent_id, name,company_name  FROM b2b WHERE agent_type = 2 AND 	status = 1";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	function b2bmarkupinsert($api,$markup,$module_type,$agent)
		{
			$this->db->select('*');
			$this->db->from('b2b_markup');
			$this->db->where('markup_type',$module_type);
			$this->db->where('api',$api);
			$this->db->where('agent_id',$agent);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				$data= array('markup'=>$markup,'api'=>$api,'markup_type' => $module_type,'agent_id' => $agent);
			$this->db->insert('b2b_markup',$data);
			return true;
			}else{
				$this->db->where('api',$api);
				$this->db->where('markup_type',$module_type);
				$this->db->where('agent_id',$agent);
				$this->db->delete('b2b_markup');
				$data= array('markup'=>$markup,'api'=>$api,'markup_type' => $module_type,'agent_id' => $agent);
			$this->db->insert('b2b_markup',$data);
			return true;
			}
			
			
		}
	function get_b2b_markup($type)
	{		
		
		$select = "SELECT * FROM b2b_markup WHERE markup_type = '".$type."'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	function b2bmarkupinsertcountry($api,$markup,$val,$country_name,$module_type,$agent_id)
		{
			$this->db->select('*');
			$this->db->from('b2b_markup');
			$this->db->where('markup_type',$module_type);
			$this->db->where('api',$api);
			$this->db->where('agent_id',$agent_id);
			$this->db->where('country',$country_name);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				
			$data= array('markup'=>$markup,'api'=>$api,'country'=>$country_name, 'markup_type' => $module_type, 'agent_id' => $agent_id);
			//$this->db->where('module_type',$val);
			$this->db->insert('b2b_markup',$data);
			return true;
			}else{
				$this->db->where('api',$api);
				$this->db->where('markup_type',$module_type);
				$this->db->where('country',$country_name);
				$this->db->where('agent_id',$agent_id);
				$this->db->delete('b2b_markup');
				
			$data= array('markup'=>$markup,'api'=>$api,'country'=>$country_name, 'markup_type' => $module_type, 'agent_id' => $agent_id);
			//$this->db->where('module_type',$val);
			$this->db->insert('b2b_markup',$data);
			
			return true;
			}
			
		}
		function delete_b2b_markup($id)
		{
			$this->db->where('id',$id);
			$this->db->delete('b2b_markup');
			return true;
		}
		function gethotelreports2($val='')
		{
			$this->db->select('*');
			$this->db->from('booking_global');
				$this->db->where('user_type','2');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_booking_api_status()
		{
			$this->db->select('api_status');
			$this->db->from('booking_global');
			$this->db->group_by('api_status');
				$this->db->where('user_type','2');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_booking_status()
		{
				$this->db->select('booking_status');
			$this->db->from('booking_global');
			$this->db->group_by('booking_status');
				$this->db->where('user_type','2');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_transaction_status()
		{
				$this->db->select('transaction_status');
			$this->db->from('booking_global');
			$this->db->group_by('transaction_status');
				$this->db->where('user_type','2');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_reservation_details_id($id)
	{
		
		$this->db->select('*');
		$this->db->from('booking_global');
		$this->db->where('pnr_no',$id);
		$query = $this->db->get();	
		 if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
	}
	function get_reservation_details_hotel($id)
	{
		
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->where('booking_id',$id);
		$query = $this->db->get();	
		return $query->row();
	}
}

?>

<?php 
class B2c_Model extends CI_Model
{

		function __construct()
		{
		
		parent::__construct();
		
		}
		
		
		function check_b2c_user($email)
		{
			$this->db->select('user_id');
			$this->db->from('b2c');
			$this->db->where('email',$email);
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		function b2creginsert($title,$first_name,$last_name,$email_id,$pwfield,$phone,$postalcode,$country,$city,$addresss,$akbar_ref)
		{
			$date = date('Y-m-d');
			$status = 'Inactive';
			$data = array('usertype' => 3, 'domain' => 1, 'email' => $email_id, 'password' => $pwfield, 'title' => $title, 'firstname' => $first_name, 'lastname' => $last_name, 'address' => $addresss, 'contact_no' => $phone, 'city' => $city, 'country' => $country, 'postal_code' => $postalcode, 'status' => 1, 'register_date' => date( 'Y-m-d H:i:s'));
			$this->db->insert('b2c',$data);
		}
		
		
		
		function b2clist($status)
		{
			$this->db->select('*');
			$this->db->from('b2c');
			$this->db->where('status',$status);
			
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		
		function update_b2c_status($id,$status)
		{
			$data = array('status'=>$status);
			$this->db->where('user_id',$id);
			$this->db->update('b2c',$data);
			return true;
		}
		
		function delete_b2c_user($user_id)
		{
			$this->db->where('user_id',$user_id);
			$this->db->delete('b2c');
			return true;
		}
		
		function get_single_b2c_details($user_id)
		{
			$this->db->select('*');
			$this->db->from('b2c');
			$this->db->where('user_id',$user_id);
			
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		}
		
		function update_b2c_user($user_id,$title,$first_name,$last_name,$email_id,$pwfield,$phone,$postalcode,$country,$city,$addresss)
		{
			$data = array('email' => $email_id, 'password' => $pwfield, 'title' => $title, 'firstname' => $first_name, 'lastname' => $last_name, 'address' => $addresss, 'contact_no' => $phone, 'city' => $city, 'country' => $country, 'postal_code' => $postalcode);
			$this->db->where('user_id',$user_id);
			$this->db->update('b2c',$data);
			return true;
		}
		function b2cmarkupinsert($api,$markup,$module_type)
		{
			$this->db->select('*');
			$this->db->from('b2c_markup');
			$this->db->where('module_type',$module_type);
			$this->db->where('api',$api);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				$data= array('markup'=>$markup,'api'=>$api,'module_type' => $module_type);
			$this->db->insert('b2c_markup',$data);
			return true;
			}else{
				$this->db->where('api',$api);
				$this->db->where('module_type',$module_type);
				$this->db->delete('b2c_markup');
				$data= array('markup'=>$markup,'api'=>$api,'module_type' => $module_type);
			$this->db->insert('b2c_markup',$data);
			return true;
			}
			
			
		}
		
		function delete_b2c_markup($id)
		{
			$this->db->where('id',$id);
			$this->db->delete('b2c_markup');
			return true;
		}
		
		function b2cmarkupinsertcountry($api,$markup,$val,$country_name,$module_type)
		{
			$this->db->select('*');
			$this->db->from('b2c_markup');
			$this->db->where('module_type',$module_type);
			$this->db->where('api',$api);
			$this->db->where('country',$country_name);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				
			$data= array('markup'=>$markup,'api'=>$api,'country'=>$country_name, 'module_type' => $module_type);
			//$this->db->where('module_type',$val);
			$this->db->insert('b2c_markup',$data);
			return true;
			}else{
				$this->db->where('api',$api);
				$this->db->where('module_type',$module_type);
				$this->db->where('country',$country_name);
				$this->db->delete('b2c_markup');
				
			$data= array('markup'=>$markup,'api'=>$api,'country'=>$country_name, 'module_type' => $module_type);
			//$this->db->where('module_type',$val);
			$this->db->insert('b2c_markup',$data);
			
			return true;
			}
			
		}
		function gethotelreports2($val='')
		{
			$this->db->select('*');
			$this->db->from('booking_global');
				$this->db->where('user_type','3');
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
	function get_booking_api_status()
		{
			$this->db->select('api_status');
			$this->db->from('booking_global');
			$this->db->group_by('api_status');
				$this->db->where('user_type','3');
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
				$this->db->where('user_type','3');
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
				$this->db->where('user_type','3');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
	
}

?>

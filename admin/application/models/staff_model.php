<?php 
class Staff_model extends CI_Model
{

		function __construct()
		{
		
		parent::__construct();
		
		}
		
		public function getlist($type)
		{
				$query = $this->db->get_where('akbar_staff_registration',array('status' => $type));
				if($query->num_rows() > 0)
				{
						return $query->row();
				}
		}
		
		public function staff_save($fname,$lname,$email,$password,$mobile,$address)
		{
			//echo "<pre>"; print_r($data_insert); exit;
			$data = array('fname'=>$fname,'lname' =>$lname,'email'=>$email,'password'=>$password,'mobile'=>$mobile,'address'=>$address,'status'=>0);
			$this->db->insert("akbar_staff_registration",$data);
			//echo $this->db->insert_id(); exit;
		}
		
		public function change_status($staff_id,$status) {
			$this->db->where('staff_id',$staff_id);
			$this->db->update('akbar_staff_registration' , array('status' => $status));
			}
		
		
}

?>

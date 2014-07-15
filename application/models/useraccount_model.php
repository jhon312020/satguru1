<?php 
//require_once APPPATH.'libraries/checkuser.php';
class Useraccount_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
	
	 function get_upcoming_list($b2c_id,$b2c_type,$domain_id,$fromdate,$todate,$pnrno,$tripid,$service_type)
	 {
		 //->where('check_in >=',$today)
		 $today =date('Y-m-d');
			$this->db->select('*')
			
		->from('booking_global');
		$this->db->where('user_type',$b2c_type);
		$this->db->where('booking_status !=','Cancel');
		$this->db->where('user_id',$b2c_id);
		if($fromdate !='')
		{
		$this->db->where('voucher_date >=',$fromdate);
		}
		if($todate !='')
		{
		$this->db->where('voucher_date <=',$todate);
		}
		if($pnrno !='')
		{
		$this->db->where('pnr_no',$pnrno);
		}
		if($tripid !='')
		{
		$this->db->where('booking_no',$tripid);
		}
		if($service_type !='')
		{
		$this->db->where('product_name',$service_type);
		}
		
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return ''; 
	 }
	  function get_cancel_list_recent($b2c_id,$b2c_type,$domain_id,$fromdate,$todate,$pnrno,$tripid,$service_type)
	 {
		 //->where('check_in >=',$today)
		
		 $today = date('Y-m-d',(strtotime(date('Y-m-d')) - 90000));
		
			$this->db->select('*')
			
		->from('booking_global')
		->where('user_type',$b2c_type)
		->where('user_id',$b2c_id)
		->where('voucher_date > ',$today);
		
		$query = $this->db->get();
      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return ''; 
	 }
	  function get_past_list($b2c_id,$b2c_type)
	 {
		 
		 $today =date('Y-m-d');
			$this->db->select('*')
		->from('booking')->where('user_type',$b2c_type)->where('user_id',$b2c_id)->where('check_in <',$today);
		$query = $this->db->get();
      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return ''; 
	 }
	  function get_cancel_list($b2c_id,$b2c_type)
	 {
		 
		 $today =date('Y-m-d');
			$this->db->select('*')
		->from('booking_global')->where('user_type',$b2c_type)->where('user_id',$b2c_id)->where('booking_status','Cancel');
		$query = $this->db->get();
      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return ''; 
	 }
	 function agent_deposit_details($agent_id)
	{
		$select = "SELECT *, date_format(deposited_date, '%d/%m/%Y') as deposited FROM b2b_deposit WHERE agent_id = $agent_id";
		
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
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
    public function get_agent_list_id($id)
   	{
   
		$this->db->select('*')
		->from('b2b')
		->where('agent_id', $id)
		->join('domain', 'domain.domain_id  = b2b.domain', 'left');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
  
   function add_agent_deposit($agent_id, $amount_credit, $deposited_date, $remarks)
	{
		$select2 = "select max(deposit_id)+1 as max from b2b_deposit";
		$query=$this->db->query($select2);
		$aa = $query->row();
		$m_id1 = 0;
		if($aa!='')
		{
			$m_id1=  $aa->max;
		}
		
		$m_id =  'AT'.date('d').date('m').($m_id1+10000);
	
		$data = array(
			'agent_id' => $agent_id,
			'amount_credit' => $amount_credit,
			'deposited_date' => $deposited_date,
			'remarks' => $remarks,
				'transaction_id' => $m_id,
			
			'status' => 'Pending'
		);
			
		$this->db->insert('b2b_deposit', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {
		
			
			return $id;
		} else {
			return false;
		}

	}
}


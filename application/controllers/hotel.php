<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller {
	private $ses_id;
	public $base_currency = "SGD";
	public $domain;
	
	function __construct()
	{
		
		parent::__construct();
		$this->domain = "DSS";
		
		$this->load->model('Hotel_Model');
		$this->load->model('Api_Model');
		$this->load->model('Account_Model');


	}
	function search($city_value='')
	{
		$this->load->model('Hotelbeds_Model');
		if(isset($_SESSION['city_val']) && $_POST['cityval'] == '')
		{
			$_SESSION['city_val'] = $_SESSION['city_val'];
		}
		else
		{
			$_SESSION['city_val'] = $_POST['cityval'];
		}
		if(isset($_SESSION['room_count']) && $this->input->post('room_count')== '')
		{
			$_SESSION['room_count'] = $_SESSION['room_count'];
		}
		else
		{
			$_SESSION['room_count'] = $this->input->post('room_count');
		}
		if(isset($_SESSION['adult']) && $this->input->post('adult')== '')
		{
			$_SESSION['adult'] = $_SESSION['adult'];
		}
		else
		{
			$_SESSION['adult'] = $this->input->post('adult');
		}
		if(isset($_SESSION['child']) && $this->input->post('child')== '')
		{
			$_SESSION['child'] = $_SESSION['child'];
		}
		else
		{
			$_SESSION['child'] = $this->input->post('child');
		}
		if(isset($_SESSION['child_age']) && $this->input->post('child_age')== '')
		{
			$_SESSION['child_age'] = $_SESSION['child_age'];
		}
		else
		{
			$_SESSION['child_age'] = $this->input->post('child_age');
		}
		if(isset($_SESSION['sd']) && $this->input->post('sd')== '')
		{
			$_SESSION['sd'] = $_SESSION['sd'];
		}
		else
		{
			$_SESSION['sd'] = $this->input->post('sd');
		}
		if(isset($_SESSION['ed']) && $this->input->post('ed')== '')
		{
			$_SESSION['ed'] = $_SESSION['ed'];
		}
		else
		{
			$_SESSION['ed'] = $this->input->post('ed');
		}
		$this->load->model('Hotels_Model');
		$sess_id=session_id();
		$cityName = explode(",",$_SESSION['city_val']);
		$adultCount= array_slice($_SESSION['adult'], 0, $_SESSION['room_count']);
		$childCount= array_slice($_SESSION['child'], 0, $_SESSION['room_count']);
		$destId=$this->Hotels_Model->getDestinationCodeOnName($cityName);
	//echo '<pre>';print_r($destId);exit;
		$_SESSION['hotel_search']['full_city']=$_SESSION['city_val'];
		$_SESSION['hotel_search']['country'] = trim($cityName[1]);
		$_SESSION['hotel_search']['city'] = $cityName[0];
		if ($destId)
		{
			$_SESSION['hotel_search']['dest_code']=$destId->city_code;
			$_SESSION['hotel_search']['count_code']=$destId->countrycode;
		}
		else
		{
			$_SESSION['hotel_search']['dest_code'] = '';
			$_SESSION['hotel_search']['count_code']= '';
		}
		//echo $_SESSION['hotel_search']['dest_code'];exit;
		$_SESSION['hotel_search']['room_count']= $_SESSION['room_count'];
		$_SESSION['hotel_search']['adult']= $_SESSION['adult'];
		$_SESSION['hotel_search']['child']= $childCount;
		$_SESSION['hotel_search']['adult_count']= $_SESSION['adult'];
		//$_SESSION['hotel_search']['adult_count']= array_sum($adultCount);
		$_SESSION['hotel_search']['child_count']= array_sum($childCount);
		$_SESSION['hotel_search']['sess_id']=session_id();
		$_SESSION['hotel_search']['child_age']=$_SESSION['child_age'];
		$cin_val = explode("-",$_SESSION['sd']);
		$cout_val = explode("-",$_SESSION['ed']);
		$_SESSION['hotel_search']['org_cin']=$_SESSION['sd'];
		$_SESSION['hotel_search']['org_cout']=$_SESSION['ed'];
		$_SESSION['hotel_search']['cin']= $cin_val[1].'/'.$cin_val[2].'/'.$cin_val[0];
		$_SESSION['hotel_search']['cout']= $cout_val[1].'/'.$cout_val[2].'/'.$cout_val[0];
		$_SESSION['hotel_search']['session_id']=$sess_id;
		$diff =  abs(strtotime($cout_val[0].'-'.$cout_val[1].'-'.$cout_val[2])- strtotime($cin_val[0].'-'.$cin_val[1].'-'.$cin_val[2]) );
		$sec   = $diff % 60;
		$diff  = intval($diff / 60);
		$min   = $diff % 60;
		$diff  = intval($diff / 60);
		$hours = $diff % 24;
		$_SESSION['hotel_search']['days']  = intval($diff / 24);
		$sess_id=session_id();
		//header('Cache-Control: max-age=900');
		//echo '<pre/>';
		//print_r($_POST);exit;
		$result = $this->Hotelbeds_Model->fetch_search_result_all_id_all($_SESSION['hotel_search']['session_id']);
		unset($_SESSION['hotel_xml_data']);
		$_SESSION['hotel_xml_data']=array();
		if ($result)
		{
			$_SESSION['hotel_xml_data'] = $result;
		}
		$_SESSION['hotelspro_xml_data']=array();
		$_SESSION['asiantravel_xml_data']=array();
		$this->form_validation->set_rules('cityval', 'City', 'required');
		$this->form_validation->set_rules('adult', 'Adult', 'required');
		$this->form_validation->set_rules('child', 'Child', 'required');
		$this->form_validation->set_rules('room_count', 'Room Count','required');
		if($this->form_validation->run()==FALSE)
		{
			if(!isset($_SESSION['set_basic_session']))
			{
				redirect('home','refresh');
			}
			else
			{
				$api_r=array();
				$api_r1=array();
				$api = $this->Hotel_Model->api_status_id($this->domain);
				if($api != '')
				{
					for($k=0;$k<count($api);$k++)
					{
						$api_r[]= "'".$api[$k]->api_name."'";
						$api_r1[]= $api[$k]->api_name;
					}
					$api_f = implode(",",$api_r);
					$api_f1 = implode(",",$api_r1);
				}
				else
				{
					$api_f="'Nil'";
					$api_f1='';
				}
				$data['api_fs'] =$api_f;
				$data['api'] =$api_f1;
				//echo '<pre/>';
				//print_r($data);exit;	
				$data['result'] = '';
				$data['min_val'] =0;
				$data['max_val'] =0;
				$data['tot_rec'] =0;
				$this->load->view('hotel/search_result',$data);
			}
		}
		else
		{
			$check_child_age = array_sum($_POST['child']);
			$age=array();
			if($check_child_age >= 1)
			{
				for($l=0;$l<count($_POST['child']);$l++)
				{
					if(isset($_POST['child_age'.$l]))
					{
						
						$age[] = implode(",",$_POST['child_age'.$l]);
					}
					else
					{
						$age[] = 0;
					}
				}
			}
			/**************************  set session variables  ***********************************************/
			/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
			$city_code_v = $this->Api_Model->get_city_details_new(trim($_POST['cityval']));
			//echo '<pre/>';
			//print_r($city_code_v);exit;
			$chotel_count = '';
			$_SESSION['chotel_count']=$chotel_count;
			if($city_code_v!='')
			{
				if($city_code_v->Global_Citycode!='')
				{	
					$_SESSION['city']  = $city_code_v->Global_City;
					$_SESSION['city_code']  =  $city_code_v->Global_Citycode;
					
					$_SESSION['cin']  = $_POST['sd'];
					$_SESSION['cout']  = $_POST['ed'];
					$_SESSION['hotel_name']  = '';
					$_SESSION['star_rate']  = '';
					$_SESSION['room_count']  = $_POST['room_count'];
					$_SESSION['adult']  = $_POST['adult'];
					$_SESSION['child']  = $_POST['child'];
					$_SESSION['adult_count']  = array_sum($_POST['adult']);
					$_SESSION['child_count']  = array_sum($_POST['child']);
					$_SESSION['child_age']=$age;
					$cin_val = explode("-",$_SESSION['cin']);
					$cout_val = explode("-",$_SESSION['cout']);
					$diff =  strtotime($cout_val[2].'-'.$cout_val[1].'-'.$cout_val[0])- strtotime($cin_val[2].'-'.$cin_val[1].'-'.$cin_val[0]) ;
					$sec   = $diff % 60;
					$diff  = intval($diff / 60);
					$min   = $diff % 60;
					$diff  = intval($diff / 60);
					$hours = $diff % 24;
					$_SESSION['days']  = intval($diff / 24);
					$_SESSION['set_basic_session']  = TRUE;
					/**************************  set session variables  ***********************************************/
					/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
					if(isset($_SESSION['set_basic_session']))
					{
						
						$data['set_basic_session'] =  $_SESSION['set_basic_session'];
						
						/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^   delete data's ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
						if(isset($_SESSION['session_data_id']))
						{
							$this->Api_Model->delete_temp_data($_SESSION['session_data_id']);
							//$this->Api_Model->delete_shoppingcart_data($_SESSION['session_data_id']);
						}
						/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^  delete data's ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
							
						$_SESSION['session_data_id']='';
						$_SESSION['session_data_id']=session_id();
						$this->ses_id= $_SESSION['session_data_id'];
						$data['ses_id']=$_SESSION['session_data_id'];
						//api
					}
					else
					{
						$data['set_basic_session'] ='0';
					}
					$api_r=array();
					$api_r1=array();
					$api = $this->Hotel_Model->api_status_id($this->domain);
					if($api != '')
					{
						for($k=0;$k<count($api);$k++)
						{	
						
								$api_r[]= "'".$api[$k]->api_name."'";
								$api_r1[]= $api[$k]->api_name;
						
						}
						$api_f = implode(",",$api_r);
						$api_f1 = implode(",",$api_r1);
					}
					else
					{
						$api_f="'Nil'";
						$api_f1='';
					}
					$data['api_fs'] =$api_f;
					$data['api'] =$api_f1;
					$data['result'] = '';
					$data['min_val'] =0;
					$data['max_val'] =0;
					$data['tot_rec'] =0;
					$this->load->view('hotel/search_result',$data);
				}
				else
				{
					$data['error']='';
					$data['error_header']='';
					
					$this->load->view('hotel/others/error',$data);
				}
			}
			else
			{
				$data['error']='';
				$data['error_header']='';
				
				$this->load->view('hotel/others/error',$data);
			}
		}
	}
	
	function search_v1()
	{
	//	echo '<pre/>';
	//	print_r($_SESSION);exit;
		$_SESSION['Priceline_data']=array();
		$_SESSION['Tourico_data']=array();
		$_SESSION['Hotelbeds_data']=array();
		$_SESSION['Gta_data']=array();
		
		$data['ses_id']=$_SESSION['session_data_id'];

		 				 $api_r=array();
						$api_r1=array();
						$api = $this->Hotel_Model->api_status_id($this->domain);
						
						if($api != '')
						{
							for($k=0;$k<count($api);$k++)
							{	
							if($api[$k]->api_name !='ticket_evolution' && $api[$k]->api_name !='Carsolize')
							{
									$api_r[]= "'".$api[$k]->api_name."'";
									$api_r1[]= $api[$k]->api_name;
							}
							}
							$api_f = implode(",",$api_r);
							$api_f1 = implode(",",$api_r1);
						}
						else
						{
							$api_f="'Nil'";
							$api_f1='';
						}
						
						$data['api_fs'] =$api_f;
						$data['api'] =$api_f1;
					
			if(isset($_SESSION['city_code']) && $_SESSION['city_code']!='')
			{
				$limit=0; $offset=100;
				$result =  $this->Api_Model->fetch_search_result_all($_SESSION['city_code']);
				$data['result_count'] = $_SESSION['chotel_count'];
				$data['result'] = $result['result'];
				$data['minVal'] = $result['minVal'];
				$data['maxVal'] = $result['maxVal'];
				$data['tot_rec']= $_SESSION['chotel_count'];
				
			}
			else
			{
				$data['result'] = '';
				$data['min_val'] =0;
				$data['max_val'] =0;
				$data['tot_rec'] =0;
			}

			$this->load->view('hotel/search_result',$data);
	}
	function check_room_info($degree_hotel_id)
	{
		
						$api_r=array();
						$api_r1=array();
						$api = $this->Hotel_Model->api_status_id($this->domain);
						
						if($api != '')
						{
							for($k=0;$k<count($api);$k++)
							{	
									$api_r[]= "'".$api[$k]->api_name."'";
									$api_r1[]= $api[$k]->api_name;
							}
							$api_f = implode(",",$api_r);
							$api_f1 = implode(",",$api_r1);
						}
						else
						{
							$api_f="'Nil'";
							$api_f1='';
						}
						
						$data['api_fs'] =$api_f;
						$data['api'] =$api_f1;
		if(isset($_SESSION['set_basic_session']))
		{
			
		$data['set_basic_session'] =  $_SESSION['set_basic_session'];
		
			
		   /*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^   delete data's ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
			if(isset($_SESSION['session_data_id']))
			{
			$this->Api_Model->delete_temp_data($_SESSION['session_data_id']);
			//$this->Api_Model->delete_shoppingcart_data($_SESSION['session_data_id']);
			}
			 /*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^  delete data's ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/

			$_SESSION['session_data_id']='';
			$_SESSION['session_data_id']=session_id();
			$this->ses_id= $_SESSION['session_data_id'];
			$data['ses_id']=$_SESSION['session_data_id'];
			//api
		}
		else
		{
			$data['set_basic_session'] ='0';
		}
		$data['hotel_id_val']=$degree_hotel_id;
		
	
		$room_result = $this->load->view('hotel/hotel_detail_room_info',$data,true);
		
		print json_encode(array(
				'room_result' => $room_result
			));
		//redirect('api/call_api/'.$data['api'], 'refresh');
	}
	
 function 	fetch_review_details($degree_hotel_id)	
 {
		
			$data['review_detail'] = $this->Hotel_Model->fetch_hotel_review_detail($degree_hotel_id); 
			$review_result = $this->load->view('hotel/hotel_review', $data, true);
			print json_encode(array(
					'review_result' => $review_result
			
			));
		
}
		
		
	function new_review_details($hotel_b,$hotel_t,$page)	
	{
	
		
	$data['review'] = $this->Priceline_Model->hotel_review($hotel_b,$hotel_t,$page);
	$review_result = $this->load->view('hotel/review_hotel', $data, true);

	print json_encode(array(
				'review_result' => $review_result
		));
		
	}		
		
	
	
	function get_room_data($degree_id)
	{
		$data['hotel_id_val']=$degree_id;
		$service=$this->Api_Model->get_searchresult_new_table($degree_id);		
		
		if(isset($_POST['sd']) && isset($_POST['ed']))
		{
			/**************************  set session variables  ***********************************************/
			/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
		  		$check_child_age = array_sum($_POST['child']);
				$age=array();
				if($check_child_age >= 1)
				{
					for($l=0;$l<count($_POST['child']);$l++)
					{
						if(isset($_POST['child_age'.$l]))
						{
							$age[] = implode(",",$_POST['child_age'.$l]);
						}
						else
						{
							$age[] = 0;
						}
					}
				}
				$city_code = $service->pclncityid;
			
			if(isset($city_code) && $city_code!='')
			{	
				$_SESSION['city']  = $service->city;
				$_SESSION['city_code']  =  $service->pclncityid;
				$_SESSION['cin']  = $_POST['sd'];
				$_SESSION['cout']  = $_POST['ed'];
				$_SESSION['hotel_name']  = '';
				$_SESSION['star_rate']  = '';
				$_SESSION['room_count']  = $_POST['room_count'];
				$_SESSION['adult']  = $_POST['adult'];
				$_SESSION['child']  = $_POST['child'];
				$_SESSION['adult_count']  = array_sum($_POST['adult']);
				$_SESSION['child_count']  = array_sum($_POST['child']);
				$_SESSION['child_age']=$age;
				$cin_val = explode("-",$_SESSION['cin']);
				$cout_val = explode("-",$_SESSION['cout']);
				$diff =  strtotime($cout_val[1].'-'.$cout_val[0].'-'.$cout_val[2])- strtotime($cin_val[1].'-'.$cin_val[0].'-'.$cin_val[2]) ;
				$sec   = $diff % 60;
				$diff  = intval($diff / 60);
				$min   = $diff % 60;
				$diff  = intval($diff / 60);
				$hours = $diff % 24;
				$_SESSION['days']  = intval($diff / 24);
				$_SESSION['set_basic_session']  = TRUE;
				/**************************  set session variables  ***********************************************/
				/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
			}
							/*$_SESSION['city']  = $service->city;
							$_SESSION['cin']  = $_POST['sd'];
							$_SESSION['cout']  = $_POST['ed'];
							$_SESSION['hotel_name']  = '';
							$_SESSION['star_rate']  = '';
							$_SESSION['room_count']  = $_POST['room_count'];
							$_SESSION['adult']  = $_POST['adult'];
							$_SESSION['child']  = $_POST['child'];
							$_SESSION['adult_count']  = array_sum($_POST['adult']);
							$_SESSION['child_count']  = array_sum($_POST['child']);
							$_SESSION['child_age']=$age;
							$cin_val = explode("-",$_SESSION['cin']);
							$cout_val = explode("-",$_SESSION['cout']);
							$diff =  strtotime($cout_val[1].'-'.$cout_val[0].'-'.$cout_val[2])- strtotime($cin_val[1].'-'.$cin_val[0].'-'.$cin_val[2]) ;
							$sec   = $diff % 60;
							$diff  = intval($diff / 60);
							$min   = $diff % 60;
							$diff  = intval($diff / 60);
							$hours = $diff % 24;
							$_SESSION['days']  = intval($diff / 24);
							$_SESSION['set_basic_session']  = TRUE;*/
						
				/**************************  set session variables  ***********************************************/
				/*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^*/
		
		}
		redirect('hotel/hotel_details/'.$degree_id,'refresh');
			
	}
	function fetch_search_result_page($ses,$final)
	{ 
		//$result = array_merge_recursive($_SESSION['hotelspro_xml_data'],$_SESSION['asiantravel_xml_data']);
		$result = array_merge_recursive($_SESSION['hotelspro_xml_data'],$_SESSION['asiantravel_xml_data']);
		$result1 = $result;
		/*$hc='';
		if (isset($_SESSION['sorting'])) {
            unset($_SESSION['sorting']);
        }
    
        $hotel_name_val = $_SESSION['hotel_name'];
        $ff =  $_SESSION['hotel_xml_data'];
	     
        $temp = array();

                if($ff)
                foreach($ff as $key => $value)
                {
                    if($value['total_cost']) {
                   
                    $data['hotel_code'] = $value['hotel_code'];
                    $data['total_cost'] = $value['total_cost'];
                    $data['api'] = $value['api'];
					 $data['org_amt'] = $value['org_amt'];
                    $data['xml_currency'] = $value['xml_currency'];
                    $data['currency_val'] = $value['currency_val'];
					$data['city_code'] = $value['city_code'];
					$data['freewifi'] = $value['freewifi'];
                    $data['bestdeal'] = $value['bestdeal'];
                    $data['re_score'] = $value['re_score'];
                    $data['re_count'] = $value['re_count'];
					$data['promotion'] = $value['promotion'];
                    

                    $result = $this->check_array_element($data['hotel_code'],$temp);
                    $index = $result[0];
                    if(!empty($result))
                    {
                        if($data['total_cost'] < $temp[$index]['total_cost'])
                        {
                            unset($temp[$index]);
                            $temp[] = $data;
                        }
                    }
                    else
                    {
                        $temp[] = $data;
                    }
                }}
            

        /******************************/

        //$temp = array_values($temp);

        /*foreach($temp as $kk => $value)
        {
            $hc .= (($hc)?",'".$value['api']."_".$value['hotel_code']."'" : "'".$value['api']."_".$value['hotel_code']."'");
            if($kk==0) { $min_val = $max_val = $temp[$kk]['total_cost'];}
            if($min_val > $temp[$kk]['total_cost']) $min_val = $temp[$kk]['total_cost'];
            if($max_val < $temp[$kk]['total_cost']) $max_val = $temp[$kk]['total_cost'];


            $k = $kk;
            $data['total_cost'] = round($value['total_cost']);
            for($i=0; $i <= $k-1; $i++) {

                    if($data['total_cost'] < round($temp[$i]['total_cost'])) {
                    $tmp = $temp[$k];
                    $temp[$k] = $temp[$i];
                    $temp[$i] = $tmp;
                    }
            }

        }*/

	
		
		//Hotel mapping start
		foreach($result as $key => $value)
		{
			$temp[] = $value['mapped_id'];			
		}
		
		if(!empty($temp))
		{
			$dups = array();
			foreach(array_count_values($temp) as $val => $c)
			{
				if($c > 1 && $val != 0) 
				{								
					$dups[] = $val;
				}
			}
		
			foreach($result as $key => $value)
			{
				if(in_array($value['mapped_id'],$dups))
				{
					$response = $this->hotel_min_max_price($value['mapped_id'],$result1);
					if($value['total_cost'] != $response['min_price'])				
					{
						unset($result[$key]);
					}
					elseif($value['total_cost'] == $response['min_price'])
					{
						$result[$key]['max_price'] = $response['max_price'];
					}
				}
			}
		}
		
		////Hotel mapping end 

        $data['min_val'] =  '';
        $data['max_val'] = '';


        $data['total_record'] = 0;
        if ($_SESSION['hotel_xml_data'])
        {
			$data['own_inventory'] = $_SESSION['hotel_xml_data'];
			$data['own_inventory'] = $this->load->view('hotel/search_result_ajax_own_inventory', $data, true);
		}
		else
		{
			$data['own_inventory'] = '';
			$_SESSION['OwnInventoryHotelList'] = array();
		}
        $data['result_data'] = $result;
        $_SESSION['temp_hotels'] = $result;
   
		$hotel_search_result = $this->load->view('hotel/search_result_ajax', $data, true);
		$last = count($data['result_data'])-1;
		
		$numbers = array_map(array('hotel','get_price_values'), $data['result_data']);
		  
		//$min_val = min($numbers);
		//$max_val =  max($numbers);
		$min_val = $numbers?min($numbers):0;
		$max_val =  $numbers?max($numbers):0;
		$tot_rec =   count($data['result_data']);
		
		print json_encode(array(
		'hotel_search_result' => $hotel_search_result,
		'total_result' => $tot_rec,
		'min_val' => $min_val,
		'max_val' =>$max_val
		));
	}
	
	function hotel_min_max_price($mapped_id,$array)
	{				
		foreach($array as $key => $value)
		{					
			if($value['mapped_id'] == $mapped_id)
			{								
				$temp[] = $value['total_cost'];							
			}
		}
		$temp1 = array('min_price' => min($temp), 'max_price' => max($temp));
		return $temp1;
	}
	
	function get_price_values($details) {
		return $details['total_cost'];
	}
	
	   function check_array_element($needle,$temp)
	{
    	 foreach($temp as $key => $value)
    	 {
    	  if(in_array($needle, $value))
    	  {
    	   return array($key);
    	  }
    	 }
	 return false;
	}
		function fetch_search_result_room__($sec_id,$degree_id,$final,$api__org)
	{
		$data['api__org']=$api__org;
			            $service=$this->Api_Model->get_searchresult_new_table($degree_id);		
						$api_r=array();
						$api_r1=array();
						$result=array();
						$result_api=array();
					
						$RetailRate='';
						$NetRate=array();
						//echo '<pre/>';
						//print_r($service);exit;
						
						$apig = $this->Hotel_Model->api_status_id($this->domain);
						$api_rg='';
						$api_r1g='';
						if($apig != '')
						{
							for($k=0;$k<count($apig);$k++)
							{	
							if($apig[$k]->api_name !='ticket_evolution' && $apig[$k]->api_name !='Carsolize')
							{
									$api_rg[]= "'".$apig[$k]->api_name."'";
									$api_r1g[]= $apig[$k]->api_name;
							}
							}
						
						}
						
						$final_chk  = (count($api_r1g)-1);
	    $data['set_basic_session'] ='2';
		$data['ses_id'] =$_SESSION['session_data_id'];
		$data['hotel_id_val']=$degree_id;
		$data['api_fs'] = implode(",",$api_rg);
						$data['api'] = implode(",",$api_r1g);
						
		if($final==1)
	{

						$api1 = $this->Hotel_Model->api_status_id($this->domain);
						$api=array();
						$api=$api_r1g;
					//	print_r($api);exit;
						if($api != '')
						{
							for($k=0;$k<count($api);$k++)
							{	
//							$api_r[]= "'".$api[$k]->api_name."'";
									//$api_r1[]= $api[$k]->api_name;
									
									$api_r[]= "'".$api[$k]."'";
									$api_r1[]= $api[$k];
									//echo $sec_id.'-'.$service->hotelid_t.'-'.$api[$k]->api_name;exit;
									$result[] = $this->Hotel_Model->fetch_gta_temp_result_room_apiwise($sec_id,$service->hotelid_t,$api[$k]);
							
									if($api[$k] == 'Priceline')
									{
										

									$result_p = $this->Hotel_Model->fetch_gta_temp_result_room_apiwise($sec_id,$service->hotelid_t,$api[$k]);
							//	echo '<pre/>';
							//	print_r($result_p);exit;
										if(isset($result_p[0]))
										{
										
										$RetailRate = $result_p[0]->total_cost;
										//echo $RetailRate.'-';
										}
									}
									else
									{

										if(isset($result[$k][0]))
										{
											
										  $NetRate[$result[$k][0]->api_temp_hotel_id] = $result[$k][0]->inoffcode_v1;
										//  echo '+++'.$result[$k][0]->total_cost.'+++';
									
										  $result_api[] = $this->Hotel_Model->fetch_gta_temp_result_room_apiwise($sec_id,$service->hotelid_t,$api[$k]);
										  
										
										}
									}
				
							}
							$api_f = implode(",",$api_r);
							$api_f1 = implode(",",$api_r1);
						}
						else
						{
							$api_f="'Nil'";
							$api_f1='';
						}
						
						$data['api_fs'] =$api_f;
						$data['api'] =$api_f1;
				echo '<pre/>';	
				echo $RetailRate;
			print_r($result_api);exit;

	
		$mr_i =0;


	if($RetailRate!='')
	{
		foreach($NetRate as $rowval)
		{
			
			$Margin[$mr_i] = $RetailRate - $rowval;
			$mr_i++;
		}
		

$mostProfit=0;
if(isset($Margin))
{
for ($i = 1; $i < count($Margin); $i++)
{

		if ($Margin[$i] > $Margin[$i-1])
		{
			$mostProfit = $i; //Most profit represents the XML feed with the highest margin
		}
	
}

if (($RetailRate * 0.12) >= $Margin[$mostProfit])
{
	
$MostProfit_val =($RetailRate * 0.12);
}
else
{

$MostProfit_val = $Margin[$mostProfit]; //Product with highest margin, if 12% margin or lower defaults to Priceline Inventory
}
}


if(!isset($MostProfit_val))
{
$MostProfit_val=0;
}
//echo $RetailRate;exit;

$percen =  ($MostProfit_val/$RetailRate)*100;
$biz_value = $this->Hotel_Model->get_biz_margin_details();

if($percen == '0')
{
	$percen_f = ($percen-$biz_value[0]->value)/100;
}
elseif($percen <= '12')
{

	$percen_f = ($percen-$biz_value[0]->value)/100;
}
elseif($percen > '12' && $percen <= '20')
{
	
	$percen_f =  ($percen-$biz_value[1]->value)/100;
}
elseif($percen > '20' && $percen <= '26')
{
	
	$percen_f =  ($percen-$biz_value[2]->value)/100;
}
elseif($percen > '26' && $percen <= '31')
{
	
	$percen_f =  ($percen-$biz_value[3]->value)/100;
}

elseif($percen > '31' && $percen <= '35')
{
	
	$percen_f =  ($percen-$biz_value[4]->value)/100;
}
elseif($percen > '35')
{
	
	$percen_f =  ($biz_value[5]->value)/100;
	//$percen_f =  ($percen-$biz_value[5]->value)/100;
}

//echo '****'.$percen_f.'****';
//echo '<pre/>';

//echo '<pre/>';
//print_r($result_api);
//print_r($result_p);
//echo $percen_f.'<br>';
//echo $percen.'<br>';
///echo $RetailRate.'<br>';
//echo $biz_value[0]->value;exit;
echo $percen.'-'.$percen_f;exit;

if($percen > 12)
{


	//echo 'ssss';exit;
		$markup =  ($biz_value[6]->value)/100;
   	for ($i = 0; $i < count($result_api); $i++)
		{
			for ($li = 0; $li < count($result_api[$i]); $li++)
			{
			//echo $RetailRate.'----';
			//	echo $percen_f.'----';
			//echo $result_api[$i][$li]->total_cost.'---';
				//echo $result_api[$i][$li]->total_cost.'-'.$RetailRate.'-'.$percen_f;
			//important    RetailRate
			$tot_p=number_format((($result_api[$i][$li]->total_cost*$percen_f)+$result_api[$i][$li]->total_cost), 2, '.', '');
			$inoffcode_v1_val=number_format((($result_api[$i][$li]->inoffcode_v1*$percen_f)+$result_api[$i][$li]->inoffcode_v1), 2, '.', '');
			//	$tot_p=number_format((($result_api[$i][$li]->total_cost*$markup)+$result_api[$i][$li]->total_cost), 2, '.', '');
				
			//	echo '===='.$tot_p;exit;
				$this->Hotel_Model->update_markup_rate($tot_p,$result_api[$i][$li]->api_temp_hotel_id,$inoffcode_v1_val);
			}
		}
}
else
{
	
//echo 'sada';exit;
			for ($i = 0; $i < count($result_p); $i++)
			{
				//echo 'sda';exit;
				$percen_fv = $biz_value[0]->value/100;
		//		echo $percen_fv.'-';
		//		echo $result_p[$i]->total_cost.'-';
				//$tot_p=number_format((($RetailRate*$percen_f)+$result_p[$i]->total_cost), 2, '.', '');
				$tot_p=number_format(($result_p[$i]->total_cost - ($result_p[$i]->total_cost*$percen_fv)), 2, '.', '');
  // 	echo $tot_p;exit;
		
		//$tot_p = $result_p[$i]->total_cost;
$this->Hotel_Model->update_markup_rate($tot_p,$result_p[$i]->api_temp_hotel_id);
	$this->Hotel_Model->insert_biz_rule_alert($this->domain,$result_p[$i]->degree_id,$result_p[$i]->room_type,$tot_p,$result_p[$i]->w_markup,$_SESSION['cin'],$_SESSION['cout']);
		
		}



	}

/*if($percen < 12)
{
	
   // echo $percen;exit;
	$percen = ($percen+$biz_value)/100;
	//echo '44'.$percen.'<br>';

	
		for ($i = 0; $i < count($result_api); $i++)
		{
			
			for ($li = 0; $li < count($result_api[$i]); $li++)
			{
					//echo $result_api[$i][$li]->total_cost.'//';
					echo $result_api[$i][$li]->total_cost.'@#@';
				$tot_p=number_format((($RetailRate*$percen)+$result_api[$i][$li]->total_cost), 2, '.', '');
				echo $tot_p;exit;
				$this->Hotel_Model->update_markup_rate($tot_p,$result_api[$i][$li]->api_temp_hotel_id);
			}
		}
}
else
{
	
			$percen = ($percen+$biz_value)/100;
			

			for ($i = 0; $i < count($result_api); $i++)
			{
				echo $MostProfit_val.'/'.$RetailRate.'<br>';
		$profitPercentage = 1 - ($MostProfit_val / $RetailRate);
echo $profitPercentage;exit;
		if ($profitPercentage >= 0.35)
		{
		$RetailRate = ($result_p[$i]->total_cost * 0.95); //this give you the SELL Rate if the margin is 35% or higher

		}
		elseif ($profitPercentage >= 0.30)
		{
		$RetailRate = ($result_p[$i]->total_cost * 0.965); // SELL Rate if the margin between 30% and 34%
		}
		elseif ($profitPercentage >= 0.25)
		{
		$RetailRate = ($result_p[$i]->total_cost * 0.975); // SELL Rate if the margin between 25% and 29%
		}
		elseif ($profitPercentage >= 0.20)
		{
		$RetailRate = ($result_p[$i]->total_cost * 0.98); // SELL Rate if the margin between 20% and 24%
		}
		else
		{
		
		$RetailRate = ($result_p[$i]->total_cost * 0.99); // SELL Rate if the margin is less than 20%
		}
			
		
		$tot_p=number_format(($RetailRate), 2, '.', '');
		
		//$tot_p = $result_p[$i]->total_cost;
	$this->Hotel_Model->update_markup_rate($tot_p,$result_p[$i]->api_temp_hotel_id);
	$this->Hotel_Model->insert_biz_rule_alert($this->domain,$result_p[$i]->degree_id,$result_p[$i]->room_type,$tot_p,$result_p[$i]->w_markup,$_SESSION['cin'],$_SESSION['cout']);
		
		}

}*/
	}
	}
//echo '<pre/>';
	//print_r($data);exit;
	   // echo $final;exit;
		$data['final']=$final;
		
		$room_result = $this->load->view('hotel/hotel_detail_room_info',$data,true);
	
		print json_encode(array(
				'room_result' => $room_result
			));			
			
			
	}
	function fetch_search_result_room($sec_id,$hotel_code,$api)
	{
		
	    $data['set_basic_session'] ='2';
		$data['ses_id'] =$_SESSION['session_data_id'];
		
				
		$data['hotel_id_val']=$hotel_code;
		
		
		if(isset($api) && $api!= '')
		{
	
			$this->load->model($api.'_Model');
			$room_result = $this->load->view('hotel/'.$api.'/hotel_detail_room_info',$data,true);

			print json_encode(array(
				'room_result' => $room_result
			));	
		}		
			
			
	}
	
	function fetch_search_result_room_nov28($sec_id,$degree_id,$final)
	{
			            $service=$this->Api_Model->get_searchresult_new_table($degree_id);		
						$api_r=array();
						$api_r1=array();
						$result=array();
						$result_api=array();
					
						$RetailRate='';
						$NetRate=array();
						//echo '<pre/>';
						//print_r($service);exit;
						$api1 = $this->Hotel_Model->api_status_id($this->domain);
						$api=array('Priceline','Gta','Hotelbeds');
						if($api != '')
						{
							for($k=0;$k<count($api);$k++)
							{	
//							$api_r[]= "'".$api[$k]->api_name."'";
									//$api_r1[]= $api[$k]->api_name;
									
									$api_r[]= "'".$api[$k]."'";
									$api_r1[]= $api[$k];
									//echo $sec_id.'-'.$service->hotelid_t.'-'.$api[$k]->api_name;exit;
									$result[] = $this->Hotel_Model->fetch_gta_temp_result_room_apiwise($sec_id,$service->hotelid_t,$api[$k]);
  
									if($api[$k] == 'Priceline')
									{
										

									$result_p = $this->Hotel_Model->fetch_gta_temp_result_room_apiwise($sec_id,$service->hotelid_t,$api[$k]);
								
										if(isset($result_p[0]))
										{
										
										$RetailRate = $result_p[0]->total_cost;
										//echo $RetailRate.'-';
										}
									}
									else
									{

										if(isset($result[$k][0]))
										{
											
										  $NetRate[$result[$k][0]->api_temp_hotel_id] = $result[$k][0]->total_cost;
										//  echo '+++'.$result[$k][0]->total_cost.'+++';
										  $result_api[] = $this->Hotel_Model->fetch_gta_temp_result_room_apiwise($sec_id,$service->hotelid_t,$api[$k]);
										
										}
									}
				
							}
							$api_f = implode(",",$api_r);
							$api_f1 = implode(",",$api_r1);
						}
						else
						{
							$api_f="'Nil'";
							$api_f1='';
						}
						
						$data['api_fs'] =$api_f;
						$data['api'] =$api_f1;
				//	echo '<pre/>';	
				//	print_r($result_api);exit;

		$data['set_basic_session'] ='2';
		$data['ses_id'] =$_SESSION['session_data_id'];
		$data['hotel_id_val']=$degree_id;
		$mr_i =0;
		


	if($RetailRate!='')
	{
		foreach($NetRate as $rowval)
		{
			
			$Margin[$mr_i] = $RetailRate - $rowval;
			$mr_i++;
		}
		

$mostProfit=0;
if(isset($Margin))
{
for ($i = 1; $i < count($Margin); $i++)
{

		if ($Margin[$i] > $Margin[$i-1])
		{
			$mostProfit = $i; //Most profit represents the XML feed with the highest margin
		}
	
}

if (($RetailRate * 0.12) >= $Margin[$mostProfit])
{
	
$MostProfit_val =($RetailRate * 0.12);
}
else
{

$MostProfit_val = $Margin[$mostProfit]; //Product with highest margin, if 12% margin or lower defaults to Priceline Inventory
}
}


if(!isset($MostProfit_val))
{
$MostProfit_val=0;
}
//echo $RetailRate;exit;

$percen =  ($MostProfit_val/$RetailRate)*100;
$biz_value = $this->Hotel_Model->get_biz_margin_details();

if($percen >= 0 && $percen <= 12)
{
	$percen_f = ($percen-$biz_value[0]->value)/100;
}
elseif($percen >= 13 && $percen <= 20)
{
	$percen_f =  ($percen-$biz_value[1]->value)/100;
}
elseif($percen >= 21 && $percen <= 25)
{
	$percen_f =  ($percen-$biz_value[2]->value)/100;
}
elseif($percen >= 26 && $percen <= 30)
{
	$percen_f =  ($percen-$biz_value[3]->value)/100;
}

elseif($percen >= 31 && $percen <= 35)
{
	$percen_f =  ($percen-$biz_value[4]->value)/100;
}
elseif($percen > 35)
{
	
	$percen_f =  ($percen-$biz_value[5]->value)/100;
}


if($percen > 12)
{
	
   	for ($i = 0; $i < count($result_api); $i++)
		{
			for ($li = 0; $li < count($result_api[$i]); $li++)
			{
				
				$tot_p=number_format((($RetailRate*$percen_f)+$result_api[$i][$li]->total_cost), 2, '.', '');
				
				$this->Hotel_Model->update_markup_rate($tot_p,$result_api[$i][$li]->api_temp_hotel_id);
			}
		}
}
else
{
	

			for ($i = 0; $i < count($result_p); $i++)
			{
				
				$tot_p=number_format((($RetailRate*$percen_f)+$result_p[$i]->total_cost), 2, '.', '');
	//		echo $tot_p;exit;
		
		//$tot_p = $result_p[$i]->total_cost;
	$this->Hotel_Model->update_markup_rate($tot_p,$result_p[$i]->api_temp_hotel_id);
	$this->Hotel_Model->insert_biz_rule_alert($this->domain,$result_p[$i]->degree_id,$result_p[$i]->room_type,$tot_p,$result_p[$i]->w_markup,$_SESSION['cin'],$_SESSION['cout']);
		
		}



	}

/*if($percen < 12)
{
	
   // echo $percen;exit;
	$percen = ($percen+$biz_value)/100;
	//echo '44'.$percen.'<br>';

	
		for ($i = 0; $i < count($result_api); $i++)
		{
			
			for ($li = 0; $li < count($result_api[$i]); $li++)
			{
					//echo $result_api[$i][$li]->total_cost.'//';
					echo $result_api[$i][$li]->total_cost.'@#@';
				$tot_p=number_format((($RetailRate*$percen)+$result_api[$i][$li]->total_cost), 2, '.', '');
				echo $tot_p;exit;
				$this->Hotel_Model->update_markup_rate($tot_p,$result_api[$i][$li]->api_temp_hotel_id);
			}
		}
}
else
{
	
			$percen = ($percen+$biz_value)/100;
			

			for ($i = 0; $i < count($result_api); $i++)
			{
				echo $MostProfit_val.'/'.$RetailRate.'<br>';
		$profitPercentage = 1 - ($MostProfit_val / $RetailRate);
echo $profitPercentage;exit;
		if ($profitPercentage >= 0.35)
		{
		$RetailRate = ($result_p[$i]->total_cost * 0.95); //this give you the SELL Rate if the margin is 35% or higher

		}
		elseif ($profitPercentage >= 0.30)
		{
		$RetailRate = ($result_p[$i]->total_cost * 0.965); // SELL Rate if the margin between 30% and 34%
		}
		elseif ($profitPercentage >= 0.25)
		{
		$RetailRate = ($result_p[$i]->total_cost * 0.975); // SELL Rate if the margin between 25% and 29%
		}
		elseif ($profitPercentage >= 0.20)
		{
		$RetailRate = ($result_p[$i]->total_cost * 0.98); // SELL Rate if the margin between 20% and 24%
		}
		else
		{
		
		$RetailRate = ($result_p[$i]->total_cost * 0.99); // SELL Rate if the margin is less than 20%
		}
			
		
		$tot_p=number_format(($RetailRate), 2, '.', '');
		
		//$tot_p = $result_p[$i]->total_cost;
	$this->Hotel_Model->update_markup_rate($tot_p,$result_p[$i]->api_temp_hotel_id);
	$this->Hotel_Model->insert_biz_rule_alert($this->domain,$result_p[$i]->degree_id,$result_p[$i]->room_type,$tot_p,$result_p[$i]->w_markup,$_SESSION['cin'],$_SESSION['cout']);
		
		}

}*/
	}
	
	   // echo $final;exit;
		$data['final']=$final;
		
		$room_result = $this->load->view('hotel/hotel_detail_room_info',$data,true);
	
		print json_encode(array(
				'room_result' => $room_result
			));			
			
			
	}
	function fetch_search_result() 
	{
		
		if(isset($_SESSION['city_code']) && $_SESSION['city_code']!='')
			{
				
				$tmp_data  =  $this->Api_Model->fetch_search_result_all($_SESSION['city_code']);
			}
			else
			{
				$tmp_data  =  '';
			}
		//	echo '<pre/>';
		//	print_r($tmp_data);exit;
	
		$data['result'] = $tmp_data['result'];
		$hotel_search_result = $this->load->view('hotel/search_result_ajax', $data, true);
		$min_val = $tmp_data['minVal'];
		$max_val = $tmp_data['maxVal'];
		$tot_rec = $tmp_data['totRow'];
		//$min_val = floor($tmp_data['minVal']);
		//$max_val = round($tmp_data['maxVal']);
		//$tot_rec = $tmp_data['totRow'];
	
		print json_encode(array(
				'hotel_search_result' => $hotel_search_result,
				'total_result' => $tot_rec,
				'min_val' => $min_val,
				'max_val' =>$max_val	
			));
	}
	function fetch_search_result_hotels($limit) 
	{
		
	
		
		if(isset($_SESSION['city_code']) && $_SESSION['city_code']!='')
			{
				$result =  $this->Api_Model->fetch_search_result_all($_SESSION['city_code'],$limit);
				$data['result'] =$result['result'];
			
			}
			else
			{
				$data['result']  =  '';
			}
		//	echo '<pre/>';
		//	print_r($tmp_data);exit;
	
		//$data['result'] = $tmp_data['result'];
		$hotel_search_result = $this->load->view('hotel/search_result_ajax_hotels', $data, true);
	
		$min_val = 0;
		$max_val = 0;
		$tot_rec = $limit;
		//$min_val = floor($tmp_data['minVal']);
		//$max_val = round($tmp_data['maxVal']);
		//$tot_rec = $tmp_data['totRow'];
	
		print json_encode(array(
				'hotel_search_result' => $hotel_search_result,
				'total_result' => $tot_rec,
				'min_val' => $min_val,
				'max_val' =>$max_val	
			));
	}
	function hotel_details($id,$api_encode='')
	{
		$api = base64_decode($api_encode);
		//$api= 'Asiantravel';
		if(isset($_SESSION['session_data_id']))
		{
			if($api!='')
			{
				switch(strtolower($api))
				{
					case 'own':
						$select = "SELECT  * FROM hotel_search_list WHERE HotelCode = '$id'";
						$query = $this->db->query($select);
						if($query->num_rows() == '' ){
							 $service = '';
						}
						else
						{
							$service= $query->row();
						}
						/*$this->db->select('*');
						$this->db->from('asia_hotels_deatil');
						$this->db->where('HotelId',$id);
						$query = $this->db->get();
						if($query->num_rows() == '' )
						{
							$servicess='';
						}
						else
						{
							$servicess= $query->row(); 
						}*/
						if($service!='')
						{
							$hotel_code = $service->HotelCode;
							$hotel_name = $service->HotelName;
							$star = $service->StarRating;
							$image = $service->FrontPgImage;
							$data['service']=$service;
							$data['hotelCode']=$hotel_code;
							$data['star']=$service->StarRating;
							$data['phone']=$service->ContactNo ;
							/*$data['location']=$servicess->location;
							$data['lat']=$servicess->latitude;
							$data['long']=$servicess->longitude;*/
							$data['location'] = '';
							$data['lat'] = '';
							$data['long'] = '';
							$data['hotel_name'] = $service->HotelName;
							$data['description'] = $service->HotelDesc;
							$data['address'] = $service->Address;
							$data['dest'] = $service->City ;
							$data['result_id']=$id;
							$data['cur_id'] = $id;
							if($data['lat'] !='' && $data['long']!='')
							{
									$data['nearby_hotel']='';
							}
							else
							{
								$data['nearby_hotel']='';
							}
							$this->load->model('Hotelbeds_Model');
							$this->load->view('hotel/OwnInventory/hotel_detail',$data);
						}
					break;
					default:
					$data['id']=$id;
					$data['api']=$api;
					$this->load->model($api.'_Model');
					$this->load->view('hotel/'.$api.'/hotel_detail',$data);
				}
			}
			else
			{
				$service = $this->Hotel_Model->get_permanent_details_v3($id);
				$data['hotel_details']= $service;
				if(isset($service) && $service!= '')
				{
					$api_r=array();
					$api_r1=array();
					$api = $this->Hotel_Model->api_status_id($this->domain);
					if($api != '')
					{
						for($k=0;$k<count($api);$k++)
						{
							$api_r[]= "'".$api[$k]->api_name."'";
							$api_r1[]= $api[$k]->api_name;
						}
						$api_f = implode(",",$api_r);
						$api_f1 = implode(",",$api_r1);
					}
					else
					{
						$api_f="'Nil'";
						$api_f1='';
					}
					$data['api_fs'] =$api_f;
					$data['api'] =$api_f1;
					$this->load->view('hotel/hotel_detail',$data);
				}
			}
		}
		else
		{
			$this->load->view('hotel/others/session_expiry');
		}
	}
	
	function hotel_booking($result_id,$hotel_id,$status='')
	{
		$data['result']=$this->Hotel_Model->fetch_temp_result_room_id($result_id);	
		
		if(isset($data['result']->api_temp_hotel_id))
		{
		$data['service']=$this->Hotel_Model->get_permanent_details_v3($hotel_id,$data['result']->api);		
		
		$data['result_id']=$result_id;
		$data['hotel_id']=$hotel_id;
		
		$data['id']=$hotel_id;
		$data['api']=$data['result']->api;
		
			if($status!='')
			{
				$data['status']='Login Failed';
			}
			if(isset($data['result']->api) && $data['result']->api!= '')
			{
				$this->load->model($data['result']->api.'_Model');
				$this->load->view('hotel/'.$data['result']->api.'/booking',$data);
					
			}
		}
		else
		{

			$this->load->view('hotel/others/session_expiry');
		}
		//$this->load->view('hotel/booking',$data );
				
		
	}
		function hotel_booking_v1($result_id,$hotel_id)
	{
		//echo '<pre/>';
		//print_r($this->session->userdata);exit;
		$data['result']=$this->Hotel_Model->fetch_temp_result_room_id($result_id);		
		
		if(isset($data['result']->api_temp_hotel_id))
		{
		
		$data['result_id']=$result_id;
		
		$data['room_info']=$this->Hotel_Model->fetch_temp_result_room_id_v1($result_id);		
		
			$data['hotel_id']=$hotel_id;
			$booking_type = $this->input->post('booking_type');
			
			if($booking_type == 'guest_booking')
			{
				$guest_email = $this->input->post('guest_email');
							$sessionUserInfo = array( 
								'guest_id' 		=> '',
								'guest_email'	 => $guest_email,
								'guest_type' 		=> 4,
								'guest_logged_in' 	=> TRUE,
								'guest_firstname'  => 'Guest',
								'guest_lastname'  => 'Guest',
								);
								$this->session->set_userdata($sessionUserInfo);
					
				$customer_user_email = $this->input->post('guest_email');
				$data['totalrooms']=$_SESSION['room_count'];
			$data['adult']=$_SESSION['adult_count'];
			$data['adults']=$_SESSION['adult_count'];
			$data['price']=$_POST['price'];
			/* ------------- contact details ------*/
			$data['address']='';
			$data['contact_no']='';
			$data['city']='';
			$data['country']='';
			$data['postal_code']='';
			$data['title']='';
			$data['firstname']='';
			$data['lastname']='';
			/* ------------- contact details ------*/
		
			$data['customer_user_email']=$customer_user_email;
			$this->load->view('hotel/booking_v1',$data );
			}
			elseif($booking_type == 'user_booking')
			{
				$domain_id = $this->Account_Model->get_domain_list_id($this->domain);
					 $res = $this
							  ->Account_Model
							  ->check_admin_login(
								 $this->input->post('user_name'), 
								 $this->input->post('user_password'),
								 $domain_id->domain_id
							  ); 
							  
							//  echo '<pre/>';
							//  print_r($res);exit;
					 if ( $res !== false ) 
					 {
						   
						 
								$sessionUserInfo = array( 
								'b2c_id' 		=> $res->user_id,
								'b2c_email'	 			=> $res->email,
								'b2c_type' 		=> $res->usertype,
								'b2c_logged_in' 	=> TRUE,
								'b2c_firstname'  => $res->firstname,
								'b2c_lastname'  => $res->lastname,
								);
								$this->session->set_userdata($sessionUserInfo);
								$data['totalrooms']=$_SESSION['room_count'];
			$data['adult']=$_SESSION['adult_count'];
			$data['adults']=$_SESSION['adult_count'];
			$data['price']=$_POST['price'];
			/* ------------- contact details ------*/
			$data['address']=$res->address;
			$data['contact_no']=$res->contact_no;
			$data['city']=$res->city;
			$data['country']=$res->country;
			$data['postal_code']=$res->postal_code;
			$data['title']=$res->title;
			$data['firstname']=$res->firstname;
			$data['lastname']=$res->lastname;
			/* ------------- contact details ------*/
			
			
		 $customer_user_email = $this->input->post('user_name');
			$data['customer_user_email']=$customer_user_email;
			$this->load->view('hotel/booking_v1',$data );
			
					 }
					 else
					 {
						 $status ='Failed';
						redirect("hotel/hotel_booking/".$result_id."/".$hotel_id."/".$status, 'refresh');
				
					 }
					 
					
				
			}
			elseif($booking_type == 'b2c')
			{
				
				$customer_user_email=$this->session->userdata('b2c_email');
				$data['totalrooms']=$_SESSION['room_count'];
			$data['adult']=$_SESSION['adult_count'];
			$data['adults']=$_SESSION['adult_count'];
			$data['price']=$_POST['price'];
			 $res = $this
							  ->Account_Model
							  ->check_userdata($customer_user_email);
			
		/* ------------- contact details ------*/
			$data['address']=$res->address;
			$data['contact_no']=$res->contact_no;
			$data['city']=$res->city;
			$data['country']=$res->country;
			$data['postal_code']=$res->postal_code;
			$data['title']=$res->title;
			$data['firstname']=$res->firstname;
			$data['lastname']=$res->lastname;
			/* ------------- contact details ------*/
			$data['customer_user_email']=$customer_user_email;
			$this->load->view('hotel/booking_v1',$data );
			}
			elseif($booking_type == 'b2b')
			{
				
				$customer_user_email=$this->session->userdata('b2b_email');
				$data['totalrooms']=$_SESSION['room_count'];
			$data['adult']=$_SESSION['adult_count'];
			$data['adults']=$_SESSION['adult_count'];
			$data['price']=$_POST['price'];
		 $res = $this
							  ->Account_Model
							  ->check_userdata_b2b($customer_user_email);
			//echo '<pre/>';
		//	print_r($res);exit;
		/* ------------- contact details ------*/
			$data['address']=$res->address;
			$data['contact_no']=$res->office_phone;
			$data['city']=$res->city;
			$data['country']=$res->country;
			$data['postal_code']=$res->postal_code;
			$data['title']='';
			$data['firstname']=$res->name;
			$data['lastname']=$res->name;
			/* ------------- contact details ------*/
			$data['customer_user_email']=$customer_user_email;
			$this->load->view('hotel/booking_v1',$data );
			}
			else
			{
				$customer_user_email='';
				$this->load->view('hotel/others/404-error');
			}
		}
		else
		{

			$this->load->view('hotel/others/session_expiry');
		}
	
		
	}
		
	function hotel_detail_only($id)
	{
		$data['service']=$this->Api_Model->get_searchresult_new_table($id);		
		$data['service_image']=$this->Api_Model->get_searchresult_new_table_image($data['service']->hotelid_b,$data['service']->hotelid_t);		
		$data['service_review']=$this->Hotel_Model->getting_review_count($data['service']->hotelid_b,$data['service']->hotelid_t);		
		$data['hotel_id_val']=$id;
		$data['hotelid_b'] = $data['service']->hotelid_b;
		$data['hotelid_t'] = $data['service']->hotelid_t;
		
	
		//$this->Api_Model->delete_temp_data($_SESSION['session_data_id']);
		$data['nearby']=$this->Priceline_Model->hotel_nearby($data['service']->hotelid_ppn,1);	


		$data['review']=$this->Priceline_Model->hotel_review($data['service']->hotelid_b,$data['service']->hotelid_t,1);	
	if(isset($_SESSION['session_data_id']))
	{
		$data['cart_result'] = $this->Cart_Model->fetch_cart_search_result_db_v1($_SESSION['session_data_id']);
	
	
		if($this->session->userdata('b2c_logged_in'))
		{
		$b_id = $this->session->userdata('b2c_id');
		$b_type = $this->session->userdata('b2c_type');
		}
		elseif($this->session->userdata('b2b_logged_in'))
		{
		$b_id = $this->session->userdata('b2b_id');
		$b_type = $this->session->userdata('b2b_type');
		}
		else
		{
			$b_id =0;
			$b_type =0;
			
		}

		$data['cartcount'] = $this->Account_Model->cart_count_status($b_id,$b_type);
	}
	else
	{
		$data['cart_result'] ='';
		$data['cartcount'] =0;
	}
		//echo '<pre/>';
		//print_r($data);exit;
		$this->load->view('hotel/hotel_detail_only',$data);
	}
	function display_hotel_room($id)
	{
		$service=$this->Api_Model->get_searchresult($id);		
		$data['api'] = $service->api;
		$data['hotel_code'] = $service->hotel_code;
		$data['ses_id'] = $service->session_id;
		$room_result = $this->load->view('hotel/search_result_ajax_room',$data, true);
		print json_encode(array(
				'room_result' => $room_result
			));
	}
	function fetch_search_result_map()
	{
		
	$query=$this->Hotel_Model->fetch_search_result_map_new();
	
	
	$map_data = array();
	$cnt=0;
	for($k=0;$k< count($query);$k++)
	{
	
	$map_data[$cnt]['lat'] = $query[$k]['latitude'];
	$map_data[$cnt]['lng'] = $query[$k]['longitude'];
	$map_data[$cnt]['name'] = $query[$k]['hotel_name'];
	$star = $query[$k]['star'];
	
	if($star==1)
	{
		$st ="<img src='".WEB_HOTEL_DIR."images/1 star.jpg' />";
	}
	elseif($star==2)
	{
		$st ="<img src='".WEB_HOTEL_DIR."images/2 star.jpg' />";
	}
	elseif($star==3)
	{
		$st ="<img src='".WEB_HOTEL_DIR."images/3 star.jpg' />";
	}
	elseif($star==4)
	{
		$st ="<img src='".WEB_HOTEL_DIR."images/4 star.jpg' />";
	}
	elseif($star==5)
	{
		$st ="<img src='".WEB_HOTEL_DIR."images/5 star.jpg' />";
	}
	else
	{
		$st ="<img src='".WEB_HOTEL_DIR."images/0 star copy.jpg' />";
	}
	$info = "<div id='mapdetailsbox2'><div id='imgbox2'><img src='' width='70px' height='70px' /></div><div id='hotelname2'>" . $query[$k]['hotel_name'] . "</div>"; 
	$info.="<div id='star2'> ".$st." </div> <div id='avalabletxt2'> Avalable From</div><div id='doller2'>" . $query[$k]['low_cost'] . "</div><div id='pernight2'> Per Night</div><div style='clear:both'></div></div>";
	$map_data[$cnt]['info'] = $info;
	$cnt++;
	}
	
	echo json_encode($map_data);
	
	
	}
	function mapping_fun($id)
	{
		
			
		$data['result']=$this->Hotel_Model->fetch_search_result_map_new_select_session_id($_SESSION['city_code'],$id);
		
		
		$this->load->view('map/map_all',$data);
		
	}
	function fetch_search_result_map_select($id)
	{
		
$query=$this->Hotel_Model->fetch_search_result_map_new_select($id);
$map_data = array();
$cnt=0;
for($k=0;$k< count($query);$k++)
{
	
	$map_data[$cnt]['lat'] = $query[$k]['latitude'];
	$map_data[$cnt]['lng'] = $query[$k]['longitude'];
	$map_data[$cnt]['name'] = $query[$k]['hotel_name'];
	$star = $query[$k]['star'];
	
if($star==1)
{
$st ="<img src='".WEB_HOTEL_DIR."images/1 star.jpg' />";
}
elseif($star==2)
{
$st ="<img src='".WEB_HOTEL_DIR."images/2 star.jpg' />";
}
elseif($star==3)
{
$st ="<img src='".WEB_HOTEL_DIR."images/3 star.jpg' />";
}
elseif($star==4)
{
$st ="<img src='".WEB_HOTEL_DIR."images/4 star.jpg' />";
}
elseif($star==5)
{
$st ="<img src='".WEB_HOTEL_DIR."images/5 star.jpg' />";
}
else
{
$st ="<img src='".WEB_HOTEL_DIR."images/0 star copy.jpg' />";

}
	$info = "<div id='mapdetailsbox2'><div id='imgbox2'><img src='' width='70px' height='70px' /></div><div id='hotelname2'>" . $query[$k]['hotel_name'] . "</div>"; 
	$info.="<div id='star2'> ".$st." </div> <div id='avalabletxt2'> Avalable From</div><div id='doller2'>" . $query[$k]['low_cost'] . "</div><div id='pernight2'> Per Night</div><div style='clear:both'></div></div>";
	$map_data[$cnt]['info'] = $info;
	$cnt++;
}

echo json_encode($map_data);


	}
	
	function mapping_fun_all()
	{
		$data['result']=$this->Hotel_Model->fetch_search_result_map_new_select_session($_SESSION['city_code']);
		$this->load->view('map/map_all',$data);
	}
	function set_counter_session($time_in_seconds)
	{
	
					if (isset($time_in_seconds)) {$_SESSION['time_in_seconds'] = $time_in_seconds; }
		
	}
	function reservation($parent_pnr_no,$pdf_ehck='')
	{
		
		
			
			
			
			
		$data['parent_no'] = $parent_pnr_no; 
		
		
		
		if($pdf_ehck == '')
		{
		$this->voucher_sendemail($parent_pnr_no);
		}
		
		$data['result']=$this->Hotel_Model->get_reservation_details_id($parent_pnr_no);
		$data['hotel_result']=$this->Hotel_Model->get_reservation_details_hotel($data['result']->product_id);
		
						$this->session->unset_userdata('guest_id');
						$this->session->unset_userdata('guest_email');
						$this->session->unset_userdata('guest_type');
						$this->session->unset_userdata('guest_logged_in');
						$this->session->unset_userdata('guest_firstname');
						$this->session->unset_userdata('guest_lastname');
					

		
		$this->load->view('hotel/voucher',$data);
		
	}
	
	function voucher_id($parent_pnr_no)
	{
		
		$data['parent_no'] = $parent_pnr_no; 
		$data['result']=$this->Hotel_Model->get_reservation_details_id($parent_pnr_no);
		$this->load->view('hotel/reservation_print',$data);
		
	}
		function voucher_print($parent_pnr_no)
	{
		
		$data['parent_no'] = $parent_pnr_no; 
		$data['result']=$this->Hotel_Model->get_reservation_details_id($parent_pnr_no);
		$this->load->view('hotel/reservation_print',$data);
		
	}
	
		function voucher_allprint($parent_pnr_no)
	{
		
		$data['parent_no'] = $parent_pnr_no; 
	 $data['result']=$this->Hotel_Model->get_reservation_details($parent_pnr_no);
		$this->load->view('hotel/reservation_totalprint',$data);
		
	}
	
	function voucher_sendemail($parent_no)
	{
		
		
		$data['result']=$this->Hotel_Model->get_reservation_details_id($parent_no);
		$data['hotel_result']=$this->Hotel_Model->get_reservation_details_hotel($data['result']->product_id);
		
		
		
		
		
	  $this->load->model('Email_Model');
	  $email='';
	  if($this->session->userdata('guest_email') && $this->session->userdata('guest_email')!= '')
	  {
		  $email = $this->session->userdata('guest_email');
		  $name = 'Guest';
	  }
	  elseif($this->session->userdata('b2c_email') &&  $this->session->userdata('b2c_email')!= '')
	  {
		  $email = $this->session->userdata('b2c_email');
		   $name = $this->session->userdata('b2c_firstname');
	  }
	  elseif($this->session->userdata('b2b_email') &&  $this->session->userdata('b2b_email')!= '')
	  {
		  $email = $this->session->userdata('b2b_email');
		  $name = $this->session->userdata('b2b_firstname');
	  }
	  


 		$_SESSION['helper_hotel_result'] =$data['hotel_result'];
		$_SESSION['helper_result'] =$data['result'];
		$_SESSION['helper_result_booking_no'] =$parent_no;
		$this->load->helper('pdf');
		
 	    $subject = "DSS - Hotel Booking Voucher";
 	 	$data['parent_no'] = $parent_no; 
 		$message_header =  "DSS - Hotel Booking Voucher";
	 
	 	$message = $this->load->view('hotel/voucher_content',$data,true);
	 
		$attach = 'voucher_pdf_files/'.$parent_no.'.pdf';
 	
		if($email!='')
		{
		 	$this->Email_Model->send_email($name,$subject,$email,$message_header,$message,$attach);
		}
		
		
		}
		
		
			function voucher_allroom_sendemail()
	{
		
			$this->load->model('Email_Model');
 	  $parent_no = $this->input->post('parent_no');
 	  $userval = $this->Hotel_Model->get_user_value($parent_no);
 	  $usertype = $userval->user_type;
 	  $userid = $userval->user_id;
 	  
 	  if($usertype=='2')
 	  {
 	  $getemail = $this->Hotel_Model->get_agent_detail($userid);
 	  $mailid = $getemail->email_id;
 	  }
 	  if($usertype=='3')
 	  {
 	  $getemail = $this->Hotel_Model->get_user_detail($userid);
 	  $mailid = $getemail->email;
 	  }
 	 
 	  $subject = "Voucher Detail";
 	  $data['parent_no'] = $parent_no; 
	  $data['result']=$this->Hotel_Model->get_reservation_details($parent_no);
 	  
 	  $message = $this->load->view('hotel/reservation_totalemail',$data,true);
 	  	
 	  if(	$this->Email_Model->send_email_voucher($subject,$mailid,$message))
 	  {
		    $data['status'] = "Valid Email";
      $data['error_message'] = "Your Voucher Has Been send to your Mail";
      echo json_encode($data);        
		
        
			 }
    else 
     {
     $data['status'] = "Existing Email";
     $data['error_message'] = "Some error Please try again later";
     echo json_encode($data);        	
        	
     }
		
		
		}
	
	function sendemail_detail($hotelid)
	{
	
		$hoteldetail = $this->Hotel_Model->hotel_detail_wishlist($hotelid);
		$data['hoteldetail'] = $hoteldetail;
		$this->load->view('hotel/sendhotel_detail',$data);

	}
	
	
	 function hoteldetail_sendmsg()
	 	{}
 	
 	
function bookingdetail_sendmsg()
	 	{}
 	
 	
         	function enquiry_page($hotelcode)
          	{
		
		         $data['hotelcode'] = $hotelcode;
			        $this->load->view('hotel/enquiry_form',$data);
		
          	} 	
          	
          	function UpdateEnquiryDetail()
	      {
	      	
	      	 $user_id = "0";  	
	      		if($this->session->userdata('b2c_id'))
	      	{
			
	      		$user_id = $this->session->userdata('b2c_id');
	       	}
	      	if($this->session->userdata('b2b_id'))
		       {
		
		     	$user_id = $this->session->userdata('b2b_id');
	       	}
		
	    $domain_info = $this->get_domain_detail();	  
		   $email = $this->input->post('emailval');
		 	  $subject = $this->input->post('subject');
		 	 	 	$message = $this->input->post('message');
		 	 	 	$hostval = $this->input->post('hostval');
		 	 	 	$countryval = $this->input->post('countryval');
		 	 	 	$cityval = $this->input->post('cityval');
		 	 	 	$regionval = $this->input->post('regionval');
		 	 	 	$hotel_code = $this->input->post('hotelcode');
		 	 	 	$insertval=$this->Hotel_Model->insert_enquery_detail($user_id,$email,$subject,	$message,$hostval,$cityval,$countryval,$regionval,	$hotel_code,$domain_info->domain_id);
		 
		    if($insertval)
		    {
		    	                  $data['status'] = "Valid";
                         $data['error_message'] = "Your Enquiry Detail Has Been Send to your Admin";
                         echo json_encode($data);  
		    	
		    	}else {
		    		                  $data['status'] = "Invalid";
                          $data['error_message'] = "Some Problem Please Try again later";
                          echo json_encode($data);  
		    		
		    		
		    		}
		    
		}
		
			function get_domain_detail()
					{

								$domaindetail = $this->Hotel_Model->get_domain_detail($this->domain);

								return $domaindetail;	

					}	
 	
}

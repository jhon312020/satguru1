<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Misc extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->model('Home_Model');
	$this->load->model('Admin_Model');
	$this->load->model('Misc_Model');
	
	$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	$this->output->set_header('Pragma: no-cache');
	$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

	}	
	
	public function index()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['page_header'] = 'Deal Charge Values';
			$this->load->view('deals_form',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	public function upload_markup()
	{
		
	$this->load->library('Spreadsheet_Excel_Reader');
$deal_category = $this->input->post('deal_category');
			if($deal_category == "Mark Up")
			{
				$tblName = 'akbar_markup';		
				$url = 'misc/list_markup';
			} else if($deal_category == "Discount")
			{
					$tblName = 'akbar_discount';
					$url = 'misc/list_discount';
			}
			else if($deal_category == "IATA - Commission")
			{
					$tblName = 'akbar_iata';
					$url = 'misc/list_iata';
			}
			else{
				$tblName = 'akbar_plb';
				$url = 'misc/list_plb';
				}
				
				
	$filename= $_FILES["filename"]["tmp_name"];
	$explode = explode(".",$_FILES["filename"]["name"]);
	
	if($explode[1] == 'xls')
{
	$data = new Spreadsheet_Excel_Reader($filename );


	$content = $data->sheets[0]['cells'];
	
	for($i=1; $i<=count($content);$i++)
	{
	
			$main_content = $content[$i];
		//echo "<pre>";print_r($main_content);
		$select = mysql_query("select max(id) as id from $tblName");
		$res = mysql_fetch_array($select);
		 $id = $res['id']+1;
	   	 $insert = mysql_query("insert into $tblName values('$id','$main_content[1]','$main_content[2]','$main_content[3]','$main_content[4]','$main_content[5]'
	  ,'$main_content[6]','$main_content[7]','$main_content[8]','$main_content[9]','$main_content[10]','$main_content[11]','$main_content[12]'
	  ,'$main_content[13]','$main_content[14]','$main_content[15]','$main_content[16]','$main_content[17]','$main_content[18]','$main_content[19]'
	  ,'$main_content[20]','$main_content[21]','$main_content[22]','$main_content[23]','$main_content[24]','$main_content[25]','$main_content[26]'
	  ,'$main_content[27]','$main_content[28]','$main_content[29]','$main_content[30]','$main_content[31]','$main_content[32]','$main_content[33]'
	  ,'$main_content[34]','$main_content[35]','$main_content[36]','$main_content[37]','$main_content[38]','$main_content[39]','$main_content[40]'
	  ,'$main_content[41]','$main_content[42]','$main_content[43]','$main_content[44]','$main_content[45]')");
			
	}

}

if($explode[1] == 'csv')
{
		
		
			$filePath = $_FILES["filename"]["tmp_name"];
			
			$fields = array('DealID',	'AirlineCode',	'PaxType',	'ValidFrom', 'ValidTill',	'IncFlightNo',	'ExcFlightNo',	'IncInBoundDateFrom','IncInBoundDateTill',	'ExcInBoundDateFrom', 	
			'ExcInBoundDateTill',	'IncOutBoundDateFrom',	'IncOutBoundDateTill',	'ExcOutBoundDateFrom',	'ExcOutBoundDateTill',	'IncOrginSectors',
				'ExcOrginSectors',	'IncDestinationSectors',	'ExcDestinationSectors',	'IncBookingClass',	'ExcBookingClass',	'IncFareBasisCode',	'ExcFarebasisCode',
					'DealChargeType',	'DealApplyType',	'DealSetType',	'Addons',	'DealSetAs','Value','GroupID',	'CompanyID',	'IsDomestic',	'Owner',	
					'DeductTDS',	'ApprovedFlag',	'DeletedFlag',	'CreatedUser',	'CreatedDate',	'ModifiedUser',	'ModifiedDate',	'DeletedUser',	'DeletedDate',	'ApprovedUser',
					'ApprovedDate' ,	'ValueReturn');

			if (($handle = fopen($filePath, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
       
        for ($c=0; $c < $num; $c++) {

												$csvfields = explode(';', $data[$c]);
											
												foreach($csvfields as $key=>$val)
												{
													
														$csvdata[$fields[$key]] = ($val)?$val:'';
														 $data1[$key] = $val;
														
												}
											
										  $this->db->insert($tblName, $csvdata);
        }
    }
    fclose($handle);
   }
    
			}
			redirect($url);
	}
  
 public function list_markup()
 {
 			if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['page_header'] = 'Mark Up list';
			$this->load->view('list_markup',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
 			
 	}	
 	
 	public function list_discount()
 {
 			if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['page_header'] = 'Discount list';
			$this->load->view('list_discount',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
 			
 	}	
 	
 		public function list_iata()
 {
 			if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['page_header'] = 'IATA list';
			$this->load->view('list_iata',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
 			
 	}	
 	
 	public function list_plb()
 {
 			if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');
			$data['admin_det'] = $this->Home_Model->admin_det($admin_id);
			$data['page_header'] = 'PLB List';
			$this->load->view('list_plb',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
 			
 	}	
	
	
}?>

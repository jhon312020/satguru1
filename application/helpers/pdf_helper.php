<?php
		$hotel_result =$_SESSION['helper_hotel_result'];
		$result =$_SESSION['helper_result'];

//============================================================+
// File name   : example_061.php
// Begin       : 2010-05-24
// Last Update : 2010-08-08
//
// Description : Example 061 for TCPDF class
//               XHTML + CSS
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               Manor Coach House, Church Hill
//               Aldershot, Hants, GU12 4RQ
//               UK
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: XHTML + CSS
 * @author Nicola Asuni
 * @since 2010-05-25
 */

require_once('pdf/config/lang/eng.php');
require_once('pdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DSS');
$pdf->SetTitle('DSS');
$pdf->SetSubject('DSS');
$pdf->SetKeywords('DSS Booking voucher');

// set default header data

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$html = <<<EOF

<table style="width: 700px; padding: 10px;float: left; bgcolor:#827E7E ">
<tr>
<td align="left"  valign="bottom">
<div style="width: 50%; float: left;"><h3><span style="color: #333;">Hotel</span> Booking Voucher</h3></div>
            </td>
			 <td align="right">
              
			  	
			  </td>
			  </tr>
			  <tr>
			  <td  colspan="2">
			  <table width="640px">
			  <tr>
			  <td width="140px"> 
			  </td>
			  <td width="500px"> Hotel Name : $hotel_result->hotel_name<br>Address : $hotel_result->address
			  </td>
			   </tr>
			   </table>
			  
			  </td>
			  </tr>
			  
			  <tr>
			  <td colspan="2">
			     Please Present This Voucher Upon Arrival
			  </td>
			  </tr>
			   <tr>
			  <td colspan="2">
			    <table width="640px" cellspacing="5" cellpadding="5">
             
                <tr>
              	<td width="160px" bgcolor="#585858" style="color:#FFFFFF">Booking Number</td>
                <td width="160px" bgcolor="#585858" style="color:#FFFFFF">$result->pnr_no</td>
                <td width="160px" bgcolor="#585858" style="color:#FFFFFF">Hotel B_No</td>
                <td width="160px" bgcolor="#585858" style="color:#FFFFFF">$result->booking_no</td>
               </tr>
			   
               <tr>
              	<td width="160px" bgcolor="#D0D0D0">Guest Name</td>
                <td width="160px">$hotel_result->passanger</td>
                <td width="160px" bgcolor="#D0D0D0">Total Price</td>
                <td width="160px">$hotel_result->amount SGD</td>
               </tr>
            
               
               
                 <tr>
              	<td width="160px" bgcolor="#D0D0D0">Check In</td>
                <td width="160px">$hotel_result->check_in</td>
                <td width="160px" bgcolor="#D0D0D0">Check Out</td>
                <td width="160px">$hotel_result->check_out</td>
               </tr>
               <tr>
              	<td width="160px" bgcolor="#D0D0D0">Room Type</td>
                <td width="160px">$hotel_result->room_type</td>
                <td width="160px" bgcolor="#D0D0D0">Night</td>
                <td width="160px">$hotel_result->nights</td>
               </tr>
               <tr>
              	<td width="160px" bgcolor="#D0D0D0">Meals</td>
                <td width="160px">$hotel_result->inclusion_val</td>
                <td width="160px" bgcolor="#D0D0D0">Status</td>
                <td width="160px">$result->api_status</td>
               </tr>
               <tr>
              	<td width="160px" bgcolor="#D0D0D0">Extra Request</td>
                <td width="160px">$hotel_result->cust_remark</td>
                <td width="160px" bgcolor="#D0D0D0">City Name</td>
                <td width="160px">$hotel_result->city</td>
               </tr>
                <tr>
              	<td colspan="4" bgcolor="#D0D0D0">$result->BookedAndPaidval</td>
              
               </tr>
               
              </table>
			  </td>
			  </tr>
			  
			  <tr>
			  <td colspan="2">
			     DSS travel service is in charge of this bookings payment.
			  </td>
			  </tr>
			    <tr>
			  <td colspan="2">
			     Caution : Please read properly
			  </td>
			  </tr>
			  <tr>
			  <td colspan="2">
			    <ul>
                          <li class="">IMPORTANT: At check-in ,you must present the credit card used to make this booking and  a valid photo ID with the same name.Failure to do so may result in the hotel requesting additional payment or your reservation not being honored.If you have submitted the DSS   Group fax form along with the required documentation for third party booking or paid via a different payment method ,please disgard the note above.</li>
                          <li class="">Unless otherwise indicated,all rooms are guaranteed on the day of arrival.In case of no-shows,your room(s) will be released and you will be subject to the term and condition of the Cancellation Policy specified in the Confirmation Booking email.</li>
                          <li class="">The total price for this booking does not include mini-bar items,telephone usage,laundry service,etc.If applicable the hotel will bill you directly.</li>
                          <li class="">In cases where Breakfast is included with the room rate,please note that certain hotels may charge extra for children travelling with their parents.Additional guests requesting extra beds are required to pay for breakfast.If applicable,the hotel will bill you directly.</li>
                          
                      </ul>
			  </td>
			  </tr>
			   <tr>
			  <td colspan="2">
			    Requests for booking changes or cancellation are possible duringthe business hours.(9.00-10.00)
			  </td>
			  </tr>
			   <tr>
			  <td aligh="left" >
			   
			  </td>
			  <td align="right">
			  Singapore : Tel- 09335757775
			  </td>
			  </tr>
			  
</table>

EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// *******************************************************************
// HTML TIPS & TRICKS
// *******************************************************************

// REMOVE CELL PADDING
//
// $pdf->SetCellPadding(0);
// 
// This is used to remove any additional vertical space inside a 
// single cell of text.

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// REMOVE TAG TOP AND BOTTOM MARGINS
//
// $tagvs = array('p' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n' => 0)));
// $pdf->setHtmlVSpace($tagvs);
// 
// Since the CSS margin command is not yet implemented on TCPDF, you
// need to set the spacing of block tags using the following method.

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// SET LINE HEIGHT
//
// $pdf->setCellHeightRatio(1.25);
// 
// You can use the following method to fine tune the line height
// (the number is a percentage relative to font height).

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// CHANGE THE PIXEL CONVERSION RATIO
//
// $pdf->setImageScale(0.47);
// 
// This is used to adjust the conversion ratio between pixels and 
// document units. Increase the value to get smaller objects.
// Since you are using pixel unit, this method is important to set the
// right zoom factor.
// 
// Suppose that you want to print a web page larger 1024 pixels to 
// fill all the available page width.
// An A4 page is larger 210mm equivalent to 8.268 inches, if you 
// subtract 13mm (0.512") of margins for each side, the remaining 
// space is 184mm (7.244 inches).
// The default resolution for a PDF document is 300 DPI (dots per 
// inch), so you have 7.244 * 300 = 2173.2 dots (this is the maximum 
// number of points you can print at 300 DPI for the given width).
// The conversion ratio is approximatively 1024 / 2173.2 = 0.47 px/dots
// If the web page is larger 1280 pixels, on the same A4 page the 
// conversion ratio to use is 1280 / 2173.2 = 0.59 pixels/dots

// *******************************************************************

// reset pointer to the last page
$pdf->lastPage();

// -------echo 'asda';exit;--------------------------------------------------

//Close and output PDF document
if(isset($_SESSION['helper_result_booking_no']) && $_SESSION['helper_result']!='')
{
$pdf->Output('voucher_pdf_files/'.$_SESSION['helper_result_booking_no'].'.pdf', 'F');
}
//============================================================+
// END OF FILE                                                
//============================================================+

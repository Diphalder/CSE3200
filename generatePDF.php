<?php 
require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;



// instantiate and use the dompdf class
$dompdf = new Dompdf();
ob_start();

require 'connect_DB.php';
require 'data.php';
require('PDF/'.$_SESSION['pdf']);




$html =ob_get_contents();
ob_get_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation

if($_SESSION['pdf']=='tcr_attendance.php')
{
    $dompdf->setPaper('A4','landscape');
}  
else{

    $dompdf->setPaper('A4', 'portrait');

}

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('generatePDF.php',['Attachment'=>false]);

<?php
require 'functions.php';
require('libraries/fpdf/fpdf.php');
//$ticket_ID = $_COOKIE["ticket"];
/*
$ch = curl_init('https://cloud.netlifyusercontent.com/assets/344dbf88-fdf9-42bb-adb4-46f01eedd629/68dd54ca-60cf-4ef7-898b-26d7cbe48ec7/10-dithering-opt.jpg');
$fp = fopen('/resources', 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);
*/
$ticket_ID = 1;

$conn = db_connect();

$sql = "SELECT e.Name, e.Start_DateTime, v.Name AS 'VenueName'
        FROM events e
        JOIN tickets t ON e.Event_ID = t.Event_ID
        JOIN venue v ON e.Venue_ID = v.Venue_ID
        WHERE t.Ticket_ID = $ticket_ID;";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$event_name = $row['Name'];
$event_time = $row['Start_DateTime'];
$venue_name = $row['VenueName'];
//echo $d;

mysqli_close($conn);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$event_name);
$pdf->Ln(20);
$pdf->Cell(40,10,$event_time);
$pdf->Ln(20);
$pdf->Cell(40,10,$venue_name);
$pdf->Ln(20);
$pdf->Cell(40,10,'Ticket Unique Identifier - '.$ticket_ID);
//$pdf->Image('logo.png',10,6,30);
$pdf->Output();

//require('fpdf.php');
/*
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    //$this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,$row['Name'],1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();

*/
?>

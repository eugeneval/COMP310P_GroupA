<?php
/*******************************************************************************
* Eventi                                                                       *
*                                                                              *
* Version: 1.0                                                                 *
* Authors: Eugene Valetsky - George Imafidon - Syed Ismail Ahmad               *
*******************************************************************************/
require 'functions.php';
require('libraries/fpdf/fpdf.php');
$ticket_ID = $_COOKIE["ticket"];

//$ticket_ID = 1;

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

mysqli_close($conn);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$event_name);
$pdf->Ln(20);
$pdf->Cell(40,10,'At - '.$event_time);
$pdf->Ln(10);
$pdf->Cell(40,10,$venue_name);
$pdf->Ln(20);
$pdf->Cell(40,10,'Ticket Unique Identifier - '.$ticket_ID);
$pdf->Output();
?>

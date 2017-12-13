<?php
require 'functions.php';
require('libraries/fpdf/fpdf.php');
$ticket_ID = $_COOKIE["ticket"];


$conn = db_connect();



$sql = "SELECT e.Name, e.Start_DateTime, v.Name AS 'VenueName'
        FROM events e
        JOIN tickets t ON e.Event_ID = t.Event_ID
        JOIN venue v ON e.Venue_ID = v.Venue_ID
        WHERE t.Ticket_ID = $ticket_ID;";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$rowd = 1200;

die(print_r($rowd));

mysqli_close($conn);
/*
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$d);
$pdf->Output();
*/
?>

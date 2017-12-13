<?php
require 'functions.php';
require('libraries/fpdf/fpdf.php');
$ticket_ID = $_COOKIE["ticket"];

$conn = db_connect();

$sql = "SELECT events.Name, events.Start_DateTime, venue.Name AS VenueName
        FROM events
        JOIN tickets ON events.Event_ID=tickets.Event_ID
        JOIN venue ON events.Venue_ID=venue.Venue_ID
        WHERE Ticket_ID = $ticket_ID;";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
mysqli_close($conn);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();

?>

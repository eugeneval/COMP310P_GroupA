<?php

<<<<<<< HEAD
require('libraries/fpdf/fpdf.php');
$ticket_ID = $_COOKIE["ticket"];

=======
require('fpdf.php');
>>>>>>> 228e75dda6d2001ffb4bff23cbbd27f909a04e60

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();


 ?>

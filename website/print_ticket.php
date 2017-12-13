<?php

require('libraries/fpdf/fpdf.php');
$ticket_ID = $_COOKIE["ticket"];


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();


 ?>

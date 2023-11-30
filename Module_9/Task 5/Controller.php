<?php

use setasign\Fpdi\Fpdi;

include '../sharedViewTop.php';

// FPDF AND FPDI ARE STOLEN FROM HERE:
require_once('../fpdf/fpdf.php'); // http://www.fpdf.org/
require_once('../fpdi/src/autoload.php'); // https://www.setasign.com/products/fpdi/demos/simple-demo/#p-319.5

$pdf = new Fpdi();

$pdf->AddPage();

$pdf->setSourceFile("Mod9Template.pdf");

$fs = $pdf->importPage(1);

$pdf->useTemplate($fs);

$pdf->setFont("Arial", "", 10);

// Logo
$pdf->Image('Logo.png', 101, 39, 20);

// Set initial X and Y
$pdf->setY(45);
$pdf->setX(13);

// First cell with automatic line break
// Name on customer (2)
$pdf->cell(100, 5, "Mike Wazowski", 0, 1, "L");

// Reuse X again as it remains the same
// Customers address (3)
$pdf->cell(100, 5, "Odderoeyveien 31, 4610 Kristiansand S", 0, 1, "L");

// Move down to Y position 125 for a section under the logo
// Invoice sender (1)
$pdf->setY(60);
$pdf->setX(101);
$pdf->cell(100, 5, "Mystes AS", 0, 1, "L");

// Position for ticket information
$pdf->setY(88);
// Product and price (4)
$pdf->cell(90, 5, "1 stk Young-adult ticket", 0, 0, "L");
$pdf->cell(90, 5, "199kr", 0, 1, "R");

// Position for the final price
$pdf->setY(187.5);
// Total sum to pay (5)
$pdf->cell(105, 5, "199kr", 0, 1, "R");

// Output the PDF
$pdf->output('F', "Mod9TemplateOutput.pdf");

// It does not look good, but I mean it works...
echo "<iframe 
        src=\"Mod9TemplateOutput.pdf\" 
        style=\"position: absolute; top: 50px; left: 0; width: 100%; height: calc(100% - 50px); border: none;\">
        </iframe>";

include '../sharedViewBottom.php';

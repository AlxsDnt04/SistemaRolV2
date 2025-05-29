<?php
require_once '../libs/fpdf/fpdf.php';
require_once '../models/Rol.php';


$id = $_GET["id"];
if(!$id) die("El ID no existe o consulte al administrador");
$rolModel = new Rol();
$data = $rolModel->obtenerRolPorId($id);

if(!$data)die("Datos no encontrados - consulte al administrador");

$pdf = new FPDF();
$pdf->AddPage();

//margin inferiori 
$pdf->SetAutoPageBreak(true,margin:20);


//encabezado
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0, 10, utf8_decode("Rol de pago"), 0, 1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',12);
$pdf->Cell(100, 8, "Empleado ".utf8_decode($data['nombre'].' '.$data['apellido']), 0, 1,'C');



$pdf->Output();


?>
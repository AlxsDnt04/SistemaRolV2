<?php
require_once '../libs/fpdf/fpdf.php';
require_once '../models/Rol.php';


$id = $_GET["id"];
if (!$id) die("El ID no existe o consulte al administrador");
$rolModel = new Rol();
$data = $rolModel->obtenerRolPorId($id);

if (!$data) die("Datos no encontrados - consulte al administrador");

$pdf = new FPDF();
$pdf->AddPage();

//margin inferiori 
$pdf->SetAutoPageBreak(true, margin: 20);


//encabezado
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode("Rol de pago"), 0, 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(5);
// Encabezado 
$pdf->Cell(50, 10, "Empleado: " , 0, 0, 'L'); 
$pdf->Cell(60, 10, utf8_decode($data['nombre'] . ' ' . $data['apellido']), 0, 0, 'L'); 
$pdf->Ln();
$pdf->Cell(50, 8, "CI: ", 0, 0, 'L');
$pdf->Cell(60, 8, utf8_decode($data['ci_empleado']), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(50, 8, "MES: ", 0, 0, 'L');
$pdf->Cell(60, 8, utf8_decode($data['mes']), 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(50, 8, "FECHA DE REGISTRO: ", 0, 0, 'L');
$pdf->Cell(60, 8, utf8_decode($data['fecha_registro']), 0, 1, 'L');


$pdf->SetFont('Arial', '', 12);

$pdf->Ln(5);
//fuente
$pdf->SetFont('Arial', '', 11);
$pdf->SetFillColor(220, 230, 240);
$pdf->Cell(95, 10, "INGRESOS", 1, 0, 'C', true);
$pdf->Cell(95, 10, "EGRESOS", 1, 0, 'C', true);
$pdf->Ln();


$pdf->SetFont('Arial', '', 11);
// TODOS LOS INGRESOS
$ingresos = [
    'Sueldo' => $data['sueldo'],
    'Hora 25%' => $data['hora25'],
    'Hora 50%' => $data['hora50'],
    'Hora 100%' => $data['hora100'],
    'Bonos' => $data['bonos'],
    'Total Ingreso' => $data['totalIngreso'],
];
// Todos los egresos
$egresos = [
    'Iess' => $data['iess'],
    'Multas' => $data['multas'],
    'Atrasos' => $data['atrasos'],
    'Alimentacion' => $data['alimentacion'],
    'Anticipo' => $data['anticipos'],
    'Otros' => $data['otros'],
    'TotalEgreso' => $data['totalEgreso'],
];

$maxFilas = max(count($ingresos), count($egresos));
$ingVal = array_values(array:$ingresos);
$ingKeys = array_keys($ingresos);

$egrVal = array_values($egresos);
$egrKeys = array_keys($egresos);

for ($i=0; $i < $maxFilas; $i++) { 
     // Columna de ingresos
    if (isset($ingKeys[$i])) {
        $pdf->Cell(47, 8, utf8_decode($ingKeys[$i]), 1, 0, 'L');
        $pdf->Cell(48, 8, number_format($ingVal[$i], 2), 1, 0, 'R');
    } else {
        $pdf->Cell(47, 8, '', 1, 0);
        $pdf->Cell(48, 8, '', 1, 0);
    }

    // Columna de egresos
    if (isset($egrKeys[$i])) {
        $pdf->Cell(47, 8, utf8_decode($egrKeys[$i]), 1, 0, 'L');
        $pdf->Cell(48, 8, $egrVal[$i], 1, 0, 'R');
    } else {
        $pdf->Cell(47, 8, '', 1, 0);
        $pdf->Cell(48, 8, '', 1, 0);
    }

    $pdf->Ln();
}

$pdf->Ln(5);
// Total a pagar
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetFillColor(220, 230, 240);
$pdf->Cell(0, 10, "Total a Pagar:  $" . number_format($data['totalPagar'], 2), 1, 1, 'C', true);
$pdf->Ln(20);

// pie de pagina
$pdf->Cell(0, 10, "Generado el: " . date('d-m-Y'),0, 1, 'C');
$pdf->Ln(30);
$pdf->Image('../assets/img/firmaE.png', 85, 193, 60);
$pdf->Cell(0, 10, "____________________________", 0, 1, 'C');
$pdf->Cell(0, 10, "Firma de RRHH", 0, 1, 'C');
$pdf->Ln(20);
$pdf->Cell(0, 10, "____________________________", 0, 1, 'C');
$pdf->Cell(0, 10, "Firma del Empleado: ".($data['nombre']." ".$data['apellido']), 0, 1, 'C');

$nombreArchivo = 'RolPago_'.$data['ci_empleado'].'_'.$data['mes'].'_'.$data['fecha_registro'].'.pdf';
$pdf->Output('I', $nombreArchivo);

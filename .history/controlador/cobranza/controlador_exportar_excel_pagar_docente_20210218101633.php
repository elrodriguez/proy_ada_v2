<?php
require '../../vendor/autoload.php';
include '../../modelo/modelo_cobranza.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'NIVEL');
$sheet->setCellValue('B1', 'DOCENTE');
$sheet->setCellValue('C1', 'TIPO');
$sheet->setCellValue('D1', 'CATEGORIA');
$sheet->setCellValue('E1', 'MODALIDAD');
$sheet->setCellValue('F1', 'FECHA REGISTRO');
$sheet->setCellValue('G1', 'CANTIDAD DE TESIS');
$sheet->setCellValue('H1', 'MONTO');

$txtfechadesde =  $_POST["desde"];
$txtfechahasta =  $_POST["hasta"];
$flag =  1;

$MC = new modelo_cobranza();
$array = $MC->reportepagardocente($flag,$txtfechadesde,$txtfechahasta);
$c = 2;
foreach($array as $item){
    $sheet->setCellValue('A'.$c, 'NIVEL');
    $sheet->setCellValue('B'.$c, 'DOCENTE');
    $sheet->setCellValue('C'.$c, 'TIPO');
    $sheet->setCellValue('D'.$c, 'CATEGORIA');
    $sheet->setCellValue('E'.$c, 'MODALIDAD');
    $sheet->setCellValue('F'.$c, 'FECHA REGISTRO');
    $sheet->setCellValue('G'.$c, 'CANTIDAD DE TESIS');
    $sheet->setCellValue('H'.$c, 'MONTO');
    $c++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('hola_mundo.xlsx');
// Redireccionamos para que descargue el archivo generado
header("Location: hola_mundo.xlsx");
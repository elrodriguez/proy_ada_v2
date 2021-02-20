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

$txtfechadesde =  $_POST["txtfecha_desde"];
$txtfechahasta =  $_POST["txtfecha_hasta"];
$flag =  1;

$MC = new modelo_cobranza();
$consulta = $MC->pagar_docente($codigo,$docente,$flag,$modalidad,$categoria,$tipo);
echo $consulta;
    
$writer = new Xlsx($spreadsheet);
$writer->save('hola_mundo.xlsx');
// Redireccionamos para que descargue el archivo generado
header("Location: hola_mundo.xlsx");
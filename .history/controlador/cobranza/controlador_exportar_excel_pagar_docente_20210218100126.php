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
$docente =  $_POST["docente"];
$flag =  $_POST["flag"];
$modalidad =  $_POST["modalidad"];
$categoria =  $_POST["categoria"];
$tipo =  $_POST["tipo"];

$MC = new modelo_cobranza();
$consulta = $MC->pagar_docente($codigo,$docente,$flag,$modalidad,$categoria,$tipo);
echo $consulta;
    
$writer = new Xlsx($spreadsheet);
$writer->save('hola_mundo.xlsx');
// Redireccionamos para que descargue el archivo generado
header("Location: hola_mundo.xlsx");
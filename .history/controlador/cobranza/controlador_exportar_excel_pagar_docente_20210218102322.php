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

$txtfechadesde =  $_REQUEST["desde"];
$txtfechahasta =  $_REQUEST["hasta"];
$flag =  1;

$MC = new modelo_cobranza();
$array = $MC->reportepagardocente($flag,$txtfechadesde,$txtfechahasta);
//print_r($array);exit;
$c = 2;
foreach($array as $item){
    $sheet->setCellValue('A'.$c, $item['modalidad']);
    $sheet->setCellValue('B'.$c, $item['docente_nombre']);
    $sheet->setCellValue('C'.$c, $item['tipo']);
    $sheet->setCellValue('D'.$c, $item['categoria']);
    $sheet->setCellValue('E'.$c, $item['moda']);
    $sheet->setCellValue('F'.$c, $item['por_pagar_fecha']);
    $sheet->setCellValue('G'.$c, $item['total_tesis']);
    $sheet->setCellValue('H'.$c, $item['pago']);
    if($item['pagado'] == 0){
        $sheet->setCellValue('H'.$c, 'pendiente');
    }else{
        $sheet->setCellValue('H'.$c, 'cancelado');
    }
    $c++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('reporte_docente.xlsx');
// Redireccionamos para que descargue el archivo generado
header("Location: reporte_docente.xlsx");
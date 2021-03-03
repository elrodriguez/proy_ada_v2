<?php
require '../../vendor/autoload.php';
include '../../modelo/modelo_cobranza.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'NIVEL');
$sheet->setCellValue('B1', 'DOCENTE');
$sheet->setCellValue('C1', 'PROGRAMA ACADEMICO');
$sheet->setCellValue('D1', 'TIPO');
$sheet->setCellValue('E1', 'CATEGORIA');
$sheet->setCellValue('F1', 'MODALIDAD');
$sheet->setCellValue('G1', 'FECHA REGISTRO');
$sheet->setCellValue('H1', 'CANTIDAD DE TESIS');
$sheet->setCellValue('I1', 'MONTO');
$sheet->setCellValue('J1', 'ESTADO');


$txtfechadesde =  $_REQUEST["desde"];
$txtfechahasta =  $_REQUEST["hasta"];
$flag =  1;

$MC = new modelo_cobranza();
$array = $MC->reportepagardocente($flag,$txtfechadesde,$txtfechahasta);
// print_r($array);exit;
$c = 2;
foreach($array as $item){
    $sheet->setCellValue('A'.$c, $item['modalidad']);
    $sheet->setCellValue('B'.$c, $item['docente_nombre']);
    $sheet->setCellValue('C'.$c, $item['descripcion']);
    $sheet->setCellValue('D'.$c, $item['tipo']);
    $sheet->setCellValue('E'.$c, $item['categoria']);
    $sheet->setCellValue('F'.$c, $item['moda']);
    $sheet->setCellValue('G'.$c, $item['por_pagar_fecha']);
    $sheet->setCellValue('H'.$c, $item['total_tesis']);
    $sheet->setCellValue('I'.$c, $item['pago']);

    if($item['pagado'] == 0){
        $sheet->setCellValue('J'.$c, 'Pendiente');
    }else{
        $sheet->setCellValue('J'.$c, 'Autorizado');
    }
    $c++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('Reporte_Docente_'.$txtfechadesde.'_Hasta_'.$txtfechahasta.'.xlsx');
// Redireccionamos para que descargue el archivo generado
header("Location: Reporte_Docente_".$txtfechadesde."_Hasta_".$txtfechahasta.".xlsx");

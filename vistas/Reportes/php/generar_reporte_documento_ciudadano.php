<?php
//include('plantilla.php');
require('../fpdf/fpdf.php');
$mysqli = new mysqli("localhost","root","hiworld2018","bd_tramite");

if(mysqli_connect_errno()){
	echo 'Conexion Fallida : ', mysqli_connect_error();
	exit();
}

$query = "SELECT
documento.documento_cod,
documento.doc_asunto,
cast(documento.doc_fecha_recepcion as date) as fecha,
area.area_nombre,
tipo_documento.tipodo_descripcion,
documento.doc_estado
FROM
documento
INNER JOIN detalle_ciudadano ON detalle_ciudadano.documento_cod = documento.documento_cod
INNER JOIN area ON documento.area_cod = area.area_cod
INNER JOIN tipo_documento ON documento.tipoDocumento_cod = tipo_documento.tipodocumento_cod
where ciudadano_cod='".$_GET['txtidciudadano']."'";
	$resultado = $mysqli->query($query);

	$pdf=new FPDF('L','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Image('../../ucsur-fonfo.png', 17, 7, 30 );
		$pdf->SetFont('Courier','B',15);
		$pdf->Cell(70);
		$pdf->Cell(120,10, 'Reporte de documentos tramitados',0,0,'C');
		$pdf->Ln(20);
		$pdf->SetFont('Courier','B',12);
		$pdf->Cell(70);
		$pdf->Cell(60,6, 'CIUDADANO',1,0,'P');
		$pdf->SetFont('Courier','',12);
		$pdf->Cell(80,6, $_GET["txtciudadano"],1,1,'P');
		$pdf->Cell(70);
		$pdf->SetFont('Courier','B',12);
		$pdf->Cell(60,6, 'TIPO CIUDADANO',1,0,'P');
		$pdf->SetFont('Courier','',12);
		$pdf->Cell(80,6, $_GET["txttipopersona"],1,1,'P');
		$pdf->Cell(70);
		$pdf->SetFont('Courier','B',12);
		$pdf->Cell(60,6, 'FECHA REPORTE',1,0,'P');
		$pdf->SetFont('Courier','',12);
		$hoy = date("Y-m-j");
		$pdf->Cell(80,6, $hoy,1,1,'P');
		$pdf->Ln(10);
		$pdf->SetFont('Courier','B',12);
	$pdf->Cell(80);
	$pdf->Cell(120,10, 'Listado de documentos tramitados',0,0,'C');
	$pdf->Ln(10);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(30,6,'CODIGO',1,0,'C',1);
	$pdf->Cell(212,6,'ASUNTO',1,0,'C',1);
	$pdf->Cell(35,6,utf8_decode('FECHA RECEPCION'),1,1,'C',1);

	$pdf->SetFont('Courier','',10);
	$cont=0;
	if ($resultado = $mysqli->query($query)) {
		while($row = $resultado->fetch_assoc())
		{
		$cont++;
		$pdf->Cell(30,6,utf8_decode($row['documento_cod']),1,0,'C');
		$pdf->Cell(212,6,utf8_decode($row['doc_asunto']),1,0,'C');
		$pdf->Cell(35,6,utf8_decode($row['fecha']),1,1,'C');
		}
	}
	if ($cont==0) {
			$pdf->Cell(277,6,"No se encontraron Datos",1,1,'C');
	}

	$pdf->Cell(120);
	$pdf->Output();
?>

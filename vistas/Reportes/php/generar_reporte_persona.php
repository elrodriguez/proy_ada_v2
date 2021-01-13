<?php
//include('plantilla.php');
require('../fpdf/fpdf.php');
$mysqli = new mysqli("localhost","root","","bd_tramite"); 
	
if(mysqli_connect_errno()){
	echo 'Conexion Fallida : ', mysqli_connect_error();
	exit();
}
$query = "SELECT
ciudadano.ciud_dni,
CONCAT_WS(' ',ciudadano.ciud_nombres,ciudadano.ciud_apellidoPate,ciudadano.ciud_apellidoMate) AS persona,
documento.doc_asunto,
CAST(documento.doc_fecha_recepcion as date) as FECHA,
area.area_nombre,
documento.doc_estado,
documento.documento_cod
FROM
ciudadano
INNER JOIN detalle_ciudadano ON detalle_ciudadano.ciudadano_cod = ciudadano.ciudadano_cod
INNER JOIN documento ON detalle_ciudadano.documento_cod = documento.documento_cod
INNER JOIN area ON documento.area_cod = area.area_cod order by documento_cod";
	$resultado = $mysqli->query($query);
	
	$pdf=new FPDF('L','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Image('../../descarga.png', 17, 7, 30 );
	$pdf->SetFont('Courier','B',15);
	$pdf->Cell(70);
	$pdf->Cell(120,10, 'Reporte de tramites de ciudadanos',0,0,'C');
	$pdf->Ln(30);
	$pdf->SetFont('Courier','B',12);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Courier','B',10);
	$pdf->Cell(25,6,utf8_decode('CÓDIGO'),1,0,'C',1);
	$pdf->Cell(80,6,utf8_decode('CIUDADANO'),1,0,'C',1);
	$pdf->Cell(101,6,'ASUNTO',1,0,'C',1);
	$pdf->Cell(35,6,utf8_decode('FECHA RECEPCIÓN'),1,0,'C',1);
	$pdf->Cell(35,6,'AREA',1,1,'C',1);
	
	$pdf->SetFont('Courier','',10);
	$cont=0;
	if ($resultado = $mysqli->query($query)) {
		while($row = $resultado->fetch_assoc())
		{
		$cont++;
		$pdf->Cell(25,6,utf8_decode($row['documento_cod']),1,0,'C');
		$pdf->Cell(80,6,utf8_decode($row['persona']),1,0,'C');
		$pdf->Cell(101,6,utf8_decode($row['doc_asunto']),1,0,'C');
		$pdf->Cell(35,6,utf8_decode($row['FECHA']),1,0,'C');
		$pdf->Cell(35,6,utf8_decode($row['area_nombre']),1,1,'C');
		}
	}
	if ($cont==0) {
			$pdf->Cell(276,6,"No se encontraron Datos",1,1,'C');
	}
	$pdf->Cell(120);
	$pdf->Output();
?>
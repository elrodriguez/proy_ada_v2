<?php 

require '../../modelo/modelo_documento_coordinador.php';
$value = $_REQUEST['value'];
$iddocumento = $_REQUEST['pk'];

$MC = new Modelo_documento();
$consulta = $MC->subir_documento_anexos(24,$iddocumento,$value,null);
echo $consulta;
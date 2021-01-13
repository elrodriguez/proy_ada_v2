<?php
    require '../../modelo/modelo_documento_asistente.php';
    $documento = $_REQUEST['doc'];

    $MC = new Modelo_documento();
	$consulta = $MC->obtenerporcentajeturniting($documento);
    print_r($consulta);
    if($consulta['porcentaje'] >=12){
        
    }

?>
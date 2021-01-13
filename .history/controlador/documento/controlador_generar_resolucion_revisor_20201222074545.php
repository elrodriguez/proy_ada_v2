<?php
    require '../../modelo/modelo_documento_coordinador.php';
    $documento = $_REQUEST['doc'];
    $correo = $_REQUEST['correo'];
    //echo $correo.' - '.$documento ;exit;
    $MC = new Modelo_documento();
    $consulta = $MC->obtenerporcentajeturniting($documento);
    $revisores = $MC->obtener_revisores($documento);
    
?>
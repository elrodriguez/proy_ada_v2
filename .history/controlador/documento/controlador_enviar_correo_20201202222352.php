<?php
    require '../../modelo/modelo_documento_asistente.php';
    $documento = $_REQUEST['doc'];

    $MC = new Modelo_documento();
    $consulta = $MC->obtenerporcentajeturniting($documento);
    
    $to = "elrodriguez2423@gmail.com";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $html = '';
    if($consulta['porcentaje'] >=12){
        $subject = "[DGIDI-UCSUR] Registro de proyecto de investigación – Proyecto de tesis de #Autor_principal#";
        $html = ``;
    }

?>
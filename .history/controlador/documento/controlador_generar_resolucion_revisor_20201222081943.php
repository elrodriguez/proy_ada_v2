<?php
    require '../../modelo/modelo_documento_coordinador.php';
    $documento = $_REQUEST['doc'];
    //echo $correo.' - '.$documento ;exit;
    $MC = new Modelo_documento();
    $consulta = $MC->obtenerporcentajeturniting($documento);
    $revisores = $MC->obtener_revisores($documento);
    
    // Load library 
include_once '../../vendor/HtmlToDoc.php';  
 
// Initialize class 
$htd = new HTML_TO_DOC();
?>
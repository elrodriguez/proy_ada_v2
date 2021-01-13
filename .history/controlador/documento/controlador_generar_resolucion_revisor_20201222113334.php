<?php
    require '../../modelo/modelo_documento_coordinador.php';
    $documento = $_REQUEST['doc'];
    //echo $correo.' - '.$documento ;exit;
    $MC = new Modelo_documento();
    $consulta = $MC->obtenerporcentajeturniting($documento);
    $revisores = $MC->obtener_revisores($documento);
    
    header("Content-type: application/vnd.ms-word");
     header("Content-Disposition: attachment;Filename=document_name.doc");    
     echo "<html>";
     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
     echo "<body>";
     echo "<h5 style='text-align: center;'>ACEPTAC&Iacute;ON DEL PROYECTO DE TESIS Y NOMBRAMIENTO DEL ASESOR DE TESIS</h5>";
     echo "<b style='font-size: 11px;'>RESOLUCION DIRECTORIAL DE CARRERA N&deg;XXXXX-CI-DAFCE-U.CIENTIFICA-2020</b>";
     echo "<p style='float: right;'>Lima xx de xx del 2020</p>";
     echo "<b style='font-size: 11px;'>VISTO:</b>";
     echo "<div style='text-align: justify;'>";
     echo "<p>El informe de resolu&iacute;on independiente acad&eacute;mico y la aprobac&iacute;on de un comit&eacute; de &Eacute;tica del</p>";
     echo "<p>proyecto de tesis tulado: xxxxxxx</p>";
     echo "<p>presentado por: xxxxxxx</p>";
     echo "<b style='font-size: 11px;'>CONSIDERADO:</b><br>";
     echo "<p>Que, de acuerdo al reglamento general de la universidad Cientifica del sur y los</p>";
     echo "<p>reglamentos de pre/posgrado para obtener el t&iacute;tulo profecional/ grado acad&eacute;mico de</p>";
     echo "<p></p>";
     echo "<p></p>";
     echo "</div>";
     echo "</body>";
     echo "</html>";
?>
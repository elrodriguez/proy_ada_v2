<?php
    require '../../modelo/modelo_documento_coordinador.php';
    $documento = $_REQUEST['doc'];

    $MC = new Modelo_documento();
    $ciudadanos = $MC->obtenerciudadanos($documento);
    $consulta = $MC->obtenerdocumento($documento);
    //print_r($ciudadanos);exit;
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=resolucion-doc-".$documento.".doc"); 
    header('Content-Type: text/html; charset=utf-8');  
    echo "<html><head>";
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
    echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />';
    echo "</head><body>";
    echo "<h4 style='text-align: center;'>UNIVERSIDAD CIENTÍFICA DEL SUR</h4>";
    echo "<h4 style='text-align: center;'>Constancia de ingreso de tesis en repositorio instituciona</h4>";
    echo "<div >";
    echo "<p style='text-align: justify;'>Lima ".date('d')." de ".date('m')." del ".date('Y').", en la sala de conferencias se reunieron los miembros del Jurado: </p>";
    echo "<p style='text-align: justify;'>Señor (ita, es), </p>"; 
    echo "<p style='text-align: justify;'>"; 
    $pp = count($ciudadanos);
    $cc = 1;
    foreach($ciudadanos as $ciudadano){
        echo strtoupper($ciudadano['nombre_completo'].($cc<$pp ?', ':''));
        $cc++;
    }
    echo "</p>";
    echo "<h4 style='text-align: justify;'>CONSIDERADO:</h4>";
    echo "<p style='text-align: justify;'>Que, de acuerdo al reglamento general de la universidad Cientifica del sur y los reglamentos depara obtener el en la Facultad de ciencias empresariales se debe desarrollar un trabajo de investigacion</p>";
    echo "<p style='text-align: justify;'>Que, deacuerdo a la normativa vigente de la universidad cientifica del sur, en uso de las atribuciones conferidas al director academico de carrera</p>";
    echo "<h4 style='text-align: justify;'>SE RESUELVE:</h4>";
    echo "<p style='text-align: justify;'>Aprobar e inscribir el pryecto de tesis titulado: TESIS UNO y estableser el inicio del periodo de ejecucíon de mencionado proyecto. Nombrar al docente como asesor para el desarrollo de tesis en cuestion Registrese, Comuníquese y archivese</p>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
?>
<?php
    require '../../modelo/modelo_documento_coordinador.php';
    $documento = $_REQUEST['doc'];

    $MC = new Modelo_documento();
    $ciudadanos = $MC->obtenerciudadanos($documento);
    $consulta = $MC->obtenerdocumento($documento);
    //print_r($ciudadanos);exit;
    //  header("Content-type: application/vnd.ms-word");
    //  header("Content-Disposition: attachment;Filename=resolucion-doc-".$documento.".doc"); 
    //  header('Content-Type: text/html; charset=utf-8');  
     echo "<html><head>";
     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
     echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />';
     echo "</head><body>";
     echo "<h4 style='text-align: center;'>ACEPTACÍON DEL PROYECTO DE TESIS Y NOMBRAMIENTO DEL</h4>";
     echo "<h4 style='text-align: center;'>ASESOR DE TESIS</h4>";
     echo "<h5 style='text-align: justify;'>RESOLUCION DIRECTORIAL DE CARRERA N°XXXXX-CI-DAFCE-U.CIENTIFICA-2020</h5>";
     echo "<div >";
     echo "<p style='text-align: justify;'>Lima ".date('d')." de ".date('m')." del ".date('Y').", en la sala de conferencias se reunieron los miembros del Jurado: </p>";
     echo "<h4 style='text-align: justify;'>VISTO:</h4>";
     echo "<p style='text-align: justify;'>El informe de resoluíon independiente académico y la aprobacíon de un comité de Ética del proyecto de tesis tulado: ".$consulta[0]['doc_asunto']." presentado por: "; 
     $pp = count($ciudadanos);
     $cc = 1;
     foreach($ciudadanos as $ciudadano){
         echo $ciudadano['nombre_completo'].($cc<$pp ?', ':'');
         $cc++;
    }
     echo "</p>";
     echo "<h4 style='text-align: justify;'>CONSIDERADO:</h4>";
     echo "<p style='text-align: justify;'>Que, de acuerdo al reglamento general de la universidad Cientifica del sur y los reglamentos depara obtener el en la Facultad de ciencias empresariales se debe desarrollar un trabajo de investigacion</p>";
     echo "<p style='text-align: justify;'>Que, deacuerdo a la normativa vigente de la universidad cientifica del sur, en uso de las atribuciones conferidas al director academico de carrera</p>";
     echo "<h4 style='text-align: justify;'>SE RESUELVE:</h4>";
     echo "<p style='text-align: justify;'>Aprobar e inscribir el pryecto de tesis titulado: TESIS UNO y estableser el inicio del periodo de ejecucíon de mencionado proyecto. Nombrar al docente como asesor para el desarrollo de tesis en cuestion Registrese, Comuníquese y archivese</p>";

     echo "</body>";
     echo "</html>";
?>
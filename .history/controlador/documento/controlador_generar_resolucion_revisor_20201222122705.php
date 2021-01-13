<?php
    require '../../modelo/modelo_documento_coordinador.php';
    $documento = $_REQUEST['doc'];
    //echo $correo.' - '.$documento ;exit;
    $MC = new Modelo_documento();
    $consulta = $MC->obtenerporcentajeturniting($documento);
    //print_r($consulta);exit;
     header("Content-type: application/vnd.ms-word");
     header("Content-Disposition: attachment;Filename=resolucion-doc-".$documento.".doc");    
     echo "<html>";
     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
     echo "<body>";
     echo "<h4 style='text-align: center;'>ACEPTAC&Iacute;ON DEL PROYECTO DE TESIS Y NOMBRAMIENTO DEL ASESOR DE TESIS</h4>";
     echo "<b style='font-size: 12px;'>RESOLUCION DIRECTORIAL DE CARRERA N&deg;XXXXX-CI-DAFCE-U.CIENTIFICA-2020</b>";
     echo "<div width='100%'><p style='float: right;'>Lima xx de xx del 2020</p></div>";
     echo "<b>VISTO:</b>";
     echo "<div >";
     echo "<p style='text-align: justify;'>El informe de resolu&iacute;on independiente acad&eacute;mico y la aprobac&iacute;on de un comit&eacute; de &Eacute;tica del ";
     echo "proyecto de tesis tulado: ".$consulta[0]['doc_asunto'];
     echo " presentado por: ";
     $pp = count($consulta);
     $cc = 1;
     foreach($consulta as $item){
        echo $item['ciudadano_full_name'].($pp<$cc?",":"");
        $cc++;
    }
     echo "</p>";
     echo "<b>CONSIDERADO:</b><br>";
     echo "<p style='text-align: justify;'>Que, de acuerdo al reglamento general de la universidad Cientifica del sur y los ";
     echo "reglamentos de";
     if($consulta[0]['grado']=='PREGRADO'){
        echo " pregrado ";
     }else if($consulta[0]['grado']=='MESTRIA'){
        echo " posgrado ";
     }else if($consulta[0]['grado']=='DOCTORADO'){
        echo " posgrado ";
     }
     echo "para obtener el ";
     if($consulta[0]['grado']=='PREGRADO'){
        echo " t&iacute;tulo profecional";
     }else if($consulta[0]['grado']=='MESTRIA'){
        echo " grado acad&eacute;mico de Maestro";
     }else if($consulta[0]['grado']=='DOCTORADO'){
        echo " grado acad&eacute;mico de Doctor";
     }
     echo " en la Facultad de ciencias empresariales se debe ";
     echo "desarrollar un trabajo de investigacion</p>";
     echo "<p>Que, deacuerdo a la normativa vigente de la universidad cientifica del sur, en uso de las atribuciones ";
     echo "conferidas al director academico de carrera</p>";
     echo "<b>SE RESUELVE:</b><br>";
     echo "<p style='text-align: justify;'>Aprobar e inscribir el pryecto de tesis titulado: ".$consulta[0]['doc_asunto']." y estableser ";
     echo "el inicio del periodo de ejecuc&iacute;on de mencionado proyecto. ";
     echo "Nombrar al docente ".$consulta[0]['asesor_full_name']." como asesor para el desarrollo de tesis en cuestion ";
     echo "Registrese, Comun&iacute;quese y archivese </p>";
     echo "</div>";
     echo "</body>";
     echo "</html>";
?>
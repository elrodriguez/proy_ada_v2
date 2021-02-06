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
    echo "<p style='text-align: justify;'><u>Presente. -</u></p><br><br>";
    echo "<p style='text-align: justify;'>De mi consideración, </p><br><br>";
    echo "<p style='text-align: justify;'>Es muy grato dirigirme a usted (es) para indicar que la tesis titulada “".$consulta[0]['doc_Asunto']."”, que es de su autoría, ha sido ingresada en el repositorio institucional de la Universidad Científica del Sur. Puede verificar la misma a través de la siguiente dirección web:</p>";
    echo "<p style='text-align: center;'>".$consulta[0]['repositorio']."</p>";
    echo "<p style='text-align: justify;'>Es propicia la ocasión para reiterarle mi estima y consideración personal.</p>";
    echo "<br><br>";
    echo "<p style='text-align: justify;'>Atentamente,</p>";
    echo "<br><br>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
?>
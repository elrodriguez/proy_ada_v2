<?php
    require '../../modelo/modelo_documento_coordinador.php';
    $documento = $_REQUEST['doc'];
    //echo $correo.' - '.$documento ;exit;
    $MC = new Modelo_documento();
    $jurados = $MC->obtenerjuradodocumento(1,$documento);
    $consulta = $MC->obtenerporcentajeturniting($documento);

    //  header("Content-type: application/vnd.ms-word");
    //  header("Content-Disposition: attachment;Filename=anexo13-".$documento.".doc"); 
    //  header('Content-Type: text/html; charset=utf-8');  
     echo "<html><head>";
     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
     echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />';
     echo "</head><body>";
     echo "<h4 style='text-align: center;color:blue;'>ANEXO 13</h4>";
     echo "<h4 style='text-align: center;'>ACTA DE SUSTENTACIÓN DE TESIS</h4>";
     echo "<div >";
     echo "<p style='text-align: justify;'>Siendo las ".date('H:i')." horas del día ".date('d')." de ".date('m')." del ".date('Y').", en la sala de conferencias se reunieron los miembros del Jurado: </p>";
     echo "<table style='border: 1px solid #000;border-collapse: collapse;'><thead>";
     echo "<tr>";
     echo "<td style='border: 1px solid #000;'>Nombre Jurado</td>";
     echo "</tr></thead><tbody>";
     $pp = count($consulta);
     $cc = 0;
     foreach($jurados as $jurado){
         echo "<tr >";
         if($cc == 0){
            echo "<td><b>Presidente</b></td>";
         }else{
            echo "<td><b>Miembro ".$cc."</b></td>";
         }
         
         echo "<td style='border: 1px solid #000;'>".$jurado['nombre_completo']."</td>";
         echo "</tr>";
         $cc++;
    }
    echo "</tbody></table>";

     echo "<p style='text-align: justify;'>Para evaluar la tesis titulada: “".$consulta[0]['doc_asunto']."”, presentada por el tesista XXXX, para optar el Título Profesional/grado académico de XXXXXXXXX.</p>";
     echo "<p>Terminada la sustentación, el Jurado luego de deliberar concluyen de manera unánime (      ) por mayoría simple (      ) que la tesis es:</p>";
     echo "<table style='border: 1px solid #000;border-collapse: collapse;'><tbody>";
     echo "<tr><td style='border: 1px solid #000;'>Aprobado</td><td style='border: 1px solid #000;'>(    )</td></tr>";
     echo "<tr><td style='border: 1px solid #000;'>Aprobado - Muy buena</td><td style='border: 1px solid #000;'>(    )</td></tr>";
     echo "<tr><td style='border: 1px solid #000;'>Aprobado - Sobresaliente</td><td style='border: 1px solid #000;'>(    )</td></tr>";
     echo "<tr><td style='border: 1px solid #000;'>Desaprobado</td><td style='border: 1px solid #000;'>(    )</td></tr>";
     echo "</tbody></table>";
     echo "<p style='text-align: justify;'>Calificándola con nota de: _______ en letras ( ___________________________________)</p>";
     echo "<p style='text-align: justify;'>En fe de lo actuado los miembros de Jurado suscriben la presente Acta en señal de conformidad.</p>";
     echo "</body>";
     echo "</html>";
?>
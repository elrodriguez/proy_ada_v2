<?php
    require '../../modelo/modelo_documento_coordinador.php';
    $documento = $_REQUEST['doc'];
    //echo $correo.' - '.$documento ;exit;
    $MC = new Modelo_documento();
    $jurados = $MC->obtenerjurados($documento);
    $consulta = $MC->obtenerdocumento($documento);
    $ciudadanos = $MC->obtenerciudadanos($documento);
    $revisores = $MC->obtenerrevisores($documento);

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=anexo13-".$documento.".doc"); 
    header('Content-Type: text/html; charset=utf-8');  
    echo "<html><head>";
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
    echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />';
    echo "</head><body>";
    echo "<h4 style='text-align: center;color:blue;'>ANEXO 13</h4>";
    echo "<h4 style='text-align: center;'>ACTA DE SUSTENTACIÓN DE TESIS</h4>";
    echo "<div >";
    echo "<p style='text-align: justify;'>Siendo las ".date('H:i')." horas del día ".date('d')." de ".date('m')." del ".date('Y').", en la sala de conferencias se reunieron los miembros del Jurado: </p>";
    echo "<table style='border: 1px solid #000;border-collapse: collapse;'>";
    echo "<tbody>";
    $pp = count($jurados);
    $cc = 0;

    foreach($jurados as $jurado){
        echo "<tr>";
        if($cc == 0){
        echo "<td style='border: 1px solid #000;padding:5px;'><b>Presidente</b></td>";
        }else{
        echo "<td style='border: 1px solid #000;padding:5px;'><b>Miembro ".$cc."</b></td>";
        }
        
        echo "<td style='border: 1px solid #000;padding:5px;'>Lic./Mg./Dr. ".$jurado['full_name']."</td>";
        echo "</tr>";
        $cc++;
    }
    echo "</tbody></table>";

    echo "<p style='text-align: justify;'>Para evaluar la tesis titulada: &#8220;".$consulta[0]['doc_asunto']."&#8221;, presentada por el tesista(s)"; 
    
    $cu = count($ciudadanos );
    $cui = 1;
    foreach($ciudadanos as $ciudadano){
        echo ' '.$ciudadano['nombre_completo'].($cui< ($cu-1)?', ': ($cui < $cu ? 'y': '' ));
        $cui++;
    }

    echo ", para optar el T&iacute;tulo Profesional/grado académico de XXXXXXXXX.</p>";
    echo "<p>Terminada la sustentaci&oacute;n, el Jurado luego de deliberar concluyen de manera unánime (      ) por mayoría simple (      ) que la tesis es:</p>";
    echo "<table style='border: 1px solid #000;border-collapse: collapse;'><tbody>";
    echo "<tr><td style='border: 1px solid #000;padding:5px;'>Aprobado</td><td style='border: 1px solid #000;padding:5px;'>(    )</td></tr>";
    echo "<tr><td style='border: 1px solid #000;padding:5px;'>Aprobado - Muy buena</td><td style='border: 1px solid #000;padding:5px;'>(    )</td></tr>";
    echo "<tr><td style='border: 1px solid #000;padding:5px;'>Aprobado - Sobresaliente</td><td style='border: 1px solid #000;padding:5px;'>(    )</td></tr>";
    echo "<tr><td style='border: 1px solid #000;padding:5px;'>Desaprobado</td><td style='border: 1px solid #000;padding:5px;'>(    )</td></tr>";
    echo "</tbody></table>";
    echo "<p style='text-align: justify;'>Calific&aacute;ndola con nota de: _______ en letras ( ___________________________________)</p>";
    echo "<p style='text-align: justify;'>En fe de lo actuado los miembros de Jurado suscriben la presente Acta en señal de conformidad.</p>";
    echo "<table style='width:100%;'>";

    echo "<tr><td colspan='2' style='height: 60px;'></td></tr>";
    echo "<tr>";
    $ci = 1;

    foreach($jurados as $h => $jurado){
            if($ci <=2){
                echo "<td style='text-align: center;'><p>__________________________________</p><p>".($h == 0?' Presidente del Jurado':'Miembro del Jurado')."</p><p>Lic./Mg./Dr. ".$jurado['full_name']."</p></td>";
                if($ci == 2){
                    echo "</tr>";
                    echo "<tr>";
                    $ci = 0;
                }
            }
        $ci++;
    }
    if($pp%2==0){
        echo "<td colspan='2' style='text-align: center;'><p>__________________________________</p><p>Asesor</p><p>Lic./Mg./Dr. ".$revisores[0]['full_name']."</p></td>";
    }else{
        echo "<td style='text-align: center;'><p>__________________________________</p><p>Asesor</p><p>Lic./Mg./Dr. ".$revisores[0]['full_name']."</p></td>";
    }
    echo "</tr>";

    echo "</table>";
    echo "</body>";
    echo "</html>";
?>
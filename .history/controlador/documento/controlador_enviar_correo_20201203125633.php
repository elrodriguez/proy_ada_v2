<?php
    require '../../modelo/modelo_documento_asistente.php';
    $documento = $_REQUEST['doc'];

    $MC = new Modelo_documento();
    $consulta = $MC->obtenerporcentajeturniting($documento);
    //print_r($consulta);exit;
    $to = "elrodriguez2423@gmail.com";
    $subject = '';
    $headers =  'MIME-Version: 1.0' . "\r\n"; 
    $headers .= 'From: Your name <info@address.com>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

    $message = '';
    if($consulta[0]['porcentaje'] >=12){
        $subject = "[DGIDI-UCSUR] Registro de proyecto de investigación – Proyecto de tesis de #Autor_principal#";
        $message .= `<html>
                    <head>
                        <title>Proyecto de tesis aceptado</title>
                    </head>
                    <body>
                        <strong>Estimado(a),</strong>
                        <p>(`.$consulta[0]['doc_ticket'].`)</p>`;
                        foreach($consulta as $item){
                            $message .=`<p>(`.$item['ciudadano_full_name'].`)</p>`;
                        }
        $message .=`<p>Presente. –</p>

                        <p>Tenga un buen día. Con fecha 2 de Diciembre de 2020, me comunico con usted a nombre de la Dirección General de Investigación, Desarrollo e Innovación (DGIDI) de la Universidad Científica del Sur. El motivo de este correo es para indicarle que el proyecto titulado: “`.$consulta[0]['doc_asunto'].`”, ha sido revisado mediante el sistema Turnitin no encontrándose sospecha de plagio.</p>

                        <p>En tal sentido, luego de este proceso y la validación de parte de su asesor, le informo que su proyecto queda registrado con el código N° `.$consulta[0]['documento_cod'].`. Con este identificador podrá seguir con el paso de evaluación del proyecto por parte de la Dirección Académica de la Carrera de `.$consulta[0]['ciud_carrera'].`.</p> 

                        <p>Adjunto el informe generado por el sistema Turnitin. Le pido revisar dicho documento, podría haber algunos comentarios de mi parte. Además, adjunto documento original para consideración del coordinador de investigación de la carrera/facultad –encargado de la próxima evaluación-.</p>

                        <p>Saludos cordiales,</p>

                        <p>Francis Tupa Andrade</p>
                        <p>Especialista en Gestión de Información</p>

                    </body>
                    </html>`;
    }elseif($consulta[0]['porcentaje'] <=10){
        $subject = "[DGIDI-UCSUR] Denegación al registro de proyecto de tesis de #nombre de tesista#";
        $message .= `<html>
                    <head>
                        <title>Denegación de registro de proyecto de tesis</title>
                    </head>
                    <body>
                        <strong>Estimado(a),</strong>
                        <p>(`.$consulta[0]['doc_ticket'].`)</p>`;
                        foreach($consulta as $item){
                            $message .=`<p>(`.$item['ciudadano_full_name'].`)</p>`;
                        }
                        $message .=`<p>Buen día. Me comunicó con usted para informarle que luego de la evaluación de su proyecto titulado “`.$consulta[0]['doc_asunto'].`”, a través del sistema Turnitin, el porcentaje encontrado ha excedido el punto de corte que consideramos aceptable (`.$consulta[0]['porcentaje'].`) por lo que no podemos registrarlo. Le pido que corrija los textos que son observados, los cuales son similares con fuentes externas (mediante el parafraseo, la colocación de comillas o, mejor, resumiendo los párrafos y escribiéndolos de acuerdo con sus propias palabras).</p>

                        <p>Le adjunto el informe de Turnitin. El texto “observado” corresponde a aquel que resulta similar con fuentes externas; el mismo está resaltado con diferentes colores. Para identificar la fuente con la cual resulta similar, revise el texto resaltado e identifique el número con el que está acompañado (presente en una burbuja de color azul).</p>

                        <p>Luego, vaya a la última parte del texto y encontrará las fuentes en detalle además de algunos comentarios míos. Las correcciones tienen que ser hechas sobre todo en los lugares en donde figuran mis comentarios.</p>

                        <p>Podrá enviarnos la nueva versión corregida, siguiendo el mismo procedimiento que realizó inicialmente. Se cierra ticket.</p>

                        <p>Saludos cordiales, </p>

                        <p>Francis Tupa Andrade</p>
                        <p>Especialista en Gestión de Información</p>


                    </body>
                    </html>`;
    }
    print_r($message);exit;
   mail($to, $subject, $message, $headers) ;
?>
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
        $html = `<html>
                    <head>
                        <title>HTML</title>
                    </head>
                    <body>
                    Estimado(a),
                        #Autor_principal# (`.$consulta['doc_ticket'].`)
                        Presente. –

                        <p>Tenga un buen día. Con fecha 2 de Diciembre de 2020, me comunico con usted a nombre de la Dirección General de Investigación, Desarrollo e Innovación (DGIDI) de la Universidad Científica del Sur. El motivo de este correo es para indicarle que el proyecto titulado: “#Nombre_del_proyecto#”, ha sido revisado mediante el sistema Turnitin no encontrándose sospecha de plagio.</p>

                        <p>En tal sentido, luego de este proceso y la validación de parte de su asesor, le informo que su proyecto queda registrado con el código N° #Codigo_de_Proyecto#. Con este identificador podrá seguir con el paso de evaluación del proyecto por parte de la Dirección Académica de la Carrera de #carrera_profesional#.</p> 

                        <p>Adjunto el informe generado por el sistema Turnitin. Le pido revisar dicho documento, podría haber algunos comentarios de mi parte. Además, adjunto documento original para consideración del coordinador de investigación de la carrera/facultad –encargado de la próxima evaluación-.</p>

                        <p>Saludos cordiales,</p>

                        <p>Francis Tupa Andrade</p>
                        <p>Especialista en Gestión de Información</p>

                    </body>
                    </html>`;
    }

?>
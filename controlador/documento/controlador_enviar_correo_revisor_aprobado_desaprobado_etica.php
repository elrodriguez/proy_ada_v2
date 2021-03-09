<?php
session_start();
    require '../../modelo/modelo_documento_coordinador.php';
    include 'config_correo.php';
    $corr=correo();
    $pass=password();
    $host=host();
    $port=puerto();
    $ruta_archivo=ruta();
    $documento = $_REQUEST['doc']; //recupera id documento
    $correo = $_REQUEST['correo'];
    $MC = new Modelo_documento();
    $consulta = $MC->obtenerdocumento($documento);
    $ciudadanos = $MC->obtenerciudadanos($documento);
    $revisores = $MC->obtenerrevisores($documento);
    // $jurados = $MC->obtenerjurados($documento);
    // $asesores = $MC->obtenerasesores($documento);
    $tesistas = '';
    foreach($revisores as $item){
        $revisores .="-".$item['full_name']." <br> ";
    }
    foreach($ciudadanos as $item){
        $tesistas .=$item['nombre_completo']." // ";
    }

    $fechaActual = date('d-m-Y');
    $date_past = strtotime('+21 day', strtotime($fechaActual));
    $date_past = date('d-m-Y', $date_past);
    $message = '';
    if($consulta[0]['estado_paso_cuatro']=='APROBADO'){
        $subject = "COMITE DE ETICA APROBACION DEL PROYECTO DE INVESTIGACION";
        $message .= "<html>
                    <head>
                        <title>Proyecto Tesis</title>
                    </head>
                    <body>
                        <strong>Estimado(a)(s) tesista (s),</strong>".$tesistas;
                        foreach($ciudadanos as $item){
                            $message .="<p>".$item['nombre_completo']."</p>";
                        }
        $message .="

                        <p>Buen día. Me comunico con usted para informarle que el proyecto de investigación titulado: “".$consulta[0]['doc_asunto']."”, ha sido aprobado de acuerdo con lo indicado en el documento que adjunto (#N_Constancia#). De querer una versión impresa, puede acercarse a nuestra oficina, cuando se restablezcan las actividades presenciales, y gentilmente le entregaremos una copia.</p>
                        <p>De necesitar el uso de bienes (equipos de laboratorio, etc.) o información de la Universidad (bases de datos, permisos para realizar encuestas dentro de la Universidad); o cartas de presentación (ante SERFOR, SERNAMP, PRODUCE, etc.), por favor comunicarse con la Srta. Vanessa Quispe Flores (gquispe@cientifica.edu.pe) con el formato (descargue aquí) debidamente rellenado. En caso contrario no tiene que realizar algo adicional.</p>
                        <p>Saludos cordiales, </p>
                        <p>H. Rubén Borja García</p>
                        <p>Secretario técnico</p>
                        <p>Comité Institucional de Ética en Investigación </p>
                        <p>Universidad Científica del Sur </p>

                    </body>
                    </html>";
    }elseif($consulta[0]['estado_paso_cuatro']=='DESAPROBADO'){
        $subject = "[COMITE ETICA] OBSERVACION DE PROYECTO DE TESIS";
        $message .= "<html>
                    <head>
                        <title>TESIS OBSERVADO</title>
                    </head>
                    <body>
                        <strong>Estimado(a) (s) tesista (s),</strong>
                        <strong>Estimado(a)(s) tesista (s),</strong>".$tesistas;
                        foreach($ciudadanos as $item){
                            $message .="<p>".$item['nombre_completo']."</p>";
                        }
                        $message .="<p>Buenas tardes. Luego de la evaluación del proyecto de investigación titulado:“".$consulta[0]['doc_asunto']."”, el CIEI-CIENTÍFICA (fecha de revisión: #Fecha_de_decisión(crga del archivo)# ) ha considerado oportuno hacerle algunas consultas antes de dar una decisión final, las cuales</p>

                        <p>son:</p>
                        <p>1. #Comentarios#</p>
                        <p>Toda aclaración deberá estar contenida en el documento corregido, en color rojo, con el fin de facilitar la revisión. La no realización de dicha acción puede ser motivo de no aceptar el levantamiento de las observaciones enviado. </p>
                        <p>Adicionalmente, le pido que use el formato (descargar aquí*) que deberá ser rellenado por su persona, en el que se detalla las acciones realizadas para levantar cada observación. Esta comunicación deber ser remitida a cieicientifica@cientifica.edu.pe </p>
                        <p>Estaremos a la espera de su respuesta.</p>
                        <p>Helbert Rubén Borja García</p>
                        <p>Secretario técnico</p>
                        <p>Universidad Científica del Sur </p>
                        </body>
                    </html>";
    }
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../../vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = $host;                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = $corr;                     //SMTP username
      $mail->Password   = $pass;                           //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = $port;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

      //Recipients
      $mail->setFrom($corr, $_SESSION['usuario']);
      $mail->addAddress($correo, 'el ususario');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $fichero ='C:/xampp/htdocs/proy_ada_v2/'.$consulta[0]['archivo_turniting']; ///en local
        // $fichero ='http://proyada.local/'.$consulta[0]['archivo_turniting']; ///produccion
        //print_r($fichero);exit;
        // $mail->addAttachment($fichero,"Informe_Turniting.pdf");                  //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message fue enviado';
    } catch (Exception $e) {
        echo "Error en el mensaje. Mailer Error: {$mail->ErrorInfo}";
    }

?>

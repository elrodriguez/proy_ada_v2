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
    // $revisores = $MC->obtenerrevisores($documento);
    $jurados = $MC->obtenerjurados($documento);
    // $asesores = $MC->obtenerasesores($documento);
    $tesistas = '';
    foreach($jurados as $item){
        $jurados .="-".$item['full_name']." <br> ";
    }
    foreach($ciudadanos as $item){
        $tesistas .=$item['nombre_completo']." // ";
    }
    $message = '';
    $fechaActual = date('d-m-Y');
    $date_past = strtotime('+14 day', strtotime($fechaActual));
    $date_past = date('d-m-Y', $date_past);

    $subject = "NOMBRAMIENTO DE JURADO EXAMINADOR - Lima ".$fechaActual;
    $message .= "<html>
                    <head>
                        <title>--</title>
                    </head>
                    <body>";
        $message .="
                        <p>Estimados docentes, Por el presente quiero comunicarles que han sido designados como miembros de jurado examinador de tesis. </p>
                        <p>Teniendo en cuenta la importancia de este tema, esperamos su máxima colaboración para cumplir con los plazos establecido (14 días hábiles) pueden hacerlo antes. </p>
                        <p>Fecha límite de entrega: ".$date_past."</p>
                        <p>Procedimiento:</p>
                        <p>- Revisar la tesis</p>
                        <p>- Si consideran que la tesis se encuentra APTA PARA SUSTENTAR, el presidente del Jurado deberá informar a través del ANEXO 10</p>
                        <p>- Si entre ustedes consideran que la tesis se encuentra NO APTA PARA SUSTENTAR, el presidente del Jurado deberá consolidar y listar las observaciones</p>
                        <p>Jurado examinador de tesis:</p>
                        <p>".$jurados."</p>
                        <p>Agradeceré confirmar la recepción de este correo.</p>
                        <p>Descargar Anexo en el siguiente enlace</p>
                        <p></p>
                        <p>Atte. responsable del área de Investigación - Facultad de Ciencias Empresariales</p>

                    </body>
                    </html>";
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

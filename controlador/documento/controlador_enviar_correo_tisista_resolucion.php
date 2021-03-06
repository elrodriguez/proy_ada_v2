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
    $message = '';
    $fechaActual = date('d-m-Y');
    $date_past = strtotime('+14 day', strtotime($fechaActual));
    $date_past = date('d-m-Y', $date_past);

    $subject = "RESOLUCION DIRECTORAL";
    $message .= "<html>
                    <head>
                        <title>REVISORES</title>
                    </head>
                    <body>
                        <strong>Estimado(a),</strong>
                        <p>".$tesistas."</p>";
        $message .="
                        <p>Adjunto la resolución directoral Firmada por el Decano sobre la aceptación de su tema: “".$consulta[0]['doc_asunto']."”. </p>
                        <p>De acuerdo al Reglamento General de la Universidad Científica del Sur y los reglamentos de pregrado para obtener el título profesional de «Título que otorga el programa académico» en el programa académico de «Programa académico», se debe desarrollar un trabajo de investigación.</p>
                        <p>Tiene plazo de tiempo hasta #Fecha final# para desarrollar el proyecto de investigación y solicitar una revisión para la sustentación.</p>
                        <p>Estaremos a la espera de su respuesta</p>
                        <p>Atte. # coordinador que selecciono el caso#</p>

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

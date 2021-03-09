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

    $subject = "[DGIDI-UCSUR] DESIGNACION DE COMITE DE REVISION INDEPENDIENTE ACADEMICA - LIMA- ".$fechaActual;
    $message .= "<html>
                    <head>
                        <title>REVISORES</title>
                    </head>
                    <body>
                        <strong>Estimado(a),</strong>
                        <p>".$revisores."</p>";
        $message .="<p>COMITE DE EVALUACIÓN <br> Universidad Cient&iacute;fica del Sur</p>
                    <p>Presente.-</p>
                    <p>De mi consideración,</p>
                        <p>Es muy grato dirigirme a usted para informarle que el proyecto de tesis:“".$consulta[0]['doc_asunto']."”, del estudiante (s)  ".$tesistas.". ha sido enviada a nuestra dirección para su evaluación independiente Académica. </p>
                        <p>En tal sentido reconocido por su experticia en su especialidad, le solicitó la evaluación del proyecto de tesis y nos indique si es que guarda los criterios de coherencia y validez metodológica y científica.</p>
                        <p>El plazo de proyecto no puede exceder los 14 días hábiles siendo su cumplimiento el ".$date_past."</p>
                        <p>Es propicia la ocasión para reiterarle mi estima y consideración personal.</p>
                        <p>Especialista en Gestión de Información</p>
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

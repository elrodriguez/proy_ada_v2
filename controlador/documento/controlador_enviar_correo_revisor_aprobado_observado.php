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
    if($consulta[0]['estado_paso_tres']=='APROBADO'){
        $subject = "APROBACION DE PROYECTO DE TESIS";
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
                        <p>Es muy grato dirigirme a usted para indicarle que su proyecto de tesis ha sido APROBADO, se adjunta informe ANEXO 6, las observaciones, están adjuntas en dicho documento la aprobación definitiva de su proyecto de Tesis En Dirección Académica. Se realizará mediante mediante Resolución Directoral, para lo que se requerirá, junto con esta evaluación, la aprobación de un Comité de Ética. Por lo tanto, se eleva el presente comunicado al área DGIDI para la evaluación Ética.</p>
                        <p>El siguiente paso es continuar con el desarrollo del ANEXO 7</p>
                        <p>Recuerde que usted cuenta con un plazo de 12 meses para el desarrollo del proyecto, desde la aprobación del anteproyecto hasta la sustentación de la tesis, según las Normas y procedimientos de los trabajos de Investigación para la obtención de títulos profesionales y grados académicos de la universidad científica del sur.</p>
                        <p>En caso requiera solicitar la ampliación del plazo deberá realizar su solicitud ANEXO 6-B</p>
                        <p>DESCARGAR PROCEDIMIENTOS Y ANEXOS EN EL SIGUIENTE ENLACE:</p>

                    </body>
                    </html>";
    }elseif($consulta[0]['estado_paso_tres']=='OBSERVADO'){
        $subject = "[DGIDI-UCSUR] OBSERVACION DE PROYECTO DE TESIS";
        $message .= "<html>
                    <head>
                        <title>TESIS OBSERVADO</title>
                    </head>
                    <body>
                        <strong>Estimado(a) (s) tesista (s),</strong>
                        <p>Adjunto el Informe del Jurado Revisor de Tesis OBSERVADO</p>";
                        foreach($ciudadanos as $item){
                            $message .="<p>".$item['nombre_completo']."</p>";
                        }
                        $message .="<p>De acuerdo con el reglamento usted dispone de (21) días hábiles para resolver las observaciones y enviar al correo #Correo de Coordinador que envía el correo # Adjuntando los Siguientes Documentos:</p>

                        <p>- Anexo 6 (Acta de Observaciones).</p>
                        <p>-	Anexo 6-A (Acta de Observaciones levantadas).</p>
                        <p>-	Anexo 3, versión actualizada de su proyecto de tesis.</p>
                        <p>Fecha límite de entrega: ".$date_past."</p>
                        <p>en caso que no cumpla con el plazo se dará por DESAPROBADO el proyecto de tesis según las Normas y procedimientos de los trabajos de Investigación para la obtención de titulos profesionales y grados académicos</p>
                        <p>En caso de más tiempo deberá informarlo.</p>
                        <p>DESCARGAR PROCEDIMIENTOS Y ANEXOS EN EL SIGUIENTE ENLACE:</p>
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

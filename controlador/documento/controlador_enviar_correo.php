<?php
session_start();
    require '../../modelo/modelo_documento_coordinador.php';

    $documento = $_REQUEST['doc']; //recupera id documento
    $correo = $_REQUEST['correo'];
    $MC = new Modelo_documento();
    $consulta = $MC->obtenerdocumento($documento);
    $ciudadanos = $MC->obtenerciudadanos($documento);
    $revisores = $MC->obtenerrevisores($documento);
    $jurados = $MC->obtenerjurados($documento);
    $asesores = $MC->obtenerasesores($documento);
    $tesistas = '';
    foreach($ciudadanos as $item){
        $tesistas .=$item['nombre_completo']." // ";
    }
    $message = '';
    if($consulta[0]['porcentaje'] <=10){
        $subject = "[DGIDI-UCSUR] REGISTRO DE PROYECTO DE INVESTIGACION / PROYECTO TESIS DE ".$tesistas;
        $message .= "<html>
                    <head>
                        <title>Proyecto de tesis aceptado</title>
                    </head>
                    <body>
                        <strong>Estimado(a),</strong>
                        <p>ticket(".$consulta[0]['doc_ticket'].")</p>";
                        foreach($ciudadanos as $item){
                            $message .="<p>".$item['nombre_completo']."</p>";
                        }
                        $fechaActual = date('d-m-Y');
        $message .="<p>Presente. –</p>

                        <p>Tenga un buen día. Con fecha".$fechaActual.", me comunico con usted a nombre de la Dirección General de Investigación, Desarrollo e Innovación (DGIDI) de la Universidad Científica del Sur. El motivo de este correo es para indicarle que el proyecto titulado: “".$consulta[0]['doc_asunto']."”, ha sido revisado mediante el sistema Turnitin no <strong>encontrándose sospecha de plagio.</strong></p>

                        <p>En tal sentido, luego de este proceso y la validación de parte de su asesor, le informo que su proyecto queda registrado con el código N° ".$consulta[0]['documento_cod'].". Con este identificador podrá seguir con el paso de evaluación del proyecto por parte de la Dirección Académica de la Carrera de </p>

                        <p>Adjunto el informe generado por el sistema Turnitin. Le pido revisar dicho documento, podría haber algunos comentarios de mi parte. Además, adjunto documento original para consideración del coordinador de investigación de la carrera/facultad –encargado de la próxima evaluación-.</p>

                        <p>Saludos cordiales,</p>

                        <p>Francis Tupa Andrade</p>
                        <p>Especialista en Gestión de Información</p>
                    </body>
                    </html>";
    }elseif($consulta[0]['porcentaje'] >10){
        $subject = "[DGIDI-UCSUR] DENEGACION AL REGISTRO DE PROYECTO DE TESIS DE ".$tesistas ;
        $message .= "<html>
                    <head>
                        <title>Denegación de registro de proyecto de tesis</title>
                    </head>
                    <body>
                        <strong>Estimado(a),</strong>
                        <p>ticket(".$consulta[0]['doc_ticket'].")</p>";
                        foreach($ciudadanos as $item){
                            $message .="<p>".$item['nombre_completo']."</p>";
                        }
                        $message .="<p>Buen día. Me comunicó con usted para informarle que luego de la evaluación de su proyecto titulado <strong> “".$consulta[0]['doc_asunto']."”, </strong>a través del sistema Turnitin, el porcentaje encontrado ha excedido el punto de corte que consideramos aceptable <strong>(".$consulta[0]['porcentaje'].") </strong>por lo que no podemos registrarlo. Le pido que corrija los textos que son observados, los cuales son similares con fuentes externas (mediante el parafraseo, la colocación de comillas o, mejor, resumiendo los párrafos y escribiéndolos de acuerdo con sus propias palabras).</p>

                        <p>Le adjunto el informe de Turnitin. El texto “observado” corresponde a aquel que resulta similar con fuentes externas; el mismo está resaltado con diferentes colores. Para identificar la fuente con la cual resulta similar, revise el texto resaltado e identifique el número con el que está acompañado (presente en una burbuja de color azul).</p>

                        <p>Luego, vaya a la última parte del texto y encontrará las fuentes en detalle además de algunos comentarios míos. Las correcciones tienen que ser hechas sobre todo en los lugares en donde figuran mis comentarios.</p>

                        <p>Podrá enviarnos la nueva versión corregida, siguiendo el mismo procedimiento que realizó inicialmente. Se cierra ticket.</p>

                        <p>Saludos cordiales, </p>

                        <p>Francis Tupa Andrade</p>
                        <p>Especialista en Gestión de Información</p>


                    </body>
                    </html>";
    }
    include 'config_correo.php';
    $corr=correo();
    $pass=password();
    $host=host();
    $ruta_archivo=ruta();
    $port=puerto();

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
        $fichero =$ruta_archivo.$consulta[0]['archivo_turniting']; ///en local
        // $fichero ='http://proyada.local/'.$consulta[0]['archivo_turniting']; ///produccion
        //print_r($fichero);exit;
        $mail->addAttachment($fichero,"Informe_Turniting.pdf");                  //Add attachments
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

<?php 
    session_start();
    $text_default = $_POST["body"];
    $resolution = $_POST["resolucion"];
    $observaciones = $_POST["observaciones"];
    $tipo_permiso = $_SESSION["tipo_permiso"];
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader (created by composer, not included with PHPMailer)
    require 'libs/vendor/autoload.php';
    require_once "db.php";

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'desarrolloweb2527@gmail.com';                     //SMTP username
    $mail->Password   = "gxqu sapg gaiw kpcs";                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Laura Ramon Elizondo');
    $mail->addAddress($_SESSION["user_email"]);
    $mail->addAddress("mejialepizpablo@gmail.com");
    if($resolution == "Aceptar con rebajo salarial total" || $resolution == "Aceptar con rebajo salarial parcial"){
        $mail->addAddress("ethanarojas31@gmail.com");
    }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Resolucion Permiso de ' . $tipo_permiso;
    $mail->Body    = $text_default . " " . $resolution . "<br><br>Observaciones: " . $observaciones;

    $mail->send();
    $connection = Connect_DB();
    if($tipo_permiso == "omision"){
        $sql = "DELETE FROM omision WHERE cedula = ?";
    }
    else if ($tipo_permiso == "solicitud_salida"){
        $sql = "DELETE FROM solicitud_salida WHERE cedula = ?";
    }
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $_SESSION["user_id"]);
    $stmt->execute();
    $stmt->close();
    $connection->close();
    header("location: correo_enviado.html");
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'libs/vendor/autoload.php'; 
    require_once "db.php";
    $connection = Connect_DB();
    $null = null;
    $mail = new PHPMailer(true);

    if ($_POST["tipo_permiso"] == "omision"){
        $name = $_POST["name"];
        $job_position = $_POST["job_position"];
        $id = $_POST["cedula"];
        $instance = $_POST["instancia"];
        $event_date = $_POST["fecha_evento"];
        $entry = $_POST["entrada"];
        $exit = $_POST["salida"];
        $journey = $_POST["jornada"];
        $justification = $_POST["justificacion"];

        $sql = "INSERT INTO omision(nombre, cedula, rol, instancia, fecha_evento, entrada, salida, tipo_omision, justificacion) VALUES (?, ?, ?, ?, ?, ? , ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sisssssss", $name, $id, $job_position, $instance, $event_date, $entry, $exit, $journey, $justification);
        $stmt->execute();
        $mail->Subject = "Nueva Solicitud de Omision de Marca - $name";
        $mail->Body = "
        <h2>Justificación de Omisión de Marca</h2> <br><br>
        <p><b>Nombre:</b> $name</p><br>
        <p><b>Puesto:</b> $job_position</p><br>
        <p><b>Cédula:</b> $id</p><br>
        <p><b>Instancia:</b> $instance</p><br>
        <p><b>Fecha:</b> $event_date</p><br>
        <p><b>Entrada:</b> $entry</p><br>
        <p><b>Salida:</b> $exit</p><br>
        <p><b>Jornada:</b> $journey</p><br>
        <p><b>Justificación:</b> $justification</p>
        ";
    }
    else if($_POST["tipo_permiso"] == "salida"){
        $name = $_POST["name"];
        $job_position = $_POST["job_position"];
        $id = $_POST["cedula"];
        $condition = $_POST["condicion"];
        $prof_group = $_POST["prof_group"];
        $lessons = $_POST["lessons"];
        $exit_date = $_POST["exit_date"];
        $exit_hour = $_POST["exit_hour"];
        $final_hour = $_POST["final_hour"];
        $journey = $_POST["jornada"];
        $reason = $_POST["motivo"];
        $observations = $_POST["observaciones"];
        $sending_hour = $_POST["hora_envio"];
        $sending_date = $_POST["fecha_envio"];

// Procesar firma
    if (isset($_FILES['firma']) && $_FILES['firma']['error'] == 0) {
        $fileTmpPath = $_FILES['firma']['tmp_name'];
        $fileName = $_FILES['firma']['name'];
        $fileType = $_FILES['firma']['type'];

        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        if (!in_array($fileType, $allowedTypes)) {
            echo "Solo se permiten firma PDF, JPG y PNG.";
            exit;
        }

        $fileContent = file_get_contents($fileTmpPath);
    } else {
        $fileName = null;
        $fileType = null;
        $fileContent = null;
    }

    // Insertar solicitud de salida con firma
    $sql = "INSERT INTO solicitud_salida(nombre, cedula, rol, condicion, grupo_profesional, fecha, fecha_evento, hora_inicio, hora_fin, total_lecciones, jornada, motivo, observaciones, hora_presentado, nombre_firma, tipo_firma, firma) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $connection->prepare($sql);
    $stmt->bind_param(
        "sssssssssissssssb",
        $name, $id, $job_position, $condition, $prof_group, $sending_date,
        $exit_date, $exit_hour, $final_hour, $lessons, $journey, $reason,
        $observations, $sending_hour, $fileName, $fileType, $null
    );
    $stmt->send_long_data(16, $fileContent);
    $stmt->execute();
    $mail->Subject = "Nueva Solicitud de Permiso de salida - $name";
    $mail->Body    = "
        <h2>Justificación de Permiso De Salida</h2> <br><br>
        <p><b>Nombre:</b> $name</p><br>
        <p><b>Puesto:</b> $job_position</p><br>
        <p><b>Cédula:</b> $id</p><br>
        <p><b>Condición:</b> $condition</p><br>
        <p><b>Grupo Profesional:</b>$prof_group</p><br>
        <p><b>Lecciones:</b>$lessons</p><br>
        <p><b>Fecha de salida:</b>$exit_date</p><br>
        <p><b>Hora de salida:</b>$exit_hour</p><br>
        <p><b>Hora Final:</b>$final_hour</p><br>
        <p><b>Jornada:</b> $journey</p><br>
        <p><b>Motivo:</b>$reason</p><br>
        <p><b>Observaciones:</b>$observations</p><br>
        <p><b>Fecha de envío:</b> $sending_date</p><br>
        <p><b>Hora de envío:</b>$sending_hour</p><br>
    ";
    } else {
        echo "Error al guardar la solicitud de salida.";
    }



    try {
    // Configuración servidor
    $mail->SMTPDebug = 0; 
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'desarrolloweb2527@gmail.com'; 
    $mail->Password   = "gxqu sapg gaiw kpcs"; // ⚠️ Usar contraseña de aplicación
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Destinatarios
    $mail->setFrom('desarrolloweb2527@gmail.com', 'Sistema Permisos CTPMN');
    $mail->addAddress("aaroncastillo009@gmail.com");
    $mail->addAddress("mejialepizpablo@gmail.com"); // dirección fija del receptor del correo(doña laura)

    // Contenido
    $mail->isHTML(true);

    $mail->send();
    header("Location: inicio.php");
    exit();
} catch (Exception $e) {
    echo "No se pudo enviar el mensaje. Error: {$mail->ErrorInfo}";
}

/*
    $prof_gruop = $_POST["prof_group"];
    $lessons = $_POST["lessons"];
    $type_justification = $_POST["justifico"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $condition = $_POST["condicion"];
    */


    $stmt->close();
    $connection->close();
    header("Location: inicio.php");
?>
<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="es">
    <title>Formulario Permiso</title>
    <link rel="stylesheet" href="css/estilo_solicitud.css">
</head>
<body>
    <header>          
        <nav>
            <a href="#">INICIO</a>
            <img src="img/logo.png" class="logo">
        </nav>
    </header>
    <form class="all" action="solicitud_permiso.php" method="post">
        <section class="first">
            <h1>Formulario de Solicitud de Ausencia, Llegada Tardía, Incapacidades</h1>
            <hr>
            <div class="general">
                <p>Quién elabora en la institución educativa CTP Mercedes Norte, con las siguientes condiciones:</p>
                <div>
                    <div class="space">
                        <label>Nombre Completo: </label>
                        <input type="text" name="nombre" class="fill" value="<?php echo $_SESSION["user"]?>">
                    </div>
                    <div class="space space-inline">
                        <div>
                            <label>Puesto Laboral: </label>
                            <select class="fill-small" name="job_position" required>
                                <option value="" disabled selected hidden><?php echo $_SESSION["rol"]?></option>
                                <option value="admin">Administrativo</option>
                                <option value="profesor">Profesor</option>
                            </select>
                        </div>
                        <div>
                            <label>Cédula: </label>
                            <input type="text" class="fill-small id" value="<?php echo $_SESSION["cedula"]?>">
                        </div>
                    </div>
                    <div class="checkbox checkbox-inline">
                        <label>En condición: </label>
                        <div class="radio-group">
                            <input type="radio" id="condicion_propietario" name="condicion" value="propietario">
                            <label for="condicion_propietario">Propietario</label>
                            <input type="radio" id="condicion_interino" name="condicion" value="interino">
                            <label for="condicion_interino">Interino</label>
                        </div>
                    </div>
                    <div class="space">
                        <label>Grupo Profesional: </label>
                        <input type="text" class="fill-small" name="prof_group" value="<?php echo $_SESSION["grupo_profesional"]?>">
                    </div>
                    <div class="space">
                        <label>Total de lecciones: </label>
                        <input type="text" name="lessons" class="fill-small">
                    </div>
                    <div class="checkbox">
                        <label>Solicito <strong>permiso para: </strong></label>
                        <div class="radio-group">
                            <input type="radio" id="justifico_ausencia" name="justifico" value="ausencia">
                            <label for="justifico_ausencia">Ausencia</label>
                            <input type="radio" id="justifico_tardia" name="justifico" value="tardia">
                            <label for="justifico_tardia">Tardía</label>
                            <input type="radio" id="justifico_etc" name="justifico" value="etc">
                            <label for="justifico_etc">Etc.</label>
                        </div>
                    </div>
                    <div class="space">
                        <label>En la <strong>fecha</strong>: </label>
                        <input type="date" class="fill-small">
                    </div>
                    <div class="space space-inline">
                        <div class="space">
                            <label>Hora: desde las </label>
                            <input type="text" class="fill-small" maxlength="10">
                        </div>
                        <div class="space">
                            <label> hasta las </label>
                            <input type="text" class="fill-small" maxlength="10">
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>Jornada: </label>
                        <div class="radio-group">
                            <input type="radio" id="jornada_completa" name="jornada" value="completa">
                            <label for="jornada_completa">Jornada Completa</label>
                            <input type="radio" id="jornada_media" name="jornada" value="media">
                            <label for="jornada_media">Media Jornada</label>
                            <input type="radio" id="jornada_manana" name="jornada" value="manana">
                            <label for="jornada_manana">Mañana</label>
                            <input type="radio" id="jornada_tarde" name="jornada" value="tarde">
                            <label for="jornada_tarde">Tarde</label>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="second">
            <div class="tablas">
                    <table class="tabla">
                        <tr class="pepe">
                            <td>Cita Médica Pesonal</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr class="pepe">
                            <td>Acompañamiento a cita médica de familiar directo</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr class="pepe">
                            <td>Asistencia a Convocatoria</td>
                            <div class="conv-container">
                                <td class="checkbox-conv"><input type="checkbox">Regional</td>
                                <td class="checkbox-conv"><input type="checkbox">Nacional</td>
                                <td class="checkbox-conv"><input type="checkbox">Circuital</td>
                                <td class="checkbox-conv"><input type="checkbox">Sindical</td>
                            </div>
                        </tr>
                        <tr>
                            <td>Atención de asuntos personales</td>
                            <td><input type="text" class="fill-smaller"></td>
                        </tr>
                    </table>
                </div>
                <div>
                <label for="file">Adjunto Comprobante</label>
                <input type="file" id="file" name="file">
                </div>
        </section>
        <section class="thrid">
            <div>
                <label>Observaciones</label>
                <input type="text">
            </div>
            <div>
                <label>Saliendo del centro educativo a las <input type="time"> Presento la solicitud a las
                    <input type="time"> del mes <input type="number" id="month" maxlength="20"> del año 2025 en <strong>CTP Mercedes Norte.</strong>
            </div>
            <div>
                <label>Firma del/la funcionario (a):</label>
                <input type="text">
            </div>
            <br>
            <p>Importante: Todo permiso de ausencia laboral está sujeto a cumplimiento de requisitos y copia adjunta de documento pertinente de cita, convocatoria o licencia,
                de ser posible con tres días de anticipación. Posterior a la ausencia_y/o tardia, _el funcionario debe hacer entrega del comprobante pertinente de
                justificacion de asistencia en el plazo no mayor de 48 (cuarenta y ocho horas). Las licencias dependen de requisitos previos para su goce. De no presentar
                el comprobante se tramitará lo que corresponda.</p>
        </section>
        <input class="button" type="submit" value="Enviar todo">
    </form>
    <footer>
        <p><strong>CTPMN</strong></p>
        <p>Heredia, Mercedes Norte del Templo Católica</p>
        <p>TEL: 22605090 // 22617445</p>
        <p>Correo: ctp.mercedes.norte@mep.go.cr</p>
    </footer>
</body>
</html>
<?php 
  session_start();
  require_once "db.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Revisión de formularios</title>
  <link rel="stylesheet" href="css/revision_forms.css" />
</head>
<body>

    <header>
        <img src="img/logo mejorado 1.png" class="logo" alt="Logo CTPMN">
        <a href="inicio_especial.html" class="link-inicio">Inicio</a>
    </header>

  <main>
    <h1>Revisión de formularios</h1>
    <h2>Omision de Marca</h2>
    <div class="table">
      <div class="row">
        <div class="column omision"><p>Nombre</p></div>
        <div class="column omision"><p>Cedula</p></div>
        <div class="column omision"><p>Puesto</p></div>
        <div class="column omision"><p>Instancia</p></div>
        <div class="column omision"><p>Fecha de Evento</p></div>
        <div class="column omision"><p>Hora Entrada</p></div>
        <div class="column omision"><p>Hora Salida</p></div>
        <div class="column omision"><p>Tipo de Omision</p></div>
        <div class="column omision"><p>Justificacion</p></div>
        <div class="column omision"><p>Resolucion</p></div>
      </div>
      <?php 
        $connection = Connect_DB();
        $sql = "SELECT * FROM omision";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $element){
          echo '<div class="row">
              <div class="column omision">' . $element["nombre"] . '</div>
              <div class="column omision">' . $element["cedula"] . '</div>
              <div class="column omision">' . ucfirst($element["rol"])  . '</div>
              <div class="column omision">' . $element["instancia"] . '</div>
              <div class="column omision">' . $element["fecha_evento"] . '</div>
              <div class="column omision">' . $element["entrada"] . '</div>
              <div class="column omision">' . $element["salida"] . '</div>
              <div class="column omision">' . $element["tipo_omision"] . '</div>
              <div class="column omision">' . $element["justificacion"] . '</div>
              <div class="column omision">
                <form action="resolucion.php" class="button_form" method="post"> 
                  <input type="hidden" name="cedula" value="' . $element["cedula"] . '">
                  <input type="hidden" name="tipo_permiso" value="omision">
                  <input type="submit" value="Resolucion"class="button">
                </form>
              </div>
            </div>';
        }
      ?>
    </div>
    <h2>Solicitud permiso de salida</h2>
    <div class="table">
      <div class="row">
        <div class="column solicitud_salida"><p>Nombre</p></div>
        <div class="column solicitud_salida"><p>Cedula</p></div>
        <div class="column solicitud_salida"><p>Puesto</p></div>
        <div class="column solicitud_salida"><p>Condicion</p></div>
        <div class="column solicitud_salida"><p>Fecha envio</p></div>
        <div class="column solicitud_salida"><p>Hora envio</p></div>
        <div class="column solicitud_salida"><p>Fecha evento</p></div>
        <div class="column solicitud_salida"><p>Jornada</p></div>
        <div class="column solicitud_salida"><p>Hora Salida</p></div>
        <div class="column solicitud_salida"><p>Hora Final</p></div>
        <div class="column solicitud_salida"><p>Lecciones</p></div>
        <div class="column solicitud_salida"><p>Motivo</p></div>
        <div class="column solicitud_salida"><p>Firma</p></div>
        <div class="column solicitud_salida"><p>Resolucion</p></div>
      </div>
            <?php 
        $connection = Connect_DB();
        $sql = "SELECT * FROM solicitud_salida";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $element){
          echo '<div class="row">
              <div class="column solicitud_salida">' . $element["nombre"] . '</div>
              <div class="column solicitud_salida">' . $element["cedula"] . '</div>
              <div class="column solicitud_salida">' . ucfirst($element["rol"])  . '</div>
              <div class="column solicitud_salida">' . $element["condicion"] . '</div>
              <div class="column solicitud_salida">' . $element["fecha"] . '</div>
              <div class="column solicitud_salida">' . $element["hora_presentado"] . '</div>
              <div class="column solicitud_salida">' . $element["fecha_evento"] . '</div>
              <div class="column solicitud_salida">' . $element["jornada"] . '</div>
              <div class="column solicitud_salida">' . $element["hora_inicio"] . '</div>
              <div class="column solicitud_salida">' . $element["hora_fin"] . '</div>
              <div class="column solicitud_salida">' . $element["total_lecciones"] . '</div>
              <div class="column solicitud_salida">' . $element["motivo"] . '</div>
              <div class="column solicitud_salida"> <img class="firma" src="http://localhost/prueba/ver_firma.php?id=' . $element["id"] . '" alt=""> </div>

              <div class="column solicitud_salida">
                <form action="resolucion.php" class="button_form" method="post"> 
                  <input type="hidden" name="cedula" value="' . $element["cedula"] . '">
                  <input type="hidden" name="tipo_permiso" value="solicitud_salida">
                  <input type="submit" value="Resolucion"class="button">
                </form>
              </div>
            </div>';
        }
      ?>
    </div>
  </main>
  

<footer>
    <p>Heredia, Mercedes Norte, 400 mts, norte de la Iglesia Católica</p>
    <p>TEL: 22605090 // 22617445</p>
    <p>Correo: ctp.mercedes.norte@mep.go.cr</p>
</footer>

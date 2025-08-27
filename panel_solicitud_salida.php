<?php 
require_once "db.php";
$connect = Connect_DB();

$sql = "SELECT id, nombre_firma, tipo_firma, firma FROM solicitud_salida";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Comprobantes de ausencia</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p><strong>Firma:</strong> " . $row['nombre_firma'] . "</p>";
/*cambié abrir_firma por ver_firma*/
        echo "<a href='ver_firma.php?id=" . $row['id'] . "' target='_blank'>Ver firma</a>";
        echo "</div><hr>";
    }
} else {
    echo "No hay firmas disponibles.";
}

$connect->close();
?>

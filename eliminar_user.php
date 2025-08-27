<?php 
require "db.php";
$connection = Connect_DB();
$cedula = $_POST["cedula"];
$sql = "DELETE FROM usuarios WHERE cedula = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $cedula);
$stmt->execute();
$stmt->close();
$connection->close();
header("location: users_registrados.php")
?>
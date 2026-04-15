<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../index.php");
    exit();
}

include("conexion.php");

$id_usuario = $_SESSION["id_usuario"];
$especialidad = mysqli_real_escape_string($conexion, $_POST["especialidad"]);
$fecha = mysqli_real_escape_string($conexion, $_POST["fecha"]);
$hora = mysqli_real_escape_string($conexion, $_POST["hora"]);
$estado = "Activa";

$sql = "INSERT INTO citas (id_usuario, especialidad, fecha, hora, estado)
        VALUES ('$id_usuario', '$especialidad', '$fecha', '$hora', '$estado')";

if (mysqli_query($conexion, $sql)) {
    echo "<h2>Cita guardada correctamente</h2>";
    echo "<a href='../dashboard.php'>Volver al dashboard</a><br>";
    echo "<a href='../citas.php'>Registrar otra cita</a>";
} else {
    echo "Error al guardar la cita: " . mysqli_error($conexion);
}

mysqli_close($conexion);

?>
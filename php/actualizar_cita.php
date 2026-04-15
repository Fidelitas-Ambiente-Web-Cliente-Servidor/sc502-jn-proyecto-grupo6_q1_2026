<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../index.php");
    exit();
}

include("conexion.php");

$id_cita = $_POST["id_cita"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$id_usuario = $_SESSION["id_usuario"];
$rol = $_SESSION["rol"];

if ($rol == "administrador") {
    $sql = "UPDATE citas
            SET fecha = '$fecha', hora = '$hora', estado = 'Reprogramada'
            WHERE id_cita = '$id_cita'";
} else {
    $sql = "UPDATE citas
            SET fecha = '$fecha', hora = '$hora', estado = 'Reprogramada'
            WHERE id_cita = '$id_cita' AND id_usuario = '$id_usuario'";
}

mysqli_query($conexion, $sql);

mysqli_close($conexion);

header("Location: ver_citas.php");
exit();

?>
<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../index.php");
    exit();
}

include("conexion.php");

$id_cita = $_GET["id"];
$id_usuario = $_SESSION["id_usuario"];
$rol = $_SESSION["rol"];

if ($rol == "administrador") {
    $sql = "UPDATE citas
            SET estado = 'Cancelada'
            WHERE id_cita = '$id_cita'";
} else {
    $sql = "UPDATE citas
            SET estado = 'Cancelada'
            WHERE id_cita = '$id_cita' AND id_usuario = '$id_usuario'";
}

mysqli_query($conexion, $sql);

mysqli_close($conexion);

header("Location: ver_citas.php");
exit();

?>
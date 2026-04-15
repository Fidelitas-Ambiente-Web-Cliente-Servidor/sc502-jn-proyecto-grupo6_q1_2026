<?php

$servidor = "db";
$usuario = "appuser";
$contrasena = "apppass";
$base_datos = "plataforma_salud";

$conexion = mysqli_connect($servidor, $usuario, $contrasena, $base_datos);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8mb4");

?>
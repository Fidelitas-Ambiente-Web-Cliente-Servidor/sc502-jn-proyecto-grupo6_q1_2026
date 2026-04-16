<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "plataforma_salud";

$conexion = new mysqli($host, $user, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

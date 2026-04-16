<?php

$base_datos = "plataforma_salud";

/*Docker*/
$servidor = "db";
$usuario = "appuser";
$contrasena = "apppass";

$conexion = @mysqli_connect($servidor, $usuario, $contrasena, $base_datos);


/*XAMPP*/
if (!$conexion) {
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";

    $conexion = @mysqli_connect($servidor, $usuario, $contrasena, $base_datos);
}

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8mb4");

?>
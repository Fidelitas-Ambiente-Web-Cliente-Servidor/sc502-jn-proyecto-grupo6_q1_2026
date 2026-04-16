<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../index.php");
    exit();
}

if ($_SESSION["rol"] != "administrador") {
    header("Location: ../dashboard.php");
    exit();
}

include("conexion.php");

$nombre = mysqli_real_escape_string($conexion, trim($_POST["nombre"]));
$correo = mysqli_real_escape_string($conexion, trim($_POST["correo"]));
$contrasena = mysqli_real_escape_string($conexion, trim($_POST["contrasena"]));
$id_rol = mysqli_real_escape_string($conexion, trim($_POST["id_rol"]));

$sql_verificar = "SELECT id_usuario FROM usuarios WHERE correo = '$correo'";
$resultado_verificar = mysqli_query($conexion, $sql_verificar);

if (mysqli_num_rows($resultado_verificar) > 0) {
    echo "<h2>Ese correo ya está registrado.</h2>";
    echo "<a href='../crear_usuario.php'>Volver</a>";
} else {
    $sql_insertar = "INSERT INTO usuarios (nombre, correo, contrasena, id_rol)
                    VALUES ('$nombre', '$correo', '$contrasena', '$id_rol')";

    if (mysqli_query($conexion, $sql_insertar)) {
        echo "<h2>Usuario creado correctamente.</h2>";
        echo "<a href='../admin.php'>Volver al panel</a>";
    } else {
        echo "<h2>Error al crear el usuario.</h2>";
        echo "<p>" . mysqli_error($conexion) . "</p>";
        echo "<a href='../crear_usuario.php'>Volver</a>";
    }
}

mysqli_close($conexion);

?>
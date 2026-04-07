<?php

session_start();

include("conexion.php");

$usuario = mysqli_real_escape_string($conexion, trim($_POST["usuario"]));
$password = mysqli_real_escape_string($conexion, trim($_POST["password"]));

$sql = "SELECT u.id_usuario, u.nombre, u.correo, r.nombre_rol
        FROM usuarios u
        INNER JOIN roles r ON u.id_rol = r.id_rol
        WHERE u.correo = '$usuario' AND u.contrasena = '$password'";

$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) > 0) {

    $fila = mysqli_fetch_assoc($resultado);

    $_SESSION["id_usuario"] = $fila["id_usuario"];
    $_SESSION["nombre"] = $fila["nombre"];
    $_SESSION["correo"] = $fila["correo"];
    $_SESSION["rol"] = $fila["nombre_rol"];

    if ($fila["nombre_rol"] == "administrador") {
        header("Location: ../admin.php");
    } else {
        header("Location: ../dashboard.php");
    }
    exit();

} else {

    echo "<h2>Credenciales incorrectas</h2>";
    echo "<a href='../index.php'>Volver</a>";

}

mysqli_close($conexion);

?>

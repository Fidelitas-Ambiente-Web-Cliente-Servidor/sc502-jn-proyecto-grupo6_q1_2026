<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION["rol"] != "administrador") {
    header("Location: dashboard.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <h1>Panel del Administrador</h1>

    <p>Bienvenido: <?php echo $_SESSION["nombre"]; ?></p>
    <p>Rol: <?php echo $_SESSION["rol"]; ?></p>

    <a href="php/ver_citas.php">Ver Citas Registradas</a>
    <a href="php/logout.php">Cerrar sesión</a>

</body>
</html>
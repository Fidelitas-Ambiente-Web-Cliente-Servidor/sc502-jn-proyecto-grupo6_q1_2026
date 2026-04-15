<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION["rol"] != "paciente") {
    header("Location: admin.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Paciente</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <h1>Panel del Paciente</h1>

    <p>Bienvenido: <?php echo $_SESSION["nombre"]; ?></p>
    <p>Rol: <?php echo $_SESSION["rol"]; ?></p>

    <a href="citas.php">Solicitar Cita</a>
    <a href="php/ver_citas.php">Ver Citas</a>
    <a href="expediente.php">Ver Expediente</a>
    <a href="documentos.php">Ver Documentos y Resultados</a>
    <a href="php/logout.php">Cerrar sesión</a>

</body>
</html>
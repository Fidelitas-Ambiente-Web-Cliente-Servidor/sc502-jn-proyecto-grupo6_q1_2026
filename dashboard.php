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

include("php/conexion.php");

$id_usuario = $_SESSION["id_usuario"];

$sql = "SELECT especialidad, fecha, hora, estado
        FROM citas
        WHERE id_usuario = '$id_usuario' AND estado != 'Cancelada'
        ORDER BY fecha, hora
        LIMIT 1";

$resultado = mysqli_query($conexion, $sql);

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

    <h2>Recordatorio</h2>

    <?php
    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        echo "<p><strong>Tu próxima cita es:</strong></p>";
        echo "<p>Especialidad: " . $fila["especialidad"] . "</p>";
        echo "<p>Fecha: " . $fila["fecha"] . "</p>";
        echo "<p>Hora: " . $fila["hora"] . "</p>";
        echo "<p>Estado: " . $fila["estado"] . "</p>";
    } else {
        echo "<p>No tienes citas registradas por el momento.</p>";
    }

    mysqli_close($conexion);
    ?>

    <a href="citas.php">Solicitar Cita</a>
    <a href="php/ver_citas.php">Ver Citas</a>
    <a href="expediente.php">Ver Expediente</a>
    <a href="documentos.php">Ver Documentos y Resultados</a>
    <a href="php/logout.php">Cerrar sesión</a>

</body>
</html>
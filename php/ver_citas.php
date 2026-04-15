<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../index.php");
    exit();
}

include("conexion.php");

$id_usuario = $_SESSION["id_usuario"];
$rol = $_SESSION["rol"];

if ($rol == "administrador") {
    $sql = "SELECT c.id_cita, u.nombre, c.especialidad, c.fecha, c.hora, c.estado
            FROM citas c
            INNER JOIN usuarios u ON c.id_usuario = u.id_usuario
            ORDER BY c.fecha, c.hora";
} else {
    $sql = "SELECT c.id_cita, u.nombre, c.especialidad, c.fecha, c.hora, c.estado
            FROM citas c
            INNER JOIN usuarios u ON c.id_usuario = u.id_usuario
            WHERE c.id_usuario = '$id_usuario'
            ORDER BY c.fecha, c.hora";
}

$resultado = mysqli_query($conexion, $sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Citas</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

    <h1>Citas Registradas</h1>

    <?php
    if (mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<div>";
            echo "<p><strong>ID:</strong> " . $fila["id_cita"] . "</p>";
            echo "<p><strong>Paciente:</strong> " . $fila["nombre"] . "</p>";
            echo "<p><strong>Especialidad:</strong> " . $fila["especialidad"] . "</p>";
            echo "<p><strong>Fecha:</strong> " . $fila["fecha"] . "</p>";
            echo "<p><strong>Hora:</strong> " . $fila["hora"] . "</p>";
            echo "<p><strong>Estado:</strong> " . $fila["estado"] . "</p>";

            if ($fila["estado"] != "Cancelada") {
                echo "<a href='cancelar_cita.php?id=" . $fila["id_cita"] . "' onclick=\"return confirm('¿Seguro que deseas cancelar esta cita?');\">Cancelar</a>";
                echo "<a href='../reprogramar.php?id=" . $fila["id_cita"] . "'>Reprogramar</a>";
            }

            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "<p>No hay citas registradas.</p>";
    }

    mysqli_close($conexion);
    ?>

    <?php
    if ($rol == "administrador") {
        echo "<a href='../admin.php'>Volver</a>";
    } else {
        echo "<a href='../dashboard.php'>Volver</a>";
    }
    ?>

</body>
</html>
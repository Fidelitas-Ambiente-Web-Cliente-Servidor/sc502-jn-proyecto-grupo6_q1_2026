<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: index.php");
    exit();
}

include("php/conexion.php");

$id_usuario = $_SESSION["id_usuario"];

$sql = "SELECT tipo_sangre, diagnostico, ultima_visita
        FROM expedientes
        WHERE id_usuario = '$id_usuario'";

$resultado = mysqli_query($conexion, $sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Expediente Médico</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <h1>Expediente Médico</h1>

    <?php
    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        echo "<p><strong>Paciente:</strong> " . $_SESSION["nombre"] . "</p>";
        echo "<p><strong>Tipo de sangre:</strong> " . $fila["tipo_sangre"] . "</p>";
        echo "<p><strong>Diagnóstico:</strong> " . $fila["diagnostico"] . "</p>";
        echo "<p><strong>Última visita:</strong> " . $fila["ultima_visita"] . "</p>";
    } else {
        echo "<p>No hay expediente registrado para este usuario.</p>";
    }

    mysqli_close($conexion);
    ?>

    <?php
    if ($_SESSION["rol"] == "administrador") {
        echo "<a href='admin.php'>Volver</a>";
    } else {
        echo "<a href='dashboard.php'>Volver</a>";
    }
    ?>

</body>
</html>
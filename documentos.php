<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: index.php");
    exit();
}

include("php/conexion.php");

$id_usuario = $_SESSION["id_usuario"];

$sql = "SELECT titulo, descripcion, fecha_documento
        FROM documentos
        WHERE id_usuario = '$id_usuario'";

$resultado = mysqli_query($conexion, $sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Documentos y Resultados</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <h1>Documentos y Resultados</h1>

    <?php
    if (mysqli_num_rows($resultado) > 0) {

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<div>";
            echo "<p><strong>Título:</strong> " . $fila["titulo"] . "</p>";
            echo "<p><strong>Descripción:</strong> " . $fila["descripcion"] . "</p>";
            echo "<p><strong>Fecha:</strong> " . $fila["fecha_documento"] . "</p>";
            echo "<hr>";
            echo "</div>";
        }

    } else {
        echo "<p>No hay documentos registrados para este usuario.</p>";
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
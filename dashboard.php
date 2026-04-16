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
    <link rel="stylesheet" href="css/estilos.css?v=5">
</head>
<body>

<div class="patient-wrapper">
    <div class="patient-panel">
        <h1>Panel del Paciente</h1>

        <p class="patient-info">Bienvenido: <strong><?php echo $_SESSION["nombre"]; ?></strong></p>
        <p class="patient-info">Rol: <strong><?php echo $_SESSION["rol"]; ?></strong></p>

        <div class="patient-recordatorio">
            <h2>Recordatorio</h2>

            <?php
            if (mysqli_num_rows($resultado) > 0) {
                $fila = mysqli_fetch_assoc($resultado);

                echo "<div class='patient-cita-box'>";
                echo "<p><strong>Tu próxima cita es:</strong></p>";
                echo "<p><strong>Especialidad:</strong> " . $fila["especialidad"] . "</p>";
                echo "<p><strong>Fecha:</strong> " . $fila["fecha"] . "</p>";
                echo "<p><strong>Hora:</strong> " . $fila["hora"] . "</p>";
                echo "<p><strong>Estado:</strong> " . $fila["estado"] . "</p>";
                echo "</div>";
            } else {
                echo "<div class='patient-cita-box'>";
                echo "<p>No tienes citas registradas por el momento.</p>";
                echo "</div>";
            }

            mysqli_close($conexion);
            ?>
        </div>

        <h2>Acciones rápidas</h2>

        <div class="patient-acciones-grid">
            <a class="patient-card-link" href="citas.php">
                <h3>Solicitar cita</h3>
                <p>Agenda una nueva cita médica en el sistema.</p>
            </a>

            <a class="patient-card-link" href="php/ver_citas.php">
                <h3>Ver citas</h3>
                <p>Consulta, cancela o reprograma tus citas registradas.</p>
            </a>

            <a class="patient-card-link" href="expediente.php">
                <h3>Ver expediente</h3>
                <p>Revisa la información básica de tu expediente médico.</p>
            </a>

            <a class="patient-card-link" href="documentos.php">
                <h3>Documentos y resultados</h3>
                <p>Consulta documentos y resultados disponibles.</p>
            </a>
        </div>

        <div class="patient-acciones-finales">
            <a class="patient-boton" href="php/logout.php">Cerrar sesión</a>
        </div>
    </div>
</div>

</body>
</html>
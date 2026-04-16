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

include("php/conexion.php");

$sql_usuarios = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
$sql_citas = "SELECT COUNT(*) AS total_citas FROM citas";
$sql_activas = "SELECT COUNT(*) AS total_activas FROM citas WHERE estado = 'Activa'";
$sql_canceladas = "SELECT COUNT(*) AS total_canceladas FROM citas WHERE estado = 'Cancelada'";

$resultado_usuarios = mysqli_query($conexion, $sql_usuarios);
$resultado_citas = mysqli_query($conexion, $sql_citas);
$resultado_activas = mysqli_query($conexion, $sql_activas);
$resultado_canceladas = mysqli_query($conexion, $sql_canceladas);

$fila_usuarios = mysqli_fetch_assoc($resultado_usuarios);
$fila_citas = mysqli_fetch_assoc($resultado_citas);
$fila_activas = mysqli_fetch_assoc($resultado_activas);
$fila_canceladas = mysqli_fetch_assoc($resultado_canceladas);

$sql_recientes = "SELECT c.id_cita, u.nombre, c.especialidad, c.fecha, c.hora, c.estado
                FROM citas c
                INNER JOIN usuarios u ON c.id_usuario = u.id_usuario
                WHERE c.estado = 'Activa' OR c.estado = 'Reprogramada'
                ORDER BY c.fecha, c.hora
                LIMIT 5";

$resultado_recientes = mysqli_query($conexion, $sql_recientes);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador</title>
    <link rel="stylesheet" href="css/estilos.css?v=6">
</head>
<body>

<div class="admin-wrapper">
    <div class="admin-panel">
        <h1>Panel del Administrador</h1>

        <p class="admin-info">Bienvenido: <strong><?php echo $_SESSION["nombre"]; ?></strong></p>
        <p class="admin-info">Rol: <strong><?php echo $_SESSION["rol"]; ?></strong></p>

        <div class="admin-resumen">
            <div class="admin-card">
                <h3>Usuarios</h3>
                <p><?php echo $fila_usuarios["total_usuarios"]; ?></p>
            </div>

            <div class="admin-card">
                <h3>Citas totales</h3>
                <p><?php echo $fila_citas["total_citas"]; ?></p>
            </div>

            <div class="admin-card">
                <h3>Citas activas</h3>
                <p><?php echo $fila_activas["total_activas"]; ?></p>
            </div>

            <div class="admin-card">
                <h3>Citas canceladas</h3>
                <p><?php echo $fila_canceladas["total_canceladas"]; ?></p>
            </div>
        </div>

        <h2>Últimas citas activas o reprogramadas</h2>

        <div class="admin-citas">
            <?php
            if (mysqli_num_rows($resultado_recientes) > 0) {
                while ($fila = mysqli_fetch_assoc($resultado_recientes)) {
                    echo "<div class='admin-cita'>";
                    echo "<p><strong>ID:</strong> " . $fila["id_cita"] . "</p>";
                    echo "<p><strong>Paciente:</strong> " . $fila["nombre"] . "</p>";
                    echo "<p><strong>Especialidad:</strong> " . $fila["especialidad"] . "</p>";
                    echo "<p><strong>Fecha:</strong> " . $fila["fecha"] . "</p>";
                    echo "<p><strong>Hora:</strong> " . $fila["hora"] . "</p>";
                    echo "<p><strong>Estado:</strong> " . $fila["estado"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay citas activas o reprogramadas en este momento.</p>";
            }
            ?>
        </div>

        <div class="admin-acciones">
            <a class="admin-boton" href="php/ver_citas.php">Ver todas las citas</a>
            <a class="admin-boton" href="usuarios.php">Ver usuarios registrados</a>
            <a class="admin-boton" href="crear_usuario.php">Crear usuario</a>
            <a class="admin-boton" href="php/logout.php">Cerrar sesión</a>
        </div>
    </div>
</div>

<?php mysqli_close($conexion); ?>

</body>
</html>
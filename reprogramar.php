<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: index.php");
    exit();
}

include("php/conexion.php");

$id_cita = $_GET["id"];
$id_usuario = $_SESSION["id_usuario"];
$rol = $_SESSION["rol"];

if ($rol == "administrador") {
    $sql = "SELECT id_cita, especialidad, fecha, hora
            FROM citas
            WHERE id_cita = '$id_cita'";
} else {
    $sql = "SELECT id_cita, especialidad, fecha, hora
            FROM citas
            WHERE id_cita = '$id_cita' AND id_usuario = '$id_usuario'";
}

$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 0) {
    echo "<p>No se encontró la cita.</p>";
    echo "<a href='php/ver_citas.php'>Volver</a>";
    exit();
}

$fila = mysqli_fetch_assoc($resultado);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reprogramar Cita</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <h1>Reprogramar Cita</h1>

    <form action="php/actualizar_cita.php" method="POST">
        <input type="hidden" name="id_cita" value="<?php echo $fila["id_cita"]; ?>">

        <label>Especialidad</label>
        <input type="text" value="<?php echo $fila["especialidad"]; ?>" disabled>

        <label>Nueva fecha</label>
        <input type="date" name="fecha" value="<?php echo $fila["fecha"]; ?>" required>

        <label>Nueva hora</label>
        <input type="time" name="hora" value="<?php echo $fila["hora"]; ?>" required>

        <button type="submit">Actualizar Cita</button>
    </form>

    <a href="php/ver_citas.php">Volver</a>

</body>
</html>
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

$sql_lista_usuarios = "SELECT u.id_usuario, u.nombre, u.correo, r.nombre_rol
                    FROM usuarios u
                    INNER JOIN roles r ON u.id_rol = r.id_rol
                    ORDER BY u.id_usuario";

$resultado_lista_usuarios = mysqli_query($conexion, $sql_lista_usuarios);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Registrados</title>
    <link rel="stylesheet" href="css/estilos.css?v=6">
</head>
<body>

<div class="admin-wrapper">
    <div class="admin-panel">
        <h1>Usuarios registrados</h1>

        <div class="admin-usuarios">
            <?php
            if (mysqli_num_rows($resultado_lista_usuarios) > 0) {
                while ($usuario = mysqli_fetch_assoc($resultado_lista_usuarios)) {
                    echo "<div class='admin-usuario'>";
                    echo "<p><strong>ID:</strong> " . $usuario["id_usuario"] . "</p>";
                    echo "<p><strong>Nombre:</strong> " . $usuario["nombre"] . "</p>";
                    echo "<p><strong>Correo:</strong> " . $usuario["correo"] . "</p>";
                    echo "<p><strong>Rol:</strong> " . $usuario["nombre_rol"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay usuarios registrados.</p>";
            }
            ?>
        </div>

        <div class="admin-acciones">
            <a class="admin-boton" href="admin.php">Volver al panel</a>
        </div>
    </div>
</div>

<?php mysqli_close($conexion); ?>

</body>
</html>
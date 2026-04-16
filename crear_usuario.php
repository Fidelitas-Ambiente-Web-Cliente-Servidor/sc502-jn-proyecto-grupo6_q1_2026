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
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="css/estilos.css?v=7">
</head>
<body>

<div class="admin-wrapper">
    <div class="admin-panel">
        <h1>Crear nuevo usuario</h1>
        <p class="admin-info">Completa los datos para registrar un nuevo usuario en el sistema.</p>

        <form action="php/guardar_usuario.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" required>

            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="id_rol">Rol</label>
            <select id="id_rol" name="id_rol" required>
                <option value="2">Paciente</option>
                <option value="1">Administrador</option>
            </select>

            <button type="submit">Guardar usuario</button>
        </form>

        <div class="admin-acciones">
            <a class="admin-boton" href="admin.php">Volver al panel</a>
        </div>
    </div>
</div>

</body>
</html>
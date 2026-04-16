<?php
session_start();

if (isset($_SESSION["id_usuario"])) {
    if ($_SESSION["rol"] == "administrador") {
        header("Location: admin.php");
    } else {
        header("Location: dashboard.php");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Servicios de Salud</title>
    <link rel="stylesheet" href="css/estilos.css?v=3">
</head>
<body>

    <div class="login-wrapper">
        <div class="login-layout">

            <section class="login-info">
                <span class="login-badge">Atención simple y clara</span>

                <h1>Plataforma de Servicios de Salud</h1>

                <p class="login-texto">
                    Gestiona tus citas, consulta tu expediente y revisa tus documentos
                    desde una sola plataforma, con una experiencia más simple y ordenada.
                </p>

                <div class="login-features">
                    <div class="login-feature">
                        <h3>Citas médicas</h3>
                        <p>Solicita, consulta y reprograma tus citas de forma sencilla.</p>
                    </div>

                    <div class="login-feature">
                        <h3>Expediente</h3>
                        <p>Visualiza información básica de tu expediente de manera clara.</p>
                    </div>

                    <div class="login-feature">
                        <h3>Resultados</h3>
                        <p>Accede a documentos y resultados sin complicaciones innecesarias.</p>
                    </div>
                </div>
            </section>

            <section class="login-card">
                <h2>Iniciar sesión</h2>

                <form action="php/login.php" method="POST">
                    <label for="usuario">Correo</label>
                    <input type="text" id="usuario" name="usuario" required>

                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Ingresar</button>
                </form>

                <div class="login-demo">
                    <p><strong>Paciente:</strong> juan@salud.com</p>
                    <p><strong>Administrador:</strong> admin@salud.com</p>
                    <p><strong>Contraseña:</strong> 123</p>
                </div>
            </section>

        </div>
    </div>

</body>
</html>
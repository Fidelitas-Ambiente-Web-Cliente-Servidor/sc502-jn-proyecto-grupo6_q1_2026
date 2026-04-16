<?php

session_start();
include("conexion.php");

// Validar que venga del formulario
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    exit();
}

// Obtener datos
$usuario = trim($_POST["usuario"]);
$password = trim($_POST["password"]);

// Validar campos vacíos
if (empty($usuario) || empty($password)) {
    echo "<h2>Datos vacíos</h2>";
    echo "<a href='../index.php'>Volver</a>";
    exit();
}

// Consulta
$sql = "SELECT u.id_usuario, u.nombre, u.correo, r.nombre_rol
        FROM usuarios u
        INNER JOIN roles r ON u.id_rol = r.id_rol
        WHERE u.correo = '$usuario' AND u.contrasena = '$password'";

$resultado = mysqli_query($conexion, $sql);

// Validar error en query
if (!$resultado) {
    die("Error en query: " . mysqli_error($conexion));
}

// Validar usuario
if (mysqli_num_rows($resultado) > 0) {

    $fila = mysqli_fetch_assoc($resultado);

    // Guardar sesión
    $_SESSION["id_usuario"] = $fila["id_usuario"];
    $_SESSION["nombre"] = $fila["nombre"];
    $_SESSION["correo"] = $fila["correo"];
    $_SESSION["rol"] = $fila["nombre_rol"];

    // Redirección según rol
    if ($fila["nombre_rol"] == "administrador") {
        header("Location: ../admin.php");
    } else {
        header("Location: ../dashboard.php");
    }
    exit();

} else {

    echo "<h2>Credenciales incorrectas</h2>";
    echo "<a href='../index.php'>Volver</a>";
    exit();

}

mysqli_close($conexion);

?>



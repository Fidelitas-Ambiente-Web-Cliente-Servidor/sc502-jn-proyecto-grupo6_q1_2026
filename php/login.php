<?php

session_start();

$usuario = $_POST['usuario'];
$password = $_POST['password'];

if($usuario == "paciente" && $password == "123"){

$_SESSION['usuario'] = $usuario;

header("Location: ../dashboard.php");

}else{

echo "Usuario o contraseña incorrectos";

}

?>

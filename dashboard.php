<?php

session_start();

if(!isset($_SESSION['usuario'])){

header("Location:index.php");

}

?>

<h2>Panel del Paciente</h2>

<a href="citas.php">Solicitar Cita</a>

<a href="php/ver_citas.php">Ver Citas</a>

<a href="expediente.php">Ver Expediente</a>

<a href="php/logout.php">Cerrar sesión</a>

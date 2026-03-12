<?php

$especialidad = $_POST['especialidad'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$archivo = fopen("../data/citas.txt","a");

fwrite($archivo,$especialidad.",".$fecha.",".$hora."\n");

fclose($archivo);

echo "Cita guardada correctamente";

echo "<br><a href='../dashboard.php'>Volver</a>";

?>

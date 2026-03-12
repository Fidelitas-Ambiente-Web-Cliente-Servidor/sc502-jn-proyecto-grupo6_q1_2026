<?php

$citas = file("../data/citas.txt");

echo "<h2>Lista de citas</h2>";

foreach($citas as $cita){

$datos = explode(",",$cita);

echo "Especialidad: ".$datos[0]."<br>";
echo "Fecha: ".$datos[1]."<br>";
echo "Hora: ".$datos[2]."<br>";

echo "<hr>";

}

?>

<?php

$paciente = array(

"nombre"=>"Carlos Perez",
"edad"=>35,
"tipo_sangre"=>"O+",
"hospital"=>"Hospital Central"

);

?>

<h2>Expediente Médico</h2>

<p>Nombre: <?php echo $paciente['nombre']; ?></p>

<p>Edad: <?php echo $paciente['edad']; ?></p>

<p>Tipo de sangre: <?php echo $paciente['tipo_sangre']; ?></p>

<p>Hospital: <?php echo $paciente['hospital']; ?></p>

<h2>Solicitar cita médica</h2>

<form action="php/guardar_cita.php" method="POST">

<label>Especialidad</label>

<select name="especialidad">

<option>Medicina General</option>
<option>Cardiología</option>
<option>Odontología</option>

</select>

<label>Fecha</label>
<input type="date" name="fecha">

<label>Hora</label>
<input type="time" name="hora">

<button type="submit">Guardar cita</button>

</form>

<html>
<title>
</title>
<body>
<center>
<b>Lista de Estudiantes</b><br>
<?php
	include("conexion.php");
	
	$sql = "select * from Estudiante order by turno desc, nombre, apellido ";
	$res = mysql_query($sql, $link);
	
	if (!$res) {
		echo "Error de BD, no se pudo consultar la base de datos\n";
		echo "Error MySQL: " . mysql_error();
		exit;
	}
?>
	<br>
	<table border = 1>
	<tr>
	  <td><b>Nombre</b></td><td><b>Apellido</b></td><td><b><center>Turno</center></b></td>
	</tr>
<?php
	while ($fila = mysql_fetch_assoc($res)) {
		// echo $fila['cedula'] . ",";
		echo "<tr><td>" . $fila['nombre'] . "</td>";
		echo "<td>" . $fila['apellido'] . "</td>";
		echo "<td><center>";
		if ($fila['turno'] == 0) {
			echo "Sin turno asignado";
		}
		else if ($fila['turno'] == 1)
		  	echo "2pm a 4pm ";
		else 
			echo "4pm a 6pm ";
		
		echo "</center></td></tr>";
	}
	echo "</table>";

	mysql_free_result($res);
			
?>
</center>
</body>
</html>

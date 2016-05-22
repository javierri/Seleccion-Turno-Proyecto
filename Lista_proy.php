<html>
<title>
</title>
<body>
<center>
<b>Lista de Proyectos</b><br>
<?php
	include("conexion.php");
	
	$sql = "select * from Estudiante, EquipoGrupo, Grupo ".
	       "where Estudiante.Equipo = EquipoGrupo.Equipo and ".
	       "EquipoGrupo.Grupo = Grupo.numero ".
	       "order by Estudiante.Equipo desc, nombre, apellido ";
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
		echo $fila['Proyecto'];	
		echo "</center></td></tr>";
	}
	echo "</table>";

	mysql_free_result($res);
			
?>
</center>
</body>
</html>

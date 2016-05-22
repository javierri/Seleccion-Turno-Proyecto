<html>
<title>
</title>
<body>
<center>
<b>Proyecto del Grupo</b> <br>
<?php
	include("conexion.php");
	
	$ced = $_POST["cedula"];
	$cod = $_POST["codigo"];
	$sql = "select * from Estudiante where cedula = '". $ced ."' and codigo = '". $cod ."'";
	//echo $sql;
	$res = mysql_query($sql, $link);
	
	if (!$res) {
		echo "Error de BD, no se pudo consultar la base de datos\n";
		echo "Error MySQL: " . mysql_error();
		exit;
	}
	
	echo "<br>";
	$fila = mysql_fetch_assoc($res);
	
	if ($fila == "") {
		echo "Cedula no registrada o codigo erroneo !!!";
		exit;
	}
	echo $fila['cedula'] . ",";
	echo $fila['nombre'] . ",";
	echo $fila['apellido'];
	echo "<br>";

	$equipo = $fila['Equipo'];
	mysql_free_result($res);

	$sql = "select * from EquipoGrupo where Equipo = '". $equipo . "'";
	//echo $sql;
	$res = mysql_query($sql, $link);
	
	if (!$res) {
		echo "Error de BD, no se pudo consultar la base de datos\n";
		echo "Error MySQL: " . mysql_error();
		exit;
	}
	
	echo "<br>";
	$fila = mysql_fetch_assoc($res);
	
	if ($fila['Grupo'] != "0"){
		echo "<br>";
		echo "Usted o alguien de su equipo ya ha seleccionado un Proyecto, verifique la lista de Proyectos<br>";
	}
	else {
		$num = 0;	
		do {
			mysql_free_result($res);
			$proy = (rand() % 5) + 1;
			
			$sql = "select count(Equipo) as num from EquipoGrupo where Grupo = '". $proy ."'";
			$res = mysql_query($sql, $link);
		
			if (!$res) {
				echo "Error de BD, no se pudo consultar la base de datos\n";
				echo "Error MySQL: " . mysql_error();
				exit;
			}
			
			$fila = mysql_fetch_assoc($res);
			$num = $fila['num'];
			// echo $num;
			
		} while ($num != 0);
		
		
		$sql = "update EquipoGrupo set Grupo = '" . $proy. "' where Equipo = '" . $equipo. "'";
		mysql_query($sql, $link);
		
		$sql = "select * from Grupo where numero = '". $proy ."'";
		$res = mysql_query($sql, $link);
		
		if (!$res) {
			echo "Error de BD, no se pudo consultar la base de datos\n";
			echo "Error MySQL: " . mysql_error();
			exit;
		}
			
		$fila = mysql_fetch_assoc($res);
		echo "Su equipo debe realizar el proyecto <b>" . $fila['Proyecto'] . "</b><br>";
		
		
	}
	echo "<br><a href = 'Lista_proy.php'>Ver lista de Proyectos</a>";
?>
</center>
</body>
</html>

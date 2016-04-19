<html>
<title>
</title>
<body>
<center>
<b>Turno Estudiante</b> <br>
<?php
	include("conexion.php");
	
	$ced = $_POST["cedula"];
	$cod = $_POST["codigo"];
	$sql = "select * from Estudiante where cedula = '". $ced ."' and codigo = '". $cod ."'";
	// echo $sql;
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
	
	if ($fila['turno'] != "0"){
		echo "<br>";
		echo "Usted ya ha seleccionado un turno, verifique la lista de Estudiantes<br>";
	}
	else {
		mysql_free_result($res);
		
		$turno = (rand() % 2) + 1;
		
		$sql = "select count(cedula) as num from Estudiante where turno = '". $turno ."'";
		$res = mysql_query($sql, $link);
	
		if (!$res) {
			echo "Error de BD, no se pudo consultar la base de datos\n";
			echo "Error MySQL: " . mysql_error();
			exit;
		}
		
		$fila = mysql_fetch_assoc($res);
		$num = $fila['num'];
		// echo $num;
		if ($num >= 10) {
			$turno = (($turno + 2) % 2) + 1;
		}
		if ($turno == 1)
		  	echo "Su turno sera de 2pm a 4pm ";
		else 
			echo "Su turno sera de 4pm a 6pm ";
		echo "<br>";
		
		$sql = "update Estudiante set turno = '" . $turno . "' where cedula = '" . $ced . "'";
		$res = mysql_query($sql, $link);
	}
	echo "<br><a href = 'lista.php'>Ver lista de Estudiantes</a>";
?>
</center>
</body>
</html>

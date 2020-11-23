<?php 

	$dsn = "mysql:host=localhost; dbname=pract";
	$user = "root";
	$password = "";

	try {
		$conn = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'UTF8'"));

		$sql = 'SELECT concat(a.nomalu, " ", a.apealu) as Alumnos, nomcarr as Carrera, nomcur as Curso, 
				concat(nomprof, " ", apeprof) as Profesor, round((((n1+n2+n3)/3)+ep+ef)/3,2) as Notas, a.idalu as id
				FROM alumnos as a 
				join notascurso as nc on a.idalu = nc.idalu
				join cursoprofesor as cp on nc.idcurprof = cp.idcurprof
				join cursos as c on cp.idcur = c.idcur
				join plan  as pl on c.idcur = pl.idcur
				join carrera as ca on pl.idcarr = ca.idcarr
				join profesor as p on p.idprof = cp.idprof
				where round((((n1+n2+n3)/3)+ep+ef)/3,2) >= 10.5
				order by Alumnos';

		$result = $conn->query($sql);

		//echo "Contador: ".$result->rowCount();

		echo "<table border='1' >
				<tr>
					<th>N°</th>
					<th>ALUMNO</th>
					<th>CURSO</th>
					<th>PROFESOR</th>
					<th>CARRERA</th>
					<th>PROMEDIO</th>
				</tr>";

		
		foreach($result->fetchall() as $k=>$alumnos)
		{
			echo "<tr> 
					<td>".($k+1)."</td>
					<td>".$alumnos["Alumnos"]."</td>
					<td>".$alumnos["Curso"]."</td>
					<td>".$alumnos["Profesor"]."</td>
					<td>".$alumnos["Carrera"]."</td>
					<td>".$alumnos["Notas"]."</td>
					<td>
						<form method='POST' action='eliminar.php'>
							<input type='hidden' name='id' value='".$alumnos["id"]."'/>
							<input type='submit' name='submit' value='Eliminar'/>
						</form>
					</td>
				 </tr>";
		}
	} catch (Exception $e) {
		echo "ERROR".$e->getMessage();
	}

?>

<html>
	<a href="index.html">Menu Principal</a>
</html>
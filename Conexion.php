<?php 

	
		$dns = "mysql:host=localhost; dbname=pract";
		$user = "root";
		$password = "";

		
 		try{

 			$conn = new PDO($dns, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"'));
 			echo "Conexion exitosa.<br>";

	 		$sql = 'SELECT concat(a.nomalu, " ", a.apealu) as Alumnos, nomcarr as Carrera, nomcur as Curso, 
	 			round((((n1+n2+n3)/3)+ep+ef)/3,2) as "Promedio Aprobados"
				FROM alumnos as a 
				join notascurso as nc on a.idalu = nc.idalu
				join cursoprofesor as cp on nc.idcurprof = cp.idcurprof
				join cursos as c on cp.idcur = c.idcur
				join plan  as pl on c.idcur = pl.idcur
				join carrera as ca on pl.idcarr = ca.idcarr
				
				order by Alumnos';	

	 		$resultado = $conn->query($sql);

	 		echo "<table border='1'>
	 				<tr>
	 				<th>#</th>
	 				<th>ALUMNOS</th>
	 				<th>CARRERA</th>
	 				<th>CURSO</th>
	 				<th>PROMEDIOS</th>
	 				</tr>";
	 		
			
			foreach($resultado->fetchAll() as $k=>$alumnos)
			{
				echo "<tr>
						<td>".($k+1)."</td>
						<td>".$alumnos["Alumnos"]."</td>
						<td>".$alumnos["Carrera"]."</td>
						<td>".$alumnos["Curso"]."</td>
						<td>".$alumnos["Promedio Aprobados"]."</td>
					  </tr>";
				
			}echo "</table>";
		}catch(Exception $e){
			echo "Error: ".$e->getMessage();
		}
	
?>
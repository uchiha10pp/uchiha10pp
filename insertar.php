<?php 

	//var_dump($_POST);

	if(isset($_POST["submit"]))
	{
		$codigo = $_POST["codigo"];
		$nombre = strtoupper($_POST["nombre"]);
		$apellido = strtoupper($_POST["apellido"]);
		$direccion = strtoupper($_POST["direccion"]);
		$correo = strtoupper($_POST["correo"]);
		$sexo = strtoupper($_POST["sexo"]);
		$telefono = $_POST["telefono"];		
		$carrera = "carrera";
	

		$dsn = "mysql:host=localhost; dbname=pract";
		$user = "root";
		$password = "";

		try {
			$conn = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'UTF8'"));

			$sql = "INSERT INTO alumnos(codalu, nomalu, apealu, diralu, emailalu, sexoalu, celualu)
					VALUES('$codigo', '$nombre', '$apellido', '$direccion', '$correo', '$sexo', '$telefono')";

			$filasaf = $conn->exec($sql);
			echo "$filasaf";

			} catch (Exception $e) {
			echo "ERROR".$e->getMessage();
		}
	}

	header("Location:index.html");
 ?>
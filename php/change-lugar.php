<?php 
include 'conexion.php';//Archivo que establece una coneccion con la base de datos espesifica

	if($_GET['create']){
		$nombre = htmlentities($_GET['create'], ENT_QUOTES); //Nombre del lugar, se le aplica una funcion para eliminar caracteres especiales
		$tipo = $_GET['tipo']; //Tipo de lugar
		if(isset($_GET['lugar'])) //Si existe un lugar para que sea recursivo
			$lugar = $_GET['lugar'];
		else
			$lugar = "NULL";
		$qry = "INSERT INTO Lugar (lu_nombre, lu_tipo, lu_lugar) VALUES ('".$nombre."','".$tipo."',".$lugar.")"; //INSERT estandar para Lugar
		if(pg_query( $conexion, $qry )) //pg_query envia el query a la base de datos para ser ejecutada
			print "Se ha agregado un nuevo Lugar";
	}

?>

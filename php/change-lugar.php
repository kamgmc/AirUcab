<?php 
include 'conexion.php';//Archivo que establece una coneccion con la base de datos espesifica

	if(isset($_GET['create'])){
		
		$nombre = htmlentities($_POST['create'], ENT_QUOTES); //Nombre del lugar, se le aplica una funcion para eliminar caracteres especiales
		$tipo = $_POST['tipo']; //Tipo de lugar
		
		if($_POST['lugar'] > 0)  //Si existe una referencia a lugar esta sera un numero mayor a cero
			$lugar = $_POST['lugar'];
		else
			$lugar = "NULL";
		
		$qry = "INSERT INTO Lugar (lu_nombre, lu_tipo, lu_lugar) VALUES ('".$nombre."','".$tipo."',".$lugar.")"; //INSERT estandar para Lugar
		
		if(pg_query( $conexion, $qry )) //pg_query envia el query a la base de datos para ser ejecutada
			print "Se ha agregado un nuevo Lugar";
		
	}
	if(isset($_GET['update'])){
		
		$nombre = htmlentities($_POST['create'], ENT_QUOTES); 
		$tipo = $_POST['tipo']; 
		
		if($_POST['lugar'] > 0) 
			$lugar = $_POST['lugar'];
		else
			$lugar = "NULL";
		
		$qry = "UPDATE Lugar SET lu_nombre ='".$nombre."', lu_tipo='".$tipo."', lu_lugar=".$lugar." where lu_id=".$_GET['update'];
		
		if(pg_query( $conexion, $qry )) 
			print "Se ha modificado el Lugar ".$_GET['update'];
		
	}
	if(isset($_GET['delete'])){
		
		$qry = "DELETE FROM Lugar where lu_id=".$_GET['delete'];
		
		if(pg_query( $conexion, $qry )) 
			print "Se ha eliminado el Lugar ".$_GET['delete'];
		
	}
?>

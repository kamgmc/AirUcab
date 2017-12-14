<?php  include_once 'conexion.php';
//Querys de Status
	function insertarStatus( $nombre ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Status (st_nombre) VALUES ('".$nombre."')";
		return pg_query($conexion, $qry);
	}
	function editarStatus( $id, $nombre ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Status SET st_nombre='".$nombre."' WHERE st_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarStatus( $id ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "DELETE FROM Status WHERE st_id=".$id;
		return pg_query($conexion, $qry);
	}
// Querys de Lugar
	function insertarLugar( $nombre , $tipo, $lugar ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		if($lugar <= 0)  
			$lugar = "NULL";
		$qry = "INSERT INTO Lugar (lu_nombre, lu_tipo, lu_lugar) VALUES ('".$nombre."','".$tipo."',".$lugar.")";
		return pg_query($conexion, $qry);
	}
	function editarLugar( $id, $nombre, $tipo, $lugar ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		if($lugar <= 0)  
			$lugar = "NULL";
		$qry = "UPDATE Lugar SET lu_nombre ='".$nombre."', lu_tipo='".$tipo."', lu_lugar=".$lugar." where lu_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarLugar( $id ){
		$qry = "DELETE FROM Lugar where lu_id=".$id;
		return pg_query($conexion, $qry);
	}
?>

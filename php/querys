<?php  include 'conexion.php';

	function crearLugar( $nombre , $tipo, $lugar ){
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

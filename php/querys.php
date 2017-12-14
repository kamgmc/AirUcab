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
//Querys de Rol de sistema
	function insertarRol( $nombre ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Rol_sistema (sr_nombre) VALUES ('".$nombre."')";
		return pg_query($conexion, $qry);
	}
	function editarRol( $id, $nombre ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Rol_sistema SET sr_nombre='".$nombre."' WHERE sr_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarRol( $id ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "DELETE FROM Rol_sistema WHERE sr_id=".$id;
		return pg_query($conexion, $qry);
	}
//Querys de Permiso
	function insertarPermiso( $nombre, $iniciales ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$iniciales = htmlentities($iniciales, ENT_QUOTES);
		if(strlen($iniciales) < 3 || strlen($iniciales) > 5)
			return false;
		$qry = "INSERT INTO Permiso (pe_nombre, pe_iniciales) VALUES ('".$nombre."','".$iniciales."')";
		return pg_query($conexion, $qry);
	}
	function editarPermiso( $id, $nombre, $iniciales ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$iniciales = htmlentities($iniciales, ENT_QUOTES);
		if(strlen($iniciales) < 3 || strlen($iniciales) > 5)
			return false;
		$qry = "UPDATE Permiso SET pe_nombre='".$nombre."', pe_iniciales='".$nombre."' WHERE pe_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarPermiso( $id ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "DELETE FROM Permiso WHERE pe_id=".$id;
		return pg_query($conexion, $qry);
	}
// Querys de Lugar
	function insertarLugar( $nombre , $tipo, $lugar ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "INSERT INTO Lugar (lu_nombre, lu_tipo, lu_lugar) VALUES ('".$nombre."','".$tipo."',".$lugar.")";
		return pg_query($conexion, $qry);
	}
	function editarLugar( $id, $nombre, $tipo, $lugar ){
		$nombre = htmlentities($nombre, ENT_QUOTES);
		$qry = "UPDATE Lugar SET lu_nombre ='".$nombre."', lu_tipo='".$tipo."', lu_lugar=".$lugar." where lu_id=".$id;
		return pg_query($conexion, $qry);
	}
	function eliminarLugar( $id ){
		$qry = "DELETE FROM Lugar where lu_id=".$id;
		return pg_query($conexion, $qry);
	}
?>

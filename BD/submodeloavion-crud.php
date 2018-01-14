<?php 
session_start(); error_reporting('E_ALL ^ E_NOTICE'); 
include 'querys.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 2;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ) $permiso[] = $rol->permiso;
//Crear Submodelo de Avion
if(isset($_GET['create'])){
	if( in_array("as_c", $permiso) ){
		if(insertarSubmodeloAvion( $_POST['nombre'], $_POST['peso_max'], $_POST['peso_vacio'], $_POST['velocidad_crucero'], $_POST['carrera_despegue'], $_POST['autonomia'], $_POST['capacidad_combustible'], $_POST['alcance'], $_POST['modelo'], $_POST['n_motores'] ))
			header('Location: modeloavion.php?tab=submodelo');
		else 
			header('Location: modeloavion.php?tab=submodelo&error=4');
	}
	else 
		header('Location: modeloavion.php?tab=submodelo&error=4');
}
//Editar Submodelo de Avion
if(isset($_GET['edit'])){
	if( in_array("as_u", $permiso) ){
		$id = $_GET['edit'];
		if(editarSubmodeloAvion( $id, $_POST['nombre'], $_POST['peso_max'], $_POST['peso_vacio'], $_POST['velocidad_crucero'], $_POST['carrera_despegue'], $_POST['autonomia'], $_POST['capacidad_combustible'], $_POST['alcance'], $_POST['modelo'], $_POST['n_motores'] ))
			header('Location: modeloavion.php?tab=submodelo');
		else
			header('Location: modeloavion.php?tab=submodelo&error=5');
	}
	else 
		header('Location: modeloavion.php?tab=submodelo&error=5');
}
//Eliminar Submodelo de Avion
if(isset($_GET['delete'])){
	if( in_array("as_d", $permiso) ){
		$id = $_GET['delete'];
		$qry = "Select Count(*) total From Submodelo_avion WHERE as_modelo_avion=(Select as_modelo_avion From Submodelo_avion Where as_id=".$id.")";
		$con = pg_query($conexion, $qry);
		$submodelo = pg_fetch_object($con);
		if( $submodelo->total > 1 ){
			if(eliminarSubmodeloAvion($id))
				header('Location: modeloavion.php?tab=submodelo');
			else
				header('Location: modeloavion.php?tab=submodelo&error=6');
		}
		else
			header('Location: modeloavion.php?tab=submodelo&error=60');
	}
	else 
		header('Location: modeloavion.php?tab=submodelo&error=6');
}
exit;
?>
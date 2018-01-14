<?php 
session_start(); error_reporting('E_ALL ^ E_NOTICE'); 
include 'querys.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 2;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ) $permiso[] = $rol->permiso;

if(isset($_GET['create'])){
	if(in_array("er_c", $permiso)){
		if(insertarCargo($_POST['nombre']))
			header('Location: empleados.php?tab=cargo');
		else
			header('Location: empleados.php?tab=cargo&error=13');
	}
	else
		header('Location: empleados.php?tab=cargo&error=13');
}
if(isset($_GET['edit'])){
	if(in_array("er_u", $permiso)){
		$id = $_GET['edit'];
		if(editarCargo($id, $_POST['nombre']))
			header('Location: empleados.php?tab=cargo');
		else
			header('Location: empleados.php?tab=cargo&error=14');
	}
	else
		header('Location: empleados.php?tab=cargo&error=14');
}
if(isset($_GET['delete'])){
	if(in_array("er_d", $permiso)){
		$id = $_GET['delete'];
		if(eliminarCargo($id))
			header('Location: empleados.php?tab=cargo');
		else
			header('Location: empleados.php?tab=cargo&error=15');
	}
	else
		header('Location: empleados.php?tab=cargo&error=15');
}
exit;
?>
<?php 
session_start(); error_reporting('E_ALL ^ E_NOTICE'); 
include 'querys.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 2;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ) $permiso[] = $rol->permiso;
//Crear Distribucion de Avion
if(isset($_GET['create'])){
	if( in_array("di_c", $permiso) ){
		if(insertarDistribucion( $_POST['nombre'], $_POST['capacidad_pasajeros'], $_POST['numero_clases'], $_POST['distancia_asientos'], $_POST['ancho_asientos'], $_POST['modelo'] ))
			header('Location: modeloavion.php?tab=distribucion');
		else
			header('Location: modeloavion.php?tab=distribucion&error=7');
	}
	else
		header('Location: modeloavion.php?tab=distribucion&error=7');
}
//Editar Distribucion de Avion
if(isset($_GET['edit'])){
	if( in_array("di_u", $permiso) ){
		$id = $_GET['edit'];
		if(editarDistribucion( $id, $_POST['nombre'], $_POST['capacidad_pasajeros'], $_POST['numero_clases'], $_POST['distancia_asientos'], $_POST['ancho_asientos'], $_POST['modelo'] ))
			header('Location: modeloavion.php?tab=distribucion');
		else
			header('Location: modeloavion.php?tab=distribucion&error=8');
	}
	else
		header('Location: modeloavion.php?tab=distribucion&error=8');
}
//Eliminar Distribucion de Avion
if(isset($_GET['delete'])){
	if( in_array("di_d", $permiso) ){
		$id = $_GET['delete'];
		$qry = "Select Count(*) total From Distribucion WHERE di_modelo_avion=(Select di_modelo_avion From Distribucion Where di_id=".$id.")";
		$con = pg_query($conexion, $qry);
		$distribucion = pg_fetch_object($con);
		if($distribucion->total > 1){
			if(eliminarDistribucion($id))
				header('Location: modeloavion.php?tab=distribucion');
			else
				header('Location: modeloavion.php?tab=distribucion&error=9');
		}
		else
			header('Location: modeloavion.php?tab=distribucion&error=90');
	}
	else
		header('Location: modeloavion.php?tab=distribucion&error=9');
}
exit;
?>
<?php 
session_start(); error_reporting('E_ALL ^ E_NOTICE'); 
include 'querys.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 2;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ) $permiso[] = $rol->permiso;
//Crear un Modelo de Avion
if(isset($_GET['create'])){
	if( in_array("am_c", $permiso) ){
		if(insertarModeloAvion( $_POST['nombre'], $_POST['longitud'], $_POST['envergadura'], $_POST['altura'], $_POST['superficie_alar'], $_POST['flecha_alar'], $_POST['peso_max_aterrizaje'], $_POST['alcance'], $_POST['velocidad_max'], $_POST['techo_servicio'], $_POST['regimen_ascenso'], $_POST['numero_pasillos'], $_POST['tipo_fuselaje'], $_POST['altura_fuselaje'], $_POST['ancho_fuselaje'], $_POST['altura_cabina'], $_POST['ancho_cabina'], $_POST['volumen_carga'], $_POST['capacidad_pilotos'], $_POST['capacidad_asistentes'], $_POST['carrera_despegue'], $_POST['tiempo_estimado'] ))
			header('Location: modeloavion.php');
		else
			header('Location: modeloavion.php?error=1');
	}
	else
		header('Location: modeloavion.php?error=1');
}
//Editar un Modelo de Avion
if(isset($_GET['edit'])){
	if( in_array("am_u", $permiso) ){
		$id = $_GET['edit'];
		if(editarModeloAvion( $id, $_POST['nombre'], $_POST['longitud'], $_POST['envergadura'], $_POST['altura'], $_POST['superficie_alar'], $_POST['flecha_alar'], $_POST['peso_max_aterrizaje'], $_POST['alcance'], $_POST['velocidad_max'], $_POST['techo_servicio'], $_POST['regimen_ascenso'], $_POST['numero_pasillos'], $_POST['tipo_fuselaje'], $_POST['altura_fuselaje'], $_POST['ancho_fuselaje'], $_POST['altura_cabina'], $_POST['ancho_cabina'], $_POST['volumen_carga'], $_POST['capacidad_pilotos'], $_POST['capacidad_asistentes'], $_POST['carrera_despegue'], $_POST['tiempo_estimado'] ))
			header('Location: modeloavion.php');
		else
			header('Location: modeloavion.php?error=2');
	}
	else
		header('Location: modeloavion.php?error=2');
}
//Eliminar un Modelo de Avion
if(isset($_GET['delete'])){
	if( in_array("am_d", $permiso) ){
		$id = $_GET['delete'];
		if(eliminarModeloAvion($id))
			header('Location: modeloavion.php');
		else
			header('Location: modeloavion.php?error=3');
	}
	else
		header('Location: modeloavion.php?error=3');
}
exit;
?>
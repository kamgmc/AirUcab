<?php include 'querys.php';
	if(isset($_GET['create'])){
		if(insertarModeloAvion( $_POST['nombre'], $_POST['longitud'], $_POST['envergadura'], $_POST['altura'], $_POST['superficie_alar'], $_POST['flecha_alar'], $_POST['peso_max_aterrizaje'], $_POST['alcance'], $_POST['velocidad_max'], $_POST['techo_servicio'], $_POST['regimen_ascenso'], $_POST['numero_pasillos'], $_POST['tipo_fuselaje'], $_POST['altura_fuselaje'], $_POST['ancho_fuselaje'], $_POST['altura_cabina'], $_POST['ancho_cabina'], $_POST['volumen_carga'], $_POST['capacidad_pilotos'], $_POST['capacidad_asistentes'], $_POST['carrera_despegue'], $_POST['tiempo_estimado'] ))
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		else
			header('Location: modeloavion.php?error=1');
	}
	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		if(editarModeloAvion( $id, $_POST['nombre'], $_POST['longitud'], $_POST['envergadura'], $_POST['altura'], $_POST['superficie_alar'], $_POST['flecha_alar'], $_POST['peso_max_aterrizaje'], $_POST['alcance'], $_POST['velocidad_max'], $_POST['techo_servicio'], $_POST['regimen_ascenso'], $_POST['numero_pasillos'], $_POST['tipo_fuselaje'], $_POST['altura_fuselaje'], $_POST['ancho_fuselaje'], $_POST['altura_cabina'], $_POST['ancho_cabina'], $_POST['volumen_carga'], $_POST['capacidad_pilotos'], $_POST['capacidad_asistentes'], $_POST['carrera_despegue'], $_POST['tiempo_estimado'] ))
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		else
			header('Location: modeloavion.php?error=2');
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		eliminarModeloAvion($id);
		//	header('Location: ' . $_SERVER['HTTP_REFERER']);
		//else
		//	header('Location: modeloavion.php?error=3');
	}
	exit;
?>
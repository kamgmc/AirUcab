<?php include 'querys.php';
	if(isset($_GET['create'])){
		if(insertarSubmodeloAvion( $_POST['nombre'], $_POST['peso_max'], $_POST['peso_vacio'], $_POST['velocidad_crucero'], $_POST['carrera_despegue'], $_POST['autonomia'], $_POST['capacidad_combustible'], $_POST['alcance'], $_POST['modelo'] ))
			header('Location: modeloavion.php?tab=submodelo');
		else
			header('Location: modeloavion.php?tab=submodelo&error=4');
	}
	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		if(editarSubmodeloAvion( $id, $_POST['nombre'], $_POST['peso_max'], $_POST['peso_vacio'], $_POST['velocidad_crucero'], $_POST['carrera_despegue'], $_POST['autonomia'], $_POST['capacidad_combustible'], $_POST['alcance'], $_POST['modelo'] ))
			header('Location: modeloavion.php?tab=submodelo');
		else
			header('Location: modeloavion.php?tab=submodelo&error=5');
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		if(eliminarSubmodeloAvion($id))
			header('Location: modeloavion.php?tab=submodelo');
		else
			header('Location: modeloavion.php?tab=submodelo&error=6');
	}
	exit;
?>
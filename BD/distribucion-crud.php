<?php include 'querys.php';
	if(isset($_GET['create'])){
		if(insertarDistribucion( $_POST['nombre'], $_POST['capacidad_pasajeros'], $_POST['numero_clases'], $_POST['distancia_asientos'], $_POST['ancho_asientos'], $_POST['modelo'] ))
			header('Location: modeloavion.php?tab=distribucion');
		else
			header('Location: modeloavion.php?tab=distribucion&error=7');
	}
	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		if(editarDistribucion( $id, $_POST['nombre'], $_POST['capacidad_pasajeros'], $_POST['numero_clases'], $_POST['distancia_asientos'], $_POST['ancho_asientos'], $_POST['modelo'] ))
			header('Location: modeloavion.php?tab=distribucion');
		else
			header('Location: modeloavion.php?tab=distribucion&error=8');
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		if(eliminarDistribucion($id))
			header('Location: modeloavion.php?tab=distribucion');
		else
			header('Location: modeloavion.php?tab=distribucion&error=9');
	}
	exit;
?>
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
	exit;
?>
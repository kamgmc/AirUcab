<?php include 'querys.php';
	if(isset($_GET['create'])){
		if(insertarCargo($_POST['nombre']))
			header('Location: empleados.php?tab=cargo');
		
		else
			header('Location: empleados.php?tab=cargo&error=13');
	}
	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		if(editarCargo($id, $_POST['nombre']))
			header('Location: empleados.php?tab=cargo');
		
		else
			header('Location: empleados.php?tab=cargo&error=14');
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		if(eliminarCargo($id))
			header('Location: empleados.php?tab=cargo');
		
		else
			header('Location: empleados.php?tab=cargo&error=15');
	}
	exit;
?>
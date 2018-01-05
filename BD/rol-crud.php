<?php include 'querys.php';
	if(isset($_GET['create'])){
		if(insertarRol($_POST['nombre']))
			header('Location: empleados.php?tab=rol');
		else
			header('Location: empleados.php?tab=rol&error=10');
	}
	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		if(editarRol($id, $_POST['nombre']))
			header('Location: empleados.php?tab=rol');
		else
			header('Location: empleados.php?tab=rol&error=11');
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		if(eliminarRol($id))
			header('Location: empleados.php?tab=rol');
		else
			header('Location: empleados.php?tab=rol&error=12');
	}
	exit;
?>
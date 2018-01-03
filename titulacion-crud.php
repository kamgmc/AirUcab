<?php include 'querys.php';
	if(isset($_GET['create'])){
		if(insertarTitulacion($_POST['nombre']))
			header('Location: empleados.php?tab=titulacion');
		
		else
			header('Location: empleados.php?tab=titulacion&error=16');
	}
	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		if(editarTitulacion($id, $_POST['nombre']))
			header('Location: empleados.php?tab=titulacion');
		
		else
			header('Location: empleados.php?tab=titulacion&error=17');
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		if(eliminarTitulacion($id))
			header('Location: empleados.php?tab=titulacion');
		
		else
			header('Location: empleados.php?tab=titulacion&error=18');
	}
	exit;
?>
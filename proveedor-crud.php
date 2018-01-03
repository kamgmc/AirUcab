<?php include 'querys.php';
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		eliminarProveedor($id);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
?>
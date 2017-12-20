<?php include 'querys.php';
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		if(eliminarModeloAvion($id))
			print "yes";
		else
			print "NOOOOO";
		//header('Location: ' . $_SERVER['HTTP_REFERER']);
		//exit;
	}
?>
<?php include 'querys.php';
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		eliminarCliente($id);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	if(isset($_GET['create'])){
		$t_rif = $_POST['tipo_rif'];
		$rif = $_POST['rif'];
		$nombre = $_POST['nombre'];
		$pweb = $_POST['web'];
		$lugar = $_POST['parroquia'];
		if(insertarCliente ( $t_rif, $rif, $nombre, $pweb, $lugar )){
			$qry = "SELECT cl_id AS id FROM Cliente where cl_tipo_rif='".$t_rif."' AND cl_rif=".$rif;
			$answer = pg_query( $conexion, $qry );
			$cliente = pg_fetch_object($answer);
			if(isset($_POST['contacto']) && isset($_POST['tipo_contacto'])) 
				insertarContacto( $_POST['contacto'], $_POST['tipo_contacto'], $cliente->id, 'NULL', 'NULL' );
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
?>
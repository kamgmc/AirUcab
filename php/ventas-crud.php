<?php include 'querys.php';
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		eliminarFacturaVenta($id);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	if(isset($_GET['create'])){
		$cliente = $_POST['cliente'];
		$submodelo = $_POST['submodelo'];
		$distribucion = $_POST['distribucion'];
		$precio = $_POST['precio'];
		if(insertarFacturaVenta ( $cliente )){
			$qry = "SELECT Max(fv_id) AS id FROM Factura_venta where fv_cliente=".$cliente;
			$answer = pg_query( $conexion, $qry );
			$factura = pg_fetch_object($answer);
			insertarAvion( $factura->id, $distribucion, $submodelo, $precio );
		}
		//header('Location: ' . $_SERVER['HTTP_REFERER']);
		//exit;
	}
?>
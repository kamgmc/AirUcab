<?php include 'querys.php';
	if(isset($_GET['create'])){
		//Busca Errores en las variables 
		$exit = false; $i = 0;
		while(!$exit){
			if( isset($_POST['distribucion'][$i]) && isset($_POST['submodelo'][$i]) && isset($_POST['precio'][$i]) ){
				if( strlen($_POST['precio'][$i]) <= 4 ){header('Location: ventas.php?error=2');exit;}
				$i++;
			}
			else $exit = true;
		}
		$exit = false; $i = 0;
		while(!$exit){
			if( isset($_POST['transferencia'][$i]) && isset($_POST['transferencia_monto'][$i]) ){
				if( strlen($_POST['transferencia'][$i]) <= 3 ){header('Location: ventas.php?error=3');exit;}
				if( $_POST['transferencia_monto'][$i] <= 0 ){header('Location: ventas.php?error=3');exit;}
				$i++;
			}
			else $exit = true;
		}
		$exit = false; $i = 0;
		while(!$exit){
			if( isset($_POST['tarjeta_numero'][$i]) && isset($_POST['tarjeta_nombre'][$i]) && isset($_POST['tarjeta_cod'][$i]) && isset($_POST['tarjeta_fecha'][$i]) && isset($_POST['tarjeta_monto'][$i]) ){
				if(strlen($_POST['tarjeta_numero'][$i]) != 16 ){header('Location: ventas.php?error=3');exit;}
				if(strlen($_POST['tarjeta_cod'][$i]) != 3 ){header('Location: ventas.php?error=3');exit;}
				if( $_POST['tarjeta_monto'][$i] <= 0 ){header('Location: ventas.php?error=3');exit;}
				$i++;
			}
			else $exit = true;
		}
		//Inserta Factura al Cliente
		if(insertarFacturaVenta ( $_POST['cliente'] )){
			$qry = "SELECT Max(fv_id) AS id FROM Factura_venta where fv_cliente=".$_POST['cliente'];
			$answer = pg_query( $conexion, $qry );
			$factura = pg_fetch_object($answer);
			// Inserta todos los aviones que se hayan escrito en el formulario
			$exit = false; $i = 0;
			while(!$exit){
				if( isset($_POST['distribucion'][$i]) && isset($_POST['submodelo'][$i]) && isset($_POST['precio'][$i]) ){
					if( insertarAvion( $factura->id, $_POST['distribucion'][$i], $_POST['submodelo'][$i], $_POST['precio'][$i] ) ){
						$qry = "SELECT Max(a_id) AS id FROM Avion where a_submodelo_avion=".$_POST['submodelo'][$i]." AND a_distribucion=".$_POST['distribucion'][$i]." AND a_precio=".$_POST['precio'][$i];
						if($answer = pg_query( $conexion, $qry )){
							$avion = pg_fetch_object($answer);
							if( insertarStatusAvion( 1, $avion->id ) )
								$i++;
							//else{header('Location: ventas.php?error=2');exit;}
						}
						//else{header('Location: ventas.php?error=2');exit;}
					}
					//else{header('Location: ventas.php?error=2');exit;}
				}
				else $exit = true;
			}
			//Inserta todos los pagos que fueron por trasnferencia
			$exit = false; $i = 0;
			while(!$exit){
				if( isset($_POST['transferencia'][$i]) && isset($_POST['transferencia_monto'][$i]) ){
					if(insertarTipoPago( $_POST['transferencia'][$i], 'NULL', 'NULL', 'NULL' )) {
						$qry = "SELECT Max(pt_id) AS id FROM Tipo_pago where pt_numero=".$_POST['transferencia'][$i];
						if($answer = pg_query( $conexion, $qry )){
							$tipo_pago = pg_fetch_object($answer);
							if(insertarPago( $_POST['transferencia_monto'][$i], $tipo_pago->id, $factura->id, 'NULL' ))
								$i++;
							//else{header('Location: ventas.php?error=3');exit;}
						}
						//else{header('Location: ventas.php?error=3');exit;}
					}
					//else{header('Location: ventas.php?error=3');exit;}
				}
				else $exit = true;
			}
			//Inserta todos los pagos que fueron por tarjeta de credito
			$exit = false; $i = 0;
			while(!$exit){
				if( isset($_POST['tarjeta_numero'][$i]) && isset($_POST['tarjeta_nombre'][$i]) && isset($_POST['tarjeta_cod'][$i]) && isset($_POST['tarjeta_fecha'][$i]) && isset($_POST['tarjeta_monto'][$i]) ){
					if(insertarTipoPago( $_POST['tarjeta_numero'][$i], $_POST['tarjeta_nombre'][$i], $_POST['tarjeta_cod'][$i], $_POST['tarjeta_fecha'][$i] )) {
						$qry = "SELECT Max(pt_id) AS id FROM Tipo_pago where pt_numero=".$_POST['tarjeta_numero'][$i]." AND pt_tc_nombre='".$_POST['tarjeta_nombre'][$i]."'";
						if($answer = pg_query( $conexion, $qry )){
							$tipo_pago = pg_fetch_object($answer);
							if(insertarPago( $_POST['tarjeta_monto'][$i], $tipo_pago->id, $factura->id, 'NULL' ))
								$i++;
							//else{header('Location: ventas.php?error=3');exit;}
						}
						//else{header('Location: ventas.php?error=3');exit;}
					}
					//else{header('Location: ventas.php?error=3');exit;}
				}
				else $exit = true;
			}
		}
		//else header('Location: ventas.php?error=1');
		exit;
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		eliminarFacturaVenta($id);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
?>
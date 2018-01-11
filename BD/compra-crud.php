<?php include 'querys.php';
	if(isset($_GET['create'])){
		//Busca Errores en las variables de Avión 
		$exit = false; $i = 0;
		while(!$exit){
			if( isset($_POST['material'][$i]) && isset($_POST['cantidad'][$i]) && isset($_POST['precio'][$i]) ){
				if( $_POST['cantidad'][$i] <= 0 ){header('Location: ventas.php?error=2');exit;}
				$i++;
			}
			else $exit = true;
		}
		//Busca errores en las variables de Transferencia
		$exit = false; $i = 0;
		while(!$exit){
			if( isset($_POST['transferencia'][$i]) && isset($_POST['transferencia_monto'][$i]) ){
				if( strlen($_POST['transferencia'][$i]) <= 3 ){header('Location: ventas.php?error=3');exit;}
				if( $_POST['transferencia_monto'][$i] <= 0 ){header('Location: ventas.php?error=3');exit;}
				$i++;
			}
			else $exit = true;
		}
		//Busca errores en las variables de Tarjeta de credito
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
		//Crea una nueva Factura de compra al proveedor
		if(insertarFacturaCompra ( $_POST['proveedor'] )){//Crea una Factura de compra
			$qry = "SELECT Max(fc_id) AS id FROM Factura_compra where fc_proveedor=".$_POST['proveedor']; // Busca el ID recien insertado
			$answer = pg_query( $conexion, $qry );
			$factura = pg_fetch_object($answer);
			// Inserta todos los materiales que se hayan escrito en el formulario
			$exit = false; $i = 0;
			while(!$exit){
				if( isset($_POST['material'][$i]) && isset($_POST['cantidad'][$i]) && isset($_POST['precio'][$i]) ){ 
					$iteraciones = $_POST['cantidad'][$i];
					$estable = $i;//Todas las variables de avion deben existir
					for($x = 0; $x < $iteraciones; $x++){
						$qry2 = "SELECT m_id id FROM material WHERE m_factura_compra=0 and m_tipo_material=".$_POST['material'][$estable]." order by id";
						$anwser = pg_query($conexion, $qry2); 
						if(pg_num_rows($anwser) > 0){
							print "HAY<br/>";
							$material = pg_fetch_object($anwser);
							$qry = "UPDATE Material SET m_factura_compra=".$factura->id.", m_precio=".$_POST['precio'][$estable]." WHERE m_id=".$material->id;
							if(pg_query($conexion, $qry)){
								insertarTraslado(4, 4, 'NULL', $material->id, 'NULL');
								$qryp = 'SELECT MAX(tr_id) AS id From Traslado Where tr_material='.$material->id;
								$anwserp = pg_query($conexion, $qryp);
								$id = pg_fetch_object($anwserp);
								editarTraslado($id->id, 'TRUE');
							}
							//else{header('Location: ventas.php?error=2');exit;}
						}
						else{
							print "NO HAY<br/>";
							if(insertarMaterial( $_POST['material'][$estable], $factura->id, 'NULL', $_POST['precio'][$estable] )){//Material nuevo
								$qry = "SELECT MAX(m_id) AS id FROM Material WHERE m_factura_compra=".$factura->id." AND m_tipo_material=".$_POST['material'][$estable]." AND m_pieza is NULL";
								$anwser = pg_query($conexion, $qry);
								$materialc = pg_fetch_object($anwser);
								insertarStatusMaterial( 1, $materialc->id);
								insertarTraslado(4, 4, 'NULL', $materialc->id, 'NULL');
								$qryp = 'SELECT MAX(tr_id) AS id From Traslado Where tr_material='.$materialc->id;
								$anwserp = pg_query($conexion, $qryp);
								$id = pg_fetch_object($anwserp);
								editarTraslado($id->id, 'TRUE');
							}
							//else{header('Location: ventas.php?error=2');exit;}
						}
					}
					$i++;
				}
				else $exit = true;
			}
			//Inserta todos los pagos que fueron por transferencia
			$exit = false; $i = 0;
			while(!$exit){
				if( isset($_POST['transferencia'][$i]) && isset($_POST['transferencia_monto'][$i]) ){ //Todas las variables deben existir
					if(insertarTipoPago( $_POST['transferencia'][$i], 'NULL', 'NULL', 'NULL' )) { //Inserta el tipo de pago transferencia
						$qry = "SELECT Max(pt_id) AS id FROM Tipo_pago where pt_numero=".$_POST['transferencia'][$i];
						if($answer = pg_query( $conexion, $qry )){
							$tipo_pago = pg_fetch_object($answer);
							if(insertarPago( $_POST['transferencia_monto'][$i], $tipo_pago->id, $factura->id, 'NULL' ))//Inserta el pago con el monto
								$i++;
							else{header('Location: ventas.php?error=3');exit;}
						}
						else{header('Location: ventas.php?error=3');exit;}
					}
					else{header('Location: ventas.php?error=3');exit;}
				}
				else $exit = true;
			}
			//Inserta todos los pagos que fueron por tarjeta de credito
			$exit = false; $i = 0;
			while(!$exit){
				if( isset($_POST['tarjeta_numero'][$i]) && isset($_POST['tarjeta_nombre'][$i]) && isset($_POST['tarjeta_cod'][$i]) && isset($_POST['tarjeta_fecha'][$i]) && isset($_POST['tarjeta_monto'][$i]) ){//Todas las variables deben existir
					if(insertarTipoPago( $_POST['tarjeta_numero'][$i], $_POST['tarjeta_nombre'][$i], $_POST['tarjeta_cod'][$i], $_POST['tarjeta_fecha'][$i] )) { //Inserta el tipo de pago por Tarjeta de credito
						$qry = "SELECT Max(pt_id) AS id FROM Tipo_pago where pt_numero=".$_POST['tarjeta_numero'][$i]." AND pt_tc_nombre='".$_POST['tarjeta_nombre'][$i]."'";
						if($answer = pg_query( $conexion, $qry )){
							$tipo_pago = pg_fetch_object($answer);
							if(insertarPago( $_POST['tarjeta_monto'][$i], $tipo_pago->id, $factura->id, 'NULL' ))//Inserta el pago con el monto
								$i++;
							else{header('Location: ventas.php?error=3');exit;}
						}
						else{header('Location: ventas.php?error=3');exit;}
					}
					else{header('Location: ventas.php?error=3');exit;}
				}
				else $exit = true;
			}
			//header('Location: ventas.php');exit;
		}
		else header('Location: ventas.php?error=1');exit;
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		if(eliminarFacturaCompra($id))
			header('Location: compras.php');
		else
			header('Location: compras.php?error=5');
		exit;
	}
?>
<?php include 'querys.php';
	if(isset($_GET['create'])){
		//Busca Errores en las variables de Avión 
		$exit = false; $i = 0;
		while(!$exit){
			if( isset($_POST['distribucion'][$i]) && isset($_POST['submodelo'][$i]) && isset($_POST['precio'][$i]) ){
				if( strlen($_POST['precio'][$i]) <= 4 ){header('Location: ventas.php?error=2');exit;}
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
		//Crea una nueva Factura de venta al Cliente
		if(insertarFacturaVenta ( $_POST['cliente'] )){//Crea una Factura de venta
			$qry = "SELECT Max(fv_id) AS id FROM Factura_venta where fv_cliente=".$_POST['cliente']; // Busca el ID recien insertado
			$answer = pg_query( $conexion, $qry );
			$factura = pg_fetch_object($answer);
			// Inserta todos los aviones que se hayan escrito en el formulario
			$exit = false; $i = 0;
			while(!$exit){
				if( isset($_POST['distribucion'][$i]) && isset($_POST['submodelo'][$i]) && isset($_POST['precio'][$i]) ){ //Todas las variables de avion deben existir
					if( insertarAvion( $factura->id, $_POST['distribucion'][$i], $_POST['submodelo'][$i], $_POST['precio'][$i] ) ){// Crea un avión
						$qry = "SELECT Max(a_id) AS id FROM Avion where a_submodelo_avion=".$_POST['submodelo'][$i]." AND a_distribucion=".$_POST['distribucion'][$i]." AND a_precio=".$_POST['precio'][$i];
						if($answer = pg_query( $conexion, $qry )){
							$avion = pg_fetch_object($answer);
							//Inicializa el status cada Avión
							if( insertarStatusAvion( 1, $avion->id ) ){
								$qry = "Select pm_id AS id, pm_cantidad AS cantidad from s_avion_m_pieza INNER JOIN Modelo_pieza ON smp_modelo_pieza=pm_modelo_pieza Where smp_submodelo_avion=".$_POST['submodelo'][$i]." UNION Select smp_modelo_pieza AS id, smp_cantidad AS cantidad from s_avion_m_pieza Where smp_submodelo_avion=".$_POST['submodelo'][$i]." ORDER BY id";
								$anwsermodelo = pg_query($conexion, $qry);
								print $_POST['submodelo'][$i]." submodelo<br/>";
								while( $modelo_pieza = pg_fetch_object($anwsermodelo) ){
									print $modelo_pieza->id.' modelo pieza<br/>';
									for($j = 1; $j <= $modelo_pieza->cantidad; $j++ ){
										print $j.' $j<br/>';
										if(insertarPieza( $modelo_pieza->id, $avion->id )){//Crea una nueva pieza
											$qry = "SELECT Max(p_id) AS id FROM Pieza where p_avion=".$avion->id." AND p_modelo_pieza=".$modelo_pieza->id;
											if($answer = pg_query( $conexion, $qry )){
												$pieza = pg_fetch_object($answer);//Pieza especifica
												$qry2 = "SELECT tmm_id id, tmm_cantidad cantidad, tmm_tipo_material material FROM t_material_m_pieza WHERE tmm_modelo_pieza=".$modelo_pieza->id;
												//Hace una lista de los materiales necesarios
												$anwser = pg_query($conexion, $qry2); $materiales = array();
												while( $material = pg_fetch_object($anwser) )
													$materiales[$material->id] = $material->cantidad;
												//Recorre todos los materiales necesarios
												$anwser = pg_query($conexion, $qry2);
												while($pm = pg_fetch_object($anwser)){
													// Busca si hay materiales ya creados disponibles
													$qry = "SELECT m_id id FROM Material, Status_material, Status WHERE m_tipo_material=".$pm->material." AND m_pieza=NULL AND sm_material=m_id AND sm_status=st_id AND st_nombre<>'Rechazado'";
													$anwser = pg_query($conexion, $qry);
													while($material = pg_fetch_object($anwser)){
														if( isset($materiales[$pm->id]) ){
															editarMaterial( $material->id, $pieza->id, 0 );
															$materiales[$pm->id]--;
															if($materiales[$pm->id] == 0){
																unset($materiales[$pm->id]);
																
															}
														}
													}
												}
												$anwser = pg_query($conexion, $qry2);
												while($pm = pg_fetch_object($anwser)){
													if( isset($materiales[$pm->id]) && $materiales[$pm->id] > 0 ){
														for($h = 0; $h < $materiales[$pm->id]; $h++){
															insertarMaterial( $pm->material, 0, $pieza->id, 1 );//Material nuevo
															$qry = "SELECT MAX(m_id) AS id FROM Material WHERE m_factura_compra=0 AND m_tipo_material=".$pm->material." AND m_pieza=".$pieza->id;
															$anwser = pg_query($conexion, $qry);
															$materialc = pg_fetch_object($anwser);
															insertarStatusMaterial( 1, $materialc->id);//Status del material inicialmente
														}
													}
												}
												insertarStatusPieza( 1, $pieza->id );
											}
										}
									}
									print $modelo_pieza->id.' modelo pieza<br/>';
									print 'out<br/>';
								}
								$i++;
								print 'outout<br/>';
							}
							else{header('Location: ventas.php?error=2');exit;}
						}
						else{header('Location: ventas.php?error=2');exit;}
					}
					else{header('Location: ventas.php?error=2');exit;}
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
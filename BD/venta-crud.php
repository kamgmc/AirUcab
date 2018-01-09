<?php include 'querys.php';
	if(isset($_GET['create'])){
		//Busca Errores en las variables de Avión 
		$exit = false; $i = 0;
		while(!$exit){
			if( isset($_POST['distribucion'][$i]) && isset($_POST['submodelo'][$i]) && isset($_POST['precio'][$i]) && isset($_POST['cantidad'][$i]) ){
				if( strlen($_POST['precio'][$i]) <= 4 ){header('Location: ventas.php?error=2');exit;}
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
		//Crea una nueva Factura de venta al Cliente
		if(insertarFacturaVenta ( $_POST['cliente'] )){//Crea una Factura de venta
			$qry = "SELECT Max(fv_id) AS id FROM Factura_venta where fv_cliente=".$_POST['cliente']; // Busca el ID recien insertado
			$answer = pg_query( $conexion, $qry );
			$factura = pg_fetch_object($answer);
			// Inserta todos los aviones que se hayan escrito en el formulario
			$exit = false; $i = 0;
			while(!$exit){
				if( isset($_POST['distribucion'][$i]) && isset($_POST['submodelo'][$i]) && isset($_POST['precio'][$i]) && isset($_POST['cantidad'][$i]) && isset($_POST['motor'.$i]) ){ 
					$iteraciones = $_POST['cantidad'][$i];
					$estable = $i;//Todas las variables de avion deben existir
					$Postmotor = "motor".$i;
					for($x = 0; $x < $iteraciones; $x++){
						if( insertarAvion( $factura->id, $_POST['distribucion'][$estable], $_POST['submodelo'][$estable], $_POST['precio'][$estable] ) ){// Crea un avión
							$qry = "SELECT Max(a_id) AS id FROM Avion where a_submodelo_avion=".$_POST['submodelo'][$estable]." AND a_distribucion=".$_POST['distribucion'][$estable]." AND a_precio=".$_POST['precio'][$estable];
							if($answer = pg_query( $conexion, $qry )){
								$avion = pg_fetch_object($answer);
								//Inicializa el status cada Avión
								if( insertarStatusAvion( 1, $avion->id ) ){
									$qry = "Select pm_id AS id, pm_cantidad AS cantidad from s_avion_m_pieza INNER JOIN Modelo_pieza ON smp_modelo_pieza=pm_modelo_pieza Where smp_submodelo_avion=".$_POST['submodelo'][$estable]." UNION Select smp_modelo_pieza AS id, smp_cantidad AS cantidad from s_avion_m_pieza Where smp_submodelo_avion=".$_POST['submodelo'][$estable]." ORDER BY id";
									$anwsermodelo = pg_query($conexion, $qry);
									while( $modelo_pieza = pg_fetch_object($anwsermodelo) ){
										for($j = 1; $j <= $modelo_pieza->cantidad; $j++ ){
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
									}
									$qry = "SELECT pm_id AS id FROM modelo_pieza WHERE pm_nombre='Asiento'";
									$anwser = pg_query($conexion, $qry);
									$asiento = pg_fetch_object($anwser);

									$qry = "SELECT di_capacidad_pasajeros AS capacidad FROM distribucion WHERE di_id=".$_POST['distribucion'][$estable];
									$anwser = pg_query($conexion, $qry);
									$distribucion = pg_fetch_object($anwser);

									for($h = 0; $h < $distribucion->capacidad; $h++){
										if(insertarPieza( $asiento->id, $avion->id )){//Crea una nueva pieza
											$qry = "SELECT Max(p_id) AS id FROM Pieza where p_avion=".$avion->id." AND p_modelo_pieza=".$asiento->id;
											if($answer = pg_query( $conexion, $qry )){
												$pieza = pg_fetch_object($answer);//Pieza especifica
												$qry2 = "SELECT tmm_id id, tmm_cantidad cantidad, tmm_tipo_material material FROM t_material_m_pieza WHERE tmm_modelo_pieza=".$asiento->id;
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
									$qry = "SELECT as_cantidad_motor AS cantidad FROM Submodelo_avion WHERE as_id=".$_POST['submodelo'][$estable];
									$anwser = pg_query($conexion, $qry);
									$submodelo = pg_fetch_object($anwser);

									for($h = 0; $h < $submodelo->cantidad; $h++){
										if(insertarMotor( $_POST[$Postmotor][$h], $avion->id )){//Crea una nueva pieza
											$qry = "SELECT Max(mo_id) AS id FROM Motor where mo_avion=".$avion->id." AND mo_modelo_motor=".$_POST[$Postmotor][$h];
											if($answer = pg_query( $conexion, $qry )){
												$motor = pg_fetch_object($answer);//Motor especifico
												insertarStatusMotor( 1, $motor->id );
											}
										}
									}
									$i++;
								}
								//else{header('Location: ventas.php?error=2');exit;}
							}
							//else{header('Location: ventas.php?error=2');exit;}
						}
						//else{header('Location: ventas.php?error=2');exit;}
					}
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
				if( isset($_POST['tarjeta_numero'][$i]) && isset($_POST['tarjeta_nombre'][$i]) && isset($_POST['tarjeta_cod'][$i]) && isset($_POST['tarjeta_fecha'][$i]) && isset($_POST['tarjeta_monto'][$i]) ){//Todas las variables deben existir
					if(insertarTipoPago( $_POST['tarjeta_numero'][$i], $_POST['tarjeta_nombre'][$i], $_POST['tarjeta_cod'][$i], $_POST['tarjeta_fecha'][$i] )) { //Inserta el tipo de pago por Tarjeta de credito
						$qry = "SELECT Max(pt_id) AS id FROM Tipo_pago where pt_numero=".$_POST['tarjeta_numero'][$i]." AND pt_tc_nombre='".$_POST['tarjeta_nombre'][$i]."'";
						if($answer = pg_query( $conexion, $qry )){
							$tipo_pago = pg_fetch_object($answer);
							if(insertarPago( $_POST['tarjeta_monto'][$i], $tipo_pago->id, $factura->id, 'NULL' ))//Inserta el pago con el monto
								$i++;
							//else{header('Location: ventas.php?error=3');exit;}
						}
						//else{header('Location: ventas.php?error=3');exit;}
					}
					//else{header('Location: ventas.php?error=3');exit;}
				}
				else $exit = true;
			}
			//header('Location: ventas.php');exit;
		}
		//else header('Location: ventas.php?error=1');exit;
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		eliminarFacturaVenta($id);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
?>
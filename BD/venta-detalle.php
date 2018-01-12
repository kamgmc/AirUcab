<?php session_start();
include 'conexion.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 2;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "SELECT fv_id id, fv_fecha fecha, cl_nombre cliente, cl_tipo_rif||'-'||cl_rif AS rif, (Select SUM(a_precio) From Avion Where a_factura_venta=".$_GET['id'].") AS  total, (Select SUM(pa_monto) from Pago WHERE pa_factura_venta=".$id.") AS pagado FROM Factura_venta LEFT JOIN Cliente ON fv_cliente=cl_id WHERE fv_id=".$id;
$con = pg_query($conexion, $qry);
$venta = pg_fetch_object($con);
$resultado = '<div class="modal-header">
				<h4 id="exampleModalLabel" class="modal-title">Detalle de Venta</h4>
				<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="card col-lg-12">
							<div class="row">
								<!-- Columna Izquierda   -->
								<div class="card-body col-lg-6">
									<div class="row">
										<div class="col-lg-4">
											<h4>N° de Factura</h4>
										</div>
										<div class="col-lg-8">'.$venta->id.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4"><h4>';
										if($venta->pagado >= $venta->total) $resultado .= '<span class="badge badge-success">Pagado</span>';
										if($venta->pagado < $venta->total) $resultado .= '<span class="badge badge-primary">Pendiente de pago</span>';
									$resultado .= '</h4>
										</div>';$date = new DateTime($venta->fecha);
										if($venta->pagado < $venta->total) $resultado .= '<div class="col-lg-8">'.number_format($venta->total-$venta->pagado, 2, ',', '.').' Bs</div>';
									$resultado .= '</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Total</h4>
										</div>
										<div class="col-lg-8">'.number_format($venta->total, 2, ',', '.').'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Fecha</h4>
										</div>
										<div class="col-lg-8">'.$date->format('d/m/Y').'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Cliente</h4>
										</div>
										<div class="col-lg-8">'.$venta->cliente.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>CI / RIF</h4>
										</div>
										<div class="col-lg-8">'.$venta->rif.'</div>
									</div>
								</div>
								<!-- Columna izquierda ENDS -->
								<!-- Columna derecha -->
								<div class=" card-body col-lg-6">';
									$qry = "SELECT pa_id id, pa_monto monto, pa_fecha fecha, pt_numero transaccion, pt_tc_nombre tc_nombre, pt_tc_fecha vencimiento FROM Pago LEFT JOIN Tipo_pago ON pa_tipo_pago=pt_id WHERE pa_factura_venta=".$_GET['id'];
									$rs = pg_query($conexion, $qry);
									$howMany = pg_num_rows($rs);
									if( $howMany > 0 ){
										$resultado .='<div class="row">
											<div class="col-lg-4">
												<h4>Pago</h4> 
											</div>
										</div>
										<div class="row">
											<div class="list-group col-sm-12">';
												$con = pg_query($conexion, $qry);
												while($pago = pg_fetch_object($con)){
													$resultado .='
														<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
															<div class="d-flex w-100 justify-content-between">
																<h5 class="mb-1">';
													if(is_null($pago->tc_nombre))
														$resultado .= "Transferencia";
													else
														$resultado .= "Tarjeta de Crédito";
													$date = new DateTime($pago->fecha);
													$resultado .='</h5><small> '.$date->format('d/m/Y').'</small></div>';
													$resultado .='<strong>Monto:</strong> '.number_format($pago->monto, 2, ',', '.').' Bs<br/>';
													if(is_null($pago->tc_nombre))
														$resultado .= "<strong>N° de Transferencia:</strong> ".$pago->transaccion."<br/>";
													if(!is_null($pago->tc_nombre)) $resultado .= "<strong>Tarjetahabiente:</strong> ".$pago->tc_nombre."<br/><strong>N° de Tarjeta:</strong> ".chunk_split($pago->transaccion, 4, ' ')."<br/>";
													if(!is_null($pago->vencimiento)){ 
														$date = new DateTime($pago->vencimiento);
														$resultado .= "<strong>Fecha de vencimiento:</strong> ".$date->format('d/m/Y');
													}
													$resultado .= '</a>';
												}
											$resultado .='</div>
										</div>';
									}
									else
										$resultado .='<div class="row">
											<div class="col-lg-12">
												<h4>No se han registrado pagos.</h4> 
											</div>
										</div>';
									$resultado .= '
								</div>
							</div>';
							if( in_array("a_r", $permiso) ){
							$resultado .= '<div class="row">
								<div class="col-md-12">
									<table class="table table-striped table-sm table-hover">
										<thead>
											<tr>
												<th class="text-center">ID</th>
												<th>Avión</th>
												<th class="text-center">Distribución</th>
												<th class="text-center">Inicio de fabricación</th>
												<th class="text-center">Fecha de entrega (Aprox)</th>
												<th class="text-center">Precio</th>
												<th class="text-center">Status</th>
												<th class="text-center">Acción</th>
											</tr>
										</thead>
										<tbody>';
										$qry = "Select a_id AS id, am_nombre||' - '||as_nombre AS nombre, di_nombre AS distribucion, a_fecha_ini fecha_ini, a_fecha_fin fecha_fin, st_nombre as status, a_precio AS precio FROM Factura_venta RIGHT JOIN Avion av ON fv_id=a_factura_venta LEFT JOIN Status_avion ON sa_avion=a_id LEFT JOIN Status ON sa_status=st_id LEFT JOIN Submodelo_avion ON a_submodelo_avion=as_id LEFT JOIN Distribucion ON a_distribucion=di_id LEFT JOIN Modelo_avion ON as_modelo_avion=am_id WHERE sa_id = (SELECT MAX(sa_id) FROM Status_avion WHERE sa_avion=av.a_id) AND fv_id=".$_GET['id'];
										$rs = pg_query( $conexion, $qry );
											while( $avion = pg_fetch_object($rs) ){
												$dateIni = new DateTime($avion->fecha_ini);
												if(!is_null($avion->fecha_fin)){
													$dateFin = new DateTime($avion->fecha_fin);
													$dateFin = $dateFin->format("d/m/Y");
												}
												else
													$dateFin = "";
												$resultado .= '<tr>
													<td class="text-center">'.$avion->id.'</td>
													<td>'.$avion->nombre.'</td>
													<td class="text-center">'.$avion->distribucion.'</td>
													<td class="text-center">'.$dateIni->format("d/m/Y").'</td>
													<td class="text-center">'.$dateFin.'</td>
													<td class="text-center">'.number_format($avion->precio, 2, ",", ".").' Bs</td>
													<td class="text-center">'.$avion->status.'</td>
													<td class="text-center">
														<a href="'.$avion->id.'" title="Ver mas" class="click-avion-detalle">
															<i class="fa fa-file-text-o" aria-hidden="true"></i> 
														</a>&emsp;
														<a href="avion-crud.php?delete='.$avion->id.'"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
													</td>
												</tr>';
											}
										$resultado .= '</tbody>
									</table>
								</div>
							</div>';
							}
						$resultado .= '</div>
					</div>
				</div>
			</div>
			<script>
			$( "a.click-avion-detalle" ).click(function( event ) {
				event.preventDefault();
				var href = $(this).attr("href");
				$.ajax({type: "POST",dataType: "html",url:"avion-detalle.php?id="+href,success: function(data){$("#detalleAvionBody").html(data);}});
				$("#ModalDetalleAvion").modal("toggle");
				$("#ModalDetalleAvion").modal("handleUpdate");
			});
			</script>';
echo $resultado;
?>
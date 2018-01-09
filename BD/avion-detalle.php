<?php session_start();
include 'conexion.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "SELECT p_id AS id, p_fecha_ini AS fecha, pm_nombre AS nombre, st_nombre AS status, wt_nombre AS ala, et_nombre AS estabilizador FROM pieza pi,status_pieza,status,modelo_pieza LEFT JOIN Tipo_ala ON wt_id=pm_tipo_ala LEFT JOIN Tipo_estabilizador ON et_id=pm_tipo_estabilizador WHERE pm_id=p_modelo_pieza and st_id=spi_status and p_id=spi_pieza and spi_id=(SELECT Max(spi_id) FROM Status_pieza WHERE spi_pieza=pi.p_id) and p_avion=".$id;
$qryMotor = "SELECT mo_id AS id, mo_fecha_ini AS fecha, mb_nombre||' - '||mm_nombre AS nombre, st_nombre AS status FROM Motor mo, Status_motor, Status, Modelo_motor, Marca_motor WHERE mm_id=mo_modelo_motor and st_id=stm_status and mo_id=stm_motor and mm_marca=mb_id and stm_id=(SELECT Max(stm_id) FROM Status_motor WHERE stm_motor=mo.mo_id) and mo_avion=".$id;
$con = pg_query($conexion, $qry);
$conMotor = pg_query($conexion, $qryMotor);
$resultado = '<div class="modal-header">
				<h4 id="exampleModalLabel" class="modal-title">Detalle de Avion</h4>
				<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
							<div class="col-md-12">
								<table class="table table-striped table-sm table-hover">
									<thead>
										<tr>
											<th class="text-center">ID</th>
											<th>Pieza</th>
											<th class="text-center">Fecha</th>
											<th class="text-center">Status</th>
											<th class="text-center">Acción</th>
										</tr>
									</thead>
									<tbody>';
										while( $pieza = pg_fetch_object($con) ){
											$date = new DateTime($pieza->fecha);
											$resultado .= '<tr>
												<td class="text-center">'.$pieza->id.'</td>
												<td>'.$pieza->nombre;
											if(!is_null($pieza->ala))
												$resultado .= " ".$pieza->ala;
											if(!is_null($pieza->estabilizador))
												$resultado .= " ".$pieza->estabilizador;
												$resultado .= '</td>
												<td class="text-center">'.$date->format("d/m/Y").'</td>
												<td class="text-center">'.$pieza->status.'</td>
												<td class="text-center">
													<a href="'.$pieza->id.'" data-nombre="'.$pieza->nombre;
											if(!is_null($pieza->ala))
												$resultado .= " ".$pieza->ala;
											if(!is_null($pieza->estabilizador))
												$resultado .= " ".$pieza->estabilizador;
												$resultado .= '" title="Ver mas" class="click-pieza-detalle">
														<i class="fa fa-file-text-o" aria-hidden="true"></i> 
													</a>&emsp;
													<a href="pieza-crud.php?delete='.$pieza->id.'"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
												</td>
											</tr>';
										}
										while( $motor = pg_fetch_object($conMotor) ){
											$date = new DateTime($motor->fecha);
											$resultado .= '<tr>
												<td class="text-center">'.$motor->id.'</td>
												<td>Motor '.$motor->nombre.'</td>
												<td class="text-center">'.$date->format("d/m/Y").'</td>
												<td class="text-center">'.$motor->status.'</td>
												<td class="text-center">
													<a href="'.$motor->id.'" data-nombre="'.$motor->nombre.'" title="Ver mas" class="click-motor-detalle">
														<i class="fa fa-file-text-o" aria-hidden="true"></i> 
													</a>&emsp;
													<a href="motor-crud.php?delete='.$motor->id.'"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
												</td>
											</tr>';
										}
									$resultado .= '</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
		$( "a.click-pieza-detalle" ).click(function( event ) {
			event.preventDefault();
			var href = $(this).attr("href");
			var nombre = $(this).data("nombre");
			$.ajax({type: "POST",dataType: "html",url:"pieza-detalle.php?id="+href+"&nombre="+nombre,success: function(data){$("#detallePiezaBody").html(data);}});
			$("#ModalDetallePieza").modal("toggle");
			$("#ModalDetallePieza").modal("handleUpdate");
		});
		$( "a.click-motor-detalle" ).click(function( event ) {
			event.preventDefault();
			var href = $(this).attr("href");
			var nombre = $(this).data("nombre");
			$.ajax({type: "POST",dataType: "html",url:"motor-detalle.php?id="+href+"&nombre="+nombre,success: function(data){$("#detalleMotorBody").html(data);}});
			$("#ModalDetalleMotor").modal("toggle");
			$("#ModalDetalleMotor").modal("handleUpdate");
		});
		$("#ModalDetalleMotor").on("hidden.bs.modal", function () {
			$("#ModalDetalleAvion").modal("handleUpdate");
		});
		$("#ModalDetallePieza").on("hidden.bs.modal", function () {
			$("#ModalDetalleAvion").modal("handleUpdate");
		});
		</script>';
echo $resultado;
?>
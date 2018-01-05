<?php session_start();
include 'conexion.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "Select spi_id AS id, spi_fecha_ini AS fecha_ini, spi_fecha_fin AS fecha_fin, st_nombre AS status, se_nombre||' - '||zo_nombre AS ubicacion, tr_confirmacion AS recibido from Status, Status_pieza LEFT JOIN Traslado ON tr_pieza=spi_pieza LEFT JOIN Zona ON tr_zona_recibe=zo_id LEFT JOIN Sede ON se_id=zo_sede WHERE st_id=spi_status AND spi_pieza=".$id;
$con = pg_query($conexion, $qry);
$resultado = '<div class="modal-header">
				<h4 id="exampleModalLabel" class="modal-title">Detalle de '.$_GET['nombre'].' - '.$_GET['id'].'</h4>
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
											<th>Status</th>
											<th class="text-center">Fecha inicio</th>
											<th class="text-center">Fecha final</th>
										</tr>
									</thead>
									<tbody>';
										while( $statusPieza = pg_fetch_object($con) ){
											$dateIni = new DateTime($statusPieza->fecha_ini);
											if(is_null($statusPieza->fecha_fin))
												$dateFin = "";
											else{
												$dateFin = new DateTime($statusPieza->fecha_ini);
												$dateFin = $dateFin->format("d/m/Y");
											}
											$resultado .= '<tr>
												<td class="text-center">'.$statusPieza->id.'</td>
												<td>'.$statusPieza->status.'</td>
												<td class="text-center">'.$dateIni->format("d/m/Y").'</td>
												<td class="text-center">'.$dateFin.'</td>
											</tr>';
										}
									$resultado .= '</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>';
echo $resultado;
?>
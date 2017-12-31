<?php session_start();
include 'conexion.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
$qry = "select smp_id AS id, smp_cantidad AS cantidad, pm_nombre AS pieza, pm_id As id_pieza, am_nombre||' - '||as_nombre AS nombre from S_avion_m_pieza, Modelo_pieza, Submodelo_avion, Modelo_avion WHERE smp_modelo_pieza=pm_id AND smp_submodelo_avion=as_id AND as_modelo_avion=am_id AND smp_submodelo_avion=".$_GET['id']." ORDER BY pm_nombre";
$con = pg_query($conexion, $qry);
$submodelo = pg_fetch_object($con);
$resultado = '<div class="modal-header">
			<h4 id="exampleModalLabel" class="modal-title">Piezas de '.$submodelo->nombre.'</h4>
			<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
		</div>
		<div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="card col-lg-12">
						<div class="row">
							<!-- Columna Izquierda   -->
							<div class="card-body col-lg-6">
								<div class="list-group">
								  	<a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
										<div class="d-flex w-100 justify-content-between">
										  	<h5 class="mb-1">Pieza</h5>
										  	<small>Cantidad</small>
										</div>
								  	</a>';
									$con = pg_query($conexion, $qry);
									while($submodelo = pg_fetch_object($con)){
										$resultado .= '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
											<div class="d-flex w-100 justify-content-between">
												<h5 class="mb-1">'.$submodelo->pieza.'</h5>
												<small>'.$submodelo->cantidad.' unds</small>
											</div>
										</a>';
										$qry2 = "select pm_nombre as pieza from Modelo_pieza WHERE pm_modelo_pieza=".$submodelo->id_pieza." ORDER BY pm_nombre";
										$con2 = pg_query($conexion, $qry2);
										while($submodelo2 = pg_fetch_object($con2)){
											$resultado .= '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
											<div class="d-flex w-80 justify-content-between">
												<h5 class="mb-1">&emsp;&emsp;'.$submodelo2->pieza.'</h5>
											</div>
										</a>';
										}
									}
								$resultado .= '</div>
							</div>
							<!-- Columna izquierda ENDS -->
							<!-- Columna derecha -->
							<div class=" card-body col-lg-6">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
			<a href="" class="click-submodelo-editar btn btn-primary">Editar</a>
		</div>
			<script>
			$( "a.click-submodelo-editar" ).click(function( event ) {
				event.preventDefault();
				var href = $(this).attr("href");
				$.ajax({type: "POST",dataType: "html",url:"submodeloavion-editar.php?id="+href,success: function(data){$("#editarSubmodeloBody").html(data);}});
				$("#ModalEditarSubmodelo").modal("show");
				$("#ModalEditarSubmodelo").modal("handleUpdate");
			});
			</script>';
echo $resultado;
?>
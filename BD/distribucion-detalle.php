<?php session_start();
include 'conexion.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "select di_id, di_nombre, di_numero_clases, di_capacidad_pasajeros, di_distancia_asientos, di_ancho_asientos, am_nombre AS modelo from distribucion, modelo_avion where am_id=di_modelo_avion AND di_id=".$id;
$con = pg_query($conexion, $qry);
$distribucion = pg_fetch_object($con);
$resultado = '<div class="modal-header">
				<h4 id="exampleModalLabel" class="modal-title">Detalle Distribución de Avión</h4>
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
											<h4>ID</h4> </div>
										<div class="col-lg-8">'.$distribucion->di_id.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Nombre</h4> </div>
										<div class="col-lg-8">'.$distribucion->di_nombre.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Modelo de Avión</h4> </div>
										<div class="col-lg-8">'.$distribucion->modelo.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Numero de Clases</h4> </div>
										<div class="col-lg-8">'.$distribucion->di_numero_clases.'</div>
									</div>
								</div>
								<!-- Columna izquierda ENDS -->
								<!-- Columna derecha -->
								<div class=" card-body col-lg-6">
									<div class="row">
										<div class="col-lg-4">
											<h4>Capacidad de Pasajeros</h4> </div>
										<div class="col-lg-8">'.$distribucion->di_capacidad_pasajeros.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Distancia entre Asientos</h4> </div>
										<div class="col-lg-8">'.number_format($distribucion->di_distancia_asientos, 1, ',', '.')." cm".'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Ancho de Asientos</h4> </div>
										<div class="col-lg-8">'.number_format($distribucion->di_ancho_asientos, 1, ',', '.')." cm".'</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>';
				if( in_array("di_u", $permiso) )
				$resultado.='<a href="'.$distribucion->di_id.'" class="click-distribucion-editar btn btn-primary">Editar</a>';
			$resultado.='</div>
			<script>
			$( "a.click-distribucion-editar" ).click(function( event ) {
				event.preventDefault();
				var href = $(this).attr("href");
				$.ajax({type: "POST",dataType: "html",url:"distribucion-editar.php?id="+href,success: function(data){$("#editarDistribucionBody").html(data);}});
				$("#ModalEditarDistribucion").modal("show");
				$("#ModalEditarDistribucion").modal("handleUpdate");
			});
			</script>';
echo $resultado;
?>
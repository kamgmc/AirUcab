<?php 
	include 'conexion.php';
	$qry = "SELECT * FROM Modelo_avion WHERE am_id=".$_GET['id'];
	$con = pg_query($conexion, $qry);
	$modelo = pg_fetch_object($con);
	$dias = $modelo->am_tiempo_estimado; 
	$meses = 0; 
	while($dias > 31){$meses+=1; $dias-=30;}
	$resultado = '<div class="modal-header">
						<h4 id="exampleModalLabel" class="modal-title">Detalle Modelo de Avión</h4>
						<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								<div class="card col-lg-12"><div class="row">
									<!-- Columna Izquierda   -->
									<div class="card-body col-lg-6">
										<div class="row">
											<div class="col-lg-4">
												<h4>ID</h4>
											</div>
											<div class="col-lg-8">'.$modelo->am_id.'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Nombre</h4>
											</div>
											<div class="col-lg-8">'.$modelo->am_nombre.'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Longitud</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_longitud, 2, ',', '.')." m".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Envergadura</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_envergadura, 2, ',', '.')." m".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Altura</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_altura, 1, ',', '.')." m".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Superficie Alar</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_ala_superficie, 2, ',', '.')." m<sup>2</sup>".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Flecha Alar</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_ala_flecha, 0, ',', '.')."°".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Peso Maximo de Aterrizaje</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_peso_aterrizaje_max, 0, ',', '.')." Kg".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Alcance</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_alcance, 0, ',', '.')." Km".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Velocidad Máxima</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_velocidad_max, 0, ',', '.')." Km/h (".number_format($modelo->am_velocidad_max/1234.8, 2, ',', '.').' Mach)</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Techo de Servicio</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_techo_servicio, 0, ',', '.')." m".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Regimen de Ascenso</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_regimen_ascenso, 1, ',', '.')." m/s".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Numero Pasillos</h4>
											</div>
											<div class="col-lg-8">'.$modelo->am_numero_pasillos.'</div>
										</div>
									</div>
									<!-- Columna izquierda ENDS -->
									<!-- Columna derecha -->
									<div class=" card-body col-lg-6">
										<div class="row">
											<div class="col-lg-4">
												<h4>Tipo de Fuselaje</h4>
											</div>
											<div class="col-lg-8">'.$modelo->am_fuselaje_tipo.'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Altura del Fuselaje</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_fuselaje_altura, 2, ',', '.')." m".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Ancho del Fuselaje</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_fuselaje_ancho, 2, ',', '.')." m".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Altura de la Cabina</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_cabina_altura, 2, ',', '.')." m".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Ancho de la Cabina</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_cabina_ancho, 2, ',', '.')." m".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Volumen de Carga</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_carga_volumen, 1, ',', '.')." m<sup>3</sup>".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Capacidad de Pilotos</h4>
											</div>
											<div class="col-lg-8">'.$modelo->am_capacidad_pilotos.'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Capacidad de Asistentes</h4>
											</div>
											<div class="col-lg-8">'.$modelo->am_capacidad_asistentes.'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Carrera de Despegue</h4>
											</div>
											<div class="col-lg-8">'.number_format($modelo->am_carrera_despegue, 0, ',', '.')." Km".'</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<h4>Tiempo Estimado de Fabricación</h4>
											</div>
											<div class="col-lg-8">'.$meses." meses y ".$dias." dias".'</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
					<a href="'.$modelo->am_id.'" class="click-editar btn btn-primary">Editar</a>
				</div>
				<script>
				$( "a.click-editar" ).click(function( event ) {
					event.preventDefault();
					var href = $(this).attr("href");
					$.ajax({type: "POST",dataType: "html",url:"modeloavion-editar.php?id="+href,success: function(data){$("#editarModeloBody").html(data);}});
					$("#ModalEditarModelo").modal("show");
					$("#ModalEditarModelo").modal("handleUpdate");
				});
				</script>';
echo $resultado;

?>
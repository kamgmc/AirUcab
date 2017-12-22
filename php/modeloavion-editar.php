<?php 
	include 'conexion.php';
	$qry = "SELECT * FROM Modelo_avion WHERE am_id=".$_GET['id'];
	$con = pg_query($conexion, $qry);
	$modelo = pg_fetch_object($con);
	$result ='<form action="modeloavion-crud.php?edit='.$modelo->am_id.'" method="post">
				<div class="modal-header">
					<h4 id="exampleModalLabel" class="modal-title">Editar Modelo de Avión</h4>
					<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="card col-lg-12">
								<div class="row">
									<div class="card-body col-lg-6">
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Nombre</h4> 
											</label>
											<div class="col-sm-9">
												<input name="nombre" type="text" value="'.$modelo->am_nombre.'" class="form-control" required> 
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Longitud</h4>
											</label>
											<div class="col-sm-9">
												<input name="longitud" type="text" value="'.$modelo->am_longitud.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Envergadura</h4>
											</label>
											<div class="col-sm-9">
												<input name="envergadura" type="text" value="'.$modelo->am_envergadura.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Altura</h4>
											</label>
											<div class="col-sm-9">
												<input name="altura" type="text" value="'.$modelo->am_altura.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Superficie Alar</h4>
											</label>
											<div class="col-sm-9">
												<input name="superficie_alar" type="text" value="'.$modelo->am_ala_superficie.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Flecha Alar</h4>
											</label>
											<div class="col-sm-9">
												<input name="flecha_alar" type="text" value="'.$modelo->am_ala_flecha.'" class="form-control"  pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Peso Maximo de Aterrizaje</h4>
											</label>
											<div class="col-sm-9">
												<input name="peso_max_aterrizaje" type="text" value="'.$modelo->am_peso_aterrizaje_max.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Alcance</h4>
											</label>
											<div class="col-sm-9">
												<input name="alcance" type="text" value="'.$modelo->am_alcance.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Velocidad Máxima</h4>
											</label>
											<div class="col-sm-9">
												<input name="velocidad_max" type="text" value="'.$modelo->am_velocidad_max.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Techo de Servicio</h4>
											</label>
											<div class="col-sm-9">
												<input name="techo_servicio" type="text" value="'.$modelo->am_techo_servicio.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Regimen de Ascenso</h4>
											</label>
											<div class="col-sm-9">
												<input name="regimen_ascenso" type="text" value="'.$modelo->am_regimen_ascenso.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Numero de Pasillos</h4>
											</label>
											<div class="col-sm-9">
												<input name="numero_pasillos" type="text" value="'.$modelo->am_numero_pasillos.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
									</div>
									<div class=" card-body col-lg-6">
										<div class=" form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Tipo de Fuselaje</h4> 
											</label>
											<div class="col-sm-9 select">
												<select name="tipo_fuselaje" class="form-control" required>
													<option ';
													if($modelo->am_fuselaje_tipo == "Ancho")
														$result .= 'selected';
													$result .=' value="Ancho">Ancho</option>
													<option '; 
													if($modelo->am_fuselaje_tipo == "Normal")
														$result .= 'selected';
													$result .= ' value="Normal">Normal</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Altura de la Cabina</h4>
											</label>
											<div class="col-sm-9">
												<input name="altura_cabina" type="text" value="'.$modelo->am_cabina_altura.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Ancho de la Cabina</h4>
											</label>
											<div class="col-sm-9">
												<input name="ancho_cabina" type="text" value="'.$modelo->am_cabina_ancho.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Altura del Fuselaje</h4>
											</label>
											<div class="col-sm-9">
												<input name="altura_fuselaje" type="text" value="'.$modelo->am_fuselaje_altura.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Ancho del Fuselaje</h4>
											</label>
											<div class="col-sm-9">
												<input name="ancho_fuselaje" type="text" value="'.$modelo->am_fuselaje_ancho.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Volumen de Carga</h4>
											</label>
											<div class="col-sm-9">
												<input name="volumen_carga" type="text" value="'.$modelo->am_carga_volumen.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Capacidad de Pilotos</h4>
											</label>
											<div class="col-sm-9">
												<input name="capacidad_pilotos" type="text" value="'.$modelo->am_capacidad_pilotos.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Capacidad de Asistentes de Vuelo</h4>
											</label>
											<div class="col-sm-9">
												<input name="capacidad_asistentes" type="text" value="'.$modelo->am_capacidad_asistentes.'" class="form-control" pattern="\d+\.?\d{0,2}" required> 
											</div>
										</div>

										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Carrera de Despegue</h4>
											</label>
											<div class="col-sm-9">
												<input name="carrera_despegue" type="text" value="'.$modelo->am_carrera_despegue.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Tiempo Estimado de Elaboración</h4>
											</label>
											<div class="col-sm-9">
												<input name="tiempo_estimado" type="text" value="'.$modelo->am_tiempo_estimado.'" class="form-control" pattern="\d+\.?\d{0,2}" required> 
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar Cambios</button>
				</div>
			</form>';
echo $result;
?>
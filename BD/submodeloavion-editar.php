<?php 
include 'conexion.php';
$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "SELECT as_id, as_nombre, as_peso_maximo_despegue, as_peso_vacio, as_velocidad_crucero, as_carrera_despegue_peso_maximo, as_autonomia_peso_maximo_despegue, as_modelo_avion, as_capacidad_combustible, as_alcance_carga_maxima, am_nombre AS modelo from submodelo_avion, modelo_avion where as_modelo_avion=am_id AND as_id=".$id;
$con = pg_query($conexion, $qry);
$submodelo = pg_fetch_object($con);
$result = '<form action="submodeloavion-crud.php?edit='.$submodelo->as_id.'" method="post">
				<div class="modal-header">
					<h4 id="exampleModalLabel" class="modal-title">Editar Submodelo de Avión</h4>
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
												<h4>Modelo de Avión</h4>
											</label>
											<div class="col-sm-9 select">
												<select name="modelo" class="form-control">';
												$qry = "SELECT am_id AS id, am_nombre AS nombre FROM Modelo_avion";
												$rs = pg_query( $conexion, $qry );
												while( $modelo = pg_fetch_object($rs) ){
													$result .= '<option value="'.$modelo->id.'" '; 
													if($modelo->id == $submodelo->as_modelo_avion)
														$result .= 'selected';
													$result .='>'.$modelo->nombre.'</option>';
												}
												$result .= '</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Nombre</h4>
											</label>
											<div class="col-sm-9">
												<input name="nombre" type="text" value="'.$submodelo->as_nombre.'" class="form-control" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Peso Máximo de Despegue</h4>
											</label>
											<div class="col-sm-9">
												<input name="peso_max" type="text" value="'.$submodelo->as_peso_maximo_despegue.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Peso Vacio</h4>
											</label>
											<div class="col-sm-9">
												<input name="peso_vacio" type="text" value="'.$submodelo->as_peso_vacio.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Carrera de Despegue con Peso Máximo</h4>
											</label>
											<div class="col-sm-9">
												<input name="carrera_despegue" type="text" value="'.$submodelo->as_carrera_despegue_peso_maximo.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
									</div>
									<div class=" card-body col-lg-6">
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Velocidad Crucero</h4>
											</label>
											<div class="col-sm-9">
												<input name="velocidad_crucero" type="text" value="'.$submodelo->as_velocidad_crucero.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Autonomia de Despegue con Peso Máximo</h4>
											</label>
											<div class="col-sm-9">
												<input name="autonomia" type="text" value="'.$submodelo->as_autonomia_peso_maximo_despegue.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Capacidad de Combustible</h4>
											</label>
											<div class="col-sm-9">
												<input name="capacidad_combustible" type="text" value="'.$submodelo->as_capacidad_combustible.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Alcance con Carga Maxima</h4>
											</label>
											<div class="col-sm-9">
												<input name="alcance" type="text" value="'.$submodelo->as_alcance_carga_maxima.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
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
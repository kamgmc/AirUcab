<?php 
include 'conexion.php';
$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "select di_id, di_nombre, di_numero_clases, di_capacidad_pasajeros, di_distancia_asientos, di_ancho_asientos, di_modelo_avion from distribucion where di_id=".$id;
$con = pg_query($conexion, $qry);
$distribucion = pg_fetch_object($con);
$result = '<form action="distribucion-crud.php?edit='.$distribucion->di_id.'" method="post">
				<div class="modal-header">
					<h4 id="exampleModalLabel" class="modal-title">Editar Distribución de Avión</h4>
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
													if($modelo->id == $distribucion->di_modelo_avion)
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
												<input name="nombre" type="text" value="'.$distribucion->di_nombre.'" class="form-control" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Capacidad de Pasajeros</h4>
											</label>
											<div class="col-sm-9">
												<input name="capacidad_pasajeros" type="text" value="'.$distribucion->di_capacidad_pasajeros.'" class="form-control" pattern="\d+" required>
											</div>
										</div>
									</div>
									<div class=" card-body col-lg-6">
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Numero de Clases</h4>
											</label>
											<div class="col-sm-9">
												<input name="numero_clases" type="text" value="'.$distribucion->di_numero_clases.'" class="form-control" pattern="\d+" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Distancia entre Asientos</h4>
											</label>
											<div class="col-sm-9">
												<input name="distancia_asientos" type="text" value="'.$distribucion->di_distancia_asientos.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Acho de Asientos</h4>
											</label>
											<div class="col-sm-9">
												<input name="ancho_asientos" type="text" value="'.$distribucion->di_ancho_asientos.'" class="form-control" pattern="\d+\.?\d{0,2}" required>
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
<?php include 'conexion.php';
$qry = "SELECT sr_id id, sr_nombre nombre FROM Rol_sistema WHERE sr_id=".$_GET['id'];
$con = pg_query($conexion, $qry);
$rol = pg_fetch_object($con);
$resultado = '<form action="rol-crud.php?edit='.$rol->id.'" method="post">
					<div class="modal-header">
						<h4 id="exampleModalLabel" class="modal-title">Editar Rol</h4>
						<button type="button" data-dismiss="modal" aria-label="Close" class="close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group row">
							<label class="col-sm-3 form-control-label">
								<h4>Nombre</h4>
							</label>
							<div class="col-sm-9">
								<input name="nombre" type="text" value="'.$rol->nombre.'" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
						<button type="submit" class="btn btn-primary">Guardar Cambios</button>
					</div>
				</form>';
echo $resultado;
?>
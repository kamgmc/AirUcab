<?php include 'conexion.php';
$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "SELECT er_id id, er_nombre nombre FROM Cargo WHERE er_id=".$id;
$con = pg_query($conexion, $qry);
$cargo = pg_fetch_object($con);
$resultado = '<form action="cargo-crud.php?edit='.$cargo->id.'" method="post">
					<div class="modal-header">
						<h4 id="exampleModalLabel" class="modal-title">Editar Cargo</h4>
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
								<input name="nombre" type="text" value="'.$cargo->nombre.'" class="form-control" pattern="[A-Z a-zñ]+" required>
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
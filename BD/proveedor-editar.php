<?php include 'conexion.php';
$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "SELECT po_id AS id, po_nombre AS nombre, po_tipo_rif AS tipo_rif, po_rif AS rif, po_pagina_web AS web, pa.lu_id AS parroquia, mu.lu_id AS municipio, es.lu_id AS estado FROM Proveedor LEFT JOIN Lugar pa ON pa.lu_id=po_direccion LEFT JOIN Lugar mu ON mu.lu_id=pa.lu_lugar LEFT JOIN Lugar es ON es.lu_id=mu.lu_lugar WHERE po_id=".$id;
$con = pg_query($conexion, $qry);
$proveedor = pg_fetch_object($con);
$result = '<form action="cliente-crud?edit='.$proveedor->id.'" method="post">
				<div class="modal-header">
					<h4 id="exampleModalLabel" class="modal-title">Editar Cliente</h4>
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
												<input name="nombre" type="text" placeholder="Introduzca Nombre" class="form-control" pattern="[A-Za-zñ0-9 .,]+" value="'.$proveedor->nombre.'" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Estado</h4>
											</label>
											<div class="col-sm-9 select">
												<select id="list-estados-u" name="estado" class="form-control" required>';
													$qry = "SELECT lu_id id, lu_nombre nombre FROM Lugar WHERE lu_tipo='Estado' ORDER BY lu_nombre";
													$rs = pg_query( $conexion, $qry );
													while( $estado = pg_fetch_object($rs) ){
														$result .= '<option value="'.$estado->id.'" '; 
														if($estado->id == $proveedor->estado) 
															$result .= 'selected'; 
														$result .= '>'.$estado->nombre.'</option>';
													}
												$result .= '</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Municipio</h4>
											</label>
											<div class="col-sm-9 select">
												<select id="list-municipios-u" name="municipio" class="form-control" required>';
													$qry = "SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar WHERE lu_lugar=".$proveedor->estado." AND lu_tipo='Municipio' ORDER BY lu_nombre";
													$rs = pg_query( $conexion, $qry );
													while( $municipio = pg_fetch_object($rs) ){
														$result .= '<option value="'.$municipio->id.'" '; 
														if($municipio->id == $proveedor->municipio) 
															$result .= 'selected'; 
														$result .= '>'.$municipio->nombre.'</option>';
													}
												$result .= '</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Parroquia</h4>
											</label>
											<div class="col-sm-9 select">
												<select id="list-parroquias-u" name="parroquia" class="form-control" required>';
													$qry = "SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar WHERE lu_lugar=".$proveedor->municipio." AND lu_tipo='Parroquia' ORDER BY lu_nombre";
													$rs = pg_query( $conexion, $qry );
													while( $parroquia = pg_fetch_object($rs) ){
														$result .= '<option value="'.$parroquia->id.'" '; 
														if($parroquia->id == $proveedor->parroquia) 
															$result .= 'selected'; 
														$result .= '>'.$parroquia->nombre.'</option>';
													}
												$result .= '</select>
											</div>
										</div>
									</div>
									<div class=" card-body col-lg-6">
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>CI / RIF</h4> 
											</label>
											<div class="col-sm-3 select">
												<select name="tipo_rif" class="form-control" required>
													<option value="J" ';if($proveedor->tipo_rif == 'J') $result .= 'selected';$result .= '>J</option>
													<option value="G" ';if($proveedor->tipo_rif == 'G') $result .= 'selected';$result .= '>G</option>
													<option value="V" ';if($proveedor->tipo_rif == 'V') $result .= 'selected';$result .= '>V</option>
													<option value="E" ';if($proveedor->tipo_rif == 'E') $result .= 'selected';$result .= '>E</option>
												</select>
											</div>
											<div class="col-sm-6">
												<input name="rif" type="text" placeholder="Introduzca Rif" class="form-control" pattern="\d+" value="'.$proveedor->rif.'" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Página Web</h4>
											</label>
											<div class="col-sm-9">
												<input name="web" type="text" placeholder="Introduzca Pagina Web" class="form-control" value="'.$proveedor->web.'" pattern="[A-Za-z.-]+">
											</div>
										</div>';
										$qry = "SELECT Count(*) AS total FROM Contacto WHERE co_proveedor=".$proveedor->id;
										$rs = pg_query( $conexion, $qry );
										$total = pg_fetch_object($rs); $i = 1;
										$result .= '<div class="form-group row ';
											if($total->total == 0) $result .= 'last-contacto-u';
											$result .='">
											<label class="col-sm-12 form-control-label">
												<h4>Contacto</h4> 
											</label>
										</div>';
										$qry = "SELECT co_id AS id, co_tipo AS tipo, co_valor AS valor FROM Contacto WHERE co_proveedor=".$proveedor->id." ORDER BY co_id";
										$rs = pg_query( $conexion, $qry );
										while( $contacto = pg_fetch_object($rs) ){
											$result.= '<div class="form-group row ';
											if($i == $total->total) $result .= 'last-contacto-u';
											$result .='">
												<div class="col-sm-3 text-right"><i data-id="'.$contacto->id.'" class="fa fa-times delete-contacto" aria-hidden="true"></i></div>
												<div class="col-sm-3 select">
													<select name="tipo_contacto_update[]" class="form-control" required>';
														$qre = "SELECT ct_id id, ct_nombre nombre FROM Tipo_contacto ORDER BY ct_nombre";
														$rse = pg_query( $conexion, $qre );
														while( $tipo_contacto = pg_fetch_object($rse) ){
															$result.= '<option value="'.$tipo_contacto->id.'" ';
															if($tipo_contacto->id == $contacto->tipo) $result.= 'selected';
															$result.= '>'.$tipo_contacto->nombre.'</option>';
														}
													$result.= '</select>
												</div>
												<div class="col-sm-6">
													<input name="contacto_update[]" pattern="[A-Z a-zñ0-9.@\-_]+" type="text" value="'.$contacto->valor.'" class="form-control" required>
												</div>
												<input name="contacto_update_id[]" type="hidden" value="'.$contacto->id.'"/>
											</div>';
											$i++;
										}
										$result.= '
										<div class="form-group row">
											<div class="col-sm-12 text-right">
												<i id="add-contacto-u" class="fa fa-plus"></i>&emsp;
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
			</form>
			<script>
				$("#list-estados-u").change(function () {
					var iden = $("#list-estados-u option:selected").val();
					$("#list-municipios-u").removeAttr("disabled");
					$("#list-parroquias-u").empty();
					$.ajax({
						type: "POST"
						, dataType: "html"
						, url: "getter.php?get=municipios&id=" + iden
						, success: function (data) {
							$("#list-municipios-u").html(data);
						}
					});
				});
				$("#list-municipios-u").change(function () {
					var iden = $("#list-municipios-u option:selected").val();
					$("#list-parroquias-u").removeAttr("disabled");
					$.ajax({
						type: "POST"
						, dataType: "html"
						, url: "getter.php?get=parroquias&id=" + iden
						, success: function (data) {
							$("#list-parroquias-u").html(data);
						}
					});
				});
				$("#add-contacto-u").click(function(){
					var $last = $(".last-contacto-u");
					$last.removeClass("last-contacto-u");
					$.ajax({
						type: "POST",
						dataType: "html",
						url:"getter.php?get=fieldContactoU",
						success: function(data){
							$last.after(data);
						}
					});
				});
				$(".delete-contacto").click(function(){
					if(!$(this).hasClass("new")){
						var $id = $(this).data("id");
						var $row = $(this).closest(".row");
						$row.empty();
						$row.removeClass("row");
						$.ajax({
							type: "POST",
							dataType: "html",
							url:"getter.php?get=fieldContactoDelete&id="+$id,
							success: function(data){
								$row.html(data);
							}
						});
					}
				});
			</script>';
echo $result;
?>
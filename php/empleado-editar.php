<?php 
include 'conexion.php';
$qry = "SELECT em_id id,em_nombre nombre, em_apellido apellido, em_nacionalidad nac, em_ci ci, em_usuario usuario, em_titulacion titulacion, em_rol rol, em_cargo cargo, se.se_id sede, em_zona zona, pa.lu_id parroquia, mu.lu_id municipio, es.lu_id estado, em_nota nota, em_supervisa zona_s, em_gerencia sede_g FROM Empleado LEFT JOIN Zona zo ON em_zona=zo.zo_id LEFT JOIN Sede se on zo.zo_sede=se.se_id LEFT JOIN Cargo ON er_id=em_cargo LEFT JOIN Lugar pa ON pa.lu_id=em_direccion LEFT JOIN Lugar mu ON mu.lu_id=pa.lu_lugar LEFT JOIN Lugar es ON es.lu_id=mu.lu_lugar WHERE em_id=".$_GET['id']." ORDER BY em_id";
$con = pg_query($conexion, $qry);
$empleado = pg_fetch_object($con);
$result = '<form action="empleado-crud?edit='.$empleado->id.'" method="post">
				<div class="modal-header">
					<h4 id="exampleModalLabel" class="modal-title">Editar Empleado</h4>
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
												<input name="nombre" type="text" value="'.$empleado->nombre.'" class="form-control" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Apellido</h4>
											</label>
											<div class="col-sm-9">
												<input name="apellido" type="text" value="'.$empleado->apellido.'" class="form-control" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>CI</h4> 
											</label>
											<div class="col-sm-2 select">
												<select name="nacionalidad" class="form-control" required>
													<option value="V" ';if($empleado->nac == 'V') $result .= 'selected';$result .= '>V</option>
													<option value="E" ';if($empleado->nac == 'E') $result .= 'selected';$result .= '>E</option>
													<option value="P" ';if($empleado->nac == 'P') $result .= 'selected';$result .= '>P</option>
												</select>
											</div>
											<div class="col-sm-7">
												<input name="ci" type="text" value="'.$empleado->ci.'" class="form-control" pattern="\d+">
												<span class="help-block-none">
													<small>Introduzca unicamente el número.</small>
												</span> 
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Usario</h4>
											</label>
											<div class="col-sm-9">
												<input name="usuario" type="text" value="'.strtolower($empleado->usuario).'" class="form-control" required>
												<span class="help-block-none"><small>El nombre de usuario debe ser unico.</small></span> 
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Titulación</h4>
											</label>
											<div class="col-sm-9 select">
												<select name="titulacion" class="form-control" required>';
													$qry = "SELECT ti_id id, ti_nombre nombre FROM Titulacion ORDER BY ti_nombre";
													$rs = pg_query( $conexion, $qry );
													while( $titulacion = pg_fetch_object($rs) ){
														$result .= '<option value="'.$titulacion->id.'" '; 
														if($titulacion->id == $empleado->titulacion) 
															$result .= 'selected'; 
														$result .= '>'.$titulacion->nombre.'</option>';
													}
												$result .= '</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Cargo</h4>
											</label>
											<div class="col-sm-9 select">
												<select name="cargo" class="form-control" required>';
													$qry = "SELECT er_id id, er_nombre nombre FROM Cargo ORDER BY er_nombre";
													$rs = pg_query( $conexion, $qry );
													while( $cargo = pg_fetch_object($rs) ){
														$result .= '<option value="'.$cargo->id.'" '; 
														if($cargo->id == $empleado->cargo) 
															$result .= 'selected'; 
														$result .= '>'.$cargo->nombre.'</option>';
													}
												$result .= '</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Rol</h4>
											</label>
											<div class="col-sm-9 select">
												<select name="rol" class="form-control" required>';
													$qry = "SELECT sr_id id, sr_nombre nombre FROM Rol_sistema WHERE sr_nombre<>'Usuario Anónimo' ORDER BY sr_nombre";
													$rs = pg_query( $conexion, $qry );
													while( $rol = pg_fetch_object($rs) ){
														$result .= '<option value="'.$rol->id.'" '; 
														if($rol->id == $empleado->rol) 
															$result .= 'selected'; 
														$result .= '>'.$rol->nombre.'</option>';
													}
												$result .= '</select>
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
														if($estado->id == $empleado->estado) 
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
													$qry = "SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar WHERE lu_lugar=".$empleado->estado." AND lu_tipo='Municipio' ORDER BY lu_nombre";
													$rs = pg_query( $conexion, $qry );
													while( $municipio = pg_fetch_object($rs) ){
														$result .= '<option value="'.$municipio->id.'" '; 
														if($municipio->id == $empleado->municipio) 
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
													$qry = "SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar WHERE lu_lugar=".$empleado->municipio." AND lu_tipo='Parroquia' ORDER BY lu_nombre";
													$rs = pg_query( $conexion, $qry );
													while( $parroquia = pg_fetch_object($rs) ){
														$result .= '<option value="'.$parroquia->id.'" '; 
														if($parroquia->id == $empleado->parroquia) 
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
												<h4>Sede</h4>
											</label>
											<div class="col-sm-9 select">
												<select id="list-sedes-u" name="sede" class="form-control" required>';
													$qry = "SELECT se_id AS id, se_nombre AS nombre FROM Sede ORDER BY se_nombre";
													$rs = pg_query( $conexion, $qry );
													while( $sede = pg_fetch_object($rs) ){
														$result .= '<option value="'.$sede->id.'" '; 
														if($sede->id == $empleado->sede) 
															$result .= 'selected'; 
														$result .= '>'.$sede->nombre.'</option>';
													}
												$result .= '</select>
											</div>
											<div class="col-sm-3"></div>
											<div class="form-check col-sm-9">
												<label class="form-check-label">
													<input id="check-gerente-u" name="gerencia" type="checkbox" class="form-check-input" ';
													if($empleado->sede_g == 't') $result .= 'checked';
													if($empleado->zona_s == 't') $result .= ' disabled';
													$result.= '>
													Es gerente de esta sede
												</label>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 form-control-label">
												<h4>Zona</h4>
											</label>
											<div class="col-sm-9 select">
												<select id="list-zonas-u" name="zona" class="form-control" required>';
													$qry = "SELECT zo_id AS id, zo_nombre AS nombre FROM Zona WHERE zo_sede=".$empleado->sede." ORDER BY zo_nombre";
													$rs = pg_query( $conexion, $qry );
													while( $zona = pg_fetch_object($rs) ){
														$result .= '<option value="'.$zona->id.'" '; 
														if($zona->id == $empleado->zona) 
															$result .= 'selected'; 
														$result .= '>'.$zona->nombre.'</option>';
													}
												$result .= '</select>
											</div>
											<div class="col-sm-3"></div>
											<div class="form-check col-sm-9">
												<label class="form-check-label">
													<input id="check-supervisor-u" name="supervisa" type="checkbox" class="form-check-input" ';
													if($empleado->zona_s == 't') $result .= 'checked';
													if($empleado->sede_g == 't') $result .= ' disabled';
													$result.= '>
													Es supervisor de esta zona
												</label>
											</div>
										</div>';
										$qry = "SELECT Count(*) AS total FROM Contacto WHERE co_empleado=".$empleado->id;
										$rs = pg_query( $conexion, $qry );
										$total = pg_fetch_object($rs); $i = 1;
										$result .= '<div class="form-group row ';
											if($total->total == 0) $result .= 'last-contacto-u';
											$result .='">
											<label class="col-sm-12 form-control-label">
												<h4>Contacto</h4> 
											</label>
										</div>';
										$qry = "SELECT co_id AS id, co_tipo AS tipo, co_valor AS valor FROM Contacto WHERE co_empleado=".$empleado->id." ORDER BY co_id";
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
													<input name="contacto_update[]" type="text" value="'.$contacto->valor.'" class="form-control" required>
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
										</div>';
										$qry = "SELECT Count(*) AS total FROM Beneficiario WHERE be_empleado=".$empleado->id;
										$rs = pg_query( $conexion, $qry );
										$total = pg_fetch_object($rs); $i = 1;
										$result .= '<div class="form-group row ';
											if($total->total == 0) $result .= 'last-beneficiario-u';
											$result .='">
											<label class="col-sm-3 form-control-label">
												<h4>Beneficiarios</h4> 
											</label>
										</div>';
										$qry = "SELECT be_id id, be_nacionalidad nac, be_ci ci, be_nombre nombre, be_apellido apellido FROM Beneficiario WHERE be_empleado=".$empleado->id." ORDER BY be_id";
										$rs = pg_query( $conexion, $qry );
										while( $beneficiario = pg_fetch_object($rs) ){
											$result.= '<div class="form-group row ';
											if($i == $total->total) $result .= 'last-beneficiario-u';
												$result .='">
												<div class="col-sm-3 text-right"><i data-id="'.$beneficiario->id.'" class="fa fa-times delete-beneficiario" aria-hidden="true"></i></div>
												<div class="col-sm-9">
													<input name="nombre_beneficiario_update[]" type="text" value="'.$beneficiario->nombre.'" class="form-control" required>
												</div>
												<div class="col-sm-3"></div>
												<div class="col-sm-9">
													<input name="apellido_beneficiario_update[]" type="text" value="'.$beneficiario->apellido.'" class="form-control" required>
												</div>
												<div class="col-sm-3"></div>
												<div class="col-sm-2 select">
													<select name="nacionalidad_beneficiario_update[]" class="form-control" required>
														<option value="V" ';if($beneficiario->nac == 'V') $result .= 'selected';$result .= '>V</option>
														<option value="E" ';if($beneficiario->nac == 'E') $result .= 'selected';$result .= '>E</option>
														<option value="P" ';if($beneficiario->nac == 'P') $result .= 'selected';$result .= '>P</option>
													</select>
												</div>
												<div class="col-sm-7">
													<input name="ci_beneficiario_update[]" type="text" value="'.$beneficiario->ci.'" class="form-control" pattern="\d+" required>
													<span class="help-block-none">
														<small>Introduzca unicamente el número.</small>
													</span> 
												</div>
												<input name="id_beneficiario_update[]" type="hidden" value="'.$beneficiario->id.'"/>
											</div>';
											$i++;
										}
										$result.= '
										<div class="form-group row">
											<div class="col-sm-12 text-right">
												<i id="add-beneficiario-u" class="fa fa-plus"></i>&emsp;
											</div>
										</div>';
										$qry = "SELECT Count(*) AS total FROM Experiencia WHERE ex_empleado=".$empleado->id;
										$rs = pg_query( $conexion, $qry );
										$total = pg_fetch_object($rs); $i = 1;
										$result .= '<div class="form-group row ';
											if($total->total == 0) $result .= 'last-experiencia-u';
											$result .='">
											<label class="col-sm-3 form-control-label">
												<h4>Experiencia</h4>
											</label>
										</div>';
										$qry = "SELECT ex_id id, ex_descripcion, ex_years FROM Experiencia WHERE ex_empleado=".$empleado->id." ORDER BY ex_id";
										$rs = pg_query( $conexion, $qry );
										while( $experiencia = pg_fetch_object($rs) ){
											$result.= '<div class="form-group row ';
											if($i == $total->total) $result .= 'last-experiencia-u';
												$result .='">
											<div class="col-sm-3 text-right"><i data-id="'.$experiencia->id.'" class="fa fa-times delete-experiencia" aria-hidden="true"></i></div>
											<div class="col-sm-7">
												<input name="experiencia_desc_update[]" type="text" value="'.$experiencia->ex_descripcion.'" class="form-control" required> 
											</div>
											<div class="col-md-2">
												<input name="experiencia_year_update[]" type="text" value="'.$experiencia->ex_years.'" class="form-control" pattern="\d{0,2}\.?\d{0,1}" required> 
											</div>
											<input name="experiencia_id_update[]" type="hidden" value="'.$experiencia->id.'"/>
										</div>';
											$i++;
										}
										$result.= '
										<div class="form-group row">
											<div class="col-sm-12 text-right">
												<i id="add-experiencia-u" class="fa fa-plus"></i>&emsp;
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
				$("#list-sedes-u").change(function () {
					var href = $("#list-sedes-u option:selected").val();
					$("#list-zonas-u").removeAttr("disabled");
					$.ajax({
						type: "POST"
						, dataType: "html"
						, url: "getter.php?get=zonas&id=" + href
						, success: function (data) {
							$("#list-zonas-u").html(data);
						}
					});
				});
				$("#list-estados-u").change(function () {
					var iden = $("#list-estados-u option:selected").val();
					$("#list-municipios-u").removeAttr("disabled");
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
				$("#add-beneficiario-u").click(function(){
					var $last = $(".last-beneficiario-u");
					$last.removeClass("last-beneficiario-u");
					$.ajax({
						type: "POST",
						dataType: "html",
						url:"getter.php?get=fieldBeneficiarioU",
						success: function(data){
							$last.after(data);
						}
					});
				});
				$("#add-experiencia-u").click(function(){
					var $last = $(".last-experiencia-u");
					$last.removeClass("last-experiencia-u");
					$.ajax({
						type: "POST",
						dataType: "html",
						url:"getter.php?get=fieldExperienciaU",
						success: function(data){
							$last.after(data);
						}
					});
				});
				$("#check-gerente-u").click(function(){
					if($("#check-gerente-u").is(":checked"))
						$("#check-supervisor-u").prop("disabled", true);
					else
						$("#check-supervisor-u").prop("disabled", false);
				});
				$("#check-supervisor-u").click(function(){
					if($("#check-supervisor-u").is(":checked"))
						$("#check-gerente-u").prop("disabled", true);
					else
						$("#check-gerente-u").prop("disabled", false);
				});
				$(".delete-contacto").click(function(){
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
				});
				$(".delete-beneficiario").click(function(){
					var $id = $(this).data("id");
					var $row = $(this).closest(".row");
					$row.empty();
					$row.removeClass("row");
					$.ajax({
						type: "POST",
						dataType: "html",
						url:"getter.php?get=fieldBeneficiarioDelete&id="+$id,
						success: function(data){
							$row.html(data);
						}
					});
				});
				$(".delete-experiencia").click(function(){
					var $id = $(this).data("id");
					var $row = $(this).closest(".row");
					$row.empty();
					$row.removeClass("row");
					$.ajax({
						type: "POST",
						dataType: "html",
						url:"getter.php?get=fieldExperienciaDelete&id="+$id,
						success: function(data){
							$row.html(data);
						}
					});
				});
			</script>';
echo $result;
?>
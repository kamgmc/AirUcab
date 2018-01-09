<?php include 'conexion.php';
	if($_GET['get'] == "municipios"){
		$id = htmlentities($_GET['id'], ENT_QUOTES);
		$qry = "SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar WHERE lu_lugar=".$id." AND lu_tipo='Municipio' ORDER BY lu_nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		while( $municipio = pg_fetch_object($answer) ){
			$resultado.="<option value='".$municipio->id."'>".$municipio->nombre."</option>";
		}
	}
	if($_GET['get'] == "parroquias"){
		$id = htmlentities($_GET['id'], ENT_QUOTES);
		$qry = "SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar WHERE lu_lugar=".$id." AND lu_tipo='Parroquia' ORDER BY lu_nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		while( $parroquia = pg_fetch_object($answer) ){
			$resultado.="<option value='".$parroquia->id."'>".$parroquia->nombre."</option>";
		}
	}
	if($_GET['get'] == "submodelos"){
		$id = htmlentities($_GET['id'], ENT_QUOTES);
		$qry = "SELECT as_id AS id, as_nombre AS nombre FROM Submodelo_avion WHERE as_modelo_avion=".$id." ORDER BY as_nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		while( $parroquia = pg_fetch_object($answer) ){
			$resultado.="<option value='".$parroquia->id."'>".$parroquia->nombre."</option>";
		}
	}
	if($_GET['get'] == "submodelosLimited"){
		$id = htmlentities($_GET['id'], ENT_QUOTES);
		$qry = "SELECT as_id AS id, as_nombre AS nombre FROM Submodelo_avion sa WHERE (Select COUNT(*) From S_avion_m_motor Where smt_submodelo_avion=sa.as_id)>0 AND (Select COUNT(*) From S_avion_m_pieza Where smp_submodelo_avion=sa.as_id)>0 AND as_modelo_avion=".$id." ORDER BY as_nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		while( $parroquia = pg_fetch_object($answer) ){
			$resultado.="<option value='".$parroquia->id."'>".$parroquia->nombre."</option>";
		}
	}
	if($_GET['get'] == "distribuciones"){
		$id = htmlentities($_GET['id'], ENT_QUOTES);
		$qry = "SELECT di_id AS id, di_nombre AS nombre FROM Distribucion WHERE di_modelo_avion=".$id." ORDER BY di_nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		while( $parroquia = pg_fetch_object($answer) ){
			$resultado.="<option value='".$parroquia->id."'>".$parroquia->nombre."</option>";
		}
	}
	if($_GET['get'] == "zonas"){
		$id = htmlentities($_GET['id'], ENT_QUOTES);
		$qry = "SELECT zo_id AS id, zo_nombre AS nombre FROM Zona WHERE zo_sede=".$id." ORDER BY zo_nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		while( $zona = pg_fetch_object($answer) ){
			$resultado.="<option value='".$zona->id."'>".$zona->nombre."</option>";
		}
	}
	if($_GET['get'] == "fieldContacto"){
		$resultado = '<div class="form-group row last-contacto">
			<div class="col-sm-3 text-right"></div>
			<div class="col-sm-3 select">
				<select name="tipo_contacto[]" class="form-control">
					<option value="NULL">Seleccionar</option>';
					$qry = "SELECT ct_id id, ct_nombre nombre FROM Tipo_contacto ORDER BY ct_nombre";
					$rs = pg_query( $conexion, $qry );
					while( $tipo_contacto = pg_fetch_object($rs) ){
						$resultado.='<option value="'.$tipo_contacto->id.'">'.$tipo_contacto->nombre.'</option>';
					}
				$resultado.='</select>
			</div>
			<div class="col-sm-6">
				<input name="contacto[]" type="text" placeholder="Introduzca Contacto" class="form-control" pattern="[A-Z a-zñ0-9.@\-_]+">
			</div>
		</div>';
	}
	if($_GET['get'] == "fieldContactoU"){
		$resultado = '<div class="form-group row last-contacto-u">
			<div class="col-sm-3 text-right"></div>
			<div class="col-sm-3 select">
				<select name="tipo_contacto[]" class="form-control">
					<option value="NULL">Seleccionar</option>';
					$qry = "SELECT ct_id id, ct_nombre nombre FROM Tipo_contacto ORDER BY ct_nombre";
					$rs = pg_query( $conexion, $qry );
					while( $tipo_contacto = pg_fetch_object($rs) ){
						$resultado.='<option value="'.$tipo_contacto->id.'">'.$tipo_contacto->nombre.'</option>';
					}
				$resultado.='</select>
			</div>
			<div class="col-sm-6">
				<input name="contacto[]" type="text" placeholder="Introduzca Contacto" class="form-control" pattern="[A-Z a-zñ0-9.@\-_]+">
			</div>
		</div>';
	}
	if($_GET['get'] == "fieldContactoDelete"){
		$id = $_GET['id'];
		$resultado = '<input name="contacto_delete[]" type="hidden" value="'.$id.'" class="form-control" required>';
	}
	if($_GET['get'] == "fieldBeneficiario"){
		$resultado = '<div class="form-group row last-beneficiario">
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
				<input name="nombre_beneficiario[]" type="text" placeholder="Introduzca Nombre" class="form-control" pattern="[A-Z a-zñ]+" required>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
				<input name="apellido_beneficiario[]" type="text" placeholder="Introduzca Apellido" class="form-control" pattern="[A-Z a-zñ]+" required>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-2 select">
				<select name="nacionalidad_beneficiario[]" class="form-control" required>
					<option value="V">V</option>
					<option value="E">E</option>
					<option value="P">P</option>
				</select>
			</div>
			<div class="col-sm-7">
				<input name="ci_beneficiario[]" type="text" placeholder="Introduzca CI" class="form-control" pattern="\d+" required>
				<span class="help-block-none">
					<small>Introduzca unicamente el número.</small>
				</span> 
			</div>
		</div>';
	}
	if($_GET['get'] == "fieldBeneficiarioU"){
		$resultado = '<div class="form-group row last-beneficiario-u">
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
				<input name="nombre_beneficiario[]" type="text" placeholder="Introduzca Nombre" class="form-control" pattern="[A-Z a-zñ]+" required>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
				<input name="apellido_beneficiario[]" type="text" placeholder="Introduzca Apellido" class="form-control" pattern="[A-Z a-zñ]+" required>
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-2 select">
				<select name="nacionalidad_beneficiario[]" class="form-control" required>
					<option value="V">V</option>
					<option value="E">E</option>
					<option value="P">P</option>
				</select>
			</div>
			<div class="col-sm-7">
				<input name="ci_beneficiario[]" type="text" placeholder="Introduzca CI" class="form-control" pattern="\d+" required>
				<span class="help-block-none">
					<small>Introduzca unicamente el número.</small>
				</span> 
			</div>
		</div>';
	}
	if($_GET['get'] == "fieldBeneficiarioDelete"){
		$id = htmlentities($_GET['id'], ENT_QUOTES);
		$resultado = '<input name="beneficiario_delete[]" type="hidden" value="'.$id.'" class="form-control" required>';
	}
	if($_GET['get'] == "fieldExperiencia"){
		$resultado = '<div class="form-group row last-experiencia">
			<div class="col-sm-3"></div>
			<div class="col-sm-7">
				<input name="experiencia_desc[]" type="text" placeholder="Descripción de Experiencia" class="form-control" pattern="[A-Z a-zñ]+" required> 
			</div>
			<div class="col-md-2">
				<input name="experiencia_year[]" type="text" placeholder="Años" class="form-control" pattern="\d{0,2}\.?\d{0,1}" required> 
			</div>
		</div>';
	}
	if($_GET['get'] == "fieldExperienciaU"){
		$resultado = '<div class="form-group row last-experiencia-u">
			<div class="col-sm-3"></div>
			<div class="col-sm-7">
				<input name="experiencia_desc[]" type="text" placeholder="Descripción de Experiencia" class="form-control" pattern="[A-Z a-zñ]+" required> 
			</div>
			<div class="col-md-2">
				<input name="experiencia_year[]" type="text" placeholder="Años" class="form-control" pattern="\d{0,2}\.?\d{0,1}" required> 
			</div>
		</div>';
	}
	if($_GET['get'] == "fieldExperienciaDelete"){
		$id = $_GET['id'];
		$resultado = '<input name="experiencia_delete[]" type="hidden" value="'.$id.'" class="form-control" required>';
	}
	if($_GET['get'] == "fieldAvion"){
		$resultado = '<hr/><div class="row form-avion last-avion">
			<div class="card-body col-lg-6">
				<div class="form-group row">
					<label class="col-sm-3 form-control-label">
						<h4>Modelo de Avión</h4>
					</label>
					<div class="col-sm-9 select">
						<select name="modelo_avion[]" class="form-control lista_modelos" required>
							<option value="NULL">Seleccionar</option>';
							$qry = "SELECT am_id id, am_nombre nombre FROM Modelo_avion ma WHERE (SELECT Count(*) from Distribucion WHERE di_modelo_avion=ma.am_id) > 0 AND (SELECT Count(*) from Submodelo_avion WHERE as_modelo_avion=ma.am_id) > 0";
							$rs = pg_query( $conexion, $qry );
							while( $avion = pg_fetch_object($rs) )
								$resultado .= '<option value="'.$avion->id.'">'.$avion->nombre.'</option>';

						$resultado .= '</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 form-control-label">
						<h4>Submodelo de Avión</h4>
					</label>
					<div class="col-sm-9 select">
						<select name="submodelo[]" class="form-control lista_submodelos" disabled required>
						</select> 
						<span class="help-block-none">
							<small>Seleccionar Modelo Avion primero.</small>
						</span> 
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 form-control-label">
						<h4>Cantidad</h4>
					</label>
					<div class="col-sm-9">
						<input name="cantidad[]" type="text" placeholder="Introduzca Cantidad" class="form-control" pattern="\d+" required>
					</div>
				</div>
			</div>
			<div class=" card-body col-lg-6 right-side">
				<div class="form-group row">
					<label class="col-sm-3 form-control-label">
						<h4>Precio</h4>
					</label>
					<div class="col-sm-9">
						<input name="precio[]" type="text" placeholder="Introduzca precio del Avion" class="form-control" pattern="([0-9]+\.[0-9]+)|([0-9]+)" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 form-control-label">
						<h4>Distribución</h4>
					</label>
					<div class="col-sm-9 select">
						<select name="distribucion[]" class="form-control lista_distribuciones" disabled required>
						</select> 
						<span class="help-block-none">
							<small>Seleccionar Modelo Avion primero.</small>
						</span> 
					</div>
				</div>
			</div>
		</div>';
	}
	if($_GET['get'] == "motorField"){
		$id = htmlentities($_GET['id'], ENT_QUOTES);
		$num = htmlentities($_GET['num'], ENT_QUOTES);
		$num--;
		$qry = "SELECT as_cantidad_motor AS cantidad FROM Submodelo_avion WHERE as_id=".$id;
		$answer = pg_query( $conexion, $qry );
		$submodelo = pg_fetch_object($answer);
		$resultado = "";
		for($k = 1; $k <= $submodelo->cantidad; $k++){
			$resultado .= '<div class="form-group row motorField">
							<label class="col-sm-3 form-control-label">
								<h4>Motor #'.$k.'</h4>
							</label>
							<div class="col-sm-9 select">
								<select name="motor'.$num.'[]" class="form-control" required>
									<option value="NULL">Seleccionar</option>';
									$qry = "Select mm_id AS id, mb_nombre||' - '||mm_nombre AS nombre from S_avion_m_motor, Modelo_motor, Marca_motor WHERE mm_id=smt_modelo_motor AND mm_marca=mb_id AND smt_submodelo_avion=".$id." ORDER BY nombre";
									$rs = pg_query( $conexion, $qry );
									while( $motor = pg_fetch_object($rs) )
										$resultado .= '<option value="'.$motor->id.'">'.$motor->nombre.'</option>';
								$resultado .= '</select> 
								<span class="help-block-none">
									<small>Seleccionar Submodelo de Avión primero.</small>
								</span> 
							</div>
						</div>';
		}
	}
	if($_GET['get'] == "fieldPago"){
		$resultado = '<hr/><div class="row last-pago">
			<div class="card-body col-lg-12">
				<div class="form-check form-check-inline">
					<label class="form-check-label">
						<input class="form-check-input transferencia" name="tipo_pago-'.$_GET['last'].'" type="radio"> Transferencia
					</label>
				</div>
				<div class="form-check form-check-inline">
					<label class="form-check-label">
						<input class="form-check-input tarjeta-credito" name="tipo_pago-'.$_GET['last'].'" type="radio"> Tarjeta de Crédito 
					</label>
				</div>
				<div class="pago-space row">
				</div>
			</div>
		</div>
		<script>
			$("input[type=radio][name=tipo_pago-'.$_GET['last'].']").change(function() {
				var $space = $(this).closest(".row").find(".pago-space");
				if( $(this).hasClass("transferencia") )
					$.ajax({type: "POST",dataType: "html",url:"getter.php?get=fieldTransferencia",success: function(data){$space.html(data);}});
				if( $(this).hasClass("tarjeta-credito") )
					$.ajax({type: "POST",dataType: "html",url:"getter.php?get=fieldTarjeta",success: function(data){$space.html(data);}});
			});
		</script>';
	}
	if($_GET['get'] == "fieldTransferencia"){
		$resultado = '<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-sm-3 form-control-label">
					<h5>N° de Transferencia</h5>
				</label>
				<div class="col-sm-9">
					<input name="transferencia[]" type="text" placeholder="Introduzca N° de Transferencia" pattern="\d{4,}" class="form-control" required>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-sm-3 form-control-label">
					<h5>Monto</h5>
				</label>
				<div class="col-sm-9">
					<input name="transferencia_monto[]" type="text" placeholder="Introduzca Monto" pattern="([0-9]+\.[0-9]+)|([0-9]+)" class="form-control" required>
				</div>
			</div>
		</div>';
	}
	if($_GET['get'] == "fieldTarjeta"){
		$resultado = '<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-sm-3 form-control-label">
					<h5>N° de Tarjeta</h5>
				</label>
				<div class="col-sm-9">
					<input name="tarjeta_numero[]" type="text" placeholder="Introduzca N° de Tarjeta" pattern="\d{16}" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-3 form-control-label">
					<h5>Código de Seguridad</h5>
				</label>
				<div class="col-sm-9">
					<input name="tarjeta_cod[]" type="text" placeholder="Introduzca Codigo" pattern="\d{3}" class="form-control" required>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-sm-3 form-control-label">
					<h5>Tarjetahabiente</h5>
				</label>
				<div class="col-sm-9">
					<input name="tarjeta_nombre[]" type="text" placeholder="Introduzca Nombre y apellido" pattern="[a-zA-z ñ]+" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="example-date-input" class="col-sm-3 col-form-label">
					<h5>Fecha de Vencimiento</h5>
				</label>
				<div class="col-sm-9">
					<input class="form-control" name="tarjeta_fecha[]" min="'.date("Y-m-d").'" type="date" placeholder="Fecha de Vencimiento"  required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-3 form-control-label">
					<h5>Monto</h5>
				</label>
				<div class="col-sm-9">
					<input name="tarjeta_monto[]" type="text" placeholder="Introduzca Monto" pattern="([0-9]+\.[0-9]+)|([0-9]+)" class="form-control" required>
				</div>
			</div>
		</div>';
	}
	if($_GET['get'] == "cl_rif"){
		$id = htmlentities($_GET['id'], ENT_QUOTES);
		$qry = "SELECT cl_tipo_rif AS tipo, cl_rif AS rif FROM Cliente WHERE cl_id=".$id;
		$answer = pg_query( $conexion, $qry );
		$cliente = pg_fetch_object($answer);
		if($id!='NULL')
			$resultado=$cliente->tipo."-".$cliente->rif;
		else
			$resultado="";
	}
	if($_GET['get'] == "po_rif"){
		$id = htmlentities($_GET['id'], ENT_QUOTES);
		$qry = "SELECT po_tipo_rif AS tipo, po_rif AS rif FROM Proveedor WHERE po_id=".$id;
		$answer = pg_query( $conexion, $qry );
		$proveedor = pg_fetch_object($answer);
		if($id!='NULL')
			$resultado=$proveedor->tipo."-".$proveedor->rif;
		else
			$resultado="";
	}
	
	echo $resultado;
?>
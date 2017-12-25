<?php include 'conexion.php';
	if($_GET['get'] == "municipios"){
		$id = $_GET['id'];
		$qry = "SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar WHERE lu_lugar=".$id." AND lu_tipo='Municipio' ORDER BY lu_nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		while( $municipio = pg_fetch_object($answer) ){
			$resultado.="<option value='".$municipio->id."'>".$municipio->nombre."</option>";
		}
	}
	if($_GET['get'] == "parroquias"){
		$id = $_GET['id'];
		$qry = "SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar WHERE lu_lugar=".$id." AND lu_tipo='Parroquia' ORDER BY lu_nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		while( $parroquia = pg_fetch_object($answer) ){
			$resultado.="<option value='".$parroquia->id."'>".$parroquia->nombre."</option>";
		}
	}
	if($_GET['get'] == "submodelos"){
		$id = $_GET['id'];
		$qry = "SELECT as_id AS id, as_nombre AS nombre FROM Submodelo_avion WHERE as_modelo_avion=".$id." ORDER BY as_nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		while( $parroquia = pg_fetch_object($answer) ){
			$resultado.="<option value='".$parroquia->id."'>".$parroquia->nombre."</option>";
		}
	}
	if($_GET['get'] == "distribuciones"){
		$id = $_GET['id'];
		$qry = "SELECT di_id AS id, di_nombre AS nombre FROM Distribucion WHERE di_modelo_avion=".$id." ORDER BY di_nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		while( $parroquia = pg_fetch_object($answer) ){
			$resultado.="<option value='".$parroquia->id."'>".$parroquia->nombre."</option>";
		}
	}
	if($_GET['get'] == "zonas"){
		$id = $_GET['id'];
		$qry = "SELECT zo_id AS id, zo_nombre AS nombre FROM Zona WHERE zo_sede=".$id." ORDER BY zo_nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		while( $zona = pg_fetch_object($answer) ){
			$resultado.="<option value='".$zona->id."'>".$zona->nombre."</option>";
		}
	}
	if($_GET['get'] == "fieldContacto"){
		$resultado = '<div class="form-group row last-contacto">
			<div class="col-sm-3"></div>
			<div class="col-sm-3 select">
				<select name="tipo_contacto[]" class="form-control" required>
					<option value="NULL">Seleccionar</option>';
					$qry = "SELECT ct_id id, ct_nombre nombre FROM Tipo_contacto ORDER BY ct_nombre";
					$rs = pg_query( $conexion, $qry );
					while( $tipo_contacto = pg_fetch_object($rs) ){
						$resultado.='<option value="'.$tipo_contacto->id.'">'.$tipo_contacto->nombre.'</option>';
					}
				$resultado.='</select>
			</div>
			<div class="col-sm-6">
				<input name="contacto[]" type="text" placeholder="Introduzca Contacto" class="form-control" required>
			</div>
		</div>';
	}
	if($_GET['get'] == "cl_rif"){
		$id = $_GET['id'];
		$qry = "SELECT cl_tipo_rif AS tipo, cl_rif AS rif FROM Cliente WHERE cl_id=".$id;
		$answer = pg_query( $conexion, $qry );
		$cliente = pg_fetch_object($answer);
		if($id!='NULL')
			$resultado=$cliente->tipo."-".$cliente->rif;
		else
			$resultado="";
	}
	
	echo $resultado;
?>
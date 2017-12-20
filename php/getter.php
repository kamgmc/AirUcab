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
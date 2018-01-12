<?php include 'conexion.php';
	if($_GET['get'] == "produccion-anual"){
		$year = htmlentities($_GET['year'], ENT_QUOTES);
		$qry = "SELECT count(a_id) cantidad FROM Avion, Status_avion, Status WHERE EXTRACT(Year from a_fecha_fin)=".$year." AND sa_avion=a_id AND sa_status=st_id AND st_nombre='Listo'";
		$rs = pg_query( $conexion, $qry );
		$qry2="SELECT count(p_id) cantidad FROM Pieza, Status_pieza, Status WHERE EXTRACT(Year from p_fecha_fin)=".$year." AND spi_pieza=p_id AND spi_status=st_id AND st_nombre='Listo'";
		$rs2 = pg_query( $conexion, $qry ); 
		$avion = pg_fetch_object($rs);
		$pieza = pg_fetch_object($rs2);
		$resultado="Aviones: ".$avion->cantidad.'<br/> Piezas: '.$pieza->cantidad;
	}
	if($_GET['get'] == "produccion-mensual"){
		$year = htmlentities($_GET['year'], ENT_QUOTES);
		$qry = "SELECT count(a_id)/12::real cantidad FROM Avion, Status_avion, Status WHERE EXTRACT(Year from a_fecha_fin)=".$year." AND sa_avion=a_id AND sa_status=st_id AND st_nombre='Listo'";
		$rs = pg_query( $conexion, $qry );
		$qry2="SELECT count(p_id)/12::real cantidad FROM Pieza, Status_pieza, Status WHERE EXTRACT(Year from p_fecha_fin)=".$year." AND spi_pieza=p_id AND spi_status=st_id AND st_nombre='Listo'";
		$rs2 = pg_query( $conexion, $qry ); 
		$avion = pg_fetch_object($rs);
		$pieza = pg_fetch_object($rs2);
		$resultado="Aviones: ".number_format($avion->cantidad, 2, ',', '.').'<br/> Piezas: '.number_format($pieza->cantidad, 2, ',', '.');
	}
	if($_GET['get'] == "mejores-clientes"){
		$year = htmlentities($_GET['year'], ENT_QUOTES);
		$qry = "SELECT cl_nombre nombre, count(a_id) cantidad FROM Cliente, Factura_venta, Avion WHERE a_factura_venta=fv_id AND fv_cliente=cl_id AND EXTRACT(Year from fv_fecha)=".$year." GROUP BY cl_nombre ORDER BY cantidad DESC limit 10";
		$rs = pg_query( $conexion, $qry ); $resultado = "";
		while($cliente = pg_fetch_object($rs))
			$resultado.='<p><strong>'.$cliente->nombre.'</strong> '.$cliente->cantidad.' ventas.</p>';
	}
	if($_GET['get'] == "modelos-producidos"){
		$year = htmlentities($_GET['year'], ENT_QUOTES);
		$qry = "SELECT am_nombre nombre, (Select Count(a_id)/12::real From Avion, Submodelo_avion, Status_avion, Status Where a_submodelo_avion=as_id and as_modelo_avion=ma.am_id and sa_avion=a_id and sa_status=st_id and st_nombre='Listo' AND EXTRACT(Year from sa_fecha_ini)=".$year.") cantidad FROM  Modelo_avion ma Order By nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		$rs = pg_query( $conexion, $qry ); $resultado = "";
		while($modelo = pg_fetch_object($rs))
			$resultado.='<p><strong>'.$modelo->nombre.'</strong> '.number_format($modelo->cantidad, 2, ',', '.').' aviones.</p>';
	}
	if($_GET['get'] == "inventario-mensual"){
		$year = htmlentities($_GET['year'], ENT_QUOTES);
		$month = htmlentities($_GET['month'], ENT_QUOTES);
		$qry = "Select nombre, Count(*) cantidad From(SELECT mt_nombre nombre FROM Material, Tipo_material, Status_material, Status, Factura_compra Where m_tipo_material=mt_id AND m_pieza is null AND sm_material=m_id AND m_factura_compra=fc_id AND EXTRACT(Month from fc_fecha)=".$month." AND EXTRACT(Year from fc_fecha)=".$year." AND sm_status=st_id AND st_nombre<>'Rechazado' Group By m_id, mt_nombre) AS Materiales Group By nombre";
		$answer = pg_query( $conexion, $qry );
		$resultado="<option value='NULL'>Seleccionar</option>";
		$rs = pg_query( $conexion, $qry ); $resultado = "";
		if(pg_num_rows($rs) > 0){
			while($material = pg_fetch_object($rs))
				$resultado.='<p><strong>'.$material->nombre.'</strong> '.number_format($material->cantidad, 0, ',', '.').' unds .</p>';
		}
		else print "<p>Sin inventario.</p>";
				
		
	}
	echo $resultado;
?>
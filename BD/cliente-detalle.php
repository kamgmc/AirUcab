<?php session_start();
include 'conexion.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "SELECT cl_id AS id, cl_tipo_rif AS tipo_rif, cl_rif AS rif, cl_nombre AS nombre, (Select SUM(a_precio) From Avion, Factura_venta Where a_factura_venta=fv_id AND fv_cliente=cl.cl_id) as monto, cl_fecha_inicio AS fecha, pa.lu_nombre as parroquia, pa.lu_id as id_parroquia, mu.lu_nombre as municipio, mu.lu_id as id_municipio, es.lu_nombre as estado, es.lu_id as id_estado, cl_pagina_web AS web FROM Cliente cl LEFT JOIN Lugar pa ON lu_id=cl_direccion LEFT JOIN Lugar mu ON mu.lu_id=pa.lu_lugar LEFT JOIN Lugar es ON es.lu_id=mu.lu_lugar WHERE cl_id=".$id;
$con = pg_query($conexion, $qry);
$cliente = pg_fetch_object($con);
$date = new DateTime($cliente->fecha);
$resultado = '<div class="modal-header">
			<h4 id="exampleModalLabel" class="modal-title">Detalle Cliente</h4>
			<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
		</div>
		<div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="card col-lg-12">
						<div class="row">
							<!-- Columna Izquierda   -->
							<div class="card-body col-lg-6">
								<div class="row">
									<div class="col-lg-4">
										<h4>Nombre</h4>
									</div>
									<div class="col-lg-8">'.$cliente->nombre.'</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<h4>CI / RIF</h4> 
									</div>
									<div class="col-lg-8">'.$cliente->tipo_rif."-".$cliente->rif.'</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<h4>Dirección</h4>
									</div>
									<div class="col-lg-8">'.$cliente->parroquia.", ".$cliente->municipio.", ".$cliente->estado.'</div>
								</div>';
									if(!is_null($cliente->web))
										$resultado .= '<div class="row">
											<div class="col-lg-4">
												<h4>Pagina Web</h4>
											</div>
											<div class="col-lg-8"> 
												<a href="http://'.$cliente->web.'" class="external">'.$cliente->web.'</a>
											</div>
										</div>';
								$resultado .= '</div>
							<!-- Columna izquierda ENDS -->
							<!-- Columna derecha -->
							<div class=" card-body col-lg-6">';
								$qry = "SELECT ct_nombre AS tipo, co_valor AS valor FROM Contacto, Tipo_contacto WHERE ct_id=co_tipo AND co_cliente=".$cliente->id;
								$answer = pg_query( $conexion, $qry );
								$num = pg_num_rows($answer);
								if($num > 0){
								$resultado .= '<div class="row">
									<div class="col-lg-12">
										<h4>Contacto</h4> 
									</div>
									<div class="col-lg-12">';
									while( $contacto = pg_fetch_object($answer) )
										$resultado .= $contacto->tipo." - ".$contacto->valor."</br>";
									$resultado .= '</div>
								</div>';
								}
								$resultado .= '<div class="row">
									<div class="col-lg-4">
										<h4>Monto Acreditado</h4>
									</div>
									<div class="col-lg-8">'.number_format($cliente->monto, 2, ',', '.')." Bs".'</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<h4>Fecha Suscripción</h4>
									</div>
									<div class="col-lg-8">'.$date->format('d/m/Y').'</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>';
			if( in_array("cl_u", $permiso) )
			$resultado.='<a href="'.$cliente->id.'" class="click-cliente-editar btn btn-primary">Editar</a>';
		$resultado.='</div>
		<script>
		$( "a.click-cliente-editar" ).click(function( event ) {
			event.preventDefault();
			var href = $(this).attr("href");
			$.ajax({type: "POST",dataType: "html",url:"cliente-editar.php?id="+href,success: function(data){$("#editarClienteBody").html(data);}});
			$("#ModalEditarCliente").modal("show");
			$("#ModalEditarCliente").modal("handleUpdate");
		});
		</script>';
echo $resultado;
?>
<?php session_start();
include 'conexion.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 2;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "SELECT po_id AS id, po_tipo_rif||'-'||po_rif AS rif, po_nombre AS nombre, (Select SUM(m_precio) From Material, Factura_compra Where m_factura_compra=fc_id AND fc_proveedor=po.po_id) as monto, po_fecha_ini as fecha, pa.lu_nombre AS parroquia, mu.lu_nombre AS municipio, es.lu_nombre AS estado, po_pagina_web AS web FROM proveedor po LEFT JOIN Lugar pa ON pa.lu_id=po_direccion LEFT JOIN Lugar mu ON pa.lu_lugar=mu.lu_id LEFT JOIN Lugar es ON mu.lu_lugar=es.lu_id WHERE po_id=".$id;
$con = pg_query($conexion, $qry);
$proveedor = pg_fetch_object($con);
$date = new DateTime($proveedor->fecha);
$resultado = '<div class="modal-header">
				<h4 id="exampleModalLabel" class="modal-title">Detalle de Proveedor</h4>
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
										<div class="col-lg-8">'.$proveedor->nombre.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>CI/RIF</h4>
										</div>
										<div class="col-lg-8">'.$proveedor->rif.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Dirección</h4> </div>
										<div class="col-lg-8">'.$proveedor->parroquia.", ".$proveedor->municipio.", ".$proveedor->estado.'</div>
									</div>';
									if(!is_null($proveedor->web))
										$resultado .= '<div class="row">
											<div class="col-lg-4">
												<h4>Pagina Web</h4>
											</div>
											<div class="col-lg-8"> 
												<a href="http://'.$proveedor->web.'" class="external">'.$proveedor->web.'</a>
											</div>
										</div>';
								$resultado .= '</div>
								<!-- Columna izquierda ENDS -->
								<!-- Columna derecha -->
								<div class=" card-body col-lg-6">';
									$qry = "SELECT ct_nombre AS tipo, co_valor AS valor FROM Contacto, Tipo_contacto WHERE ct_id=co_tipo AND co_proveedor=".$proveedor->id;
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
											<h4>Monto Pagado</h4>
										</div>
										<div class="col-lg-8">'.number_format($proveedor->monto, 2, ',', '.')." Bs".'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Fecha de Suscripción</h4>
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
				if( in_array("po_u", $permiso) )
				$resultado.='<a href="'.$proveedor->id.'" class="click-proveedor-editar btn btn-primary">Editar</a>';
			$resultado.='</div>
			<script>
		$( "a.click-proveedor-editar" ).click(function( event ) {
			event.preventDefault();
			var href = $(this).attr("href");
			$.ajax({type: "POST",dataType: "html",url:"proveedor-editar.php?id="+href,success: function(data){$("#editarProveedorBody").html(data);}});
			$("#ModalEditarProveedor").modal("show");
			$("#ModalEditarProveedor").modal("handleUpdate");
		});
		</script>';
echo $resultado;
?>
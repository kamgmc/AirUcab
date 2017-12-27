<?php session_start();
include 'conexion.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
$qry = "SELECT em_id id,em_nombre nombre, em_apellido apellido, em_nacionalidad nac, em_ci ci, em_fecha_ingreso fecha, em_usuario usuario, ti_nombre titulacion, sr_nombre rol, er_nombre cargo, se.se_nombre sede, zo.zo_nombre zona, pa.lu_nombre parroquia, mu.lu_nombre municipio, es.lu_nombre estado, em_nota nota, em_supervisa zona_s, em_gerencia sede_g FROM Empleado left join Titulacion ON ti_id=em_titulacion LEFT JOIN Rol_sistema ON sr_id=em_rol LEFT JOIN Zona zo ON em_zona=zo.zo_id LEFT JOIN Sede se on zo.zo_sede=se.se_id LEFT JOIN Cargo ON er_id=em_cargo LEFT JOIN Lugar pa ON pa.lu_id=em_direccion LEFT JOIN Lugar mu ON mu.lu_id=pa.lu_lugar LEFT JOIN Lugar es ON es.lu_id=mu.lu_lugar WHERE em_id=".$_GET['id']." ORDER BY em_id";
$con = pg_query($conexion, $qry);
$empleado = pg_fetch_object($con);
$date = new DateTime($empleado->fecha);
$resultado = '<div class="modal-header">
				<h4 id="exampleModalLabel" class="modal-title">Detalle de Empleado</h4>
				<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="card col-lg-12">
							<div class="row">
								<div class="card-body col-lg-6">
									<div class="row">
										<div class="col-lg-4">
											<h4>Nombre</h4>
										</div>
										<div class="col-lg-8">'.$empleado->nombre.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Apellido</h4>
										</div>
										<div class="col-lg-8">'.$empleado->apellido.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>CI</h4>
										</div>
										<div class="col-lg-8">'.$empleado->nac."-".number_format($empleado->ci, 0, ',', '.').'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Dirección</h4>
										</div>
										<div class="col-lg-8">'.$empleado->parroquia.", ".$empleado->municipio.", ".$empleado->estado.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Fecha de Ingreso</h4>
										</div>
										<div class="col-lg-8">'.$date->format('d-m-Y').'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Usuario</h4>
										</div>
										<div class="col-lg-8">'."@".$empleado->usuario.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Titulación</h4>
										</div>
										<div class="col-lg-8">'.$empleado->titulacion.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Cargo</h4>
										</div>
										<div class="col-lg-8">'.$empleado->cargo.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Rol del sistema</h4>
										</div>
										<div class="col-lg-8">'.$empleado->rol.'</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Sede</h4>
										</div>
										<div class="col-lg-8">'.$empleado->sede.'</div>';
										if( $empleado->sede_g == 't' )
											$resultado .= '<div class="col-lg-4"></div><div class="col-lg-8"><strong>Gerencia esta Sede.</strong></div>';
										$resultado .='
									</div>
									<div class="row">
										<div class="col-lg-4">
											<h4>Zona</h4>
										</div>
										<div class="col-lg-8">'.$empleado->zona.'</div>';
										if( $empleado->zona_s == 't' )
											$resultado .= '<div class="col-lg-4"></div><div class="col-lg-8"><strong>Supervisa esta zona.</strong></div>';
										$resultado .='
									</div>
								</div>
								<div class=" card-body col-lg-6">';
									$qry = "SELECT ct_nombre AS tipo, co_valor AS valor FROM Contacto, Tipo_contacto WHERE ct_id=co_tipo AND co_empleado=".$empleado->id;
									$answer = pg_query( $conexion, $qry );
									$num = pg_num_rows($answer);
									if($num > 0){
										$resultado .= '<div class="row">
										<div class="col-lg-12">
											<h4>Contacto</h4> 
										</div>';
										while( $contacto = pg_fetch_object($answer) )
											$resultado .= '<div class="col-lg-12 text-left">'.$contacto->tipo." - ".$contacto->valor.'</div>';
										
										$resultado .= '</div>';
									}
									$qry = "SELECT be_nombre AS nombre, be_apellido AS apellido, be_nacionalidad AS nac, be_ci AS ci FROM Beneficiario WHERE be_empleado=".$empleado->id;
									$answer = pg_query( $conexion, $qry );
									$num = pg_num_rows($answer);
									if($num > 0){
										$resultado .= '<div class="row">
										<div class="col-lg-12">
											<h4>Beneficiarios</h4>
										</div>';
										while( $beneficiario = pg_fetch_object($answer) )
											$resultado .= '<div class="col-lg-12 text-left">'.$beneficiario->nombre." ".$beneficiario->apellido." / ".$beneficiario->nac."-".number_format($beneficiario->ci, 0, ',', '.').'</div>';
										$resultado .= '</div>';
									}
									$qry = "SELECT ex_descripcion AS desc, ex_years AS years FROM Experiencia WHERE ex_empleado=".$empleado->id;
									$answer = pg_query( $conexion, $qry );
									$num = pg_num_rows($answer);
									if($num > 0){
										$resultado .= '<div class="row">
										<div class="col-lg-12">
											<h4>Experiencia</h4> 
										</div>'; 
										while( $experiencia = pg_fetch_object($answer) )
											$resultado .= '<div class="col-lg-12 text-left">'.$experiencia->desc." / ".$experiencia->years." años.".'</div>';
										$resultado .= '</div>';
									}
									else
										$resultado .= '<div class="row">
											<div class="col-lg-12">
												<h4>No posee experiencia.</h4> 
											</div>
										</div>'; 
									if(!is_null($empleado->nota))
										$resultado .= '<div class="row">
											<div class="col-lg-3">
												<h4>Nota</h4> 
											</div>
											<div class="col-lg-9">'.$empleado->nota.'</div>
										</div>';
									$resultado .='
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>';
				if( in_array("em_u", $permiso) )
				$resultado.='<a href="'.$empleado->id.'" class="click-empleado-editar btn btn-primary">Editar</a>';
			$resultado.='</div>
			<script>
			$( "a.click-empleado-editar" ).click(function( event ) {
				event.preventDefault();
				var href = $(this).attr("href");
				$.ajax({type: "POST",dataType: "html",url:"empleado-editar.php?id="+href,success: function(data){$("#editarEmpleadoBody").html(data);}});
				$("#ModalEditarEmpleado").modal("show");
				$("#ModalEditarEmpleado").modal("handleUpdate");
			});
			</script>';
echo $resultado;
?>
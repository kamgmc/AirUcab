<?php session_start();
include 'conexion.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 2;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ) $permiso[] = $rol->permiso;

$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "SELECT * FROM Modelo_avion WHERE am_id=".$id;
$con = pg_query($conexion, $qry);
$modelo = pg_fetch_object($con);
//Calculo de Tiempo estimado
$dias = $modelo->am_tiempo_estimado + 1;
$hoy = new DateTime();
$fin = new DateTime(date('Y-m-d', strtotime($hoy->format("Y-m-d"). ' + '.$dias.' days')));
$interval = $hoy->diff($fin);
//Contenido del Modal
$resultado = '<div class="modal-header">
<h4 id="exampleModalLabel" class="modal-title">Detalle Modelo de Avión</h4>
<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
	<div class="container-fluid">
		<div class="row">
			<div class="card col-lg-12"><div class="row">
				<!-- Columna Izquierda   -->
				<div class="card-body col-lg-6">
					<div class="row">
						<div class="col-lg-4">
							<h4>ID</h4>
						</div>
						<div class="col-lg-8">'.$modelo->am_id.'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Nombre</h4>
						</div>
						<div class="col-lg-8">'.$modelo->am_nombre.'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Longitud</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_longitud, 2, ',', '.')." m".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Envergadura</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_envergadura, 2, ',', '.')." m".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Altura</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_altura, 1, ',', '.')." m".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Superficie Alar</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_ala_superficie, 2, ',', '.')." m<sup>2</sup>".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Flecha Alar</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_ala_flecha, 0, ',', '.')."°".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Peso Maximo de Aterrizaje</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_peso_aterrizaje_max, 0, ',', '.')." Kg".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Alcance</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_alcance, 0, ',', '.')." Km".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Velocidad Máxima</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_velocidad_max, 0, ',', '.')." Km/h (".number_format($modelo->am_velocidad_max/1234.8, 2, ',', '.').' Mach)</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Techo de Servicio</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_techo_servicio, 0, ',', '.')." m".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Regimen de Ascenso</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_regimen_ascenso, 1, ',', '.')." m/s".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Numero Pasillos</h4>
						</div>
						<div class="col-lg-8">'.$modelo->am_numero_pasillos.'</div>
					</div>
				</div>
				<!-- Columna izquierda ENDS -->
				<!-- Columna derecha -->
				<div class=" card-body col-lg-6">
					<div class="row">
						<div class="col-lg-4">
							<h4>Tipo de Fuselaje</h4>
						</div>
						<div class="col-lg-8">'.$modelo->am_fuselaje_tipo.'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Altura del Fuselaje</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_fuselaje_altura, 2, ',', '.')." m".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Ancho del Fuselaje</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_fuselaje_ancho, 2, ',', '.')." m".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Altura de la Cabina</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_cabina_altura, 2, ',', '.')." m".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Ancho de la Cabina</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_cabina_ancho, 2, ',', '.')." m".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Volumen de Carga</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_carga_volumen, 1, ',', '.')." m<sup>3</sup>".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Capacidad de Pilotos</h4>
						</div>
						<div class="col-lg-8">'.$modelo->am_capacidad_pilotos.'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Capacidad de Asistentes</h4>
						</div>
						<div class="col-lg-8">'.$modelo->am_capacidad_asistentes.'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Carrera de Despegue</h4>
						</div>
						<div class="col-lg-8">'.number_format($modelo->am_carrera_despegue, 0, ',', '.')." m".'</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<h4>Tiempo Estimado de Fabricación</h4>
						</div>
						<div class="col-lg-8">'.$interval->format('%m meses y %d días').'</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>';
	if( in_array("am_u", $permiso) )
		$resultado.='<a href="'.$modelo->am_id.'" class="click-modelo-editar btn btn-primary">Editar</a>';
$resultado.='</div>';
if( in_array("am_u", $permiso) )
$resultado.='<script>
	//Control Editar Modelo
	$( "a.click-modelo-editar" ).click(function( event ) {
		event.preventDefault();
		var href = $(this).attr("href");
		$.ajax({type: "POST",dataType: "html",url:"modeloavion-editar.php?id="+href,success: function(data){$("#editarModeloBody").html(data);}});
		$("#ModalEditarModelo").modal("show");
		$("#ModalEditarModelo").modal("handleUpdate");
	});
	</script>';
echo $resultado;
?>
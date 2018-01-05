<?php session_start();
include 'conexion.php';
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
$id = htmlentities($_GET['id'], ENT_QUOTES);
$qry = "select as_id, as_nombre, as_peso_maximo_despegue, as_peso_vacio, as_velocidad_crucero, as_carrera_despegue_peso_maximo, as_autonomia_peso_maximo_despegue, as_capacidad_combustible, as_alcance_carga_maxima, am_nombre AS modelo from submodelo_avion, modelo_avion where as_modelo_avion=am_id AND as_id=".$id;
$con = pg_query($conexion, $qry);
$submodelo = pg_fetch_object($con);
$resultado = '<div class="modal-header">
			<h4 id="exampleModalLabel" class="modal-title">Detalle Submodelo de Avión</h4>
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
										<h4>ID</h4> </div>
									<div class="col-lg-8">'.$submodelo->as_id.'</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<h4>Nombre</h4> </div>
									<div class="col-lg-8">'.$submodelo->as_nombre.'</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<h4>Modelo de Avión</h4> </div>
									<div class="col-lg-8">'.$submodelo->modelo.'</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<h4>Peso Maximo Despegue</h4> </div>
									<div class="col-lg-8">'.number_format($submodelo->as_peso_maximo_despegue, 0, ',', '.')." Kg".'</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<h4>Peso Vacio</h4> </div>
									<div class="col-lg-8">'.number_format($submodelo->as_peso_vacio, 0, ',', '.')." Kg".'</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<h4>Velocidad Crucero</h4> </div>
									<div class="col-lg-8">'.number_format($submodelo->as_velocidad_crucero, 0, ',', '.')." Km/h (".number_format($submodelo->as_velocidad_crucero/1234.8, 2, ',', '.').' Mach)</div>
								</div>
							</div>
							<!-- Columna izquierda ENDS -->
							<!-- Columna derecha -->
							<div class=" card-body col-lg-6">
								<div class="row">
									<div class="col-lg-4">
										<h4>Carrera Despegue Peso Maximo</h4> </div>
									<div class="col-lg-8">'.number_format($submodelo->as_carrera_despegue_peso_maximo, 0, ',', '.')." m".'</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<h4>Autonomia Peso Maximo Despegue</h4> </div>
									<div class="col-lg-8">'.number_format($submodelo->as_autonomia_peso_maximo_despegue, 0, ',', '.')." Km".'</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<h4>Capacidad Combustible</h4> </div>
									<div class="col-lg-8">'.number_format($submodelo->as_capacidad_combustible, 0, ',', '.')." Lts".'</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<h4>Alcance Carga Maxima</h4> </div>
									<div class="col-lg-8">'.number_format($submodelo->as_alcance_carga_maxima, 0, ',', '.')." m".'</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>';
			if( in_array("as_u", $permiso) )
				$resultado.='<a href="'.$submodelo->as_id.'" class="click-submodelo-editar btn btn-primary">Editar</a>';
			$resultado.='</div>
			<script>
			$( "a.click-submodelo-editar" ).click(function( event ) {
				event.preventDefault();
				var href = $(this).attr("href");
				$.ajax({type: "POST",dataType: "html",url:"submodeloavion-editar.php?id="+href,success: function(data){$("#editarSubmodeloBody").html(data);}});
				$("#ModalEditarSubmodelo").modal("show");
				$("#ModalEditarSubmodelo").modal("handleUpdate");
			});
			</script>';
echo $resultado;
?>
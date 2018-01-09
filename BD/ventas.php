<!DOCTYPE html><?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AirUCAB - Ventas</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<!-- Fontastic Custom icon font-->
	<link rel="stylesheet" href="css/fontastic.css">
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
	<!-- Google fonts - Poppins -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
	<!-- theme stylesheet-->
	<link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
	<!-- Custom stylesheet - for your changes-->
	<link rel="stylesheet" href="css/custom.css">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/airucab.ico"> </head>

<body>
	<div class="page home-page">
		<!-- Main Navbar-->
		<header class="header">
			<nav class="navbar">
				<div class="container-fluid">
					<div class="navbar-holder d-flex align-items-center justify-content-between">
						<!-- Navbar Header-->
						<div class="navbar-header">
							<!-- Navbar Brand -->
							<a href="index.html" class="navbar-brand">
								<div class="brand-text brand-big"><span>Air</span><strong>UCAB</strong></div>
								<div class="brand-text brand-small"><strong>AU</strong></div>
							</a>
							<!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a> </div>
						<!-- Navbar Menu -->
						<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
							<?php if( isset($_SESSION['code']) ){ ?>
							<!-- Logout    -->
							<li class="nav-item">
								<a href="close.php" class="nav-link logout">Cerrar Sesión<i class="fa fa-sign-out"></i></a>
							</li>
							<?php }else{ ?>
							<!-- Login -->
							<li class="nav-item">
								<a href="login.php" class="nav-link logout">Iniciar Sesión<i class="fa fa-sign-in"></i></a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<div class="page-content d-flex align-items-stretch">
			<!-- Side Navbar -->
			<nav class="side-navbar">
				<?php if( isset($_SESSION['code']) ){ ?>
				<!-- Sidebar Header-->
				<div class="sidebar-header d-flex align-items-center">
					<div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
					<div class="title">
						<h1 class="h4"><?php print $_SESSION['usuario']; ?></h1>
						<p><?php print $_SESSION['cargo']; ?></p>
					</div>
				</div>
				<?php } ?>
				<!-- Sidebar Navidation Menus-->
				<ul class="list-unstyled">
					<?php if( in_array("am_r", $permiso) || in_array("as_r", $permiso) || in_array("di_r", $permiso) ){ ?>
					<li>
						<a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a>
					</li>
					<?php }?>
					<li>
						<a href="motores.php"> <i class="fa fa-tachometer " aria-hidden="true"></i>Motores </a>
					</li>
					<li>
						<a href="piezas.php"> <i class="fa fa-puzzle-piece " aria-hidden="true"></i>Piezas </a>
					</li>
					<li>
						<a href="materiales.php"> <i class="fa fa-server " aria-hidden="true"></i>Materiales </a>
					</li>
					<?php if( in_array("fv_r", $permiso) || in_array("fv_c", $permiso) ){ ?>
					<li class="active">
						<a href="ventas.php"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Ventas </a>
					</li>
					<?php }?>
					<?php if( in_array("fc_r", $permiso) ){ ?>
					<li>
						<a href="compras.php"> <i class="fa fa-shopping-bag " aria-hidden="true"></i>Compras </a>
					</li>
					<?php }?>
					<li>
						<a href="Sedes.php"> <i class="fa fa-university " aria-hidden="true"></i>Sedes </a>
					</li>
					<?php if( in_array("em_r", $permiso) || in_array("em_c", $permiso) ){ ?>
					<li>
						<a href="empleados.php"><i class="fa fa-id-card-o"></i>Empleados</a>
					</li>
					<?php }?>
					<?php if( in_array("cl_r", $permiso) ){ ?>
					<li>
						<a href="clientes.php"> <i class="fa fa-address-book-o" aria-hidden="true"></i>Clientes</a>
					</li>
					<?php }?>
					<?php if( in_array("po_r", $permiso) ){ ?>
					<li>
						<a href="proveedores.php"> <i class="fa fa-truck" aria-hidden="true"></i>Proveedores</a>
					</li>
					<?php }?>
					<li>
						<a href="pruebas.php"> <i class="fa fa-check-square-o " aria-hidden="true"></i>Pruebas </a>
					</li>
					<li>
						<a href="traslados.php"> <i class="fa fa-share-square-o " aria-hidden="true"></i>Traslados </a>
					</li>
				</ul>
			</nav>
			<div class="content-inner">
				<?php if(isset($_GET['error'])){?>
				<!-- Alert -->
				<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
					<?php if($_GET['error']==1){?>Error al crear <strong>Factura de Venta</strong>.<?php }?>
					<?php if($_GET['error']==2){?>Error al insertar <strong>Avion</strong>.<?php }?>
					<?php if($_GET['error']==3){?>Error al insertar <strong>Pago</strong>.<?php }?>
					<?php if($_GET['error']==4){?>Error al insertar <strong>Experiencia</strong>.<?php }?>
					<?php if($_GET['error']==5){?>Error al editar <strong>Empleado</strong>.<?php }?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }?>
				<!-- Section de TABS-->
				<section>
					<div class="container-fluid">
						<input id="tab0" type="radio" name="tabs" class="no-display" checked>
						<label for="tab0" class="label"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Ventas</label>
						<!-- TAB Ventas -->
						<section id="content0" class="sectiontab">
							<!-- Filtrador-->
							<div class="container-fluid">
								<div class="row">
									<div class="card col-lg-12">
										<div class="row">
											<div class="card-body col-lg-5">
												<h3 class="h4">Filtrar ventas por:</h3>
												<form class="form-horizontal">
													<div class="row">
														<label class="col-sm-3 form-control-label">Cliente</label>
														<div class="col-sm-9 select">
															<select id="filtro_submodelo" name="cliente" class="form-control">
																<option value="NULL">Seleccionar</option>
																<?php $qry = "SELECT cl_id id, cl_nombre nombre FROM Cliente ORDER BY cl_nombre";
																$rs = pg_query( $conexion, $qry );
																while( $cliente = pg_fetch_object($rs) ){?>
																<option value="<?php print $cliente->id;?>">
																	<?php print $cliente->nombre;?>
																</option>
																<?php }?>
															</select>
														</div>
													</div>
													<div class="row">
														<label class="col-sm-3 form-control-label">Modelo de Avión</label>
														<div class="col-sm-9 select">
															<select name="account" class="form-control">
																<option value="NULL">Seleccionar</option>
																<?php $qry = "SELECT am_id id, am_nombre nombre FROM Modelo_avion ORDER BY am_nombre";
																$rs = pg_query( $conexion, $qry );
																while( $avion = pg_fetch_object($rs) ){?>
																<option value="<?php print $avion->id;?>">
																	<?php print $avion->nombre;?>
																</option>
																<?php }?>
															</select>
														</div>
													</div>
												</form>
											</div>
											<div class=" card-body col-lg-4">
												<div class="form-group row">
													<div class="col-sm-9">
														<br/>
														<input type="submit" value="Filtrar" class="btn btn-primary"> 
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Filtrador ENDS -->
							<!-- TABLE STARTS -->
							<div class="col-md-12">
								<div class="card">
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#ModalVentaCrear" class="btn btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th class="text-center">ID</th>
													<th>Cliente</th>
													<th class="text-center">Fecha de venta</th>
													<th class="text-center">Total</th>
													<th class="text-center">Status</th>
													<th class="text-center">Acción</th>
												</tr>
											</thead>
											<tbody>
												<?php 	
												$qry = "SELECT fv_id id, cl_nombre cliente, fv_fecha fecha, (Select SUM(a_precio) From Avion Where a_factura_venta=fv.fv_id) AS  total, (Select SUM(pa_monto) from Pago WHERE pa_factura_venta=fv.fv_id) AS pagado FROM Factura_venta fv LEFT JOIN Cliente ON fv_cliente=cl_id ORDER BY fv_fecha DESC, fv_id DESC";
												$rs = pg_query( $conexion, $qry );
												while( $venta = pg_fetch_object($rs) ){?>
													<tr>
														<td class="text-center"><?php print $venta->id;?></td>
														<td><?php print $venta->cliente;?></td>
														<td class="text-center"><?php $date = new DateTime($venta->fecha); print $date->format('d/m/Y');?></td>
														<td class="text-center"><?php print number_format($venta->total, 2, ',', '.')." Bs";?></td>
														<td class="text-center"><?php if($venta->pagado >= $venta->total) print "Pagado"; else print "Pendiente de pago";?></td>
														<td class="text-center">
															<a href="<?php print $venta->id;?>" title="Ver mas" class="click-venta-detalle">
																<i class="fa fa-file-text-o" aria-hidden="true"></i> 
															</a>&emsp;
															<a href="venta-crud.php?delete=<?php print $venta->id;?>">
																<i class="fa fa-trash-o" aria-hidden="true"></i>
															</a>
														</td>
													</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>
						<!-- TAB Ventas ENDS -->
						<!-- Modal Venta Crear -->
						<div id="ModalVentaCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">Crear Nueva Venta</h4>
										<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body">
									<form action="venta-crud.php?create=true" method="post">
										<div class="container-fluid">
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12">
															<h4>Información de Cliente</h4>
														</div>
													</div>
													<div class="row">
														<div class="card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Cliente</h4>
																</label>
																<div class="col-sm-9 select">
																	<select id="lista_clientes" name="cliente" class="form-control" required>
																		<option value="NULL">Seleccionar</option>
																		<?php $qry = "SELECT cl_id id, cl_nombre nombre FROM Cliente";
																		$rs = pg_query( $conexion, $qry );
																		while( $cliente = pg_fetch_object($rs) ){?>
																		<option value="<?php print $cliente->id;?>"><?php print $cliente->nombre;?></option>
																		<?php }?>
																	</select>
																</div>
															</div>
														</div>
														<div class=" card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>CI/RIF Cliente</h4> </label>
																<div class="col-sm-9">
																	<input id="cl_rif" type="text" disabled class="form-control"> </div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12">
															<h4>Información de Avión</h4>
														</div>
													</div>
													<div class="row form-avion last-avion">
														<div class="card-body col-lg-6">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Modelo de Avión</h4>
																</label>
																<!-- Traer de la tabla de modelo avion las opciones -->
																<div class="col-sm-9 select">
																	<select name="modelo_avion[]" class="form-control lista_modelos" required>
																		<option value="NULL">Seleccionar</option>
																		<?php $qry = "SELECT am_id id, am_nombre nombre FROM Modelo_avion ma WHERE (SELECT Count(*) from Distribucion WHERE di_modelo_avion=ma.am_id) > 0 AND (SELECT Count(*) from Submodelo_avion WHERE as_modelo_avion=ma.am_id) > 0";
																		$rs = pg_query( $conexion, $qry );
																		while( $avion = pg_fetch_object($rs) ){?>
																		<option value="<?php print $avion->id;?>"><?php print $avion->nombre;?></option>
																		<?php }?>
																	</select>
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
														<div class="card-body col-lg-6 right-side">
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h4>Precio</h4>
																</label>
																<div class="col-sm-9">
																	<input name="precio[]" type="text" placeholder="Introduzca precio del Avión" class="form-control" pattern="([0-9]+\.[0-9]+)|([0-9]+)" required>
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
													</div>
													<div class="form-group row">
														<div class="col-sm-12 text-right">
															<i id="add-avion" class="fa fa-plus"></i>&emsp;
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="card col-lg-12">
													<div class="row">
														<div class="col-sm-12">
															<h4>Información de Pago</h4>
														</div>
													</div>
													<div id="last" data-num="1" class="row last-pago">
														<div class="card-body col-lg-12">
															<div class="form-check form-check-inline">
																<label class="form-check-label">
																	<input class="form-check-input transferencia" name="tipo_pago" type="radio"> Transferencia
																</label>
															</div>
															<div class="form-check form-check-inline">
																<label class="form-check-label">
																	<input class="form-check-input tarjeta-credito" name="tipo_pago" type="radio"> Tarjeta de Crédito 
																</label>
															</div>
															<div class="pago-space row">
															</div>
														</div>
													</div>
													<div class="form-group row">
														<div class="col-sm-12 text-right">
															<i id="add-pago" class="fa fa-plus"></i>&emsp;
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="submit" class="btn btn-primary">Guardar</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Modal Venta Crear ENDS -->
						<!-- Modal Detalle Venta  -->
						<div id="ModalDetalleVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div id="detalleVentaBody" class="modal-content">
									
								</div>
							</div>
						</div>
						<!-- Modal Detalle Venta ENDS -->
						<!-- Modal Detalle Avion  -->
						<div id="ModalDetalleAvion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-lg">
								<div id="detalleAvionBody" class="modal-content">
								</div>
							</div>
						</div>
						<!-- Modal Detalle Avion ENDS -->
						<!-- Modal Detalle Pieza  -->
						<div id="ModalDetallePieza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog">
								<div id="detallePiezaBody" class="modal-content">
								</div>
							</div>
						</div>
						<!-- Modal Detalle Pieza ENDS -->
						<!-- Modal Detalle Motor  -->
						<div id="ModalDetalleMotor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog">
								<div id="detalleMotorBody" class="modal-content">
								</div>
							</div>
						</div>
						<!-- Modal Detalle Motor ENDS -->
					</div>
				</section>
				<!-- Section de TABS ENDS -->
			</div>
		</div>
		<!-- Page Footer-->
		<footer class="main-footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<p>AirUCAB &copy; 2017-2018</p>
					</div>
					<div class="col-sm-6 text-right">
						<p>Diseño por <a href="" class="external">AK</a></p>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!-- Javascript files-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="vendor/popper.js/umd/popper.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/jquery.cookie/jquery.cookie.js"></script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	<script src="js/front.js"></script>
	<script>
		$( document ).ready(function() {
			function update() {
				var id = $( "option:selected", this ).val();
				var $targetS = $(this).closest(".form-avion").find(".lista_submodelos");
				var $targetD = $(this).closest(".form-avion").find(".lista_distribuciones");
				$.ajax({type: "POST",dataType: "html",url:"getter.php?get=submodelosLimited&id="+id,success: function(data){$targetS.html(data); $targetS.removeAttr("disabled");}});
				$.ajax({type: "POST",dataType: "html",url:"getter.php?get=distribuciones&id="+id,success: function(data){$targetD.html(data); $targetD.removeAttr("disabled");}});
			}
			function updateSubmodelo() {
				var id = $( "option:selected", this ).val();
				var $target = $(this).closest(".form-avion").find(".right-side");
				var num = $('.form-avion').length;
				$(this).closest(".form-avion").find(".motorField").each(function(){
					$(this).remove();
				});
				$.ajax({type: "POST",dataType: "html",url:"getter.php?get=motorField&id="+id+"&num="+num,success: function(data){
					$target.append(data);}
				});
			}
			$( "a.click-venta-detalle" ).click(function( event ) {
				event.preventDefault();
				var href = $(this).attr('href');
				$.ajax({type: "POST",dataType: "html",url:"venta-detalle.php?id="+href,success: function(data){$("#detalleVentaBody").html(data);}});
				$("#ModalDetalleVenta").modal('toggle');
			});
			$("#add-avion").click(function(){
				var $last = $(".last-avion");
				$last.removeClass("last-avion");
				$(".lista_modelos").off("change",update);
				$(".lista_submodelos").off("change",updateSubmodelo);
				$.ajax({
					type: "POST",
					dataType: "html",
					url: "getter.php?get=fieldAvion",
					success: function(data){
						$last.after(data);
						$(".lista_modelos").on("change",update);
						$(".lista_submodelos").on("change",updateSubmodelo);
					},
					error: function(data){
						$(".lista_modelos").on("change",update);
						$(".lista_submodelos").on("change",updateSubmodelo);
					}
				});
			});
			$("#add-pago").click(function(){
				var $last = $(".last-pago");
				$last.removeClass("last-pago");
				var num = $("#last").data("num");
				$("#last").data("num",num+1);
				$.ajax({
					type: "POST",
					dataType: "html",
					url: "getter.php?get=fieldPago&last="+num,
					success: function(data){
						$last.after(data);
					}
				});
			});
    		$("#lista_clientes").change(function() {
				var id = $( "#lista_clientes option:selected" ).val();
				$.ajax({type: "POST",dataType: "html",url:"getter.php?get=cl_rif&id="+id,success: function(data){$("#cl_rif").val(data);}});
			});
			$('input[type=radio][name=tipo_pago]').change(function() {
				var $space = $(this).closest(".row").find(".pago-space");
				if( $(this).hasClass("transferencia") )
					$.ajax({type: "POST",dataType: "html",url:"getter.php?get=fieldTransferencia",success: function(data){$space.html(data);}});
				if( $(this).hasClass("tarjeta-credito") )
					$.ajax({type: "POST",dataType: "html",url:"getter.php?get=fieldTarjeta",success: function(data){$space.html(data);}});
			});
			$(".lista_modelos").on("change",update);
			$(".lista_submodelos").on("change",updateSubmodelo);
		});
	</script>
</body>

</html>
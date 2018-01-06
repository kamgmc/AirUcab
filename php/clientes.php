<?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }
if( !in_array("cl_r", $permiso)){
	if( !isset($_SESSION['code']) ){
		header('Location: login.php');
		exit;
	}
}?>
<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>AirUCAB - Clientes</title>
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
						<?php if( in_array("am_r", $permiso) || in_array("as_r", $permiso) || in_array("di_r", $permiso) || in_array("am_c", $permiso) || in_array("as_c", $permiso) || in_array("di_c", $permiso) ){ ?>
						<li>
							<a href="modeloavion.php"> <i class="fa fa-plane" aria-hidden="true"></i> Aviones </a>
						</li>
						<?php }?>
						<?php if( in_array("em_r", $permiso) || in_array("em_c", $permiso) ){ ?>
						<li>
							<a href="empleados.php"><i class="fa fa-id-card-o"></i>Empleados</a>
						</li>
						<?php }?>
						<?php if( in_array("fv_r", $permiso) || in_array("fv_c", $permiso) ){ ?>
						<li>
							<a href="ventas.php"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Ventas </a>
						</li>
						<?php }?>
						<?php if( in_array("cl_r", $permiso) ){ ?>
						<li class="active">
							<a href="clientes.php"> <i class="fa fa-address-book-o" aria-hidden="true"></i>Clientes</a>
						</li>
						<?php }?>
						<?php if( in_array("po_r", $permiso) ){ ?>
						<li>
							<a href="proveedores.php"> <i class="fa fa-truck" aria-hidden="true"></i>Proveedores</a>
						</li>
						<?php }?>
						<?php if( in_array("fc_r", $permiso) ){ ?>
						<li>
							<a href="compras.php"> <i class="fa fa-shopping-bag " aria-hidden="true"></i>Compras </a>
						</li>
						<?php }?>
						<li>
							<a href="materiales.php"> <i class="fa fa-server " aria-hidden="true"></i>Materiales </a>
						</li>
						<li>
							<a href="piezas.php"> <i class="fa fa-puzzle-piece " aria-hidden="true"></i>Piezas </a>
						</li>
						<li>
							<a href="motores.php"> <i class="fa fa-tachometer " aria-hidden="true"></i>Motores </a>
						</li>
						<li>
							<a href="pruebas.php"> <i class="fa fa-check-square-o " aria-hidden="true"></i>Pruebas </a>
						</li>
						<li>
							<a href="traslados.php"> <i class="fa fa-share-square-o " aria-hidden="true"></i>Traslados </a>
						</li>
						<li>
							<a href="Sedes.php"> <i class="fa fa-university " aria-hidden="true"></i>Sedes </a>
						</li>
					</ul>
				</nav>
				<div class="content-inner">
					<?php if(isset($_GET['error'])){?>
					<!-- Alert -->
					<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
						<?php if($_GET['error']==1){?>Error al crear <strong>Cliente</strong>.<?php }?>
						<?php if($_GET['error']==2){?>Error al insertar <strong>Contacto</strong>.<?php }?>
						<?php if($_GET['error']==3){?>Error al editar <strong>Cliente</strong>.<?php }?>
						<?php if($_GET['error']==4){?>Error al editar <strong>Contacto</strong>.<?php }?>
						<?php if($_GET['error']==5){?>Error al eliminar <strong>Cliente</strong>.<?php }?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php }?>
					<!-- Seccion de diferentes TABS -->
					<section>
						<div class="container-fluid">
							<input id="tab0" type="radio" name="tabs" class="no-display" checked>
							<label for="tab0" class="label"><i class="fa fa-address-book-o" aria-hidden="true"></i> Clientes</label>
							<!-- TAB Explorador Clientes -->
							<section id="content0" class="sectiontab">
								<!-- Accionista -->
								<div class="container-fluid">
									<div class="row">
										<div class="card col-lg-12">
											<div class="row">
												<div class="card-body col-lg-5">
													<form class="form-horizontal">
														<div class="form-group row">
															<div class="col-sm-12">
																<input type="text" placeholder="Ingrese Nombre a Buscar o ID..." class="form-control"> </div>
														</div>
													</form>
												</div>
												<div class=" card-body col-lg-4">
													<div class="form-group row">
														<div class="col-sm-9">
															<input type="submit" value="Ejecutar" class="btn btn-primary"> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Accionista ENDS -->
								<!-- TABLE STARTS -->
								<div class="col-md-12">
									<div class="card">
										<div class="row">
											<div class="col-sm-10"></div>
											<div class="col-sm-2 pad-top">
                                                <?php if( in_array("cl_c", $permiso) ){ ?>
												<button type="button" data-toggle="modal" data-target="#ModalClienteCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
                                                <?php } ?>
											</div>
										</div>
										<div class="card-body">
											<table class="table table-striped table-sm table-hover">
												<thead>
													<tr>
														<th class="text-center">ID</th>
														<th class="text-center">CI / RIF</th>
														<th>Nombre</th>
														<th class="text-center">Monto Acreditado</th>
														<th class="text-center">Fecha de Inscripción</th>
														<th class="text-center"># de Ventas</th>
														<th class="text-center">Ubicación</th>
														<th class="text-center">Acción</th>
													</tr>
												</thead>
												<tbody>
													<?php 	
												$qry = "SELECT cl_id AS id, cl_tipo_rif AS tipo_rif, cl_rif AS rif, cl_nombre AS nombre, SUM(a_precio) AS monto, cl_fecha_inicio AS fecha, COUNT(fv_id) AS ventas, lu_nombre AS direccion FROM Cliente left join Factura_venta ON fv_cliente=cl_id LEFT JOIN Avion ON a_factura_venta=fv_id LEFT JOIN Lugar ON lu_id=cl_direccion GROUP BY cl_id, cl_tipo_rif, cl_rif, cl_nombre,cl_fecha_inicio,lu_nombre ORDER BY cl_id";
												$rs = pg_query( $conexion, $qry );
												while( $cliente = pg_fetch_object($rs) ){?>
														<tr>
															<td class="text-center">
																<?php print $cliente->id;?>
															</td>
															<td class="text-center">
																<?php print $cliente->tipo_rif."-".$cliente->rif;?>
															</td>
															<td>
																<?php print $cliente->nombre;?>
															</td>
															<td class="text-center">
																<?php print number_format($cliente->monto, 2, ',', '.')." Bs";?>
															</td>
															<td class="text-center">
																<?php $date = new DateTime($cliente->fecha); print $date->format('d/m/Y');?>
															</td>
															<td class="text-center">
																<?php print $cliente->ventas;?>
															</td>
															<td class="text-center">
																<?php print $cliente->direccion;?>
															</td>
															<td class="text-center">
																<a href="<?php print $cliente->id;?>" class="click-cliente-detalle">
																	<i class="fa fa-file-text-o" aria-hidden="true"></i> 
																</a>
																<?php if( in_array("cl_d", $permiso) ){ ?>&emsp;
																<a href="cliente-crud.php?delete=<?php print $cliente->id;?>">
																	<i class="fa fa-trash-o" aria-hidden="true"></i>
																</a>
                                                                <?php }?>
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
							<!-- Tab Explorador Clientes ENDS -->
							<!-- Modal Cliente Crear -->
							<div id="ModalClienteCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div class="modal-content">
										<form method="post" action="cliente-crud.php?create=true">
											<div class="modal-header">
												<h4 id="exampleModalLabel" class="modal-title">Crear Nuevo Cliente</h4>
												<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
											</div>
											<div class="modal-body">
												<div class="container-fluid">
													<div class="row">
														<div class="card col-lg-12">
															<div class="row">
																<div class="card-body col-lg-6">
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Nombre</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="nombre" type="text" placeholder="Introduzca Nombre" class="form-control" pattern="[A-Z a-zñ]+" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Estado</h4>
																		</label>
																		<div class="col-sm-9 select">
																			<select id="list-estados" name="account" class="form-control" required>
																				<?php $qry="SELECT lu_id AS id, lu_nombre AS nombre FROM Lugar where lu_tipo='Estado' ORDER BY lu_nombre";
																				$answer = pg_query( $conexion, $qry );
																				while( $estado = pg_fetch_object($answer) ){?>
																				<option value="<?php print $estado->id;?>">
																					<?php print $estado->nombre;?>
																				</option>
																				<?php }?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Municipio</h4>
																		</label>
																		<div class="col-sm-9 select">
																			<select id="list-municipios" disabled name="account" class="form-control" required>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Parroquia</h4>
																		</label>
																		<div class="col-sm-9 select">
																			<select id="list-parroquias" disabled name="parroquia" class="form-control" required>
																			</select>
																		</div>
																	</div>
																</div>
																<div class=" card-body col-lg-6">
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>CI / RIF</h4> 
																		</label>
																		<div class="col-sm-3 select">
																			<select name="tipo_rif" class="form-control" required>
																				<option value="J">J</option>
																				<option value="G">G</option>
																				<option value="V">V</option>
																				<option value="E">E</option>
																			</select>
																		</div>
																		<div class="col-sm-6">
																			<input name="rif" type="text" placeholder="Introduzca Rif" class="form-control" pattern="\d+" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3 form-control-label">
																			<h4>Página Web</h4>
																		</label>
																		<div class="col-sm-9">
																			<input name="web" type="text" placeholder="Introduzca Pagina Web" class="form-control" pattern="[A-Za-z.-]+">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-12 form-control-label">
																			<h4>Contacto</h4> 
																		</label>
																	</div>
																	<div class="form-group row last-contacto">
																		<div class="col-sm-3 text-right"></div>
																		<div class="col-sm-3 select">
																			<select name="tipo_contacto[]" class="form-control" required>
																				<option value="NULL">Seleccionar</option>
																				<?php $qry = "SELECT ct_id id, ct_nombre nombre FROM Tipo_contacto ORDER BY ct_nombre";
																				$rs = pg_query( $conexion, $qry );
																				while( $tipo_contacto = pg_fetch_object($rs) ){?>
																				<option value="<?php print $tipo_contacto->id;?>">
																					<?php print $tipo_contacto->nombre;?>
																				</option>
																				<?php }?>
																			</select>
																		</div>
																		<div class="col-sm-6">
																			<input name="contacto[]" type="text" placeholder="Introduzca Contacto" class="form-control" pattern="[A-Z a-zñ0-9.@]+" required>
																		</div>
																	</div>
																	<div class="form-group row">
																		<div class="col-sm-12 text-right">
																			<i id="add-contacto" class="fa fa-plus"></i>&emsp;
																		</div>
																	</div>
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
							<!-- Modal Cliente Crear ENDS -->
							<!-- Modal Cliente Informacion -->
							<div id="ModalDetalleCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div id="detalleClienteBody" class="modal-content">
									</div>
								</div>
							</div>
							<!-- Modal Cliente Informacion ENDS -->
							<!-- Modal Cliente Editar -->
							<div id="ModalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
								<div role="document" class="modal-dialog modal-xl">
									<div id="editarClienteBody" class="modal-content">
									</div>
								</div>
							</div>
							<!-- Modal Cliente Editar ENDS -->
						</div>
					</section>
					<!-- Section de tabs ENDS -->
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
			$(document).ready(function () {
				$("#list-estados").change(function () {
					var iden = $("#list-estados option:selected").val();
					$("#list-municipios").removeAttr('disabled');
					$("#list-parroquias").empty();
					$.ajax({
						type: "POST"
						, dataType: "html"
						, url: "getter.php?get=municipios&id=" + iden
						, success: function (data) {
							$("#list-municipios").html(data);
						}
					});
				});
				$("#list-municipios").change(function () {
					var iden = $("#list-municipios option:selected").val();
					$("#list-parroquias").removeAttr('disabled');
					$.ajax({
						type: "POST"
						, dataType: "html"
						, url: "getter.php?get=parroquias&id=" + iden
						, success: function (data) {
							$("#list-parroquias").html(data);
						}
					});
				});
				$("#add-contacto").click(function(){
					var $last = $(".last-contacto");
					$last.removeClass("last-contacto");
					$.ajax({
						type: "POST",
						dataType: "html",
						url:"getter.php?get=fieldContacto",
						success: function(data){
							$last.after(data);
						}
					});
				});
				$( "a.click-cliente-detalle" ).click(function( event ) {
					event.preventDefault();
					var href = $(this).attr('href');
					$.ajax({type: "POST",dataType: "html",url:"cliente-detalle.php?id="+href,success: function(data){$("#detalleClienteBody").html(data);}});
					$("#ModalDetalleCliente").modal('toggle');
				});
				$("#list-estados-up").change(function () {
					var municipio = $(this).closest(".form-group").siblings(".form-group").children("#list-municipios-up");
					var iden = $("#list-estados-up option:selected").val();
					$.ajax({
						type: "POST"
						, dataType: "html"
						, url: "getter.php?get=municipios&id=" + iden
						, success: function (data) {
							municipio.html(data);
						}
					});
				});
				$("#list-municipios-up").change(function () {
					var iden = $("#list-municipios-up option:selected").val();
					$.ajax({
						type: "POST"
						, dataType: "html"
						, url: "getter.php?get=parroquias&id=" + iden
						, success: function (data) {
							$("#list-parroquias-up").html(data);
						}
					});
				});
			});
		</script>
	</body>

	</html>

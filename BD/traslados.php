<?php session_start(); 
date_default_timezone_set('America/Port_of_Spain'); 
error_reporting('E_ALL ^ E_NOTICE'); 
include 'conexion.php'; 
if(!isset($_SESSION['rol'])){ $nombre = session_name("AirUCAB"); $_SESSION['rol'] = 5;} 
$qry = "SELECT pe_iniciales AS permiso FROM Rol_permiso, permiso, rol_sistema WHERE rp_permiso=pe_id AND rp_rol=sr_id AND sr_id=".$_SESSION['rol']; 
$rs = pg_query( $conexion, $qry ); $permiso = array();
while( $rol = pg_fetch_object($rs) ){ $permiso[] = $rol->permiso; }?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AirUCAB - Main</title>
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
	<link rel="shortcut icon" href="favicon.png"> </head>

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
							<!-- Logout    -->
							<li class="nav-item"><a href="login.html" class="nav-link logout">Cerrar Sesion<i class="fa fa-sign-out"></i></a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<div class="page-content d-flex align-items-stretch">
			<!-- Side Navbar -->
			<nav class="side-navbar">
				<!-- Sidebar Header-->
				<div class="sidebar-header d-flex align-items-center">
					<div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
					<div class="title">
						<h1 class="h4">Abuelo Fdz</h1>
						<p>Director Operaciones</p>
					</div>
				</div>
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
					<li>
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
					<li class="active">
						<a href="traslados.php"> <i class="fa fa-share-square-o " aria-hidden="true"></i>Traslados </a>
					</li>
					<li>
						<a href="Sedes.php"> <i class="fa fa-university " aria-hidden="true"></i>Sedes </a>
					</li>
				</ul>
			</nav>
			<div class="content-inner">
				<!-- Section de TABS -->
				<section>
					<div class="container-fluid">
						<input id="tab0" type="radio" name="tabs" class="no-display" checked>
						<label for="tab0" class="label"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Traslados</label>
						
						
						<!-- TAB Pruebas -->
						<section id="content0" class="sectiontab">
							
							<!-- TABLE STARTS -->
							<div class="col-md-12">
								<div class="card">
									<div class="row">
										<div class="col-sm-10"></div>
										<div class="col-sm-2 pad-top">
											<button type="button" data-toggle="modal" data-target="#myModalPruebaCrear" class="btn btn-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i> Crear</button>
										</div>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm table-hover">
											<thead>
												<tr>
													<th>NOMBRE</th>
													<th class="text-center">Accion</th>
												</tr>
											</thead>
											<tbody>
												
													<tr>
														<td>Prueba de Calidad</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalPrueba"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td>Prueba de Calidad</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalPrueba"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td>Prueba de Calidad</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalPrueba"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td>Prueba de Calidad</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalPrueba"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td>Prueba de Calidad</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalPrueba"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td>Prueba de Calidad</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalPrueba"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td>Prueba de Calidad</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalPrueba"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td>Prueba de Calidad</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalPrueba"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													<tr>
														<td>Prueba de Calidad</td>
														<td class="text-center">
															<a href="" data-toggle="modal" data-target="#myModalPrueba"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>&emsp;
															<a href=""> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
														</td>
													</tr>
													
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- TABLE ENDS -->
						</section>


						

						


						
						

												
						<!-- Modal Prueba Editar -->
						<div id="myModalPrueba" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">EDITAR PRUEBA</h4>
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
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Tipo</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Tipo" class="form-control"> </div>
															</div>
															
														</div>	
															
														<div class=" card-body col-lg-6">
															
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nota</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Aqui puedes escribir..." class="form-control form-control-lg" rows="4" cols="50"> </div>
															</div>
														</div>

													</div>
												</div>
											</div>
										</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" class="btn btn-primary">Guardar Cambios</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Prueba Editar ENDS -->

					

						

						<!-- Modal Prueba Crear -->
						<div id="myModalPruebaCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
							<div role="document" class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h4 id="exampleModalLabel" class="modal-title">CREAR PRUEBA</h4>
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
																	<h3>Nombre</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Nombre" class="form-control"> </div>
															</div>
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Tipo</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Introduzca Tipo" class="form-control"> </div>
															</div>
															
														</div>	
															
														<div class=" card-body col-lg-6">
															
															<div class="form-group row">
																<label class="col-sm-3 form-control-label">
																	<h3>Nota</h3> </label>
																<div class="col-sm-9">
																	<input type="text" placeholder="Aqui puedes escribir..." class="form-control form-control-lg" rows="4" cols="50"> </div>
															</div>
														</div>

													</div>
												</div>
											</div>
										</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
										<button type="button" class="btn btn-primary">Guardar Cambios</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Prueba Crear ENDS -->

						






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
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="vendor/popper.js/umd/popper.min.js">
	</script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/jquery.cookie/jquery.cookie.js">
	</script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	<script src="js/front.js"></script>
</body>

</html>